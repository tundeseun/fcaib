
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.subject'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.subject'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.academics'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.subject'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="d-flex justify-content-end my-3">
        <a  class="primary-btn small fix-gr-bg" href="add-course">
            <span class="ti-plus pr-2"></span>
            Add Course
        </a>
    </div>
    <div class="container-fluid p-0">
        <?php if(isset($subject)): ?>
          <?php if(userPermission(258)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('subject')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
           


            <div class="col-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.subject'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               <?php if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != ""): ?>
                                <tr>
                                    <td colspan="5">
                                         <?php if(session()->has('message-success-delete')): ?>
                                          <div class="alert alert-success">
                                              <?php echo e(session()->get('message-success-delete')); ?>

                                          </div>
                                        <?php elseif(session()->has('message-danger-delete')): ?>
                                          <div class="alert alert-danger">
                                              <?php echo e(session()->get('message-danger-delete')); ?>

                                          </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.sl'); ?></th>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <td>Dept.</td>
                                    <td>Level</td>
                                    <th>Semester</th>
                                    <th>Units</th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=0; ?>
                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$i); ?></td>
                                    <td><?php echo e($subject->subject_name); ?></td>
                                    <td><?php echo e($subject->subject_code); ?></td>
                                    <td>
                                        <?php if($subject->class_id == 0): ?>
                                            Elective Course
                                        <?php elseif($subject->class_id == -1): ?>
                                            Compulsory Course
                                        <?php else: ?>
                                            <?php echo e($subject->classes->class_name); ?>

                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo e($subject->sections->section_name); ?></td>
                                    <td><?php echo e($subject->subject_type == 'F'? '1st':'2nd'); ?></td>
                                    <td><?php echo e($subject->units); ?></td>
                                    
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                 <?php if(userPermission(259)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('subject_edit', [@$subject->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                               <?php endif; ?>
                                                <?php if(userPermission(260)): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteSubjectModal<?php echo e(@$subject->id); ?>"  href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                           <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                 <div class="modal fade admin-query" id="deleteSubjectModal<?php echo e(@$subject->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.subject'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                    <a href="<?php echo e(route('subject_delete', [@$subject->id])); ?>" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/academics/subject.blade.php ENDPATH**/ ?>