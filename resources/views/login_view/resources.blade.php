@extends('layouts.global')

@section('content')
    <div class="btn-toolbar justify-content-end">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a href="#liveries" class="btn btn-dark">{{ __('messages.liveries') }}</a>
            <a href="#documents" class="btn btn-dark">{{ __('messages.documents') }}</a>
            <a href="#checklist" class="btn btn-dark">{{ __('messages.checklist') }}</a>
        </div>
    </div>
    <p class="h3" id="liveries">
        <i class="fa-solid fa-brush"></i> {{ __('messages.liveries') }}
    </p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.simulator')}}</th>
            <th scope="col">{{__('messages.last_modification')}}</th>
            <th scope="col">{{__('messages.download')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($liveries as $liveries)
            <tr>
                <td>{{$liveries->name}}</td>
                <td>{{$liveries->simulator}}</td>
                <td>{{$liveries->updated_at}}</td>
                <td><a href="{{$liveries->url}}" target="_blank" class="btn btn-dark btn-sm"> <i class="fa-solid fa-download"></i></a></td>
            </tr>
        @endforeach
        @if($liveries=='[]')
            <tr>
                <td colspan="4">{{__('messages.not_upload')}}</td>
            </tr>
        @endif
        </tbody>
    </table>
    <p class="h3" id="documents">
        <i class="fa-solid fa-file"></i> {{ __('messages.documents') }}
    </p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.last_modification')}}</th>
            <th scope="col">{{__('messages.download')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($documents as $documents)
            <tr>
                <td>{{$documents->name}}</td>
                <td>{{$documents->updated_at}}</td>
                <td><a href="{{$documents->url}}" target="_blank" class="btn btn-dark btn-sm"> <i class="fa-solid fa-download"></i></a></td>
            </tr>
        @endforeach
        @if($documents=='[]')
            <tr>
                <td colspan="3">{{__('messages.not_upload')}}</td>
            </tr>
        @endif
        </tbody>
    </table>
    <p class="h3" id="checklist">
        <i class="fa-solid fa-clipboard-list"></i> {{ __('messages.checklist') }}
    </p>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{__('messages.only_name')}}</th>
            <th scope="col">{{__('messages.last_modification')}}</th>
            <th scope="col">{{__('messages.download')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($checklist as $checklist)
            <tr>
                <td>{{$checklist->name}}</td>
                <td>{{$checklist->updated_at}}</td>
                <td><a href="{{$checklist->url}}" target="_blank" class="btn btn-dark btn-sm"> <i class="fa-solid fa-download"></i></a></td>
            </tr>
        @endforeach
        @if($checklist=='[]')
            <tr>
                <td colspan="3">{{__('messages.not_upload')}}</td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
    </div>

@endsection
