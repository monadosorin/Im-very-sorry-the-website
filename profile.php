<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'profile';
require_once './header.php';

$nama = getStudentNameFinger($_SESSION['nrp']);

if (isset($_GET['status'])) {
    if ($_GET['status'] == 4) {
        echo '<script>',
        'window.history.pushState("","","./profile.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/bye_5.gif",
				imageHeight: 150,
                title: "Captcha Gagal! Silakan Coba Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 5) {
        echo '<script>',
        'window.history.pushState("","","./profile.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_2.gif",
				imageHeight: 150,
                title: "Mohon Maaf, Ukuran File Image Maksimal 5 MB!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 6) {
        echo '<script>',
        'window.history.pushState("","","./profile.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/server_error.gif",
				imageHeight: 150,
                title: "Terjadi Error di Server!<br>Silakan Coba Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 7) {
        echo '<script>',
        'window.history.pushState("","","./profile.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_2.gif",
				imageHeight: 150,
                title: "Mohon Maaf, Silakan Upload Hanya File Image (.jpg, .jpeg, Atau .png)!",
                showConfirmButton: false,
                timer: 3000
                })',
        '</script>';
    } else if ($_GET['status'] == 8) {
        echo '<script>',
        'window.history.pushState("","","./profile.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_1.gif",
				imageHeight: 150,
                title: "Kok Gitu, Sih?",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    }
}
?>

<style>
    body{background-color:#7c6ed1;height:100vh;width:100vw;overflow:hidden}.wrapper{height:calc(100vh - 80px);width:100vw;}.container-menu{overflow-x:hidden;height:100%;position:relative;display:grid;place-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;overflow-y:scroll;padding:0!important;margin-bottom:0!important}.menu .container-menu{background-color:#c55d50}.menu{display:grid;place-items:center;grid-template-rows:50px auto;height:95%;position:relative;padding:35px;overflow-x:hidden}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}.bar{width:100%;height:100%;background-color:#d67c57;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#fdcd5f;left:0;height:100%;display:grid;place-items:center;width:50px;color:#3c6cb4;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red;color:#fff}.content-container{color:#3c6cb4;z-index:2}.cv-text{letter-spacing:5px;color:#fdcd5f;margin-bottom:0;grid-column:2}.bg-profile{top:0;z-index:1;position:relative;object-fit:cover}label{color:#fff}input,select,textarea{border:none!important;border-radius:10px!important;color:#fff!important}::placeholder{color:#fdcd5f!important;opacity:1}:-ms-input-placeholder{color:#fdcd5f!important}::-ms-input-placeholder{color:#fdcd5f!important}#search_mhs::placeholder{color:#3c6cb4!important;opacity:1}#search_mhs:-ms-input-placeholder{color:#3c6cb4!important}#search_mhs::-ms-input-placeholder{color:#3c6cb4!important}.container-menu::-webkit-scrollbar{width:15px}.container-menu::-webkit-scrollbar-track{background:#c55d50}.container-menu::-webkit-scrollbar-thumb{background:#fdcd5f;border-right:8px #c55d50 solid;border-top:10px #c55d50 solid;border-bottom:10px #c55d50 solid;background-clip:padding-box}.bg-mobile{display:none}.display-photo{width:40%;height:calc(100vh - calc(100vh - 100%))}@media screen and (max-width:767px){.bg-mobile{display:block}.display-photo{width:80%}}@media screen and (max-width:992px){.cv-text{font-size:14pt}}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media only screen and (min-width:768px) and (orientation:portrait){@supports (-webkit-touch-callout:none){.wrapper{height:94%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.menu{padding:20px}}.bg-container{top:0;left:0;width:100%;position:absolute}.jconfirm-box-container .jconfirm-box{background-image:url(assets/background/details.png);background-size:cover;box-shadow:none!important}input::-webkit-inner-spin-button,input::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}input[type=number]{-moz-appearance:textfield}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;font-weight:700;-webkit-appearance:none}.btn:hover{transition:.3s;background:#3660a2;color:#fff}.btn-red{border-radius:25px!important}.display-photo{border:5px dashed #f9cd5f}::-webkit-calendar-picker-indicator{background-image:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 24 24"><path fill="white" d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z"/></svg>')}#submit-button{color:#000!important;border-radius:25px!important}#submit-button:hover{color:#fff!important}.menu{overflow:hidden}.jconfirm-content{max-height:50vh;padding:15px;}.jconfirm.jconfirm-modern .jconfirm-box div.jconfirm-title-c{padding-bottom:0!important;}.jconfirm-content::-webkit-scrollbar{width:8px;border-radius:10px}.jconfirm-content::-webkit-scrollbar-track{background:#c55d50}.jconfirm-content::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}
</style>

<body>
    <div class="wrapper">
        <div class="menu" data-aos="zoom-in">
            <div class="bar">
                <a href="home.php" style="height: 100%; text-decoration: none;">
                    <div class="close-menu">
                        <i class="fas fa-times"></i>
                    </div>
                </a>

                <div>
                    <h3 class="cv-text">Curriculum Vitae</h3>
                </div>
            </div>
            <div class="container-menu">
                <div class="bg-container">
                    <img class="bg-profile" src="./assets/background/cv.png" alt="Background - Profile" style="width: 100%;">
                    <div class="bg-mobile">
                        <img class="bg-profile" src="./assets/background/cv.png" alt="Background - Profile" style="width: 100%;">
                        <img class="bg-profile" src="./assets/background/cv.png" alt="Background - Profile" style="width: 100%;">
                    </div>
                </div>

                <div class="content-container mt-3">
                    <form action="phps/updatecv.php" method="post" enctype="multipart/form-data" id="update_cv">
                        <div class="col-sm-12 col-md-8 offset-md-2">
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="nrp" style="font-weight: bold;">NRP</label></center>
                                        <!-- DON'T PLAY-PLAY WITH THIS ONE, TRUST ME ;) -->
                                        <input type="text" class="form-control" id="nrp" name="nrp" style="height:40px; font-size: 12pt; text-align: center; background: #b5562d !important;" value="<?= strtoupper($rowMahasiswa['nrp']) ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="angkatan" style="font-weight: bold;">Angkatan</label></center>
                                        <input type="text" class="form-control" id="angkatan" name="angkatan" style="height:40px; font-size: 12pt; text-align: center;background: #b5562d !important;" value="<?= $angkatan ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="nama" style="font-weight: bold;">Nama Lengkap</label></center>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" style="height:40px; font-size: 12pt; text-align: center;background: #d67c55;" value='<?php if ($rowMahasiswa['nama'] == '') {
                                                                                                                                                                                                                                        echo $nama;
                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                        echo sanitizeString($rowMahasiswa['nama']);
                                                                                                                                                                                                                                    } ?>' minlength="3" maxlength="40" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="jurusan" style="font-weight: bold;">Fakultas dan Jurusan</label></center>
                                        <select class="form-control" id="jurusan" name="jurusan" style="height:40px; font-size: 12pt;background: #d67c55 !important;" required>
                                            <option value="">Pilih fakultas dan jurusan Anda...</option>
                                            <?php
                                            $sqlMahasiswa = "SELECT * FROM jurusanpcu WHERE id_jurusan = ?";
                                            $stmtMahasiswa = $pdo->prepare($sqlMahasiswa);
                                            $stmtMahasiswa->execute([$id_jurusan]);
                                            while ($rowMahasiswaNew = $stmtMahasiswa->fetch()) { ?>
                                                <option value="<?php echo $rowMahasiswaNew['fakultas'] . " - " .  $rowMahasiswaNew['jurusan']; ?>"><?php echo $rowMahasiswaNew['fakultas'] . " - " . $rowMahasiswaNew['jurusan']; ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="tempat_lahir" style="font-weight: bold;">Tempat Lahir</label></center>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Ex: Surabaya" style="height:40px; font-size: 12pt; text-align: center;background: #d67c55 !important;" maxlength="81" required <?php if ($rowMahasiswa['tempat_lahir'] != '') {
                                                                                                                                                                                                                                                                        echo "value='" .
                                                                                                                                                                                                                                                                        sanitizeString($rowMahasiswa['tempat_lahir']) . "'";
                                                                                                                                                                                                                                                                    } ?>>
                                        <!-- Taumatawhakatangihangakoauauotamateaturipukakapikimaungahoronukupokaiwhenuakitanatahu (81 karakter) sudah diakui sebagai tempat dengan nama terpanjang di dunia oleh Guinness World Records. -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="tanggal_lahir" style="font-weight: bold;">Tanggal Lahir</label></center>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" style="height:40px; font-size: 12pt;background: #d67c55 !important;" required <?php if ($rowMahasiswa['tanggal_lahir'] != '') {
                                                                                                                                                                                                            echo "value='" . sanitizeString($rowMahasiswa['tanggal_lahir']) . "'";
                                                                                                                                                                                                        } ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center><label for="alamat" style="font-weight: bold;">Alamat</label></center>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" style="font-size: 12pt;  text-align: center;background: #d67c55 !important;" rows="2" placeholder="Masukkan alamat lengkap Anda" maxlength="200" required><?php if ($rowMahasiswa['alamat'] != '') {
                                                                                                                                                                                                                                                                            echo sanitizeString($rowMahasiswa['alamat']);
                                                                                                                                                                                                                                                                        } ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="nomor_hp" style="font-weight: bold;">Nomor HP</label></center>
                                        <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Ex: 08123456789" style="height:40px; font-size: 12pt; text-align: center;background: #d67c55 !important;" minlength="6" maxlength="20" required <?php if ($rowMahasiswa['nomor_hp'] != '') {
                                                                                                                                                                                                                                                                                echo "value='" . sanitizeString($rowMahasiswa['nomor_hp']) . "'";
                                                                                                                                                                                                                                                                            } ?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="id_line" style="font-weight: bold;">ID LINE</label></center>
                                        <input type="text" class="form-control" id="id_line" name="id_line" style="height:40px; font-size: 12pt; text-align: center; background: #d67c55 !important;" placeholder="Ex: bempetra" minlength="4" maxlength="40" required <?php if ($rowMahasiswa['id_line'] != '') {
                                                                                                                                                                                                                                                                            echo "value='" . sanitizeString($rowMahasiswa['id_line']) . "'";
                                                                                                                                                                                                                                                                        } ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center><label for="instagram" style="font-weight: bold;">Instagram<br>(tanpa @)</label></center>
                                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Ex: bempetra" style="height:40px; font-size: 12pt; text-align: center;background: #d67c55 !important;" maxlength="30" required <?php if ($rowMahasiswa['instagram'] != '') {
                                                                                                                                                                                                                                                                echo "value='" . sanitizeString($rowMahasiswa['instagram']) . "'";
                                                                                                                                                                                                                                                            } ?>>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <center><label for="ipk" style="font-weight: bold;">IPK Terakhir</label></center>
                                            <input type="number" class="form-control" min="0" max="4" id="ipk" name="ipk" step="0.01" placeholder="Ex: 3.99" style="height:40px; font-size: 12pt; text-align: center;background: #d67c55 !important;" required <?php if ($rowMahasiswa['ipk'] != '') {
                                                                                                                                                                                                                                                                    echo "value='" . sanitizeString($rowMahasiswa['ipk']) . "'";
                                                                                                                                                                                                                                                                } ?>>
                                        </div>
                                    </div> -->
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center><label for="kelebihan" style="font-weight: bold;">Kelebihan</label></center>
                                        <textarea type="text" class="form-control" id="kelebihan" name="kelebihan" style="font-size: 12pt;  text-align: center;background: #d67c55 !important;" rows="2" placeholder="Apa saja kelebihan yang kamu miliki?" maxlength="400" required><?php if ($rowMahasiswa['kelebihan'] != '') {
                                                                                                                                                                                                                                                                                            echo sanitizeString($rowMahasiswa['kelebihan']);
                                                                                                                                                                                                                                                                                        } ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center><label for="kekurangan" style="font-weight: bold;">Kekurangan</label></center>
                                        <textarea type="text" class="form-control" id="kekurangan" name="kekurangan" style="font-size: 12pt;  text-align: center;background: #d67c55 !important;" rows="2" placeholder="Karena kesempurnaan hanya milik Tuhan semata" maxlength="400" required><?php if ($rowMahasiswa['kekurangan'] != '') {
                                                                                                                                                                                                                                                                                                    echo sanitizeString($rowMahasiswa['kekurangan']);
                                                                                                                                                                                                                                                                                                } ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center><a onclick="quickTips()" class="btn btn-success mb-2" style='width: 200px;'>Quick Tips for You!</a></center>
                                        <center><label for="pengalaman" style="font-weight: bold;">Pengalaman Organisasi dan Kepanitiaan<br>(maksimal 1000 karakter)</label></center>
                                        <textarea type="text" class="form-control" id="pengalaman" name="pengalaman" style="font-size: 12pt;  text-align: center;background: #d67c55 !important;" rows="5" placeholder="Ex: Acara WGG 2020, Sekretaris Petra Chess Competition 2021, IT LKMM-TD 2022, dsb." maxlength="1000" required><?php if ($rowMahasiswa['pengalaman'] != '') {
                                                                                                                                                                                                                                                                                                                                            echo sanitizeString($rowMahasiswa['pengalaman']);
                                                                                                                                                                                                                                                                                                                                        } ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center><a onclick="websitePortfolio()" class="btn btn-success mb-2" style='width: 200px;'>What Is This?</a></center>
                                        <center><label for="portfolio" style="font-weight: bold;">Website atau URL Portfolio<br>(OPSIONAL)</label></center>
                                        <input type="url" class="form-control" id="portfolio" name="portfolio" style="font-size: 12pt;  text-align: center;background: #d67c55 !important;" placeholder="Portfolio PDD / Website Portfolio / LinkedIn / dll." maxlength="1000" <?php if ($rowMahasiswa['instagram'] != '') {
                                                                                                                                                                                                                                                                echo "value='" . sanitizeString($rowMahasiswa['portfolio']) . "'";
                                                                                                                                                                                                                                                            } ?>>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if ($rowMahasiswa['photo_filepath'] == '') {
                            ?>
                                <div class="row">
                                    <div class="col-12 col-md-10 offset-md-1 my-3">
                                        <div class="form-group" align="center">
                                            <label for="photo" style="font-weight: bold;">Upload Foto Formal/Informal Anda (Potrait)<br><span style="color: #FDCD5F;">(MAX 5 MB OF .jpg, .jpeg, OR .png)</span></label>
                                            <input type="file" class="form-control-file fileUploadContainer" id="photo" name="photo" accept="image/*" style="width: 250px;" onchange="displayImage(this)" required>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="row justify-content-center mt-3 mb-2">
                                    <h5 style="font-weight: bold; color: white;">Your Current Photo</h5>
                                </div>
                                <div class="row justify-content-center" data-aos="zoom-in">
                                    <img src='uploads/cv_photo/<?= sanitizeString($rowMahasiswa['photo_filepath']) ?>' alt="<?= strtoupper($rowMahasiswa['nrp']); ?>" class="display-photo">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-md-10 offset-md-1 my-3">
                                        <div class="form-group" align="center">
                                            <label for="photo" style="font-weight: bold;">Update Foto (Potrait) Anda<br>(OPSIONAL)<br><span style="color: #FDCD5F;">(MAX 5 MB OF .jpg, .jpeg, OR .png)</span></label>
                                            <input type="file" class="form-control-file fileUploadContainer" id="photo" name="photo" accept="image/*" style="width: 250px;" onchange="displayImage(this);">
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="image-display-container row justify-content-center" data-aos="zoom-in">
                                <img class="display-photo mb-4" id="element-display-photo" src="#" alt="Selected Image" hidden />
                            </div>

                            <div class="row justify-content-center mx-3 mb-3">
                                <p style="font-size: 12pt; font-weight: bold; text-align: center; color: white;">Saya menyatakan bahwa semua data yang saya isi di atas adalah jujur dan benar adanya, tanpa rekayasa apapun serta tanpa paksaan dari pihak manapun. Apabila di kemudian hari ditemukan ketidaksesuaian, saya bersedia bertanggung jawab.</p>
                            </div>

                            <div class="btn-container" hidden>
                                <center>
                                    <input class="g-recaptcha submit btn btn-warning mb-5" data-sitekey="6LdukNYaAAAAAJwNQk4_DFZxIqKcQHCLIvxcMD86" data-callback='onSubmit' data-action='cv' value="<?php if ($rowMahasiswa['status'] == 0) {
                                                                                                        echo "Setuju dan Simpan Data";
                                                                                                    } else {
                                                                                                        echo "Setuju dan Update Data";
                                                                                                    } ?>" type='submit' id='submit-button'>
                                </center>
                                <div id="uploading" class="mb-5" style="color: #FDCD5F;" hidden>
                                    <center>
                                        <div class="spinner-border text-warning mb-3" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <h3 style="font-size: 12pt; font-weight: bold;" id="uploading">Uploading... Please wait.</h3>
                                        <h3 style="font-size: 12pt; font-weight: bold;" id="uploading">Large file sizes may took some time!</h3>
                                    </center>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-container">
			<img src="./assets/svg/footer.svg" alt="Footer" class="footer-svg">
        </div>
    </div>

    <script>
        function displayImage(a){if(a.files&&a.files[0]){var n=new FileReader;n.onload=function(n){if("image/*"==$(a).attr("accept")){var e=a.files[0].size,t=a.files[0].name.split(".").pop().toLowerCase();"jpg"!=t&&"jpeg"!=t&&"png"!=t?($("#element-display-photo").prop("hidden",!0),$.alert("<span style='color: #c24134; font-weight: bold; text-align: center;'><center>Mohon maaf, silakan upload hanya file image (.jpg, .jpeg, atau .png)!</center></span>"),$(a).val(null)):e>5242880?($("#element-display-photo").prop("hidden",!0),$.alert("<span style='color: #c24134; font-weight: bold; text-align: center;'><center>Mohon maaf, ukuran file maksimal adalah 5 MB! Silakan upload ulang.</center></span>"),$(a).val(null)):0==e?($("#element-display-photo").prop("hidden",!0),$.alert("<span style='color: #c24134; font-weight: bold; text-align: center;'><center>AMPUN BANG JAGO!</center></span>"),$(a).val(null)):$("#element-display-photo").attr("src",n.target.result).removeAttr("hidden")}},n.readAsDataURL(a.files[0])}else $("#element-display-photo").prop("hidden",!0)}function quickTips(){$.confirm({title:'<span style="color: #3C6CB4;">QUICK TIPS <i class="far fa-lightbulb"></i></span>',typeAnimated:!0,theme:"modern",draggable:!1,columnClass:"col-md-8",buttons:{cancel:{text:"CLOSE",btnClass:"btn-red"}},content:'\n                <div style="text-transform: none; color: #3C6CB4; font-size: 14pt;">\n                    Apabila masih <b>belum memiliki</b> pengalaman organisasi dan kepanitiaan sama sekali, coba ceritakan sedikit tentang <b>dirimu</b> dan <b>bidang</b> yang sesuai dengan <b>karakter</b> atau <b>personality</b> yang kamu miliki.\n                    <br>\n                    <br>\n                    Apabila <b>sudah memiliki</b> beberapa pengalaman, deskripsikan <b>dirimu</b> secara singkat dan <b>bidang</b> apa saja yang sudah pernah kamu geluti dan <b>paling cocok dalam dirimu</b>.\n                    <br>\n                    <br>\n                    <b>Contoh:</b>\n                    <br>\n                    <i>"Saya merupakan pribadi dengan karakter yang tegas, disiplin, dan dapat diandalkan. Menurut saya, dengan karakter yang telah saya miliki, saya merasa cocok dan tertarik untuk ditempatkan di divisi Keamanan." \n                    <br>\n                    <br>\n                    "Ketelitian dan kerapian merupakan prinsip utama dalam kehidupan saya. Saya tidak pernah bangun tidur tanpa lupa untuk merapikan tempat tidur. Oleh karena itu, saya merasa cocok dan tertarik untuk ditempatkan di divisi Sekretaris."\n                    <br>\n                    <br>\n                    "Berikut adalah pengalaman saya selama mengikuti kepanitiaan dan organisasi di UK Petra: 1. ..., 2. ..., dst."</i>\n                    <br>\n                    <br>\n                    <b>Good luck and be the next <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ketua Badan Eksekutif Mahasiswa Universitas Kristen Petra 2020/2021">Ricky Ciputra</span>!</b>\n                </div>\n            '})}function onSubmit(a){document.getElementById("update_cv").reportValidity()&&($(".submit").prop("hidden",!0),$("#uploading").removeAttr("hidden"),document.getElementById("update_cv").submit())}$(".form-control").on("input",function(){$(".btn-container").removeAttr("hidden")}),$(".form-control-file").on("input",function(){$(".btn-container").removeAttr("hidden")});var tooltipTriggerList=[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')),tooltipList=tooltipTriggerList.map(function(a){return new bootstrap.Tooltip(a)});function websitePortfolio(){$.confirm({title:'<span style="color: #3C6CB4;">Website atau URL Portfolio</span>',typeAnimated:!0,theme:"modern",draggable:!1,columnClass:"col-md-8",buttons:{cancel:{text:"CLOSE",btnClass:"btn-red"}},content:'<div style="text-transform: none; color: #3C6CB4; font-size: 14pt;">\n                Cantumkan website portfolio karya atau Curriculum Vitae kamu (apabila ada) seperti <b>Portfolio PDD, Arsitektur, Wix, LinkedIn, GitHub, Website Pribadi, atau lainnya</b> dalam bentuk <b>URL lengkap (http://www.___ atau https://www.___)</b> untuk memperkuat value yang kamu miliki.\n            </div>'})}
        <?php
        if (hasFilledOutCV($_SESSION['nrp'])) {
        ?>
            $('select[name="jurusan"]').val('<?= $rowMahasiswa['jurusan'] ?>');
        <?php
        }
        ?>
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
		AOS.init();
        $(".container-menu").on('scroll', function() {
			AOS.refresh();
        });
        function imStillAlive() {
            $.ajax({
                url: "imstillalive.php",
                type: "GET",
                success: function(data) {
                },
                error: function(xhr, status, error) {
                }
            });
        }
        // Set up an interval to call the function every 20 minutes (20 * 60 * 1000 milliseconds)
        setInterval(imStillAlive, 20 * 60 * 1000);
	</script>
</body>

</html>