<?php
namespace Database\Seeders;

use App\Models\Location;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TemperatureSeeder extends Seeder
{
    public function run(): void
    {
        $locations = Location::all();
        if ($locations->isEmpty()) {
            $this->command->info('Nincsenek helyszínek a hőmérsékleti adatok létrehozásához.');
            return;
        }

        foreach ($locations as $location) {
            // Az utolsó 24 óra adatait generáljuk
            $startTime   = Carbon::now()->subDay();
            $currentTime = $startTime->copy();

            // Alap hőmérséklet 20°C körül
            $baseTemperature = 20;
            // Napi ingadozás ±5°C
            $dailyVariation = 5;

            // 15 mérés generálása
            for ($i = 0; $i < 15; $i++) {
                // Napi ingadozás szinuszos függvénnyel
                $hourOfDay   = $currentTime->hour;
                $dailyOffset = sin(($hourOfDay - 12) * pi() / 12) * $dailyVariation;

                // Véletlenszerű ingadozás ±1°C
                $randomVariation = (rand(-100, 100) / 100);

                // Végső hőmérséklet számítása
                $temperature = $baseTemperature + $dailyOffset + $randomVariation;

                // Hőmérséklet mentése
                Temperature::create([
                    'location_id' => $location->id,
                    'temperature' => $temperature,
                    'created_at'  => $currentTime->format('Y-m-d H:i:s'),
                    'updated_at'  => $currentTime->format('Y-m-d H:i:s'),
                ]);

                // Következő mérés 30-60 perc múlva
                $currentTime->addMinutes(rand(30, 60));
            }
        }
    }
}
