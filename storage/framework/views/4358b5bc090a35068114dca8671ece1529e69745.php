
<?php $__env->startSection('title'); ?>
Course Registration
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Course Registration </h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#">Course Registration</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">

                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-3">First Semester Courses</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table  class="table table-hover bg-white" bgcolor="#ffffff" cellspacing="0" width="100%">

                                <thead> 
                                    <tr>
                                        <th class="col-6 pl-4">Course Title</th>
                                        <th class="col-4">Course Code</th>
                                        <th class="col-2">Select/Unselect Course</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $first_semester_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $first): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($first->subject_name); ?></td>
                                            <td class="col-4"><?php echo e($first->subject_code); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="<?php echo e($first->subject_code); ?>" class="form-control-sm">
                                            </td>
                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="main-title">
                        <h3 class="my-3">Second Semester Courses</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table  class="table bg-white" cellspacing="0" width="100%">

                                <thead> 
                                    <tr>
                                        <th class="col-6 pl-4">Course Title</th>
                                        <th class="col-4">Course Code</th>
                                        <th class="col-2">Select/Unselect Course</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $second_semester_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($second->subject_name); ?></td>
                                            <td class="col-4"><?php echo e($second->subject_code); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="<?php echo e($second->subject_code); ?>" class="form-control-sm">
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\college\resources\views/backEnd/studentPanel/course_registration.blade.php ENDPATH**/ ?>