<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'database';
require_once './header.php';
?>

<?php
if (isset($_GET['stat'])) {
    if ($_GET['stat'] == 1) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "success",
                title: "Sukses Menambah Acara Baru!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['stat'] == 2) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Terjadi Error di Server! <br>Silakan Coba Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['stat'] == 4) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Nama Acara Sudah Terdaftar! Silakan Gunakan Nama Yang Berbeda",
                showConfirmButton: false,
                timer: 3000
                })',
        '</script>';
    } else if ($_GET['stat'] == 5) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Divisi Sudah Terdaftar Pada Acara Tersebut!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['stat'] == 6) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "success",
                title: "Sukses Menambah Divisi!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['stat'] == 7) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Panitia Sudah Terdaftar Pada Acara Tersebut!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['stat'] == 8) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "success",
                title: "Sukses Menambah Panitia!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    }
}

//upload image
if (isset($_GET['status'])) {
    if ($_GET['status'] == 5) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Mohon Maaf, Ukuran File Image Maksimal 5 MB!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 6) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Terjadi Error di Server!<br>Silakan Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 7) {
        echo '<script>',
        'window.history.pushState("","","./database.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Mohon Maaf, Silakan Upload Hanya File Image (.jpg, .jpeg, Atau .png)!",
                showConfirmButton: false,
                timer: 3000
                })',
        '</script>';
    }
}
?>

<style>
    .swal2-container {
        z-index: 100000000000;
    }

    .jconfirm-bg {
        height: 100% !important;
    }
</style>

<body>
    <div class="container mb-5">

        <div class="row justify-content-center">
            <h3 class="title">KRITIK & SARAN</h3>
        </div>
        <div class="row mt-1">
            <div class="col-12">
                <center>
                    <a type='button' href='database_suggestions.php' class='btn btn-warning' style='-webkit-appearance: none; font-weight: bold;'>
                        LIHAT KRITIK DAN SARAN
                    </a>
                </center>
            </div>
            <div class="col-12 mt-3">
                <center>
                    <a type='button' href='./search.php?value=1' class='btn btn-primary' style='-webkit-appearance: none;' target="_blank">
                        <b>LIHAT SEMUA PENGISI CV</b>
                    </a>
                </center>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <div class="row justify-content-center">
            <h3 class="title mx-3">PENILAIAN KUARTAL 1 BEM 2023/2024</h3>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-12 col-md-4">
                <center>
                    <a type='button' href='filter_testimoni_bem.php' class='btn btn-primary' style='-webkit-appearance: none;'>
                        <b>FILTER TESTIMONI</b>
                    </a>
                    <a type='button' href='kuartal/lihat_hasil.php' class='btn btn-warning' style='-webkit-appearance: none;'>
                        <b>LIHAT HASIL</b>
                    </a>
                </center>
            </div>
        </div>
        
        <br>
        <hr>
        <br>

        <div class="row justify-content-center">
            <h3 class="title mx-3">STATUS FUNGSIONARIS BEM 2023/2024</h3>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-12 col-md-4 mt-3">
                <center>
                    <a type='button' href='status_fungsio_bem.php' class='btn btn-primary' style='-webkit-appearance: none;'>
                        <b>STATUS FUNGSIONARIS BEM</b>
                    </a>
                </center>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <div class="row justify-content-center">
            <h3 class="title">ATUR DATABASE ACARA</h3>
        </div>
        <div class="row mt-1">
            <div class="col-12 col-md-4 mt-3">
                <center>
                    <a type='button' href='database_acara.php' class='btn btn-warning' style='-webkit-appearance: none;'>
                        LIHAT DATABASE<br><b>ACARA</b>
                    </a>
                </center>
            </div>
            <div class="col-12 col-md-4 mt-3">
                <center>
                    <a type='button' href='database_divisi.php' class='btn btn-warning' style='-webkit-appearance: none;'>
                        LIHAT DATABASE<br><b>DIVISI</b>
                    </a>
                </center>
            </div>
            <div class="col-12 col-md-4 mt-3">
                <center>
                    <a type='button' href='database_panitia.php' class='btn btn-warning' style='-webkit-appearance: none;'>
                        LIHAT DATABASE<br><b>PANITIA</b>
                    </a>
                </center>
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-12 col-md-4 mt-3">
                <center>
                    <a type='button' href='filter_testimoni.php' class='btn btn-primary' style='-webkit-appearance: none;'>
                        <b>FILTER TESTIMONI</b>
                    </a>
                </center>
            </div>
        </div>
     

        <br>
        <hr>
        <br>

        <div class="row justify-content-center">
            <h3 class="title">TAMBAH ACARA BARU</h3>
        </div>
        <form action="phps/add_new_event.php" enctype="multipart/form-data" method="POST" onsubmit="pleaseWait()">
            <div class="form-group">
                <center><a onclick="aturanPenamaan()" class="btn btn-danger mt-1">PENTING: Aturan Penamaan Acara</a></center>
                <center><label for="name" style="font-weight: bold;" class="mt-3">Nama dan Tahun Acara</label></center>
                <input type="text" style="text-align: center;" id="name" name="name" placeholder="Ex: Spetrakuler 2021" class="form-control" maxlength="80" required>
                <center><label for="type" style="font-weight: bold;" class="mt-3">Tipe Acara</label></center>
                <input type="text" style="text-align: center;" id="type" name="type" placeholder="Ex: Competition" class="form-control" maxlength="30" required>
                <center><label for="status" style="font-weight: bold;" class="mt-3">Status Acara</label></center>
                <select class="form-control" id="status" name="status" style="height:40px; font-size: 12pt;" required>
                    <option value="">Pilih status...</option>
                    <option value="Upcoming">Upcoming</option>
                    <option value="Open Recruitment">Open Recruitment</option>
                    <option value="On Going">On Going</option>
                    <option value="Finished">Finished</option>
                </select>
                <center><label for="organizer" style="font-weight: bold;" class="mt-3">Penyelenggara Acara</label></center>
                <input type="text" style="text-align: center;" id="organizer" name="organizer" placeholder="Ex: BEM UK Petra, UKM Martografi" class="form-control" maxlength="30" required>
                <center><label for="year" style="font-weight: bold;" class="mt-3">Tahun Acara</label></center>
                <input type="number" style="text-align: center;" id="year" name="year" placeholder="Ex: 2021" class="form-control" min="0" required>
                <center><label for="url" style="font-weight: bold;" class="mt-3">URL Lengkap Acara<br><span style="color: red;">(Harus Lengkap! Caranya Tinggal Copy Dari Web Address)</span></label></center>
                <input type="text" style="text-align: center;" id="url" name="url" placeholder="Ex: http://bem.petra.ac.id/spetrakuler/openrec/ atau https://www.instagram.com/spetrakuler/" class="form-control" required>
                <center><label for="poster" style="font-weight: bold;" class="mt-4">Upload Foto (Potrait) Poster Acara<br><span style="color: red;">(MAX 5 MB OF .jpg, .jpeg, OR .png)</span></label></center>
                <div class="form-group row justify-content-center">
                    <center>
                        <input type="file" class="form-control-file fileUploadContainer" id="poster" name="poster" accept="image/*" required>
                    </center>
                </div>
            </div>
            <br>
            <center><input type="submit" name="submit" value="Tambah Acara" class="submit-acara btn btn-success container-fluid" style="width: 150px;"></center>
            <div id="uploading" hidden>
                <center>
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h3 style="font-size: 12pt; font-weight: bold;" id="uploading">Uploading... Please wait.</h3>
                    <h3 style="font-size: 12pt; font-weight: bold;" id="uploading">Large file sizes may took some time!</h3>
                </center>
            </div>
        </form>

        <br>
        <hr>
        <br>

        <div class="row justify-content-center">
            <h3 class="title">TAMBAH DIVISI BARU</h3>
        </div>
        <?php
        $sqlAcara = "SELECT * FROM event where validity = 1 ORDER BY year DESC";
        $stmtAcara = $pdo->prepare($sqlAcara);
        $stmtAcara->execute([]);
        if ($stmtAcara->rowCount() == 0) { ?>
            <center>
                <p style="color: red; font-weight: bold; margin-top: 10px;">Belum Ada Acara Yang Ditambahkan</p>
            </center>
        <?php  } else { ?>
            <form action="phps/add_new_divisi.php" method="POST">
                <div class="form-group">
                    <center><label for="nama" style="font-weight: bold;" class="mt-3">Nama Divisi</label></center>
                    <input type="text" style="text-align: center;" id="nama" name="nama" placeholder="Ex: Konsumsi" class="form-control" maxlength="30" required>
                    <center><label for="event" style="font-weight: bold;" class="mt-3">Acara</label></center>
                    <select class="selectpicker form-control" id="event" name="event" style="height:40px; font-size: 12pt;" data-live-search="true" maxlength="10" required>
                        <option value="">Pilih acara...</option>
                        <?php
                        while ($rowAcara = $stmtAcara->fetch()) { ?>
                            <option value="<?php echo $rowAcara['id']; ?>"><?php echo $rowAcara['name']; ?></option>
                        <?php  } ?>
                    </select>
                    <br>
                    <center><input type="submit" id="submit-divisi" name="submit" value="Tambah Divisi" class="btn btn-success container-fluid mt-4" style="width: 150px;"></center>
                </div>
            </form>
        <?php } ?>

        <br>
        <hr>
        <br>

        <div class="row justify-content-center">
            <h3 class="title">TAMBAH PANITIA BARU</h3>
        </div>
        <?php
        $sqlAcara = "SELECT * FROM event";
        $stmtAcara = $pdo->prepare($sqlAcara);
        $stmtAcara->execute([]);

        $sqlDivisi = "SELECT * FROM divisi_event";
        $stmtDivisi = $pdo->prepare($sqlDivisi);
        $stmtDivisi->execute([]);

        if ($stmtAcara->rowCount() == 0) { ?>
            <center>
                <p style="color: red; font-weight: bold; margin-top: 10px;">Belum Ada Acara Yang Ditambahkan</p>
            </center>
        <?php } else if ($stmtDivisi->rowCount() == 0) {
        ?>
            <center>
                <p style="color: red; font-weight: bold; margin-top: 10px;">Belum Ada Divisi Yang Ditambahkan</p>
            </center>
        <?php
        } else {
        ?>
            <form action="phps/add_new_panitia.php" method="POST">
                <div class="form-group">
                    <center><label for="nrp" style="font-weight: bold;" class="mt-3">NRP</label></center>
                    <input type="text" style="text-align: center;" id="nrp" name="nrp" placeholder="Ex: c14190001" class="form-control" minlength="9" maxlength="9" required>
                    <center><label for="nama" style="font-weight: bold;" class="mt-3">Nama Lengkap</label></center>
                    <input type="text" style="text-align: center;" id="nama" name="nama" placeholder="Input nama lengkap panitia" class="form-control" required>
                    <center><label for="jabatan" style="font-weight: bold;" class="mt-3">Jabatan</label></center>
                    <select class="form-control" id="jabatan" name="jabatan" style="height:40px; font-size: 12pt;" onchange="toggle_bph()" required>
                        <option value="">Pilih jabatan...</option>
                        <option value="Badan Pengurus Harian">Badan Pengurus Harian (BPH)</option>
                        <option value="Koordinator atau Wakil Koordinator">Koordinator atau Wakil Koordinator</option>
                        <option value="Anggota Divisi">Anggota Divisi</option>
                    </select>
                    <p id="pusat" class="mt-2 mx-2" style="text-align: center; font-weight: bold; color: red;" hidden>Silakan tambahkan divisi baru bernama "Pusat" sebagai divisi dari panitia dengan jabatan Badan Pengurus Harian</p>
                    <center><label for="acara" style="font-weight: bold;" class="mt-3">Acara</label></center>
                    <select class="selectpicker form-control" id="acara" name="acara" style="height:40px; font-size: 12pt;" onchange="toggle_divisi()" data-live-search="true" required>
                        <option value="">Pilih acara...</option>
                        <?php
                        while ($rowAcara = $stmtAcara->fetch()) { ?>
                            <option value="<?php echo $rowAcara['id']; ?>"><?php echo $rowAcara['name']; ?></option>
                        <?php  } ?>
                    </select>
                    <center><label for="divisi" style="font-weight: bold;" class="mt-3">Divisi</label></center>
                    <select class="form-control" id="divisi" name="divisi" style="height:40px; font-size: 12pt;" disabled>
                        <option value="" id="pil-div">Pilih divisi...</option>
                    </select>
                    <center>
                        <p style="color: red; font-weight: bold; margin-top: 10px;" id="no-div" hidden>Belum Ada Divisi Yang Ditambahkan Pada Acara Ini</p>
                    </center>
                </div>
                <br>
                <center><input type="submit" id="submit-panit" name="submit" value="Tambah Panitia" class="btn btn-success container-fluid" style="width: 150px;" disabled></center>
            </form>
        <?php } ?>

        <br>
        <hr>
        <br>

        <!-- <div class="row justify-content-center">
            <h3 class="title">CEK VALIDASI DATA EXCEL</h3>
            <p style="text-align: center; font-weight: bold;">Fitur untuk mengecek apakah NRP dan Nama Lengkap Panitia pada Excel yang dilakukan upload menggunakan <a href="./misc/excel/Template%20Tambah%20Panitia.xlsx">format template Excel</a> yang diberikan sudah sesuai dengan database</p>
        </div> -->
        <?php
        // $sqlAcara = "SELECT * FROM event";
        // $stmtAcara = $pdo->prepare($sqlAcara);
        // $stmtAcara->execute([]);

        // $sqlDivisi = "SELECT * FROM divisi_event";
        // $stmtDivisi = $pdo->prepare($sqlDivisi);
        // $stmtDivisi->execute([]);

        // if ($stmtAcara->rowCount() == 0) { ?>
            <!-- <center>
                <p style="color: red; font-weight: bold; margin-top: 10px;">Belum Ada Acara Yang Ditambahkan</p>
            </center> -->
        <?php // } else if ($stmtDivisi->rowCount() == 0) {
        ?>
            <!-- <center>
                <p style="color: red; font-weight: bold; margin-top: 10px;">Belum Ada Divisi Yang Ditambahkan</p>
            </center> -->
        <?php
        // } else {
        ?>
            <!-- <form action="phps/excel_data_validation.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <center><label for="excel" style="font-weight: bold;" class="mt-3">Upload File Excel<br><span style="color: red;">(MAX 3 MB OF .xlsx OR .xls)</span></label></center>
                    <div class="form-group row justify-content-center">
                        <center>
                            <input type="file" class="form-control-file fileUploadContainer" id="excel" name="excel" accept=".xlsx, .xls" required>
                        </center>
                    </div>
                    <center><input type="submit" id="submit-excel" name="submit" value="Cek Data" class="btn btn-success container-fluid" style="width: 150px;"></center>
                </div>
            </form> -->
            <!-- <br>
            <hr>
            <br> -->
            <div class="row justify-content-center">
                <h3 class="title">TAMBAH DIVISI & PANITIA BARU<br>(EXCEL)</h3>
            </div>
            <center><a href="panduan_excel.php" class="btn btn-danger mb-3">PENTING: Panduan Excel</a></center>
            <center><a onclick="tambahExcelPanitia()" class="btn btn-success mb-3">Silahkan Submit Excel Panitia Disini</a></center>
            <form action="phps/add_new_panitia_excel.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <?php
                    $getAcaraExcelsql = "SELECT DISTINCT a.id, a.name FROM event a LEFT JOIN divisi_event b ON b.id_event = a.id LEFT JOIN panitia_event c ON c.id_event = a.id WHERE b.nama IS NULL AND c.nama IS NULL AND a.validity = 1";
                    $getAcaraExcelstmt = $pdo->prepare($getAcaraExcelsql);
                    $getAcaraExcelstmt->execute();

                    if ($getAcaraExcelstmt->rowCount() != 0) {
                    ?>
                        <center><label for="acara" style="font-weight: bold;">Acara</label></center>
                        <select class="form-control" id="acara" name="acara" style="height:40px; font-size: 12pt;" onchange="toggle_divisi()" required>
                            <option value="">Pilih acara...</option>
                            <?php
                            while ($getAcaraExcel = $getAcaraExcelstmt->fetch()) { ?>
                                <option value="<?php echo $getAcaraExcel['id']; ?>"><?php echo $getAcaraExcel['name']; ?></option>
                            <?php  }
                            ?>
                        </select>
                        <p class="mt-2" style="text-align: center; font-weight: bold;">daftar acara yang ditampilkan adalah acara yang <u>belum pernah</u> ditambahkan data divisi dan panitia</p>
                        <center><label for="excel" style="font-weight: bold;" class="mt-3">Upload File Excel<br><span style="color: red;">(MAX 3 MB OF .xlsx OR .xls)</span></label></center>
                        <div class="form-group row justify-content-center">
                            <center>
                                <input type="file" class="form-control-file fileUploadContainer" id="excel" name="excel" accept=".xlsx, .xls" required>
                            </center>
                        </div>
                        <center><input type="submit" id="submit-excel" name="submit" value="Tambah Panitia" class="btn btn-success container-fluid" style="width: 150px;"></center>
                    <?php
                    } else {
                    ?>
                        <p class="mt-3" style="text-align: center; font-weight: bold; color: red;">Silakan Menambah Acara Baru Terlebih Dahulu<br><span>(daftar acara yang ditampilkan adalah acara yang <u>belum pernah</u> ditambahkan data divisi dan panitia)</span></p>
                    <?php
                    }
                    ?>
                </div>
            </form>
        <?php //} ?>
    </div>

    <script>
        function toggle_divisi(){if(""==$("#acara").val())$("#divisi").prop("disabled",!0),$("#divisi").html('<option value="">Pilih divisi...</option>'),$("#no-div").prop("hidden",!0),$("#divisi").prop("required",!0),$("#divisi").removeAttr("hidden"),$("#submit-panit").removeAttr("disabled");else{$("#divisi").removeAttr("disabled"),$("#divisi").prop("required",!0);var a=$("#acara").val();$.ajax({url:"phps/get_division_by_event.php",data:{acara:a},method:"POST",success:function(a){"false"==a?($("#no-div").removeAttr("hidden"),$("#divisi").removeAttr("required"),$("#divisi").prop("hidden",!0),$("#submit-panit").prop("disabled",!0)):($("#no-div").prop("hidden",!0),$("#divisi").prop("required",!0),$("#divisi").removeAttr("hidden"),$("#submit-panit").removeAttr("disabled"),$("#divisi").html('<option value="">Pilih divisi...</option>'+a))}})}}function toggle_bph(){"Badan Pengurus Harian"==$("#jabatan").val()?$("#pusat").removeAttr("hidden"):$("#pusat").prop("hidden",!0)}function pleaseWait(){$(".submit-acara").prop("hidden",!0),$("#uploading").removeAttr("hidden")}function aturanPenamaan(){$.confirm({title:"Aturan Penamaan Acara",type:"red",theme:"modern",columnClass:"col-12 col-md-8",buttons:{cancel:{text:"Asiap Kapten",btnClass:"btn-red"}},content:'\n                <center style="color: black; font-size: 12pt; max-height: 300px;">\n                    <p style="font-size: 14pt;"><b>CONTOH YANG <span style="color: red;">SALAH</span></b></p>\n                    <p>PCC <span style="color: red; font-weight: bold;">(SALAH) <i class="fas fa-times"></i></span></p>\n                    <p>PCC 2021 <span style="color: red; font-weight: bold;">(SALAH) <i class="fas fa-times"></i></span></p>\n                    <p>Petra Chess Competition <span style="color: red; font-weight: bold;">(SALAH) <i class="fas fa-times"></i></span></p>\n                    <br>\n                    <p style="font-size: 14pt;"><b>CONTOH YANG <span style="color: green;">BENAR</span></b></p>\n                    <p style="text-transform: capitalize;"><b>Petra Chess Competition 2021  </b><span style="color: green; font-weight: bold;">(BENAR) <i class="fas fa-check"></i></span></p>\n                    <br>\n                    <p style="font-size: 14pt;"><b>Kok Gitu Yah?</b></p>\n                    <p>Supaya nama acara tidak double untuk assessment acara tahun berikutnya maka harus diberikan tahun acara di belakang nama acara dan jangan disingkat yah guys!</p>\n                </center>\n            '})}$("input[type='file']").on("change",function(){var a=this.files[0].size,e=this.files[0].name.split(".").pop().toLowerCase();"image/*"==$(this).attr("accept")?("jpg"!=e&&"jpeg"!=e&&"png"!=e&&($.alert("<span style='color: #c24134; font-weight: bold; text-align: center;'><center>Mohon maaf, silakan upload hanya file image (.jpg, .jpeg, atau .png)!</center></span>"),$(this).val(null)),a>5242880&&($.alert("<span style='color: #c24134; font-weight: bold; text-align: center;'><center>Mohon maaf, ukuran file maksimal adalah 5 MB! Silakan upload ulang.</center></span>"),$(this).val(null))):".xlsx, .xls"==$(this).attr("accept")&&("xlsx"!=e&&"xls"!=e&&($.alert("<span style='color: #c24134; font-weight: bold; text-align: center;'><center>Mohon maaf, silakan upload hanya file Excel (.xlsx, .xls)!</center></span>"),$(this).val(null)),a>3145728&&($.alert("<span style='color: #c24134; font-weight: bold; text-align: center;'><center>Mohon maaf, ukuran file maksimal adalah 3 MB! Silakan upload ulang.</center></span>"),$(this).val(null)))});

        function excelFailed() {
            $.confirm({
                title: 'INVALID DATA',
                type: 'red',
                theme: 'modern',
                icon: 'fas fa-times',
                columnClass: "col-12 col-md-8",
                buttons: {
                    cancel: {
                        text: 'CLOSE',
                        btnClass: 'btn-red'
                    }
                },
                content: `
                <center style="color: black; font-size: 12pt; max-height: 300px;">
                <?php
                if (isset($_GET['double'])) {
                    $doubleNRP = unserialize($_GET['double']);
                    if (!empty($doubleNRP)) {
                ?>
                    <p style="font-size: 14pt;"><b>NRP DOUBLE</b></p>
                    <p>
                    <?php
                        foreach ($doubleNRP as $nrp) {
                            echo $nrp . " ";
                        }
                    ?>
                    </p>
                    <br>
                    <?php
                    }
                }

                if (isset($_GET['format'])) {
                    $invalidFormatNRP = unserialize($_GET['format']);
                    if (!empty($invalidFormatNRP)) {
                    ?>
                    <p style="font-size: 14pt;"><b>NRP TIDAK SESUAI FORMAT</b></p>
                    <p>
                    <?php
                        foreach ($invalidFormatNRP as $nrp) {
                            echo $nrp . " ";
                        }
                    ?>
                    </p>
                    <br>
                    <?php
                    }
                }
                if (isset($_GET['jabatan'])) {
                    $invalidJabatan = unserialize($_GET['jabatan']);
                    if (!empty($invalidJabatan)) {
                    ?>
                    <p style="font-size: 14pt;"><b>INVALID KODE JABATAN</b></p>
                    <p>
                    <?php
                        foreach ($invalidJabatan as $kode) {
                            echo $kode . " ";
                        }
                    ?>
                    </p>
                    <?php
                    }
                }
                    ?>
                </center>
            `
            });
        }

        <?php
        if (isset($_GET['stat'])) {
            if ($_GET['stat'] == 9) {
                echo
                'window.history.pushState("","","./database.php");',
                'excelFailed();';
            }
        }
        ?>
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
                        $stmt = $pdo->prepare("SELECT * FROM event order by name asc");
                        $stmt->execute();
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
</body>

</html>