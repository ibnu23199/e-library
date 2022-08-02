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
            <form action="<?= base_url('books/f_tambah'); ?>" method="POST">
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary mt-4 tambah-baris-buku">Tambah Baris</button>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kode Buku</th>
                                                <th>Judul</th>
                                                <th>Kategori</th>
                                                <th>Genre</th>
                                                <th>Penulis</th>
                                                <th>Penerbit</th>
                                                <th>Stok</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-buku">
                                            <tr>
                                                <td><input type="text" class="form-control kode_buku" name="kode_buku[]" autocomplete="off"></td>
                                                <td><input type="text" class="form-control" name="judul[]" autocomplete="off"></td>
                                                <td>
                                                    <select name="kategori[]" class="form-control">
                                                        <?php foreach ($kategori as $k) : ?>
                                                            <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="genre[]" class="form-control">
                                                        <?php foreach ($genre as $kg) : ?>
                                                            <option value="<?= $kg->id_genre; ?>"><?= $kg->nama_genre; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="penulis[]" autocomplete="off"></td>
                                                <td><input type="text" class="form-control" name="penerbit[]" autocomplete="off"></td>
                                                <td><input type="text" class="form-control" name="stok[]" autocomplete="off"></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                                </div>
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
        $('.tambah-baris-buku').click(function() {
            var kategori = `
                <select name="kategori[]" class="form-control">
                <?php foreach ($kategori as $k) : ?>
                    <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                <?php endforeach; ?>
                </select>
            `;

            var genre = `
                <select name="genre[]" class="form-control">
                <?php foreach ($genre as $kg) : ?>
                    <option value="<?= $kg->id_genre; ?>"><?= $kg->nama_genre; ?></option>
                <?php endforeach; ?>
                </select>
            `;
            var html = `
                <tr>
                    <td><input type="text" class="form-control kode_buku" name="kode_buku[]" autocomplete="off"></td>
                    <td><input type="text" class="form-control" name="judul[]" autocomplete="off"></td>
                    <td>` + kategori + `</td>
                    <td>` + genre + `</td>
                    <td><input type="text" class="form-control" name="penulis[]" autocomplete="off"></td>
                    <td><input type="text" class="form-control" name="penerbit[]" autocomplete="off"></td>
                    <td><input type="text" class="form-control" name="stok[]" autocomplete="off"></td>
                    <td><button type="button" class="btn btn-icons btn-inverse-danger"><i class="icon-trash"></i></button></td>
                </tr>
            `;

            $('#tbody-buku').append(html);
        });

        $('#tbody-buku').on('click', 'tr td button', function() {
            $(this).parents('tr').remove();
        });

        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type == "text")) {
                return false;
            }
        }

        $('.kode_buku').on('propertychange input', function(e) {
            document.onkeypress = stopRKey;
            var valueChanged = false;

            if (e.type == 'propertychange') {
                valueChanged = e.originalEvent.propertyName == 'value';
            } else {
                valueChanged = true;
            }
            if (valueChanged) {
                /* Code goes here */
                document.onkeypress = stopRKey;
            }

        });

    });
</script>