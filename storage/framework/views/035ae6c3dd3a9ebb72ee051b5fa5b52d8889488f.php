
 <?php if(Auth::user()->role_id == 1 ): ?>
    <div class="col-lg-9">
 <?php elseif(userPermission(561) && userPermission(560)): ?>
    <div class="col-lg-9">
 <?php else: ?>
    <div class="col-lg-12">
 <?php endif; ?>

    <div class="main-title">
        <h3 class="mb-0">
            <?php echo app('translator')->get('lang.meeting'); ?>   <?php echo app('translator')->get('lang.list'); ?>
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>#</th>
                    <th><?php echo app('translator')->get('lang.meeting_id'); ?></th>
                    <th><?php echo app('translator')->get('lang.password'); ?></th>
                    <th><?php echo app('translator')->get('lang.topic'); ?></th>
                    <th><?php echo app('translator')->get('lang.date'); ?></th>
                    <th><?php echo app('translator')->get('lang.time'); ?></th>
                    <th><?php echo app('translator')->get('lang.duration'); ?></th>
                    <th><?php echo app('translator')->get('lang.zoom_start_join'); ?> <?php echo app('translator')->get('lang.before'); ?></th>
                    <th><?php echo app('translator')->get('lang.zoom_start_join'); ?></th>
                    <th><?php echo app('translator')->get('lang.actions'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td><?php echo e($meeting->meeting_id); ?></td>
                    <td><?php echo e($meeting->password); ?></td>
                    <td><?php echo e($meeting->topic); ?></td>
                    <td><?php echo e($meeting->date_of_meeting); ?></td>
                    <td><?php echo e($meeting->time_of_meeting); ?></td>
                    <td><?php echo e($meeting->meeting_duration); ?> Min </td>                    
                    <td><?php echo e($meeting->time_before_start); ?> Min </td>
                    <td>
                        <?php if($meeting->currentStatus == 'started'): ?>
                            <?php if(userPermission(559)): ?>
                                <a class="primary-btn small bg-success text-white border-0" href="<?php echo e(route('zoom.meeting.join', $meeting->meeting_id)); ?>" target="_blank" >
                                    <?php if(Auth::user()->role_id == 1 || Auth::user()->id == $meeting->created_by): ?>
                                        <?php echo app('translator')->get('lang.start'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('lang.join'); ?>
                                    <?php endif; ?>
                                </a>
                            <?php else: ?>
                                <button href="#notpermitted" class="primary-btn small bg-warning text-white border-0">Not Permitted</button>
                            <?php endif; ?>

                        <?php elseif( $meeting->currentStatus == 'waiting'): ?>
                            <a href="#Closed" class="primary-btn small bg-info text-white border-0">Waiting</button>
                        <?php else: ?>
                            <a href="#Closed" class="primary-btn small bg-warning text-white border-0">Closed</button>
                        <?php endif; ?>
                    </td>
                    <td>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                    <?php echo app('translator')->get('lang.select'); ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="<?php echo e(route('zoom.meetings.show', $meeting->meeting_id)); ?>"><?php echo app('translator')->get('lang.view'); ?></a>
                                    <?php if(userPermission(557)): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('zoom.meetings.edit',$meeting->id )); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->id == $meeting->created_by): ?>
                                    
                                     <a class="dropdown-item modalLink" data-modal-size="modal-md" title="<?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.recorded'); ?> <?php echo app('translator')->get('lang.video'); ?>"  
                                           href="<?php echo e(route('zoom.meeting-upload-vedio-file', [$meeting->id])); ?>" ><?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.recorded'); ?> <?php echo app('translator')->get('lang.video'); ?></a>
                                  
                                    <?php endif; ?>
                                    <?php if(userPermission(558)): ?>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#d<?php echo e($meeting->id); ?>" href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                    </td>
                </tr>
                <div class="modal fade admin-query" id="uploadmeeting<?php echo e($meeting->id); ?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> <?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.recorded'); ?>  <?php echo app('translator')->get('lang.file'); ?></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="container-fluid">
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'zoom.upload_document',
                                                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="meeting_id"
                                                   value="<?php echo e($meeting->id); ?>">
                                            <div class="row mt-25">
                                                <div class="col-lg-12">
                                                    <div class="input-effect">
                                                        <input type="hidden" name="meetingupload" value="meetingUpload">
                                                        <input class="primary-input form-control" type="text"
                                                               name="title" value="<?php echo e($meeting->vedio_link); ?>" id="link">
                                                        <label> <?php echo app('translator')->get('lang.link'); ?></label>
                                                        <span class="focus-border"></span>

                                                        <span class=" text-danger" role="alert"
                                                              id="amount_error">
                                                            
                                                        </span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-30">
                                            <div class="row no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                        <input class="primary-input" type="text"
                                                               id="placeholderPhoto" placeholder="<?php echo e(isset($meeting->local_video) && @$meeting->local_video != ""? getFilePath3(@$meeting->local_video) : 'Attach File'); ?>"
                                                               disabled>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="primary-btn-small-input" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="photo"> <?php echo app('translator')->get('lang.browse'); ?></label>
                                                        <input type="file" class="d-none" name="vedio"
                                                               id="photo">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 text-center mt-40">
                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg"
                                                        data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?>
                                                </button>

                                                <button class="primary-btn fix-gr-bg submit" type="submit"><?php echo app('translator')->get('lang.save'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php if(userPermission(558)): ?>
                    <div class="modal fade admin-query" id="d<?php echo e($meeting->id); ?>" >
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.delete_meetings'); ?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <div class="text-center">
                                        <h4><?php echo app('translator')->get('lang.are_you_sure_delete'); ?></h4>
                                    </div>

                                    <div class="mt-40 d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                        <form class="" action="<?php echo e(route('zoom.meetings.destroy',$meeting->id)); ?>" method="POST" >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>
                                            <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php /**PATH /home2/fcaibedu/public_html/portal/Modules/Zoom/Resources/views/meeting/includes/list.blade.php ENDPATH**/ ?>