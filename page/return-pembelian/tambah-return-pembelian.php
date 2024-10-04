<form id="tambah-return-pembelian" enctype="multipart/form-data">

    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Tanggal Return</label>
                <input type="date" class="form-control" name="tanggal_return_pembelian">
            </div>
        </div>
        <?php
        require_once '../../config.php';
        $query = mysqli_query($conn, "SELECT MAX(kode_return_pembelian) AS kode_return_pembelian FROM return_pembelian");
        $data = mysqli_fetch_array($query);
        $max = $data['kode_return_pembelian'] ? substr($data['kode_return_pembelian'], 3, 3) : "000";
        $no = $max + 1;
        $char = "RPB";
        $kode = $char . sprintf("%03s", $no);
        ?>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Kode Pengembalian Produk</label>
                <input type="text" name="kode_return_pembelian" class="form-control" placeholder="Jumlah Transaksi"
                    value="<?= $kode; ?>" readonly>
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
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_barang'] . '">' . $row['nama_barang'] . '</option>';
                    }

                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Pemosok</label>
                <select class="form-control select2" id="pemasok" name="id_pemasok" data-toggle="select2">
                    <option value="">Pilih Pemasok</option>
                    <?php
                    require_once '../../config.php';
                    $sql = "SELECT * FROM pemasok";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        ?>

                        <option value="<?= $row['id_pemasok'] ?>"><?= $row['nama_pemasok'] ?></option>
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
                <textarea class="form-control" name="catatan"></textarea>
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
    $("#pemasok").select2({

    })
    $("#tambah-return-pembelian").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=tambah-return-pembelian',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('Berhasil Ditambah');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>