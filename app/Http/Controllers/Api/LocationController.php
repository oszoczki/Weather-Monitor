<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Lekéri az összes helyszínt és azok utolsó méréseit.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $locations = Location::with(['temperatures'])->get();

        return response()->json([
            'data' => $locations->map(function ($location) {
                return [
                    'id'                  => $location->id,
                    'country'             => getCountryList()[$location->country_code],
                    'city'                => $location->city,
                    'latitude'            => $location->latitude,
                    'longitude'           => $location->longitude,
                    'last_temperature'    => $location->temperatures->isNotEmpty()
                    ? number_format($location->temperatures->last()->temperature, 1)
                    : null,
                    'last_measurement_at' => $location->temperatures->isNotEmpty()
                    ? $location->temperatures->last()->created_at
                    : null,
                ];
            }),
        ]);
    }

    /**
     * Lekéri egy adott helyszín részletes adatait és méréseit.
     *
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Location $location)
    {
        $location->load(['temperatures' => function ($query) {
            $query->latest()->take(24);
        }]);

        return response()->json([
            'data' => [
                'id'           => $location->id,
                'country'      => getCountryList()[$location->country_code],
                'city'         => $location->city,
                'latitude'     => $location->latitude,
                'longitude'    => $location->longitude,
                'temperatures' => $location->temperatures->map(function ($temperature) {
                    return [
                        'temperature' => number_format($temperature->temperature, 1),
                        'measured_at' => $temperature->created_at,
                    ];
                }),
                'statistics'   => [
                    'average' => $location->temperatures->avg('temperature'),
                    'min'     => $location->temperatures->min('temperature'),
                    'max'     => $location->temperatures->max('temperature'),
                ],
            ],
        ]);
    }
}
