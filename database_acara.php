<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'database_acara';
require_once './header.php';

if (isset($_GET['stat'])) {
    if ($_GET['stat'] == 1) {
        echo '<script>',
        'window.history.pushState("","","./database_acara.php");',
        '	Swal.fire({
                position: "center",
                icon: "success",
                title: "Sukses Update Data Acara!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['stat'] == 2) {
        echo '<script>',
        'window.history.pushState("","","./database_acara.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Terjadi Error di Server! <br>Silakan Coba Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['stat'] == 3) {
        echo '<script>',
        'window.history.pushState("","","./database_acara.php");',
        '	Swal.fire({
                position: "center",
                icon: "error",
                title: "Nama Acara Sudah Terdaftar! Silakan Gunakan Nama Yang Berbeda",
                showConfirmButton: false,
                timer: 3000
                })',
        '</script>';
    } else if ($_GET['status'] == 5) {
        echo '<script>',
        'window.history.pushState("","","./database_acara.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "https://media.giphy.com/media/iD6QiXTTAYrU5C3c89/giphy.gif",
				imageHeight: 150,
                title: "Mohon Maaf, Ukuran File Image Maksimal 5 MB!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    } else if ($_GET['status'] == 7) {
        echo '<script>',
        'window.history.pushState("","","./database_acara.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "https://media.giphy.com/media/iD6QiXTTAYrU5C3c89/giphy.gif",
				imageHeight: 150,
                title: "Mohon Maaf, Silakan Upload Hanya File Image (.jpg, .jpeg, Atau .png)!",
                showConfirmButton: false,
                timer: 3000
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

<body>
    <div class="container-fluid" style="margin-top: 30px;">
        <div class="row mx-4 justify-content-center">
            <h1 class="title"><i class="fas fa-calendar-alt"></i> DATABASE ACARA</h1>
        </div>
        <?php
        $cekRowEventsql = "SELECT * FROM event";
        $cekRowEventstmt = $pdo->prepare($cekRowEventsql);
        $cekRowEventstmt->execute();
        if ($cekRowEventstmt->rowCount() > 0) {
        ?>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                    <select class="form-control" id="filter_status" name="filter_status" style="height:40px; font-size: 12pt;">
                        <option value="">Lihat berdasarkan status acara...</option>
                        <option value="Upcoming">Upcoming</option>
                        <option value="Open Recruitment">Open Recruitment</option>
                        <option value="On Going">On Going</option>
                        <option value="Finished">Finished</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                    <select class="form-control" id="filter_tahun" name="filter_tahun" style="height:40px; font-size: 12pt;">
                        <option value="">Lihat berdasarkan tahun acara...</option>
                        <?php
                        $getListYearsql = "SELECT DISTINCT year FROM event ORDER BY year DESC";
                        $getListYearstmt = $pdo->prepare($getListYearsql);
                        $getListYearstmt->execute([]);
                        while ($getListYearrow = $getListYearstmt->fetch()) {
                        ?>
                            <option value="<?= $getListYearrow['year']; ?>"><?= $getListYearrow['year']; ?></option>
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
                <table class="table table-hovered table-striped" id="acaraTable" style="color: #412c27; width: 100%">
                    <thead style="text-align: center; font-weight: bold;">
                        <tr>
                            <td style="width: 5%;">#</td>
                            <td>Nama Acara</td>
                            <td>Tipe Acara</td>
                            <td>Status Acara</td>
                            <td>Penyelenggara Acara</td>
                            <td>Ketua Kegiatan</td>
                            <td>Tahun Acara</td>
                            <td>URL Acara</td>
                            <td>Status Data</td>
                            <td>Jenis Kepanitiaan</td>
                            <td>Link Proposal</td>
                            <td>Tools</td>
                        </tr>
                    </thead>
                    <tbody id="acaraTableBody" style="text-align: center;">

                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="database.php" class="btn btn-warning container-fluid mb-5" style="width: 150px;"><b>Back</b></a></center>
    </div>

    <script>
        function show() {
            $("#acaraTableBody").html("<span>Harap tunggu...</span>"),
                $.ajax({
                    url: "phps/refresh_data.php",
                    type: "get",
                    dataType: "json",
                    data: {
                        id: 1
                    },
                    success: function(a) {
                        $("#acaraTable").dataTable().fnDestroy();
                        for (var t = a, e = "", n = 1, r = 0; r < t.length; r++) {
                            var i = t[r];

                            // logic for status data
                            var statusData = '';
                            var actionButton = '';
                            if(i.validity == 0){
                                if(i.token_reach_biro != null){
                                    statusData = '<div class="text-primary">Menunggu proposal diterima gsgf pada Birokrasi</div>'
                                }else{
                                    statusData = '<div class="text-primary">Menunggu Keputusan PIC Reach</div>'
                                    actionButton += `<button class="btn btn-success" onclick="acceptAcara(`+i.id+`,'`+i.name+`','`+i.organizer+`','`+i.year+`')">
                                        Accept
                                    </button>`
                                }
                            }else if(i.validity == 1){
                                statusData = '<div class="text-success">Accepted</div>'
                                if(i.token_reach_biro == null){
                                    actionButton += `<button class="btn btn-success" onclick="acceptAcara(`+i.id+`,'`+i.name+`','`+i.organizer+`','`+i.year+`')">
                                        Accept
                                    </button>`
                                }
                            }else if(i.validity == 2){
                                statusData = '<div class="text-danger">Rejected</div>'
                                if(i.token_reach_biro == null){
                                    actionButton += `<button class="btn btn-success" onclick="acceptAcara(`+i.id+`,'`+i.name+`','`+i.organizer+`','`+i.year+`')">
                                        Accept
                                    </button>`
                                }
                            }else{
                                statusData= 'Tidak diketahui'
                            }
                            actionButton += `                                    
                                    <button class="btn btn-danger" onclick="rejectAcara(`+i.id+`,'`+i.name+`','`+i.organizer+`','`+i.year+`')">
                                        Reject
                                    </button>`;

                            // link proposal
                            var proposal ='';
                            if(i.link_proposal != null){
                                proposal = '<a href="'+i.link_proposal+'" target="_blank">'+i.link_proposal+'</a>'
                            }else{
                                proposal = '-';
                            }

                            e += "<tr>",
                                e += "<td>" + n + "</td>", 
                                e += "<td>" + i.name + "</td>",
                                e += "<td>" + i.type + "</td>", 
                                e += "<td>" + i.status + "</td>",
                                e += "<td>" + i.organizer + "</td>", 
                                e += "<td>" + i.nrp_ketua + "</td>",
                                e += "<td>" + i.year + "</td>", 
                                e += "<td><a type='button' style='-webkit-appearance: none;' class='btn btn-primary' target='_blank' href='" + i.url + "'>VISIT</a></td>",
                                e += "<td>" + statusData + "</td>", 
                                e += "<td>" + i.jenis_kepanitiaan + "</td>", 
                                e += "<td>" + proposal + "</td>", 
                                e += `
                                <td class='d-flex justify-content-center'>
                                    <a type='button' style='-webkit-appearance: none; text-align: center;' class='btn btn-warning mr-2' href='edit_event.php?id=` + i.id + `'>
                                        <i class='far fa-edit'></i>
                                    </a>
                                    `+actionButton+`
                                    <a type='button' style='-webkit-appearance: none; text-align: center;' class='btn btn-dark' data-acara='` + i.name + `' data-id='` + i.id + `' data-organizer='` + i.organizer + `' data-tahun='` + i.year + `' onclick='deleteAcara(this)'>
                                        <i class='fas fa-trash-alt'></i>
                                    </a>
                                    
                                </td>`, 
                                e += "</tr>", n += 1
                        }
                        $("#acaraTableBody").html(e), Search($("#acaraTable").DataTable({
                            oLanguage: {
                                sEmptyTable: "Belum Ada Acara Yang Ditambahkan"
                            }
                        }))
                    },
                    error: function(a) {
                        alert("ERROR!")
                    }
                })
        }

        function deleteAcara(a) {
            var t = a.getAttribute("data-id"),
                e = a.getAttribute("data-acara"),
                n = a.getAttribute("data-organizer"),
                r = a.getAttribute("data-tahun");
            $.confirm({
                title: "Konfirmasi Penghapusan Acara",
                type: "red",
                typeAnimated: !0,
                theme: "modern",
                icon: "fas fa-question",
                draggable: !1,
                columnClass: "col-md-9",
                buttons: {
                    confirm: {
                        text: "KONFIRMASI",
                        btnClass: "btn-green",
                        action: function() {
                            $.ajax({
                                url: "phps/delete_database.php",
                                method: "POST",
                                data: {
                                    id: t,
                                    ajaxid: 1
                                },
                                success: function(a) {
                                    "true" == a ? (Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "Sukses Menghapus Acara!",
                                        showConfirmButton: !1,
                                        timer: 2e3
                                    }), setTimeout(function() {
                                        window.location.href = "database_acara.php"
                                    }, 2e3)) : "false" == a && (Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",
                                        showConfirmButton: !1,
                                        timer: 3500
                                    }), setTimeout(function() {
                                        window.location.href = "database_acara.php"
                                    }, 3500))
                                }
                            })
                        }
                    },
                    cancel: {
                        text: "BATAL",
                        btnClass: "btn-red",
                        action: function() {
                            konfirmasiBatal()
                        }
                    }
                },
                content: "<div style='color: black; font-size: 12pt; max-height: 300px;'>Apakah Anda yakin akan menghapus acara <b>" + e + "</b> yang diselenggarakan oleh <b>" + n + "</b> pada tahun <b>" + r + "</b>?<br><br><span style='font-weight: bold; color: red; font-size: 16pt;'>P E R H A T I A N</span><br>Acara yang dihapus akan menghapus semua divisi dan panitia yang sudah pernah ditambahkan ke acara " + e + " dan penilaian yang sudah pernah diberikan di acara " + e + " <b>tidak akan ditampilkan lagi</b>.<br><br><b style='color: red;'>Pilihan yang sudah dibuat tidak dapat diubah kembali!</b></div><br>"
            })
        }
        function rejectAcara(id,e,n,r){
            $.confirm({
                title: "Konfirmasi Reject Acara",
                type: "red",
                typeAnimated: !0,
                theme: "modern",
                icon: "fas fa-question",
                draggable: !1,
                columnClass: "col-md-9",
                buttons: {
                    confirm: {
                        text: "KONFIRMASI",
                        btnClass: "btn-green",
                        action: function() {
                            $.ajax({
                                url: "phps/reject_event.php",
                                method: "POST",
                                data: {
                                    id_event : id
                                },
                                success: function(a) {
                                    if(a == 'success'){
                                        Swal.fire({
                                            position: "center",
                                            icon: "success",
                                            title: "Sukses Reject Acara!",
                                            showConfirmButton: !1,
                                            timer: 2e3
                                        }).then((result) => {
                                            window.location.href = "database_acara.php"
                                        })
                                    }else if( a == 'gagal'){
                                        Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",
                                            showConfirmButton: !1,
                                            timer: 3500
                                        }).then((result) => {
                                            window.location.href = "database_acara.php"
                                        })
                                    }else if(a == 'login'){
                                        Swal.fire({
                                            position: "center",
                                            icon: "warning",
                                            title: "Silahkan login terlebih dahulu",
                                            showConfirmButton: !1,
                                            timer: 3500
                                        }).then((result) => {
                                            window.location.href = "index.php"
                                        })
                                    }else if(a == 'no access'){
                                        Swal.fire({
                                            position: "center",
                                            icon: "warning",
                                            title: "Maaf tapi anda tidak diperbolehkan",
                                            showConfirmButton: !1,
                                        }).then((result) => {
                                            window.location.href = "home.php"
                                        })
                                    }else{
                                        Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",
                                            showConfirmButton: !1,
                                        }).then((result) => {
                                            window.location.href = "database_acara.php"
                                        })
                                    }
                                }
                            })
                        }
                    },
                    cancel: {
                        text: "BATAL",
                        btnClass: "btn-red",
                        action: function() {
                            konfirmasiBatal()
                        }
                    }
                },
                content: "<div style='color: black; font-size: 12pt; max-height: 300px;'>Apakah Anda yakin akan REJECT acara <b>" + e + "</b> yang diselenggarakan oleh <b>" + n + "</b> pada tahun <b>" + r + "</b>?<br><br>"
            })
        }
        function acceptAcara(id,e,n,r){
            $.confirm({
                title: "Konfirmasi Aceept Acara",
                type: "red",
                typeAnimated: !0,
                theme: "modern",
                icon: "fas fa-question",
                draggable: !1,
                columnClass: "col-md-9",
                buttons: {
                    confirm: {
                        text: "KONFIRMASI",
                        btnClass: "btn-green",
                        action: function() {
                            $.ajax({
                                url: "phps/accept_event.php",
                                method: "POST",
                                data: {
                                    id_event : id
                                },
                                success: function(a) {
                                    if(a == 'success'){
                                        Swal.fire({
                                            position: "center",
                                            icon: "success",
                                            title: "Sukses Accept Acara!",
                                            showConfirmButton: !1,
                                            timer: 2e3
                                        }).then((result) => {
                                            window.location.href = "database_acara.php"
                                        })
                                    }else if( a == 'gagal'){
                                        Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",
                                            showConfirmButton: !1,
                                            timer: 3500
                                        }).then((result) => {
                                            window.location.href = "database_acara.php"
                                        })
                                    }else if(a == 'login'){
                                        Swal.fire({
                                            position: "center",
                                            icon: "warning",
                                            title: "Silahkan login terlebih dahulu",
                                            showConfirmButton: !1,
                                            timer: 3500
                                        }).then((result) => {
                                            window.location.href = "index.php"
                                        })
                                    }else if(a == 'no access'){
                                        Swal.fire({
                                            position: "center",
                                            icon: "warning",
                                            title: "Maaf tapi anda tidak diperbolehkan",
                                            showConfirmButton: !1,
                                        }).then((result) => {
                                            window.location.href = "home.php"
                                        })
                                    }else{
                                        Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",
                                            showConfirmButton: !1,
                                        }).then((result) => {
                                            window.location.href = "database_acara.php"
                                        })
                                    }
                                }
                            })
                        }
                    },
                    cancel: {
                        text: "BATAL",
                        btnClass: "btn-red",
                        action: function() {
                            konfirmasiBatal()
                        }
                    }
                },
                content: "<div style='color: black; font-size: 12pt; max-height: 300px;'>Apakah Anda yakin akan ACCEPT acara <b>" + e + "</b> yang diselenggarakan oleh <b>" + n + "</b> pada tahun <b>" + r + "</b>?<br><br>"
            })
        }

        function konfirmasiBatal() {
            $.confirm({
                title: "Konfirmasi Batal!",
                type: "red",
                typeAnimated: !0,
                theme: "modern",
                icon: "far fa-times-circle",
                draggable: !1,
                columnClass: "batal col-md-4",
                buttons: {
                    cancel: {
                        text: "OK",
                        btnClass: "btn-red"
                    }
                },
                content: ""
            })
        }

        function Search(a) {
            $("#filter_status").on("change", function() {
                a.columns(3).search(this.value).draw()
            }), $("#filter_tahun").on("change", function() {
                a.columns(5).search(this.value).draw()
            })
        }
        $(document).ready(function() {
            show()
        });
    </script>
</body>

</html>