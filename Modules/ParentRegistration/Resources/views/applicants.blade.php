@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Manage Applicants</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.new') @lang('lang.registration')</a>
                <a href="#">Applicants List</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('message-success') != "")
                        @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                        @endif
                    @endif
                    <div class="white-box">
                        <form class='form-horizontal' action ="{{route('parentregistration-applicants-search')}}" method='POST' enctype='multipart/form-data' id ='parent-registration'>
                            @csrf
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-4 mt-30-md" id="class-div">
                                    <select class="w-100 niceSelect bb form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" name="class">
                                        <option data-display="@lang('lang.select_class')" value="">@lang('lang.select_class')</option>
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
                                <div class="col-lg-4 mt-30-md" id="section-div">
                                    <select class="w-100 niceSelect bb form-control{{ $errors->has('current_section') ? ' is-invalid' : '' }}" name="section">
                                        <option data-display="Entry Level" value="">Entry Level</option>
                                        <option value="1">Utme Entry (Level 100)</option>
                                        <option value="2">Direct Entry (Level 200)</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 mt-30-md">
                                    <div class="form-group input-group">
                                        <input class="primary-input form-control" type="number" name='cut_off_mark' placeholder="Cut Off Mark" value="{{old('cut_off_mark')}}" />
                                    </div>
                                    @if($errors->has('cut_off_mark'))
                                    <div class="text-danger error-message invalid-select mb-10">{{ $errors->first('cut_off_mark') }}</div>
                                    @endif
                                </div>
                            </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
            @if (@$students)
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">Applicants List ({{@$students ? @$students->count() : 0}})</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="" cellspacing="0" width="100%">
                                <thead>
                                    @if(session()->has('message-success') != "" ||
                                    session()->get('message-danger') != "")
                                    <tr>
                                        <td colspan="10">
                                            @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message-success') }}
                                            </div>
                                            @elseif(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>@lang('lang.name')</th>
                                        <th>UTME Score</th>
                                        <th>@lang('lang.class')</th>
                                        <th>@lang('lang.section')</th>
                                        <th>@lang('lang.academic_year')</th>
                                        <th>@lang('lang.actions')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach(@$students as $student)
                                    <tr>
                                        <td>{{ucwords($student->first_name.' '.$student->last_name)}}</td>
                                        <td>{{@$student->utme_score}}</td>
                                        <td>{{@$student->class->class_name}}</td>
                                        <td>{{@$student->section->section_name}}</td>
                                        <td>{{@$student->academicYear->year}}</td>
                                        <td>

                                                @if(userPermission(544))

                                                <a class="btn btn-primary btn-sm" href="{{route('parentregistration/student-view', [$student->id])}}"  data-id="{{$student->id}}"  ><span class="ti-eye"></span> View</a>

                                                @endif

                                                @if(userPermission(545))

                                                 <a onclick="deleteId({{$student->id}});" class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#deleteStudentModal" data-id="{{$student->id}}"  ><span class="ti-check"></span> Approve</a>
                                                 @endif

                                                 @if(userPermission(546))

                                                 <a onclick="enableId({{$student->id}});" class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#enableStudentModal" data-id="{{$student->id}}"><span class="ti-trash"></span> Delete</a>
                                                 @endif

                                        </td>
                                    </tr>
                                    
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    </div>
</section>

<div class="modal fade admin-query" id="deleteStudentModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Applicant @lang('lang.approve')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_approve')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['route' => 'parentregistration/student-approve', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                <input type="hidden" name="id" value="{{@$student->id}}" id="student_delete_i">  {{-- using js in main.js --}}
                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.approve')</button>
                     {{ Form::close() }}
                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade admin-query" id="enableStudentModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') Applicant</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['route' => 'parentregistration/student-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" value="" id="student_enable_i">  {{-- using js in main.js --}}
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
