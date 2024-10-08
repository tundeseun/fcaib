

<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.result'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<?php
    $user = Auth::user()->student;
    date_default_timezone_set($time_zone_setup->time_zone);
?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.online_exam'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.online_exam'); ?></a>
                <a href="<?php echo e(route('student_view_result')); ?>"><?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.result'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.online_exam'); ?> <?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.result'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead> 
                                <tr>
                                    <th><?php echo app('translator')->get('lang.title'); ?></th>
                                    <th><?php echo app('translator')->get('lang.time'); ?></th>
                                    <th><?php echo app('translator')->get('lang.total_marks'); ?></th>
                                    <th><?php echo app('translator')->get('lang.obtained_marks'); ?> </th>
                                    <th><?php echo app('translator')->get('lang.result'); ?></th>
                                    <th><?php echo app('translator')->get('lang.status'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $result_views; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($result_view->onlineExam !=""?@$result_view->onlineExam->title:""); ?></td>
                                        <td  data-sort="<?php echo e(strtotime(@$result_view->onlineExam->date)); ?>" >
                                            <?php if(!empty(@$result_view->onlineExam)): ?>
                                           <?php echo e(@$result_view->onlineExam->date != ""? dateConvert(@$result_view->onlineExam->date):''); ?>



                                             
                                             <br> Time: <?php echo e(date('h:i A', strtotime(@$result_view->onlineExam->start_time)).' - '.date('h:i A', strtotime(@$result_view->onlineExam->end_time))); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $total_marks = 0;
                                            foreach($result_view->onlineExam->assignQuestions as $assignQuestion){
                                                @$total_marks = $total_marks + @$assignQuestion->questionBank->marks;
                                            }
                                            echo @$total_marks;
                                            ?>
                                        </td>
                                        <td><?php echo e(@$result_view->total_marks); ?></td>
                                        <td>
                                            <?php
                                                @$result = @$result_view->total_marks * 100 / @$total_marks;
                                                if(@$result >= @$result_view->onlineExam->percentage){
                                                    echo "Pass";  
                                                }else{
                                                    echo "Fail";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                             <?php
                                                $startTime = strtotime($result_view->onlineExam->date . ' ' . $result_view->onlineExam->start_time);
                                                $endTime = strtotime($result_view->onlineExam->date . ' ' . $result_view->onlineExam->end_time);
                                                $now = date('h:i:s');
                                                $now =  strtotime("now");
                                            ?>

                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <?php if($now >= $endTime): ?>
                                                    <a class=" dropdown-item btn btn-success modalLink" data-modal-size="modal-lg" title="Answer Script"  href="<?php echo e(route('student_answer_script', [@$result_view->online_exam_id, @$result_view->student_id])); ?>" ><?php echo app('translator')->get('lang.answer_script'); ?></a>
                                                    <a class="dropdown-item" href="<?php echo e(route("student-online-exam-question-view", [$result_view->online_exam_id])); ?>"><?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.question'); ?></a>
                                                    
                                                    <?php else: ?>
                                                        <span class=" dropdown-item"><?php echo app('translator')->get('lang.Wait_Till_Exam_Finish'); ?></span>
                                                    <?php endif; ?>
                                                
                                                   </div>
                                            </div>
                                           
                                            
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/student_view_result.blade.php ENDPATH**/ ?>