@extends('layouts.global')

@section('content')
    <p class="h3"><i class="fa-solid fa-book"></i> {{ __('messages.rules') }}</p>
    @if($rules != null)
    {!! $rules->description !!}

    <p style="font-size: 12px">{{__('messages.last_edit')}}: {{$rules->updated_at}}</p>
    @endif
@endsection
