<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../../config.php";
        $query = mysqli_query($conn, "SELECT * FROM v_returnpembelian");
        while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $data['kode_return_pembelian'] ?></td>
                <td><?= $data['tanggal_return_pembelian'] ?></td>
                <td><?= $data['nama_barang'] ?></td>
                <td><?= $data['jumlah'] ?></td>
                <td><?= $data['catatan'] ?></td>
                <td>
                    <button data-id="<?= $data['id_return_pembelian'] ?>" id="edit" type="button"
                        class="btn btn-primary">Edit</button>
                    <button data-idtransaksi="<?= $data['id_transaksi'] ?>" data-id="<?= $data['id_return_pembelian'] ?>"
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
                url: 'page/return-pembelian/edit-return-pembelian.php',
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
                    url: 'proses.php?act=hapus-return-pembelian',
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