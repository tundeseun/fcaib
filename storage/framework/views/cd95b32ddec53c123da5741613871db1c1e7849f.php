
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.item_store'); ?> <?php echo app('translator')->get('lang.list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.item_store'); ?> <?php echo app('translator')->get('lang.list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.inventory'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.item_store'); ?> <?php echo app('translator')->get('lang.list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($editData)): ?>
         <?php if(userPermission(325)): ?>
           
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('item-store')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
       <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($editData)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.item_store'); ?>
                            </h3>
                        </div>
                        <?php if(isset($editData)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('item-store-update',$editData->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                         <?php if(userPermission(325)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'item-store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <?php if(session()->has('message-success')): ?>
                                    <div class="alert alert-success mb-20">
                                        <?php echo e(session()->get('message-success')); ?>

                                    </div>
                                    <?php elseif(session()->has('message-danger')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session()->get('message-danger')); ?>

                                    </div>
                                    <?php endif; ?>

                                    <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('store_name') ? ' is-invalid' : ''); ?>"
                                            type="text" name="store_name" autocomplete="off" value="<?php echo e(isset($editData)? $editData->store_name : ''); ?>">
                                            <label> <?php echo app('translator')->get('lang.store_name'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('store_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('store_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                     <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input oninput="numberCheckWithDot(this)" class="primary-input form-control<?php echo e($errors->has('store_no') ? ' is-invalid' : ''); ?>"
                                            type="text" name="store_no" autocomplete="off" value="<?php echo e(isset($editData)? $editData->store_no : ''); ?>">
                                            <label> <?php echo app('translator')->get('lang.number'); ?> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('store_no')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('store_no')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                     <div class="col-lg-12 mb-20">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4" name="description" id="description"><?php echo e(isset($editData) ? $editData->description : ''); ?></textarea>
                                    <label> <?php echo app('translator')->get('lang.description'); ?> <span></span> </label>
                                    <span class="focus-border textarea"></span>

                                </div>
                            </div>

                                </div>
                                	  <?php 
                                  $tooltip = "";
                                  if(userPermission(325)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">

                                            <span class="ti-check"></span>
                                            <?php if(isset($editData)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
             
          <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0"><?php echo app('translator')->get('lang.item_store'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <td colspan="4">
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
                            <th><?php echo app('translator')->get('lang.store_name'); ?></th>
                            <th><?php echo app('translator')->get('lang.no'); ?></th>
                            <th><?php echo app('translator')->get('lang.description'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(isset($itemstores)): ?>
                        <?php $__currentLoopData = $itemstores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($value->store_name); ?></td>
                            <td><?php echo e($value->store_no); ?></td>
                            <td><?php echo e($value->description); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <?php echo app('translator')->get('lang.select'); ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <?php if(userPermission(326)): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('item-store-edit',@$value->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                    <?php endif; ?>
                                    <?php if(userPermission(327)): ?>
                                        <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Store" href="<?php echo e(route('delete-store-view',$value->id)); ?>"><?php echo app('translator')->get('lang.delete'); ?></a>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/inventory/itemStoreList.blade.php ENDPATH**/ ?>