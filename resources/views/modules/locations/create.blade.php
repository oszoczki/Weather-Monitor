@extends('app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">{{ __('locations.new_location') }}</h1>
                <a href="{{ route('locations.index') }}" class="text-blue-600 hover:text-blue-900">
                    {{ __('locations.back_to_list') }}
                </a>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('locations.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label for="country" class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.country') }}</label>
                    <input type="text" name="country" id="country" value="{{ old('country') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.city') }}</label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label for="cron" class="block text-gray-700 text-sm font-bold mb-2">{{ __('locations.cron') }}</label>
                    <input type="number" name="cron" id="cron" value="{{ old('cron') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ __('locations.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection 