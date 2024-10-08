
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.marking'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.examinations'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.examinations'); ?></a>
                <a href="<?php echo e(route('online-exam')); ?>"><?php echo app('translator')->get('lang.online_exam'); ?></a>
                <a href="<?php echo e(route('online_exam_marks_register', [@$online_exam_question->id])); ?>"><?php echo app('translator')->get('lang.marking'); ?></a>
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
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.marking'); ?></h3>
                </div>
            </div>
        </div>


    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'online_exam_marks_store',  'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'marks_register_store'])); ?> 

        <input type="hidden" name="exam_id" value="<?php echo e(@$online_exam_question->id); ?>">
        <input type="hidden" name="subject_id" value="<?php echo e(@$online_exam_question->subject_id); ?>">
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
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>


                            <th><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                            <th><?php echo app('translator')->get('lang.student'); ?></th>
                            <th><?php echo app('translator')->get('lang.class_Sec'); ?></th>
                            <th><?php echo app('translator')->get('lang.exam'); ?></th>
                            <th><?php echo app('translator')->get('lang.subject'); ?></th>
                            <th><?php echo app('translator')->get('lang.marking'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                
                            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(@$student->admission_no); ?></td>
                                <td><?php echo e(@$student->full_name); ?></td>
                                <td><?php echo e(@$student->className !=""?@$student->className->class_name: ""); ?> (<?php echo e(@$student->section !=""?@$student->section->section_name: ""); ?>)</td>
                                <td><?php echo e(@$online_exam_question->title); ?></td>
                                <td><?php echo e(@$online_exam_question->subject !=""?$online_exam_question->subject->subject_name:""); ?></td>
                                <td>
                                    <?php if(in_array(@$student->id, @$present_students)): ?>
                                        <a class="primary-btn small bg-success text-white border-0" href="<?php echo e(route('online_exam_marking', [@$online_exam_question->id, @$student->id])); ?>">
                                            <?php echo app('translator')->get('lang.view_answer_marking'); ?>
                                     </a>
                                    <?php else: ?>
                                        <a class="primary-btn small bg-warning text-white border-0" href="#">
                                            <?php echo app('translator')->get('lang.absent'); ?>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/examination/online_exam_marks_register.blade.php ENDPATH**/ ?>