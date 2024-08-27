<!DOCTYPE html>
<html lang="{{ env('APP_LOCALE') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - @yield('page-name')</title>

    @vite('resources/sass/app.sass', 'build')
    @vite('resources/js/app.js', 'build')

    @yield('include-vite')
</head>

<body>
    @include('include.header')
    <div class="page-content mini-scroll">
        @yield('body')
    </div>
</body>

</html>
