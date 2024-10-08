
<?php if(userPermission(1) ): ?>
<li data-position="<?php echo e(menuPosition(1)); ?>" class="sortable_li">
    <a href="<?php echo e(route('student-dashboard')); ?>">
        <span class="flaticon-resume"></span>
        <?php echo app('translator')->get('lang.dashboard'); ?>
    </a>
</li>
<?php endif; ?>
<?php if(userPermission(11) ): ?>
<li data-position="<?php echo e(menuPosition(11)); ?>" class="sortable_li">
    <a href="<?php echo e(route('student-profile')); ?>">
        <span class="flaticon-resume"></span>
        <?php echo app('translator')->get('lang.my_profile'); ?>
    </a>
</li>
<?php endif; ?>
<?php if(userPermission(20) ): ?>
<li data-position="<?php echo e(menuPosition(20)); ?>" class="sortable_li">
    <a href="#subMenuStudentFeesCollection" data-toggle="collapse" aria-expanded="false"
    class="dropdown-toggle" href="#">
        <span class="flaticon-wallet"></span>
        <?php echo app('translator')->get('lang.fees'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuStudentFeesCollection">
        <?php if(moduleStatusCheck('FeesCollection')== false ): ?>
        <li data-position="<?php echo e(menuPosition(21)); ?>">
            <a href="<?php echo e(route('student_fees')); ?>"><?php echo app('translator')->get('lang.pay_fees'); ?></a>
        </li>
        <?php else: ?>
        <li  data-position="<?php echo e(menuPosition(21)); ?>">
            <a href="<?php echo e(route('feescollection/student-fees')); ?>">b@lang('lang.pay_fees')</a>
        </li>

        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>
<?php if(userPermission(22) ): ?>
<li  data-position="<?php echo e(menuPosition(22)); ?>" class="sortable_li">
    <a href="<?php echo e(route('student_class_routine')); ?>">
        <span class="flaticon-calendar-1"></span>
        <?php echo app('translator')->get('lang.class_routine'); ?>
    </a>
</li>
<?php endif; ?>

<?php if(userPermission(36) ): ?>
<li  data-position="<?php echo e(menuPosition(36)); ?>" class="sortable_li">
    <a href="#subMenuStudentExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
    href="#">
        <span class="flaticon-test"></span>
        <?php echo app('translator')->get('lang.examinations'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuStudentExam">
        <?php if(userPermission(37) ): ?>
            <li  data-position="<?php echo e(menuPosition(37)); ?>">
                <a href="<?php echo e(route('student_result')); ?>"><?php echo app('translator')->get('lang.result'); ?></a>
            </li>
        <?php endif; ?>
        <?php if(userPermission(38) ): ?>
            <li  data-position="<?php echo e(menuPosition(38)); ?>">
                <a href="<?php echo e(route('student_exam_schedule')); ?>"><?php echo app('translator')->get('lang.exam_schedule'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>


<?php if(userPermission(39) ): ?>
<li  data-position="<?php echo e(menuPosition(39)); ?>" class="sortable_li">
    <a href="#subMenuLeaveManagement" data-toggle="collapse" aria-expanded="false"
        class="dropdown-toggle">
        <span class="flaticon-slumber"></span>
        <?php echo app('translator')->get('lang.leave'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuLeaveManagement">

        <?php if(userPermission(40) ): ?>

            <li  data-position="<?php echo e(menuPosition(40)); ?>">
                <a href="<?php echo e(route('student-apply-leave')); ?>"><?php echo app('translator')->get('lang.apply_leave'); ?></a>
            </li>
        <?php endif; ?>

        <?php if(userPermission(44) ): ?>

            <li  data-position="<?php echo e(menuPosition(44)); ?>">
                    <a href="<?php echo e(route('student-pending-leave')); ?>"><?php echo app('translator')->get('lang.pending_leave_request'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>
<?php if(userPermission(45) ): ?>
<li  data-position="<?php echo e(menuPosition(45)); ?>" class="sortable_li">
    <a href="#subMenuStudentOnlineExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
    href="#">
        <span class="flaticon-test-1"></span>
        <?php echo app('translator')->get('lang.online_exam'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuStudentOnlineExam">

    <?php if(moduleStatusCheck('OnlineExam') ==false ): ?>
        <?php if(userPermission(46) ): ?>
            <li  data-position="<?php echo e(menuPosition(46)); ?>">
                <a href="<?php echo e(route('student_online_exam')); ?>"><?php echo app('translator')->get('lang.active_exams'); ?></a>
            </li>
        <?php endif; ?>
        <?php if(userPermission(47) ): ?>
            <li  data-position="<?php echo e(menuPosition(47)); ?>">
                <a href="<?php echo e(route('student_view_result')); ?>"><?php echo app('translator')->get('lang.view_result'); ?></a>
            </li>
        <?php endif; ?>

        <?php elseif(moduleStatusCheck('OnlineExam') == true ): ?>

        <?php if(userPermission(2046) ): ?>
        <li  data-position="<?php echo e(menuPosition(2046)); ?>"> 
            <a href="<?php echo e(route('om_student_online_exam')); ?>">  <?php echo app('translator')->get('lang.active_exams'); ?> </a>
        </li>     
        <?php endif; ?>                           
                            
        <?php if(userPermission(2047) ): ?>                   
        <li  data-position="<?php echo e(menuPosition(2047)); ?>">                                            
            <a href=" <?php echo e(route('om_student_view_result')); ?> ">  <?php echo app('translator')->get('lang.view_result'); ?> </a>
        </li> 
        <?php endif; ?>                               
                            
        <?php if(userPermission(2048) ): ?>                  
        <li  data-position="<?php echo e(menuPosition(2048)); ?>">                                            
            <a href="<?php echo e(route('student_pdf_exam')); ?> " class="active"> PDF <?php echo app('translator')->get('lang.exam'); ?> </a>
        </li> 
        <?php endif; ?>                               
                            
        <?php if(userPermission(2049) ): ?>                   
        <li  data-position="<?php echo e(menuPosition(2049)); ?>">                                            
            <a href=" <?php echo e(route('student_view_pdf_result')); ?> ">  PDF <?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.result'); ?> </a>
        </li>  
        <?php endif; ?>

    <?php endif; ?>

    </ul>
</li>
<?php endif; ?>
<?php if(userPermission(48) ): ?>

<li  data-position="<?php echo e(menuPosition(48)); ?>" class="sortable_li">
    <a href="<?php echo e(route('student_noticeboard')); ?>">
        <span class="flaticon-poster"></span>
        <?php echo app('translator')->get('lang.notice_board'); ?>
    </a>
</li>
<?php endif; ?>
<?php if(userPermission(49) ): ?>
<li  data-position="<?php echo e(menuPosition(49)); ?>" class="sortable_li">
    <a href="<?php echo e(route('course-registration')); ?>">
        <span class="flaticon-reading"></span>
        <?php echo app('translator')->get('lang.subject'); ?> Registration
    </a>
</li>
<?php endif; ?>
<?php if(userPermission(49) ): ?>
<li  data-position="<?php echo e(menuPosition(49)); ?>" class="sortable_li">
    <a href="<?php echo e(route('student_subject')); ?>">
        <span class="flaticon-reading-1"></span>
        <?php echo app('translator')->get('lang.subjects'); ?>
    </a>
</li>
<?php endif; ?>
<?php if(userPermission(50) ): ?>
<li  data-position="<?php echo e(menuPosition(50)); ?>" class="sortable_li">
    <a href="<?php echo e(route('student_teacher')); ?>">
        <span class="flaticon-professor"></span>
        Lecturer
    </a>
</li>
<?php endif; ?>
<?php if(userPermission(55) ): ?>
<li  data-position="<?php echo e(menuPosition(55)); ?>" class="sortable_li">
    <a href="<?php echo e(route('student_dormitory')); ?>">
        <span class="flaticon-hotel"></span>
        <?php echo app('translator')->get('lang.dormitory'); ?>
    </a>
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
                    <?php endif; ?><?php /**PATH C:\xampp\htdocs\college\resources\views/backEnd/partials/student_sidebar.blade.php ENDPATH**/ ?>