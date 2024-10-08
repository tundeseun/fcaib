
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Assigned Courses</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#">Assigned Courses</a>
            </div>
        </div>
    </div>
</section>

<?php if(isset($courses)): ?>
<section class="mt-20">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Course Title</th>
                            <th>Course Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($course->class_name); ?></td>
                            <td><?php echo e($course->subject_name); ?></td>
                            <td><?php echo e($course->subject_code); ?></td>
                            <td><?php echo e(@$course->subject->upload->status ?? 'Pending'); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Select</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="<?php echo e(route('upload-results', $course->subject_id)); ?>">CSV Upload</a>                                    
                                        <a class="dropdown-item" href="<?php echo e(route('upload-results-single', $course->subject_id)); ?>">Single Upload</a>  
                                        <a class="dropdown-item" href="<?php echo e(route('upload-results-single', $course->subject_id)); ?>">View</a>  
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
</section>

<?php endif; ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/teacherPanel/view_courses.blade.php ENDPATH**/ ?>