<?php $__env->startSection('title'); ?>
<?php echo e($fee->feesGroupMaster->feesTypes->name); ?> Payment
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
            <h1><?php echo e($fee->feesGroupMaster->feesTypes->name); ?> Payment</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('student_fees')); ?>">Pay Fees</a>
            </div>
        </div>
    </div>
</section>
<section class="login-area  registration_area ">
        <div class="row mt-20">
            <div class="col-lg-12">
                <div class="white-box single_registration_area">

                        <div class="row">
                                <div class="reg_tittle col-md-6 offset-md-3 mb-20">
                                    <h2 class="text-center"><?php echo e($fee->feesGroupMaster->feesTypes->name); ?> Payment</h2>
                                    <p class="text-center text-danger">Note: <?php echo e($fee->feesGroupMaster->feesTypes->name); ?> payment & processing costs <?php echo e(@generalSetting()->currency_symbol); ?><?php echo e(number_format($fee->fees_amount)); ?> Please pay to continue</p>
                                </div>
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <center>
                                    <button type="button" onclick="makePayment()" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                        <span class="ti-check"></span>
                                        Pay Now
                                    </button>
                                </center>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</section>
<script type="text/javascript" src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>  

<!--https://login.remita.net/payment/v1/remita-pay-inline.bundle.js-->
<!--https://remitademo.net/payment/v1/remita-pay-inline.bundle.js-->
<!--https://login.remita.net/remita/exapp/api/v1/send/api-->
<!--https://login.remita.net/payment/v1/remita-pay-inline.bundle.js-->
<!--remitademo.net/remita/exapp/api/v1/send/api-->
<script>         
      function makePayment() {
          var form = document.querySelector("#payment-form");
          var paymentEngine = RmPaymentEngine.init({
              key: "<?php echo e(config('remita.key')); ?>",
              transactionId: Math.floor(Math.random()*1101233), // Replace with a reference you generated or remove the entire field for us to auto-generate a reference for you. Note that you will be able to check the status of this transaction using this transaction Id
              customerId: '<?php echo e($user->student->matric_number ?? $user->student->admission_no); ?>',
              firstName: '<?php echo e($user->student->first_name); ?>',
              lastName: '<?php echo e($user->student->last_name); ?>',
              email: '<?php echo e($user->email); ?>',
              amount: '<?php echo e($fee->fees_amount); ?>',
              narration: '<?php echo e($fee->feesGroupMaster->feesTypes->name); ?> Payment',
              onSuccess: function (response) {
                  console.log('callback Successful Response', response);
                  window.location =`/pay-fees-2/${response.paymentReference}/${response.transactionId}/<?php echo e($fee->id); ?>`
              },
              onError: function (response) {
                  console.log('callback Error Response', response);
              },
              onClose: function () {
                  console.log("closed");
              }
          });
           paymentEngine.showPaymentWidget();
      }
     
      window.onload = function () {
          setDemoData();
      };
  </script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/pay_fees.blade.php ENDPATH**/ ?>