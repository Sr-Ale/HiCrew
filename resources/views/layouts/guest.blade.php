<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        include '../config.php';
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{$va_description}}"/>
    <meta name="keywords" content="{{$va_keywords}}"/>
    <meta name="author" content="HiCrew"/>
    <meta name="copyright" content="HiCrew"/>
    <link rel="icon" type="image/x-icon" href="{{asset('/images/fav.png')}}">
    <title>{{$va_name}} - HiCrew!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-image: url('{{ asset('images/bg_login.png') }}')">
            <div>
                <a href="{{route('index')}}">
                    <img src="{{asset('images/logo_va.png')}}">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
            <br>
        </div>
    </body>
</html>
