<?php
namespace App\Http\Controllers;

use App\Models\Location;

/**
 * HomeController
 *
 * Ez a vezérlő kezeli a főoldalt és az időjárási adatok megjelenítését.
 * Biztosítja a helyszínek listázását és azok időjárási adatainak megjelenítését.
 */
class HomeController extends Controller
{
    /**
     * Megjeleníti a főoldalt az összes helyszín időjárási adataival.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lekérjük az összes helyszínt az utolsó méréseikkel
        $locations = Location::with(['temperatures'])->where('show_on_home', 1)->get();

        return view('home', compact('locations'));
    }
}
