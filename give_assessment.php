<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'assessment';
require_once './header.php';
?>

<style>
    body{background-color:#7c6ed1;height:100vh;width:100vw;overflow:hidden}.wrapper{height:calc(100vh - 80px);width:100vw}.container-menu{height:100%;position:relative;display:grid;place-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;padding:0!important;margin-bottom:0!important;overflow-y:hidden;overflow-x:hidden!important}.menu{display:grid;place-items:center;grid-template-rows:50px auto;height:95%;position:relative;padding:35px;overflow:hidden}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}.bar{width:100%;height:100%;background-color:#d67c57;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#fdcd5f;left:0;height:100%;display:grid;place-items:center;width:50px;color:#3c6cb4;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red;color:#fff}.content-container{color:#3c6cb4;padding:50px;z-index:3}.assessment-text{letter-spacing:5px;color:#fff;margin-bottom:0;grid-column:2}.bg-assessment{top:0;z-index:1;position:relative;object-fit:cover}.bg-container{top:0;left:0;width:100%;position:absolute}label{color:#3c6cb4;font-weight:700}input,select,textarea{background:#d67c55!important;border:none!important;border-radius:10px!important;color:#fff!important}#testimoni{background:#ead8c0!important}.container-menu::-webkit-scrollbar{width:15px}.container-menu::-webkit-scrollbar-track{background:#f9ead5}.container-menu::-webkit-scrollbar-thumb{background:#3c6cb4;border-right:8px #f9ead5 solid;border-top:10px #f9ead5 solid;border-bottom:10px #f9ead5 solid;background-clip:padding-box}@media screen and (max-width:992px){.assessment-text{font-size:20pt}}.bg-mobile{display:none}@media screen and (max-width:767px){.bg-mobile{display:block}}.performance-title{font-weight:700}.performance-nilai{text-align:center;font-weight:700}@media screen and (max-width:380px){.performance-title{font-size:16pt}.performance-nilai{font-size:14pt}#testimoni{width:97%}.nama{font-size:16pt}#divisi,#jabatan{font-size:14pt}}hr{width:90%;border:1px solid #7c6ed1}.choose-container{display:grid;place-items:center}.menu .container-menu{background-color:#f9ead5}.jconfirm-box-container .jconfirm-box{background-image:url(assets/background/details.png);background-size:cover;box-shadow:none!important}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.menu{padding:20px}.content-container{padding:30px 15px}}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;-webkit-appearance:none;font-weight:700}.btn:hover{transition:.3s;background:#7c6ed1!important;color:#fff!important}.saya-mengerti{border-radius:40px!important;background-color:#dc3545!important;color:#fff!important;transition:.3s!important}.saya-mengerti:hover{transition:.3s;color:#fdcd5f}.jconfirm-content{max-height:50vh;padding:15px;}.jconfirm.jconfirm-modern .jconfirm-box div.jconfirm-title-c{padding-bottom:0!important;}.jconfirm-content::-webkit-scrollbar{width:8px;border-radius:10px}.jconfirm-content::-webkit-scrollbar-track{background:#c55d50}.jconfirm-content::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}
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
                    <h3 class="assessment-text">Assessment</h3>
                </div>
            </div>
            <div class="container-menu justify-content-center">
                <div class="bg-container">
                    <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                    <div class="bg-mobile">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
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
                            <h5 style="text-align: center;        -webkit-text-stroke: 0.1px black;">Acara kepanitiaan yang Anda ikuti harus <u><b>sudah selesai</b></u> dan harus sudah ditambahkan ke database oleh <b>Departemen HRD BEM UK Petra</b> untuk bisa melakukan atau mendapatkan penilaian. Silakan menghubungi <b>Departemen HRD BEM UK Petra</b> di halaman <a href="contactus.php" style="font-weight: bold; text-decoration: none; color: #3B6CB4;">Problems</a> untuk informasi lebih lanjut.</h5>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="choose-container row justify-content-center mt-3" style="margin-right: 0px !important;">

                            <div class="list-acara col-12" style="margin-left: 20px!important;">
                                <label for="acara">Berikan Penilaian di Acara</label>
                                <select class="form-control" id="acara" name="acara" style="height:40px; font-size: 12pt; width: 100%;" onchange="toggleMahasiswa()">
                                    <option value="">Pilih acara kepanitiaan Anda...</option>
                                    <?php getAvailableEvent($_SESSION['nrp']) ?>
                                </select>
                            </div>

                            <div id="list-mhs" class="col-12" style="margin-left: 20px!important;" hidden>
                                <label class="mt-3" for="mahasiswa">Berikan Penilaian Untuk</label>
                                <select class="form-control" id="mahasiswa" name="mahasiswa" style="height:40px; font-size: 12pt; width: 100%;" onchange="toggleAssessment()" disabled>
                                    <option value="">Pilih mahasiswa/i...</option>
                                </select>
                            </div>

                            <p style="text-align: center; font-weight: bold; color: green;" class="mt-3 mx-3" id="done-acara" hidden>Terima kasih!<br>Anda telah selesai memberikan semua penilaian yang dapat diberikan di acara kepanitiaan ini. Silakan lakukan penilaian di acara kepanitiaan lain yang mungkin tersedia.</p>
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
                                <h3 class="performance-title"><i class="fas fa-hourglass-half"></i> Time Management</h3>
                            </div>
                            <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                                <p class="deskripsi">Kemampuan untuk mengatur waktunya dengan baik menggambarkan panitia tersebut ahli, terampil, dan berkomitmen tinggi terhadap satu ataupun banyak bidang yang ia tekuni. <u>Indikator:</u></p>
                                <ol class="ml-4">
                                    <li><b>Sering terlambat lebih dari 15 menit tanpa alasan</b> saat rapat divisi maupun hari H acara, <b>tidak</b> menyelesaikan tugas <b>tanpa ada alasan yang jelas</b></li>
                                    <li><b>Sering terlambat hingga 15 menit</b> saat rapat divisi maupun hari H acara, menyelesaikan tugas <b>setelah lewat</b> deadline</li>
                                    <li><b>Selalu datang secara tepat waktu</b> saat rapat divisi maupun hari H acara, menyelesaikan tugas <b>sesuai</b> dengan deadline</li>
                                    <li><b>Selalu datang sebelum jam yang sudah ditentukan</b> saat rapat divisi maupun hari H acara, menyelesaikan tugas <b>beberapa hari sebelum</b> deadline</li>
                                </ol>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <h4 class="performance-nilai">Penilaian Time Management<br><span class="nama"></span></h4>
                            </div>
                            <div class="row mt-2 mx-2 justify-content-center">
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="time_management" id="time_management1" value="1" width="30px;">
                                    <label class="form-check-label" for="time_management1"><b>&nbsp;&nbsp;1</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="time_management" id="time_management2" value="2">
                                    <label class="form-check-label" for="time_management2"><b>&nbsp;&nbsp;2</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="time_management" id="time_management3" value="3">
                                    <label class="form-check-label" for="time_management3"><b>&nbsp;&nbsp;3</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="time_management" id="time_management4" value="4">
                                    <label class="form-check-label" for="time_management4"><b>&nbsp;&nbsp;4</b></label>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>

                            <div class="row justify-content-center">
                                <h3 class="performance-title"><i class="far fa-handshake"></i> Cooperative</h3>
                            </div>
                            <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                                <p class="deskripsi">Panitia tersebut ringan tangan untuk bekerja sama atau membantu panitia lain dalam mengerjakan tugas. Panitia tersebut juga mampu menyesuaikan cara kerjanya dengan panitia lain sehingga menciptakan suasana kerja yang efisien dan efektif. <u>Indikator:</u></p>
                                <ol class="ml-4">
                                    <li><b>Tidak pernah</b> membantu panitia sedivisi mencari solusi dari permasalahan</li>
                                    <li><b>Jarang</b> membantu panitia sedivisi mencari solusi dari permasalahan</li>
                                    <li><b>Cukup sering</b> membantu panitia sedivisi mencari solusi dari permasalahan, mampu bekerja sama dengan panitia divisi lain secara lancar dan kondusif</li>
                                    <li><b>Selalu</b> membantu panitia sedivisi mencari solusi dari permasalahan, mampu bekerja sama dengan panitia divisi lain secara lancar dan kondusif</li>
                                </ol>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <h4 class="performance-nilai">Penilaian Cooperative<br><span class="nama"></span></h4>
                            </div>
                            <div class="row mt-2 mx-2 justify-content-center">
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="cooperative" id="cooperative1" value="1" width="30px;">
                                    <label class="form-check-label" for="cooperative1"><b>&nbsp;&nbsp;1</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="cooperative" id="cooperative2" value="2">
                                    <label class="form-check-label" for="cooperative2"><b>&nbsp;&nbsp;2</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="cooperative" id="cooperative3" value="3">
                                    <label class="form-check-label" for="cooperative3"><b>&nbsp;&nbsp;3</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="cooperative" id="cooperative4" value="4">
                                    <label class="form-check-label" for="cooperative4"><b>&nbsp;&nbsp;4</b></label>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>

                            <div class="row justify-content-center">
                                <h3 class="performance-title"><i class="fas fa-puzzle-piece"></i> Problem Solving</h3>
                            </div>
                            <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                                <p class="deskripsi">Saat dihadapkan dengan masalah, panitia tersebut mampu mengatasinya dengan baik hingga orang lain mempercayainya untuk memegang tanggung jawab. <u>Indikator:</u></p>
                                <ol class="ml-4">
                                    <li><b>Tidak mampu</b> mengatasi dan menyelesaikan masalah hingga tuntas</li>
                                    <li><b>Kurang mampu</b> mengatasi dan menyelesaikan masalah hingga tuntas</li>
                                    <li><b>Cukup mampu</b> mengatasi dan menyelesaikan masalah hingga tuntas</li>
                                    <li><b>Sangat mampu</b> mengatasi dan menyelesaikan masalah hingga tuntas</li>
                                </ol>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <h4 class="performance-nilai">Penilaian Problem Solving<br><span class="nama"></span></h4>
                            </div>
                            <div class="row mt-2 mx-2 justify-content-center">
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="problem_solving" id="problem_solving1" value="1" width="30px;">
                                    <label class="form-check-label" for="problem_solving1"><b>&nbsp;&nbsp;1</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="problem_solving" id="problem_solving2" value="2">
                                    <label class="form-check-label" for="problem_solving2"><b>&nbsp;&nbsp;2</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="problem_solving" id="problem_solving3" value="3">
                                    <label class="form-check-label" for="problem_solving3"><b>&nbsp;&nbsp;3</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="problem_solving" id="problem_solving4" value="4">
                                    <label class="form-check-label" for="problem_solving4"><b>&nbsp;&nbsp;4</b></label>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>

                            <div class="row justify-content-center">
                                <h3 class="performance-title"><i class="fas fa-brain"></i> Open Minded</h3>
                            </div>
                            <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                                <p class="deskripsi">Panitia tersebut tidak akan memaksakan kehendaknya karena selalu berusaha untuk mendengarkan dan mempertimbangkan pendapat sekitar agar dapat mencapai kesepakatan bersama. <u>Indikator:</u></p>
                                <ol class="ml-4">
                                    <li><b>Tidak pernah</b> menanyakan pendapat orang lain atau sesama anggota divisi saat mengalami kendala</li>
                                    <li><b>Jarang</b> menanyakan pendapat orang lain atau sesama anggota divisi saat mengalami kendala</li>
                                    <li><b>Sering</b> menanyakan pendapat orang lain atau sesama anggota divisi saat mengalami kendala</li>
                                    <li><b>Selalu</b> menanyakan pendapat orang lain atau sesama anggota divisi saat mengalami kendala</li>
                                </ol>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <h4 class="performance-nilai">Penilaian Open Minded<br><span class="nama"></span></h4>
                            </div>
                            <div class="row mt-2 mx-2 justify-content-center">
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="open_minded" id="open_minded1" value="1" width="30px;">
                                    <label class="form-check-label" for="open_minded1"><b>&nbsp;&nbsp;1</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="open_minded" id="open_minded2" value="2">
                                    <label class="form-check-label" for="open_minded2"><b>&nbsp;&nbsp;2</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="open_minded" id="open_minded3" value="3">
                                    <label class="form-check-label" for="open_minded3"><b>&nbsp;&nbsp;3</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="open_minded" id="open_minded4" value="4">
                                    <label class="form-check-label" for="open_minded4"><b>&nbsp;&nbsp;4</b></label>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>

                            <div class="row justify-content-center">
                                <h3 class="performance-title"><i class="fas fa-heartbeat"></i> Emotional Stability</h3>
                            </div>
                            <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                                <p class="deskripsi">Saat berada di bawah tekanan, panitia tersebut tetap bersikap tegar dan mudah beradaptasi dengan segala keadaan sehingga selalu memberi kinerja yang terbaik. <u>Indikator:</u></p>
                                <ol class="ml-4">
                                    <li><b>Tidak mampu</b> mengerjakan tugas dalam deadline singkat dengan hasil maksimal</li>
                                    <li><b>Kurang mampu</b> mengerjakan tugas dalam deadline singkat dengan hasil maksimal</li>
                                    <li><b>Cukup mampu</b> mengerjakan tugas dalam deadline singkat dengan hasil maksimal</li>
                                    <li><b>Sangat mampu</b> mengerjakan tugas dalam deadline singkat dengan hasil maksimal</li>
                                </ol>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <h4 class="performance-nilai">Penilaian Emotional Stability<br><span class="nama"></span></h4>
                            </div>
                            <div class="row mt-2 mx-2 justify-content-center">
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="emotional_stability" id="emotional_stability1" value="1" width="30px;">
                                    <label class="form-check-label" for="emotional_stability1"><b>&nbsp;&nbsp;1</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="emotional_stability" id="emotional_stability2" value="2">
                                    <label class="form-check-label" for="emotional_stability2"><b>&nbsp;&nbsp;2</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="emotional_stability" id="emotional_stability3" value="3">
                                    <label class="form-check-label" for="emotional_stability3"><b>&nbsp;&nbsp;3</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="emotional_stability" id="emotional_stability4" value="4">
                                    <label class="form-check-label" for="emotional_stability4"><b>&nbsp;&nbsp;4</b></label>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>

                            <div class="row justify-content-center">
                                <h3 class="performance-title">Testimoni</h3>
                            </div>
                            <center><a onclick="etikaTestimoni()" class="btn mt-1" style="background: #DC3545; width: 250px; color: white;">Etika Memberikan Testimoni</a></center>
                            <textarea type="text" class="form-control mt-3" id="testimoni" name="testimoni" style="font-size: 12pt; text-align: center; color: #3C6CB4 !important;" rows="3" placeholder="Silakan berikan kesan dan pesan Anda di kolom ini (maksimal 1000 karakter)" maxlength="1000" required></textarea>

                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                            <center>
                                <button class="submit btn btn-warning mt-3 mb-5" onclick="submitAssessment()" style='width: 200px;'>Submit Assessment</button>
                            </center>

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
        function submitAssessment(){for(var e,a,i,t,n,s=!1,r=!1,m=!1,o=!1,l=!1,d=document.getElementsByName("time_management"),p=!1,h=0,g=d.length;h<g;h++)if(d[h].checked){p=!0,s=!0,e=d[h].value;break}0==p&&$.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Time Management sebelum submit!</span>');var c=document.getElementsByName("cooperative");for(p=!1,h=0,g=c.length;h<g;h++)if(c[h].checked){p=!0,r=!0,a=c[h].value;break}0==p&&$.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Cooperative sebelum submit!</span>');var b=document.getElementsByName("problem_solving");for(p=!1,h=0,g=b.length;h<g;h++)if(b[h].checked){p=!0,m=!0,i=b[h].value;break}0==p&&$.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Problem Solving sebelum submit!</span>');var u=document.getElementsByName("open_minded");for(p=!1,h=0,g=u.length;h<g;h++)if(u[h].checked){p=!0,o=!0,t=u[h].value;break}0==p&&$.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Open Minded sebelum submit!</span>');var f=document.getElementsByName("emotional_stability");for(p=!1,h=0,g=f.length;h<g;h++)if(f[h].checked){p=!0,l=!0,n=f[h].value;break}0==p&&$.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Emotional Stability sebelum submit!</span>'),""==$("#testimoni").val().trim()&&$.alert('<span style="font-weight: bold; color: red;">Silakan memberikan testimoni sebelum submit!</span>'),$("#testimoni").val().trim().length<10&&""!=$("#testimoni").val().trim()&&$.alert('<span style="font-weight: bold; color: red;">Kasih testimoni jangan pendek-pendek, dong. Minimal 10 karakter, yah! :)</span>'),$("#testimoni").val().trim().length>1e3&&$.alert('<span style="font-weight: bold; color: red;">Testimoni maksimal 1000 karakter!</span>');var k=!1;e<0||e>4||a<0||a>4||i<0||i>4||t<0||t>4||n<0||n>4?$.alert('<span style="font-weight: bold; color: red;">Kok gitu, sih?</span>'):k=!0,k&&s&&r&&m&&o&&l&&$("#testimoni").val().length>=10&&$("#testimoni").val().length<1e3&&grecaptcha.ready(function(){grecaptcha.execute("6LdukNYaAAAAAJwNQk4_DFZxIqKcQHCLIvxcMD86",{action:"assessment"}).then(function(s){var r=document.getElementById("recaptchaResponse");r.value=s,$(".submit").prop("disabled",!0).html("<b>Submitting...</b>");var m=$("#testimoni").val(),o=$("#acara").val(),l=$("#mahasiswa").val();$.ajax({url:"phps/submit_assessment.php",data:{tmValue:e,cValue:a,psValue:i,omValue:t,esValue:n,testimoni:m,id:l,id_event:o,response:r.value},method:"POST",success:function(e){"true"==e?Swal.fire({position:"center",imageUrl:"./assets/gif/success_2.gif",imageHeight:150,title:"Sukses Memberikan Assessment!",showConfirmButton:!1,timer:2e3}):"false"==e?Swal.fire({position:"center",imageUrl:"./assets/gif/server_error.gif",imageHeight:150,title:"Terjadi Error di Server! <br>Silakan Ulangi Kembali",showConfirmButton:!1,timer:2e3}):"grecaptcha-failed"==e?Swal.fire({position:"center",imageUrl:"./assets/gif/bye_5.gif",imageHeight:150,title:"Captcha Gagal! <br>Silakan Coba Ulangi Kembali",showConfirmButton:!1,timer:2e3}):"max-testi"==e?Swal.fire({position:"center",imageUrl:"./assets/gif/invalid_3.gif",imageHeight:150,title:"Testimoni Maksimal 1000 Karakter!",showConfirmButton:!1,timer:2e3}):"min-testi"==e?Swal.fire({position:"center",imageUrl:"./assets/gif/invalid_3.gif",imageHeight:150,title:"Testimoni Minimal 10 Karakter!",showConfirmButton:!1,timer:2e3}):"invalid-rating"==e&&Swal.fire({position:"center",imageUrl:"./assets/gif/invalid_1.gif",imageHeight:150,title:"Kok Gitu, Sih?",showConfirmButton:!1,timer:2e3}),setTimeout(function(){window.location.href="give_assessment.php"},2e3)}})})})}function toggleMahasiswa(){if(""==$("#acara").val())$("#mahasiswa").prop("disabled",!0),$("#mahasiswa").html('<option value="">Pilih mahasiswa/i...</option>'),$(".assessment-container").prop("hidden",!0),$("#done-acara").prop("hidden",!0),$("#list-mhs").prop("hidden",!0);else{$("#list-mhs").removeAttr("hidden"),$("#mahasiswa").removeAttr("disabled"),$("#mahasiswa").prop("required",!0),$("#mahasiswa").html('<option value="">Harap tunggu...</option>');var e=$("#acara").val();$.ajax({url:"phps/get_list_mahasiswa.php",data:{acara:e},method:"POST",success:function(e){$("#mahasiswa").html('<option value="">Pilih mahasiswa/i...</option>'+e),0==e.length?($("#list-mhs").prop("hidden",!0),$("#done-acara").removeAttr("hidden"),$(".assessment-container").prop("hidden",!0)):($("#done-acara").prop("hidden",!0),$("#list-mhs").removeAttr("hidden"))}})}}function toggleAssessment(){if($(".container-menu").css({"overflow-y":"scroll"}),$(".form-check-input").prop("checked",!1),$(".spinner-border").prop("hidden",!1),$(".mhs-desc").prop("hidden",!0),""==$("#mahasiswa").val())$(".assessment-container").prop("hidden",!0);else{$(".assessment-container").removeAttr("hidden");var e=$("#mahasiswa").val();$.ajax({url:"phps/get_mahasiswa.php",data:{id_mhs:e},method:"POST",success:function(e){$(".spinner-border").prop("hidden",!0),$(".mhs-desc").prop("hidden",!1);var a=$.parseJSON(e);$(".nama").html(a.nama),$("#jabatan").html(a.jabatan),$("#divisi").html(a.divisi),$("#acara-mhs").html(a.acara)}})}}function etikaTestimoni(){$.confirm({title:'<span style="color:#3C6CB4;">Etika Memberikan Testimoni</span>',typeAnimated:!0,theme:"modern",draggable:!1,columnClass:"col-md-6",buttons:{cancel:{text:"Saya Mengerti",btnClass:"saya-mengerti"}},content:'\n                <div style="color: #3C6CB4; font-size: 14pt;">\n                    <p style="text-align: center;">Berikan <b>kesan, pesan, apresiasi, maupun kritik </b>yang <b>positif</b> serta <b>membangun</b> selama mengikuti acara kepanitiaan bersama di UK Petra yang dapat mendukung proses pemilihan panitia di masa depan.<br>Penilaian dan testimoni yang Anda berikan pada halaman ini akan bersifat <b>anonim</b> bagi Mahasiswa/i yang diberikan penilaian dan testimoni.<br><br>\n                    <span style="color: red; font-weight: bold;">Dilarang mengandung unsur pornografi, fitnah, pencemaran nama baik, dan pelanggaran SARA! NRP dan nama Anda akan tercantum di database BEM UK Petra.</span>\n                </p>\n                </div>\n            '})}
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