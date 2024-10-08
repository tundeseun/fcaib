<div class="text-center">
    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
</div>

<div class="mt-40 d-flex justify-content-between">
    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
    <a href="<?php echo e(route('delete-exam-schedule',@$id)); ?>" class="text-light">
    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
     </a>
</div><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/academics/delete_exam_schedule.blade.php ENDPATH**/ ?>