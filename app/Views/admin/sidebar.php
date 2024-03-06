<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-lime elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin') ?>" class="brand-link bg-dark">
        <img src="<?=base_url('assets/img/')?>jaguarete.png" alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .9;  max-height: 40px; filter: invert(1);">
        <span class="brand-text font-weight-light">Min. Ecología</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview  <?= strpos($section, 'config') !== false ? ' menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= strpos($section, 'config') !== false ? ' active' : '' ?>">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Configuraciones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin') ?>/users"
                               class="nav-link<?= $section == 'users-list' ? ' active' : '' ?>">
                                <p>
                                    Usuarios
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--   Sumarios  -->
                <li class="nav-item has-treeview  <?= strpos($section, 'summaries') !== false ? ' menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= strpos($section, 'summaries') !== false ? ' active' : '' ?>">
                        <i class="nav-icon fas fa-file-archive"></i>
                        <p>
                            Adm. Sumarios
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin') ?>/summaries"
                               class="nav-link<?= $section == 'summaries-list' ? ' active' : '' ?>">
                                <p>
                                    Sumarios
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
