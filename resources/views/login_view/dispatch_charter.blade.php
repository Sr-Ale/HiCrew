@extends('layouts.global')
@php
    include '../config.php';
@endphp
@section('content')
    <p class="h3"><i class="fa-solid fa-plane-departure"></i> {{ __('messages.charter_flight') }}</p>
    <section class="content" id="selector">
        <button type="button" class="btn btn-block btn-dark" onclick="SiFunction()">{{ __('messages.yes_simbrief') }}</button>
        <button type="button" class="btn btn-block btn-dark" onclick="NoFunction()">{{ __('messages.no_simbrief') }}</button>
    </section>
    <section class="content" id="simbrief" style="display: none">
        <form class="row g-3" id="sbapiform">
            <div class="col-md-3">
                <label for="text" class="form-label">{{__('messages.callsign')}} ({{__('messages.no_add')}} {{$va_icao}})</label>
                <input type="text" class="form-control" id="fltnum" name="fltnum" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
            </div>
            <div class="col-md-3">
                <label for="text" class="form-label">{{__('messages.departure')}}</label>
                @if($va_force_depart==1)
                    <input name="orig" size="5" type="hidden" class="form-control" placeholder="ZZZZ" maxlength="4" value="{{$personal_data->ubication}}" required>
                    <input size="5" type="text" class="form-control" placeholder="ZZZZ" maxlength="4" value="{{$personal_data->ubication}}" required disabled>
                    @else
                    <input name="orig" size="5" type="text" class="form-control" placeholder="ZZZZ" maxlength="4" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                @endif
            </div>
            <div class="col-md-3">
                <label for="text" class="form-label">{{__('messages.arrival')}}</label>
                <input name="dest" size="5" type="text" class="form-control" placeholder="ZZZZ" maxlength="4" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
            </div>
            @if($va_charter_use==1)
                <div class="col-md-3">
                    <label for="text" class="form-label">{{__('messages.aircraft')}}</label>
                    <select class="form-select" name="type" id="type">
                        @foreach(\App\Models\Fleets::all() as $aircraft)
                            @php
                                $tmp = \App\Models\Aircrafts::find($aircraft->type);
                            @endphp
                            @if($aircraft->boocked==0)
                                @if($va_force_airport==1)
                                    @if($aircraft->location == $personal_data->ubication)
                                        <option value="{{$tmp->icao}}">{{$tmp->icao}} [{{$aircraft->registration}}]</option>
                                    @endif
                                @else
                                    <option value="{{$tmp->icao}}">{{$tmp->icao}} [{{$aircraft->registration}}]</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            @else
            <div class="col-md-3">
                <label for="text" class="form-label">{{__('messages.aircraft')}}</label>
                <input name="type" type="text" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
            </div>
            @endif
            <div class="col-md-3">
                <label for="text" class="form-label">{{__('messages.reserve_fuel')}} KG</label>
                <input type="text" class="form-control" id="addedfuel" name="addedfuel" maxlength="3" aria-describedby="text" required>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">{{__('messages.route')}} ({{__('messages.simbrief_route')}})</label>
                <textarea name="route" class="form-control"></textarea>
            </div>
            <input type="hidden" name="airline" value="{{$va_icao}}">
            @php
                $horasalida = date("H");
                $minutosalida = date("i");
                $minutosalida+=30;
                if($minutosalida/60>1){
                  $minutosalida-=60;
                  $horasalida+=1;
                }
            @endphp
            <input type="hidden" name="deph" value="{{$horasalida}}">
            <input type="hidden" name="depm" value="{{$minutosalida}}">
            <input type="hidden" name="units" value="KGS">
            <input type="hidden" name="contpct" value="auto">
            <input type="hidden" name="navlog" value="1">
            <input type="hidden" name="etops" value="0">
            <input type="hidden" name="stepclimbs" value="0">
            <input type="hidden" name="tlr" value="1">
            <input type="hidden" name="notams" value="1">
            <input type="hidden" name="firnot" value="0">
            <input type="hidden" name="maps" value="detail">
            <input type="hidden" name="cpt" value="{{Auth::user()->name}}">
            <input type="hidden" name="acdata" value="{'extrarmk':'RMK\/TCAS EQUIPPED ORG HICREW TEL OCC XXXXXXXXX'}">

            <div class="col-12">
                <input type="button" class="btn btn-dark" value="{{__('messages.yes_simbrief')}}" onclick="simbriefsubmit('https://crew.thorairlines.com/simbrief/2');"/>

            </div>
        </form>
    </section>


    <section class="content" id="nosimbrief" style="display: none">
        <form class="row g-3" action="{{route('central_report')}}" method="POST">
            @csrf
            <div class="col-md-3">
                <label for="text" class="form-label">{{__('messages.callsign')}}</label>
                <input type="text" class="form-control" id="fltnum" name="fltnum" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
            </div>
            <div class="col-md-3">
                <label for="text" class="form-label">{{__('messages.departure')}}</label>
                @if($va_force_depart==1)
                    <input name="orig" size="5" type="hidden" class="form-control" placeholder="ZZZZ" maxlength="4" value="{{$personal_data->ubication}}" required>
                    <input size="5" type="text" class="form-control" placeholder="ZZZZ" maxlength="4" value="{{$personal_data->ubication}}" required disabled>
                @else
                    <input name="orig" size="5" type="text" class="form-control" placeholder="ZZZZ" maxlength="4" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                @endif
            </div>
            <div class="col-md-3">
                <label for="text" class="form-label">{{__('messages.arrival')}}</label>
                <input name="dest" size="5" type="text" class="form-control" placeholder="ZZZZ" maxlength="4" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
            </div>
            @if($va_charter_use==1)
                <div class="col-md-3">
                    <label for="text" class="form-label">{{__('messages.aircraft')}}</label>
                    <select class="form-select" name="type" id="type">
                        @foreach(\App\Models\Fleets::all() as $aircraft)
                            @php
                                $tmp = \App\Models\Aircrafts::find($aircraft->type);
                            @endphp
                            @if($aircraft->boocked==0)
                                @if($va_force_airport==1)
                                    @if($aircraft->location == $personal_data->ubication)
                                        <option value="{{$tmp->icao}}">{{$tmp->icao}} [{{$aircraft->registration}}]</option>
                                    @endif
                                @else
                                    <option value="{{$tmp->icao}}">{{$tmp->icao}} [{{$aircraft->registration}}]</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            @else
                <div class="col-md-3">
                    <label for="text" class="form-label">{{__('messages.aircraft')}}</label>
                    <input name="type" type="text" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                </div>
            @endif
            <div class="col-md-3">
                <label for="text" class="form-label">{{__('messages.red')}}</label>
                <select class="form-select" name="red" id="red">
                    <option value="0">IVAO</option>
                    <option value="1">VATSIM</option>
                </select>
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-dark">{{__('messages.no_simbrief')}}</button>
            </div>
        </form>
    </section>




    <script>
        function SiFunction() {
            var x = document.getElementById("simbrief");
            var y = document.getElementById("nosimbrief");
            var a = document.getElementById("selector");
            if (x.style.display === "none") {
                x.style.display = "block";
                a.style.display = "none";
                y.style.display = "none";
            } else {
                x.style.display = "none";
            }
        }
        function NoFunction() {
            var x = document.getElementById("simbrief");
            var y = document.getElementById("nosimbrief");
            var a = document.getElementById("selector");
            if (y.style.display === "none") {
                x.style.display = "none";
                a.style.display = "none";
                y.style.display = "block";
            } else {
                y.style.display = "none";
            }
        }

    </script>

@endsection
