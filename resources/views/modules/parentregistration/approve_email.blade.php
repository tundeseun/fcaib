
@php

$generalSetting = App\SmGeneralSettings::where('id',1)->first();

$email_template = App\SmsTemplate::where('id',1)->first();

$applicant_details = App\SmsTemplate::applicantsDetails();


@endphp
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
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

		</style>
	</head>
<body style="margin:0px;padding:0px;background-color:#e4e5e7">
<div style="margin:0px;padding:0px;background-color:#e4e5e7">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#e4e5e7" style="margin-top: 50px;">
        <tbody>

		    
			<!-- HEADING + ICON START -->
			<tr>
				<td align="center" style="padding: 0 5px 0 5px;">
					<table width="600" border="0" cellspacing="0" cellpadding="0" style="background:linear-gradient(90deg, rgb(124, 50, 255) 0%, rgb(199, 56, 216) 51%, rgb(124, 50, 255) 100%) 0% 0% / 200%;" bgcolor="#AD36E6" class="m_wd_full">
						<tbody>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:linear-gradient(90deg, rgb(124, 50, 255) 0%, rgb(199, 56, 216) 51%, rgb(124, 50, 255) 100%) 0% 0% / 200%;" bgcolor="#AD36E6">
										<tbody>
										    <tr><td height="50"><img src="https://gallery.mailchimp.com/d942a4805f7cb9a8a6067c1e6/images/1a808f19-c541-48d8-afad-3d9529131c98.gif" alt="" width="1" style="width:1px;display:block"></td></tr>
											<tr>
												<td align="center" class="m_img_mc_fix">
													<img align="center" src="{{asset(generalSetting()->logo)}}" alt="" width="83" height="83" border="0" style="width:83px; max-width:83px;">
												</td>

											</tr>
											<tr>
												<td align="center" style="padding:25px 25px 0px 25px; font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:32px; font-weight:bold; color:#ffffff; line-height:30px; text-align:center; display:block;">
													Admission Status
												</td>
											</tr>
											<tr><td height="50"><img src="https://gallery.mailchimp.com/d942a4805f7cb9a8a6067c1e6/images/1a808f19-c541-48d8-afad-3d9529131c98.gif" alt="" width="1" style="width:1px;display:block"></td></tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<!-- HEADING + ICON END -->
			

			
			<!-- ACCOUNT INFORMATION START -->
			<tr>
				<td align="center" style="padding:0 5px 0 5px;">
					<table width="600" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" style="background:#ffffff;" class="m_wd_full">
						<tbody>
							<tr>
								<td style="padding:0 25px 0 25px;">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tbody>
										    <tr><td height="50"><img src="https://gallery.mailchimp.com/d942a4805f7cb9a8a6067c1e6/images/1a808f19-c541-48d8-afad-3d9529131c98.gif" alt="" width="1" style="width:1px;display:block"></td></tr>
											<tr>
												<td align="center" style="font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; font-weight:normal; color:#24252a; line-height:22px; text-align:left; display:block;">

													<h3>Dear {{$applicant_details['fullname']}},</h3>
													<p>Congratulations, <b>{{@generalSetting()->school_name}}</b> is pleased to inform you that after reviewing your application to study with us you have been granted provisional admission.</p>

													<p>Please login using this username <b>{{$applicant_details['email']}}</b> and password <b>123456</b> to print your admission letter and begin your clearance.</p>

													<p>We hope you enjoy your experience!</p>

													<p>If this mail is not for you please disregard.</p>

													Regards,<br/>
													{{@generalSetting()->school_name}} admission office.<br/>


												</td>
											</tr>
											<tr><td height="30"><img src="https://gallery.mailchimp.com/d942a4805f7cb9a8a6067c1e6/images/1a808f19-c541-48d8-afad-3d9529131c98.gif" alt="" width="1" style="width:1px;display:block"></td></tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<!-- ACCOUNT INFORMATION END -->

						<!-- HEADING + ICON START -->
			<tr>
				<td align="center" style="padding: 0 5px 0 5px;">
					<table width="600" bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="background:#FFFFFF;" class="m_wd_full">
						<tbody>
							<tr>
								<td style="padding: 0 25px 0 25px;">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<!-- Button START -->
											<tr>
												<td style="border-top:1px solid #eeeeee; padding:30px 0 0 0px;">
													<table align="center" cellspacing="0" cellpadding="0" border="0">
														<tr>
															<td style="background:linear-gradient(90deg, rgb(124, 50, 255) 0%, rgb(199, 56, 216) 51%, rgb(124, 50, 255) 100%) 0% 0% / 200%;border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;-moz-border-radius:5px;-o-border-radius:5px; display:block;">
																<table cellspacing="0" cellpadding="0" border="0" width="100%">
																	<tr>
																		<td>
																			<table cellspacing="0" cellpadding="0" border="0" width="100%">
																				<tr>
																					<td style="padding:14px 30px 14px 30px;text-transform:uppercase; font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; text-align:center; font-size: 14px; font-weight:bold; line-height: 1.3; color:#ffffff;">
																						<a href="{{url('/login')}}" style="color:#ffffff; text-decoration:none; margin-bottom: 10px; background: #AD36E6; border: none; height: 40px; padding: 10px;" target="_blank" >Login </a>
																						
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<!-- Button END -->
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<!-- HEADING + ICON END -->
			
			<!-- Footer -->
			<tr>
				<td align="center" style="padding:0 5px 5px 5px;">
					<table width="600" bgcolor="#f6f7f9" border="0" cellspacing="0" cellpadding="0" style="background:#f6f7f9;" class="m_wd_full">
						<tbody>
							<tr>
								<td style="padding:0 25px 0 25px;">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tbody>
										    <tr><td height="25"><img src="https://gallery.mailchimp.com/d942a4805f7cb9a8a6067c1e6/images/1a808f19-c541-48d8-afad-3d9529131c98.gif" alt="" width="1" style="width:1px;display:block"></td></tr>
											<tr>
												<td align="center" style="font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:13px; font-weight:normal; color:#24252a; line-height:19px; text-align:center; display:block;">
											
												</td>
											</tr>
											<tr><td height="25"><img src="https://gallery.mailchimp.com/d942a4805f7cb9a8a6067c1e6/images/1a808f19-c541-48d8-afad-3d9529131c98.gif" alt="" width="1" style="width:1px;display:block"></td></tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<!-- Footer END -->
			
        </tbody>
    </table>
</div>
</body>
</html>