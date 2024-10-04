<?php
$sub_title = "Pemasok";
$title = "Daftar Pemasok";
include 'partials/page-title.php'; ?>

<div class="row mb-2">
    <div class="col-sm-4">
        <button id="tambah" class="btn btn-success rounded-pill waves-effect waves-light mb-3"><i
                class="mdi mdi-plus"></i> Tambah Pemasok</button>
        <a href="page/pemasok/cetak-pemasok.php" target="_blank"
            class="btn btn-primary rounded-pill waves-effect waves-light mb-3"><i class="mdi mdi-printer"></i> Cetak</a>

    </div>
</div>
<!-- end row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Pemasok</h4>
                <div id="load-table">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    function loadTable() {
        $('#load-table').load('page/pemasok/tabel-pemasok.php')
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Tambah Pemasok Baru');
            // load form
            $('.modal-body').load('page/pemasok/tambah-pemasok.php');
        });
    });
</script>