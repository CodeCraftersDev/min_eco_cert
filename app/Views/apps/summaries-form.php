<?= $this->extend('admin/base'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content" id="summary-form">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary pb-5">
                    <!-- form start -->
                    <form role="form" id="form-summary" method="POST" enctype="multipart/form-data">
                        <?php if(isset($summary)) { ?>
                            <input type="hidden" name="id" id="id" value="<?= $summary->id ?>">
                        <?php } ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="card col-12">
                                    <div class="card-header">
                                        Detalles del Sumario
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="input-id">Nro. Sumario</label>
                                                        <input type="text" name="id" class="form-control" id="input-id" value="<?= isset($summary) ? trim($summary->id) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="input-n_disposicion">Disposición</label>
                                                        <input type="text" name="n_disposicion" class="form-control" id="input-n_disposicion" value="<?= isset($summary) ? trim($summary->n_disposicion) : '' ?>" maxlength="100" disabled>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="input-d_sumario">Carátula</label>
                                                        <input type="text" name="d_sumario" class="form-control" id="input-d_sumario" value="<?= isset($summary) ? trim($summary->d_sumario) : '' ?>" maxlength="500" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-c_origen">Origen</label>
                                                        <input type="text" name="c_origen" class="form-control" id="input-c_origen" value="<?= isset($summary) ? trim($summary->c_origen) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-c_destino">Destino</label>
                                                        <input type="text" name="c_destino" class="form-control" id="input-c_destino" value="<?= isset($summary) ? trim($summary->c_destino) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-c_tipo_tramite">Tipo de Trámite</label>
                                                        <input type="text" name="c_tipo_tramite" class="form-control" id="input-c_tipo_tramite" value="<?= isset($summary) ? trim($summary->c_tipo_tramite) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-n_fojas">Nro. de Fojas</label>
                                                        <input type="text" name="n_fojas" class="form-control" id="input-n_fojas" value="<?= isset($summary) ? trim($summary->n_fojas) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-n_multa">Multa</label>
                                                        <input type="text" name="n_multa" class="form-control" id="input-n_multa" value="<?= isset($summary) ? trim($summary->n_multa) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-d_clave">Clave</label>
                                                        <input type="text" name="d_clave" class="form-control" id="input-d_clave" value="<?= isset($summary) ? trim($summary->d_clave) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="input-d_observacion">Observaciones</label>
                                                        <input type="text" name="d_observacion" class="form-control" id="input-d_observacion" value="<?= isset($summary) ? trim($summary->d_observacion) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-12">
                                    <div class="card-header">
                                        Involucrados en el Sumario
                                    </div>
                                    <div class="card-body">
                                        <!-- involved details -->
                                        <div class="col-12">
                                            <?php foreach ($summaryInvolved as $involved) : ?>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-denominacion-"<?= trim($involved->denominacion) ?>">Denominación</label>
                                                        <input type="text" name="denominacion-<?= trim($involved->denominacion) ?>" class="form-control" id="input-denominacion-<?= trim($involved->denominacion) ?>"
                                                               value="<?= isset($involved) ? trim($involved->denominacion) : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-documento-"<?= trim($involved->documento) ?>">Documento Nro.</label>
                                                        <input type="text" name="documento-<?= trim($involved->documento) ?>" class="form-control" id="input-documento-<?= trim($involved->documento) ?>"
                                                               value="<?= isset($involved) ? trim($involved->documento) : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="input-tipo-"<?= trim($involved->tipo) ?>">Tipo Documento</label>
                                                        <input type="text" name="tipo-<?= trim($involved->tipo) ?>" class="form-control" id="input-tipo-<?= trim($involved->tipo) ?>"
                                                               value="<?= isset($involved) ? trim($involved->tipo) : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="input-titular-"<?= trim($involved->titular) ?>">Titular</label>
                                                        <select name="titular-<?= trim($involved->titular) ?>" class="form-control" id="input-titular-<?= trim($involved->titular) ?>">
                                                            <option value="S" <?= isset($involved) && trim($involved->titular) == 'S' ? 'selected' : ''?>> SI </option>
                                                            <option value="N" <?= isset($involved) && trim($involved->titular) == 'S' ? 'selected' : ''?>> NO </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="form-footer fixed">
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-eco-secondary-outline" onclick="window.history.go(-1); return false;">Cancelar</button>
                                    <button type="submit" class="btn btn-eco-primary">Guardar <div class="spinner"><span class="" role="status" aria-hidden="true"></span></div></button>
                                </div>
                            </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    const init = function() {
        admin.summarys.form.init();
    };
</script>
<?= $this->endSection();?>
