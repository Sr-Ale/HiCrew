@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.notams') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modal">{{__('messages.add_notam')}}</button></p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.description')}}</th>
            <th scope="col">{{__('messages.notam_open')}}</th>
            <th scope="col">{{__('messages.notam_close')}}</th>
            <th scope="col">{{__('messages.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notams as $notams)
            <tr>
                <td>{{$notams->id}}</td>
                <td>{{$notams->name}}</td>
                <td>{{$notams->description}}</td>
                <td>{{$notams->date_open}}</td>
                <td>{{$notams->date_close}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal{{$notams->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('notams_delete', ['id' => $notams->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    @foreach($notams_modals as $notams)
        <div class="modal fade" id="Modal{{$notams->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.notam')}} #{{$notams->id}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('notams_edit', $notams->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="text" value="{{$notams->name}}"  required>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.description')}}</label>
                                <input type="text" class="form-control" id="desc" name="desc" aria-describedby="text" value="{{$notams->description}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.notam_open')}}</label>
                                <input type="datetime-local" class="form-control" id="open" name="open" aria-describedby="text" value="{{$notams->date_open}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.notam_close')}}</label>
                                <input type="datetime-local" class="form-control" id="close" name="close" aria-describedby="text" value="{{$notams->date_close}}" required>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add_notam')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('notams_create')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.description')}}</label>
                            <input type="text" class="form-control" id="desc" name="desc" aria-describedby="text" required>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.notam_open')}}</label>
                            <input type="datetime-local" class="form-control" id="open" name="open" aria-describedby="text" required>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.notam_close')}}</label>
                            <input type="datetime-local" class="form-control" id="close" name="close" aria-describedby="text" required>
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
