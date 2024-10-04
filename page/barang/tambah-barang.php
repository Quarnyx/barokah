<form id="tambah-barang" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Nama barang</label>
                <input type="text" class="form-control" name="nama_barang" placeholder="barang">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" placeholder="Kode Barang">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Satuan Barang</label>
                <input type="text" name="satuan" class="form-control" placeholder="Satuan Barang">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

<script>
    $("#tambah-barang").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=tambah-barang',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('barang Berhasil Ditambah');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>