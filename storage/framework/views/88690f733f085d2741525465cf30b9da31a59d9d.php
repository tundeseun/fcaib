
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.progress_card_report'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    .single-report-admit table tr th {
        border: 1px solid #a2a8c5 !important;
        vertical-align: middle;
    }

    #grade_table th{
        border: 1px solid black;
        text-align: center;
        background: #351681;
        color: white;
    }
    #grade_table td{
        color: black;
        text-align: center !important;
        border: 1px solid black;
    }

hr{
    margin:0;
}
.table-bordered {
    border: 1px solid #a2a8c5;
}

.single-report-admit table tr th {
    font-weight: 500;
}

    #grade_table th {
        border: 1px solid #dee2e6;
        border-top-style: solid;
        border-top-width: 1px;
        text-align: left;
        background: #351681;
        color: white;
        background: #f2f2f2;
        color: #415094;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        border-top: 0px;
        padding: 5px 4px;
        background: transparent;
        border-bottom: 1px solid rgba(130, 139, 178, 0.15) !important;
    }

    #grade_table td {
        color: #828bb2;
        padding: 0 7px;
        font-weight: 400;
        background-color: transparent;
        border-right: 0;
        border-left: 0;
        text-align: left !important;
        border-bottom: 1px solid rgba(130, 139, 178, 0.15) !important;
    }
    .single-report-admit table tr th {
        border: 0;
        border-bottom: 1px solid rgba(67, 89, 187, 0.15) !important;
        text-align: left
    }
    .single-report-admit table thead tr th {
        border: 0 !important;
    }
    .single-report-admit table tbody tr:first-of-type td {
        border-top: 1px solid rgba(67, 89, 187, 0.15) !important;
    }
    .single-report-admit table tr td {
        vertical-align: middle;
        font-size: 12px;
        color: #828BB2;
        font-weight: 400;
        border: 0;
        border-bottom: 1px solid rgba(130, 139, 178, 0.15) !important;
        text-align: left
    }

        .single-report-admit table tbody tr th {
            border: 0 !important;
            border-bottom: 1px solid rgba(67, 89, 187, 0.15) !important;
        }
    .single-report-admit table.summeryTable tbody tr:first-of-type td,
    .single-report-admit table.comment_table tbody tr:first-of-type td {
        border-top:0 !important;
    }

    /* new  style  */
    .single-report-admit{}
    .single-report-admit .student_marks_table{
        background: -webkit-linear-gradient(
        90deg
        , #d8e6ff 0%, #ecd0f4 100%);
            background: -moz-linear-gradient(90deg, #d8e6ff 0%, #ecd0f4 100%);
            background: -o-linear-gradient(90deg, #d8e6ff 0%, #ecd0f4 100%);
            background: linear-gradient(
        90deg
        , #d8e6ff 0%, #ecd0f4 100%);
    }


</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.progress_card_report'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.progress_card_report'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area mb-40">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                    </div>
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
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'progress_card_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="col-lg-4 mt-30-md md_mb_20">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
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
                            <div class="col-lg-4 mt-30-md md_mb_20" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
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
                            <div class="col-lg-4 mt-30-md md_mb_20" id="select_student_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                                    <option data-display="<?php echo app('translator')->get('lang.select_student'); ?> *" value=""><?php echo app('translator')->get('lang.select_student'); ?> *</option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_student_loader">
                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                </div>
                                <?php if($errors->has('student')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('student')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search"></span>
                                    <?php echo app('translator')->get('lang.search'); ?>
                                </button>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
</section>

<?php if(isset($is_result_available)): ?>
<?php 
    $generalSetting= App\SmGeneralSettings::where('school_id', Auth::user()->school_id)->first();
    if(!empty($generalSetting)){
            $school_name =$generalSetting->school_name;
            $site_title =$generalSetting->site_title;
            $school_code =$generalSetting->school_code;
            $address =$generalSetting->address;
            $phone =$generalSetting->phone; 
            $email =$generalSetting->email;
    } 
?>
    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.progress_card_report'); ?></h3>
                    </div>
                </div>
                <div class="col-lg-8 pull-right mt-0">

                        <div class="print_button pull-right">
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'progress-card/print', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student', 'target' => '_blank'])); ?>


                            <input type="hidden" name="class_id" value="<?php echo e($class_id); ?>">
                            <input type="hidden" name="section_id" value="<?php echo e($section_id); ?>">
                            <input type="hidden" name="student_id" value="<?php echo e($student_id); ?>">
                            
                            <button type="submit" class="primary-btn small fix-gr-bg"><i class="ti-printer"> </i> <?php echo app('translator')->get('lang.print'); ?>
                            </button>
                           <?php echo e(Form::close()); ?>

                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="single-report-admit">
                                    <div class="card">
                                            <div class="card-header">
                                                    <div class="d-flex">
                                                            <div class="col-lg-2">
                                                            <img class="logo-img" src="<?php echo e(generalSetting()->logo); ?>" alt="">
                                                            </div>
                                                            <div class="col-lg-6 ml-30">
                                                                <h3 class="text-white"> 
                                                                    <?php echo e(isset(generalSetting()->school_name)?generalSetting()->school_name:'Infix School Management ERP'); ?> 
                                                                </h3> 
                                                                <p class="text-white mb-0"> 
                                                                    <?php echo e(isset(generalSetting()->address)?generalSetting()->address:'Infix School Address'); ?> 
                                                                </p>
                                                                <p class="text-white mb-0">
                                                                    <?php echo app('translator')->get('lang.email'); ?>:  <?php echo e(isset($email)?$email:'admin@demo.com'); ?> ,   <?php echo app('translator')->get('lang.phone'); ?>:  <?php echo e(isset(generalSetting()->phone)?generalSetting()->phone:'admin@demo.com'); ?> 
                                                                </p> 
                                                            </div>
                                                            <div class="offset-2">
                                                            </div>
                                                        </div>
                                                <div>
                                                    <img class="report-admit-img"  src="<?php echo e(file_exists(@$studentDetails->student_photo) ? asset($studentDetails->student_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?>" width="100" height="100" alt="<?php echo e(asset($studentDetails->student_photo)); ?>">
                                                </div>
                                            </div>
                                        <div class="card-body">
                                            <div class="student_marks_table">
                                                <div class="row">
                                                    <div class="col-lg-7 text-black"> 
                                                        <h3 style="border-bottm:1px solid #ddd; padding: 15px; text-align:center"> 
                                                            <?php echo app('translator')->get('lang.progress_card_report'); ?>
                                                        </h3>
                                                        <h3>
                                                            <?php echo e($studentDetails->full_name); ?>

                                                        </h3>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <p class="mb-0">
                                                                    <?php echo app('translator')->get('lang.academic_year'); ?> : &nbsp;<span class="primary-color fw-500"><?php echo e(generalSetting()->session_year); ?></span>
                                                                </p>
                                                                <p class="mb-0">
                                                                    <?php echo app('translator')->get('lang.section'); ?> : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="primary-color fw-500"><?php echo e($studentDetails->section_name); ?></span>
                                                                </p>
                                                                <p class="mb-0">
                                                                    <?php echo app('translator')->get('lang.class'); ?> : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="primary-color fw-500"><?php echo e($studentDetails->class_name); ?></span>
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <p class="mb-0">
                                                                    <?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?> : <span class="primary-color fw-500"><?php echo e($studentDetails->admission_no); ?></span>
                                                                </p>
                                                                <p class="mb-0">
                                                                    <?php echo app('translator')->get('lang.roll'); ?> : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="primary-color fw-500"><?php echo e($studentDetails->roll_no); ?></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 text-black">
                                                        <?php if(@$marks_grade): ?>
                                                            <table class="table" id="grade_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th><?php echo app('translator')->get('lang.staring'); ?></th>
                                                                        <th> <?php echo app('translator')->get('lang.ending'); ?></th>
                                                                        <th><?php echo app('translator')->get('lang.gpa'); ?></th>
                                                                        <th><?php echo app('translator')->get('lang.grade'); ?></th>
                                                                        <th><?php echo app('translator')->get('lang.evalution'); ?></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $__currentLoopData = $marks_grade; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade_d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <tr>
                                                                            <td><?php echo e($grade_d->percent_from); ?></td>
                                                                            <td><?php echo e($grade_d->percent_upto); ?></td>
                                                                            <td><?php echo e($grade_d->gpa); ?></td>
                                                                            <td><?php echo e($grade_d->grade_name); ?></td>
                                                                            <td class="text-left"><?php echo e($grade_d->description); ?></td>
                                                                        </tr>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                            </table>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th rowspan="2"><?php echo app('translator')->get('lang.subjects'); ?></th>
                                                            <?php $__currentLoopData = $assinged_exam_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assinged_exam_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $exam_type = App\SmExamType::examType($assinged_exam_type);
                                                                ?>
                                                                <th colspan="4"><?php echo e($exam_type->title); ?></th>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <th rowspan="2"><?php echo app('translator')->get('lang.total'); ?></th>
                                                        </tr>
                                                        <tr class="text-center">
                                                            <?php $__currentLoopData = $assinged_exam_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assinged_exam_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <th><?php echo app('translator')->get('lang.full'); ?> <?php echo app('translator')->get('lang.mark'); ?></th>
                                                                <th><?php echo app('translator')->get('lang.marks'); ?></th>
                                                                <th><?php echo app('translator')->get('lang.grade'); ?></th>
                                                                <th><?php echo app('translator')->get('lang.gpa'); ?></th>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="mark_sheet_body">
                                                        <?php
                                                            $total_fail = 0;
                                                            $total_marks = 0;
                                                            $gpa_with_optional_count=0;
                                                            $gpa_without_optional_count=0;
                                                            $value=0;
                                                            $total_subject = 0;
                                                            $totalGpa  = 0;
                                                            $all_exam_type_full_mark=0;
                                                            $total_additional_subject_gpa=0;
                                                        ?>
                                                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr class="text-center">
                                                            <?php if($optional_subject_setup!='' && $student_optional_subject!=''): ?>
                                                                    <?php if($student_optional_subject->subject_id==$data->subject->id): ?>
                                                                        <td><?php echo e($data->subject !=""?$data->subject->subject_name:""); ?> (<?php echo app('translator')->get('lang.optional'); ?>)</td>
                                                                    <?php else: ?>
                                                                    <td><?php echo e($data->subject !=""?$data->subject->subject_name:""); ?></td>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <td><?php echo e($data->subject !=""?$data->subject->subject_name:""); ?></td>
                                                            <?php endif; ?>
                                                            <?php
                                                                $totalSumSub= 0;
                                                                $totalSubjectFail= 0;
                                                                $TotalSum= 0;
                                                                    foreach($assinged_exam_types as $assinged_exam_type){
                                                                    $mark_parts     =   App\SmAssignSubject::getNumberOfPart($data->subject_id, $class_id, $section_id, $assinged_exam_type);
                                                                    $result         =   App\SmResultStore::GetResultBySubjectId($class_id, $section_id, $data->subject_id,$assinged_exam_type ,$student_id);
                                                                    
                                                                    if(!empty($result)){
                                                                        $final_results = App\SmResultStore::GetFinalResultBySubjectId($class_id, $section_id, $data->subject_id,$assinged_exam_type ,$student_id);
                                                                    
                                                                        $term_base = App\SmResultStore::termBaseMark($class_id, $section_id, $data->subject_id,$assinged_exam_type ,$student_id);
                                                                    }
                                                                    $total_subject+=$assinged_exam_type;
                                                                    $subject_full_mark=subjectFullMark($assinged_exam_type, $data->subject_id);
                                                                    $total_additional_subject_gpa+=@$optional_subject_setup->gpa_above;
                                                                if($result->count()>0){
                                                            ?>
                                                            <td>
                                                                <?php
                                                                    $all_exam_type_full_mark+=$subject_full_mark;
                                                                ?>
                                                                <?php echo e($subject_full_mark); ?>

                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if($final_results != ""){
                                                                        echo $final_results->total_marks;
                                                                        $totalSumSub += $final_results->total_marks;
                                                                        $totalGpa += $final_results->total_gpa_point;
                                                                        $total_marks += $final_results->total_marks;
                                                                    }else{
                                                                        echo 0;
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if($final_results != ""){
                                                                        if($final_results->total_gpa_grade == @$fail_grade_name->grade_name){
                                                                            $totalSubjectFail++;
                                                                            $total_fail++;
                                                                        }
                                                                        echo $final_results->total_gpa_grade;
                                                                    }else{
                                                                        echo '-';
                                                                    }
                                                                    if ($student_optional_subject!='') {
                                                                        if ($student_optional_subject->subject_id==$data->subject->id) {
                                                                            $optional_subject_mark=$final_results->total_marks;
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td><?php echo e(number_format($final_results->total_gpa_point,2,'.','')); ?></td>
                                                            <?php
                                                                }else{ ?>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                <?php
                                                                }
                                                                    }
                                                            ?>
                                                            <td><?php echo e($totalSumSub); ?></td>
                                                            <?php
                                                                if($totalSubjectFail > 0){
                                                                }else{
                                                                    $totalSumSub = $totalSumSub / count($assinged_exam_types);
                                                                }
                                                            ?>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $colspan = 4 + count($assinged_exam_types) * 2;
                                                            if ($optional_subject_setup!='') {
                                                            $col_for_result=3;
                                                            } else {
                                                                $col_for_result=2;
                                                            }
                                                        ?>
                                                        <tr class="text-center">
                                                            <th><?php echo app('translator')->get('lang.result'); ?></th>
                                                            <?php
                                                                $term_base_gpa  = 0;
                                                                $average_gpa  = 0;
                                                                $with_percent_average_gpa  = 0;
                                                                $optional_subject_total_gpa  = 0;
                                                                $optional_subject_total_above_gpa  = 0;
                                                                $without_additional_subject_total_gpa  = 0;
                                                                $with_additional_subject_addition  = 0;
                                                                $with_optional_percentage  = 0;
                                                                $total_with_optional_percentage  = 0;
                                                                $total_with_optional_subject_extra_gpa  = 0;
                                                                $optional_subject_mark= 0;
                                                            ?>
                                                            <?php $__currentLoopData = $assinged_exam_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assinged_exam_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $exam_type = App\SmExamType::examType($assinged_exam_type);
                                                                $term_base_gpa=termWiseGpa($assinged_exam_type, $student_id);
                                                                $with_percent_average_gpa +=$term_base_gpa;

                                                                $term_base_full_mark=termWiseTotalMark($assinged_exam_type, $student_id);
                                                                $average_gpa+=$term_base_full_mark;

                                                                if($optional_subject_setup!='' && $student_optional_subject!=''){

                                                                    $optional_subject_gpa = optionalSubjectFullMark($assinged_exam_type,$student_id,@$optional_subject_setup->gpa_above,"optional_sub_gpa");
                                                                    $optional_subject_total_gpa += $optional_subject_gpa;

                                                                    $optional_subject_above_gpa = optionalSubjectFullMark($assinged_exam_type,$student_id,@$optional_subject_setup->gpa_above,"with_optional_sub_gpa");
                                                                    $optional_subject_total_above_gpa += $optional_subject_above_gpa;

                                                                    $without_subject_gpa = optionalSubjectFullMark($assinged_exam_type,$student_id,@$optional_subject_setup->gpa_above,"without_optional_sub_gpa");
                                                                    $without_additional_subject_total_gpa += $without_subject_gpa;
                                                                    
                                                                    $with_additional_subject_gpa = termWiseAddOptionalMark($assinged_exam_type,$student_id,@$optional_subject_setup->gpa_above);
                                                                    $with_additional_subject_addition += $with_additional_subject_gpa;

                                                                    $with_optional_subject_extra_gpa = termWiseTotalMark($assinged_exam_type,$student_id,"optional_subject");
                                                                    $total_with_optional_subject_extra_gpa += $with_optional_subject_extra_gpa;

                                                                    $with_optional_percentages=termWiseGpa($assinged_exam_type, $student_id,$with_optional_subject_extra_gpa);
                                                                    $total_with_optional_percentage += $with_optional_percentages;
                                                                }
                                                            ?>
                                                            <th colspan="4"> <?php echo app('translator')->get('lang.average'); ?> <?php echo app('translator')->get('lang.gpa'); ?> : 
                                                                <?php echo e(number_format($term_base_full_mark,2,'.','')); ?>

                                                                </br>
                                                                <?php echo e($exam_type->title); ?> (<?php echo e($exam_type->percentage); ?>%) : <?php echo e(number_format($term_base_gpa,2,'.','')); ?>

                                                                <?php if($optional_subject_setup!='' && $student_optional_subject!=''): ?>
                                                                    <hr>
                                                                    <?php echo app('translator')->get('lang.with'); ?> <?php echo app('translator')->get('lang.optional'); ?> : 
                                                                    <?php echo e(number_format($with_optional_subject_extra_gpa,2,'.','')); ?>

                                                                    </br>
                                                                    <?php echo app('translator')->get('lang.with'); ?> <?php echo app('translator')->get('lang.optional'); ?> (<?php echo e($exam_type->percentage); ?>%) : 
                                                                    <?php echo e(number_format($with_optional_percentages,2,'.','')); ?>

                                                                <?php endif; ?>
                                                            </th>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <th>
                                                                <?php echo e(number_format($average_gpa,2,'.','')); ?>

                                                                </br>
                                                                <?php echo e(number_format($with_percent_average_gpa, 2, '.', '')); ?>

                                                                <?php if($optional_subject_setup!='' && $student_optional_subject!=''): ?>
                                                                    <hr>
                                                                    <?php echo e(number_format($total_with_optional_subject_extra_gpa, 2, '.', '')); ?>

                                                                    </br>
                                                                    <?php echo e(number_format($total_with_optional_percentage, 2, '.', '')); ?>

                                                                <?php endif; ?>
                                                            </th>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td colspan="<?php echo e($colspan / $col_for_result - 1); ?>"  class="text-center"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.marks'); ?></td>
                                                            <?php if($optional_subject_setup!='' && $student_optional_subject!=''): ?>
                                                                <td colspan="<?php echo e($colspan / $col_for_result + 7); ?>" class="text-center" style="padding:10px; font-weight:bold"><?php echo e($total_marks); ?> <?php echo app('translator')->get('lang.out_of'); ?> <?php echo e($all_exam_type_full_mark); ?></td>
                                                            <?php else: ?>
                                                                <td colspan="<?php echo e($colspan / $col_for_result + 9); ?>" class="text-center" style="padding:10px; font-weight:bold"><?php echo e($total_marks); ?> <?php echo app('translator')->get('lang.out_of'); ?> <?php echo e($all_exam_type_full_mark); ?></td>
                                                            <?php endif; ?>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <?php if($optional_subject_setup!='' && $student_optional_subject!=''): ?>
                                                                <td colspan="<?php echo e($colspan / $col_for_result - 1); ?>"  class="text-center">
                                                                    <?php echo app('translator')->get('lang.optional'); ?> <?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.gpa'); ?>
                                                                        <hr>
                                                                    <?php echo app('translator')->get('lang.gpa_above'); ?> <?php echo e(@$optional_subject_setup->gpa_above); ?>

                                                                </td>
                                                                <td colspan="<?php echo e($colspan / $col_for_result + 7); ?>" class="text-center" style="padding:10px; font-weight:bold">
                                                                    <?php echo e($optional_subject_total_gpa); ?>

                                                                        <hr>
                                                                    <?php echo e($optional_subject_total_above_gpa); ?>

                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                        <?php
                                                            if ($optional_subject_mark) {
                                                                $total_marks_without_optional=$total_marks-$optional_subject_mark;
                                                                $op_subject_count=count($subjects)-1;
                                                            }else{
                                                                $total_marks_without_optional=$total_marks;
                                                                $op_subject_count=count($subjects);
                                                            }
                                                        ?>
                                                        <tr>
                                                            <td colspan="<?php echo e($colspan / $col_for_result - 1); ?>" class="text-center"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.gpa'); ?></td>
                                                            <?php if($optional_subject_setup!='' && $student_optional_subject!=''): ?>
                                                            <td colspan="4" class="text-center" style="padding:10px;">
                                                                <?php echo e(number_format($total_with_optional_percentage,2,'.','')); ?>

                                                            </td>
                                                            <td colspan="3" class="text-center" style="padding:10px;"><?php echo app('translator')->get('lang.without_additional'); ?> <?php echo app('translator')->get('lang.grade'); ?></td>
                                                            <td colspan="2" class="text-center" style="padding:10px;">
                                                                <?php echo e(number_format($with_percent_average_gpa,2,'.','')); ?>

                                                            </td>
                                                            <?php else: ?>
                                                                <td colspan="<?php echo e($colspan / $col_for_result + 9); ?>" class="text-center" style="padding:10px;">
                                                                    <?php echo e(gradeName(number_format(termWiseFullMark($assinged_exam_types,$student_id),2,'.',''))); ?>

                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td colspan="<?php echo e($colspan / $col_for_result - 1); ?>" class="text-center"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.grade'); ?></td>
                                                            <?php if($optional_subject_setup!='' && $student_optional_subject!=''): ?>
                                                                <td colspan="4" class="text-center" style="padding:10px; font-weight:bold">
                                                                    <?php echo e(gradeName(number_format($total_with_optional_percentage,2,'.',''))); ?>

                                                                </td>
                                                            <td colspan="3" class="text-center" style="padding:10px;"><?php echo app('translator')->get('lang.without_additional'); ?> <?php echo app('translator')->get('lang.gpa'); ?></td>
                                                            <td colspan="2" class="text-center" style="padding:10px;">
                                                                <?php echo e(gradeName(number_format($with_percent_average_gpa,2,'.',''))); ?>

                                                            </td>
                                                            <?php else: ?>
                                                                <td colspan="<?php echo e($colspan / $col_for_result + 9); ?>" class="text-center" style="padding:10px; font-weight:bold">
                                                                    <?php echo e(number_format(termWiseFullMark($assinged_exam_types,$student_id),2,'.','')); ?>

                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                        
                                                        
                                                        <tr>
                                                            <?php if($optional_subject_setup!='' && $student_optional_subject!=''): ?>
                                                                <td colspan="<?php echo e($colspan / $col_for_result - 1); ?>" class="text-center"><?php echo app('translator')->get('lang.remarks'); ?></td>
                                                                <td colspan="<?php echo e($colspan / $col_for_result + 7); ?>" class="text-center" style="padding:10px; font-weight:bold">
                                                                    <?php echo e(remarks(number_format($total_with_optional_percentage,2,'.',''))); ?>

                                                                </td>
                                                            <?php else: ?>
                                                                <td colspan="<?php echo e($colspan / $col_for_result - 1); ?>" class="text-center"><?php echo app('translator')->get('lang.remarks'); ?></td>
                                                                <td colspan="<?php echo e($colspan / $col_for_result + 9); ?>" class="text-center" style="padding:10px; font-weight:bold">
                                                                    <?php echo e(remarks(number_format(termWiseFullMark($assinged_exam_types,$student_id),2,'.',''))); ?>

                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/reports/progress_card_report.blade.php ENDPATH**/ ?>