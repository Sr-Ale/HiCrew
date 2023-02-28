@extends('layouts.global')

@section('content')
    <p class="h3" id="liveries">
        <i class="fa-solid fa-brush"></i> {{ __('messages.liveries') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modals1">{{__('messages.add')}}</button>
    </p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.simulator')}}</th>
            <th scope="col">{{__('messages.last_modification')}}</th>
            <th scope="col">{{__('messages.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($liveries as $liveries)
            <tr>
                <td>{{$liveries->id}}</td>
                <td>{{$liveries->name}}</td>
                <td>{{$liveries->simulator}}</td>
                <td>{{$liveries->updated_at}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal{{$liveries->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('resources_delete', ['id' => $liveries->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if($liveries=='[]')
            <tr>
                <td colspan="4">{{__('messages.not_upload')}}</td>
            </tr>
        @endif
        </tbody>
    </table>
    <p class="h3" id="documents">
        <i class="fa-solid fa-file"></i> {{ __('messages.documents') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modals2">{{__('messages.add')}}</button>
    </p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.last_modification')}}</th>
            <th scope="col">{{__('messages.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($documents as $documents)
            <tr>

                <td>{{$documents->id}}</td>
                <td>{{$documents->name}}</td>
                <td>{{$documents->updated_at}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal{{$documents->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('resources_delete', ['id' => $documents->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if($documents=='[]')
            <tr>
                <td colspan="3">{{__('messages.not_upload')}}</td>
            </tr>
        @endif
        </tbody>
    </table>
    <p class="h3" id="checklist">
        <i class="fa-solid fa-clipboard-list"></i> {{ __('messages.checklist') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modals3">{{__('messages.add')}}</button>
    </p>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.last_modification')}}</th>
            <th scope="col">{{__('messages.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($checklist as $checklist)
            <tr>
                <td>{{$checklist->id}}</td>
                <td>{{$checklist->name}}</td>
                <td>{{$checklist->updated_at}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal{{$checklist->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <form method="POST" action="{{ route('resources_delete', ['id' => $checklist->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if($checklist=='[]')
            <tr>
                <td colspan="3">{{__('messages.not_upload')}}</td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
    </div>
    @foreach($resources_modals as $resources_modals)
        <div class="modal fade" id="Modal{{$resources_modals->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">#{{$resources_modals->id}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('resources_edit', $resources_modals->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="text" value="{{$resources_modals->name}}"  required>
                            </div>
                            @if($resources_modals->type==0)
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.simulator')}}</label>
                                <input type="text" class="form-control" id="simulator" name="simulator" aria-describedby="text" value="{{$resources_modals->simulator}}" required>
                            </div>
                            @else
                                <input type="text" class="hidden" id="simulator" name="simulator" aria-describedby="text" value="{{$resources_modals->simulator}}" required>
                            @endif
                            <div class="mb-3">
                                <label for="text" class="form-label">{{__('messages.url')}}</label>
                                <input type="text" class="form-control" id="url" name="url" aria-describedby="text"  value="{{$resources_modals->url}}" required>
                                <input type="text" class="hidden" id="type" name="type" aria-describedby="text"  value="{{$resources_modals->type}}" required>
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
    @endforeach


    <div class="modal fade" id="Modals1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.liveries')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('resources_create')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.simulator')}}</label>
                            <input type="text" class="form-control" id="simulator" name="simulator" aria-describedby="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.url')}}</label>
                            <input type="text" class="form-control" id="url" name="url" aria-describedby="text" required>
                            <input type="text" class="hidden" id="type" name="type" value="0" aria-describedby="text" required>
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

    <div class="modal fade" id="Modals2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.documents')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('resources_create')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.url')}}</label>
                            <input type="text" class="form-control" id="url" name="url" aria-describedby="text" required>
                            <input type="text" class="hidden" id="type" name="type" value="1" aria-describedby="text" required>
                            <input type="text" class="hidden" id="simulator" name="simulator"  value="0" aria-describedby="text" required>
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

    <div class="modal fade" id="Modals3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.checklist')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('resources_create')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">{{__('messages.url')}}</label>
                            <input type="text" class="form-control" id="url" name="url" aria-describedby="text" required>
                            <input type="text" class="hidden" id="type" name="type" value="2" aria-describedby="text" required>
                            <input type="text" class="hidden" id="simulator" name="simulator"  value="0" aria-describedby="text" required>
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
