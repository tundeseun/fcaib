@extends('backEnd.master')
@section('title')
Paid Fees & Receipts
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
            <h1>Paid Fees & Receipts</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">Paid Fees & Receipts</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>Fee</th>
                                    <th>Method</th>
                                    <th>Amount({{generalSetting()->currency_symbol}})</th>
                                    <th>Date</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($fees_payments as $fees_payment)
                                <tr>
                                    <td>
                                        {{ $fees_payment->feesType ? $fees_payment->feesType->name : '' }}
                                    </td>
                                    <td>
                                        {{ $fees_payment->payment_mode }}
                                    </td>
                                    <td>{{ number_format($fees_payment->amount) }}</td>
                                    <td>
                                        {{ dateConvert($fees_payment->payment_date) }}
                                    </td>
                                    <td>
                                        @if($fees_payment->receipt)
                                            <a href="{{ url($fees_payment->receipt) }}" class="btn btn-sm btn-success"><span class="ti-printer"></span> Receipt</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
