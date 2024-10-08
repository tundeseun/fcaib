@php 

$setting = generalSetting();
App::setLocale(getUserLanguage());


@endphp

<!doctype html>
@php
    App::setLocale(getUserLanguage());
@endphp
<html lang="{{ app()->getLocale() }}" @if(isset ($ttl_rtl ) && $ttl_rtl ==1) dir="rtl" class="rtl" @endif >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset(generalSetting()->favicon)}}" type="image/png"/>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/login2')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/login2')}}/themify-icons.css">
    <link rel="stylesheet" href="{{url('/')}}/public/backEnd/vendors/css/nice-select.css" />
    <link rel="stylesheet" href="{{url('/')}}/public/backEnd/vendors/js/select2/select2.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/login2')}}/css/style.css">
	<link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/toastr.min.css"/>
    <title>{{isset($setting)? !empty($setting->site_title) ? $setting->site_title : 'System ': 'System '}} | @lang('lang.login')</title>
<style>
    .loginButton {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .loginButton{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .singleLoginButton{
        flex: 22% 0 0;
    }

    .loginButton .get-login-access {
        display: block;
        width: 100%;
        border: 1px solid #fff;
        border-radius: 5px;
        margin-bottom: 20px;
        padding: 5px;
        white-space: nowrap;
    }

    .custom-footer-margin{
        margin-top: -35px;
    }

    @media (max-width: 576px) {
    .singleLoginButton{
        flex: 49% 0 0;
    }
    }

    @media (max-width: 576px) {
    .singleLoginButton{
        flex: 49% 0 0;
    }

    .loginButton .get-login-access {
        margin-bottom: 10px;
    }
    }
    
    .create_account a {
        color: #828bb2;
        font-weight: 500;
        text-decoration: none;
    }

    #email-address:focus-visible {
        outline: none;
    }
    #password-login:focus-visible{
        outline: none;
    }
</style>
</head>
<body>
    <div class="in_login_part mb-40"  style="{{$css}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-lg-5 col-xl-4 col-md-7">
					{{-- @if($errors->any())
						{{ implode('', $errors->all('<div>:message</div>')) }}
					@endif --}}
                    <div class="in_login_content">
                        @php 
                            $setting = generalSetting();
                        @endphp
                        
                        <div class="in_login_page_iner">
                            <form method="POST" class="loginForm" action="{{route('login')}}" id="infix_form">
                                @csrf
                                <input type="hidden" name="school_id" value="1">
                                <input type="hidden" name="username" id="username-hidden">

                                <?php if(session()->has('message-danger') != ""): ?>
                                    <?php if(session()->has('message-danger')): ?>
                                    <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <input type="hidden" id="url" value="{{url('/')}}">

                                <div class="in_single_input">
                                    <input type="text" placeholder="@lang('lang.enter') @lang('lang.email')" name="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" id="email-address">
                                    <span class="addon_icon">
                                        <i class="ti-email"></i>
                                    </span>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback text-left pl-3 d-block" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="in_single_input">
                                    <input type="password" placeholder="@lang('lang.enter')  @lang('lang.password')" name="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}" id="password-login">
                                    <span class="addon_icon"><i class="ti-key"></i></span>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback text-left pl-3 d-block" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="in_checkbox">
                                        <div class="boxes">
                                            <input type="checkbox" id="Remember" name="remember">
                                            <label for="Remember">@lang('lang.remember_me')</label>
                                        </div>
                                    </div>
                                    <div class="in_forgot_pass">
                                        <a href="{{route('recoveryPassord')}}">@lang('lang.forget') @lang('lang.password') ? </a>
                                    </div>
                                </div>
                                <div class="in_login_button text-center mt-2">
                                    <button type="submit" class="btn btn-warning form-control" id="btnsubmit">
                                        <span class="ti-lock"></span>
                                        @lang('lang.login')
                                    </button>
                                </div>
                                <div class="create_account text-center">
                                    <p>New Student? <a href="{{url('post-utme')}}">Enrol Here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--================ Footer Area =================-->
    <footer class="footer_area min-height-10 custom-footer-margin">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <p style="color: #828bb2">{!! @generalSetting()->copyright_text !!} </p>
                </div>
            </div>
        </div>
    </footer>


    <!--================ End Footer Area =================-->
    <script src="{{asset('public/backEnd/login2')}}/js/jquery-3.4.1.min.js"></script>
    <script src="{{asset('public/backEnd/login2')}}/js/popper.min.js"></script>
	<script src="{{asset('public/backEnd/login2')}}/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{asset('public/backEnd/')}}/vendors/js/toastr.min.js"></script>



	<script>
	$(document).ready(function () {

		$('#btnsubmit').on('click',function()
		{
		$(this).html('Please wait ...')
			.attr('disabled','disabled');
		$('#infix_form').submit();
		});

	 });

	$(document).ready(function() {
        $("#email-address").keyup(function(){
            $("#username-hidden").val($(this).val());
        });
    });

	 </script>
	{!! Toastr::message() !!}
  </body>
</html>
