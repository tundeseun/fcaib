<style>
    .footer-list ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 50px;
    }

    .footer-list ul li {
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .f_title {
        margin-bottom: 40px;
    }

    .f_title h4 {
        color: #415094;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0px;
    }
</style>
@php
    if(moduleStatusCheck('ParentRegistration')){
        $is_registration_permission = Modules\ParentRegistration\Entities\SmRegistrationSetting::first('position');
    }

    $setting  = generalSetting();
    App::setLocale(getUserLanguage());
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(isset ($ttl_rtl ) && $ttl_rtl ==1) dir="rtl" class="rtl" @endif >
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="Infix is 100+ unique feature enable school management software system. It can manage all type of school, academy and any educational institution"/>
    <link rel="icon" href="{{asset($setting->favicon)}}" type="image/png"/>
    <title>{{ $setting->site_title ? $setting->site_title :  'Infix Edu ERP' }}</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Bootstrap CSS -->
    @if( $setting->site_title == 1)
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/bootstrap.min.css"/>
    @else
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    @endif

    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery-ui.css"/>

    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/owl.carousel.min.css"/>
    <!-- main css -->

    @if($setting->site_title ==1)
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/style.css"/>
    @else
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/{{@activeStyle()->path_main_style}}"/>
    @endif

    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.print.css">

    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/infix.css"/>
    
    <script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.2.1.min.js">
    </script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    @stack('css')
</head>

<body class="client light">
<!--================ Start Header Menu Area =================-->
<header class="header-area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box-1420">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href="{{url('/')}}/home">
                    <img class="w-75"
                         src="{{asset($setting->logo ? $setting->logo : 'public/uploads/settings/logo.png')}}"
                         alt="Infix Logo" style="max-width: 150px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">

                            {{-- Static Header Menu Start --}}
                                <li class="nav-item  {{Request::path() == '/' ||  Request::path() == 'home'? 'active':''}} ">
                                    <a class="nav-link" href="{{url('/')}}/home">
                                        @lang('lang.home')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('parentregistration/registration')}}">Admissions</a>
                                </li>

                                <li class="nav-item {{Request::path() == 'about'? 'active':''}}">
                                    <a class="nav-link" href="{{url('/')}}/about">
                                        @lang('lang.about')
                                    </a>
                                </li>

                                <li class="nav-item {{Request::path() == 'news-page'? 'active':''}}">
                                    <a class="nav-link" href="{{url('/')}}/news-page">
                                        @lang('lang.news')
                                    </a>
                                </li>

                                <li class="nav-item {{Request::path() == 'contact'? 'active':''}}">
                                    <a class="nav-link" href="{{url('/')}}/contact">
                                        @lang('lang.contact')
                                    </a>
                                </li>
                            {{-- Static Header Menu End --}}

                            @if (!auth()->check())
                                <li class="nav-item {{Request::path() == 'login'? 'active':''}}">
                                    <a class="nav-link" href="{{url('/')}}/login">@lang('lang.login')</a>
                                </li>
                            @else
                                <li class="nav-item submenu_left_control">
                                    <a class="nav-link" href="#"> {{ Auth::user()->full_name}}</a>
                                    <ul class="sumbmenu">
                                        
                                            <li class="menu_list_left">
                                                <a href="{{url('/')}}/dashboard">
                                                   <span class="ti-menu"></span>
                                                   Dashboard
                                                </a>
                                            </li>

                                            <li class="menu_list_left">
                                                <a href="{{ Auth::user()->role_id == 2? route('student-logout'): route('logout')}}"
                                                   onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">
                                                    <span class="ti-unlock"></span>
                                                    @lang('lang.logout')
                                                </a>

                                                <form id="logout-form"
                                                      action="{{ Auth::user()->role_id == 2? route('student-logout'): route('logout') }}"
                                                      method="POST" style="display: none;">

                                                    @csrf
                                                </form>
                                            </li>
                                  
                                    </ul>
                                </li>
                            @endif

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <ul class="nav navbar-nav mr-auto search-bar">
                            <li class=""></li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================ End Header Menu Area =================-->

@yield('main_content')

<!--================Footer Area =================-->
<footer class="footer_area section-gap-top" style="background:#20232E;">
    <div class="container">
        <div class="row footer_inner">
 
                <div class="col-lg-4 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4 class="text-white">Connect With Us</h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>

                                    <li class="text-white">
                                        <span class="ti-map"></span> {{generalSetting()->address}}
                                    </li>
                                    <li >
                                        <a class="text-white" href="mailto:{{generalSetting()->email}}"><span class="ti-email"></span> {{generalSetting()->email}}</a>
                                    </li>
                                    <li >
                                        <a class="text-white" href="tel:{{generalSetting()->phone}}"><span class="ti-headphone-alt"></span> {{generalSetting()->phone}}</a>
                                    </li>
                                       
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4 class="text-white">Study</h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>
                                        <li>
                                            <a href="{{url('parentregistration/registration')}}" class="text-white">
                                                Admissions
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('/')}}/course" class="text-white">
                                                Courses
                                            </a>
                                        </li>
                                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4 class="text-white">Resources</h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>

                                        <li>
                                            <a href="{{url('/')}}/contact" class="text-white">
                                                Contact Us
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('/')}}/about" class="text-white">
                                                About Us
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('/')}}/news-page" class="text-white">
                                               News
                                            </a>
                                        </li>
                                   
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>


        </div>
        <div class="row single-footer-widget">
            <div class="col-lg-8 col-md-9">
                <div class="copy_right_text">

                        <p class="text-white">{!! $setting->copyright_text !!}</p>
                </div>
            </div>
            @if($social_permission)
                <div class="col-lg-4 col-md-3">
                    <div class="social_widget">
                        @foreach($social_icons as $social_icon)
                            @if (@$social_icon->url != "")
                                <a href="{{@$social_icon->url}}" class="text-white">
                                    <i class="{{$social_icon->icon}}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</footer>
<!--================End Footer Area =================-->

{{-- <script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.2.1.min.js"></script> --}}
<script src="{{asset('public/backEnd/')}}/vendors/js/jquery-ui.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/popper.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/nice-select.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/raphael-min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/morris.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/owl.carousel.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/moment.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/print/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap-datepicker.min.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDs3mrTgrYd6_hJS50x4Sha1lPtS2T-_JA"></script>
<script src="{{asset('public/backEnd/')}}/js/main.js"></script>
<script src="{{asset('public/backEnd/')}}/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('public/backEnd/')}}/js/developer.js"></script>

@yield('script')

</body>
</html>