<style type="text/css">
    .bank-details p, .cheque-details p{
        margin:0 !important;
    }
</style>
<?php if(@$method['bank_info']->active_status == 1): ?>
<style type="text/css">

    .cheque-details{
        display: none;
    }

</style>
<?php elseif(@$method['cheque_info']->active_status == 1): ?>
<style type="text/css">

    .bank-details{
        display: none;
    }
    
</style>
<?php endif; ?>
<div class="container-fluid">
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'child-bank-slip-store','method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm', 'onsubmit' => "return validateFormFees()"])); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="row mt-25">
                    <div class="col-lg-12">
                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control read-only-input has-content" id="startDate" type="text"
                                         name="date" value="<?php echo e(isset($fees_payment)? date('m/d/Y', strtotime($fees_payment->date)) : date('m/d/Y')); ?>" readonly>
                                        <label><?php echo app('translator')->get('lang.date'); ?></label>
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
                </div>
                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                
                <input type="hidden" name="assign_id" id="assign_id" value="<?php echo e($assign_id); ?>">
                <input type="hidden" name="real_amount" id="real_amount" value="<?php echo e($amount); ?>">
                <input type="hidden" name="student_id" value="<?php echo e($student_id); ?>">
                <input type="hidden" name="class_id" value="<?php echo e($std_info->class_id); ?>">
                <input type="hidden" name="section_id" value="<?php echo e($std_info->section_id); ?>">
                <input type="hidden" name="fees_type_id" value="<?php echo e($fees_type_id); ?>">

                <div class="row mt-25">
                    <div class="col-lg-12" id="sibling_class_div">
                        <div class="input-effect">
                            <input class="primary-input form-control read-only-input has-content" type="number" name="amount" max="<?php echo e(isset($fees_payment)? $fees_payment->amount: $amount); ?>" min="0" value="<?php echo e(isset($fees_payment)? $fees_payment->amount: $amount); ?>" id="amount" required>
                            <label><?php echo app('translator')->get('lang.amount'); ?> <span>*</span> </label>
                            <?php if($errors->has('amount')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('amount')); ?></strong>
                            </span>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
                <div class="row mt-25" id="fine_title" style="display:none">
                    <div class="col-lg-12">
                        <div class="input-effect">
                            <input class="primary-input form-control"  type="text" name="fine_title" >
                            <label><?php echo app('translator')->get('lang.fine'); ?> <?php echo app('translator')->get('lang.title'); ?> <span>*</span> </label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                </div>
                <script>
                function checkFine(){
                    var fine_amount=document.getElementById("fine_amount").value;
                    var fine_title=document.getElementById("fine_title");
                    if (fine_amount>0) {
                        fine_title.style.display = "block";
                    } else {
                        fine_title.style.display = "none";
                    }
                }
                </script>
                <div class="row mt-50">
                    <div class="col-lg-3">
                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.payment'); ?> <?php echo app('translator')->get('lang.mode'); ?> *</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex radio-btn-flex ml-40">
                            <?php if(@$method['bank_info']->active_status == 1): ?>
                            <div class="mr-30">
                                <input type="radio" name="payment_mode" id="cash" value="bank" class="common-radio relationButton" onclick="relationButton('Bk')" <?php echo e(@$method['bank_info']->active_status == 1? 'checked':''); ?>>
                                <label for="cash"><?php echo app('translator')->get('lang.bank'); ?></label>
                            </div>
                            <?php endif; ?>
                            <?php if(@$method['cheque_info']->active_status == 1): ?>
                            <div class="mr-30">
                                <input type="radio" name="payment_mode" id="cheque" value="cheque" class="common-radio relationButton"  onclick="relationButton('Cq')" <?php echo e(@$method['bank_info']->active_status != 1? 'checked':''); ?>>
                                <label for="cheque"><?php echo app('translator')->get('lang.cheque'); ?></label>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row mt-50" id="feesBankPayment">
                    <div class="col-lg-3">
                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.bank'); ?>*</p>
                    </div>
                    <div class="col-lg-9">
                        <div class="input-effect">
                            <select class="niceSelect1 w-100 bb form-control<?php echo e($errors->has('bank_id') ? ' is-invalid' : ''); ?>" name="bank_id">
                            <?php if(isset($banks)): ?>
                            <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->bank_name); ?> (<?php echo e($value->account_name); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </select>
                            <span class="focus-border"></span>
                            <?php if($errors->has('bank_id')): ?>
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e($errors->first('bank_id')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
               
               <div class="row">
                <?php if(isset($data['bank_info'])): ?>
                <div class="col-md-6 bank-details" id="bank-area">
                  <strong><?php echo $data['bank_info']->bank_details; ?></strong>
                </div>
                <?php endif; ?> 
                <?php if(isset($data['cheque_info'])): ?>
                <div class="col-md-6 cheque-details" id="cheque-area">
                    <strong><?php echo $data['cheque_info']->cheque_details; ?></strong>
                </div>
               </div>
               <?php endif; ?>
               
                <div class="row mt-25">
                    <div class="col-lg-12" id="sibling_name_div">
                        <div class="input-effect mt-20">
                            <textarea class="primary-input form-control" cols="0" rows="3" name="note" id="note"><?php echo e(isset($fees_payment)?$fees_payment->note:''); ?></textarea>
                            <label><?php echo app('translator')->get('lang.note'); ?> </label>
                            <span class="focus-border textarea"></span>
                        </div>
                    </div>
                </div>
                    <div class="row no-gutters input-right-icon mt-35">
                        <div class="col">
                            <div class="input-effect">
                                <input class="primary-input" id="placeholderInput" type="text"
                                       placeholder="<?php echo e(isset($visitor)? ($visitor->file != ""? getFilePath3($visitor->file):'File Name'):'File Name'); ?>"
                                       readonly>
                                <span class="focus-border"></span>
                                <?php if($errors->has('file')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e(@$errors->first('file')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="primary-btn-small-input" type="button">
                                <label class="primary-btn small fix-gr-bg"
                                       for="browseFile"><?php echo app('translator')->get('lang.browse'); ?></label>
                                <input type="file" class="d-none" id="browseFile" name="slip">
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
                    <button type="button" class="primary-btn tr-bg submit" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                    <button class="primary-btn fix-gr-bg" type="submit">
                        <?php if(!isset($fees_payment)): ?>
                        <?php echo app('translator')->get('lang.save'); ?> 
                        <?php else: ?>
                        <?php echo app('translator')->get('lang.update'); ?>
                        <?php endif; ?>
                        <?php echo app('translator')->get('lang.information'); ?>
                    </button>
                </div>
            </div>
        </div>
    <?php echo e(Form::close()); ?>

</div>
<script type="text/javascript">
        relationButton = (status) => {
            var cheque_area = document.getElementById("cheque-area");
            var bank_area = document.getElementById("bank-area");
            if(status == "Bk"){
                cheque_area.style.display = "none";
                bank_area.style.display = "block";
                $("#feesBankPayment").show();
            }else if(status == "Cq"){
                cheque_area.style.display = "block";
                bank_area.style.display = "none";
                $("#feesBankPayment").hide();
            }
        }

    $("#search-icon").on("click", function() {
        $("#search").focus();
    });

    $("#start-date-icon").on("click", function() {
        $("#startDate").focus();
    });

    $("#end-date-icon").on("click", function() {
        $("#endDate").focus();
    });

    $(".primary-input.date").datepicker({
        autoclose: true,
        setDate: new Date(),
    });
    $(".primary-input.date").on("changeDate", function(ev) {
        // $(this).datepicker('hide');
        $(this).focus();
    });

    $(".primary-input.time").datetimepicker({
        format: "LT",
    });

    var fileInput = document.getElementById("browseFile");
    if (fileInput) {
        fileInput.addEventListener("change", showFileName);

        function showFileName(event) {
            var fileInput = event.srcElement;
            var fileName = fileInput.files[0].name;
            document.getElementById("placeholderInput").placeholder = fileName;
        }
    }
    var fileInp = document.getElementById("browseFil");
    if (fileInp) {
        fileInp.addEventListener("change", showFileName);

        function showFileName(event) {
            var fileInp = event.srcElement;
            var fileName = fileInp.files[0].name;
            document.getElementById("placeholderIn").placeholder = fileName;
        }
    }

    if ($(".niceSelect1").length) {
        $(".niceSelect1").niceSelect();
    }
</script>
<?php /**PATH C:\xampp\htdocs\infix\resources\views/backEnd/studentPanel/fees_generate_modal_child.blade.php ENDPATH**/ ?>