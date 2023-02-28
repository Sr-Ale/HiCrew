@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.staff_list') }}</p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ __('messages.only_name') }}</th>
                <th scope="col">{{ __('messages.rank_staff') }}</th>
                <th scope="col">{{ __('messages.ivao') }}</th>
                <th scope="col">{{ __('messages.vatsim') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permission as $permission)
                @php
                    $aux = \App\Models\User::where('id',$permission->id)->get();
                    $auxiliar = explode(" ", $aux[0]->name);
                @endphp
                <tr>
                <th scope="row">{{$auxiliar[0]}}</th>
                @if($permission->academy && ($permission->valid || $permission->operations || $permission->events || $permission->members))
                <td>{{ __('messages.academy_and_staff') }}</td>
                @elseif($permission->academy)
                    <td>{{ __('messages.only_academy') }}</td>
                @else
                    <td>{{ __('messages.staff') }}</td>
                @endif
                <td><a href="https://ivao.aero/Member.aspx?Id={{$aux[0]->ivao}}">{{$aux[0]->ivao}}</a></td>
                <td>{{$aux[0]->vatsim}}</td>
                </tr>
            @endforeach
            @if($permission=='[]')
                <tr>
                    <th scope="row" colspan="4">
                        {{ __('messages.no_staff') }}
                    </th>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
    <br>
    <p class="h3">{{ __('messages.pilot_list') }}</p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ __('messages.callsign') }}</th>
                <th scope="col">{{ __('messages.only_name') }}</th>
                <th scope="col">{{ __('messages.ivao') }}</th>
                <th scope="col">{{ __('messages.vatsim') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $users)
            <tr>
                <th scope="row">{{$users->callsign}}</th>
                @php
                    $names = explode(" ", $users->name);
                @endphp
                <td>{{$names[0]}}</td>
                <td><a href="https://ivao.aero/Member.aspx?Id={{$users->ivao}}">{{$users->ivao}}</a></td>
                <td>{{$users->vatsim}}</td>
            </tr>

            @endforeach
            @if($users=='[]')
                <tr>
                    <th scope="row" colspan="4">
                        {{ __('messages.no_pilots') }}
                    </th>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
@endsection
