
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.exam_routine'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> <?php echo app('translator')->get('lang.exam_routine'); ?> </h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"> <?php echo app('translator')->get('lang.examinations'); ?></a>
                    <a href="#"> <?php echo app('translator')->get('lang.exam_routine'); ?> </a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <?php if(session()->has('success') != "" || session()->has('danger') != ""): ?>
                        <tr>
                            <td colspan="20">
                                <?php if(session()->has('success') != ""): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session()->get('success')); ?>

                                </div>
                                <?php else: ?>
                                <div class="alert alert-success">
                                    <?php echo e(session()->get('danger')); ?>

                                </div>
                            </td>
                                <?php endif; ?>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th width="10%">DAYS</th>
                            <th>EXAMINATION SCHEDULE</th>
                        </tr>
                        <?php $__currentLoopData = $exam_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <small>
                                    <?php echo e(@$day->day); ?>

                                </small>
                            </td>
                            <?php 
                                $schedules = App\SmExamSchedule::getSchedules($day->day, $class_id, $section_id);
                            ?>
                            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <small>
                                    <span class=""><?php echo e($schedule->subject_name); ?>(<?php echo e($schedule->subject_code); ?>)</span>
                                    <br>
                                    <span class=""><?php echo e($schedule->start_time); ?> - <?php echo e($schedule->end_time); ?></span></br>
                                    <span class="tt">Venue: <?php echo e($schedule->room_no); ?></span></br>
                                </small>
                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </thead>
                    <tbody>
                    </tbody>
            </table>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/exam_schedule.blade.php ENDPATH**/ ?>