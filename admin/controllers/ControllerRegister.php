<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if($_POST) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $no = $_POST['no'];
    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM user WHERE username = '$username' OR no_user = '$no'")) == 0) {
        $password = md5($_POST['password']);
        $alamat = $_POST['alamat'];
        $jk = $_POST['jk'];
        $status = $_POST['status'];
        $sql = "INSERT INTO user VALUES ('', '$nama', '$no', '$alamat', 'user', '$jk', '$username', '$password', '1')";
        mysqli_query($db, $sql);
        setFlasher("Berhasil", "Registrasi");
    } else {
        setFlasher("Gagal", "Registrasi", "error");
    }
}
// } else {
//     setFlasher("Gagal", "Registrasi", "error");
// }

header('Location: ../../index.php');