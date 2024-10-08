@php

  $stid = 'App\SmStudent'::where('user_id',Auth::user()->id)->first()->id;

@endphp

@if(userPermission(1) )
<li >
    <a href="{{route('student-dashboard')}}">
        <span class="ti-dashboard"></span>
        @lang('lang.dashboard')
    </a>
</li>
@endif
@if(userPermission(48) )

<li  >
    <a href="{{route('student_noticeboard')}}">
        <span class="ti-announcement"></span>
        @lang('lang.notice_board')
    </a>
</li>
@endif


@if(userPermission(20) )
<li >
    <a href="#subMenuStudentFeesCollection" data-toggle="collapse" aria-expanded="false"
    class="dropdown-toggle" href="#">
        <span class="ti-bookmark-alt"></span>
        @lang('lang.fees')
    </a>
    <ul class="collapse list-unstyled" id="subMenuStudentFeesCollection">
        <li>
            <a href="{{route('student_fees')}}">@lang('lang.pay_fees')</a>
        </li>
        <li>
            <a href="{{route('student_paid_fees',$stid)}}">Paid Fees & Receipts</a>
        </li>
        
         <li>
            <a href="{{route('check-rrr-status-form')}}">Check RRR Status</a>
        </li>
    </ul>
</li>
@endif

@if(generalSetting()->hostel_booking != 0)
    @if(userPermission(55) )
    <li  >
        <a href="{{route('student_dormitory')}}">
            <span class="ti-home"></span>
            Hostel Booking
        </a>
    </li>
    @endif
@endif


@if(generalSetting()->course_registration != 0)
    @if(userPermission(49) )
    <li>
        <a href="{{route('course-registration')}}">
            <span class="ti-write"></span>
            Course Registration
        </a>
    </li>
    @endif
@endif

@if(userPermission(36) )
<li  >
    <a href="#subMenuStudentExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
    href="#">
        <span class="ti-pencil-alt"></span>
        @lang('lang.examinations')
    </a>
    <ul class="collapse list-unstyled" id="subMenuStudentExam">
        @if(userPermission(37) )
            <li  >
                <a href="{{route('student-result',$stid)}}">@lang('lang.result') </a>
            </li>
        @endif
        @if(userPermission(38) )
            <li  >
                <a href="{{route('student_exam_schedule')}}">@lang('lang.exam_schedule')</a>
            </li>
        @endif
    </ul>
</li>
@endif
@if(userPermission(45) )
<li  >
    <a href="#subMenuStudentOnlineExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
    href="#">
        <span class="ti-desktop"></span>
        @lang('lang.online_exam')
    </a>
    <ul class="collapse list-unstyled" id="subMenuStudentOnlineExam">

    @if(moduleStatusCheck('OnlineExam') ==false )
        @if(userPermission(46) )
            <li  >
                <a href="{{route('student_online_exam')}}">@lang('lang.active_exams')</a>
            </li>
        @endif


        @elseif(moduleStatusCheck('OnlineExam') == true )

        @if(userPermission(2046) )
        <li  > 
            <a href="{{route('om_student_online_exam')}}">  @lang('lang.active_exams') </a>
        </li>     
        @endif                           
                            
        @if(userPermission(2047) )                   
        <li  >                                            
            <a href=" {{route('om_student_view_result')}} ">  @lang('lang.view_result') </a>
        </li> 
        @endif                               
                            
        @if(userPermission(2048) )                  
        <li  >                                            
            <a href="{{route('student_pdf_exam')}} " class="active"> PDF @lang('lang.exam') </a>
        </li> 
        @endif                               
                            
        @if(userPermission(2049) )                   
        <li  >                                            
            <a href=" {{route('student_view_pdf_result')}} ">  PDF @lang('lang.exam') @lang('lang.result') </a>
        </li>  
        @endif

    @endif

    </ul>
</li>
@endif





 @include('chat::menu')
 
 <!-- Zoom Menu -->
                    @if(moduleStatusCheck('Zoom') == TRUE)
                       
                        @include('zoom::menu.Zoom')
                    @endif
                  
                    <!-- BBB Menu -->
                    @if(moduleStatusCheck('BBB') == true)
                        @include('bbb::menu.bigbluebutton_sidebar')
                    @endif

                    <!-- Jitsi Menu -->
                    @if(moduleStatusCheck('Jitsi')==true)
                        @include('jitsi::menu.jitsi_sidebar')
                    @endif
@if(userPermission(22) )
<li  >
    <a href="{{route('student_class_routine')}}">
        <span class="ti-calendar"></span>
        Class Routines
    </a>
</li>
@endif
@if(userPermission(11) )
<li >
    <a href="{{route('student-profile')}}">
        <span class="ti-user"></span>
        @lang('lang.my_profile')
    </a>
</li>
@endif
@if(Auth::user()->isGraduate())
<li  >
    <a href="{{route('transcript-application')}}">
        <span class="ti-printer"></span>
        Transcript Application
    </a>
</li>

<li  >
    <a href="{{route('statement-result')}}">
        <span class="ti-zip"></span>
        Statement of Result
    </a>
</li>
@endif