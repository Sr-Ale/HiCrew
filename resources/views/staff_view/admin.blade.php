@extends('layouts.global')

@section('content')
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @if(Auth::user()->permission()->valid)
            <div class="col">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <a href="#">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-check"></i> {{__('messages.valid')}}</h5>
                    </div>
                    </a>
                </div>
            </div>
        @endif
            @if(Auth::user()->permission()->operations)
                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route("aircraft")}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-plane"></i> {{__('messages.aircraft')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route("fleet_staff")}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-plane-departure"></i> {{__('messages.fleet')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route("hubs")}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-globe"></i> {{__('messages.hub')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        @if(Auth::user()->permission()->events)
            <div class="col">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <a href="{{route('events')}}">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-calendar"></i> {{__('messages.events')}}</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endif

        @if(Auth::user()->permission()->members)

                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route('members')}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-people-group"></i> {{__('messages.members')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <a href="{{route('notams')}}">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-bullhorn"></i> {{__('messages.notams')}}</h5>
                        </div>
                    </a>
                </div>
            </div>

                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route('staff_resources')}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-folder-open"></i> {{__('messages.resources')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route('staff_tours')}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-map"></i> {{__('messages.tours')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route('files')}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-file"></i> {{__('messages.file')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
        @endif

            @if(Auth::user()->permission()->academy)
                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route('academy_staff')}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-school"></i> {{__('messages.academy')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            @if(Auth::user()->permission()->admin)
                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route('permission')}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-screwdriver-wrench"></i> {{__('messages.permission')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <a href="{{route('staff_rules')}}">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-scale-balanced"></i> {{__('messages.rules')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

    </div>

@endsection
