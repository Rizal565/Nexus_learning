<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.all.min.js"></script>
    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url() ?>" class="h1">Form Register</a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('register') ?>" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Full name" autocomplete="off" value="<?= set_value('name') ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" value="<?= set_value('email') ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="images" id="images" placeholder="images" autocomplete="off" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-images"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?= set_value('password') ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="retype_password" id="retype_password" placeholder="Retype password" value="<?= set_value('retype_password') ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>

                <a href="<?= base_url('login') ?>" class="text-center">I already have a account</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <?php if ($this->session->flashdata('success')) : ?>
        <script>
            Swal.fire(
                'Done',
                '<?= $this->session->flashdata('message'); ?>',
                'success'
            );
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('Failed')) : ?>
        <script>
            Swal.fire(
                'Failed',
                '<?= $this->session->flashdata('message'); ?>',
                'error'
            );
        </script>
    <?php endif; ?>

    <?php if (validation_errors()) : ?>
        <script>
            Swal.fire(
                'Error',
                '<?= str_replace("\n", "\\n", addslashes(validation_errors())); ?>',
                'error'
            );
        </script>
    <?php endif; ?>

</body>

</html>