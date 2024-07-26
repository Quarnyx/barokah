<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../../config.php";
        $no = 0;
        $query = mysqli_query($conn, "SELECT * FROM pelanggan");
        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nama_pelanggan'] ?></td>
                <td><?= $data['alamat_pelanggan'] ?></td>
                <td><?= $data['no_hp'] ?></td>
                <td>
                    <button data-id="<?= $data['id_pelanggan'] ?>" data-name="<?= $data['nama_pelanggan'] ?>" id="edit"
                        type="button" class="btn btn-primary">Edit</button>
                    <button data-id="<?= $data['id_pelanggan'] ?>" data-name="<?= $data['nama_pelanggan'] ?>" id="delete"
                        type="button" class="btn btn-danger">Delete</button>
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
                url: 'page/pengguna/edit-pengguna.php',
                data: 'id=' + id + '&name=' + name,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Edit Data ' + name);
                    $('.modal .modal-body').html(data);
                }
            })
        });
        $('#tabel-data').on('click', '#edit-password', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            alertify.prompt('Ganti Password ' + name, 'Masukkan Password Baru', '', function (evt, value) {
                $.ajax({
                    type: 'POST',
                    url: 'proses.php?act=ganti-password',
                    data: 'id=' + id + '&name=' + name + '&password=' + value,
                    success: function (data) {
                        alertify.success('Password Berhasil Diubah');
                    },
                    error: function (data) {
                        alertify.error(data);
                    }
                })
            }, function () {
                alertify.error('Ganti password dibatalkan');
            })
        });
        $('#tabel-data').on('click', '#delete', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data ' + name + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'proses.php?act=hapus-pengguna',
                    data: 'id=' + id,
                    success: function (data) {
                        loadTable();

                        // alertify pesan sukses
                        alertify.success('Pengguna Berhasil Dihapus');
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