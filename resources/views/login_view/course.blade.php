@extends('layouts.global')

@section('content')
    <p class="h3">{{$courses[0]->name}}</p>
    {!! $courses[0]->html !!}
    @php($tmp = \App\Models\Courses_users::where('id_parts',$courses[0]->id)->where('id_user',Auth::user()->id)->get())
    @if($tmp == '[]')
        <form class="row g-3" action="{{route('course_create')}}" method="POST">
            @csrf
                <input type="text" class="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}" aria-describedby="text" required>
                <input type="text" class="hidden" id="part" name="part"  value="{{$courses[0]->id}}" aria-describedby="text" required>
            <input type="text" class="hidden" id="id" name="id"  value="{{$courses[0]->id_courses}}" aria-describedby="text" required>
            <div class="col-12">
                <button type="submit" class="btn btn-dark">{{__('messages.complete')}}</button>
            </div>
        </form>
    @else
        <br>
        ({{__("messages.complete")}})
    @endif

@endsection
