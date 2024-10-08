
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
                        <form class="card p-5" style="border-radius: 20px;" onsubmit="makePayment()" id="payment-form">
                             
                             <table class="table table-striped p-3">
                                <thead>
                                    <tr>
                                        <th>Hostel</th>
                                        <th>Hostel Type</th>
                                        <th>Address</th>
                                        <th>Room</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo e($room->dormitory->dormitory_name); ?></td>
                                        <td><?php echo e($room->dormitory->type == 'G' ? 'Female' : 'Male'); ?>

                                        <td><?php echo e($room->dormitory->address); ?>

                                        <td><?php echo e($room->name); ?>

                                    </tr>
                                </tbody>
                             </table>
                            
                            <h3>
                                Pay <?php echo e(@generalSetting()->currency_symbol); ?><?php echo e(number_format($room->cost_per_bed)); ?> accomodation fee to get this room
                            </h3>

                            <p>
                                N/B: This has to be completed within 24hours, you can cancel and get another available room
                            </p>
                            <div class="d-flex justify-content-between">
                                <a class="fix-gr-bg mt-3 p-2" style="border: 1px solid #092A4D; border-radius: 5px; color: #092A4D;" href="/student-dormitory/cancel"><i class="ti-close"></i> Cancel</a>
                                <button class="primary-btn fix-gr-bg submit mt-3" type="button" onclick="makePayment()" ><i class="ti-check"></i> Pay </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
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
              amount: '<?php echo e($room->cost_per_bed); ?>',
              narration: 'Hostel Accomodation Fee',
              onSuccess: function (response) {
                  console.log('callback Successful Response', response);
                  window.location =`/student-dormitory/allocation/${response.paymentReference}/${response.transactionId}`
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
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/student_room_allocation.blade.php ENDPATH**/ ?>