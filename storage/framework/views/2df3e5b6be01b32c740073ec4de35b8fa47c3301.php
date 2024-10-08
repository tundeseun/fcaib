
<?php $__env->startSection('title'); ?>
Lecturers <?php echo app('translator')->get('lang.list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Lecturers <?php echo app('translator')->get('lang.list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#">Lecturers</a>
                <a href="#">Lecturers <?php echo app('translator')->get('lang.list'); ?></a>
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
                            <h3 class="mb-0">Lecturer</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr> 
                                    <th>Lecturer <?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.email'); ?></th>
                                    <th><?php echo app('translator')->get('lang.phone'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr> 
                                    <td>
                                        <img src="<?php echo e(file_exists(@$value->teacher->staff_photo) ? asset(@$value->teacher->staff_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?>" class="img img-thumbnail" style="width: 60px; height: auto;">
                                        <?php echo e(@$value->teacher !=""?@$value->teacher->full_name:""); ?>

                                    </td> 
                                    <td><?php echo e(@$value->teacher !=""?@$value->teacher->email:""); ?></td>
                                    <td><?php echo e(@$value->teacher !=""?@$value->teacher->mobile:""); ?></td>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/studentTeacher.blade.php ENDPATH**/ ?>