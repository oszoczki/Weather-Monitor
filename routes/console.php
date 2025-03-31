<?php

use App\Models\Location;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

foreach (Location::all() as $location) {
    Schedule::command('location:check', [$location->id])
        ->cron($location->cron)
        ->withoutOverlapping()
        ->runInBackground();
}
