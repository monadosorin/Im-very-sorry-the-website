<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'database_panitia';
require_once './header.php';

if (isset($_GET['stat'])) {
    if ($_GET['stat'] == 1) {
        echo '<script>',
        'window.history.pushState("","","./database_panitia.php");',
        '	Swal.fire({
                position: "center",
                icon: "success",
                title: "Sukses Update Data Panitia!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['stat'] == 2) {
        echo '<script>',
        'window.history.pushState("","","./database_panitia.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",
                showConfirmButton: false,
                timer: 3000
                })',
        '</script>';
    } else if ($_GET['stat'] == 3) {
        echo '<script>',
        'window.history.pushState("","","./database_panitia.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Panitia Sudah Terdaftar Pada Acara Tersebut!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    }
}
?>

<style>
    .batal .jconfirm-content-pane {
        height: 0 !important;
    }

    .batal .jconfirm-title-c {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }
</style>

    <div class="container-fluid" style="margin-top: 30px;">
        <div class="row mx-4 justify-content-center">
            <h1 class="title"><i class="fas fa-users"></i> DATABASE PANITIA</h1>
        </div>
        <?php
        $cekRowPanitiasql = "SELECT * FROM panitia_event";
        $cekRowPanitiastmt = $pdo->prepare($cekRowPanitiasql);
        $cekRowPanitiastmt->execute();
        if ($cekRowPanitiastmt->rowCount() > 0) {
        ?>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                    <select class="selectpicker form-control" id="filter_acara" name="filter_acara" style="height:40px; font-size: 12pt;" data-live-search="true">
                        <option value="">Lihat berdasarkan acara...</option>
                        <?php
                        $getListEventsql = "SELECT * FROM event ORDER BY year DESC";
                        $getListEventstmt = $pdo->prepare($getListEventsql);
                        $getListEventstmt->execute([]);
                        while ($getListEventrow = $getListEventstmt->fetch()) {
                        ?>
                            <option value="<?= $getListEventrow['name']; ?>"><?= $getListEventrow['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                    <select class="form-control" id="filter_jabatan" name="filter_jabatan" style="height:40px; font-size: 12pt;">
                        <option value="">Lihat berdasarkan jabatan...</option>
                        <option value="Badan Pengurus Harian">Badan Pengurus Harian (BPH)</option>
                        <option value="Koordinator atau Wakil Koordinator">Koordinator atau Wakil Koordinator</option>
                        <option value="Anggota Divisi">Anggota Divisi</option>
                    </select>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="row" style="margin-top: 20px; overflow-x: auto;">
            <div class="col-12" style="overflow-x: auto;">
                <table class="table table-hovered table-striped" id="panitiaTable" style="color: #412c27; width: 100%">
                    <thead style="text-align: center; font-weight: bold;">
                        <tr>
                            <td style="width: 5%;">#</td>
                            <td>NRP</td>
                            <td>Nama</td>
                            <td>Jabatan</td>
                            <td>Divisi</td>
                            <td>Acara</td>
                            <td>Tools</td>
                        </tr>
                    </thead>
                    <tbody id="panitiaTableBody" style="text-align: center;">

                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="database.php" class="btn btn-warning container-fluid mb-5" style="width: 150px;"><b>Back</b></a></center>
    </div>

    <script>
        function show(){$("#panitiaTableBody").html("<span>Harap tunggu...</span>"),$.ajax({url:"phps/refresh_data.php",type:"get",dataType:"json",data:{id:3},success:function(a){$("#panitiaTable").dataTable().fnDestroy();for(var t=a,n="",e=1,i=0;i<t.length;i++){var r=t[i];n+="<tr>",n+="<td>"+e+"</td>",n+="<td>"+r.nrp.toUpperCase()+"</td>",n+="<td>"+r.nama+"</td>",n+="<td>"+r.jabatan+"</td>",n+="<td>"+r.divisi+"</td>",n+="<td>"+r.acara+"</td>",n+="<td class='d-flex justify-content-center'><a type='button' style='-webkit-appearance: none; text-align: center;' class='btn btn-warning mr-2' href='edit_panitia.php?id="+r.id+"'><i class='far fa-edit'></i></a><a type='button' style='-webkit-appearance: none; text-align: center;' class='btn btn-danger' data-nama='"+r.nama+"' data-acara='"+r.acara+"' data-id='"+r.id+"' data-nrp='"+r.nrp+"' data-tahun='"+r.tahun_acara+"' onclick='deletePanitia(this)'><i class='fas fa-trash-alt'></i></a></td>",n+="</tr>",e+=1}$("#panitiaTableBody").html(n),Search($("#panitiaTable").DataTable({oLanguage:{sEmptyTable:"Belum Ada Panitia Yang Ditambahkan"}}))},error:function(a){alert("ERROR!")}})}function deletePanitia(a){var t=a.getAttribute("data-id"),n=a.getAttribute("data-nrp"),e=a.getAttribute("data-nama"),i=a.getAttribute("data-acara");a.getAttribute("data-tahun");$.confirm({title:"Konfirmasi Penghapusan Panitia",type:"red",typeAnimated:!0,theme:"modern",icon:"fas fa-question",draggable:!1,columnClass:"col-md-9",buttons:{confirm:{text:"KONFIRMASI",btnClass:"btn-green",action:function(){$.ajax({url:"phps/delete_database.php",method:"POST",data:{id:t,ajaxid:3},success:function(a){"true"==a?(Swal.fire({position:"center",icon:"success",title:"Sukses Menghapus Panitia!",showConfirmButton:!1,timer:2e3}),setTimeout(function(){window.location.href="database_panitia.php"},2e3)):"false"==a&&(Swal.fire({position:"center",icon:"error",title:"Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",showConfirmButton:!1,timer:3500}),setTimeout(function(){window.location.href="database_panitia.php"},3500))}})}},cancel:{text:"BATAL",btnClass:"btn-red",action:function(){konfirmasiBatal()}}},content:"<div style='color: black; font-size: 12pt; max-height: 300px;'>Apakah Anda yakin akan menghapus panitia NRP <b>"+n+"</b> dengan nama <b>"+e+"</b> pada acara <b>"+i+"</b>?<br><br><span style='font-weight: bold; color: red; font-size: 16pt;'>P E R H A T I A N</span><br>Penilaian yang sudah pernah diberikan kepada "+e+" pada acara "+i+" <b>tidak akan ditampilkan lagi</b>.<br><br><b style='color: red;'>Pilihan yang sudah dibuat tidak dapat diubah kembali!</b></div><br>"})}function konfirmasiBatal(){$.confirm({title:"Konfirmasi Batal!",type:"red",typeAnimated:!0,theme:"modern",icon:"far fa-times-circle",draggable:!1,columnClass:"batal col-md-4",buttons:{cancel:{text:"OK",btnClass:"btn-red"}},content:""})}function Search(a){$("#filter_acara").on("change",function(){a.columns(5).search(this.value).draw()}),$("#filter_jabatan").on("change",function(){a.columns(3).search(this.value).draw()})}$(document).ready(function(){show()});
    </script>
</body>

</html>