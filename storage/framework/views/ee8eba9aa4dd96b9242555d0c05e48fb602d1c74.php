
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
                                    <?php echo e(@$student_detail->first_name.' '.@$student_detail->last_name); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Admission No.
                                </div>
                                <div class="value">
                                    <?php echo e(@$student_detail->admission_no); ?>

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
                    <?php if(userPermission(13)): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#studentFees" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.fees'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(40)): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#leaves" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.leave'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(14)): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#studentExam" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.exam'); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentOnlineExam" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.online'); ?> <?php echo app('translator')->get('lang.exam'); ?></a>
                    </li>
                    <?php if(userPermission(15)): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Session::get('studentDocuments') == 'active'? 'active':''); ?>" href="#studentDocuments" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.documents'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(19)): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Session::get('studentTimeline') == 'active'? 'active':''); ?> " href="#studentTimeline" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.timeline'); ?></a>
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
                            <h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('lang.transport_and_dormitory_details'); ?></h4>


                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            <?php echo app('translator')->get('lang.dormitory_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e(@$student_detail->dormitory != ""? @$student_detail->dormitory->dormitory_name: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Transport Part -->



                        </div>
                    </div>
                    <!-- End Profile Tab -->

                    <!-- Start Fees Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentFees">
                        <div class="table-responsive">
                            <table  class="display school-table school-table-style table_not_fixed" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th> <?php echo app('translator')->get('lang.fees_group'); ?></th>
                                    <th><?php echo app('translator')->get('lang.fees_code'); ?></th>
                                    <th><?php echo app('translator')->get('lang.due_date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.status'); ?></th>
                                    <th><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                    <th><?php echo app('translator')->get('lang.payment_id'); ?></th>
                                    <th><?php echo app('translator')->get('lang.mode'); ?></th>
                                    <th><?php echo app('translator')->get('lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.discount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                    <th><?php echo app('translator')->get('lang.fine'); ?>(<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                    <th><?php echo app('translator')->get('lang.paid'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                    <th><?php echo app('translator')->get('lang.balance'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    @$grand_total = 0;
                                    @$total_fine = 0;
                                    @$total_discount = 0;
                                    @$total_paid = 0;
                                    @$total_grand_paid = 0;
                                    @$total_balance = 0;
                                ?>
                                <?php $__currentLoopData = $fees_assigneds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                         @$grand_total += @$fees_assigned->feesGroupMaster->amount;
                                       
                                        
                                    ?>

                                    <?php
                                        @$discount_amount = $fees_assigned->applied_discount;
                                        @$total_discount += @$discount_amount;
                                        @$student_id = @$fees_assigned->student_id;
                                    ?>
                                    <?php
                                        @$paid = App\SmFeesAssign::discountSum(@$fees_assigned->student_id, @$fees_assigned->feesGroupMaster->feesTypes->id, 'amount');
                                        @$total_grand_paid += @$paid;
                                    ?>
                                    <?php
                                        @$fine = App\SmFeesAssign::discountSum(@$fees_assigned->student_id, @$fees_assigned->feesGroupMaster->feesTypes->id, 'fine');
                                        @$total_fine += @$fine;
                                    ?>
                                        
                                    <?php
                                        @$total_paid = @$discount_amount + @$paid;
                                    ?>
                                <tr>
                                    <td><?php echo e(@$fees_assigned->feesGroupMaster->feesGroups !=""?@$fees_assigned->feesGroupMaster->feesGroups->name:""); ?></td>
                                    <td><?php echo e(@$fees_assigned->feesGroupMaster->feesTypes!=""?@$fees_assigned->feesGroupMaster->feesTypes->name:""); ?></td>
                                    <td>
                                        <?php if(!empty(@$fees_assigned->feesGroupMaster)): ?>                                                                            
                                        <?php echo e(@$fees_assigned->feesGroupMaster->date != ""? dateConvert(@$fees_assigned->feesGroupMaster->date):''); ?>

                                        <?php endif; ?>
                                    </td>
                                    <?php
                                     $total_payable_amount=$fees_assigned->fees_amount;
                                        $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                        $balance_amount=number_format($rest_amount+$fine, 2, '.', '');
                                        $total_balance +=  $balance_amount;
                                ?>
                                <td>
                                    
                                    <?php if($balance_amount ==0): ?>
                                        <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('lang.paid'); ?></button>
                                    <?php elseif($paid != 0): ?>
                                        <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('lang.partial'); ?></button>
                                    <?php elseif($paid == 0): ?>
                                        <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('lang.unpaid'); ?></button>
                                    <?php endif; ?>
                                    
                                </td>
                                    <td>
                                        <?php
                                        echo number_format($fees_assigned->feesGroupMaster->amount, 2, '.', '');
                                     ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> <?php echo e(@$discount_amount); ?> </td>
                                    <td><?php echo e(@$fine); ?></td>
                                    <td><?php echo e(@$paid); ?></td>
                                    <td>
                                        <?php 
                                            echo @$balance_amount;
                                        ?>
                                    </td>
                                </tr>
                                    <?php 
                                        @$payments = App\SmFeesAssign::feesPayment(@$fees_assigned->feesGroupMaster->feesTypes->id, @$fees_assigned->student_id);
                                        $i = 0;
                                    ?>

                                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right"><img src="<?php echo e(asset('public/backEnd/img/table-arrow.png')); ?>"></td>
                                        <td>
                                            <?php
                                                @$created_by = App\User::find(@$payment->created_by);
                                            ?>
                                            <?php if(@$created_by != ""): ?>
                                            <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo e('Collected By: '.@$created_by->full_name); ?>"><?php echo e(@$payment->fees_type_id.'/'.@$payment->id); ?></a></td>
                                            <?php endif; ?>
                                        <td>
                                            <?php echo e($payment->payment_mode); ?>

                                        </td>
                                        <td class="nowrap">                                                                                
                                        <?php echo e(@$payment->payment_date != ""? dateConvert(@$payment->payment_date):''); ?>

                                        </td>
                                        <td>
                                            <?php echo e(@$payment->discount_amount); ?>

                                        </td>
                                        <td>
                                            <?php echo e(@$payment->fine); ?>

                                            <?php if($payment->fine!=0): ?>
                                            <?php if(strlen($payment->fine_title) > 14): ?>
                                            <spna class="text-danger nowrap" title="<?php echo e($payment->fine_title); ?>">
                                                (<?php echo e(substr($payment->fine_title, 0, 15) . '...'); ?>)
                                            </spna>
                                            <?php else: ?>
                                            <?php if($payment->fine_title==''): ?>
                                            <?php echo e($payment->fine_title); ?>

                                            <?php else: ?>
                                            <spna class="text-danger nowrap">
                                                (<?php echo e($payment->fine_title); ?>)
                                            </spna>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e(@$payment->amount); ?>

                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th><?php echo app('translator')->get('lang.grand_total'); ?> (<?php echo e(@generalSetting()->currency_symbol); ?>)</th>
                                    <th></th>
                                    <th><?php echo e(@$grand_total); ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?php echo e(@$total_discount); ?></th>
                                    <th><?php echo e(@$total_fine); ?></th>
                                    <th><?php echo e(@$total_grand_paid); ?></th>
                                    <th><?php echo e(number_format($total_balance, 2, '.', '')); ?> </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                    <!-- End Profile Tab -->
                    <!-- Start leave Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="leaves">
                        <div class="white-box">
                            <div class="row mt-30">
                                <div class="col-lg-12">
                                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('lang.leave_type'); ?></th>
                                                <th><?php echo app('translator')->get('lang.leave_from'); ?> </th>
                                                <th><?php echo app('translator')->get('lang.leave_to'); ?></th>
                                                <th><?php echo app('translator')->get('lang.apply_date'); ?></th>
                                                <th><?php echo app('translator')->get('lang.status'); ?></th>
                                                <th><?php echo app('translator')->get('lang.action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $diff = ''; ?>
                                        <?php if(count($leave_details)>0): ?>
                                        <?php $__currentLoopData = $leave_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(@$value->leaveType->type); ?></td>
                                            <td>
                                                
                    <?php echo e($value->leave_from != ""? dateConvert($value->leave_from):''); ?>



                                            </td>
                                            <td>
                                            
                    <?php echo e($value->leave_to != ""? dateConvert($value->leave_to):''); ?>


                                            </td>
                                            <td>
                                                
                    <?php echo e($value->apply_date != ""? dateConvert($value->apply_date):''); ?>


                                            </td>
                                            <td>

                                                <?php if($value->approve_status == 'P'): ?>
                                                <button class="primary-btn small bg-warning text-white border-0"> <?php echo app('translator')->get('lang.pending'); ?></button>
                                                <?php endif; ?>

                                                <?php if($value->approve_status == 'A'): ?>
                                                <button class="primary-btn small bg-success text-white border-0"> <?php echo app('translator')->get('lang.approved'); ?></button>
                                                <?php endif; ?>

                                                <?php if($value->approve_status == 'C'): ?>
                                                <button class="primary-btn small bg-danger text-white border-0"> <?php echo app('translator')->get('lang.cancelled'); ?></button>
                                                <?php endif; ?>

                                            </td>
                                            <td>
                                                <a class="modalLink" data-modal-size="modal-md" title="<?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.leave'); ?> <?php echo app('translator')->get('lang.details'); ?>" href="<?php echo e(url('view-leave-details-apply', $value->id)); ?>"><button class="primary-btn small tr-bg"> <?php echo app('translator')->get('lang.view'); ?> </button></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?> 
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo app('translator')->get('lang.not_leaves_data'); ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php endif; ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- End leave Tab -->
                    
                    <!-- Start Exam Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentExam">
                        <?php
                            $exam_count= count($exam_terms); 
                        ?>
                        <?php if($exam_count < 1): ?>
                        <div class="white-box no-search no-paginate no-table-info mb-2">
                           <table class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <?php echo app('translator')->get('lang.subject'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang.full_marks'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang.passing_marks'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang.obtained_marks'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang.results'); ?>
                                        </th>
                                    </tr>
                                </thead>
                           </table>
                        </div>
                        <?php endif; ?>
                        <div class="white-box no-search no-paginate no-table-info mb-2">
                            <?php $__currentLoopData = $exam_terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $get_results = App\SmStudent::getExamResult(@$exam->id, @$student_detail);
                            ?>
                            <?php if($get_results): ?>
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo e(@$exam->title); ?></h3>
                            </div>
                            <?php
                                $grand_total = 0;
                                $grand_total_marks = 0;
                                $result = 0;
                                $temp_grade=[];
                                $total_gpa_point = 0;
                                $total_subject = count($get_results);
                                $optional_subject = 0;
                                $optional_gpa = 0;
                            ?>
                            
                            
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <?php echo app('translator')->get('lang.date'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang.subject'); ?> ( <?php echo app('translator')->get('lang.full_marks'); ?>)
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang.obtained_marks'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang.grade'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang.gpa'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $get_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if((!is_null($optional_subject_setup)) && (!is_null($student_optional_subject))){
                                            if($mark->subject_id != @$student_optional_subject->subject_id){
                                                $temp_grade[]=$mark->total_gpa_grade;
                                            }
                                        }else{
                                            $temp_grade[]=$mark->total_gpa_grade;
                                        }
                                        $total_gpa_point += $mark->total_gpa_point;
                                        if(! is_null(@$student_optional_subject)){
                                            if(@$student_optional_subject->subject_id == $mark->subject->id && $mark->total_gpa_point  < @$optional_subject_setup->gpa_above ){
                                                $total_gpa_point = $total_gpa_point - $mark->total_gpa_point;
                                            }
                                        }
                                        $temp_gpa[]=$mark->total_gpa_point;
                                        $get_subject_marks =  subjectFullMark ($mark->exam_type_id, $mark->subject_id );
                                        
                                        $subject_marks = App\SmStudent::fullMarksBySubject($exam->id, $mark->subject_id);
                                        $schedule_by_subject = App\SmStudent::scheduleBySubject($exam->id, $mark->subject_id, @$student_detail);
                                        $result_subject = 0;
                                        $grand_total_marks += $get_subject_marks;
                                        if(@$mark->is_absent == 0){
                                            $grand_total += @$mark->total_marks;
                                            if($mark->marks < $subject_marks->pass_mark){
                                                $result_subject++;
                                                $result++;
                                            }
                                        }else{
                                            $result_subject++;
                                            $result++;
                                        }
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo e(!empty($schedule_by_subject->date)? dateConvert($schedule_by_subject->date):''); ?>

                                        </td>
                                        <td>
                                            <?php echo e(@$mark->subject->subject_name); ?> (<?php echo e(@subjectFullMark($mark->exam_type_id, $mark->subject_id )); ?>)
                                            
                                        </td>
                                        <td>
                                            <?php echo e(@$mark->total_marks); ?>

                                        </td>
                                        <td>
                                            <?php echo e(@$mark->total_gpa_grade); ?>

                                        </td>
                                        <td>
                                            <?php echo e(number_format(@$mark->total_gpa_point, 2, '.', '')); ?>

                                            
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                
                                </tbody>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <?php echo app('translator')->get('lang.grand_total'); ?>: <?php echo e($grand_total); ?>/<?php echo e($grand_total_marks); ?>

                                        </th>
                                        <th><?php echo app('translator')->get('lang.grade'); ?>: 
                                        <?php
                                            if(in_array($failgpaname->grade_name,$temp_grade)){
                                                echo $failgpaname->grade_name;
                                                }else {
                                                    $final_gpa_point = ($total_gpa_point- $optional_gpa) /  ($total_subject - $optional_subject);
                                                    $average_grade=0;
                                                    $average_grade_max=0;
                                                    if($result == 0 && $grand_total_marks != 0){
                                                        $gpa_point=number_format($final_gpa_point, 2, '.', '');
                                                        if($gpa_point >= $maxgpa){
                                                            $average_grade_max = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                            
                                                            ->where('from', '<=', $maxgpa )
                                                            ->where('up', '>=', $maxgpa )
                                                            ->first('grade_name');

                                                            echo  @$average_grade_max->grade_name;
                                                        } else {
                                                            $average_grade = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                            
                                                            ->where('from', '<=', $final_gpa_point )
                                                            ->where('up', '>=', $final_gpa_point )
                                                            ->first('grade_name');
                                                            echo  @$average_grade->grade_name;  
                                                        }
                                                }else{
                                                    echo $failgpaname->grade_name;
                                                }
                                            }
                                            ?>
                                        </th>
                                        <th> 
                                            <?php echo app('translator')->get('lang.gpa'); ?>
                                            <?php
                                                $final_gpa_point = 0;
                                                $final_gpa_point = ($total_gpa_point - $optional_gpa)/  ($total_subject - $optional_subject);
                                                $float_final_gpa_point=number_format($final_gpa_point,2);
                                                if($float_final_gpa_point >= $maxgpa){
                                                    echo $maxgpa;
                                                }else {
                                                    echo $float_final_gpa_point;
                                                }
                                            ?>
                                        </th>
                                    </tr>
                                    </tfoot>
                            </table>

                            <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <!-- End Exam Tab -->
                    <!-- Start Online Exam Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="studentOnlineExam">
                           
                            <?php
                            $exam_count= count($exam_terms); 
                            ?>
                            <?php if($result_views->count()<1): ?>
                            <div class="white-box no-search no-paginate no-table-info mb-2">
                               <table class="display school-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('lang.title'); ?></th>
                                            <th><?php echo app('translator')->get('lang.time'); ?></th>
                                            <th><?php echo app('translator')->get('lang.total_marks'); ?></th>
                                            <th><?php echo app('translator')->get('lang.obtained_marks'); ?> </th>
                                            <th><?php echo app('translator')->get('lang.result'); ?></th>
                                            <th><?php echo app('translator')->get('lang.status'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                               </table>
                            </div>

                            <?php endif; ?>

                       
                                <div class="white-box no-search no-paginate no-table-info mb-2">
                                    <?php if($result_views->count()<1): ?>
                                        <h4 class="text-center"><?php echo app('translator')->get('lang.result_not_publish_yet'); ?></h4>
                                    <?php endif; ?>
                                    
                                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                        <thead> 
                                            <tr>
                                                <th><?php echo app('translator')->get('lang.title'); ?></th>
                                                <th><?php echo app('translator')->get('lang.time'); ?></th>
                                                <th><?php echo app('translator')->get('lang.total_marks'); ?></th>
                                                <th><?php echo app('translator')->get('lang.obtained_marks'); ?> </th>
                                                <th><?php echo app('translator')->get('lang.result'); ?></th>
                                                <th><?php echo app('translator')->get('lang.status'); ?></th>
                                            </tr>
                                        </thead>
            
                                        <tbody>
                                            <?php $__currentLoopData = $result_views; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                                <tr>
                                                    <td><?php echo e($result_view->onlineExam !=""?@$result_view->onlineExam->title:""); ?></td>
                                                    <td  data-sort="<?php echo e(strtotime(@$result_view->onlineExam->date)); ?>" >
                                                        <?php if(!empty(@$result_view->onlineExam)): ?>
                                                       <?php echo e(@$result_view->onlineExam->date != ""? dateConvert(@$result_view->onlineExam->date):''); ?>

            
            
                                                         <br> <?php echo app('translator')->get('lang.time'); ?>: <?php echo e(@$result_view->onlineExam->start_time.' - '.@$result_view->onlineExam->end_time); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        $total_marks = 0;
                                                        foreach($result_view->onlineExam->assignQuestions as $assignQuestion){
                                                            @$total_marks = $total_marks + @$assignQuestion->questionBank->marks;
                                                        }
                                                        echo @$total_marks;
                                                        ?>
                                                    </td>
                                                    <td><?php echo e(@$result_view->total_marks); ?></td>
                                                    <td>
                                                        <?php
                                                            @$result = @$result_view->total_marks * 100 / @$total_marks;
                                                            if(@$result >= @$result_view->onlineExam->percentage){
                                                                echo "Pass";  
                                                            }else{
                                                                echo "Fail";
                                                            }
                                                        ?>
                                                    </td>
                                                    
                                                    <td>
                                                    <?php
                                                        $startTime = strtotime($result_view->onlineExam->date . ' ' . $result_view->onlineExam->start_time);
                                                        $endTime = strtotime($result_view->onlineExam->date . ' ' . $result_view->onlineExam->end_time);
                                                        $now = date('h:i:s');
                                                        $now =  strtotime("now");
                                                    ?>
                                                    <?php if($now >= $endTime): ?>
                                                    <a class="btn btn-success modalLink" data-modal-size="modal-lg" title="Answer Script"  href="<?php echo e(route('student_answer_script', [@$result_view->online_exam_id, @$result_view->student_id])); ?>" ><?php echo app('translator')->get('lang.answer_script'); ?></a>
                                                            
                                                    <?php else: ?>
                                                        <span class="btn primary-btn small  fix-gr-bg" style="background:blue"><?php echo app('translator')->get('lang.Wait_Till_Exam_Finish'); ?></span>
                                                    <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            
                        </div>
                        <!-- End Online Exam Tab -->
                  
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
                                            <?php if(userPermission(18)): ?>
                                            <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,1)" data-id="1"  href="#">
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
                                        <td class="col-4 d-flex align-items-center">
                                            <?php if(userPermission(17)): ?>
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="<?php echo e(asset($student_detail->document_file_2)); ?>" download><?php echo app('translator')->get('lang.download'); ?></a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            <?php endif; ?>
                                            <?php if(userPermission(18)): ?>
                                                <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,2)" data-id="2"  href="#">
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
                                        <td class="col-4 d-flex align-items-center">
                                            <?php if(userPermission(17)): ?>
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="<?php echo e(asset($student_detail->document_file_3)); ?>" download><?php echo app('translator')->get('lang.download'); ?></a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            <?php endif; ?>
                                            <?php if(userPermission(18)): ?>
                                                <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,3)" data-id="3"  href="#">
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
                                        <td class="col-4 d-flex align-items-center">
                                            <?php if(userPermission(17)): ?>
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="<?php echo e(asset($student_detail->document_file_4)); ?>" download><?php echo app('translator')->get('lang.download'); ?></a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            <?php endif; ?>
                                            <?php if(userPermission(18)): ?>
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
                                    <tr class="d-flex">
                                        <td class="col-2"><?php echo e(@$document->title); ?></td>
                                        <td class="col-6"><?php echo e(showDocument(@$document->file)); ?></td>
                                        <td class="col-4">
                                            <?php if(userPermission(17)): ?>
                                                <a class="primary-btn tr-bg text-uppercase bord-rad" href="<?php echo e(route('student-download-document',showDocument(@$document->file))); ?>">
                                                    Download<span class="pl ti-download"></span>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(@$document->type=='stu'): ?>
                                                <?php if(userPermission(18)): ?>
                                                    <a class="primary-btn icon-only fix-gr-bg" data-toggle="modal" data-target="#deleteDocumentModal<?php echo e(@$document->id); ?>"  href="#">
                                                        <span class="ti-trash"></span>
                                                    </a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a></a>
                                            <?php endif; ?>
                                            
                                           
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteDocumentModal<?php echo e(@$document->id); ?>" >
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
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                        <a class="primary-btn fix-gr-bg" href="<?php echo e(route('delete_document', [@$document->id])); ?>">
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
                    <!-- Start Timeline Tab -->
                    <div role="tabpanel" class="tab-pane fade <?php echo e(Session::get('studentTimeline') == 'active'? 'show active':''); ?>" id="studentTimeline">
                        <div class="white-box">
                            <?php $__currentLoopData = $timelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="student-activities">
                                <div class="single-activity">
                                    <h4 class="title text-uppercase">                                                                            
                                    <?php echo e(@$timeline->date != ""? dateConvert(@$timeline->date):''); ?>

                                    </h4>
                                    <div class="sub-activity-box d-flex">
                                        <h6 class="time text-uppercase"><?php echo e(date('h:i A', strtotime(@$timeline->date))); ?></h6>
                                        <div class="sub-activity">
                                            <h5 class="subtitle text-uppercase"> <?php echo e(@$timeline->title); ?></h5>
                                            <p>
                                                <?php echo e(@$timeline->description); ?>

                                            </p>
                                        </div>

                                        <div class="close-activity">
                                            <?php if(@$timeline->file != ""): ?>
                                            <a href="<?php echo e(route('download-timeline-doc',showDocument(@$timeline->file))); ?>" class="primary-btn tr-bg text-uppercase bord-rad">
                                                Download<span class="pl ti-download"></span>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Timeline Tab -->
                </div>
            </div>
            <!-- End Student Details -->
        </div>

            
    </div>
</section>

<!-- timeline form modal start-->
<div class="modal fade admin-query" id="add_timeline_madal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Timeline</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
               <div class="container-fluid">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_timeline_store',
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
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control" id="startDate" type="text"
                                                 name="date">
                                                <label>Date</label>
                                                <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="Description"></textarea>
                                    <label>Description<span></span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-30">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input" type="text" id="placeholderFileFourName" placeholder="Document"
                                                disabled>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_4">browse</label>
                                            <input type="file" class="d-none" name="document_file_4" id="document_file_4">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                
                                <input type="checkbox" id="currentAddressCheck" class="common-checkbox" name="visible_to_student" value="1">
                                <label for="currentAddressCheck">Visible to this person</label>
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
<!-- timeline form modal end-->


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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\college\resources\views/backEnd/studentPanel/my_profile.blade.php ENDPATH**/ ?>