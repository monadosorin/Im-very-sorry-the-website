<?php
require_once 'phps/connect.php';

if (!isset($_SESSION['nrp'])) {
    header("Location: index.php");
    exit();
}

$_SESSION['page'] = 'status_fungsio_bem';

$nrp = $_SESSION['nrp'];

include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>REACH – Status Fungsionaris Penilaian Kuartal 1 BEM 2021/2022</title>
</head>

<style>
    pre {
        color: black !important;
    }
</style>

<script>
    var ajaxcall;

    function show() {
        $("#testimoniTableBody").html("<span>Harap tunggu...</span>");

        if (ajaxcall != null) {
            ajaxcall.abort();
        }

        $.ajax({
            url: "phps/refresh_data.php",
            type: "get",
            dataType: "json",
            data: {
                id: 14
            },
            success: function(result) {
                $("#testimoniTable").dataTable().fnDestroy();
                var data = result;
                var str = "";
                var num = 1;
                //loop dari data
                for (var i = 0; i < data.length; i++) {
                    var d = data[i];
                    str += "<tr>";
                    str += "<td>" + num + "</td>";
                    str += "<td>" + d.nrp.toUpperCase() + "</td>";
                    str += "<td>" + d.nama + "</td>";
                    str += "<td>" + d.jabatan + "</td>";
                    str += "<td>" + d.id_bidang + "</td>";
                    if (d.status == 0) {
                        str += '<td style="color: red; font-weight: bold;"><i class="fas fa-times"></i></td>';
                        str += "<td hidden>no</td>";
                    } else {
                        str += '<td style="color: green; font-weight: bold;"><i class="fas fa-check"></i></td>';
                        str += "<td hidden>yes</td>";
                    }
                    str += "</tr>";
                    num += 1;
                }
                $("#testimoniTableBody").html(str);
                var table = $('#testimoniTable').DataTable({
                    "oLanguage": {
                        "sEmptyTable": "Terima Kasih! Semua Testimoni Sudah Dilakukan Filter"
                    }
                });
                Search(table);
            },
            error: function(result) {
                //Error handling
                alert("ERROR!");
                // console.log();

            }
        });
    }

    function Search(table) {
        $("#filter_jabatan").on("change", function() {
            table.columns(3).search(this.value).draw();
        });
        $("#filter_bidang").on("change", function() {
            table.columns(4).search(this.value).draw();
        });
        $("#filter_status").on("change", function() {
            table.columns(6).search(this.value).draw();
        });
    }

    function viewTestimoni(data) {
        var testimoni = data.getAttribute("data-testimoni");
        var id = data.getAttribute("data-id");
        $.confirm({
            title: 'View Testimoni',
            typeAnimated: true,
            theme: 'modern',
            draggable: false,
            onOpen: function() {
                setTimeout(() => {
                    this.$content.html(`
                        <div class="mb-3" style="color: black; text-align: center; font-size: 14pt; max-height: 400px; text-transform: none;"><pre>` + testimoni + `</pre></div>
                    `)
                }, 100);
            },
            columnClass: "col-md-6",
            buttons: {
                confirm: {
                    text: 'LOLOS',
                    btnClass: 'btn-green',
                    action: function() {
                        $.ajax({
                            url: "phps/update_testimoni.php",
                            method: "POST",
                            data: {
                                id: id,
                                ajaxid: 5
                            },
                            success: function(res) {
                                show();
                                if (res == 'true') {
                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "Lolos!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                } else if (res == 'false') {
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                }
                            }
                        });
                    }
                },
                cancel: {
                    text: 'TIDAK LOLOS',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: "phps/update_testimoni.php",
                            method: "POST",
                            data: {
                                id: id,
                                ajaxid: 6
                            },
                            success: function(res) {
                                show();
                                if (res == 'true') {
                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "Tidak Lolos!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                } else if (res == 'false') {
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "Terjadi Error di Server! <br>Silakan Contact Departemen Information System BEM UK Petra.",
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                }
                            }
                        });
                    }
                },
                andMore: {
                    text: 'CANCEL',
                    btnClass: 'btn-blue',
                    action: function() {}
                }
            },
            content: `
            <div style="height: 100px; display: grid; place-items: center;">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            `
        });
    }

    $(document).ready(function() {
        show();
    });
</script>

<body>
    <div class="container-fluid" style="margin-top: 30px;">
        <div class="title-row row mx-4">
            <h1 class="title"><i class="fas fa-users"></i> STATUS FUNGSIONARIS BEM</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                <select class="form-control" id="filter_jabatan" name="filter_jabatan" style="height:40px; font-size: 12pt;">
                    <option value="">Lihat berdasarkan jabatan...</option>
                    <?php
                    $getJabatansql = "SELECT * FROM bem_jabatan_2024";
                    $getJabatanstmt = $pdo->prepare($getJabatansql);
                    $getJabatanstmt->execute([]);
                    while ($getJabatan = $getJabatanstmt->fetch()) {
                    ?>
                        <option value="<?= $getJabatan['nama']; ?>"><?= $getJabatan['nama']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                <select class="form-control" id="filter_bidang" name="filter_bidang" style="height:40px; font-size: 12pt;">
                    <option value="">Lihat berdasarkan bidang...</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                <select class="form-control" id="filter_status" name="filter_status" style="height:40px; font-size: 12pt;">
                    <option value="">Lihat berdasarkan status...</option>
                    <option value="yes">Sudah atau Masih Dalam Proses Melakukan Penilaian Kuartal 3 BEM</option>
                    <option value="no">Belum Melakukan Penilaian Kuartal 3 BEM</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;overflow-x: auto;">
            <div class="col-12" style="overflow-x: auto;">
                <table class="table table-hovered table-striped" id="testimoniTable" style="color: #412c27; width: 100%">
                    <thead style="text-align: center; font-weight: bold;">
                        <tr>
                            <td style="width: 5%;">#</td>
                            <td>NRP</td>
                            <td>Nama</td>
                            <td>Jabatan</td>
                            <td>Bidang</td>
                            <td>Status</td>
                            <td hidden>Filter Status</td>
                        </tr>
                    </thead>
                    <tbody id="testimoniTableBody" style="text-align: center;">

                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="database.php" class="btn btn-warning container-fluid mb-5 mt-3" style="width: 220px;"><b>Back</b></a></center>
    </div>
</body>

</html>