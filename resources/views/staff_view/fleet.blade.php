@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.fleet') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modal">{{__('messages.add')}} {{__('messages.fleet')}}</button></p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{ __('messages.aircraft') }}</th>
            <th scope="col">{{ __('messages.registration') }}</th>
            <th scope="col">{{ __('messages.only_name') }}</th>
            <th scope="col">{{ __('messages.location') }}</th>
            <th scope="col">{{ __('messages.hub') }}</th>
            <th scope="col">{{ __('messages.boocked') }}</th>
            <th scope="col">{{__('messages.actions')}}</th>

        </tr>
        </thead>
        <tbody>
        @foreach($fleet as $fleet)
            <tr>
                <td>{{$fleet->id}}</td>
                @php($aircrafts = \App\Models\Aircrafts::where('id',$fleet->type)->get())
                <td>{{$aircrafts[0]->icao}}</td>
                <td>{{$fleet->registration}}</td>
                <td>{{$fleet->name}}</td>
                <td>{{$fleet->location}}</td>
                @php($hubs = \App\Models\Hubs::where('id',$fleet->hub)->get())
                <td>{{$hubs[0]->oaci}}</td>
                @if($fleet->boocked)
                    <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                @else
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                @endif
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal-{{$fleet->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('fleet_delete', ['id' => $fleet->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    @foreach($fleet_modals as $fleet)
        <div class="modal fade" id="Modal-{{$fleet->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.fleet')}} #{{$fleet->id}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('fleet_edit', $fleet->id)}}" method="POST">
                            @csrf

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.aircraft')}}</label>
                                <select class="form-select" aria-label="Default select example" name="aircraft" id="aircraft">
                                    @php($tmp = \App\Models\Aircrafts::where('id',$fleet->type)->get())
                                    <option value="{{$fleet->type}}">{{$tmp[0]->icao}}</option>
                                    @foreach(\App\Models\Aircrafts::all() as $aircraft)
                                        <option value="{{$aircraft->id}}">{{$aircraft->icao}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.hub')}}</label>
                                <select class="form-select" aria-label="Default select example" name="hub" id="hub">
                                    @php($aux = \App\Models\Hubs::where('id',$fleet->hub)->get())
                                    <option value="{{$fleet->hub}}">{{$aux[0]->oaci}}</option>
                                    @foreach(\App\Models\Hubs::all() as $hubs)
                                        <option value="{{$hubs->id}}">{{$hubs->oaci}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="text" value="{{$fleet->name}}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.registration')}}</label>
                                <input type="text" class="form-control" id="registration" name="registration" aria-describedby="text" value="{{$fleet->registration}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.location')}}</label>
                                <input type="text" class="form-control" id="location" name="location" aria-describedby="text" value="{{$fleet->location}}"required>
                            </div>

                            <div class="col-md-6 form-check">
                                <input type="checkbox" class="form-check-input" id="boocked" name="boocked" value="1">
                                <label class="form-check-label" for="exampleCheck1">{{__('messages.boocked')}}</label>
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-dark">{{__('messages.send')}}</button>
                            </div>
                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.fleet')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('fleet_create')}}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.aircraft')}}</label>
                            <select class="form-select" aria-label="Default select example" name="aircraft" id="aircraft">
                                <option selected>{{__('messages.open_menu')}}</option>
                                @foreach(\App\Models\Aircrafts::all() as $aircraft)
                                    <option value="{{$aircraft->id}}">{{$aircraft->icao}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.hub')}}</label>
                            <select class="form-select" aria-label="Default select example" name="hub" id="hub">
                                <option selected>{{__('messages.open_menu')}}</option>
                                @foreach(\App\Models\Hubs::all() as $hubs)
                                <option value="{{$hubs->id}}">{{$hubs->oaci}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>

                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.registration')}}</label>
                            <input type="text" class="form-control" id="registration" name="registration" aria-describedby="text" required>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.location')}}</label>
                            <input type="text" class="form-control" id="location" name="location" aria-describedby="text" required>
                        </div>

                        <div class="col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="boocked" name="boocked" value="1">
                            <label class="form-check-label" for="exampleCheck1">{{__('messages.boocked')}}</label>
                        </div>

                        <div class="col-12">
                        <button type="submit" class="btn btn-primary">{{__('messages.send')}}</button>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
