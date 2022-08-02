<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data siswa</h4>
                            <a href="<?= base_url('students/tambah'); ?>" class="btn btn-primary">
                                Tambah Data
                            </a>
                            <?= $this->session->flashdata('pesan'); ?>
                            <div class="table-responsive">
                                <table id="data-datatables" class="table">
                                    <thead>
                                        <tr>
                                            <th>No Induk</th>
                                            <th>Nama</th>
                                            <th>Jurusan</th>
                                            <th>Kelas</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($siswa as $s) : ?>
                                            <tr>
                                                <td><?= $s->no_induk; ?></td>
                                                <td><?= $s->nama_siswa; ?></td>
                                                <td><?= $s->nama_jurusan; ?></td>
                                                <td><?= $s->nama_kelas; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inverse-success text-center edit-siswa" data-no_induk="<?= encrypt_url($s->no_induk); ?>" data-nama_siswa="<?= $s->nama_siswa; ?>" data-jurusan="<?= $s->jurusan; ?>" data-kelas="<?= $s->kelas; ?>">Edit</button>
                                                    <a href="<?= base_url('students/f_hapus/') . encrypt_url($s->no_induk); ?>" class="btn btn-inverse-danger text-center btn-hapus">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit siswa</h4>
                            <form action="<?= base_url('students/f_edit'); ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama_siswa">Nama siswa</label>
                                    <input type="text" name="nama_siswa" class="form-control" id="nama_siswa" disabled required autocomplete="off">
                                    <input type="hidden" name="no_induk" class="form-control" id="no_induk" required>
                                </div>
                                <div class="form-group">
                                    <label for="jurusan">Jurusan / Prodi</label>
                                    <select name="jurusan" class="form-control" disabled required>
                                        <option value=""></option>
                                        <?php foreach ($jurusan as $j) : ?>
                                            <option value="<?= $j->id_jurusan; ?>"><?= $j->nama_jurusan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" class="form-control" disabled required>
                                        <option value=""></option>
                                        <?php foreach ($kelas as $k) : ?>
                                            <option value="<?= $k->id_kelas; ?>"><?= $k->nama_kelas; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="reset" class="btn btn-inverse-warning btn-reset-siswa">Reset</button>
                                <button type="submit" class="btn btn-inverse-success submit-edit-siswa" style="display: none;">Ubah</button>
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
        $('.edit-siswa').click(function() {
            var no_induk = $(this).data('no_induk');
            var nama_siswa = $(this).data('nama_siswa');
            var jurusan = $(this).data('jurusan');
            var kelas = $(this).data('kelas');

            $('input[name=no_induk]').val(no_induk);
            $('input[name=nama_siswa]').val(nama_siswa);
            $('select[name=jurusan]').val(jurusan);
            $('select[name=kelas]').val(kelas);

            $('input[name=nama_siswa]').prop("disabled", false);
            $('select[name=jurusan]').prop("disabled", false);
            $('select[name=kelas]').prop("disabled", false);
            $('.submit-edit-siswa').css("display", 'inline-block');
        });

        $('.btn-reset-siswa').click(function() {
            $('input[name=nama_siswa]').prop("disabled", true);
            $('select[name=jurusan]').prop("disabled", true);
            $('select[name=kelas]').prop("disabled", true);
            $('.submit-edit-siswa').css("display", 'none');
        });
    });
</script>