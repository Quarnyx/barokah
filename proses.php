<?php

require_once 'config.php';
switch ($_GET['act'] ?? '') {
    case 'tambah-pengguna':
        $username = $_POST['username'];
        $nama_user = $_POST['nama_user'];
        $level = $_POST['level'];
        $password = md5($_POST['password']);
        $sql = "INSERT INTO pengguna (username, password, level, nama_user) VALUES ('$username', '$password', '$level', '$nama_user')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;

        }
        break;
    case 'edit-pengguna':

        $username = $_POST['username'];
        $nama_user = $_POST['nama_user'];
        $level = $_POST['level'];
        $kode_user = $_POST['id'];
        $sql = "UPDATE pengguna SET username = '$username', nama_user = '$nama_user', level = '$level' WHERE id_user = '$kode_user'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }

        break;
    case 'hapus-pengguna':
        $kode_user = $_POST['id'];
        $sql = "DELETE FROM pengguna WHERE id_user = '$kode_user'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'ganti-password':
        $password = md5($_POST['password']);
        $sql = "UPDATE pengguna SET password = '$password' WHERE id_user = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    // proses tambah pelanggan
    case 'tambah-pelanggan':
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $alamat_pelanggan = $_POST['alamat_pelanggan'];
        $no_hp = $_POST['no_hp'];
        $sql = "INSERT INTO pelanggan (nama_pelanggan, alamat_pelanggan, no_hp) VALUES ('$nama_pelanggan', '$alamat_pelanggan', '$no_hp')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'edit-pelanggan':
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $alamat_pelanggan = $_POST['alamat_pelanggan'];
        $no_hp = $_POST['no_hp'];
        $sql = "UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', alamat_pelanggan = '$alamat_pelanggan', no_hp = '$no_hp' WHERE id_pelanggan = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'hapus-pelanggan':
        $sql = "DELETE FROM pelanggan WHERE id_pelanggan = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    // supplier
    case 'tambah-supplier':
        $nama_supplier = $_POST['nama_supplier'];
        $alamat_supplier = $_POST['alamat_supplier'];
        $telp = $_POST['telp'];
        $sql = "INSERT INTO supplier (nama_supplier, alamat_supplier, telp) VALUES ('$nama_supplier', '$alamat_supplier', '$telp')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'edit-supplier':
        $nama_supplier = $_POST['nama_supplier'];
        $alamat_supplier = $_POST['alamat_supplier'];
        $telp = $_POST['telp'];
        $sql = "UPDATE supplier SET nama_supplier = '$nama_supplier', alamat_supplier = '$alamat_supplier', telp = '$telp' WHERE id_supplier = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'hapus-supplier':
        $sql = "DELETE FROM supplier WHERE id_supplier = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    // tambah barang
    case 'tambah-barang':
        $nama_barang = $_POST['nama_barang'];
        $kode_barang = $_POST['kode_barang'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $sql = "INSERT INTO barang (nama_barang, kode_barang, harga_beli, harga_jual) VALUES ('$nama_barang', '$kode_barang', '$harga_beli', '$harga_jual')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'edit-barang':
        $nama_barang = $_POST['nama_barang'];
        $kode_barang = $_POST['kode_barang'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $sql = "UPDATE barang SET nama_barang = '$nama_barang', kode_barang = '$kode_barang', harga_beli = '$harga_beli', harga_jual = '$harga_jual' WHERE id_barang = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'hapus-barang':
        $sql = "DELETE FROM barang WHERE id_barang = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    // akun
    case 'tambah-akun':
        $nama_akun = $_POST['nama_akun'];
        $kode_akun = $_POST['kode_akun'];
        $tipe_akun = $_POST['tipe_akun'];
        $jenis_akun = 0;
        $sql = "INSERT INTO akun (nama_akun, kode_akun, tipe_akun, jenis_akun) VALUES ('$nama_akun', '$kode_akun', '$tipe_akun', '$jenis_akun')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'edit-akun':
        $nama_akun = $_POST['nama_akun'];
        $kode_akun = $_POST['kode_akun'];
        $tipe_akun = $_POST['tipe_akun'];
        $sql = "UPDATE akun SET nama_akun = '$nama_akun', kode_akun = '$kode_akun', tipe_akun = '$tipe_akun' WHERE id_akun = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'hapus-akun':
        $sql = "DELETE FROM akun WHERE id_akun = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;

}