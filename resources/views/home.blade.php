@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Helyszínek és hőmérsékletek</h1>
        <a href="{{ route('locations.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Helyszínek kezelése
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($locations as $location)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ getCountryList()[$location->country_code] }}, {{ $location->city }}</h2>
                    @if ($location->temperatures->isNotEmpty())
                        <p class="text-gray-600">
                            <span class="font-medium">Hőmérséklet:</span> 
                            {{ number_format($location->temperatures->last()->temperature, 1) }}°C
                        </p>
                    @else
                        <p class="text-gray-500 italic">Még nincs mérés</p>
                    @endif
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <a href="{{ route('locations.show', $location) }}" 
                       class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200">
                        Megtekintés
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 