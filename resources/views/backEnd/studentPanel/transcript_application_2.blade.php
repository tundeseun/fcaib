@extends('backEnd.master')
@section('title')
Transcript Application
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
            <h1>Transcript Application</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('transcript-application')}}">Transcript Application</a>
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
                                    <h2 class="text-center">Transcript Application Payment</h2>
                                    <p class="text-center text-danger">Note: Transcript application & processing costs {{@generalSetting()->currency_symbol}}{{number_format($transcript_cost)}} Please pay to continue</p>
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
<script type="text/javascript" src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
<script>         
      function makePayment() {
          var form = document.querySelector("#payment-form");
          var paymentEngine = RmPaymentEngine.init({
              key: "{{ config('remita.key') }}",
              transactionId: Math.floor(Math.random()*1101233), // Replace with a reference you generated or remove the entire field for us to auto-generate a reference for you. Note that you will be able to check the status of this transaction using this transaction Id
              customerId: '{{ $student_detail->matric_number ?? $student_detail->admission_no }}',
              firstName: '{{ $student_detail->first_name }}',
              lastName: '{{ $student_detail->last_name }}',
              email: '{{  $user->email}}',
              amount: '{{ $transcript_cost }}',
              narration: 'Transcript Application Payment',
              onSuccess: function (response) {
                  console.log('callback Successful Response', response);
                  window.location =`/transcript-application-3/${response.paymentReference}/${response.transactionId}`
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