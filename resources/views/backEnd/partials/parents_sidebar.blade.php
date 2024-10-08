@if(userPermission(56) )
<li >
   <a href="{{route('parent-dashboard')}}">
       <span class="flaticon-resume"></span>
       @lang('lang.dashboard')
   </a>
</li>
@endif
@if(userPermission(66) )
   <li >
       <a href="#subMenuParentMyChildren" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-reading"></span>
           @lang('lang.my_children')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentMyChildren">
           

           @foreach($childrens as $children)
               <li>
                   <a href="{{route('my_children', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @endforeach
       </ul>
   </li>
@endif
@if(userPermission(71) )
   <li >
       <a href="#subMenuParentFees" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-wallet"></span>
           @lang('lang.fees')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentFees">
           @foreach($childrens as $children)
           @if(moduleStatusCheck('FeesCollection')== false )
               <li>
                   <a href="{{route('parent_fees', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @else
               <li>
                   <a href="{{route('feescollection/parent-fee-payment', [$children->id])}}">{{$children->full_name}}</a>
               </li>

           @endif
           @endforeach
       </ul>
   </li>
@endif
@if(userPermission(72) )
   <li >
       <a href="#subMenuParentClassRoutine" data-toggle="collapse" aria-expanded="false"
       class="dropdown-toggle">
           <span class="flaticon-calendar-1"></span>
           @lang('lang.class_routine')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentClassRoutine">
           @foreach($childrens as $children)
               <li>
                   <a href="{{route('parent_class_routine', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @endforeach
       </ul>
   </li>
@endif

@if(userPermission(97) )
   <li >
       <a href="#subMenuLessonPlan" data-toggle="collapse" aria-expanded="false"
       class="dropdown-toggle">
           <span class="flaticon-calendar-1"></span>
           @lang('lang.lesson')
       </a>
       <ul class="collapse list-unstyled" id="subMenuLessonPlan">
            @foreach($childrens as $children)           
             @if(userPermission(98) )
               <li  >
                  <a href="{{route('lesson-parent-lessonPlan',[$children->id])}}"> {{$children->full_name}}-Lesson plan</a>
               </li>
               @endif
               @if(userPermission(99) )
                 <li  >
                 <a href="{{route('lesson-parent-lessonPlan-overview',[$children->id])}}">  {{$children->full_name}}- Lesson plan overview</a>
               </li>
               @endif
           @endforeach
       </ul>
   </li>
@endif
@if(userPermission(73) )
   <li >
       <a href="#subMenuParentHomework" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-book"></span>
           @lang('lang.home_work')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentHomework">
           @foreach($childrens as $children)
               <li>
                   <a href="{{route('parent_homework', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @endforeach
       </ul>
   </li>
@endif
@if(userPermission(75) )
   <li >
       <a href="#subMenuParentAttendance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-authentication"></span>
           @lang('lang.attendance')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentAttendance">
           @foreach($childrens as $children)
               <li>
                   <a href="{{route('parent_attendance', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @endforeach
       </ul>
   </li>
@endif
@if(userPermission(76) )
   <li >
       <a href="#subMenuParentExamination" data-toggle="collapse" aria-expanded="false"
       class="dropdown-toggle">
           <span class="flaticon-test"></span>
           @lang('lang.exam')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentExamination">
           @foreach($childrens as $children)
               @if(userPermission(77) )
                   <li  >
                       <a href="{{route('parent_examination', [$children->id])}}">{{$children->full_name}}</a>
                   </li>
               @endif
               @if(userPermission(78) )
                   <li  >
                       <a href="{{route('parent_exam_schedule', [$children->id])}}">@lang('lang.exam_schedule')</a>
                   </li>
               @endif


               


               <hr>
           @endforeach
       </ul>
   </li>
@endif

@if (moduleStatusCheck('OnlineExam') == false)
    
    @if(userPermission(2016) )
    <li >
        <a href="#subMenuOnlineExam" data-toggle="collapse" aria-expanded="false"
        class="dropdown-toggle">
            <span class="flaticon-test"></span>
            @lang('lang.online') @lang('lang.exam')
        </a>
        <ul class="collapse list-unstyled" id="subMenuOnlineExam">
            @if(moduleStatusCheck('OnlineExam') == false ) 
                @foreach($childrens as $children) 
                    @if(userPermission(2018) )
                    <li  >
                        <a href="{{ route('parent_online_examination', [$children->id])}}">@lang('lang.online_exam') - {{$children->full_name}}</a>
                    </li>
                    @endif
                    @if(userPermission(2017) )
                        <li  >
                        <a href="{{ route('parent_online_examination_result', [$children->id])}}">@lang('lang.online_exam') @lang('lang.result') - {{$children->full_name}}</a>
                    </li>
                @endif
                <hr>
                @endforeach

            @endif      
            </ul>
        </li>
        @endif 
@endif
    @if (moduleStatusCheck('OnlineExam') == true)
        
        @if(userPermission(2101) )
        <li >
            <a href="#subMenuOnlineExamModule" data-toggle="collapse" aria-expanded="false"
            class="dropdown-toggle">
                <span class="flaticon-test"></span>
                @lang('lang.online') @lang('lang.exam')
            </a>
            <ul class="collapse list-unstyled" id="subMenuOnlineExamModule">
                
                
                    @foreach($childrens as $children)
                        @if(userPermission(2001) )                           
                            <li >                                            
                                <a href="{{route('om_parent_online_examination',$children->id)}}">  @lang('lang.online_exam') - {{$children->full_name}} </a>
                            </li>  
                        @endif
                        @if(userPermission(2002) )                           
                            <li >                                            
                                <a href="{{route('om_parent_online_examination_result',$children->id)}}">  @lang('lang.online_exam') @lang('lang.result') - {{$children->full_name}} </a>
                            </li>  
                        @endif
                        @if(userPermission(2103) )                           
                            <li >                                            
                                <a href="{{route('parent_pdf_exam',$children->id)}}">  @lang('lang.pdf_exam') - {{$children->full_name}} </a>
                            </li>  
                        @endif                                   
                        @if(userPermission(2104) )   
                            <li > 
                                <a href="{{route('parent_view_pdf_result',$children->id)}}"> @lang('lang.pdf_exam') @lang('lang.result') - {{$children->full_name}} </a>
                            </li> 
                        @endif 
                                            
                        <hr>
                    @endforeach
        
                
                </ul>
            </li>
            @endif 
    @endif 


@if(userPermission(80) )
   <li >
       <a href="#subMenuParentLeave" data-toggle="collapse" aria-expanded="false"
       class="dropdown-toggle">
           <span class="flaticon-test"></span>
           @lang('lang.leave')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentLeave">
           @foreach($childrens as $children)
               <li >
                   <a href="{{route('parent_leave', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @endforeach
           @if(userPermission(81) )
               <li  >
                   <a href="{{route('parent-apply-leave')}}">@lang('lang.apply_leave')</a>
               </li>
           @endif
           @if(userPermission(82) )
               <li  >
                   <a href="{{route('parent-pending-leave')}}">@lang('lang.pending_leave_request')</a>
               </li>
           @endif
           
       </ul>
   </li>
@endif
@if(userPermission(85) )
   <li >
       <a href="{{route('parent_noticeboard')}}">
           <span class="flaticon-poster"></span>
           @lang('lang.notice_board')
       </a>
   </li>
@endif
@if(userPermission(86) )
   <li >
       <a href="#subMenuParentSubject" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-reading-1"></span>
           @lang('lang.subjects')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentSubject">
           @foreach($childrens as $children)
               <li>
                   <a href="{{route('parent_subjects', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @endforeach
       </ul>
   </li>
@endif
@if(userPermission(87) )
   <li >
       <a href="#subMenuParentTeacher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-professor"></span>
           @lang('lang.teacher_list')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentTeacher">
           @foreach($childrens as $children)
               <li>
                   <a href="{{route('parent_teacher_list', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @endforeach
       </ul>
   </li>
@endif
@if(userPermission(88) )
   <li >
       <a href="#subMenuStudentLibrary" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
       href="#">
           <span class="flaticon-book-1"></span>
           @lang('lang.library')
       </a>
       <ul class="collapse list-unstyled" id="subMenuStudentLibrary">
           @if(userPermission(89) )
               <li >
                   <a href="{{route('parent_library')}}"> @lang('lang.book_list')</a>
               </li>
           @endif
           @if(userPermission(90) )
               <li >
                   <a href="{{route('parent_book_issue')}}">@lang('lang.book_issue')</a>
               </li>
           @endif
       </ul>
   </li>
@endif
@if(userPermission(91) )
   <li >
       <a href="#subMenuParentTransport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-bus"></span>
           @lang('lang.transport')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentTransport">
           @foreach($childrens as $children)
               <li>
                   <a href="{{route('parent_transport', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @endforeach
       </ul>
   </li>
@endif
@if(userPermission(92) )
   <li >
       <a href="#subMenuParentDormitory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-hotel"></span>
           @lang('lang.dormitory_list')
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentDormitory">
           @foreach($childrens as $children)
               <li>
                   <a href="{{route('parent_dormitory_list', [$children->id])}}">{{$children->full_name}}</a>
               </li>
           @endforeach
       </ul>
   </li>
@endif

<!-- chat module sidebar -->

 @if(userPermission(910) )
<li  >
    <a href="#subMenuChat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <span class="flaticon-test"></span>
        @lang('lang.chat')
    </a>
    <ul class="collapse list-unstyled" id="subMenuChat">
        @if(userPermission(911) )
        <li   >
            <a href="{{ route('chat.index') }}">@lang('lang.chat') @lang('lang.box')</a>
        </li>
        @endif

        @if(userPermission(913) )
        <li  >
            <a href="{{ route('chat.invitation') }}">@lang('lang.invitation')</a>
        </li>
        @endif

        @if(userPermission(914) )
            <li  >
                <a href="{{ route('chat.blocked.users') }}">@lang('lang.blocked') @lang('lang.user')</a>
            </li>
        @endif

     
    </ul>
</li>
@endif

<!-- BBB Menu  -->   
     @if(moduleStatusCheck('BBB') == true)
        @if(userPermission(105) )
                <li >
                <a href="#bigBlueButtonMenu" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle">
                    <span class="flaticon-reading"></span>
                @lang('lang.bbb')
                </a>
                            <ul class="collapse list-unstyled" id="bigBlueButtonMenu">
                                @if(userPermission(106) )
                                    <li  >
                                        <a href="{{ route('bbb.virtual-class')}}">@lang('lang.virtual_class')</a>
                                    </li>
                                @endif
                                @if(userPermission(107) )
                                    <li  >
                                        <a href="{{ route('bbb.meetings') }}">@lang('lang.virtual_meeting')</a>
                                    </li>
                                @endif

                                @if(userPermission(115) )
                                <li  >
                                    <a href="{{ route('bbb.parent.class.recording.list') }}"> @lang('lang.class') @lang('lang.record') @lang('lang.list')</a>
                                </li>
                                @endif
                            
                                @if(userPermission(116) )
                                    <li  >
                                        <a href="{{ route('bbb.parent.meeting.recording.list') }}"> @lang('lang.meeting') @lang('lang.record') @lang('lang.list')</a>
                                    </li>
                                @endif

                            </ul>
                </li>

        @endif    

@endif
<!-- BBB  Menu end -->   
<!-- Jitsi Menu  -->      
    @if(moduleStatusCheck('Jitsi')==true)
     @if(userPermission(108) )
        <li >
                <a href="#subMenuJisti" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle">
                    <span class="flaticon-reading"></span>
                @lang('lang.jitsi')
                </a>
                <ul class="collapse list-unstyled" id="subMenuJisti">
                    @if(userPermission(109) )
                        <li  >
                            <a href="{{ route('jitsi.virtual-class')}}">@lang('lang.virtual_class')</a>
                        </li>
                    @endif
                    @if(userPermission(110) )
                        <li  >
                            <a href="{{ route('jitsi.meetings') }}">@lang('lang.virtual_meeting')</a>
                        </li>
                    @endif
                
                </ul>
        </li>

    @endif        
@endif
<!-- jitsi Menu end -->

<!-- Zomm Menu  start -->
     @if(moduleStatusCheck('Zoom') == TRUE)

        @if(userPermission(100) )
            <li >
                <a href="#zoomMenu" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle">
                    <span class="flaticon-reading"></span>
                @lang('lang.zoom')
                </a>
                <ul class="collapse list-unstyled" id="zoomMenu">
                    @if(userPermission(101) )
                        <li  >
                            <a href="{{ route('zoom.virtual-class')}}">@lang('lang.virtual_class')</a>
                        </li>
                    @endif
                    @if(userPermission(103) )
                        <li  >
                            <a href="{{ route('zoom.meetings') }}">@lang('lang.virtual_meeting')</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif
@endif
<!-- zoom Menu  -->