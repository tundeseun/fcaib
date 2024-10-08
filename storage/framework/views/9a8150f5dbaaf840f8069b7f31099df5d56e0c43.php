<?php if(userPermission(556)): ?>
<div class="col-lg-3">

    <div class="main-title">
        <h3 class="mb-30">
            <?php if(isset($editdata)): ?>
                <?php echo app('translator')->get('lang.edit'); ?>
            <?php else: ?>
                <?php echo app('translator')->get('lang.add'); ?>
            <?php endif; ?>
            <?php echo app('translator')->get('lang.virtual_class'); ?>
        </h3>
    </div>

    <?php if(isset($editdata)): ?>
        <form class="form-horizontal" action="<?php echo e(route('zoom.virtual-class.update',$editdata->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            
    <?php else: ?>
        <?php if(userPermission(561)): ?>
            <form class="form-horizontal" action="<?php echo e(route('zoom.virtual-class.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
        <?php endif; ?>
    <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($editdata)): ?>
                                            <option value="<?php echo e(@$class->id); ?>" <?php echo e(old('class',$editdata->class_id)  ? 'selected':''); ?>><?php echo e(@$class->class_name); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e(@$class->id); ?>" <?php echo e(old('class')  ? 'selected':''); ?>><?php echo e(@$class->class_name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e(@$errors->first('class')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        

                        <div class="row  mt-40">

                            
                            <div class="col-lg-12" id="select_section_div">                                
                                <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?> </option>
                                    <?php if(isset($editdata)): ?>
                                        <?php $__currentLoopData = $class_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(@$section->id); ?>" <?php echo e(old('section',$section->id) == $editdata->section_id ? 'selected':''); ?>><?php echo e(@$section->section_name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
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
                        <?php if(Auth::user()->role_id == 1 ): ?>
                        <div class="row mt-40">
                            <div class="col-lg-12" id="selectTeacherDiv">
                                <label for="teacher_ids" class="mb-2">Lecturer *</label>
                                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="">
                                                <?php if(isset($editdata)): ?>
                                                    <input type="checkbox" id="section<?php echo e(@$teacher->user_id); ?>"
                                                           class="common-checkbox form-control<?php echo e(@$errors->has('teacher_ids') ? ' is-invalid' : ''); ?>"
                                                           name="teacher_ids[]"
                                                           value="<?php echo e(@$teacher->user_id); ?>" <?php echo e($editdata->teachers->contains($teacher->user_id) ? 'checked': ''); ?>>
                                                    <label for="section<?php echo e(@$teacher->user_id); ?>"><?php echo e(@$teacher->full_name); ?></label>
                                                <?php else: ?>
                                                    <input type="radio" id="section<?php echo e(@$teacher->user_id); ?>"
                                                           class="common-checkbox form-control<?php echo e(@$errors->has('teacher_ids') ? ' is-invalid' : ''); ?>"
                                                           name="teacher_ids" value="<?php echo e(@$teacher->user_id); ?>">
                                                    <label for="section<?php echo e(@$teacher->user_id); ?>"> <?php echo e(@$teacher->full_name); ?></label>
                                                <?php endif; ?>
                                            </div>


                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($errors->has('teacher_ids')): ?>
                                        <span class="invalid-feedback" role="alert" style="display:block">
                                            <strong><?php echo e($errors->first('teacher_ids')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('topic') ? ' is-invalid' : ''); ?>"
                                    type="text" name="topic" autocomplete="off" value="<?php echo e(isset($editdata) ?  old('topic',$editdata->topic) : old('topic')); ?>">
                                    <label><?php echo app('translator')->get('lang.topic'); ?><span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('topic')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('topic')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="description" id="address"><?php echo e(isset($editdata) ? old('description',$editdata->description) : old('description')); ?></textarea>
                                    <label><?php echo app('translator')->get('lang.description'); ?></label>
                                    <span class="focus-border textarea"></span>
                                    <?php if($errors->has('description')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('description')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-6">
                                <label><?php echo app('translator')->get('lang.date_of_class'); ?><span>*</span></label>
                                <input class="primary-input date form-control" id="startDate" type="text" name="date" readonly="true" value="<?php echo e(isset($editdata) ? old('date',Carbon\Carbon::parse($editdata->date_of_meeting)->format('m/d/Y')): old('date',Carbon\Carbon::now()->format('m/d/Y'))); ?>" required>
                                <?php if($errors->has('date')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('date')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-6">
                                    <label><?php echo app('translator')->get('lang.time_of_class'); ?><span>*</span></label>
                                    <input class="primary-input time form-control<?php echo e(@$errors->has('time') ? ' is-invalid' : ''); ?>" type="text" name="time" value="<?php echo e(isset($editdata) ? old('time',$editdata->time_of_meeting): old('time')); ?>">
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('time')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e(@$errors->first('time')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input oninput="numberCheck(this)" type="number" class="primary-input form-control<?php echo e($errors->has('durration') ? ' is-invalid' : ''); ?>"
                                    type="text" name="durration" autocomplete="off" value="<?php echo e(isset($editdata)? old('durration',$editdata->meeting_duration) : old('durration')); ?>">
                                    <label><?php echo app('translator')->get('lang.duration_of_class'); ?><span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('durration')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('durration')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input oninput="numberCheck(this)" type="number" class="primary-input form-control<?php echo e($errors->has('time_before_start') ? ' is-invalid' : ''); ?>"
                                    type="text" name="time_before_start" autocomplete="off" value="<?php echo e(isset($editdata)? old('time_before_start',$editdata->time_before_start) : 10); ?>">
                                    <label><?php echo app('translator')->get('lang.class'); ?> <?php echo app('translator')->get('lang.start'); ?> <?php echo app('translator')->get('lang.before'); ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('time_before_start')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('time_before_start')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                    type="text" name="password" autocomplete="off" value="<?php echo e(isset($editdata) ?  old('password',$editdata->password) : old('password',123456)); ?>">
                                    <label><?php echo app('translator')->get('lang.password'); ?><span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <div class="row mt-30">
                        <div class="col-lg-12 d-flex">
                            <p class="text-uppercase fw-500 mb-10" style="width: 130px;"><?php echo app('translator')->get('lang.zoom_recurring'); ?></p>
                            <div class="d-flex radio-btn-flex ml-40">
                                <?php if(isset($editdata)): ?>
                                    <div class="mr-30">
                                        <input type="radio" name="is_recurring" id="recurring_options1" value="1" class="common-radio recurring-type" <?php echo e(old('is_recurring',$editdata->is_recurring) == 1? 'checked': ''); ?>>
                                    <label for="recurring_options1"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30">
                                        <input type="radio" name="is_recurring" id="recurring_options2" value="0" class="common-radio recurring-type" <?php echo e(old('is_recurring',$editdata->is_recurring) == 0? 'checked': ''); ?>>
                                        <label for="recurring_options2"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php else: ?>
                                    <div class="mr-30">
                                        <input type="radio" name="is_recurring" id="recurring_options1" value="1" class="common-radio recurring-type" <?php echo e(old('is_recurring') == 1? 'checked': ''); ?>>
                                        <label for="recurring_options1"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30">
                                        <input type="radio" name="is_recurring" id="recurring_options2" value="0" class="common-radio recurring-type" <?php echo e(old('is_recurring') == 0? 'checked': ''); ?>>
                                        <label for="recurring_options2"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-20 recurrence-section-hide">
                        <div class="col-lg-6">
                            
                            <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('recurring_type') ? ' is-invalid' : ''); ?>" id="recurring_type" name="recurring_type">
                                <option data-display="<?php echo app('translator')->get('lang.type'); ?> *" value=""><?php echo app('translator')->get('lang.type'); ?> *</option>
                                <?php if(isset($editdata)): ?>
                                    <option value="1" <?php echo e(old('recurring_type',$editdata->recurring_type) == 1  ? 'selected':''); ?> ><?php echo app('translator')->get('lang.zoom_recurring_daily'); ?></option>
                                    <option value="2" <?php echo e(old('recurring_type',$editdata->recurring_type) == 2  ? 'selected':''); ?> ><?php echo app('translator')->get('lang.zoom_recurring_weekly'); ?></option>
                                    <option value="3" <?php echo e(old('recurring_type',$editdata->recurring_type) == 3  ? 'selected':''); ?>><?php echo app('translator')->get('lang.zoom_recurring_monthly'); ?> </option>
                                <?php else: ?>
                                    <option value="1" <?php echo e(old('recurring_type') == 1  ? 'selected':''); ?> > <?php echo app('translator')->get('lang.zoom_recurring_daily'); ?></option>
                                    <option value="2" <?php echo e(old('recurring_type') == 2  ? 'selected':''); ?> > <?php echo app('translator')->get('lang.zoom_recurring_weekly'); ?></option>
                                    <option value="3" <?php echo e(old('recurring_type') == 3  ? 'selected':''); ?>>  <?php echo app('translator')->get('lang.zoom_recurring_monthly'); ?> </option>
                                <?php endif; ?>
                            </select>
                            <?php if($errors->has('recurring_type')): ?>
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e(@$errors->first('recurring_type')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                                
                                <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('recurring_repect_day') ? ' is-invalid' : ''); ?>" id="recurring_repect_day" name="recurring_repect_day">
                                        <option data-display="<?php echo app('translator')->get('lang.select'); ?> *" value=""><?php echo app('translator')->get('lang.zoom_recurring_repect'); ?> *</option>
                                    <?php for($i = 1; $i <= 15; $i++): ?>
                                        <?php if(isset($editdata)): ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e(old('recurring_repect_day',$editdata->recurring_repect_day) == $i ? 'selected':''); ?> ><?php echo e($i); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e(old('recurring_repect_day') == $i ? 'selected':''); ?>  ><?php echo e($i); ?></option>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </select>
                                <?php if($errors->has('recurring_repect_day')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e(@$errors->first('recurring_repect_day')); ?></strong>
                                </span>
                                <?php endif; ?>
                        </div>
                    </div>

                    

                    
                    <div class="row mt-30 day_hide" id="day_hide">
                        <div class="col-lg-12 ml-15">
                            <label><?php echo app('translator')->get('lang.occurs_on'); ?> *</label>
                            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row ml-15">
                                            <div class="">
                                                <?php if(isset($editdata)): ?>
                                                    <input type="checkbox" id="day<?php echo e(@$day->id); ?>"
                                                           class="common-checkbox form-control<?php echo e(@$errors->has('days') ? ' is-invalid' : ''); ?>"
                                                           name="days[]"
                                                           value="<?php echo e(@$day->zoom_order); ?>"<?php echo e(in_array($day->zoom_order,$assign_day ?? '')? 'checked':''); ?> >
                                                    <label for="day<?php echo e(@$day->id); ?>"><?php echo e(@$day->name); ?></label>
                                                <?php else: ?>
                                                    <input type="checkbox" id="day<?php echo e(@$day->id); ?>"
                                                           class="common-checkbox form-control<?php echo e(@$errors->has('days') ? ' is-invalid' : ''); ?>"
                                                           name="days[]" value="<?php echo e(@$day->zoom_order); ?>">
                                                    <label for="day<?php echo e(@$day->id); ?>"> <?php echo e(@$day->name); ?></label>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($errors->has('days')): ?>
                                        <span class="invalid-feedback" role="alert" style="display:block">
                                            <strong><?php echo e($errors->first('days')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mt-30 recurrence-section-hide">
                        <div class="col-lg-6">
                            <label><?php echo app('translator')->get('lang.zoom_recurring_end'); ?> *</label>
                            <input class="primary-input date form-control" sty id="recurring_end_date" type="text" name="recurring_end_date" readonly="true" value="<?php echo e(isset($editdata) ? old('recurring_end_date',Carbon\Carbon::parse($editdata->recurring_end_date)->format('m/d/Y')): old('recurring_end_date')); ?>" required>
                            <?php if($errors->has('recurring_end_date')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('recurring_end_date')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row no-gutters input-right-icon mt-30">
                        <div class="col">
                            <div class="input-effect">
                                <input
                                    class="primary-input form-control <?php echo e($errors->has('attached_file') ? ' is-invalid' : ''); ?>"
                                    readonly="true" type="text"
                                    placeholder="<?php echo e(isset($editdata->attached_file) && @$editdata->attached_file != ""? getFilePath3(@$editdata->attached_file) : 'Attach File'); ?>"
                                    id="placeholderUploadContent">
                                <span class="focus-border"></span>
                                <?php if($errors->has('attached_file')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('attached_file')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="primary-btn-small-input" type="button">
                                <label class="primary-btn small fix-gr-bg"
                                    for="upload_content_file"><?php echo app('translator')->get('lang.browse'); ?></label>
                                <input type="file" class="d-none form-control" name="attached_file"
                                    id="upload_content_file">
                            </button>
                        </div>
                    </div>

                    
                    <div class="row mt-40">
                        <div class="col-lg-12 d-flex">
                            <p class="text-uppercase fw-500 mb-10" style="width: 130px;"><?php echo app('translator')->get('lang.change_default_settings'); ?></p>
                            <div class="d-flex radio-btn-flex ml-40">
                                    <div class="mr-30 row">
                                        <input type="radio" name="chnage-default-settings" id="change_default_settings" value="1" <?php if(isset($editdata)): ?> checked <?php endif; ?> class="common-radio chnage-default-settings relationButton">
                                        <label for="change_default_settings"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="chnage-default-settings" id="change_default_settings2" value="0" <?php if(!isset($editdata)): ?> checked <?php endif; ?> class="common-radio chnage-default-settings relationButton">
                                        <label for="change_default_settings2"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-40 default-settings">
                        <div class="col-lg-12 d-flex">
                            <p class="text-uppercase fw-500 mb-10" style="width: 130px;"><?php echo app('translator')->get('lang.join_before_host'); ?></p>
                            <div class="d-flex radio-btn-flex ml-40">
                                <?php if(isset($editdata)): ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="join_before_host" id="metting_options1" value="1" class="common-radio relationButton" <?php echo e(old('join_before_host',$editdata->join_before_host) == 1 ? 'checked': ''); ?>>
                                        <label for="metting_options1"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="join_before_host" id="metting_options2" value="0" class="common-radio relationButton" <?php echo e(old('join_before_host',$editdata->join_before_host) == 0 ? 'checked': ''); ?>>
                                        <label for="metting_options2"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php else: ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="join_before_host" id="metting_options1" value="1" class="common-radio relationButton" <?php echo e(old('join_before_host', $default_settings->join_before_host) == 1? 'checked': ''); ?>>
                                        <label for="metting_options1"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="join_before_host" id="metting_options2" value="0" class="common-radio relationButton" <?php echo e(old('join_before_host', $default_settings->join_before_host) == 0? 'checked': ''); ?>>
                                        <label for="metting_options2"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-30 default-settings">
                        <div class="col-lg-12 d-flex">
                            <p class="text-uppercase fw-500 mb-10" style="width: 130px;"><?php echo app('translator')->get('lang.host_video'); ?></p>
                            <div class="d-flex radio-btn-flex ml-40">
                                <?php if(isset($editdata)): ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="host_video" id="host_video1" value="1" class="common-radio relationButton" <?php echo e(old('host_video',$editdata->host_video) == 1? 'checked': ''); ?>>
                                        <label for="host_video1"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="host_video" id="host_video2" value="0" class="common-radio relationButton" <?php echo e(old('host_video',$editdata->host_video) == 0? 'checked': ''); ?>>
                                        <label for="host_video2"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php else: ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="host_video" id="host_video1" value="1" class="common-radio relationButton" <?php echo e(old('host_video',$default_settings->host_video) == 1? 'checked': ''); ?>>
                                        <label for="host_video1"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="host_video" id="host_video2" value="0" class="common-radio relationButton" <?php echo e(old('host_video',$default_settings->host_video) == 0? 'checked': ''); ?>>
                                        <label for="host_video2"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-30 default-settings">
                        <div class="col-lg-12 d-flex">
                            <p class="text-uppercase fw-500 mb-10" style="width: 130px;"><?php echo app('translator')->get('lang.participant_video'); ?></p>
                            <div class="d-flex radio-btn-flex ml-40">
                                <?php if(isset($editdata)): ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="participant_video" id="host_video3" value="1" class="common-radio" <?php echo e(old('participant_video', $editdata->participant_video) == 1 ? 'checked': ''); ?>>
                                        <label for="host_video3"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="participant_video" id="host_video4" value="0" class="common-radio" <?php echo e(old('participant_video', $editdata->participant_video) == 0 ? 'checked': ''); ?>>
                                        <label for="host_video4"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php else: ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="participant_video" id="host_video3" value="1" class="common-radio" <?php echo e(old('participant_video', $default_settings->participant_video) == 1 ? 'checked': ''); ?>>
                                        <label for="host_video3"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="participant_video" id="host_video4" value="0" class="common-radio" <?php echo e(old('participant_video', $default_settings->participant_video) == 0 ? 'checked': ''); ?>>
                                        <label for="host_video4"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-30 default-settings">
                        <div class="col-lg-12 d-flex">
                            <p class="text-uppercase fw-500 mb-10" style="width: 130px;"><?php echo app('translator')->get('lang.mute_upon_entry'); ?> </p>
                            <div class="d-flex radio-btn-flex ml-40">
                                <?php if(isset($editdata)): ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="mute_upon_entry" id="mute_upon_entry_on" value="1" class="common-radio" <?php echo e(old('mute_upon_entry', $editdata->mute_upon_entry) == 1 ? 'checked': ''); ?>>
                                        <label for="mute_upon_entry_on"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="mute_upon_entry" id="mute_upon_entry" value="0" class="common-radio" <?php echo e(old('mute_upon_entry', $editdata->mute_upon_entry) == 0 ? 'checked': ''); ?>>
                                        <label for="mute_upon_entry"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php else: ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="mute_upon_entry" id="mute_upon_entry_on" value="1" class="common-radio" <?php echo e(old('mute_upon_entry', $default_settings->mute_upon_entry) == 1 ? 'checked': ''); ?>>
                                        <label for="mute_upon_entry_on"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="mute_upon_entry" id="mute_upon_entry" value="0" class="common-radio" <?php echo e(old('mute_upon_entry', $default_settings->mute_upon_entry) == 0 ? 'checked': ''); ?>>
                                        <label for="mute_upon_entry"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-30 default-settings">
                        <div class="col-lg-12 d-flex">
                            <p class="text-uppercase fw-500 mb-10" style="width: 130px;"><?php echo app('translator')->get('lang.waiting_room'); ?></p>
                            <div class="d-flex radio-btn-flex ml-40">
                                <?php if(isset($editdata)): ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="waiting_room" id="waiting_room_on" value="1" class="common-radio" <?php echo e(old('waiting_room', $editdata->waiting_room) == 1 ? 'checked': ''); ?>>
                                        <label for="waiting_room_on"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="waiting_room" id="waiting_room" value="0" class="common-radio" <?php echo e(old('waiting_room', $editdata->waiting_room) == 0 ? 'checked': ''); ?>>
                                        <label for="waiting_room"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php else: ?>
                                    <div class="mr-30 row">
                                        <input type="radio" name="waiting_room" id="waiting_room_on" value="1" class="common-radio" <?php echo e(old('waiting_room', $default_settings->waiting_room) == 1 ? 'checked': ''); ?>>
                                        <label for="waiting_room_on"><?php echo app('translator')->get('lang.yes'); ?></label>
                                    </div>
                                    <div class="mr-30 row">
                                        <input type="radio" name="waiting_room" id="waiting_room" value="0" class="common-radio" <?php echo e(old('waiting_room', $default_settings->waiting_room) == 0 ? 'checked': ''); ?>>
                                        <label for="waiting_room"><?php echo app('translator')->get('lang.no'); ?></label>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if($default_settings->package_id != 1 ): ?>
                        <div class="row mt-30 default-settings">
                            <div class="col-lg-12 row">
                                <p class="text-uppercase fw-500 mb-10 col-lg-6" style="width: 130px;"><?php echo app('translator')->get('lang.auto_recording'); ?></p>
                                <div class="col-lg-6">
                                    <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('auto_recording') ? ' is-invalid' : ''); ?>" name="auto_recording">
                                        <?php if(isset($editdata)): ?>
                                            <option value="none" <?php echo e(old('auto_recording',$editdata->auto_recording) == 'none'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.none'); ?></option>
                                            <option value="local" <?php echo e(old('auto_recording',$editdata->auto_recording) == 'local'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.local'); ?></option>
                                            <option value="cloud" <?php echo e(old('auto_recording',$editdata->auto_recording) == 'cloud'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.cloud'); ?></option>
                                        <?php else: ?>
                                            <option value="none" <?php echo e(old('auto_recording',$default_settings->auto_recording) == 'none'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.none'); ?></option>
                                            <option value="local" <?php echo e(old('auto_recording',$default_settings->auto_recording) == 'local'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.local'); ?></option>
                                            <option value="cloud" <?php echo e(old('auto_recording',$default_settings->auto_recording) == 'cloud'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.cloud'); ?></option>
                                        <?php endif; ?>
                                    </select>
                                    <?php if($errors->has('auto_recording')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e(@$errors->first('auto_recording')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mt-30 default-settings">
                        <div class="col-lg-12 row">
                            <p class="text-uppercase fw-500 mb-10 col-lg-6" style="width: 130px;"><?php echo app('translator')->get('lang.audio_options'); ?></p>
                            <div class="col-lg-6">
                                <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('audio') ? ' is-invalid' : ''); ?>" name="audio">
                                    <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.package'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.package'); ?> *</option>
                                    <?php if(isset($editdata)): ?>
                                        <option value="both" <?php echo e(old('audio',$editdata->audio) == 'both' ? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.both'); ?></option>
                                        <option value="telephony"  <?php echo e(old('audio',$editdata->audio) == 'telephony'? 'selected' : ''); ?>><?php echo app('translator')->get('lang.telephony'); ?></option>
                                        <option value="voip"  <?php echo e(old('audio',$editdata->audio) == 'voip'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.voip'); ?></option>
                                    <?php else: ?>
                                        <option value="both" <?php echo e(old('audio',$default_settings->audio) == 'both' ? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.both'); ?></option>
                                        <option value="telephony"  <?php echo e(old('audio',$default_settings->audio) == 'telephony'? 'selected' : ''); ?>><?php echo app('translator')->get('lang.telephony'); ?></option>
                                        <option value="voip"  <?php echo e(old('audio',$default_settings->audio) == 'voip'? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.voip'); ?></option>
                                    <?php endif; ?>

                                </select>
                                <?php if($errors->has('audio')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e(@$errors->first('audio')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-30 default-settings">
                        <div class="col-lg-12 row">
                            <p class="text-uppercase fw-500 mb-10 col-lg-6" style="width: 130px;"><?php echo app('translator')->get('lang.meeting_approval'); ?></p>
                            <div class="col-lg-6">
                                <select class="w-100 bb niceSelect form-control <?php echo e(@$errors->has('approval_type') ? ' is-invalid' : ''); ?>" name="approval_type">
                                    <?php if(isset($editdata)): ?>
                                        <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.package'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.package'); ?> *</option>
                                        <option value="0" <?php echo e(old('approval_type',$editdata->approval_type) == 0? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.automatically'); ?></option>
                                        <option value="1" <?php echo e(old('approval_type',$editdata->approval_type) == 1? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.manually'); ?> <?php echo app('translator')->get('lang.approve'); ?></option>
                                        <option value="2" <?php echo e(old('approval_type',$editdata->approval_type) == 2? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.no'); ?> <?php echo app('translator')->get('lang.registration'); ?> <?php echo app('translator')->get('lang.required'); ?></option>
                                    <?php else: ?>
                                        <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.package'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.package'); ?> *</option>
                                        <option value="0" <?php echo e(old('approval_type',$default_settings->approval_type) == 0? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.automatically'); ?></option>
                                        <option value="1" <?php echo e(old('approval_type',$default_settings->approval_type) == 1? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.manually'); ?> <?php echo app('translator')->get('lang.approve'); ?></option>
                                        <option value="2" <?php echo e(old('approval_type',$default_settings->approval_type) == 2? 'selected' : ''); ?> ><?php echo app('translator')->get('lang.no'); ?> <?php echo app('translator')->get('lang.registration'); ?> <?php echo app('translator')->get('lang.required'); ?></option>
                                    <?php endif; ?>

                                </select>
                                <?php if($errors->has('approval_type')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e(@$errors->first('approval_type')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    
                    <?php
                    $tooltip = "";
                        if(userPermission(561) )
                        {
                            $tooltip = "";
                        }else{
                            $tooltip = "You have no permission to add";
                        }
                    ?>
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                <span class="ti-check"></span>
                                <?php if(isset($editdata)): ?>
                                    <?php echo app('translator')->get('lang.update'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.save'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.virtual_class'); ?>

                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\infix\Modules/Zoom\Resources/views/virtualClass/includes/form.blade.php ENDPATH**/ ?>