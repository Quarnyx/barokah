<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Kode Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <?php
            session_start();
            if ($_SESSION['level'] == "Pemilik") { ?>
                <th>Satuan</th>
            <?php } ?>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../../config.php";
        $no = 0;
        $query = mysqli_query($conn, "SELECT * FROM barang");
        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nama_barang'] ?></td>
                <td><?= $data['kode_barang'] ?></td>
                <td><?= "Rp. " . number_format($data['harga_beli'], 0, ',', '.') ?></td>
                <td><?= "Rp. " . number_format($data['harga_jual'], 0, ',', '.') ?></td>
                <td><?php
                $sqlbeli = "SELECT SUM(qty) FROM detail_pembelian WHERE id_barang = '$data[id_barang]'";
                $sqljual = "SELECT SUM(qty) FROM detail_penjualan WHERE id_barang = '$data[id_barang]'";
                $sqlreturn = "SELECT SUM(jumlah) FROM return_pembelian WHERE id_barang = '$data[id_barang]'";
                $querybeli = mysqli_query($conn, $sqlbeli);
                $queryjual = mysqli_query($conn, $sqljual);
                $queryreturn = mysqli_query($conn, $sqlreturn);
                $beli = mysqli_fetch_array($querybeli);
                $jual = mysqli_fetch_array($queryjual);
                $return = mysqli_fetch_array($queryreturn);
                echo $beli[0] - $jual[0] - $return[0];
                ?></td>
                <td><?= $data['satuan'] ?></td>
                <?php
                if ($_SESSION['level'] == "Pemilik") {
                    ?>
                    <td>
                        <button data-id="<?= $data['id_barang'] ?>" data-name="<?= $data['nama_barang'] ?>" id="edit"
                            type="button" class="btn btn-primary">Edit</button>
                        <button data-id="<?= $data['id_barang'] ?>" data-name="<?= $data['nama_barang'] ?>" id="delete"
                            type="button" class="btn btn-danger">Delete</button>
                    </td>
                    <?php
                }
                ?>
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
            const name = $(this).data('name');
            $.ajax({
                type: 'POST',
                url: 'page/barang/edit-barang.php',
                data: 'id=' + id + '&name=' + name,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Edit Data ' + name);
                    $('.modal .modal-body').html(data);
                }
            })
        });

        $('#tabel-data').on('click', '#delete', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus barang ' + name + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'proses.php?act=hapus-barang',
                    data: 'id=' + id,
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