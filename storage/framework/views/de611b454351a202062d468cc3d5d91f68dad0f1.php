
                       <!-- <?php if(userPermission(410)  ): ?>

                            <li  >
                                <a href="<?php echo e(route('email-settings')); ?>"><?php echo app('translator')->get('lang.email_settings'); ?></a>
                            </li>
                        <?php endif; ?> -->


                       <?php if(userPermission(428)  ): ?>

                                <li  >
                                    <a href="<?php echo e(route('base_setup')); ?>"><?php echo app('translator')->get('lang.base_setup'); ?></a>
                                </li>
                         <?php endif; ?>



                        <!-- <?php if(userPermission(451)  ): ?>

                            <li  >
                                <a href="<?php echo e(route('language-settings')); ?>"><?php echo app('translator')->get('lang.language_settings'); ?></a>
                            </li>
                        <?php endif; ?> -->
                        <?php if(userPermission(456)  ): ?>

                            <li  >
                                <a href="<?php echo e(route('backup-settings')); ?>"><?php echo app('translator')->get('lang.backup_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                        
                       <!-- <?php if(userPermission(444)  ): ?>

                            <li  >
                                <a href="<?php echo e(route('sms-settings')); ?>"><?php echo app('translator')->get('lang.sms_settings'); ?></a>
                            </li>
                        <?php endif; ?> -->
                       

                        <?php if(userPermission(482)  ): ?>
                        <li>
                            <a href="<?php echo e(route('api/permission')); ?>"><?php echo app('translator')->get('lang.api'); ?> <?php echo app('translator')->get('lang.permission'); ?> </a>
                        </li>
                    <?php endif; ?>
<?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/partials/without_saas_school_admin_menu.blade.php ENDPATH**/ ?>