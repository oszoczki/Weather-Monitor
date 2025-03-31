<?php
namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        return [
            'city'         => $this->faker->city(),
            'country_code' => $this->faker->randomElement(['HU', 'ES', 'DE', 'AT']),
            'latitude'     => $this->faker->latitude(),
            'longitude'    => $this->faker->longitude(),
            'cron'         => $this->faker->randomElement(['*/5 * * * *', '*/10 * * * *', '*/15 * * * *']),
            'show_on_home' => $this->faker->boolean(),
        ];
    }
}
