<?php

function tambahTransaksi($id_akun_debit, $id_akun_kredit, $total, $catatan, $tanggal_transaksi, $conn)
{
    $sql = "INSERT INTO jurnal (id_akun_debit, id_akun_kredit, total, catatan, tanggal_transaksi) VALUES ('$id_akun_debit', '$id_akun_kredit', '$total', '$catatan', '$tanggal_transaksi')";
    $result = $conn->query($sql);
    if ($result) {
        http_response_code(200);
    } else {
        http_response_code(500);
        echo $conn->error;
    }
}
function hapusTransaksi($id, $conn)
{
    $sql = "DELETE FROM jurnal WHERE id_transaksi = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        http_response_code(200);
    } else {
        http_response_code(500);
        echo $conn->error;
    }
}

function editPembelian($conn, $id_akun_debit, $id_akun_kredit, $total, $catatan, $id)
{
    $sql = "UPDATE jurnal SET id_akun_debit = '$id_akun_debit', id_akun_kredit = '$id_akun_kredit', total = '$total', catatan = '$catatan' WHERE id_transaksi = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        http_response_code(200);
    } else {
        http_response_code(500);
        echo $conn->error;
    }
}
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
    case 'tambah-transaksi':
        $id_akun_debit = $_POST['id_akun_debit'];
        $id_akun_kredit = $_POST['id_akun_kredit'];
        $total = $_POST['total'];
        $catatan = $_POST['catatan'];
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        tambahTransaksi($_POST['id_akun_debit'], $_POST['id_akun_kredit'], $_POST['total'], $_POST['catatan'], $_POST['tanggal_transaksi'], $conn);
        break;
    case 'edit-transaksi':
        $id_akun_debit = $_POST['id_akun_debit'];
        $id_akun_kredit = $_POST['id_akun_kredit'];
        $total = $_POST['total'];
        $catatan = $_POST['catatan'];
        $id = $_POST['id'];
        $sql = "UPDATE jurnal SET id_akun_debit = '$id_akun_debit', id_akun_kredit = '$id_akun_kredit', total = '$total', catatan = '$catatan' WHERE id_transaksi = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'hapus-transaksi':
        $id = $_POST['id'];
        hapusTransaksi($_POST['id'], $conn);

        break;
    case 'tambah-pembelian':

        $id_akun_debit = $_POST['id_akun_debit'];
        $id_akun_kredit = $_POST['id_akun_kredit'];
        $id_barang = $_POST['id_barang'];
        $id_supplier = $_POST['id_supplier'];
        $kode_pembelian = $_POST['kode_pembelian'];
        $harga_beli = $_POST['harga_beli'];
        $qty = $_POST['qty'];
        $total = $harga_beli * $qty;
        $catatan = 'Pembelian' . $kode_pembelian;
        $tanggal_pembelian = $_POST['tanggal_pembelian'];
        $gambar = $_FILES['gambar']['name'];
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['gambar']['size'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        // generate random number for photo filename
        $gambar = rand(1000, 1000000) . "." . $ekstensi;
        $file_loc = 'assets/img/pembelian/' . $gambar;
        move_uploaded_file($file_tmp, $file_loc);
        //get file location
        // input ke tabel transaksi
        tambahTransaksi($id_akun_debit, $id_akun_kredit, $total, $catatan, $tanggal_pembelian, $conn);
        // ambil id transaksi terakhir
        $sql = "SELECT id_transaksi FROM jurnal ORDER BY id_transaksi DESC LIMIT 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_transaksi = $row['id_transaksi'];
        // input ke tabel pembelian
        $sql = "INSERT INTO pembelian (id_supplier, id_barang, qty, harga_beli, kode_pembelian, id_transaksi, gambar, tanggal_pembelian) VALUES ('$id_supplier', '$id_barang', '$qty', '$harga_beli', '$kode_pembelian', '$id_transaksi', '$gambar', '$tanggal_pembelian')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'edit-pembelian':
        $id_akun_debit = $_POST['id_akun_debit'];
        $id_akun_kredit = $_POST['id_akun_kredit'];
        $id_barang = $_POST['id_barang'];
        $id_supplier = $_POST['id_supplier'];
        $kode_pembelian = $_POST['kode_pembelian'];
        $harga_beli = $_POST['harga_beli'];
        $qty = $_POST['qty'];
        $total = $harga_beli * $qty;
        $catatan = 'Pembelian' . $kode_pembelian;
        $id = $_POST['id'];
        $id_transaksi = $_POST['id_transaksi'];
        echo $id;
        $sql = "UPDATE pembelian SET id_supplier = '$id_supplier', id_barang = '$id_barang', qty = '$qty', harga_beli = '$harga_beli' WHERE id_pembelian = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }

        editPembelian($conn, $_POST['id_akun_debit'], $_POST['id_akun_kredit'], $total, $catatan, $id_transaksi);
        break;

    case 'hapus-pembelian':
        $id = $_POST['id'];
        $id_transaksi = $_POST['id_transaksi'];
        echo $id_transaksi;
        $sql = "DELETE FROM pembelian WHERE id_pembelian = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        hapusTransaksi($id_transaksi, $conn);

        break;



}