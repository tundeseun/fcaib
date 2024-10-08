@extends('backEnd.master')
@section('title') 
    Applicant @lang('lang.view')
@endsection
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   @endphp 
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Applicants Details</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="{{url('parentregistration/student-list')}}">@lang('lang.new') @lang('lang.registration')</a>
                    <a href="#">Applicants Details</a>
                </div>
            </div>
        </div>
    </section>
    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Start Student Meta Information -->
                    <div class="main-title">
                        <h3 class="mb-20">Applicants Details</h3>
                    </div>

                    <div class="student-meta-box">
                        <div class="student-meta-top"></div>
                        <img class="student-meta-img img-100" src="{{ file_exists(@$student_detail->student_photo) ? asset($student_detail->student_photo) : asset('public/uploads/staff/demo/staff.jpg') }}" alt="" style="min-height: 100px; max-height: 100px;">
                        <div class="white-box radius-t-y-0">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Names
                                    </div>
                                
                                    <div class="value">
                                        {{ucwords($student_detail->first_name.' '.$student_detail->last_name)}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Dept.
                                    </div>
                                    <div class="value">
                                        
                                            {{@$student_detail->class->class_name}}
                                           
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.section')
                                    </div>
                                    <div class="value">
                                        {{@$student_detail->section->section_name}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.gender')
                                    </div>
                                    <div class="value">
                                        {{$student_detail->gender !=""?$student_detail->gender->base_setup_name:""}}
                                    </div>
                                </div>
                            </div>
                             @if(moduleStatusCheck('Saas') == TRUE)
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.school')
                                    </div>
                                    <div class="value">
                                        {{@$student_detail->school->school_name}}
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.academic_year')
                                    </div>
                                    <div class="value">
                                        {{@$student_detail->academicYear->year}}
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- End Student Meta Information -->

                </div>

                <!-- Start Student Details -->
                <div class="col-lg-9 student-details up_admin_visitor">
                    

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Profile Tab -->
                        <div role="tabpanel" class="tab-pane fade  show active" id="studentProfile">
                            <div class="white-box">
                                <h4 class="stu-sub-head">@lang('lang.personal') @lang('lang.info')</h4>
                               

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.date_of_birth')
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                {{ !empty($student_detail->date_of_birth)? dateConvert($student_detail->date_of_birth):''}}  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.age')
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                {{@$student_detail->age}} @lang('lang.year')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.email')
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                {{$student_detail->student_email}}
                                            </div>
                                        </div>
                                    </div>
                                </div>                                

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.mobile')
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                {{$student_detail->student_mobile}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <h4 class="stu-sub-head mt-20">@lang('lang.guardian') @lang('lang.info')</h4>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.name')
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                {{ucwords($student_detail->guardian_name)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.mobile')
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                {{$student_detail->guardian_mobile}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.email')
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                {{$student_detail->guardian_email}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                Relationship
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                               @if($student_detail->guardian_relation == 'F')
                                               {{'Father'}}
                                               @elseif($student_detail->guardian_relation == 'M')
                                               {{'Mother'}}
                                               @else
                                               {{'Other'}}
                                               @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="single-info">
                                    <h4 class="stu-sub-head mt-20">Applicants Documents</h4>
                                    <div class="row">
                                        <div class="col">
                                            <a class="btn btn-sm btn-primary text-white p-2 my-2" target="_blank" href="{{url($student_detail->ssce_result)}}">View Applicants SSCE Result</a>
                                            <a class="btn btn-sm btn-primary text-white p-2 my-2" target="_blank" href="{{url($student_detail->utme_result)}}">View Applicants UTME Result</a>
                                            <a class="btn btn-sm btn-primary text-white p-2 my-2" target="_blank" href="{{url($student_detail->guarantors_letter)}}">View Applicants Guarantors Letter</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <h4 class="stu-sub-head mt-20">Actions</h4>
                                    <div class="row">
                                        <div class="col">
                                            <a class="btn btn-sm btn-success text-white p-2 my-2" onclick="deleteId({{$student_detail->id}});" class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#deleteStudentModal" data-id="{{$student_detail->id}}"><span class="ti-check"></span>Approve</a>
                                            <a class="btn btn-sm btn-danger text-white p-2 my-2" onclick="enableId({{$student_detail->id}});" class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#enableStudentModal" data-id="{{$student_detail->id}}"><span class="ti-trash"></span> Delete</a>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- End Profile Tab -->
                        <!-- delete document modal -->

                        <!-- delete document modal -->
                    </div>
                </div>
                <!-- End Student Details -->
            </div>


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
