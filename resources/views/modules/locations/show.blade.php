@extends('app')

@section('content')
    <div class="container mx-auto px-4 py-8">
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

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('temperatures.date') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('temperatures.temperature') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($location->temperatures->take(-5) as $temperature)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $temperature->created_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $temperature->temperature }}&degC</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 