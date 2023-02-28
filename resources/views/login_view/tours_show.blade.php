@extends('layouts.global')

@section('content')

        @foreach($tours as $tours)
            <p class="h3">{{ $tours->name }}</p>
            {!! $tours->description !!}
            <br>
            <p style="font-size: 13px">{{__('messages.notam_open')}}: {{$tours->date_open}}</p>
            <p style="font-size: 13px">{{__('messages.notam_close')}}: {{$tours->date_close}}</p>
            <table class="table text-center">
                <thead>
                <tr>
                    <th scope="col">{{ __('messages.leg') }}</th>
                    <th scope="col">{{ __('messages.departure') }}</th>
                    <th scope="col">{{ __('messages.arrival') }}</th>
                    <th scope="col">{{ __('messages.description') }}</th>
                    <th scope="col">{{ __('messages.report') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach($parts as $parts)
                    @php($aux=\App\Models\Tours_users::where('id_part',$parts->id)->get())
                    @if($aux != '[]')

                    @else
                        <tr>
                            <td>{{$parts->parts}}</td>
                            <td>{{$parts->departure}}</td>
                            <td>{{$parts->arrival}}</td>
                            <td>{{$parts->description}}</td>
                            <td>
                                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#Modal{{$parts->id}}"><i class="fa-solid fa-paper-plane"></i></button>
                            </td>
                        </tr>
                    @endif
                @endforeach
                @foreach($user_parts as $user_parts)
                    @php($tmp=\App\Models\Tours_parts::where('id_tour',$user_parts->id_tour)->where('id',$user_parts->id_part)->get())
                    @if($user_parts->stats==NULL)
                        <tr class="table-info">
                            <td>{{$tmp[0]->parts}}</td>
                            <td>{{$tmp[0]->departure}}</td>
                            <td>{{$tmp[0]->arrival}}</td>
                            <td>{{$tmp[0]->description}}</td>
                            <td>{{__('messages.pending')}}</td>
                        </tr>
                    @elseif($user_parts->stats==1)
                        <tr class="table-success">
                            <td>{{$tmp[0]->parts}}</td>
                            <td>{{$tmp[0]->departure}}</td>
                            <td>{{$tmp[0]->arrival}}</td>
                            <td>{{$tmp[0]->description}}</td>
                            <td>{{__('messages.accepted')}}</td>
                        </tr>
                    @else
                        <tr class="table-danger">
                            <td>{{$tmp[0]->parts}}</td>
                            <td>{{$tmp[0]->departure}}</td>
                            <td>{{$tmp[0]->arrival}}</td>
                            <td>{{$tmp[0]->description}}</td>
                            <td>{{__('messages.rejected')}} ({{$user_parts->comment_staff}})&nbsp; <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#ModalReferal{{$tmp[0]->id}}"><i class="fa-solid fa-paper-plane"></i></button>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        @endforeach
        @if($tours == "[]")
            {{__("messages.no_tours")}}
        @endif

        @foreach($parts_modal as $parts)
            <div class="modal fade" id="Modal{{$parts->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.leg')}} #{{$parts->parts}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" action="{{route('tours_register', $parts->id)}}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label for="text" class="form-label">{{__('messages.departure_time')}}</label>

                                    <input type="datetime-local" class="form-control" id="departure" name="departure" aria-describedby="text" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="text" class="form-label">{{__('messages.arrival_time')}}</label>
                                    <input type="datetime-local" class="form-control" id="arrival" name="arrival" aria-describedby="text" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="text" class="form-label">{{__('messages.comment')}}</label>
                                    <input type="text" class="form-control" id="comment" name="comment" aria-describedby="text">
                                    <input type="hidden" class="form-control" id="tour" name="tour" aria-describedby="text" value="{{$parts->id_tour}}" required>
                                    <input type="hidden" class="form-control" id="leg" name="leg" aria-describedby="text" value="{{$parts->id}}" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark">{{__('messages.send')}}</button>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
            </div>


            <div class="modal fade" id="ModalReferal{{$parts->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.leg')}} #{{$parts->parts}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @php($aux2=\App\Models\Tours_users::where('id_part',$parts->id)->get())
                            @foreach($aux2 as $aux2)
                            <form class="row g-3" action="{{route('tours_edit_user', $aux2->id)}}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label for="text" class="form-label">{{__('messages.departure_time')}}</label>

                                    <input type="datetime-local" class="form-control" id="departure" name="departure" aria-describedby="text" value="{{$aux2->dep_time}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="text" class="form-label">{{__('messages.arrival_time')}}</label>
                                    <input type="datetime-local" class="form-control" id="arrival" name="arrival" aria-describedby="text" value="{{$aux2->arr_time}}" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="text" class="form-label">{{__('messages.comment')}}</label>
                                    <input type="text" class="form-control" id="comment" name="comment" aria-describedby="text" value="{{$aux2->comment_user}}">
                                    <input type="hidden" class="form-control" id="tour" name="tour" aria-describedby="text" value="{{$parts->id_tour}}" required>
                                    <input type="hidden" class="form-control" id="leg" name="leg" aria-describedby="text" value="{{$parts->id}}" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark">{{__('messages.send')}}</button>
                                </div>
                            </form>
                            @endforeach


                        </div>

                    </div>
                </div>
            </div>
        @endforeach

@endsection
