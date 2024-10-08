<?php 

$setting = generalSetting();
App::setLocale(getUserLanguage());


?>

<!doctype html>
<?php
    App::setLocale(getUserLanguage());
?>
<html lang="<?php echo e(app()->getLocale()); ?>" <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?> dir="rtl" class="rtl" <?php endif; ?> >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset(generalSetting()->favicon)); ?>" type="image/png"/>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login2')); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login2')); ?>/themify-icons.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/select2/select2.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login2')); ?>/css/style.css">
	<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/toastr.min.css"/>
    <title><?php echo e(isset($setting)? !empty($setting->site_title) ? $setting->site_title : 'System ': 'System '); ?> | Student Registration</title>
<style>
    .loginButton {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .loginButton{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .singleLoginButton{
        flex: 22% 0 0;
    }

    .loginButton .get-login-access {
        display: block;
        width: 100%;
        border: 1px solid #fff;
        border-radius: 5px;
        margin-bottom: 20px;
        padding: 5px;
        white-space: nowrap;
    }

    .custom-footer-margin{
        margin-top: -35px;
    }

    @media (max-width: 576px) {
    .singleLoginButton{
        flex: 49% 0 0;
    }
    }

    @media (max-width: 576px) {
    .singleLoginButton{
        flex: 49% 0 0;
    }

    .loginButton .get-login-access {
        margin-bottom: 10px;
    }
    }
    
    .create_account a {
        color: #828bb2;
        font-weight: 500;
        text-decoration: none;
    }

    #email-address:focus-visible {
        outline: none;
    }
    #utme-number:focus-visible{
        outline: none;
    }
</style>
</head>
<body>
    <div class="in_login_part mb-40"  style="<?php echo e($css); ?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-lg-5 col-xl-4 col-md-7">
					
                    <div class="in_login_content">
                        <?php 
                            $setting = generalSetting();
                        ?>
                        
                        <div class="card">
                            <div class="d-flex justify-content-start p-3">
                                <a href="/post-utme"><i class="ti-angle-left"></i> Back</a>
                            </div>

                            <div class="p-5">
                                <h4 class="mb-5">Post-UTME Payment</h4>

                                <div class="in_single_input">
                                    <i class="ti-user"></i> UTME Number : <?php echo e($applicant_details->utme_number); ?>

                                    <hr/>
                                </div>

                                <div class="in_single_input">
                                    <i class="ti-email"></i> Email : <?php echo e($applicant_details->email); ?>

                                     <hr/>
                                </div>

                                <div class="in_login_button text-center mt-2">
                                    <button type="button" onclick="makePayment()" class="btn btn-warning form-control" >
                                        Pay <?php echo e(@generalSetting()->currency_symbol); ?><?php echo e(number_format($application_cost)); ?>

                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--================ Footer Area =================-->
    <footer class="footer_area min-height-10 custom-footer-margin">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <p style="color: #828bb2"><?php echo @generalSetting()->copyright_text; ?> </p>
                </div>
            </div>
        </div>
    </footer>


    <!--================ End Footer Area =================-->
    <script src="<?php echo e(asset('public/backEnd/login2')); ?>/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo e(asset('public/backEnd/login2')); ?>/js/popper.min.js"></script>
	<script src="<?php echo e(asset('public/backEnd/login2')); ?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/toastr.min.js"></script>

    <script type="text/javascript" src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
    <script>         
      function makePayment() {
          var form = document.querySelector("#payment-form");
          var paymentEngine = RmPaymentEngine.init({
              key: "<?php echo e(config('remita.key')); ?>",
              transactionId: Math.floor(Math.random()*1101233), // Replace with a reference you generated or remove the entire field for us to auto-generate a reference for you. Note that you will be able to check the status of this transaction using this transaction Id
              customerId: '<?php echo e($applicant_details->utme_number); ?>',
              email: '<?php echo e($applicant_details->email); ?>',
              amount: '<?php echo e($application_cost); ?>',
              narration: 'Post UTME',
              onSuccess: function (response) {
                  console.log('callback Successful Response', response);
                  window.location =`/post-utme-2/${response.paymentReference}/${response.transactionId}`
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

	$(document).ready(function () {

		$('#btnsubmit').on('click',function()
		{
		$(this).html('Please wait ...')
			.attr('disabled','disabled');
		$('#infix_form').submit();
		});

	 });

	$(document).ready(function() {
        $("#email-address").keyup(function(){
            $("#username-hidden").val($(this).val());
        });
    });

	 </script>
	<?php echo Toastr::message(); ?>

    
  </body>
</html>
<?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/auth/studentRegistration.blade.php ENDPATH**/ ?>