<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Perfis Sociais') }}</title>

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.ts'])
    @inertiaHead
</head>

<body class="bg-slate-900 h-full">
    @inertia
</body>

</html>