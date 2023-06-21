<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/main.css'])
    @livewireStyles
</head>

<body class="hold-transition login-page antialiased"
    style="background: url('{{ asset('bg.jpg') }}');fit;background-size:cover;">
    {{ $slot }}
    @livewireScripts
</body>
</html>
