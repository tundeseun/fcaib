@extends('backEnd.master')
@section('title')
@lang('lang.result')
@endsection
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Results</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.examinations')</a>
                    <a href="#">@lang('lang.result')</a>
                </div>
            </div>
        </div>
    </section>

    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
            <div class="col-lg-12">
                <div class="no-search no-paginate no-table-info mb-2">
                    
                    @foreach($levels as $level)
                    @php
                        $f_credit_units = 0; $f_grade_points = 0;
                        $f_results = App\SmCourseRegistration::getExamResult(@$level->student_id, 'F', @$level->section);
                    @endphp
                    @if(count($f_results) > 0)

                    <table id="table_id" class="display school-table mb-5" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Level
                                </th>
                                <th>
                                    Semester
                                </th>
                                <th>
                                    Course
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Units
                                </th>
                                <th>
                                    Grade Obtained
                                </th>
                                <th>
                                    Grade Point
                                </th>
                                <th>
                                    Remark
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($f_results as $fresult)
                            <tr>
                                <td>{{@$level->section_name}}</td>
                                <td>First</td>
                                <td>{{@$fresult->subject_code}}</td>
                                <td>{{@$fresult->subject_name}}</td>
                                <td>{{@$fresult->units}}</td>
                                <td>{{@$fresult->grade}}</td>
                                <td>{{@$fresult->grade_point}}</td>
                                <td>{{$fresult->remark}}</td>
                                @php $f_credit_units += $fresult->units; $f_grade_points += $fresult->grade_point; @endphp  
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                        @if($f_credit_units != 0)
                        <h3>Grade Point Average : {{number_format($f_grade_points/$f_credit_units,2)}}</h3>
                        <h3>Cumulative Grade Point Average : {{number_format(App\SmCourseRegistration::cgpa($id),2)}}</h3>
                        @endif

                    @endif

                    @php
                        $s_credit_units = 0; $s_grade_points = 0;
                        $s_results = App\SmCourseRegistration::getExamResult(@$level->student_id, 'S', @$level->section);
                    @endphp
                    @if(count($s_results) > 0 )
                    <table id="table_id" class="display school-table mb-5" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Level
                                </th>
                                <th>
                                    Semester
                                </th>
                                <th>
                                    Course
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Units
                                </th>
                                <th>
                                    Grade Obtained
                                </th>
                                <th>
                                    Grade Point
                                </th>
                                <th>
                                    Remark
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($s_results as $sresult)
                            <tr>
                                <td>{{@$level->section_name}}</td>
                                <td>Second</td>
                                <td>{{@$sresult->subject_code}}</td>
                                <td>{{@$sresult->subject_name}}</td>
                                <td>{{@$sresult->units}}</td>
                                <td>{{@$sresult->grade}}</td>
                                <td>{{@$sresult->grade_point}}</td>
                                <td>{{$sresult->remark}}</td>
                                @php $s_credit_units += $sresult->units; $s_grade_points += $sresult->grade_point; @endphp  
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        @if($s_credit_units != 0)
                                <h3>Grade Point Average : {{number_format($s_grade_points/$s_credit_units,2)}}</h3>
                                <h3>Cumulative Grade Point Average : {{number_format(App\SmCourseRegistration::cgpa($id),2)}}</h3>
                        @endif
                    @endif

                    @endforeach

                </div>

                </div>
            </div>
        </div>
    </section>
@endsection
