@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.courses') }}</p>
    <div class="container">
        <div class="row">
            @foreach($courses as $courses)
            <div class="col-6">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4 bg-dark">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$courses->name}}</h5>
                                <br>
                                @php
                                    $aux = \App\Models\Courses_users::where('id_courses',$courses->id)->where('id_user',Auth::user()->id)->get();
                                @endphp
                                @if($aux == '[]')
                                    <div class="progress">
                                        <div class="progress-bar bg-dark" role="progressbar" aria-label="Example with label" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                @else
                                    @php
                                        $tmp=count($aux);
                                        $tmp=($tmp/$courses->parts)*100;
                                        $tmp=round($tmp, 2);
                                    @endphp
                                    <div class="progress">
                                        <div class="progress-bar bg-dark" role="progressbar" aria-label="Example with label" style="width: {{$tmp}}%;" aria-valuenow="{{$tmp}}" aria-valuemin="0" aria-valuemax="100">
                                            {{$tmp}}%</div>
                                    </div>
                                @endif
                                <br>
                                <a class="btn btn-dark btn-sm" href="{{route("course",$courses->id)}}">{{__('messages.enter')}}</a>
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
