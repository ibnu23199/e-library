<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Buku (Excel)</h4>
                            <a href="<?= base_url('books/template_excel'); ?>" class="btn btn-inverse-success">Download template</a>
                            <?= $this->session->flashdata('pesan'); ?>
                            <form action="<?= base_url('books/f_tambah_excel'); ?>" method="POST" enctype="multipart/form-data" class="mt-3">
                                <div class="form-group">
                                    <label for="file_excel">File</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="file_excel" class="custom-file-input" id="file_excel" required>
                                            <label class="custom-file-label" for="file_excel">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-inverse-primary"><i class="icon-cloud-upload"></i> Upload</button>
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
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>