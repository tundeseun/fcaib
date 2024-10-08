
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.take_online_exam'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Examinations </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.examinations'); ?></a>
                <a href="<?php echo e(route('student_online_exam')); ?>"><?php echo app('translator')->get('lang.online_exam'); ?></a>
                <a href="<?php echo e(route('take_online_exam',@$online_exam->id)); ?>"><?php echo app('translator')->get('lang.take_online_exam'); ?></a>
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
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_done_online_exam', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'online_take_exam'])); ?>

                <div class="row">
                    <input type="hidden" name="online_exam_id" id="online_exam_id" value="<?php echo e(@$online_exam->id); ?>">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <table  class="" cellspacing="0" width="100%">
                                <tbody>
                                    <tr align="center" class="exam-bg">
                                        <td colspan="2" class="pt-4 pb-3 px-sm-5">
                                            <h1><?php echo app('translator')->get('lang.exam_name'); ?> : <?php echo e(@$online_exam->title); ?></h1>
                                            <h2><strong><?php echo app('translator')->get('lang.subject'); ?> : </strong><?php echo e(@$online_exam->subject !=""?@$online_exam->subject->subject_name:""); ?></h2>
                                            <h6><strong><?php echo app('translator')->get('lang.class_Sec'); ?> : </strong><?php echo e(@$online_exam->class !=""?@$online_exam->class->class_name:""); ?> (<?php echo e(@$online_exam->section !=""?@$online_exam->section->section_name:""); ?>)</h6>
                                            <h3 class="mb-20"><strong><?php echo app('translator')->get('lang.total_marks'); ?> : </strong>
                                            <?php
                                            @$total_marks = 0;
                                                foreach($online_exam->assignQuestions as $question){
                                                    $total_marks = $total_marks + $question->questionBank->marks;
                                                }
                                                echo @$total_marks;
                                            ?></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong><?php echo app('translator')->get('lang.instruction'); ?> : </strong><?php echo e(@$online_exam->instruction); ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong><?php echo app('translator')->get('lang.exam_has_to_be_submitted_within'); ?>: </strong><?php echo e(@$online_exam->date); ?> <?php echo e(@$online_exam->end_time); ?></p>
                                                <p id="countDownTimer"></p>
                                                </div>
                                            </div>
                                            <input type="hidden" id="count_date" value="<?php echo e(@$online_exam->date); ?>">
                                            <input type="hidden" id="count_start_time" value="<?php echo e(date('Y-m-d H:i:s', strtotime(@$online_exam->start_time))); ?>">
                                            <input type="hidden" id="count_end_time" value="<?php echo e(date('Y-m-d H:i:s', strtotime(@$online_exam->end_time))); ?>">
                                        </td>
                                    </tr>
                                    <?php $j=0; ?>
                                    <?php $__currentLoopData = $assigned_questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $student_id=Auth::user()->student->id;
                                        $submited_answer=App\OnlineExamStudentAnswerMarking::StudentGivenAnswer($question->online_exam_id,$question->question_bank_id,$student_id);
                                        if ($question->questionBank->type=='MI') {
                                            $submited_answer=App\OnlineExamStudentAnswerMarking::StudentImageAnswer($question->online_exam_id,$question->question_bank_id,$student_id);
                                            
                                        }
                                    ?>
                                    <input type="hidden" name="online_exam_id" value="<?php echo e(@$question->online_exam_id); ?>">
                                    <input type="hidden" name="question_ids[]" value="<?php echo e(@$question->question_bank_id); ?>">

                                    
                                    <tr>
                                        <td width="80%" class="pt-5">
                                            <?php echo e(++$j.'.'); ?> <?php echo e(@$question->questionBank->question); ?>

                                            <?php if(@$question->questionBank->type == "MI"): ?>
                            
                                            <img class="mb-20" width="100%" height="auto" src="<?php echo e(asset($question->questionBank->question_image)); ?>" alt="">
                                        <?php endif; ?>
                                            <?php if(@$question->questionBank->type == "M"): ?>
                                                <?php
                                                    @$multiple_options = @$question->questionBank->questionMu;
                                                    @$number_of_option = @$question->questionBank->questionMu->count();
                                                    $i = 0;
                                                ?>
                                                <?php $__currentLoopData = $multiple_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multiple_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="mt-20">
                                                <input  data-question = "<?php echo e(@$question->question_bank_id); ?>" type="radio" data-option="<?php echo e(@$multiple_option->id); ?>" id="answer<?php echo e(@$multiple_option->id); ?>" class="common-checkbox answer_question_mu" name="options_<?php echo e(@$question->question_bank_id); ?>" value="<?php echo e($multiple_option->id); ?>" <?php echo e(isset($submited_answer)? $submited_answer->user_answer==$multiple_option->id? 'checked' :'' : ''); ?>>
                                                    <label for="answer<?php echo e(@$multiple_option->id); ?>"><?php echo e(@$multiple_option->title); ?></label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php elseif($question->questionBank->type == "MI"): ?>
                                                <?php
                                                    @$multiple_options = @$question->questionBank->questionMu;
                                                    @$number_of_option = @$question->questionBank->questionMu->count();
                                                    $i = 0;
                                                ?>
                                                <div class="upload_grid_wrapper">
                                                    <?php $__currentLoopData = $multiple_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multiple_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     
                                                        <div class="single_upload_img">
                                                            <div class="img_check">
                                                                <input  data-question = "<?php echo e(@$question->question_bank_id); ?>" type="<?php echo e(@$question->questionBank->answer_type); ?>" data-option="<?php echo e(@$multiple_option->id); ?>" id="answer<?php echo e(@$multiple_option->id); ?>" class="common-checkbox answer_question_mu" name="options_<?php echo e(@$question->question_bank_id); ?>" value="<?php echo e($multiple_option->id); ?>" <?php echo e(isset($submited_answer)? in_array($multiple_option->id,$submited_answer) ? 'checked' :'' : ''); ?>>
                                                                <label for="answer<?php echo e(@$multiple_option->id); ?>"></label>
                                                                
                                                            </div>
                                                            <img src="<?php echo e(asset($multiple_option->title)); ?>" alt="">
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php elseif($question->questionBank->type == "T"): ?>
                                            <div class="d-flex radio-btn-flex mt-20">
                                                <div class="mr-30">
                                                    <input data-question = "<?php echo e(@$question->question_bank_id); ?>" type="radio" name="trueOrFalse_<?php echo e(@$question->question_bank_id); ?>" id="true_<?php echo e(@$question->question_bank_id); ?>" value="T" <?php echo e(isset($submited_answer)? $submited_answer->user_answer=='T'? 'checked' :'' : ''); ?> class="common-radio relationButton answer_question_mu">
                                                    <label for="true_<?php echo e($question->question_bank_id); ?>">True</label>
                                                </div>
                                                <div class="mr-30">
                                                    <input  data-question ="<?php echo e(@$question->question_bank_id); ?>" type="radio" name="trueOrFalse_<?php echo e(@$question->question_bank_id); ?>" id="false_<?php echo e(@$question->question_bank_id); ?>" value="F" <?php echo e(isset($submited_answer)? $submited_answer->user_answer=='F'? 'checked' :'' : ''); ?> class="common-radio relationButton answer_question_mu">
                                                    <label for="false_<?php echo e(@$question->question_bank_id); ?>">False</label>
                                                </div>
                                            </div>
                                            <?php else: ?>

                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="input-effect mt-20">
                                                            <textarea class="primary-input form-control mt-10 form_filler_<?php echo e(@$question->question_bank_id); ?>" name="answer_word_<?php echo e(@$question->question_bank_id); ?>" id="answer_word_<?php echo e(@$question->question_bank_id); ?>"><?php echo e(isset($submited_answer)? $submited_answer->user_answer : ''); ?> </textarea>
                                                            <label><?php echo app('translator')->get('lang.suitable_words'); ?></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="primary-btn fix-gr-bg" data-question = "<?php echo e(@$question->question_bank_id); ?>" onclick="fillBlanks(<?php echo e(@$question->question_bank_id); ?>)">Fill</p>
                                                    </div>
                                                </div>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <input type="hidden" name="marks[]" value="<?php echo e(@$question->questionBank!=""?@$question->questionBank->id:""); ?>">
                                        <td width="20%" class="text-right">
                                             <div class="std_mark_box">

                                                <strong><?php echo e(@$question->questionBank!=""?@$question->questionBank->marks:""); ?></strong>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="2" class="text-center pt-4">
                                            <button class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                <?php echo app('translator')->get('lang.submit'); ?> <?php echo app('translator')->get('lang.exam'); ?>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
<script>
    $(document).on('change','.answer_question_mu',function (){
        let question_id = $(this).data('question');
        let option = $(this).data('option');
        let online_exam_id = $('#online_exam_id').val();
        let submit_value = '';
                if ($(this).is(':checked'))
                {
                    submit_value = $(this).val();
                }

                $.ajax({
                url : "<?php echo e(route('ajax_student_online_exam_submit')); ?>",
                method : "GET",
                data : {
                    online_exam_id : online_exam_id,
                    question_id : question_id,
                    option : option,
                    submit_value : submit_value,
                },
                success : function (result){
                    // console.log(result);
                    if (result.type=='warning') {
                        toastr.warning(result.message, result.title, {
                            timeOut: 5000
                        })
                    } else {
                        // toastr.success(result.message, result.title, {
                        //     timeOut: 5000
                        // })
                    }
                    
                }
            })
                
    });
    function fillBlanks(question_id) {
        let online_exam_id = $('#online_exam_id').val();
        let submit_value = $('#answer_word_'+question_id).val();
                $.ajax({
                url : "<?php echo e(route('ajax_student_online_exam_submit')); ?>",
                method : "GET",
                data : {
                    online_exam_id : online_exam_id,
                    question_id : question_id,
                    submit_value : submit_value,
                },
                success : function (result){
                    // console.log(result);
                    if (result.type=='warning') {
                        toastr.warning(result.message, result.title, {
                            timeOut: 5000
                        })
                    } else {
                        toastr.success(result.message, result.title, {
                            timeOut: 5000
                        })
                    }
                }
            })
    }

</script>


    <?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/take_online_exam.blade.php ENDPATH**/ ?>