
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.invoice'); ?> <?php echo app('translator')->get('lang.settings'); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>

    /* .copyPaper {
       display: none!important;
    } */
    .copyPaperShow {
        display: show;
    }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?> 

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.invoice'); ?> <?php echo app('translator')->get('lang.settings'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.bulk_print'); ?></a>   
                <a href="#"><?php echo app('translator')->get('lang.invoice'); ?> <?php echo app('translator')->get('lang.settings'); ?> </a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <form action="<?php echo e(route('invoice-settings-update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="white-box">
                            <div class="row p-0">
                                <div class="col-lg-12">
                                    <h3 class="text-center"><?php echo app('translator')->get('lang.invoice'); ?> <?php echo app('translator')->get('lang.settings'); ?></h3>
                                    <hr>
                                   


<input type="hidden" name="id" value="<?php echo e($invoiceSettings->id ?? ''); ?>">
<input class="primary-input form-control<?php echo e($errors->has('prefix') ? ' is-invalid' : ''); ?>" type="text" name="prefix" id="prefix" value="<?php echo e($invoiceSettings->prefix ?? ''); ?>">

                                    <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-3 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.showing'); ?>  <?php echo app('translator')->get('lang.page'); ?> (<?php echo app('translator')->get('lang.part'); ?>)</p>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="d-flex radio-btn-flex"> 
                                                   
                                                        
                                                        <div class="mr-30">
    <input type="checkbox" name="copy_s_per_th" id="c_part1" class="common-radio relationButton copy_per_th" <?php echo e(isset($invoiceSettings) && $invoiceSettings->c_signature_p == 1 ? 'checked' : ''); ?>>
    <label for="c_part1" id="copys"><?php echo e(isset($invoiceSettings) ? $invoiceSettings->copy_s : ''); ?></label>
</div>

                                                        
                                                        
                                                  
                                                        
                                                        
                                                        <div class="mr-30">
    <input type="checkbox" name="copy_c_per_th" id="c_part2" class="common-radio relationButton copy_per_th" <?php echo e(isset($invoiceSettings) && $invoiceSettings->c_signature_c == 1 ? 'checked' : ''); ?>>
    <label for="c_part2" id="copyc"><?php echo e(isset($invoiceSettings) ? $invoiceSettings->copy_c : ''); ?></label>
</div>

                                                        
                                                        
                                                        
                                                        <div class="mr-30">
    <input type="checkbox" name="copy_o_per_th" id="c_part3" class="common-radio relationButton copy_per_th" <?php echo e(isset($invoiceSettings) && $invoiceSettings->c_signature_o == 1 ? 'checked' : ''); ?>>
    <label for="c_part3" id="copyo"><?php echo e(isset($invoiceSettings) ? $invoiceSettings->copy_o : ''); ?></label>
</div>

                                                        
                                                    </div>
                                            
                                                <?php if($errors->has('per_th')): ?>
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong><?php echo e(@$errors->first('per_th')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                      
                                            <div class="col-lg-6">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                              
                                                  
                                                    
                                                    <input class="primary-input form-control<?php echo e($errors->has('prefix') ? ' is-invalid' : ''); ?>" type="text" name="prefix" id="prefix" value="<?php echo e(isset($invoiceSettings) ? $invoiceSettings->prefix : ''); ?>">

                                                    <label><?php echo app('translator')->get('lang.invoice'); ?> <?php echo app('translator')->get('lang.prefix'); ?> ( <?php echo app('translator')->get('lang.format_standard_three_character'); ?> )<span></span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('prefix')): ?>
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong><?php echo e($errors->first('prefix')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                  
                                            
                                                 </div>

                                             </div>
                                    </div>

                                 

                                    <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                               <input class="primary-input form-control<?php echo e($errors->has('signature_p') ? ' is-invalid' : ''); ?>" type="text" name="footer_1" value="<?php echo e(isset($invoiceSettings) ? $invoiceSettings->footer_1 : ''); ?>">

                                                <label><?php echo app('translator')->get('lang.signature'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('signature_p')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('signature_p')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.is_showing'); ?> <?php echo app('translator')->get('lang.signature'); ?>  </p>
                                                </div>
                                                <div class="col-lg-7">
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                  <input type="radio" name="signature_p" id="signature_p_on" value="1" class="common-radio relationButton" <?php echo e(isset($invoiceSettings) && $invoiceSettings->signature_p == 1 ? 'checked' : ''); ?>>

                                                                    <label for="signature_p_on"><?php echo app('translator')->get('lang.yes'); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                   <input type="radio" name="signature_p" id="signature_p_on" value="1" class="common-radio relationButton" <?php echo e(isset($invoiceSettings) && $invoiceSettings->signature_p == 1 ? 'checked' : ''); ?>>
                                                                    <label for="participant_video"><?php echo app('translator')->get('lang.no'); ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-40 mt-40">

                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                               <input class="primary-input form-control<?php echo e($errors->has('footer_2') ? ' is-invalid' : ''); ?>" type="text" name="footer_2" value="<?php echo e($invoiceSettings ? $invoiceSettings->footer_2 : ''); ?>">

                                                <label><?php echo app('translator')->get('lang.signature'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('footer_2')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('footer_2')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.is_showing'); ?> <?php echo app('translator')->get('lang.signature'); ?> </p>
                                                </div>
                                                <div class="col-lg-7">
                                                        <div class=" radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="signature_c" id="signature_c" value="1" class="common-radio relationButton" <?php echo e(isset($invoiceSettings) && $invoiceSettings->signature_c == 1 ? 'checked' : ''); ?>>

                                                                    <label for="signature_c"><?php echo app('translator')->get('lang.yes'); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="signature_c" id="join_before_host" value="0" class="common-radio relationButton"  <?php echo e(isset($invoiceSettings) && $invoiceSettings->signature_c==0 ? 'checked':''); ?>>
                                                                    <label for="join_before_host"><?php echo app('translator')->get('lang.no'); ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control<?php echo e($errors->has('footer_3') ? ' is-invalid' : ''); ?>" type="text"  name="footer_3" value="<?php echo e($invoiceSettings ? $invoiceSettings->footer_3 : ''); ?>">
                                                <label><?php echo app('translator')->get('lang.signature'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('footer_3')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('footer_3')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.is_showing'); ?> <?php echo app('translator')->get('lang.signature'); ?></p>
                                                </div>
                                                <div class="col-lg-7">
                                                        <div class=" radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="signature_o" id="signature_o_on" value="1" class="common-radio relationButton"  <?php echo e(isset($invoiceSettings) && $invoiceSettings->signature_o==1 ? 'checked':''); ?> >
                                                                    <label for="signature_o_on"><?php echo app('translator')->get('lang.yes'); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="signature_o" id="waiting_room" value="0" class="common-radio relationButton"  <?php echo e(isset($invoiceSettings) && $invoiceSettings->signature_o==0 ? 'checked':''); ?> >
                                                                    <label for="waiting_room"><?php echo app('translator')->get('lang.no'); ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row mb-40 mt-40">

                                        <div class="col-lg-4">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                               <input class="primary-input form-control<?php echo e($errors->has('copy_s') ? ' is-invalid' : ''); ?>" type="text" name="copy_s" id="copy_s" value="<?php echo e(isset($invoiceSettings) ? $invoiceSettings->copy_s : ''); ?>">

                                                <label><?php echo app('translator')->get('lang.copy'); ?> <?php echo app('translator')->get('lang.for'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('copy_s')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('copy_s')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control<?php echo e($errors->has('copy_s') ? ' is-invalid' : ''); ?>" type="text" name="copy_o" id="copy_o" value="<?php echo e(isset($invoiceSettings) ? $invoiceSettings->copy_o  : ''); ?>">
                                                <label><?php echo app('translator')->get('lang.copy'); ?> <?php echo app('translator')->get('lang.for'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('copy_s')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('copy_s')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control<?php echo e($errors->has('copy_c') ? ' is-invalid' : ''); ?>" type="text" name="copy_c"  id="copy_c" value="<?php echo e(isset($invoiceSettings) ? $invoiceSettings->copy_c  : ''); ?>">
                                                <label><?php echo app('translator')->get('lang.copy'); ?> <?php echo app('translator')->get('lang.for'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('copy_s')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('copy_c')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>                                  

                                    <div class="row mb-40 mt-40">

                                       
                                     
                                    </div>



                                    <?php if(userPermission(570)): ?>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" id="_submit_btn_admission">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.update'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php $__env->startSection('script'); ?>
<script>
        
    $(document).ready(function(){
        $(document).on('change','.per_th',function(){
            let per_th = $(this).val();     
            // alert(per_th);       
            // $(".copyPaper").show();
            $('#copyPaperShow').addClass('copyPaperShow');
             $('#copyPaperShow').removeClass('copyPaper');
        
        })      
      
    })

    $(document).on("keyup", "#copy_s", function(event) {
        let titleValue = $(this).val();
        $("#copys").html(titleValue);
    });
    $(document).on("keyup", "#copy_c", function(event) {
        let titleValue = $(this).val();
        $("#copyc").html(titleValue);
    });
    $(document).on("keyup", "#copy_o", function(event) {
        let titleValue = $(this).val();
        $("#copyo").html(titleValue);
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/Modules/BulkPrint/Resources/views/feesCollection/invoice_settings.blade.php ENDPATH**/ ?>