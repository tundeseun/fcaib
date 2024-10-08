@extends('backEnd.master')
@section('title')
@lang('lang.general_settings')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.general_settings')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.general_settings')</a>
            </div>
        </div>
    </div>
</section>
<section class="student-details">
    <div class="container-fluid p-0">
        @include('backEnd.partials.alertMessage')
        <div class="row">
            <div class="col-lg-3 col-md-6 col-xl-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.change_logo')</h3>
                        </div>
                        @if(Illuminate\Support\Facades\Config::get('app.app_sync'))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data']) }}
                    @else
                        @if(userPermission(406))
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-school-logo', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                    @endif
                      

                        <div class="white-box">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="text-center">
                                
                            @if(isset($editData->logo))
                                                      
                                <img class="img-fluid Img-100" src="{{asset($editData->logo)}}" alt="" >
                            @else
                                <img class="img-fluid" src="{{asset('public/uploads/settings/logo.png')}}" alt="">
                            @endif
                            </div>

                            <div class="mt-40">
                                <div class="text-center">
                                    <label class="primary-btn small fix-gr-bg" for="upload_logo">@lang('lang.upload')</label>
                                    <input type="file" class="d-none form-control" name="main_school_logo" id="upload_logo">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                    
                                @if(Illuminate\Support\Facades\Config::get('app.app_sync'))
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" >@lang('lang.change_logo')</button></span>
                                @else
                                    @if(userPermission(406))
                                    <button class="primary-btn fix-gr-bg small  "    >
                                        <span class="ti-check"></span>
                                        @lang('lang.save') 
                                    </button>
                                    @endif 
                                @endif 
                             
                                @if ($errors->has('main_school_logo'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('main_school_logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>


                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="main-title">

                            <h3 class="mb-30">@lang('lang.change_fav') </h3>
                        </div>

                        @if(Illuminate\Support\Facades\Config::get('app.app_sync'))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data']) }}
                    @else
                    @if(userPermission(406))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-school-logo', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

                        @endif
                    @endif
                       
                        <div class="white-box">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="text-center">
                            @if(isset($editData->favicon) && !empty(@$editData->favicon))                            
                                <img class="img-fluid Img-50" src="{{@$editData->favicon}}" alt="" >
                            @else
                                <img class="img-fluid" src="{{asset('public/uploads/settings/favicon.png')}}" alt="">
                            @endif
                            </div>

                            <div class="mt-40">
                                <div class="text-center">
                                    <label class="primary-btn small fix-gr-bg" for="upload_favicon">@lang('lang.upload')</label>
                                    <input type="file" class="d-none form-control" name="main_school_favicon" id="upload_favicon">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                @if(Illuminate\Support\Facades\Config::get('app.app_sync'))
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" >@lang('lang.change_fav')</button></span>
                                @else
                                @if(userPermission(407))
                                    <button class="primary-btn fix-gr-bg small white_space">
                                            <span class="ti-check"></span>
                                        @lang('lang.save')
                                    </button>
                                    @endif  
                                @endif  
                                @if ($errors->has('main_school_favicon'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('main_school_favicon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>     
            </div>

            <div class="col-lg-9 col-xl-9">
                <section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">
                        @lang('lang.update')
                   </h3>
                </div>
            </div>
        </div>
        @if(Illuminate\Support\Facades\Config::get('app.app_sync'))
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data']) }}
        @else
            @if(userPermission(409))
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-general-settings-data', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            @endif
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">

                        @csrf
                        <div class="row mb-40">
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('school_name') ? ' is-invalid' : '' }}"
                                    type="text" name="school_name" autocomplete="off" value="{{isset($editData)? @$editData->school_name : old('school_name')}}">
                                    <label>@lang('lang.school_name') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('school_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('school_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('site_title') ? ' is-invalid' : '' }}"
                                    type="text" name="site_title" autocomplete="off" value="{{isset($editData)? @$editData->site_title : old('site_title')}}">
                                    <label>@lang('lang.site_title') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('site_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('site_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                    type="text" name="phone" autocomplete="off" value="{{ isset($editData) ? @$editData->phone : old('phone')}}">
                                    <label>@lang('lang.phone') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    type="text" name="email" autocomplete="off" value="{{isset($editData)? @$editData->email: old('email')}}">
                                    <label>@lang('lang.email') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row md-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="address" id="address">{{isset($editData) ? @$editData->address : old('address')}}</textarea>
                                    <label>@lang('lang.school_address') <span></span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row md-30 mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="copyright_text" id="copyright_text">{{isset($editData) ? @$editData->copyright_text : old('copyright_text')}}</textarea>
                                    <label>@lang('lang.copyright_text') <span></span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-30 mt-20">
                            <div class="col-lg-12 d-flex relation-button">
                                <p class="mb-0">Allow Hostel Booking</p>
                                <div class="d-flex ml-30 mt-3">
                                    <div>
                                        <input type="radio" name="hostel_booking" id="hostel_booking1" value="1" class="common-radio relationButton" {{@$editData->hostel_booking == "1"? 'checked': ''}}>
                                        <label for="hostel_booking1">@lang('lang.enable')</label>
                                    </div>
                                    <div class="ml-3">
                                        <input type="radio" name="hostel_booking" id="hostel_booking2" value="0" class="common-radio relationButton" {{@$editData->hostel_booking == "0"? 'checked': ''}}>
                                        <label for="hostel_booking2">@lang('lang.disable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-30 mt-20">
                            <div class="col-lg-12 d-flex relation-button">
                                <p class="mb-0">Allow Course Registration</p>
                                <div class="d-flex ml-30 mt-3">
                                    <div>
                                        <input type="radio" name="course_registration" id="course_registration1" value="1" class="common-radio relationButton" {{@$editData->course_registration == "1"? 'checked': ''}}>
                                        <label for="course_registration1">@lang('lang.enable')</label>
                                    </div>
                                    <div class="ml-3">
                                        <input type="radio" name="course_registration" id="course_registration2" value="0" class="common-radio relationButton" {{@$editData->course_registration == "0"? 'checked': ''}}>
                                        <label for="course_registration2">@lang('lang.disable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

        
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">

                            @if(env('APP_SYNC')==TRUE)
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" > @lang('lang.update')</button></span>
                            @else
                                @if(userPermission(409))
                                <button type="submit" class="primary-btn fix-gr-bg submit">
                                    <span class="ti-check"></span>
                                    @lang('lang.update')
                                </button>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{ Form::close() }}
    </div>
</div>
</section>
            </div>
        </div>
    </div>
</section>
<div class="modal fade admin-query question_image_preview"  >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.layout') @lang('lang.image')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <img src="" width="100%" class="question_image_url" alt="">
            </div>

        </div>
    </div>
</div>
<script>
    
    $(document).on('click', '.layout_image', function(){

         console.log(this.src);
            // $('.question_image_url').src(this.src);
            $('.question_image_url').attr('src',this.src);   
            $('.question_image_preview').modal('show');
        })
</script>
@endsection
