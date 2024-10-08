
<?php $__env->startSection('title'); ?> 
    Applicant <?php echo app('translator')->get('lang.view'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?> 
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Applicants Details</h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="<?php echo e(url('parentregistration/student-list')); ?>"><?php echo app('translator')->get('lang.new'); ?> <?php echo app('translator')->get('lang.registration'); ?></a>
                    <a href="#">Applicants Details</a>
                </div>
            </div>
        </div>
    </section>
    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Start Student Meta Information -->
                    <div class="main-title">
                        <h3 class="mb-20">Applicants Details</h3>
                    </div>

                    <div class="student-meta-box">
                        <div class="student-meta-top"></div>
                        <img class="student-meta-img img-100" src="<?php echo e(file_exists(@$student_detail->student_photo) ? asset($student_detail->student_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?>" alt="" style="min-height: 100px; max-height: 100px;">
                        <div class="white-box radius-t-y-0">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Applicant <?php echo app('translator')->get('lang.name'); ?>
                                    </div>
                                
                                    <div class="value">
                                        <?php echo e(ucwords($student_detail->first_name.' '.$student_detail->last_name)); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.class'); ?>
                                    </div>
                                    <div class="value">
                                        
                                            <?php echo e(@$student_detail->class->class_name); ?>

                                           
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.section'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e(@$student_detail->section->section_name); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.gender'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e($student_detail->gender !=""?$student_detail->gender->base_setup_name:""); ?>

                                    </div>
                                </div>
                            </div>
                             <?php if(moduleStatusCheck('Saas') == TRUE): ?>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.school'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e(@$student_detail->school->school_name); ?>

                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.academic_year'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e(@$student_detail->academicYear->year); ?>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- End Student Meta Information -->

                </div>

                <!-- Start Student Details -->
                <div class="col-lg-9 student-details up_admin_visitor">
                    

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Profile Tab -->
                        <div role="tabpanel" class="tab-pane fade  show active" id="studentProfile">
                            <div class="white-box">
                                <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.personal'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                               

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.date_of_birth'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(!empty($student_detail->date_of_birth)? dateConvert($student_detail->date_of_birth):''); ?>  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.age'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(@$student_detail->age); ?> <?php echo app('translator')->get('lang.year'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.email'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->student_email); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>                                

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.mobile'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->student_mobile); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <h4 class="stu-sub-head mt-20"><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.name'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(ucwords($student_detail->guardian_name)); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.mobile'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->guardian_mobile); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.email'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->guardian_email); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                Relationship
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                               <?php if($student_detail->guardian_relation == 'F'): ?>
                                               <?php echo e('Father'); ?>

                                               <?php elseif($student_detail->guardian_relation == 'M'): ?>
                                               <?php echo e('Mother'); ?>

                                               <?php else: ?>
                                               <?php echo e('Other'); ?>

                                               <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="single-info">
                                    <h4 class="stu-sub-head mt-20">Applicants Documents</h4>
                                    <div class="row">
                                        <div class="col">
                                            <a class="btn btn-sm btn-primary text-white p-2 my-2" target="_blank" href="<?php echo e(url($student_detail->ssce_result)); ?>">View Applicants SSCE Result</a>
                                            <a class="btn btn-sm btn-primary text-white p-2 my-2" target="_blank" href="<?php echo e(url($student_detail->utme_result)); ?>">View Applicants UTME Result</a>
                                            <a class="btn btn-sm btn-primary text-white p-2 my-2" target="_blank" href="<?php echo e(url($student_detail->guarantors_letter)); ?>">View Applicants Guarantors Letter</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <h4 class="stu-sub-head mt-20">Actions</h4>
                                    <div class="row">
                                        <div class="col">
                                            <a class="btn btn-sm btn-success text-white p-2 my-2" onclick="deleteId(<?php echo e($student_detail->id); ?>);" class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#deleteStudentModal" data-id="<?php echo e($student_detail->id); ?>"><span class="ti-check"></span>Approve</a>
                                            <a class="btn btn-sm btn-danger text-white p-2 my-2" onclick="enableId(<?php echo e($student_detail->id); ?>);" class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#enableStudentModal" data-id="<?php echo e($student_detail->id); ?>"><span class="ti-trash"></span> Delete</a>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- End Profile Tab -->
                        <!-- delete document modal -->

                        <!-- delete document modal -->
                    </div>
                </div>
                <!-- End Student Details -->
            </div>


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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\college\resources\views/modules/parentregistration/student_view.blade.php ENDPATH**/ ?>