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
                    <h3><b>DAFTAR BARANG</b></h3>
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
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Satuan</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
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
                                    <td><?= $data['satuan'] ?></td>
                                    <td><?= "Rp. " . number_format($data['harga_beli'], 0, ',', '.') ?></td>
                                    <td><?= "Rp. " . number_format($data['harga_jual'], 0, ',', '.') ?></td>

                                </tr>
                                <?php
                            }
                            ?>
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