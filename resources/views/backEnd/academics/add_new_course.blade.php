@extends('backEnd.master')
@section('title') 
@lang('lang.subject')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.subject')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.academics')</a>
                <a href="#">@lang('lang.subject')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="d-flex my-3">
        <a  class="primary-btn small fix-gr-bg" href="/subject">
            <span class="ti-arrow-left pr-2"></span>
            Back
        </a>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">

                        @if(isset($subject))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject_update', 'method' => 'POST']) }}
                        @else
                        @if(userPermission(258))
            
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject_store', 'method' => 'POST']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="main-title">
                                <h3 class="mb-30">@if(isset($subject))
                                        @lang('lang.edit')
                                    @else
                                        @lang('lang.add')
                                    @endif
                                    @lang('lang.subject')
                                </h3>
                            </div>
                            <hr/>
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(session()->has('message-success'))
                                          <div class="alert alert-success">
                                              {{ session()->get('message-success') }}
                                          </div>
                                        @elseif(session()->has('message-danger'))
                                          <div class="alert alert-danger">
                                              {{ session()->get('message-danger') }}
                                          </div>
                                        @endif
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ @$errors->has('subject_name') ? ' is-invalid' : '' }}" 
                                            type="text" name="subject_name" autocomplete="off" value="{{isset($subject)? $subject->subject_name: old('subject_name')}}">
                                            <input type="hidden" name="id" value="{{isset($subject)? $subject->id: ''}}">
                                            <label>@lang('lang.subject_name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('subject_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ @$errors->first('subject_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('subject_code') ? ' is-invalid' : '' }}" type="text" name="subject_code" autocomplete="off" value="{{isset($subject)? $subject->subject_code: old('subject_code')}}">
                                            <label>@lang('lang.subject_code') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('subject_code'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ @$errors->first('subject_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('units') ? ' is-invalid' : '' }}" type="text" name="units" autocomplete="off" value="{{isset($subject)? $subject->units: old('units')}}">
                                            <label>Units<span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('units'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ @$errors->first('units') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="w-100 bb niceSelect form-control {{ @$errors->has('class') ? ' is-invalid' : '' }}" name="class">
                                                @if(isset($subject))
                                                @if($subject->class_id == 0)
                                                <option value="0">Elective Course</option>
                                                @elseif($subject->class_id == -1)
                                                <option value="-1">Compulsory Course</option>
                                                @else
                                                <option data-display="{{@$subject->class->class_name}}" value="{{@$subject->class_id}}">
                                                @endif
                                                {{@$subject->classes->class_name}}</option>
                                                @endif
                                                <option data-display="@lang('lang.select_class')*" value="">@lang('lang.select_class') *</option>
                                                @foreach($classes as $class)
                                                <option value="{{@$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{@$class->class_name}}</option>
                                                @endforeach
                                                <option value="-1">Compulsory Course</option>
                                                <option value="0">Elective Course</option>
                                            </select>
                                            @if ($errors->has('class'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ @$errors->first('class') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="w-100 bb niceSelect form-control{{ @$errors->has('section') ? ' is-invalid' : '' }}" name="section">
                                                @if(isset($subject))
                                                <option data-display="{{@$subject->sections->section_name}}" value="{{@$subject->section_id}}">{{@$subject->sections->section_name}}</option>
                                                @endif
                                                <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section')*</option>
            
                                                @foreach($sections as $section)
                                                <option data-display="{{@$section->section_name}}" value="{{@$section->id}}" {{isset($section_id)? ($section_id == $section->id? 'selected':''):''}}>{{@$section->section_name}}</option>
                                                @endforeach
            
                                            </select>
                                            @if ($errors->has('section'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ @$errors->first('section') }}</strong>
                                            </span>
                                            @endif
            
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="d-flex radio-btn-flex">
                                            @if(isset($subject))
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationFather" value="F" class="common-radio relationButton" {{@$subject->subject_type == 'F'? 'checked':''}}>
                                                <label for="relationFather">1st Semester</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationMother" value="S" class="common-radio relationButton" {{@$subject->subject_type == 'S'? 'checked':''}}>
                                                <label for="relationMother">2nd Semester</label>
                                            </div>
                                            @else
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationFather" value="F" class="common-radio relationButton" checked>
                                                <label for="relationFather">1st Semester</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationMother" value="S" class="common-radio relationButton">
                                                <label for="relationMother">2nd Semester</label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
            
                                 @php 
                                  $tooltip = "";
                                  if(userPermission(258)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($subject))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
