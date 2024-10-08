
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.class_time_setup'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Documents/Forms Upload</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.academics'); ?></a>
                <a href="#">Documents/Forms Upload</a>
            </div>
        </div>
    </div>
</section>
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
            <th class="col-3"><?php echo app('translator')->get('lang.title'); ?></th>
            <th class="col-4"><?php echo app('translator')->get('lang.name'); ?></th>
            <th class="col-2">Purpose</th>
            <th class="col-3"><?php echo app('translator')->get('lang.action'); ?></th>
        </tr>
        </thead>

        <tbody class="d-block">

        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="d-flex">
                <td class="col-3"><?php echo e($document->title); ?></td>
                <td class="col-4"><?php echo e(showDocument($document->file)); ?></td>
                <td class="col-2"><?php echo e($document->purpose); ?></td>
                <td class="col-3">
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
<div class="modal fade admin-query" id="add_document_madal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.document'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add-document',
                                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                    <div class="row">
                        <div class="col-lg-12">
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
                        <div class="col-lg-12">
                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control" name="purpose" >
                                            <option data-display="Select Purpose" value="">Select Purpose</option>
                                            <option value="First Year Clearance">First Year Clearance</option>
                                            <option value="Final Year Clearance">Final Year Clearance</option>
                                            <option value="Others">Others</option>
                                        </select>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/academics/documents.blade.php ENDPATH**/ ?>