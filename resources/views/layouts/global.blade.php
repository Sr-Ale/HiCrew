<!doctype html>
<html lang="en">
<head>
    @php
        include '../config.php';
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{$va_description}}"/>
    <meta name="keywords" content="{{$va_keywords}}"/>
    <meta name="author" content="HiCrew"/>
    <meta name="copyright" content="HiCrew"/>
    <title>{{$va_name}} - HiCrew!</title>
    <link rel="icon" type="image/x-icon" href="{{asset('/images/fav.png')}}">
    <script src="https://kit.fontawesome.com/e4925a8ca3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
    <script type="text/javascript" src="{{asset('simbrief.apiv1.js')}}"></script>
    <!--<link rel="stylesheet" href={{ asset('css/custom.css') }}>-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
</head>
<body style="background-color: rgba(0, 0, 0, .1)">
<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


<br>
@include('layouts.footer')

    <div class="card fixed bottom-0 start-0" id="cookies" style="z-index: 99999;">
        <div class="card-body">
            {{__('messages.cookies')}}
            <br>
            <a onclick="aceptar_cookies();" class="btn btn-dark" style="cursor:pointer;">{{__('messages.accept')}}</a>
        </div>
    </div>

</x-app-layout>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script>function GetCookie(name) {
        var arg=name+"=";
        var alen=arg.length;
        var clen=document.cookie.length;
        var i=0;

        while (i<clen) {
            var j=i+alen;

            if (document.cookie.substring(i,j)==arg)
                return "1";
            i=document.cookie.indexOf(" ",i)+1;
            if (i==0)
                break;
        }

        return null;
    }

    function aceptar_cookies(){
        var expire=new Date();
        expire=new Date(expire.getTime()+7776000000);
        document.cookie="cookies_surestao=aceptada; expires="+expire;

        var visit=GetCookie("cookies_surestao");

        if (visit==1){
            popbox3();
        }
    }

    $(function() {
        var visit=GetCookie("cookies_surestao");
        if (visit==1){ popbox3(); }
    });

    function popbox3() {
        $('#cookies').toggle();
    }</script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
