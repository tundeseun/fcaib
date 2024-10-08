<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lang.pay_fees'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.fees'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.fees'); ?></a>
                    <a href="<?php echo e(route('student_fees')); ?>"><?php echo app('translator')->get('lang.pay_fees'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <?php
    $payeremail = Auth::user()->email;
    $payername = Auth::user()->full_name;
?>
    <input type="hidden" id="url" value="<?php echo e(URL::to('/')); ?>">
    <input type="hidden" id="student_id" value="<?php echo e(@$student->id); ?>">
    <section class="full_wide_table">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="d-flex justify-content-between">
                        <div class="main-title">
                            <h3 class="mb-30">Pay Fees</h3>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(session()->has('message-success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session()->get('message-success')); ?>

                </div>
            <?php elseif(session()->has('message-danger')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session()->get('message-danger')); ?>

                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12" id="myFrame">
                    <div class="table-responsive">
                        <table id="" class="display school-table school-table-style-parent-fees" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th class="nowrap"><?php echo app('translator')->get('lang.fees_group'); ?> </th>
                                <th class="nowrap"><?php echo app('translator')->get('lang.fees_code'); ?> </th>
                                <th class="nowrap"><?php echo app('translator')->get('lang.due_date'); ?> </th>
                                <th class="nowrap"><?php echo app('translator')->get('lang.status'); ?></th>
                                <th class="nowrap"><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(@generalSetting()->currency_symbol); ?>)</th>
                                <th class="nowrap"><?php echo app('translator')->get('lang.action'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                                @$grand_total = 0;
                                @$total_fine = 0;
                                @$total_discount = 0;
                                @$total_paid = 0;
                                @$total_grand_paid = 0;
                                @$total_balance = 0;
                                $count = 0;
                            ?>

                            <?php $__currentLoopData = $fees_assigneds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $count++;

                                    @$grand_total += @$fees_assigned->feesGroupMaster->amount;

                                ?>

                                <?php
                                    @$discount_amount = $fees_assigned->applied_discount;
                                    @$total_discount += @$discount_amount;
                                    @$student_id = @$fees_assigned->student_id;
                                ?>
                                <?php
                                    // Sum of total paid amount of single fees type
                                    $paid = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id)->sum('amount');

                                    @$total_grand_paid += @$paid;
                                ?>
                                <?php
                                    // Sum of total fine for single fees type
                                    $fine = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id)->sum('fine');

                                    @$total_fine += $fine;
                                ?>

                                <?php
                                    @$total_paid = @$discount_amount + @$paid;
                                ?>
                                <tr>
                                    <td>
                                        <?php echo e(@$fees_assigned->feesGroupMaster->feesGroups != "" ? @$fees_assigned->feesGroupMaster->feesGroups->name : ""); ?>

                                    </td>
                               
                                    <td>
                                        <?php echo e(@$fees_assigned->feesGroupMaster->feesTypes->name); ?>

                                    </td>
                                    <td class="nowrap">
                                        <?php echo e(@$fees_assigned->feesGroupMaster->date != "" ? dateConvert(@$fees_assigned->feesGroupMaster->date) : ''); ?>

                                    </td>

                                    <td>
                                        <?php
                                            $total_payable_amount = $fees_assigned->feesGroupMaster->amount;
                                            $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                            $balance_amount = number_format($rest_amount + $fine, 2, '.', '');
                                            $total_balance += $balance_amount;
                                        ?>
                                        <?php if($balance_amount == 0): ?>
                                            <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('lang.paid'); ?></button>
                                        <?php else: ?>
                                            <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('lang.unpaid'); ?></button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo @$total_payable_amount;
                                        ?>
                                    </td>
                                    <td>
                                        <?php if($rest_amount != 0): ?>
                                            <div class="dropdown">
                                               <button type="button" class="primary-btn fix-gr-bg"
                                                onclick="proceedToPayment('<?php echo e($fees_assigned->id); ?>', '<?php echo e($fees_assigned->feesGroupMaster->amount); ?>', '<?php echo e(@$student->id); ?>', '<?php echo e(@$fees_assigned->feesGroupMaster->feesTypes->remita_service_id); ?>','<?php echo e(@$fees_assigned->feesGroupMaster->feesTypes->name); ?>','<?php echo e($payername); ?>','<?php echo e($payeremail); ?>')">
                                            Proceed to Payment
                                        </button>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                                <?php
                                    @$payments = $student->feesPayment->where('active_status', 1)->where('fees_type_id', $fees_assigned->feesGroupMaster->feesTypes->id);
                                    $i = 0;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>
                                    <?php echo app('translator')->get('lang.grand'); ?> <?php echo app('translator')->get('lang.total'); ?> (<?php echo e(@generalSetting()->currency_symbol); ?>)
                                </th>
                                <th></th>
                                <th>
                                    <?php echo e(@$grand_total); ?>

                                </th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
    function proceedToPayment(feesAssignedId, amount, userId, remita_service_id, description,payername, payeremail) {
        var url = document.getElementById('url').value;

        // Send AJAX request to initiate payment
        $.ajax({
            url: url + '/generate-rrr', // Adjust the route to match your Laravel route
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                fees_assigned_id: feesAssignedId,
                amount: amount,
                userId: userId,
                remita_service_id: remita_service_id,
                payername: payername,
                payeremail: payeremail, // Fixed typo here
                description: description
            },
            success: function(response) {
                // Redirect to a new page or display in a modal
                window.location.href = url + '/payment-details?RRR=' + response.RRR + '&amount=' + response.amount + '&user_id=' + userId + '&fees_type_id=' + feesAssignedId + '&remita_service_id=' + remita_service_id;
            },
            error: function(error) {
                console.log(error);
                alert('Failed to initiate payment. Please try again.');
            }
        });
    }
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/fees_pay.blade.php ENDPATH**/ ?>