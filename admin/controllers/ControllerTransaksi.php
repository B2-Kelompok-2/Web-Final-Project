<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['pemesanan'])) {
        $id = $_GET['pemesanan'];
        $dt = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pemesanan INNER JOIN hewan ON pemesanan.id_hewan = hewan.id_hewan WHERE id_pemesanan = $id"));
        $res = array(
            'biaya' => $dt['harga_hewan'] * $dt['jumlah'],
        );
    } else if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM transaksi WHERE id_pemesanan = $id"));
        
        $res = array(
            'id' => $d['id_pemesanan'],
            'nota' => $d['no_nota'],
            'pemesanan' => $d['id_pemesanan'],
            'bayar' => $d['total_bayar'],
            'extra' => $d['extra_biaya'],
            'biaya' => $d['biaya'],
        );
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            $nt = $_POST['nota'];
            $ant = $_POST['pemesanan'];
            $byr = $_POST['bayar'];
            $ext = $_POST['extra'];
            $bya = $_POST['biaya'];
            mysqli_query($db, "INSERT INTO transaksi VALUES ($ant, $_SESSION[id], '$nt', $bya, $ext, $byr)");
            setFlasher("Berhasil", "tambah transaksi", "success");
            break;
        case 'del':
            $id = $_POST['id'];
            mysqli_query($db, "DELETE FROM transaksi WHERE id_pemesanan = '$id'");
            setFlasher("Berhasil", "delete permanent transaksi");
            break;
        default:
            header('Location: ../index.php');
            break;
    }
}
