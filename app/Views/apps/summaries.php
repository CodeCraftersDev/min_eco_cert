<?= $this->extend('admin/base'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content table-list" id="communities-list">
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
                                            <input type="search" name="search" id="search" class="form-control onlyalphanumeric" placeholder="Buscar..." value="<?= isset($_GET['search']) && !empty($_GET['search']) ? $_GET['search'] : ''?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-tools">
                            <div class="float-right">
                                <a href="<?= base_url() ?>admin/summaries/create" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Cargar nuevo </a>
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
                                        <th>Datos 1</th>
                                        <th>Datos 2</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="sortable-row" data-axis="y">
                                    <?php foreach ($summaries as $summary) { ?>
                                        <?php foreach ($summary as $s) { ?>
                                        <tr id="<?= $s['id'] ?>" >
                                            <td><?= $s['name'] ?></td>
                                            <td class="actions">
                                                <a href="<?= base_url() ?>admin/summaries/<?= $s['id'] ?>/edit" class="edit"><i class="fas fa-cog"></i>
                                                </a><button class="remove" data-name="<?= $s['name'] ?>" data-id="<?= $s['id'] ?>"><i class="far fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    <?php } } ?>
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
        admin.communities.list.init();
    };
</script>
<?= $this->endSection();?>
