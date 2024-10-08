<?php if(userPermission(542)  ): ?>
    <li data-position="<?php echo e(menuPosition(542)); ?>" class="sortable_li">
        <a href="#subMenuStudentRegistration" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-reading"></span>
            <?php echo app('translator')->get('lang.registration'); ?>
        </a>
        <ul class="collapse list-unstyled" id="subMenuStudentRegistration">
            <?php if(userPermission(543) ): ?>
                <li data-position="<?php echo e(menuPosition(543)); ?>">
                    <a href="<?php echo e(route('parentregistration-applicants')); ?>"> Applicants List</a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\college\Modules/ParentRegistration\Resources/views/menu/ParentRegistration.blade.php ENDPATH**/ ?>