
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
			.courses * {
			  border: 1px solid black;
			  border-collapse: collapse;
			  padding: 5px;
			}

            h2,h3,h4{
                margin: 0px;
            }

            hr{
                background-color: 1px solid #9C9CA2;
                border: none;
            }

		</style>
	</head>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:100%; margin: 5px;">
        <tbody style="width:100%">
            <tr style="width:100%">
                <td align="center" style="font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:15px; font-weight:normal; color:#24252a; line-height:22px; text-align:left; display:block; width:100%;">
                    <p>
                        <center>
                            <img align="center" src="{{asset(generalSetting()->logo)}}" alt="" width="83" height="83" border="0" style="width:100px; max-width:100px;">
                        </center>
                        <center>
                            <h3>Federal College of Agriculture, Ibadan</h3>
                            <h2>Student Receipt</h2>
                        </center>
                    </p>

                    <div class="courses" style="width:100%; margin:0px;" >
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td>Date : </td>
                                    <td>{{now()}}</td>
                                    <td>Session : </td>		
                                    <td>{{ $payment['session'] }}</td>
                                    <td>S/No. : </td>
                                    <td>{{ $payment['serial_no'] }}</td>								
                                </tr>
                            </tbody>
                        </table>
                    </div>

                        <center>
                            <h4 style="color: #9C9CA2;">Paid by</h4>
                        </center>

                    <div class="courses" style="width:100%; margin:0px;" >
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td>Registration/Matric No. : </td>
                                    <td>{{$user->student->matric_number ?? $user->student->admission_no}}</td>
                                </tr>
                                <tr>
                                    <td>Names : </td>
                                    <td>{{$user->student->full_name}}</td>
                                </tr>
                                @if(@$user->student->class->class_name)
                                <tr>
                                    <td>Department : </td>
                                    <td>{{$user->student->class->class_name}}</td>
                                </tr>
                                @endif
                                @if(@$user->student->section->section_name)
                                <tr>
                                    <td>Level : </td>
                                    <td>{{$user->student->section->section_name}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if($payment['type'] == 'Accomodation Fee')

                        <center>
                            <h4 style="color: #9C9CA2;">Hostel Details</h4>
                        </center>


                    <div class="courses" style="width:100%; margin:0px;" >
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th> Hostel </th>
                                    <th> Room </th>
                                    <th> Description </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> {{ $room->dormitory->dormitory_name}} </td>
                                    <td> {{ $room->name}}</td>
                                    <td> {{ $room->description}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif


                        <center>
                            <h4 style="color: #9C9CA2;">Fees Details</h4>
                        </center>


                    <div class="courses" style="width:100%; margin:0px;" >
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th> Description </th>
                                    <th> NGN </th>
                                    <th> Kobo </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> {{ $payment['type'] }} </td>
                                    <td> {{ $payment['amount'] }}</td>
                                    <td> 00 </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="padding-left: 80px;">

                            <small style="font-style: italic; margin-right: 20px;">Received from </small> {{strtoupper($user->student->full_name)}} <hr/>
                            @if(@$user->student->class->class_name)
                             <small style="font-style: italic; margin-right: 20px;">of </small> {{strtoupper($user->student->class->class_name)}} <hr/>
                            @endif
                            <small style="font-style: italic; margin-right: 20px;">the sum of </small> {{strtoupper($payment['amount_in_words'])}} NAIRA ONLY<hr/>
                            <small style="font-style: italic; margin-right: 20px;">being payment for </small> {{strtoupper($payment['type'])}}

                    </div>

                    <p>
                        Signatures<br/><br/>
                        <b>Student .........................................</b>
                        <b style="margin-left: 10px;">Cashier .....................................</b>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>