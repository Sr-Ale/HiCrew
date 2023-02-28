@extends('layouts.global')

@section('content')
    <p class="h3">{{ $academy[0]->name }}</p>
    <div class="container">
        <div class="row">
            @foreach($courses as $courses)
            <div class="col-6">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4 bg-dark">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$courses->name}}</h5>
                                <br>
                                @php
                                    $aux = \App\Models\Courses_users::where('id_parts',$courses->id)->where('id_user',Auth::user()->id)->get();
                                @endphp
                                @if($aux !='[]')
                                    ({{__("messages.complete")}})
                                @endif
                                <a class="btn btn-dark btn-sm" href="{{route("course_view",[$academy[0]->id,$courses->parts])}}">{{__('messages.enter')}}</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
            @if($courses == '[]')
                <p>{{__('messages.no_courses')}}.</p>
            @endif
        </div>
    </div>



@endsection
