<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'database_divisi';
require_once './header.php';

if (isset($_GET['stat'])) {
    if ($_GET['stat'] == 1) {
        echo '<script>',
        'window.history.pushState("","","./database_divisi.php");',
        '	Swal.fire({
                position: "center",
                icon: "success",
                title: "Sukses Update Data Divisi!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['stat'] == 2) {
        echo '<script>',
        'window.history.pushState("","","./database_divisi.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Terjadi Error di Server! <br>Silakan Coba Ulangi Kembali",
                showConfirmButton: false,
                timer: 3000
                })',
        '</script>';
    } else if ($_GET['stat'] == 3) {
        echo '<script>',
        'window.history.pushState("","","./database_divisi.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Divisi Sudah Terdaftar Pada Acara Tersebut!",
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
            <h1 class="title"><i class="fas fa-cogs"></i> DATABASE DIVISI</h1>
        </div>
        <?php
        $cekRowDivisisql = "SELECT * FROM divisi_event";
        $cekRowDivisistmt = $pdo->prepare($cekRowDivisisql);
        $cekRowDivisistmt->execute();
        if ($cekRowDivisistmt->rowCount() > 0) {
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
        <?php
        }
        ?>
        <div class="row" style="margin-top: 20px; overflow-x: auto;">
            <div class="col-12" style="overflow-x: auto;">
                <table class="table table-hovered table-striped" id="divisiTable" style="color: #412c27; width: 100%">
                    <thead style="text-align: center; font-weight: bold;">
                        <tr>
                            <td style="width: 5%;">#</td>
                            <td>Nama Divisi</td>
                            <td>Acara</td>
                            <td>Tools</td>
                        </tr>
                    </thead>
                    <tbody id="divisiTableBody" style="text-align: center;">

                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="database.php" class="btn btn-warning container-fluid mb-5" style="width: 150px;"><b>Back</b></a></center>
    </div>

    <script>
        function show(){$("#divisiTableBody").html("<span>Harap tunggu...</span>"),$.ajax({url:"phps/refresh_data.php",type:"get",dataType:"json",data:{id:2},success:function(a){$("#divisiTable").dataTable().fnDestroy();for(var t=a,i="",e=1,n=0;n<t.length;n++){var s=t[n];i+="<tr>",i+="<td>"+e+"</td>",i+="<td>"+s.nama+"</td>",i+="<td>"+s.acara+"</td>",i+="<td class='d-flex justify-content-center'><a type='button' style='-webkit-appearance: none; text-align: center;' class='btn btn-warning mr-2' href='edit_divisi.php?id="+s.id+"'><i class='far fa-edit'></i></a><a type='button' style='-webkit-appearance: none; text-align: center;' class='btn btn-danger' data-acara='"+s.acara+"' data-id='"+s.id+"' data-divisi='"+s.nama+"' data-tahun='"+s.tahun_acara+"' onclick='deleteDivisi(this)'><i class='fas fa-trash-alt'></i></a></td>",i+="</tr>",e+=1}$("#divisiTableBody").html(i),Search($("#divisiTable").DataTable({oLanguage:{sEmptyTable:"Belum Ada Divisi Yang Ditambahkan"}}))},error:function(a){alert("ERROR!")}})}function deleteDivisi(a){var t=a.getAttribute("data-id"),i=a.getAttribute("data-divisi"),e=a.getAttribute("data-acara"),n=a.getAttribute("data-tahun");$.confirm({title:"Konfirmasi Penghapusan Divisi",type:"red",typeAnimated:!0,theme:"modern",icon:"fas fa-question",draggable:!1,columnClass:"col-md-9",buttons:{confirm:{text:"KONFIRMASI",btnClass:"btn-green",action:function(){$.ajax({url:"phps/delete_database.php",method:"POST",data:{id:t,ajaxid:2},success:function(a){"true"==a?(Swal.fire({position:"center",icon:"success",title:"Sukses Menghapus Divisi!",showConfirmButton:!1,timer:2e3}),setTimeout(function(){window.location.href="database_divisi.php"},2e3)):"false"==a&&(Swal.fire({position:"center",icon:"error",title:"Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",showConfirmButton:!1,timer:3500}),setTimeout(function(){window.location.href="database_divisi.php"},3500))}})}},cancel:{text:"BATAL",btnClass:"btn-red",action:function(){konfirmasiBatal()}}},content:"<div style='color: black; font-size: 12pt; max-height: 300px;'>Apakah Anda yakin akan menghapus divisi <b>"+i+"</b> pada acara <b>"+e+"</b> tahun <b>"+n+"</b>?<br><br><span style='font-weight: bold; color: red; font-size: 16pt;'>P E R H A T I A N</span><br>Divisi yang dihapus akan menghapus semua panitia yang sudah pernah ditambahkan ke divisi "+i+" pada acara "+e+" dan penilaian yang sudah pernah diberikan di divisi "+i+" pada acara "+e+" <b>tidak akan ditampilkan lagi</b>.<br><br><b style='color: red;'>Pilihan yang sudah dibuat tidak dapat diubah kembali!</b></div><br>"})}function konfirmasiBatal(){$.confirm({title:"Konfirmasi Batal!",type:"red",typeAnimated:!0,theme:"modern",icon:"far fa-times-circle",draggable:!1,columnClass:"batal col-md-4",buttons:{cancel:{text:"OK",btnClass:"btn-red"}},content:""})}function Search(a){$("#filter_acara").on("change",function(){a.columns(2).search(this.value).draw()})}$(document).ready(function(){show()});
    </script>
</body>

</html>