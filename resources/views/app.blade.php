<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.head')
    </head>
    <body class='flex justify-center items-center h-screen w-screen'>
        <div class="content">
            @yield('content')
        </div>
    </body>
    <footer>
        @yield('scripts')
    </footer>
</html>