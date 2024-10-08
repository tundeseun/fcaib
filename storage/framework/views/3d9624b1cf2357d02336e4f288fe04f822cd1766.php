<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.subject'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.subject'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.academics'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.subject'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="d-flex my-3">
        <a  class="primary-btn small fix-gr-bg" href="/subject">
            <span class="ti-arrow-left pr-2"></span>
            Back
        </a>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">

                        <?php if(isset($subject)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject_update', 'method' => 'POST'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(258)): ?>
            
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject_store', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="main-title">
                                <h3 class="mb-30"><?php if(isset($subject)): ?>
                                        <?php echo app('translator')->get('lang.edit'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('lang.add'); ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->get('lang.subject'); ?>
                                </h3>
                            </div>
                            <hr/>
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if(session()->has('message-success')): ?>
                                          <div class="alert alert-success">
                                              <?php echo e(session()->get('message-success')); ?>

                                          </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                          <div class="alert alert-danger">
                                              <?php echo e(session()->get('message-danger')); ?>

                                          </div>
                                        <?php endif; ?>
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e(@$errors->has('subject_name') ? ' is-invalid' : ''); ?>" 
                                            type="text" name="subject_name" autocomplete="off" value="<?php echo e(isset($subject)? $subject->subject_name: old('subject_name')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($subject)? $subject->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.subject_name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('subject_name')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e(@$errors->first('subject_name')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('subject_code') ? ' is-invalid' : ''); ?>" type="text" name="subject_code" autocomplete="off" value="<?php echo e(isset($subject)? $subject->subject_code: old('subject_code')); ?>">
                                            <label><?php echo app('translator')->get('lang.subject_code'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('subject_code')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e(@$errors->first('subject_code')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('units') ? ' is-invalid' : ''); ?>" type="text" name="units" autocomplete="off" value="<?php echo e(isset($subject)? $subject->units: old('units')); ?>">
                                            <label>Units<span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('units')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e(@$errors->first('units')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('class') ? ' is-invalid' : ''); ?>" name="class">
                                                <?php if(isset($subject)): ?>
                                                <?php if($subject->class_id == 0): ?>
                                                <option value="0">Elective Course</option>
                                                <?php elseif($subject->class_id == -1): ?>
                                                <option value="-1">Compulsory Course</option>
                                                <?php else: ?>
                                                <option data-display="<?php echo e(@$subject->class->class_name); ?>" value="<?php echo e(@$subject->class_id); ?>">
                                                <?php endif; ?>
                                                <?php echo e(@$subject->classes->class_name); ?></option>
                                                <?php endif; ?>
                                                <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>*" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(@$class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e(@$class->class_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <option value="-1">Compulsory Course</option>
                                                <option value="0">Elective Course</option>
                                            </select>
                                            <?php if($errors->has('class')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e(@$errors->first('class')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="w-100 bb niceSelect form-control<?php echo e(@$errors->has('section') ? ' is-invalid' : ''); ?>" name="section">
                                                <?php if(isset($subject)): ?>
                                                <option data-display="<?php echo e(@$subject->sections->section_name); ?>" value="<?php echo e(@$subject->section_id); ?>"><?php echo e(@$subject->sections->section_name); ?></option>
                                                <?php endif; ?>
                                                <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?>*</option>
            
                                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-display="<?php echo e(@$section->section_name); ?>" value="<?php echo e(@$section->id); ?>" <?php echo e(isset($section_id)? ($section_id == $section->id? 'selected':''):''); ?>><?php echo e(@$section->section_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
                                            </select>
                                            <?php if($errors->has('section')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e(@$errors->first('section')); ?></strong>
                                            </span>
                                            <?php endif; ?>
            
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="d-flex radio-btn-flex">
                                            <?php if(isset($subject)): ?>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationFather" value="F" class="common-radio relationButton" <?php echo e(@$subject->subject_type == 'F'? 'checked':''); ?>>
                                                <label for="relationFather">1st Semester</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationMother" value="S" class="common-radio relationButton" <?php echo e(@$subject->subject_type == 'S'? 'checked':''); ?>>
                                                <label for="relationMother">2nd Semester</label>
                                            </div>
                                            <?php else: ?>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationFather" value="F" class="common-radio relationButton" checked>
                                                <label for="relationFather">1st Semester</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationMother" value="S" class="common-radio relationButton">
                                                <label for="relationMother">2nd Semester</label>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
            
                                 <?php 
                                  $tooltip = "";
                                  if(userPermission(258)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($subject)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/academics/add_new_course.blade.php ENDPATH**/ ?>