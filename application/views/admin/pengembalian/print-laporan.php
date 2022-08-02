<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Library - Premium Apps By Abduloh | Aplications</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/iconfonts/simple-line-icon/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="<?= base_url('assets/app-assets/e-library/'); ?>vendors/notiflix/notiflix-2.7.0.min.css">
    <!-- endinject -->
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

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3>E-Library BY ABDUL MALELA</h3>
                    <p>Jln. Nakula, Dsn. Cilempung, Ds. Pasirjaya, Kec. Cilamaya Kulon, Kab. Karawang </p>
                    <p style="margin-top: -15px;">Telp (021) 976 866, mail abdulohmalela10@gmail.com, HP. 08756545345765</p>
                    <hr>
                </div>
                <h4 class="text-center">Laporan Pengembalian</h4>
                <table cellpadding="10" style="border: none;">
                    <tr>
                        <th>Mulai Tanggal :</th>
                        <td><?= $from; ?></td>
                    </tr>
                    <tr>
                        <th>Sampai Tanggal :</th>
                        <td><?= $to; ?></td>
                    </tr>
                </table>

                <table class="table table-bordered text-center mt-3" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Peminjaman</th>
                            <th>Nama</th>
                            <th>Tgl Pinjam</th>
                            <th>Lama Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pengembalian as $p) : ?>

                            <tr>
                                <td> <?= $no++; ?> </td>
                                <td><?= $p->kode_peminjaman; ?></td>
                                <td><?= $p->nama_siswa; ?></td>
                                <td><?= date('d-M-Y', strtotime($p->tgl_peminjaman)); ?></td>
                                <td><?= $p->lama_peminjaman; ?> Hari</td>
                                <td><?= date('d-M-Y', strtotime($p->tgl_pengembalian)); ?></td>
                                <td>
                                    <?php
                                    if ($p->terlambat == 0) {
                                        echo "Sukses";
                                    } else {
                                        echo "Terlambat";
                                    }
                                    ?>
                                </td>
                                <td>Rp. <?= number_format($p->total_denda); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7" class="text-left">
                                Total
                            </th>
                            <th>
                                <?= count($pengembalian); ?> Transaksi
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    window.print();
</script>