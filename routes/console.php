<?php

use App\Models\Location;
use App\Models\Temperature;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('weather:check-all', function () {
    $this->info('Starting weather check for all locations...');

    foreach (Location::all() as $location) {
        try {
            if (time() % $location->cron !== 0) {
                continue;
            }

            $response = Http::get('https://api.open-meteo.com/v1/forecast', [
                'latitude'  => $location->latitude,
                'longitude' => $location->longitude,
                'current'   => 'temperature_2m',
                'timezone'  => 'auto',
            ]);

            if ($response->successful()) {
                $weatherData = $response->json();
                $current     = $weatherData['current'];

                // Store temperature data in database
                Temperature::create([
                    'location_id' => $location->id,
                    'temperature' => $current['temperature_2m'],
                ]);

                Log::info("Weather data for {$location->city}, {$location->country}", [
                    'location_id' => $location->id,
                    'temperature' => $current['temperature_2m'],
                    'timestamp'   => now(),
                ]);

                $this->info("Processed {$location->city}: {$current['temperature_2m']}°C");
            } else {
                Log::error("Failed to fetch weather for {$location->city}", [
                    'location_id' => $location->id,
                    'response'    => $response->status(),
                ]);
                $this->error("Failed to fetch weather for {$location->city}");
            }
        } catch (\Exception $e) {
            Log::error("Error processing {$location->city}", [
                'location_id' => $location->id,
                'error'       => $e->getMessage(),
            ]);
            $this->error("Error processing {$location->city}: {$e->getMessage()}");
        }
    }

    $this->info('Completed weather check for all locations.');
})->purpose('Check weather for all locations')->everySecond();
