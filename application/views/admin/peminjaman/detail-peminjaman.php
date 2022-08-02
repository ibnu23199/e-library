<style>
    input[type=text],
    input[type=date] {
        font-size: 14px;
    }

    tr td input[type=text] {
        border: none;
    }
</style>
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row mt-4">
                <div class="col-lg-5">
                    <div class="card" style="border-left: 4px solid #439aff;">
                        <div class="card-body pb-0">
                            <h4 class="card-title">Detail Peminjam</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Peminjam</th>
                                        <td class="text-left">: <?= $peminjaman->nama_siswa; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tgl Peminjaman</th>
                                        <td class="text-left">: <?= $peminjaman->tgl_peminjaman; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Lama Peminjaman</th>
                                        <td class="text-left">: <?= $peminjaman->lama_peminjaman; ?> Hari</td>
                                    </tr>
                                    <tr>
                                        <th>Batas Pengembalian</th>
                                        <td class="text-left">: <?= $peminjaman->tgl_kembali; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status Peminjaman</th>
                                        <td class="text-left">:
                                            <?php if ($peminjaman->status == 0) : ?>
                                                <span class="badge badge-primary">Belum Dikembalikan</span>
                                            <?php else : ?>
                                                <span class="badge badge-success">DiKembalikan</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Denda <sup class="text-danger">*jika terlambat mengembalikan</sup></th>
                                        <td class="text-left">: Rp.<?= number_format($peminjaman->jumlah_denda); ?> / Hari</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-primary text-wrap">
                                            <!-- <span class="text-danger">*Info</span><br> -->
                                            <?php if ($denda['lewat_batas'] == 0) : ?>
                                                <span class="text-primary">
                                                    *Masih tersisa <strong><?= $denda['hari']; ?></strong> Hari untuk mengembalikan buku sebelum mendapatkan Denda
                                                </span>
                                            <?php endif; ?>

                                            <?php if ($denda['lewat_batas'] == 1 && $peminjaman->status == 0) : ?>
                                                <span class="text-danger">
                                                    *Anda Terlambat <strong><?= $denda['hari']; ?></strong> Hari, Total Denda = Rp. <?= number_format($peminjaman->jumlah_denda * $denda['hari']); ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card" style="border-left: 4px solid #439aff;">
                        <div class="card-body">
                            <h4 class="card-title">List Buku Dipinjam</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <?php foreach ($detail_peminjaman as $dp) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <img src="<?= base_url('assets/app-assets/buku/'); ?><?= $dp->sampul_buku; ?>" alt="" style="width: 80px; height: 80px;">
                                            </td>
                                            <td>
                                                <?= $dp->judul_buku; ?>
                                            </td>
                                            <td>
                                                <?= $dp->jumlah; ?> Buku
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
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