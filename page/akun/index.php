<?php
$sub_title = "Akun";
$title = "Daftar Akun";
include 'partials/page-title.php'; ?>

<div class="row mb-2">
    <div class="col-sm-4">
        <button id="tambah" class="btn btn-success rounded-pill waves-effect waves-light mb-3"><i
                class="mdi mdi-plus"></i> Tambah Akun</button>
        <button id="tambah-saldo" class="btn btn-success rounded-pill waves-effect waves-light mb-3"><i
                class="mdi mdi-plus"></i> Tambah Saldo</button>
        <a href="page/akun/cetak-akun.php" target="_blank"
            class="btn btn-primary rounded-pill waves-effect waves-light mb-3"><i class="mdi mdi-printer"></i> Cetak</a>
    </div>
</div>
<!-- end row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Akun</h4>
                <div id="load-table">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    function loadTable() {
        $('#load-table').load('page/akun/tabel-akun.php')
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Tambah akun');
            // load form
            $('.modal-body').load('page/akun/tambah-akun.php');
        });
        $('#tambah-saldo').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Tambah Transaksi');
            // load form
            $('.modal-body').load('page/jurnal/tambah-transaksi.php');
        });
    });
</script>