
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.exam_attendance'); ?> <?php echo app('translator')->get('lang.create'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php $__env->startPush('css'); ?>
    <style>
        .primary-btn.mr-40.fix-gr-bg.nowrap.submit {
            position: relative;
            left: -85px;
        }
    </style>
<?php $__env->stopPush(); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.exam_attendance'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.examination'); ?></a>
                <a href="<?php echo e(route('exam_attendance')); ?>"><?php echo app('translator')->get('lang.exam_attendance'); ?></a>
                <a href="<?php echo e(route('exam_attendance_create')); ?>"><?php echo app('translator')->get('lang.exam_attendance'); ?> <?php echo app('translator')->get('lang.create'); ?></a>
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
              
                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_attendance_create', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('exam') ? ' is-invalid' : ''); ?>" name="exam">
                                    <option data-display="<?php echo app('translator')->get('lang.select_exam'); ?> *" value=""><?php echo app('translator')->get('lang.select_exam'); ?> *</option>
                                    <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$exam->id); ?>" <?php echo e(isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''); ?>><?php echo e(@$exam->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('exam')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('exam')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="class_subject" name="class">
                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col-lg-3 mt-30-md" id="select_class_subject_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?> select_subject" id="select_class_subject" name="subject">
                                    <option data-display="<?php echo app('translator')->get('lang.select_subject'); ?> *" value=""><?php echo app('translator')->get('lang.select_subject'); ?> *</option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_subject_loader">
                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                </div>
                                <?php if($errors->has('subject')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('subject')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-3 mt-30-md" id="m_select_subject_section_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> m_select_subject_section" id="m_select_subject_section" name="section">
                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> " value=" "><?php echo app('translator')->get('lang.select_section'); ?> </option>
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
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    <?php echo app('translator')->get('lang.search'); ?>
                                </button>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
<?php if(isset($students)): ?>
<?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam-attendance-store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

<div class="row mt-40">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->get('lang.exam_attendance'); ?> | <small><?php echo app('translator')->get('lang.class'); ?>: <?php echo e($search_info['class_name']); ?>, <?php echo app('translator')->get('lang.section'); ?>: <?php echo e($search_info['section_name']); ?>,  <?php echo app('translator')->get('lang.subject'); ?>: <?php echo e($search_info['subject_name']); ?></small></h3>
                        </div>
                    </div>
                </div>             

                <input class="examId" type="hidden" name="exam_id" value="<?php echo e(@$exam_id); ?>">
                <input class="subjectId" type="hidden" name="subject_id" value="<?php echo e(@$subject_id); ?>">
                <input class="classId" type="hidden" name="class_id" value="<?php echo e(@$class_id); ?>">
                <input class="sectionId" type="hidden" name="section_id" value="<?php echo e(@$section_id); ?>">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <table class="display school-table school-table-style shadow-none p-0" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="9">
                                            <?php if(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th width="25%"><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th width="25%"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                        <th width="25%"><?php echo app('translator')->get('lang.class_Sec'); ?></th>
                                        <th width="25%"><?php echo app('translator')->get('lang.roll_number'); ?></th>
                                        <th width="25%"><?php echo app('translator')->get('lang.attendance'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                    <?php if(count($exam_attendance_childs) == 0): ?>                                   
                               
                                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(@$student->admission_no); ?><input type="hidden" name="id[]" value="<?php echo e(@$student->id); ?>"></td>
                                            <td><?php echo e(@$student->full_name); ?></td>
                                            <td><?php echo e(@$student->className->class_name); ?> (<?php echo e(@$student->section->section_name); ?>)</td>
                                            <td><?php echo e(@$student->roll_no); ?></td>
                                            <td>
                                                <div class="d-flex radio-btn-flex">
                                                    <div class="mr-20">
                                                        <input type="radio" name="attendance[<?php echo e(@$student->id); ?>]" id="attendanceP<?php echo e(@$student->id); ?>" value="P" class="common-radio attd" checked>
                                                        <label for="attendanceP<?php echo e($student->id); ?>"><?php echo app('translator')->get('lang.present'); ?></label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="attendance[<?php echo e(@$student->id); ?>]" id="attendanceL<?php echo e(@$student->id); ?>" value="A" class="common-radio">
                                                        <label for="attendanceL<?php echo e($student->id); ?>"><?php echo app('translator')->get('lang.absent'); ?></label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                 
                                        <?php $__currentLoopData = $exam_attendance_childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(@$student->studentInfo !=""?@$student->studentInfo->admission_no:""); ?><input type="hidden" name="id[]" value="<?php echo e(@$student->student_id); ?>"></td>
                                            <td><?php echo e(@$student->studentInfo !=""?@$student->studentInfo->full_name:""); ?></td>
                                            <td><?php echo e(@$student->studentInfo->className->class_name); ?> (<?php echo e(@$student->studentInfo->section->section_name); ?>)</td>
                                            <td><?php echo e(@$student->studentInfo !=""?@$student->studentInfo->roll_no:""); ?></td>
                                            <td>
                                                <div class="d-flex radio-btn-flex">
                                                    <div class="mr-20">
                                                        <input type="radio" name="attendance[<?php echo e(@$student->student_id); ?>]" id="attendanceP<?php echo e(@$student->id); ?>" value="P" class="common-radio" <?php echo e(@$student->attendance_type == 'P'? 'checked': ''); ?>>
                                                        <label for="attendanceP<?php echo e(@$student->id); ?>"><?php echo app('translator')->get('lang.present'); ?></label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="attendance[<?php echo e(@$student->student_id); ?>]" id="attendanceL<?php echo e(@$student->id); ?>" value="A" class="common-radio" <?php echo e(@$student->attendance_type == 'A'? 'checked': ''); ?>>
                                                        <label for="attendanceL<?php echo e(@$student->id); ?>"><?php echo app('translator')->get('lang.absent'); ?></label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="text-center mt-3">
                                <button type="submit" class="primary-btn fix-gr-bg nowrap submit">
                                    <?php echo app('translator')->get('lang.save'); ?> <?php echo app('translator')->get('lang.attendance'); ?>
                                </button>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/examination/exam_attendance_create.blade.php ENDPATH**/ ?>