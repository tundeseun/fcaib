@extends('backEnd.master')
@section('title')
Statement of Result Applications
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
            <h1>Statement of Result Applications</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">Statement of Result Applications</a>
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
                                    <th>Names</th>
                                    <th>Dept.</th>
                                    <th>Grad. Year</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($results as $result)
                                    <tr>
                                        <td>{{@$result->names}}</td>
                                        <td>{{@$result->department}}</td>
                                        <td>{{@$result->graduation_year}}</td>
                                        <td>{{@$result->email}}</td>
                                        <td>{{@$result->phone_number}}</td>
                                        <td>
                                            @if($result->status == 1)
                                            <a href="{{route('statement-m-untreated', $result->id)}}" class="btn btn-primary btn-sm"><span class="ti-close"></span> Mark as Untreated</a>
                                            @else
                                            <a href="{{route('statement-m-treated', $result->id)}}" class="btn btn-primary btn-sm"><span class="ti-check"></span> Mark as Treated</a>
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

