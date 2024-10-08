
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lang.virtual_meeting'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    .propertiesname{
        text-transform: uppercase;
    }.
    .recurrence-section-hide {
       display: none!important
    }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.meetings'); ?> <?php echo app('translator')->get('lang.list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.meetings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.list'); ?></a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
                <?php echo $__env->make('zoom::meeting.includes.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('zoom::meeting.includes.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if(isset($editdata)): ?>
        <?php if( old('is_recurring',$editdata->is_recurring) == 1): ?>
            <script>$(".recurrence-section-hide").show();</script>
        <?php else: ?>
            <script>$(".recurrence-section-hide").hide(); $(".day_hide").hide();</script>
        <?php endif; ?>
    <?php elseif( old('is_recurring') == 1): ?>
        <script>$(".recurrence-section-hide").show();</script>
    <?php else: ?>
        <script>$(".recurrence-section-hide").hide();  $(".day_hide").hide();</script>
    <?php endif; ?>
    <?php if(isset($editdata)): ?>
        <script>$(".default-settings").show();</script>
    <?php else: ?>
    <script>$(".default-settings").hide();</script>
     <?php endif; ?>
    <script>
        
        $(document).ready(function(){
            $(document).on('change','.user_type',function(){
                let userType = $(this).val();
                $("#selectSectionss").select2().empty()
                $.get('<?php echo e(route('zoom.user.list.user.type.wise')); ?>',{ user_type: userType },function(res){
                    $("#selectSectionss").select2().empty()
                    $.each(res.users, function( index, item ) {
                        $('#selectSectionss').append(new Option(item.full_name, item.id))
                    });
                })
            })

            $(document).on('click','.recurring-type',function(){
                if($("input[name='is_recurring']:checked").val() == 0){
                    $(".recurrence-section-hide").hide();
                    $(".day_hide").hide();
                }else{
                    $(".recurrence-section-hide").show();
                }
            })
            $("#recurring_type").on("change", function() {
                 var type = $(this).val();
                 
                 if(type==2){
                    $(".day_hide").show();
                 }else{
                    $(".day_hide").hide();
                 }
              
            })

            $(document).on('click','.chnage-default-settings',function(){
                if($(this).val() == 0){
                    $(".default-settings").hide();
                }else{
                    $(".default-settings").show();
                }
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/Modules/Zoom/Resources/views/meeting/meeting.blade.php ENDPATH**/ ?>