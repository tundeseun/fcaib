@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Results</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">Results</a>
            </div>
        </div>
    </div>
</section>

@if(isset($results))
<section class="mt-20">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Lecturer</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach($results as $result)
                        <tr>
                            <td>{{$result->department->class_name}}</td>
                            <td>{{$result->course->subject_code}}<br/>
                                <small class="text-muted">{{$result->course->subject_name}}</small>
                            </td>
                            <td>{{ $result->status }}</td>
                            <td>{{$result->course->assigned->teacher->getName()}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Select</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{route('upload-results-single', $result->course->id)}}">View</a>                                    
                                        <a class="dropdown-item" href="{{route('department-result-accept', $result->id)}}">Accept</a>  
                                        <a class="dropdown-item" href="{{route('department-result-reject', $result->id)}}">Reject</a>  
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endif



@endsection
