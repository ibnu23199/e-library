<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Denda Terlambat</h4>
                            <a href="<?= base_url('denda/tambah/') . encrypt_url(1); ?>" class="btn btn-primary">
                                Tambah Data
                            </a>
                            <?= $this->session->flashdata('pesan'); ?>
                            <div class="table-responsive mt-3">
                                <table id="data-datatables" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>nominal</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($denda as $d) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $d->nama_denda; ?></td>
                                                <td>Rp. <?= number_format($d->jumlah_denda); ?>/Hari</td>
                                                <td>
                                                    <button type="button" class="btn btn-inverse-success edit-denda1" data-id_denda="<?= encrypt_url($d->id_denda); ?>" data-nama_denda="<?= $d->nama_denda; ?>" data-jumlah_denda="<?= $d->jumlah_denda; ?>">Edit</button>
                                                    <a href="<?= base_url('denda/f_hapus/') . encrypt_url($d->id_denda) . '/'; ?>" class="btn btn-inverse-danger btn-hapus">Hapus</a>
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
                            <h4 class="card-title">Denda Lainnya</h4>
                            <a href="<?= base_url('denda/tambah/') . encrypt_url(2); ?>" class="btn btn-primary">
                                Tambah Data
                            </a>
                            <?= $this->session->flashdata('pesan2'); ?>
                            <div class="table-responsive mt-3">
                                <table id="data-datatables2" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($denda_lainnya as $dl) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dl->nama_denda; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inverse-success edit-denda2" data-id_denda="<?= encrypt_url($dl->id_denda); ?>" data-nama_denda="<?= $dl->nama_denda; ?>" data-jumlah_denda="<?= $dl->jumlah_denda; ?>">Edit</button>
                                                    <a href="<?= base_url('denda/f_hapus/') . encrypt_url($dl->id_denda) . '/2'; ?>" class="btn btn-inverse-danger btn-hapus">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row popup-denda" style="position: absolute; left: 50%; top: -50%; transform: translate(-50%, -50%); z-index: 999; width: 100%; transition: 1s;">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6 shadow-lg">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Denda Terlambat</h4>
                            <form action="<?= base_url('denda/f_edit/'); ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama_denda1">Nama Denda</label>
                                    <input type="text" name="nama_denda1" class="form-control" id="nama_denda1" required autocomplete="off">
                                    <input type="hidden" name="id_denda1" class="form-control" id="id_denda1" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_denda">Jumlah Denda / Hari</label>
                                    <input type="number" name="jumlah_denda" class="form-control" id="jumlah_denda" required autocomplete="off">
                                </div>
                                <button type="reset" class="btn btn-inverse-warning btn-reset-denda1">Reset</button>
                                <button type="submit" class="btn btn-inverse-success submit-edit-denda1">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row popup-denda2" style="position: absolute; left: 50%; top: -50%; transform: translate(-50%, -50%); z-index: 999; width: 100%; transition: 1s;">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6 shadow-lg">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Denda Terlambat</h4>
                            <form action="<?= base_url('denda/f_edit/')  . 2; ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama_denda2">Nama Denda</label>
                                    <input type="text" name="nama_denda2" class="form-control" id="nama_denda2" required autocomplete="off">
                                    <input type="hidden" name="id_denda2" class="form-control" id="id_denda2" required>
                                </div>
                                <button type="reset" class="btn btn-inverse-warning btn-reset-denda2">Reset</button>
                                <button type="submit" class="btn btn-inverse-success submit-edit-denda2">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class=" footer">
            <div class="w-100 clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"><?= $setting->footer_1; ?></span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><?= $setting->footer_2; ?></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>