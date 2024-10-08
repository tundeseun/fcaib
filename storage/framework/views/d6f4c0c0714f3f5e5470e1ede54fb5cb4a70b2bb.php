
<?php $__env->startSection('title'); ?>
Transcript Applications
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
            <h1>Transcript Applications</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('transcript-applications')); ?>">Transcript Applications</a>
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
                                    <th>Entry/Grad. Year</th>
                                    <th>Institution</th>
                                    <th>Institution Country</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $transcripts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transcript): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$transcript->names); ?></td>
                                        <td><?php echo e(@$transcript->department); ?></td>
                                        <td><?php echo e(@$transcript->entry_year); ?> - <?php echo e(@$transcript->graduation_year); ?></td>
                                        <td><?php echo e(@$transcript->institution_name); ?></td>
                                        <td><?php echo e(@$transcript->institution_country); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('transcript',@$transcript->id)); ?>" class="btn btn-primary btn-sm"><span class="ti-eye"></span> View</a>
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


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/transcript_applications.blade.php ENDPATH**/ ?>