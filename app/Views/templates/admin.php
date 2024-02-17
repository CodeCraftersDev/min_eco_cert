<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?> | <?= $section; ?> </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('adminlte/plugins/fontawesome-free/css/');?>all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url('adminlte/plugins/icheck-bootstrap/')?>icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('adminlte/dist/css/')?>adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=base_url('adminlte/plugins/overlayScrollbars/css/')?>OverlayScrollbars.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?=base_url('adminlte/plugins/summernote/')?>summernote-bs4.min.css">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('assets/img/') ?>favicon.jpg">
    <meta name="msapplication-TileColor" content="#004f9f">
    <meta name="msapplication-TileImage" content="<?= base_url('assets/img/') ?>icon.jpg">
    <meta name="theme-color" content="#004f9f">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?=base_url('adminlte/dist/img/')?>AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!--  <li class="nav-item">
                <span class="info nav-link"><?/*= $username */?></span>
            </li>-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    test
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <button type="button" id="btn-pass-change-modal" class="btn btn-light" data-toggle="modal" data-target="#pass-change-modal">
                        Administrar Cuenta
                    </button>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>admin/logout" role="button" data-toggle="tooltip"
                   title="Cerrar sesión" data-placement="left">
                    <i class="fas fa-power-off"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <?= $this->renderSection('content');?>
    <?= view('admin/sidebar') ?>

    <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="https://ccdev.ar/">Code Crafters</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=base_url('adminlte/plugins/jquery/')?>jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url('adminlte/plugins/jquery-ui/')?>jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('adminlte/plugins/bootstrap/js/')?>bootstrap.bundle.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url('adminlte/plugins/summernote/')?>summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url('adminlte/plugins/overlayScrollbars/js/')?>jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('adminlte/dist/js/')?>adminlte.js"></script>
</body>
</html>
