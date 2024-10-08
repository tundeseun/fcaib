@extends('backEnd.master')
@section('title') 
Student Information Update
@endsection


@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backEnd/')}}/css/croppie.css">
@endsection
@section('mainContent')

<section class="sms-breadcrumb up_breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Student Information Update</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('student_list')}}">@lang('lang.student_list')</a>
                <a href="#">Student Information Update</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

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
                        <div class="row mb-4">
                            <div class="col-lg-12 text-center">

                                @if($errors->any())
                                    @foreach ($errors->all() as $error)


                                    @if($error == "The email address has already been taken.")
                                        <div class="error text-danger ">
                                            {{ 'The email address has already been taken, You can find out in student list or disabled student list' }}
                                        </div>
                                    @endif 
                                    @endforeach
                                @endif

                                @if ($errors->any())
                                     <div class="error text-danger ">{{ 'Something went wrong, please try again' }}</div>
                                @endif
                            </div>
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head">@lang('lang.personal') @lang('lang.info')</h4>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}"> 
                        <input type="hidden" name="id" id="id" value="{{$student->id}}">


                        <div class="row mb-20">
                            <div class="col-md-4">
                                <img src="{{ file_exists(@$student->student_photo) ? asset($student->student_photo) : asset('public/uploads/staff/demo/staff.jpg') }}" alt="Profile Pic" id="output" height="200px" width="200px"><br>
                                   @if ($errors->has('photo'))
                                        <center class="text-danger error-message invalid-select mb-10">{{ $errors->first('photo') }}</center>
                                    @endif
                                <br>

                                <span class="primary-btn-small-input">
                                    <label class="primary-btn small fix-gr-bg" for="photo">@lang('lang.browse')</label>
                                    <input type="file" class="d-none" value="{{ old('photo') }}" name="photo" id="photo" accept="image/*" onchange="loadFile(event)">
                                </span>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-40">
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" type="text" name="first_name" value="{{$student->first_name}}">
                                            <label>@lang('lang.first') @lang('lang.name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" type="text" name="last_name" value="{{$student->last_name}}">
                                            <label>@lang('lang.last') @lang('lang.name')</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-20">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender">
                                                <option data-display="@lang('lang.gender') *" value="">@lang('lang.gender') *</option>
                                                @foreach($genders as $gender)
                                                    @if(isset($student->gender_id))
                                                        <option value="{{$gender->id}}" {{$student->gender_id == $gender->id? 'selected': ''}}>{{$gender->base_setup_name}}</option>
                                                    @else
                                                        <option value="{{$gender->id}}">{{$gender->base_setup_name}}</option>
                                                    @endif
                                                @endforeach

                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('gender'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-20">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" id="startDate" type="text" name="date_of_birth" value="{{date('m/d/Y', strtotime($student->date_of_birth))}}" autocomplete="off">
                                                    <span class="focus-border"></span>
                                                    <label>@lang('lang.date_of_birth') <span>*</span></label>
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
                                    <div class="col-lg-6 mt-20">
                                        <div class="input-effect">
                                            <input oninput="emailCheck(this)" class="primary-input form-control{{ $errors->has('email_address') ? ' is-invalid' : '' }}" type="text" name="email_address" value="{{$student->email}}">
                                            <label>@lang('lang.email') @lang('lang.address') <span></span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('email_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email_address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 mt-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('matric_number') ? ' is-invalid' : '' }}" type="text" name="matric_number" value="{{$student->matric_number}}">
                                            <label>Matric Number</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('matric_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('matric_number') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-20">
                                        <div class="input-effect">
                                            <input oninput="phoneCheck(this)" class="primary-input form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" type="text" name="phone_number" value="{{$student->mobile}}">
                                            <label>@lang('lang.phone') @lang('lang.number')</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <div class="row mt-40 mb-20">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head">Departmental Details</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-20">
                            
                            <div class="col-lg-6">
                                <div class="input-effect" id="class-div">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" id="classSelectStudent">
                                        <option data-display="@lang('lang.class') *" value="">@lang('lang.class') *</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}" {{$student->class_id == $class->id? 'selected':''}}>{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_class_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('class'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="input-effect" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" name="section" id="sectionSelectStudent">
                                       <option data-display="@lang('lang.section') *" value="">@lang('lang.section') *</option>
                                       @if(isset($student->section_id))
                                       @foreach($student->sections as $section)
                                        <option value="{{$section->id}}" {{$student->section_id == $section->id? 'selected': ''}}>{{$section->section_name}}</option>
                                        @endforeach
                                       @endif
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>                            
                        </div>



                        <div class="row mt-40 mb-20">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head">Password</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-40 mb-20">
                            <div class="col-lg-6 mt-20">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" >
                                    <label>CHANGE PASSWORD</label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg submit">
                                    <span class="ti-check"></span>
                                    @lang('lang.update_student')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</section>



@endsection
@section('script')
<script>

        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
              var output = document.getElementById('output');
              output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
          };


        
</script>
<script src="{{asset('public/backEnd/')}}/js/st_addmision.js"></script>

@endsection