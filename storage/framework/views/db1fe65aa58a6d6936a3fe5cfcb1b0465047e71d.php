<?php $__env->startSection('title'); ?>
Payment Status
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRR Status Check</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">RRR Status Check</h1>
        <form action="<?php echo e(route('check-rrr-status')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="rrr">Enter RRR:</label>
                <input type="text" class="form-control" id="rrr" name="rrr" required>
            </div>
            <button type="submit" class="btn btn-primary">Check Status</button>
        </form>
        
        <?php if(isset($status)): ?>
            <div class="alert alert-<?php echo e($status == 'Successful' ? 'success' : 'danger'); ?> mt-4">
                <strong>Status:</strong> <?php echo e($status); ?>

            </div>
            <ul class="list-group mt-3">
                <li class="list-group-item"><strong>RRR:</strong> <?php echo e($rrr); ?></li>
                <li class="list-group-item"><strong>Amount:</strong> <?php echo e($amount); ?></li>
                <li class="list-group-item"><strong>Order ID:</strong> <?php echo e($orderId); ?></li>
                <li class="list-group-item"><strong>Message:</strong> <?php echo e($message); ?></li>
                <li class="list-group-item"><strong>Payment Date:</strong> <?php echo e($paymentDate); ?></li>
                <li class="list-group-item"><strong>Transaction Time:</strong> <?php echo e($transactionTime); ?></li>
            </ul>
        <?php else: ?>
            <div class="alert alert-warning mt-4">
                <strong>No status available. Please try again.</strong>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/payment/check-rrr-status.blade.php ENDPATH**/ ?>