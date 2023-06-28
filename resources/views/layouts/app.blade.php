<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('logo.svg') }}">
    <script src="http://127.0.0.1:8000/moment/moment.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/main.css','resources/js/toast.js'])
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
    @stack('js')
    @livewireScripts
</body>
</html>
