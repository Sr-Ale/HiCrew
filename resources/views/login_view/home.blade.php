@extends('layouts.global')
@php
    include '../config.php';
@endphp
@section('content')
    <p class="h3">{{ __('messages.welcome') }} {{Auth::user()->name}}</p>
    <div class="card">
        <div class="card-header">
            <i class="fa-solid fa-chart-simple"></i> {{ __('messages.you_stats') }}
        </div>
        <table class="table table-borderless text-center">
                <thead>
                <tr style="font-size: 25px">
                    <th scope="col">{{$total_flights}}</th>
                    <th scope="col">{{$hours}}</th>
                    <th scope="col">{{$personal_data->points}}</th>
                    <th scope="col">{{$personal_data->ubication}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ __('messages.flights') }}</td>
                    <td>{{ __('messages.hours') }}</td>
                    <td>{{ __('messages.points') }}</td>
                    <td>{{ __('messages.location') }}</td>
                </tr>
                </tbody>
            </table>

    </div>
    </br>
    <div class="container-fluid">
        <div class="row align-items-start">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-bullhorn"></i> {{ __('messages.notams') }}
                    </div>
                    <div class="card-body">

                        @if(count($notam) > 0)
                        @foreach($notam as $notam)
                                <div class="row align-items-start">
                                    <div class="col">
                                        <p>{{$notam->name}}</p>
                                        <p style="font-size: 13px">{{$notam->description}}</p>
                                    </div>
                                    <div class="col">
                                        <p style="font-size: 13px">{{__('messages.notam_open')}}: {{$notam->date_open}}</p>
                                        <p style="font-size: 13px">{{__('messages.notam_close')}}: {{$notam->date_close}}</p>
                                    </div>
                                </div>
                            <hr>
                        @endforeach
                        @else
                            {{__('messages.no_notams')}}
                        @endif
                    </div>
                </div>
            </div>
            @if(count($event) > 0)
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-calendar"></i> {{ __('messages.events') }}
                    </div>
                    <div class="card-body">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($event as $event)
                        <div class="carousel-item active" data-bs-interval="10000">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#Modal{{$event->id}}">
                            <img src="{{$event->url}}" class="d-block w-100" alt="{{$event->name}}">
                            </a>
                        </div>
                            <div class="modal fade" id="Modal{{$event->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{$event->name}}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {!! $event->description !!}
                                            <br>
                                            <p class="h5"><i class="fa-solid fa-star"></i> {{$event->points}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
    <br>

    <div class="card">
        <div class="card-header">
            <i class="fa-solid fa-paper-plane"></i> {{ __('messages.live_flights') }}
        </div>
        <div class="card-body">
            <table class="table text-center">
                <thead class="table-dark">
                <tr>
                    <th scope="col">{{ __('messages.callsign') }}</th>
                    <th scope="col">{{ __('messages.departure') }}</th>
                    <th scope="col">{{ __('messages.arrival') }}</th>
                    <th scope="col">{{ __('messages.aircraft') }}</th>

                    <th scope="col">{{ __('messages.red') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ivao as $ivao)
                    @if(strncmp($ivao['callsign'], $va_icao,3) === 0)
                        <tr>
                            <td>{{$ivao['callsign']}}</td>
                            <td>{{$ivao['flightPlan']['departureId']}}</td>
                            <td>{{$ivao['flightPlan']['arrivalId']}}</td>
                            <td>{{$ivao['flightPlan']['aircraftId']}}</td>
                            <td>IVAO</td>
                        </tr>
                    @endif
                @endforeach
                @foreach($vatsim as $vatsim)
                    @if(strncmp($vatsim['callsign'], $va_icao,3) === 0)
                        <tr>
                            <td>{{$vatsim['callsign']}}</td>
                            @if($vatsim['flight_plan']!=NULL)
                            <td>{{$vatsim['flight_plan']['departure']}}</td>
                            <td>{{$vatsim['flight_plan']['arrival']}}</td>
                            <td>{{$vatsim['flight_plan']['aircraft_short']}}</td>
                            @else
                                <td>INOP</td>
                                <td>INOP</td>
                                <td>INOP</td>
                            @endif
                            <td>VATSIM</td>
                        </tr>
                    @endif
                @endforeach

                </tbody>
            </table>


            <style>
                #map {
                    height: 70vh;
                    width: 100%;
                    margin: 0 auto;
                    z-index: 1
                }
            </style>
            <div id="map"></div>

        </div>

    </div>

    <script src="js/map.js"></script>
    <script type="text/javascript">
        const markerCustom = customizedMarker();
        function customizedMarker(){
            return{
                radius:5,
                fillColor: 'white',
                color: 'white',
                weight: 1.2,
                opacity: 1,
                fillOpacity: 0.8
            }
        }
        <?php foreach ($ivao_map as $ivao){
        if(strncmp($ivao['callsign'], $va_icao,3) === 0){
        ?>
        L.circleMarker([ <?php echo $ivao['lastTrack']['latitude'] ?>, <?php echo $ivao['lastTrack']['longitude'] ?>]
        ,markerCustom).bindPopup("<center>" + "<?php echo $ivao['callsign'] ?>" + "<br>" +
            "<?php echo $ivao['flightPlan']['departureId'] ?>" + "-" + "<?php echo $ivao['flightPlan']['arrivalId'] ?>" + "<br> IVAO" +
            "</center>").addTo(map)
        <?php }}
        ?>

        <?php foreach ($vatsim_map as $vat){
        if(strncmp($vat['callsign'], $va_icao,3) === 0){
        if($vat['flight_plan']!=NULL){
            ?>
        L.circleMarker([ <?php echo $vat['latitude'] ?>, <?php echo $vat['longitude'] ?>]
            ,markerCustom).bindPopup("<center>" + "<?php echo $vat['callsign'] ?>" + "<br>" +
            "<?php echo $vat['flight_plan']['departure'] ?>" + "-" + "<?php echo $vat['flight_plan']['arrival'] ?>" + "<br> VATSIM" +
            "</center>").addTo(map)
        <?php }}}
        ?>


    </script>

@endsection
