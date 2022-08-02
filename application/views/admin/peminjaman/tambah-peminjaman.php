<style>
    input[type=text],
    input[type=date] {
        font-size: 14px;
    }

    tr td input[type=text] {
        border: none;
    }
</style>
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <form action="<?= base_url('peminjaman/f_tambah'); ?>" method="POST">
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambah Peminjam</h4>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="siswa">Siswa</label>
                                            <select name="siswa" id="siswa" class="select2 form-control" required>
                                                <option value="">pilih siswa</option>
                                                <?php foreach ($siswa as $s) : ?>
                                                    <option value="<?= $s->no_induk; ?>"><?= $s->nama_siswa; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="lama_peminjaman">Lama Pinjam</label>
                                            <div class="input-group">
                                                <input type="number" name="lama_peminjaman" class="form-control" required>
                                                <div class="input-group-append bg-light">
                                                    <span class="input-group-text">HARI</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="denda">Jenis Denda <small class="text-danger">(Jika Terlambat Mengembalikan)</small></label>
                                            <select name="denda" id="denda" class="select2 form-control" required>
                                                <option value="">pilih denda</option>
                                                <?php foreach ($denda as $d) : ?>
                                                    <option value="<?= $d->id_denda; ?>"><?= $d->nama_denda; ?> ( <?= $d->jumlah_denda; ?> / Hari )</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs tab-basic justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#barcode" role="tab" aria-controls="barcode" aria-selected="true">Barcode</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#manual" role="tab" aria-controls="manual" aria-selected="false">Manual</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade active show" id="barcode" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="form-group">
                                            <input type="text" name="f_barcode" class="form-control text-center barcode" autofocus autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="manual" role="tabpanel" aria-labelledby="profile-tab">
                                        <select id="manual_input" name="manual_input" class="select2" style="width: 100%;">
                                            <option value="">cari buku</option>
                                            <?php foreach ($buku as $b) : ?>
                                                <option value="<?= $b->kode_buku; ?>" data-judul_buku="<?= $b->judul_buku; ?>" data-kategori_buku="<?= $b->kategori_buku; ?>" data-genre_buku="<?= $b->genre_buku; ?>" data-nama_kategori="<?= $b->nama_kategori; ?>" data-nama_genre="<?= $b->nama_genre; ?>" data-sampul_buku="<?= $b->sampul_buku; ?>"><?= $b->judul_buku; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div id="sampul-buku">
                                        <img src="<?= base_url('assets/app-assets/buku/'); ?>default.png" alt="" style="width: 150px; height: 150px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="judul_buku">Judul Buku</label>
                                        <input type="hidden" name="f_kode_buku" id='kode_buku' class="form-control" disabled>
                                        <input type="text" name="f_judul_buku" id='judul_buku' class="form-control" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select name="f_kategori" id='kategori' class="form-control" disabled>
                                                    <option value=""></option>
                                                    <?php foreach ($kategori as $k) : ?>
                                                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="genre">Genre</label>
                                                <select name="f_genre" id='genre' class="form-control" disabled>
                                                    <option value=""></option>
                                                    <?php foreach ($genre as $g) : ?>
                                                        <option value="<?= $g->id_genre; ?>"><?= $g->nama_genre; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" name="f_jumlah" id='jumlah' class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <br>
                                                <button type="button" class="btn btn-inverse-success baris-pinjam">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Buku</th>
                                                <th>Jumlah</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="list-buku-dipinjam">

                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-inverse-primary mt-3">simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
        $('.select2').select2();

        $('#manual_input').change(function() {
            if ($('select[name=manual_input] option:selected').val() != "") {
                var kode_buku = $('select[name=manual_input] option:selected').val();
                var judul_buku = $('select[name=manual_input] option:selected').data('judul_buku');
                var kategori_buku = $('select[name=manual_input] option:selected').data('kategori_buku');
                var genre_buku = $('select[name=manual_input] option:selected').data('genre_buku');
                var nama_kategori = $('select[name=manual_input] option:selected').data('nama_kategori');
                var nama_genre = $('select[name=manual_input] option:selected').data('nama_genre');
                var sampul_buku = $('select[name=manual_input] option:selected').data('sampul_buku');

                var img = `
                    <img src="<?= base_url('assets/app-assets/buku/'); ?>` + sampul_buku + `" alt="" style="width: 150px; height: 150px;">
                `;

                $('input[name=f_kode_buku]').val(kode_buku);
                $('input[name=f_judul_buku]').val(judul_buku);
                $('select[name=f_kategori]').val(kategori_buku);
                $('select[name=f_genre]').val(genre_buku);
                $('input[name=f_jumlah]').val(1);
                $('#sampul-buku').html(img);
            }
        });

        $('.baris-pinjam').click(function() {
            if ($('input[name=f_kode_buku]').val() != '') {
                var img = `
                    <img src="<?= base_url('assets/app-assets/buku/'); ?>default.png" alt="" style="width: 150px; height: 150px;">
                `;

                var kode_buku = $('input[name=f_kode_buku]').val();
                var judul_buku = $('input[name=f_judul_buku]').val();
                var jumlah = $('input[name=f_jumlah]').val();

                var html = `
                <tr>
                    <td>
                    <input type="text" name="judul_buku[]" value="` + judul_buku + `" class="form-control" readonly style="background: transparent;">
                        <input type="hidden" name="kode_buku[]" value="` + kode_buku + `" class="form-control" readonly>
                    </td>
                    <td>
                        <input type="text" name="jumlah_buku[]" value="` + jumlah + `" class="form-control" readonly style="background: transparent;">
                    </td>
                    <td>
                        <button type="button" class="btn btn-icons btn-inverse-danger"><i class="icon-trash"></i></button>
                    </td>
                </tr>
            `;

                $('input[name=f_kode_buku]').val('');
                $('input[name=f_judul_buku]').val('');
                $('select[name=f_kategori]').val('');
                $('select[name=f_genre]').val('');
                $('select[name=manual_input]').val('');
                $('input[name=f_jumlah]').val('');
                $('input[name=f_barcode]').val('');
                $('#sampul-buku').html(img);

                $('#list-buku-dipinjam').append(html);
                $('input[name=f_barcode]').focus();
            }
        });

        $('#list-buku-dipinjam').on('click', 'tr td button', function() {
            $(this).parents('tr').remove();
        });

        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type == "text")) {
                return false;
            }
        }

        $('input[name=f_barcode]').on('propertychange input', function(e) {
            var barcode = $('input[name=f_barcode]').val();

            document.onkeypress = stopRKey;
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
                    dataType: 'json',
                    url: "<?= base_url('peminjaman/ajax_buku') ?>",
                    success: function(data) {

                        $.each(data, function(id_buku, kode_buku, judul_buku, sampul_buku, kategori_buku, genre_buku, penulis, penerbit, tahun_terbit, stok) {
                            var img = `
                                    <img src="<?= base_url('assets/app-assets/buku/'); ?>` + data.sampul_buku + `" alt="" style="width: 150px; height: 150px;">
                                `;

                            $('input[name=f_kode_buku]').val(data.kode_buku);
                            $('input[name=f_judul_buku]').val(data.judul_buku);
                            $('select[name=f_kategori]').val(data.kategori_buku);
                            $('select[name=f_genre]').val(data.genre_buku);
                            $('input[name=f_jumlah]').val(1);
                            $('#sampul-buku').html(img);
                        });
                    }
                });
            }

        });
    });
</script>