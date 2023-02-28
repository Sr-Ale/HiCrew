@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.members') }}</p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.name')}}</th>
            <th scope="col">{{__('messages.callsign')}}</th>
            <th scope="col">{{__('messages.ivao')}}</th>
            <th scope="col">{{__('messages.vatsim')}}</th>
            <th scope="col">{{__('messages.email')}}</th>
            <th scope="col">{{__('messages.date')}}</th>
            <th scope="col">{{__('messages.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $members)
            <tr>
                <td>{{$members->id}}</td>
                <td>{{$members->name}}</td>
                <td>{{$members->callsign}}</td>
                <td>{{$members->ivao}}</td>
                <td>{{$members->vatsim}}</td>
                <td>{{$members->email}}</td>
                <td>{{$members->birthday}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal-{{$members->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('members_delete', ['id' => $members->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    @foreach(\App\Models\User::all() as $user)
        <div class="modal fade" id="Modal-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$user->name}} #{{$user->id}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('members_edit',$user->id)}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"value="{{$user->name}}" aria-describedby="text" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.callsign')}}</label>
                                <input type="text" class="form-control" id="callsign" name="callsign" value="{{$user->callsign}}" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.ivao')}}</label>
                                <input type="number" class="form-control" id="ivao" name="ivao" value="{{$user->ivao}}" aria-describedby="text">
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.vatsim')}}</label>
                                <input type="number" class="form-control" id="vatsim" name="vatsim" value="{{$user->vatsim}}" aria-describedby="text">
                            </div>
                            <div class="col-md-12">
                                <label for="text" class="form-label">{{__('messages.email')}}</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" aria-describedby="text">
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
@endsection
