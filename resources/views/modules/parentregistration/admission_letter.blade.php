
@php

$generalSetting = App\SmGeneralSettings::where('id',1)->first();

$email_template = App\SmsTemplate::where('id',1)->first();

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
<body>
<div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 20px;">
        <tbody>

		    
			<!-- HEADING + ICON START -->
			<tr>
				<td align="center">
					<table border="0" cellspacing="0" cellpadding="0" style="background:#fff;" class="m_wd_full">
						<tbody>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tbody>
										    <tr><td><img src="https://gallery.mailchimp.com/d942a4805f7cb9a8a6067c1e6/images/1a808f19-c541-48d8-afad-3d9529131c98.gif" alt="" width="1" style="width:1px;display:block"></td></tr>
											<tr>
												<td align="center" class="m_img_mc_fix">
													<center><img align="center" src="{{asset(generalSetting()->logo)}}" alt="" width="83" height="83" border="0" style="width:100px; max-width:100px;"></center>
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
			<!-- HEADING + ICON END -->
			

			
			<!-- ACCOUNT INFORMATION START -->
			<tr>
				<td align="center">
					<table bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" class="m_wd_full">
						<tbody>
							<tr>
								<td style="padding:0 25px 0 25px;">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tbody>
										    <tr><td height="50"><img src="https://gallery.mailchimp.com/d942a4805f7cb9a8a6067c1e6/images/1a808f19-c541-48d8-afad-3d9529131c98.gif" alt="" width="1" style="width:1px;display:block"></td></tr>
											<tr>
												<td align="center" style="font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:15px; font-weight:normal; color:#24252a; line-height:22px; text-align:left; display:block;">
													<p>{{@date('F Y')}}</p>
													<p>Dear {{@$compact['name']}},</p>
													<p>Congratulations, {{@generalSetting()->school_name}} is pleased to inform you that after reviewing your application to study with us you have been granted provisional admission.</p>

													

													



													<p style="margin-top: 100px">Regards,<br/>
													{{@generalSetting()->school_name}} admission office.<br/>
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
</html>