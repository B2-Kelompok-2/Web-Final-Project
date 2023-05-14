<?php
include 'init.php';
$title = 'Hewan';
include 'template/header.php';

if (!visible('user', $data['status'])) {
    header('Location: dashboard.php');
}

function hewan($data = null) {
    if (!empty($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM hewan WHERE nama_hewan LIKE '%$data%' OR desc_hewan LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM hewan");
}

$hewan = hewan($_GET['search']);

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Hewan</h1>
            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Hewan</div>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center no-footer">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Description</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($hewan)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['nama_hewan'] ?></td>
                                    <td class="align-middle"><?= $d['desc_hewan'] ?></td>
                                    <td class="align-middle"><?= $d['harga_hewan'] ?></td>
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