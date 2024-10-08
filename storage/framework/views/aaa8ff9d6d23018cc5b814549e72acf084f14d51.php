
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lang.virtual_class'); ?> <?php echo app('translator')->get('lang.reports'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    .propertiesname{
        text-transform: uppercase;
    }.
    .recurrence-section-hide {
       display: none!important
    }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.virtual_class'); ?> <?php echo app('translator')->get('lang.reports'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.virtual_class'); ?></a>
                <a href="#"> <?php echo app('translator')->get('lang.reports'); ?> </a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-10">
                <h3 class="mb-30">
                    <?php echo app('translator')->get('lang.virtual_class'); ?> <?php echo app('translator')->get('lang.reports'); ?>
                </h3>
            </div>
        </div>
        <div class="row mb-20">
            <div class="col-lg-12">
                <div class="white-box">
                    <form action="<?php echo e(route('zoom.virtual.class.reports.show')); ?>" method="GET">
                            <div class="row">
                                <div class="col-lg-2 mt-30-md">
                                    <select class="w-100 niceSelect bb form-control <?php echo e($errors->has('class_id') ? ' is-invalid' : ''); ?>" id="select_class" name="class_id">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?></option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($class_id) ): ?>
                                                <option value="<?php echo e($class->id); ?>" <?php echo e($class_id == $class->id? 'selected':''); ?>><?php echo e($class->class_name); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($class->id); ?>" ><?php echo e($class->class_name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 mt-30-md" id="select_section_div">
                                    <select class="w-100 niceSelect bb form-control<?php echo e($errors->has('section_id') ? ' is-invalid' : ''); ?>" id="select_section" name="section_id">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                </div>
                                <?php if(Auth::user()->role_id == 1): ?>
                                    <div class="col-lg-2 mt-30-md">
                                        <select class="w-100 niceSelect bb form-control<?php echo e($errors->has('section_id') ? ' is-invalid' : ''); ?>" name="teachser_ids">
                                            <option data-display="<?php echo app('translator')->get('lang.select_teacher'); ?>" value=""><?php echo app('translator')->get('lang.select_teacher'); ?></option>
                                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($teacher->id); ?>" <?php echo e(isset($teachser_ids) == $teacher->id? 'selected':''); ?> ><?php echo e($teacher->full_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-3 mt-30-md">
                                    <input data-display="<?php echo app('translator')->get('lang.from_date'); ?>" placeholder="<?php echo app('translator')->get('lang.from_date'); ?>" class="primary-input date form-control" type="text" name="from_time" value="<?php echo e(isset($from_time) ? Carbon\Carbon::parse($from_time)->format('m/d/Y') : ''); ?>">
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <input data-display="<?php echo app('translator')->get('lang.to_date'); ?>" placeholder="<?php echo app('translator')->get('lang.to_date'); ?>" class="primary-input date form-control" type="text" name="to_time" value="<?php echo e(isset($to_time) ? Carbon\Carbon::parse($to_time)->format('m/d/Y') : ''); ?>">
                                </div>
                                <?php
                                    $tooltip = "";
                                        if(userPermission(566))
                                        {
                                            $tooltip = "";
                                        }else{
                                            $tooltip = "You have no permission to search";
                                        }
                                ?>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area" style="display:  <?php echo e(isset($meetings) ? 'block' : 'none'); ?> ">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="default_table2" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4): ?>
                                        <th><?php echo app('translator')->get('lang.class'); ?></th>
                                        <th><?php echo app('translator')->get('lang.class_section'); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo app('translator')->get('lang.meeting_id'); ?></th>
                                    <th><?php echo app('translator')->get('lang.password'); ?></th>
                                    <th><?php echo app('translator')->get('lang.topic'); ?></th>
                                    <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4): ?>
                                        <th>Lecturers</th>
                                    <?php endif; ?>
                                    <th><?php echo app('translator')->get('lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.time'); ?></th>
                                    <th><?php echo app('translator')->get('lang.duration'); ?></th>
                                </tr>
                        </thead>

                        <tbody>
                            <?php if(isset($meetings)): ?>
                                <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4): ?>
                                        <td><?php echo e($meeting->class->class_name); ?></td>
                                        <td><?php echo e($meeting->section->section_name); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($meeting->meeting_id); ?></td>
                                    <td><?php echo e($meeting->password); ?></td>
                                    <td><?php echo e($meeting->topic); ?>  </td>
                                    <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4): ?>
                                        <td><?php echo e($meeting->teachersName); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($meeting->date_of_meeting); ?></td>
                                    <td><?php echo e($meeting->time_of_meeting); ?></td>
                                    <td><?php echo e($meeting->meeting_duration); ?> Min</td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/Modules/Zoom/Resources/views/report/reports.blade.php ENDPATH**/ ?>