
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.general_settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.general_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.general_settings'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="student-details">
    <div class="container-fluid p-0">
        <?php echo $__env->make('backEnd.partials.alertMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-xl-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->get('lang.change_logo'); ?></h3>
                        </div>
                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data'])); ?>

                    <?php else: ?>
                        <?php if(userPermission(406)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-school-logo', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                      

                        <div class="white-box">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="text-center">
                                
                            <?php if(isset($editData->logo)): ?>
                                                      
                                <img class="img-fluid Img-100" src="<?php echo e(asset($editData->logo)); ?>" alt="" >
                            <?php else: ?>
                                <img class="img-fluid" src="<?php echo e(asset('public/uploads/settings/logo.png')); ?>" alt="">
                            <?php endif; ?>
                            </div>

                            <div class="mt-40">
                                <div class="text-center">
                                    <label class="primary-btn small fix-gr-bg" for="upload_logo"><?php echo app('translator')->get('lang.upload'); ?></label>
                                    <input type="file" class="d-none form-control" name="main_school_logo" id="upload_logo">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                    
                                <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" ><?php echo app('translator')->get('lang.change_logo'); ?></button></span>
                                <?php else: ?>
                                    <?php if(userPermission(406)): ?>
                                    <button class="primary-btn fix-gr-bg small  "    >
                                        <span class="ti-check"></span>
                                        <?php echo app('translator')->get('lang.save'); ?> 
                                    </button>
                                    <?php endif; ?> 
                                <?php endif; ?> 
                             
                                <?php if($errors->has('main_school_logo')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('main_school_logo')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>


                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="main-title">

                            <h3 class="mb-30"><?php echo app('translator')->get('lang.change_fav'); ?> </h3>
                        </div>

                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data'])); ?>

                    <?php else: ?>
                    <?php if(userPermission(406)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-school-logo', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>


                        <?php endif; ?>
                    <?php endif; ?>
                       
                        <div class="white-box">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="text-center">
                            <?php if(isset($editData->favicon) && !empty(@$editData->favicon)): ?>                            
                                <img class="img-fluid Img-50" src="<?php echo e(@$editData->favicon); ?>" alt="" >
                            <?php else: ?>
                                <img class="img-fluid" src="<?php echo e(asset('public/uploads/settings/favicon.png')); ?>" alt="">
                            <?php endif; ?>
                            </div>

                            <div class="mt-40">
                                <div class="text-center">
                                    <label class="primary-btn small fix-gr-bg" for="upload_favicon"><?php echo app('translator')->get('lang.upload'); ?></label>
                                    <input type="file" class="d-none form-control" name="main_school_favicon" id="upload_favicon">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" ><?php echo app('translator')->get('lang.change_fav'); ?></button></span>
                                <?php else: ?>
                                <?php if(userPermission(407)): ?>
                                    <button class="primary-btn fix-gr-bg small white_space">
                                            <span class="ti-check"></span>
                                        <?php echo app('translator')->get('lang.save'); ?>
                                    </button>
                                    <?php endif; ?>  
                                <?php endif; ?>  
                                <?php if($errors->has('main_school_favicon')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('main_school_favicon')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>     
            </div>

            <div class="col-lg-9 col-xl-9">
                <section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">
                        <?php echo app('translator')->get('lang.update'); ?>
                   </h3>
                </div>
            </div>
        </div>
        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data'])); ?>

        <?php else: ?>
            <?php if(userPermission(409)): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-general-settings-data', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                        <?php echo csrf_field(); ?>
                        <div class="row mb-40">
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('school_name') ? ' is-invalid' : ''); ?>"
                                    type="text" name="school_name" autocomplete="off" value="<?php echo e(isset($editData)? @$editData->school_name : old('school_name')); ?>">
                                    <label><?php echo app('translator')->get('lang.school_name'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('school_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('school_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('site_title') ? ' is-invalid' : ''); ?>"
                                    type="text" name="site_title" autocomplete="off" value="<?php echo e(isset($editData)? @$editData->site_title : old('site_title')); ?>">
                                    <label><?php echo app('translator')->get('lang.site_title'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('site_title')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('site_title')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                    type="text" name="phone" autocomplete="off" value="<?php echo e(isset($editData) ? @$editData->phone : old('phone')); ?>">
                                    <label><?php echo app('translator')->get('lang.phone'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('phone')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                    type="text" name="email" autocomplete="off" value="<?php echo e(isset($editData)? @$editData->email: old('email')); ?>">
                                    <label><?php echo app('translator')->get('lang.email'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row md-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="address" id="address"><?php echo e(isset($editData) ? @$editData->address : old('address')); ?></textarea>
                                    <label><?php echo app('translator')->get('lang.school_address'); ?> <span></span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row md-30 mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="copyright_text" id="copyright_text"><?php echo e(isset($editData) ? @$editData->copyright_text : old('copyright_text')); ?></textarea>
                                    <label><?php echo app('translator')->get('lang.copyright_text'); ?> <span></span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-30 mt-20">
                            <div class="col-lg-12 d-flex relation-button">
                                <p class="mb-0">Allow Hostel Booking</p>
                                <div class="d-flex ml-30 mt-3">
                                    <div>
                                        <input type="radio" name="hostel_booking" id="hostel_booking1" value="1" class="common-radio relationButton" <?php echo e(@$editData->hostel_booking == "1"? 'checked': ''); ?>>
                                        <label for="hostel_booking1"><?php echo app('translator')->get('lang.enable'); ?></label>
                                    </div>
                                    <div class="ml-3">
                                        <input type="radio" name="hostel_booking" id="hostel_booking2" value="0" class="common-radio relationButton" <?php echo e(@$editData->hostel_booking == "0"? 'checked': ''); ?>>
                                        <label for="hostel_booking2"><?php echo app('translator')->get('lang.disable'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-30 mt-20">
                            <div class="col-lg-12 d-flex relation-button">
                                <p class="mb-0">Allow Course Registration</p>
                                <div class="d-flex ml-30 mt-3">
                                    <div>
                                        <input type="radio" name="course_registration" id="course_registration1" value="1" class="common-radio relationButton" <?php echo e(@$editData->course_registration == "1"? 'checked': ''); ?>>
                                        <label for="course_registration1"><?php echo app('translator')->get('lang.enable'); ?></label>
                                    </div>
                                    <div class="ml-3">
                                        <input type="radio" name="course_registration" id="course_registration2" value="0" class="common-radio relationButton" <?php echo e(@$editData->course_registration == "0"? 'checked': ''); ?>>
                                        <label for="course_registration2"><?php echo app('translator')->get('lang.disable'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

        
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">

                            <?php if(env('APP_SYNC')==TRUE): ?>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" > <?php echo app('translator')->get('lang.update'); ?></button></span>
                            <?php else: ?>
                                <?php if(userPermission(409)): ?>
                                <button type="submit" class="primary-btn fix-gr-bg submit">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.update'); ?>
                                </button>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php echo e(Form::close()); ?>

    </div>
</div>
</section>
            </div>
        </div>
    </div>
</section>
<div class="modal fade admin-query question_image_preview"  >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.layout'); ?> <?php echo app('translator')->get('lang.image'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <img src="" width="100%" class="question_image_url" alt="">
            </div>

        </div>
    </div>
</div>
<script>
    
    $(document).on('click', '.layout_image', function(){

         console.log(this.src);
            // $('.question_image_url').src(this.src);
            $('.question_image_url').attr('src',this.src);   
            $('.question_image_preview').modal('show');
        })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/systemSettings/generalSettingsView.blade.php ENDPATH**/ ?>