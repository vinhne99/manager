<!DOCTYPE html>
<html lang="en" data-ng-app="website" class="ng-scope">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Home</title>
        <link rel="SHORTCUT ICON"     type="">
        <link rel="canonical" href="<?php echo base_url(); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >

        <!-- Optional theme -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
        <!-- bxSlider CSS file -->
        <link href="<?php echo base_url(); ?>assets/slide/jquery.bxslider.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.css" >
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate1.css" >
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" >
        <script src="<?php echo base_url(); ?>assets/js/modernizr.js"></script> <!-- Modernizr -->
        <script src="<?php echo base_url(); ?>assets/js/velocity.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.js"></script>
    </head>
    <body>
    <div class="wrapper header">
            <div class="col-md-3">
                <div class="row wow bounceInLeft animated"><a  href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png"></a></div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <nav class="navbar navbar-default menu-nav">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse menu" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a class="active" href="<?php echo base_url(); ?>">Trang chủ</a></li>
                                    <li><a href="<?php echo site_url("bang-gia"); ?>">Bảng giá</a></li>
                                    <li><a class="kho-giao-dien" href="<?php if (current_url() == base_url()) echo 'javascript:;'; else echo site_url("#!kho-giao-dien"); ?>">Kho giao diện</a></li>
                                    <li><a href="<?php echo site_url("lien-he"); ?>">Liên hệ</a></li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                    </nav>
                </div>
            </div>
        </div>

        <?php $this->load->view($page); ?>

        <div class="clearfix"></div>
        <div class="wrapper footer <?php if (current_url() == base_url()) echo 'wow bounceInDown animated';  ?>">
            <div class="col-md-9 contact-content">
                <ul>
                    <li class="name"><?php echo setting_value("title");  ?></li>
                    <li class="address"><?php echo setting_value("address");  ?></li>
                    <li class="phone"><?php echo setting_value("tell");  ?></li>
                    <li class="email"><?php echo setting_value("email");  ?></li>
                </ul>
                <a target="_blank" href="<?php echo setting_value("link_facebook");  ?>" class="icon icon-facebook"></a>
                <a target="_blank" href="<?php echo setting_value("link_google");  ?>" class="icon icon-google"></a>
            </div>
            <div class="col-md-3 google-map">
            </div>
        </div>

        <div id="asd_popup"  data-backdrop="static" data-keyboard="false" class="modal fade gallery-popup-image" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <a href="javascript:;" class="close-modal" data-dismiss="modal"></a>
                <div class="modal-content custom-modal select-fr-popup " >
                    <img src="<?php echo base_url(); ?>assets/images/asd.png">
                </div>
            </div>
        </div>



    <div class="cd-quick-view">
        <a href="#0" class="cd-close">Close</a>
        <div id="camera-cont">
        </div>
    </div>


    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/slide/jquery.bxslider.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/filterizr/jquery.filterizr.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/controls.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/main.js"></script>


    </body>
</html>