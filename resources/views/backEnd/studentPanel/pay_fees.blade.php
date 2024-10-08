@extends('backEnd.master')
@section('title')
{{$fee->feesGroupMaster->feesTypes->name }} Payment
@endsection

@section('mainContent')
<style type="text/css">
    .form-control{
        margin-top: 8px;
    }
    label{
        margin-top: 8px;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{$fee->feesGroupMaster->feesTypes->name }} Payment</h1>
            <p>{{$fee->feesGroupMaster->feesTypes->remita_service_id}}</p>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('student_fees')}}">Pay Fees</a>
            </div>
        </div>
    </div>
</section>
<section class="login-area  registration_area ">
        <div class="row mt-20">
            <div class="col-lg-12">
                <div class="white-box single_registration_area">

                        <div class="row">
                                <div class="reg_tittle col-md-6 offset-md-3 mb-20">
                                    <h2 class="text-center">{{$fee->feesGroupMaster->feesTypes->name }} Payment</h2>
                                    <p class="text-center text-danger">Note: {{$fee->feesGroupMaster->feesTypes->name }} payment & processing costs {{@generalSetting()->currency_symbol}}{{ number_format($fee->fees_amount) }} Please pay to continue</p>
                                </div>
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <center>
                                    <button type="button" onclick="makePayment()" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{@$tooltip}}">
                                        <span class="ti-check"></span>
                                        Pay Now
                                    </button>
                                </center>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</section>
<script type="text/javascript" src="https://login.remita.net/payment/v1/remita-pay-inline.bundle.js"></script>
<script>         
      function makePayment() {
          var form = document.querySelector("#payment-form");
          var paymentEngine = RmPaymentEngine.init({
              key: "RkNBSUJBREFOfDUxNzcyOTQ1NTF8ZGMxNzFiYmUyZGZlMDRhNTRiODAwODRiNTg3YTVjOTBmYjQ3ZTUzZWViOThkOWJjZTkzM2VmMGRlOTlkNWRiZjZiN2EyYzA2NDg0ZWE5OTcyYmIyNWFjMjQ1ZmUyZWM1MzYxMzNiNzQzNDNiNmVmZDU5Yjg0NTM4ZjVhZDZkMTE=", //"{{ config('remita.key') }}",
              transactionId: Math.floor(Math.random()*1101233), // Replace with a reference you generated or remove the entire field for us to auto-generate a reference for you. Note that you will be able to check the status of this transaction using this transaction Id
              customerId: '{{$user->student->matric_number ?? $user->student->admission_no }}',
              firstName: '{{$user->student->first_name}}',
              lastName: '{{$user->student->last_name}}',
              email: '{{$user->email}}',
              amount: '{{$fee->fees_amount}}',
              narration: '{{$fee->feesGroupMaster->feesTypes->name}} Payment',
              onSuccess: function (response) {
                  console.log('callback Successful Response', response);
                   window.location =`/pay-fees-2/${response.paymentReference}/${response.transactionId}/{{ $fee->id }}`
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
  @endsection