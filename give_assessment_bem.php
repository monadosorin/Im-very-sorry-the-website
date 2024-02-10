<?php
require_once 'phps/connect.php';

if (!isset($_SESSION['nrp'])) {
    header("Location: index.php");
    exit();
}

$_SESSION['page'] = 'give_assessment_bem';

$nrp = $_SESSION['nrp'];

$cekFungsionarissql = "SELECT * FROM bem_fungsionaris_2024 WHERE nrp = ?";
$cekFungsionarisstmt = $pdo->prepare($cekFungsionarissql);
$cekFungsionarisstmt->execute([$nrp]);

if ($cekFungsionarisstmt->rowCount() == 0) {
    header("Location: index.php");
    exit();
}

include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>REACH – Penilaian Kuartal 1 BEM 2023/2024 (WAJIB)</title>
</head>

<style>
    body{background-color:#7c6ed1;height:100vh;width:100vw;overflow:hidden}.wrapper{height:calc(100vh - 80px);width:100vw}.container-menu{height:100%;position:relative;display:grid;place-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;padding:0!important;margin-bottom:0!important;overflow-y:hidden;overflow-x:hidden!important}.menu{display:grid;place-items:center;grid-template-rows:50px auto;height:95%;position:relative;padding:35px;overflow:hidden}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}.bar{width:100%;height:100%;background-color:#d67c57;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#fdcd5f;left:0;height:100%;display:grid;place-items:center;width:50px;color:#3c6cb4;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red;color:#fff}.content-container{color:#3c6cb4;padding:50px;z-index:3}.assessment-text{letter-spacing:5px;color:#fff;margin-bottom:0;grid-column:2}.bg-assessment{top:0;z-index:1;position:relative;object-fit:cover}.bg-container{top:0;left:0;width:100%;position:absolute}label{color:#3c6cb4;font-weight:700}input,select,textarea{background:#d67c55!important;border:none!important;border-radius:10px!important;color:#fff!important}#testimoni{background:#ead8c0!important}.container-menu::-webkit-scrollbar{width:15px}.container-menu::-webkit-scrollbar-track{background:#f9ead5}.container-menu::-webkit-scrollbar-thumb{background:#3c6cb4;border-right:8px #f9ead5 solid;border-top:10px #f9ead5 solid;border-bottom:10px #f9ead5 solid;background-clip:padding-box}@media screen and (max-width:992px){.assessment-text{font-size:20pt}}.bg-mobile{display:none}@media screen and (max-width:767px){.bg-mobile{display:block}}.performance-title{font-weight:700;text-align:center;}.performance-nilai{text-align:center;font-weight:700}@media screen and (max-width:380px){.performance-title{font-size:16pt}.performance-nilai{font-size:14pt}#testimoni{width:97%}.nama{font-size:16pt}#divisi,#jabatan{font-size:14pt}}hr{width:90%;border:1px solid #7c6ed1}.choose-container{display:grid;place-items:center}.menu .container-menu{background-color:#f9ead5}.jconfirm-box-container .jconfirm-box{background-image:url(assets/background/details.png);background-size:cover;box-shadow:none!important}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.menu{padding:20px}.content-container{padding:30px 15px}}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;-webkit-appearance:none;font-weight:700}.btn:hover{transition:.3s;background:#7c6ed1!important;color:#fff!important}.saya-mengerti{border-radius:40px!important;background-color:#dc3545!important;color:#fff!important;transition:.3s!important}.saya-mengerti:hover{transition:.3s;color:#fdcd5f}.jconfirm-content{max-height:50vh;padding:15px;}.jconfirm.jconfirm-modern .jconfirm-box div.jconfirm-title-c{padding-bottom:0!important;}.jconfirm-content::-webkit-scrollbar{width:8px;border-radius:10px}.jconfirm-content::-webkit-scrollbar-track{background:#c55d50}.jconfirm-content::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}
</style>

<body>
    <div class="wrapper">
        <div class="menu">
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
                    <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                    <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                    <div class="bg-mobile">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                        <img class="bg-assessment" src="./assets/background/bgsmaller.jpg" alt="Background - Assessment" style="width: 100%;">
                    </div>
                </div>
                <div class="content-container justify-content-center">
                    <div class="choose-container row justify-content-center mt-3" style="margin-right: 0px !important;">

                        <div id="list-mhs" class="col-12" style="margin-left: 20px!important;">
                            <label class="mt-3" for="mahasiswa">Berikan Penilaian Untuk</label>
                            <select class="form-control" id="mahasiswa" name="mahasiswa" style="height:40px; font-size: 12pt; width: 100%;" onchange="toggleAssessment()">
                                <option value="">Pilih fungsionaris...</option>
                            </select>
                            <font size="2">nb : Silakan mengisi penilaian untuk semua nama yang ada pada daftar penilaian wajib anda!</font>
                        </div>

                        <p style="text-align: center; font-weight: bold; color: green; font-size: 14pt;" class="mt-3 mx-3" id="done-acara" hidden>Terima kasih!<br>#KAMU telah selesai memberikan semua penilaian <u>wajib</u> yang dapat diberikan pada Penilaian Kuartal I BEM 2023/2024.</p>
                    </div>

                    <div class="justify-content-center mt-4">
                        <center>
                            <a type='button' href='assessment_history_bem.php' class='btn btn-warning' style='width: 200px;'>
                                Assessment History
                            </a>
                            <br>
                            <a type='button' onclick='announcement()' class='btn btn-danger mt-3' style='width: 200px; background-color: #3B6CB4; color: white;'>
                                Announcement
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
                                <h5 id="departemen" style="text-align: center;"></h5>
                                <h5 id="bidang" style="text-align: center;"></h5>
                            </div>
                        </div>

                        <br>
                        <center>
                            <hr>
                        </center>
                        <br>
                        <br>

                        <!-- 1 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="fas fa-medkit"></i> Caring<i><br>(Proaktif)</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Fungsio memilki kepekaan dan peduli dengan keadaan di sekitarnya, berinisiatif untuk membantu baik secara emosional dan fisikal.<u> Indikator:</u></p>
                            <ol class="ml-4">
                                <li>Tidak mau tahu dan hanya mementingkan dirinya/tugasnya sendiri</li>
                                <li>Tidak tahu dan tidak berusaha untuk peka/bertanya</li>
                                <li>Mengetahui apabila ada masalah tetapi memilih untuk diam saja/pura-pura tidak tahu</li>
                                <li>Mengetahui apabila ada masalah dan berinisiatif untuk memberikan bantuan/solusi kepada fungsio lain</li>
                            </ol>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <h4 class="performance-nilai">Penilaian Caring<br><span class="nama"></span></h4>
                        </div>
                        <div class="row mt-2 mx-2 justify-content-center">
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="caring" id="caring1" value="1" width="30px;">
                                <label class="form-check-label" for="caring1"><b>&nbsp;&nbsp;1</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="caring" id="caring2" value="2">
                                <label class="form-check-label" for="caring2"><b>&nbsp;&nbsp;2</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="caring" id="caring3" value="3">
                                <label class="form-check-label" for="caring3"><b>&nbsp;&nbsp;3</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="caring" id="caring4" value="4">
                                <label class="form-check-label" for="caring4"><b>&nbsp;&nbsp;4</b></label>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
<!-- 2 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="fas fa-user-tie"></i> Cooperativeness<i><br>(Proaktif)</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Fungsio ringan tangan untuk bekerja sama dan tidak semaunya sendiri, serta aktif dalam memberikan solusi/masukan yang membangun kepada fungsio lain.<u> Indikator:</u></p>
                            <ol class="ml-4">
                                <li>Sulit diajak bekerja sama tanpa alasan yang jelas, meninggalkan tanggung jawabnya sehingga merugikan fungsio lain</li>
                                <li>Cenderung individualis, namun tetap melakukan tanggung jawabnya sehingga tidak merugikan fungsio lain</li>
                                <li>Bersedia diajak bekerja sama saat diminta bantuannya</li>
                                <li>Berinisiatif untuk memberikan bantuan/solusi kepada fungsio lain</li>
                            </ol>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <h4 class="performance-nilai">Penilaian Cooperativeness<br><span class="nama"></span></h4>
                        </div>
                        <div class="row mt-2 mx-2 justify-content-center">
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="cooperativeness" id="cooperativeness1" value="1" width="30px;">
                                <label class="form-check-label" for="cooperativeness1"><b>&nbsp;&nbsp;1</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="cooperativeness" id="cooperativeness2" value="2">
                                <label class="form-check-label" for="cooperativeness2"><b>&nbsp;&nbsp;2</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="cooperativeness" id="cooperativeness3" value="3">
                                <label class="form-check-label" for="cooperativeness3"><b>&nbsp;&nbsp;3</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="cooperativeness" id="cooperativeness4" value="4">
                                <label class="form-check-label" for="cooperativeness4"><b>&nbsp;&nbsp;4</b></label>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
<!-- 3 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="fas fa-hourglass-half"></i> Problem Solving<i><br>(Progresif)
</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Saat fungsio dihadapkan dengan masalah, fungsio tersebut mampu menyelesaikan masalah yang ada dengan penuh integritas, sehingga layak dipercaya untuk menerima tanggung jawab.<u> Indikator:</u></p>
                            <ol class="ml-4">
                                <li>Saat dihadapkan dengan masalah, fungsio lepas tangan/kabur dan tidak menyelesaikan masalah yang dihadapi</li>
                                <li>Dapat menyelesaikan masalah, namun kurang mengutamakan integritas dalam solusi penyelesaian masalah yang dibuat (bersikap bias terhadap suatu keputusan karena faktor keuntungan internal maupun eksternal)</li>
                                <li>Kemampuan penyelesaian masalah rata-rata, namun selalu mengutamakan integritas dalam setiap solusi yang dibuat</li>
                                <li>Mampu menangani permasalahan yang ada dengan cekatan dan mengutamakan integritas dalam solusi yang dibuat</li>
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
<!-- 4 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="far fa-handshake"></i> Responsibility<i><br>(Progresif)</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Fungsio dapat bertanggung jawab akan tugas yang telah diberikan dan menyelesaikan sesuatu yang sudah dimulainya baik karena hasil keputusan atau akibat dari suatu tindakannya sendiri <u> Indikator:</u></p>
                            <ol class="ml-4">
                                <li>Fungsio mengabaikan jobdesknya tanpa alasan, kabur dari masalah, atau melemparkan tanggung jawab kepada fungsio lain sehingga merugikan fungsionaris lainnya</li>
                                <li>Fungsio mengerjakan tanggung jawabnya tetapi sangat bergantung atas keputusan atau arahan atau jawaban dari atasan</li>
                                <li>Fungsio menunda-nunda mengerjakan tanggung jawabnya sehingga harus terus menerus diingatkan oleh atasan</li>
                                <li>Fungsio menyelesaikan tanggung jawabnya tanpa disuruh</li>
                            </ol>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <h4 class="performance-nilai">Penilaian Responsibility<br><span class="nama"></span></h4>
                        </div>
                        <div class="row mt-2 mx-2 justify-content-center">
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="responsibility" id="responsibility1" value="1" width="30px;">
                                <label class="form-check-label" for="responsibility1"><b>&nbsp;&nbsp;1</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="responsibility" id="responsibility2" value="2">
                                <label class="form-check-label" for="responsibility2"><b>&nbsp;&nbsp;2</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="responsibility" id="responsibility3" value="3">
                                <label class="form-check-label" for="responsibility3"><b>&nbsp;&nbsp;3</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="responsibility" id="responsibility4" value="4">
                                <label class="form-check-label" for="responsibility4"><b>&nbsp;&nbsp;4</b></label>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
<!-- 5 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="fas fa-puzzle-piece"></i> Decision Making<i><br>(Progresif)</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Fungsio dapat melihat pola kesalahan yang telah terjadi sebelumnya serta menerima masukan dan menggunakannya sebagai bahan pertimbangan untuk mengambil keputusan yang terbaik.<u> Indikator:</u></p>
                            <ol class="ml-4">
                                <li>Melakukan semuanya semaunya sendiri, sama sekali tidak mau menerima pendapat, kritik, atau saran yang diberikan orang lain</li>
                                <li>Terlalu mendengarkan pendapat dan mengikutinya tanpa melakukan pertimbangan</li>
                                <li>Dapat mengevaluasi dan mempertimbangkan pendapat, kritik, ataupun saran dari orang lain tetapi tetap memiliki kebias-an kepada suatu pilihan</li>
                                <li>Berinisiatif untuk mengevaluasi dan mempertimbangkan pendapat, kritik, ataupun saran dari orang lain untuk mendapatkan keputusan yang terbaik</li>
                            </ol>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <h4 class="performance-nilai">Penilaian Decision Making<br><span class="nama"></span></h4>
                        </div>
                        <div class="row mt-2 mx-2 justify-content-center">
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="decision_making" id="decision_making1" value="1" width="30px;">
                                <label class="form-check-label" for="decision_making1"><b>&nbsp;&nbsp;1</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="decision_making" id="decision_making2" value="2">
                                <label class="form-check-label" for="decision_making2"><b>&nbsp;&nbsp;2</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="decision_making" id="decision_making3" value="3">
                                <label class="form-check-label" for="decision_making3"><b>&nbsp;&nbsp;3</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="decision_making" id="decision_making4" value="4">
                                <label class="form-check-label" for="decision_making4"><b>&nbsp;&nbsp;4</b></label>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
<!-- 6 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="fas fa-brain"></i> Time Management<i><br>(Professional)</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Fungsio dapat mengatur waktunya dengan baik sehingga tugas-tugasnya dapat terselesaikan tepat waktu.<u>Indikator:</u></p>
                            <ol class="ml-4">
                                <li>Tidak menyelesaikan tugas yang diberikan</li>
                                <li>Beberapa kali menyelesaikan tanggung jawab lebih dari deadline tanpa kabar/alasan yang jelas</li>
                                <li>Hampir selalu menyelesaikan tanggung jawabnya tepat waktu dan memberikan kabar jika terkendala soal deadline</li>
                                <li>Selalu menyelesaikan tanggung jawabnya tepat waktu atau bahkan sebelum deadline</li>
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
<!-- 7 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="fas fa-heartbeat"></i> Communicative<i><br>(Professional)</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Fungsio dapat mengkomunikasikan pendapat dan kendalanya dengan cara yang efektif sehingga meminimalisir adanya miskomunikasi dalam kerja sama.<u> Indikator:</u></p>
                            <ol class="ml-4">
                                <li>Sangat sulit dihubungi, sehingga sulit untuk diajak bekerja sama</li>
                                <li>Jarang memberikan kabar tentang kondisi pekerjaannya</li>
                                <li>Sering memberikan kabar saat diminta/di follow-up</li>
                                <li>Memiliki inisiatif untuk memberi kabar kepada pihak yang bekerja sama dengannya tanpa perlu di follow-up</li>
                            </ol>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <h4 class="performance-nilai">Penilaian Communicative<br><span class="nama"></span></h4>
                        </div>
                        <div class="row mt-2 mx-2 justify-content-center">
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="communicative" id="communicative1" value="1" width="30px;">
                                <label class="form-check-label" for="communicative1"><b>&nbsp;&nbsp;1</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="communicative" id="communicative2" value="2">
                                <label class="form-check-label" for="communicative2"><b>&nbsp;&nbsp;2</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="communicative" id="communicative3" value="3">
                                <label class="form-check-label" for="communicative3"><b>&nbsp;&nbsp;3</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="communicative" id="communicative4" value="4">
                                <label class="form-check-label" for="communicative4"><b>&nbsp;&nbsp;4</b></label>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>

    

          
<!-- 8 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="fas fa-person-booth"></i></i> Politeness<i><br> (Professional)</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Fungsio mampu berkomunikasi dengan pihak internal maupun eksternal dengan tata cara yang baik dan benar, sehingga mampu menjalin kolaborasi yang berdampak.<u> Indikator:</u></p>
                            <ol class="ml-4">
                                <li><b>Tidak</b> pernah menggunakan kata “terima kasih”, “tolong”, “maaf”, dan cukup sering bertutur kata kurang sopan ketika berkomunikasi</li>
                                <li><b>Jarang</b> menggunakan kata “terima kasih”, “tolong”, “maaf” dan terkadang bertutur kata kurang sopan ketika berkomunikasi</li>
                                <li><b>Cukup</b> sering menggunakan kata “terima kasih”, “tolong”, “maaf”, dan bertutur kata sopan ketika berkomunikasi</li>
                                <li><b>Selalu</b> menggunakan kata “terima kasih”, “tolong”, “maaf”, dan bertutur kata sopan ketika berkomunikasi</li>
                            </ol>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <h4 class="performance-nilai">Penilaian Politeness<br><span class="nama"></span></h4>
                        </div>
                        <div class="row mt-2 mx-2 justify-content-center">
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="politeness" id="politeness1" value="1" width="30px;">
                                <label class="form-check-label" for="politeness1"><b>&nbsp;&nbsp;1</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="politeness" id="politeness2" value="2">
                                <label class="form-check-label" for="politeness2"><b>&nbsp;&nbsp;2</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="politeness" id="politeness3" value="3">
                                <label class="form-check-label" for="politeness3"><b>&nbsp;&nbsp;3</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="politeness" id="politeness4" value="4">
                                <label class="form-check-label" for="politeness4"><b>&nbsp;&nbsp;4</b></label>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
<!-- 9 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="far fa-comments"></i> Open Mindedness<i><br> (Potensial)</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Fungsio terbuka untuk menerima kritik atau saran dari orang lain dan bersedia mempertimbangkannya demi mewujudkan tujuan-tujuan organisasi dengan lebih baik lagi.<u> Indikator:</u></p>
                            <ol class="ml-4">
                                <li>Keras kepala, sama sekali tidak mau menerima atau bahkan mempermasalahkan pendapat, kritik, atau saran yang diberikan orang lain</li>
                                <li>Terlihat kurang nyaman saat menerima pendapat, kritik, atau saran dari orang lain / bersikap seolah-olah peduli tetapi tidak dilakukan</li>
                                <li>Dapat menerima pendapat, kritik, ataupun saran dari orang lain dengan rendah hati</li>
                                <li>Berinisiatif untuk meminta pendapat, kritik, ataupun saran dari orang lain dan dapat menerimanya dengan rendah hati</li>
                            </ol>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <h4 class="performance-nilai">Penilaian Open Mindedness<br><span class="nama"></span></h4>
                        </div>
                        <div class="row mt-2 mx-2 justify-content-center">
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="open_mindedness" id="open_mindedness1" value="1" width="30px;">
                                <label class="form-check-label" for="open_mindedness1"><b>&nbsp;&nbsp;1</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="open_mindedness" id="open_mindedness2" value="2">
                                <label class="form-check-label" for="open_mindedness2"><b>&nbsp;&nbsp;2</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="open_mindedness" id="open_mindedness3" value="3">
                                <label class="form-check-label" for="open_mindedness3"><b>&nbsp;&nbsp;3</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="open_mindedness" id="open_mindedness4" value="4">
                                <label class="form-check-label" for="open_mindedness4"><b>&nbsp;&nbsp;4</b></label>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>

<!-- 9 -->
                        <div class="row justify-content-center">
                            <h3 class="performance-title"><i class="far fa-comments"></i> Trustworthy<i><br> (Potensial)</i></h3>
                        </div>
                        <div class="row mx-5 justify-content-center" style="font-size: 14pt;">
                            <p class="deskripsi">Fungsio dapat dipercaya untuk menyelesaikan suatu tugas dan mampu mempertanggungjawabkan tindakannya, serta senantiasa bersikap jujur dan menepati janji.<u> Indikator:</u></p>
                            <ol class="ml-4">
                                <li>Sering kabur, berbohong dan tidak menepati janji yang dibuat</li>
                                <li>Suka menunda-nunda saat mengerjakan tanggung jawabnya dan selalu mencari-cari alasan saat dihubungi</li>
                                <li>Menyelesaikan tanggung jawab meskipun melewati deadline dan jujur saat mengkomunikasikan kendala yang dialami</li>
                                <li>Memiliki tanggung jawab atas tindakannya dan selalu bersikap jujur</li>
                            </ol>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <h4 class="performance-nilai">Penilaian Trustworthy<br><span class="nama"></span></h4>
                        </div>
                        <div class="row mt-2 mx-2 justify-content-center">
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="trustworthy" id="trustworthy1" value="1" width="30px;">
                                <label class="form-check-label" for="trustworthy1"><b>&nbsp;&nbsp;1</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="trustworthy" id="trustworthy2" value="2">
                                <label class="form-check-label" for="trustworthy2"><b>&nbsp;&nbsp;2</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="trustworthy" id="trustworthy3" value="3">
                                <label class="form-check-label" for="trustworthy3"><b>&nbsp;&nbsp;3</b></label>
                            </div>
                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="trustworthy" id="trustworthy4" value="4">
                                <label class="form-check-label" for="trustworthy4"><b>&nbsp;&nbsp;4</b></label>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>

                        <div class="row justify-content-center mx-2">
                            <h3 class="performance-title">Testimoni</h3>
                        </div>
                        <center><a onclick="etikaTestimoni()" class="btn btn-danger mt-1" style="background: #DC3545; width: 250px; color: white;">Etika Memberikan Testimoni</a></center>
                        <textarea type="text" class="form-control mt-3" id="testimoni" name="testimoni" style="font-size: 12pt; text-align: center; color: #3C6CB4 !important;" rows="3" placeholder="Silakan berikan kesan dan pesan Anda di kolom ini (maksimal 1000 karakter)" maxlength="1000" required></textarea>

                        <center><button class="submit btn btn-warning mt-3 mb-5" onclick="submitAssessment()" style='width: 200px;'>Submit Assessment</button></center>
                        <div class="row mx-2 mb-3 justify-content-center">
                                <a href="./suggestions.php" target="_blank" style="text-align: center; text-decoration: none; color: #3C6CB4;">Punya kritik atau saran untuk REACH? 😊</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-container">
            <img src="./assets/svg/footer.svg" alt="Footer" class="footer-svg">
        </div>
    </div>
</body>

<script>
    function submitAssessment() {
        var caringCheck = false;
        var cooperativenessCheck = false;
        var psCheck = false;
        var responsibilityCheck = false;
        var decisionCheck = false;
        var timeCheck = false;
        var communicativeCheck = false;
        var politenessCheck = false;
        var openMindedCheck = false;
        var trustCheck = false;

        var caringValue;
        var cooperativenessValue;
        var psValue;
        var responsibilityValue;
        var decisionValue;
        var timeValue;
        var communicativeValue;
        var politenessValue;
        var openMindedValue;
        var trustValue;

        var caring = document.getElementsByName('caring');
        var checked = false;
        for (var i = 0, length = caring.length; i < length; i++) {
            if (caring[i].checked) {
                checked = true;
                caringCheck = true;
                caringValue = caring[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Caring sebelum submit!</span>');
        }

        var cooperativeness = document.getElementsByName('cooperativeness');
        checked = false;
        for (var i = 0, length = cooperativeness.length; i < length; i++) {
            if (cooperativeness[i].checked) {
                checked = true;
                cooperativenessCheck = true;
                cooperativenessValue = cooperativeness[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Cooperativeness sebelum submit!</span>');
        }

        var problem_solving = document.getElementsByName('problem_solving');
        checked = false;
        for (var i = 0, length = problem_solving.length; i < length; i++) {
            if (problem_solving[i].checked) {
                checked = true;
                psCheck = true;
                psValue = problem_solving[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Problem Solving sebelum submit!</span>');
        }

        var responsibility = document.getElementsByName('responsibility');
        checked = false;
        for (var i = 0, length = responsibility.length; i < length; i++) {
            if (responsibility[i].checked) {
                checked = true;
                responsibilityCheck = true;
                responsibilityValue = responsibility[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Responsibility sebelum submit!</span>');
        }

        var decision_making = document.getElementsByName('decision_making');
        checked = false;
        for (var i = 0, length = decision_making.length; i < length; i++) {
            if (decision_making[i].checked) {
                checked = true;
                decisionCheck = true;
                decisionValue = decision_making[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Decision Making sebelum submit!</span>');
        }

        var time_management = document.getElementsByName('time_management');
        checked = false;
        for (var i = 0, length = time_management.length; i < length; i++) {
            if (time_management[i].checked) {
                checked = true;
                timeCheck = true;
                timeValue = time_management[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Time Management sebelum submit!</span>');
        }

        var communicative = document.getElementsByName('communicative');
        checked = false;
        for (var i = 0, length = communicative.length; i < length; i++) {
            if (communicative[i].checked) {
                checked = true;
                communicativeCheck = true;
                communicativeValue = communicative[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Communicative sebelum submit!</span>');
        }

        var politeness = document.getElementsByName('politeness');
        checked = false;
        for (var i = 0, length = politeness.length; i < length; i++) {
            if (politeness[i].checked) {
                checked = true;
                politenessCheck = true;
                politenessValue = politeness[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Politeness sebelum submit!</span>');
        }

        var open_mindedness = document.getElementsByName('open_mindedness');
        checked = false;
        for (var i = 0, length = open_mindedness.length; i < length; i++) {
            if (open_mindedness[i].checked) {
                checked = true;
                openMindedCheck = true;
                openMindedValue = open_mindedness[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Open Mindedness sebelum submit!</span>');
        }

        var trustworthy = document.getElementsByName('trustworthy');
        checked = false;
        for (var i = 0, length = trustworthy.length; i < length; i++) {
            if (trustworthy[i].checked) {
                checked = true;
                trustCheck = true;
                trustValue = trustworthy[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        if (checked == false) {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan penilaian di bagian Trustworthy sebelum submit!</span>');
        }

        if ($("#testimoni").val().trim() == "") {
            $.alert('<span style="font-weight: bold; color: red;">Silakan memberikan testimoni sebelum submit!</span>');
        }
        if ($("#testimoni").val().trim().length < 10 && $("#testimoni").val().trim() != "") {
            $.alert('<span style="font-weight: bold; color: red;">Kasih testimoni jangan pendek-pendek dong. Minimal 10 karakter yah! :)</span>');
        }

        if (caringCheck && cooperativenessCheck && psCheck && responsibilityCheck && decisionCheck && timeCheck && communicativeCheck && politenessCheck && openMindedCheck && trustCheck && $("#testimoni").val().length >= 10) {
            $('.submit').prop('disabled', true).html('<b>Please Wait...</b>');

            var testimoni = $("#testimoni").val();
            var id = $("#mahasiswa").val();
            $.ajax({
                url: "phps/submit_assessment_bem.php",
                data: {
                    caringValue,
                    cooperativenessValue,
                    psValue,
                    responsibilityValue,
                    decisionValue,
                    timeValue,
                    communicativeValue,
                    politenessValue,
                    openMindedValue,
                    trustValue,
                    testimoni: testimoni,
                    id: id
                },
                method: "POST",
                success: function(res) {
                    if (res == 'true') {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Sukses Memberikan Assessment!",
                            showConfirmButton: false,
                            timer: 2000
                        })
                        setTimeout(function() {
                            window.location.href = "give_assessment_bem.php";
                        }, 2000);
                    } else if (res == 'false') {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",
                            showConfirmButton: false,
                            timer: 3500
                        })
                        setTimeout(function() {
                            window.location.href = "give_assessment_bem.php";
                        }, 3500);
                    }
                }
            });
        }
    }

    function toggleFungsionaris() {
        $("#mahasiswa").html('<option value="">Harap tunggu...</option>');
        $.ajax({
            url: "phps/get_list_mahasiswa_bem.php",
            method: "POST",
            success: function(res) {
                console.log(res);
                $("#mahasiswa").html('<option value="">Pilih fungsionaris...</option>' + res);
                if (res.length == 0) {
                    $('#list-mhs').prop('hidden', true);
                    $("#done-acara").removeAttr('hidden');
                    $(".assessment-container").prop('hidden', true);
                } else {
                    $('#done-acara').prop('hidden', true);
                    $("#list-mhs").removeAttr('hidden');
                }
            }
        });
    }

    toggleFungsionaris();

    function toggleAssessment() {
        $(".container-menu").css({
            'overflow-y': 'scroll'
        });
        $(".form-check-input").prop("checked", false);
        $(".spinner-border").prop("hidden", false);
        $(".mhs-desc").prop("hidden", true);
        if ($("#mahasiswa").val() == "") {
            $(".assessment-container").prop('hidden', true);
        } else {
            $(".assessment-container").removeAttr('hidden');
            var id_mhs = $("#mahasiswa").val();
            $.ajax({
                url: "phps/get_mahasiswa.php",
                data: {
                    id_mhs: id_mhs,
                    bem: 1
                },
                method: "POST",
                success: function(res) {
                    $(".spinner-border").prop("hidden", true);
                    $(".mhs-desc").prop("hidden", false);
                    var values = $.parseJSON(res);
                    $(".nama").html(values.nama);
                    if (values.jabatan == "Kepala Departemen" || values.jabatan == "Wakil Kepala Departemen" || values.jabatan == "Anggota Departemen" || values.jabatan == "Internship") {
                        if (values.jabatan == "Internship") {
                            $("#jabatan").html(values.jabatan + " BEM");
                        } else {
                            $("#jabatan").html(values.jabatan);
                        }
                        $("#departemen").html(values.departemen);
                        $("#bidang").html("Bidang " + values.id_bidang);
                    } else if (values.jabatan == "Kepala Bidang" || values.jabatan == "Wakil Kepala Bidang") {
                        $("#jabatan").html(values.jabatan + " " + values.id_bidang);
                        $("#departemen").html("");
                        $("#bidang").html("");
                    } else {
                        $("#jabatan").html(values.jabatan);
                        $("#departemen").html("");
                        $("#bidang").html("Bidang " + values.id_bidang);
                    }

                    if ($("#jabatan").html() == 'Internship BEM') {
                        console.log('masuk');
                        $(".subject").html('Internship BEM');
                    } else {
                        $(".subject").html('Fungsionaris');
                    }
                }
            });
        }
    }

    function etikaTestimoni() {
        $.confirm({
            title: '<span style="color:#3C6CB4;">Etika Memberikan Testimoni</span>',
            typeAnimated: true,
            theme: 'modern',
            draggable: false,
            columnClass: "col-md-6",
            buttons: {
                cancel: {
                    text: 'Saya Mengerti',
                    btnClass: 'saya-mengerti'
                }
            },
            content: `
                <div style="color: #3C6CB4; font-size: 14pt;">
                    <p style="text-align: center;">Berikan <b>kesan, pesan, apresiasi, maupun kritik </b>yang <b>positif</b> serta <b>membangun</b> selama berproses bersama di BEM UK Petra periode 2023/2024. Penilaian dan testimoni yang Anda berikan pada halaman ini akan bersifat <b>anonim</b> bagi Mahasiswa/i yang diberikan penilaian dan testimoni.<br><br>
                    <span style="color: red; font-weight: bold;">Dilarang mengandung unsur pornografi, fitnah, pencemaran nama baik, dan pelanggaran SARA! NRP dan nama Anda akan tercantum di database BEM UK Petra.</span>
                </p>
                </div>
            `
        });
    }

    function announcement() {
        $.confirm({
            title: '<span style="color:#3C6CB4;">Announcement</span>',
            typeAnimated: true,
            theme: 'modern',
            draggable: false,
            columnClass: "col-md-7",
            buttons: {
                cancel: {
                    text: 'Close',
                    btnClass: 'saya-mengerti'
                }
            },
            content: `
                <div style="color: #3C6CB4; font-size: 14pt;">
                    <p style="text-align: center;">
                        Penilaian dan testimoni yang diberikan melalui Penilaian Kuartal I BEM 2023/2024 <b>tidak akan ditampilkan</b> pada profil R E A C H. Semangat dalam memberikan penilaian dan testimoni untuk teman-teman semuanya! 😁
                    </p>
                </div>
            `
        });
    }
</script>

</html>