
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.dormitory'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.dormitory'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('student_dormitory')); ?>"><?php echo app('translator')->get('lang.dormitory'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <?php if(isset($room_list)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('room-list')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"> <?php echo app('translator')->get('lang.dormitory_room_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="default_table2" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.dormitory'); ?></th>
                                    <th><?php echo app('translator')->get('lang.room_number'); ?> </th>
                                    <th><?php echo app('translator')->get('lang.room_type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.no_of_bed'); ?></th>
                                    <th><?php echo app('translator')->get('lang.cost_per_bed'); ?></th>
                                    <th><?php echo app('translator')->get('lang.status'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $room_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php @$rowCount=0; ?>
                                    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(@$rowCount==0): ?>
                                        <td rowspan="<?php echo e(@$values->count()); ?>"><?php echo e(@$room_list->dormitory != ""? @$room_list->dormitory->dormitory_name:''); ?></td>
                                        <?php endif; ?>
                                        <?php @$rowCount=@$rowCount+1; ?>
                                        <td><?php echo e(@$room_list->name); ?></td>
                                        <td><?php echo e(@$room_list->roomType != ""? @$room_list->roomType->type: ''); ?></td>
                                        <td><?php echo e(@$room_list->number_of_bed); ?></td>
                                        <td><?php echo e(@$room_list->cost_per_bed); ?></td>
                                        <td>
                                            <?php if(@$student_detail->room_id == @$room_list->id): ?>
                                                <button class="primary-btn small fix-gr-bg">
                                                   <?php echo app('translator')->get('lang.assigned'); ?>                                                 
                                                </button>
                                             <?php else: ?>
                                              
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\college\resources\views/backEnd/studentPanel/student_dormitory.blade.php ENDPATH**/ ?>