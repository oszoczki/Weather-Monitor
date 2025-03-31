<?php
namespace App\Http\Controllers;

use App\Models\Location;
use App\Rules\CronExpression;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('modules.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('modules.locations.create');
    }

    public function store(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'country_code' => 'required|string|size:2',
            'city'         => 'required|string|max:255',
            'show_on_home' => 'nullable|boolean',
            'cron'         => ['required', 'string', new CronExpression],
        ]);

        $response = Http::get('https://geocoding-api.open-meteo.com/v1/search', [
            'name'        => $request->city,
            'count'       => 1,
            'language'    => 'en',
            'format'      => 'json',
            'countryCode' => $request->country_code,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (empty($data['results'])) {
                return back()->withInput()->with('error', __('locations.city_not_found'));
            }

            $location = $data['results'][0];

            // Store location in database
            $locationObject = Location::create([
                'country_code' => $location['country_code'],
                'city'         => $location['name'],
                'latitude'     => $location['latitude'],
                'longitude'    => $location['longitude'],
                'cron'         => $request->cron,
                'show_on_home' => $request->show_on_home ?? 0,
            ]);

            $schedule->command('location:check', ['location' => $locationObject->id])
                ->cron('1 * * * *')
                ->withoutOverlapping()
                ->runInBackground();

            return redirect()->route('locations.index')
                ->with('success', __('locations.created'));
        }

        return back()->withInput()->with('error', __('locations.weather_error'));
    }

    public function show(Location $location)
    {
        return view('modules.locations.show', compact('location'));
    }

    public function edit(Location $location)
    {
        return view('modules.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        try {
            $request->validate([
                'cron'         => ['required', 'string', new CronExpression],
                'show_on_home' => 'nullable|boolean',
            ]);

            // Update location in database
            $location->update([
                'cron'         => $request->cron,
                'show_on_home' => $request->show_on_home ?? 0,
            ]);

            return redirect()->route('locations.index')
                ->with('success', __('locations.updated'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', __('locations.location_update_error'));
        }
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')
            ->with('success', __('locations.deleted'));
    }
}
