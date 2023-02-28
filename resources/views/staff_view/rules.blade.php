@extends('layouts.global')

@section('content')
    <form class="row g-3" action="{{route('rules_action','1')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="text" class="form-label">{{__('messages.rules')}} ({{__('messages.accept_html')}})</label>
            <textarea class="form-control" id="rules" name="rules"  rows="6"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-dark">{{__('messages.send')}}</button>
        </div>
    </form>
@endsection
