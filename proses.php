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

}