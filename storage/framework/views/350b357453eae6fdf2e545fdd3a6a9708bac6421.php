
<?php

$generalSetting = App\SmGeneralSettings::where('id',1)->first();

$email_template = App\SmsTemplate::where('id',1)->first();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
		<style type="text/css">
			.courses * {
			  border: 1px solid black;
			  border-collapse: collapse;
			  padding: 5px;
			}

		</style>
	</head>
<body>
<div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 20px;">
        <tbody style="width:100%">

		 
			

			
			<!-- ACCOUNT INFORMATION START -->
			<tr style="width:100%">
				<td align="center" style="width:100%">
					<table bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" style="width:100%">
						<tbody style="width:100%">
							<tr style="width:100%">
								<td style="padding:0 15px 0 15px;" style="width:100%">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:100%">
										<tbody style="width:100%">
											<tr style="width:100%">
												<td align="center" style="font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:15px; font-weight:normal; color:#24252a; line-height:22px; text-align:left; display:block; width:100%;">
													<p><center><img align="center" src="<?php echo e(asset(generalSetting()->logo)); ?>" alt="" width="83" height="83" border="0" style="width:100px; max-width:100px;"></center>
														<center>
															<h3>Federal College of Agriculture, Ibadan <br/> Course Registration Details</h3>
														</center>
														<h5>
															Matric Number : <?php echo e($compact['student']->matric_number); ?><br/>
															Names : <?php echo e($compact['student']->full_name); ?><br/>
															Department : <?php echo e($compact['student']->class->class_name); ?><br/>
															Level : <?php echo e($compact['student']->section->section_name); ?><br/>
															Semester: <?php if($compact['semester']=='F'): ?> First Semester <?php else: ?> Second Semester <?php endif; ?>
														</h5>
													 
													</p>
													<div class="courses" style="width:100%; margin:0px;" >
														<table width="100%">
															<thead>
																<tr>
																	<th>Course Title</th>
																	<th>Course Code</th>
																	<th>Units</th>
																	<th>Course Type</th>
																</tr>
															</thead>
															<tbody>
																<?php $total_units = 0; ?>
																<?php $__currentLoopData = $compact['registered_courses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<tr>
																	<?php $total_units+=$course->units ?>
																	<td><?php echo e($course->subject_name); ?></td>
																	<td><?php echo e($course->subject_code); ?></td>
																	<td><?php echo e($course->units); ?></td>
																	<td>
																		<?php if($course->class_id == 0): ?> Elective <?php else: ?> Departmental <?php endif; ?>
																	</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</tbody>

														</table>
													</div>
													<p>
														Total Units : <?php echo e($total_units); ?> Units<br/>
														Signatures<br/>
														<b>Student .............................</b>
														<b style="margin-left: 10px;">HOD .................................</b>
														<b style="margin-left: 10px;">Head, Exams and Records ...........................</b>
													</p>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<!-- ACCOUNT INFORMATION END -->
        </tbody>
    </table>
</div>
</body>
</html><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/modules/parentregistration/course_registration.blade.php ENDPATH**/ ?>