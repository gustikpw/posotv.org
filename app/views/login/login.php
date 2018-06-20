<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $title; ?> | Login</title>

    <link href="<?php echo base_url('assets/inspinia271/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inspinia271/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">


    <link href="<?php echo base_url('assets/inspinia271/css/animate.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inspinia271/css/style.css') ?>" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <!-- <h2 class="font-bold">Welcome to POSO TV App</h2> -->
                <br>
                <img src="<?=base_url('assets/img/poso.tv.png')?>" height="200px" width="auto" alt="">

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="<?php echo site_url('login/login')?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" required="">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                    </form>
                    <p class="m-t">
                        <small><span><?php if (!isset($_SESSION['errors'])) { echo "Inspinia we app framework base on Bootstrap 3 &copy; 2014"; } else { echo $_SESSION['errors']; } ?></span></small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright PT. POSO MEDIA VISION - POSO TV
            </div>
            <div class="col-md-6 text-right">
               <small>© 2017-<?php echo date('Y') ?></small>
            </div>
        </div>
    </div>
</body>
</html>
