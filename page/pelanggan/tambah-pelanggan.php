<form id="tambah" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama Pelanggan</label>
                <input type="text" id="simpleinput" class="form-control" name="tambah_pelanggan"
                    placeholder="Pelanggan">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat_pelanggan" id="" cols="10" rows="5"></textarea>
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
    $("#tambah").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=tambah-pelanggan',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('Pengguna Berhasil Ditambah');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>