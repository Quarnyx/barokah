<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Akun</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../../config.php";
        if (isset($_GET['bulan'])) {
            $query = mysqli_query($conn, "SELECT * FROM v_jurnal WHERE MONTH(tanggal_transaksi) = '$_GET[bulan]'");

        } else {
            $query = mysqli_query($conn, "SELECT * FROM v_jurnal");

        }
        while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $data['tanggal_transaksi'] ?></td>
                <td><?= $data['catatan'] ?></td>
                <td><?= $data['nama_akun'] ?></td>
                <td>Rp. <?= number_format($data['debit'], 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($data['kredit'], 0, ',', '.') ?></td>
                <td>
                    <button data-id="<?= $data['id_transaksi'] ?>" id="edit" type="button"
                        class="btn btn-primary">Edit</button>
                    <button data-id="<?= $data['id_transaksi'] ?>" id="delete" type="button"
                        class="btn btn-danger">Delete</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php
require_once '../../config.php';
if (isset($_GET['bulan'])) {
    $sql = mysqli_query($conn, "SELECT sum(debit) AS debit FROM v_jurnal WHERE MONTH(tanggal_transaksi) = '$_GET[bulan]'");
    $debit = mysqli_fetch_array($sql);
    $bulansebelumnya = $_GET['bulan'] - 1;
    $sqlbulan = mysqli_query($conn, "SELECT sum(debit) AS debit FROM v_jurnal WHERE MONTH(tanggal_transaksi) = '$bulansebelumnya'");
    $debitbulanan = mysqli_fetch_array($sqlbulan);
} else {
    $sql = mysqli_query($conn, "SELECT sum(debit) AS debit FROM v_jurnal");
    $debit = mysqli_fetch_array($sql);
}
if (!empty($debit['debit'])) {


    ?>

    <div class="row mt-5">
        <div class="=col-xxxl-3 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="justify-content-between">
                        <div class="row">
                            <div class="col-6">

                                <h4 class="text-success">
                                    <?php echo 'Rp ' . number_format($debit['debit'], 0, ',', '.') ?>
                                </h4>
                                <div class="text-muted">Total Debit</div>
                            </div>
                            <div class="col-6">
                                <?php if (isset($_GET['bulan'])) {
                                    if ($debitbulanan['debit'] > $debit['debit']) {
                                        $style = 'fe-arrow-down text-danger me-1';
                                    } else {
                                        $style = 'fe-arrow-up text-success me-1';
                                    }
                                    ?>
                                    <p class="text-muted font-15 mb-1">Bulan Sebelumnya</p>
                                    <h4><i
                                            class="<?php echo $style ?>"></i><?php echo 'Rp ' . number_format($debitbulanan['debit'], 0, ',', '.') ?>
                                    </h4>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <i class="feather-dollar-sign fs-2"></i>
                    </div>
                </div>
                <div class="card-footer bg-success py-3">
                    <div class="hstack justify-content-between">
                        <p class="text-white mb-0">Debit</p>
                    </div>
                </div>
            </div>


        </div>
        <div class="=col-xxxl-3 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="justify-content-between">
                        <div class="row">
                            <div class="col-6">
                                <?php
                                require_once '../../config.php';
                                if (isset($_GET['bulan'])) {
                                    $sql = mysqli_query($conn, "SELECT sum(kredit) AS kredit FROM v_jurnal WHERE MONTH(tanggal_transaksi) = '$_GET[bulan]'");
                                    $kredit = mysqli_fetch_array($sql);
                                    // bulan sebelumnya
                                    $bulansebelumnya = $_GET['bulan'] - 1;
                                    $sqlbulan = mysqli_query($conn, "SELECT sum(kredit) AS kredit FROM v_jurnal WHERE MONTH(tanggal_transaksi) = '$bulansebelumnya'");
                                    $kreditbulanan = mysqli_fetch_array($sqlbulan);
                                } else {
                                    $sql = mysqli_query($conn, "SELECT sum(kredit) AS kredit FROM v_jurnal");
                                    $kredit = mysqli_fetch_array($sql);
                                }
                                ?>
                                <h4 class="text-warning">
                                    <?php echo 'Rp ' . number_format($kredit['kredit'], 0, ',', '.') ?>
                                </h4>
                                <div class="text-muted">Total Kredit</div>
                            </div>
                            <div class="col-6">
                                <?php if (isset($_GET['bulan'])) {
                                    if ($kreditbulanan['kredit'] > $kredit['kredit']) {
                                        $style = 'fe-arrow-down text-danger me-1';
                                    } else {
                                        $style = 'fe-arrow-up text-success me-1';
                                    }
                                    ?>
                                    <p class="text-muted font-15 mb-1">Bulan Sebelumnya</p>
                                    <h4><i
                                            class="<?php echo $style ?>"></i><?php echo 'Rp ' . number_format($kreditbulanan['kredit'], 0, ',', '.') ?>
                                    </h4>
                                <?php } ?>
                            </div>
                            <div class="text-end">
                                <i class="feather-dollar-sign fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-warning py-3">
                    <div class="hstack justify-content-between">
                        <p class="text-white mb-0">Kredit</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php } ?>
<script>
    $(document).ready(function () {
        $('#tabel-data').DataTable();
        $('#tabel-data').on('click', '#edit', function () {
            const id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'page/jurnal/edit-transaksi.php',
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
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus transaksi ini? ', function () {
                $.ajax({
                    type: 'POST',
                    url: 'proses.php?act=hapus-transaksi',
                    data: 'id=' + id,
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