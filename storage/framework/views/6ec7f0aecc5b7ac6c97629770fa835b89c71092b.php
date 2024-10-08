
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.fill_marks'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.marks_register'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.examination'); ?></a>
                <a href="<?php echo e(route('marks_register')); ?>"><?php echo app('translator')->get('lang.marks_register'); ?></a>
                <a href="<?php echo e(route('marks_register_create')); ?>"><?php echo app('translator')->get('lang.fill_marks'); ?></a>
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
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'marks_register_create', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_subject'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('exam') ? ' is-invalid' : ''); ?>" name="exam">
                                    <option data-display="<?php echo app('translator')->get('lang.select_exam'); ?> *" value=""><?php echo app('translator')->get('lang.select_exam'); ?> *</option>
                                    <?php $__currentLoopData = $exam_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($exam_type->id); ?>" <?php echo e(isset($exam_id)? ($exam_id == $exam_type->id? 'selected':''):''); ?>><?php echo e($exam_type->title); ?></option>
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
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?> select_class_subject" id="select_class_subject" name="subject">
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
    </div>
</section>

<?php if(isset($students)): ?>
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.fill_marks'); ?> | 
                    <small><?php echo app('translator')->get('lang.exam'); ?>: <?php echo e($search_info['exam_name']); ?>, <?php echo app('translator')->get('lang.class'); ?>: <?php echo e($search_info['class_name']); ?>, <?php echo app('translator')->get('lang.section'); ?>: <?php echo e($search_info['section_name']); ?>

                    </h3>
                </div>
            </div>
        </div>


    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'marks_register_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'marks_register_store'])); ?> 


        <input type="hidden" name="exam_id" value="<?php echo e($exam_id); ?>">
        <input type="hidden" name="class_id" value="<?php echo e($class_id); ?>">
        <input type="hidden" name="section_id" value="<?php echo e($section_id); ?>">
        <input type="hidden" name="subject_id" value="<?php echo e($subject_id); ?>"> 

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%" >
                    <thead>
                        <tr>
                            <th rowspan="2" ><?php echo app('translator')->get('lang.admission_no'); ?>.</th>
                            <th rowspan="2" ><?php echo app('translator')->get('lang.roll_no'); ?>.</th>
                            <th rowspan="2" ><?php echo app('translator')->get('lang.class_Sec'); ?></th>
                            <th rowspan="2" ><?php echo app('translator')->get('lang.student'); ?></th>
                            <th class="text-center" colspan="<?php echo e($number_of_exam_parts + 1); ?>"> <?php echo e($subjectNames->subject_name); ?></th> 
                            <th rowspan="2"><?php echo app('translator')->get('lang.is_present'); ?></th>
                        </tr>
                        <tr>
                            <?php $__currentLoopData = $marks_entry_form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e($part->exam_title); ?> ( <?php echo e($part->exam_mark); ?> ) </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th>Lecturer <?php echo app('translator')->get('lang.remarks'); ?></th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <?php $colspan = 3; $counter = 0;  ?>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $absent_check = App\SmMarksRegister::is_absent_check($exam_id, $class_id, $student->section_id, $subject_id, $student->id);
                        ?>
                        <tr>
                            <td>
                                <input type="hidden" name="student_ids[]" value="<?php echo e($student->id); ?>">
                                <input type="hidden" name="student_rolls[<?php echo e($student->id); ?>]" value="<?php echo e($student->roll_no); ?>">
                                <input type="hidden" name="student_admissions[<?php echo e($student->id); ?>]" value="<?php echo e($student->admission_no); ?>">
                                <?php echo e($student->admission_no); ?>

                            </td>
                            <td><?php echo e($student->roll_no); ?></td>
                            <td><?php echo e($student->class->class_name.'('.$student->section->section_name .')'); ?></td>
                            <td><?php echo e($student->full_name); ?></td>
                            <?php $entry_form_count=0; ?>
                            <?php $__currentLoopData = $marks_entry_form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <?php $d = 5 + rand()%5;   ?>
                            <td>
                                <div class="input-effect mt-10">
                                <input type="hidden" name="exam_setup_ids[]" value="<?php echo e($part->id); ?>">
                                <?php 
                                $search_mark = App\SmMarkStore::get_mark_by_part($student->id, $part->exam_term_id, $part->class_id, $part->section_id, $part->subject_id, $part->id); 
                                ?>
                                    <input oninput="numberCheckWithDot(this)" class="primary-input marks_input" type="text" step="any" max="<?php echo e(@$part->exam_mark); ?>"
                                    name="marks[<?php echo e($student->id); ?>][<?php echo e($part->id); ?>]" value="<?php echo e(!empty($search_mark)?$search_mark:0); ?>" <?php echo e(@$absent_check->attendance_type == 'A' || @$absent_check->attendance_type == ''? 'readonly':''); ?>>
                                    
                                    <input class="primary-input" type="hidden" name="exam_Sids[<?php echo e($student->id); ?>][<?php echo e($entry_form_count++); ?>]" value="<?php echo e($part->id); ?>">
                                    
                                    <input type="hidden" id="part_marks" name="part_marks" value="<?php echo e($part->exam_mark); ?>">
                                    
                                    <label><?php echo e($part->exam_title); ?> Mark</label>
                                    <span class="focus-border"></span>
                                </div>                                
                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                             $teacher_remarks = App\SmMarkStore::teacher_remarks($student->id, $exam_id, $student->class_id, $student->section_id, $subject_id); 
                            ?>
                            <td>
                                <div class="input-effect mt-10">
                                <input class="primary-input" type="text" name="teacher_remarks[<?php echo e($student->id); ?>][<?php echo e($part->subject_id); ?>]" value="<?php echo e($teacher_remarks); ?>" <?php echo e(@$absent_check->attendance_type == 'A' || @$absent_check->attendance_type == ''? 'readonly':''); ?> >
                                <label><?php echo app('translator')->get('teacher'); ?> <?php echo app('translator')->get('remarks'); ?></label>
                                <span class="focus-border"></span>
                            </div>
                            </td>

                             <?php $is_absent_check = App\SmMarkStore::is_absent_check($student->id, $part->exam_term_id, $part->class_id, $part->section_id, $part->subject_id); ?>

                            <td>
                                <div class="input-effect">
                                    <?php if(@$absent_check->attendance_type == 'P'): ?>
                                    <button class="primary-btn small fix-gr-bg" type="button"><?php echo app('translator')->get('lang.present'); ?></button>
                                    <?php else: ?>
                                    <button class="primary-btn small bg-danger text-white border-0" type="button"><?php echo app('translator')->get('lang.absent'); ?></button>
                                    <?php endif; ?>                              


                                    <?php if(@$absent_check->attendance_type == 'A'): ?>
                                    <input type="text" name="absent_students[]" value="<?php echo e($student->id); ?>">
                                    <?php endif; ?>
                                </div>
                                    
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                         <?php if(userPermission(224)): ?>
                        <tr>
                            <td colspan="<?php echo e(count($marks_entry_form) + 5); ?>" class="text-center">
                                <button type="submit" class="primary-btn fix-gr-bg mt-20 submit">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.save'); ?> <?php echo app('translator')->get('lang.marks'); ?>
                                </button>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

               
         
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/examination/masks_register_create.blade.php ENDPATH**/ ?>