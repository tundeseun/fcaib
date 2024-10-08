@extends('backEnd.master')
@section('title') 
Fee Payments
@endsection
@section('mainContent')


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Fee Payments</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.fees_collection')</a>
                <a href="#">Fee Payments</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if (@$fees_payments)            
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Fee</th>
                                        <th>Payee</th>
                                        <th>Method</th>
                                        <th>Amount({{generalSetting()->currency_symbol}})</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fees_payments as $fees_payment)
                                        <tr>
                                            <td>{{$fees_payment->feesType->name ?? ''}}</td>
                                            <td>
                                                @if($fees_payment->studentInfo)
                                                    {{$fees_payment->studentInfo->full_name}}
                                                @else
                                                    Student Not Found
                                                @endif
                                            </td>
                                            <td>{{$fees_payment->payment_mode}}</td>
                                            <td>{{number_format($fees_payment->amount)}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

