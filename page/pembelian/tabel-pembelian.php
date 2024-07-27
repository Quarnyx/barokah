<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Nama Supplier</th>
            <th>Harga Beli</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../../config.php";
        $query = mysqli_query($conn, "SELECT * FROM v_pembelian");
        while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $data['kode_pembelian'] ?></td>
                <td><?= $data['nama_barang'] ?></td>
                <td><?= $data['nama_supplier'] ?></td>
                <td>Rp. <?= number_format($data['harga_beli'], 0, ',', '.') ?></td>
                <td><?= $data['qty'] ?></td>
                <td>Rp. <?= number_format($data['harga_beli'] * $data['qty'], 0, ',', '.') ?></td>
                <td>
                    <button data-id="<?= $data['id_pembelian'] ?>" id="edit" type="button"
                        class="btn btn-primary">Edit</button>
                    <button data-id="<?= $data['id_pembelian'] ?>" data-idtransaksi="<?= $data['id_transaksi'] ?>"
                        id="delete" type="button" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#tabel-data').DataTable();
        $('#tabel-data').on('click', '#edit', function () {
            const id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'page/pembelian/edit-pembelian.php',
                data: 'id=' + id,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Edit Data ' + name);
                    $('.modal .modal-body').html(data);
                }
            })
        });

        $('#tabel-data').on('click', '#delete', function () {
            const id = $(this).data('id');
            const id_transaksi = $(this).data('idtransaksi');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus transaksi ini? ', function () {
                $.ajax({
                    type: 'POST',
                    url: 'proses.php?act=hapus-pembelian',
                    data: {
                        id: id,
                        id_transaksi: id_transaksi
                    },
                    success: function (data) {
                        loadTable();

                        // alertify pesan sukses
                        alertify.success('Transaksi Berhasil Dihapus');
                    },
                    error: function (data) {
                        alertify.error(data);
                    }
                })
            }, function () {
                alertify.error('Hapus dibatalkan');
            })
        });
    });
</script>