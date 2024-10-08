
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.exam_schedule'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.exam_schedule'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.examination'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.exam_schedule'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.exam_schedule'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php if(session()->has('message-success') != ""): ?>
                        <?php if(session()->has('message-success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message-success')); ?>

                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                     <?php if(session()->has('message-danger') != ""): ?>
                        <?php if(session()->has('message-danger')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session()->get('message-danger')); ?>

                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="white-box">
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value="0"><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e(@$class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> " value="0"><?php echo app('translator')->get('lang.select_section'); ?> </option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-lg-12 mt-20 text-right">
                                    <button onclick="filter()" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php if($exam_dates != ""): ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.exam_schedule'); ?></h3>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-3">

                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add-new-exam-schedule','method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm'])); ?>

                        <div class="white-box">
                            <?php echo csrf_field(); ?>
                            <div class="add-visitor">
                                <input type="hidden" name="class_id" id="class_id" value="<?php echo e(@$class_id); ?>">
                                <input type="hidden" name="section_id" id="section_id" value="<?php echo e(@$section_id); ?>">
                             
                                <div class="row mt-25">
                                    <div class="col-lg-12 mt-30-md">
                                        <select class="w-100 bb niceSelect form-control" name="subject" id="subject">
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
                                            <input class="primary-input date form-control<?php echo e($errors->has('day') ? ' is-invalid' : ''); ?>" id="startDate" type="text" placeholder="<?php echo app('translator')->get('lang.day'); ?>*" name="day">
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
                                            <input class="primary-input time  form-control<?php echo e(@$errors->has('start_time') ? ' is-invalid' : ''); ?>" type="text" name="start_time">
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
                                                <input class="primary-input time  form-control<?php echo e(@$errors->has('end_time') ? ' is-invalid' : ''); ?>" type="text" name="end_time">
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
                                    <button class="primary-btn fix-gr-bg submit" type="submit"><?php echo app('translator')->get('lang.save'); ?></button>
                                </div>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?> 
            </div>

            <div class="col-md-9">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <?php if(session()->has('success') != "" || session()->has('danger') != ""): ?>
                        <tr>
                            <td colspan="20">
                                <?php if(session()->has('success') != ""): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session()->get('success')); ?>

                                </div>
                                <?php else: ?>
                                <div class="alert alert-success">
                                    <?php echo e(session()->get('danger')); ?>

                                </div>
                            </td>
                                <?php endif; ?>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th width="10%">DAYS</th>
                            <th>EXAMINATION SCHEDULE</th>
                        </tr>
                        <?php $__currentLoopData = $exam_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <small>
                                    <?php echo e(@$day->day); ?>

                                </small>
                            </td>
                            <?php 
                                $schedules = App\SmExamSchedule::getSchedules($day->day, $class_id, $section_id);
                            ?>
                            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <small>
                                    <span class=""><?php echo e($schedule->subject_name); ?>(<?php echo e($schedule->subject_code); ?>)</span>
                                    <br>
                                    <span class=""><?php echo e($schedule->start_time); ?> - <?php echo e($schedule->end_time); ?></span></br>
                                    <span class="tt">Venue: <?php echo e($schedule->room_no); ?></span></br>
                                    <?php if(userPermission(248)): ?>

                                        <a href="<?php echo e(route('edit-exam-schedule', [$schedule->id, $section_id, $class_id])); ?>" class="modalLink" data-modal-size="modal-md" title="Edit Exam Schedule"><span class="ti-pencil-alt" id="addClassRoutine"></span></a>
                                    <?php endif; ?>
                                    <?php if(userPermission(249)): ?>

                                        <a href="<?php echo e(route('delete-exam-schedule-modal',$schedule->id)); ?>" class="modalLink" data-modal-size="modal-md" title="Delete Exam Schedule"><span class="ti-trash" id="addClassRoutine"></span></a>

                                    <?php endif; ?>
                                </small>
                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
 
    </div>
</section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<script type="text/javascript">

function get_url() {
    var urlPrefix   = '<?php echo e(@url()->current()); ?>'
    var urlSuffix = "";
    var class_id = 0;
    var section_id = 0;

    section_id = $('#select_section').val();
    class_id = $('#select_class').val();


    urlSuffix = "/"+class_id+"/"+section_id;

    var url = urlPrefix.substring(0, urlPrefix.length - 4) +urlSuffix;
    return url;
}

function filter() {
    var url = get_url();
    window.location.replace(url);
    //console.log(url);
}
</script>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/examination/exam_schedule_create.blade.php ENDPATH**/ ?>