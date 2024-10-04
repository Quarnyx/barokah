<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Keranjang</h4>
                <table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Harga Beli</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        session_start();
                        include "../../config.php";
                        $total = 0;
                        $harga_beli = 0;
                        $harga_jual = 0;
                        $query = mysqli_query($conn, "SELECT * FROM v_pembelian WHERE kode_pembelian = '$_POST[kode_pembelian]'");
                        while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?= $data['kode_pembelian'] ?></td>
                                <td><?= $data['nama_barang'] ?></td>
                                <td>Rp. <?= number_format($data['harga_beli'], 0, ',', '.') ?></td>
                                <td><?= $data['qty'] ?></td>
                                <td><?= $data['satuan'] ?></td>
                                <td>Rp. <?= number_format($data['harga_beli'] * $data['qty'], 0, ',', '.') ?></td>
                                <td>
                                    <button data-id="<?= $data['id_detail_pembelian'] ?>" id="delete" type="button"
                                        class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <?php
                            $harga_beli += $data['harga_beli'] * $data['qty'];
                            $total += ($data['harga_beli'] * $data['qty']);
                        }
                        ?>
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<form id="tambah-pembelian" enctype="multipart/form-data">
    <input type="hidden" name="kode_pembelian" value="<?= $_POST['kode_pembelian'] ?>" id="kode_pembelian">
    <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
    <input type="hidden" name="harga_beli" value="<?= $harga_beli ?>">
    <div class="row">
        <div class=" col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tanggal pembelian</label>
                                <input type="date" name="tanggal_pembelian" class="form-control"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Total</label>
                                <input type="text" name="total" class="form-control" placeholder="Total"
                                    value="<?php echo $total; ?>" id="total">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Nota Pembelian</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div> <!-- end card body-->
        </div>

    </div>
</form>

<script>
    $(document).ready(function () {
        $('#tabel-data').DataTable();
        $('#pelanggan').on('change', function () {
            var alamat = $(this).find(':selected').data('alamat');
            $('textarea[name=alamat]').val(alamat);
        });
        $('.select2').select2();
        $('#tabel-data').on('click', '#delete', function () {
            const id = $(this).data('id');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus transaksi ini? ', function () {
                $.ajax({
                    type: 'POST',
                    url: 'proses.php?act=hapus-pembelian-detail',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        loadTable();

                        // alertify pesan sukses
                        alertify.success('Transaksi Berhasil Dihapus');
                    },
                    error: function (data) {
                        alertify.error(data);
                    }
                })
            }, function () {
                alertify.error('Hapus dibatalkan');
            })
        });

        $("#tambah-pembelian").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var kode_pembelian = $('#kode_pembelian').val();

            $.ajax({
                type: 'POST',
                url: 'proses.php?act=tambah-pembelian',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $(".modal").modal('hide');
                    window.location.reload();

                },
                error: function (data) {
                    alertify.error(data);
                }
            });

        });


    });
</script>