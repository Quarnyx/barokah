<?php
require_once '../../config.php';
$sql = "SELECT * FROM v_returnpembelian WHERE id_return_pembelian = '$_POST[id]'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<form id="edit-return-pembelian" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id_return_pembelian']; ?>">
    <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi']; ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Tanggal Return</label>
                <input type="date" class="form-control" name="tanggal_return_pembelian"
                    value="<?= $row['tanggal_return_pembelian']; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Kode Pengembalian Produk</label>
                <input type="text" name="kode_return_pembelian" class="form-control" placeholder="Jumlah Transaksi"
                    value="<?= $row['kode_return_pembelian']; ?>" readonly>
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
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Pemasok</label>
                <select class="form-control select2" id="pemasok" name="id_pemasok" data-toggle="select2">
                    <option value="">Pilih Pemasok</option>
                    <?php
                    require_once '../../config.php';
                    $sqla = "SELECT * FROM pemasok";
                    $resulta = $conn->query($sqla);
                    while ($rowa = $resulta->fetch_assoc()) {
                        ?>

                        <option value="<?= $rowa['id_pemasok'] ?>" <?php echo $rowa['id_pemasok'] == $row['id_pemasok'] ? 'selected' : ''; ?>><?= $rowa['nama_pemasok'] ?></option>
                        <?php
                    }

                    ?>
                </select>
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
    $("#edit-return-pembelian").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=edit-return-pembelian',
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