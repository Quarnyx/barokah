<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                            <i class="fe-heart font-22 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <?php
                            include 'config.php';
                            $sql = "SELECT SUM(total) AS total FROM penjualan WHERE MONTH(tanggal_penjualan) = MONTH(NOW()) AND YEAR(tanggal_penjualan) = YEAR(NOW())";
                            $query = $conn->query($sql);
                            $data = $query->fetch_array();
                            $total = $data['total'];
                            ?>
                            <h3 class="text-dark mt-1">Rp <span
                                    data-plugin="counterup"><?= number_format($total, 0, ',', '.') ?></span></h3>
                            <p class="text-muted mb-1 text-truncate">Total Pendapatan Bulan</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-4">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <?php
                    include 'config.php';
                    $sql = "SELECT COUNT(id_penjualan)  AS penjualan FROM penjualan WHERE DATE(tanggal_penjualan) = CURDATE()";
                    $data = $query->fetch_array();
                    $total = $data;
                    ?>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $total ?></span></h3>
                            <p class="text-muted mb-1 text-truncate">Penjualan Hari ini</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-4">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <?php
                    include 'config.php';
                    $sql = "SELECT COUNT(id_barang) AS barang FROM barang";
                    $query = $conn->query($sql);
                    $data = $query->fetch_array();
                    $total = $data['barang'];
                    ?>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $total ?></span>
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Total Produk</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->


</div>
<!-- end row-->

<div class="row">
    <div class="col-lg-12   ">
        <div class="card">
            <div class="card-body pb-2">
                <div class="float-end d-none d-md-inline-block">
                    <div class="btn-group mb-2">
                        <button type="button" class="btn btn-xs btn-light">Today</button>
                        <button type="button" class="btn btn-xs btn-light">Weekly</button>
                        <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                    </div>
                </div>

                <h4 class="header-title mb-3">Sales Analytics</h4>

                <div dir="ltr">
                    <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                </div>
            </div>
        </div> <!-- end card -->
    </div> <!-- end col-->
</div>
<!-- end row -->