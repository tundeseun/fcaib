<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo e(asset('/')); ?>/public/backEnd/css/report/bootstrap.min.css">
    <title><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.fees'); ?></title>
  <style>
    *{
      margin: 0;
      padding: 0;
    }
    body{
      font-size: 12px;
      font-family: 'Poppins', sans-serif;
    }
    .student_marks_table{
      width: 95%;
      margin: 10px auto 0 auto;
    }
    .text_center{
      text-align: center;
    }
    p{
      margin: 0;
      font-size: 12px;
      text-transform: capitalize;
    }
    ul{
      margin: 0;
      padding: 0;
    }
    li{
      list-style: none;
    }
    td {
    border: 1px solid #726E6D;
    padding: .3rem;
    text-align: center;
  }
  th{
    border: 1px solid #726E6D;
    text-transform: capitalize;
    text-align: center;
    padding: .5rem;
  }
  thead{
    font-weight:bold;
    text-align:center;
    color: #222;
    font-size: 10px
  }
  .custom_table{
    width: 100%;
  }
  table.custom_table thead th {
    padding-right: 0;
    padding-left: 0;
  }
  table.custom_table thead tr > th {
    border: 0;
    padding: 0;
}
table.custom_table thead tr th .fees_title{
  font-size: 12px;
  font-weight: 600;
  border-top: 1px solid #726E6D;
  padding-top: 10px;
  margin-top: 10px;
}
.border-top{
  border-top: 0 !important;
}
  .custom_table th ul li {
    display: flex;
    justify-content: space-between;
  }
  .custom_table th ul li p {
    margin-bottom: 5px;
    font-weight: 500;
    font-size: 12px;
}
tbody td p{
  text-align: right;
}
tbody td{
  padding: 0.3rem;
}
table{
  border-spacing: 10px;
  width: 95%;
  margin: auto;
}
.fees_pay{
  text-align: center;
}
.border-0{
  border: 0 !important;
}
.copy_collect{
  text-align: center;
  font-weight: 500;
  color: #000;
}

.copyies_text{
  display: flex;
  justify-content: space-between;
  margin: 10px 0;
}
.copyies_text li{
  text-transform: capitalize;
  color: #000;
  font-weight: 500;
  border-top: 1px dashed #ddd;
}
.school_name{
  font-size: 14px;
  font-weight: 600;
  }
  .print_btn{
    float:right;
    padding: 20px;
    font-size: 12px;
  }
  .fees_book_title{
    display: inline-block;
    width: 100%;
    text-align: center;
    font-size: 12px;
    margin-top: 5px;
    border-top: 1px solid #ddd;
    padding: 5px;
  }
.footer{
  width: 95%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  position: fixed;
  bottom: 30px;
  margin: auto;
  left: 0;
  right: 0;
}
.footer .footer_widget{
  width: 30%;
}
.footer .footer_widget .copyies_text{
  justify-content: space-between;
}
</style>
<style type="text/css" media="print">
    @page  { size: A4 landscape; }
  </style>
  </head>
  <script>
    var is_chrome = function () { return Boolean(window.chrome); }
      if(is_chrome){
          //  window.print();
          //  setTimeout(function(){window.close();}, 10000);
           //give them 10 seconds to print, then close
        }else{
           window.print();
        }
  </script>
  <body onLoad="loadHandler();">
        <?php  
          $setting = generalSetting();
        ?>
      <div class="student_marks_table print" >
      <table class="custom_table">
        <thead>
          <tr>
            <!-- first header  -->
            <th colspan="2">
              <div style="float:left; width:30%">
                      <?php if(file_exists($setting->logo)): ?>
                      <img src="<?php echo e(url($setting->logo)); ?>" style="width:100px; height:auto"   alt="">
                    <?php endif; ?>
              </div>
              <div style="float:right; width:70%; text-aligh:left">
                      <h4 class="school_name"><?php echo e($setting->school_name); ?></h4>
                      <p><?php echo e($setting->address); ?></p>
              </div>
                <h4 class="fees_book_title" style="display:inline-block"></h4>
              <ul>
                <li>
                  <p>
                    Matric Number: <?php echo e(@$student->matric_number); ?>

                  </p> 
                  <p>
                    <?php echo app('translator')->get('lang.date'); ?>: <?php echo e(date('d/m/Y')); ?>

                  </p>
                </li>
                <li>
                  <p>
                    <?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.name'); ?>: <?php echo e(@$student->full_name); ?> 
                  </p>
                </li>
                <li>
                  <p>
                    <?php echo app('translator')->get('lang.class'); ?>: <?php echo e(@$student->class->class_name); ?>

                  </p> 
                  <p>
                    <?php echo app('translator')->get('lang.roll'); ?>:<?php echo e(@$student->roll_no); ?>

                  </p>
                </li>
                <li>
                  <p>
                    <?php echo app('translator')->get('lang.section'); ?>: <?php echo e(@$student->section->section_name); ?>

                  </p> 
                  <p>
                  <?php echo app('translator')->get('lang.group'); ?>: ___
                  </p>
                </li>
              </ul>
            </th>
            <!-- space  -->
            <th class="border-0" rowspan="9"></th>

            <!-- 2nd header  -->
            <th colspan="2">
                  <div style="float:left; width:30%">
                    <?php if(file_exists($setting->logo)): ?>
                      <img src="<?php echo e(url($setting->logo)); ?>" style="width:100px; height:auto"   alt="">
                    <?php endif; ?>
                  </div>
                  <div style="float:right; width:70%; text-aligh:left">
                    <h4 class="school_name"><?php echo e($setting->school_name); ?></h4>
                    <p><?php echo e($setting->address); ?></p>
                  </div>
                  <h4 class="fees_book_title" style="display:inline-block"></h4>
                  <ul>
                    <li>
                      <p>
                        <?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?>: <?php echo e(@$student->admission_no); ?>

                      </p> 
                      <p>
                        <?php echo app('translator')->get('lang.date'); ?>: <?php echo e(date('d/m/Y')); ?>

                      </p>
                    </li>
                    <li>
                      <p>
                        <?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.name'); ?>: <?php echo e(@$student->full_name); ?> 
                      </p>
                    </li>
                    <li>
                      <p>
                        <?php echo app('translator')->get('lang.class'); ?>: <?php echo e(@$student->class->class_name); ?>

                      </p> 
                      <p>
                        <?php echo app('translator')->get('lang.roll'); ?>:<?php echo e(@$student->roll_no); ?>

                      </p>
                    </li>
                    <li>
                      <p>
                        <?php echo app('translator')->get('lang.section'); ?>: <?php echo e(@$student->section->section_name); ?>

                      </p> 
                      <p>
                      <?php echo app('translator')->get('lang.group'); ?>: ___
                      </p>
                    </li>
                  </ul>
            </th>

            <th class="border-0" rowspan="9"></th>
            <!-- space  -->

            <!-- 3rd header  -->
            <th colspan="2">
                <div style="float:left; width:30%">
                   <?php if(file_exists($setting->logo)): ?>
                      <img src="<?php echo e(url($setting->logo)); ?>" style="width:100px; height:auto"   alt="">
                    <?php endif; ?>
                </div>
                <div style="float:right; width:70%; text-aligh:left">
                  <h4 class="school_name"><?php echo e($setting->school_name); ?></h4>
                  <p><?php echo e($setting->address); ?></p>
                </div>
                <h4 class="fees_book_title" style="display:inline-block"></h4>
                <ul>
                  <li>
                    <p>
                      <?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?>: <?php echo e(@$student->admission_no); ?>

                    </p> 
                    <p>
                      <?php echo app('translator')->get('lang.date'); ?>: <?php echo e(date('d/m/Y')); ?>

                    </p>
                  </li>
                  <li>
                    <p>
                      <?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.name'); ?>: <?php echo e(@$student->full_name); ?> 
                    </p>
                  </li>
                  <li>
                    <p>
                      <?php echo app('translator')->get('lang.class'); ?>: <?php echo e(@$student->class->class_name); ?>

                    </p> 
                    <p>
                      <?php echo app('translator')->get('lang.roll'); ?>:<?php echo e(@$student->roll_no); ?>

                    </p>
                  </li>
                  <li>
                    <p>
                      <?php echo app('translator')->get('lang.section'); ?>: <?php echo e(@$student->section->section_name); ?>

                    </p> 
                    <p>
                    <?php echo app('translator')->get('lang.group'); ?>: ___
                    </p>
                  </li>
                </ul>
            </th>

          </tr>
        </thead>
        <tbody>
            <tr>
              <!-- first header  -->
                <th><?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.details'); ?></th>
                <th><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                <!-- space  -->
                <th class="border-0" rowspan="<?php echo e(5+count($fees_assigneds)); ?>" ></th>
                <!-- 2nd header  -->
                <th><?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.details'); ?></th>
                <th><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                <th class="border-0" rowspan="<?php echo e(5+count($fees_assigneds)); ?>" ></th>
                <!-- 3rd header  -->
                <th><?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.details'); ?></th>
                <th><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
            </tr>
        <?php
          $grand_total = 0;
          $total_fine = 0;
          $total_discount = 0;
          $total_paid = 0;
          $total_grand_paid = 0;
          $total_balance = 0;
          $totalpayable=0;
        ?>
        <?php $__currentLoopData = $fees_assigneds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php 
            $grand_total += $fees_assigned->feesGroupMaster->amount; 
            $discount_amount = $fees_assigned->applied_discount;
              $total_discount += $discount_amount;
              $student_id = $fees_assigned->student_id;
              //Sum of total paid amount of single fees type
              $paid = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id)->sum('amount');
              $total_grand_paid += $paid;
              //Sum of total fine for single fees type
            $fine = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id)->sum('fine');
            $total_fine += $fine;
            $total_paid = $discount_amount + $paid;
          ?>
          <tr>
            <?php
              $assigned_main_fees=number_format((float)@$fees_assigned->feesGroupMaster->amount, 2, '.', '');
              $p_amount= $assigned_main_fees-$paid + $fine-$discount_amount;
              // $totalpayable+=number_format((float)@$fees_assigned->feesGroupMaster->amount, 2, '.', '');
              $totalpayable+=$p_amount;
            ?>
             <!-- first td wrap  -->
             
                <td class="border-top">
                    <p>
                      <?php echo e($fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesGroups->name:""); ?> 
                      [<?php echo e($fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesTypes->name:""); ?>]
                    </p>
                    <?php if($discount_amount>0): ?>
                      <p>
                        <strong>
                          <?php echo app('translator')->get('lang.discount'); ?>(-)
                        </strong> 
                      </p>
                    <?php endif; ?>
                    <?php if($fine>0): ?>
                      <p> 
                        <strong>
                          <?php echo app('translator')->get('lang.fine'); ?>(+)
                        </strong> 
                      </p>
                    <?php endif; ?>
                    <?php if($paid>0): ?>
                      <p> 
                        <strong>
                          <?php echo app('translator')->get('lang.paid'); ?>(+)
                        </strong> 
                      </p>
                    <?php endif; ?>
                      <p> 
                        <strong>
                          <?php echo app('translator')->get('lang.unpaid'); ?>
                        </strong> 
                      </p>
                </td>
                <td class="border-top" style="text-align: right">
                    <?php echo e(@$assigned_main_fees); ?>

                    <?php if($discount_amount>0): ?>
                      <br>
                      <?php echo e(number_format($discount_amount, 2, '.', '')); ?>

                    <?php endif; ?>
                    <?php if($fine>0): ?>
                      <br>
                      <?php echo e(number_format($fine, 2, '.', '')); ?>

                    <?php endif; ?>
                    <?php if($paid>0): ?>
                      <br>
                      <?php echo e(number_format($paid, 2, '.', '')); ?>

                    <?php endif; ?>
                    <br>
                  <?php echo e(number_format(@$p_amount, 2, '.', '')); ?>

                </td>
             
          

            <!-- 2nd td wrap  -->
            
            <td class="border-top">
              <p>
                <?php echo e($fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesGroups->name:""); ?> 
                [<?php echo e($fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesTypes->name:""); ?>]
              </p>
              <?php if($discount_amount>0): ?>
                <p> 
                  <strong>
                    <?php echo app('translator')->get('lang.discount'); ?>(-)
                  </strong> 
                </p>
              <?php endif; ?>
              <?php if($fine>0): ?>
                <p> 
                  <strong>
                    <?php echo app('translator')->get('lang.fine'); ?>(+)
                  </strong> 
                </p>
              <?php endif; ?>
              <?php if($paid>0): ?>
                <p> 
                  <strong>
                    <?php echo app('translator')->get('lang.paid'); ?>(+)
                  </strong> 
                </p>
              <?php endif; ?>
              <p> 
                <strong>
                  <?php echo app('translator')->get('lang.unpaid'); ?>
                </strong> 
              </p>
            </td>

            <td class="border-top" style="text-align: right">
              <?php echo e(@$assigned_main_fees); ?>

              <?php if($discount_amount>0): ?>
                <br>
                <?php echo e(number_format($discount_amount, 2, '.', '')); ?>

              <?php endif; ?>
              <?php if($fine>0): ?>
                <br>
                <?php echo e(number_format($fine, 2, '.', '')); ?>

              <?php endif; ?>
              <?php if($paid>0): ?>
                <br>
                <?php echo e(number_format($paid, 2, '.', '')); ?>

              <?php endif; ?>
              <br>
              <?php echo e(number_format(@$p_amount, 2, '.', '')); ?>

            </td>

            

            <!-- 3rd td wrap  -->
            
            <td class="border-top">
              <p>
                <?php echo e($fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesGroups->name:""); ?> 
                [<?php echo e($fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesTypes->name:""); ?>]
              </p>
              <?php if($discount_amount>0): ?>
                <p> 
                  <strong>
                    <?php echo app('translator')->get('lang.discount'); ?>(-)
                  </strong> 
                </p>
              <?php endif; ?>
              <?php if($fine>0): ?>
                <p> 
                  <strong>
                    <?php echo app('translator')->get('lang.fine'); ?>(+)
                  </strong> 
                </p>
              <?php endif; ?>
              <?php if($paid>0): ?>
                <p> 
                  <strong>
                    <?php echo app('translator')->get('lang.paid'); ?>(+)
                  </strong> 
                </p>
              <?php endif; ?>
              <p> 
                <strong>
                  <?php echo app('translator')->get('lang.unpaid'); ?>
                </strong> 
              </p>
            </td>

            <td class="border-top" style="text-align: right">
              <?php echo e(@$assigned_main_fees); ?>

              <?php if($discount_amount>0): ?>
                <br>
                <?php echo e(number_format($discount_amount, 2, '.', '')); ?>

              <?php endif; ?>
              <?php if($fine>0): ?>
                <br>
                <?php echo e(number_format($fine, 2, '.', '')); ?>

              <?php endif; ?>
              <?php if($paid>0): ?>
                <br>
                <?php echo e(number_format($paid, 2, '.', '')); ?>

              <?php endif; ?>
              <br>
              <?php echo e(number_format(@$p_amount, 2, '.', '')); ?>

            </td>
            
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php
              $totalpayable=$totalpayable;
              if ($totalpayable<0) {
                  $totalpayable=0.00;
              } else {
                $totalpayable=$totalpayable;
              }
          ?>
          <tr>
            <td>
              <p>
                <strong>
                  <?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.payable'); ?> <?php echo app('translator')->get('lang.amount'); ?>
                </strong>
              </p>
            </td>
            <td style="text-align: right">
              
              <strong> <?php echo e(number_format((float) $totalpayable, 2, '.', '')); ?> </strong>
             </td>
            <td>
              <p>
                <strong>
                  <?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.payable'); ?> <?php echo app('translator')->get('lang.amount'); ?>
                </strong>
              </p>
            </td>
            <td style="text-align: right">
              
              <strong> <?php echo e(number_format((float) $totalpayable, 2, '.', '')); ?> </strong>
             </td>
            <!-- 3rd td wrap  -->
            <td>
              <p>
                <strong>
                  <?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.payable'); ?> <?php echo app('translator')->get('lang.amount'); ?>
                </strong>
              </p>
            </td>
            <td style="text-align: right">
              
              <strong> <?php echo e(number_format((float) $totalpayable, 2, '.', '')); ?> </strong>
             </td>
          </tr>
          
          <tr>
          </tr>

          <tr>
                <td colspan="2" >
                  <?php echo app('translator')->get('lang.if'); ?> <?php echo app('translator')->get('lang.unpaid'); ?>,
                  <?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.will_be'); ?> <?php echo app('translator')->get('lang.cancelled'); ?> <?php echo app('translator')->get('lang.after'); ?>
                </td>
                <!-- 2nd td wrap  -->
                <td colspan="2" >
                  <?php echo app('translator')->get('lang.if'); ?> <?php echo app('translator')->get('lang.unpaid'); ?>,
                  <?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.will_be'); ?> <?php echo app('translator')->get('lang.cancelled'); ?> <?php echo app('translator')->get('lang.after'); ?>
                </td>
                <!-- 3rd td wrap  -->
                <td colspan="2" >
                  <?php echo app('translator')->get('lang.if'); ?> <?php echo app('translator')->get('lang.unpaid'); ?>,
                  <?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.will_be'); ?> <?php echo app('translator')->get('lang.cancelled'); ?> <?php echo app('translator')->get('lang.after'); ?>
                </td>
          </tr>

          <tr>
                <td colspan="2">
                  <p class="parents_num text_center"> 
                    <?php echo app('translator')->get('lang.parents'); ?> <?php echo app('translator')->get('lang.phone'); ?> <?php echo app('translator')->get('lang.number'); ?> : 
                    <span>
                      <?php echo e(@$parent->guardians_mobile); ?>

                    </span> 
                  </p>
                </td>
                <!-- 2nd td wrap  -->
                <td colspan="2">
                  <p class="parents_num text_center"> 
                    <?php echo app('translator')->get('lang.parents'); ?> <?php echo app('translator')->get('lang.phone'); ?> <?php echo app('translator')->get('lang.number'); ?> : 
                    <span>
                      <?php echo e(@$parent->guardians_mobile); ?>

                    </span> 
                  </p>
                </td>
                <!-- 2nd td wrap  -->
                <td colspan="2">
                  <p class="parents_num text_center"> 
                    <?php echo app('translator')->get('lang.parents'); ?> <?php echo app('translator')->get('lang.phone'); ?> <?php echo app('translator')->get('lang.number'); ?> : 
                    <span>
                      <?php echo e(@$parent->guardians_mobile); ?>

                    </span> 
                  </p>
                </td>
          </tr>
        </tbody>
      </table>
    </div>
<footer class="footer" >
  <div class="footer_widget">
    <ul class="copyies_text">
      <li><?php echo app('translator')->get('lang.parent'); ?>/<?php echo app('translator')->get('lang.student'); ?></li>
      <li><?php echo app('translator')->get('lang.casier'); ?></li>
      <li><?php echo app('translator')->get('lang.officer'); ?></li>
    </ul>
    <p class="copy_collect">
      <?php echo app('translator')->get('lang.parent'); ?>/<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.copy'); ?>
    </p>
  </div>
  <div class="footer_widget">
      <ul class="copyies_text">
        <li>
          <?php echo app('translator')->get('lang.parent'); ?>/<?php echo app('translator')->get('lang.student'); ?>
        </li>
        <li>
          <?php echo app('translator')->get('lang.casier'); ?>
        </li>
        <li>
          <?php echo app('translator')->get('lang.officer'); ?>
        </li>
      </ul>
      <p class="copy_collect">
        <?php echo app('translator')->get('lang.parent'); ?>/<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.copy'); ?>
      </p>
    </div>
    <div class="footer_widget">
        <ul class="copyies_text">
          <li>
            <?php echo app('translator')->get('lang.parent'); ?>/<?php echo app('translator')->get('lang.student'); ?>
          </li>
          <li>
            <?php echo app('translator')->get('lang.casier'); ?>
          </li>
          <li>
            <?php echo app('translator')->get('lang.officer'); ?>
          </li>
        </ul>
        <p class="copy_collect">
          <?php echo app('translator')->get('lang.parent'); ?>/<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.copy'); ?>
        </p>
      </div>
</footer>
  <script>
    function printInvoice() {
      window.print();
    }
  </script>
  <script src="<?php echo e(asset('/')); ?>/public/backEnd/js/fees_invoice/jquery-3.2.1.slim.min.js"></script>
  <script src="<?php echo e(asset('/')); ?>/public/backEnd/js/fees_invoice/popper.min.js"></script>
  <script src="<?php echo e(asset('/')); ?>/public/backEnd/js/fees_invoice/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/backEnd/feesCollection/fees_payment_invoice_print.blade.php ENDPATH**/ ?>