<?php
namespace Tests\Unit;

use App\Http\Controllers\Api\MetricsController;
use App\Models\Location;
use App\Models\Temperature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MetricsControllerTest extends TestCase
{
    use RefreshDatabase;

    private MetricsController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new MetricsController();
    }

    #[Test]
    public function it_returns_correct_location_count_metric()
    {
        // Given
        Location::factory()->count(3)->create();

        // When
        $response = $this->controller->index();
        $content  = $response->getContent();

        // Then
        $this->assertStringContainsString('# HELP weathermonitor_locations_total', $content);
        $this->assertStringContainsString('# TYPE weathermonitor_locations_total gauge', $content);
        $this->assertStringContainsString('weathermonitor_locations_total 3', $content);
    }

    #[Test]
    public function it_returns_correct_temperature_measurements_count_metric()
    {
        // Given
        $location = Location::factory()->create();
        Temperature::factory()->count(5)->create(['location_id' => $location->id]);

        // When
        $response = $this->controller->index();
        $content  = $response->getContent();

        // Then
        $this->assertStringContainsString('# HELP weathermonitor_temperature_measurements_total', $content);
        $this->assertStringContainsString('# TYPE weathermonitor_temperature_measurements_total counter', $content);
        $this->assertStringContainsString('weathermonitor_temperature_measurements_total 5', $content);
    }

    #[Test]
    public function it_returns_correct_current_temperature_metrics()
    {
        // Given
        $location = Location::factory()->create([
            'city'         => 'Test City',
            'country_code' => 'HU',
        ]);
        $temperature = Temperature::factory()->create([
            'location_id' => $location->id,
            'temperature' => 22.5,
        ]);

        // When
        $response = $this->controller->index();
        $content  = $response->getContent();

        // Then
        $this->assertStringContainsString('# HELP weathermonitor_temperature_celsius', $content);
        $this->assertStringContainsString('# TYPE weathermonitor_temperature_celsius gauge', $content);
        $this->assertStringContainsString(
            sprintf(
                'weathermonitor_temperature_celsius{location="%d", city="Test City", country="Magyarország"} 22.5',
                $location->id
            ),
            $content
        );
    }

    #[Test]
    public function it_returns_correct_average_temperature_metrics()
    {
        // Given
        $location = Location::factory()->create([
            'city'         => 'Test City',
            'country_code' => 'HU',
        ]);

        // Create temperatures for the last 24 hours
        Temperature::factory()->createMany([
            ['location_id' => $location->id, 'temperature' => 20.0, 'created_at' => now()->subHours(12)],
            ['location_id' => $location->id, 'temperature' => 22.0, 'created_at' => now()->subHours(6)],
            ['location_id' => $location->id, 'temperature' => 24.0, 'created_at' => now()->subHours(1)],
        ]);

        // When
        $response = $this->controller->index();
        $content  = $response->getContent();

        // Then
        $this->assertStringContainsString('# HELP weathermonitor_temperature_average_celsius', $content);
        $this->assertStringContainsString('# TYPE weathermonitor_temperature_average_celsius gauge', $content);
        $this->assertStringContainsString(
            sprintf(
                'weathermonitor_temperature_average_celsius{location="%d", city="Test City", country="Magyarország"} 22.0',
                $location->id
            ),
            $content
        );
    }

    #[Test]
    public function it_returns_correct_min_max_temperature_metrics()
    {
        // Given
        $location = Location::factory()->create([
            'city'         => 'Test City',
            'country_code' => 'HU',
        ]);

        // Create temperatures for the last 24 hours
        Temperature::factory()->createMany([
            ['location_id' => $location->id, 'temperature' => 20.0, 'created_at' => now()->subHours(12)],
            ['location_id' => $location->id, 'temperature' => 22.0, 'created_at' => now()->subHours(6)],
            ['location_id' => $location->id, 'temperature' => 24.0, 'created_at' => now()->subHours(1)],
        ]);

        // When
        $response = $this->controller->index();
        $content  = $response->getContent();

        // Then
        $this->assertStringContainsString('# HELP weathermonitor_temperature_min_celsius', $content);
        $this->assertStringContainsString('# TYPE weathermonitor_temperature_min_celsius gauge', $content);
        $this->assertStringContainsString(
            sprintf(
                'weathermonitor_temperature_min_celsius{location="%d", city="Test City", country="Magyarország"} 20.0',
                $location->id
            ),
            $content
        );

        $this->assertStringContainsString('# HELP weathermonitor_temperature_max_celsius', $content);
        $this->assertStringContainsString('# TYPE weathermonitor_temperature_max_celsius gauge', $content);
        $this->assertStringContainsString(
            sprintf(
                'weathermonitor_temperature_max_celsius{location="%d", city="Test City", country="Magyarország"} 24.0',
                $location->id
            ),
            $content
        );
    }

    #[Test]
    public function it_returns_correct_content_type()
    {
        // When
        $response = $this->controller->index();

        // Then
        $this->assertEquals('text/plain', $response->headers->get('Content-Type'));
    }
}
