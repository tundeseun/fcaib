@extends('backEnd.master')
@section('title')
Transcript Application Details
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
            <h1>Transcript Application Details</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('transcript',$transcript->id)}}">Transcript Application Details</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="white-box">
                <h4 class="stu-sub-head">Applicants Information</h4>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Fullname
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->names}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Email Address
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->email}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Phone Number
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->phone_number}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Nationality
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->nationality}}
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="stu-sub-head mt-20">Applicants Educational Information</h4>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Department
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->department}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Entry Year
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->entry_year}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Graduation Year
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->graduation_year}}
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="stu-sub-head mt-20">Intended Institution Details</h4>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's Name
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->institution_name}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's Address
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->institution_address}}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's Country
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->institution_country}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's email
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->institution_email}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's Receiving Office/Officer
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            {{@$transcript->institution_office}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-30">
                    <a href="{{route('student-result', $transcript->student_id)}}" class="btn btn-sm btn-primary text-white m-2"><span class="ti-eye"></span> View Results</a>
                    @if($transcript->status == 0)
                    <a href="{{route('transcript-treated', $transcript->id)}}" class="btn btn-sm btn-primary text-white m-2"><span class="ti-check"></span> Mark as Treated</a>
                    @else
                    <a href="{{route('transcript-untreated', $transcript->id)}}" class="btn btn-sm btn-primary text-white m-2"><span class="ti-check"></span> Mark as Untreated</a>
                    @endif
                    @if($transcript->ssce !== null)
                    <a class="btn btn-sm btn-primary text-white m-2" target="_blank" href="{{url($transcript->ssce)}}">View Applicants SSCE Result</a>
                    @endif
                    @if($transcript->statement !== null)
                    <a class="btn btn-sm btn-primary text-white m-2" target="_blank" href="{{url($transcript->statement)}}">View Applicants Statement of Result</a>
                    @endif
                    <a class="btn btn-sm btn-primary text-white m-2" href="{{route('generate-transcript', $transcript->id)}}"><span class="ti-printer"></span> Generate Transcript</a>
                </div>
            </div>
    </div>
</section>

@endsection

