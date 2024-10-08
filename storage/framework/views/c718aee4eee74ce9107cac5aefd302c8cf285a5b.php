
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Upload Result</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#">Upload Result</a>
            </div>
        </div>
    </div>
</section>

<?php if(isset($students)): ?>
<section class="mt-20">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <div class="bg-white p-3">
                    <h3 class="mb-3">
                             Course Title : <b><?php echo e($course_details->subject_name); ?></b><hr/>
                             Course Code : <b><?php echo e(strtoupper($course_details->subject_code)); ?></b><hr/>
                             Credit Unit(s) : <b id="units"><?php echo e($course_details->units); ?></b><hr/>
                    </h3>
                    <table class="table table-condensed table-hover" cellspacing="0" width="100%" style="box-shadow: none;">
                        <thead>
                            <tr>
                                <th class="col-2 pl-2">Admission No.</th>
                                <th class="col-4">Student Names</th>
                                <th class="col-2">Total Score (CA + Exam)</th>
                                <th class="col-2">Grade</th>
                                <th class="col-2">Remark</th>
                            </tr>

                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="pl-2"><?php echo e($student->id); ?></td>
                                <td><?php echo e($student->full_name); ?></td>
                                <td>
                                    <input type="number" name="score" class="form-control primary-input" id="score__<?php echo e($student->cid); ?>" value="<?php echo e($student->score); ?>" oninput="update_result(<?php echo e($student->cid); ?>)" min="0">
                                </td>
                                <td>
                                    <span id="grade__<?php echo e($student->cid); ?>" class="font-weight-bold"><?php echo e($student->grade); ?></span>
                                </td>
                                <td>
                                    <span id="remark__<?php echo e($student->cid); ?>" class="font-weight-bold"><?php echo e($student->remark); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <a href="<?php echo e(route('course-list')); ?>" class="btn btn-primary"><span class="ti-check"></span> Done </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>



<?php $__env->stopSection(); ?>
<script type="text/javascript">
    function update_result(cid){
            var score = '#score__'+cid;
            var grade = '#grade__'+cid;
            var remark = '#remark__'+cid;
            var units = $('#units').html();
            score = parseInt($(score).val());

            $.ajax({
                url:("<?php echo e(route('update-score')); ?>"),
                type: "POST",
                data:{
                    "cid": cid,
                    'score': score,
                    'units': units
                },
                success:function(response)
                {
                    $(grade).html(response.grade);
                    $(remark).html(response.remark);

                }
            });

    }
</script>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/teacherPanel/upload_results.blade.php ENDPATH**/ ?>