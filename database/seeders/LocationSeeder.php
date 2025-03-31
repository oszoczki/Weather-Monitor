<?php
namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create([
            'country_code' => 'HU',
            'city'         => 'Budapest',
            'latitude'     => 47.4979,
            'longitude'    => 19.0402,
            'cron'         => '*/30 * * * *',
        ]);

        Location::create([
            'country_code' => 'HU',
            'city'         => 'Debrecen',
            'latitude'     => 47.5316,
            'longitude'    => 21.6213,
            'cron'         => '0 * * * *',
        ]);
    }
}
