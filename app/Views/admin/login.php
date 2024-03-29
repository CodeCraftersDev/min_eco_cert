<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?> | <?= $section; ?> </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

  <!-- custom styles -->
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>styles.css">

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('assets/img/') ?>favicon.jpg">
  <meta name="msapplication-TileColor" content="#004f9f">
  <meta name="msapplication-TileImage" content="<?= base_url('assets/img/') ?>favicon.jpg">
  <meta name="theme-color" content="#004f9f">
</head>

<body class="hold-transition login-page">
  <img src="<?= base_url('assets/img/') ?>fondo_eco.png" class="blur-bg">

  <div class="login-box">
    <div class="login-logo ">
      <img src="<?= base_url('assets/img/')?>eco_logo.png">
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <h5 class="login-box-msg">Bienvenido</h5>
        <form action="#" method="post">
          <div class="input-field mb-3">
            <span class="far fa-user p-2"></span>
            <input id="username" type="text" name="username" class="form-control form-control-sm" placeholder="Username">
          </div>
          <div class="input-field mb-3">
            <span class="fas fa-lock p-2"></span>
            <input id="password" type="password" name="password" class="form-control form-control-sm" placeholder="Password" autocomplete="off">
          </div>
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none">
            Datos ingresados no son correctos.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col">
              <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <script>
    const base_url = "<?= base_url() ?>admin";
    //const token = "<?php //= $token ?>//";
  </script>

  <!-- jQuery -->
  <script src="<?=base_url('adminlte/plugins/jquery/')?>jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?=base_url('adminlte/plugins/bootstrap/js/')?>bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url('adminlte/dist/js/')?>adminlte.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/js/') ?>login.js"></script>

</body>
</html>
