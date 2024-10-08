<?php $__env->startComponent('mail::message'); ?>
Dear <?php echo e($user->student->full_name); ?>,
<p>
Your payment for Post UTME was successful, please find your receipt attached.
</p>
<?php $__env->startComponent('mail::button', ['url' => url('/login')]); ?>
Login
<?php if (isset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e)): ?>
<?php $component = $__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e; ?>
<?php unset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php if (isset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d)): ?>
<?php $component = $__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d; ?>
<?php unset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/emails/send-utme-mail.blade.php ENDPATH**/ ?>