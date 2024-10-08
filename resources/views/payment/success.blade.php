@extends('backEnd.master')

@section('title')
    Payment Success
@endsection

@section('mainContent')

<style>
    .payment-container {
        margin-top: 30px;
        text-align: center;
    }
    .card-header {
        background-color: #001f3f; /* Navy blue */
        color: white;
        font-size: 1.25rem;
        text-align: center;
    }
    .card-body {
        padding: 20px;
        font-size: 1rem;
    }
    .payment-info p {
        font-size: 1.1rem;
        font-weight: bold;
        color: #001f3f;
    }
    .payment-info span {
        font-size: 1.2rem;
        font-weight: bold;
    }
</style>

<div class="container payment-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Successful</div>
                <div class="card-body">
                    <div class="payment-info">
                        <p>Payment Reference: <span>{{ $payment->payment_reference }}</span></p>
                        <p>Transaction ID: <span>{{ $payment->transaction_id }}</span></p>
                        <p>Amount Paid: <span>&#8358;{{ number_format($payment->amount, 2) }}</span></p>
                        <p>Payment Date: <span>{{ $payment->payment_date }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
