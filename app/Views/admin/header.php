<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Min. Ecología | <?= $title; ?></title>

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
    <!-- jquery-confirm -->
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/jquery-confirm/') ?>jquery-confirm.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/select2/css/') ?>select2.min.css">
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/select2-bootstrap4-theme/') ?>select2-bootstrap4.min.css">
    <!-- Noty -->
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/noty/') ?>noty.css">
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/noty/') ?>themes/bootstrap-v4.css">

    <!-- Site style -->
    <link rel="stylesheet" href="<?=base_url('assets/css/')?>admin-styles.min.css?no-cache=<?=time()?>">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('assets/img/') ?>favicon.jpg">
    <meta name="msapplication-TileColor" content="#004f9f">
    <meta name="msapplication-TileImage" content="<?= base_url('assets/img/') ?>icon.jpg">
    <meta name="theme-color" content="#004f9f">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<!-- ajax Loader -->
<div id="ajax_loader">
    <div class="ajax_background"></div>
    <div class="ajax_img_loader">
        <svg version="1.1" id="L3"
             xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px"
             y="0px"
             viewBox="0 0 100 100"
             enable-background="new 0 0 0 0"
             xml:space="preserve"
        >
        <circle fill="none" stroke="#2ECC71" stroke-width="4" cx="50" cy="50" r="44" />
            <circle fill="#fff" stroke="#2ECC71" stroke-width="3" cx="8" cy="54" r="6" >
                <animateTransform
                        attributeName="transform"
                        dur="2s"
                        type="rotate"
                        from="0 50 48"
                        to="360 50 52"
                        repeatCount="indefinite" />

            </circle>
    </svg>
    </div>
</div>


<div class="wrapper">

    <!-- Preloader -->
    <!--    <div class="preloader flex-column justify-content-center align-items-center">-->
    <!--        <img class="animation__shake" src="--><?php //=base_url('adminlte/dist/img/')?><!--AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
    <!--    </div>-->

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
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url() ?>admin/profile" class="dropdown-item">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    <?= session('username') ?>
                                </h3>
                                <p class="text-sm">Administrar mi cuenta</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="<?= base_url() ?>admin/logout" role="button" data-toggle="tooltip"
                       title="Cerrar sesión" data-placement="center"> Cerrar Sesión
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!--  sidebarmenu  -->
    <?= $this->include('admin/sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $title; ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url().uri_string() ?>"> <?= $title; ?></a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
