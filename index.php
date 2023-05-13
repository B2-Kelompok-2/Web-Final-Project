<?php
session_start();
include 'database/database.php';
include 'config/flasher.php';

function hewan()
{
    return mysqli_query($GLOBALS['db'], "SELECT * FROM hewan");
}

function antrian()
{
    $tgl = date("Y-m-d");
    // return mysqli_query($GLOBALS['db'], "SELECT * FROM antrian INNER JOIN mobil ON antrian.no_plat = mobil.no_plat WHERE tanggal = '$tgl'");
}

// $noa = mysqli_num_rows(antrian());
// $merk = mysqli_query($db, "SELECT * FROM merk_mobil");
// $tipe = mysqli_query($db, "SELECT * FROM tipe_mobil");
$hewan = hewan();
$pkt = hewan();
$pktc = hewan();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrotechfarm</title>
    <link rel="icon" href="resources/img/cow.png">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="resources/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="resources/modules/prism/prism.css">
    <link rel="stylesheet" href="resources/modules/datatables/css/datatables.min.css">
    <link rel="stylesheet" href="resources/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="resources/modules/select2/dist/css/select2.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/components.css">

    <!-- my fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <!--style manual-->
</head>

<body id="grad1" style="background-color: white;">
    <div id="app">
        <section class="jumbotron">
            <div class="container">
                <h1 class="display-1" style="color: black; font-family: sans-serif;" align="center">
                    <img src="resources/img/barn.gif" alt="" width="200">
                    <br> Hewan Ternak Terbaik <br>
                    di <strong>Agrotechfarm</strong>
                </h1>
                <br>
                <div align="center">
                    <button type="button" id="register" class="btn btn-primary text-light">Daftar Sekarang!</button>
                </div>
                <br>
                <div align="center">
                    <button type="button" id="crant" class="btn btn-primary text-light" href="admin/index.php"><a href="admin/index.php" style="color: white; text-decoration: none;">Masuk untuk memesan</a></button>
                </div>
                <br><br>

                <h3 class="display-3" style="color: black; font-size: 24px; font-family: sans-serif;" align="center">Beli hewan ternak disini <br> Cepat selesai dan banyak lagi</h3>
                <!-- card -->
                <div align="center">
                    <div class="row mt-5">
                        <div class="col-lg" data-aos="zoom-in">
                            <div style="font-size: 20px; color: black;" class="text-dark login-brand">About Us</div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg" data-aos="zoom-in">
                            <div class="card-title" style="color: black;">Perfectly Livestock</div>
                            <div>
                                <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/gazjnoea.json" trigger="hover" colors="primary:#6777ef,secondary:#eee966" style="width:100px;height:100px">
                                </lord-icon>
                            </div>
                            <div style="color: black;">E-Farm will assure you to have a <br> perfectly animal</div>
                            <div>
                            </div>
                        </div>
                        <div class="col-lg" data-aos="zoom-in">
                            <div class="card-title" style="color: black;">Save your money!</div>
                            <div>
                                <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/yeallgsa.json" trigger="hover" colors="primary:#6777ef,secondary:#eee966" style="width:100px;height:100px">
                                </lord-icon>
                            </div>
                            <div style="color: black;">E-Farm provide a cheap Animal</div>
                            <div>
                            </div>
                        </div>
                        <div class="col-lg" data-aos="zoom-in">
                            <div class="card-title" style="color: black;">Look at the progress</div>
                            <div>
                                <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/tvyxmjyo.json" trigger="hover" colors="primary:#6777ef,secondary:#eee966" style="width:100px;height:100px">
                                </lord-icon>
                            </div>
                            <div style="color: black;">You can look what is happening to your <br>, mood</div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <!-- end about us -->
                    <div class="row mt-5">
                        <div class="col-lg" data-aos="zoom-in">
                            <div style="font-size: 20px; color: black;" class="text-dark mb-4 login-brand">Tersedia</div>
                        </div>
                    </div>
                    <!-- <div class='row mt-4 d-flex justify-content-center'>
                            <div class="col-4" data-aos="zoom-in"> -->
                    <div class="container-hewan">
                        <div class="hewan-sapi">
                            <img src="resources/img/cow.gif" alt="" width="100">
                        </div>
                        <div class="hewan-kambing">
                            <img src="resources/img/goat.gif" alt="" width="100">
                        </div>
                        <div class="hewan-ayam">
                            <img src="resources/img/hen.gif" alt="" width="100">
                        </div>
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->
                    <div class="col-lg" data-aos="zoom-in">
                    </div>
                    <!-- Contact us -->
                    <div class="row mt-5">
                        <div class="col-lg" data-aos="zoom-in">
                            <div style="font-size: 20px; color: black;" class="text-dark mb-4 login-brand">Kontak Kami</div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg" data-aos="zoom-in">
                            <a name="" id="" class="btn btn-info" href="contact.php" role="button">Klik disini!</a>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="fixed-bottom b-example-divider"></div>
                    <div class="container">
                        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                            <div class="col-md-4 d-flex align-items-center">
                                <span class="text-muted">&copy; 2023 E-Farm</span>
                            </div>
                        </footer>
                    </div>
                </div>
        </section>
    </div>
    <div class="modal modal-xl" id="registrasi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="exampleModalToggleLabel">Daftar</h1>
                </div>
                <form method="POST" action="admin/controllers/ControllerRegister.php">
                    <div class="modal-body modal-dialog-scrollable m-0">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" maxlength="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" maxlength="20" required>
                        </div>
                        <div id="pws" class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" maxlength="20" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-8">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea type="text" class="form-control" name="alamat" id="alamat" maxlength="80" required></textarea>
                            </div>
                            <div class="col">
                                <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jk" id="p" value="P" required>
                                    <label class="form-check-label" for="p">
                                        Perempuan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jk" id="l" value="L">
                                    <label class="form-check-label" for="l">
                                        Laki-Laki
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="no" class="form-label">Nomor HP</label>
                            <input type="number" class="form-control" name="no" id="no" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" required>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <a class="btn btn-info px-4" href="contact.php" role="button">Contact</a>
                        <span>
                            <button id="submit" type="submit" class="btn btn-success mx-2">Submit</button>
                            <button type="button" class="btn btn-danger btn-cancel" data-dismiss="modal">Cancel</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End Footer -->

    <!-- General JS Scripts -->
    <script src="resources/modules/jquery.min.js"></script>
    <script src="resources/modules/popper.js"></script>
    <script src="resources/modules/tooltip.js"></script>
    <script src="resources/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="resources/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="resources/modules/moment.min.js"></script>
    <script src="resources/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="resources/modules/prism/prism.js"></script>
    <script src="resources/modules/datatables/datatables.min.js"></script>
    <script src="resources/modules/izitoast/js/iziToast.min.js"></script>
    <script src="resources/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="resources/modules/chart.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="resources/js/page/bootstrap-modal.js"></script>
    <script src="resources/js/page/modules-toastr.js"></script>
    <script src="resources/js/page/modules-chartjs.js"></script>

    <!-- Template JS File -->
    <script src="resources/js/scripts.js"></script>
    <script src="resources/js/custom.js"></script>

    <script>
        $(document).ready(function() {
            <?php Flash() ?>

            $('#register').click(function (e) { 
                $('#registrasi').modal('show')
                
            });
        })
    </script>
</body>

</html>