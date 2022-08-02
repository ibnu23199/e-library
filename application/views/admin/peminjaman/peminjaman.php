<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Peminjaman</h4>
                    <a href="<?= base_url('peminjaman/tambah'); ?>" class="btn btn-primary">
                        Tambah Data
                    </a>
                    <a href="<?= base_url('peminjaman/laporan'); ?>" class="btn btn-warning">Laporan</a>
                    <?= $this->session->flashdata('pesan'); ?>
                    <div class="row mt-3">
                        <div class="col-12 table-responsive">
                            <table id="data-datatables" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Lama Pinjam</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($peminjaman as $peminjam) : ?>
                                        <?php
                                        $this->db->select_sum('jumlah');
                                        $this->db->where('kode_peminjaman', $peminjam->kode_peminjaman);
                                        $query = $this->db->get('detail_peminjaman')->row(); ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $peminjam->nama_siswa; ?></td>
                                            <td><?= $peminjam->tgl_peminjaman; ?></td>
                                            <td><?= $peminjam->lama_peminjaman ?> Hari</td>
                                            <td><?= $query->jumlah ?> Buku</td>
                                            <td>
                                                <?php if ($peminjam->status == 0) : ?>
                                                    <span class="badge badge-warning">Belum Selesai</span>
                                                <?php else : ?>
                                                    <span class="badge badge-success">Selesai</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Option
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="<?= base_url('peminjaman/detail/') . encrypt_url($peminjam->kode_peminjaman); ?>">Detail</a>
                                                        <?php if ($peminjam->status == 0) : ?>
                                                            <a class="dropdown-item" href="<?= base_url('peminjaman/barcode/') . encrypt_url($peminjam->kode_peminjaman); ?>">Barcode</a>
                                                            <a class="dropdown-item" href="<?= base_url('peminjaman/edit/') . encrypt_url($peminjam->kode_peminjaman); ?>">Edit</a>
                                                            <a class="dropdown-item btn-hapus" href="<?= base_url('peminjaman/f_hapus/') . encrypt_url($peminjam->kode_peminjaman); ?>">Hapus</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
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