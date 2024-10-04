<!-- ========== Menu ========== -->
<div class="app-menu">

    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="index.php" class="logo-light">
            <img src="assets/images/logo-light.png" alt="logo" class="logo-lg">
            <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
        </a>

        <!-- Brand Logo Dark -->
        <a href="index.php" class="logo-dark">
            <img src="assets/images/logo-dark.png" alt="dark logo" class="logo-lg">
            <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
        </a>
    </div>

    <!-- menu-left -->
    <div class="scrollbar">

        <!-- User box -->
        <div class="user-box text-center">
            <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block" data-bs-toggle="dropdown">Geneva
                    Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted mb-0">Admin Head</p>
        </div>

        <!--- Menu -->
        <ul class="menu">

            <li class="menu-title">Navigasi</li>

            <li class="menu-item">
                <a href="?page=dashboard" class="menu-link">
                    <span class="menu-icon"><i data-feather="airplay"></i></span>
                    <span class="menu-text"> Home </span>
                </a>
            </li>
            <?php
            if ($_SESSION['level'] == "Pemilik") {
                ?>
                <li class="menu-title">Data Master</li>

                <li class="menu-item">
                    <a href="?page=akun" class="menu-link">
                        <span class="menu-icon"><i data-feather="calendar"></i></span>
                        <span class="menu-text"> Akun </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=pengguna" class="menu-link">
                        <span class="menu-icon"><i data-feather="calendar"></i></span>
                        <span class="menu-text"> Pengguna </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=pelanggan" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Pelanggan </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=pemasok" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Pemasok </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=barang" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Barang </span>
                    </a>
                </li>
            <?php } ?>
            <?php
            if ($_SESSION['level'] == "Karyawan") {
                ?>
                <li class="menu-item">
                    <a href="?page=pengguna" class="menu-link">
                        <span class="menu-icon"><i data-feather="calendar"></i></span>
                        <span class="menu-text"> Pengguna </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="?page=barang" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Barang </span>
                    </a>
                </li>
                <li class="menu-title">Transaksi</li>

                <li class="menu-item">
                    <a href="?page=penjualan" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Penjualan </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=pembelian" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Pembelian </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=return-pembelian" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Retur Pembelian </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=jurnal" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Jurnal Umum </span>
                    </a>
                </li>
            <?php } ?>
            <?php
            if ($_SESSION['level'] == "Pemilik") {
                ?>
                <li class="menu-title">Laporan</li>

                <li class="menu-item">
                    <a href="?page=stok" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Stok Produk </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=laporan-penjualan" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Penjualan </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=laporan-pembelian" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Pembelian </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=laporan-return-penjualan" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Retur Penjualan </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=laporan-return-pembelian" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Retur Pembelian </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=neraca" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Neraca </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=laba-rugi" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Laba/Rugi </span>
                    </a>
                </li>
            <?php } ?>
            <?php
            if ($_SESSION['level'] == "Karyawan") {
                ?>
                <li class="menu-title">Laporan</li>
                <li class="menu-item">
                    <a href="?page=stok" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Stok Produk </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=laporan-penjualan" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Penjualan </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="?page=laporan-pembelian" class="menu-link">
                        <span class="menu-icon"><i data-feather="message-square"></i></span>
                        <span class="menu-text"> Pembelian </span>
                    </a>
                </li>
            <?php } ?>



        </ul>
        <!--- End Menu -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left menu End ========== -->