<div class="container-fluid pt-0">
    <div class="student-details notice-details">
        <div class="student-meta-box">
            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-12 col-md-5 mb-10">
                        <div class="name">
                            <strong><?php echo e(@$notice->notice_title); ?></strong>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-3">
                        <div class="name">
                            <?php echo $notice->notice_message; ?>

                        </div>
                    </div>
                    <div class="col-lg-12 col-md-4 mt-10">
                        <div class="name">
                            
                             <blockquote class="text-right">
                                <small class="font-italic"><?php echo e(@$notice->publish_on != ""? dateConvert( @$notice->publish_on):''); ?></small>
                              </blockquote>
                        </div>
                    </div>
               </div>
           </div>
    </div>
</div>
</div>
<?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/dashboard/view_notice.blade.php ENDPATH**/ ?>