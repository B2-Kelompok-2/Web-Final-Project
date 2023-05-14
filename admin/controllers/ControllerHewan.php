<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM hewan WHERE id_hewan = $id"));
        $res = array(
            'id' => $d['id_hewan'],
            'nama' => $d['nama_hewan'],
            'desc' => $d['desc_hewan'],
            'harga' => $d['harga_hewan'],
        );
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            $nama_hewan = $_POST['nama'];
            $desc = $_POST['desc'];
            $harga_hewan = $_POST['harga'];
            $sql = "INSERT INTO hewan VALUES ('', '$nama_hewan', '$desc', '$harga_hewan')";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "Tambah Hewan", "success");
            break;
        case 'update':
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $desc = $_POST['desc'];
            $harga = $_POST['harga'];
            $sql = "UPDATE hewan SET nama_hewan = '$nama', desc_hewan = '$desc', harga_hewan = $harga WHERE id_hewan = $id";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "update", "success");
            break;
        case 'restore':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE hewan SET status_data = '1' WHERE id_hewan = '$id'");
            setFlasher("Berhasil", "restore hewan");
            break;
        case 'delete':
            $id = $_POST["id"];
            mysqli_query($db, "DELETE FROM hewan WHERE id_hewan = '$id'");
            setFlasher("Berhasil", "delete permanent hewan");
            break;
        default:
            header('Location: admin/dashboard.php');
            break;
    }
}