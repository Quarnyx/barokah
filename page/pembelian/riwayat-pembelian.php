<table id="tabel-riwayat" class="table table-bordered table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Pembelian</th>
            <th>Gambar</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../../config.php";
        $no = 0;
        $query = mysqli_query($conn, "SELECT * FROM pembelian");
        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['kode_pembelian'] ?></td>
                <td><img src="assets/img/pembelian/<?= $data['gambar'] ?>" width="50px"></td>
                <td><?= $data['total'] ?></td>
                <td>
                    <a href="?page=pembelian&kode_pembelian=<?php echo $data['kode_pembelian'] ?>"
                        data-id="<?= $data['kode_pembelian'] ?>" id="pilih" type="button" class="btn btn-info">Pilih</a>
                    <button data-id_transaksi="<?= $data['id_transaksi'] ?>"
                        data-kode_pembelian="<?= $data['kode_pembelian'] ?>" id="delete-pembelian" type="button"
                        class="btn btn-danger">Delete</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#tabel-riwayat').DataTable();
        $('#tabel-riwayat').on('click', '#delete-pembelian', function () {
            const kode_pembelian = $(this).data('kode_pembelian');
            const id_transaksi = $(this).data('id_transaksi');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus barang ' + name + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'proses.php?act=hapus-pembelian',
                    data: 'kode_pembelian=' + kode_pembelian + '&id_transaksi=' + id_transaksi,
                    success: function (data) {
                        loadTable();

                        // alertify pesan sukses
                        alertify.success('Barang Berhasil Dihapus');
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