<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Laporan Pengembalian</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="from">Dari Tanggal</label>
                                        <input type="date" name="from" id="from" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="to">Sampai Tanggal</label>
                                        <input type="date" name="to" id="to" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary cari"><i class="icon-magnifier"></i>Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="isi-laporan">
                                <div class="alert alert-danger">Pilih Tanggal Terlebih Dahulu</div>
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
<script>
    $(document).ready(function() {
        $('.cari').click(function() {
            var from = $('input[name=from]').val();
            var to = $('input[name=to]').val();

            if (from == '' && to == '') {
                var html = '<div class="alert alert-danger">Kolom Tanggal Tidak Boleh Kosong</div>';
                $('#isi-laporan').html(html);
            } else {
                $.ajax({
                    type: 'POST',
                    data: {
                        from: from,
                        to: to
                    },
                    url: "<?= base_url('pengembalian/filter_laporan') ?>",
                    async: true,
                    success: function(data) {
                        $('#isi-laporan').html(data);
                    }
                })
            }
        });
    });
</script>