<?php
include 'init.php';
$title = 'Pemesanan';
include 'template/header.php';

$tgl = date("Y-m-d");

if (!visible('user', $data['status'])) {
    header('Location: dashboard.php');
}

function pemesanan($data = null)
{
    $user = $GLOBALS['data'];
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM pemesanan INNER JOIN hewan ON pemesanan.id_hewan = hewan.id_hewan WHERE hewan.nama_hewan LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM pemesanan INNER JOIN hewan ON pemesanan.id_hewan = hewan.id_hewan WHERE pemesanan.id_user = $user[id_user]");
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
                                <th scope="col">Jumlah</th>
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
                                    <td class="align-middle"><?= $data['nama_user'] ?></td>
                                    <td class="align-middle"><?= $d['nama_hewan'] ?></td>
                                    <td class="align-middle"><?= $d['jumlah'] ?></td>
                                    <td class="align-middle"><?= $d['tanggal'] ?></td>
                                    <td class="align-middle"><?= $d['waktu'] ?></td>
                                    <td class="align-middle">
                                        <?= ucwords($d['status']) ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php if ($d['status'] == 'batal') : ?>
                                            <button class="btn btn-danger btn-del" value="<?= $d['id_pemesanan'] ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php else : ?>
                                            <button class="btn btn-danger btn-delete" value="<?= $d['id_pemesanan'] ?>">
                                                <i class="fas fa-times"></i>
                                            </button>
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
        var hewan = 0;
        var controller = 'controllers/ControllerPemesanan.php'
        $('#formAll').attr('action', controller)

        $('#jumlah').change(function(e) {
            $('#harga').val($(this).val() * hewan)
        });

        $('#hewan').on('change', function(e) {
            $.ajax({
                url: controller,
                method: 'GET',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    hewan = parseInt(response['harga'])
                    $('#harga').val(hewan)
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

        $('.btn-delete').click(function() {
            $('#confirm').modal('show')
            let id = $(this).val()
            $('.confirmation').click(function() {
                if (Boolean($(this).val())) {
                    $.ajax({
                        url: $('#formAll').attr('action'),
                        method: 'POST',
                        data: {
                            id: id,
                            action: "delete",
                            form: $('#form').val()
                        },
                        success: function(response) {
                            window.location = window.location;
                        }
                    })
                } else {
                    $('#confirm').modal('hide')
                }
            })
        })


        $('.btn-del').click(function() {
            $('#confirm').modal('show')
            let id = $(this).val()
            $('.confirmation').click(function() {
                if (Boolean($(this).val())) {
                    $.ajax({
                        url: $('#formAll').attr('action'),
                        method: 'POST',
                        data: {
                            id: id,
                            action: "del",
                            form: $('#form').val()
                        },
                        success: function(response) {
                            window.location = window.location;
                        }
                    })
                } else {
                    $('#confirm').modal('hide')
                }
            })
        })
    })

</script>
<?php include 'template/footer.php' ?>