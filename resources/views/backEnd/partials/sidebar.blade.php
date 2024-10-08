@php
$school_config = schoolConfig();
$isSchoolAdmin = Session::get('isSchoolAdmin');
@endphp
<nav id="sidebar">
    <div class="sidebar-header update_sidebar" style="background: #07294D;">
        <a href="{{url('/')}}" >
            @if(! is_null($school_config->logo))
                <img src="{{ asset($school_config->logo)}}" alt="logo">
            @else
                <img src="{{ asset('public/uploads/settings/logo.png')}}" alt="logo">
            @endif
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>
    @if(Auth::user()->is_saas == 0)

        <ul class="list-unstyled components" id="sidebar_menu">
            @if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 )
                @if(userPermission(1))
                    <li>
                        @if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator=="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1)
                            <a href="{{route('superadmin-dashboard')}}" id="superadmin-dashboard">
                        @else
                            <a href="{{route('admin-dashboard')}}" id="admin-dashboard">
                        @endif
                            <span class="ti-dashboard"></span>@lang('lang.dashboard')
                            </a>
                    </li>
                @endif
            @endif

            @if(Auth::user()->role_id == 4)
                    <li>
                        <a href="{{route('course-list')}}">
                        <span class="ti-blackboard"></span>Assigned Courses
                        </a>
                    </li>
                    <li>
                        <a href="{{route('course-list')}}">
                        <span class="ti-export"></span>Upload Results
                        </a>
                    </li>
                    <li>
                        <a href="{{route('lecturer-online-exam-results')}}">
                        <span class="ti-rss-alt"></span>Online Exam Results
                        </a>
                    </li>

            @endif

            @if(Auth::user()->role_id == 4 && Auth::user()->isHOD())
                    <li >
                            <a href="#subMenuHOD" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-files"></span>
                                Head of Dept. Menu
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuHOD">
                                    <li >
                                        <a href="{{route('department-results')}}">Pending Dept. Results</a>
                                    </li>
                                    <li >
                                        <a href="{{route('accepted-department-results')}}">Accepted Dept. Results</a>
                                    </li>
                                    <li >
                                        <a href="{{route('rejected-department-results')}}">Rejected Dept. Results</a>
                                    </li>
                            </ul>
                    </li>
            @endif



            @if(moduleStatusCheck('InfixBiometrics')== TRUE && Auth::user()->role_id == 1)
                @include('infixbiometrics::menu.InfixBiometrics')
            @endif

            {{-- Parent Registration Menu --}}
            
            @if(moduleStatusCheck('ParentRegistration')== TRUE)
             @include('parentregistration::menu.ParentRegistration')
            @endif


            {{-- Saas Subscription Menu --}}
            @if(moduleStatusCheck('SaasSubscription')== TRUE && Auth::user()->is_administrator != "yes")
                @include('saassubscription::menu.SaasSubscriptionSchool')
            @endif
            
            {{-- Saas Module Menu --}}
            @if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator =="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1 )
                @include('saas::menu.Saas')
            @else
      
            @include('menumanage::menu.sidebar')

                @if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 )
                   


                   
                        {{-- admin_section --}}
               




                    {{-- student_information --}}
                    @if(userPermission(61) )
                        <li >
                            <a href="#subMenuStudent" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-files"></span>
                                @lang('lang.student_information')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuStudent">
                                @if(userPermission(64)  )
                                    <li >
                                        <a href="{{route('student_list')}}"> @lang('lang.student_list')</a>
                                    </li>
                                @endif



                                @if(userPermission(83)  )
                                    <li >
                                        <a href="{{route('disabled_student')}}">Suspended Students</a>
                                    </li>
                                @endif
                                @if(userPermission(663)  )
                                    <li >
                                        <a href="{{route('all-student-export')}}">@lang('lang.student') @lang('lang.export')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if(userPermission(123) )
                    <li >
                            <a href="#subMenuX" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-zip"></span>
                                Transcript Applications
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuX">
                                    <li>
                                        <a href="{{route('transcript-applications')}}">Untreated Applications</a>
                                    </li>
                                    <li>
                                        <a href="{{route('transcript-uapplications')}}">Treated Applications</a>
                                    </li>
                            </ul>
                        </li>
                    @endif
                    
                    @if(userPermission(123) )
                    <li >
                            <a href="#subMenuY" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-printer"></span>
                                Statement of Results
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuY">
                                    <li>
                                        <a href="{{route('statement-result-untreated')}}">Untreated Applications</a>
                                    </li>
                                    <li>
                                        <a href="{{route('statement-result-treated')}}">Treated Applications</a>
                                    </li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->is_administrator=="yes")
                    @endif
                    {{-- academics --}}
                    @if(userPermission(245)  )
                        <li  >
                            <a href="#subMenuAcademic" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="ti-write"></span>
                                @lang('lang.academics')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAcademic">
                                <li>
                                    <a href="{{route('upload-results')}}">Bulk Result Upload</a>
                                </li>
                                <li>
                                    <a href="{{route('upload-graduands')}}">Upload Graduands List</a>
                                </li>
                                
                                @if(userPermission(253) )
                                    <li  >
                                        <a href="{{route('manage-documents')}}"> Documents/Forms</a>
                                    </li>
                                @endif
                                @if(userPermission(265) )
                                    <li  >
                                        <a href="{{route('section')}}"> Level</a>
                                    </li>
                                @endif
                                @if(userPermission(261) )
                                    <li  >
                                        <a href="{{route('class')}}"> @lang('lang.class')</a>
                                    </li>
                                @endif
                                @if(userPermission(257) )
                                    <li  >
                                        <a href="{{route('subject')}}"> @lang('lang.subjects')</a>
                                    </li>
                                @endif
                                @if(userPermission(250) )
                                    <li  >
                                        <a href="{{route('assign_subject_create')}}"> @lang('lang.assign_subject')</a>
                                    </li>
                                @endif
                                @if(userPermission(273) )
                                    <li  >
                                        <a href="{{route('class-time')}}"> @lang('lang.class_time_setup')</a>
                                    </li>
                                @endif
                                @if(userPermission(246) )
                                    <li  >
                                        <a href="{{route('class_routine_new')}}"> Time Table</a>
                                    </li>
                                @endif
                                @if(userPermission(246) )
                                    <li  >
                                        <a href="{{route('class-room')}}"> Class Rooms</a>
                                    </li>
                                @endif
                            <!-- only for teacher -->
                                @if(Auth::user()->role_id == 4)
                                    <li>
                                        <a href="{{route('view-teacher-routine')}}">@lang('lang.view') @lang('lang.class_routine')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- FeesCollection --}}
                    @if(moduleStatusCheck('FeesCollection')== TRUE)
                        @include('feescollection::menu.FeesCollection')
                    @else
                        @if(userPermission(108) )
                            <li >
                                <a href="#subMenuFeesCollection" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <span class="ti-bookmark-alt"></span>
                                    Fees Management
                                </a>
                                <ul class="collapse list-unstyled" id="subMenuFeesCollection">
                                    @if(userPermission(123) )
                                        <li  >
                                            <a href="{{route('fees_group')}}"> @lang('lang.fees_group')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(127) )
                                        <li  >
                                            <a href="{{route('fees_type')}}"> @lang('lang.fees_type')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(131) )
                                        <li  >
                                            <a href="{{route('fees-master')}}"> @lang('lang.fees_master')</a>
                                        </li>
                                    @endif
                                    
                                    @if(userPermission(109) )
                                        <li  >
                                            <a href="{{route('collect_fees')}}"> @lang('lang.collect_fees')</a>
                                        </li>
                                    @endif
                                   
                                    @if(userPermission(113) )
                                        <li  >
                                            <a href="{{route('search_fees_payment')}}"> @lang('lang.search_fees_payment')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(116) )
                                        <li  >
                                            <a href="{{route('search_fees_due')}}"> @lang('lang.search_fees_due')</a>
                                        </li>
                                    @endif

                                    @if(userPermission(136) )
                                        <li  >
                                            <a href="{{route('fees_forward')}}"> @lang('lang.fees_forward')</a>
                                        </li>
                                    @endif

                                    @if(userPermission(383) )
                                        <li >
                                            <a href="{{route('transaction_report')}}">@lang('lang.collection') @lang('lang.report')</a>
                                        </li>
                                    @endif
                                 
                                    {{-- @if(userPermission(840))
                                    <li >
                                        <a href="#subMenuFeesReport" data-toggle="collapse" aria-expanded="false"
                                           class="dropdown-toggle">
                                            @lang('lang.report')
                                        </a>
                                        <ul class="collapse list-unstyled" id="subMenuFeesReport">
                                            @if(userPermission(383))
                                                <li >
                                                    <a href="{{route('transaction_report')}}">@lang('lang.collection') @lang('lang.report')</a>
                                                </li>
                                           @endif
                                         
                                        </ul>
                                    </li>
                                    @endif --}}
                                </ul>
                            </li>
                        @endif
                    @endif


                    
                @if(moduleStatusCheck('BulkPrint')== TRUE)
                    @include('bulkprint::menu.bulk_print_sidebar')
                @endif

                    {{-- accounts --}}
                    @if(userPermission(137) )
                        <li >
                            <a href="#subMenuAccount" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-bar-chart-alt"></span>
                                @lang('lang.accounts')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAccount">
                                @if(userPermission(148) )
                                    <li  >
                                        <a href="{{route('chart-of-account')}}"> @lang('lang.chart_of_account')</a>
                                    </li>
                                @endif
                                @if(userPermission(156) )
                                    <li  >
                                        <a href="{{route('bank-account')}}"> @lang('lang.bank_account')</a>
                                    </li>
                                @endif
                                @if(userPermission(139) )
                                    <li  >
                                        <a href="{{route('add_income')}}"> @lang('lang.income')</a>
                                    </li>
                                @endif
                                @if(userPermission(138) )
                                    <li  >
                                        <a href="{{route('profit')}}"> @lang('lang.profit') @lang('lang.&') @lang('lang.loss')</a>
                                    </li>
                                @endif
                                @if(userPermission(143) )
                                    <li  >
                                        <a href="{{route('add-expense')}}"> @lang('lang.expense')</a>
                                    </li>
                                @endif
                                {{-- @if(userPermission(147))
                                    <li>
                                        <a href="{{route('search_account')}}"> @lang('lang.search')</a>
                                    </li>
                                @endif --}}
                                @if(userPermission(704) )
                                    <li  >
                                        <a href="{{route('fund-transfer')}}">@lang('lang.fund') @lang('lang.transfer')</a>
                                    </li>
                                @endif
                                @if(userPermission(700) )
                                    <li >
                                        <a href="#subMenuAccountReport" data-toggle="collapse" aria-expanded="false"
                                           class="dropdown-toggle">
                                            @lang('lang.report')
                                        </a>
                                        <ul class="collapse list-unstyled" id="subMenuAccountReport">
                                            @if(userPermission(701) )
                                                <li >
                                                    <a href="{{route('fine-report')}}"> @lang('lang.fine') @lang('lang.report')</a>
                                                </li>
                                            @endif
                                            @if(userPermission(702) )
                                                <li >
                                                    <a href="{{route('accounts-payroll-report')}}"> @lang('lang.payroll') @lang('lang.report')</a>
                                                </li>
                                            @endif
                                            @if(userPermission(703) )
                                                <li >
                                                    <a href="{{route('transaction')}}"> @lang('lang.transaction')</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    {{-- human_resource --}}
                    @if(userPermission(160) )
                        <li >
                            <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-user"></span>
                                @lang('lang.human_resource')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuHumanResource">
                                @if(userPermission(180) )
                                    <li  >
                                        <a href="{{route('designation')}}"> @lang('lang.designation')</a>
                                    </li>
                                @endif
                                @if(userPermission(184) )
                                    <li >
                                        <a href="{{route('department')}}"> @lang('lang.department')</a>
                                    </li>
                                @endif
                                @if(userPermission(162) )
                                    <li >
                                        <a href="{{route('addStaff')}}"> @lang('lang.add')  @lang('lang.staff') </a>
                                    </li>
                                @endif
                                @if(userPermission(161) )
                                    <li >
                                        <a href="{{route('staff_directory')}}"> @lang('lang.staff_directory')</a>
                                    </li>
                                @endif
                                @if(userPermission(165) )
                                    <li >
                                        <a href="{{route('staff_attendance')}}"> @lang('lang.staff_attendance')</a>
                                    </li>
                                @endif
                                @if(userPermission(169) )
                                    <li >
                                        <a href="{{route('staff_attendance_report')}}"> @lang('lang.staff_attendance_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(170) )
                                    <li >
                                        <a href="{{route('payroll')}}"> @lang('lang.payroll')</a>
                                    </li>
                                @endif
                                @if(userPermission(178) )
                                    <li >
                                        <a href="{{route('payroll-report')}}"> @lang('lang.payroll_report')</a>
                                    </li>
                                @endif

                                @if(userPermission(178))
                               
                               @endif
                            </ul>
                        </li>
                    @endif

                    {{-- leave --}}
                    @if(userPermission(188) )
                        <li >
                            <a href="#subMenuLeaveManagement" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-calendar"></span>
                                @lang('lang.leave')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuLeaveManagement">
                                @if(userPermission(203) )
                                    <li  >
                                        <a href="{{route('leave-type')}}"> @lang('lang.leave_type')</a>
                                    </li>
                                @endif
                                @if(userPermission(199) )
                                    <li  >
                                        <a href="{{route('leave-define')}}"> @lang('lang.leave_define')</a>
                                    </li>
                                @endif
                                @if(userPermission(189) )
                                    <li  >
                                        <a href="{{route('approve-leave')}}">@lang('lang.approve_leave_request')</a>
                                    </li>
                                @endif
                                @if(userPermission(196) )
                                    <li  >
                                        <a href="{{route('pending-leave')}}">@lang('lang.pending_leave_request')</a>
                                    </li>
                                @endif
                                @if (Auth::user()->role_id!=1)

                                    @if(userPermission(193) )
                                        <li  >
                                            <a href="{{route('apply-leave')}}">@lang('lang.apply_leave')</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </li>
                    @endif


                    {{-- Chat --}}
                    @include('chat::menu')

                    {{-- Examination --}}
                    @if(userPermission(207) )
                        <li >
                            <a href="#subMenuExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="ti-pencil-alt"></span>
                                @lang('lang.examination')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuExam">
                                @if(userPermission(225) )
                                    <li   >
                                        <a href="{{route('marks-grade')}}"> @lang('lang.marks_grade')</a>
                                    </li>
                                @endif

                                @if(userPermission(217) )
                                    <li   >
                                        <a href="{{route('exam_schedule_create',[0,0])}}"> @lang('lang.exam_schedule')</a>
                                    </li>
                                @endif
                                @if(userPermission(221) )
                                    <li   >
                                        <a href="{{route('exam_attendance')}}">Exam Attendance sheet</a>
                                    </li>
                                @endif

                                {{-- @if(userPermission(230))
                                    <li>
                                        <a href="{{route('question-group')}}">@lang('lang.question_group')</a>
                                    </li>
                                @endif
                                @if(userPermission(234))
                                    <li>
                                        <a href="{{route('question-bank')}}">@lang('lang.question_bank')</a>
                                    </li>
                                @endif
                                @if(userPermission(238))
                                    <li>
                                        <a href="{{route('online-exam')}}">@lang('lang.online_exam')</a>
                                    </li>
                                @endif --}}

                                <li>
                                    <a href="#examSettings" data-toggle="collapse" aria-expanded="false"
                                       class="dropdown-toggle">
                                        @lang('lang.settings')
                                    </a>
                                    <ul class="collapse list-unstyled" id="examSettings">
                                        @if(userPermission(436) )
                                            <li  >
                                                <a href="{{route('custom-result-setting')}}">@lang('lang.setup') @lang('lang.exam') @lang('lang.rule')</a>
                                            </li>
                                        @endif

                                        @if(userPermission(706) )
                                            <li  >
                                                <a href="{{route('exam-settings')}}">@lang('lang.format') @lang('lang.settings')</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>

                            </ul>
                        </li>
                    @endif

                    {{-- online Exam --}}
                    
                    @if(moduleStatusCheck('OnlineExam')== true)
                        @include('onlineexam::menu_onlineexam')
                    @else
                        @if(userPermission(875) )
                            <li >
                                <a href="#subMenuOnlineExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <span class="ti-desktop"></span>
                                    @lang('lang.online_exam')
                                </a>
                                <ul class="collapse list-unstyled" id="subMenuOnlineExam">
                                    @if(userPermission(230) )
                                        <li  >
                                            <a href="{{route('question-group')}}">@lang('lang.question_group')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(234) )
                                        <li  >
                                            <a href="{{route('question-bank')}}">@lang('lang.question_bank')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(238) )
                                        <li  >
                                            <a href="{{route('online-exam')}}">@lang('lang.online_exam')</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif


                    {{-- Communicate --}}
                    @if(userPermission(286) )
                        <li >
                            <a href="#subMenuCommunicate" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-comments"></span>
                                @lang('lang.communicate')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuCommunicate">
                                @if(userPermission(287) )
                                    <li   >
                                        <a href="{{route('notice-list')}}">@lang('lang.notice_board')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('Saas') == true && Auth::user()->is_administrator != "yes" )
                                    <li>
                                        <a href="{{route('administrator-notice')}}">@lang('lang.administrator') @lang('lang.notice')</a>
                                    </li>
                                @endif
                                @if(userPermission(291) )
                                    <li   >
                                        <a href="{{route('send-email-sms-view')}}">@lang('lang.send_email')</a>
                                    </li>
                                @endif
                                @if(userPermission(293) )
                                    <li   >
                                        <a href="{{route('email-sms-log')}}">@lang('lang.email_sms_log')</a>
                                    </li>
                                @endif
                                @if(userPermission(294) )
                                    <li   >
                                        <a href="{{route('event')}}">@lang('lang.event')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('Saas')== FALSE)
                                    @if(userPermission(710) )
                                    <li   >
                                        <a href="{{route('sms-template-new')}}">@lang('lang.sms') @lang('lang.template')</a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                        </li>
                    @endif



                    {{-- Inventory --}}
                    @if(userPermission(315) )
                        <li >
                            <a href="#subMenuInventory" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-archive"></span>
                                @lang('lang.inventory')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuInventory">
                                @if(userPermission(316) )
                                    <li  >
                                        <a href="{{route('item-category')}}"> @lang('lang.item_category')</a>
                                    </li>
                                @endif
                                @if(userPermission(320) )
                                    <li  >
                                        <a href="{{route('item-list')}}"> @lang('lang.item_list')</a>
                                    </li>
                                @endif
                                @if(userPermission(324) )
                                    <li  >
                                        <a href="{{route('item-store')}}"> @lang('lang.item_store')</a>
                                    </li>
                                @endif
                                @if(userPermission(328) )
                                    <li  >
                                        <a href="{{route('suppliers')}}"> @lang('lang.supplier')</a>
                                    </li>
                                @endif
                                @if(userPermission(332) )
                                    <li  >
                                        <a href="{{route('item-receive')}}"> @lang('lang.item_receive')</a>
                                    </li>
                                @endif
                                @if(userPermission(334) )
                                    <li  >
                                        <a href="{{route('item-receive-list')}}"> @lang('lang.item_receive_list')</a>
                                    </li>
                                @endif
                                @if(userPermission(339) )
                                    <li  >
                                        <a href="{{route('item-sell-list')}}"> @lang('lang.item_sell')</a>
                                    </li>
                                @endif
                                @if(userPermission(345) )
                                    <li  >
                                        <a href="{{route('item-issue')}}"> @lang('lang.item_issue')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif



                    {{-- Dormitory --}}
                    @if(userPermission(362) )
                        <li >
                            <a href="#subMenuDormitory" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-home"></span>
                                Hostel Management
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuDormitory">
                                @if(userPermission(367) )
                                    <li  >
                                        <a href="{{route('dormitory-list')}}"> Hostels</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Reports --}}
                    @if(userPermission(376) )
                        <li >
                            <a href="#subMenusystemReports" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-pie-chart"></span>
                                @lang('lang.reports')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenusystemReports">

                                @if(userPermission(378) )
                                    <li  >
                                        <a href="{{route('student_history')}}">@lang('lang.student_history')</a>
                                    </li>
                                @endif
                                @if(userPermission(379) )
                                    <li  >
                                        <a href="{{route('student_login_report')}}">@lang('lang.student_login_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(381) )
                                    <li  >
                                        <a href="{{route('fees_statement')}}">@lang('lang.fees_statement')</a>
                                    </li>
                                @endif
                                @if(userPermission(382) )
                                    <li  >
                                        <a href="{{route('balance_fees_report')}}">@lang('lang.balance_fees_report')</a>
                                    </li>
                                @endif


                                @if(userPermission(394) )
                                    <li  >
                                        <a href="{{route('user_log')}}">@lang('lang.user_log')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                  
                    {{-- UserManagement --}}
                    @if(userPermission(417) )
                        <li  >
                            <a href="#subMenuUserManagement" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-panel"></span>
                                @lang('lang.role') @lang('lang.&') @lang('lang.permission')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuUserManagement">
                                @if(userPermission(585) )
                                    <li  >
                                        <a href="{{route('rolepermission/role')}}">@lang('lang.role')</a>
                                    </li>
                                @endif
                                @if(userPermission(421) )
                                    <li  >
                                        <a href="{{route('login-access-control')}}">@lang('lang.login_permission')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- System Settings --}}
                    @if(userPermission(398) )
                        <li  >
                            <a href="#subMenusystemSettings" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-settings"></span>
                                @lang('lang.system_settings')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenusystemSettings">
                                   
                                @if((moduleStatusCheck('Saas')== TRUE) && (auth()->user()->is_administrator=="yes"))
                                    <li>
                                        <a href="{{route('school-general-settings')}}"> @lang('lang.general_settings')</a>
                                    </li>
                                @else
                                    @if(userPermission(405)  )

                                        <li  >
                                            <a href="{{route('general-settings')}}"> @lang('lang.general_settings')</a>
                                        </li>
                                    @endif
                                @endif
                                {{-- @if(userPermission(417))
                                    <li>
                                        <a href="{{route('rolepermission/role')}}">@lang('lang.role')</a>
                                    </li>
                                @endif
                                @if(userPermission(421))
                                    <li>
                                        <a href="{{route('login-access-control')}}">@lang('lang.login_permission')</a>
                                    </li>
                                @endif --}}


                                @if(userPermission(121)  )
                                    {{--    <li> <a href="{{route('base_group')}}">@lang('lang.base_group')</a> </li>--}}
                                @endif

                                @if(userPermission(432)  )
                                    <li  >
                                        <a href="{{route('academic-year')}}">@lang('lang.academic_year')</a>
                                    </li>
                                @endif





                                @if(userPermission(412)  )
                                    <li >
                                        <a href="{{route('payment-method-settings')}}">@lang('lang.payment') @lang('lang.settings')</a>
                                    </li>
                                @endif

                                @if(userPermission(410)  )

                                    <li >
                                        <a href="{{route('email-settings')}}">@lang('lang.email_settings')</a>
                                    </li>
                                @endif

                                @if(userPermission(444)  )

                                    <li >
                                        <a href="{{route('sms-settings')}}">@lang('lang.sms_settings')</a>
                                    </li>
                                @endif

                                {{-- SAAS DISABLE --}}
                                @if(moduleStatusCheck('Saas')== FALSE   )
                                    @include('backEnd/partials/without_saas_school_admin_menu')
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Dormitory --}}
                    @if(env('APP_ENV') !== 'production')
                        @if(moduleStatusCheck('Saas')== FALSE)
                            @if(userPermission(485) )
                                <li  >
                                    <a href="#subMenusystemStyle" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle">
                                        <span class="ti-cut"></span>
                                        @lang('lang.style')
                                    </a>
                                    <ul class="collapse list-unstyled" id="subMenusystemStyle">
                                        @if(userPermission(486) )
                                            <li >
                                                <a href="{{route('background-setting')}}">@lang('lang.background_settings')</a>
                                            </li>
                                        @endif
                                        @if(userPermission(490)  )
                                            <li >
                                                <a href="{{route('color-style')}}">@lang('lang.color') @lang('lang.theme')</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endif

                    {{-- Front Settings --}}
                    @if(moduleStatusCheck('Saas')== FALSE)
                        @if(userPermission(492) &&  menuStatus(492))
                            <li  >
                                <a href="#subMenufrontEndSettings" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <span class="ti-image"></span>
                                    @lang('lang.front_settings')
                                </a>
                                <ul class="collapse list-unstyled" id="subMenufrontEndSettings">
                                    @if(userPermission(493) )
                                        <li  >
                                            <a href="{{route('admin-home-page')}}"> @lang('lang.home_page') </a>
                                        </li>
                                    @endif
                                    @if(userPermission(523) )
                                        <li  >
                                            <a href="{{route('news-heading-update')}}">@lang('lang.news_heading')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(500)  )
                                        <li  >
                                            <a href="{{route('news-category')}}">@lang('lang.news') @lang('lang.category')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(495)  )
                                        <li  >
                                            <a href="{{route('news_index')}}">@lang('lang.news_list')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(525)  )
                                        <li  >
                                            <a href="{{route('course-heading-update')}}">@lang('lang.course_heading')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(525)  )
                                        <li  >
                                            <a href="{{route('course-details-heading')}}">@lang('lang.course_details_heading')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(673)  )
                                        <li  >
                                            <a href="{{route('course-category')}}">@lang('lang.course') @lang('lang.category')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(509)  )
                                        <li  >
                                            <a href="{{route('course-list')}}">@lang('lang.course_list')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(504)  )
                                        <li  >
                                            <a href="{{route('testimonial_index')}}">@lang('lang.testimonial')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(514) )
                                        <li  >
                                            <a href="{{route('conpactPage')}}">@lang('lang.contact') @lang('lang.page') </a>
                                        </li>
                                    @endif
                                    @if(userPermission(517) )
                                        <li  >
                                            <a href="{{route('contactMessage')}}">@lang('lang.contact') @lang('lang.message')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(520) )
                                        <li  >
                                            <a href="{{route('about-page')}}"> @lang('lang.about_us') </a>
                                        </li>
                                    @endif
                                    @if(userPermission(529) )
                                        <li  >
                                            <a href="{{route('social-media')}}"> @lang('lang.social_media') </a>
                                        </li>
                                    @endif
                                    @if(userPermission(654) )
                                        <li  >
                                            <a href="{{route('page-list')}}">@lang('lang.pages')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(527) )
                                        <li  >
                                            <a href="{{route('custom-links')}}"> @lang('lang.footer_widget') </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif

                    {{-- Ticket --}}
                    @if(moduleStatusCheck('Saas')== TRUE  && Auth::user()->is_administrator != "yes" )
                        <li >
                            <a href="#Ticket" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="ti-settings"></span>
                                @lang('lang.ticket_system')
                            </a>
                            <ul class="collapse list-unstyled" id="Ticket">
                                <li>
                                    <a href="{{ route('school/ticket-view') }}">@lang('lang.ticket_list')</a>
                                </li>
                            </ul>
                        </li>
                    @endif

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
             
            @endif

                    <!-- Student Panel -->
                    @if(Auth::user()->role_id == 2)                   
                        @include('backEnd/partials/student_sidebar')
                    @endif

                    <!-- Parents Panel Menu -->
                    @if(Auth::user()->role_id == 3)
                        @include('backEnd/partials/parents_sidebar')
                    @endif
            @endif

    @if(Auth::user()->is_administrator=="yes")
            @if(userPermission(11) )
                <li  >
                    <a href="#subMenuAdmin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="ti-layers"></span>
                        Admin Menu
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuAdmin">
                        @if(userPermission(12) )
                            <li >
                                <a href="{{route('admission_query')}}">@lang('lang.admission_query')</a>
                            </li>
                        @endif


                        @if(userPermission(41) )
                            <li >
                                <a href="{{route('setup-admin')}}">@lang('lang.admin_setup')</a>
                            </li>
                        @endif
                        @if(userPermission(49) )
                            <li >
                                <a href="{{route('student-certificate')}}">@lang('lang.student_certificate')</a>
                            </li>
                        @endif
                        @if(userPermission(53) )
                            <li >
                                <a href="{{route('generate_certificate')}}">@lang('lang.generate_certificate')</a>
                            </li>
                        @endif
                        @if(userPermission(45) )
                            <li >
                                <a href="{{route('student-id-card')}}">@lang('lang.id_card')</a>
                            </li>
                        @endif
                        @if(userPermission(57) )
                            <li >
                                <a href="{{route('generate_id_card')}}">@lang('lang.generate_id_card')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @endif
        </ul>

    @endif

    @if(Auth::user()->is_saas == 1)
    
        @include('saasrolepermission::menu.SaasAdminMenu')
    @endif

    @if(Auth::user()->is_saas == 1 && Auth::user()->role_id != 1)
        <ul class="list-unstyled components">
            <li>
                <a href="{{route('saas/institution-list')}}" id="superadmin-dashboard">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.institution') @lang('lang.list') 
                </a>
            </li>
        </ul>
    @endif

</nav>