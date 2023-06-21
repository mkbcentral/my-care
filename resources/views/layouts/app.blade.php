<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/main.css'])
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.patials.navbar')
        @include('layouts.patials.sidebar')
        <div class="content-wrapper">
            {{$slot}}
        </div>
        @include('layouts.patials.footer')
    </div>
    @livewireScripts
</body>
</html>
