<?php
include 'init.php';
$title = 'Transaksi';
include 'template/header.php';

if (!visible('user', $data['status'])) {
    header('Location: dashboard.php');
}

function transaksi($data = null)
{
    $user = $GLOBALS['data'];
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM transaksi INNER JOIN pemesanan ON pemesanan.id_pemesanan = transaksi.id_pemesanan WHERE transaksi.no_nota LIKE '%$data%' AND pemesanan.id_user = $user[id_user]");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM transaksi INNER JOIN pemesanan ON pemesanan.id_pemesanan = transaksi.id_pemesanan WHERE pemesanan.id_user = $user[id_user]");
}

$transaksi = transaksi($_GET['search']);
?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Transaksi</h1>
            </div>
            <div id="updateForm">

            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Transaksi</div>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama User</th>
                                <th scope="col">Nomor Nota</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Extra Biaya</th>
                                <th scope="col">Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($transaksi)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $data['nama_user'] ?></td>
                                    <td class="align-middle"><?= $d['no_nota'] ?></td>
                                    <td class="align-middle"><?= $d['biaya'] ?></td>
                                    <td class="align-middle"><?= $d['extra_biaya'] ?></td>
                                    <td class="align-middle"><?= $d['total_bayar'] ?></td>
                                </tr>
                            <?php $i++;
                            endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<?php include 'template/footer.php' ?>