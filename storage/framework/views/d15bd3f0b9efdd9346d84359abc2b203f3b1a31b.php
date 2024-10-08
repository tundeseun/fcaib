
<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('lang.manage'); ?> <?php echo app('translator')->get('lang.zoom'); ?> <?php echo app('translator')->get('lang.settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
 <style type="text/css">
        #selectStaffsDiv, .forStudentWrapper {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 55px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:focus + .slider {
            box-shadow: 0 0 1px linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
        .buttons_div_one{
        /* border: 4px solid #FFFFFF; */
        border-radius:12px;

        padding-top: 0px;
        padding-right: 5px;
        padding-bottom: 0px;
        margin-bottom: 4px;
        padding-left: 0px;
         }
        .buttons_div{
        border: 4px solid #19A0FB;
        border-radius:12px
        }
        .slider_zoom{
         margin-top: -8%;
         margin-bottom: 0;
         margin-left: 6%;
        }
    </style>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.manage'); ?> <?php echo app('translator')->get('lang.zoom_setting'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.virtual_class'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.settings'); ?></a>
            </div>
        </div>
    </div>
</section>
<?php if($setting->api_use_for==0 || auth()->user()->role_id ==1): ?>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <form action="<?php echo e(route('zoom.settings.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="white-box">
                                <div class="row p-0">
                                    <div class="col-lg-12">
                                        <h3 class="text-center"><?php echo app('translator')->get('lang.zoom_setting'); ?></h3>
                                        <hr>


                                        <div class="row mb-40 mt-40">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.meeting_approval'); ?></p>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('approval_type') ? ' is-invalid' : ''); ?>" name="approval_type">
                                                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> *</option>
                                                            <option value="0" <?php echo e(old('approval_type',$setting->approval_type) == 0? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.automatically'); ?> </option>
                                                            <option value="1" <?php echo e(old('approval_type',$setting->approval_type) == 1? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.manually'); ?> <?php echo app('translator')->get('lang.approve'); ?></option>
                                                            <option value="2" <?php echo e(old('approval_type',$setting->approval_type) == 2? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.no'); ?> <?php echo app('translator')->get('lang.registration'); ?> <?php echo app('translator')->get('lang.required'); ?></option>
                                                        </select>
                                                        <?php if($errors->has('approval_type')): ?>
                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                                <strong><?php echo e(@$errors->first('approval_type')); ?></strong>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.host_video'); ?> </p>
                                                    </div>
                                                    <div class="col-lg-7">
                                                            <div class="radio-btn-flex ml-20">
                                                                <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="host_video" id="host_video_on" value="1" class="common-radio relationButton" <?php echo e(old('host_video',$setting->host_video) == 1 ? 'checked': ''); ?>>
                                                                        <label for="host_video_on"><?php echo app('translator')->get('lang.enable'); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="host_video" id="host_video" value="0" class="common-radio relationButton" <?php echo e(old('host_video',$setting->host_video) == '0' ? 'checked': ''); ?>>
                                                                        <label for="host_video"><?php echo app('translator')->get('lang.disable'); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mb-40 mt-40">

                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"> <?php echo app('translator')->get('lang.auto_recording'); ?> ( <?php echo app('translator')->get('lang.for_paid_package'); ?> )</p>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('auto_recording') ? ' is-invalid' : ''); ?>" name="auto_recording">
                                                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> *</option>
                                                            <option value="none" <?php echo e(old('auto_recording',$setting->auto_recording) == 'none'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.none'); ?></option>
                                                            <option value="local" <?php echo e(old('auto_recording',$setting->auto_recording) == 'local'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.local'); ?></option>
                                                            <option value="cloud" <?php echo e(old('auto_recording',$setting->auto_recording) == 'cloud'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.cloud'); ?></option>
                                                        </select>
                                                        <?php if($errors->has('auto_recording')): ?>
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                            <strong><?php echo e(@$errors->first('auto_recording')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.participant_video'); ?> </p>
                                                    </div>
                                                    <div class="col-lg-7">
                                                            <div class="radio-btn-flex ml-20">
                                                                <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="participant_video" id="participant_video_on" value="1" class="common-radio relationButton" <?php echo e(old('participant_video',$setting->participant_video) == 1? 'checked': ''); ?>>
                                                                        <label for="participant_video_on"><?php echo app('translator')->get('lang.enable'); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="participant_video" id="participant_video" value="0" class="common-radio relationButton" <?php echo e(old('participant_video',$setting->participant_video) == 0? 'checked': ''); ?>>
                                                                        <label for="participant_video"><?php echo app('translator')->get('lang.disable'); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mb-40 mt-40">

                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.audio_options'); ?></p>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('audio') ? ' is-invalid' : ''); ?>" name="audio">
                                                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> *</option>
                                                            <option value="both" <?php echo e(old('audio',$setting->audio) == 'both' ? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.both'); ?></option>
                                                            <option value="telephony"  <?php echo e(old('audio',$setting->audio) == 'telephony'? 'selected' : ''); ?>><?php echo app('translator')->get('lang.telephony'); ?></option>
                                                            <option value="voip"  <?php echo e(old('audio',$setting->audio) == 'voip'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.voip'); ?></option>

                                                        </select>
                                                        <?php if($errors->has('audio')): ?>
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                            <strong><?php echo e(@$errors->first('audio')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.join_before_host'); ?> </p>
                                                    </div>
                                                    <div class="col-lg-7">
                                                            <div class=" radio-btn-flex ml-20">
                                                                <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="join_before_host" id="join_before_host_on" value="1" class="common-radio relationButton"  <?php echo e(old('join_before_host',$setting->join_before_host) == 1? 'checked': ''); ?>>
                                                                        <label for="join_before_host_on"><?php echo app('translator')->get('lang.enable'); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="join_before_host" id="join_before_host" value="0" class="common-radio relationButton"  <?php echo e(old('join_before_host',$setting->join_before_host) == 0? 'checked': ''); ?>>
                                                                        <label for="join_before_host"><?php echo app('translator')->get('lang.disable'); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-40 mt-40">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.pakage'); ?></p>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('package_id') ? ' is-invalid' : ''); ?>" name="package_id">
                                                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> *</option>
                                                            <option value="1" <?php echo e(old('package_id',$setting->package_id) == 1 ? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.basic'); ?> (<?php echo app('translator')->get('lang.free'); ?>)</option>
                                                            <option value="2" <?php echo e(old('package_id',$setting->package_id) == 2 ? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.pro'); ?></option>
                                                            <option value="3" <?php echo e(old('package_id',$setting->package_id) == 3 ? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.business'); ?></option>
                                                            <option value="4" <?php echo e(old('package_id',$setting->package_id) == 4 ? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.enterprise'); ?></option>
                                                        </select>
                                                        <?php if($errors->has('package_id')): ?>
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                            <strong><?php echo e(@$errors->first('package_id')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.waiting_room'); ?></p>
                                                    </div>
                                                    <div class="col-lg-7">
                                                            <div class=" radio-btn-flex ml-20">
                                                                <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="waiting_room" id="waiting_room_on" value="1" class="common-radio relationButton"  <?php echo e(old('waiting_room',$setting->waiting_room) == 1? 'checked': ''); ?>>
                                                                        <label for="waiting_room_on"><?php echo app('translator')->get('lang.enable'); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="waiting_room" id="waiting_room" value="0" class="common-radio relationButton"  <?php echo e(old('waiting_room',$setting->waiting_room) == 0? 'checked': ''); ?>>
                                                                        <label for="waiting_room"><?php echo app('translator')->get('lang.disable'); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row mb-40 mt-40">
                                            <div class="col-lg-6">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <input class="primary-input form-control<?php echo e($errors->has('api_key') ? ' is-invalid' : ''); ?>" type="text" name="api_key" value="<?php echo e(old('api_key',$setting->api_key)); ?>">
                                                    <label><?php echo app('translator')->get('lang.api_key'); ?><span>*</span> </label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('api_key')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('api_key')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"> <?php echo app('translator')->get('lang.mute_upon_entry'); ?> </p>
                                                    </div>
                                                    <div class="col-lg-7">

                                                            <div class="radio-btn-flex ml-20">
                                                                <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="mute_upon_entry" id="mute_upon_entr_on" value="1" class="common-radio relationButton" <?php echo e(old('mute_upon_entry',$setting->mute_upon_entry) == 1? 'checked': ''); ?>>
                                                                        <label for="mute_upon_entr_on"><?php echo app('translator')->get('lang.enable'); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="">
                                                                        <input type="radio" name="mute_upon_entry" id="mute_upon_entry" value="0" class="common-radio relationButton"  <?php echo e(old('mute_upon_entry',$setting->mute_upon_entry) == 0? 'checked': ''); ?>>
                                                                        <label for="mute_upon_entry"><?php echo app('translator')->get('lang.disable'); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row mb-40 mt-40">
                                            <div class="col-lg-6">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <input class="primary-input form-control<?php echo e($errors->has('secret_key') ? ' is-invalid' : ''); ?>" type="text" name="secret_key" value="<?php echo e(old('secret_key',$setting->secret_key)); ?>">
                                                    <label><?php echo app('translator')->get('lang.serect_key'); ?><span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('secret_key')): ?>
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong><?php echo e($errors->first('secret_key')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-5 d-flex">
                                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.api'); ?> use for</p>
                                                    </div>
                                                    <div class="col-lg-7">
                                                          <p class="slider_zoom"><?php echo app('translator')->get('lang.admin'); ?>/Lecturer</p>
                                                            <div class=" radio-btn-flex ml-20">
                                                              
                                                                <label class="switch">
                                                                    <input type="checkbox" name="api_use_for"
                                                                            class="weekend_switch_btn" <?php echo e(@$setting->api_use_for == 0? '':'checked'); ?>>
                                                                        <span class="slider round" style="background-color: #b336e2"></span>
                                                                    </label>
                                                                <div class="row">
                                                                

                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>

                                        <?php if(userPermission(570)): ?>
                                            <div class="row mt-40">
                                                <div class="col-lg-12 text-center">
                                                <button class="primary-btn fix-gr-bg" id="_submit_btn_admission">
                                                        <span class="ti-check"></span>
                                                        <?php echo app('translator')->get('lang.update'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php elseif($setting->api_use_for==1 && auth()->user()->role_id !=1): ?>  
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <form action="<?php echo e(route('zoom.ind.settings.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="white-box">
                            <div class="row p-0">
                                <div class="col-lg-12">
                                    <h3 class="text-center"><?php echo app('translator')->get('lang.zoom_setting'); ?></h3>
                                    <hr>
                                       <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control<?php echo e($errors->has('api_key') ? ' is-invalid' : ''); ?>" type="text" name="api_key" value="<?php echo e(auth()->user()->zoom_api_key_of_user); ?>">
                                                <label><?php echo app('translator')->get('lang.api_key'); ?><span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('api_key')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('api_key')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control<?php echo e($errors->has('secret_key') ? ' is-invalid' : ''); ?>" type="text" name="secret_key" value="<?php echo e(auth()->user()->zoom_api_serect_of_user); ?>">
                                                <label><?php echo app('translator')->get('lang.serect_key'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('secret_key')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('secret_key')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                  

                                 
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" id="_submit_btn_admission">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.update'); ?>
                                                </button>
                                            </div>
                                        </div>
                                  

                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/Modules/Zoom/Resources/views/settings.blade.php ENDPATH**/ ?>