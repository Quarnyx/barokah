<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Custom styles for this template -->
    <link href="../../assets/css/app.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />


</head>

<body>
    <?php
    include '../../config.php';

    ?>
    <div class="container-fluid">

        <div class="card-header py-3">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>TOKO BAROKAH</h3>
                    <h3><b>Faktur</b></h3>
                </div>
            </div>
        </div>
        <hr>
        <div class="">
            <!--rows -->
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Harga Jual</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../../config.php";
                            $total = 0;
                            $harga_beli = 0;
                            $harga_jual = 0;
                            $query = mysqli_query($conn, "SELECT * FROM v_penjualan WHERE kode_penjualan = '$_GET[id]'");
                            while ($data = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?= $data['kode_penjualan'] ?></td>
                                    <td><?= $data['nama_barang'] ?></td>
                                    <td>Rp. <?= number_format($data['harga_jual'], 0, ',', '.') ?></td>
                                    <td><?= $data['qty'] ?></td>
                                    <td>Rp. <?= number_format($data['harga_jual'] * $data['qty'], 0, ',', '.') ?></td>

                                </tr>
                                <?php
                                $harga_beli += $data['harga_beli'] * $data['qty'];
                                $harga_jual += $data['harga_jual'] * $data['qty'];
                                $total += ($data['harga_jual'] * $data['qty']);
                            }
                            ?>
                            <tr>
                                <td colspan="3"></td>
                                <td>Total</td>
                                <td>Rp. <?= number_format($total, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    function tanggal($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }
    ?>

</body>
<script>

    window.print();
    window.onafterprint = window.close;
</script>

</html>