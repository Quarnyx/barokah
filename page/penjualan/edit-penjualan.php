<?php
require_once '../../config.php';
$sql = "SELECT * FROM detail_penjualan WHERE id_detail_penjualan = '$_POST[id]'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<form id="edit-penjualan" enctype="multipart/form-data">
    <input type="hidden" value="<?= $row['id_detail_penjualan'] ?>" name="id">

    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Tanggal Penjualan</label>
                <input type="date" class="form-control" name="tanggal_penjualan"
                    value="<?php echo $row['tanggal_penjualan']; ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Kode Penjualan</label>
                <input type="text" name="kode_penjualan" class="form-control" placeholder="Kode Penjualan"
                    value="<?= $row['kode_penjualan'] ?>" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Barang</label>
                <select class="form-control select2" id="barang" name="id_barang" data-toggle="select2">
                    <option value="">Pilih Barang</option>
                    <?php
                    require_once '../../config.php';
                    $sql = "SELECT * FROM barang";
                    $result = $conn->query($sql);
                    while ($rowa = $result->fetch_assoc()) {
                        ?>

                        <option value="<?= $rowa['id_barang'] ?>" data-hargabeli="<?= $rowa['harga_beli'] ?>"
                            data-hargajual="<?= $rowa['harga_jual'] ?>" <?php if ($rowa['id_barang'] == $row['id_barang'])
                                  echo 'selected' ?>><?= $rowa['nama_barang'] ?></option>
                        <?php
                    }

                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Harga Jual</label>
                <input type="number" class="form-control" name="harga_jual" value="<?= $row['harga_jual'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Jumlah Beli</label>
                <input type="number" class="form-control" name="qty" value="<?= $row['qty'] ?>">
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
    // select2
    $(document).ready(function () {
        $('.select2').select2({
            drowpdownParent: $('#myModal'),
        }
        );
    })
    $("#edit-penjualan").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=edit-penjualan-detail',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('Pembelian Berhasil Diedit');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>