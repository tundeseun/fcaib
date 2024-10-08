@extends('backEnd.master')
@section('title')
Transcript Application
@endsection

@section('mainContent')
<style type="text/css">
    .form-control{
        margin-top: 8px;
    }
    label{
        margin-top: 8px;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Transcript Application</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('transcript-application')}}">Transcript Application</a>
            </div>
        </div>
    </div>
</section>
<section class="login-area  registration_area ">
        <div class="row mt-20">
            <div class="col-lg-12">
                <div class="white-box single_registration_area">
                @if($has_application == 1)
                    <div>
                        <h1>Existing Application</h1><hr/>
                        <p>
                            You Currently have an ongoing application for Transcript<br/> Please hold on while its being processed
                        </p>
                    </div>
                 @else
                    <form method="POST" class="" action="{{ route('transcript-application-2') }}" id="parent-registration" enctype="multipart/form-data">
                        <div class="row">
                                <div class="reg_tittle col-md-6 offset-md-3 mb-20">
                                    <h2 class="text-center">Transcript Application Form</h2>
                                    <p class="text-center text-danger">Note: Transcript application & processing costs {{@generalSetting()->currency_symbol}}{{number_format($transcript_cost)}} Please fill all fields & click apply to continue*</p>
                                </div>
                        </div>

                         {{ csrf_field() }}

                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head">Basic Information</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" type="text" name="first_name" autocomplete="off" value="{{$student_detail->first_name}}" readonly required>
                                    <label>@lang('lang.first_name') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" type="text" name="last_name" autocomplete="off" value="{{$student_detail->last_name}}" readonly required>
                                    <label>@lang('lang.last_name') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" type="text" name="phone_number" autocomplete="off" value="{{$student_detail->mobile}}" required>
                                    <label>@lang('lang.phone_number') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" autocomplete="off" value="{{$student_detail->email}}" required>
                                    <label>@lang('lang.email') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" type="text" name="department" autocomplete="off" value="{{$student_detail->class->class_name}}" readonly>
                                    <label>Department<span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('department'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('department') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <select id="entry_year" name="entry_year" class="niceSelect w-100 bb form-control" required> 
                                   <option value="">Year of Entry *</option>
                                   @for($i = 1990; $i <= date('Y'); $i++)
                                   <option>{{$i}}</option>
                                   @endfor
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <select id="graduation_year" name="graduation_year" class="niceSelect w-100 bb form-control" required> 
                                   <option value="">Year of Graduation *</option>
                                    @for($i = 1990; $i <= date('Y'); $i++)
                                   <option>{{$i}}</option>
                                   @endfor
                                </select>
                            </div>


                            <div class="col-lg-6">
                                <select id="nationality" name="nationality" class="niceSelect w-100 bb form-control" required> 
                                   <option value="">Nationality *</option>
                                   @include('backEnd.studentPanel.countries')
                                </select>
                            </div>
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head">Address: (To Which Your Request Are To Be Sent)</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('institution_name') ? ' is-invalid' : '' }}" type="text" name="institution_name" autocomplete="off" required>
                                    <label>Institution Name <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('institution_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('institution_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('institution_address') ? ' is-invalid' : '' }}" type="text" name="institution_address" autocomplete="off" required>
                                    <label>Institution Address<span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('institution_address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('institution_address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <select id="institution_country" name="institution_country" class="niceSelect w-100 bb form-control" required> 
                                   <option value="">Country *</option>
                                   @include('backEnd.studentPanel.countries')
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('institution_email') ? ' is-invalid' : '' }}" type="text" name="institution_email" autocomplete="off" required>
                                    <label>Institution Email <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('institution_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('institution_email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('institution_office') ? ' is-invalid' : '' }}" type="text" name="institution_office" autocomplete="off" required>
                                    <label>Institution's Receiving Office/Officer (e.g The Registrar, The Registry)<span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('institution_office'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('institution_office') }}</strong>
                                        </span>
                                    @endif
                                </div>
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


                            <div class="col-lg-6">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileTwoName" placeholder="SSCE Result *"
                                                readonly="" required>
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
                                            <input type="file" class="d-none" name="document_file_2" id="document_file_2" required>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="Statement of Result *"
                                                readonly="" required>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('document_file_1'))
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ @$errors->first('document_file_1') }}</strong>
                                                        </span>
                                                @endif

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_1">Statement of Result *</label>
                                            <input type="file" class="d-none" name="document_file_1" id="document_file_1" required>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="float-left">
                                    <button type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{@$tooltip}}">
                                        <span class="ti-check"></span>
                                       Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
                </div>
            </div>
        </div>
</section>
@endsection

