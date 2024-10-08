<style>
    .footer-list ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 50px;
    }

    .footer-list ul li {
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .f_title {
        margin-bottom: 40px;
    }

    .f_title h4 {
        color: #415094;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0px;
    }
</style>
<?php
    if(moduleStatusCheck('ParentRegistration')){
        $is_registration_permission = Modules\ParentRegistration\Entities\SmRegistrationSetting::first('position');
    }

    $setting  = generalSetting();
    App::setLocale(getUserLanguage());
?>
<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?> dir="rtl" class="rtl" <?php endif; ?> >
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="Infix is 100+ unique feature enable school management software system. It can manage all type of school, academy and any educational institution"/>
    <link rel="icon" href="<?php echo e(asset($setting->favicon)); ?>" type="image/png"/>
    <title><?php echo e($setting->site_title ? $setting->site_title :  'Infix Edu ERP'); ?></title>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <!-- Bootstrap CSS -->
    <?php if( $setting->site_title == 1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/bootstrap.min.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css"/>
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/jquery-ui.css"/>

    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/owl.carousel.min.css"/>
    <!-- main css -->

    <?php if($setting->site_title ==1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/style.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/<?php echo e(@activeStyle()->path_main_style); ?>"/>
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fullcalendar.print.css">

    <link rel="stylesheet" href="<?php echo e(asset('public/')); ?>/frontend/css/infix.css"/>
    
    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js">
    </script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body class="client light">
<!--================ Start Header Menu Area =================-->
<header class="header-area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box-1420">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>/home">
                    <img class="w-75"
                         src="<?php echo e(asset($setting->logo ? $setting->logo : 'public/uploads/settings/logo.png')); ?>"
                         alt="Infix Logo" style="max-width: 150px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">

                            
                                <li class="nav-item  <?php echo e(Request::path() == '/' ||  Request::path() == 'home'? 'active':''); ?> ">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>/home">
                                        <?php echo app('translator')->get('lang.home'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('parentregistration/registration')); ?>">Admissions</a>
                                </li>

                                <li class="nav-item <?php echo e(Request::path() == 'about'? 'active':''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>/about">
                                        <?php echo app('translator')->get('lang.about'); ?>
                                    </a>
                                </li>

                                <li class="nav-item <?php echo e(Request::path() == 'news-page'? 'active':''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>/news-page">
                                        <?php echo app('translator')->get('lang.news'); ?>
                                    </a>
                                </li>

                                <li class="nav-item <?php echo e(Request::path() == 'contact'? 'active':''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>/contact">
                                        <?php echo app('translator')->get('lang.contact'); ?>
                                    </a>
                                </li>
                            

                            <?php if(!auth()->check()): ?>
                                <li class="nav-item <?php echo e(Request::path() == 'login'? 'active':''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>/login"><?php echo app('translator')->get('lang.login'); ?></a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item submenu_left_control">
                                    <a class="nav-link" href="#"> <?php echo e(Auth::user()->full_name); ?></a>
                                    <ul class="sumbmenu">
                                        
                                            <li class="menu_list_left">
                                                <a href="<?php echo e(url('/')); ?>/dashboard">
                                                   <span class="ti-menu"></span>
                                                   Dashboard
                                                </a>
                                            </li>

                                            <li class="menu_list_left">
                                                <a href="<?php echo e(Auth::user()->role_id == 2? route('student-logout'): route('logout')); ?>"
                                                   onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">
                                                    <span class="ti-unlock"></span>
                                                    <?php echo app('translator')->get('lang.logout'); ?>
                                                </a>

                                                <form id="logout-form"
                                                      action="<?php echo e(Auth::user()->role_id == 2? route('student-logout'): route('logout')); ?>"
                                                      method="POST" style="display: none;">

                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </li>
                                  
                                    </ul>
                                </li>
                            <?php endif; ?>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <ul class="nav navbar-nav mr-auto search-bar">
                            <li class=""></li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================ End Header Menu Area =================-->

<?php echo $__env->yieldContent('main_content'); ?>

<!--================Footer Area =================-->
<footer class="footer_area section-gap-top" style="background:#20232E;">
    <div class="container">
        <div class="row footer_inner">
 
                <div class="col-lg-4 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4 class="text-white">Connect With Us</h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>

                                    <li class="text-white">
                                        <span class="ti-map"></span> <?php echo e(generalSetting()->address); ?>

                                    </li>
                                    <li >
                                        <a class="text-white" href="mailto:<?php echo e(generalSetting()->email); ?>"><span class="ti-email"></span> <?php echo e(generalSetting()->email); ?></a>
                                    </li>
                                    <li >
                                        <a class="text-white" href="tel:<?php echo e(generalSetting()->phone); ?>"><span class="ti-headphone-alt"></span> <?php echo e(generalSetting()->phone); ?></a>
                                    </li>
                                       
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4 class="text-white">Study</h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>
                                        <li>
                                            <a href="<?php echo e(url('parentregistration/registration')); ?>" class="text-white">
                                                Admissions
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(url('/')); ?>/course" class="text-white">
                                                Courses
                                            </a>
                                        </li>
                                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4 class="text-white">Resources</h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>

                                        <li>
                                            <a href="<?php echo e(url('/')); ?>/contact" class="text-white">
                                                Contact Us
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(url('/')); ?>/about" class="text-white">
                                                About Us
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(url('/')); ?>/news-page" class="text-white">
                                               News
                                            </a>
                                        </li>
                                   
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>


        </div>
        <div class="row single-footer-widget">
            <div class="col-lg-8 col-md-9">
                <div class="copy_right_text">

                        <p class="text-white"><?php echo $setting->copyright_text; ?></p>
                </div>
            </div>
            <?php if($social_permission): ?>
                <div class="col-lg-4 col-md-3">
                    <div class="social_widget">
                        <?php $__currentLoopData = $social_icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(@$social_icon->url != ""): ?>
                                <a href="<?php echo e(@$social_icon->url); ?>" class="text-white">
                                    <i class="<?php echo e($social_icon->icon); ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
<!--================End Footer Area =================-->


<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-ui.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/nice-select.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/raphael-min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/morris.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/owl.carousel.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/moment.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/print/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap-datepicker.min.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDs3mrTgrYd6_hJS50x4Sha1lPtS2T-_JA"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/main.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/developer.js"></script>

<?php echo $__env->yieldContent('script'); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\college\resources\views/frontEnd/home/front_master.blade.php ENDPATH**/ ?>