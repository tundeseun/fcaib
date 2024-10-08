<?php
$school_config = schoolConfig();
$isSchoolAdmin = Session::get('isSchoolAdmin');
?>
<nav id="sidebar">
    <div class="sidebar-header update_sidebar" style="background: #07294D;">
        <a href="<?php echo e(url('/')); ?>" >
            <?php if(! is_null($school_config->logo)): ?>
                <img src="<?php echo e(asset($school_config->logo)); ?>" alt="logo">
            <?php else: ?>
                <img src="<?php echo e(asset('public/uploads/settings/logo.png')); ?>" alt="logo">
            <?php endif; ?>
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>
    <?php if(Auth::user()->is_saas == 0): ?>

        <ul class="list-unstyled components" id="sidebar_menu">
            <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 ): ?>
                <?php if(userPermission(1)): ?>
                    <li>
                        <?php if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator=="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1): ?>
                            <a href="<?php echo e(route('superadmin-dashboard')); ?>" id="superadmin-dashboard">
                        <?php else: ?>
                            <a href="<?php echo e(route('admin-dashboard')); ?>" id="admin-dashboard">
                        <?php endif; ?>
                            <span class="ti-dashboard"></span><?php echo app('translator')->get('lang.dashboard'); ?>
                            </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(Auth::user()->role_id == 4): ?>
                    <li>
                        <a href="<?php echo e(route('course-list')); ?>">
                        <span class="ti-blackboard"></span>Assigned Courses
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('course-list')); ?>">
                        <span class="ti-export"></span>Upload Results
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('lecturer-online-exam-results')); ?>">
                        <span class="ti-rss-alt"></span>Online Exam Results
                        </a>
                    </li>

            <?php endif; ?>

            <?php if(moduleStatusCheck('InfixBiometrics')== TRUE && Auth::user()->role_id == 1): ?>
                <?php echo $__env->make('infixbiometrics::menu.InfixBiometrics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            
            
            <?php if(moduleStatusCheck('ParentRegistration')== TRUE): ?>
             <?php echo $__env->make('parentregistration::menu.ParentRegistration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>


            
            <?php if(moduleStatusCheck('SaasSubscription')== TRUE && Auth::user()->is_administrator != "yes"): ?>
                <?php echo $__env->make('saassubscription::menu.SaasSubscriptionSchool', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            
            
            <?php if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator =="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1 ): ?>
                <?php echo $__env->make('saas::menu.Saas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
      
            <?php echo $__env->make('menumanage::menu.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 ): ?>
                   


                   
                        
               




                    
                    <?php if(userPermission(61) ): ?>
                        <li >
                            <a href="#subMenuStudent" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-files"></span>
                                <?php echo app('translator')->get('lang.student_information'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuStudent">
                                <?php if(userPermission(64)  ): ?>
                                    <li >
                                        <a href="<?php echo e(route('student_list')); ?>"> <?php echo app('translator')->get('lang.student_list'); ?></a>
                                    </li>
                                <?php endif; ?>



                                <?php if(userPermission(83)  ): ?>
                                    <li >
                                        <a href="<?php echo e(route('disabled_student')); ?>">Suspended Students</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(663)  ): ?>
                                    <li >
                                        <a href="<?php echo e(route('all-student-export')); ?>"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.export'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(123) ): ?>
                    <li >
                            <a href="#subMenuX" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-zip"></span>
                                Transcript Applications
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuX">
                                    <li>
                                        <a href="<?php echo e(route('transcript-applications')); ?>">Untreated Applications</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('transcript-uapplications')); ?>">Treated Applications</a>
                                    </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(userPermission(123) ): ?>
                    <li >
                            <a href="#subMenuY" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-printer"></span>
                                Statement of Results
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuY">
                                    <li>
                                        <a href="<?php echo e(route('statement-result-untreated')); ?>">Untreated Applications</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('statement-result-treated')); ?>">Treated Applications</a>
                                    </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->is_administrator=="yes"): ?>
                    <?php endif; ?>
                    
                    <?php if(userPermission(245)  ): ?>
                        <li  >
                            <a href="#subMenuAcademic" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="ti-write"></span>
                                <?php echo app('translator')->get('lang.academics'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAcademic">
                                <?php if(userPermission(253) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('manage-documents')); ?>"> Documents/Forms</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(265) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('section')); ?>"> Level</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(261) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('class')); ?>"> <?php echo app('translator')->get('lang.class'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(257) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('subject')); ?>"> <?php echo app('translator')->get('lang.subjects'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(250) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('assign_subject_create')); ?>"> <?php echo app('translator')->get('lang.assign_subject'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(273) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('class-time')); ?>"> <?php echo app('translator')->get('lang.class_time_setup'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(246) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('class_routine_new')); ?>"> Time Table</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(246) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('class-room')); ?>"> Class Rooms</a>
                                    </li>
                                <?php endif; ?>
                            <!-- only for teacher -->
                                <?php if(Auth::user()->role_id == 4): ?>
                                    <li>
                                        <a href="<?php echo e(route('view-teacher-routine')); ?>"><?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.class_routine'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(moduleStatusCheck('FeesCollection')== TRUE): ?>
                        <?php echo $__env->make('feescollection::menu.FeesCollection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php if(userPermission(108) ): ?>
                            <li >
                                <a href="#subMenuFeesCollection" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <span class="ti-bookmark-alt"></span>
                                    Fees Management
                                </a>
                                <ul class="collapse list-unstyled" id="subMenuFeesCollection">
                                    <?php if(userPermission(123) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('fees_group')); ?>"> <?php echo app('translator')->get('lang.fees_group'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(127) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('fees_type')); ?>"> <?php echo app('translator')->get('lang.fees_type'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(131) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('fees-master')); ?>"> <?php echo app('translator')->get('lang.fees_master'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    

                                    <?php if(userPermission(118) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('fees_discount')); ?>"> <?php echo app('translator')->get('lang.fees_discount'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(109) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('collect_fees')); ?>"> <?php echo app('translator')->get('lang.collect_fees'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                   
                                    <?php if(userPermission(113) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('search_fees_payment')); ?>"> <?php echo app('translator')->get('lang.search_fees_payment'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(116) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('search_fees_due')); ?>"> <?php echo app('translator')->get('lang.search_fees_due'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <li >
                                        <a href="<?php echo e(route('bank-payment-slip')); ?>"> <?php echo app('translator')->get('lang.bank'); ?>  <?php echo app('translator')->get('lang.payment'); ?></a>
                                    </li>

                                    <?php if(userPermission(136) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('fees_forward')); ?>"> <?php echo app('translator')->get('lang.fees_forward'); ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(userPermission(383) ): ?>
                                        <li >
                                            <a href="<?php echo e(route('transaction_report')); ?>"><?php echo app('translator')->get('lang.collection'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                 
                                    
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>


                    
                <?php if(moduleStatusCheck('BulkPrint')== TRUE): ?>
                    <?php echo $__env->make('bulkprint::menu.bulk_print_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                    
                    <?php if(userPermission(137) ): ?>
                        <li >
                            <a href="#subMenuAccount" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-bar-chart-alt"></span>
                                <?php echo app('translator')->get('lang.accounts'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAccount">
                                <?php if(userPermission(148) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('chart-of-account')); ?>"> <?php echo app('translator')->get('lang.chart_of_account'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(156) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('bank-account')); ?>"> <?php echo app('translator')->get('lang.bank_account'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(139) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('add_income')); ?>"> <?php echo app('translator')->get('lang.income'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(138) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('profit')); ?>"> <?php echo app('translator')->get('lang.profit'); ?> <?php echo app('translator')->get('lang.&'); ?> <?php echo app('translator')->get('lang.loss'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(143) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('add-expense')); ?>"> <?php echo app('translator')->get('lang.expense'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(userPermission(704) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('fund-transfer')); ?>"><?php echo app('translator')->get('lang.fund'); ?> <?php echo app('translator')->get('lang.transfer'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(700) ): ?>
                                    <li >
                                        <a href="#subMenuAccountReport" data-toggle="collapse" aria-expanded="false"
                                           class="dropdown-toggle">
                                            <?php echo app('translator')->get('lang.report'); ?>
                                        </a>
                                        <ul class="collapse list-unstyled" id="subMenuAccountReport">
                                            <?php if(userPermission(701) ): ?>
                                                <li >
                                                    <a href="<?php echo e(route('fine-report')); ?>"> <?php echo app('translator')->get('lang.fine'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(userPermission(702) ): ?>
                                                <li >
                                                    <a href="<?php echo e(route('accounts-payroll-report')); ?>"> <?php echo app('translator')->get('lang.payroll'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(userPermission(703) ): ?>
                                                <li >
                                                    <a href="<?php echo e(route('transaction')); ?>"> <?php echo app('translator')->get('lang.transaction'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(userPermission(160) ): ?>
                        <li >
                            <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-user"></span>
                                <?php echo app('translator')->get('lang.human_resource'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuHumanResource">
                                <?php if(userPermission(180) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('designation')); ?>"> <?php echo app('translator')->get('lang.designation'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(184) ): ?>
                                    <li >
                                        <a href="<?php echo e(route('department')); ?>"> <?php echo app('translator')->get('lang.department'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(162) ): ?>
                                    <li >
                                        <a href="<?php echo e(route('addStaff')); ?>"> <?php echo app('translator')->get('lang.add'); ?>  <?php echo app('translator')->get('lang.staff'); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(161) ): ?>
                                    <li >
                                        <a href="<?php echo e(route('staff_directory')); ?>"> <?php echo app('translator')->get('lang.staff_directory'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(165) ): ?>
                                    <li >
                                        <a href="<?php echo e(route('staff_attendance')); ?>"> <?php echo app('translator')->get('lang.staff_attendance'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(169) ): ?>
                                    <li >
                                        <a href="<?php echo e(route('staff_attendance_report')); ?>"> <?php echo app('translator')->get('lang.staff_attendance_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(170) ): ?>
                                    <li >
                                        <a href="<?php echo e(route('payroll')); ?>"> <?php echo app('translator')->get('lang.payroll'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(178) ): ?>
                                    <li >
                                        <a href="<?php echo e(route('payroll-report')); ?>"> <?php echo app('translator')->get('lang.payroll_report'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(178)): ?>
                               
                               <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(188) ): ?>
                        <li >
                            <a href="#subMenuLeaveManagement" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-calendar"></span>
                                <?php echo app('translator')->get('lang.leave'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuLeaveManagement">
                                <?php if(userPermission(203) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('leave-type')); ?>"> <?php echo app('translator')->get('lang.leave_type'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(199) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('leave-define')); ?>"> <?php echo app('translator')->get('lang.leave_define'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(189) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('approve-leave')); ?>"><?php echo app('translator')->get('lang.approve_leave_request'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(196) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('pending-leave')); ?>"><?php echo app('translator')->get('lang.pending_leave_request'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Auth::user()->role_id!=1): ?>

                                    <?php if(userPermission(193) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('apply-leave')); ?>"><?php echo app('translator')->get('lang.apply_leave'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>


                    
                    <?php echo $__env->make('chat::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    
                    <?php if(userPermission(207) ): ?>
                        <li >
                            <a href="#subMenuExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="ti-pencil-alt"></span>
                                <?php echo app('translator')->get('lang.examination'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuExam">
                                <?php if(userPermission(225) ): ?>
                                    <li   >
                                        <a href="<?php echo e(route('marks-grade')); ?>"> <?php echo app('translator')->get('lang.marks_grade'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(217) ): ?>
                                    <li   >
                                        <a href="<?php echo e(route('exam_schedule_create',[0,0])); ?>"> <?php echo app('translator')->get('lang.exam_schedule'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(221) ): ?>
                                    <li   >
                                        <a href="<?php echo e(route('exam_attendance')); ?>">Exam Attendance sheet</a>
                                    </li>
                                <?php endif; ?>

                                

                                <li>
                                    <a href="#examSettings" data-toggle="collapse" aria-expanded="false"
                                       class="dropdown-toggle">
                                        <?php echo app('translator')->get('lang.settings'); ?>
                                    </a>
                                    <ul class="collapse list-unstyled" id="examSettings">
                                        <?php if(userPermission(436) ): ?>
                                            <li  >
                                                <a href="<?php echo e(route('custom-result-setting')); ?>"><?php echo app('translator')->get('lang.setup'); ?> <?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.rule'); ?></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(userPermission(706) ): ?>
                                            <li  >
                                                <a href="<?php echo e(route('exam-settings')); ?>"><?php echo app('translator')->get('lang.format'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    
                    <?php if(moduleStatusCheck('OnlineExam')== true): ?>
                        <?php echo $__env->make('onlineexam::menu_onlineexam', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php if(userPermission(875) ): ?>
                            <li >
                                <a href="#subMenuOnlineExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <span class="ti-desktop"></span>
                                    <?php echo app('translator')->get('lang.online_exam'); ?>
                                </a>
                                <ul class="collapse list-unstyled" id="subMenuOnlineExam">
                                    <?php if(userPermission(230) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('question-group')); ?>"><?php echo app('translator')->get('lang.question_group'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(234) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('question-bank')); ?>"><?php echo app('translator')->get('lang.question_bank'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(238) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('online-exam')); ?>"><?php echo app('translator')->get('lang.online_exam'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>


                    
                    <?php if(userPermission(286) ): ?>
                        <li >
                            <a href="#subMenuCommunicate" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-comments"></span>
                                <?php echo app('translator')->get('lang.communicate'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuCommunicate">
                                <?php if(userPermission(287) ): ?>
                                    <li   >
                                        <a href="<?php echo e(route('notice-list')); ?>"><?php echo app('translator')->get('lang.notice_board'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(moduleStatusCheck('Saas') == true && Auth::user()->is_administrator != "yes" ): ?>
                                    <li>
                                        <a href="<?php echo e(route('administrator-notice')); ?>"><?php echo app('translator')->get('lang.administrator'); ?> <?php echo app('translator')->get('lang.notice'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(291) ): ?>
                                    <li   >
                                        <a href="<?php echo e(route('send-email-sms-view')); ?>"><?php echo app('translator')->get('lang.send_email'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(293) ): ?>
                                    <li   >
                                        <a href="<?php echo e(route('email-sms-log')); ?>"><?php echo app('translator')->get('lang.email_sms_log'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(294) ): ?>
                                    <li   >
                                        <a href="<?php echo e(route('event')); ?>"><?php echo app('translator')->get('lang.event'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(moduleStatusCheck('Saas')== FALSE): ?>
                                    <?php if(userPermission(710) ): ?>
                                    <li   >
                                        <a href="<?php echo e(route('sms-template-new')); ?>"><?php echo app('translator')->get('lang.sms'); ?> <?php echo app('translator')->get('lang.template'); ?></a>
                                    </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>



                    
                    <?php if(userPermission(315) ): ?>
                        <li >
                            <a href="#subMenuInventory" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-archive"></span>
                                <?php echo app('translator')->get('lang.inventory'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuInventory">
                                <?php if(userPermission(316) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('item-category')); ?>"> <?php echo app('translator')->get('lang.item_category'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(320) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('item-list')); ?>"> <?php echo app('translator')->get('lang.item_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(324) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('item-store')); ?>"> <?php echo app('translator')->get('lang.item_store'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(328) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('suppliers')); ?>"> <?php echo app('translator')->get('lang.supplier'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(332) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('item-receive')); ?>"> <?php echo app('translator')->get('lang.item_receive'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(334) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('item-receive-list')); ?>"> <?php echo app('translator')->get('lang.item_receive_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(339) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('item-sell-list')); ?>"> <?php echo app('translator')->get('lang.item_sell'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(345) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('item-issue')); ?>"> <?php echo app('translator')->get('lang.item_issue'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>



                    
                    <?php if(userPermission(362) ): ?>
                        <li >
                            <a href="#subMenuDormitory" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-home"></span>
                                Hostel Management
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuDormitory">
                                <?php if(userPermission(367) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('dormitory-list')); ?>"> Hostels</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(371) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('room-type')); ?>"> <?php echo app('translator')->get('lang.room_type'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(363) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('room-list')); ?>"> Rooms</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(376) ): ?>
                        <li >
                            <a href="#subMenusystemReports" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-pie-chart"></span>
                                <?php echo app('translator')->get('lang.reports'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenusystemReports">

                                <?php if(userPermission(378) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('student_history')); ?>"><?php echo app('translator')->get('lang.student_history'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(379) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('student_login_report')); ?>"><?php echo app('translator')->get('lang.student_login_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(381) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('fees_statement')); ?>"><?php echo app('translator')->get('lang.fees_statement'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(382) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('balance_fees_report')); ?>"><?php echo app('translator')->get('lang.balance_fees_report'); ?></a>
                                    </li>
                                <?php endif; ?>


                                <?php if(userPermission(394) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('user_log')); ?>"><?php echo app('translator')->get('lang.user_log'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                  
                    
                    <?php if(userPermission(417) ): ?>
                        <li  >
                            <a href="#subMenuUserManagement" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-panel"></span>
                                <?php echo app('translator')->get('lang.role'); ?> <?php echo app('translator')->get('lang.&'); ?> <?php echo app('translator')->get('lang.permission'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuUserManagement">
                                <?php if(userPermission(585) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('rolepermission/role')); ?>"><?php echo app('translator')->get('lang.role'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(421) ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('login-access-control')); ?>"><?php echo app('translator')->get('lang.login_permission'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(398) ): ?>
                        <li  >
                            <a href="#subMenusystemSettings" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="ti-settings"></span>
                                <?php echo app('translator')->get('lang.system_settings'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenusystemSettings">
                                   
                                <?php if((moduleStatusCheck('Saas')== TRUE) && (auth()->user()->is_administrator=="yes")): ?>
                                    <li>
                                        <a href="<?php echo e(route('school-general-settings')); ?>"> <?php echo app('translator')->get('lang.general_settings'); ?></a>
                                    </li>
                                <?php else: ?>
                                    <?php if(userPermission(405)  ): ?>

                                        <li  >
                                            <a href="<?php echo e(route('general-settings')); ?>"> <?php echo app('translator')->get('lang.general_settings'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                


                                <?php if(userPermission(121)  ): ?>
                                    
                                <?php endif; ?>

                                <?php if(userPermission(432)  ): ?>
                                    <li  >
                                        <a href="<?php echo e(route('academic-year')); ?>"><?php echo app('translator')->get('lang.academic_year'); ?></a>
                                    </li>
                                <?php endif; ?>





                                <?php if(userPermission(412)  ): ?>
                                    <li >
                                        <a href="<?php echo e(route('payment-method-settings')); ?>"><?php echo app('translator')->get('lang.payment'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(410)  ): ?>

                                    <li >
                                        <a href="<?php echo e(route('email-settings')); ?>"><?php echo app('translator')->get('lang.email_settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(444)  ): ?>

                                    <li >
                                        <a href="<?php echo e(route('sms-settings')); ?>"><?php echo app('translator')->get('lang.sms_settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                
                                <?php if(moduleStatusCheck('Saas')== FALSE   ): ?>
                                    <?php echo $__env->make('backEnd/partials/without_saas_school_admin_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(moduleStatusCheck('Saas')== FALSE): ?>
                        <?php if(userPermission(485) ): ?>
                            <li  >
                                <a href="#subMenusystemStyle" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <span class="ti-cut"></span>
                                    <?php echo app('translator')->get('lang.style'); ?>
                                </a>
                                <ul class="collapse list-unstyled" id="subMenusystemStyle">
                                    <?php if(userPermission(486) ): ?>
                                        <li >
                                            <a href="<?php echo e(route('background-setting')); ?>"><?php echo app('translator')->get('lang.background_settings'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(490)  ): ?>
                                        <li >
                                            <a href="<?php echo e(route('color-style')); ?>"><?php echo app('translator')->get('lang.color'); ?> <?php echo app('translator')->get('lang.theme'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    
                    <?php if(moduleStatusCheck('Saas')== FALSE): ?>
                        <?php if(userPermission(492) &&  menuStatus(492)): ?>
                            <li  >
                                <a href="#subMenufrontEndSettings" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <span class="ti-image"></span>
                                    <?php echo app('translator')->get('lang.front_settings'); ?>
                                </a>
                                <ul class="collapse list-unstyled" id="subMenufrontEndSettings">
                                    <?php if(userPermission(493) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('admin-home-page')); ?>"> <?php echo app('translator')->get('lang.home_page'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(523) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('news-heading-update')); ?>"><?php echo app('translator')->get('lang.news_heading'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(500)  ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('news-category')); ?>"><?php echo app('translator')->get('lang.news'); ?> <?php echo app('translator')->get('lang.category'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(495)  ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('news_index')); ?>"><?php echo app('translator')->get('lang.news_list'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(525)  ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('course-heading-update')); ?>"><?php echo app('translator')->get('lang.course_heading'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(525)  ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('course-details-heading')); ?>"><?php echo app('translator')->get('lang.course_details_heading'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(673)  ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('course-category')); ?>"><?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(509)  ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('course-list')); ?>"><?php echo app('translator')->get('lang.course_list'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(504)  ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('testimonial_index')); ?>"><?php echo app('translator')->get('lang.testimonial'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(514) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('conpactPage')); ?>"><?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.page'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(517) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('contactMessage')); ?>"><?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.message'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(520) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('about-page')); ?>"> <?php echo app('translator')->get('lang.about_us'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(529) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('social-media')); ?>"> <?php echo app('translator')->get('lang.social_media'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(654) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('page-list')); ?>"><?php echo app('translator')->get('lang.pages'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(527) ): ?>
                                        <li  >
                                            <a href="<?php echo e(route('custom-links')); ?>"> <?php echo app('translator')->get('lang.footer_widget'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    
                    <?php if(moduleStatusCheck('Saas')== TRUE  && Auth::user()->is_administrator != "yes" ): ?>
                        <li >
                            <a href="#Ticket" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="ti-settings"></span>
                                <?php echo app('translator')->get('lang.ticket_system'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="Ticket">
                                <li>
                                    <a href="<?php echo e(route('school/ticket-view')); ?>"><?php echo app('translator')->get('lang.ticket_list'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <!-- Zoom Menu -->
                    <?php if(moduleStatusCheck('Zoom') == TRUE): ?>
                       
                        <?php echo $__env->make('zoom::menu.Zoom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                  
                    <!-- BBB Menu -->
                    <?php if(moduleStatusCheck('BBB') == true): ?>
                        <?php echo $__env->make('bbb::menu.bigbluebutton_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <!-- Jitsi Menu -->
                    <?php if(moduleStatusCheck('Jitsi')==true): ?>
                        <?php echo $__env->make('jitsi::menu.jitsi_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
             
            <?php endif; ?>

                    <!-- Student Panel -->
                    <?php if(Auth::user()->role_id == 2): ?>                   
                        <?php echo $__env->make('backEnd/partials/student_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <!-- Parents Panel Menu -->
                    <?php if(Auth::user()->role_id == 3): ?>
                        <?php echo $__env->make('backEnd/partials/parents_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
            <?php endif; ?>

    <?php if(Auth::user()->is_administrator=="yes"): ?>
            <?php if(userPermission(11) ): ?>
                <li  >
                    <a href="#subMenuAdmin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="ti-layers"></span>
                        Admin Menu
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuAdmin">
                        <?php if(userPermission(12) ): ?>
                            <li >
                                <a href="<?php echo e(route('admission_query')); ?>"><?php echo app('translator')->get('lang.admission_query'); ?></a>
                            </li>
                        <?php endif; ?>


                        <?php if(userPermission(41) ): ?>
                            <li >
                                <a href="<?php echo e(route('setup-admin')); ?>"><?php echo app('translator')->get('lang.admin_setup'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(userPermission(49) ): ?>
                            <li >
                                <a href="<?php echo e(route('student-certificate')); ?>"><?php echo app('translator')->get('lang.student_certificate'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(userPermission(53) ): ?>
                            <li >
                                <a href="<?php echo e(route('generate_certificate')); ?>"><?php echo app('translator')->get('lang.generate_certificate'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(userPermission(45) ): ?>
                            <li >
                                <a href="<?php echo e(route('student-id-card')); ?>"><?php echo app('translator')->get('lang.id_card'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(userPermission(57) ): ?>
                            <li >
                                <a href="<?php echo e(route('generate_id_card')); ?>"><?php echo app('translator')->get('lang.generate_id_card'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>
        </ul>

    <?php endif; ?>

    <?php if(Auth::user()->is_saas == 1): ?>
    
        <?php echo $__env->make('saasrolepermission::menu.SaasAdminMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(Auth::user()->is_saas == 1 && Auth::user()->role_id != 1): ?>
        <ul class="list-unstyled components">
            <li>
                <a href="<?php echo e(route('saas/institution-list')); ?>" id="superadmin-dashboard">
                    <span class="flaticon-analytics"></span>
                    <?php echo app('translator')->get('lang.institution'); ?> <?php echo app('translator')->get('lang.list'); ?> 
                </a>
            </li>
        </ul>
    <?php endif; ?>

</nav><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/partials/sidebar.blade.php ENDPATH**/ ?>