
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
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"> Hostel Accomodation</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <?php if($student_detail->room_id != 0): ?>

                            <div class="bg-white col-12 p-5" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-3" style='background-size: cover; background-image: url("<?php echo e(file_exists(@$student_detail->student_photo) ? asset($student_detail->student_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?> ");'>
                                    </div>
                                    <div class="col-md-9">
                                        <h3>Accomodation Details</h3><hr/>
                                        <h5><?php echo e($accomodation->dormitory_name); ?></h5>
                                        <p>Room Number <?php echo e($accomodation->name); ?><br/><?php echo e($accomodation->description); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                        <table id="default_table2" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.dormitory'); ?></th>
                                    <th><?php echo app('translator')->get('lang.room_number'); ?> </th>
                                    <th><?php echo app('translator')->get('lang.room_type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.no_of_bed'); ?></th>
                                    <th>Available</th>
                                    <th><?php echo app('translator')->get('lang.cost_per_bed'); ?></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $room_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$room_list->dormitory_name); ?></td>
                                        <td><?php echo e(@$room_list->name); ?></td>
                                        <td><?php echo e(@$room_list->description); ?></td>
                                        <td><?php echo e(@$room_list->number_of_bed); ?></td>
                                        <td><?php echo e(@$room_list->number_of_bed - @$room_list->taken); ?></td>
                                        <td><?php echo e(@generalSetting()->currency_symbol); ?><?php echo e(@number_format($room_list->cost_per_bed)); ?></td>
                                        <td>
                                            <?php if(@$student_detail->room_id == @$room_list->id): ?>
                                                <button class="primary-btn small fix-gr-bg">
                                                   <?php echo app('translator')->get('lang.assigned'); ?>                                                 
                                                </button>
                                            <?php else: ?>
                                            
                                                <?php if($room_list->cost_per_bed != 0): ?>

                                                        <?php
                                                            $is_paystack = DB::table('sm_payment_methhods')->where('method','Paystack')->where('active_status',1)->first();
                                                        ?>
                                                        <?php if(!empty($is_paystack) && $room_list->cost_per_bed !=0): ?>
                                                            <form method="POST" action="<?php echo e(route('pay-with-paystack')); ?>"
                                                                  accept-charset="UTF-8" class="form-horizontal"
                                                                  role="form">
                                                                <input type="hidden" name="email" value="<?php echo e($student_detail->email); ?>">
                                                                <input type="hidden" name="orderID" value="345">
                                                                <input type="hidden" name="amount" value="<?php echo e($room_list->cost_per_bed*100); ?>">
                                                                <input type="hidden" name="payment_type"
                                                                   value="hostel">
                                                                <input type="hidden" name="room_id"
                                                                   value="<?php echo e($room_list->id); ?>">
                                                                <input type="hidden" name="student_id"
                                                                       value="<?php echo e($student_detail->id); ?>">
                                                                <input type="hidden" name="payment_mode"
                                                                       value="<?php echo e(@$payment_gateway->id); ?>">
                                                                <input type="hidden" name="reference"
                                                                       value="<?php echo e(Paystack::genTranxRef()); ?>"> 
                                                                <input type="hidden" name="key"
                                                                       value="<?php echo e(@$paystack_info->gateway_secret_key); ?>"> 
                                                                <?php echo e(csrf_field()); ?> 

                                                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
                                                                <button type="submit" class="primary-btn small fix-gr-bg">
                                                                   Make Payment
                                                                </button>
                                                            </form>
                                                        <?php endif; ?>
                                                <?php endif; ?>


                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/student_dormitory.blade.php ENDPATH**/ ?>