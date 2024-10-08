
<?php $__env->startSection('title'); ?>
Statement of Result Applications
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    .form-control{
        margin-top: 8px;
    }
    label{
        margin-top: 8px;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Treated Statement of Result Applications</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#">Statement of Result Applications</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>Names</th>
                                    <th>Dept.</th>
                                    <th>Grad. Year</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$result->names); ?></td>
                                        <td><?php echo e(@$result->department); ?></td>
                                        <td><?php echo e(@$result->graduation_year); ?></td>
                                        <td><?php echo e(@$result->email); ?></td>
                                        <td><?php echo e(@$result->phone_number); ?></td>
                                        <td>
                                            <?php if($result->status == 1): ?>
                                            <a href="<?php echo e(route('statement-m-untreated', $result->id)); ?>" class="btn btn-primary btn-sm"><span class="ti-close"></span> Mark as Untreated</a>
                                            <?php else: ?>
                                            <a href="<?php echo e(route('statement-m-treated', $result->id)); ?>" class="btn btn-primary btn-sm"><span class="ti-check"></span> Mark as Treated</a>
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


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/statement_applications.blade.php ENDPATH**/ ?>