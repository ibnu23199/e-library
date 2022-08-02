<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Genre</h4>
                            <a href="<?= base_url('genre/tambah'); ?>" class="btn btn-primary">
                                Tambah Data
                            </a>
                            <?= $this->session->flashdata('pesan'); ?>
                            <div class="table-responsive">
                                <table id="data-datatables" class="table">
                                    <thead>
                                        <tr>
                                            <th>Id Genre</th>
                                            <th>Genre</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($genre as $g) : ?>
                                            <tr>
                                                <td><?= $g->id_genre; ?></td>
                                                <td><?= $g->nama_genre; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inverse-success text-center edit-genre" data-id_genre="<?= encrypt_url($g->id_genre); ?>" data-nama_genre="<?= $g->nama_genre; ?>">Edit</button>
                                                    <a href="<?= base_url('genre/f_hapus/') . encrypt_url($g->id_genre); ?>" class="btn btn-inverse-danger text-center btn-hapus">Hapus</a>
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
                            <h4 class="card-title">Edit Genre</h4>
                            <form action="<?= base_url('genre/f_edit'); ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama_genre">Nama Genre</label>
                                    <input type="text" name="nama_genre" class="form-control" id="nama_genre" disabled required autocomplete="off">
                                    <input type="hidden" name="id_genre" class="form-control" id="nama_genre" required>
                                </div>
                                <button type="reset" class="btn btn-inverse-warning btn-reset-genre">Reset</button>
                                <button type="submit" class="btn btn-inverse-success submit-edit-genre" style="display: none;">Ubah</button>
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