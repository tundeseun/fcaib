
<?php $__env->startSection('title'); ?>
Transcript Application Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    .form-control{
        margin-top: 8px;
    }
    label{
        margin-top: 8px;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Transcript Application Details</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('transcript',$transcript->id)); ?>">Transcript Application Details</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="white-box">
                <h4 class="stu-sub-head">Applicants Information</h4>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Fullname
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->names); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Email Address
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->email); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Phone Number
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->phone_number); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Nationality
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->nationality); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="stu-sub-head mt-20">Applicants Educational Information</h4>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Department
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->department); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Entry Year
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->entry_year); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Applicant's Graduation Year
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->graduation_year); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="stu-sub-head mt-20">Intended Institution Details</h4>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's Name
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->institution_name); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's Address
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->institution_address); ?>

                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's Country
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->institution_country); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's email
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->institution_email); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                               Institution's Receiving Office/Officer
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">                                                                                
                            <?php echo e(@$transcript->institution_office); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-30">
                    <a href="<?php echo e(route('student-result', $transcript->student_id)); ?>" class="btn btn-sm btn-primary text-white m-2"><span class="ti-eye"></span> View Results</a>
                    <?php if($transcript->status == 0): ?>
                    <a href="<?php echo e(route('transcript-treated', $transcript->id)); ?>" class="btn btn-sm btn-primary text-white m-2"><span class="ti-check"></span> Mark as Treated</a>
                    <?php else: ?>
                    <a href="<?php echo e(route('transcript-untreated', $transcript->id)); ?>" class="btn btn-sm btn-primary text-white m-2"><span class="ti-check"></span> Mark as Untreated</a>
                    <?php endif; ?>
                    <?php if($transcript->ssce !== null): ?>
                    <a class="btn btn-sm btn-primary text-white m-2" target="_blank" href="<?php echo e(url($transcript->ssce)); ?>">View Applicants SSCE Result</a>
                    <?php endif; ?>
                    <?php if($transcript->statement !== null): ?>
                    <a class="btn btn-sm btn-primary text-white m-2" target="_blank" href="<?php echo e(url($transcript->statement)); ?>">View Applicants Statement of Result</a>
                    <?php endif; ?>
                    <a class="btn btn-sm btn-primary text-white m-2" href="<?php echo e(route('generate-transcript', $transcript->id)); ?>"><span class="ti-printer"></span> Generate Transcript</a>
                </div>
            </div>
    </div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/studentPanel/transcript_single.blade.php ENDPATH**/ ?>