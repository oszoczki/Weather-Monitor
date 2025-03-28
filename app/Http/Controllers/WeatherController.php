<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'country' => 'required|string',
            'city'    => 'required|string',
            'number'  => 'required|numeric',
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
                return back()->withInput()->with('error', 'Nem található ilyen város az adott országban.');
            }

            $location = $data['results'][0];

            // // Fetch weather data
            // $weatherResponse = Http::get('https://api.open-meteo.com/v1/forecast', [
            //     'latitude'  => $location['latitude'],
            //     'longitude' => $location['longitude'],
            //     'current'   => 'temperature_2m',
            //     'timezone'  => $location['timezone'],
            // ]);

            // if ($weatherResponse->successful()) {
            //     $weatherData = $weatherResponse->json();

            //     return back()->withInput()->with([
            //         'success' => sprintf(
            //             'Város: %s, %s - Hőmérséklet: %s°C',
            //             $location['name'],
            //             $location['country'],
            //             $weatherData['current']['temperature_2m']
            //         ),
            //     ]);
            // }
        }

        return back()->withInput()->with('error', 'Hiba történt az időjárás adatok lekérdezése során.');
    }
}
