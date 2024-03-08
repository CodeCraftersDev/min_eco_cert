<?= $this->extend('admin/base'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content" id="summary-form">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <!-- form start -->

                        <div class="card-body">
                            <div class="row">




                                <div class="card col-12 mb-4">
                                    <form role="form" id="form-summary" method="POST" enctype="multipart/form-data">
                                        <?php if(isset($summary)) { ?>
                                            <input type="hidden" name="id" id="id" value="<?= $summary->id ?>">
                                        <?php } ?>
                                    <div class="card-header">
                                        Detalles del Sumario
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="input-id-summary">Nro. Sumario</label>
                                                        <input type="text" name="id-summary" class="form-control" id="input-id-summary" value="<?= isset($summary) ? trim($summary->id) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="input-d_disposicion">Disposición</label>
                                                        <input type="text" name="n_disposicion" class="form-control" id="input-d_disposicion" value="<?= isset($summary) ? trim($summary->d_disposicion) : '' ?>" maxlength="100" disabled>
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
                                                        <label for="input-d_origen">Origen</label>
                                                        <input type="text" name="d_origen" class="form-control" id="input-d_origen" value="<?= isset($summary) ? trim($summary->d_origen) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-d_destino">Destino</label>
                                                        <input type="text" name="d_destino" class="form-control" id="input-d_destino" value="<?= isset($summary) ? trim($summary->d_destino) : '' ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-d_tramite">Tipo de Trámite</label>
                                                        <input type="text" name="d_tramite" class="form-control" id="input-d_tramite" value="<?= isset($summary) ? trim($summary->d_tramite) : '' ?>" disabled>
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
                                                        <label for="input-d_estado">Estado</label>
                                                        <input type="text" name="d_estado" class="form-control" id="input-d_estado" value="<?= isset($summary) ? trim($summary->d_estado) : '' ?>" disabled>
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
                                    </form>
                                </div>



                                <div class="card col-12">
                                    <div class="card-header">
                                        Involucrados en el Sumario
                                        <button
                                            id="addUser"
                                            type="button"
                                            style="margin-right: 10px"
                                            class="btn btn-eco-primary-outline"
                                        >Agregar Nuevo Interviniente
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <!-- involved details -->
                                        <div class="col-12 users-list">
                                            <?php foreach ($summaryInvolved as $involved) : ?>
                                            <form id="userForm_<?=trim($involved->id)?>">
                                            <div class="row user_form_block" id="rowUser_<?=trim($involved->id)?>">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="input-d_denominacion-<?= trim($involved->id) ?>">Denominación</label>
                                                        <input type="text" name="d_denominacion-<?= trim($involved->id) ?>" class="form-control" id="input-d_denominacion-<?= trim($involved->id) ?>"
                                                               value="<?= isset($involved) ? trim($involved->d_denominacion) : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="input-n_documento-<?= trim($involved->id) ?>">Documento Nro.</label>
                                                        <input type="text" name="n_documento-<?= trim($involved->id) ?>" class="form-control" id="input-n_documento-<?= trim($involved->id) ?>"
                                                               value="<?= isset($involved) ? trim($involved->n_documento) : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="input-tipo-<?= trim($involved->c_tipo) ?>">Tipo Documento</label>
                                                        <select name="tipo-doc-<?= trim($involved->id) ?>" class="form-control" id="input-tipo-doc-<?= trim($involved->id) ?>">
                                                            <option value="" > Seleccione </option>
                                                            <option value="dni" <?= isset($involved) && trim($involved->c_tipo) == 'dni' ? 'selected' : ''?>> DNI </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="input-titular-<?= trim($involved->id) ?>">Titular</label>
                                                        <select name="titular-<?= trim($involved->id) ?>" class="form-control" id="input-titular-<?= trim($involved->id) ?>">
                                                            <option value="" > Seleccione </option>
                                                            <option value="S" <?=isset($involved) && trim($involved->c_ult_titular) == 'S' ? 'selected' : ''?>> SI </option>
                                                            <option value="N" <?= isset($involved) && trim($involved->c_ult_titular) == 'N' ? 'selected' : ''?>> NO </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="flex-direction: row; align-items: center; display: flex; padding-top: 10px;">
                                                    <button
                                                        type="button"
                                                        style="margin-right: 10px"
                                                        class="btn btn-eco-primary-outline"
                                                        onclick="saveUser(<?=$involved->id?>)">Guardar
                                                    </button>
                                                    <button
                                                        type="button"
                                                        class="btn btn-eco-danger-outline"
                                                        onclick="deleteUser(<?=$involved->id?>)">Eliminar
                                                    </button>
                                                </div>

                                            </div>
                                            </form>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

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
        admin.summaries.form.init();
    };
</script>
<?= $this->endSection();?>
