
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.online_exam'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.examinations'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.examinations'); ?></a>
                <a href="<?php echo e(route('student_online_exam')); ?>"><?php echo app('translator')->get('lang.online_exam'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->get('lang.take_online_exam'); ?></h3>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_online_exam_submit', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'online_take_exam'])); ?>

                <div class="row">
                    <input type="hidden" name="online_exam_id" id="online_exam_id" value="<?php echo e(@$online_exam->id); ?>">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class="container-fluid exam-bg">
                                <div class="">
                                    <div class="row  pl-10">
                                        <div class="col-lg-7 mt-20">
                                            <h3><?php echo app('translator')->get('lang.exam_name'); ?> : <?php echo e(@$online_exam->title); ?></h3>
                                                        <h4><strong><?php echo app('translator')->get('lang.subject'); ?> : </strong><?php echo e(@$online_exam->subject !=""?@$online_exam->subject->subject_name:""); ?></h4>
                                                        <h4><strong><?php echo app('translator')->get('lang.class_Sec'); ?> : </strong><?php echo e(@$online_exam->class !=""?@$online_exam->class->class_name:""); ?> (<?php echo e(@$online_exam->section !=""?@$online_exam->section->section_name:""); ?>)</h4>
                                                        <h4 class="mb-20"><strong><?php echo app('translator')->get('lang.total_marks'); ?> : </strong>
                                                        <?php
                                                        @$total_marks = 0;
                                                            foreach($online_exam->assignQuestions as $question){
                                                                $total_marks = $total_marks + $question->questionBank->marks;
                                                            }
                                                            echo @$total_marks;
                                                        ?></h4>
                                        <p><strong><?php echo app('translator')->get('lang.instruction'); ?> : </strong><?php echo e(@$online_exam->instruction); ?></p>
                                        </div>
                                        <div class="col-lg-5 mt-20">
                                            <p class="mb-2"><strong><?php echo app('translator')->get('lang.exam_has_to_be_submitted_within'); ?>: </strong><?php echo e(@$online_exam->date); ?> <?php echo e(@$online_exam->end_time); ?></p>
                                            <p id="countDownTimer"></p>
                                            
                                            <input type="hidden" id="count_date" value="<?php echo e(@$online_exam->date); ?>">
                                            <input type="hidden" id="count_start_time" value="<?php echo e(date('Y-m-d H:i:s', strtotime(@$online_exam->start_time))); ?>">
                                            <input type="hidden" id="count_end_time" value="<?php echo e(date('Y-m-d H:i:s', strtotime(@$online_exam->end_time))); ?>">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">

                            
                            <table  class="" cellspacing="0" width="100%">
                                <tbody>
                                    
                                    <?php $j=0; ?>
                                    <?php $__currentLoopData = $assigned_questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   
                                    <input type="hidden" name="online_exam_id" value="<?php echo e(@$question->online_exam_id); ?>">
                                    <input type="hidden" name="question_ids[]" value="<?php echo e(@$question->question_bank_id); ?>">

                                    
                                    <tr>
                                        <td width="80%" class="pt-5">
                                           <h4><?php echo e(++$j.'.'); ?> <?php echo e(@$question->questionBank->question); ?></h4> 
                                            <?php if(@$question->questionBank->type == "MI"): ?>
                                                <div class="qustion_banner_img">
                                                    <img src="<?php echo e(asset($question->questionBank->question_image)); ?>" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <?php if(@$question->questionBank->type == "M"): ?>
                                                <?php
                                                    @$multiple_options = @$question->questionBank->questionMu;
                                                    @$number_of_option = @$question->questionBank->questionMu->count();
                                                    $i = 0;
                                                ?>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <?php $__currentLoopData = $multiple_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multiple_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="mt-20 mr-20">
                                                    <input  data-question = "<?php echo e(@$question->question_bank_id); ?>" type="radio" id="answer<?php echo e(@$multiple_option->id); ?>" class="common-checkbox answer_question_mu" name="options_<?php echo e(@$question->question_bank_id); ?>" value="<?php echo e($multiple_option->id); ?>">
                                                        <label for="answer<?php echo e(@$multiple_option->id); ?>"><?php echo e(@$multiple_option->title); ?></label>
                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>

                                            <?php elseif($question->questionBank->type == "MI"): ?>
                                            <?php
                                                @$multiple_options = @$question->questionBank->questionMu;
                                                @$number_of_option = @$question->questionBank->questionMu->count();
                                                $i = 0;
                                            ?>
                                            <div class="quiestion_group">
                                                <?php $__currentLoopData = $multiple_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multiple_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="single_question " style="background-image: url(<?php echo e(asset($multiple_option->title)); ?>)">

                                                        <div class="img_ovelay">
                                                            <div class="icon">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php elseif($question->questionBank->type == "T"): ?>
                                            <div class="d-flex align-items-center justify-content-center radio-btn-flex mt-20">
                                                <div class="mr-30">
                                                    <input data-question = "<?php echo e(@$question->question_bank_id); ?>" type="radio" name="trueOrFalse_<?php echo e(@$question->question_bank_id); ?>" id="true_<?php echo e(@$question->question_bank_id); ?>" value="T"  class="common-radio relationButton answer_question_mu">
                                                    <label for="true_<?php echo e($question->question_bank_id); ?>"><?php echo app('translator')->get('lang.true'); ?></label>
                                                </div>
                                                <div class="mr-30">
                                                    <input  data-question ="<?php echo e(@$question->question_bank_id); ?>" type="radio" name="trueOrFalse_<?php echo e(@$question->question_bank_id); ?>" id="false_<?php echo e(@$question->question_bank_id); ?>" value="F"  class="common-radio relationButton answer_question_mu">
                                                    <label for="false_<?php echo e(@$question->question_bank_id); ?>"><?php echo app('translator')->get('lang.false'); ?></label>
                                                </div>
                                            </div>
                                            <?php else: ?>

                                            <?php endif; ?>

                                            <div class="mt-20">
                                                <?php if($question->questionBank->type == "M"): ?>
                                                <?php
                                                    $ques_bank_multiples = $question->questionBank->questionMu;
                                                    $currect_multiple = '';
                                                    $k = 0;
                                                    foreach($ques_bank_multiples as $ques_bank_multiple){
                                                    
                                                        if(@$ques_bank_multiple->status == 1){
                                                        $k++;
                                                            if($k == 1){
                                                                $currect_multiple .= $ques_bank_multiple->title;
                                                            }else{
                                                                $currect_multiple .= ','.$ques_bank_multiple->title;
                                                            }
                                                        }
                                                    }
    
                                                ?>
                                                <h4>[<?php echo app('translator')->get('lang.currect_answer'); ?>: <?php echo e($currect_multiple); ?>]</h4>

                                                <?php elseif(@$question->questionBank->type == "MI"): ?>
                                <?php
                                    $ques_bank_multiples = $question->questionBank->questionMu;
                                    $currect_multiple = '';
                                    $k = 0;
                                ?>
                                    <h4>[<?php echo app('translator')->get('lang.currect_answer'); ?>]</h4>
                                <div class="quiestion_group">
                                    <?php

                                    foreach($ques_bank_multiples as $ques_bank_multiple){
                                        if ($ques_bank_multiple->status == 0) {
                                            continue;
                                        }
                                    ?>
                                    <div class="single_question "style="background-image: url(<?php echo e(asset($ques_bank_multiple->title)); ?>)">

                                    <div class="img_ovelay">
                                    
                                        <div class="icon">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    </div>

                                    <?php
                                    
                                    }
                                  
                                    ?>
                                </div>
                       
                                                <?php elseif(@$question->questionBank->type == "T"): ?>
                                                    <h4>[<?php echo app('translator')->get('lang.currect_answer'); ?>: <?php echo e(@$question->questionBank->trueFalse == "T"? 'True': 'False'); ?>]</h4>
                                                <?php else: ?> 
                                                    <h4>[<?php echo app('translator')->get('lang.currect_answer'); ?>: <?php echo e(@$question->questionBank->suitable_words); ?>]</h4>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <input type="hidden" name="marks[]" value="<?php echo e(@$question->questionBank!=""?@$question->questionBank->id:""); ?>">
                                        <td width="20%" class="text-right">

                                                <span class="primary-btn fix-gr-bg"><?php echo e(@$question->questionBank!=""?@$question->questionBank->marks:""); ?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
                 <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</section>



<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>

    <?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/examination/view_online_question.blade.php ENDPATH**/ ?>