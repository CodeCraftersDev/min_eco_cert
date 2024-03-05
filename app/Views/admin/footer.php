</div>
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
    $.widget.bridge('uibutton', $.ui.button);
    const base_url = "<?= base_url() ?>admin";
</script>
<!-- noty -->
<script src="<?= base_url('adminlte/plugins/noty') ?>/noty.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('adminlte/plugins/bootstrap/js/')?>bootstrap.bundle.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url('adminlte/plugins/summernote/')?>summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url('adminlte/plugins/overlayScrollbars/js/')?>jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('adminlte/dist/js/')?>adminlte.js"></script>
<!-- Select2 -->
<script src="<?= base_url('adminlte/plugins/select2') ?>/js/select2.full.js"></script>
<!-- jQuery-confirm -->
<script src="<?= base_url('adminlte/plugins/jquery-confirm') ?>/jquery-confirm.min.js"></script>
<!-- jQuery-validation -->
<script src="<?= base_url('adminlte/plugins/jquery-validation') ?>/jquery.validate.min.js"></script>
<script src="<?= base_url('adminlte/plugins/jquery-validation') ?>/additional-methods.min.js"></script>
<!-- jQuery Mask -->
<script src="<?= base_url('adminlte/plugins/jquery-mask') ?>/jquery.mask.min.js"></script>

<!-- Custom JS App -->
<script src="<?=base_url('assets/js/')?>app.js"></script>

<script>
    admin.global.nav.init();
    if(typeof init == 'function') {
        init();
    }
</script>
</body>
</html>
