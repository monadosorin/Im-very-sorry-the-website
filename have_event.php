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
    }
    .pilihan-btn:hover, .pilihan-btn:active, .pilihan-btn:focus {
        background-color: #c45c54;
        color: #fbebd3;

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
            font-size: 50px;
        }
    }
   
</style>

<body>
    <div class="container">
        <div class="content_header_container">
            <div class="content_header_text" data-aos="zoom-in">
                <div class="row">
                    <div class="col-12">
                        <h1 id="content_header_title">Have an Event?</h1>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 style="text-align: center; color: white; font-size: 25px;">
                            Kamu ketua sebuah kegiatan dan ingin kepanitiaanmu dinilai di RE-ACH? Berikut beberapa langkah yang bisa kamu ikuti!
                        </h3>
                    </div>
                </div>
                <div class="row" style="margin-top: 10vh;">
                    <div class="col-12" style="text-align: center;">
                        <a href="#content">
                            <i class="fas fa-chevron-double-down fa-4x scroll animate__animated animate__shakeY animate__infinite infinite" style="color: white;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content_container">
            <div class="row mb-5" id="content">
                <div class="list_content col-12 col-md-6 mt-3" style="font-size: 25px; color: white;" data-aos="fade-up">
                    <h1 style="font-size: 70px; font-weight: bold; color: #FDCD5F;">1</h1>
                    <p>
                        Ketua kegiatan diharapkan dapat dikontak untuk dapat mengurus segala sesuatu yang berhubungan dengan RE-ACH dari awal hingga acara selesai.
                    </p>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-6"></div>
                <div class="list_content col-12 col-md-6" style="font-size: 25px; text-align: right; color: white;" data-aos="fade-up">
                    <h1 style="font-size: 70px; font-weight: bold; color: #FDCD5F;">2</h1>
                    <p>
                        Ketua kegiatan wajib melengkapi informasi mengenai kegiatan pada Form <a class="link" href="manage_event.php">berikut</a>. Bagi acara yang tidak diselenggarakan oleh BEM UK Petra, setelah mengisi form silahkan menghubungi PIC Reach melalui LINE (ID: <a class="link" href="http://line.me/ti/p/~michelle.callista" target="_blank">michelle.callista</a>).
                    </p>
                </div>
            </div>

            <div class="row mb-2">
                <div class="list_content col-12 col-md-6" style="font-size: 25px; color: white;" data-aos="fade-up">
                    <h1 style="font-size: 70px; font-weight: bold; color: #FDCD5F;">3</h1>
                    <p>
                        Jika susunan panitia kegiatan sudah lengkap, ketua kegiatan wajib melengkapi data panitia di template excel yang terdapat di link <a class="link" href="http://petra.id/REACH_TemplateDaftarPanitia" target="_blank">berikut</a>. Dan submit file excel pada tombol hijau dibawah ini.
                    </p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="list_content col-12 col-md-6" style="font-size: 25px; color: white;" data-aos="fade-up">
                    <center>
                        <a onclick="aturanPenamaan()" class="btn btn-danger mb-3" style="width: 80%;">PENTING: Panduan Pengisian Excel Panitia</a>
                        <a onclick="tambahExcelPanitia()" class="btn btn-success mb-3" style="width: 80%;">Silahkan Submit Excel Panitia Disini</a>
                    </center>       
                    <p style="font-size: 15px; text-align: center;">
                        <b>Catatan:</b> Sangat disarankan bagi ketua kegiatan untuk melengkapi data panitia segera setelah proposal keluar dari BAKA/setelah proses open recruitment selesai agar data dapat segera dimasukkan ke dalam database.
                    </p>
                </div>
            </div>

            <!-- <div class="row mb-5">
                <div class="col-md-6"></div>
                <div class="list_content col-12 col-md-6" style="font-size: 25px; text-align: right; color: white;" data-aos="fade-up">
                    <h1 style="font-size: 70px; font-weight: bold; color: #FDCD5F;">4</h1>
                    <p>
                        ketua kegiatan wajib melakukan follow-up kepada PIC HRD melalui LINE (ID: <a class="link" href="http://line.me/ti/p/~michelle.callista" target="_blank">michelle.callista</a>) setelah mengisi maupun mengubah data pada Form.
                    </p>
                </div>
            </div> -->
        </div>
    </div>

    <!-- Loader -->
    <style>
        .loader{
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: slategray;
            opacity: .6;
            z-index: 100;
            display: none;
        }
    </style>
    <div class="loader">
        <div style="width: 100%;height:100vh;position:relative;display:flex;justify-content:center;align-items:center;">
            <div class="spinner-border text-warning" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
    </div>
    <script>
        function aturanPenamaan() {
            data =
                `
                <div style = "color: black; text-align: left; font-size: 14pt;"> 
                    <ol>
                        <li>
                            Download terlebih dahulu template yang tersedia dalam bentuk file .xlsx
                        </li>
                        <li>
                            Isi kolom yang tersedia sesuai dengan judul masing-masing kolom mulai dari NRP, Nama Lengkap Panitia, Kode Jabatan (contoh: 1/2/3), dan Divisi.<br>
                            Keterangan untuk kode jabatan:<br>
                            <ul style="list-style-type:circle">
                                <li>
                                    <b>1</b> untuk Badan Pengurus Harian
                                </li>
                                <li>
                                    <b>2</b> untuk Koordinator atau Wakil Koordinator
                                </li>
                                <li>
                                    <b>3</b> untuk Anggota Divisi
                                </li>
                            </ul>
                        </li>
                        <li>
                            Dimohon untuk tidak mengisi kolom kode jabatan dengan nilai selain angka 1, 2, atau 3 untuk mencegah terjadinya error dalam proses penambahan data.
                        </li>
                        <li>
                            Harap jangan mengubah pengaturan pada template Excel termasuk pengaturan warna, border, dsb. karena template sudah diatur sedemikian rupa agar dapat dibaca oleh sistem.
                        </li>
                        <li>
                            Pengisian data juga diharapkan tidak menggunakan fungsi/rumus Excel agar data dapat terbaca oleh sistem.
                        </li>
                        <li>
                            Pastikan data yang diisi sudah final dan akurat sebelum mengisi.
                        </li>
                    </ol>
                </div>
            `;

            $.confirm({
                title: "Panduan Pengisian Excel Panitia",
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
    <script>
        function isJson(str) {
            try {
                JSON.parse(str);
                return true;
            } catch (e) {
                return false;
            }
        }
        var selectedId = null;
        function tambahExcelPanitia() {
                data =
                    `  
                    <div class="btn-group-vertical" role="group" style=>
                    <?php
                    //cuman munculin acara nya dia 
                        $stmt = $pdo->prepare("SELECT * FROM event where nrp_ketua = ?");
                        $stmt->execute([$_SESSION['nrp']]);
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                    if($result):
                        $i=0;
                        foreach($result as $r): ?>
                        <button type="button" class="btn pilihan-btn" onclick="setEventId(<?php echo $r['id']; ?>)" style="border-bottom: 0.5px solid #ccc;"><?php echo $r['name']; ?> 
        
                        <?php 
                        $stmt2 = $pdo->prepare("SELECT * FROM panitia_event where id_event = ?");
                        $stmt2->execute([$r['id']]);
                        if($stmt2->rowCount() > 0):
                        ?>
                            <div class="text-success">Sudah Submit</div>
                        <?php endif; ?>
                        </button>
                        <?php endforeach; 
                    endif;
                    if(!$result): ?>
                        <p style='color: black; text-align: center;'>Tidak ada acara yang tersedia</p>
                    <?php endif; ?>
                    </div>
                `,

                upload =
                `
                <form id="uploadForm" enctype="multipart/form-data">
                    <h5 style="color: black; text-align: center;">Pastikan Format File ".xlsx" atau ".xls"</h5>    
                    <input type="file" id="uploadBtn" name="fileExcel" accept=".xlsx, .xls">
                </form>
                `;

                $.confirm({
                title: "Silahkan Pilih Acara Anda",
                theme: "modern",
                columnClass: "col-12 col-md-8",
                buttons: {
                    finish: {
                        text: "Next",
                        theme: "modern",
                        btnClass: "btn-green",
                        action: function () {
                            $.confirm({
                                title: "Silahkan Upload File Excel Panitia",
                                theme: "modern",
                                columnClass: "col-12 col-md-8",
                                content: upload,
                                buttons: {
                                    confirm: {
                                        text: "Submit",
                                        btnClass: "btn-green",
                                        action: function () {
                                            $('.loader').fadeIn();
                                            var formData = new FormData($("#uploadForm")[0]);
                                            formData.append("id", selectedId);

                                            $.ajax({
                                                url: "phps/get_acaraku.php",
                                                type: "POST",
                                                data: formData,
                                                processData: false,
                                                contentType: false,
                                                success: function (response) {
                                                    $('.loader').fadeOut();
                                                    if(isJson(response)){
                                                        data = JSON.parse(response);
                                                        if(data.status == 1){ 
                                                            Swal.fire({
                                                                position: "center",
                                                                imageUrl: "./assets/gif/success_1.gif",
                                                                imageHeight: 150,
                                                                title: data.msg,
                                                                showConfirmButton: false,
                                                            }).then((result) => {
                                                                location.reload();
                                                            })
                                                        }else if(data.status == 2){
                                                            var stringMsg = '';
                                                            data.invalid_columns.forEach(i => {
                                                                stringMsg += ( i + ', ' )
                                                            });
                                                            Swal.fire({
                                                                position: "center",
                                                                imageUrl: "./assets/gif/bye_9.gif",
                                                                imageHeight: 150,
                                                                title: data.msg,
                                                                text: stringMsg,
                                                                showConfirmButton: false,
                                                            })
                                                        } else if(data.status == 4){
                                                            Swal.fire({
                                                                position: "center",
                                                                imageUrl: "./assets/gif/bye_9.gif",
                                                                imageHeight: 150,
                                                                title: data.msg,
                                                                showConfirmButton: false,
                                                            })
                                                        } else{
                                                            Swal.fire({
                                                                position: "center",
                                                                imageUrl: "./assets/gif/bye_3.gif",
                                                                imageHeight: 150,
                                                                title: data.msg,
                                                                showConfirmButton: false,
                                                            })
                                                        }
                                                    }else{
                                                        Swal.fire({
                                                            position: "center",
                                                            imageUrl: "./assets/gif/bye_3.gif",
                                                            imageHeight: 150,
                                                            title: "Maaf terjadi kesalahan, silahkan hubungi Line PIC kami. Error code : response not json",
                                                            showConfirmButton: false,
                                                        })
                                                    }
                                                },
                                                error: function (xhr, status, error) {
                                                    $('.loader').fadeOut();
                                                    console.error("Terjadi kesalahan:", error);
                                                    Swal.fire({
                                                        position: "center",
                                                        imageUrl: "./assets/gif/bye_3.gif",
                                                        imageHeight: 150,
                                                        title: "Maaf terjadi kesalahan, silahkan hubungi Line PIC kami. Error code :" + error,
                                                        showConfirmButton: false,
                                                    })
                                                }
                                            });
                                        }
                                    },
                                    cancel: {
                                        text: "Cancel",
                                        btnClass: "btn-red"
                                    }
                                }
                            });
                        }
                    },
                    cancel: {
                        text: "Cancel",
                        btnClass: "btn-red"
                    }
                },
                content: data
                });
        }   
        function setEventId(id){
            selectedId =id;
        }
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
        $(".container").on('scroll', function() {
            AOS.refresh();
        });
    </script>

</body>

</html>