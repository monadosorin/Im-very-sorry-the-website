<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'HaveanEvent';
require_once './header.php';
?>

<style>
    html {
        scroll-behavior: smooth;
    }

    body {
        background-image: url(assets/background/cv.png);
    }

    ::-webkit-scrollbar {
        width: 8px;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #c55d50;
    }

    ::-webkit-scrollbar-thumb {
        background: #fdcd5f;
        background-clip: padding-box;
    }

    .jconfirm-content {
        max-height: 50vh;
        padding: 15px;
    }

    .jconfirm.jconfirm-modern .jconfirm-box div.jconfirm-title-c {
        padding-bottom: 0 !important;
    }

    .animate__animated.animate__shakeY {
        --animate-duration: 5s;
    }

    .link {
        text-decoration: none;
        color: #FDCD5F;
        font-weight: bold;
    }

    .link:hover {
        color: #FDCD5F;
        text-decoration: none;
    }

    .content_header_container {
        height: 90vh;
        display: grid;
        place-items: center;
    }

    #content_header_title {
        text-align: center;
        color: #FDCD5F;
        font-weight: bold;
        font-size: 70px;
        font-size: 1.75rem;
    }

    @media only screen and (max-width: 768px) {
        .list_content {
            padding: 0px 25px 0px 25px;
        }

        body {
            background-image: none;
            background: #C55D50;
        }

        #content_header_title {
            font-size: 1.75rem;
        }
    }
    .wrapper{height:calc(100vh - 80px);width:100vw;}
    .container-menu{overflow-x:hidden;
        height:100%;position:relative;display:grid;place-items:center;
        margin-right:0!important;margin-left:0!important;width:100%;
        max-width:unset!important;overflow-y:scroll;padding:0!important;margin-bottom:0!important}
    .menu .container-menu{background-color:#c55d50}
    .menu{display:grid;place-items:center;grid-template-rows:50px auto;height:95%;position:relative;padding:35px;overflow-x:hidden}
    .footer-container{display:grid;place-items:center}
    .footer-svg{width:200px}.bar{width:100%;height:100%;background-color:#d67c57;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}
    .close-menu{background-color:#fdcd5f;left:0;height:100%;display:grid;place-items:center;
        width:50px;color:#3c6cb4;font-size:24pt;grid-column:1;transition:.5s}
    .close-menu:hover{transition:.5s;background-color:red;color:#fff}
    .content-container{color:#3c6cb4;z-index:2}.cv-text{letter-spacing:5px;color:#fdcd5f;margin-bottom:0;grid-column:2}
    .bg-profile{top:0;z-index:1;position:relative;object-fit:cover}
    label{color:#fff}
    input,select,textarea{border:none!important;border-radius:10px!important;color:#fff!important}
    ::placeholder{color:#fdcd5f!important;opacity:1}:-ms-input-placeholder{color:#fdcd5f!important}
    ::-ms-input-placeholder{color:#fdcd5f!important}
    #search_mhs::placeholder{color:#3c6cb4!important;opacity:1}
    #search_mhs:-ms-input-placeholder{color:#3c6cb4!important}
    #search_mhs::-ms-input-placeholder{color:#3c6cb4!important}
    .container-menu::-webkit-scrollbar{width:15px}
    .container-menu::-webkit-scrollbar-track{background:#c55d50}
    .container-menu::-webkit-scrollbar-thumb{background:#fdcd5f;border-right:8px #c55d50 solid;border-top:10px #c55d50 solid;border-bottom:10px #c55d50 solid;background-clip:padding-box}
    .bg-mobile{display:none}
    .display-photo{width:40%;height:calc(100vh - calc(100vh - 100%))}
    @media screen and (max-width:767px){.bg-mobile{display:block}
    .display-photo{width:80%}
}
    @media screen and (max-width:992px){.cv-text{font-size:14pt}
}
    @media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}
}
}
    @media only screen and (min-width:768px) and (orientation:portrait){@supports (-webkit-touch-callout:none){.wrapper{height:94%;position:fixed}
}
}
    @media screen and (max-width:768px){.wrapper{height:90%;position:fixed}
    @supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}
}
    .menu{padding:20px}
}
    .bg-container{top:0;left:0;width:100%;position:absolute}
    .jconfirm-box-container .jconfirm-box{background-image:url(assets/background/details.png);background-size:cover;box-shadow:none!important}
    input::-webkit-inner-spin-button,input::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}
    input[type=number]{-moz-appearance:textfield}
    .btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;font-weight:700;-webkit-appearance:none}
    .btn:hover{transition:.3s;background:#3660a2;color:#fff}
    .btn-red{border-radius:25px!important}
    .display-photo{border:5px dashed #f9cd5f}
    ::-webkit-calendar-picker-indicator{background-image:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 24 24"><path fill="white" d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z"/></svg>')}
    #submit-button{color:#000!important;border-radius:25px!important}
    #submit-button:hover{color:#fff!important}
    .menu{overflow:hidden}
    .jconfirm-content{max-height:50vh;padding:15px;}
    .jconfirm.jconfirm-modern .jconfirm-box div.jconfirm-title-c{padding-bottom:0!important;}
    .jconfirm-content::-webkit-scrollbar{width:8px;border-radius:10px}
    .jconfirm-content::-webkit-scrollbar-track{background:#c55d50}
    .jconfirm-content::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}
    .navbar-toggler{
        display: none;
    }

</style>

<body>
    <div class="container">
        <div class="content_header_container">
            <div class="content_header_text" data-aos="zoom-in">
                <div class="row">
                    <div class="col-12 align-self-center" style="display:flex;flex-direction:column;">
                        <h1 id="content_header_title">Add Event</h1>
                        <a onclick="aturanPenamaan()" class="btn btn-danger mt-1" style="margin:auto;">PENTING: Aturan Penamaan Acara</a>
                    </div>
                </div>
                <div class="row" style="width:78vw">
                    <!-- Form add acara -->
                    <form method="post" id="add_event" style="width:100%">
                        <div class="col-sm-12 col-md-8 offset-md-2">
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="nama" style="font-weight: bold;">Nama dan Tahun Acara</label></center>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Ex: Spetrakuler 2021" style="height:40px; font-size: 12pt; text-align: center;background: #d67c55;" minlength="3" maxlength="40" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="tahun" style="font-weight: bold;">Tahun Acara</label></center>
                                        <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Ex: 2021" style="height:40px; font-size: 12pt; text-align: center;background: #d67c55;" minlength="3" maxlength="40" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="nama" style="font-weight: bold;">Status Acara</label></center>
                                        <select class="form-select form-control" aria-label="Default select example" id="status" name="status" style="background:#d67c55;" required>
                                            <option selected>-- Pilih status --</option>
                                            <option value="openrec">Openrec</option>
                                            <option value="closerec">Closerec</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center><label for="penyelenggara" style="font-weight: bold;">Penyelenggara Acara</label></center>
                                        <select class="form-control" id="penyelenggara" name="penyelenggara" style="height:40px; font-size: 12pt;background: #d67c55 !important;" required onchange="cekPenyelenggara()">
                                            <option selected>-- Pilih Penyelenggara --</option>
                                            <option value="BEM UK Petra">BEM UK Petra</option>
                                            <!-- <option value="PERSMA">PERSMA</option>
                                            <option value="TPS">TPS</option>
                                            <option value="PELMA">PELMA</option>
                                            <option value="HIMAKOMTRA">HIMAKOMTRA</option>
                                            <option value="HIMABAMATRA">HIMABAMATRA</option>
                                            <option value="HIMASAINTRA">HIMASAINTRA</option>
                                            <option value="HIMAVISTRA">HIMAVISTRA</option>
                                            <option value="HIMAINTRA">HIMAINTRA</option>
                                            <option value="HIMATANTRA">HIMATANTRA</option>
                                            <option value="HIMAJAKTRA">HIMAJAKTRA</option>
                                            <option value="HIMASINTRA">HIMASINTRA</option>
                                            <option value="HIMABINTRA">HIMABINTRA</option>
                                            <option value="HIMAMATRA">HIMAMATRA</option>
                                            <option value="HIMAPATRA">HIMAPATRA</option>
                                            <option value="HIMAKETRA">HIMAKETRA</option>
                                            <option value="HIMAHOTTRA">HIMAHOTTRA</option>
                                            <option value="HIMAPASTRA">HIMAPASTRA</option>
                                            <option value="HIMAGUDATRA">HIMAGUDATRA</option>
                                            <option value="HIMAARTRA">HIMAARTRA</option>
                                            <option value="HIMASITRA">HIMASITRA</option>
                                            <option value="HIMATEKTRA">HIMATEKTRA</option>
                                            <option value="HIMATITRA">HIMATITRA</option>
                                            <option value="HIMAINFRA">HIMAINFRA</option> -->
                                            <option value="other">other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- KALAU LUAR BEM -->
                            <div class="acara-luar-bem" style="display:none;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <center><label for="penyelenggara-luar" style="font-weight: bold;">Nama Penyelenggara Acara</label></center>
                                            <input type="text" class="form-control" id="penyelenggara-luar" name="penyelenggara-luar" style="font-size: 12pt;  text-align: center;background: #d67c55 !important;" rows="1" placeholder="Ex: UKM Martografi & HIMABINTRA" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <center><label for="linkproposal" style="font-weight: bold;">Link Proposal</label></center>
                                            <input type="text" class="form-control" id="linkproposal" name="linkproposal" style="font-size: 12pt;  text-align: center;background: #d67c55 !important;" rows="1" placeholder="Ex: https://docs.google.com/document/d/16t0iMzYqNbxojpKqo3hxiS2eGmwFgjnulqpEOqyUE/edit?usp=sharing" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END KALAU LUAR BEM -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center><label for="tipe" style="font-weight: bold;">Tipe Acara</label></center>
                                        <input type="text" class="form-control" id="tipe" name="tipe" style="font-size: 12pt;  text-align: center;background: #d67c55 !important;" rows="1" placeholder="Ex: Sesuai Tipe pada Proposal" maxlength="200" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center><label for="urlAcara" style="font-weight: bold;">URL Lengkap Acara</label></center>
                                        <input type="text" class="form-control" id="urlAcara" name="urlAcara" style="font-size: 12pt;  text-align: center;background: #d67c55 !important;" rows="1" placeholder="Ex: http://bem.petra.ac.id/spetrakuler/openrec/ atau https://www.instagram.com/spetrakuler/" maxlength="200" required>
                                    </div>
                                </div>
                            </div>

                            <div class="btn-container" >
                                <center>
                                    <button class="submit btn btn-warning mb-5" data-callback='onSubmit' type='submit' id='submit-button'>Submit</button>
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

        
    </div>

    <script>
        function aturanPenamaan() {
            data =
                `
                <div>
                <center style="color: black; font-size: 12pt; max-height: 300px;">
                    <p style="font-size: 14pt;"><b>CONTOH YANG <span style="color: red;">SALAH</span></b></p>
                    <p>PCC <span style="color: red; font-weight: bold;">(SALAH) <i class="fas fa-times"></i></span></p>
                    <p>PCC 2021 <span style="color: red; font-weight: bold;">(SALAH) <i class="fas fa-times"></i></span></p>
                    <p>Petra Chess Competition <span style="color: red; font-weight: bold;">(SALAH) <i class="fas fa-times"></i></span></p>
                    <br>
                    <p style="font-size: 14pt;"><b>CONTOH YANG <span style="color: green;">BENAR</span></b></p>
                    <p style="text-transform: capitalize;"><b>Petra Chess Competition 2021  </b><span style="color: green; font-weight: bold;">(BENAR) <i class="fas fa-check"></i></span></p>
                    <br>
                    <p style="font-size: 14pt;"><b>Kok Gitu Yah?</b></p>
                    <p>Supaya nama acara tidak double untuk assessment acara tahun berikutnya maka harus diberikan tahun acara di belakang nama acara dan jangan disingkat yah guys!</p>
                </center>
            </div>
            `;

            $.confirm({
                title: "Aturan Penamaan Acara",
                theme: "modern",
                columnClass: "col-12 col-md-8",
                buttons: {
                    cancel: {
                        text: "Close",
                        btnClass: "btn-red"
                    }
                },
                content: data
            });
        }
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> -->
    <script>
        AOS.init();
        $(".container").on('scroll', function() {
            AOS.refresh();
        });
        cekPenyelenggara();
        function cekPenyelenggara(){
            var object = document.querySelector('.acara-luar-bem')
            var penyelenggara = document.querySelector("#penyelenggara").value;
            if(penyelenggara == 'other'){
                object.style.display = 'block';
                setRequired(true)
            }else if(penyelenggara == 'BEM UK Petra'){
                object.style.display = 'none';
                setRequired(false)
            }else{
                object.style.display = 'none';
                setRequired(false)
            }
        }
        function setRequired(val){
            input = document.querySelector('.acara-luar-bem').getElementsByTagName('input');
            for(i = 0; i < input.length; i++){
                input[i].required = val;
            }
        }
        $(document).ready(function(){
            $('#add_event').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "phps/add_event_public.php",
                    data: $(this).serialize(),
                    success: function (response) {
                        if(response == 'play'){
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/invalid_2.gif",
                                imageHeight: 150,
                                title: "Don\'t Play-Play Bosque!",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }else if(response == 'login'){
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/invalid_2.gif",
                                imageHeight: 150,
                                title: "Mohon Login Terlebih Dahulu!",
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                window.location.href = 'login.php';}
                                )
                        }else if (response == 'tahun'){
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/bye_9.gif",
                                imageHeight: 150,
                                title: "Tolong berikan tahun acara yang benar. (4 digit angka)",
                                showConfirmButton: false,
                            })
                        }
                        else if(response == 'berhasil'){
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/success_1.gif",
                                imageHeight: 150,
                                title: "Sukses Menyimpan Acara!",
                                html: "Silahkan menghubungi PIC Reach melalui LINE (ID: <a class='link' href='http://line.me/ti/p/~michelle.callista' target='_blank'>michelle.callista</a>)",
                                showConfirmButton: false,
                            }).then((result) => {
                                   window.history.back();
                            })
                        }else if(response == 'urlAcara'){
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/bye_9.gif",
                                imageHeight: 150,
                                title: "Tolong berikan URL Acara yang benar. (Diawali http: atau https)",
                                showConfirmButton: false,
                            })
                        }else if(response == 'docs'){
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/bye_9.gif",
                                imageHeight: 150,
                                title: "Tolong berikan link proposal yang benar. (Diawali https://docs.google.com/document/)",
                                showConfirmButton: false,
                            })
                        }
                        else if(response == 'sudah'){
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/bye_3.gif",
                                imageHeight: 150,
                                title: "Mohon maaf, Nama Acara telah digunakan",
                                showConfirmButton: false,
                            })
                        }
                        else if(response.includes('berhasil')){
                            parts = response.split('=');
                            token = parts[1]
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/success_1.gif",
                                imageHeight: 150,
                                title: "Sukses Menyimpan Acara! Berikut Token untuk Biro : "+token,
                                // text: "Token juga dikirimkan lewat email",
                                text: 'Silahkan disimpan dengan baik.',
                                showConfirmButton: false,
                            }).then((result) => {
                                   window.history.back();
                            })
                        }
                        // TODO else if token biro
                        else if(response == 'gagal'){
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/server_error.gif",
                                imageHeight: 150,
                                title: "Terjadi Error di Server!<br>Silakan Coba Ulangi Kembali",
                                showConfirmButton: false,
                            })
                        }else{
                            Swal.fire({
                                position: "center",
                                imageUrl: "./assets/gif/server_error.gif",
                                imageHeight: 150,
                                title: "Terjadi Error di Server!<br>Silakan Coba Ulangi Kembali",
                                showConfirmButton: false,
                            })
                        }
                    }
                    ,error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            position: "center",
                            imageUrl: "./assets/gif/server_error.gif",
                            imageHeight: 150,
                            title: "Terjadi Error di Server!<br>Silakan Coba Ulangi Kembali",
                            showConfirmButton: false,
                            text: 'Error Code : ' +xhr.status,
                        })
                    }
                });
            })
            $('.navbar').append(`
                <div onclick="window.history.back()" style="font-size:1.5rem;padding-right:35px;color:#3c6cb4;cursor:pointer;"><i class="fas fa-arrow-left"></i> Back</div>
            `)
        })
    </script>

</body>

</html>