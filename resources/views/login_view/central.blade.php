@extends('layouts.global')
@php
    include '../config.php';
@endphp
@section('content')
    @if($personal_data->hub !=NULL )
        @if($flight_active>=1)
            {{__('messages.flight_active')}}
            <br>
            <br>
            <table class="table text-center">
                <thead class="table-dark">
                <tr>
                    <th scope="col">{{ __('messages.callsign') }}</th>
                    <th scope="col">{{ __('messages.departure') }}</th>
                    <th scope="col">{{ __('messages.arrival') }}</th>
                    <th scope="col">{{ __('messages.aircraft') }}</th>
                    <th scope="col">{{ __('messages.red') }}</th>
                    <th scope="col">{{ __('messages.state') }}</th>
                    <th scope="col">{{ __('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{$id_flight_open->callsign}}</td>
                                <td>{{$id_flight_open->departure}}</td>
                                <td>{{$id_flight_open->arrival}}</td>
                                <td>{{$id_flight_open->aircraft}}</td>
                            @if($id_flight_open->red==0)
                                <td>IVAO</td>
                            @else
                                <td>VATSIM</td>
                            @endif

                            @if($id_flight_open->state==0)
                                <td>{{__('messages.state_0')}}</td>
                            @elseif($id_flight_open->state==1)
                                <td>{{__('messages.state_1')}}</td>
                            @endif
                            <td>
                            @if($id_flight_open->simbrief!=NULL)
                                <a href="plan/{{$id_flight_open->simbrief}}" class="btn btn-dark btn-sm">{{ __('messages.show_flight') }}</a>
                                @endif
                                <form method="POST" action="{{ route('central_cancel', ['id' => $id_flight_open->id]) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm cancel?')">{{ __('messages.cancel_flight') }}</button>
                                </form>
                                </td>
                        </tr>


                </tbody>
            </table>
        @else

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @if($va_charter_flights == 1)
            <div class="col">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <a href="{{route('dispatch_charter')}}">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-plane-departure"></i> {{ __('messages.charter_flight') }}</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if($va_regular_flights == 1)
            <div class="col">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <a href="{{route('dispatch_scheduled')}}">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-paper-plane"></i> {{ __('messages.regular_flight') }}</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if($va_manual_report == 1)
            <div class="col">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <a href="" data-bs-toggle="modal" data-bs-target="#ModalReport">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-pen"></i> {{ __('messages.manual_flight') }}</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if($va_dispatch == 1)
            <div class="col">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <a href="" >
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-network-wired"></i> {{ __('messages.dispatcher') }}</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if($va_change_location == 1)
            <div class="col">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <a href="" data-bs-toggle="modal" data-bs-target="#Modal">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-globe"></i> {{ __('messages.change_ubi') }}</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endif

    </div>
    @endif

    @if($va_manual_report == 1)
        <div class="modal fade" id="ModalReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('messages.manual_flight') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('central_manual')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.callsign')}}</label>
                                <input type="text" class="form-control" id="callsign" name="callsign" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.departure')}}</label>
                                <input type="text" class="form-control" id="departure" name="departure" maxlength="4" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.arrival')}}</label>
                                <input type="text" class="form-control" id="arrival" name="arrival" maxlength="4" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.aircraft')}}</label>
                                <input type="text" class="form-control" id="aircraft" name="aircraft" maxlength="4" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.departure_time')}}</label>
                                <input type="datetime-local" class="form-control" id="open" name="open" aria-describedby="text" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.arrival_time')}}</label>
                                <input type="datetime-local" class="form-control" id="close" name="close" aria-describedby="text" required>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.comments_tracker')}}</label>
                                <input type="text" class="form-control" id="comment" name="comment" aria-describedby="text" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-dark">{{__('messages.send')}}</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($va_change_location == 1)
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('messages.change_ubi') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('central_ubication')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.change_ubi')}}</label>
                            <input type="text" class="form-control" id="oaci" name="oaci" maxlength="4" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark">{{__('messages.send')}}</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    @endif
    @else
        {{__('messages.need_hub')}}
        <br>
        <br>
        <form class="row g-3" action="{{route('central_hub')}}" method="POST">
            @csrf
            <div class="col-md-6">
                <label for="text" class="form-label">{{__('messages.hub')}}</label>
                <select class="form-select" aria-label="Default select example" name="hub" id="hub">
                    @foreach(\App\Models\Hubs::all() as $hubs)
                        <option value="{{$hubs->oaci}}">{{$hubs->oaci}} ({{$hubs->name}})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-dark">{{__('messages.send')}}</button>
            </div>
        </form>
    @endif

@endsection
