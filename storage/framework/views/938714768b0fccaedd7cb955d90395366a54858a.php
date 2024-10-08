
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Manage Applicants</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.new'); ?> <?php echo app('translator')->get('lang.registration'); ?></a>
                <a href="#">Applicants List</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php if(session()->has('message-success') != ""): ?>
                        <?php if(session()->has('message-success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message-success')); ?>

                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="white-box">
                        <form class='form-horizontal' action ="<?php echo e(route('parentregistration-applicants-search')); ?>" method='POST' enctype='multipart/form-data' id ='parent-registration'>
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">


                                <div class="col-lg-4 mt-30-md" id="academic-year-div">

                                    <select class="niceSelect w-100 bb form-control" name="academic_year" id="select-academic-year-school">
                                        <option data-display="Select Academic Year" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.academic_year'); ?></option>
                                        <?php $__currentLoopData = academicYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <option value="<?php echo e($academic_year->id); ?>"><?php echo e(@$academic_year->year); ?> [<?php echo e(@$academic_year->title); ?>]</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </select>
                                       
                                </div>

                                <div class="col-lg-4 mt-30-md" id="class-div">
                                    <select class="w-100 niceSelect bb form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select-class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>" value=""><?php echo app('translator')->get('lang.select_class'); ?></option>
                                        
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-4 mt-30-md" id="section-div">
                                    <select class="w-100 niceSelect bb form-control<?php echo e($errors->has('current_section') ? ' is-invalid' : ''); ?>" id="select-section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                    </select>
                                </div>
                            </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
            <?php if(@$students): ?>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">Applicants List (<?php echo e(@$students ? @$students->count() : 0); ?>)</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-success') != "" ||
                                    session()->get('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="10">
                                            <?php if(session()->has('message-success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('message-success')); ?>

                                            </div>
                                            <?php elseif(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.class'); ?></th>
                                        <th><?php echo app('translator')->get('lang.section'); ?></th>
                                        <th><?php echo app('translator')->get('lang.academic_year'); ?></th>
                                        <th><?php echo app('translator')->get('lang.actions'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = @$students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(ucwords($student->first_name.' '.$student->last_name)); ?></td>

                                        <td><?php echo e(@$student->class->class_name); ?></td>
                                        <td><?php echo e(@$student->section->section_name); ?></td>
                                        <td><?php echo e(@$student->academicYear->year); ?></td>
                                        <td>

                                                <?php if(userPermission(544)): ?>

                                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('parentregistration/student-view', [$student->id])); ?>"  data-id="<?php echo e($student->id); ?>"  ><span class="ti-eye"></span> View</a>

                                                <?php endif; ?>

                                                <?php if(userPermission(545)): ?>

                                                 <a onclick="deleteId(<?php echo e($student->id); ?>);" class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#deleteStudentModal" data-id="<?php echo e($student->id); ?>"  ><span class="ti-check"></span> Approve</a>
                                                 <?php endif; ?>

                                                 <?php if(userPermission(546)): ?>

                                                 <a onclick="enableId(<?php echo e($student->id); ?>);" class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#enableStudentModal" data-id="<?php echo e($student->id); ?>"><span class="ti-trash"></span> Delete</a>
                                                 <?php endif; ?>

                                        </td>
                                    </tr>
                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
    </div>
</section>

<div class="modal fade admin-query" id="deleteStudentModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Applicant <?php echo app('translator')->get('lang.approve'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                
                <div class="text-center">
                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_approve'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                     <?php echo e(Form::open(['route' => 'parentregistration/student-approve', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                <input type="hidden" name="id" value="<?php echo e(@$student->id); ?>" id="student_delete_i">  
                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.approve'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade admin-query" id="enableStudentModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> Applicant</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                     <?php echo e(Form::open(['route' => 'parentregistration/student-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" value="" id="student_enable_i">  
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\college\Modules/ParentRegistration\Resources/views/applicants.blade.php ENDPATH**/ ?>