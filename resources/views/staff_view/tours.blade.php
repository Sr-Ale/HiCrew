@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.tours') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modal">{{__('messages.add')}} {{__('messages.tours')}}</button></p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{ __('messages.only_name') }}</th>
            <th scope="col">{{ __('messages.description') }}</th>
            <th scope="col">{{ __('messages.leg') }}</th>
            <th scope="col">{{ __('messages.notam_open') }}</th>
            <th scope="col">{{ __('messages.notam_close') }}</th>
            <th scope="col">{{__('messages.actions')}}</th>

        </tr>
        </thead>
        <tbody>
        @foreach($tours as $tours)
            <tr>
                <td>{{$tours->id}}</td>
                <td>{{$tours->name}}</td>
                <td>{{$tours->description}}</td>
                <td>{{$tours->parts}}</td>
                <td>{{$tours->date_open}}</td>
                <td>{{$tours->date_close}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ModalTour-{{$tours->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#Modal-{{$tours->id}}"><i class="fa-solid fa-door-open"></i></button>
                    <form method="POST" action="{{ route('tours_delete', ['id' => $tours->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>


    @foreach($tours_modals as $tour)
        <div class="modal fade" id="Modal-{{$tour->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$tour->name}}
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modaledit-{{$tour->id}}">{{__('messages.add')}}
                                {{__('messages.leg')}}</button></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{ __('messages.parts') }}</th>
                                <th scope="col">{{ __('messages.description') }}</th>
                                <th scope="col">{{ __('messages.departure') }}</th>
                                <th scope="col">{{ __('messages.arrival') }}</th>
                                <th scope="col">{{__('messages.actions')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Tours_parts::where('id_tour',$tour->id)->get() as $tmp)
                                <tr>
                                    <td>{{$tmp->id}}</td>
                                    <td>{{$tmp->parts}}</td>
                                    <td>{{$tmp->description}}</td>
                                    <td>{{$tmp->departure}}</td>
                                    <td>{{$tmp->arrival}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ModalLeg-{{$tmp->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <form method="POST" action="{{ route('leg_delete', ['id' => $tmp->id]) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach(\App\Models\Tours::all() as $tour)
        <div class="modal fade" id="Modaledit-{{$tour->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.leg')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('leg_create')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.departure')}}</label>
                                <input type="text" class="form-control" id="departure" name="departure" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                <input type="hidden" class="form-control" id="id_tour" name="id_tour" value="{{$tour->id}}" aria-describedby="text" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.arrival')}}</label>
                                <input type="text" class="form-control" id="arrival" name="arrival" aria-describedby="text" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.description')}}</label>
                                <input type="text" class="form-control" id="description" name="description" aria-describedby="text" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.leg')}}</label>
                                <input type="number" class="form-control" id="leg" name="leg" aria-describedby="text" required>
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

    @foreach(\App\Models\Tours_parts::all() as $tours)
        <div class="modal fade" id="ModalLeg-{{$tours->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.parts')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('leg_edit',$tours->id)}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.departure')}}</label>
                                <input type="text" class="form-control" id="departure" name="departure" aria-describedby="text" value="{{$tours->departure}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.arrival')}}</label>
                                <input type="text" class="form-control" id="arrival" name="arrival" aria-describedby="text" value="{{$tours->arrival}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.description')}}</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{$tours->description}}" aria-describedby="text" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.leg')}}</label>
                                <input type="number" class="form-control" id="leg" name="leg" aria-describedby="text" value="{{$tours->parts}}" required>
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

    @foreach(\App\Models\Tours::all() as $tour)
        <div class="modal fade" id="ModalTour-{{$tour->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$tour->name}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('tours_edit',$tour->id)}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="text" value="{{$tour->name}}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.leg')}}</label>
                                <input type="number" class="form-control" id="leg" name="leg" aria-describedby="text" value="{{$tour->parts}}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.notam_open')}}</label>
                                <input type="datetime-local" class="form-control" id="open" name="open" aria-describedby="text" value="{{$tour->date_open}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.notam_close')}}</label>
                                <input type="datetime-local" class="form-control" id="close" name="close" aria-describedby="text" value="{{$tour->date_close}}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.description')}}</label>
                                <input type="text" class="form-control" id="description" name="description" aria-describedby="text" value="{{$tour->description}}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.url')}}</label>
                                <input type="text" class="form-control" id="url" name="url" aria-describedby="text" value="{{$tour->url}}" required>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.tours')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('tours_create')}}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>

                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.leg')}}</label>
                            <input type="number" class="form-control" id="leg" name="leg" aria-describedby="text" required>
                        </div>

                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.notam_open')}}</label>
                            <input type="datetime-local" class="form-control" id="open" name="open" aria-describedby="text"  required>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.notam_close')}}</label>
                            <input type="datetime-local" class="form-control" id="close" name="close" aria-describedby="text" required>
                        </div>

                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.description')}}</label>
                            <input type="text" class="form-control" id="description" name="description" aria-describedby="text" required>
                        </div>

                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.url')}}</label>
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
