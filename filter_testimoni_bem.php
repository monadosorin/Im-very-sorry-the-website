<?php
require_once 'phps/connect.php';

if (!isset($_SESSION['nrp'])) {
    header("Location: index.php");
    exit();
}

$_SESSION['page'] = 'filter_testimoni_bem';

$nrp = $_SESSION['nrp'];

include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>REACH – Filter Testimoni Penilaian Kuartal 1 BEM 2023/2024</title>
</head>

<style>
    pre {
        color: black !important;
    }
    .swal2-container {
        z-index: 100000000000000;
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
                id: 11
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
                    str += "<td>" + d.nrp_penilai.toUpperCase() + "</td>";
                    str += "<td>" + d.nama_penilai + "</td>";
                    testimoni = d.testimoni.replace(/'/g, "").replace(/"/g, "");
                    str += "<td class='btn-col'><a type='button' style='-webkit-appearance: none;' class='btn btn-warning' data-id='" + d.id + "' data-testimoni='" + testimoni + "' data-nama='" + d.nama + "' onclick='viewTestimoni(this)'><b>View</b></a></td>";
                    str += "<td>" + d.submitted_on + " WIB</td>";
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
    }

    function viewTestimoni(data) {
            var testimoni = data.getAttribute("data-testimoni");
            var id = data.getAttribute("data-id");
            var nama = data.getAttribute("data-nama");
            $.confirm({
                title: 'View Testimoni',
                typeAnimated: true,
                theme: 'modern',
                draggable: false,
                onOpen: function() {
                    setTimeout(() => {
                        this.$content.html(`
                        <div class="mb-3" style="color: black; text-align: center; font-size: 14pt; max-height: 400px; text-transform: none;">
                        <b><span id="nama-testi">` + nama + `</span></b><br>
                        <pre><span id="testimoni-testi">` + testimoni + `</span></pre>
                        </div>
                    `)
                    }, 100);
                },
                columnClass: "col-md-6",
                buttons: {
                    lolos: {
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
                                            title: "Terjadi Error di Server! <br>Silakan Coba Ulangi Kembali.",
                                            showConfirmButton: false,
                                            timer: 3000
                                        })
                                    }
                                }
                            });

                            if ($(data).parent().parent().next().find('.btn-col').children().attr("data-nama") == undefined) {
                                nama = $(data).parent().parent().prev().find('.btn-col').children().attr("data-nama");
                                testimoni = $(data).parent().parent().prev().find('.btn-col').children().attr("data-testimoni");
                                id = $(data).parent().parent().prev().find('.btn-col').children().attr("data-id");
                                acara = $(data).parent().parent().prev().find('.btn-col').children().attr("data-acara");

                                if (nama == undefined) {
                                    show();
                                    return true;
                                } else {
                                    data = $(data).parent().parent().prev().find('.btn-col').children();
                                    $(data).parent().parent().next().remove();
                                }
                            } else {
                                nama = $(data).parent().parent().next().find('.btn-col').children().attr("data-nama");
                                testimoni = $(data).parent().parent().next().find('.btn-col').children().attr("data-testimoni");
                                id = $(data).parent().parent().next().find('.btn-col').children().attr("data-id");
                                acara = $(data).parent().parent().next().find('.btn-col').children().attr("data-acara");

                                data = $(data).parent().parent().next().find('.btn-col').children();
                                $(data).parent().parent().prev().remove();
                            }

                            document.getElementById("nama-testi").innerHTML = nama;
                            
                            document.getElementById("testimoni-testi").innerHTML = testimoni;

                            return false;
                        }
                    },
                    tidak_lolos: {
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
                                            title: "Terjadi Error di Server! <br>Silakan Coba Ulangi Kembali.",
                                            showConfirmButton: false,
                                            timer: 3000
                                        })
                                    }
                                }
                            });

                            if ($(data).parent().parent().next().find('.btn-col').children().attr("data-nama") == undefined) {
                                nama = $(data).parent().parent().prev().find('.btn-col').children().attr("data-nama");
                                testimoni = $(data).parent().parent().prev().find('.btn-col').children().attr("data-testimoni");
                                id = $(data).parent().parent().prev().find('.btn-col').children().attr("data-id");
                                acara = $(data).parent().parent().prev().find('.btn-col').children().attr("data-acara");

                                if (nama == undefined) {
                                    show();
                                    return true;
                                } else {
                                    data = $(data).parent().parent().prev().find('.btn-col').children();
                                    $(data).parent().parent().next().remove();
                                }
                            } else {
                                nama = $(data).parent().parent().next().find('.btn-col').children().attr("data-nama");
                                testimoni = $(data).parent().parent().next().find('.btn-col').children().attr("data-testimoni");
                                id = $(data).parent().parent().next().find('.btn-col').children().attr("data-id");
                                acara = $(data).parent().parent().next().find('.btn-col').children().attr("data-acara");

                                data = $(data).parent().parent().next().find('.btn-col').children();
                                $(data).parent().parent().prev().remove();
                            }

                            document.getElementById("nama-testi").innerHTML = nama;
                            
                            document.getElementById("testimoni-testi").innerHTML = testimoni;

                            return false;
                        }
                    },
                
                    close: {
                        text: 'CLOSE',
                        btnClass: 'btn-blue',
                        action: function() {
                            show();
                        }
                    },
                    back: {
                        text: 'BACK',
                        btnClass: 'btn-warning',
                        action: function() {
                            if ($(data).parent().parent().prev().find('.btn-col').children().attr("data-nama") == undefined) {
                                alert("This is the first testimonial in table.")
                            } else {
                                nama = $(data).parent().parent().prev().find('.btn-col').children().attr("data-nama");
                                testimoni = $(data).parent().parent().prev().find('.btn-col').children().attr("data-testimoni");
                                id = $(data).parent().parent().prev().find('.btn-col').children().attr("data-id");
                                acara = $(data).parent().parent().prev().find('.btn-col').children().attr("data-acara");

                                data = $(data).parent().parent().prev().find('.btn-col').children();

                                document.getElementById("nama-testi").innerHTML = nama;
                                
                                document.getElementById("testimoni-testi").innerHTML = testimoni;
                            }

                            return false;
                        }
                    },
                    next: {
                        text: 'NEXT',
                        btnClass: 'btn-warning',
                        action: function() {
                            if ($(data).parent().parent().next().find('.btn-col').children().attr("data-nama") == undefined) {
                                alert("This is the last testimonial in table.")
                            } else {
                                nama = $(data).parent().parent().next().find('.btn-col').children().attr("data-nama");
                                testimoni = $(data).parent().parent().next().find('.btn-col').children().attr("data-testimoni");
                                id = $(data).parent().parent().next().find('.btn-col').children().attr("data-id");
                                acara = $(data).parent().parent().next().find('.btn-col').children().attr("data-acara");

                                data = $(data).parent().parent().next().find('.btn-col').children();

                                document.getElementById("nama-testi").innerHTML = nama;
                                
                                document.getElementById("testimoni-testi").innerHTML = testimoni;
                            }

                            return false;
                        }
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
            <h1 class="title"><i class="fas fa-filter"></i> FILTER TESTIMONI</h1>
        </div>
        <?php
        $cekTestimonisql = "SELECT * FROM bem_kuartal1_2024";
        $cekTestimonistmt = $pdo->prepare($cekTestimonisql);
        $cekTestimonistmt->execute();
        if ($cekTestimonistmt->rowCount() > 0) {
        ?>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                    <select class="form-control" id="filter_jabatan" name="filter_jabatan" style="height:40px; font-size: 12pt;">
                        <option value="">Lihat berdasarkan jabatan...</option>
                        <?php
                        $getJabatansql = "SELECT * FROM bem_jabatan_2022";
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
        <?php
        }
        ?>
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
                            <td>NRP Penilai</td>
                            <td>Nama Penilai</td>
                            <td>Testimoni</td>
                            <td>Submitted On</td>
                        </tr>
                    </thead>
                    <tbody id="testimoniTableBody" style="text-align: center;">

                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="testimoni_tidak_lolos_bem.php" class="btn btn-danger container-fluid mb-3" style="width: 220px;"><b>Testimoni Tidak Lolos</b></a></center>
        <center><a href="filter_history_bem.php" class="btn btn-success container-fluid mb-3" style="width: 220px;"><b>Filter History</b></a></center>
        <center><a href="database.php" class="btn btn-warning container-fluid mb-5" style="width: 220px;"><b>Back</b></a></center>
    </div>
</body>

</html>