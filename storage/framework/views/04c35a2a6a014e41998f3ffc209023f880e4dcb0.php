<?php $__env->startSection('title'); ?>
Paid Fees & Receipts
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
            <h1>Paid Fees & Receipts</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#">Paid Fees & Receipts</a>
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
                                    <th>Fee</th>
                                    <th>Method</th>
                                    <th>Amount(<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                    <th>Date</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $fees_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($fees_payment->feesType ? $fees_payment->feesType->name : ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($fees_payment->payment_mode); ?>

                                    </td>
                                    <td><?php echo e(number_format($fees_payment->amount)); ?></td>
                                    <td>
                                        <?php echo e(dateConvert($fees_payment->payment_date)); ?>

                                    </td>
                                    <td>
                                        <?php if($fees_payment->receipt): ?>
                                            <a href="<?php echo e(url($fees_payment->receipt)); ?>" class="btn btn-sm btn-success"><span class="ti-printer"></span> Receipt</a>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/paid_fees.blade.php ENDPATH**/ ?>