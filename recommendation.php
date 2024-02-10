<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'recommendation';
require_once './header.php';
?>

<style>
    .card{transition:.5s;background-color:#d67c55!important;border-radius:25px!important}.card-img-top{border-radius:25px 25px 0 0!important}.card:hover{transition:.5s;transform:scale(1.1)}.card-text{color:#fff}body{background-image:url(assets/background/cv.png);background-color:#c55d50}.carousel-control-next-icon,.carousel-control-prev-icon{height:100px;width:100px;background-size:50%,50%}.carousel-inner>.item{position:relative;display:none;-webkit-transition:10ms ease-in-out left;-moz-transition:10ms ease-in-out left;-o-transition:10ms ease-in-out left;transition:10ms ease-in-out left}::-webkit-scrollbar{width:8px;border-radius:10px}::-webkit-scrollbar-track{background:#c55d50}::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}.dept-logo{width:60px;padding:1px}.sorry{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)}@media screen and (max-width:768px){body{background-image:none;background-color:#c55d50}.sorry{position:static;top:0;left:0;transform:none;display:grid;place-items:center;margin-top:5%;padding:0 20px}}.btn-red{border-radius:40px!important;background-color:#dc3545!important;color:#fff!important;transition:.3s!important}.btn-red:hover{transition:.3s;color:#fdcd5f}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;-webkit-appearance:none;font-weight:700}.btn:hover{transition:.3s;background:#7c6ed1;color:#fff}
</style>

<?php
if ($rowMahasiswa['status'] != 0) {
?>
    <style type="text/css">
        @keyframes ldio-7xufn7u97p6{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}.ldio-7xufn7u97p6>div>div{transform-origin:100px 100px;animation:ldio-7xufn7u97p6 3.0303030303030303s linear infinite;opacity:.8}.ldio-7xufn7u97p6>div>div>div{position:absolute;left:30px;top:30px;width:70px;height:70px;border-radius:70px 0 0 0;transform-origin:100px 100px}.ldio-7xufn7u97p6>div div:nth-child(1){animation-duration:.7575757575757576s}.ldio-7xufn7u97p6>div div:nth-child(1)>div{background:#e15b64;transform:rotate(0)}.ldio-7xufn7u97p6>div div:nth-child(2){animation-duration:1.0101010101010102s}.ldio-7xufn7u97p6>div div:nth-child(2)>div{background:#f47e60;transform:rotate(0)}.ldio-7xufn7u97p6>div div:nth-child(3){animation-duration:1.5151515151515151s}.ldio-7xufn7u97p6>div div:nth-child(3)>div{background:#f8b26a;transform:rotate(0)}.ldio-7xufn7u97p6>div div:nth-child(4){animation-duration:3.0303030303030303s}.ldio-7xufn7u97p6>div div:nth-child(4)>div{background:#abbd81;transform:rotate(0)}.loadingio-spinner-wedges-n24ir3anbsf{width:200px;height:200px;display:inline-block;overflow:hidden}.ldio-7xufn7u97p6{width:100%;height:100%;position:relative;transform:translateZ(0) scale(1);backface-visibility:hidden;transform-origin:0 0}.ldio-7xufn7u97p6 div{box-sizing:content-box}
    </style>
<?php
}
?>

<body>
    <div class="container">
        <?php
        if ($rowMahasiswa['status'] == 0) {
        ?>
            <div class="sorry justify-content-center">
                <h1 style="text-align: center; letter-spacing: 5px; color: #FDCD5F;font-weight: 500;">MOHON MAAF</h1>
                <h5 style="text-align: center; color: white;" class="mt-3">Silakan mengisi Curriculum Vitae (CV) di halaman <a href="profile.php" style="text-decoration: none; color: #FDCD5F; font-weight: bold;">Profile</a> terlebih dahulu untuk dapat mengakses halaman ini.</h5>
                <h5 style="text-align: center; color: white;" class="mt-3">Melalui halaman <span style="text-decoration: none; color: #FDCD5F; font-weight: bold;">Explore</span>, kamu dapat melihat lebih dari <span style="text-decoration: none; color: #FDCD5F; font-weight: bold;"><?= intval(getPetranesiansHitzCount() / 10) * 10 ?></span> profil Petranesians lain yang sudah terhubung di <span style="color: #FDCD5F; font-weight: bold;">R E A C H</span>, lho. Jadi, tunggu apalagi? Yuk, segera isi CV-mu di halaman <a href="profile.php" style="text-decoration: none; color: #FDCD5F; font-weight: bold;">Profile</a> yah, Petranesian! &#128588;</h5>
                <center class="row my-5 justify-content-center">
                    <img class="dept-logo" src="./assets/image/HRD.png" alt="HRD">
                    <img class="dept-logo" src="./assets/image/IS.png" alt="IS">
                    <img class="dept-logo" src="./assets/image/SNC.png" alt="SNC">
                </center>
            </div>
        <?php
        } else {
        ?>
            <div data-aos="fade-up">
                <div class="title-row mx-2">
                    <h2 class="title" style="color: #FDCD5F; letter-spacing: 5px;">Explore Petranesians</h2>
                    <h6 class="title" style="color: #FDCD5F; letter-spacing: 5px;">click on Petranesian to see the profile!</h6>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-5 mt-3">
                        <select class="form-control" id="filter_divisi" name="filter_divisi" style="height:40px; font-size: 12pt; background-color:#D67C55;color:white; border-radius:25px!important;border:none;" onchange="toggleFilter()">
                            <option value="">Cari berdasarkan divisi...</option>
                            <option value="Acara">Acara</option>
                            <option value="PDD">PDD</option>
                            <option value="Sekretariat">Sekretariat</option>
                            <option value="Public Relation">Public Relation</option>
                            <option value="Perlengkapan">Perlengkapan</option>
                            <option value="Konsumsi">Konsumsi</option>
                            <option value="IT">IT</option>
                            <option value="Sponsor">Sponsor</option>
                            <option value="Keamanan">Keamanan</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Materi">Materi</option>
                            <option value="Peran">Peran</option>
                            <option value="Asisten Tutor">Asisten Tutor</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-5 mt-3">
                        <select class="form-control" id="filter_angkatan" name="filter_angkatan" style="height:40px; font-size: 12pt; background-color:#D67C55;color:white; border-radius:25px!important;border:none;" onchange="toggleFilter()" hidden>
                            <option value="">Lihat berdasarkan angkatan...</option>
                            <?php getBatchList() ?>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <p class="mt-3" style="color: #FDCD5F; font-size: 12pt;" id="not-found" hidden>Belum Ada Data</p>
                </div>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" hidden>
                    <div class="carousel-inner py-5" style="height: 720px;">

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="row mx-2 justify-content-center mb-5">
                    <center><a onclick="disclaimer()" class="btn btn-danger mt-1" style='width: 150px;'>Disclaimer</a></center>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <script>
        <?php
        if ($rowMahasiswa['status'] != 0) {
        ?>
            function disclaimer(){$.confirm({title:'<span style="color: #3C6CB4;">Disclaimer</span>',theme:"modern",columnClass:"col-12 col-md-8",buttons:{cancel:{text:"CLOSE",btnClass:"btn-red"}},content:'\n                <center style="max-height: 300px; color: #3C6CB4; font-size: 14pt;">\n                    Data yang ditampilkan pada hasil pencarian divisi <b>tidak 100% akurat</b>. Sistem akan menampilkan profil Petranesians berdasarkan <b>acara kepanitiaan yang sudah pernah dilakukan input</b> oleh Departemen HRD BEM UK Petra pada <b>database REACH</b> dan berdasarkan <b>Pengalaman Organisasi dan Kepanitiaan</b> yang dilakukan input Petranesians pada halaman <a href="./profile.php" target="_blank" style="text-decoration: none; font-weight: bold; color: #3C6CB4">Profile</a>. Silakan menampilkan <b>salah satu kata kunci</b> di bawah ini pada kolom <b>Pengalaman Organisasi dan Kepanitiaan</b> untuk membantu Petranesians agar dapat ditampilkan sesuai divisi yang sudah pernah Petranesians ambil atau tertarik dengan divisi yang bersangkutan.<br><br>\n                    <span style="font-weight: bold; font-size: 16pt;">Kata Kunci</span><br>\n                    <b>Acara</b> — <i>acara, mc, master of ceremony, event</i><br>\n                    <b>PDD</b> — <i>pdd, pubdekdok, publikasi, publication, dekorasi, dekor, decoration, dokumentasi, documentation, layout, illustration, ilustrasi, layout & illustration, fotografer, photography, creative</i><br>\n                    <b>Sekretariat</b> — <i>sekretaris, sekretariat, sekret, sekkon, sekon, sekkonkes, sekonkes, secretary, sekben, gsab</i><br>\n                    <b>Public Relation</b> — <i>pr, public relation, humas, hubungan masyarakat, pubsek, pubsekhum</i><br>\n                    <b>Perlengkapan</b> — <i>perkapman, transkapman, transakap, perlengkapan, perkap, supply, equipment</i><br>\n                    <b>Konsumsi</b> — <i>konsumsi, konsum, sekkon, sekon, sekkonkes, sekonkes, konkes, consumption</i><br>\n                    <b>IT</b> — <i>it, information, informasi, technology, teknologi, sistem, system, sistem informasi, teknologi informasi, information technology, information system</i><br>\n                    <b>Sponsor</b> — <i>sponsor, sponsorship, dana, danus, dana usaha</i><br>\n                    <b>Keamanan</b> — <i>keamanan, transkaman, transkapman, perkapman, tata aturan, security</i><br>\n                    <b>Kesehatan</b> — <i>kesehatan, konkes, sekkonkes, sekonkes, health</i><br>\n                    <b>Materi</b> — <i>materi, material</i><br>\n                    <b>Peran</b> — <i>peran, frontline, front line, fl</i><br>\n                    <b>Asisten Tutor</b> — <i>asisten tutor, astor, tutor assistant</i><br>\n                </center>\n            '})}function toggleFilter(){""!=$("#filter_divisi").val()?($(".carousel").prop("hidden",!1),$("#filter_angkatan").prop("hidden",!1),$(".carousel-inner").html("<center><div class='loadingio-spinner-wedges-n24ir3anbsf'><div class='ldio-7xufn7u97p6'><div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div></div></div></center>"),setTimeout(function(){var a=$("#filter_divisi").val(),n=$("#filter_angkatan").val();$.ajax({url:"phps/refresh_data.php",type:"get",dataType:"json",data:{id:15,divisi:a,angkatan:n},success:function(a){var n=a;if(n.length>0){$("#not-found").prop("hidden",!0),$(".carousel").prop("hidden",!1);for(var e="",i=0;i<n.length;i++){var t=n[i],r=t.jurusan.substr(0,t.jurusan.indexOf("-")),s=t.jurusan.split("-").pop();e+=0!=i?'\n                                <div class="carousel-item">\n                            ':'\n                                <div class="carousel-item active">\n                            ',e+='\n                            <center>\n                                <div class="card mx-2 shadow bg-white rounded" style="width: 18rem;">\n                                    <a href="view_profile.php?nrp='+t.nrp+'" target="_blank" style="text-decoration: none; color: black;">\n                        ',0==i||1==i||i==n.length-1?e+='\n                                        <img class="card-img-top" src="uploads/cv_photo/'+t.photo_filepath+'" alt="'+t.nama+'" style="max-height: 450px;">\n                            ':e+='\n                                        <img loading="lazy" class="card-img-top" src="uploads/cv_photo/'+t.photo_filepath+'" alt="'+t.nama+'" style="max-height: 450px;">\n                            ',e+='\n                                        <div class="card-body">\n                                            <div class="row justify-content-center mx-2">\n                                                <h5 style="font-weight: bold; color: #FDCD5F;">'+t.nama+'</h5>\n                                            </div>\n                                            <div class="row mt-2 justify-content-center">\n                                                <p class="card-text">'+r+'</b></p>\n                                            </div>\n                                            <div class="row justify-content-center">\n                                                <p class="card-text">'+s+'</p>\n                                            </div>\n                                            <div class="row mt-2 justify-content-center">\n                                                <p class="card-text">'+t.angkatan+"</p>\n                                            </div>\n                                        </div>\n                                    </a>\n                                </div>\n                            </center>\n                        </div>\n                        ",1}$(".carousel-inner").html(e)}else $(".carousel").prop("hidden",!0),$("#not-found").prop("hidden",!1)},error:function(a){alert("Mohon maaf, terjadi error di server. Silakan coba ulangi kembali.")}})},1e3)):($(".carousel").prop("hidden",!0),$("#filter_angkatan").prop("hidden",!0),$("#filter_angkatan").val(""))}$(".carousel").bind("slide.bs.carousel",function(a){var n=$(".active.carousel-item",this).prev(".carousel-item").prev(".carousel-item"),e=$(".active.carousel-item",this).prev(".carousel-item").prev(".carousel-item").prev(".carousel-item");prevImage1=n.find("img").removeAttr("loading"),prevImage2=e.find("img").removeAttr("loading");var i=$(".active.carousel-item",this).next(".carousel-item").next(".carousel-item"),t=$(".active.carousel-item",this).next(".carousel-item").next(".carousel-item").next(".carousel-item");nextImage1=i.find("img").removeAttr("loading"),nextImage2=t.find("img").removeAttr("loading")});var tooltipTriggerList=[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')),tooltipList=tooltipTriggerList.map(function(a){return new bootstrap.Tooltip(a)});
        <?php
        }
        ?>
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>