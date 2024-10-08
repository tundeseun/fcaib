
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.result'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Results</h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.examinations'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.result'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
            <div class="col-lg-12">
                <div class="no-search no-paginate no-table-info mb-2">
                    
                    <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $f_credit_units = 0; $f_grade_points = 0;
                        $f_results = App\SmCourseRegistration::getExamResult(@$level->student_id, 'F', @$level->section);
                    ?>
                    <?php if(count($f_results) > 0): ?>

                    <table id="table_id" class="display school-table mb-5" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Level
                                </th>
                                <th>
                                    Semester
                                </th>
                                <th>
                                    Course
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Units
                                </th>
                                <th>
                                    Grade Obtained
                                </th>
                                <th>
                                    Grade Point
                                </th>
                                <th>
                                    Remark
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $f_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fresult): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(@$level->section_name); ?></td>
                                <td>First</td>
                                <td><?php echo e(@$fresult->subject_code); ?></td>
                                <td><?php echo e(@$fresult->subject_name); ?></td>
                                <td><?php echo e(@$fresult->units); ?></td>
                                <td><?php echo e(@$fresult->grade); ?></td>
                                <td><?php echo e(@$fresult->grade_point); ?></td>
                                <td><?php echo e($fresult->remark); ?></td>
                                <?php $f_credit_units += $fresult->units; $f_grade_points += $fresult->grade_point; ?>  
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                        <?php if($f_credit_units != 0): ?>
                        <h3>Grade Point Average : <?php echo e(number_format($f_grade_points/$f_credit_units,2)); ?></h3>
                        <h3>Cumulative Grade Point Average : <?php echo e(number_format(App\SmCourseRegistration::cgpa($id),2)); ?></h3>
                        <?php endif; ?>

                    <?php endif; ?>

                    <?php
                        $s_credit_units = 0; $s_grade_points = 0;
                        $s_results = App\SmCourseRegistration::getExamResult(@$level->student_id, 'S', @$level->section);
                    ?>
                    <?php if(count($s_results) > 0 ): ?>
                    <table id="table_id" class="display school-table mb-5" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Level
                                </th>
                                <th>
                                    Semester
                                </th>
                                <th>
                                    Course
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Units
                                </th>
                                <th>
                                    Grade Obtained
                                </th>
                                <th>
                                    Grade Point
                                </th>
                                <th>
                                    Remark
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $s_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sresult): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(@$level->section_name); ?></td>
                                <td>Second</td>
                                <td><?php echo e(@$sresult->subject_code); ?></td>
                                <td><?php echo e(@$sresult->subject_name); ?></td>
                                <td><?php echo e(@$sresult->units); ?></td>
                                <td><?php echo e(@$sresult->grade); ?></td>
                                <td><?php echo e(@$sresult->grade_point); ?></td>
                                <td><?php echo e($sresult->remark); ?></td>
                                <?php $s_credit_units += $sresult->units; $s_grade_points += $sresult->grade_point; ?>  
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                        <?php if($s_credit_units != 0): ?>
                                <h3>Grade Point Average : <?php echo e(number_format($s_grade_points/$s_credit_units,2)); ?></h3>
                                <h3>Cumulative Grade Point Average : <?php echo e(number_format(App\SmCourseRegistration::cgpa($id),2)); ?></h3>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/student_result.blade.php ENDPATH**/ ?>