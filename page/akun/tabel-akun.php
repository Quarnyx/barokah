<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Akun</th>
            <th>Kode Akun</th>
            <th>Tipe</th>
            <th>Saldo</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../../config.php";
        $no = 0;
        $query = mysqli_query($conn, "SELECT * FROM akun");
        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nama_akun'] ?></td>
                <td><?= $data['kode_akun'] ?></td>
                <td><?= $data['tipe_akun'] ?></td>
                <td><?php
                $sqlsaldo = mysqli_query($conn, "SELECT SUM(debit) - SUM(kredit) AS saldo FROM v_jurnal WHERE nama_akun = '$data[nama_akun]'");
                $datasaldo = mysqli_fetch_array($sqlsaldo);
                if (empty($datasaldo['saldo'])) {
                    $datasaldo['saldo'] = 0;
                }
                echo number_format(abs($datasaldo['saldo']), 0, ',', '.');
                ?></td>
                <td>
                    <button data-id="<?= $data['id_akun'] ?>" data-name="<?= $data['nama_akun'] ?>" id="edit" type="button"
                        class="btn btn-primary">Edit</button>
                    <?php if ($data['jenis_akun'] == '0') { ?>
                        <button data-id="<?= $data['id_akun'] ?>" data-name="<?= $data['nama_akun'] ?>" id="delete"
                            type="button" class="btn btn-danger">Delete</button><?php } else { ?>
                        <button class="btn btn-default" data-toggle="tooltip" title="Tidak bisa dihapus, ini akun default"><i
                                class="fa fa-lock"></i></button>
                    <?php } ?>
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
            const name = $(this).data('name');
            $.ajax({
                type: 'POST',
                url: 'page/akun/edit-akun.php',
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
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus akun ' + name + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'proses.php?act=hapus-akun',
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