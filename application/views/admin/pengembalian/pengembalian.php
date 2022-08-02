<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Pengembalian</h4>
                    <button type="button" class="btn btn-primary tambah-pengembalian">
                        Tambah Data
                    </button>
                    <a href="<?= base_url('pengembalian/laporan'); ?>" class="btn btn-warning">Laporan</a>
                    <?= $this->session->flashdata('pesan'); ?>
                    <div class="row mt-3">
                        <div class="col-12 table-responsive">
                            <table id="data-datatables" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Lama Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pengembalian as $kembali) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $kembali->kode_peminjaman; ?></td>
                                            <td><?= $kembali->nama_siswa; ?></td>
                                            <td><?= $kembali->tgl_peminjaman; ?></td>
                                            <td><?= $kembali->lama_peminjaman ?> Hari</td>
                                            <td><?= $kembali->tgl_pengembalian ?></td>
                                            <td>
                                                <?php if ($kembali->terlambat == 0) : ?>
                                                    <span class="badge badge-success">Sukses</span>
                                                <?php else : ?>
                                                    <span class="badge badge-danger">Terlambat</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-inverse-primary" href=" <?= base_url('pengembalian/detail/') . encrypt_url($kembali->kode_peminjaman); ?>">Detail</a>
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

<div class="row popup-pengembalian" style="position: absolute; left: 50%; top: -50%; transform: translate(-50%, -50%); z-index: 999; width: 100%; transition: 1s;">
    <div class="col-lg-3 col-md-3"></div>
    <div class="col-lg-6 col-md-6 shadow-lg">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengembalian Buku</h4>
                <form action="<?= base_url('pengembalian/tambah/')  . 2; ?>" method="GET">
                    <div class="form-group">
                        <input type="text" name="kode_peminjaman" class="form-control" id="kode_peminjaman" required autocomplete="off">
                    </div>
                    <button type="reset" class="btn btn-inverse-warning btn-reset-pengembalian">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>