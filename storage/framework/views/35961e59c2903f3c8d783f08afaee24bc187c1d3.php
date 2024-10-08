
<?php if(Auth::user()->role_id == 1 ): ?>
    <div class="col-lg-9">
<?php elseif(userPermission(555) && userPermission(556)): ?>
    <div class="col-lg-9">
<?php else: ?>
    <div class="col-lg-12">
<?php endif; ?>
        <div class="main-title">
            <h3 class="mb-0">
                <?php echo app('translator')->get('lang.virtual_class'); ?>  <?php echo app('translator')->get('lang.list'); ?>
            </h3>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <?php if(Auth::user()->role_id != 2 || Auth::user()->role_id != 3): ?>
                                <th><?php echo app('translator')->get('lang.class'); ?></th>
                                <th>Level</th>
                            <?php endif; ?>
                            <th><?php echo app('translator')->get('lang.virtual_class_id'); ?></th>
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
                            <?php if(Auth::user()->role_id != 2 || Auth::user()->role_id != 3 ): ?>
                                <td><?php echo e($meeting->class->class_name); ?></td>
                                <td><?php echo e($meeting->section_id !=null ?  $meeting->section->section_name :'All sections'); ?></td>
                            <?php endif; ?>
                            <td><?php echo e($meeting->meeting_id); ?></td>
                            <td><?php echo e($meeting->password); ?></td>
                            <td><?php echo e($meeting->topic); ?></td>
                            <td><?php echo e($meeting->date_of_meeting); ?></td>
                            <td><?php echo e($meeting->time_of_meeting); ?></td>
                            <td><?php echo e($meeting->meeting_duration); ?> <?php echo app('translator')->get('lang.min'); ?></td>
                            <td><?php echo e($meeting->time_before_start); ?> Min </td>
                            <td>
                                <?php if($meeting->currentStatus == 'started'): ?>
                           
                                        <a class="primary-btn small bg-success text-white border-0" href="<?php echo e(route('zoom.virtual-class.join', $meeting->meeting_id)); ?>" target="_blank" >
                                            <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->id == $meeting->created_by ): ?>
                                                <?php echo app('translator')->get('lang.start'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.join'); ?>
                                            <?php endif; ?>
                                        </a>
            
                                <?php elseif( $meeting->currentStatus == 'waiting'): ?>
                                    <a href="#Closed" class="primary-btn small bg-info text-white border-0"><?php echo app('translator')->get('lang.waiting'); ?></button>
                                <?php else: ?>
                                    <a href="#Closed" class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('lang.closed'); ?></button>
                                <?php endif; ?>
                                
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <?php echo app('translator')->get('lang.select'); ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" target="_blank"  href="<?php echo e(route('zoom.virtual-class.show', $meeting->meeting_id)); ?>"><?php echo app('translator')->get('lang.view'); ?></a>
                                         <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->id == $meeting->created_by ): ?>
                                         
                                         
                                           <a class="dropdown-item modalLink" data-modal-size="modal-md"   title="<?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.recorded'); ?> <?php echo app('translator')->get('lang.video'); ?>"  
                                           href="<?php echo e(route('zoom.virtual-upload-vedio-file', [$meeting->id])); ?>" ><?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.recorded'); ?> <?php echo app('translator')->get('lang.video'); ?></a>
                                        
                                        <?php endif; ?>
                                        <?php if(userPermission(562)): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('zoom.virtual-class.edit',$meeting->id )); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                        <?php endif; ?>
                                        <?php if(userPermission(563) ): ?>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#d<?php echo e($meeting->id); ?>" href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
     
                   
                        <?php if(userPermission(563)): ?>
                            <div class="modal fade admin-query" id="d<?php echo e($meeting->id); ?>" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo app('translator')->get('lang.delete_virtual_class'); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4><?php echo app('translator')->get('lang.are_you_sure_delete'); ?></h4>
                                            </div>
                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                <form class="" action="<?php echo e(route('zoom.virtual-class.destroy',$meeting->id)); ?>" method="POST" >
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
<?php /**PATH /home2/fcaibedu/public_html/portal/Modules/Zoom/Resources/views/virtualClass/includes/list.blade.php ENDPATH**/ ?>