<?php
namespace App\Console\Commands;

use App\Models\Location;
use App\Models\Temperature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:check {location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            Log::info('Checking location ' . $this->argument('location'));

            $location = Location::find($this->argument('location'));

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

                Log::info("Weather data for {$location->city}, {$location->country_code}", [
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
}
