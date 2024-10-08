
<?php $__env->startSection('title'); ?>
Statement of Result Application
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
            <h1>Statement of Result Application</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('statement-result')); ?>">Statement of Result Application</a>
            </div>
        </div>
    </div>
</section>
<section class="login-area  registration_area ">
        <div class="row mt-20">
            <div class="col-lg-12">
                <div class="white-box single_registration_area">
                 <?php if($has_application == 1): ?>
                    <div>
                        <h1>Existing Application</h1><hr/>
                        <p>
                            You Currently have an ongoing application for Statement of Result<br/> Please hold on while its being processed
                        </p>
                    </div>
                 <?php else: ?>   
                    <form method="POST" class="" action="<?php echo e(route('pay-with-paystack')); ?>" id="parent-registration" enctype="multipart/form-data">
                        <div class="row">
                                <div class="reg_tittle col-md-6 offset-md-3 mb-20">
                                    <h2 class="text-center">Statement of Result Application Form</h2>
                                    <p class="text-center text-danger">Note: Statement of Result application & processing costs <?php echo e(@generalSetting()->currency_symbol); ?><?php echo e(number_format($application_cost->amount)); ?> Please fill all fields & click apply to continue*</p>
                                </div>
                        </div>

                         <?php echo e(csrf_field()); ?>


                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head">Basic Information</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" type="text" name="first_name" autocomplete="off" value="<?php echo e($student_detail->first_name); ?>" readonly required>
                                    <label><?php echo app('translator')->get('lang.first_name'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('first_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e(@$errors->first('first_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" type="text" name="last_name" autocomplete="off" value="<?php echo e($student_detail->last_name); ?>" readonly required>
                                    <label><?php echo app('translator')->get('lang.last_name'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('last_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e(@$errors->first('last_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('phone_number') ? ' is-invalid' : ''); ?>" type="text" name="phone_number" autocomplete="off" value="<?php echo e($student_detail->mobile); ?>" required>
                                    <label><?php echo app('translator')->get('lang.phone_number'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('phone_number')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e(@$errors->first('phone_number')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" type="text" name="email" autocomplete="off" value="<?php echo e($student_detail->email); ?>" required>
                                    <label><?php echo app('translator')->get('lang.email'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e(@$errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('department') ? ' is-invalid' : ''); ?>" type="text" name="department" autocomplete="off" value="<?php echo e($student_detail->class->class_name); ?>" readonly>
                                    <label>Department<span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('department')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e(@$errors->first('department')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <select id="graduation_year" name="graduation_year" class="niceSelect w-100 bb form-control" required> 
                                   <option value="">Year of Graduation *</option>
                                    <?php for($i = 1990; $i <= date('Y'); $i++): ?>
                                   <option><?php echo e($i); ?></option>
                                   <?php endfor; ?>
                                </select>
                            </div>
                        </div>


                        <input type="hidden" name="orderID" value="345">
                        <input type="hidden" name="amount" value="<?php echo e($application_cost->amount * 100); ?>">
                        <input type="hidden" name="payment_type" value="Statement of Result">
                        <input type="hidden" name="student_id" value="<?php echo e($student_detail->id); ?>">
                        <input type="hidden" name="payment_mode" value="<?php echo e(@$payment_gateway->id); ?>">
                        <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef()); ?>"> 
                        <input type="hidden" name="key" value="<?php echo e(@$paystack_info->gateway_secret_key); ?>"> 
                        <?php echo e(csrf_field()); ?> 
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="float-left">
                                    <button type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                        <span class="ti-check"></span>
                                       Apply
                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>

                </div>
            </div>
        </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/statement_result.blade.php ENDPATH**/ ?>