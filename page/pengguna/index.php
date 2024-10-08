<?php
$sub_title = "Pengguna";
$title = "Daftar Pengguna";
include 'partials/page-title.php'; ?>
<?php
if ($_SESSION['level'] == "Pemilik") {
    ?>
    <div class="row mb-2">
        <div class="col-sm-4">
            <button id="tambah" class="btn btn-success rounded-pill waves-effect waves-light mb-3"><i
                    class="mdi mdi-plus"></i> Tambah Pengguna</button>
            <a href="page/pengguna/cetak-pengguna.php" target="_blank"
                class="btn btn-primary rounded-pill waves-effect waves-light mb-3"><i class="mdi mdi-printer"></i> Cetak</a>

        </div>
    </div>
    <?php
}
?>
<!-- end row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Pengguna</h4>
                <div id="load-table">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    function loadTable() {
        $('#load-table').load('page/pengguna/tabel-pengguna.php')
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Tambah Pengguna');
            // load form
            $('.modal-body').load('page/pengguna/tambah-pengguna.php');
        });
    });
</script>