
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Đăng nhập hệ thống quản lý</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/admin/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url(); ?>assets/admin/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background:#F7F7F7;">

<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">

                <form method="post" action="<?php echo base_url(); ?>admin">
                    <h1>Đăng nhập hệ thống</h1>
                    <?php if (validation_errors() ||  $this->session->flashdata('message') != ''): ?>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php if (validation_errors()) echo validation_errors(); else echo  $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <input type="text" value="<?php echo set_value('username'); ?>" name="username" class="form-control" placeholder="Tên đăng nhập" required="" />
                    </div>
                    <div>
                        <input name="password"  type="password" class="form-control" placeholder="Mật khẩu" required="" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary pull-left">Đăng nhập</button>
                    </div>
                    <div class="clearfix"></div>

                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>
        
    </div>
</div>

</body>

</html>
