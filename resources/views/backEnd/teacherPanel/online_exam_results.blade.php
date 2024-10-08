@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Assigned Courses</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">Assigned Courses</a>
            </div>
        </div>
    </div>
</section>

@if(isset($courses))
<section class="mt-20">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Course Title</th>
                            <th>Course Code</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td>{{getDepartmentById($course->class_id)}}</td>
                            <td>{{$course->subject_name}}</td>
                            <td>{{$course->subject_code}}</td>
                            <td>
                            @if($course->end_date_time < $present_date_time && $course->status == 1)
                                <a href="{{route('online_exam_result', [$course->eid])}}" class="btn btn-success btn-sm">View Results</a>
                            </td>
                            @endif
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
