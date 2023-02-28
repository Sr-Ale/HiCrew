@php
    include '../config.php';
@endphp


@extends('layouts.global')

@section('content')
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center text-light bg-light" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('{{ __('edit.va_img') }}'); background-repeat: no-repeat; background-size: cover;">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal">{{$va_name}}</h1>
            <p class="lead fw-normal">{{ __('edit.va_desc') }}</p>
            @if(!auth()->check())
            <a class="btn btn-outline-light" href="{{route('register')}}">{{ __('messages.register') }}</a>
            <a class="btn btn-outline-light" href="{{route('login')}}">{{ __('messages.login') }}</a>
            @endif
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>

    <section class="py-6 bg-light-primary">
        <div class="container">

            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 text-center justify-content-center px-xl-6 aos-init aos-animate" data-aos="fade-up">
                <div class="col my-3">
                    <div class="card border-hover-primary hover-scale">
                        <div class="card-body">
                            <div class="text-primary mb-5">

                                <i class="fa-solid {{__('edit.card1_ico')}}" style="color:{{$color_primary}};font-size: 40px"></i>
                            </div>
                            <h6 class="font-weight-bold mb-3">{{__('edit.card1_title')}}</h6>
                            <p class="text-muted mb-0">{{__('edit.card1_text')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="card border-hover-primary hover-scale">
                        <div class="card-body">
                            <div class="text-primary mb-5">

                                <i class="fa-solid {{__('edit.card2_ico')}}" style="color:{{$color_primary}};font-size: 40px"></i>
                            </div>
                            <h6 class="font-weight-bold mb-3">{{__('edit.card2_title')}}</h6>
                            <p class="text-muted mb-0">{{__('edit.card2_text')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="card border-hover-primary hover-scale">
                        <div class="card-body">
                            <div class="text-primary mb-5">

                                <i class="fa-solid {{__('edit.card3_ico')}}" style="color:{{$color_primary}};font-size: 40px"></i>
                            </div>
                            <h6 class="font-weight-bold mb-3">{{__('edit.card3_title')}}</h6>
                            <p class="text-muted mb-0">{{__('edit.card3_text')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="card border-hover-primary hover-scale">
                        <div class="card-body">
                            <div class="text-primary mb-5">

                                <i class="fa-solid {{__('edit.card4_ico')}}" style="color:{{$color_primary}};font-size: 40px"></i>
                            </div>
                            <h6 class="font-weight-bold mb-3">{{__('edit.card4_title')}}</h6>
                            <p class="text-muted mb-0">{{__('edit.card4_text')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="card border-hover-primary hover-scale">
                        <div class="card-body">
                            <div class="text-primary mb-5">

                                <i class="fa-solid {{__('edit.card5_ico')}}" style="color:{{$color_primary}};font-size: 40px"></i>
                            </div>
                            <h6 class="font-weight-bold mb-3">{{__('edit.card5_title')}}</h6>
                            <p class="text-muted mb-0">{{__('edit.card5_text')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="card border-hover-primary hover-scale">
                        <div class="card-body">
                            <div class="text-primary mb-5">

                                <i class="fa-solid {{__('edit.card6_ico')}}" style="color:{{$color_primary}};font-size: 40px"></i>
                            </div>
                            <h6 class="font-weight-bold mb-3">{{__('edit.card6_title')}}</h6>
                            <p class="text-muted mb-0">{{__('edit.card6_text')}}</p>
                        </div>
                    </div>
                </div>
                @if($va_certified_ivao == 1)
                <div class="col my-3">
                    <a href="https://www.ivao.aero/" target="_blank">
                    <div class="card border-hover-primary hover-scale">
                        <div class="card-body">
                            <img src="images/IVAO.png">
                        </div>
                    </div>
                    </a>
                </div>
                @endif
                @if($va_certified_vatsim == 1)
                <div class="col my-3">
                    <a href="https://www.vatsim.net/" target="_blank">
                    <div class="card border-hover-primary hover-scale">
                        <div class="card-body">
                            <img src="images/VATSIM.png">
                        </div>
                    </div>
                    </a>
                </div>
                @endif


            </div>
        </div>
    </section>
@endsection
