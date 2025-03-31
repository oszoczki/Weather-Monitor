<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.head')
    </head>
    <body class='font-sans antialiased'>
        @include('components.header')

        <div class="content min-h-screen max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </body>
    <footer>
        @yield('scripts')
    </footer>
</html>