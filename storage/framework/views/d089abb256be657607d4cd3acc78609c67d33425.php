
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.my_profile'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<?php $__env->startPush('css'); ?>
<style>
.student-details .nav-tabs {
    margin-left: 10px;
}
</style>
<?php $__env->stopPush(); ?>

<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3 mb-30">
                <!-- Start Student Meta Information -->
                <div class="main-title">
                    <h3 class="mb-20"><?php echo app('translator')->get('lang.my_profile'); ?> </h3>
                </div>
                <div class="student-meta-box">
                    <div class="student-meta-top"></div>
                    <img class="student-meta-img img-100" src="<?php echo e(file_exists(@$student_detail->student_photo) ? asset($student_detail->student_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?>" alt="" style="min-height: 100px; max-height:100px;">
                    <div class="white-box radius-t-y-0">
                        <div class="single-meta mt-10">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Names
                                </div>
                                <div class="value">
                                    <?php echo e(ucwords(@$student_detail->first_name.' '.@$student_detail->last_name)); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Matric Number
                                </div>
                                <div class="value">
                                    <?php echo e(@$student_detail->matric_number); ?>

                                </div>
                            </div>
                        </div>

                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Dept.
                                </div>
                                <div class="value">
                                   <?php echo e(@$student_detail->className != ""? @$student_detail->className->class_name:''); ?> 
                                </div>
                            </div>
                        </div>

                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->get('lang.section'); ?>
                                </div>
                                <div class="value">
                                    <?php echo e(@$student_detail->section != ""? @$student_detail->section->section_name:""); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->get('lang.gender'); ?> 
                                </div>
                                <div class="value">
                                    <?php echo e(@$student_detail->gender!= ""? @$student_detail->gender->base_setup_name:""); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Student Meta Information -->
            </div>

            <!-- Start Student Details -->
            <div class="col-lg-9">
                <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                    <?php if(userPermission(12)): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(Session::get('studentDocuments') != 'active' && Session::get('studentTimeline') != 'active'): ?> active <?php endif; ?>" href="#studentProfile" role="tab" data-toggle="tab"> <?php echo app('translator')->get('lang.profile'); ?> </a>
                        </li>
                    <?php endif; ?>


                    <?php if(userPermission(15)): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Session::get('studentDocuments') == 'active'? 'active':''); ?>" href="#studentDocuments" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.documents'); ?></a>
                        </li>
                    <?php endif; ?>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Start Profile Tab -->
                    <div role="tabpanel" class="tab-pane fade <?php if(Session::get('studentDocuments') != 'active' && Session::get('studentTimeline') != 'active'): ?> show active <?php endif; ?>" id="studentProfile">
                        <div class="white-box">
                            <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.personal'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            <?php echo app('translator')->get('lang.admission'); ?>  <?php echo app('translator')->get('lang.date'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">                                                                                
                                        <?php echo e(@$student_detail->admission_date != ""? dateConvert(@$student_detail->admission_date):''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            <?php echo app('translator')->get('lang.date_of_birth'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">                                                                                        
                                            <?php echo e(@$student_detail->date_of_birth != ""? dateConvert(@$student_detail->date_of_birth):''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            <?php echo app('translator')->get('lang.phone'); ?>  <?php echo app('translator')->get('lang.number'); ?> 
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            <?php echo e(@$student_detail->mobile); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                              <?php echo app('translator')->get('lang.email'); ?> <?php echo app('translator')->get('lang.address'); ?> 
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            <?php echo e(@$student_detail->email); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                           <?php echo app('translator')->get('lang.address'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                           <?php echo e(@$student_detail->current_address); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Start Parent Part -->
                            <h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('lang.parent'); ?> / <?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.details'); ?></h4>
                            
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
                            <!-- End Parent Part -->

                            <!-- Start Transport Part -->
                            <?php if($accomodation): ?>
                            <h4 class="stu-sub-head mt-40">Hostel Accomodation</h4>


                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            <?php echo e($accomodation->dormitory_name); ?>

                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            Room Number <?php echo e($accomodation->name); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Transport Part -->
                            <?php endif; ?>



                        </div>
                    </div>
                    <!-- End Profile Tab -->

                    <!-- Start leave Tab -->

                  
                    <!-- Start Documents Tab -->
                    <div role="tabpanel" class="tab-pane fade <?php echo e(Session::get('studentDocuments') == 'active'? 'show active':''); ?>" id="studentDocuments">
                        <div class="white-box">
                            <div class="text-right mb-20">
                                <?php if(userPermission(16)): ?>
                                    <button type="button" data-toggle="modal" data-target="#add_document_madal" class="primary-btn tr-bg text-uppercase bord-rad">
                                        <?php echo app('translator')->get('lang.upload_document'); ?>
                                        <span class="pl ti-upload"></span>
                                    </button>
                                <?php endif; ?>
                            </div>
                            <table id="" class="table simple-table table-responsive school-table"
                                cellspacing="0">
                                <thead class="d-block">
                                    <tr class="d-flex">
                                        <th class="col-2"><?php echo app('translator')->get('lang.document_title'); ?></th>
                                        <th class="col-6"><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th class="col-4"><?php echo app('translator')->get('lang.action'); ?></th>
                                    </tr>
                                </thead>

                                <tbody class="d-block">
                                    <?php if($student_detail->admission_letter != ""): ?>
                                    <tr class="d-flex">
                                        <td class="col-2">Admission Letter</td>
                                        <td class="col-6"><?php echo e(showDocument(@$student_detail->admission_letter)); ?></td>
                                        <td class="col-4 d-flex align-items-center">
                                            <?php if(userPermission(17)): ?>
                                                <button class="primary-btn tr-bg text-uppercase bord-rad">
                                                    <a href="<?php echo e(asset($student_detail->admission_letter)); ?>" download><?php echo app('translator')->get('lang.download'); ?></a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_1 != ""): ?>
                                    <tr class="d-flex">
                                        <td class="col-2"><?php echo e($student_detail->document_title_1); ?> </td>
                                        <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_1)); ?></td>
                                        <td class="col-4 d-flex align-items-center">
                                            <?php if(userPermission(17)): ?>
                                                <button class="primary-btn tr-bg text-uppercase bord-rad">
                                                    <a href="<?php echo e(asset($student_detail->document_file_1)); ?>" download><?php echo app('translator')->get('lang.download'); ?></a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_2 != ""): ?>
                                    <tr class="d-flex">
                                        <td class="col-2"><?php echo e($student_detail->document_title_2); ?></td>
                                        <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_2)); ?></td>
                                        <td class="col-4 d-flex align-items-center">
                                            <?php if(userPermission(17)): ?>
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="<?php echo e(asset($student_detail->document_file_2)); ?>" download><?php echo app('translator')->get('lang.download'); ?></a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_3 != ""): ?>
                                    <tr class="d-flex">
                                        <td class="col-2"><?php echo e($student_detail->document_title_3); ?></td>
                                        <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_3)); ?></td>
                                        <td class="col-4 d-flex align-items-center">
                                            <?php if(userPermission(17)): ?>
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="<?php echo e(asset($student_detail->document_file_3)); ?>" download><?php echo app('translator')->get('lang.download'); ?></a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_4 != ""): ?>
                                    <tr class="d-flex">
                                        <td class="col-2"><?php echo e($student_detail->document_title_4); ?></td>
                                        <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_4)); ?></td>
                                        <td class="col-4 d-flex align-items-center">
                                            <?php if(userPermission(17)): ?>
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="<?php echo e(asset($student_detail->document_file_4)); ?>" download><?php echo app('translator')->get('lang.download'); ?></a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    


                                    
                                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="d-flex">
                                        <td class="col-2"><?php echo e(@$document->title); ?></td>
                                        <td class="col-6"><?php echo e(showDocument(@$document->file)); ?></td>
                                        <td class="col-4">
                                            <?php if(userPermission(17)): ?>
                                                <a class="primary-btn tr-bg text-uppercase bord-rad" href="<?php echo e(route('student-download-document',showDocument(@$document->file))); ?>">
                                                    Download<span class="pl ti-download"></span>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Documents Tab -->
                    <!-- Add Document modal form start-->
                    <div class="modal fade admin-query" id="add_document_madal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Upload Document</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                   <div class="container-fluid">
                                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_upload_document',
                                                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="hidden" name="student_id" value="<?php echo e(@$student_detail->id); ?>">
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control{" type="text" name="title" value="" id="title">
                                                                <label>Title <span>*</span> </label>
                                                                <span class="focus-border"></span>
                                                                
                                                                <span class=" text-danger" role="alert" id="amount_error">
                                                                    
                                                                </span>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-30">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect">
                                                                <input class="primary-input" type="text" id="placeholderPhoto" placeholder="Document"
                                                                    disabled>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="primary-btn-small-input" type="button">
                                                                <label class="primary-btn small fix-gr-bg" for="photo">browse</label>
                                                                <input type="file" class="d-none" name="photo" id="photo">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- <div class="col-lg-12 text-center mt-40">
                                                    <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                                        <span class="ti-check"></span>
                                                        save information
                                                    </button>
                                                </div> -->
                                                <div class="col-lg-12 text-center mt-40">
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>

                                                        <button class="primary-btn fix-gr-bg" type="submit">save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Add Document modal form end-->
                    <!-- delete document modal -->

                    <!-- delete document modal -->

                </div>
            </div>
            <!-- End Student Details -->
        </div>

            
    </div>
</section>




<script>
    // data table responsive problem tab
    $(document).ready(function () {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $($.fn.dataTable.tables(true)).DataTable()
    .columns.adjust()
    .responsive.recalc();
    });
    });

    function deleteDoc(id,doc){
        // alert(doc);
        var modal = $('#delete-doc');
         modal.find('input[name=student_id]').val(id)
         modal.find('input[name=doc_id]').val(doc)
         modal.modal('show');
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/my_profile.blade.php ENDPATH**/ ?>