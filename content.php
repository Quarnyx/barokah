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
    default:
        include 'page/404.php';
}