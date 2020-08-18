<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/'); ?>img/logo/logo-light.png">
        </div>
        <div class="sidebar-brand-text mx-3"><?= SITE_NAME ?></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Management
    </div>

    <?php if (isset($_SESSION['auth']['group'])) {
        if ($_SESSION['auth']['group'] == 1) { ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUserManagement" aria-expanded="true" aria-controls="collapseUserManagement">
                    <i class="far fa-fw fa-user"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUserManagement" class="collapse" aria-labelledby="headingUserManagement" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('user-group'); ?>"><i class="far fa-fw fa-id-badge"></i> User Group</a>
                        <a class="collapse-item" href="<?= base_url('user-privilege'); ?>"><i class="fa fa-fw fa-universal-access"></i> User Privilege</a>
                        <a class="collapse-item" href="<?= base_url('users'); ?>"><i class="far fa-fw fa-user-circle"></i> Users & Activation</a>
                    </div>
                </div>
            </li>

    <?php }
    } ?>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIdentityCardManagemnet" aria-expanded="true" aria-controls="collapseIdentityCardManagemnet">
            <i class="fa fa-fw fa-id-card"></i>
            <span>Identity Card</span>
        </a>
        <div id="collapseIdentityCardManagemnet" class="collapse" aria-labelledby="headingIdentityCardManagemnet" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('ktp'); ?>"><i class="far fa-fw fa-address-card"></i> KTP</a>
                <a class="collapse-item" href="<?= base_url('npwp'); ?>"><i class="far fa-fw fa-credit-card"></i> NPWP</a>
            </div>
        </div>
    </li>

    <?php if (isset($_SESSION['auth']['group'])) {
        if ($_SESSION['auth']['group'] == 1) { ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('import-document'); ?>">
                    <i class="fas fa-fw fa-file-import"></i>
                    <span>Import Documents</span>
                </a>
            </li>

    <?php }
    } ?>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Report
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('report/sales'); ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Sales Report</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('report/sales/barang-langganan'); ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Report</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="version"><?= VERSION_APP ?></div>
    <!-- <div class="version" id="version-katapanda"></div> -->
</ul>
<!-- Sidebar -->