<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Kelas</h4>
                            <a href="<?= base_url('kelas/tambah'); ?>" class="btn btn-primary">
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
                                        foreach ($kelas as $k) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $k->nama_kelas; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inverse-success text-center edit-kelas" data-id_kelas="<?= encrypt_url($k->id_kelas); ?>" data-nama_kelas="<?= $k->nama_kelas; ?>">Edit</button>
                                                    <a href="<?= base_url('kelas/f_hapus/') . encrypt_url($k->id_kelas); ?>" class="btn btn-inverse-danger text-center btn-hapus">Hapus</a>
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
                            <h4 class="card-title">Edit kelas</h4>
                            <form action="<?= base_url('kelas/f_edit'); ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama_kelas">Nama kelas</label>
                                    <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" disabled required autocomplete="off">
                                    <input type="hidden" name="id_kelas" class="form-control" id="id_kelas" required>
                                </div>
                                <button type="reset" class="btn btn-inverse-warning btn-reset-kelas">Reset</button>
                                <button type="submit" class="btn btn-inverse-success submit-edit-kelas" style="display: none;">Ubah</button>
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
        $('.edit-kelas').click(function() {
            var id_kelas = $(this).data('id_kelas');
            var nama_kelas = $(this).data('nama_kelas');

            $('input[name=id_kelas]').val(id_kelas);
            $('input[name=nama_kelas]').val(nama_kelas);
            $('input[name=nama_kelas]').prop("disabled", false);
            $('.submit-edit-kelas').css("display", 'inline-block');
        });

        $('.btn-reset-kelas').click(function() {
            $('input[name=nama_kelas]').prop("disabled", true);
            $('.submit-edit-kelas').css("display", 'none');
        });
    });
</script>