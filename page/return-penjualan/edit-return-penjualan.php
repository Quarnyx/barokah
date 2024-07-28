<?php
require_once '../../config.php';
$sql = "SELECT * FROM v_returnpenjualan WHERE id_return_penjualan = '$_POST[id]'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<form id="edit-return-penjualan" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id_return_penjualan']; ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Tanggal Return</label>
                <input type="date" class="form-control" name="tanggal_return_penjualan"
                    value="<?= $row['tanggal_return_penjualan']; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Kode Pengembalian Produk</label>
                <input type="text" name="kode_return_penjualan" class="form-control" placeholder="Jumlah Transaksi"
                    value="<?= $row['kode_return_penjualan']; ?>" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Barang</label>
                <select class="form-select" name="id_barang">
                    <?php
                    $sql = "SELECT * FROM barang";
                    $result = $conn->query($sql);
                    while ($rowa = $result->fetch_assoc()) {
                        echo '<option value="' . $rowa['id_barang'] . '"' . ($rowa['id_barang'] == $row['id_barang'] ? 'selected' : '') . '>' . $rowa['nama_barang'] . '</option>';
                    }

                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" value="<?= $row['jumlah']; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Keterangan</label>
                <textarea class="form-control" name="catatan"><?php echo $row['catatan']; ?></textarea>
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
    $("#edit-return-penjualan").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=edit-return-penjualan',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success(' Berhasil Diedit');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>