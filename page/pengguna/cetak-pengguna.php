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
                    <h3><b>DAFTAR PENGGUNA</b></h3>
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
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../../config.php";
                            $no = 0;
                            $query = mysqli_query($conn, "SELECT * FROM pengguna");
                            while ($data = mysqli_fetch_array($query)) {
                                $no++;
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $data['nama_user'] ?></td>
                                    <td><?= $data['username'] ?></td>
                                    <td><?= $data['level'] ?></td>

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