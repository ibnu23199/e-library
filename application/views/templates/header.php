<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Library - Premium Apss By Abduloh | Aplications</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/iconfonts/simple-line-icon/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/notiflix/notiflix-2.7.0.min.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <?= $plugin['select2_css']; ?>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets/app-assets/e-library/'); ?>images/<?= $setting->logo_mini; ?>" />

    <!-- plugins:js -->
    <script src="<?= base_url('assets/app-assets/e-library/'); ?>vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url('assets/app-assets/e-library/'); ?>vendors/js/vendor.bundle.addons.js"></script>
    <script src="<?= base_url('assets/app-assets/e-library/'); ?>vendors/notiflix/notiflix-2.7.0.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?= base_url('assets/app-assets/e-library/'); ?>js/template.js"></script>
    <!-- endinject -->
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
            <div class="nav-top flex-grow-1">
                <div class="container d-flex flex-row h-100 align-items-center">
                    <div class="text-center navbar-brand-wrapper d-flex align-items-center">
                        <a class="navbar-brand brand-logo" href=""><img src="<?= base_url('assets/app-assets/e-library/'); ?>images/<?= $setting->logo; ?>" alt="logo e-library premium by Abdul"></a>
                        <a class="navbar-brand brand-logo-mini" href=""><img src="<?= base_url('assets/app-assets/e-library/'); ?>images/<?= $setting->logo_mini; ?>" alt="logo e-library premium by Abdul"></a>
                    </div>
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between flex-grow-1">

                        <ul class="navbar-nav navbar-nav-right mr-0 ml-auto">
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" aria-expanded="false">
                                    <img src="<?= base_url('assets/app-assets/user/'); ?><?= $admin->avatar; ?>" alt="e-library premium by Abdul">
                                    <span class="nav-profile-name"><?= $admin->nama; ?></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                    <a href="<?= base_url('pengaturan'); ?>" class="dropdown-item">
                                        <i class="icon-settings text-primary mr-2"></i>
                                        Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?= base_url('auth/sign_out'); ?>" class="dropdown-item">
                                        <i class="icon-logout text-primary mr-2"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="icon-menu"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="nav-bottom">
                <div class="container">
                    <ul class="nav page-navigation">
                        <li class="nav-item <?= $menu['dashboard']; ?>">
                            <a href="<?= base_url(); ?>" class="nav-link"><i class="link-icon icon-screen-desktop"></i><span class="menu-title">Dashboard</span></a>
                        </li>
                        <li class="nav-item <?= $menu['master_data']; ?>">
                            <a href="#" class="nav-link"><i class="link-icon icon-pie-chart"></i><span class="menu-title">Master Data</span><i class="menu-arrow"></i></a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('books'); ?>">Books</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('category'); ?>">Category</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('genre'); ?>">Genre</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('denda'); ?>">Denda</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('students'); ?>">Students</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('jurusan'); ?>">Prodi / Jurusan</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('kelas'); ?>">Kelas</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?= $menu['transaksi']; ?>">
                            <a href="#" class="nav-link"><i class="link-icon icon-book-open"></i><span class="menu-title">Transaksi</span><i class="menu-arrow"></i></a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('peminjaman'); ?>">Peminjaman</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('pengembalian'); ?>">Pengembalian</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?= $menu['settings']; ?>">
                            <a href="<?= base_url('pengaturan'); ?>" class="nav-link"><i class="link-icon icon-settings"></i><span class="menu-title">Settings</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>