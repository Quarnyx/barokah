<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../../config.php";
        $no = 0;
        session_start();
        $id_user = $_SESSION['id_user'];
        if ($_SESSION['level'] == "Pemilik") {
            $query = mysqli_query($conn, "SELECT * FROM pengguna");
        } else {
            $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_user = '$id_user'");
        }
        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nama_user'] ?></td>
                <td><?= $data['username'] ?></td>
                <td><?= $data['level'] ?></td>
                <td>
                    <button data-password="<?= $data['password'] ?>" data-id="<?= $data['id_user'] ?>"
                        data-name="<?= $data['username'] ?>" id="lihat-password" type="button" class="btn btn-info">Lihat
                        Password</button>
                    <button data-id="<?= $data['id_user'] ?>" data-name="<?= $data['username'] ?>" id="edit-password"
                        type="button" class="btn btn-success">Ganti Password</button>
                    <button data-id="<?= $data['id_user'] ?>" data-name="<?= $data['username'] ?>" id="edit" type="button"
                        class="btn btn-primary">Edit</button>
                    <button data-id="<?= $data['id_user'] ?>" data-name="<?= $data['username'] ?>" id="delete" type="button"
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
        $('#tabel-data').on('click', '#lihat-password', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const password = $(this).data('password');
            alertify.confirm('Password ' + name, 'Password : ' + password, function () {
                alertify.success('Password Berhasil Ditampilkan');
            }, function () {
                alertify.error('Password dibatalkan');
            })
        });
    });
</script>