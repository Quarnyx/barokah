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
                            <th>Harga Jual</th>
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
                        $query = mysqli_query($conn, "SELECT * FROM v_penjualan WHERE kode_penjualan = '$_POST[kode_penjualan]'");
                        while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?= $data['kode_penjualan'] ?></td>
                                <td><?= $data['nama_barang'] ?></td>
                                <td>Rp. <?= number_format($data['harga_jual'], 0, ',', '.') ?></td>
                                <td><?= $data['qty'] ?></td>
                                <td><?= $data['satuan'] ?></td>
                                <td>Rp. <?= number_format($data['harga_jual'] * $data['qty'], 0, ',', '.') ?></td>
                                <td>
                                    <button data-id="<?= $data['id_detail_penjualan'] ?>" id="edit" type="button"
                                        class="btn btn-primary">Edit</button>
                                    <button data-id="<?= $data['id_detail_penjualan'] ?>" id="delete" type="button"
                                        class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <?php
                            $harga_beli += $data['harga_beli'] * $data['qty'];
                            $harga_jual += $data['harga_jual'] * $data['qty'];
                            $total += ($data['harga_jual'] * $data['qty']);
                        }
                        ?>
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<form id="tambah-penjualan" enctype="multipart/form-data">
    <input type="hidden" name="kode_penjualan" value="<?= $_POST['kode_penjualan'] ?>" id="kode_penjualan">
    <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
    <input type="hidden" name="harga_beli" value="<?= $harga_beli ?>">
    <input type="hidden" name="harga_jual" value="<?= $harga_jual ?>">
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="simpleinput" class="form-label">Pelanggan</label>
                        <select class="form-control select2" id="pelanggan" name="id_pelanggan" data-toggle="select2">
                            <option value="">Pilih Pelanggan</option>
                            <?php
                            $sql = "SELECT * FROM pelanggan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) { ?>

                                <option value="<?= $row['id_pelanggan'] ?>" data-alamat="<?= $row['alamat_pelanggan'] ?>">
                                    <?= $row['nama_pelanggan'] ?>
                                </option>
                                <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class=" mb-3">
                        <label for="simpleinput" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="" cols="10" rows="5" readonly></textarea>
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
        <div class=" col-lg-8 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Penjualan</label>
                                <input type="date" name="tanggal_penjualan" class="form-control"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class=" mb-3">
                                <label for="simpleinput" class="form-label">Bayar</label>
                                <input type="text" name="bayar" class="form-control" placeholder="Bayar" id="bayar">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Total</label>
                                <input type="text" name="total" class="form-control" placeholder="Total"
                                    value="<?php echo $total; ?>" id="total">
                            </div>

                            <div class=" mb-3">
                                <label for="simpleinput" class="form-label">Kembalian</label>
                                <input type="text" name="kembalian" class="form-control" placeholder="Kembalian"
                                    id="kembalian">
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

        $('#tabel-data').on('click', '#edit', function () {
            const id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'page/penjualan/edit-penjualan.php',
                data: 'id=' + id,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Edit Data ' + name);
                    $('.modal .modal-body').html(data);
                }
            })
        });

        $('#tabel-data').on('click', '#delete', function () {
            const id = $(this).data('id');
            const id_transaksi = $(this).data('idtransaksi');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus transaksi ini? ', function () {
                $.ajax({
                    type: 'POST',
                    url: 'proses.php?act=hapus-penjualan-detail',
                    data: {
                        id: id,
                        id_transaksi: id_transaksi
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

        $('#bayar').on('keyup', function () {
            var bayar = $(this).val();
            var total = $('#total').val();
            var kembalian = bayar - total;
            $('#kembalian').val(kembalian);
        });

        $("#tambah-penjualan").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var kode_penjualan = $('#kode_penjualan').val();

            $.ajax({
                type: 'POST',
                url: 'proses.php?act=tambah-penjualan',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $(".modal").modal('hide');
                    // loadTable();
                    // reload page
                    // window.location.reload();
                    // konfirmasi cetak
                    alertify.confirm('Cetak Faktur', 'Apakah anda ingin mencetak faktur ini?', function () {
                        window.location.reload();

                        window.open('page/penjualan/cetak-faktur.php?id=' + kode_penjualan, '_blank');
                    }, function () {
                        alertify.error('Cetak dibatalkan');
                    })

                },
                error: function (data) {
                    alertify.error(data);
                }
            });

        });


    });
</script>