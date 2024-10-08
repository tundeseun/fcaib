
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
    <div class="container-fluid p-0">
        <?php if(isset($subject)): ?>
          <?php if(userPermission(258)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('subject')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
           
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($subject)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.subject'); ?>
                            </h3>
                        </div>
                        <?php if(isset($subject)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject_update', 'method' => 'POST'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(258)): ?>
      
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject_store', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
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
                                            <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                                <?php if(isset($subject)): ?>
                                                <option data-display="<?php echo e(@$subject->class_name); ?>" value="<?php echo e(@$subject->class_id); ?>"><?php echo e(@$subject->class_name); ?></option>
                                                <?php endif; ?>
                                                <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>*" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(@$class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e(@$class->class_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <div class="input-effect" id="select_section_div">
                                            <select class="w-100 bb niceSelect form-control<?php echo e(@$errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                                <?php if(isset($subject)): ?>
                                                <option data-display="<?php echo e(@$subject->section_name); ?>" value="<?php echo e(@$subject->section_id); ?>"><?php echo e(@$subject->section_name); ?></option>
                                                <?php endif; ?>
                                                <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?>*</option>
                                            </select>
                                            <div class="pull-right loader loader_style" id="select_section_loader">
                                                <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                            </div>
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

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.subject'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               <?php if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != ""): ?>
                                <tr>
                                    <td colspan="5">
                                         <?php if(session()->has('message-success-delete')): ?>
                                          <div class="alert alert-success">
                                              <?php echo e(session()->get('message-success-delete')); ?>

                                          </div>
                                        <?php elseif(session()->has('message-danger-delete')): ?>
                                          <div class="alert alert-danger">
                                              <?php echo e(session()->get('message-danger-delete')); ?>

                                          </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.sl'); ?></th>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <td>Dept.</td>
                                    <td>Level</td>
                                    <th>Semester</th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=0; ?>
                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$i); ?></td>
                                    <td><?php echo e(@$subject->subject_name); ?></td>
                                    <td><?php echo e(@$subject->subject_code); ?></td>
                                    <td><?php echo e(@$subject->class_name); ?></td>
                                    <td><?php echo e(@$subject->section_name); ?></td>
                                    <td><?php echo e(@$subject->subject_type == 'F'? '1st':'2nd'); ?></td>
                                    
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                 <?php if(userPermission(259)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('subject_edit', [@$subject->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                               <?php endif; ?>
                                                <?php if(userPermission(260)): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteSubjectModal<?php echo e(@$subject->id); ?>"  href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                           <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                 <div class="modal fade admin-query" id="deleteSubjectModal<?php echo e(@$subject->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.subject'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                    <a href="<?php echo e(route('subject_delete', [@$subject->id])); ?>" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\college\resources\views/backEnd/academics/subject.blade.php ENDPATH**/ ?>