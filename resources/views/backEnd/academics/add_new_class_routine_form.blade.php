
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
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add-new-class-routine-store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm', 'onsubmit' => "return validateAddNewroutine()"]) }}
        <div class="row">
            <div class="col-lg-12">  
                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                <input type="hidden" name="day" id="day" value="{{@$day}}">
                <input type="hidden" name="class_time_id" id="class_time_id" value="{{@$class_time_id}}">
                <input type="hidden" name="class_id" id="class_id" value="{{@$class_id}}">
                <input type="hidden" name="section_id" id="section_id" value="{{@$section_id}}">
                <input type="hidden" name="update_teacher_id" id="update_teacher_id" value="{{isset($teacher_detail)? $teacher_detail->id:''}}">
                @if(isset($assigned_id))
                    <input type="hidden" name="assigned_id" id="assigned_id" value="{{@$assigned_id}}">
                @endif               
                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelectModal form-control" name="subject" id="subject" onchange="changeSubject()">
                            <option data-display="@lang('lang.select') @lang('lang.subject') *" value="">@lang('lang.select') @lang('lang.subject') *</option>
                            @foreach($subjects as $subject)
                                @if(!in_array($subject->subject_id, $assinged_subject))
                                <option value="{{ @$subject->subject_id}}" {{isset($subject_id)? ($subject_id == $subject->subject_id?'selected':''):''}}>{{ @$subject->subject->subject_name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="text-danger" role="alert" id="subject_error"></span>                        
                    </div>
                </div>
                {{-- <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <div class="input-effect">
                         <input name="teacher_name" class="primary-input read-only-input" type="text" readonly="true" id="teacher_name" value="{{isset($teacher_detail)? $teacher_detail->full_name:''}}">
                         <input name="teacher_id" class="primary-input read-only-input" type="hidden" readonly="true" id="teacher_id"  value="{{isset($teacher_detail)? $teacher_detail->id:''}}">
                         <span class="focus-border"></span>
                         <label id="teacher_label">Lecturer <span>*</span></label>
                         <div class="pull-right loader loader_style" id="select_teacher_loader">
                            <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                        </div>
                        <span class="text-danger" role="alert" id="teacher_error">
                        </span>
                     </div>                        
                    </div>
                </div> --}}
                <div class="row mt-25" id="teacher-div">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelectModal form-control" name="teacher_id" id="teacher_name">
                            <option data-display="@lang('lang.select') Lecturer *" value="">@lang('lang.select') Lecturer *</option>
                            @if(isset($assigned_id))
                                @foreach($teachers as $teacher)                                
                                    <option value="{{ @$teacher->id}}" {{isset($teacher_detail)? ($teacher_detail->id == $teacher->id?'selected':''):''}}>{{ @$teacher->full_name}}</option>
                                @endforeach
                            @endif
                            
                        </select>
                        <div class="pull-right loader loader_style" id="select_teacher_loader">
                            <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                        </div>
                        <span class="text-danger" role="alert" id="teacher_error"></span>
                    </div>
                </div>

                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelectModal form-control" name="room" id="room"  onchange="changeRoom()">
                            <option data-display="@lang('lang.select') @lang('lang.room') *" value="">@lang('lang.select') @lang('lang.room') *</option>
                            @foreach($rooms as $room)
                                @if(!in_array($room->id, $assinged_room))
                                <option value="{{ @$room->id}}" {{isset($room_id)? ($room_id == $room->id?'selected':''):''}}>{{ @$room->room_no}}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="text-danger" role="alert" id="room_error"></span>
                    </div>
                </div>

                @if(!isset($assigned_id))
                    <div class="row mt-25 pl-30"  id="otherdays">   

                    </div>
                    <div class="dloader dloader_style mt-2 text-center" id="select_day_loader">
                        <img class="dloader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                    </div>
               @endif
            </div>
            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                    <button class="primary-btn fix-gr-bg submit" type="submit">@lang('lang.save') @lang('lang.information')</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
@push('script')
<script>
    // class routine get teacher
    function changeSubject() {
        var url = $('#url').val();
        var i = 0;
        var formData = {
            class_id: $('#class_id').val(),
            section_id: $('#section_id').val(),
            subject: $('#subject').val(),
            class_time_id: $('#class_time_id').val(),
            day: $('#day').val(),
            update_teacher_id: $('#update_teacher_id').val()
        };
       
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'get-class-teacher-ajax',

            beforeSend: function() {
                    $('#select_teacher_loader').addClass('pre_dloader');
                    $('#select_teacher_loader').removeClass('loader');
            },
            success: function (data) {       
                // $("#teacher_name").empty();
                  var a = "";                   
                  $.each(data, function(i, item) {
                      if (item.length) {
                          $("#teacher_name").find("option").not(":first").remove();
                          $("#teacher-div ul").find("li").not(":first").remove();

                          $.each(item, function(i, teacher) {
                              $("#teacher_name").append(
                                  $("<option>", {
                                      value: teacher.id,
                                      text: teacher.full_name,
                                  })
                              );
                              $("#teacher-div ul").append(
                                  "<li data-value='" +
                                  teacher.id +
                                  "' class='option'>" +
                                  teacher.full_name +
                                  "</li>"
                              );
                          });
                      } else {
                          $("#teacher-div .current").html("No Teahcer available *");
                          $("#teacher_name").find("option").not(":first").remove();
                          $("#teacher-div ul").find("li").not(":first").remove();
                      }
                  });
                
              
                // if (data[0] != "") {
                //     $('#teacher_name').val(data[0]['full_name']);
                //     $("#teacher_label").remove();
                //     $('#teacher_id').val(data[0]['id']);
                //     $('#teacher_error').html('');
                // } else {
                //     if (data[1] == 0) {
                //         $('#teacher_error').html('No teacher Assigned for the subject');
                //     } else {
                //         $('#teacher_error').html("the subject's teacher already assinged for the same time");
                //     }
                //     $('#teacher_name').val('');
                //     $('#teacher_id').val('');
                // }
            },
            error: function (data) {
                console.log('Error:', data);
            },
            complete: function() {
                i--;
                if (i <= 0) {
                    $('#select_teacher_loader').removeClass('pre_dloader');
                    $('#select_teacher_loader').addClass('loader');
                }
            }
        });

    }
    function changeRoom(){
        var url = $('#url').val();
        var i = 0;
        var formData = {
            class_id: $('#class_id').val(),
            section_id: $('#section_id').val(),
            subject: $('#subject').val(),
            class_time_id: $('#class_time_id').val(),
            day: $('#day').val(),
            room_id: $('#room').val(),
            teacher_id: $('#teacher_id').val(),
            update_teacher_id: $('#update_teacher_id').val()
        };
        
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'get-other-days-ajax',

            beforeSend: function() {
                    $('#select_day_loader').addClass('pre_dloader');
                    $('#select_day_loader').removeClass('dloader');
            },

            success: function(data) {
                $("#otherdays").empty();
                var appendRow = "";
                appendRow += "<div class='row p-0'>";
                appendRow += "<div class='col-lg-4 p-0'>";
                appendRow += "<label>{{__('lang.select')}} day</label>";
                appendRow += "</div>";
                appendRow += "<div class='col-lg-8'>";
                appendRow += "<input type='checkbox' id='all_days' onclick='selectAll()' class='common-checkbox' name='all_days[]' value='0'>";
                appendRow += " <label for='all_days'>{{__('lang.select')}} {{__('lang.all')}}</label>";
                appendRow += "</div>";
                appendRow += "<div class='col-lg-12'>";
                appendRow += "<div class='row'>";

                $.each(data, function(i, item) {
                    $.each(item, function(i, day) {
                        appendRow += "<div class='col-lg-4 pr-0'>";
                        appendRow +="<input type='checkbox' id='days_" + day.id 
                                    +"' class='common-checkbox day-checkbox' name='day_ids[]' value='" +day.id +"'>";
                        appendRow +="<label for='days_" +day.id +"'>" +day.name +"</label>";
                        appendRow += "</div>";
                    });
                });
                appendRow += "</div>";
                appendRow += "</div>";
                appendRow += "<div class='col-lg-12'>";
                $("#otherdays").append(appendRow);
            },
            error: function(data) {
                console.log('Error:', data);
            },
            complete: function() {
                i--;
                if (i <= 0) {
                    $('#select_day_loader').removeClass('pre_dloader');
                    $('#select_day_loader').addClass('dloader');
                }
            }
        });
    }
    function selectAll(){
        $("#all_days").on("change", function() {
            $(".day-checkbox").prop("checked", this.checked);
        });

        $(".day-checkbox").on("change", function() {
            if ($(".day-checkbox:checked").length == $(".day-checkbox").length) {
                $("#all_days").prop("checked", true);
            } else {
                $("#all_days").prop("checked", false);
            }
        });
    }
</script>
