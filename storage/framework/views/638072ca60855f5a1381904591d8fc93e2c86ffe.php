
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.student_details'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <?php
        function showTimelineDocName($data){
            $name = explode('/', $data);
            $number = count($name);
            return $name[$number-1];
        }
        function showDocumentName($data){
            $name = explode('/', $data);
            $number = count($name);
            return $name[$number-1];
        }
    ?>
<?php  $setting = app('school_info');  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?>

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.student_details'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="<?php echo e(route('student_list')); ?>"><?php echo app('translator')->get('lang.student_list'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.student_details'); ?></a>
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
                        <h3 class="mb-20"><?php echo app('translator')->get('lang.student_details'); ?></h3>
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
                                        <?php echo e(@ucwords($student_detail->first_name.' '.@$student_detail->last_name)); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Matric No.
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
                                        <?php if($student_detail->className!="" && $student_detail->session_id!=""): ?>
                                            <?php echo e(@$student_detail->className->class_name); ?>

                                        <?php endif; ?>
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

                                        <?php echo e(@$student_detail->gender !=""?$student_detail->gender->base_setup_name:""); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <!-- Start Student Details -->
                <div class="col-lg-9 student-details up_admin_visitor">
                    <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  <?php if(Session::get('studentDocuments') != 'active' && Session::get('studentTimeline') != 'active'): ?> active <?php endif; ?>" href="#studentProfile" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.profile'); ?></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Session::get('studentDocuments') == 'active'? 'active':''); ?>" href="#studentDocuments" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.document'); ?></a>
                        </li>


                        <!-- <li class="nav-item">
                            <a class="nav-link <?php echo e(Session::get('academicHistory') == 'active'? 'active':''); ?> " href="#academicHistory" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.academic'); ?> <?php echo app('translator')->get('lang.history'); ?></a>
                        </li> -->
                        <li class="nav-item edit-button">
                            <?php if(userPermission(66)): ?>
                                <a href="<?php echo e(route('student-result', [@$student_detail->id])); ?>"
                                class="primary-btn small fix-gr-bg">Results
                                </a>
                            <?php endif; ?>
                            <?php if(userPermission(66)): ?>
                                <a href="<?php echo e(route('student_paid_fees',$student_detail->id)); ?>" class="primary-btn small fix-gr-bg">
                                    Paid Fees & Receipts
                                </a>
                            <?php endif; ?>
                            <?php if(userPermission(66)): ?>
                                <a href="<?php echo e(route('student_edit', [@$student_detail->id])); ?>"
                                class="primary-btn small fix-gr-bg">Update
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Profile Tab -->
                        <div role="tabpanel" class="tab-pane fade  <?php if(Session::get('studentDocuments') != 'active' && Session::get('studentTimeline') != 'active'): ?> show active <?php endif; ?>" id="studentProfile">
                            <div class="white-box">
                                <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.personal'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.date'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(!empty($student_detail->admission_date)? dateConvert($student_detail->admission_date):''); ?>

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
                                                <?php echo e(\Carbon\Carbon::parse($student_detail->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years')); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.phone'); ?> <?php echo app('translator')->get('lang.number'); ?>
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

                        <!-- Start Documents Tab -->
                        <div role="tabpanel" class="tab-pane fade <?php echo e(Session::get('studentDocuments') == 'active'? 'show active':''); ?>" id="studentDocuments">
                            <div class="white-box">
                                <div class="text-right mb-20">
                                    <button type="button" data-toggle="modal" data-target="#add_document_madal"
                                            class="primary-btn tr-bg text-uppercase bord-rad">
                                        <?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.document'); ?>
                                        <span class="pl ti-upload"></span>
                                    </button>
                                </div>
                                <table id="" class="table simple-table table-responsive school-table"
                                       cellspacing="0">
                                    <thead class="d-block">
                                    <tr class="d-flex">
                                        <th class="col-2"><?php echo app('translator')->get('lang.title'); ?></th>
                                        <th class="col-6"><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th class="col-4"><?php echo app('translator')->get('lang.action'); ?></th>
                                    </tr>
                                    </thead>

                                    <tbody class="d-block">
                                    <?php if($student_detail->document_file_1 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($student_detail->document_title_1); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_1)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($student_detail->document_file_1)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                        href="<?php echo e(url($student_detail->document_file_1)); ?>" download>
                                                        <?php echo app('translator')->get('lang.download'); ?><span class="pl ti-download"></span>
                                                    </a>
                                                     <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,1)"  data-id="1"  href="#">
                                                        <span class="ti-trash"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_2 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($student_detail->document_title_2); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_2)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($student_detail->document_file_2)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                       href="<?php echo e(url($student_detail->document_file_2)); ?>" download>
                                                        <?php echo app('translator')->get('lang.download'); ?><span class="pl ti-download"></span>
                                                    </a>
                                                    <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,2)"  data-id="2"  href="#">
                                                        <span class="ti-trash"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_3 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($student_detail->document_title_3); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_3)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($student_detail->document_file_3)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                    href="<?php echo e(url($student_detail->document_file_3)); ?>" download>
                                                        <?php echo app('translator')->get('lang.download'); ?><span class="pl ti-download"></span>
                                                    </a>
                                                    <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,3)"  data-id="3"  href="#">
                                                        <span class="ti-trash"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_4 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($student_detail->document_title_4); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_4)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($student_detail->document_file_4)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                    href="<?php echo e(url($student_detail->document_file_4)); ?>" download>
                                                        <?php echo app('translator')->get('lang.download'); ?><span class="pl ti-download"></span>
                                                    </a>

                                                    <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,4)"  data-id="4"  href="#">
                                                        <span class="ti-trash"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                     

                                    <div class="modal fade admin-query" id="delete-doc" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <form action="<?php echo e(route('student_document_delete')); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="student_id" >
                                                            <input type="hidden" name="doc_id">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                            <button type="submit" class="primary-btn fix-gr-bg"><?php echo app('translator')->get('lang.delete'); ?></button>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    

                                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                //    $name = explode('/', $document->file);

                                    // if(!function_exists('showDocumentName')){
                                    //     function showDocumentName($data){
                                    //     $name = explode('/', $data);
                                    //     return $name[4];
                                    // }
                                    // }

                                ?>
                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($document->title); ?></td>
                                            <td class="col-6"><?php echo e(showDocument($document->file)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($document->file)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                    href="<?php echo e(url($document->file)); ?>" download>
                                                        <?php echo app('translator')->get('lang.download'); ?><span class="pl ti-download"></span>
                                                    </a>
                                                <?php endif; ?>
                                                <a class="primary-btn icon-only fix-gr-bg" data-toggle="modal"
                                                   data-target="#deleteDocumentModal<?php echo e($document->id); ?>" href="#">
                                                    <span class="ti-trash"></span>
                                                </a>

                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteDocumentModal<?php echo e($document->id); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?>
                                                            </button>
                                                            <a class="primary-btn fix-gr-bg"
                                                               href="<?php echo e(route('delete-student-document', [$document->id])); ?>">
                                                                <?php echo app('translator')->get('lang.delete'); ?></a>
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
                        <!-- End Documents Tab -->
                        <!-- Add Document modal form start-->
                        <div class="modal fade admin-query" id="add_document_madal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"> <?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.document'); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'upload_document',
                                                                'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="hidden" name="student_id"
                                                           value="<?php echo e($student_detail->id); ?>">
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control{" type="text"
                                                                       name="title" value="" id="title">
                                                                <label> <?php echo app('translator')->get('lang.title'); ?><span>*</span> </label>
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
                                                                       id="placeholderPhoto" placeholder="Document"
                                                                       disabled>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="primary-btn-small-input" type="button">
                                                                <label class="primary-btn small fix-gr-bg" for="photo"> <?php echo app('translator')->get('lang.browse'); ?></label>
                                                                <input type="file" class="d-none" name="photo"
                                                                       id="photo">
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
    function deleteDoc(id,doc){
        // alert(doc);
        var modal = $('#delete-doc');
         modal.find('input[name=student_id]').val(id)
         modal.find('input[name=doc_id]').val(doc)
         modal.modal('show');
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentInformation/student_view.blade.php ENDPATH**/ ?>