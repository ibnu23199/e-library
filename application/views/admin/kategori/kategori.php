<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Kategori</h4>
                            <a href="<?= base_url('category/tambah'); ?>" class="btn btn-primary">
                                Tambah Data
                            </a>
                            <?= $this->session->flashdata('pesan'); ?>
                            <div class="table-responsive mt-3">
                                <table id="data-datatables" class="table">
                                    <thead>
                                        <tr>
                                            <th>Id Kategori</th>
                                            <th>Kategori</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kategori as $k) : ?>
                                            <tr>
                                                <td><?= $k->id_kategori; ?></td>
                                                <td><?= $k->nama_kategori; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inverse-success text-center edit-kategori" data-id_kategori="<?= encrypt_url($k->id_kategori); ?>" data-nama_kategori="<?= $k->nama_kategori; ?>">Edit</button>
                                                    <a href="<?= base_url('category/f_hapus/') . encrypt_url($k->id_kategori); ?>" class="btn btn-inverse-danger text-center btn-hapus">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Kategori</h4>
                            <form action="<?= base_url('category/f_edit'); ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" disabled required autocomplete="off">
                                    <input type="hidden" name="id_kategori" class="form-control" id="nama_kategori" required>
                                </div>
                                <button type="reset" class="btn btn-inverse-warning btn-reset-kategori">Reset</button>
                                <button type="submit" class="btn btn-inverse-success submit-edit-kategori" style="display: none;">Ubah</button>
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