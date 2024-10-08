
@php

$generalSetting = App\SmGeneralSettings::where('id',1)->first();

$email_template = App\SmsTemplate::where('id',1)->first();

@endphp
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>{{$details->names}} Transcript</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
		<style type="text/css">
			@media only screen and (max-width:580px){

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
	        			<h5 style="margin-right: 20px;">{{$details->institution_office}},<br/>
	        				{{$details->institution_name}},<br/>
	        				{{$details->institution_address}},<br/>
	        				{{$details->institution_country}},<br/>
	        				Email: {{$details->institution_email}},<br/>

	        			</h5>
        		</td>
        		<td style="width: 30%;">
        			<h5>
        				{{date('jS F, Y')}}
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
        				I forward herewith the Academic Transcript of <b>{{$details->names}}</b> on request for the purpose of gaining admission into your institution.
        			</h5>
        			<h5 style="font-weight: normal;">
        				I wish to inform you that transcripts are not normally forwarded directly to students or graduands, but to institutions or similar establishments that require them.
        			</h5>

        			<h5 style="font-weight: normal;">
        				In the circumstance therefore, please treat this transcript as a classified document that should not be released to the student/ graduand.
        			</h5>

        			<h5 style="margin-top: 50px">
        				Signed Management<br/>
        				{{generalSetting()->school_name}}
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
															<h2>{{generalSetting()->school_name}}<br/>
																<small>{{generalSetting()->site_title}}</small>
															</h2>
														</center>
														<center>
															<h4>STUDENT'S ACADEMIC TRANSCRIPT</h4>
														</center>
														<h4>
															A. STUDENT'S PERSONAL DETAILS:
														</h4>
														<h5>
															NAME: {{ucwords($details->names)}}<br/>
															DEPARTMENT: {{$details->department}}<br/>
															ENTRY YEAR: {{$details->entry_year}}<br/>
															GRADUATION YEAR: {{$details->graduation_year}}<br/>

														</h5>

														<h4>
															B. QUALIFICATION/CLASSIFICATION:
														</h4>
														<h5>
															QUALIFICATION AWARDED: Bachelor of Science (B. Sc.) {{$details->department}}<br/>
															CLASS OF DEGREE: Second Class Lower<br/>
															GRADUATION YEAR: {{$details->graduation_year}}<br/>
															DATE OF ISSUE OF TRANSCRIPT: {{date('jS F, Y')}}

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
																	@foreach($marks as $mark)
																	<tr>
																		<td>{{$mark->percent_from}} - {{$mark->percent_upto}}</td>
																		<td>{{$mark->grade_name}} - {{$mark->description}}</td>
																		<td>{{(int)$mark->gpa}}</td>
																	</tr>
																	@endforeach
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
												@foreach($levels as $level)
								                    @php
								                        $f_credit_units = 0; $f_grade_points = 0;
								                        $f_results = App\SmCourseRegistration::getExamResult(@$level->student_id, 'F', @$level->section);
								                    @endphp
								                    @if(count($f_results) > 0)
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

								                           @foreach($f_results as $fresult)
								                            <tr>
								                                <td>{{@$level->section_name}}</td>
								                                <td>First</td>
								                                <td>{{@$fresult->subject_code}}</td>
								                                <td>{{@$fresult->subject_name}}</td>
								                                <td>{{@$fresult->units}}</td>
								                                <td>{{@$fresult->grade}}</td>
								                                <td>{{$fresult->remark}}</td>
								                                @php $f_credit_units += $fresult->units; $f_grade_points += $fresult->grade_point; @endphp  
								                            </tr>
								                            @endforeach

															</tbody>
														</table>
														@if($f_credit_units != 0)
															<h4 style="border: none; margin-top: -10px;">Grade Point Average : {{number_format($f_grade_points/$f_credit_units,2)}}<br/>Cumulative Grade Point Average : {{number_format(App\SmCourseRegistration::cgpa($level->student_id),2)}}</h4>
														@endif
													@endif

													@php
								                        $s_credit_units = 0; $s_grade_points = 0;
								                        $s_results = App\SmCourseRegistration::getExamResult(@$level->student_id, 'S', @$level->section);
								                    @endphp
									                @if(count($s_results) > 0)
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
									                            @foreach($s_results as $sresult)
									                            <tr>
									                                <td>{{@$level->section_name}}</td>
									                                <td>Second</td>
									                                <td>{{@$sresult->subject_code}}</td>
									                                <td>{{@$sresult->subject_name}}</td>
									                                <td>{{@$sresult->units}}</td>
									                                <td>{{@$sresult->grade}}</td>
									                                <td>{{$sresult->remark}}</td>
									                                @php $s_credit_units += $sresult->units; $s_grade_points += $sresult->grade_point; @endphp  
									                            </tr>
									                            @endforeach
									                        </tbody>
									                    </table>
									                        @if($s_credit_units != 0)
									                                <h4 style="border: none; margin-top: -10px;">Grade Point Average : {{number_format($s_grade_points/$s_credit_units,2)}}<br/>Cumulative Grade Point Average : {{number_format(App\SmCourseRegistration::cgpa($level->student_id),2)}}</h3>
									                        @endif
									                @endif


												@endforeach

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
</html>