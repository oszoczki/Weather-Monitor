<header class="shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <a href="{{ route('home') }}" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Főoldal
                    </a>
                    <a href="{{ route('locations.index') }}" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('locations.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Helyszínek
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" 
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                Főoldal
            </a>
            <a href="{{ route('locations.index') }}" 
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('locations.*') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                Helyszínek
            </a>
        </div>
    </div>
</header>