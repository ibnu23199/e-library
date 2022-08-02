<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Jurusan / Prodi</h4>
                            <a href="<?= base_url('jurusan/tambah'); ?>" class="btn btn-primary">
                                Tambah Data
                            </a>
                            <?= $this->session->flashdata('pesan'); ?>
                            <div class="table-responsive">
                                <table id="data-datatables" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($jurusan as $j) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $j->nama_jurusan; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inverse-success text-center edit-jurusan" data-id_jurusan="<?= encrypt_url($j->id_jurusan); ?>" data-nama_jurusan="<?= $j->nama_jurusan; ?>">Edit</button>
                                                    <a href="<?= base_url('jurusan/f_hapus/') . encrypt_url($j->id_jurusan); ?>" class="btn btn-inverse-danger text-center btn-hapus">Hapus</a>
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
                            <h4 class="card-title">Edit jurusan</h4>
                            <form action="<?= base_url('jurusan/f_edit'); ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama_jurusan">Nama Jurusan</label>
                                    <input type="text" name="nama_jurusan" class="form-control" id="nama_jurusan" disabled required autocomplete="off">
                                    <input type="hidden" name="id_jurusan" class="form-control" id="id_jurusan" required>
                                </div>
                                <button type="reset" class="btn btn-inverse-warning btn-reset-jurusan">Reset</button>
                                <button type="submit" class="btn btn-inverse-success submit-edit-jurusan" style="display: none;">Ubah</button>
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

<script>
    $(document).ready(function() {
        $('.edit-jurusan').click(function() {
            var id_jurusan = $(this).data('id_jurusan');
            var nama_jurusan = $(this).data('nama_jurusan');

            $('input[name=id_jurusan]').val(id_jurusan);
            $('input[name=nama_jurusan]').val(nama_jurusan);
            $('input[name=nama_jurusan]').prop("disabled", false);
            $('.submit-edit-jurusan').css("display", 'inline-block');
        });

        $('.btn-reset-jurusan').click(function() {
            $('input[name=nama_jurusan]').prop("disabled", true);
            $('.submit-edit-jurusan').css("display", 'none');
        });
    });
</script>