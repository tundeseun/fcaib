
<script>
    if ($(".niceSelectModal").length) {
        $(".niceSelectModal").niceSelect();
    }
</script>
<style>
        .nice-select.bb .current {
          bottom: 10px;
         }

        .dloader_img_style{
            width: 70px;
            height: 70px;
        }

        .dloader {
            display: none;
        }

        .pre_dloader {
            display: show;
        }

</style>
<div class="container-fluid">
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-exam-schedule',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm'])); ?>

        <div class="row">
            <div class="col-lg-12">  
                <?php echo csrf_field(); ?>
                <div class="add-visitor">
                    <input type="hidden" name="class_id" id="class_id" value="<?php echo e(@$class_id); ?>">
                    <input type="hidden" name="section_id" id="section_id" value="<?php echo e(@$section_id); ?>">
                    <input type="hidden" name="id" value="<?php echo e(@$schedule->id); ?>">
                 
                    <div class="row mt-25">
                        <div class="col-lg-12 mt-30-md">
                            <select class="w-100 bb niceSelect form-control" name="subject" id="subject">
                                <option value="<?php echo e($schedule->subject->id); ?>"><?php echo e($schedule->subject->subject_name); ?></option>
                                <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.subject'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.subject'); ?> *</option>
                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(@$subject->id); ?>"><?php echo e(@$subject->subject_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="text-danger" role="alert" id="subject_error"></span>                        
                        </div>
                    </div>

                    <div class="row mt-25">
                        <div class="col-lg-12 mt-30-md">
                            <select class="w-100 bb niceSelect form-control" name="room" id="room">
                                <option value="<?php echo e($schedule->classRoom->id); ?>"><?php echo e($schedule->classRoom->room_no); ?></option>
                                <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.room'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.room'); ?> *</option>
                                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(@$room->id); ?>" <?php echo e(isset($room_id)? ($room_id == $room->id?'selected':''):''); ?>><?php echo e(@$room->room_no); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="text-danger" role="alert" id="room_error"></span>
                        </div>
                    </div>

                    <div class="row no-gutters input-right-icon mt-40">
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <input class="primary-input date form-control<?php echo e($errors->has('day') ? ' is-invalid' : ''); ?>" id="startDate" type="text" placeholder="<?php echo app('translator')->get('lang.day'); ?>*" name="day" value='<?php echo e(str_replace("-", "/", $schedule->day)); ?>'>
                                    <span class="focus-border"></span>
                                <?php if($errors->has('day')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('day')); ?></strong>
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

                    <div class="row no-gutters input-right-icon mt-25">
                        <div class="col">
                            <div class="input-effect">
                                <input class="primary-input time  form-control<?php echo e(@$errors->has('start_time') ? ' is-invalid' : ''); ?>" type="text" name="start_time" value="<?php echo e($schedule->start_time); ?>">
                                <label><?php echo app('translator')->get('lang.select_time'); ?> *</label>
                                <span class="focus-border"></span>
                                <?php if($errors->has('start_time')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e(@$errors->first('start_time')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="" type="button">
                                <i class="ti-timer"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row no-gutters input-right-icon mt-25">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input time  form-control<?php echo e(@$errors->has('end_time') ? ' is-invalid' : ''); ?>" type="text" name="end_time"  value="<?php echo e($schedule->end_time); ?>">
                                    <label><?php echo app('translator')->get('lang.end_time'); ?> *</label>
                                    <span class="focus-border"></span>
                                   <?php if($errors->has('end_time')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('end_time')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-timer"></i>
                                </button>
                            </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                    <button class="primary-btn fix-gr-bg submit" type="submit"><?php echo app('translator')->get('lang.save'); ?></button>
                </div>
            </div>
        </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/academics/edit_exam_schedule_form.blade.php ENDPATH**/ ?>