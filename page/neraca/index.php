<?php
$sub_title = "Laporan Neraca";
$title = "Laporan Neraca";
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
                    <input type="hidden" name="page" value="neraca">
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
                <h4 class="text-center mt-3 mb-3"><b>TOKO BAROKAH</b><br><b>LAPORAN NERACA</b><br>Periode <?php
                if (!empty($_GET["bulan"])) {
                    echo 'Bulan ' . bulan($_GET['bulan']);
                } else {
                    echo "Semua";
                }
                ?></h4>
                <div class="card-body">


                    <table class="table table-bordered mb-0">
                        <tr>
                            <th class="text-uppercase text-center">Aktiva</th>
                            <th class="text-uppercase text-center">Kewajiban</th>
                        </tr>
                        <tr>
                            <td>
                                <table class="table">
                                    <tr>
                                        <th>Aktiva Lancar</th>
                                    </tr>
                                    <?php
                                    $sqlaktiva = "SELECT SUM(debit) - SUM(kredit) AS debit,
                                                v_jurnal.tipe_akun,
                                                v_jurnal.nama_akun
                                            FROM
                                                v_jurnal
                                            WHERE
                                                tipe_akun = 'Aktiva Lancar' $kondisi
                                            GROUP BY
                                                v_jurnal.nama_akun
                                                HAVING SUM(debit) - SUM(kredit) <> 0";
                                    $aktivalancar = $conn->query($sqlaktiva);
                                    while ($row = $aktivalancar->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td style="padding:0px 0px 0px 25px !important">
                                                <?php echo $row['nama_akun'] ?>
                                            </td>
                                            <td style="padding:0px !important" class="text-end">Rp
                                                <?php echo number_format($row['debit'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important">Jumlah
                                            Aktiva Lancar</td>
                                        <?php
                                        $sqllancar = "SELECT sum(debit)-sum(kredit) AS debit FROM v_jurnal WHERE tipe_akun = 'Aktiva Lancar' $kondisi";
                                        $lancar = $conn->query($sqllancar);
                                        $lancar = $lancar->fetch_array();
                                        ?>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($lancar['debit'], 0, ',', '.') ?>
                                        </td>
                                    <tr>
                                        <th>Aktiva Tetap</th>
                                    </tr>
                                    <?php
                                    $sqlaktiva = "SELECT
                                                SUM(debit) AS debit,
                                                v_jurnal.tipe_akun,
                                                v_jurnal.nama_akun
                                            FROM v_jurnal
                                            WHERE tipe_akun = 'Aktiva Tetap' $kondisi
                                            GROUP BY
                                                v_jurnal.nama_akun";
                                    $aktivalancar = $conn->query($sqlaktiva);
                                    while ($row = $aktivalancar->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td style="padding:0px 0px 0px 25px !important">
                                                <?php echo $row['nama_akun'] ?>
                                            </td>
                                            <td style="padding:0px !important" class="text-end">Rp
                                                <?php echo number_format($row['debit'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important">Jumlah
                                            Aktiva Tetap</td>
                                        <?php
                                        $sqltetap = "SELECT sum(debit) AS debit FROM v_jurnal WHERE tipe_akun = 'Aktiva Tetap' $kondisi";
                                        $tetap = $conn->query($sqltetap);
                                        $tetap = $tetap->fetch_array();
                                        ?>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($tetap['debit'], 0, ',', '.') ?>
                                        </td>
                                    <tr>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important">Jumlah
                                            Aktiva</td>
                                        <?php
                                        $totalwajib = $lancar['debit'] + $tetap['debit'];
                                        ?>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($totalwajib, 0, ',', '.') ?>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                            <!-- kewajiban -->
                            <td>
                                <table class="table">
                                    <tr>
                                        <th>Utang Lancar</th>
                                    </tr>
                                    <?php
                                    $sqlaktiva = "SELECT
                                                SUM(kredit) - SUM(debit) AS kredit,
                                                v_jurnal.tipe_akun,
                                                v_jurnal.nama_akun
                                            FROM v_jurnal
                                            WHERE tipe_akun = 'Utang Lancar' $kondisi
                                            GROUP BY
                                                v_jurnal.nama_akun";
                                    $aktivalancar = $conn->query($sqlaktiva);
                                    while ($row = $aktivalancar->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td style="padding:0px 0px 0px 25px !important">
                                                <?php echo $row['nama_akun'] ?>
                                            </td>
                                            <td style="padding:0px !important" class="text-end">Rp
                                                <?php echo number_format($row['kredit'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important">Total Kewajiban</td>
                                        <?php
                                        $sqlulancar = "SELECT sum(kredit)-sum(debit) AS kredit FROM v_jurnal WHERE tipe_akun = 'Utang Lancar' $kondisi";
                                        $ulancar = $conn->query($sqlulancar);
                                        $ulancar = $ulancar->fetch_array();
                                        ?>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($ulancar['kredit'], 0, ',', '.') ?>
                                        </td>
                                    <tr>
                                        <th>Modal</th>
                                    </tr>
                                    <?php
                                    $sqlaktiva = "SELECT
                                                SUM(kredit) AS kredit,
                                                v_jurnal.tipe_akun,
                                                v_jurnal.nama_akun
                                            FROM v_jurnal
                                            WHERE tipe_akun = 'Modal' $kondisi
                                            GROUP BY
                                                v_jurnal.nama_akun";
                                    $aktivalancar = $conn->query($sqlaktiva);
                                    while ($row = $aktivalancar->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td style="padding:0px 0px 0px 25px !important">
                                                <?php echo $row['nama_akun'] ?>
                                            </td>
                                            <td style="padding:0px !important" class="text-end">Rp
                                                <?php echo number_format($row['kredit'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important">Jumlah Modal
                                        </td>
                                        <?php
                                        $sqlmodal = "SELECT sum(kredit) AS kredit FROM v_jurnal WHERE tipe_akun = 'modal' $kondisi";
                                        $modal = $conn->query($sqlmodal);
                                        $modal = $modal->fetch_array();
                                        ?>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($modal['kredit'], 0, ',', '.') ?>
                                        </td>
                                    <tr>
                                        <th>Laba</th>
                                        <?php
                                        $sqllaba = "SELECT sum(kredit) AS penkredit FROM v_jurnal WHERE tipe_akun = 'Pendapatan' $kondisi";
                                        $laba = $conn->query($sqllaba);
                                        $laba = $laba->fetch_array();
                                        $sqlhpp = "SELECT sum(debit) AS hppdebit FROM v_jurnal WHERE tipe_akun = 'Harga Pokok Penjualan' $kondisi";
                                        $hpp = $conn->query($sqlhpp);
                                        $hpp = $hpp->fetch_array();
                                        $sqlbeban = "SELECT sum(debit) AS bebandebit FROM v_jurnal WHERE tipe_akun = 'Beban' $kondisi";
                                        $beban = $conn->query($sqlbeban);
                                        $beban = $beban->fetch_array();
                                        $laba = $laba['penkredit'] - $hpp['hppdebit'] - $beban['bebandebit'];

                                        ?>
                                        <td class="text-end">Rp
                                            <?php echo number_format($laba, 0, ',', '.') ?>
                                        </td>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important">Total Passiva</td>
                                        <?php
                                        $totalwajib = $modal['kredit'] + $ulancar['kredit'] + $laba;
                                        ?>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($totalwajib, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                </table>
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