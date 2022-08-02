<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Library - Premium Apss By Abduloh | Authentication</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/iconfonts/simple-line-icon/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets/app-assets/e-library/'); ?>images/<?= $setting->logo_mini; ?>" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper auth p-0 theme-two">
                <div class="row d-flex align-items-stretch">
                    <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
                        <div class="slide-content bg-1">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 h-100 bg-white">
                        <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
                            <?php if ($admin == null) : ?>
                                <div class="nav-get-started">
                                    <p>No admin account</p>
                                    <a class="btn get-started-btn" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-4" data-whatever="Admin">GET STARTED</a>
                                </div>
                            <?php endif; ?>
                            <form action="" method="POST">
                                <h3 class="mr-auto">Hello Admin! let's get started</h3>
                                <p class="mb-5 mr-auto">Enter your details below.</p>
                                <div class="mb-2">
                                    <?= $this->session->flashdata('pesan'); ?>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="text" name="l_email" class="form-control" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-lock"></i></span>
                                        </div>
                                        <input type="password" name="l_password" class="form-control" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary submit-btn">SIGN IN</button>
                                </div>
                                <div class="wrapper mt-5 text-gray">
                                    <p class="footer-text"><?= $setting->footer_1; ?>.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-4" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="<?= base_url('auth/daftar_admin'); ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-4">Create Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name : </label>
                            <input type="text" class="form-control" name="nama" id="recipient-name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Username : </label>
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url('assets/app-assets/e-library/'); ?>vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url('assets/app-assets/e-library/'); ?>vendors/js/vendor.bundle.addons.js"></script>
    <script src="<?= base_url('assets/app-assets/e-library/'); ?>vendors/sweetalert/sweetalert2.all.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?= base_url('assets/app-assets/e-library/'); ?>js/template.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
</body>



</html>