<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Kelas</h4>
                            <button type="button" class="btn btn-primary tambah-baris-kelas">
                                Tambah Baris
                            </button>
                            <form action="<?= base_url('kelas/f_tambah'); ?>" method="POST">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th class="text-center">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-data-kelas">
                                            <tr>
                                                <td><input type="text" name="nama_kelas[]" class="form-control" required style="width: 100%; border: none; font-size: 14px;" required autofocus></td>
                                                <td class="text-center"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-inverse-success mt-3"><i class="icon-cloud-upload"></i> Simpan</button>
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
        $('.tambah-baris-kelas').click(function() {
            var baru = `
                <tr>
                    <td><input type="text" name="nama_kelas[]" class="form-control" required style="width: 100%; border: none; font-size: 14px;" required autofocus></td>
                    <td class="text-center"><button type="button" class="btn btn-icons btn-inverse-danger remove-baris-admin"><i class="icon-trash"></i></button></td>
                </tr>
           `;
            $('#tbody-data-kelas').append(baru);
        });

        $('#tbody-data-kelas').on('click', 'tr td button', function() {
            $(this).parents('tr').remove();
        });
    })
</script>