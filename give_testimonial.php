<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'testimonial';
require_once './header.php';

if (isset($_GET['status'])) {
    if ($_GET['status'] == 0) {
        echo '<script>',
        'window.history.pushState("","","./give_testimonial.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/bye_5.gif",
				imageHeight: 150,
                title: "Captcha Gagal! Silakan Coba Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 1) {
        echo '<script>',
        'window.history.pushState("","","./give_testimonial.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/server_error.gif",
				imageHeight: 150,
                title: "Terjadi Error di Server!<br>Silakan Coba Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 2) {
        echo '<script>',
        'window.history.pushState("","","./give_testimonial.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/bye_1.gif",
				imageHeight: 150,
                title: "Sukses Memberikan Testimoni!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 3) {
        echo '<script>',
        'window.history.pushState("","","./give_testimonial.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_3.gif",
				imageHeight: 150,
                title: "Testimoni Minimal 10 Karakter!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 4) {
        echo '<script>',
        'window.history.pushState("","","./give_testimonial.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_3.gif",
				imageHeight: 150,
                title: "Testimoni Maksimal 1000 Karakter!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    }
}
?>

<style>
    body{background-color:#7c6ed1;height:100vh;width:100vw;overflow:hidden}.wrapper{height:calc(100vh - 80px);width:100vw}.container-menu{height:100%;position:relative;display:grid;place-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;overflow-y:scroll;padding:0!important;margin-bottom:0!important;overflow-y:hidden;overflow-x:hidden!important}.menu{display:grid;place-items:center;grid-template-rows:50px auto;height:95%;position:relative;padding:35px;overflow:hidden}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}.bar{width:100%;height:100%;background-color:#d67c57;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#fdcd5f;left:0;height:100%;display:grid;place-items:center;width:50px;color:#3c6cb4;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red;color:#fff}.content-container{color:#3c6cb4;padding:50px;z-index:3}.assessment-text{letter-spacing:5px;color:#fff;margin-bottom:0;grid-column:2}.bg-assessment{top:0;z-index:1;position:relative;object-fit:cover}.bg-container{top:0;left:0;width:100%;position:absolute}label{color:#3c6cb4;font-weight:700}input,select,textarea{background:#d67c55!important;border:none!important;border-radius:10px!important;color:#fff!important}#testimoni{background:#ead8c0!important}.container-menu::-webkit-scrollbar{width:15px}.container-menu::-webkit-scrollbar-track{background:#f9ead5}.container-menu::-webkit-scrollbar-thumb{background:#3c6cb4;border-right:8px #f9ead5 solid;border-top:10px #f9ead5 solid;border-bottom:10px #f9ead5 solid;background-clip:padding-box}@media screen and (max-width:992px){.assessment-text{font-size:20pt}}.bg-mobile{display:none}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.menu{padding:20px}.content-container{padding:30px 15px;}}@media screen and (max-width:767px){.bg-mobile{display:block}}.performance-title{font-weight:700}.performance-nilai{text-align:center;font-weight:700}@media screen and (max-width:380px){.performance-title{font-size:16pt}.performance-nilai{font-size:14pt}#testimoni{width:97%}.nama{font-size:16pt}#divisi,#jabatan{font-size:14pt}}hr{width:90%;border:1px solid #7c6ed1}.choose-container{display:grid;place-items:center}.menu .container-menu{background-color:#f9ead5}.jconfirm-box-container .jconfirm-box{background-image:url(assets/background/details.png);background-size:cover;box-shadow:none!important}.saya-mengerti{border-radius:40px!important;background-color:#dc3545!important;color:#fff!important;transition:.3s!important}.saya-mengerti:hover{transition:.3s;color:#fdcd5f}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;-webkit-appearance:none;font-weight:700}.btn:hover{transition:.3s;background:#7c6ed1!important;color:#fff!important;}#submit-button{width:200px;background-color:#fdcd5f!important;color:#000!important;border-radius:25px!important}#submit-button:hover{background-color:#7c6ed1!important;color:#fff!important}.jconfirm-content{max-height:50vh;padding:15px;}.jconfirm.jconfirm-modern .jconfirm-box div.jconfirm-title-c{padding-bottom:0!important;}.jconfirm-content::-webkit-scrollbar{width:8px;border-radius:10px}.jconfirm-content::-webkit-scrollbar-track{background:#c55d50}.jconfirm-content::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}
</style>

<body>
    <div class="wrapper">
        <div class="menu" data-aos="zoom-in">
            <div class="bar">
                <a href="choose_assessment.php" style="height: 100%; text-decoration: none;">
                    <div class="close-menu">
                        <i class="fas fa-times"></i>
                    </div>
                </a>
                <div>
                    <h3 class="assessment-text">Testimonial</h3>
                </div>
            </div>
            <div class="container-menu justify-content-center">
                <div class="bg-container">
                    <img class="bg-assessment" src="./assets/background/testimonial.png" alt="Background - Assessment" style="width: 100%;">
                    <div class="bg-mobile">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                    </div>
                </div>
                <div class="content-container justify-content-center">
                    <?php
                    if (!isCommittee($_SESSION['nrp'])) {
                    ?>
                        <div class="row justify-content-center mx-2">
                            <h3 style="font-weight: bold; color: red; text-align: center;">Anda Belum Pernah Mengikuti Acara Kepanitiaan!</h3>
                        </div>
                        <div class="row justify-content-center mt-3 mx-2">
                            <h5 style="text-align: center;        -webkit-text-stroke: 0.1px black;">Acara kepanitiaan yang Anda ikuti harus <u><b>sudah selesai</b></u> dan harus sudah ditambahkan ke database oleh Departemen HRD BEM UK Petra untuk bisa melakukan atau mendapatkan penilaian. Silakan menghubungi Departemen HRD BEM UK Petra di halaman <a href="contactus.php" style="font-weight: bold; text-decoration: none; color: #3B6CB4;">Problems</a> untuk informasi lebih lanjut.</h5>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="choose-container row justify-content-center mt-3" style="margin-right: 0px !important;">

                            <div class="list-acara col-12" style="margin-left: 20px!important;">
                                <label for="acara">Berikan Testimoni di Acara</label>
                                <select class="form-control" id="acara" name="acara" style="height:40px; font-size: 12pt; width: 100%;" onchange="toggleMahasiswa()">
                                    <option value="">Pilih acara kepanitiaan Anda...</option>
                                    <?php getAvailableEvent($_SESSION['nrp']) ?>
                                </select>
                            </div>

                            <div id="list-mhs" class="col-12" style="margin-left: 20px!important;" hidden>
                                <label class="mt-3" for="mahasiswa">Berikan Testimoni Untuk</label>
                                <select class="form-control" id="mahasiswa" name="mahasiswa" style="height:40px; font-size: 12pt; width: 100%;" onchange="toggleAssessment()" disabled>
                                    <option value="">Pilih mahasiswa/i...</option>
                                </select>
                            </div>

                            <p style="text-align: center; font-weight: bold; color: green;" class="mt-3 mx-3" id="done-acara" hidden>Terima kasih!<br>Anda telah selesai memberikan semua testimoni yang dapat diberikan <u>tanpa penilaian</u> di acara kepanitiaan ini. Silakan berikan testimoni di acara kepanitiaan lain yang mungkin tersedia.</p>
                        </div>

                        <div class="row justify-content-center mt-4">
                            <center>
                                <a type='button' href='assessment_history.php' class='btn btn-warning' style='width: 200px;'>
                                    Assessment History
                                </a>
                            </center>
                        </div>

                        <div class="assessment-container" style="padding-top: 20px;" hidden>

                            <br>
                            <center>
                                <hr>
                            </center>
                            <br>

                            <div class="justify-content-center mx-2" style="display: grid; place-items: center;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="mhs-desc">
                                    <h3 class="nama" style="text-align: center; font-weight: bold;"></h3>
                                    <h5 id="jabatan" style="text-align: center;"></h5>
                                    <h5 id="divisi" style="text-align: center;"></h5>
                                    <h5 id="acara-mhs" style="text-align: center;"></h5>
                                </div>
                            </div>

                            <br>
                            <center>
                                <hr>
                            </center>
                            <br>
                            <br>

                            <div class="row justify-content-center">
                                <h3 class="performance-title">Testimoni</h3>
                            </div>
                            <form action="phps/submit_testimonial.php" method="post" enctype="multipart/form-data" id="form_testimoni">
                                <center><a onclick="etikaTestimoni()" class="btn btn-danger mt-1" style="background: #DC3545; width: 250px; color: white">Etika Memberikan Testimoni</a></center>
                                <textarea type="text" class="form-control mt-3" id="testimoni" name="testimoni" style="font-size: 12pt; text-align: center; color: #3C6CB4 !important;" rows="3" placeholder="Silakan berikan kesan dan pesan Anda di kolom ini (maksimal 1000 karakter)" minlength="10" maxlength="1000" required></textarea>

                                <input type="text" id="id_panitia" name="id_panitia" class="hidden-id" value="" hidden>

                                <center>
                                    <input class="g-recaptcha submit btn btn-warning mt-3 mb-5" data-sitekey="6LdukNYaAAAAAJwNQk4_DFZxIqKcQHCLIvxcMD86" data-callback='onSubmit' data-action='testimonial' value="Submit Testimonial" type='submit' id="submit-button">
                                </center>
                            </form>

                            <div class="row mx-2 mb-3 justify-content-center">
                                <a href="./suggestions.php" target="_blank" style="text-align: center; text-decoration: none; color: #3C6CB4;">Punya kritik atau saran untuk REACH? 😊</a>
                            </div>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="footer-container">
            <img src="./assets/svg/footer.svg" alt="Footer" class="footer-svg">
        </div>
    </div>

    <script>
        function toggleMahasiswa(){if(""==$("#acara").val())$("#mahasiswa").prop("disabled",!0),$("#mahasiswa").html('<option value="">Pilih mahasiswa/i...</option>'),$(".assessment-container").prop("hidden",!0),$("#done-acara").prop("hidden",!0),$("#list-mhs").prop("hidden",!0);else{$("#list-mhs").removeAttr("hidden"),$("#mahasiswa").removeAttr("disabled"),$("#mahasiswa").prop("required",!0),$("#mahasiswa").html('<option value="">Harap tunggu...</option>');var a=$("#acara").val();$.ajax({url:"phps/get_list_mahasiswa.php",data:{acara:a,id:1},method:"POST",success:function(a){$("#mahasiswa").html('<option value="">Pilih mahasiswa/i...</option>'+a),0==a.length?($("#list-mhs").prop("hidden",!0),$("#done-acara").removeAttr("hidden"),$(".assessment-container").prop("hidden",!0)):($("#done-acara").prop("hidden",!0),$("#list-mhs").removeAttr("hidden"))}})}}function toggleAssessment(){if($(".container-menu").css({"overflow-y":"scroll"}),$(".spinner-border").prop("hidden",!1),$(".mhs-desc").prop("hidden",!0),""==$("#mahasiswa").val())$(".assessment-container").prop("hidden",!0);else{$(".hidden-id").attr("value",$("#mahasiswa").val()),$(".assessment-container").removeAttr("hidden");var a=$("#mahasiswa").val();$.ajax({url:"phps/get_mahasiswa.php",data:{id_mhs:a},method:"POST",success:function(a){$(".spinner-border").prop("hidden",!0),$(".mhs-desc").prop("hidden",!1);var n=$.parseJSON(a);$(".nama").html(n.nama),$("#jabatan").html(n.jabatan),$("#divisi").html(n.divisi),$("#acara-mhs").html(n.acara)}})}}function etikaTestimoni(){$.confirm({title:'<span style="color:#3C6CB4;">Etika Memberikan Testimoni</span>',typeAnimated:!0,theme:"modern",draggable:!1,columnClass:"col-md-6",buttons:{cancel:{text:"Saya Mengerti",btnClass:"saya-mengerti"}},content:'\n                <div style="color: #3C6CB4; font-size: 14pt;">\n                    <p style="text-align: center;">Berikan <b>kesan, pesan, apresiasi, maupun kritik </b>yang <b>positif</b> serta <b>membangun</b> selama mengikuti acara kepanitiaan bersama di UK Petra yang dapat mendukung proses pemilihan panitia di masa depan.<br>Testimoni yang Anda berikan pada halaman ini akan bersifat <b>anonim</b> bagi Mahasiswa/i yang diberikan testimoni.<br><br>\n                    <span style="color: red; font-weight: bold;">Dilarang mengandung unsur pornografi, fitnah, pencemaran nama baik, dan pelanggaran SARA! NRP dan nama Anda akan tercantum di database BEM UK Petra.</span>\n                </p>\n                </div>\n            '})}function onSubmit(a){document.getElementById("form_testimoni").reportValidity()&&($(".submit").attr("value","Submitting..."),document.getElementById("form_testimoni").submit())}
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
		AOS.init();
        $(".container-menu").on('scroll', function() {
			AOS.refresh();
        });
	</script>
</body>

</html>