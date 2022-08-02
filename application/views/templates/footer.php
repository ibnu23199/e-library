</div>
<!-- container-scroller -->

<!-- Custom js for this page-->
<?= $plugin['dashboard']; ?>
<?= $plugin['datatables']; ?>
<?= $plugin['select2_js']; ?>
<!-- End custom js for this page-->
<script>
    $(document).ready(function() {
        $('#data-datatables').DataTable({
            "lengthMenu": [
                [-1, 5, 10, 25, 50],
                ["All", 5, 10, 25, 50]
            ]
        });
        $('#data-datatables2').DataTable({
            "lengthMenu": [
                [-1, 5, 10, 25, 50],
                ["All", 5, 10, 25, 50]
            ]
        });
        $('.btn-hapus').click(function(e) {
            var href = $(this).attr('href');
            e.preventDefault();
            Notiflix.Confirm.Show('Apakah Anda Yakin',
                'data yg dihapus tidak dapat dipulihkan',
                'Yes',
                'No',
                function() {
                    document.location.href = href
                },
                function() {
                    Notiflix.Notify.Info('Tidak di Hapus');
                });
        });


        // KATEGORI
        $('.tambah-baris-kategori').click(function() {
            var baru = `
                <tr>
                    <td><input type="text" name="nama_kategori[]" class="form-control" required style="width: 100%; border: none; font-size: 14px;" required autofocus></td>
                    <td class="text-center"><button type="button" class="btn btn-icons btn-inverse-danger remove-baris-admin"><i class="icon-trash"></i></button></td>
                </tr>
           `;
            $('#tbody-data-kategori').append(baru);
        });

        $('#tbody-data-kategori').on('click', 'tr td button', function() {
            $(this).parents('tr').remove();
        });

        $('.edit-kategori').click(function() {
            var id_kategori = $(this).data('id_kategori');
            var nama_kategori = $(this).data('nama_kategori');

            $('input[name=id_kategori]').val(id_kategori);
            $('input[name=nama_kategori]').val(nama_kategori);
            $('input[name=nama_kategori]').prop("disabled", false);
            $('.submit-edit-kategori').css("display", 'inline-block');
        });

        $('.btn-reset-kategori').click(function() {
            $('input[name=nama_kategori]').prop("disabled", true);
            $('.submit-edit-kategori').css("display", 'none');
        });
        // END KATEGORI

        // GENRE
        $('.tambah-baris-genre').click(function() {
            var baru = `
                <tr>
                    <td><input type="text" name="nama_genre[]" class="form-control" required style="width: 100%; border: none; font-size: 14px;" required autofocus></td>
                    <td class="text-center"><button type="button" class="btn btn-icons btn-inverse-danger remove-baris-admin"><i class="icon-trash"></i></button></td>
                </tr>
           `;
            $('#tbody-data-genre').append(baru);
        });

        $('#tbody-data-genre').on('click', 'tr td button', function() {
            $(this).parents('tr').remove();
        });

        $('.edit-genre').click(function() {
            var id_genre = $(this).data('id_genre');
            var nama_genre = $(this).data('nama_genre');

            $('input[name=id_genre]').val(id_genre);
            $('input[name=nama_genre]').val(nama_genre);
            $('input[name=nama_genre]').prop("disabled", false);
            $('.submit-edit-genre').css("display", 'inline-block');
        });

        $('.btn-reset-genre').click(function() {
            $('input[name=nama_genre]').prop("disabled", true);
            $('.submit-edit-genre').css("display", 'none');
        });
        // END GENRE

        // DENDA
        $('.tambah-baris-denda-harian').click(function() {
            var baru = `
                <tr>
                    <td><input type="text" name="nama_denda[]" class="form-control" required style="width: 100%; border: none; font-size: 14px;" required autofocus></td>
                    <td><input type="number" name="jumlah_denda[]" class="form-control" required style="width: 100%; border: none; font-size: 14px;" required></td>
                    <td class="text-center"><button type="button" class="btn btn-icons btn-inverse-danger remove-baris-admin"><i class="icon-trash"></i></button></td>
                </tr>
           `;
            $('#tbody-data-denda-harian').append(baru);
        });

        $('.tambah-baris-denda-lainnya').click(function() {
            var baru = `
                <tr>
                    <td><input type="text" name="nama_denda[]" class="form-control" required style="width: 100%; border: none; font-size: 14px;" required autofocus></td>
                    <td class="text-center"><button type="button" class="btn btn-icons btn-inverse-danger remove-baris-admin"><i class="icon-trash"></i></button></td>
                </tr>
           `;
            $('#tbody-data-denda-lainnya').append(baru);
        });

        $('#tbody-data-denda-harian').on('click', 'tr td button', function() {
            $(this).parents('tr').remove();
        });

        $('#tbody-data-denda-lainnya').on('click', 'tr td button', function() {
            $(this).parents('tr').remove();
        });

        $('.edit-denda1').click(function() {
            var id_denda = $(this).data('id_denda');
            var nama_denda = $(this).data('nama_denda');
            var jumlah_denda = $(this).data('jumlah_denda');
            $('input[name=nama_denda1]').val(nama_denda);
            $('input[name=id_denda1]').val(id_denda);
            $('input[name=jumlah_denda]').val(jumlah_denda);
            $('.popup-denda').css('top', '50%');
        });

        $('.edit-denda2').click(function() {
            var id_denda = $(this).data('id_denda');
            var nama_denda = $(this).data('nama_denda');
            var jumlah_denda = $(this).data('jumlah_denda');
            $('input[name=nama_denda2]').val(nama_denda);
            $('input[name=id_denda2]').val(id_denda);
            $('.popup-denda2').css('top', '50%');
        });

        $('.btn-reset-denda1').click(function() {
            $('.popup-denda').css('top', '-50%');
        });

        $('.btn-reset-denda2').click(function() {
            $('.popup-denda2').css('top', '-50%');
        });
        // END DENDA

        $('.tambah-pengembalian').click(function() {
            $('.popup-pengembalian').css('top', '50%');
        });

        $('.btn-reset-pengembalian').click(function() {
            $('.popup-pengembalian').css('top', '-50%');
        });
    });
</script>
</body>

</html>