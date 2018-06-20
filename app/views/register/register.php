<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POSO TV WebApp | Register</title>

    <link href="<?=base_url('assets/inspinia271/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia271/font-awesome/css/font-awesome.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia271/css/plugins/iCheck/custom.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia271/css/animate.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia271/css/style.css')?>" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

              <img src="<?=base_url('assets/img/poso.tv.png')?>" height="100px" width="auto" alt="">


            </div>
            <h3>Register Administrator</h3>
            <p>Buat user pertama kali.</p>
            <form class="m-t" role="form" action="<?=site_url('register/post')?>" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?=base_url('assets/inspinia271/js/jquery-3.1.1.min.js')?>"></script>
    <script src="<?=base_url('assets/inspinia271/js/bootstrap.min.js')?>"></script>
    <!-- iCheck -->
    <script src="<?=base_url('assets/inspinia271/js/plugins/iCheck/icheck.min.js')?>"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
