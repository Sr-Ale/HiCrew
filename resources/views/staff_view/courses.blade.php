@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.academy') }} <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modal">{{__('messages.add')}} {{__('messages.courses')}}</button></p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{ __('messages.only_name') }}</th>
            <th scope="col">{{ __('messages.parts') }}</th>
            <th scope="col">{{__('messages.actions')}}</th>

        </tr>
        </thead>
        <tbody>
        @foreach($courses as $courses)
            <tr>
                <td>{{$courses->id}}</td>
                <td>{{$courses->name}}</td>
                <td>{{$courses->parts}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ModalAcademy-{{$courses->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#Modal-{{$courses->id}}"><i class="fa-solid fa-door-open"></i></button>
                    <form method="POST" action="{{ route('academy_delete', ['id' => $courses->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <p class="h3">{{ __('messages.students') }}</p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{ __('messages.courses') }}</th>
            <th scope="col">{{ __('messages.parts') }}</th>
            <th scope="col">{{__('messages.callsign')}}</th>

        </tr>
        </thead>
        <tbody>
        @foreach($students as $students)
            <tr>
                <td>{{$students->id}}</td>
                @php($aux = \App\Models\Courses::where('id',$students->id_courses)->get())
                <td>{{$aux[0]->name}}</td>
                @php($aux = \App\Models\Parts_courses::where('id',$students->id_parts)->get())
                <td>{{$aux[0]->name}}</td>
                @php($aux = \App\Models\User::where('id',Auth::user()->id)->get())
                <td>{{$aux[0]->callsign}} ({{$aux[0]->name}})</td>
            </tr>
        @endforeach

        </tbody>
    </table>


    @foreach($courses_modals as $courses)
        <div class="modal fade" id="Modal-{{$courses->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$courses->name}}
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modaledit-{{$courses->id}}">{{__('messages.add')}}
                                {{__('messages.parts')}}</button></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{ __('messages.only_name') }}</th>
                                <th scope="col">{{ __('messages.parts') }}</th>
                                <th scope="col">{{__('messages.actions')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Parts_courses::where('id_courses',$courses->id)->get() as $tmp)
                                <tr>
                                    <td>{{$tmp->id}}</td>
                                    <td>{{$tmp->name}}</td>
                                    <td>{{$tmp->parts}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ModalCourse-{{$tmp->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <form method="POST" action="{{ route('courses_delete', ['id' => $tmp->id]) }}" style="display: inline;">
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

    @foreach(\App\Models\Courses::all() as $courses)
        <div class="modal fade" id="Modaledit-{{$courses->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.parts')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('courses_create')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                                <input type="hidden" class="form-control" id="id_course" name="id_course" value="{{$courses->id}}" aria-describedby="text" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.parts')}}</label>
                                <input type="number" class="form-control" id="parts" name="parts" aria-describedby="text" required>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">({{__('messages.accept_html')}})</label>
                                <textarea class="form-control" id="html" name="html"  rows="6"></textarea>
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

    @foreach(\App\Models\Parts_courses::all() as $courses)
        <div class="modal fade" id="ModalCourse-{{$courses->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.parts')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('courses_edit',$courses->id)}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$courses->name}}" aria-describedby="text" required>
                              </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.parts')}}</label>
                                <input type="number" class="form-control" id="parts" name="parts" value="{{$courses->parts}}" aria-describedby="text" required>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">({{__('messages.accept_html')}})</label>
                                <textarea class="form-control" id="html" name="html"  rows="6">{{$courses->html}}</textarea>
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

    @foreach(\App\Models\Courses::all() as $academy)
        <div class="modal fade" id="ModalAcademy-{{$academy->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$academy->name}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('academy_edit',$academy->id)}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="text" value="{{$academy->name}}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="text" class="form-label">{{__('messages.parts')}}</label>
                                <input type="number" class="form-control" id="parts" name="parts" value="{{$academy->parts}}" aria-describedby="text" required>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}} {{__('messages.courses')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('academy_create')}}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>

                        <div class="col-md-6">
                            <label for="text" class="form-label">{{__('messages.parts')}}</label>
                            <input type="number" class="form-control" id="parts" name="parts" aria-describedby="text" required>
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
