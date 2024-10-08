<?php
$setting = generalSetting();
App::setLocale(getUserLanguage());
 
if (isset($setting->copyright_text)) {
    $copyright_text = $setting->copyright_text;
} else {
    $copyright_text = 'Copyright © 2020 All rights reserved | This template is made with by Codethemes';
}
if (isset($setting->logo)) {
    $logo = $setting->logo;
} else {
    $logo = 'public/uploads/settings/logo.png';
}

if (isset($setting->favicon)) {
    $favicon = $setting->favicon;
} else {
    $favicon = 'public/backEnd/img/favicon.png';
}

$login_background = App\SmBackgroundSetting::where([['is_default', 1], ['title', 'Login Background']])->first();

if (empty($login_background)) {
    $css = "background: url(" . url('public/backEnd/img/in_registration.png') . ")  no-repeat center; background-size: cover; ";
} else {
    if (!empty($login_background->image)) {
        $css = "background: url('" . url($login_background->image) . "')  no-repeat center;  background-size: cover;";
    } else {
        $css = "background:" . $login_background->color;
    }
}
?>


<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(isset ($ttl_rtl ) && $ttl_rtl ==1) dir="rtl" class="rtl" @endif >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset($setting->favicon)}}" type="image/png" />
    <title>{{@schoolConfig()->school_name ? @schoolConfig()->school_name : 'Infix Edu ERP'}} | @lang('lang.student')  @lang('lang.registration') </title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" href="{{url('/')}}/public/backEnd/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="{{url('/')}}/public/backEnd/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="{{url('/public/')}}/landing/css/toastr.css">
    <link rel="stylesheet" href="{{url('/')}}/public/backEnd/vendors/css/nice-select.css" />
    <link rel="stylesheet" href="{{url('/')}}/public/backEnd/vendors/js/select2/select2.css" />
    <link rel="stylesheet" href="{{url('/')}}/public/backEnd/vendors/css/fastselect.min.css" />
    <link rel="stylesheet" href="{{url('public/backEnd/')}}/vendors/css/toastr.min.css"/>
    <link rel="stylesheet" href="{{url('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{{url('public/backEnd/')}}/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{url('public/backEnd/')}}/css/style.css"/>
	<link rel="stylesheet" href="{{url('Modules/ParentRegistration/Resources/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backEnd/')}}/css/croppie.css">

</head>

<body class="reg_bg" style="{{@$css}}"> 

    <section class="login-area  registration_area " style="height: 100%;">
        <div class="container mt-50">


            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="text-center white-box single_registration_area">
                        <h1>{{__('Thank You')}}</h1>
                        <h3>{!! \Session::get('success') !!}</h3>
                        <p>Please check your email constantly for an update concerning your admission status</p>
                        <a href="{{url('/')}}" class="primary-btn small fix-gr-bg"> 
                            @lang('lang.home')
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </section>
    <!--================ Start End Login Area =================-->
    <!--================ Footer Area =================-->
    <footer class="footer_area registration_footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                <p>{!!$copyright_text!!}</p>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End Footer Area =================-->

    <script src="{{url('/')}}/public/backEnd/vendors/js/jquery-3.2.1.min.js"></script>
    <script src="{{url('/')}}/public/backEnd/vendors/js/popper.js"></script>
    <script src="{{url('/')}}/public/backEnd/vendors/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/public/backEnd/vendors/js/nice-select.min.js"></script>
    <script src="{{url('/')}}/public/backEnd/js/login.js"></script>
    <script src="{{url('public/backEnd/js/validate.js')}}"></script>
    <script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap-datepicker.min.js"></script>
    <script src="{{url('/')}}/public/backEnd/js/main.js"></script>
    <script src="{{url('/')}}/public/backEnd/js/custom.js"></script>
    <script src="{{url('/public/js/registration_custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/backEnd/')}}/vendors/js/toastr.min.js"></script> 
    @section('script')
    <script src="{{asset('public/backEnd/')}}/js/croppie.js"></script>
    <script src="{{asset('public/backEnd/')}}/js/st_addmision.js"></script>
    <script>
        $(document).ready(function(){
            
            $(document).on('change','.cutom-photo',function(){
                let v = $(this).val();
                let v1 = $(this).data("id");
                console.log(v,v1);
                getFileName(v, v1);

            });

            function getFileName(value, placeholder){
                if (value) {
                    var startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
                    var filename = value.substring(startIndex);
                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                        filename = filename.substring(1);
                    }
                    $(placeholder).attr('placeholder', '');
                    $(placeholder).attr('placeholder', filename);
                }
            }

            
        })
          var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
              var output = document.getElementById('output');
              output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
          };
</script>
    </script>
    @endsection
    {!! Toastr::message() !!}
    @yield('script')
</body>
</html>
