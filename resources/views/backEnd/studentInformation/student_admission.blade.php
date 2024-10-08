@extends('backEnd.master')
@section('title') 
@lang('lang.student_admission')
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backEnd/')}}/css/croppie.css">
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.student_admission')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.student_information')</a>
                <a href="#">@lang('lang.student_admission')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="main-title xs_mt_0 mt_0_sm">
                    <h3 class="mb-0">@lang('lang.add') @lang('lang.student')</h3>
                </div>
            </div>
              @if(userPermission(63))
               <div class="offset-lg-3 col-lg-3 text-right mb-20 col-sm-6">
                <a href="{{route('import_student')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.import') Students
                </a>
            </div>
            @endif
        </div>
        @if(userPermission(65))
            {{ Form::open(['class' => 'form-horizontal studentadmission', 'files' => true, 'route' => 'student_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_form']) }}
        @endif
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
                <div class="white-box">
                    <div class="">
                        <div class="row">
                            
                                <div class="col-lg-8 col-6">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">@lang('lang.personal') @lang('lang.info')</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <img src="{{asset('public/uploads/staff/demo/staff.jpg') }}" alt="Profile Pic" id="output" height="200px" width="200px"><br>
                                       @if ($errors->has('photo'))
                                            <center class="text-danger error-message invalid-select mb-10">{{ $errors->first('photo') }}</center>
                                       @else
                                            Upload Passport Photograph *
                                        @endif
                                    <br>
                                    <span class="primary-btn-small-input justify-content-center">
                                        <label class="primary-btn small fix-gr-bg" for="photo">@lang('lang.browse')</label>
                                        <input type="file" class="d-none" value="{{ old('photo') }}" name="photo" id="photo" accept="image/*" onchange="loadFile(event)">
                                    </span>
                                </div>
                        </div>
                        {{ csrf_field() }}
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        <div class="row mb-40 mt-30">
                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('academic_year') ? ' is-invalid' : '' }}" name="academic_year">
                                        <option data-display="@lang('lang.academic_year') *" value="">@lang('lang.academic_year') *</option>
                                        @foreach($sessions as $session)
                                        <option value="{{$session->id}}" {{old('session') == $session->id? 'selected': ''}}>{{$session->year}}[{{$session->title}}]</option>
                                        @endforeach
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('academic_year'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('academic_year') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6" id="class-div">
                                <select class="w-100 niceSelect bb form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" id="classSelectStudent">
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
                           
                           
                            @if(!empty(old('class')))
                            @php
                                $old_sections = DB::table('sm_class_sections')->where('class_id', '=', old('class'))
                                ->join('sm_sections','sm_class_sections.section_id','=','sm_sections.id')
                                ->get();
                            @endphp
                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control {{ $errors->has('section') ? ' is-invalid' : '' }}" name="section"
                                        id="sectionSelectStudent" >
                                       <option data-display="@lang('lang.section') *" value="">@lang('lang.section') *</option>
                                        @foreach ($old_sections as $old_section)
                                           <option value="{{ $old_section->id }}" {{ old('section')==$old_section->id ? 'selected' : '' }} >
                                            {{ $old_section->section_name }}</option>
                                      @endforeach
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @else

                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" name="section" id="sectionSelectStudent">
                                       <option data-display="@lang('lang.section') *" value="">@lang('lang.section') *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endif


                            <input type="hidden" name="admission_number"
                             value="{{$max_admission_id != ''? $max_admission_id + 1 : 1}}" >

                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" type="text" name="first_name" value="{{old('first_name')}}">
                                    <label>@lang('lang.first') @lang('lang.name') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" type="text" name="last_name" value="{{old('last_name')}}">
                                    <label>@lang('lang.last') @lang('lang.name') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
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

                            <div class="col-lg-6 mt-3">
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


                            <div class="col-lg-6 mt-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control{{ $errors->has('student_email') ? ' is-invalid' : '' }}" type="text" name="student_email" value="{{old('student_email')}}">
                                    <label>@lang('lang.student') @lang('lang.email') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('student_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('student_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control{{ $errors->has('student_mobile') ? ' is-invalid' : '' }}" type="text" name="student_mobile" value="{{old('student_mobile')}}">
                                    <label>@lang('lang.student') @lang('lang.mobile') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('student_mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('student_mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
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
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input form-control{{ $errors->has('guardian_name') ? ' is-invalid' : '' }}" type="text" name="guardian_name" value="{{old('guardian_name')}}">
                                            <label>Guardian Name <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('guardian_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('guardian_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
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
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control{{ $errors->has('guardian_email') ? ' is-invalid' : '' }}" type="text" name="guardian_email" value="{{old('guardian_email')}}">
                                        <label>Guardian Email <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('guardian_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('guardian_email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control{{ $errors->has('guardian_mobile') ? ' is-invalid' : '' }}" type="text" name="guardian_mobile" value="{{old('guardian_mobile')}}">
                                        <label>Guardian Mobile <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('guardian_mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('guardian_mobile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
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
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control{{ $errors->has('utme_number') ? ' is-invalid' : '' }}" type="text" name="utme_number" value="{{old('utme_number')}}">
                                        <label>UTME Number <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('utme_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('utme_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control{{ $errors->has('utme_score') ? ' is-invalid' : '' }}" type="text" name="utme_score" value="{{old('utme_score')}}">
                                        <label>UTME Score <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('utme_score'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('utme_score') }}</strong>
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

                            <button type="submit" class="primary-btn small fix-gr-bg">
                                <span class="ti-plus pr-2"></span>
                                Add Student
                            </button>



                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</section>


@endsection
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
@endsection

