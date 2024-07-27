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
    case 'supplier':
        include 'page/supplier/index.php';
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
    default:
        include 'page/404.php';
}