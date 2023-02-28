@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.aircraft') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modal">{{__('messages.add')}} {{__('messages.aircraft')}}</button></p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.icao')}}</th>
            <th scope="col">{{__('messages.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($aircraft as $aircraft)
            <tr>
                <td>{{$aircraft->id}}</td>
                <td>{{$aircraft->name}}</td>
                <td>{{$aircraft->icao}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal-{{$aircraft->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('aircraft_delete', ['id' => $aircraft->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    @foreach($aircraft_modals as $aircraft)
        <div class="modal fade" id="Modal-{{$aircraft->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.aircraft')}} #{{$aircraft->id}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('aircraft_edit', $aircraft->id)}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.icao')}}</label>
                                <input type="text-local" class="form-control" id="icao" name="icao" maxlength="4" value="{{$aircraft->icao}}" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$aircraft->name}}" aria-describedby="text" required>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.url')}}</label>
                                <input type="text" class="form-control" id="url" name="url" value="{{$aircraft->img_url}}" aria-describedby="text" required>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.aircraft')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('aircraft_create')}}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.icao')}}</label>
                            <input type="text-local" class="form-control" id="icao" name="icao" maxlength="4" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.url')}} </label>
                            <input type="text" class="form-control" id="url" name="url" aria-describedby="text" required>
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
@endsection
