<?php
namespace Tests\Unit;

use App\Models\Location;
use App\Models\Temperature;
use App\Rules\CronExpression;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_fillable_attributes()
    {
        $fillable = [
            'name',
            'country_code',
            'city',
            'latitude',
            'longitude',
            'cron',
            'show_on_home',
        ];

        $location = new Location();

        $this->assertEquals($fillable, $location->getFillable());
    }

    #[Test]
    public function it_casts_coordinates_to_decimal()
    {
        $location = Location::factory()->create([
            'latitude'  => '47.497912',
            'longitude' => '19.040235',
        ]);

        $this->assertIsString($location->getRawOriginal('latitude'));
        $this->assertIsString($location->getRawOriginal('longitude'));
        $this->assertIsFloat($location->latitude);
        $this->assertIsFloat($location->longitude);
    }

    #[Test]
    public function it_has_temperatures_relationship()
    {
        $location = Location::factory()->create();
        Temperature::factory()->count(3)->create([
            'location_id' => $location->id,
        ]);

        $this->assertCount(3, $location->temperatures);
        $this->assertInstanceOf(Temperature::class, $location->temperatures->first());
    }

    #[Test]
    public function it_has_validation_rules()
    {
        $rules = Location::rules();

        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('country_code', $rules);
        $this->assertArrayHasKey('city', $rules);
        $this->assertArrayHasKey('latitude', $rules);
        $this->assertArrayHasKey('longitude', $rules);
        $this->assertArrayHasKey('cron', $rules);
        $this->assertArrayHasKey('show_on_home', $rules);

        // Ellenőrizzük a név szabályait
        $this->assertContains('required', $rules['name']);
        $this->assertContains('string', $rules['name']);
        $this->assertContains('max:255', $rules['name']);

        // Ellenőrizzük az országkód szabályait
        $this->assertContains('required', $rules['country_code']);
        $this->assertContains('string', $rules['country_code']);
        $this->assertContains('max:2', $rules['country_code']);

        // Ellenőrizzük a koordináták szabályait
        $this->assertContains('required', $rules['latitude']);
        $this->assertContains('numeric', $rules['latitude']);
        $this->assertContains('between:-90,90', $rules['latitude']);

        $this->assertContains('required', $rules['longitude']);
        $this->assertContains('numeric', $rules['longitude']);
        $this->assertContains('between:-180,180', $rules['longitude']);

        // Ellenőrizzük a cron szabályait
        $this->assertContains('required', $rules['cron']);
        $this->assertContains('string', $rules['cron']);
        $this->assertInstanceOf(CronExpression::class, $rules['cron'][2]);

        // Ellenőrizzük a show_on_home szabályait
        $this->assertContains('required', $rules['show_on_home']);
        $this->assertContains('boolean', $rules['show_on_home']);
    }

    #[Test]
    public function it_validates_latitude_range()
    {
        $data = [
            'name'         => 'Test Location',
            'country_code' => 'HU',
            'city'         => 'Test City',
            'latitude'     => 91,
            'longitude'    => 19,
            'cron'         => '*/5 * * * *',
            'show_on_home' => true,
        ];

        $validator = Validator::make($data, Location::rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('latitude', $validator->errors()->toArray());
    }

    #[Test]
    public function it_validates_longitude_range()
    {
        $data = [
            'name'         => 'Test Location',
            'country_code' => 'HU',
            'city'         => 'Test City',
            'latitude'     => 47,
            'longitude'    => 181,
            'cron'         => '*/5 * * * *',
            'show_on_home' => true,
        ];

        $validator = Validator::make($data, Location::rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('longitude', $validator->errors()->toArray());
    }

    #[Test]
    public function it_validates_country_code_length()
    {
        $data = [
            'name'         => 'Test Location',
            'country_code' => 'HUN',
            'city'         => 'Test City',
            'latitude'     => 47,
            'longitude'    => 19,
            'cron'         => '*/5 * * * *',
            'show_on_home' => true,
        ];

        $validator = Validator::make($data, Location::rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('country_code', $validator->errors()->toArray());
    }
}
