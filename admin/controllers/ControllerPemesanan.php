<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['hewan'])) {
        $hwn = $_GET['hewan'];
        $dbp = mysqli_fetch_assoc(mysqli_query($db, "SELECT harga_hewan FROM hewan WHERE id_hewan = $hwn"));
        $res = array(
            'harga' => $dbp['harga_hewan'],
        );
    } else if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pemesanan INNER JOIN hewan ON pemesanan.id_hewan = hewan.id_hewan WHERE id_pemesanan = $id"));
        
        $res = array(
            'id' => $d['id_pemesanan'],
            'user' => $d['id_user'],
            'hewan' => $d['id_hewan'],
            'jumlah' => $d['jumlah'],
            'harga' => $d['harga_hewan'] * $d['jumlah'],
            'tanggal' => $d['tanggal'],
            'waktu' => $d['waktu'],
        );
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            $user = $_POST['user'];
            $hewan = $_POST['hewan'];
            $jml = $_POST['jumlah'];
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $sql = "INSERT INTO pemesanan VALUES ('', $user, $hewan, $jml, '$date', '$time', 'menunggu')";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "tambah pemesanan", "success");
            break;
        case 'update':
            $id = $_POST['id'];
            $paket = $_POST['paket'];
            $sql = "UPDATE pemesanan SET id_paket = '$paket' WHERE id_pemesanan = '$id'";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "update pemesanan", "success");
            break;
        case 'updateStatus':
            $status = str_replace('status=', '', $_POST['status']);
            $data = explode("%20", $status);
            $id = $data[0];
            $st = $data[1];
            $sql = "UPDATE pemesanan SET status = '$st' WHERE id_pemesanan = $id";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "update status pemesanan");
            break;
        case 'restore':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE pemesanan SET status_data = '1' WHERE id_pemesanan = '$id'");
            setFlasher("Berhasil", "restore pemesanan");
            break;
        case 'delete':
            $id = $_POST['id'];
            mysqli_query($db, "DELETE FROM pemesanan WHERE id_pemesanan = '$id'");
            setFlasher("Berhasil", "delete permanent pemesanan");
            break;
        default:
            header('Location: ../index.php');
            break;
    }
}