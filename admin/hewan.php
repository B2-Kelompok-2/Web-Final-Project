<?php
include 'init.php';
$title = 'Hewan';
include 'template/header.php';

if (!visible('admin|manager', $data['status'])) {
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
                <div class="col-12 mb-3">
                    <button class="btn btn-success btn-add">Tambah Hewan</button>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center no-footer">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Description</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
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
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete" value="<?= $d['id_hewan'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update" value="<?= $d['id_hewan'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
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
        var controller = 'controllers/ControllerHewan.php'
        $('#formAll').attr('action', controller)

        $('.btn-add').click(function() {
            $('#modalTitle').html('Tambah Hewan')
            $('#action').val('store')
            $('#modalForm').modal('show')
        });


        $('.btn-update').click(function() {
            $('#modalTitle').html('Update Hewan')
            $('#action').val('update')
            var id = $(this).val()
            $.ajax({
                method: "GET",
                url: controller,
                data: {
                    id: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    $('#id').val(id)
                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });
                    $('#modalForm').modal('show')
                }
            })

        })
    })
</script>
<?php include 'template/footer.php' ?>