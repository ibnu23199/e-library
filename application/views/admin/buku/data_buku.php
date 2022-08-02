<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Buku</h4>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tambah Buku
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -183px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="<?= base_url('books/tambah'); ?>">Tambah</a>
                            <a class="dropdown-item" href="<?= base_url('books/tambah_excel'); ?>">via excel</a>
                        </div>
                    </div>
                    <?= $this->session->flashdata('pesan'); ?>
                    <div class="row mt-3">
                        <div class="col-12 table-responsive">
                            <table id="data-datatables" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($buku as $book) : ?>
                                        <?php $kategori = $this->db->get_where('kategori', ['id_kategori' => $book->kategori_buku])->row(); ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $book->judul_buku; ?></td>
                                            <td><?= $kategori->nama_kategori; ?></td>
                                            <td><?= $book->stok; ?></td>
                                            <td>
                                                <a href="<?= base_url('books/detail/') . encrypt_url($book->kode_buku); ?>" class="btn btn-inverse-primary">Detail</a>
                                                <a href="<?= base_url('books/f_hapus/') . encrypt_url($book->kode_buku); ?>" class="btn btn-inverse-danger btn-hapus">Hapus</a>
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