<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Admin Profile</h4>
                            <?= $this->session->flashdata('profile'); ?>
                            <div class="text-center">
                                <img src="<?= base_url('assets/app-assets/user/'); ?><?= $admin->avatar; ?>" class="mb-2" alt="admin e-library premium, by abduloh" style="width: 150px;">
                                <h4><?= $admin->nama; ?></h4>
                                <p class="text-muted">Admin E- Library</p>
                            </div>
                            <button type="button" class="btn btn-inverse-success" data-toggle="modal" data-target="#modal-profile">Update Profile</button>
                            <button type="button" class="btn btn-inverse-success" data-toggle="modal" data-target="#modal-password">Update Password</button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-labelledby="modal-profile" aria-hidden="true" style="display: none;">
                    <form action="<?= base_url('pengaturan/f_profile'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-profile">Update Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama" class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $admin->nama; ?>" style="border: 2px solid #eaeaea;">
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="col-form-label">Foto</label><br>
                                        <img src="<?= base_url('assets/app-assets/user/'); ?><?= $admin->avatar; ?>" class="mb-2 bg-light" alt="admin e-library premium, by abduloh" style="width: 100px;">
                                        <br>
                                        <input type="file" id="image" name="image" accept=".jpg,.png">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="modal-password-label" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-white">
                            <form action="<?= base_url('pengaturan/f_password'); ?>" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-password-label">Update Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="current-password" class="col-form-label">current password</label>
                                        <input type="text" class="form-control" name="password" id="current-password" autocomplete="off" style="border: 2px solid #eaeaea;">
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password" class="col-form-label">new password</label>
                                        <input type="text" name="password2" class="form-control" id="new-password" autocomplete="off" style="border: 2px solid #eaeaea;">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Settings</h4>
                            <?= $this->session->flashdata('setting'); ?>
                            <form action="<?= base_url('pengaturan/f_pengaturan'); ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="footer_1">Footer 1</label>
                                            <input type="text" class="form-control" name="footer_1" id="footer_1" value="<?= $setting->footer_1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="footer_2">Footer 2</label>
                                            <input type="text" class="form-control" name="footer_2" id="footer_2" value="<?= $setting->footer_2; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="logo">Logo</label> <sup class="text-danger">*format harus PNG | MAX File 5MB</sup><br>
                                            <img src="<?= base_url('assets/app-assets/e-library/'); ?>images/<?= $setting->logo; ?>" class="mb-2 bg-light" alt="admin e-library premium, by abduloh" style="width: 295px;">
                                            <input type="file" name="logo" id="logo" accept=".png">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="logo-mini">Logo Mini</label> <sup class="text-danger">*format harus PNG | MAX File 5MB</sup><br>
                                            <img src="<?= base_url('assets/app-assets/e-library/'); ?>images/<?= $setting->logo_mini; ?>" class="mb-2 bg-light" alt="admin e-library premium, by abduloh" style="width: 100px;">
                                            <input type="file" name="logo_mini" id="logo-mini" accept=".png">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-inverse-success float-right">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="w-100 clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"><?= $setting->footer_1; ?></span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><?= $setting->footer_2; ?></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>