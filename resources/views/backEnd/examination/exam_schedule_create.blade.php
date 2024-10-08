@extends('backEnd.master')
@section('title')
@lang('lang.exam_schedule')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.exam_schedule') </h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examination')</a>
                <a href="#">@lang('lang.exam_schedule')</a>
                <a href="#">@lang('lang.exam_schedule')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('message-success') != "")
                        @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                        @endif
                    @endif
                     @if(session()->has('message-danger') != "")
                        @if(session()->has('message-danger'))
                        <div class="alert alert-danger">
                            {{ session()->get('message-danger') }}
                        </div>
                        @endif
                    @endif
                    <div class="white-box">
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class') *" value="0">@lang('lang.select_class') *</option>
                                        @foreach($classes as $class)
                                        <option value="{{@$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{@$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section') " value="0">@lang('lang.select_section') </option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="col-lg-12 mt-20 text-right">
                                    <button onclick="filter()" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@if($exam_dates != "")
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.exam_schedule')</h3>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-3">

                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add-new-exam-schedule','method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm']) }}
                        <div class="white-box">
                            @csrf
                            <div class="add-visitor">
                                <input type="hidden" name="class_id" id="class_id" value="{{@$class_id}}">
                                <input type="hidden" name="section_id" id="section_id" value="{{@$section_id}}">
                             
                                <div class="row mt-25">
                                    <div class="col-lg-12 mt-30-md">
                                        <select class="w-100 bb niceSelect form-control" name="subject" id="subject">
                                            <option data-display="@lang('lang.select') @lang('lang.subject') *" value="">@lang('lang.select') @lang('lang.subject') *</option>
                                            @foreach($subjects as $subject)
                                                <option value="{{ @$subject->id}}">{{ @$subject->subject_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" role="alert" id="subject_error"></span>                        
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12 mt-30-md">
                                        <select class="w-100 bb niceSelect form-control" name="room" id="room">
                                            <option data-display="@lang('lang.select') @lang('lang.room') *" value="">@lang('lang.select') @lang('lang.room') *</option>
                                            @foreach($rooms as $room)
                                                <option value="{{ @$room->id}}" {{isset($room_id)? ($room_id == $room->id?'selected':''):''}}>{{ @$room->room_no}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" role="alert" id="room_error"></span>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('day') ? ' is-invalid' : '' }}" id="startDate" type="text" placeholder="@lang('lang.day')*" name="day">
                                                <span class="focus-border"></span>
                                            @if ($errors->has('day'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('day') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time  form-control{{ @$errors->has('start_time') ? ' is-invalid' : '' }}" type="text" name="start_time">
                                            <label>@lang('lang.select_time') *</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('start_time'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ @$errors->first('start_time') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-timer"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-25">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input time  form-control{{ @$errors->has('end_time') ? ' is-invalid' : '' }}" type="text" name="end_time">
                                                <label>@lang('lang.end_time') *</label>
                                                <span class="focus-border"></span>
                                               @if ($errors->has('end_time'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('end_time') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-timer"></i>
                                            </button>
                                        </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center mt-40">
                                <div class="mt-40 d-flex justify-content-between">
                                    <button class="primary-btn fix-gr-bg submit" type="submit">@lang('lang.save')</button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }} 
            </div>

            <div class="col-md-9">
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
                                    @if(userPermission(248))

                                        <a href="{{route('edit-exam-schedule', [$schedule->id, $section_id, $class_id])}}" class="modalLink" data-modal-size="modal-md" title="Edit Exam Schedule"><span class="ti-pencil-alt" id="addClassRoutine"></span></a>
                                    @endif
                                    @if(userPermission(249))

                                        <a href="{{route('delete-exam-schedule-modal',$schedule->id)}}" class="modalLink" data-modal-size="modal-md" title="Delete Exam Schedule"><span class="ti-trash" id="addClassRoutine"></span></a>

                                    @endif
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
        </div>
 
    </div>
</section>
@endif

@endsection

<script type="text/javascript">

function get_url() {
    var urlPrefix   = '{{@url()->current()}}'
    var urlSuffix = "";
    var class_id = 0;
    var section_id = 0;

    section_id = $('#select_section').val();
    class_id = $('#select_class').val();


    urlSuffix = "/"+class_id+"/"+section_id;

    var url = urlPrefix.substring(0, urlPrefix.length - 4) +urlSuffix;
    return url;
}

function filter() {
    var url = get_url();
    window.location.replace(url);
    //console.log(url);
}
</script>