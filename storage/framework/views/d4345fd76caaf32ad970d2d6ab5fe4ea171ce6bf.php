

<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.my_profile'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<?php  @$setting = App\SmGeneralSettings::find(1);  if(!empty(@$setting->currency_symbol)){ @$currency = @$setting->currency_symbol; }else{ @$currency = '$'; }   ?> 
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <!-- Start Meta Information -->
                <div class="main-title">
                    <h3 class="mb-20"><?php echo app('translator')->get('lang.welcome'); ?> <strong> <?php echo e(@$student_detail->full_name); ?></strong> </h3>
                </div> 

            </div>
        </div>
            <div class="row">
                <?php if(userPermission(2)): ?>
                <div class="col-lg-4 col-md-6">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery" style="background: #B5D56A;">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="text-white"><?php echo e($student_detail->matric_number ?: $student_detail->utme_number); ?></h3>
                                    <p class="mb-0 text-white">Matric Number</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
                <?php if(userPermission(3)): ?>
                <div class="col-lg-4 col-md-6">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery" style="background: #4886FF;">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="text-white"><?php echo e(getDepartmentById($student_detail->class_id)); ?></h3>
                                    <p class="mb-0 text-white">Department</p>
                                </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php if(userPermission(4)): ?>
                <div class="col-lg-4 col-md-6">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery" style="background: #F6316F;">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="text-white"><?php echo e(getLevelById($student_detail->section_id)); ?></h3>
                                    <p class="mb-0 text-white">Level</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; ?>



            </div>
           <?php if(userPermission(10)): ?>
                <section class="mt-50">
                    <div class="container-fluid p-0">
                        <div class="row">
                        
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h3 class="mb-30"><?php echo app('translator')->get('lang.calendar'); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="white-box">
                                            <div class='common-calendar'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  

                    </div>
                </div>
                </section>
            <?php endif; ?>
        </div>
    </div> 
</section>

<div id="fullCalModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body text-center">
                    <img src="" alt="There are no image" id="image" height="150" width="auto">
                    <div id="modalBody"></div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    
<?php

$count_event =0;
@$calendar_events = array();

foreach($holidays as $k => $holiday) {

    @$calendar_events[$k]['title'] = $holiday->holiday_title;
    
    $calendar_events[$k]['start'] = $holiday->from_date;
    
    $calendar_events[$k]['end'] = Carbon::parse($holiday->to_date)->addDays(1)->format('Y-m-d');

    $calendar_events[$k]['description'] = $holiday->details;

    $calendar_events[$k]['url'] = $holiday->upload_image_file;

    $count_event = $k;
    $count_event++;
}



foreach($events as $k => $event) {
    @$calendar_events[$count_event]['title'] = $event->event_title;
    
    $calendar_events[$count_event]['start'] = $event->from_date;
    
    $calendar_events[$count_event]['end'] = Carbon::parse($event->to_date)->addDays(1)->format('Y-m-d');
    $calendar_events[$count_event]['description'] = $event->event_des;
    $calendar_events[$count_event]['url'] = $event->uplad_image_file;
    $count_event++;
}





?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script type="text/javascript">
    /*-------------------------------------------------------------------------------
       Full Calendar Js 
    -------------------------------------------------------------------------------*/
    if ($('.common-calendar').length) {
        $('.common-calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventClick:  function(event, jsEvent, view) {
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#image').attr('src',event.url);
                    $('#fullCalModal').modal();
                    return false;
                },
            height: 650,
            events: <?php echo json_encode($calendar_events);?> ,
        });
    }


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/studentProfile.blade.php ENDPATH**/ ?>