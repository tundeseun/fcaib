
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.general'); ?> <?php echo app('translator')->get('lang.settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.update'); ?> <?php echo app('translator')->get('lang.general_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('general-settings')); ?>"><?php echo app('translator')->get('lang.general_settings'); ?> <?php echo app('translator')->get('lang.view'); ?></a>
              </div>
        </div>
    </div>
</section>
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
                    <div class="">
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">


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
                            <div class="col-lg-6 d-flex relation-button">
                                <p class="text-uppercase mb-0">Allow Hostel Booking</p>
                                <div class="d-flex radio-btn-flex ml-30">
                                    <div class="mr-20">
                                        <input type="radio" name="hostel_booking" id="hostel_booking1" value="1" class="common-radio relationButton" <?php echo e(@$editData->hostel_booking == "1"? 'checked': ''); ?>>
                                        <label for="hostel_booking1"><?php echo app('translator')->get('lang.enable'); ?></label>
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" name="hostel_booking" id="hostel_booking2" value="0" class="common-radio relationButton" <?php echo e(@$editData->hostel_booking == "0"? 'checked': ''); ?>>
                                        <label for="hostel_booking2"><?php echo app('translator')->get('lang.disable'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-30 mt-20">
                            <div class="col-lg-6 d-flex relation-button">
                                <p class="text-uppercase mb-0">Allow Course Registration</p>
                                <div class="d-flex radio-btn-flex ml-30">
                                    <div class="mr-20">
                                        <input type="radio" name="course_registration" id="course_registration1" value="1" class="common-radio relationButton" <?php echo e(@$editData->course_registration == "1"? 'checked': ''); ?>>
                                        <label for="course_registration1"><?php echo app('translator')->get('lang.enable'); ?></label>
                                    </div>
                                    <div class="mr-20">
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/systemSettings/updateGeneralSettings.blade.php ENDPATH**/ ?>