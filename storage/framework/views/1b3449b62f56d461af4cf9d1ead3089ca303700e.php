
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.class_routine'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Class Routine </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.class_routine'); ?></a>
            </div>
        </div>
    </div>
</section>

<?php if(isset($class_times)): ?>
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.class_routine'); ?></h3>
                </div>
            </div>
            <div class="col-lg-6 pull-right">
                <a href="<?php echo e(route('classRoutinePrint', [@$class_id, @$section_id])); ?>" class="primary-btn small fix-gr-bg pull-right" target="_blank"><i class="ti-printer"> </i> Print</a>
                
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table id="default_table" class="display school-table " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th> <?php echo app('translator')->get('lang.class_period'); ?> </th>
                            <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e(@$sm_weekend->name); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $class_times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class_time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(@$class_time->period); ?><br><?php echo e(date('h:i A', strtotime(@$class_time->start_time)).' - '.date('h:i A', strtotime(@$class_time->end_time))); ?></td>
                            <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <td>
                                <?php if(@$class_time->is_break == 0): ?>
                                <?php if(@$sm_weekend->is_weekend != 1): ?>
                                

                                <?php
                                    // @$assinged_class_routine = $class_time->routineUpdates->where('day',$sm_weekend->id)->where('class_id',$class_id)->where('section_id',$section_id)->frist();
                                    @$assinged_class_routine = App\SmClassRoutineUpdate::assingedClassRoutine($class_time->id, $sm_weekend->id, $class_id, $section_id);
                                ?>
                                <?php if(@$assinged_class_routine != ""): ?>
                                    <span class=""><?php echo e(@$assinged_class_routine->subject->subject_name); ?></span>
                                    <br>
                                    <span class=""><?php echo e(@$assinged_class_routine->classRoom->room_no); ?></span></br>
                                    <span class="tt"><?php echo e(@$assinged_class_routine->teacherDetail->full_name); ?></span></br>
                                <?php endif; ?>

                                
                                <?php else: ?>
                                <?php echo app('translator')->get('lang.weekend'); ?>

                                <?php endif; ?>
                                <?php endif; ?>
                            </td>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\college\resources\views/backEnd/studentPanel/class_routine.blade.php ENDPATH**/ ?>