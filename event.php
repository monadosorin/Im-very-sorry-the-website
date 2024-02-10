<?php
require_once 'phps/connect.php';

if (!isset($_SESSION['nrp'])) {
    header("Location: index.php");
    exit();
}

$_SESSION['page'] = 'event';

// $nama = $_SESSION['nama'];
// $nrp = $_SESSION['nrp'];

include 'header.php';

$sqlEvent = "SELECT * FROM event";
$stmtEvent = $pdo->prepare($sqlEvent);
$stmtEvent->execute();

if (str_contains('How are you', 'are')) { 
    echo 'true';
}
?>

<!DOCTYPE html>
<html>

<body>
    <div class="container-fluid mt-3 mb-5" style="width: 90%;">
        <div class="title-row row mx-2">
            <h1 class="title"><i class="fas fa-bullhorn"></i> Daftar Acara</h1>
        </div>
        <div class="title-row row mx-2 mt-2">
            <h5 class="title">CLICK ON POSTER FOR DETAILS!</h5>
        </div>
        <?php
        if ($stmtEvent->rowCount() > 0) {
        ?>
            <div class="header row">
                <div class="col-12 col-md-4 mt-3">
                    <select class="form-control" id="filter_status" name="filter_status" style="height:40px; font-size: 12pt;" onchange="toggleFilter()">
                        <option value="">Lihat berdasarkan status acara...</option>
                        <option value="Upcoming">Upcoming</option>
                        <option value="Open Recruitment">Open Recruitment</option>
                        <option value="On Going">On Going</option>
                        <option value="Finished">Finished</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 mt-3">
                    <select class="form-control" id="filter_tahun" name="filter_tahun" style="height:40px; font-size: 12pt;" onchange="toggleFilter()">
                        <option value="">Lihat berdasarkan tahun acara...</option>
                        <?php
                        $getListYearsql = "SELECT DISTINCT year FROM event ORDER BY year DESC";
                        $getListYearstmt = $pdo->prepare($getListYearsql);
                        $getListYearstmt->execute([]);
                        while ($getListYearrow = $getListYearstmt->fetch()) {
                        ?>
                            <option value=" <?= $getListYearrow['year']; ?>"><?= $getListYearrow['year']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 col-md-4 my-3">
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" placeholder="Cari acara..." aria-label="Search" aria-describedby="search-addon" id="search" name="search" oninput="searchEvent()" />
                        <span class="input-group-text border-0" id="search-addon">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="title-row row justify-content-center" id="card-container">

        </div>
        <div class="row justify-content-center mx-2 mt-5">
            <h5 class="title">STAY TUNED FOR UPCOMING EVENTS!</h5>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        displayEvents();
    });

    function displayEvents() {
        $("#card-container").html("Harap tunggu...");

        $.ajax({
            url: "phps/refresh_events.php",
            type: "get",
            dataType: "json",
            success: function(result) {
                var data = result;
                //loop dari data
                var str = '';
                for (var i = 0; i < data.length; i++) {
                    var d = data[i];
                    str += `
                        <div class="col-12 col-md-6 col-xl-4 mt-5" style="text-transform: none;">
                            <center>
                                <div class="card mx-2 shadow bg-white rounded" style="width: 18rem;">
                                    <a target="_blank" href="` + d.url + `" style="text-decoration: none; color: black;">
                                        <img class="card-img-top" src="uploads/poster/` + d.poster_filepath + `" alt="Card image cap">
                                    </a>

                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <h3 style="font-weight: bold;">` + d.name + `</h3>
                                        </div>
                                        <div class="row mt-2 pl-3">
                                            <p class="card-text">TYPE: &nbsp;<b>` + d.type + `</b></p>
                                        </div>
                                        <div class="row mt-2 pl-3">
                                            <p class="card-text">STATUS: &nbsp;<b>` + d.status + `</b></p>
                                        </div>
                                        <div class="row mt-2 pl-3">
                                            <p class="card-text">ORGANIZER: &nbsp;<b>` + d.organizer + `</b></p>
                                        </div>
                                        <div class="row mt-2 pl-3">
                                            <p class="card-text">YEAR: &nbsp;<b>` + d.year + `</b></p>
                                        </div>
                                        <div class="row mt-2 mt-3 justify-content-center">
                                            <a type='button' style='-webkit-appearance: none; text-align: center;' class='btn btn-warning' href='uploads/poster/` + d.poster_filepath + `' target='_blank'><b>SEE THE POSTER</b></a>
                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                    `;
                }
                $("#card-container").html(str);
            },
            error: function(result) {
                //Error handling
                alert("ERROR!");
            }
        });
    }

    function toggleFilter() {
        if ($("#filter_status").val() != '' || $("#filter_tahun").val() != '') {
            $("#card-container").html("Harap tunggu...");

            var status = $("#filter_status").val();
            var tahun = $("#filter_tahun").val();
            $.ajax({
                url: "phps/refresh_events.php",
                type: "post",
                dataType: "json",
                data: {
                    status: status,
                    tahun: tahun
                },
                success: function(result) {
                    var data = result;
                    var str = '';
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            var d = data[i];
                            str += `
                                <div class="col-12 col-md-6 col-xl-4 mt-5" style="text-transform: none;">
                                    <center>
                                        <div class="card mx-2 shadow bg-white rounded" style="width: 18rem;">
                                            <a target="_blank" href="` + d.url + `" style="text-decoration: none; color: black;">
                                                <img class="card-img-top" src="uploads/poster/` + d.poster_filepath + `" alt="Card image cap">
                                            </a>

                                            <div class="card-body">
                                                <div class="row justify-content-center">
                                                    <h3 style="font-weight: bold;">` + d.name + `</h3>
                                                </div>
                                                <div class="row mt-2 pl-3">
                                                    <p class="card-text">TYPE: &nbsp;<b>` + d.type + `</b></p>
                                                </div>
                                                <div class="row mt-2 pl-3">
                                                    <p class="card-text">STATUS: &nbsp;<b>` + d.status + `</b></p>
                                                </div>
                                                <div class="row mt-2 pl-3">
                                                    <p class="card-text">ORGANIZER: &nbsp;<b>` + d.organizer + `</b></p>
                                                </div>
                                                <div class="row mt-2 pl-3">
                                                    <p class="card-text">YEAR: &nbsp;<b>` + d.year + `</b></p>
                                                </div>
                                                <div class="row mt-2 mt-3 justify-content-center">
                                                    <a type='button' style='-webkit-appearance: none; text-align: center;' class='btn btn-warning' href='uploads/poster/` + d.poster_filepath + `'><b>SEE THE POSTER</b></a>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            `;
                        }
                        $("#card-container").html(str);
                    } else {
                        $("#card-container").html("");
                    }
                },
                error: function(result) {
                    //Error handling
                    alert("ERROR!");
                }
            });
        } else {
            displayEvents();
        }
    }

    function searchEvent() {
        if ($("#search").val() != '') {
            $("#card-container").html("Harap tunggu...");

            var search = $("#search").val();
            $.ajax({
                url: "phps/refresh_events.php",
                type: "post",
                dataType: "json",
                data: {
                    search: search
                },
                success: function(result) {
                    var data = result;
                    var str = '';
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            var d = data[i];
                            str += `
                                <div class="col-12 col-md-6 col-xl-4 mt-5" style="text-transform: none;">
                                    <center>
                                        <div class="card mx-2 shadow bg-white rounded" style="width: 18rem;">
                                            <a target="_blank" href="` + d.url + `" style="text-decoration: none; color: black;">
                                                <img class="card-img-top" src="uploads/poster/` + d.poster_filepath + `" alt="Card image cap">
                                            </a>

                                            <div class="card-body">
                                                <div class="row justify-content-center">
                                                    <h3 style="font-weight: bold;">` + d.name + `</h3>
                                                </div>
                                                <div class="row mt-2 pl-3">
                                                    <p class="card-text">TYPE: &nbsp;<b>` + d.type + `</b></p>
                                                </div>
                                                <div class="row mt-2 pl-3">
                                                    <p class="card-text">STATUS: &nbsp;<b>` + d.status + `</b></p>
                                                </div>
                                                <div class="row mt-2 pl-3">
                                                    <p class="card-text">ORGANIZER: &nbsp;<b>` + d.organizer + `</b></p>
                                                </div>
                                                <div class="row mt-2 pl-3">
                                                    <p class="card-text">YEAR: &nbsp;<b>` + d.year + `</b></p>
                                                </div>
                                                <div class="row mt-2 mt-3 justify-content-center">
                                                    <a type='button' style='-webkit-appearance: none; text-align: center;' class='btn btn-warning' href='uploads/poster/` + d.poster_filepath + `'><b>SEE THE POSTER</b></a>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            `;
                        }
                        $("#card-container").html(str);
                    } else {
                        $("#card-container").html("");
                    }
                },
                error: function(result) {
                    //Error handling
                    alert("ERROR!");
                }
            });
        } else {
            displayEvents();
        }
    }
</script>

<style>
    .card {
        transition: 0.5s;
    }

    .card:hover {
        transition: 0.5s;
        transform: scale(1.1);
    }
</style>

</html>