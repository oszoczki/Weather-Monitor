<?php
namespace Tests\Unit;

use App\Models\Location;
use App\Models\Temperature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TemperatureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_fillable_attributes()
    {
        $fillable = [
            'location_id',
            'temperature',
        ];

        $temperature = new Temperature();

        $this->assertEquals($fillable, $temperature->getFillable());
    }

    #[Test]
    public function it_casts_temperature_to_decimal()
    {
        $temperature = Temperature::factory()->create([
            'temperature' => '22.50',
        ]);

        $this->assertIsString($temperature->getRawOriginal('temperature'));
        $this->assertIsFloat($temperature->temperature);
        $this->assertEquals(22.50, $temperature->temperature);
    }

    #[Test]
    public function it_belongs_to_location()
    {
        $location    = Location::factory()->create();
        $temperature = Temperature::factory()->create([
            'location_id' => $location->id,
        ]);

        $this->assertInstanceOf(Location::class, $temperature->location);
        $this->assertEquals($location->id, $temperature->location->id);
    }

    #[Test]
    public function it_can_store_negative_temperatures()
    {
        $temperature = Temperature::factory()->create([
            'temperature' => -10.5,
        ]);

        $this->assertEquals(-10.5, $temperature->temperature);
    }

    #[Test]
    public function it_can_store_zero_temperature()
    {
        $temperature = Temperature::factory()->create([
            'temperature' => 0,
        ]);

        $this->assertEquals(0.0, $temperature->temperature);
    }

    #[Test]
    public function it_stores_timestamps()
    {
        $temperature = Temperature::factory()->create();

        $this->assertNotNull($temperature->created_at);
        $this->assertNotNull($temperature->updated_at);
    }

    #[Test]
    public function it_cascades_on_location_delete()
    {
        $location    = Location::factory()->create();
        $temperature = Temperature::factory()->create([
            'location_id' => $location->id,
        ]);

        $location->delete();

        $this->assertDatabaseMissing('temperatures', [
            'id' => $temperature->id,
        ]);
    }
}
