
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.student_admission'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/backEnd/')); ?>/css/croppie.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.student_admission'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student_information'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student_admission'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="main-title xs_mt_0 mt_0_sm">
                    <h3 class="mb-0"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.student'); ?></h3>
                </div>
            </div>
              <?php if(userPermission(63)): ?>
               <div class="offset-lg-3 col-lg-3 text-right mb-20 col-sm-6">
                <a href="<?php echo e(route('import_student')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.import'); ?> Students
                </a>
            </div>
            <?php endif; ?>
        </div>
        <?php if(userPermission(65)): ?>
            <?php echo e(Form::open(['class' => 'form-horizontal studentadmission', 'files' => true, 'route' => 'student_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_form'])); ?>

        <?php endif; ?>
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
                        <div class="row">
                            
                                <div class="col-lg-8 col-6">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.personal'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <img src="<?php echo e(asset('public/uploads/staff/demo/staff.jpg')); ?>" alt="Profile Pic" id="output" height="200px" width="200px"><br>
                                       <?php if($errors->has('photo')): ?>
                                            <center class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('photo')); ?></center>
                                       <?php else: ?>
                                            Upload Passport Photograph *
                                        <?php endif; ?>
                                    <br>
                                    <span class="primary-btn-small-input justify-content-center">
                                        <label class="primary-btn small fix-gr-bg" for="photo"><?php echo app('translator')->get('lang.browse'); ?></label>
                                        <input type="file" class="d-none" value="<?php echo e(old('photo')); ?>" name="photo" id="photo" accept="image/*" onchange="loadFile(event)">
                                    </span>
                                </div>
                        </div>
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="row mb-40 mt-30">
                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('academic_year') ? ' is-invalid' : ''); ?>" name="academic_year">
                                        <option data-display="<?php echo app('translator')->get('lang.academic_year'); ?> *" value=""><?php echo app('translator')->get('lang.academic_year'); ?> *</option>
                                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($session->id); ?>" <?php echo e(old('session') == $session->id? 'selected': ''); ?>><?php echo e($session->year); ?>[<?php echo e($session->title); ?>]</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('academic_year')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('academic_year')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-6" id="class-div">
                                <select class="w-100 niceSelect bb form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" name="class" id="classSelectStudent">
                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>" value=""><?php echo app('translator')->get('lang.select_class'); ?>*</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>"><?php echo e($class->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                           
                           
                            <?php if(!empty(old('class'))): ?>
                            <?php
                                $old_sections = DB::table('sm_class_sections')->where('class_id', '=', old('class'))
                                ->join('sm_sections','sm_class_sections.section_id','=','sm_sections.id')
                                ->get();
                            ?>
                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section"
                                        id="sectionSelectStudent" >
                                       <option data-display="<?php echo app('translator')->get('lang.section'); ?> *" value=""><?php echo app('translator')->get('lang.section'); ?> *</option>
                                        <?php $__currentLoopData = $old_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option value="<?php echo e($old_section->id); ?>" <?php echo e(old('section')==$old_section->id ? 'selected' : ''); ?> >
                                            <?php echo e($old_section->section_name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php else: ?>

                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section" id="sectionSelectStudent">
                                       <option data-display="<?php echo app('translator')->get('lang.section'); ?> *" value=""><?php echo app('translator')->get('lang.section'); ?> *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>


                            <input type="hidden" name="admission_number"
                             value="<?php echo e($max_admission_id != ''? $max_admission_id + 1 : 1); ?>" >

                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" type="text" name="first_name" value="<?php echo e(old('first_name')); ?>">
                                    <label><?php echo app('translator')->get('lang.first'); ?> <?php echo app('translator')->get('lang.name'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('first_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" type="text" name="last_name" value="<?php echo e(old('last_name')); ?>">
                                    <label><?php echo app('translator')->get('lang.last'); ?> <?php echo app('translator')->get('lang.name'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('last_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control" name="gender">
                                        <option data-display="<?php echo app('translator')->get('lang.gender'); ?> *" value=""><?php echo app('translator')->get('lang.gender'); ?> *</option>
                                        <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($gender->id); ?>" <?php echo e(old('gender') == $gender->id? 'selected': ''); ?>><?php echo e($gender->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php if($errors->has('gender')): ?>
                                    <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('gender')); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-6 mt-3">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input mydob date form-control<?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                name="date_of_birth" value="<?php echo e(date('d/m/Y')); ?>" autocomplete="off" id="date_of_birth">
                                                <label><?php echo app('translator')->get('lang.date_of_birth'); ?> *</label>
                                                <span class="focus-border"></span>
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


                            <div class="col-lg-6 mt-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('student_email') ? ' is-invalid' : ''); ?>" type="text" name="student_email" value="<?php echo e(old('student_email')); ?>">
                                    <label><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.email'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('student_email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('student_email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('student_mobile') ? ' is-invalid' : ''); ?>" type="text" name="student_mobile" value="<?php echo e(old('student_mobile')); ?>">
                                    <label><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.mobile'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('student_mobile')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('student_mobile')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                            <div class="row mt-40 mb-20">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">Guardian Information</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                    <div class="col-lg-6">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input form-control<?php echo e($errors->has('guardian_name') ? ' is-invalid' : ''); ?>" type="text" name="guardian_name" value="<?php echo e(old('guardian_name')); ?>">
                                            <label>Guardian Name <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('guardian_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('guardian_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 d-flex relation-button">
                                        <p class="text-uppercase mb-0">
                                            <?php echo app('translator')->get('lang.guardian_relation'); ?>
                                        </p>
                                        <div class="d-flex radio-btn-flex ml-30">
                                            <div class="mr-20">
                                                <input type="radio" name="relationButton" id="relationFather" value="F" class="common-radio relationButton" <?php echo e(old('relationButton') == "F"? 'checked': ''); ?>>
                                                <label for="relationFather"><?php echo app('translator')->get('lang.father'); ?></label>
                                            </div>
                                            <div class="mr-20">
                                                <input type="radio" name="relationButton" id="relationMother" value="M" class="common-radio relationButton" <?php echo e(old('relationButton') == "M"? 'checked': ''); ?>>
                                                <label for="relationMother"><?php echo app('translator')->get('lang.mother'); ?></label>
                                            </div>
                                            <div>
                                                <input type="radio" name="relationButton" id="relationOther" value="O" class="common-radio relationButton"  <?php echo e(old('relationButton') != ""? (old('relationButton') == "O"? 'checked': ''): 'checked'); ?>>
                                                <label for="relationOther"><?php echo app('translator')->get('lang.Other'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('guardian_email') ? ' is-invalid' : ''); ?>" type="text" name="guardian_email" value="<?php echo e(old('guardian_email')); ?>">
                                        <label>Guardian Email <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('guardian_email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('guardian_email')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('guardian_mobile') ? ' is-invalid' : ''); ?>" type="text" name="guardian_mobile" value="<?php echo e(old('guardian_mobile')); ?>">
                                        <label>Guardian Mobile <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('guardian_mobile')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('guardian_mobile')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-40 mb-20">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">UTME (J.A.M.B) DETAILS</h4>
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('utme_number') ? ' is-invalid' : ''); ?>" type="text" name="utme_number" value="<?php echo e(old('utme_number')); ?>">
                                        <label>UTME Number <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('utme_number')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('utme_number')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('utme_score') ? ' is-invalid' : ''); ?>" type="text" name="utme_score" value="<?php echo e(old('utme_score')); ?>">
                                        <label>UTME Score <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('utme_score')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('utme_score')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-40">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">Relevant Documents</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-30 mt-20">
                                 <div class="col-lg-4">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="UTME Result *"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('document_file_2')): ?>
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong><?php echo e(@$errors->first('document_file_2')); ?></strong>
                                                            </span>
                                                    <?php endif; ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_1">UTME Result *</label>
                                                <input type="file" class="d-none" name="document_file_1" id="document_file_1">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderFileTwoName" placeholder="SSCE Result *"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('document_file_2')): ?>
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong><?php echo e(@$errors->first('document_file_2')); ?></strong>
                                                            </span>
                                                    <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_2">SSCE Result *</label>
                                                <input type="file" class="d-none" name="document_file_2" id="document_file_2">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderFileThreeName" placeholder="Guarantors Letter *"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('document_file_3')): ?>
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong><?php echo e(@$errors->first('document_file_3')); ?></strong>
                                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_3">Guarantors Letter *</label>
                                                <input type="file" class="d-none" name="document_file_3" id="document_file_3">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="primary-btn small fix-gr-bg">
                                <span class="ti-plus pr-2"></span>
                                Add Student
                            </button>



                    </div>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</section>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/croppie.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/st_addmision.js"></script>
<script>
        $(document).ready(function(){
            
            $(document).on('change','.cutom-photo',function(){
                let v = $(this).val();
                let v1 = $(this).data("id");
                console.log(v,v1);
                getFileName(v, v1);

            });

            function getFileName(value, placeholder){
                if (value) {
                    var startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
                    var filename = value.substring(startIndex);
                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                        filename = filename.substring(1);
                    }
                    $(placeholder).attr('placeholder', '');
                    $(placeholder).attr('placeholder', filename);
                }
            }

            
        })
          var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
              var output = document.getElementById('output');
              output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
          };
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentInformation/student_admission.blade.php ENDPATH**/ ?>