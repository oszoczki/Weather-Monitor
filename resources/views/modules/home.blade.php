@extends('app')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Időjárás Keresés</h2>
            
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('locations') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">Ország</label>
                    <input type="text" name="country" id="country" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">Város</label>
                    <input type="text" name="city" id="city" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="cron" class="block text-sm font-medium text-gray-700">Cron</label>
                    <input type="number" name="cron" id="cron" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Keresés
                </button>
            </form>
        </div>
    </div>
@endsection