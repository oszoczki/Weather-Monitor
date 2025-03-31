@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">{{ __('locations.location_details') }}</h1>
                <div>
                    <a href="{{ route('locations.edit', $location) }}" class="text-blue-600 hover:text-blue-900 mr-4">{{ __('locations.edit') }}</a>
                    <a href="{{ route('locations.index') }}" class="text-blue-600 hover:text-blue-900">{{ __('locations.back_to_list') }}</a>
                </div>
            </div>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.country') }}</label>
                    <p class="text-gray-900">{{ $location->country }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.city') }}</label>
                    <p class="text-gray-900">{{ $location->city }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.cron') }}</label>
                    <p class="text-gray-900">{{ $location->cron }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.latitude') }}</label>
                    <p class="text-gray-900">{{ $location->latitude }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.longitude') }}</label>
                    <p class="text-gray-900">{{ $location->longitude }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.created_at') }}</label>
                    <p class="text-gray-900">{{ $location->created_at->format('Y-m-d H:i:s') }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.updated_at') }}</label>
                    <p class="text-gray-900">{{ $location->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
        </div>

        @if(!empty($location->temperatures))
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Hőmérsékleti grafikon</h3>
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <div class="h-[400px]">
                        <canvas id="temperatureChart" data-temperatures='{{ json_encode($location->temperatures) }}'></canvas>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection 