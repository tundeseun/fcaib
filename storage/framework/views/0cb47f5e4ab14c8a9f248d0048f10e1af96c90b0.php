
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
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add-new-class-routine-store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm', 'onsubmit' => "return validateAddNewroutine()"])); ?>

        <div class="row">
            <div class="col-lg-12">  
                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                <input type="hidden" name="day" id="day" value="<?php echo e(@$day); ?>">
                <input type="hidden" name="class_time_id" id="class_time_id" value="<?php echo e(@$class_time_id); ?>">
                <input type="hidden" name="class_id" id="class_id" value="<?php echo e(@$class_id); ?>">
                <input type="hidden" name="section_id" id="section_id" value="<?php echo e(@$section_id); ?>">
                <input type="hidden" name="update_teacher_id" id="update_teacher_id" value="<?php echo e(isset($teacher_detail)? $teacher_detail->id:''); ?>">
                <?php if(isset($assigned_id)): ?>
                    <input type="hidden" name="assigned_id" id="assigned_id" value="<?php echo e(@$assigned_id); ?>">
                <?php endif; ?>               
                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelectModal form-control" name="subject" id="subject" onchange="changeSubject()">
                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.subject'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.subject'); ?> *</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!in_array($subject->subject_id, $assinged_subject)): ?>
                                <option value="<?php echo e(@$subject->subject_id); ?>" <?php echo e(isset($subject_id)? ($subject_id == $subject->subject_id?'selected':''):''); ?>><?php echo e(@$subject->subject->subject_name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="text-danger" role="alert" id="subject_error"></span>                        
                    </div>
                </div>
                
                <div class="row mt-25" id="teacher-div">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelectModal form-control" name="teacher_id" id="teacher_name">
                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> Lecturer *" value=""><?php echo app('translator')->get('lang.select'); ?> Lecturer *</option>
                            <?php if(isset($assigned_id)): ?>
                                <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                
                                    <option value="<?php echo e(@$teacher->id); ?>" <?php echo e(isset($teacher_detail)? ($teacher_detail->id == $teacher->id?'selected':''):''); ?>><?php echo e(@$teacher->full_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            
                        </select>
                        <div class="pull-right loader loader_style" id="select_teacher_loader">
                            <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                        </div>
                        <span class="text-danger" role="alert" id="teacher_error"></span>
                    </div>
                </div>

                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelectModal form-control" name="room" id="room"  onchange="changeRoom()">
                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.room'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.room'); ?> *</option>
                            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!in_array($room->id, $assinged_room)): ?>
                                <option value="<?php echo e(@$room->id); ?>" <?php echo e(isset($room_id)? ($room_id == $room->id?'selected':''):''); ?>><?php echo e(@$room->room_no); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="text-danger" role="alert" id="room_error"></span>
                    </div>
                </div>

                <?php if(!isset($assigned_id)): ?>
                    <div class="row mt-25 pl-30"  id="otherdays">   

                    </div>
                    <div class="dloader dloader_style mt-2 text-center" id="select_day_loader">
                        <img class="dloader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                    </div>
               <?php endif; ?>
            </div>
            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                    <button class="primary-btn fix-gr-bg submit" type="submit"><?php echo app('translator')->get('lang.save'); ?> <?php echo app('translator')->get('lang.information'); ?></button>
                </div>
            </div>
        </div>
    <?php echo e(Form::close()); ?>

</div>
<?php $__env->startPush('script'); ?>
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
                appendRow += "<label><?php echo e(__('lang.select')); ?> day</label>";
                appendRow += "</div>";
                appendRow += "<div class='col-lg-8'>";
                appendRow += "<input type='checkbox' id='all_days' onclick='selectAll()' class='common-checkbox' name='all_days[]' value='0'>";
                appendRow += " <label for='all_days'><?php echo e(__('lang.select')); ?> <?php echo e(__('lang.all')); ?></label>";
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
<?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/academics/add_new_class_routine_form.blade.php ENDPATH**/ ?>