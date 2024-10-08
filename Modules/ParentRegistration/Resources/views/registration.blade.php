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
    <!--================ Start Login Area =================-->
    <div class="reg_bg">

    </div>
    <section class="login-area  registration_area " style="height: 100%;">
        <div class="container">

            <div class="row justify-content-center align-items-center mt-20">

                <div class="col-lg-12">
                    <div class="text-center white-box single_registration_area">
                        <form method="POST" class="" action="{{route('parentregistration-student-store')}}" id="parent-registration" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="reg_tittle mt-20 mb-20">
                                        <h1>
                                            <b>{{$setting->school_name}}</b>
                                            <br/>Post-UTME Registration Form</h1>
                                        <p class="text-danger">All fields are required</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{asset('public/uploads/staff/demo/staff.jpg') }}" alt="Profile Pic" id="output" height="200px" width="200px"><br>
                                       @if ($errors->has('photo'))
                                            <center class="text-danger error-message invalid-select mb-10">{{ $errors->first('photo') }}</center>
                                       @else
                                            Upload Passport Photograph *
                                        @endif
                                    <br>
                                    <span class="primary-btn-small-input">
                                        <label class="primary-btn small fix-gr-bg" for="photo">@lang('lang.browse')</label>
                                        <input type="file" class="d-none" value="{{ old('photo') }}" name="photo" id="photo" accept="image/*" onchange="loadFile(event)">
                                    </span>
                                </div>
                            </div>
                             {{ csrf_field() }}
                            <input type="hidden" id="url" value="{{url('/')}}"> 
                            <div class="row">

                                <div class="col-lg-6" id="class-div">
                                    <select class="w-100 niceSelect bb form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" name="class">
                                        <option data-display="@lang('lang.select_class')" value="">@lang('lang.select_class')*</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <input type="hidden" name="academic_year" value="{{$setting->academic_id}}">

                                <div class="col-lg-6 mt-30-md" >
                                    <select class="w-100 niceSelect bb form-control{{ $errors->has('current_section') ? ' is-invalid' : '' }}"  name="section">
                                        <option data-display="@lang('lang.select_section')" value="">@lang('lang.select_section')*</option>
                                        <option value="1">Utme Entry (Level 100)</option>
                                        <option value="2">Direct Entry (Level 200)</option>
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='first_name' placeholder="@lang('lang.student') @lang('lang.first_name') *" value="{{old('first_name')}}" />
                                    </div>
                                    @if($errors->has('first_name'))
                                    <div class="text-danger error-message invalid-select mb-10">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='last_name' placeholder="@lang('lang.student') @lang('lang.last_name') *" value="{{old('last_name')}}" />
                                    </div>
                                    @if($errors->has('last_name'))
                                            <div class="text-danger error-message invalid-select mb-10">{{ $errors->first('last_name') }}</div>
                                        @endif
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <select class="niceSelect w-100 bb form-control" name="gender">
                                            <option data-display="@lang('lang.gender') *" value="">@lang('lang.gender') *</option>
                                            @foreach($genders as $gender)
                                                <option value="{{$gender->id}}" {{old('gender') == $gender->id? 'selected': ''}}>{{$gender->base_setup_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($errors->has('gender'))
                                        <div class="text-danger error-message invalid-select mb-10">{{ $errors->first('gender') }}</div>
                                    @endif
                                </div>

                                <div class="col-lg-6">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input mydob date form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                                    name="date_of_birth" value="{{date('d/m/Y')}}" autocomplete="off" id="date_of_birth">
                                                    <label>@lang('lang.date_of_birth') *</label>
                                                    <span class="focus-border"></span>
                                                @if ($errors->has('date_of_birth'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="email" name='student_email' id="student_email" placeholder="@lang('lang.student') @lang('lang.email')*" value="{{$email}}" readonly />
                                    </div>
                                    <span class="text-danger error-message" id="student_email_error"></span>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='student_mobile' id="student_mobile" placeholder="@lang('lang.student') @lang('lang.mobile') *" value="{{old('student_mobile')}}" />
                                    </div>
                                    <span class="text-danger error-message" id="student_mobile_error"></span>
                                </div>
                            </div>

                            <div class="row mt-40 mb-20">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">Guardian Information</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group input-group">
                                            <input class="form-control" type="text" name='guardian_name' id="school_name" placeholder="@lang('lang.guardian_name') *" value="{{old('guardian_name')}}" />
                                        </div>
                                        @if($errors->has('guardian_name'))
                                            <div class="text-danger error-message invalid-select mb-10">{{ $errors->first('guardian_name') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 d-flex relation-button">
                                        <p class="text-uppercase mb-0">
                                            @lang('lang.guardian_relation')
                                        </p>
                                        <div class="d-flex radio-btn-flex ml-30">
                                            <div class="mr-20">
                                                <input type="radio" name="relationButton" id="relationFather" value="F" class="common-radio relationButton" {{old('relationButton') == "F"? 'checked': ''}}>
                                                <label for="relationFather">@lang('lang.father')</label>
                                            </div>
                                            <div class="mr-20">
                                                <input type="radio" name="relationButton" id="relationMother" value="M" class="common-radio relationButton" {{old('relationButton') == "M"? 'checked': ''}}>
                                                <label for="relationMother">@lang('lang.mother')</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="relationButton" id="relationOther" value="O" class="common-radio relationButton"  {{old('relationButton') != ""? (old('relationButton') == "O"? 'checked': ''): 'checked'}}>
                                                <label for="relationOther">@lang('lang.Other')</label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='guardian_email' id="guardian_email" placeholder="@lang('lang.guardian_email') *" value="{{old('guardian_email')}}"/>
                                    </div>
                                    @if($errors->has('guardian_email'))
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_email_error">{{ $errors->first('guardian_email') }}</div>
                                        @else
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_email_error"></div>
                                        @endif

                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='guardian_mobile' id="guardian_mobile" placeholder="@lang('lang.guardian_mobile') *" value="{{old('guardian_mobile')}}"/>
                                    </div>
                                    @if($errors->has('guardian_mobile'))
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_mobile_error">{{ $errors->first('guardian_mobile') }}</div>
                                        @else
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_mobile_error"></div>
                                        @endif
                                    
                                </div>
                            </div>

                            <div class="row mt-40 mb-20">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">UTME (J.A.M.B) DETAILS</h4>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='utme_number' placeholder="UTME (J.A.M.B) Registration Number *" value="{{$utme_number}}" readonly />
                                    </div>
                                    @if($errors->has('utme_number'))
                                    <div class="text-danger error-message invalid-select mb-10">{{ $errors->first('utme_number') }}</div>
                                    @endif
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="number" name='utme_score' placeholder="UTME (J.A.M.B) Score *" value="{{old('utme_score')}}" />
                                    </div>
                                    @if($errors->has('utme_score'))
                                            <div class="text-danger error-message invalid-select mb-10">{{ $errors->first('utme_score') }}</div>
                                        @endif
                                </div>
                            </div>

                            <div class="row mt-40">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">Relevant Documents</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-30 mt-20">
                                 <div class="col-lg-4">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="UTME Result *"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('document_file_2'))
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ @$errors->first('document_file_2') }}</strong>
                                                            </span>
                                                    @endif

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_1">UTME Result *</label>
                                                <input type="file" class="d-none" name="document_file_1" id="document_file_1">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderFileTwoName" placeholder="SSCE Result *"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('document_file_2'))
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ @$errors->first('document_file_2') }}</strong>
                                                            </span>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_2">SSCE Result *</label>
                                                <input type="file" class="d-none" name="document_file_2" id="document_file_2">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderFileThreeName" placeholder="Guarantors Letter *"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('document_file_3'))
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ @$errors->first('document_file_3') }}</strong>
                                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_3">Guarantors Letter *</label>
                                                <input type="file" class="d-none" name="document_file_3" id="document_file_3">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-40">
                                <div class="col-lg-12">
                                    <div class="float-left">
                                        <a type="submit" class="btn btn-danger text-white" href="{{url('/')}}">
                                            <span class="ti-arrow-left"></span>
                                            Back
                                        </a>
                                        <button type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{@$tooltip}}">
                                            <span class="ti-check"></span>
                                           Apply
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
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
