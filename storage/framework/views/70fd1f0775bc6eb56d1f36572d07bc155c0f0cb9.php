<?php $__env->startSection('title'); ?>
    Payment Success
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

<style>
    .payment-container {
        margin-top: 30px;
        text-align: center;
    }
    .card-header {
        background-color: #001f3f; /* Navy blue */
        color: white;
        font-size: 1.25rem;
        text-align: center;
    }
    .card-body {
        padding: 20px;
        font-size: 1rem;
    }
    .payment-info p {
        font-size: 1.1rem;
        font-weight: bold;
        color: #001f3f;
    }
    .payment-info span {
        font-size: 1.2rem;
        font-weight: bold;
    }
</style>

<div class="container payment-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Successful</div>
                <div class="card-body">
                    <div class="payment-info">
                        <p>Payment Reference: <span><?php echo e($payment->payment_reference); ?></span></p>
                        <p>Transaction ID: <span><?php echo e($payment->transaction_id); ?></span></p>
                        <p>Amount Paid: <span>&#8358;<?php echo e(number_format($payment->amount, 2)); ?></span></p>
                        <p>Payment Date: <span><?php echo e($payment->payment_date); ?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/payment/success.blade.php ENDPATH**/ ?>