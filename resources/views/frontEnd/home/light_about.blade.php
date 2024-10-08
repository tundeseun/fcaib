@php $page_title="All about Infix School management system; School management software"; @endphp
@extends('frontEnd.home.front_master')
@push('css')
    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/new_style.css"/>
@endpush
@section('main_content')
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="banner-area" style="background: linear-gradient(0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url({{$about->image != ""? $about->image : '../img/client/common-banner1.jpg'}}) no-repeat center;" >
            <div class="banner-inner">
                <div class="banner-content">
                    <h2>{{$about->title}}</h2>
                    <p>{{$about->description}}</p>
                    <a class="primary-btn fix-gr-bg semi-large" href="{{$about->button_url}}">{{$about->button_text}}</a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Our History Area =================-->
    <section class="academics-area mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">{{@$history->first()->category->category_name}}</h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($history as $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset($value->image)}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="{{url('news-details/'.$value->id)}}">{{$value->news_title}}</a>
                                    </h4>
                                    <p>
                                        {{$value->news_body}}
                                    </p>
                                    <div>
                                        <a href="{{url('news-details/'.$value->id)}}" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Our History Area =================-->

    <!--================ Start About Us Area =================-->
    <section class="info-area section-gap-bottom">
        <div class="container">				
            <div class="single-info row mt-40 align-items-center">
                <div class="col-lg-6 col-md-12 text-center pr-lg-0 info-left">
                    <div class="info-thumb">
                        <img src="{{asset($about->main_image)}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 pl-lg-0 info-rigth">
                    <div class="info-content">
                        <h2>{{$about->main_title}}</h2>
                        <p>
                            {{$about->main_description}}
                        </p>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End About Us Area =================-->

    <!--================ Our Mission and Vision Area =================-->
    <section class="academics-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">{{@$mission->first()->category->category_name}}</h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($mission as $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset($value->image)}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="{{url('news-details/'.$value->id)}}">{{$value->news_title}}</a>
                                    </h4>
                                    <p>
                                        {{$value->news_body}}
                                    </p>
                                    <div>
                                        <a href="{{url('news-details/'.$value->id)}}" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Our Mission and Vision Area =================-->
@endsection

