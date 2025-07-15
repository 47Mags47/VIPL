<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="_token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    @viteReactRefresh
    @inertiaHead

    @vite('resources/js/App.jsx')
    @vite('resources/sass/app.sass')
</head>

<body>

    @inertia
    @routes

</body>

</html>
