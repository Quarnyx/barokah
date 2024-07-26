<?php
require_once '../../config.php';
$sql = "SELECT * FROM barang WHERE id_barang = '$_POST[id]'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<form id="edit-barang" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id_barang'] ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Nama barang</label>
                <input type="text" class="form-control" name="nama_barang" placeholder="barang"
                    value="<?= $row['nama_barang'] ?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli"
                    value="<?= $row['harga_beli'] ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" placeholder="Kode Barang"
                    value="<?= $row['kode_barang'] ?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual"
                    value="<?= $row['harga_jual'] ?>">
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
    $("#edit-barang").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=edit-barang',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('Barang Berhasil DIedit');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>