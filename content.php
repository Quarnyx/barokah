<?php
switch ($_GET['page'] ?? '') {
    case '':
    case 'dashboard':
        include 'page/dashboard.php';
        break;
    case 'pengguna':
        include 'page/pengguna/index.php';
        break;
    case 'pelanggan':
        include 'page/pelanggan/index.php';
        break;
    case 'pemasok':
        include 'page/pemasok/index.php';
        break;
    case 'barang':
        include 'page/barang/index.php';
        break;
    case 'pembelian':
        include 'page/pembelian/index.php';
        break;
    case 'penjualan':
        include 'page/penjualan/index.php';
        break;
    case 'akun':
        include 'page/akun/index.php';
        break;
    case 'jurnal':
        include 'page/jurnal/index.php';
        break;
    case 'stok':
        include 'page/laporan-stok/index.php';
        break;
    case 'laporan-penjualan':
        include 'page/laporan-penjualan/index.php';
        break;
    case 'laporan-pembelian':
        include 'page/laporan-pembelian/index.php';
        break;
    case 'neraca':
        include 'page/neraca/index.php';
        break;
    case 'laba-rugi':
        include 'page/laba-rugi/index.php';
        break;
    case 'return-penjualan':
        include 'page/return-penjualan/index.php';
        break;
    case 'return-pembelian':
        include 'page/return-pembelian/index.php';
        break;
    case 'laporan-return-pembelian':
        include 'page/laporan-return-pembelian/index.php';
        break;
    case 'laporan-return-penjualan':
        include 'page/laporan-return-penjualan/index.php';
        break;
    default:
        include 'page/404.php';
}