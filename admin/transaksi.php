<?php
include 'init.php';
$title = 'Transaksi';
include 'template/header.php';

if (!visible('admin|kasir', $data['status'])) {
    header('Location: dashboard.php');
}

// Ini untuk instant jalanin modal diawal ketika redirect dr pemesanan, sesuaikan aja, klw di km kan cmn pake/hewan, mobil mobil ilangin aja
// if (!empty($_GET['id'])) {
//     $id = $_GET['id'];
//     $dt = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pemesanan WHERE id_antrian = $id"));

//     $tipe = $dt['tipe_mobil'];
//     $ukr = mysqli_fetch_assoc(mysqli_query($db, "SELECT nama_hewan FROM hewan WHERE desc_paket = '$tipe'"));

//     $ukr = $ukr['ukuran_mobil'];
//     $dba = mysqli_fetch_assoc(mysqli_query($db, "SELECT biaya_tambahan FROM ukuran_mobil WHERE ukuran_mobil = '$ukr'"));

//     $pkt = $dt['id_paket'];
//     $dbp = mysqli_fetch_assoc(mysqli_query($db, "SELECT harga_paket FROM paket_pencucian WHERE id_paket = $pkt"));

//     $biaya = $dba['biaya_tambahan'] + $dbp['harga_paket'];
// }

// Otomatis Nomor Nota
$nota = date("Ymd") . (mysqli_num_rows(mysqli_query($db, "SELECT * FROM transaksi")) + 1);

// ini dikasus mu jadi pemesanan
$antrian = mysqli_query($db, "SELECT id_antrian, id_hewan FROM antrian WHERE status = 'selesai'");

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
                <div class="col-12 mb-3 d-flex justify-content-between">
                    <div class="form-group m-0 p-0">
                        <button class="btn btn-success btn-add">Tambah Transaksi</button>
                    </div>
                    <div class="form-group m-0 p-0">
                        <form method="POST" action="laporan.php">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="1" readonly>
                                <input type="text" name="daterange" class="form-control daterange">
                                <div class="input-group-prepend p-0 m-0">
                                    <button type="submit" class="btn btn-info form-control shadow-none"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Plat</th>
                                <th scope="col">Grup Pencuci </th>
                                <th scope="col">Nomor Nota</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Extra Biaya</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($transaksi)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['no_plat'] ?></td>
                                    <td class="align-middle"><?= $d['nama_group'] ?></td>
                                    <td class="align-middle"><?= $d['no_nota'] ?></td>
                                    <td class="align-middle"><?= $d['biaya'] ?></td>
                                    <td class="align-middle"><?= $d['extra_biaya'] ?></td>
                                    <td class="align-middle"><?= $d['total_bayar'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete my-2" value="<?= $d['id_antrian'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <a href="nota.php?id=<?= $d['id_antrian'] ?>" class="btn btn-info btn-update my-2">
                                            <i class="fas fa-print"></i>
                                        </a>
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
        var controller = 'controllers/ControllerTransaksi.php'
        $('#formAll').attr('action', controller)

        var biaya = 0
        var total = 0
        var kembali = 0
        // Ini unutk validasi uangnya < atau > dari harganya, klw kurang ngk bisa submit
        function validate(bayar) {
            if (bayar < total) {
                $('#submit').attr('disabled', true);
                $('#bayaran').html("Pembayaran kurang");
            } else {
                $('#submit').removeAttr('disabled');
                $('#bayaran').html(' ')
                kembali = parseInt(bayar) - total
                $('#kembali').val(kembali);
            }
        }

        // Ini buat lgsg jalnin modal, hapus aja kalau di kasusmu
        if (Boolean(<?= $_GET['id'] ?>)) {
            $('#modalTitle').html('Tambah Transaksi')
            $('#action').val('store')
            $('#modalForm').modal('show')
            $('#antrian').val(<?= $id ?>)
            $('#biaya').val(<?= $biaya ?>)
            biaya = $('#biaya').val()
            $('#total').val(total + parseInt(biaya));
            total = parseInt($('#total').val());
        }

        // Ini untuk auto update total ketika extra biaya ditambahkan
        $('#extra').change(function() {
            if ($(this).val()) {
                total = parseInt($('#biaya').val()) + parseInt($(this).val())
                $('#total').val(total);
            }
            validate($('#bayar').val())
        });

        // Validasi duit ketika bayarnya diubah
        $('#bayar').change(function() {
            validate($(this).val())
        });

        // Nah ini ajax buat ambil biaya antrian ketika selectnya diubah jd pemesanan
        $('#antrian').change(function(e) {
            e.preventDefault()
            $.ajax({
                method: "GET",
                url: controller,
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });
                    biaya = $('#biaya').val()
                    $('#total').val(total + parseInt(biaya));
                    total = $('#total').val();
                }
            });
        });

        // ini biarkan
        $('.btn-add').click(function() {
            $('#modalTitle').html('Tambah Transaksi')
            $('#antri').removeClass('d-none');
            $('#action').val('store')
            $('#modalForm').modal('show')
            $('#nota').val(<?= $nota ?>);
        });

        // Ini sesuaikan dgn controllermu nanti
        $('.btn-update').click(function() {
            $('#modalTitle').html('Update Transaksi')
            $('#antri').addClass('d-none');
            var id = $(this).val()
            $.ajax({
                method: "GET",
                url: controller,
                data: {
                    id: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    $('#action').val('update')
                    $('#id').val(id)

                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });

                    total = parseInt(response['biaya']) + parseInt(response['extra'])
                    $('#total').val(total);

                    kembali = parseInt(response['bayar']) - total
                    $('#kembali').val(kembali);

                    $('#modalForm').modal('show')
                }
            })

        })
    })
</script>
<?php include 'template/footer.php' ?>