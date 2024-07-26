<?php
require_once '../../config.php';
$sql = "SELECT * FROM supplier WHERE id_supplier = '$_POST[id]'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<form id="edit-supplier" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama Supplier</label>
                <input type="text" id="simpleinput" class="form-control" name="nama_supplier"
                    placeholder="Nama Supplier" value="<?= $row['nama_supplier'] ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Telp</label>
                <input type="text" name="telp" class="form-control" placeholder="Telp" value="<?= $row['telp'] ?>">
            </div>
        </div>
    </div>
    <div class=" row">
        <div class="col-lg-12">

            <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat_supplier" id="" cols="10"
                    rows="5"><?= $row['alamat_supplier'] ?></textarea>
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
    $("#edit-supplier").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=edit-supplier',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('supplier Berhasil Diubh');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>