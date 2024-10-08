
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.merit_list_report'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<style>
    tr{
        border: 1px solid #351681;
    }
    table.meritList{
        width: 100%;
        border: 1px solid #351681;
    }
    table.meritList th{
        padding: 2px;
        text-transform: capitalize !important;
        font-size: 11px !important;  
        text-align: center !important;
        border: 1px solid #351681;
        text-align: center; 

    }
    table.meritList td{
        padding: 2px;
        font-size: 11px !important;
        border: 1px solid #351681;
        text-align: center !important;
    } 
 .single-report-admit table tr td { 
    padding: 5px 5px !important;

        border: 1px solid #351681;
} 
.single-report-admit table tr th { 
    padding: 5px 5px !important;
    vertical-align: middle;
        border: 1px solid #351681;
}
.main-wrapper {
     display: block !important ;  
}
#main-content {
    width: auto !important;
}
hr{
    margin: 0px;
}
.gradeChart tbody td{
        padding: 0;
        border: 1px solid #351681;
    }
    table.gradeChart{
        padding: 0px;
        margin: 0px;
        width: 60%;
        text-align: right; 
    }
    table.gradeChart thead th{
        border: 1px solid #000000;
        border-collapse: collapse;
        text-align: center !important;
        padding: 0px;
        margin: 0px;
        font-size: 9px;
    }
    table.gradeChart tbody td{
        border: 1px solid #000000;
        border-collapse: collapse;
        text-align: center !important;
        padding: 0px;
        margin: 0px;
        font-size: 9px;
    }

    #grade_table th{
        border: 1px solid black;
        text-align: center;
        background: #351681;
        color: white;
    }
    #grade_table td{
        color: black;
        text-align: center;
        border: 1px solid black;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.merit_list_report'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.merit_list_report'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'merit_list_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                    <div class="row">
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="col-lg-4 mt-30-md md_mb_20">
                            <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('exam') ? ' is-invalid' : ''); ?>" name="exam">
                                <option data-display="<?php echo app('translator')->get('lang.select_exam'); ?>*" value=""><?php echo app('translator')->get('lang.select_exam'); ?> *</option>
                                <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($exam->id); ?>" <?php echo e(isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''); ?>><?php echo e($exam->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('exam')): ?>
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e($errors->first('exam')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
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
                                <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>*" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
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
</section>
<?php if(isset($allresult_data)): ?>
    <?php 
        $generalSetting= App\SmGeneralSettings::find(1); 
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
        <div class="row mt-40">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30 mt-0"><?php echo app('translator')->get('lang.merit_list_report'); ?></h3>
                </div>
            </div>
            <div class="col-lg-8 pull-right">
                <a href="<?php echo e(route('merit-list/print', [$InputExamId, $InputClassId, $InputSectionId])); ?>" class="primary-btn small fix-gr-bg pull-right" target="_blank"><i class="ti-printer"> </i> <?php echo app('translator')->get('lang.print'); ?></a>
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
                                            <div class="offset-2">
                                            </div>
                                            <div class="col-lg-2">
                                            <img class="logo-img" src="<?php echo e(generalSetting()->logo); ?>" alt="">
                                            </div>
                                            <div class="col-lg-6 ml-30">
                                                <h3 class="text-white"> <?php echo e(isset(generalSetting()->school_name)?generalSetting()->school_name:'Infix School Management ERP'); ?> </h3> 
                                                <p class="text-white mb-0"> <?php echo e(isset(generalSetting()->address)?generalSetting()->address:'Infix School Address'); ?> </p>
                                                <p class="text-white mb-0"><?php echo app('translator')->get('lang.email'); ?>:  <?php echo e(isset($email)?$email:'admin@demo.com'); ?> ,   <?php echo app('translator')->get('lang.phone'); ?>:  <?php echo e(isset(generalSetting()->phone)?generalSetting()->phone:'admin@demo.com'); ?> </p> 
                                            </div>
                                            <div class="offset-2"></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                
                                                <div class="col-lg-8"> 
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h3><?php echo app('translator')->get('lang.order_of_merit_list'); ?></h3> 
                                                            <p class="mb-0">
                                                                <?php echo app('translator')->get('lang.academic_year'); ?> : <span class="primary-color fw-500"><?php echo e(@generalSetting()->academic_Year->year); ?></span>
                                                            </p>
                                                            <p class="mb-0">
                                                                <?php echo app('translator')->get('lang.exam'); ?> : <span class="primary-color fw-500"><?php echo e($exam_name); ?></span>
                                                            </p>
                                                            <p class="mb-0">
                                                                <?php echo app('translator')->get('lang.class'); ?> : <span class="primary-color fw-500"><?php echo e($class_name); ?></span>
                                                            </p>
                                                            <p class="mb-0">
                                                                <?php echo app('translator')->get('lang.section'); ?> : <span class="primary-color fw-500"><?php echo e($section->section_name); ?></span>
                                                            </p>  
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h3><?php echo app('translator')->get('lang.subjects'); ?></h3> 
                                                                <?php $__currentLoopData = $assign_subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <p class="mb-0">
                                                                        <span class="primary-color fw-500"><?php echo e($subject->subject->subject_name); ?></span>
                                                                    </p>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-lg-4 text-black"> 
                                                    <?php $marks_grade=DB::table('sm_marks_grades')->orderBy('gpa','desc')->get(); ?>
                                                    <?php if(@$marks_grade): ?>
                                                        <table class="table  table-bordered table-striped " id="grade_table">
                                                            <thead>
                                                                <tr>
                                                                    <th><?php echo app('translator')->get('lang.staring'); ?></th>
                                                                    <th><?php echo app('translator')->get('lang.ending'); ?></th>
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
                                        </div>
                                        <h3 class="primary-color fw-500 text-center"><?php echo app('translator')->get('lang.merit_list'); ?></h3>
                                        
                                            <div class="table-responsive">
                                                <table class="w-100 mt-30 mb-20 table table-bordered meritList">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo app('translator')->get('lang.name'); ?></th>
                                                            <th><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                                            <th><?php echo app('translator')->get('lang.roll_no'); ?></th>
                                                            <th><?php echo app('translator')->get('lang.position'); ?></th>
                                                            <th><?php echo app('translator')->get('lang.total_mark'); ?></th>
                                                            <th><?php echo app('translator')->get('lang.gpa'); ?>
                                                                <hr>
                                                                <small><?php echo app('translator')->get('lang.without_additional'); ?></small>
                                                            </th>
                                                            <th><?php echo app('translator')->get('lang.gpa'); ?></th>
                                                            <?php $__currentLoopData = $subjectlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <th><?php echo e($subject); ?></th>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1; $subject_mark = []; $total_student_mark = 0; $total_student_mark_optional = 0; ?>
                                                            <?php $__currentLoopData = $allresult_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                <?php
                                                                    $student_detail = App\SmStudent::where('id','=',$row->student_id)->first();
                                                                        $optional_subject='';
                                                                        $get_optional_subject=App\SmOptionalSubjectAssign::where('student_id','=',$student_detail->id)
                                                                                            ->where('session_id','=',$student_detail->session_id)
                                                                                            
                                                                                            ->first();
                                                                        if ($get_optional_subject!='') {
                                                                            $optional_subject=$get_optional_subject->subject_id;
                                                                        }
                                                                        $markslist = explode(',',$row->marks_string);
                                                                        $get_subject_id = explode(',',$row->subjects_id_string);
                                                                        $count=0;
                                                                        $additioncheck=[];
                                                                        $subject_mark=[];
                                                                ?>
                                                                <?php $__currentLoopData = $markslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                                                                    <?php if(App\SmOptionalSubjectAssign::is_optional_subject($row->student_id,$get_subject_id[$count])): ?>
                                                                        <?php
                                                                            $additioncheck[] = $mark;
                                                                        ?>
                                                                    <?php endif; ?>
                                                                    <?php
                                                                        if(App\SmOptionalSubjectAssign::is_optional_subject($row->student_id,$get_subject_id[$count])){
                                                                            $special_mark[$row->student_id]=$mark;
                                                                        }
                                                                        $count++;
                                                                    ?> 

                                                                    <?php
                                                                        $subject_mark[]= $mark;
                                                                        $total_student_mark = $total_student_mark + $mark; 
                                                                    ?> 
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($row->student_name); ?></td>
                                                            <td><?php echo e($row->admission_no); ?></td>
                                                            <td><?php echo e($row->studentinfo->roll_no); ?></td>
                                                            <td><?php echo e($key+1); ?></td>
                                                            <td><?php echo e($row->total_marks); ?></td>
                                                            <td>
                                                                <?php
                                                                    if($row->result == $failgpaname->grade_name){
                                                                        echo $failgpa;
                                                                    }else{
                                                                        $total_grade_point = 0;
                                                                        $number_of_subject = count($subject_mark)-1;
                                                                        $c=0;
                                                                        foreach ($subject_mark as $key => $mark) {
                                                                            if ($additioncheck['0'] != $mark) {                                                                     
                                                                                $grade_gpa = DB::table('sm_marks_grades')->where('percent_from','<=',$mark)->where('percent_upto','>=',$mark)->first();
                                                                                $total_grade_point = $total_grade_point + $grade_gpa->gpa;
                                                                                $c++;
                                                                            }
                                                                        }
                                                                        if($total_grade_point==0){
                                                                            echo $failgpa;
                                                                        }else{
                                                                            if($number_of_subject  == 0){
                                                                                echo $failgpa;
                                                                            }else{
                                                                                echo number_format((float)$total_grade_point/$c, 2, '.', '');
                                                                            } 
                                                                        } 
                                                                    }
                                                                ?>
                                                            </td>
                                                            <?php if( $get_optional_subject!=''): ?>
                                                                <?php
                                                                    if(!empty($special_mark[$row->student_id])){
                                                                        $optional_subject_mark=$special_mark[$row->student_id];
                                                                    }else{
                                                                        $optional_subject_mark=0;
                                                                    }
                                                                ?>
                                                                <td>
                                                                    <?php 
                                                                        if($row->result == $failgpaname->grade_name){
                                                                            echo $failgpa;
                                                                        }else{
                                                                            $optional_grade_gpa = DB::table('sm_marks_grades')->where('percent_from','<=',$optional_subject_mark)->where('percent_upto','>=',$optional_subject_mark)->first();
                                                                            $countable_optional_gpa=0;
                                                                            if ($optional_grade_gpa->gpa > $optional_subject_setup->gpa_above) {
                                                                                $countable_optional_gpa=$optional_grade_gpa->gpa - $optional_subject_setup->gpa_above;
                                                                            } else {
                                                                                $countable_optional_gpa=0;
                                                                            }
                                                                            $total_grade_point = 0;
                                                                            $number_of_subject = count($subject_mark)-1; 
                                                                            foreach ($subject_mark as $mark) {
                
                                                                                $grade_gpa = DB::table('sm_marks_grades')->where('percent_from','<=',$mark)->where('percent_upto','>=',$mark)->first();
                                                                                $total_grade_point = $total_grade_point + $grade_gpa->gpa;
                                            
                                                                                
                                                                            }
                                                                            $gpa_with_optional=$total_grade_point-$optional_grade_gpa->gpa;
                                                                            $gpa_with_optional=$gpa_with_optional+$countable_optional_gpa;
                                                                                if($gpa_with_optional==0){
                                                                                    echo $failgpa;
                                                                                }else{
                                                                                    if($number_of_subject  == 0){
                                                                                        echo $failgpa;
                                                                                    }else{
                                                                                        $grade=number_format((float)$gpa_with_optional/$number_of_subject, 2, '.', '');
                                                                                        if ($grade>$maxGpa) {
                                                                                            echo $maxGpa;
                                                                                        } else {
                                                                                            echo $grade;
                                                                                        }
                                                                                    } 
                                                                                }
                                                                        }
                                                                    ?>
                                                                </td>
                                                            <?php else: ?>
                                                                <td>
                                                                    <?php 
                                                                    if($row->result == $failgpaname->grade_name){
                                                                        echo $failgpa;
                                                                    }else{
                                                                    $total_grade_point = 0;
                                                                        $number_of_subject = count($subject_mark)-1; 
                                                                        foreach ($subject_mark as $mark) {
                                                                            $grade_gpa = DB::table('sm_marks_grades')->where('percent_from','<=',$mark)->where('percent_upto','>=',$mark)->first();
                                                                            $total_grade_point = $total_grade_point + $grade_gpa->gpa;
                                                                        }
                                                                        if($total_grade_point==0){
                                                                            echo $failgpa;
                                                                        }else{
                                                                            if($number_of_subject  == 0){
                                                                                echo $failgpa;
                                                                            }else{
                                                                                echo number_format((float)$total_grade_point/$number_of_subject, 2, '.', '');
                                                                            } 
                                                                        } 
                                                                    }
                                                                    ?>
                                                                </td>
                                                            <?php endif; ?>
                                                            <?php $__currentLoopData = $markslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <td> <?php echo e(!empty($mark)?$mark:0); ?></td>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/reports/merit_list_report.blade.php ENDPATH**/ ?>