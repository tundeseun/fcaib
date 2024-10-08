
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.active_exams'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.online_exam'); ?> </h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.online_exam'); ?></a>
                    <a href="<?php echo e(route('student_online_exam')); ?>"><?php echo app('translator')->get('lang.active_exams'); ?></a>
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
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.online_active_exams'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.title'); ?></th>
                                    <th><?php echo app('translator')->get('lang.class_Sec'); ?></th>
                                    <th><?php echo app('translator')->get('lang.subject'); ?></th>
                                    <th><?php echo app('translator')->get('lang.exam_date'); ?></th>
                                    
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $online_exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $online_exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        @$submitted_answer = $student->studentOnlineExam->where('online_exam_id',$online_exam->id)->first();
                                        
                                    ?>
                                    <?php if(!in_array(@$online_exam->id, @$marks_assigned)): ?>
                                        <tr>
                                            <td><?php echo e(@$online_exam->title); ?></td>
                                            <td><?php echo e(@$online_exam->class->class_name.'  ('.@$online_exam->section->section_name.')'); ?></td>
                                            <td><?php echo e(@$online_exam->subject !=""?@$online_exam->subject->subject_name:""); ?></td>
                                            <td data-sort="<?php echo e(strtotime(@$online_exam->date)); ?>">
                                                <?php echo e(@$online_exam->date != ""? dateConvert(@$online_exam->date):''); ?>


                                                <br>
                                                Time: <?php echo e(date('h:i A', strtotime(@$online_exam->start_time)).' - '.date('h:i A', strtotime(@$online_exam->end_time))); ?>

                                            </td>

                                            <td>
                                                <?php
                                                        $startTime = strtotime($online_exam->date . ' ' . $online_exam->start_time);
                                                        $endTime = strtotime($online_exam->date . ' ' . $online_exam->end_time);
                                                        $now = date('h:i:s');
                                                        $now =  strtotime("now");
                                                    ?>
                                                <?php if( !empty( $submitted_answer)): ?>
                                                    <?php if(@$submitted_answer->status == 1): ?>

                                                            <?php if($submitted_answer->student_done==1): ?>
                                                                <span class="btn primary-btn small  fix-gr-bg"
                                                                style="background:green"><?php echo app('translator')->get('lang.already_submitted'); ?></span>
                                                            <?php elseif($startTime <= $now && $now <= $endTime): ?>
                                                                <a class="btn primary-btn small  fix-gr-bg"
                                                                    style="background:green"
                                                                    href="<?php echo e(route("take_online_exam", [@$online_exam->id])); ?>"><?php echo app('translator')->get('lang.take_exam'); ?></a>
                                                            
                                                            <?php elseif($startTime >= $now && $now <= $endTime): ?>
                                                                <span class="btn primary-btn small  fix-gr-bg"
                                                                    style="background:blue">Waiting</span>
                                                            <?php elseif($now >= $endTime): ?>
                                                                <span class="btn primary-btn small  fix-gr-bg"
                                                                    style="background:#dc3545">Closed</span>
                                                            
                                                            
                                                            <?php else: ?>
                                                                
                                                                <span class="btn primary-btn small  fix-gr-bg"
                                                                    style="background:green"><?php echo app('translator')->get('lang.already_submitted'); ?></span>
                                                            <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if($startTime <= $now && $now <= $endTime): ?>
                                                        <a class="btn primary-btn small  fix-gr-bg"
                                                            style="background:green"
                                                            href="<?php echo e(route("take_online_exam", [@$online_exam->id])); ?>"><?php echo app('translator')->get('lang.take_exam'); ?></a>
                                                    
                                                    <?php elseif($startTime >= $now && $now <= $endTime): ?>
                                                        <span class="btn primary-btn small  fix-gr-bg"
                                                            style="background:blue">Waiting</span>
                                                    <?php elseif($now >= $endTime): ?>
                                                        <span class="btn primary-btn small  fix-gr-bg"
                                                            style="background:#dc3545">Closed</span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade admin-query" id="deleteOnlineExam">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.item'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="text-center">
                        <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                    </div>

                    <div class="mt-40 d-flex justify-content-between">
                        <button type="button" class="primary-btn tr-bg"
                                data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                        <?php echo e(Form::open(['route' => 'online-exam-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <input type="hidden" name="id" id="online_exam_id">
                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/online_exam.blade.php ENDPATH**/ ?>