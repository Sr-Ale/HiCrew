@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.hub') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modal">{{__('messages.add')}} {{__('messages.hub')}}</button></p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.oaci')}}</th>
            <th scope="col">{{__('messages.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hubs as $hubs)
            <tr>
                <td>{{$hubs->id}}</td>
                <td>{{$hubs->name}}</td>
                <td>{{$hubs->oaci}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal-{{$hubs->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('hubs_delete', ['id' => $hubs->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    @foreach($hubs_modals as $hubs)
        <div class="modal fade" id="Modal-{{$hubs->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.hub')}} #{{$hubs->id}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('hubs_edit', $hubs->id)}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.oaci')}}</label>
                                <input type="text-local" class="form-control" id="oaci" name="oaci" maxlength="4" value="{{$hubs->oaci}}" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$hubs->name}}" aria-describedby="text" required>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.url')}} ({{__('messages.optional')}})</label>
                                <input type="text" class="form-control" id="url" name="url" value="{{$hubs->img_url}}" aria-describedby="text">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.hub')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('hubs_create')}}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.oaci')}}</label>
                            <input type="text-local" class="form-control" id="oaci" name="oaci" maxlength="4" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.url')}} ({{__('messages.optional')}})</label>
                            <input type="text" class="form-control" id="url" name="url" aria-describedby="text">
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
