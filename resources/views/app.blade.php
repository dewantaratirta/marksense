<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Righteous&display=swap');
    </style>

    @vite(['resources/js/frontpage.js', 'resources/css/frontpage.pcss'])

    {{-- @if (Vite::isRunningHot())
        @vite(['resources/js/frontpage.js', 'resources/css/frontpage.pcss'])
    @else
        @vite(['resources/js/frontpage.js', 'resources/css/frontpage.css'])
    @endif --}}

    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>

<style>

</style>
