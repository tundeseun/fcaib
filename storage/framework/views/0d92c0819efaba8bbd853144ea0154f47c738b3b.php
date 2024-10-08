
<?php $__env->startSection('title'); ?> 
Fee Payments
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Fee Payments</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_collection'); ?></a>
                <a href="#">Fee Payments</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(@$fees_payments): ?>            
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Fee</th>
                                        <th>Payee</th>
                                        <th>Method</th>
                                        <th>Amount(<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $fees_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($fees_payment->feesType->name ?? ''); ?></td>
                                            <td>
                                                <?php if($fees_payment->studentInfo): ?>
                                                    <?php echo e($fees_payment->studentInfo->full_name); ?>

                                                <?php else: ?>
                                                    Student Not Found
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($fees_payment->payment_mode); ?></td>
                                            <td><?php echo e(number_format($fees_payment->amount)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/feesCollection/search_fees_payment.blade.php ENDPATH**/ ?>