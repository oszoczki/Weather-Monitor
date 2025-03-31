<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Temperature;
use Illuminate\Http\Response;

class MetricsController extends Controller
{
    /**
     * Lekéri a rendszer metrikáit Prometheus formátumban.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metrics = [];

        // Helyszínek száma
        $metrics[] = '# HELP weathermonitor_locations_total Total number of locations';
        $metrics[] = '# TYPE weathermonitor_locations_total gauge';
        $metrics[] = 'weathermonitor_locations_total ' . Location::count();

        // Mérések száma
        $metrics[] = '# HELP weathermonitor_temperature_measurements_total Total number of temperature measurements';
        $metrics[] = '# TYPE weathermonitor_temperature_measurements_total counter';
        $metrics[] = 'weathermonitor_temperature_measurements_total ' . Temperature::count();

        // Helyszínenkénti utolsó mérés
        $metrics[] = '# HELP weathermonitor_temperature_celsius Current temperature in Celsius';
        $metrics[] = '# TYPE weathermonitor_temperature_celsius gauge';

        Location::with(['temperatures'])->each(function ($location) use (&$metrics) {
            if ($location->temperatures->isNotEmpty()) {
                $metrics[] = sprintf(
                    'weathermonitor_temperature_celsius{location="%s", city="%s", country="%s"} %f',
                    $location->id,
                    $location->city,
                    getCountryList()[$location->country_code],
                    $location->temperatures->last()->temperature
                );
            }
        });

        // Átlagos hőmérséklet az utolsó 24 órában
        $metrics[] = '# HELP weathermonitor_temperature_average_celsius Average temperature in the last 24 hours';
        $metrics[] = '# TYPE weathermonitor_temperature_average_celsius gauge';

        Location::each(function ($location) use (&$metrics) {
            $avgTemp = Temperature::where('location_id', $location->id)
                ->where('created_at', '>=', now()->subHours(24))
                ->avg('temperature');

            if ($avgTemp !== null) {
                $metrics[] = sprintf(
                    'weathermonitor_temperature_average_celsius{location="%s", city="%s", country="%s"} %f',
                    $location->id,
                    $location->city,
                    getCountryList()[$location->country_code],
                    $avgTemp
                );
            }
        });

        // Minimum és maximum hőmérséklet az utolsó 24 órában
        $metrics[] = '# HELP weathermonitor_temperature_min_celsius Minimum temperature in the last 24 hours';
        $metrics[] = '# TYPE weathermonitor_temperature_min_celsius gauge';
        $metrics[] = '# HELP weathermonitor_temperature_max_celsius Maximum temperature in the last 24 hours';
        $metrics[] = '# TYPE weathermonitor_temperature_max_celsius gauge';

        Location::each(function ($location) use (&$metrics) {
            $temps = Temperature::where('location_id', $location->id)
                ->where('created_at', '>=', now()->subHours(24))
                ->get();

            if ($temps->isNotEmpty()) {
                $metrics[] = sprintf(
                    'weathermonitor_temperature_min_celsius{location="%s", city="%s", country="%s"} %f',
                    $location->id,
                    $location->city,
                    getCountryList()[$location->country_code],
                    $temps->min('temperature')
                );

                $metrics[] = sprintf(
                    'weathermonitor_temperature_max_celsius{location="%s", city="%s", country="%s"} %f',
                    $location->id,
                    $location->city,
                    getCountryList()[$location->country_code],
                    $temps->max('temperature')
                );
            }
        });

        return response(implode("\n", $metrics), Response::HTTP_OK)
            ->header('Content-Type', 'text/plain');
    }
}
