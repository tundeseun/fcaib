@extends('backEnd.master')
@section('title') 
Bulk Result Upload
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Bulk Result Upload</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">Bulk Result Upload</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3>@lang('lang.select_criteria')</h3>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-3 text-right mb-20">
                <a href="{{url('/public/backEnd/bulksample/results.xlsx')}}">
                    <button class="primary-btn tr-bg text-uppercase bord-rad">
                        Download Sample
                        <span class="pl ti-download"></span>
                    </button>
                </a>
            </div>
        </div>

    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'upload-result-store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_form']) }}
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
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <div class="box-body">      
                                        <br>           
                                        1. @lang('lang.point1')<br>
                                        2. @lang('lang.point2')<br>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        <div class="row mb-40 mt-30">

                            <div class="col-lg-4">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('session') ? ' is-invalid' : '' }}" name="session" required>
                                        @for ($i = 2000; $i <= date('Y'); $i++)
                                           <option>{{ $i }}/{{ $i+1 }}</option> 
                                        @endfor
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('session'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('session') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4" id="class-div">
                                <select class="w-100 niceSelect bb form-control {{ $errors->has('course') ? ' is-invalid' : '' }}" name="course" required>
                                    <option data-display="Course *" value="">Course *</option>
                                    @foreach($courses as $course)
                                    <option {{$course->id == request()->id ? 'selected readonly' : ''   }} title="{{$course->subject_name}}" value="{{$course->id}}">{{$course->subject_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('course'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('course') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-lg-4">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control {{ $errors->has('file') ? ' is-invalid' : '' }}" type="text" id="placeholderPhoto" placeholder="Excel file"
                                                readonly required>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('file'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="photo">@lang('lang.browse')</label>
                                            <input type="file" class="d-none" name="file" id="photo">
                                        </button>
                                    </div>
                                </div>
                            </div>
                                
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    Upload Results
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
