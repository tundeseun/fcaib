
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Results</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#">Results</a>
            </div>
        </div>
    </div>
</section>

<?php if(isset($results)): ?>
<section class="mt-20">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Lecturer</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($result->department->class_name); ?></td>
                            <td><?php echo e($result->course->subject_code); ?><br/>
                                <small class="text-muted"><?php echo e($result->course->subject_name); ?></small>
                            </td>
                            <td><?php echo e($result->status); ?></td>
                            <td><?php echo e($result->course->assigned->teacher->getName()); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Select</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="<?php echo e(route('upload-results-single', $result->course->id)); ?>">View</a>                                    
                                        <a class="dropdown-item" href="<?php echo e(route('department-result-accept', $result->id)); ?>">Accept</a>  
                                        <a class="dropdown-item" href="<?php echo e(route('department-result-reject', $result->id)); ?>">Reject</a>  
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/teacherPanel/department_results.blade.php ENDPATH**/ ?>