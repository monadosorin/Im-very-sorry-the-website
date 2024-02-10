<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'search';
require_once './header.php';
?>

<style>
    body{background-image:url(assets/background/cv.png);color:#fff!important;background-color:#c55d50}::-webkit-scrollbar{width:8px;border-radius:10px}::-webkit-scrollbar-track{background:#c55d50}::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}table{color:#fff!important;background-color:#d67c55}td{vertical-align:middle!important}.dept-logo{width:60px;padding:1px}.sorry{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)}@media screen and (max-width:768px){body{background-image:none}.sorry{position:static;top:0;left:0;transform:none;display:grid;place-items:center;margin-top:5%;padding:0 20px}}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;-webkit-appearance:none;font-weight:700}.btn:hover{transition:.3s;background:#7c6ed1!important;color:#fff!important}
</style>

<body>
    <div class="container">
        <?php
        if ($rowMahasiswa['status'] == 0) {
        ?>
            <div class="sorry justify-content-center">
                <h1 style="text-align: center; letter-spacing: 5px; color: #FDCD5F;font-weight: 500;">MOHON MAAF</h1>
                <h5 style="text-align: center; color: white;" class="mt-3">Silakan mengisi Curriculum Vitae (CV) di halaman <a href="profile.php" style="text-decoration: none; color: #FDCD5F; font-weight: bold;">Profile</a> terlebih dahulu untuk dapat menggunakan fitur ini.</h5>
                <h5 style="text-align: center; color: white;" class="mt-3">Melalui fitur <span style="text-decoration: none; color: #FDCD5F; font-weight: bold;">Search</span>, kamu dapat mencari lebih dari <span style="text-decoration: none; color: #FDCD5F; font-weight: bold;"><?= intval(getPetranesiansHitzCount() / 10) * 10 ?></span> profil Petranesians lain yang telah terhubung di <span style="color: #FDCD5F; font-weight: bold;">R E A C H</span>, lho. Jadi, tunggu apalagi? Yuk, segera isi CV-mu di halaman <a href="profile.php" style="text-decoration: none; color: #FDCD5F; font-weight: bold;">Profile</a> yah, Petranesian! &#128588;</h5>
                <center class="row my-5 justify-content-center">
                    <img class="dept-logo" src="./assets/image/HRD.png" alt="">
                    <img class="dept-logo" src="./assets/image/IS.png" alt="">
                    <img class="dept-logo" src="./assets/image/SNC.png" alt="">
                </center>
            </div>
        <?php
        } else if (!isFoundSearchResults(sanitizeString($_GET['value']))) {
        ?>
            <div class="justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <h1 style="text-align: center; letter-spacing: 5px; color: #FDCD5F;">Hasil Pencarian<br><b>"<?= sanitizeString($_GET['value']) ?>"</b><br>Tidak Ditemukan!</h1>
                <h5 style="text-align: center;" class="mt-3">Silakan pastikan Mahasiswa/i yang ingin dicari telah mengisi Curriculum Vitae (CV) di halaman <a href="profile.php" style="text-decoration: none; color: #FDCD5F; font-weight: bold;">Profile</a></h5>
            </div>
        <?php
        } else {
        ?>
            <div data-aos="fade-up">
                <?php
                if (sanitizeString($_GET['value']) == 1) {
                ?>
                    <div class="title-row row justify-content-center">
                        <h2 class="mx-3" style="color: #FDCD5F; letter-spacing: 5px;text-align:center;font-weight: bold;">Petranesian Hitz 🤘<br><span style="font-size: 12pt;font-weight:500;">(belom hitz kalau belom isi CV ya kan)</span></h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 mt-3">
                            <select class="form-control" id="filter_fakultas" name="filter_fakultas" style="height:40px; font-size: 12pt; background-color:#D67C55;color:white; border-radius:25px!important;border:none;">
                                <option value="">Lihat berdasarkan fakultas...</option>
                                <?php getFacultyList() ?>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 mt-3">
                            <select class="form-control" id="filter_jurusan" name="filter_jurusan" style="height:40px; font-size: 12pt; background-color:#D67C55;color:white; border-radius:25px!important;border:none;">
                                <option value="">Lihat berdasarkan program studi...</option>
                                <?php getMajorList() ?>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 mt-3">
                            <select class="form-control" id="filter_angkatan" name="filter_angkatan" style="height:40px; font-size: 12pt; background-color:#D67C55;color:white; border-radius:25px!important;border:none;">
                                <option value="">Lihat berdasarkan angkatan...</option>
                                <?php getBatchList() ?>
                            </select>
                        </div>
                    </div>
                <?php
                } else {
                    ?>
                    <div class="title-row row">
                        <h2 class="title" style="color: #FDCD5F; letter-spacing: 5px;"><i class="fas fa-search"></i> Search Result(s)</h2>
                    </div>
                    <div class="title-row row">
                        <p style="color: #FDCD5F; letter-spacing: 5px; font-size: 18pt;">"<?= sanitizeString($_GET['value']) ?>"</p>
                    </div>
                    <?php
                }
                ?>

                <div class="row" style="margin-top: 20px; overflow-x: auto;">
                    <div class="col-12">
                        <table class="table table-hovered table-striped" id="mahasiswaTable" style="color: #412c27; width: 100%">
                            <thead style="text-align: center; font-weight: bold;">
                                <tr>
                                    <td style="width: 5%;">#</td>
                                    <td>NRP</td>
                                    <td>Nama</td>
                                    <td>Fakultas</td>
                                    <td>Program Studi</td>
                                    <td>Angkatan</td>
                                    <td>Profile</td>
                                </tr>
                            </thead>
                            <tbody id="mahasiswaTableBody" style="text-align: center;">
                                <?php displaySearchResults(sanitizeString($_GET['value'])) ?>
                            </tbody>
                        </table><br>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            function Search(n){$("#filter_jurusan").on("change",function(){n.columns(4).search(this.value).draw()}),$("#filter_angkatan").on("change",function(){n.columns(5).search(this.value).draw()}),$("#filter_fakultas").on("change",function(){n.columns(3).search(this.value).draw()})}AOS.init(),$(".container-menu").on("scroll",function(){AOS.refresh()}),$(document).ready(function(){Search($("#mahasiswaTable").DataTable())});

            <?php
                if (isset($_GET['value'])) {
                    if ($_GET['value'] != 1) {
                    ?>
                    $('#search_mhs').val('<?= $_GET['value'] ?>');
                    <?php
                    }
                }
            ?>
        </script>
</body>

</html>