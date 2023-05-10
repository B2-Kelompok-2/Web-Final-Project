<?php
include 'init.php';
$title = 'Pemesanan';
include 'template/header.php';

$tgl = date("Y-m-d");

if (!visible('admin|kasir', $data['status'])) {
    header('Location: dashboard.php');
}

function pemesanan($data = null)
{
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM pemesanan INNER JOIN hewan ON pemesanan.id_hewan = hewan.id_hewan WHERE hewan.nama_hewan LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM pemesanan INNER JOIN hewan ON pemesanan.id_hewan = hewan.id_hewan");
}

$user = mysqli_query($db, "SELECT * FROM user WHERE status = 'user'");
$hewan = mysqli_query($db, 'SELECT * FROM hewan');
$pemesanan = pemesanan($_GET['search']);

function status($st, $s)
{
    return ($st == $s) ? "selected" : "";
}
?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pemesanan</h1>
            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Pemesanan</div>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-success btn-add">Tambah Pemesanan</button>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center no-footer">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Hewan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($pemesanan)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['nama_user'] ?></td>
                                    <td class="align-middle"><?= $d['jenis_hewan'] ?></td>
                                    <td class="align-middle"><?= $d['tanggal'] ?></td>
                                    <td class="align-middle"><?= $d['waktu'] ?></td>
                                    <td class="align-middle">
                                        <select class="form-control status" name="status">
                                            <option <?= status($d['status'], 'menunggu') ?> value="<?= $d['id_pemesanan'] ?> menunggu">Menunggu</option>
                                            <option <?= status($d['status'], 'selesai') ?> value="<?= $d['id_pemesanan'] ?> selesai">Selesai</option>
                                            <option <?= status($d['status'], 'batal') ?> value="<?= $d['id_pemesanan'] ?> batal">Batal</option>
                                        </select>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete" value="<?= $d['id_pemesanan'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update" value="<?= $d['id_pemesanan'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <?php if ($d['status'] == 'selesai') : ?>
                                            <a href="transaksi.php?id=<?= $d['id_pemesanan'] ?>" class="btn btn-success btn-transaksi">
                                                <i class="fas fa-coins"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
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
<?php include 'template/modal.php' ?>
<script>
    $(document).ready(function() {
        var biaya = 0;
        var hewan = 0;
        var controller = 'controllers/ControllerAntrian.php'
        $('#formAll').attr('action', controller)

        $('#user').on('change', function(e) {
            $.ajax({
                url: controller,
                method: 'GET',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    biaya = parseInt(response['biaya'])
                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });
                    $('#harga').val(biaya + hewan)
                },
            })
        })

        $('#hewan').on('change', function(e) {
            $.ajax({
                url: controller,
                method: 'GET',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    hewan = parseInt(response['harga'])
                    $('#harga').val(biaya + hewan)
                }
            })
        })

        $('.status').on('change', function(e) {
            $.ajax({
                url: controller,
                method: 'POST',
                data: {
                    status: $(this).serialize(),
                    action: "updateStatus"
                },
                success: function(response) {
                    window.location = window.location;
                },
                error: function(response) {
                    console.log(response)
                }
            })
        })

        $('.btn-add').click(function() {
            $('#modalTitle').html('Tambah Pemesanan')
            $('#action').val('store')
            $('#modalForm').modal('show')
            $('#tanggal').val('<?= $tgl ?>');
        });


        $('.btn-update').click(function() {
            $('#modalTitle').html('Update Pemesanan')
            $('#action').val('update')
            $('#mobil').addClass('d-none');
            var id = $(this).val()
            $.ajax({
                method: "GET",
                url: controller,
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    biaya = parseInt(response['biaya'])
                    hewan = parseInt(response['harga'])
                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });
                    $('#harga').val(biaya + hewan)

                    $('#modalForm').modal('show')
                }
            })

        })
    })
</script>
<?php include 'template/footer.php' ?>