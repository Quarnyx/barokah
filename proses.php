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
        $password = $_POST['password'];
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
        $password = $_POST['password'];
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
    // pemasok
    case 'tambah-pemasok':
        $nama_pemasok = $_POST['nama_pemasok'];
        $alamat_pemasok = $_POST['alamat_pemasok'];
        $telp = $_POST['telp'];
        $sql = "INSERT INTO pemasok (nama_pemasok, alamat_pemasok, telp) VALUES ('$nama_pemasok', '$alamat_pemasok', '$telp')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'edit-pemasok':
        $nama_pemasok = $_POST['nama_pemasok'];
        $alamat_pemasok = $_POST['alamat_pemasok'];
        $telp = $_POST['telp'];
        $sql = "UPDATE pemasok SET nama_pemasok = '$nama_pemasok', alamat_pemasok = '$alamat_pemasok', telp = '$telp' WHERE id_pemasok = '$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'hapus-pemasok':
        $sql = "DELETE FROM pemasok WHERE id_pemasok = '$_POST[id]'";
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
        $satuan = $_POST['satuan'];
        $sql = "INSERT INTO barang (nama_barang, kode_barang, harga_beli, harga_jual, satuan) VALUES ('$nama_barang', '$kode_barang', '$harga_beli', '$harga_jual', '$satuan')";
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
        $satuan = $_POST['satuan'];
        $sql = "UPDATE barang SET nama_barang = '$nama_barang', kode_barang = '$kode_barang', harga_beli = '$harga_beli', harga_jual = '$harga_jual', satuan = '$satuan' WHERE id_barang = '$_POST[id]'";
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
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        $sql = "UPDATE jurnal SET id_akun_debit = '$id_akun_debit', id_akun_kredit = '$id_akun_kredit', total = '$total', catatan = '$catatan', tanggal_transaksi = '$tanggal_transaksi' WHERE id_transaksi = '$id'";
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

        $id_akun_debit = 4;
        $id_akun_kredit = 11;
        $id_barang = $_POST['id_barang'];
        $id_pemasok = $_POST['id_pemasok'];
        $kode_pembelian = $_POST['kode_pembelian'];
        $qty = $_POST['qty'];
        $total = $_POST['total'];
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

        // cek apakah kode pembelian sudah ada di tabel pembelian
        $sql = "SELECT * FROM pembelian WHERE kode_pembelian = '$kode_pembelian'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // update pembelian
            $sql = "UPDATE pembelian SET tanggal_pembelian = '$tanggal_pembelian', gambar = '$gambar', total = '$total' WHERE kode_pembelian = '$kode_pembelian'";
            $result = $conn->query($sql);
            if ($result) {
                http_response_code(200);
            } else {
                http_response_code(500);
                echo $conn->error;
            }
            $sql = "SELECT * FROM pembelian WHERE kode_pembelian = '$kode_pembelian'";
            $row = $conn->query($sql)->fetch_assoc();
            $id_transaksi = $row['id_transaksi'];
            // update transaksi pembelian
            $sql = "UPDATE jurnal SET id_akun_debit = '$id_akun_debit', id_akun_kredit = '$id_akun_kredit', total = '$total', catatan = '$catatan' WHERE id_transaksi = '$id_transaksi'";
            $result = $conn->query($sql);
            if ($result) {
                http_response_code(200);
            } else {
                http_response_code(500);
                echo $conn->error;
            }
        } else {

            // input ke tabel transaksi
            tambahTransaksi($id_akun_debit, $id_akun_kredit, $total, $catatan, $tanggal_pembelian, $conn);
            // ambil id transaksi terakhir
            $sql = "SELECT id_transaksi FROM jurnal ORDER BY id_transaksi DESC LIMIT 1";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id_transaksi = $row['id_transaksi'];
            // input ke tabel pembelian
            $sql = "INSERT INTO pembelian (kode_pembelian, id_transaksi, tanggal_pembelian, gambar, total)
        VALUES ('$kode_pembelian', '$id_transaksi', '$tanggal_pembelian', '$gambar', '$total')";
            $result = $conn->query($sql);
            if ($result) {
                http_response_code(200);
            } else {
                http_response_code(500);
                echo $conn->error;
            }
        }
        break;
    case 'tambah-pembelian-detail':

        $id_barang = $_POST['id_barang'];
        $id_pemasok = $_POST['id_pemasok'];
        $kode_pembelian = $_POST['kode_pembelian'];
        $harga_beli = $_POST['harga_beli'];
        $qty = $_POST['qty'];
        $total = $harga_beli * $qty;
        $tanggal_pembelian = $_POST['tanggal_pembelian'];
        $sql = "INSERT INTO detail_pembelian (id_pemasok, id_barang, qty, harga_beli, kode_pembelian, tanggal_pembelian) 
        VALUES ('$id_pemasok', '$id_barang', '$qty', '$harga_beli', '$kode_pembelian', '$tanggal_pembelian')";
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
        $id_pemasok = $_POST['id_pemasok'];
        $kode_pembelian = $_POST['kode_pembelian'];
        $harga_beli = $_POST['harga_beli'];
        $qty = $_POST['qty'];
        $total = $harga_beli * $qty;
        $catatan = 'Pembelian' . $kode_pembelian;
        $id = $_POST['id'];
        $id_transaksi = $_POST['id_transaksi'];
        echo $id;
        $sql = "UPDATE pembelian SET id_pemasok = '$id_pemasok', id_barang = '$id_barang', qty = '$qty', harga_beli = '$harga_beli' WHERE id_pembelian = '$id'";
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
        $kode_pembelian = $_POST['kode_pembelian'];
        $id_transaksi = $_POST['id_transaksi'];
        echo $id_transaksi;
        $sql = "DELETE FROM pembelian WHERE kode_pembelian = '$kode_pembelian'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        $sql = "DELETE FROM detail_pembelian WHERE kode_pembelian = '$kode_pembelian'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        hapusTransaksi($id_transaksi, $conn);

        break;
    case 'hapus-pembelian-detail':
        $id = $_POST['id'];
        echo $id_transaksi;
        $sql = "DELETE FROM detail_pembelian WHERE id_detail_pembelian = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }

        break;
    case 'tambah-penjualan-detail':
        $id_barang = $_POST['id_barang'];
        $qty = $_POST['qty'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $tanggal_penjualan = date('Y-m-d');
        $kode_penjualan = $_POST['kode_penjualan'];
        $sql = "INSERT INTO detail_penjualan (id_barang, qty, harga_beli, harga_jual, kode_penjualan, tanggal_penjualan) VALUES ('$id_barang', '$qty', '$harga_beli', '$harga_jual', '$kode_penjualan', '$tanggal_penjualan')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'edit-penjualan-detail':
        $id_barang = $_POST['id_barang'];
        $qty = $_POST['qty'];
        $harga_jual = $_POST['harga_jual'];
        $id = $_POST['id'];
        echo $id;
        $sql = "UPDATE detail_penjualan SET id_barang = '$id_barang', qty = '$qty', harga_jual = '$harga_jual' WHERE id_detail_penjualan = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'hapus-penjualan-detail':
        $id = $_POST['id'];
        $sql = "DELETE FROM detail_penjualan WHERE id_detail_penjualan = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'tambah-penjualan':
        // simpan persediaan - hpp
        $id_akun_debit = 6;
        $id_akun_kredit = 4;
        $total = $_POST['harga_beli'];
        $catatan = 'Penjualan HPP ' . $_POST['kode_penjualan'];
        $tanggal_transaksi = $_POST['tanggal_penjualan'];
        $sql = "INSERT INTO jurnal (id_akun_debit, id_akun_kredit, total, catatan, tanggal_transaksi    ) VALUES ('$id_akun_debit', '$id_akun_kredit', '$total', '$catatan', '$tanggal_transaksi')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        // simpan kas pendapatan
        $id_akun_debit = 2;
        $id_akun_kredit = 5;
        $total = $_POST['harga_jual'];
        $catatan = 'Penjualan Masuk ' . $_POST['kode_penjualan'];
        $tanggal_transaksi = $_POST['tanggal_penjualan'];
        tambahTransaksi($id_akun_debit, $id_akun_kredit, $total, $catatan, $tanggal_transaksi, $conn);
        // ambil id transaksi terakhir
        $sql = "SELECT id_transaksi FROM jurnal ORDER BY id_transaksi DESC LIMIT 1";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        $id_jurnal = $data['id_transaksi'];
        // simpan penjualan
        $id_user = $_POST['id_user'];
        $total = $_POST['total'];
        $id_pelanggan = $_POST['id_pelanggan'];
        $kode_penjualan = $_POST['kode_penjualan'];
        $tanggal_penjualan = $_POST['tanggal_penjualan'];
        $sql = "INSERT INTO penjualan (id_user, total, id_pelanggan, kode_penjualan, tanggal_penjualan, id_transaksi) VALUES ('$id_user', '$total', '$id_pelanggan', '$kode_penjualan', '$tanggal_penjualan', '$id_jurnal')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        //update detail penjualan
        $sql = "UPDATE detail_penjualan SET tanggal_penjualan = '$tanggal_penjualan' WHERE kode_penjualan = '$kode_penjualan'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'tambah-return-penjualan':
        $tanggal_return_penjualan = $_POST['tanggal_return_penjualan'];
        $kode_return_penjualan = $_POST['kode_return_penjualan'];
        $catatan = $_POST['catatan'];
        $id_barang = $_POST['id_barang'];
        $jumlah = $_POST['jumlah'];
        $sql = "INSERT INTO return_penjualan (id_barang, kode_return_penjualan, tanggal_return_penjualan, catatan, jumlah) VALUES ('$id_barang', '$kode_return_penjualan', '$tanggal_return_penjualan', '$catatan', '$jumlah')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'edit-return-penjualan':
        $id = $_POST['id'];
        $id_barang = $_POST['id_barang'];
        $catatan = $_POST['catatan'];
        $jumlah = $_POST['jumlah'];
        $tanggal_return_penjualan = $_POST['tanggal_return_penjualan'];
        $sql = "UPDATE return_penjualan SET tanggal_return_penjualan = '$tanggal_return_penjualan', jumlah = '$jumlah', id_barang = '$id_barang', catatan = '$catatan' WHERE id_return_penjualan = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }

        break;
    case 'hapus-return-penjualan':
        $id = $_POST['id'];
        $sql = "DELETE FROM return_penjualan WHERE id_return_penjualan = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    // return pembelian
    case 'tambah-return-pembelian':
        $id_akun_debit = 11;
        $id_akun_kredit = 4;
        $tanggal_return_pembelian = $_POST['tanggal_return_pembelian'];
        $kode_return_pembelian = $_POST['kode_return_pembelian'];
        $catatan = 'Retur Pembelian' . $_POST['catatan'];
        $id_barang = $_POST['id_barang'];
        $jumlah = $_POST['jumlah'];
        $id_pemasok = $_POST['id_pemasok'];
        // ambil harga barang
        $sql = "SELECT harga_beli FROM barang WHERE id_barang = '$id_barang'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total = $row['harga_beli'] * $jumlah;
        tambahTransaksi($id_akun_debit, $id_akun_kredit, $total, $catatan, $tanggal_return_pembelian, $conn);
        // ambil id transaksi terakhir
        $sql = "SELECT id_transaksi FROM jurnal ORDER BY id_transaksi DESC LIMIT 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_transaksi = $row['id_transaksi'];
        // simpan return pembelian
        $sql = "INSERT INTO return_pembelian (id_barang, kode_return_pembelian, tanggal_return_pembelian, catatan, jumlah, id_transaksi, id_pemasok) VALUES ('$id_barang', '$kode_return_pembelian', '$tanggal_return_pembelian', '$catatan', '$jumlah', '$id_transaksi', '$id_pemasok')";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;
    case 'edit-return-pembelian':
        $id = $_POST['id'];
        $id_barang = $_POST['id_barang'];
        $catatan = $_POST['catatan'];
        $jumlah = $_POST['jumlah'];
        $id_pemasok = $_POST['id_pemasok'];
        $tanggal_return_pembelian = $_POST['tanggal_return_pembelian'];
        $sql = "UPDATE return_pembelian SET tanggal_return_pembelian = '$tanggal_return_pembelian', jumlah = '$jumlah', id_barang = '$id_barang', catatan = '$catatan', id_pemasok = '$id_pemasok' WHERE id_return_pembelian = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        $id_transaksi = $_POST['id_transaksi'];
        // ambil harga barang
        $sql = "SELECT harga_beli FROM barang WHERE id_barang = '$id_barang'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total = $row['harga_beli'] * $jumlah;
        $sql = "UPDATE jurnal SET total = '$total', catatan = '$catatan', tanggal_transaksi = '$tanggal_return_pembelian' WHERE id_transaksi = '$id_transaksi'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }

        break;
    case 'hapus-return-pembelian':
        $id = $_POST['id'];
        $sql = "DELETE FROM return_pembelian WHERE id_return_pembelian = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        $id_transaksi = $_POST['id_transaksi'];
        $sql = "DELETE FROM jurnal WHERE id_transaksi = '$id_transaksi'";
        $result = $conn->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $conn->error;
        }
        break;




}