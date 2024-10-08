@extends('backEnd.master')
@section('title')
@lang('lang.pay_fees')
@endsection
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.fees')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.fees')</a>
                    <a href="{{route('student_fees')}}">@lang('lang.pay_fees')</a>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="url" value="{{URL::to('/')}}">
    <input type="hidden" id="student_id" value="{{@$student->id}}">
    <section class="full_wide_table ">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="d-flex justify-content-between">
                        <div class="main-title">
                            <h3 class="mb-30">Pay Fees</h3>
                        </div>
                    </div>
                </div>
            </div>
            @if(session()->has('message-success'))
                <div class="alert alert-success">
                    {{ session()->get('message-success') }}
                </div>
            @elseif(session()->has('message-danger'))
                <div class="alert alert-danger">
                    {{ session()->get('message-danger') }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12" id="myFrame">
                    <div class="table-responsive">
                        <table id="" class="display school-table school-table-style-parent-fees" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th class="nowrap">@lang('lang.fees_group') </th>
                                <th class="nowrap">@lang('lang.fees_code') </th>
                                <th class="nowrap">@lang('lang.due_date') </th>
                                <th class="nowrap">@lang('lang.status')</th>
                                <th class="nowrap">@lang('lang.amount') ({{@generalSetting()->currency_symbol}})</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php
                                @$grand_total = 0;
                                @$total_fine = 0;
                                @$total_discount = 0;
                                @$total_paid = 0;
                                @$total_grand_paid = 0;
                                @$total_balance = 0;
                                $count = 0;
                            @endphp

                            @foreach($fees_assigneds as $fees_assigned)
                                @php
                                    $count++;

                                     @$grand_total += @$fees_assigned->feesGroupMaster->amount;


                                @endphp

                                @php
                                    @$discount_amount = $fees_assigned->applied_discount;
                                    @$total_discount += @$discount_amount;
                                    @$student_id = @$fees_assigned->student_id;
                                @endphp
                                @php
                                    //Sum of total paid amount of single fees type
                                     $paid = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id)->sum('amount');
                                    
                                     @$total_grand_paid += @$paid;
                                @endphp
                                @php
                                    //Sum of total fine for single fees type
                                    $fine = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id)->sum('fine');
               
                                    @$total_fine += $fine;
                                @endphp

                                @php
                                    @$total_paid = @$discount_amount + @$paid;
                                @endphp
                                <tr>
                                    <td>
                                        {{@$fees_assigned->feesGroupMaster->feesGroups != ""? @$fees_assigned->feesGroupMaster->feesGroups->name:""}}
                                    </td>
                                    <td>
                                        {{@$fees_assigned->feesGroupMaster->feesTypes->name}}
                                    </td>
                                    <td class="nowrap">
                                        {{@$fees_assigned->feesGroupMaster->date != ""? dateConvert(@$fees_assigned->feesGroupMaster->date):''}}
                                    </td>

                                    <td>
                                        @php
                                            // $total_payable_amount=$fees_assigned->feesGroupMaster->amount+$fine;
                                            $total_payable_amount=$fees_assigned->feesGroupMaster->amount;
                                            $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                            $balance_amount=number_format($rest_amount+$fine, 2, '.', '');
                                            $total_balance +=  $balance_amount;
                                        @endphp
                                        @if($balance_amount == 0)
                                            <button class="primary-btn small bg-success text-white border-0">@lang('lang.paid')</button>
                                        @else
                                            <button class="primary-btn small bg-danger text-white border-0">@lang('lang.unpaid')</button>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            echo @$total_payable_amount;
                                        @endphp
                                    </td>
                                    <td>
                                        @if($rest_amount != 0)
                                            <div class="dropdown">
                                                <a type="button" class="primary-btn fix-gr-bg" href="/pay-fees/{{ $fees_assigned->id }}">
                                                   Proceed to Payment
                                                </a>
                                            </div>
                                        @endif
                                    </td>

                                </tr>
                                @php
                                    @$payments =$student->feesPayment->where('active_status', 1)->where('fees_type_id',$fees_assigned->feesGroupMaster->feesTypes->id);
                                    $i = 0;
                                @endphp
                            @endforeach
                            
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>
                                    @lang('lang.grand') @lang('lang.total') ({{@generalSetting()->currency_symbol}})
                                </th>
                                <th></th>
                                <th>
                                    {{@$grand_total}}
                                </th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection
