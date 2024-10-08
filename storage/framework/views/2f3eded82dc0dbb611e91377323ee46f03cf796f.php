
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
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add-new-class-routine-store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm', 'onsubmit' => "return validateAddNewroutine()"])); ?>

        <div class="row">
            <div class="col-lg-12">  
                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                <input type="hidden" name="day" id="day" value="<?php echo e(@$day); ?>">
                <input type="hidden" name="class_id" id="class_id" value="<?php echo e(@$class_id); ?>">
                <input type="hidden" name="section_id" id="section_id" value="<?php echo e(@$section_id); ?>">
             
                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelectModal form-control" name="subject" id="subject">
                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.subject'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.subject'); ?> *</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(@$subject->subject_id); ?>" <?php echo e(isset($subject_id)? ($subject_id == $subject->subject_id?'selected':''):''); ?>><?php echo e(@$subject->subject->subject_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="text-danger" role="alert" id="subject_error"></span>                        
                    </div>
                </div>

                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelectModal form-control" name="room" id="room">
                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.room'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.room'); ?> *</option>
                            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(@$room->id); ?>" <?php echo e(isset($room_id)? ($room_id == $room->id?'selected':''):''); ?>><?php echo e(@$room->room_no); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="text-danger" role="alert" id="room_error"></span>
                    </div>
                </div>

                <div class="row no-gutters input-right-icon mt-25">
                    <div class="col">
                        <div class="input-effect">
                            <input class="primary-input time  form-control<?php echo e(@$errors->has('start_time') ? ' is-invalid' : ''); ?>" type="text" name="start_time" value="<?php echo e(isset($class_time)? $class_time->start_time: ''); ?>">
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
                                <input class="primary-input time  form-control<?php echo e(@$errors->has('end_time') ? ' is-invalid' : ''); ?>" type="text" name="end_time"  value="<?php echo e(isset($class_time)? $class_time->end_time: ''); ?>">
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
            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                    <button class="primary-btn fix-gr-bg submit" type="submit"><?php echo app('translator')->get('lang.save'); ?> <?php echo app('translator')->get('lang.information'); ?></button>
                </div>
            </div>
        </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/academics/add_new_exam_schedule_form.blade.php ENDPATH**/ ?>