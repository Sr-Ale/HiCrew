@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.permission') }}  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modal">{{__('messages.add')}} {{__('messages.permission')}}</button></p>
    <table class="table" style="text-align:center;">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.name')}}</th>
            <th scope="col">{{__('messages.staff')}}</th>
            <th scope="col">{{__('messages.valid')}}</th>
            <th scope="col">{{__('messages.operations')}}</th>
            <th scope="col">{{__('messages.academy')}}</th>
            <th scope="col">{{__('messages.events')}}</th>
            <th scope="col">{{__('messages.members')}}</th>
            <th scope="col">{{__('messages.admin')}}</th>
            <th scope="col">{{__('messages.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permission as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                @php($aux = \App\Models\User::where('id',$permission->id)->get())
                <td>{{$aux[0]->name}}</td>
                @if($permission->staff)
                    <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                @else
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                @endif
                @if($permission->valid)
                    <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                @else
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                @endif
                @if($permission->operations)
                    <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                @else
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                @endif
                @if($permission->academy)
                    <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                @else
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                @endif
                @if($permission->events)
                    <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                @else
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                @endif
                @if($permission->members)
                    <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                @else
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                @endif
                @if($permission->admin)
                    <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                @else
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                @endif
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal-{{$permission->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('permission_delete', ['id' => $permission->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>



    @foreach(\App\Models\Permission::all() as $permission)
        <div class="modal fade" id="Modal-{{$permission->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.permission')}} #{{$permission->id}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('permission_edit',$permission->id)}}" method="POST">
                            @csrf

                            <div class="col-mb-6 form-check">
                                <input type="checkbox" class="form-check-input" id="staff" name="staff" value="1" @if($permission->staff) checked @endif>
                                <label class="form-check-label" for="exampleCheck1">{{__('messages.staff')}}</label>
                            </div>
                            <div class="col-mb-6 form-check">
                                <input type="checkbox" class="form-check-input" id="valid" name="valid" value="1" @if($permission->valid) checked @endif>
                                <label class="form-check-label" for="exampleCheck1">{{__('messages.valid')}}</label>
                            </div>
                            <div class="col-mb-6 form-check">
                                <input type="checkbox" class="form-check-input" id="operations" name="operations" value="1" @if($permission->operations) checked @endif>
                                <label class="form-check-label" for="exampleCheck1">{{__('messages.operations')}}</label>
                            </div>
                            <div class="col-mb-6 form-check">
                                <input type="checkbox" class="form-check-input" id="academy" name="academy" value="1" @if($permission->academy) checked @endif>
                                <label class="form-check-label" for="exampleCheck1">{{__('messages.academy')}}</label>
                            </div>
                            <div class="col-mb-6 form-check">
                                <input type="checkbox" class="form-check-input" id="events" name="events" value="1" @if($permission->events) checked @endif>
                                <label class="form-check-label" for="exampleCheck1">{{__('messages.events')}}</label>
                            </div>
                            <div class="col-mb-6 form-check">
                                <input type="checkbox" class="form-check-input" id="members" name="members" value="1" @if($permission->members) checked @endif>
                                <label class="form-check-label" for="exampleCheck1">{{__('messages.members')}}</label>
                            </div>
                            <div class="col-mb-6 form-check">
                                <input type="checkbox" class="form-check-input" id="admin" name="admin" value="1" @if($permission->admin) checked @endif>
                                <label class="form-check-label" for="exampleCheck1">{{__('messages.admin')}}</label>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.permission')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('permission_create')}}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.staff')}}</label>
                            <select class="form-select" aria-label="Default select example" name="user" id="user">
                                <option selected>{{__('messages.open_menu')}}</option>
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-mb-6 form-check">
                            <input type="checkbox" class="form-check-input" id="staff" name="staff" value="1">
                            <label class="form-check-label" for="exampleCheck1">{{__('messages.staff')}}</label>
                        </div>
                        <div class="col-mb-6 form-check">
                            <input type="checkbox" class="form-check-input" id="valid" name="valid" value="1">
                            <label class="form-check-label" for="exampleCheck1">{{__('messages.valid')}}</label>
                        </div>
                        <div class="col-mb-6 form-check">
                            <input type="checkbox" class="form-check-input" id="operations" name="operations" value="1">
                            <label class="form-check-label" for="exampleCheck1">{{__('messages.operations')}}</label>
                        </div>
                        <div class="col-mb-6 form-check">
                            <input type="checkbox" class="form-check-input" id="academy" name="academy" value="1">
                            <label class="form-check-label" for="exampleCheck1">{{__('messages.academy')}}</label>
                        </div>
                        <div class="col-mb-6 form-check">
                            <input type="checkbox" class="form-check-input" id="events" name="events" value="1">
                            <label class="form-check-label" for="exampleCheck1">{{__('messages.events')}}</label>
                        </div>
                        <div class="col-mb-6 form-check">
                            <input type="checkbox" class="form-check-input" id="members" name="members" value="1">
                            <label class="form-check-label" for="exampleCheck1">{{__('messages.members')}}</label>
                        </div>
                        <div class="col-mb-6 form-check">
                            <input type="checkbox" class="form-check-input" id="admin" name="admin" value="1">
                            <label class="form-check-label" for="exampleCheck1">{{__('messages.admin')}}</label>
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
