<?php
$sub_title = "Jurnal Umum";
$title = "Jurnal";
include 'partials/page-title.php'; ?>

<div class="row mb-2">
    <div class="col-sm-4">
        <button id="tambah" class="btn btn-success rounded-pill waves-effect waves-light mb-3"><i
                class="mdi mdi-plus"></i> Tambah Transaksi</button>
    </div>
</div>
<!-- end row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Jurnal Umum</h4>
                <div id="load-table">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    function loadTable() {
        $('#load-table').load('page/jurnal/tabel-jurnal.php')
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Tambah Transaksi');
            // load form
            $('.modal-body').load('page/jurnal/tambah-transaksi.php');
        });
    });
</script>