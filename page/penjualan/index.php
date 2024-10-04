<?php
$sub_title = "Penjualan Barang";
$title = "Penjualan";
include 'partials/page-title.php'; ?>


<!-- end row-->
<?php
require_once 'config.php';
$query = mysqli_query($conn, "SELECT MAX(kode_penjualan) AS kode_penjualan FROM penjualan");
$data = mysqli_fetch_array($query);
$max = $data['kode_penjualan'] ? substr($data['kode_penjualan'], 3, 3) : "000";
$no = $max + 1;
$char = "PJN";
$kode = $char . sprintf("%03s", $no);
?>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Kode Penjualan</h4>
                <h2><?php echo $kode ?></h2>
                <h4><?php echo date("Y-m-d") ?></h4>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="tambah-penjualan-detail" enctype="multipart/form-data">
                    <input type="hidden" name="kode_penjualan" value="<?= $kode ?>">
                    <div class="row">
                        <div class="col-lg-4">
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

                                        <option value="<?= $row['id_barang'] ?>" data-hargabeli="<?= $row['harga_beli'] ?>"
                                            data-hargajual="<?= $row['harga_jual'] ?>"><?= $row['nama_barang'] ?></option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Harga Jual</label>
                                <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual">
                                <input type="hidden" name="harga_beli">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Qty</label>
                                <input type="number" name="qty" class="form-control" placeholder="Qty">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success rounded-pill waves-effect waves-light mb-3"><i
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
        var kode_penjualan = "<?php echo $kode; ?>";
        $('#load-table').load('page/penjualan/tabel-penjualan.php', { kode_penjualan: kode_penjualan })
    }
    $(document).ready(function () {
        $('.select2').select2();
        loadTable();
        $('#barang').on('change', function () {
            var hargabeli = $(this).find(':selected').data('hargabeli');
            var hargajual = $(this).find(':selected').data('hargajual');
            $('input[name=harga_beli]').val(hargabeli);
            $('input[name=harga_jual]').val(hargajual);
        });

        $("#tambah-penjualan-detail").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'proses.php?act=tambah-penjualan-detail',
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