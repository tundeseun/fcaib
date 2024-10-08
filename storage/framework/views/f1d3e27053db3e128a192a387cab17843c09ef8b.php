
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.collect_fees'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.fees_collection'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_collection'); ?></a>
                <a href="<?php echo e(route('collect_fees')); ?>"><?php echo app('translator')->get('lang.collect_fees'); ?></a>
                <a href="<?php echo e(route('fees_collect_student_wise', [$student->id])); ?>"><?php echo app('translator')->get('lang.student_wise'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="student-details mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.fees'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="student-meta-box">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->get('lang.name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo e(@$student->full_name); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->get('lang.mobile'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo e(@$student->mobile); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-lg-2 col-lg-5 col-md-6">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->get('lang.class'); ?> <?php echo app('translator')->get('lang.section'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php
                                                    if(@$student->className !="" && @$student->section !="")
                                                    {
                                                        echo $student->className->class_name .'('.$student->section->section_name.')';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Matric Number
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo e(@$student->matric_number); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="url" value="<?php echo e(URL::to('/')); ?>">
<input type="hidden" id="student_id" value="<?php echo e(@$student->id); ?>">
<section class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.fees'); ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                       
                        <tr>
                            <td class="text-right" colspan="14">
                                <a href="" id="fees_groups_invoice_print_button" class="primary-btn medium fix-gr-bg" target="">
                                    <i class="ti-printer pr-2"></i>
                                    <?php echo app('translator')->get('lang.invoice_print'); ?>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->get('lang.fees'); ?></th>
                            <th><?php echo app('translator')->get('lang.due_date'); ?></th>
                            <th><?php echo app('translator')->get('lang.Status'); ?></th>
                            <th><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                            <th><?php echo app('translator')->get('lang.payment_id'); ?></th>
                            <th><?php echo app('translator')->get('lang.mode'); ?></th>
                            <th><?php echo app('translator')->get('lang.date'); ?></th>
                            <th><?php echo app('translator')->get('lang.discount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                            <th><?php echo app('translator')->get('lang.fine'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                            <th><?php echo app('translator')->get('lang.paid'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                            <th><?php echo app('translator')->get('lang.balance'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $grand_total = 0;
                            $total_fine = 0;
                            $total_discount = 0;
                            $total_paid = 0;
                            $total_grand_paid = 0;
                            $total_balance = 0;
                        ?>
                        <?php $__currentLoopData = $fees_assigneds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $grand_total += $fees_assigned->feesGroupMaster->amount;
                            $discount_amount = $fees_assigned->applied_discount;
                            $total_discount += $discount_amount;
                            $student_id = $fees_assigned->student_id;
                            $paid = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'amount');
                            $total_grand_paid += $paid;
                            $fine = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'fine');
                            $total_fine += $fine;
                            $total_paid = $discount_amount + $paid;
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" id="fees_group.<?php echo e($fees_assigned->id); ?>" class="common-checkbox fees-groups-print" name="fees_group[]" value="<?php echo e($fees_assigned->id); ?>">
                                <label for="fees_group.<?php echo e($fees_assigned->id); ?>"></label>
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            </td>
                            <td>
                                <?php echo e(@$fees_assigned->feesGroupMaster->feesGroups->name); ?> / <?php echo e(@$fees_assigned->feesGroupMaster->feesTypes->name); ?>

                            </td>
                            <td>
                                <?php if($fees_assigned->feesGroupMaster !=""): ?>
                                    <?php echo e($fees_assigned->feesGroupMaster->date != ""? dateConvert($fees_assigned->feesGroupMaster->date):''); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                
                                <?php
                                    $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                    
                                    $total_balance +=  $rest_amount;
                                    
                                    $balance_amount = number_format($rest_amount+$fine, 2, '.', '');
                                   
                                ?>
                                
                                <?php if($balance_amount == 0): ?>
                                    <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('lang.paid'); ?></button>
                                <?php elseif($paid != 0): ?>
                                    <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('lang.partial'); ?></button>
                                <?php elseif($paid == 0): ?>
                                    <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('lang.unpaid'); ?></button>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($fees_assigned->feesGroupMaster->amount); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo e($discount_amount); ?></td>
                            <td><?php echo e($fine); ?></td>
                            <td><?php echo e($paid); ?></td>
                            <td> 
                                <?php
                                    $rest_amount = $fees_assigned->fees_amount;
                                    $total_balance +=  $rest_amount;
                                    echo $balance_amount;
                                ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <?php echo app('translator')->get('lang.select'); ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php if(userPermission(111)): ?>
                                            <?php if($balance_amount != 0): ?> 
                                                <a class="dropdown-item modalLink" data-modal-size="modal-lg" 
                                                title="<?php echo e(@$fees_assigned->feesGroupMaster->feesGroups->name.': '. $fees_assigned->feesGroupMaster->feesTypes->name); ?>"  
                                                href="<?php echo e(route('fees-generate-modal', [$balance_amount, $fees_assigned->student_id, $fees_assigned->feesGroupMaster->fees_type_id,$fees_assigned->fees_master_id,$fees_assigned->id])); ?>" ><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.fees'); ?> </a>
                                            <?php else: ?>
                                                <a class="dropdown-item"  target="_blank">Payment Done</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                            <?php
                                $payments = App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id, $fees_assigned->student_id);
                                $i = 0;
                            ?>
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">
                                    <img src="<?php echo e(asset('public/backEnd/img/table-arrow.png')); ?>">
                                </td>
                                <td>
                                    <?php
                                        $created_by = App\User::find($payment->created_by);
                                    ?>
                                    <?php if($created_by != ""): ?>
                                        <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo e('Collected By: '.$created_by->full_name); ?>"><?php echo e($payment->fees_type_id.'/'.$payment->id); ?></a>
                                </td>
                                    <?php endif; ?>
                                <td><?php echo e($payment->payment_mode); ?></td>
                                <td class="nowrap"><?php echo e($payment->payment_date != ""? dateConvert($payment->payment_date):''); ?></td>
                                <td class="text-center"><?php echo e($payment->discount_amount); ?></td>
                                <td>
                                    <?php echo e($payment->fine); ?>

                                    <?php if($payment->fine!=0): ?>
                                        <?php if(strlen($payment->fine_title) > 14): ?>
                                            <spna class="text-danger nowrap" title="<?php echo e($payment->fine_title); ?>">
                                                (<?php echo e(substr($payment->fine_title, 0, 15) . '...'); ?>)
                                            </spna>
                                        <?php else: ?>
                                            <?php if($payment->fine_title==''): ?>
                                                <?php echo e($payment->fine_title); ?>

                                            <?php else: ?>
                                                <spna class="text-danger nowrap">
                                                    (<?php echo e($payment->fine_title); ?>)
                                                </spna>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($payment->amount); ?>

                                </td>
                                <td></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th><?php echo app('translator')->get('lang.grand_total'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                            <th></th>
                            <th><?php echo e(number_format($grand_total, 2, '.', '')); ?></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo e(number_format($total_discount, 2, '.', '')); ?></th>
                            <th><?php echo e(number_format($total_fine, 2, '.', '')); ?></th>
                            <th><?php echo e(number_format($total_grand_paid, 2, '.', '')); ?></th>
                                <?php
                                    $show_balance=$grand_total+$total_fine-$total_discount;
                                ?>
                            <th><?php echo e(number_format($show_balance-$total_grand_paid, 2, '.', '')); ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/feesCollection/collect_fees_student_wise.blade.php ENDPATH**/ ?>