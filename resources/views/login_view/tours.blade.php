@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.tours') }}</p>
    <div class="row row-cols-1 row-cols-md-3 g-3">
        @foreach($tours as $tours)
            <div class="col">
            <div class="card bg-dark text-white">
                <a href="{{route('tours_select',$tours->id)}}">
                <img src="{{$tours->url}}" class="card-img" alt="">
                <div class="card-img-overlay">
                    <h5 class="card-title">{{$tours->name}}</h5>
                </div>
                </a>
            </div>
            </div>
        @endforeach
        @if($tours == "[]")
            <br>
            {{__("messages.no_tours")}}
        @endif
    </div>

@endsection
