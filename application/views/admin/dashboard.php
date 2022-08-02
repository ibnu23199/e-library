<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card card-statistics">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <div class="d-flex justify-content-between border-right card-statistics-item">
                                        <div>
                                            <h1 class="text-center"><?= count($buku); ?></h1>
                                            <p class="text-muted mb-0">Total Buku</p>
                                        </div>
                                        <i class="icon-book-open text-primary icon-lg"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="d-flex justify-content-between border-right card-statistics-item">
                                        <div>
                                            <h1 class="text-center"><?= count($siswa); ?></h1>
                                            <p class="text-muted mb-0">Students</p>
                                        </div>
                                        <i class="icon-people text-primary icon-lg"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="d-flex justify-content-between border-right card-statistics-item">
                                        <div>
                                            <h1 class="text-center"><?= count($peminjaman); ?></h1>
                                            <p class="text-muted mb-0">Peminjaman</p>
                                        </div>
                                        <i class="icon-refresh text-primary icon-lg"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="d-flex justify-content-between card-statistics-item">
                                        <div>
                                            <h1 class="text-center"><?= count($pengembalian); ?></h1>
                                            <p class="text-muted mb-0">Pengembalian</p>
                                        </div>
                                        <i class="icon-refresh text-primary icon-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Calendar</h4>
                            <div id="inline-datepicker-example" class="datepicker"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card" style="border-left: 4px solid #439aff;">
                        <div class="card-body">
                            <h5 class="pb-3">CEK DATA</h5>
                            <ul class="nav nav-tabs tab-basic" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#cek-buku" role="tab" aria-controls="cek-buku" aria-selected="true">Cek Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#cek-peminjaman" role="tab" aria-controls="cek-peminjaman" aria-selected="false">Cek Peminjaman</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-content-basic">
                                <div class="tab-pane fade active show" id="cek-buku" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="form-group">
                                        <input type="text" name="barcode_buku" class="form-control" style="text-align: center; height: 50px; font-size: 20px;" autofocus autocomplete="off">
                                        <div id="data-buku"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cek-peminjaman" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="form-group">
                                        <input type="text" name="barcode_peminjaman" class="form-control" style="text-align: center; height: 50px; font-size: 20px;" autocomplete="off">
                                        <div id="data-peminjaman"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
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
        $('input[name=barcode_buku]').on('propertychange input', function(e) {
            var barcode = $('input[name=barcode_buku]').val();

            var valueChanged = false;

            if (e.type == 'propertychange') {
                valueChanged = e.originalEvent.propertyName == 'value';
            } else {
                valueChanged = true;
            }
            if (valueChanged) {
                /* Code goes here */
                $.ajax({
                    type: 'POST',
                    data: {
                        barcode: barcode
                    },
                    url: "<?= base_url('app/ajax_buku') ?>",
                    async: true,
                    success: function(data) {
                        $('#data-buku').html(data);
                    }
                });
            }

        });

        $('input[name=barcode_peminjaman]').on('propertychange input', function(e) {
            var barcode = $('input[name=barcode_peminjaman]').val();

            var valueChanged = false;

            if (e.type == 'propertychange') {
                valueChanged = e.originalEvent.propertyName == 'value';
            } else {
                valueChanged = true;
            }
            if (valueChanged) {
                /* Code goes here */
                $.ajax({
                    type: 'POST',
                    data: {
                        barcode: barcode
                    },
                    url: "<?= base_url('app/ajax_peminjaman') ?>",
                    async: true,
                    success: function(data) {
                        $('#data-peminjaman').html(data);
                    }
                });
            }

        });
    });
</script>