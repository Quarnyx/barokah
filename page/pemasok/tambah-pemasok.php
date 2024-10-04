<form id="tambah-pemasok" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama Pemasok</label>
                <input type="text" id="simpleinput" class="form-control" name="nama_pemasok" placeholder="Nama Pemasok">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Telp</label>
                <input type="text" name="telp" class="form-control" placeholder="Telp">
            </div>
        </div>
    </div>
    <div class=" row">
        <div class="col-lg-12">

            <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat_pemasok" id="" cols="10" rows="5"></textarea>
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
    $("#tambah-pemasok").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=tambah-pemasok',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('pemasok Berhasil Ditambah');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>