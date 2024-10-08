
<?php $__env->startSection('title'); ?> 
Student Information Update
<?php $__env->stopSection(); ?>


<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/backEnd/')); ?>/css/croppie.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

<section class="sms-breadcrumb up_breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Student Information Update</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('student_list')); ?>"><?php echo app('translator')->get('lang.student_list'); ?></a>
                <a href="#">Student Information Update</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>


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
                <div class="white-box">
                    <div class="">
                        <div class="row mb-4">
                            <div class="col-lg-12 text-center">

                                <?php if($errors->any()): ?>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                    <?php if($error == "The email address has already been taken."): ?>
                                        <div class="error text-danger ">
                                            <?php echo e('The email address has already been taken, You can find out in student list or disabled student list'); ?>

                                        </div>
                                    <?php endif; ?> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                                <?php if($errors->any()): ?>
                                     <div class="error text-danger "><?php echo e('Something went wrong, please try again'); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.personal'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                        <input type="hidden" name="id" id="id" value="<?php echo e($student->id); ?>">


                        <div class="row mb-20">
                            <div class="col-md-4">
                                <img src="<?php echo e(file_exists(@$student->student_photo) ? asset($student->student_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?>" alt="Profile Pic" id="output" height="200px" width="200px"><br>
                                   <?php if($errors->has('photo')): ?>
                                        <center class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('photo')); ?></center>
                                    <?php endif; ?>
                                <br>

                                <span class="primary-btn-small-input">
                                    <label class="primary-btn small fix-gr-bg" for="photo"><?php echo app('translator')->get('lang.browse'); ?></label>
                                    <input type="file" class="d-none" value="<?php echo e(old('photo')); ?>" name="photo" id="photo" accept="image/*" onchange="loadFile(event)">
                                </span>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-40">
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" type="text" name="first_name" value="<?php echo e($student->first_name); ?>">
                                            <label><?php echo app('translator')->get('lang.first'); ?> <?php echo app('translator')->get('lang.name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('first_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('first_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" type="text" name="last_name" value="<?php echo e($student->last_name); ?>">
                                            <label><?php echo app('translator')->get('lang.last'); ?> <?php echo app('translator')->get('lang.name'); ?></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('last_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('last_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-20">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('gender') ? ' is-invalid' : ''); ?>" name="gender">
                                                <option data-display="<?php echo app('translator')->get('lang.gender'); ?> *" value=""><?php echo app('translator')->get('lang.gender'); ?> *</option>
                                                <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($student->gender_id)): ?>
                                                        <option value="<?php echo e($gender->id); ?>" <?php echo e($student->gender_id == $gender->id? 'selected': ''); ?>><?php echo e($gender->base_setup_name); ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo e($gender->id); ?>"><?php echo e($gender->base_setup_name); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </select>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('gender')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('gender')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-20">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control<?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" id="startDate" type="text" name="date_of_birth" value="<?php echo e(date('m/d/Y', strtotime($student->date_of_birth))); ?>" autocomplete="off">
                                                    <span class="focus-border"></span>
                                                    <label><?php echo app('translator')->get('lang.date_of_birth'); ?> <span>*</span></label>
                                                    <?php if($errors->has('date_of_birth')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('date_of_birth')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-20">
                                        <div class="input-effect">
                                            <input oninput="emailCheck(this)" class="primary-input form-control<?php echo e($errors->has('email_address') ? ' is-invalid' : ''); ?>" type="text" name="email_address" value="<?php echo e($student->email); ?>">
                                            <label><?php echo app('translator')->get('lang.email'); ?> <?php echo app('translator')->get('lang.address'); ?> <span></span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('email_address')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('email_address')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 mt-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('matric_number') ? ' is-invalid' : ''); ?>" type="text" name="matric_number" value="<?php echo e($student->matric_number); ?>">
                                            <label>Matric Number</label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('matric_number')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('matric_number')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-20">
                                        <div class="input-effect">
                                            <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('phone_number') ? ' is-invalid' : ''); ?>" type="text" name="phone_number" value="<?php echo e($student->mobile); ?>">
                                            <label><?php echo app('translator')->get('lang.phone'); ?> <?php echo app('translator')->get('lang.number'); ?></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('phone_number')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <div class="row mt-40 mb-20">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head">Departmental Details</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-20">
                            
                            <div class="col-lg-6">
                                <div class="input-effect" id="class-div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" name="class" id="classSelectStudent">
                                        <option data-display="<?php echo app('translator')->get('lang.class'); ?> *" value=""><?php echo app('translator')->get('lang.class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>" <?php echo e($student->class_id == $class->id? 'selected':''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_class_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="input-effect" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section" id="sectionSelectStudent">
                                       <option data-display="<?php echo app('translator')->get('lang.section'); ?> *" value=""><?php echo app('translator')->get('lang.section'); ?> *</option>
                                       <?php if(isset($student->section_id)): ?>
                                       <?php $__currentLoopData = $student->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($section->id); ?>" <?php echo e($student->section_id == $section->id? 'selected': ''); ?>><?php echo e($section->section_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <?php endif; ?>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>                            
                        </div>



                        <div class="row mt-40 mb-20">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head">Password</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-40 mb-20">
                            <div class="col-lg-6 mt-20">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" type="password" name="password" >
                                    <label>CHANGE PASSWORD</label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg submit">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.update_student'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</section>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>

        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
              var output = document.getElementById('output');
              output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
          };


        
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/st_addmision.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentInformation/student_edit.blade.php ENDPATH**/ ?>