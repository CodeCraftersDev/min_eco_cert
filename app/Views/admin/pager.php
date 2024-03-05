<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-center pagination-sm">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a href="<?= $pager->getFirst() ?>" aria-label="Primera" class="page-link">
                    <span aria-hidden="true">Primera</span>
                </a>
            </li>
            <li  class="page-item">
                <a href="<?= $pager->getPrevious() ?>" aria-label="Anterior" class="page-link">
                    <span aria-hidden="true">Anterior</span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a href="<?= $link['uri'] ?>" class="page-link">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li  class="page-item">
                <a href="<?= $pager->getNext() ?>" aria-label="Siguiente" class="page-link">
                    <span aria-hidden="true">Siguiente</span>
                </a>
            </li>
            <li  class="page-item">
                <a href="<?= $pager->getLast() ?>" aria-label="Última" class="page-link">
                    <span aria-hidden="true">Última</span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
