<?php
namespace Database\Factories;

use App\Models\Location;
use App\Models\Temperature;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemperatureFactory extends Factory
{
    protected $model = Temperature::class;

    public function definition(): array
    {
        return [
            'location_id' => Location::factory(),
            'temperature' => $this->faker->randomFloat(1, -10, 35),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
