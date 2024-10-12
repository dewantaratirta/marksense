<!DOCTYPE html>
<html lang="en_EN">

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

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('/site.webmanifest')}}">
    <meta name="msapplication-TileColor" content="#0052ff" />
    <meta name="theme-color" content="#0052ff" />

    @inertiaHead
</head>

<body data-theme="my-custom-theme">
    @inertia
</body>

</html>
