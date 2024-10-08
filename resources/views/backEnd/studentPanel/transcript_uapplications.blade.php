@extends('backEnd.master')
@section('title')
Treated Transcript Applications
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
            <h1>Treated Transcript Applications</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('transcript-uapplications')}}">Treated Transcript Applications</a>
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
                                    <th>Entry/Grad. Year</th>
                                    <th>Institution</th>
                                    <th>Institution Country</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($transcripts as $transcript)
                                    <tr>
                                        <td>{{@$transcript->names}}</td>
                                        <td>{{@$transcript->department}}</td>
                                        <td>{{@$transcript->entry_year}} - {{@$transcript->graduation_year}}</td>
                                        <td>{{@$transcript->institution_name}}</td>
                                        <td>{{@$transcript->institution_country}}</td>
                                        <td>
                                            <a href="{{route('transcript',@$transcript->id)}}" class="btn btn-primary btn-sm"><span class="ti-eye"></span> View</a>
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

