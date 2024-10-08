
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
                        <form class="col-lg-12" method="post" action="<?php echo e(route('course-registration')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="semester" value="F">

                            <table  class="table table-hover bg-white" bgcolor="#ffffff" cellspacing="0" width="100%">

                                <thead> 
                                    <tr>
                                        <th class="col-6 pl-4">Course Title</th>
                                        <th class="col-2">Course Code</th>
                                        <th class="col-2">Units</th>
                                        <th class="col-2">Select/Unselect</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $first_semester_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $first): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($first->subject_name); ?></td>
                                            <td class="col-2"><?php echo e($first->subject_code); ?></td>
                                            <td class="col-2"><?php echo e($first->units); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="subjects[]" class="form-control-sm" value="<?php echo e($first->id); ?>" <?php if($student_detail->first_semester_reg == 1): ?> checked = "true" disabled = "true" <?php endif; ?> >
                                            </td>
                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $first_semester_elective_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $first_electives): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($first_electives->subject_name); ?></td>
                                            <td class="col-2"><?php echo e($first_electives->subject_code); ?></td>
                                            <td class="col-2"><?php echo e($first_electives->units); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="subjects[]" class="form-control-sm" value="<?php echo e($first_electives->id); ?>" <?php if($student_detail->first_semester_reg == 1): ?> checked = "true" disabled = "true" <?php endif; ?>>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $first_semester_general_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $first_generals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($first_generals->subject_name); ?></td>
                                            <td class="col-2"><?php echo e($first_generals->subject_code); ?></td>
                                            <td class="col-2"><?php echo e($first_generals->units); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="subjects[]" class="form-control-sm" value="<?php echo e($first_generals->id); ?>" checked = "true" disabled = "true" >
                                                <input type="hidden" name="subjects[]" value="<?php echo e($first_generals->id); ?>" checked = "true">
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    <?php $__currentLoopData = $first_semester_carryover_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $first_carryovers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($first_carryovers->subject_name); ?></td>
                                            <td class="col-2"><?php echo e($first_carryovers->subject_code); ?></td>
                                            <td class="col-2"><?php echo e($first_carryovers->units); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="subjects[]" class="form-control-sm" value="<?php echo e($first_carryovers->id); ?>" checked = "true" disabled = "true">
                                                <input type="hidden" name="subjects[]" value="<?php echo e($first_carryovers->id); ?>" checked = "true">
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary btn-sm">Save/Print</button>
                        </form>
                    </div>

                    <div class="main-title">
                        <h3 class="my-3">Second Semester Courses</h3>
                    </div>
                    <div class="row">
                        <form class="col-lg-12" method="post" action="<?php echo e(route('course-registration')); ?>">
                            <?php echo csrf_field(); ?>  
                            <input type="hidden" name="semester" value="S">
                            <table  class="table bg-white" cellspacing="0" width="100%">

                                <thead> 
                                    <tr>
                                        <th class="col-5 pl-4">Course Title</th>
                                        <th class="col-3">Course Code</th>
                                        <th class="col-2">Units</th>
                                        <th class="col-2">Select/Unselect</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $second_semester_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($second->subject_name); ?></td>
                                            <td class="col-2"><?php echo e($second->subject_code); ?></td>
                                            <td class="col-2"><?php echo e($second->units); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="subjects[]" class="form-control-sm" value="<?php echo e($second->id); ?>" <?php if($student_detail->second_semester_reg == 1): ?> checked = "true" disabled = "true" <?php endif; ?>>

                                            </td>
                                        </tr>                                        

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $second_semester_elective_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second_electives): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($second_electives->subject_name); ?></td>
                                            <td class="col-2"><?php echo e($second_electives->subject_code); ?></td>
                                            <td class="col-2"><?php echo e($second_electives->units); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="subjects[]" class="form-control-sm" value="<?php echo e($second_electives->id); ?>" <?php if($student_detail->second_semester_reg == 1): ?> checked = "true" disabled = "true" <?php endif; ?>>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $second_semester_general_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second_generals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($second_generals->subject_name); ?></td>
                                            <td class="col-2"><?php echo e($second_generals->subject_code); ?></td>
                                            <td class="col-2"><?php echo e($second_generals->units); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="subjects[]" class="form-control-sm" value="<?php echo e($second_generals->id); ?>" checked = "true" disabled = "true">
                                                <input type="hidden" name="subjects[]" value="<?php echo e($second_generals->id); ?>" checked = "true">
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    <?php $__currentLoopData = $second_semester_carryover_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second_carryovers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="col-6 pl-4"><?php echo e($second_carryovers->subject_name); ?></td>
                                            <td class="col-2"><?php echo e($second_carryovers->subject_code); ?></td>
                                            <td class="col-2"><?php echo e($second_carryovers->units); ?></td>
                                            <td class="col-2">
                                                <input type="checkbox" name="subjects[]" class="form-control-sm" value="<?php echo e($second_carryovers->id); ?>" checked = "true" disabled = "true" >
                                                <input type="hidden" name="subjects[]" value="<?php echo e($second_carryovers->id); ?>" checked = "true">
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary btn-sm">Save/Print</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/course_registration.blade.php ENDPATH**/ ?>