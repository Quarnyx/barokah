<?php
$sub_title = "Laporan Laba - Rugi";
$title = "Laporan Laba - Rugi";
include 'partials/page-title.php'; ?>

<div class="row d-print-none">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Filter Periode</h5>
            </div><!-- end card header -->
            <?php
            function tanggal($tanggal)
            {
                $bulan = array(
                    1 => 'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
                $split = explode('-', $tanggal);
                return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
            }
            function bulan($inputbulan)
            {
                $bulan = array(
                    01 => 'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
                return $bulan[(int) $inputbulan];
            }
            if (isset($_GET['bulan'])) {
                $titlebulan = bulan($_GET['bulan']);
            } else {
                $titlebulan = bulan(date('m'));

            }

            ?>
            <div class="card-body">
                <form action="" method="get" class="row g-3">
                    <input type="hidden" name="page" value="laba-rugi">
                    <div class="col-md-6">
                        <label for="validationDefault01" class="form-label">Bulan</label>
                        <select class="form-select" name="bulan" id="validationDefault01">
                            <option selected disabled value="">Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Pilih</button>
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>
<!-- end row-->
<?php if (isset($_GET['bulan'])) { ?>
    <?php
    require_once 'config.php';
    if (isset($_GET['bulan'])) {
        $bulan = $_GET['bulan'];

    }

    if (!isset($_GET['bulan'])) {
        $kondisi = "";
    } else {
        $kondisi = "AND MONTH(tanggal_transaksi) = '$bulan'";
    }
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h4 class="text-center mt-3 mb-3"><b>TOKO BAROKAH</b><br><b>LAPORAN LABA RUGI</b><br>Periode <?php
                if (!empty($_GET["bulan"])) {
                    echo 'Bulan ' . bulan($_GET['bulan']);
                } else {
                    echo "Semua";
                }
                ?></h4>
                <div class="card-body">


                    <table class="table">
                        <tr>
                            <th>Pendapatan</th>
                        </tr>
                        <?php
                        $sqlutang = "SELECT SUM(debit) AS debit, v_jurnal.tipe_akun, v_jurnal.nama_akun FROM v_jurnal WHERE catatan like '%retur%' $kondisi GROUP BY v_jurnal.id_transaksi";
                        $totalutang = 0;
                        $utang = $conn->query($sqlutang);
                        while ($row = $utang->fetch_array()) {
                            ?>
                            <tr>
                                <td style="padding:0px 0px 0px 15px !important">
                                    Retur Pembelian
                                </td>
                                <td style="padding:0px !important" class="text-end">Rp
                                    <?php echo number_format($row['debit'], 0, ',', '.');
                                    $totalutang += $row['debit']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php
                        $sqlaktiva = "SELECT SUM(kredit) - SUM(debit) AS kredit,
                                                                        v_jurnal.tipe_akun,
                                                                        v_jurnal.nama_akun
                                                                    FROM
                                                                        v_jurnal
                                                                    WHERE
                                                                        tipe_akun = 'Pendapatan' $kondisi
                                                                    GROUP BY
                                                                        v_jurnal.nama_akun";
                        $totalkredit = 0;
                        $aktivalancar = $conn->query($sqlaktiva);
                        while ($row = $aktivalancar->fetch_array()) {
                            ?>
                            <tr>
                                <td style="padding:0px 0px 0px 15px !important">
                                    <?php echo $row['nama_akun'] ?>
                                </td>
                                <td style="padding:0px !important" class="text-end">Rp
                                    <?php echo number_format($row['kredit'], 0, ',', '.');
                                    $totalkredit += $row['kredit'];
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php
                        $sqlaktiva = "SELECT SUM(debit) - SUM(kredit) AS kredit,
                                                                        v_jurnal.tipe_akun,
                                                                        v_jurnal.nama_akun
                                                                    FROM
                                                                        v_jurnal
                                                                    WHERE
                                                                        tipe_akun = 'Harga Pokok Penjualan' $kondisi
                                                                    GROUP BY
                                                                        v_jurnal.nama_akun";
                        $totalhpp = 0;
                        $aktivalancar = $conn->query($sqlaktiva);
                        while ($row = $aktivalancar->fetch_array()) {
                            ?>
                            <tr>
                                <td style="padding:0px 0px 0px 15px !important">
                                    <?php echo $row['nama_akun'] ?>
                                </td>
                                <td style="padding:0px !important" class="text-end">Rp
                                    <?php echo number_format($row['kredit'], 0, ',', '.');
                                    $totalhpp += $row['kredit'];
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td style="padding:0px 0px 0px 15px !important">Laba Kotor</td>
                            <td style="padding:0px !important" class="text-end">Rp
                                <?php echo number_format($labakotor = ($totalkredit - $totalhpp) + $totalutang, 0, ',', '.') ?>
                            </td>
                        <tr>
                            <th>Beban</th>
                        </tr>
                        <?php
                        $sqlaktiva = "SELECT
                                                                        SUM(debit) - SUM(kredit) AS debit,
                                                                        v_jurnal.tipe_akun,
                                                                        v_jurnal.nama_akun
                                                                    FROM v_jurnal
                                                                    WHERE tipe_akun = 'Beban' $kondisi
                                                                    GROUP BY
                                                                        v_jurnal.nama_akun";
                        $totalbeban = 0;
                        $aktivalancar = $conn->query($sqlaktiva);
                        while ($row = $aktivalancar->fetch_array()) {
                            ?>
                            <tr>
                                <td style="padding:0px 0px 0px 15px !important">
                                    <?php echo $row['nama_akun'] ?>
                                </td>
                                <td style="padding:0px !important" class="text-end">Rp
                                    <?php echo number_format($row['debit'], 0, ',', '.');
                                    $totalbeban += $row['debit']; ?>
                                </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td style="padding:0px 0px 0px 15px !important">Total Beban</td>
                            <td style="padding:0px !important" class="text-end">Rp
                                <?php echo number_format($totalbeban, 0, ',', '.') ?>
                            </td>
                        <tr>
                        <tr>
                            <td style="padding:0px 0px 0px 15px !important">Laba Bersih</td>
                            <?php
                            $totalwajib = $labakotor - $totalbeban;
                            ?>
                            <td style="padding:0px !important" class="text-end">Rp
                                <?php echo number_format($totalwajib, 0, ',', '.') ?>
                            </td>
                        </tr>

                    </table>
                    <div class="mt-3" style="text-align:end;">
                        <hr>
                        <p class="font-weight-bold">Kendal, <?= tanggal(date('Y-m-d')) ?><br>Mengetahui,</p>
                        <div class="mt-5">
                            <p class="font-weight-bold"><?php echo $_SESSION['nama_user']; ?></p>
                        </div>
                    </div>
                    <div class="mt-4 mb-1">
                        <div class="text-end d-print-none">
                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                    class="mdi mdi-printer me-1"></i> Print</a>
                        </div>
                    </div>
                </div> <!-- end card body-->

            </div> <!-- end card -->

        </div><!-- end col-->
    </div>
    <!-- end row-->
<?php }
?>

<script>
</script>