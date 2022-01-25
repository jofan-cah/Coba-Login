<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===================================================================================-->
    <!-- ICON -->
    <link rel="shortcut icon" href="https://hmpti-udb.my.id/assets/img/logo.png?1624943673" />
    <!--===================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://hmpti-udb.my.id/assets/login_page/css/util.css" />
    <link rel="stylesheet" type="text/css" href="https://hmpti-udb.my.id/assets/login_page/css/style.css" />
    <!--===================================================================================-->
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://hmpti-udb.my.id/assets/adminlte/plugins/sweetalert2/sweetalert2.css">
</head>


<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 shadow">
                <div class="login100-form-title" style="background-image: url('https://hmpti-udb.my.id/assets/login_page/img/bg-02.jpg')">
                    <span class="login100-form-title-1"> Anda Telah Login </span>
                </div>
                <!-- tombol login -->
                <form class="login100-form">
                    <a href="<?= base_url() . '/Keluar' ?>" class="btn-google m-b-20">



                        <?= session()->get("LoggedUserData")['email']; ?></a>
                    <div class="text-center">
                        <a href="<?= base_url('/Login/keluar') ?>"> Keluar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<!-- jQuery -->
<script src="https://hmpti-udb.my.id/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://hmpti-udb.my.id/assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // showing alert
    });
</script>

</body>


<script>
    $(document).ready(function() {
        // showing alert
        <?php $alert = session()->getFlashData("msg") ?>
        <?php if (!empty($alert)) : ?>
            <?php $alert = explode("#", $alert) ?>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 20000
            });
            setTimeout(function() {
                Toast.fire({
                    icon: "<?php echo $alert[0] ?>",
                    title: "<?php echo $alert[1] ?>"
                });
            }, 1000);
        <?php endif ?>
    });
</script>

</html>