
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.collect_fees'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.collect_fees'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_collection'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.collect_fees'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
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
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'collect_fees', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-3 mt-30-md infix_up_mt">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> " value=""><?php echo app('translator')->get('lang.select_class'); ?> </option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>"  <?php echo e(( old("class") == $class->id ? "selected":"")); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3 mt-30-md infix_up_mt" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('current_section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                </div>

                                <div class="col-lg-6 mt-30-md infix_up_mt">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" name="keyword">
                                        <label><?php echo app('translator')->get('lang.search_by_name'); ?> OR <?php echo app('translator')->get('lang.admission'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
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
            
        <?php if(isset($students)): ?>
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-8 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.fees_collection'); ?> <?php echo app('translator')->get('lang.list'); ?> (<?php echo app('translator')->get('lang.class'); ?>: <?php echo e($search_info['class_name']); ?>, <?php echo app('translator')->get('lang.section'); ?>: <?php echo e(@$search_info['section_name']); ?>, <?php echo app('translator')->get('lang.keyword'); ?>: <?php echo e(@$search_info['keyword']); ?>)</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-30">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="9">
                                            <?php if(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.class'); ?></th>
                                        <th><?php echo app('translator')->get('lang.section'); ?></th>
                                        <th><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.phone'); ?></th>
                                        <th><?php echo app('translator')->get('lang.action'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($student->className->class_name); ?></td>
                                        <td><?php echo e($student->section->section_name); ?></td>
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <td><?php echo e($student->first_name.' '.$student->last_name); ?></td>
                                        <td><?php echo e($student->mobile); ?></td>

                                        <?php if(userPermission(110)): ?>

                                        <td>
                                            <a href="<?php echo e(route('fees_collect_student_wise', [$student->id])); ?>" class="primary-btn small tr-bg">
                                                <?php echo app('translator')->get('lang.collect_fees'); ?>
                                            </a>
                                        </td>

                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>

<?php endif; ?>

    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/feesCollection/collect_fees.blade.php ENDPATH**/ ?>