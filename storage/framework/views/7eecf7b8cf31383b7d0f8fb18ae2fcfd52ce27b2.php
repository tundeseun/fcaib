
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lang.exam_attendance'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.exam_attendance'); ?> </h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.examination'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.exam_attendance'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row mb-20">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="main-title sm_mb_20">
                        <h3 class="mb-0"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php if(session()->has('message-success') != ''): ?>
                        <?php if(session()->has('message-success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session()->get('message-success')); ?>

                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_attendance', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="col-lg-4 mt-30-md">
                                <select
                                    class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>"
                                    id="class_subject" name="class">
                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>"
                                            <?php echo e(isset($class_id) ? ($class_id == $class->id ? 'selected' : '') : ''); ?>>
                                            <?php echo e($class->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-4 mt-30-md" id="select_class_subject_div">
                                <select
                                    class="w-100 bb niceSelect form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?> select_class_subject"
                                    id="select_class_subject" name="subject">
                                    <option data-display="<?php echo app('translator')->get('lang.select_subject'); ?> *" value=""><?php echo app('translator')->get('lang.select_subject'); ?> *</option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_class_subject_loader">
                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>"
                                        alt="loader">
                                </div>
                                <?php if($errors->has('subject')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('subject')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-4 mt-30-md" id="m_select_subject_section_div">
                                <select
                                    class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> m_select_subject_section"
                                    id="m_select_subject_section" name="section">
                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> " value=" "><?php echo app('translator')->get('lang.select_section'); ?> </option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_section_loader">
                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>"
                                        alt="loader">
                                </div>
                                <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    <?php echo app('translator')->get('lang.search'); ?>
                                </button>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
            <?php if(isset($exam_attendance)): ?>
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-primary mx-3" id="downloadBtn"><i class="fa fa-download"></i> Download</button>
                    <a class="btn btn-outline-primary mx-3" href="javascript:void(0)" id="printBtn">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
                <div class="row mt-40" id="printSection">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class=" bg-white p-3">
                                    <div width="100%">
                                        <h3><big>Exam Attendance Sheet</big><br />Department:
                                            <?php echo e($class_name); ?><br />Course: <?php echo e($subject->subject_name); ?><br />Course
                                            Code: <?php echo e(strtoupper($subject->subject_code)); ?><br />Level: <?php echo e($section_name); ?>

                                        </h3>
                                    </div>
                                    <table class="table" cellspacing="0" width="100%">

                                        <thead>
                                            <?php if(session()->has('message-danger') != ''): ?>
                                                <tr width="100%">
                                                    <td colspan="9">
                                                        <?php if(session()->has('message-danger')): ?>
                                                            <div class="alert alert-danger">
                                                                <?php echo e(session()->get('message-danger')); ?>

                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <th class="border p-3">Matric Number</th>
                                                <th class="border p-3">Photo</th>
                                                <th class="border p-3"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                                <th class="border p-3">Student Signature</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $__currentLoopData = $exam_attendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>

                                                    <td class="border p-3">
                                                        <?php echo e(@$student->matric_number != '' ? @$student->matric_number : ''); ?><input
                                                            type="hidden" name="id[]"
                                                            value="<?php echo e(@$student->student_id); ?>"></td>
                                                    <td class="border p-3"><img
                                                            src="<?php echo e(@$student->student_photo ?? asset('public/uploads/staff/demo/staff.jpg')); ?>"
                                                            width="80px" height="80px"></td>
                                                    <td class="border p-3">
                                                        <?php echo e(ucwords($student->first_name . ' ' . @$student->last_name)); ?>

                                                    </td>
                                                    <td class="border p-3">

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const printBtn = $('#printBtn');
        const downloadBtn = $('#downloadBtn');
        printBtn.on('click', function() {
            let data = $('#printSection');
            const printWindow = window.print(data);
            printWindow.document.write(data.html());

        })

        downloadBtn.on('click', function() {
            $(this).attr('disabled', true)
            const element = document.getElementById('printSection');
            html2pdf(element);
            setTimeout(() => {
                $(this).attr('disabled', false)
            }, 2000);
        })
    })
</script>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/examination/exam_attendance.blade.php ENDPATH**/ ?>