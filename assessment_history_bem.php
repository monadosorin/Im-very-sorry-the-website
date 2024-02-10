<?php
require_once 'phps/connect.php';

if (!isset($_SESSION['nrp'])) {
    header("Location: index.php");
    exit();
}

$_SESSION['page'] = 'assessment_history_bem';

$nrp = $_SESSION['nrp'];

include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>REACH - Assessment History</title>
</head>

<script>
    var ajaxcall;

    function show() {
        $("#historyTableBody").html("<span>Harap tunggu...</span>");

        if (ajaxcall != null) {
            ajaxcall.abort();
        }

        $.ajax({
            url: "phps/refresh_data.php",
            type: "get",
            dataType: "json",
            data: {
                id: 10
            },
            success: function(result) {
                $("#historyTable").dataTable().fnDestroy();
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
                    str += "<td style='width: 20%;'>" + d.submitted_on + " WIB</td>";
                    str += "</tr>";
                    num += 1;
                }
                $("#historyTableBody").html(str);
                var table = $('#historyTable').DataTable({
                    "oLanguage": {
                        "sEmptyTable": "Anda Masih Belum Pernah Melakukan Penilaian Kuartal II BEM 2021/2022"
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
        $("#filter_acara").on("change", function() {
            table.columns(5).search(this.value).draw();
        });
    }

    $(document).ready(function() {
        show();
    });
</script>

<style>
    body {
        background-image: url('./assets/background/cv.png');
        color: white !important;
        background-color: #C55D50;
    }

    table {
        color: white !important;
        background-color: #D67C55;
    }

    td {
        vertical-align: middle !important;
    }

    ::-webkit-scrollbar {
        width: 8px;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #C55D50;
    }

    ::-webkit-scrollbar-thumb {
        background: #FDCD5F;
        /* border-radius: 10px; */
        background-clip: padding-box;
    }

    .btn {
        transition: 0.3s;
        background-color: #fdcd5f;
        border: none;
        border-radius: 25px;
        color: black;
        -webkit-appearance: none;
        font-weight: bold;
    }

    .btn:hover {
        transition: 0.3s;
        background: #7C6ED1 !important;
        color: white !important;
    }
</style>

<body>
    <div class="container-fluid" style="margin-top: 30px;">
        <div class="title-row row mx-4">
            <h1 class="title" style="letter-spacing:5px; color:#FDCD5F;"><i class="fas fa-history"></i> Assessment History</h1>
        </div>
        <div class="row" style="margin-top: 20px; overflow-x: auto;">
            <div class="col-12" style="overflow-x: auto;">
                <table class="table table-hovered table-striped" id="historyTable" style="color: #412c27; width: 100%">
                    <thead style="text-align: center; font-weight: bold;">
                        <tr>
                            <td style="width: 5%;">#</td>
                            <td>NRP</td>
                            <td>Nama</td>
                            <td>Jabatan</td>
                            <td>Bidang</td>
                            <td>Tanggal dan Waktu Submit</td>
                        </tr>
                    </thead>
                    <tbody id="historyTableBody" style="text-align: center;">

                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="choose_assessment.php" class="btn mb-5" style="width: 150px;">Back</a></center>
    </div>
</body>

</html>