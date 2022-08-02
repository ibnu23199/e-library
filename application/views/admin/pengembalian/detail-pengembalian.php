<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card px-2">
                        <div class="card-body">
                            <div class="container-fluid">
                                <h3 class="text-right mb-4">Pengembalian #<?= $pengembalian->kode_peminjaman; ?></h3>
                                <hr>
                            </div>
                            <div class="container-fluid d-flex justify-content-between">
                                <div class="col-lg-3 pl-0">
                                    <p class="mt-2 mb-2"><b>Peminjam</b></p>
                                    <?php $kelas = $this->db->get_where('kelas', ['id_kelas' => $pengembalian->kelas])->row(); ?>
                                    <?php $jurusan = $this->db->get_where('jurusan', ['id_jurusan' => $pengembalian->jurusan])->row(); ?>
                                    <p><?= $pengembalian->nama_siswa; ?><br><?= $pengembalian->no_induk; ?><br><?= $jurusan->nama_jurusan; ?> - <?= $kelas->nama_kelas; ?></p>
                                </div>
                                <div class="col-lg-3 pr-0">
                                    <p class="mt-2 mb-2 text-right"><b>Pengembalian</b></p>
                                    <p class="text-right">Tanggal Pinjam : <?= $pengembalian->tgl_peminjaman; ?>,<br> Batas pengembalian : <?= $pengembalian->tgl_kembali; ?>,<br> Tanggal Pengembalian : <?= date('d-M-Y', time()); ?>.</p>
                                </div>
                            </div>
                            <div class="container-fluid mt-2 d-flex justify-content-center w-100">
                                <div class="table-responsive w-100">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>#</th>
                                                <th>Judul Buku</th>
                                                <th class="text-right">Quantity</th>
                                                <th class="text-right">Kondisi Buku</th>
                                                <th class="text-right">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($detail_pengembalian as $dp) : ?>
                                                <tr class="text-right">
                                                    <td class="text-left"><?= $no++; ?></td>
                                                    <td class="text-left"><?= $dp->judul_buku; ?></td>
                                                    <td><?= $dp->jumlah_buku; ?></td>
                                                    <td>
                                                        <?php if ($dp->status_buku == 0) : ?>
                                                            Normal
                                                        <?php else : ?>
                                                            <?php $denda = $this->db->get_where('denda', ['id_denda' => $dp->status_buku])->row() ?>
                                                            <span class="text-danger"><?= $denda->nama_denda; ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $dp->jumlah_hilang_rusak; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="container-fluid mt-5 w-100">
                                <?php if ($pengembalian->terlambat == 0) : ?>
                                    <p class="text-right mb-2">
                                        Status Pengembalian <br>
                                        <span class="text-primary">Tidak Terlambat</span>
                                    </p>
                                <?php endif; ?>

                                <?php if ($pengembalian->terlambat == 1) : ?>
                                    <p class="text-right mb-2">
                                        Status Pengembalian <br>
                                        <span class="text-danger">Terlambat <strong><?= $status_denda['hari']; ?></strong> Hari</span>
                                        <br>
                                        Denda Terlambat Rp. <?= number_format($peminjaman->jumlah_denda * $status_denda['hari']) ?>
                                    </p>
                                <?php endif; ?>
                                <p class="text-right">
                                    Denda Lainnya Rp. <?= number_format($pengembalian->jumlah_denda_lainnya); ?>
                                </p>
                                <h4 class="text-right mb-2">Total Denda : Rp. <span><?= number_format($pengembalian->total_denda); ?></span></h4>
                                <hr>
                            </div>
                            <div class="container-fluid w-100">
                                <a href="<?= base_url('pengembalian'); ?>" class="btn btn-danger float-right"><i class="icon-action-redo mr-1"></i>Kembali</a>
                            </div>
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

<script>
    $(document).ready(function() {
        $('input[name=jumlah_denda_lainnya]').on('propertychange input', function(e) {
            var jumlah_denda_terlambat = parseInt($('input[name=jumlah_denda_terlambat]').val());
            var denda_lainnya = parseInt($('input[name=jumlah_denda_lainnya]').val());

            var total_denda = (jumlah_denda_terlambat + denda_lainnya);
            $('#total-denda').html(total_denda);
            $('input[name=total_denda]').val(total_denda);
        })
    });
</script>