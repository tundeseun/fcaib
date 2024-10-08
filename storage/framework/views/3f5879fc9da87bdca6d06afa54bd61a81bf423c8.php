<?php
$setting = generalSetting();
App::setLocale(getUserLanguage());
 
if (isset($setting->copyright_text)) {
    $copyright_text = $setting->copyright_text;
} else {
    $copyright_text = 'Copyright © 2020 All rights reserved | This template is made with by Codethemes';
}
if (isset($setting->logo)) {
    $logo = $setting->logo;
} else {
    $logo = 'public/uploads/settings/logo.png';
}

if (isset($setting->favicon)) {
    $favicon = $setting->favicon;
} else {
    $favicon = 'public/backEnd/img/favicon.png';
}

$login_background = App\SmBackgroundSetting::where([['is_default', 1], ['title', 'Login Background']])->first();

if (empty($login_background)) {
    $css = "background: url(" . url('public/backEnd/img/in_registration.png') . ")  no-repeat center; background-size: cover; ";
} else {
    if (!empty($login_background->image)) {
        $css = "background: url('" . url($login_background->image) . "')  no-repeat center;  background-size: cover;";
    } else {
        $css = "background:" . $login_background->color;
    }
}
?>


<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?> dir="rtl" class="rtl" <?php endif; ?> >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset('public/')); ?>/uploads/settings/favicon.png" type="image/png" />
    <title><?php echo e(@schoolConfig()->school_name ? @schoolConfig()->school_name : 'Infix Edu ERP'); ?> | <?php echo app('translator')->get('lang.student'); ?>  <?php echo app('translator')->get('lang.registration'); ?> </title>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="<?php echo e(url('/public/')); ?>/landing/css/toastr.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/select2/select2.css" />
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/fastselect.min.css" />
    <link rel="stylesheet" href="<?php echo e(url('public/backEnd/')); ?>/vendors/css/toastr.min.css"/>
    <link rel="stylesheet" href="<?php echo e(url('public/backEnd/')); ?>/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(url('public/backEnd/')); ?>/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(url('public/backEnd/')); ?>/css/style.css"/>
	<link rel="stylesheet" href="<?php echo e(url('Modules/ParentRegistration/Resources/assets/css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/backEnd/')); ?>/css/croppie.css">

</head>

<body class="reg_bg" style="<?php echo e(@$css); ?>"> 
    <!--================ Start Login Area =================-->
    <div class="reg_bg">

    </div>
    <section class="login-area  registration_area ">
        <div class="container">
            <?php if(\Session::has('success')): ?>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="text-center white-box single_registration_area">
                        <h1><?php echo e(__('Thank You')); ?></h1>
                        <h3><?php echo \Session::get('success'); ?></h3>
                        <a href="<?php echo e(url('/')); ?>" class="primary-btn small fix-gr-bg"> 
                            <?php echo app('translator')->get('lang.home'); ?>
                        </a>
                    </div>

                </div>
            </div>
            <?php else: ?>
            <div class="row justify-content-center align-items-center mt-20">
                <div class="col-lg-12">
                    <div class="text-center white-box single_registration_area">
                        <?php if($reg_setting->registration_permission == 1): ?>
                            <form method="POST" class="" action="<?php echo e(route('parentregistration-student-store')); ?>" id="parent-registration" enctype="multipart/form-data">
                        <?php endif; ?>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="reg_tittle mt-20 mb-20">
                                        <h2>New <?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.registration'); ?></h2>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img class="client_img" src="<?php echo e(asset('public/uploads/staff/demo/staff.jpg')); ?>" alt="Profile Pic"><br>
                                       <?php if($errors->has('photo')): ?>
                                            <center class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('photo')); ?></center>
                                       <?php else: ?>
                                            Upload Passport Photograph
                                        <?php endif; ?>
                                    <br>
                                    <span class="primary-btn-small-input">
                                        <label class="primary-btn small fix-gr-bg" for="photo"><?php echo app('translator')->get('lang.browse'); ?></label>
                                        <input type="file" class="d-none" value="<?php echo e(old('photo')); ?>" name="photo" id="photo">
                                    </span>
                                </div>
                            </div>
                             <?php echo e(csrf_field()); ?>

                            <input type="hidden" id="url" value="<?php echo e(url('/')); ?>"> 
                            <div class="row">
                                <div class="col-lg-4" id="academic-year-div">

                                    <select class="niceSelect w-100 bb form-control" name="academic_year" id="select-academic-year-school">
                                        <option data-display="Select Academic Year" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.academic_year'); ?></option>
                                        <?php $__currentLoopData = academicYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <option value="<?php echo e($academic_year->id); ?>"><?php echo e(@$academic_year->year); ?> [<?php echo e(@$academic_year->title); ?>]</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </select>
                                       
                                </div>

                                <div class="col-lg-4" id="class-div">
                                    <select class="w-100 niceSelect bb form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select-class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>" value=""><?php echo app('translator')->get('lang.select_class'); ?></option>
                                        
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-4 mt-30-md" id="section-div">
                                    <select class="w-100 niceSelect bb form-control<?php echo e($errors->has('current_section') ? ' is-invalid' : ''); ?>" id="select-section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='first_name' placeholder="<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.first_name'); ?> *" value="<?php echo e(old('first_name')); ?>" />
                                    </div>
                                    <?php if($errors->has('first_name')): ?>
                                    <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('first_name')); ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='last_name' placeholder="<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.last_name'); ?> *" value="<?php echo e(old('last_name')); ?>" />
                                    </div>
                                    <?php if($errors->has('last_name')): ?>
                                            <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('last_name')); ?></div>
                                        <?php endif; ?>
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

                                <div class="col-lg-6">
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

                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="email" name='student_email' id="student_email" placeholder="<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.email'); ?>" value="<?php echo e(old('student_email')); ?>"/>
                                    </div>
                                    <span class="text-danger error-message" id="student_email_error"></span>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='student_mobile' id="student_mobile" placeholder="<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.mobile'); ?>" value="<?php echo e(old('student_mobile')); ?>" />
                                    </div>
                                    <span class="text-danger error-message" id="student_mobile_error"></span>
                                </div>
                            </div>
                            <div class="mt-40">
                                <h5><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.info'); ?></h5>
                            </div>
                             <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='guardian_name' id="school_name" placeholder="<?php echo app('translator')->get('lang.guardian_name'); ?> *" value="<?php echo e(old('guardian_name')); ?>" />
                                    </div>
                                    <?php if($errors->has('guardian_name')): ?>
                                        <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('guardian_name')); ?></div>
                                    <?php endif; ?>
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
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='guardian_email' id="guardian_email" placeholder="<?php echo app('translator')->get('lang.guardian_email'); ?> *" value="<?php echo e(old('guardian_email')); ?>"/>
                                    </div>
                                    <?php if($errors->has('guardian_email')): ?>
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_email_error"><?php echo e($errors->first('guardian_email')); ?></div>
                                        <?php else: ?>
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_email_error"></div>
                                        <?php endif; ?>

                                    </span>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='guardian_mobile' id="guardian_mobile" placeholder="<?php echo app('translator')->get('lang.guardian_mobile'); ?> *" value="<?php echo e(old('guardian_mobile')); ?>"/>
                                    </div>
                                    <?php if($errors->has('guardian_mobile')): ?>
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_mobile_error"><?php echo e($errors->first('guardian_mobile')); ?></div>
                                        <?php else: ?>
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_mobile_error"></div>
                                        <?php endif; ?>
                                    </span>
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
                                            <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="UTME Result"
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
                                            <label class="primary-btn small fix-gr-bg" for="document_file_1">UTME Result</label>
                                            <input type="file" class="d-none" name="document_file_1" id="document_file_1">
                                        </button>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-4">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileTwoName" placeholder="SSCE Result"
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
                                            <label class="primary-btn small fix-gr-bg" for="document_file_2">SSCE Result</label>
                                            <input type="file" class="d-none" name="document_file_2" id="document_file_2">
                                        </button>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-4">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileThreeName" placeholder="Guarantors Letter"
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
                                            <label class="primary-btn small fix-gr-bg" for="document_file_3">Guarantors Letter</label>
                                            <input type="file" class="d-none" name="document_file_3" id="document_file_3">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>




  
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="float-left">
                                    <a type="submit" class="btn btn-danger text-white" href="<?php echo e(url('/')); ?>">
                                        <span class="ti-arrow-left"></span>
                                        Back
                                    </a>
                                    <button type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                        <span class="ti-check"></span>
                                       Apply
                                    </button>

                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    </form>
</section>
    <!--================ Start End Login Area =================-->
    <!--================ Footer Area =================-->
    <footer class="footer_area registration_footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                <p><?php echo $copyright_text; ?></p>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End Footer Area =================-->

    <script src="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/popper.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/bootstrap.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/nice-select.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/js/login.js"></script>
    <script src="<?php echo e(url('public/backEnd/js/validate.js')); ?>"></script>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/js/main.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/js/custom.js"></script>
    <script src="<?php echo e(url('/public/js/registration_custom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/toastr.min.js"></script> 
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
    </script>
    <?php $__env->stopSection(); ?>
    <?php echo Toastr::message(); ?>

    <?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\college\Modules/ParentRegistration\Resources/views/registration.blade.php ENDPATH**/ ?>