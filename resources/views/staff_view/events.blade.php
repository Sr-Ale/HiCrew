@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.events') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modal">{{__('messages.add_event')}}</button></p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.description')}}</th>
            <th scope="col">{{__('messages.points')}}</th>
            <th scope="col">{{__('messages.state')}}</th>
            <th scope="col">{{__('messages.event_day')}}</th>
            <th scope="col">{{__('messages.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $events)
            <tr>
                <td>{{$events->id}}</td>
                <td>{{$events->name}}</td>
                <td>{{$events->description}}</td>
                <td>{{$events->points}}</td>
                @if($events->active)
                    <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                @else
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                @endif
                <td>{{$events->day_event}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal{{$events->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('events_delete', ['id' => $events->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    @foreach($events_modals as $events_modals)
        <div class="modal fade" id="Modal{{$events_modals->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.notam')}} #{{$events_modals->id}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('events_edit',$events_modals->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="text" value="{{$events_modals->name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.description')}}</label>
                                <input type="text" class="form-control" id="desc" name="desc" aria-describedby="text" value="{{$events_modals->description}}" required>
                            </div>
                            <div class="md-3">
                                <label for="text" class="form-label">{{__('messages.url')}}</label>
                                <input type="text" class="form-control" id="link" name="link" aria-describedby="text" value="{{$events_modals->url}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.points')}}</label>
                                <input type="text" class="form-control" id="points" name="points" aria-describedby="text" value="{{$events_modals->points}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.event_day')}}</label>
                                <input type="datetime-local" class="form-control" id="day" name="day" aria-describedby="text" value="{{$events_modals->	day_event}}" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="state" name="state" value="1">
                                <label class="form-check-label" for="exampleCheck1">{{__('messages.state')}}</label>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add_event')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('events_create')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.description')}}</label>
                            <input type="text" class="form-control" id="desc" name="desc" aria-describedby="text" required>
                        </div>
                        <div class="md-3">
                            <label for="text" class="form-label">{{__('messages.url')}}</label>
                            <input type="text" class="form-control" id="link" name="link" aria-describedby="text" required>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.points')}}</label>
                            <input type="text" class="form-control" id="points" name="points" aria-describedby="text" required>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.event_day')}}</label>
                            <input type="datetime-local" class="form-control" id="day" name="day" aria-describedby="text" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="state" name="state" value="1">
                            <label class="form-check-label" for="exampleCheck1">{{__('messages.state')}}</label>
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
