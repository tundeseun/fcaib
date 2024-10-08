
<script>
    if ($(".niceSelectModal").length) {
        $(".niceSelectModal").niceSelect();
    }
</script>
<style>
        .nice-select.bb .current {
          bottom: 10px;
         }

        .dloader_img_style{
            width: 70px;
            height: 70px;
        }

        .dloader {
            display: none;
        }

        .pre_dloader {
            display: show;
        }

</style>
<div class="container-fluid">
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-exam-schedule',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm']) }}
        <div class="row">
            <div class="col-lg-12">  
                @csrf
                <div class="add-visitor">
                    <input type="hidden" name="class_id" id="class_id" value="{{@$class_id}}">
                    <input type="hidden" name="section_id" id="section_id" value="{{@$section_id}}">
                    <input type="hidden" name="id" value="{{@$schedule->id}}">
                 
                    <div class="row mt-25">
                        <div class="col-lg-12 mt-30-md">
                            <select class="w-100 bb niceSelect form-control" name="subject" id="subject">
                                <option value="{{$schedule->subject->id}}">{{$schedule->subject->subject_name}}</option>
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
                                <option value="{{$schedule->classRoom->id}}">{{$schedule->classRoom->room_no}}</option>
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
                                <input class="primary-input date form-control{{ $errors->has('day') ? ' is-invalid' : '' }}" id="startDate" type="text" placeholder="@lang('lang.day')*" name="day" value='{{str_replace("-", "/", $schedule->day)}}'>
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
                                <input class="primary-input time  form-control{{ @$errors->has('start_time') ? ' is-invalid' : '' }}" type="text" name="start_time" value="{{$schedule->start_time}}">
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
                                    <input class="primary-input time  form-control{{ @$errors->has('end_time') ? ' is-invalid' : '' }}" type="text" name="end_time"  value="{{$schedule->end_time}}">
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

            </div>
            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                    <button class="primary-btn fix-gr-bg submit" type="submit">@lang('lang.save')</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
