<?php

  $stid = 'App\SmStudent'::where('user_id',Auth::user()->id)->first()->id;

?>

<?php if(userPermission(1) ): ?>
<li >
    <a href="<?php echo e(route('student-dashboard')); ?>">
        <span class="ti-dashboard"></span>
        <?php echo app('translator')->get('lang.dashboard'); ?>
    </a>
</li>
<?php endif; ?>
<?php if(userPermission(48) ): ?>

<li  >
    <a href="<?php echo e(route('student_noticeboard')); ?>">
        <span class="ti-announcement"></span>
        <?php echo app('translator')->get('lang.notice_board'); ?>
    </a>
</li>
<?php endif; ?>


<?php if(userPermission(20) ): ?>
<li >
    <a href="#subMenuStudentFeesCollection" data-toggle="collapse" aria-expanded="false"
    class="dropdown-toggle" href="#">
        <span class="ti-bookmark-alt"></span>
        <?php echo app('translator')->get('lang.fees'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuStudentFeesCollection">
        <li>
            <a href="<?php echo e(route('student_fees')); ?>"><?php echo app('translator')->get('lang.pay_fees'); ?></a>
        </li>
        <li>
            <a href="<?php echo e(route('student_paid_fees',$stid)); ?>">Paid Fees & Receipts</a>
        </li>
        
         <li>
            <a href="<?php echo e(route('check-rrr-status-form')); ?>">Check RRR Status</a>
        </li>
    </ul>
</li>
<?php endif; ?>

<?php if(generalSetting()->hostel_booking != 0): ?>
    <?php if(userPermission(55) ): ?>
    <li  >
        <a href="<?php echo e(route('student_dormitory')); ?>">
            <span class="ti-home"></span>
            Hostel Booking
        </a>
    </li>
    <?php endif; ?>
<?php endif; ?>


<?php if(generalSetting()->course_registration != 0): ?>
    <?php if(userPermission(49) ): ?>
    <li>
        <a href="<?php echo e(route('course-registration')); ?>">
            <span class="ti-write"></span>
            Course Registration
        </a>
    </li>
    <?php endif; ?>
<?php endif; ?>

<?php if(userPermission(36) ): ?>
<li  >
    <a href="#subMenuStudentExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
    href="#">
        <span class="ti-pencil-alt"></span>
        <?php echo app('translator')->get('lang.examinations'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuStudentExam">
        <?php if(userPermission(37) ): ?>
            <li  >
                <a href="<?php echo e(route('student-result',$stid)); ?>"><?php echo app('translator')->get('lang.result'); ?> </a>
            </li>
        <?php endif; ?>
        <?php if(userPermission(38) ): ?>
            <li  >
                <a href="<?php echo e(route('student_exam_schedule')); ?>"><?php echo app('translator')->get('lang.exam_schedule'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>
<?php if(userPermission(45) ): ?>
<li  >
    <a href="#subMenuStudentOnlineExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
    href="#">
        <span class="ti-desktop"></span>
        <?php echo app('translator')->get('lang.online_exam'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuStudentOnlineExam">

    <?php if(moduleStatusCheck('OnlineExam') ==false ): ?>
        <?php if(userPermission(46) ): ?>
            <li  >
                <a href="<?php echo e(route('student_online_exam')); ?>"><?php echo app('translator')->get('lang.active_exams'); ?></a>
            </li>
        <?php endif; ?>


        <?php elseif(moduleStatusCheck('OnlineExam') == true ): ?>

        <?php if(userPermission(2046) ): ?>
        <li  > 
            <a href="<?php echo e(route('om_student_online_exam')); ?>">  <?php echo app('translator')->get('lang.active_exams'); ?> </a>
        </li>     
        <?php endif; ?>                           
                            
        <?php if(userPermission(2047) ): ?>                   
        <li  >                                            
            <a href=" <?php echo e(route('om_student_view_result')); ?> ">  <?php echo app('translator')->get('lang.view_result'); ?> </a>
        </li> 
        <?php endif; ?>                               
                            
        <?php if(userPermission(2048) ): ?>                  
        <li  >                                            
            <a href="<?php echo e(route('student_pdf_exam')); ?> " class="active"> PDF <?php echo app('translator')->get('lang.exam'); ?> </a>
        </li> 
        <?php endif; ?>                               
                            
        <?php if(userPermission(2049) ): ?>                   
        <li  >                                            
            <a href=" <?php echo e(route('student_view_pdf_result')); ?> ">  PDF <?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.result'); ?> </a>
        </li>  
        <?php endif; ?>

    <?php endif; ?>

    </ul>
</li>
<?php endif; ?>





 <?php echo $__env->make('chat::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
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
<?php if(userPermission(22) ): ?>
<li  >
    <a href="<?php echo e(route('student_class_routine')); ?>">
        <span class="ti-calendar"></span>
        Class Routines
    </a>
</li>
<?php endif; ?>
<?php if(userPermission(11) ): ?>
<li >
    <a href="<?php echo e(route('student-profile')); ?>">
        <span class="ti-user"></span>
        <?php echo app('translator')->get('lang.my_profile'); ?>
    </a>
</li>
<?php endif; ?>
<?php if(Auth::user()->isGraduate()): ?>
<li  >
    <a href="<?php echo e(route('transcript-application')); ?>">
        <span class="ti-printer"></span>
        Transcript Application
    </a>
</li>

<li  >
    <a href="<?php echo e(route('statement-result')); ?>">
        <span class="ti-zip"></span>
        Statement of Result
    </a>
</li>
<?php endif; ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/partials/student_sidebar.blade.php ENDPATH**/ ?>