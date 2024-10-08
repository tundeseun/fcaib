
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.previous'); ?>  <?php echo app('translator')->get('lang.record'); ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<input type="text" hidden value="<?php echo e(@$clas->class_name); ?>" id="cls">
<input type="text" hidden value="<?php echo e(@$sec->section_name); ?>" id="sec">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.previous'); ?> <?php echo app('translator')->get('lang.record'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?> </a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="<?php echo e(route('previous-record')); ?>"><?php echo app('translator')->get('lang.previous'); ?>  <?php echo app('translator')->get('lang.record'); ?>  </a> 
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.criteria'); ?> </h3>
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
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'previous-record', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                              <div class="col-lg-4 col-md-4 sm_mb_20 sm2_mb_20">
                                    <select class="niceSelect w-100 bb promote_session form-control<?php echo e($errors->has('promote_session') ? ' is-invalid' : ''); ?>" name="promote_session" id="promote_session">
                                        <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.academic_year'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.academic_year'); ?> *</option>
                                        <?php $__currentLoopData = academicYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($session->id); ?>" <?php echo e(isset($year)? ($session->id == $year? 'selected':''):''); ?>><?php echo e($session->year); ?> - [ <?php echo e($session->title); ?>]</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('promote_session')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('promote_session')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                    <span class="text-danger d-none" role="alert" id="promote_session_error">
                                        <strong><?php echo app('translator')->get('lang.the_session_is_required'); ?></strong>
                                    </span>
                                </div>

                                              
                                <div class="col-lg-4 col-md-4 sm_mb_20 sm2_mb_20" id="select_class_div">
                                    <select class="niceSelect w-100 bb" id="select_class" name="promote_class" id="select_class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?></option>
                                    </select>
                                    <?php if($errors->has('promote_class')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('promote_class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-4 col-md-4 sm_mb_20 sm2_mb_20" id="select_section_div">
                                    <select class="niceSelect w-100 bb" id="select_section" name="promote_section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <?php if($errors->has('promote_section')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('promote_section')); ?></strong>
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
        <?php if(isset($students)): ?>
        <div class="row mt-40">
                

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.student_list'); ?> ( <?php echo e(isset($students) ? $students->count() : 0); ?>)</h3>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id_tt" class="display school-table" cellspacing="0" width="100%">
                            <thead>                               
                                <tr>
                                    <th><?php echo app('translator')->get('lang.admission'); ?><?php echo app('translator')->get('lang.no'); ?></th>
                                    <th><?php echo app('translator')->get('lang.roll'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                    <th><?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.class'); ?></th>
                                    <th><?php echo app('translator')->get('lang.father_name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.date_of_birth'); ?></th>
                                    <th><?php echo app('translator')->get('lang.gender'); ?></th>
                                    <th><?php echo app('translator')->get('lang.type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.phone'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = @$students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$data->admission_number); ?></td>
                                    <td><?php echo e(@$data->previous_roll_number); ?></td>
                                    <td><?php echo e(@$data->student->first_name .' '. $data->student->last_name); ?></td>
                                    <td><?php echo e(@$data->className ?$data->className->class_name:''); ?></td>

                                    <td><?php echo e(@$data->student->parents->fathers_name); ?></td>
                                    <td  data-sort="<?php echo e(strtotime($data->student->date_of_birth)); ?>" >
                                       
                                    <?php echo e(dateConvert($data->student->date_of_birth)); ?>


                                    </td>
                                    <td><?php echo e(@$data->student->gender->base_setup_name); ?></td>
                                    <td><?php echo e($data->student->category->category_name); ?></td>
                                    <td><?php echo e($data->student->mobile); ?></td>                                  
                                </tr>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
      <?php endif; ?>
    </div>
</section> 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/examination/previous_record.blade.php ENDPATH**/ ?>