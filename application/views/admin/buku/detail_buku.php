<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card" style="border-left: 4px solid #439aff;">
                        <div class="card-body">
                            <h4 class="card-title">Detail Buku</h4>
                            <?= $this->session->flashdata('pesan'); ?>
                            <div class="row mt-3">
                                <div class="col-lg-4">
                                    <img src="<?= base_url('assets/app-assets/buku/') . $buku->sampul_buku; ?>" alt="" style="width: 250px; height: 250px;">
                                </div>
                                <div class="col-lg-8">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kode Buku</th>
                                                <th>Judul Buku</th>
                                                <th>Kategori</th>
                                                <th>Genre</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $buku->kode_buku; ?></td>
                                                <td><?= $buku->judul_buku; ?></td>
                                                <td><?= $buku->nama_kategori; ?></td>
                                                <td><?= $buku->nama_genre; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Penulis</th>
                                                <th>Penerbit</th>
                                                <th>Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $buku->penulis; ?></td>
                                                <td><?= $buku->penerbit; ?></td>
                                                <td><?= $buku->stok; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-inverse-success edit-buku mt-3">Edit</button>
                                <a href="<?= base_url('books'); ?>" class="btn btn-inverse-danger ml-3 mt-3">Kembali</a>
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

<div class="row popup-buku" style="position: absolute; left: 50%; top: -80%; transform: translate(-50%, -50%); z-index: 999; width: 100%; transition: 1s;">
    <div class="col-lg-3 col-md-3"></div>
    <div class="col-lg-6 col-md-6 shadow-lg">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Buku</h4>
                <form action="<?= base_url('books/f_edit/'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" value="<?= $buku->judul_buku; ?>" required autocomplete="off">
                        <input type="hidden" name="kode_buku" class="form-control" id="kode_buku" value="<?= encrypt_url($buku->kode_buku); ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori_buku" id="kategori" class="form-control" required>
                                    <?php foreach ($kategori as $k) : ?>
                                        <?php if ($k->id_kategori == $buku->kategori_buku) : ?>
                                            <option value="<?= $k->id_kategori; ?>" selected><?= $k->nama_kategori; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="genre">Genre</label>
                                <select name="genre_buku" id="genre" class="form-control" required>
                                    <?php foreach ($genre as $g) : ?>
                                        <?php if ($g->id_genre == $buku->genre_buku) : ?>
                                            <option value="<?= $g->id_genre; ?>" selected><?= $g->nama_genre; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $g->id_genre; ?>"><?= $g->nama_genre; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input type="text" name="penulis" class="form-control" id="penulis" value="<?= $buku->penulis; ?>" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="penerbit">penerbit</label>
                                <input type="text" name="penerbit" class="form-control" id="penerbit" value="<?= $buku->penerbit; ?>" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="text" name="stok" class="form-control" id="stok" value="<?= $buku->stok; ?>" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <img src="<?= base_url('assets/app-assets/buku/') . $buku->sampul_buku; ?>" alt="" style="width: 150px; height: 150px;">
                    <input type="file" name="sampul" class="ml-2" id="">
                    <br>
                    <button type="button" class="btn btn-inverse-warning btn-reset-buku">Reset</button>
                    <button type="submit" class="btn btn-inverse-success">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.edit-buku').click(function() {
            $('.popup-buku').css('top', '50%');
        });

        $('.btn-reset-buku').click(function() {
            $('.popup-buku').css('top', '-80%');
        });
    });
</script>