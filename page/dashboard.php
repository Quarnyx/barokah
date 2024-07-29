<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
<?php
if ($_SESSION['level'] == "Pemilik") {
    ?>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-body">
                <h3 class="card-title text-center"><b>Laporan Penjualan</b></h3>
                <p class="card-text text-center">Buka laporan penjualan</p>
                <a href="?page=laporan-penjualan" class="btn btn-primary waves-effect waves-light">Buka</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body text-xs-center">
                <h3 class="card-title text-center"><b>Laporan Pembelian</b></h3>
                <p class="card-text text-center">Buka laporan pembelian
                </p>
                <a href="?page=laporan-pembelian" class="btn btn-primary waves-effect waves-light">Buka</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body text-xs-right">
                <h3 class="card-title text-center"><b>Laporan Laba/Rugi</b></h3>
                <p class="card-text text-center">Buka laporan laba/rugi</p>
                <a href="?page=laba-rugi" class="btn btn-primary waves-effect waves-light">Buka</a>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card card-body text-xs-right">
                <h3 class="card-title text-center"><b>Laporan <br> Neraca</b></h3>
                <p class="card-text text-center">Buka laporan neraca</p>
                <a href="?page=neraca" class="btn btn-primary waves-effect waves-light">Buka</a>
            </div>
        </div>
    </div>

    <?php
} else { ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-body">
                <h3 class="card-title text-center"><b>Pembelian</b></h3>
                <p class="card-text text-center">Buka transaksi pembelian</p>
                <a href="?page=pembelian" class="btn btn-primary waves-effect waves-light">Buka</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-body text-xs-center">
                <h3 class="card-title text-center"><b>Penjualan</b></h3>
                <p class="card-text text-center">Buka transaksi penjualan
                </p>
                <a href="?page=penjualan" class="btn btn-primary waves-effect waves-light">Buka</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-body text-xs-right">
                <h3 class="card-title text-center"><b>Jurnal Umum</b></h3>
                <p class="card-text text-center">Buka jurnal umum</p>
                <a href="?page=jurnal-umum" class="btn btn-primary waves-effect waves-light">Buka</a>
            </div>
        </div>
    </div>
<?php } ?>