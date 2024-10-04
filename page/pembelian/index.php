<?php
$sub_title = "Pembelian Barang";
$title = "Pembelian";
include 'partials/page-title.php'; ?>


<!-- end row-->
<?php
require_once 'config.php';
$query = mysqli_query($conn, "SELECT MAX(kode_pembelian) AS kode_pembelian FROM pembelian");
$data = mysqli_fetch_array($query);
$max = $data['kode_pembelian'] ? substr($data['kode_pembelian'], 3, 3) : "000";
$no = $max + 1;
$char = "PMB";
$kode = $char . sprintf("%03s", $no);
if (isset($_GET['kode_pembelian'])) {
    $kode = $_GET['kode_pembelian'];
}
?>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="">Kode Pembelian</h3>
                <input type="text" class="form-control" id="kode" value="<?= $kode ?>">
                <h3 class="mt-3">Tanggal : <?= date('d-m-Y') ?></h3>
                <button type="button" class="btn btn-success rounded-pill waves-effect waves-light mt-3"
                    id="riwayat-pembelian">Riwayat Pembelian</button>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="tambah-pembelian-detail" enctype="multipart/form-data">
                    <input type="hidden" name="kode_pembelian" value="<?= $kode ?>">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Barang</label>
                                <select class="form-control select2" id="barang" name="id_barang" data-toggle="select2">
                                    <option value="">Pilih Barang</option>
                                    <?php
                                    require_once 'config.php';
                                    $sql = "SELECT * FROM barang";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>

                                        <option value="<?= $row['id_barang'] ?>" data-hargabeli="<?= $row['harga_beli'] ?>">
                                            <?= $row['nama_barang'] ?>
                                        </option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Harga Beli</label>
                                <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Qty</label>
                                <input type="number" name="qty" class="form-control" placeholder="Qty">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Pemosok</label>
                                <select class="form-control select2" id="pemasok" name="id_pemasok"
                                    data-toggle="select2">
                                    <option value="">Pilih Pemasok</option>
                                    <?php
                                    require_once 'config.php';
                                    $sql = "SELECT * FROM pemasok";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>

                                        <option value="<?= $row['id_pemasok'] ?>"><?= $row['nama_pemasok'] ?></option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">

                            <label class="form-label">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" class="form-control" placeholder="tanggal">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success rounded-pill waves-effect waves-light mt-3"><i
                                    class="mdi mdi-plus"></i> Tambah Barang</button>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="load-table"></div>


<script>
    function loadTable() {
        var kode_pembelian = "<?php echo $kode; ?>";
        $('#load-table').load('page/pembelian/tabel-pembelian.php', { kode_pembelian: kode_pembelian })
    }
    $(document).ready(function () {
        $('.select2').select2();
        loadTable();
        $('#riwayat-pembelian').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Riwayat Pembelian');
            // load form
            $('.modal-body').load('page/pembelian/riwayat-pembelian.php');
        });
        $('#barang').on('change', function () {
            var hargabeli = $(this).find(':selected').data('hargabeli');
            $('input[name=harga_beli]').val(hargabeli);
        });

        $("#tambah-pembelian-detail").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'proses.php?act=tambah-pembelian-detail',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $(".modal").modal('hide');
                    loadTable();

                    // alertify pesan sukses
                    alertify.success('Pembelian Berhasil Ditambah');

                },
                error: function (data) {
                    alertify.error(data);
                }
            });
        });
    });
</script>