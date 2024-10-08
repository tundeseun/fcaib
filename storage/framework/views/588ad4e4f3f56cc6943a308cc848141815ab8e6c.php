
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.class_routine_report'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.class_routine_report'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.class_routine_report'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php if(session()->has('message-success') != ""): ?>
                        <?php if(session()->has('message-success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message-success')); ?>

                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(session()->has('message-danger') != ""): ?>
                        <?php if(session()->has('message-danger')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session()->get('message-danger')); ?>

                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'class_routine_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-6 mt-30-md col-md-6">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>"  <?php echo e(isset($class_id)? ($class_id == $class->id?'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 mt-30-md col-md-6" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
    </div>
</section>

<?php if(isset($sm_routine_updates)): ?>
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.class_routine'); ?></h3>
                </div>
            </div>
            <div class="col-lg-8 pull-right mb-30">
                <a href="<?php echo e(route('classRoutinePrint', [$class_id, $section_id])); ?>" class="primary-btn small fix-gr-bg pull-right" target="_blank"><i class="ti-printer"> </i> <?php echo app('translator')->get('lang.print'); ?></a>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="default_table" class="display school-table " cellspacing="0" width="100%">
                    <thead>
                        <?php if(session()->has('success') != ""): ?>
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-success">
                                    <?php echo e(session()->get('success')); ?>

                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th><?php echo app('translator')->get('lang.class_period'); ?></th>
                            <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e($sm_weekend->name); ?></th>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/reports/class_routine_report.blade.php ENDPATH**/ ?>