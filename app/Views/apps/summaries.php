<?= $this->extend('admin/base'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content table-list" id="summaries-list">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card sortable-area">
                    <div class="card-header">
                        <div class="float-left">
                            <form method="GET" action="<?= base_url('admin/summaries/') . '?' . $_SERVER['QUERY_STRING'] ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group">
                                            <select name="type" class="form-control">
                                                <option value="summary_id" <?= isset($_GET['type']) && !empty($_GET['type']) ? ($_GET['type'] == 'summary_id' ? 'selected'  : '') : ''?>>Sumario</option>
                                                <option value="name" <?= isset($_GET['type']) && !empty($_GET['type']) ? ($_GET['type'] == 'name' ? 'selected'  : '') : ''?>>Nombre</option>
                                            </select>
                                            <input type="search" name="search" id="search" class="form-control onlyalphanumeric" placeholder="Buscar..." value="<?= isset($_GET['search']) && !empty($_GET['search']) ? $_GET['search'] : ''?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-eco-secondary-outline" type="submit"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-tools">
                            <div class="float-right">
                                <a href="<?= base_url() ?>admin/summaries/create" class="btn btn-eco-primary disabled" disabled><i class="fas fa-plus mr-1"></i> Cargar nuevo </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0 pb-1">
                        <div class="empty-results alert alert-info no-results" role="alert" style="<?= !$summaries ? 'display:block' : 'display:none' ?>">No se encontraron Sumarios.</div>
                        <?php if($summaries) { ?>
                            <div class="table-container">
                                <table class="table table-hover text-nowrap with-sortable" data-sort="communities">
                                    <thead>
                                    <tr>
                                        <th> Nro. Sumario </th>
                                        <th> Carátula </th>
                                        <th> Disposición </th>
                                        <th> Origen </th>
                                        <th> Destino </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="sortable-row" data-axis="y">
                                    <?php if(!empty($summaries) && is_array($summaries)) :?>
                                        <?php foreach ($summaries['summaries'] as $summary) : ?>
                                            <tr id="<?= $summary->id ?>" >
                                                <td><?= $summary->id ?></td>
                                                <td><?= $summary->d_sumario ?></td>
                                                <td><?= $summary->d_disposicion ?></td>
                                                <td><?= $summary->d_origen ?></td>
                                                <td><?= $summary->d_destino ?></td>
                                                <td class="actions">
                                                    <a href="<?= base_url() ?>admin/summaries/<?= $summary->id ?>/edit"
                                                       class="edit btn">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button
                                                        class="btn remove"
                                                        data-name="<?= $summary->d_disposicion ?>"
                                                        data-id="<?= $summary->id ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <button
                                                            type="button"
                                                            class="btn show"
                                                            data-id="<?= $summary->id ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if($pager) : ?>
                        <div class="card-footer">
                            <?= $pager->links() ?>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
<script>
    const init = function() {
        admin.summaries.list.init();
    };
</script>
<?= $this->endSection();?>
