
<?php

$generalSetting = App\SmGeneralSettings::where('id',1)->first();

$email_template = App\SmsTemplate::where('id',1)->first();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo e($details->names); ?> Transcript</title>
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
			<!-- ACCOUNT INFORMATION START -->
			<tr style="width:100%" width="100%">
        		<td style="width: 70%;">
	        			<h5 style="margin-right: 20px;"><?php echo e($details->institution_office); ?>,<br/>
	        				<?php echo e($details->institution_name); ?>,<br/>
	        				<?php echo e($details->institution_address); ?>,<br/>
	        				<?php echo e($details->institution_country); ?>,<br/>
	        				Email: <?php echo e($details->institution_email); ?>,<br/>

	        			</h5>
        		</td>
        		<td style="width: 30%;">
        			<h5>
        				<?php echo e(date('jS F, Y')); ?>

        			</h5>
        		</td>
        	</tr>
        </tbody>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 20px;">
        <tbody style="width:100%">

        	<tr style="width:100%" width="100%">
        		<td style="width:100%">
        			<h5 style="font-weight: normal;">Dear Sir/Madam,</h5>
        			<center><h4>ACADEMIC TRANSCRIPT</h4></center>
        			<h5 style="font-weight: normal;">
        				I forward herewith the Academic Transcript of <b><?php echo e($details->names); ?></b> on request for the purpose of gaining admission into your institution.
        			</h5>
        			<h5 style="font-weight: normal;">
        				I wish to inform you that transcripts are not normally forwarded directly to students or graduands, but to institutions or similar establishments that require them.
        			</h5>

        			<h5 style="font-weight: normal;">
        				In the circumstance therefore, please treat this transcript as a classified document that should not be released to the student/ graduand.
        			</h5>

        			<h5 style="margin-top: 50px">
        				Signed Management<br/>
        				<?php echo e(generalSetting()->school_name); ?>

        			</h5>
        		</td>
        	</tr>

        </tbody>
    </table>

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
															<h4>STUDENT'S ACADEMIC TRANSCRIPT</h4>
														</center>
														<h4>
															A. STUDENT'S PERSONAL DETAILS:
														</h4>
														<h5>
															NAME: <?php echo e(ucwords($details->names)); ?><br/>
															DEPARTMENT: <?php echo e($details->department); ?><br/>
															ENTRY YEAR: <?php echo e($details->entry_year); ?><br/>
															GRADUATION YEAR: <?php echo e($details->graduation_year); ?><br/>

														</h5>

														<h4>
															B. QUALIFICATION/CLASSIFICATION:
														</h4>
														<h5>
															QUALIFICATION AWARDED: Bachelor of Science (B. Sc.) <?php echo e($details->department); ?><br/>
															CLASS OF DEGREE: Second Class Lower<br/>
															GRADUATION YEAR: <?php echo e($details->graduation_year); ?><br/>
															DATE OF ISSUE OF TRANSCRIPT: <?php echo e(date('jS F, Y')); ?>


														</h5>

														<h4>
															C. GRADING SCALE:
														</h4>

															<table width="100%">
																<thead>
																	<tr>
																		<td>MARKING SCALE</td>
																		<td>LETTER GRADE</td>
																		<td>GRADE POINTS</td>
																	</tr>
																</thead>
																<tbody>
																	<?php $__currentLoopData = $marks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<tr>
																		<td><?php echo e($mark->percent_from); ?> - <?php echo e($mark->percent_upto); ?></td>
																		<td><?php echo e($mark->grade_name); ?> - <?php echo e($mark->description); ?></td>
																		<td><?php echo e((int)$mark->gpa); ?></td>
																	</tr>
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																</tbody>
															</table>

													 
													</p>
										<td>
									</td>
								</td>
							</tr>
						</tbody>
					</table>



											
										
									
								
							
						
					
				
			
			<!-- ACCOUNT INFORMATION END -->
        
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

										<div class="courses" style="width:100%; margin:0px;" >
												<?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								                    <?php
								                        $f_credit_units = 0; $f_grade_points = 0;
								                        $f_results = App\SmCourseRegistration::getExamResult(@$level->student_id, 'F', @$level->section);
								                    ?>
								                    <?php if(count($f_results) > 0): ?>
														<table width="100%">
															<thead>
																<tr>
																	<th>Level</th>
																	<th>Semester</th>
																	<th>Course</th>
																	<th>Title</th>
																	<th>Units</th>
																	<th>Grade</th>
																	<th>Remark</th>
																</tr>
															</thead>
															<tbody>

								                           <?php $__currentLoopData = $f_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fresult): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								                            <tr>
								                                <td><?php echo e(@$level->section_name); ?></td>
								                                <td>First</td>
								                                <td><?php echo e(@$fresult->subject_code); ?></td>
								                                <td><?php echo e(@$fresult->subject_name); ?></td>
								                                <td><?php echo e(@$fresult->units); ?></td>
								                                <td><?php echo e(@$fresult->grade); ?></td>
								                                <td><?php echo e($fresult->remark); ?></td>
								                                <?php $f_credit_units += $fresult->units; $f_grade_points += $fresult->grade_point; ?>  
								                            </tr>
								                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

															</tbody>
														</table>
														<?php if($f_credit_units != 0): ?>
															<h4 style="border: none; margin-top: -10px;">Grade Point Average : <?php echo e(number_format($f_grade_points/$f_credit_units,2)); ?><br/>Cumulative Grade Point Average : <?php echo e(number_format(App\SmCourseRegistration::cgpa($level->student_id),2)); ?></h4>
														<?php endif; ?>
													<?php endif; ?>

													<?php
								                        $s_credit_units = 0; $s_grade_points = 0;
								                        $s_results = App\SmCourseRegistration::getExamResult(@$level->student_id, 'S', @$level->section);
								                    ?>
									                <?php if(count($s_results) > 0): ?>
									                    <table id="table_id" class="display school-table mb-5" cellspacing="0" width="100%">
									                        <thead>
																<tr>
																	<th>Level</th>
																	<th>Semester</th>
																	<th>Course</th>
																	<th>Title</th>
																	<th>Units</th>
																	<th>Grade</th>
																	<th>Remark</th>
																</tr>
									                        </thead>
									                        <tbody>
									                            <?php $__currentLoopData = $s_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sresult): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									                            <tr>
									                                <td><?php echo e(@$level->section_name); ?></td>
									                                <td>Second</td>
									                                <td><?php echo e(@$sresult->subject_code); ?></td>
									                                <td><?php echo e(@$sresult->subject_name); ?></td>
									                                <td><?php echo e(@$sresult->units); ?></td>
									                                <td><?php echo e(@$sresult->grade); ?></td>
									                                <td><?php echo e($sresult->remark); ?></td>
									                                <?php $s_credit_units += $sresult->units; $s_grade_points += $sresult->grade_point; ?>  
									                            </tr>
									                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									                        </tbody>
									                    </table>
									                        <?php if($s_credit_units != 0): ?>
									                                <h4 style="border: none; margin-top: -10px;">Grade Point Average : <?php echo e(number_format($s_grade_points/$s_credit_units,2)); ?><br/>Cumulative Grade Point Average : <?php echo e(number_format(App\SmCourseRegistration::cgpa($level->student_id),2)); ?></h3>
									                        <?php endif; ?>
									                <?php endif; ?>


												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

													</div>

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
</html><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/modules/parentregistration/generate_transcript.blade.php ENDPATH**/ ?>