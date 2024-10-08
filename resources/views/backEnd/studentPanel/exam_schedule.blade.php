@extends('backEnd.master')
@section('title')
@lang('lang.exam_routine')
@endsection
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> @lang('lang.exam_routine') </h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#"> @lang('lang.examinations')</a>
                    <a href="#"> @lang('lang.exam_routine') </a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        @if(session()->has('success') != "" || session()->has('danger') != "")
                        <tr>
                            <td colspan="20">
                                @if(session()->has('success') != "")
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @else
                                <div class="alert alert-success">
                                    {{ session()->get('danger') }}
                                </div>
                            </td>
                                @endif
                        </tr>
                        @endif
                        <tr>
                            <th width="10%">DAYS</th>
                            <th>EXAMINATION SCHEDULE</th>
                        </tr>
                        @foreach($exam_dates as $day)
                        <tr>
                            <td>
                                <small>
                                    {{@$day->day}}
                                </small>
                            </td>
                            @php 
                                $schedules = App\SmExamSchedule::getSchedules($day->day, $class_id, $section_id);
                            @endphp
                            @foreach($schedules as $schedule)
                            <td>
                                <small>
                                    <span class="">{{$schedule->subject_name}}({{$schedule->subject_code}})</span>
                                    <br>
                                    <span class="">{{$schedule->start_time}} - {{$schedule->end_time}}</span></br>
                                    <span class="tt">Venue: {{$schedule->room_no}}</span></br>
                                </small>
                            </td>
                            @endforeach

                        </tr>
                        @endforeach
                    </thead>
                    <tbody>
                    </tbody>
            </table>
        </div>
    </section>
@endsection
