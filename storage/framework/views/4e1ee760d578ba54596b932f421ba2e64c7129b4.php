
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.subject'); ?> <?php echo app('translator')->get('lang.list'); ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.subject'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('student_subject')); ?>"><?php echo app('translator')->get('lang.subject'); ?></a>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.subject_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.subject'); ?></th>
                                    <th>Lecturer</th>
                                    <th><?php echo app('translator')->get('lang.subject_type'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $assignSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignSubject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$assignSubject->subject!=""?@$assignSubject->subject->subject_name:""); ?></td>
                                    <td><?php echo e(@$assignSubject->teacher!=""?@$assignSubject->teacher->full_name:""); ?></td>
                                    <td>
                                        <?php if(!empty(@$assignSubject->subject)): ?>
                                        <?php echo e(@$assignSubject->subject->subject_type == "T"? 'Theory': 'Practical'); ?>

                                        <?php endif; ?>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/student_subject.blade.php ENDPATH**/ ?>