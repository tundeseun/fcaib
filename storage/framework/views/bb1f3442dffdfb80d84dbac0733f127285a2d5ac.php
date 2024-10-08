
<?php

$generalSetting = App\SmGeneralSettings::where('id',1)->first();

$email_template = App\SmsTemplate::where('id',1)->first();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo e($receipts->feesType->name); ?> Receipt</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
		<style type="text/css">
			@media  only screen and (max-width:580px){

				.m_wd_full {
					width:100%!important;
					min-width:100%!important;
					height:auto!important
				}

				.m_wd_full_db {
					width:100%!important;
					min-width:100%!important;
					height:auto!important;
					display:block;
				}

				.m_al {
					text-align:left!important
				}
				.m_db {
					display:block!important
				}
				.m_display_n {				   	
					height:20px!important;
					display:block;
				}
				.m_h10 {				   	
					height:10px!important;
					display:block;
				}
			    .m_display_none {
					display:none;
				}
				.m_img_mc_fix {
					display:block!important;
					text-align:center!important;
				}
			}

			.courses * {
			  border: 1px solid black;
			  border-collapse: collapse;
			  padding: 5px;
			}

			th{
				font-weight: bold;
			}

			td h5{
				font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:15px; font-weight:normal; color:#24252a;
			}

		</style>
	</head>
<body>
<div>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 20px;">
        <tbody style="width:100%">
			<tr style="width:100%" width="100%">
				<td align="center" style="width:100%">
					<table bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" style="width:100%">
						<tbody style="width:100%">
							<tr style="width:100%">
								<td style="padding:0 25px 0 25px;" style="width:100%">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:100%">
										<tbody style="width:100%">
											<tr style="width:100%">
												<td align="center" style="font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:15px; font-weight:normal; color:#24252a; line-height:22px; text-align:left; display:block; width:100%;">
													<p>
														<center>
															<h2><?php echo e(generalSetting()->school_name); ?><br/>
																<small><?php echo e(generalSetting()->site_title); ?></small>
															</h2>
														</center>
														<center>
															<h3><?php echo e($receipts->feesType->name); ?> Payment Receipt</h3>

														</center>
														<h4>
															STUDENT'S DETAILS:
															<hr/>
														</h4>
														<h5>
															NAME: <b><?php echo e(strtoupper($receipts->studentInfo->full_name)); ?></b><br/>
															DEPARTMENT: <b><?php echo e(strtoupper(getDepartmentById($receipts->studentInfo->class_id))); ?></b><br/>
															LEVEL: <b><?php echo e(getLevelById($receipts->studentInfo->section_id)); ?></b><br/>
															SESSION: <b><?php echo e(getSessionById(getAcademicId())); ?></b>
														</h5>

														<h4>
															FEE DETAILS
															<hr/>
														</h4>

														<h5>
															TRANSACTION ID: <b><?php echo e($receipts->id); ?></b><br/>
															SESSION: <b><?php echo e(getSessionById($receipts->academic_id)); ?></b><br/>
															FEE TYPE: <b><?php echo e(strtoupper($receipts->feesType->name)); ?></b><br/>
															TOTAL AMOUNT: <b>NGN<?php echo e(number_format($receipts->amount)); ?></b><br/>
															TOTAL PAID: <b>NGN<?php echo e(number_format($receipts->amount)); ?></b><br/>
															TOTAL REMAINING: <b>NGN0.00</b><br/>
															STATUS: <b>PAID</b><br/>
															DATE PAID: <b><?php echo e(dateConvert($receipts->payment_date)); ?></b><br/>
														</h5>

														<p style="margin-top: 40px;">
															<hr/>
															You may review your receipt history at any time by logging in to your dashboard area.<br/>
															Note: This serves as an official receipt for this payment.
														</p>


														

													 
													</p>
										<td>
									</td>
								</td>
							</tr>
						</tbody>
					</table>

</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\infix\resources\views/modules/parentregistration/generate_receipt.blade.php ENDPATH**/ ?>