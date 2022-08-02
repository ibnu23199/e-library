<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card px-2">
                        <form action="<?= base_url('pengembalian/f_tambah'); ?>" method="post">
                            <input type="hidden" name="kode_peminjaman" value="<?= $peminjaman->kode_peminjaman; ?>">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <h3 class="text-right mb-4">Pengembalian #<?= $peminjaman->kode_peminjaman; ?></h3>
                                    <hr>
                                </div>
                                <div class="container-fluid d-flex justify-content-between">
                                    <div class="col-lg-3 pl-0">
                                        <p class="mt-2 mb-2"><b>Peminjam</b></p>
                                        <p><?= $peminjaman->nama_siswa; ?><br><?= $peminjaman->siswa; ?></p>
                                        <input type="hidden" name="no_induk_siswa" value="<?= $peminjaman->siswa; ?>">
                                    </div>
                                    <div class="col-lg-3 pr-0">
                                        <p class="mt-2 mb-2 text-right"><b>Pengembalian</b></p>
                                        <p class="text-right">Tanggal Pinjam : <?= $peminjaman->tgl_peminjaman; ?>,<br> Batas pengembalian : <?= $peminjaman->tgl_kembali; ?>,<br> Tanggal Pengembalian : <?= date('d-M-Y', time()); ?>.</p>
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
                                                foreach ($detail_peminjaman as $dp) : ?>
                                                    <tr class="text-right">
                                                        <td class="text-left"><?= $no++; ?></td>
                                                        <td class="text-left"><?= $dp->judul_buku; ?></td>
                                                        <td><?= $dp->jumlah; ?></td>
                                                        <td>
                                                            <input type="hidden" name="jumlah_buku[]" value="<?= $dp->jumlah; ?>">
                                                            <input type="hidden" name="kode_buku[]" value="<?= $dp->kode_buku; ?>">
                                                            <select name="status_buku[]" class="form-control">
                                                                <?php foreach ($data_denda as $d) : ?>
                                                                    <option value="0">Normal</option>
                                                                    <option value="<?= $d->id_denda; ?>"><?= $d->nama_denda; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="jumlah_hilang_rusak[]" class="form-control" value="<?= $dp->jumlah; ?>" max="<?= $dp->jumlah; ?>">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="container-fluid mt-5 w-100">
                                    <?php if ($denda['lewat_batas'] == 0) : ?>
                                        <span class="text-primary">
                                            <p class="text-right mb-2">Belum Terlambat</p>
                                            <input type="hidden" name="terlambat" value="0">
                                            <input type="hidden" name="jumlah_denda_terlambat" value="0">
                                        </span>
                                    <?php endif; ?>

                                    <?php if ($denda['lewat_batas'] == 1 && $peminjaman->status == 0) : ?>
                                        <span class="text-danger">
                                            <p class="text-right">*Anda Terlambat <strong><?= $denda['hari']; ?></strong> Hari <br>
                                                Total Denda = Rp. <?= number_format($peminjaman->jumlah_denda * $denda['hari']); ?>
                                            </p>
                                            <input type="hidden" name="terlambat" value="1">
                                            <input type="hidden" name="jumlah_denda_terlambat" value="<?= ($peminjaman->jumlah_denda * $denda['hari']); ?>">
                                        </span>
                                    <?php endif; ?>
                                    <div class="d-f float-right">
                                        <div class="form-group">
                                            <label for="">Denda Lainnya</label>
                                            <input type="number" name="jumlah_denda_lainnya" class="form-control" value="" style="width: 200px;">
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <?php if ($denda['lewat_batas'] == 1 && $peminjaman->status == 0) : ?>
                                        <h4 class="text-right mb-2">Total Denda : Rp. <span id="total-denda"><?= ($peminjaman->jumlah_denda * $denda['hari']); ?></span></h4>
                                        <input type="hidden" name="total_denda" value="<?= ($peminjaman->jumlah_denda * $denda['hari']); ?>">
                                    <?php else : ?>
                                        <h4 class="text-right mb-2">Total Denda : Rp. <span id="total-denda">0</span></h4>
                                        <input type="hidden" name="total_denda" value="0">
                                    <?php endif; ?>
                                    <hr>
                                </div>
                                <div class="container-fluid w-100">
                                    <button type="submit" class="btn btn-success float-right mb-3"><i class="icon-action-redo mr-1"></i>Kirim</button>
                                </div>
                            </div>
                        </form>
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