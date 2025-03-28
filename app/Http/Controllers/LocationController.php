<?php
namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('modules.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('modules.locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string',
            'city'    => 'required|string',
            'cron'    => 'required|numeric',
        ]);

        $response = Http::get('https://geocoding-api.open-meteo.com/v1/search', [
            'name'        => $request->city,
            'count'       => 1,
            'language'    => 'en',
            'format'      => 'json',
            'countryCode' => $request->country,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (empty($data['results'])) {
                return back()->withInput()->with('error', __('locations.city_not_found'));
            }

            $location = $data['results'][0];

            // Fetch weather data
            $weatherResponse = Http::get('https://api.open-meteo.com/v1/forecast', [
                'latitude'  => $location['latitude'],
                'longitude' => $location['longitude'],
                'current'   => 'temperature_2m',
                'timezone'  => $location['timezone'],
            ]);

            if ($weatherResponse->successful()) {
                $weatherData = $weatherResponse->json();

                // Store location in database
                Location::create([
                    'country'   => $location['country'],
                    'city'      => $location['name'],
                    'latitude'  => $location['latitude'],
                    'longitude' => $location['longitude'],
                    'cron'      => $request->cron,
                ]);

                return redirect()->route('locations.index')
                    ->with('success', __('locations.created'));
            }
        }

        return back()->withInput()->with('error', __('locations.weather_error'));
    }

    public function show(Location $location)
    {
        return view('modules.locations.show', compact('location'));
    }

    public function edit(Location $location)
    {
        return view('modules.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'country' => 'required|string',
            'city'    => 'required|string',
            'cron'    => 'required|numeric',
        ]);

        $response = Http::get('https://geocoding-api.open-meteo.com/v1/search', [
            'name'        => $request->city,
            'count'       => 1,
            'language'    => 'en',
            'format'      => 'json',
            'countryCode' => $request->country,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (empty($data['results'])) {
                return back()->withInput()->with('error', __('locations.city_not_found'));
            }

            $locationData = $data['results'][0];

            // Update location in database
            $location->update([
                'country'   => $locationData['country'],
                'city'      => $locationData['name'],
                'latitude'  => $locationData['latitude'],
                'longitude' => $locationData['longitude'],
                'cron'      => $request->cron,
            ]);

            return redirect()->route('locations.index')
                ->with('success', __('locations.updated'));
        }

        return back()->withInput()->with('error', __('locations.location_update_error'));
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')
            ->with('success', __('locations.deleted'));
    }
}
