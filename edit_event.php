<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'edit_event';
require_once './header.php';

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM event WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch();
}
?>

<head>
    <title>REACH - Edit Acara <?= $row['name']; ?></title>
</head>

<style>
    #photo {
        width: 40%;
        height: calc(100vh - calc(100vh - 100%));
    }

    @media screen and (max-width: 767px) {
        #photo {
            width: 60%;
        }
    }
</style>

<body>
    <div class="container mb-5">
        <div class="row justify-content-center">
            <h1 class="title"><i class="fas fa-edit"></i> EDIT ACARA</h1>
        </div>
        <form action="phps/update_event.php" method="POST" enctype="multipart/form-data" onsubmit="pleaseWait()">
            <div class="form-group">
                <center><a onclick="aturanPenamaan()" class="btn btn-danger mt-1">Penting: Lihat Aturan Penamaan Acara</a></center>
                <input hidden name="id" value="<?= $row['id'] ?>" />
                <center><label for="name" style="font-weight: bold;" class="mt-3">Nama dan Tahun Acara</label></center>
                <input type="text" style="text-align: center;" id="name" name="name" placeholder="Ex: Spetrakuler 2021" class="form-control" maxlength="80" value="<?= $row['name']; ?>" required>
                <center><label for="type" style="font-weight: bold;" class="mt-3">Tipe Acara</label></center>
                <input type="text" style="text-align: center;" id="type" name="type" placeholder="Ex: Competition" class="form-control" maxlength="30" value="<?= $row['type']; ?>" required>
                <center><label for="status" style="font-weight: bold;" class="mt-3">Status Acara</label></center>
                <select class="form-control" id="status" name="status" style="height:40px; font-size: 12pt;" required>
                    <option value="">Pilih status...</option>
                    <option value="Upcoming">Upcoming</option>
                    <option value="Open Recruitment">Open Recruitment</option>
                    <option value="On Going">On Going</option>
                    <option value="Finished">Finished</option>
                </select>
                <center><label for="organizer" style="font-weight: bold;" class="mt-3">Penyelenggara Acara</label></center>
                <input type="text" style="text-align: center;" id="organizer" name="organizer" placeholder="Ex: BEM UK Petra, UKM Martografi" class="form-control" maxlength="30" value="<?= $row['organizer']; ?>" required>
                <center><label for="year" style="font-weight: bold;" class="mt-3">Tahun Acara</label></center>
                <input type="number" style="text-align: center;" id="year" name="year" placeholder="Ex: 2021" class="form-control" min="0" value="<?= $row['year']; ?>" required>
                <center><label for="url" style="font-weight: bold;" class="mt-3">URL Lengkap Acara<br><span style="color: red;">(Harus Lengkap! Caranya Tinggal Copy Dari Web Address)</span></label></center>
                <input type="text" style="text-align: center;" id="url" name="url" placeholder="Ex: http://bem.petra.ac.id/spetrakuler/openrec/ atau https://www.instagram.com/spetrakuler/" class="form-control" value="<?= $row['url']; ?>" required>
                <div class="row justify-content-center mt-4">
                    <h5 style="font-weight: bold;">CURRENT POSTER</h5>
                </div>
                <div class="row justify-content-center">
                    <img src="uploads/poster/<?= $row['poster_filepath']; ?>" alt="" id="photo">
                </div>
                <center><label for="poster" style="font-weight: bold;" class="mt-4">Update Foto (Potrait) Poster Acara (Opsional)<br><span style="color: red;">(MAX 5 MB OF .jpg, .jpeg, OR .png)</span></label></center>
                <div class="form-group row justify-content-center">
                    <center>
                        <input type="file" class="form-control-file fileUploadContainer" id="poster" name="poster" accept="image/*">
                    </center>
                </div>
            </div>
            <br>
            <center><input type="submit" name="submit" value="Update Data Acara" class="submit-acara btn btn-success container-fluid" style="width: 200px;"></center>
            <div id="uploading" class="mb-3" hidden>
                <center>
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h3 style="font-size: 12pt; font-weight: bold;" id="uploading">Uploading... Please wait.</h3>
                    <h3 style="font-size: 12pt; font-weight: bold;" id="uploading">Large file sizes may took some time!</h3>
                </center>
            </div>
            <center><a href="database_acara.php" class="btn btn-danger container-fluid mt-3" style="width: 200px;"><b>Cancel</b></a></center>
        </form>
    </div>

    <script>
        function aturanPenamaan(){$.confirm({title:"Aturan Penamaan Acara",type:"red",typeAnimated:!0,theme:"modern",draggable:!1,columnClass:"col-md-6",buttons:{cancel:{text:"Asiap Kapten",btnClass:"btn-red"}},content:'\n                <center style="color: black; font-size: 12pt; max-height: 400px;">\n                    <p style="font-size: 14pt;"><b>CONTOH YANG <span style="color: red;">SALAH</span></b></p>\n                    <p>PCC <span style="color: red; font-weight: bold;">(SALAH) <i class="fas fa-times"></i></span></p>\n                    <p>PCC 2021 <span style="color: red; font-weight: bold;">(SALAH) <i class="fas fa-times"></i></span></p>\n                    <p>Petra Chess Competition <span style="color: red; font-weight: bold;">(SALAH) <i class="fas fa-times"></i></span></p>\n                    <br>\n                    <p style="font-size: 14pt;"><b>CONTOH YANG <span style="color: green;">BENAR</span></b></p>\n                    <p style="text-transform: capitalize;"><b>Petra Chess Competition 2021  </b><span style="color: green; font-weight: bold;">(BENAR) <i class="fas fa-check"></i></span></p>\n                    <br>\n                    <p style="font-size: 14pt;"><b>Kok Gitu Yah?</b></p>\n                    <p>Supaya nama acara tidak double untuk assessment acara tahun berikutnya maka harus diberikan tahun acara di belakang nama acara dan jangan disingkat yah guys.</p>\n                </center>\n            '})}function pleaseWait(){$(".submit-acara").prop("hidden",!0),$("#uploading").removeAttr("hidden")}$("input[type='file']").on("change",function(){if("image/*"==$(this).attr("accept")){var a=this.files[0].size,e=this.files[0].name.split(".").pop().toLowerCase();a>5242880&&($.alert("<span style='color: #c24134; font-weight: bold; text-align: center;'><center>Mohon maaf, ukuran file maksimal adalah 5 MB! Silakan upload ulang.</center></span>"),$(this).val(null)),"jpg"!=e&&"jpeg"!=e&&"png"!=e&&($.alert("<span style='color: #c24134; font-weight: bold; text-align: center;'><center>Mohon maaf, silakan upload hanya file image (.jpg, .jpeg, atau .png)!</center></span>"),$(this).val(null))}});$('select[name="status"]').val('<?= $row['status']; ?>');
    </script>
</body>

</html>