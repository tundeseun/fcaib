<html>

	<head>
		<title><?php echo app('translator')->get('lang.student_certificate'); ?></title>

		<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css" />
		<!--<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/style.css" />-->
		<style rel="stylesheet">
			.tdWidth{
				width: 33.33%;
			}
			.bgImage{
				height:auto; 
				background-repeat:no-repeat;
				background-image: url(<?php echo e(asset($certificate->file)); ?>);
				  
			}
			table{
				/* margin-top: 160px; */
				text-align: center; 
			}
			 
			td{
				padding: 25px !important;
			}
			.DivBody{    
				height: 611px;
				border: 1px solid white !important;
				margin-top: 0px;
				  
			}
			.tdBody{
				text-align: justify !important;				
			    height: 140px;
			    padding-top: 0px;
			    padding-bottom: 0px;
			    padding-left: 65px;
			    padding-right: 65px;

			}
			img{
				position: absolute;
			}
			table{
				position: relative;
				top:100;			
			}
			body{
				padding:0px !important;
				margin:0px !important;
			}
			@page  { 
				margin: 2px; 
				size: 21cm 17cm; 
				}
			body { margin: 1px; }
 
		</style>
	</head>

	<body>

		<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="DivBody">
			<img src="<?php echo e(asset($certificate->file)); ?>" style="height: 636px; width: 100% !important">
			<table width="80%" align="center" style="padding:0">
				<tr>
					<td style="text-align: left;" class="tdWidth"><?php echo e(@$certificate->header_left_text); ?>:</td>
					<td style="text-align: center;" class="tdWidth"></td>
					<td style="text-align: right;" class="tdWidth"><?php echo app('translator')->get('lang.date'); ?>: <?php echo e(@$certificate->date); ?></td>
				</tr>
				<tr>
					
					<td colspan="3" class="tdBody"><?php echo e(isset($student->id) ? App\SmStudentCertificate::certificateBody($certificate->body, $student->id) : ''); ?></td>
				</tr>
				<tr>
					<td style="text-align: left;" class="tdWidth"><?php echo e(@$certificate->footer_left_text); ?></td>
					<td style="text-align: center;" class="tdWidth"><?php echo e(@$certificate->footer_center_text); ?></td>
					<td style="text-align: right;" class="tdWidth"><?php echo e(@$certificate->footer_right_text); ?></td>
				</tr>
			</table>
		</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	 
	</body>
</html>
<?php /**PATH /home2/fcaibedu/public_html/portal/Modules/BulkPrint/Resources/views/admin/student_certificate_bulk_print.blade.php ENDPATH**/ ?>