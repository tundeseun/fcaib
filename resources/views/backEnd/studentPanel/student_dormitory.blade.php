@extends('backEnd.master')
@section('title')
@lang('lang.dormitory')
@endsection

@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.dormitory')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('student_dormitory')}}">@lang('lang.dormitory')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"> Hostel Accomodation</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        @if($status)
                        <div class="card p-5" style="border-radius: 20px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{file_exists(@$user->student->student_photo) ? asset($user->student->student_photo) : asset('public/uploads/staff/demo/staff.jpg') }}" width="100%" height="100%" />
                                </div>
                                <div class="col-md-9">
                                    <h3>Accomodation Details</h3><hr>
                                    <h5>{{  ucwords($room->dormitory->dormitory_name)}}</h5>
                                    <p>
                                        {{ ucwords($room->name) }}
                                        <br>
                                        Standard Room Space for {{$room->dormitory->type == 'B' ? 'Boys' : 'Girls'  }}
                                    </p>
                                    <small class="text-info">{{ $room->description }}</small>
                                </div>
                            </div>
                        </div>
                        @else
                            <form class="card p-5" style="border-radius: 20px;" onsubmit="makePayment()" id="payment-form">
                                <h4>
                                    Pay a non refundable booking fee of {{@generalSetting()->currency_symbol}}{{number_format($booking_cost) }} to continue
                                </h4>

                                <p>
                                    N/B: This booking fee expires after 24hours
                                </p>

                                <button class="primary-btn fix-gr-bg submit mt-3" type="button" onclick="makePayment()" ><i class="ti-check"></i> Pay </button>
                            </form>
                        @endif

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
              customerId: '{{ $user->student->matric_number ?? $user->student->admission_no }}',
              firstName: '{{ $user->student->first_name }}',
              lastName: '{{ $user->student->last_name }}',
              email: '{{  $user->email}}',
              amount: '{{ $booking_cost}}',
              narration: 'Hostel Booking Fee',
              onSuccess: function (response) {
                  console.log('callback Successful Response', response);
                  window.location =`/student-dormitory/booking/${response.paymentReference}/${response.transactionId}`
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