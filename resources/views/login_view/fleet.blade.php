@extends('layouts.global')

@section('content')
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($aircrafts as $aircrafts)
        <div class="col">
            <div class="card bg-dark text-white">
                <a href="#" data-bs-toggle="modal" data-bs-target="#Modal{{$aircrafts->id}}">
                    <img src="{{ $aircrafts->img_url }}" class="card-img" alt="{{ $aircrafts->icao }}">
                    <div class="card-img-overlay">
                        <h5 class="card-title">{{$aircrafts->name}}</h5>
                        <p class="card-text">{{ $aircrafts->icao }}</p>
                    </div>
                </a>
            </div>
        </div>

            @php
                $fleet = \App\Models\Fleets::where('type',$aircrafts->id)->get();
            @endphp
            <div class="modal fade" id="Modal{{$aircrafts->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{$aircrafts->icao}} | {{$aircrafts->name}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('messages.registration') }}</th>
                                            <th scope="col">{{ __('messages.only_name') }}</th>
                                            <th scope="col">{{ __('messages.location') }}</th>
                                            <th scope="col">{{ __('messages.hub') }}</th>
                                            <th scope="col">{{ __('messages.boocked') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fleet as $fleet)
                                        <tr>
                                            <td>{{$fleet->registration}}</td>
                                            <td>{{$fleet->name}}</td>
                                            <td>{{$fleet->location}}</td>
                                            @php($hubs = \App\Models\Hubs::where('id',$fleet->hub)->get())
                                            <td>{{$hubs[0]->oaci}}</td>
                                            @if($fleet->boocked)
                                                <td><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></button></td>
                                            @else
                                                <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                                            @endif
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
    </div>

@endsection
