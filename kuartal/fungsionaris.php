<?php
require_once "../phps/connect.php";
// Note : pada kuartal 1 = semua db bem_kuartal1_2024 jadi bem_kuartal1_2024
$getMahasiswasql = "SELECT a.id, a.nama, a.nrp, a.id_bidang, c.nama as jabatan, b.nama as departemen, b.singkatan FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE a.id = ?";
$getMahasiswasstmt = $pdo->prepare($getMahasiswasql);
$getMahasiswasstmt->execute([$_GET['id']]);
$getMahasiswa = $getMahasiswasstmt->fetch();

// if ($getMahasiswa['jabatan'] != 'Ketua UKM') {
    $getFungsiosql = "SELECT AVG(a.caring) as caring, AVG(a.cooperativeness) as cooperativeness, AVG(a.problem_solving) as problem_solving, AVG(a.responsibility) as responsibility, AVG(a.decision) as decision, AVG(a.time) as time, AVG(a.communicative) as communicative, AVG(a.politeness) as politeness, AVG(a.openMinded) as openMinded, AVG(a.trust) as trust, (AVG(a.caring) + AVG(a.cooperativeness) + AVG(a.problem_solving) + AVG(a.responsibility) + AVG(a.decision) + AVG(a.time) + AVG(a.communicative) + AVG(a.politeness) + AVG(a.openMinded) + AVG(a.trust)) / 10 as overall FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE a.id_fungsionaris = ? AND a.caring != 0";
    $getFungsiostmt = $pdo->prepare($getFungsiosql);
    $getFungsiostmt->execute([$_GET['id']]);
    $getFungsio = $getFungsiostmt->fetch();

    if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
        if ($getMahasiswa['jabatan'] != 'Internship') {
            $getDepartemensql = "SELECT AVG(a.caring) as caring, AVG(a.cooperativeness) as cooperativeness, AVG(a.problem_solving) as problem_solving, AVG(a.responsibility) as responsibility, AVG(a.decision) as decision, AVG(a.time) as time, AVG(a.communicative) as communicative, AVG(a.politeness) as politeness, AVG(a.openMinded) as openMinded, AVG(a.trust) as trust, (AVG(a.caring) + AVG(a.cooperativeness) + AVG(a.problem_solving) + AVG(a.responsibility) + AVG(a.decision) + AVG(a.time) + AVG(a.communicative) + AVG(a.politeness) + AVG(a.openMinded) + AVG(a.trust)) / 10 as overall FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
        } else {
            $getDepartemensql = "SELECT AVG(a.caring) as caring, AVG(a.cooperativeness) as cooperativeness, AVG(a.problem_solving) as problem_solving, AVG(a.responsibility) as responsibility, AVG(a.decision) as decision, AVG(a.time) as time, AVG(a.communicative) as communicative, AVG(a.politeness) as politeness, AVG(a.openMinded) as openMinded, AVG(a.trust) as trust, (AVG(a.caring) + AVG(a.cooperativeness) + AVG(a.problem_solving) + AVG(a.responsibility) + AVG(a.decision) + AVG(a.time) + AVG(a.communicative) + AVG(a.politeness) + AVG(a.openMinded) + AVG(a.trust)) / 10 as overall FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND b.id_jabatan = 10 AND a.caring != 0";
        }
        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
        $getDepartemenstmt->execute([$getMahasiswa['departemen']]);
        $getDepartemen = $getDepartemenstmt->fetch();
    }

    if ($getMahasiswa['jabatan'] != 'Internship') {
        $getBidangsql = "SELECT AVG(a.caring) as caring, AVG(a.cooperativeness) as cooperativeness, AVG(a.problem_solving) as problem_solving, AVG(a.responsibility) as responsibility, AVG(a.decision) as decision, AVG(a.time) as time, AVG(a.communicative) as communicative, AVG(a.politeness) as politeness, AVG(a.openMinded) as openMinded, AVG(a.trust) as trust, (AVG(a.caring) + AVG(a.cooperativeness) + AVG(a.problem_solving) + AVG(a.responsibility) + AVG(a.decision) + AVG(a.time) + AVG(a.communicative) + AVG(a.politeness) + AVG(a.openMinded) + AVG(a.trust)) / 10 as overall FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
    } else {
        $getBidangsql = "SELECT AVG(a.caring) as caring, AVG(a.cooperativeness) as cooperativeness, AVG(a.problem_solving) as problem_solving, AVG(a.responsibility) as responsibility, AVG(a.decision) as decision, AVG(a.time) as time, AVG(a.communicative) as communicative, AVG(a.politeness) as politeness, AVG(a.openMinded) as openMinded, AVG(a.trust) as trust, (AVG(a.caring) + AVG(a.cooperativeness) + AVG(a.problem_solving) + AVG(a.responsibility) + AVG(a.decision) + AVG(a.time) + AVG(a.communicative) + AVG(a.politeness) + AVG(a.openMinded) + AVG(a.trust)) / 10 as overall FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND b.id_jabatan = 10 AND a.caring != 0";
    }
    $getBidangstmt = $pdo->prepare($getBidangsql);
    $getBidangstmt->execute([$getMahasiswa['id_bidang']]);
    $getBidang = $getBidangstmt->fetch();

    if ($getMahasiswa['jabatan'] != 'Internship') {
        $getBEMsql = "SELECT AVG(a.caring) as caring, AVG(a.cooperativeness) as cooperativeness, AVG(a.problem_solving) as problem_solving, AVG(a.responsibility) as responsibility, AVG(a.decision) as decision, AVG(a.time) as time, AVG(a.communicative) as communicative, AVG(a.politeness) as politeness, AVG(a.openMinded) as openMinded, AVG(a.trust) as trust, (AVG(a.caring) + AVG(a.cooperativeness) + AVG(a.problem_solving) + AVG(a.responsibility) + AVG(a.decision) + AVG(a.time) + AVG(a.communicative) + AVG(a.politeness) + AVG(a.openMinded) + AVG(a.trust)) / 10 as overall FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE a.caring != 0";
    } else {
        $getBEMsql = "SELECT AVG(a.caring) as caring, AVG(a.cooperativeness) as cooperativeness, AVG(a.problem_solving) as problem_solving, AVG(a.responsibility) as responsibility, AVG(a.decision) as decision, AVG(a.time) as time, AVG(a.communicative) as communicative, AVG(a.politeness) as politeness, AVG(a.openMinded) as openMinded, AVG(a.trust) as trust, (AVG(a.caring) + AVG(a.cooperativeness) + AVG(a.problem_solving) + AVG(a.responsibility) + AVG(a.decision) + AVG(a.time) + AVG(a.communicative) + AVG(a.politeness) + AVG(a.openMinded) + AVG(a.trust)) / 10 as overall FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_jabatan = 10 AND a.caring != 0";
    }
    $getBEMstmt = $pdo->prepare($getBEMsql);
    $getBEMstmt->execute();
    $getBEM = $getBEMstmt->fetch();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
    ?>
        <title><?= $getMahasiswa['singkatan'] ?>_<?= $getMahasiswa['nama'] ?></title>
    <?php
    } else {
    ?>
        <title>BPH_<?= $getMahasiswa['nama'] ?></title>
    <?php
    }
    ?>
</head>

<body>
    <div class="container mt-5 center" style="width:2480px;font-family:Times New Roman;font-size: 14pt;">
        <div class="row mx-5 justify-content-center">
            <div class="col-md-2">
                <center>
                    <img src="./ukp.png" alt="" style="width: 120px;">
                </center>
            </div>
            <div class="col-md-8">
                <h5 style="font-weight:bold; font-size:12pt;text-align:center;line-height: 0.8;">PENILAIAN KUARTAL I1 BEM</h5>
                <h5 style="font-weight:bold; font-size:12pt;text-align:center;line-height: 0.8;"><i>HUMAN RESOURCE DEVELOPMENT DEPARTMENT</i></h5>
                <h5 style="font-weight:bold; font-size:12pt;text-align:center;line-height: 0.8;">BADAN EKSEKUTIF MAHASISWA</h5>
                <h5 style="font-weight:bold; font-size:12pt;text-align:center;line-height: 0.8;">UNIVERSITAS KRISTEN PETRA</h5>
                <h5 style="font-size:12pt;text-align:center;line-height: 0.8;">Jl. Siwalankerto 121-131 Ged. E – 101 Surabaya 60236</h5>
                <h5 style="font-size:12pt;text-align:center;line-height: 0.8;">Telp. 8494830 – 8439040 psw 3919</h5>
                <h5 style="font-size:12pt;text-align:center;line-height: 0.8;"><i>E-mail</i> : <span style="font-family: Calibri;"><u>bem_ukp@petra.ac.id</u></span></h5>
            </div>
            <div class="col-md-2">
                <center>
                    <img src="./bem_ukp.png" alt="" style="width: 120px;">
                </center>
            </div>
        </div>

        <hr style="border: 5px solid #602322;">

        <style>
            li,
            h5,
            p {
                line-height: 1.5;
                font-size: 14pt !important;
            }

            .content {
                padding: 20px 50px;
            }
        </style>

        <div class="content">
            <?php
            if ($getMahasiswa['jabatan'] != 'Internship') {
            ?>
                <p>Hal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<b><u>Penilaian Kuartal I Anggota BEM</u></b></p>
            <?php
            } else {
            ?>
                <p>Hal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<b><u>Penilaian <i>Internship</i> BEM</u></b></p>
            <?php
            }
            ?>

            <ol type="I">
                <?php
                if ($getMahasiswa['jabatan'] != 'Internship') {
                ?>
                    <li>Identitas Fungsionaris</li>
                <?php
                } else {
                ?>
                    <li>Identitas <i>Internship</i> BEM</li>
                <?php
                }
                ?>
                <ol style="list-style-type: none;">
                    <li>Nama<span style="padding-left: 70px;">: &nbsp;<b><?= $getMahasiswa['nama'] ?></b></span></li>
                    <li>NRP<span style="padding-left: 78px;">: &nbsp;<b><?= $getMahasiswa['nrp'] ?></b></span></li>
                    <?php
                    if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                    ?>
                        <li>Departemen<span style="padding-left: 23px;">: &nbsp;<b><?= $getMahasiswa['departemen'] ?></b></span></li>
                        <?php
                        if ($getMahasiswa['jabatan'] != 'Internship') {
                        ?>
                            <li>Jabatan<span style="padding-left: 58px;">: &nbsp;<b><?= $getMahasiswa['jabatan'] ?></b></span></li>
                        <?php
                        }
                        ?>
                        <?php
                    } else {
                        if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                        ?>
                            <li>Jabatan<span style="padding-left: 58px;">: &nbsp;<b><?= $getMahasiswa['jabatan'] ?></b></span></li>
                        <?php
                        } else if ($getMahasiswa['jabatan'] == 'Kepala Bidang' || $getMahasiswa['jabatan'] == 'Wakil Kepala Bidang') {
                        ?>
                            <li>Jabatan<span style="padding-left: 58px;">: &nbsp;<b><?= $getMahasiswa['jabatan'] . " " . $getMahasiswa['id_bidang'] ?></b></span></li>
                    <?php
                        }
                    }
                    ?>
                </ol>
                <br>
                <li>Hasil Penilaian</li>
                <ol type="A">
                    <?php
                    // if ($getMahasiswa['jabatan'] != 'Ketua UKM') {
                    ?>
                        <li>Penerapan Nilai PETRA dan #SATU</li>
                        <ol>
                            <li>Pribadi</li>
                            <div class="radar-outer-row row justify-content-center">
                                <div class="radar-row" style="border: 1px solid black; padding: 10px 30px;">
                                    <h3 style="text-align: center; font-size: 12pt;font-weight: bold;"><?= $getMahasiswa['nama'] ?></h3>
                                    <canvas id="myChart" width="400" height="300"></canvas>
                                    <script>
                                        var ctx = document.getElementById('myChart').getContext('2d');

                                        var myChart = new Chart(ctx, {
                                            type: 'radar',
                                            data: {
                                                labels: ['Caring', 'Cooperativeness', 'Problem Solving', 'Responsibility', 'Decision', 'Time', 'Communicative', 'Politeness', 'Open Minded', 'Trustworthy'],
                                                datasets: [{
                                                    label: '[Nama Fungsio]',
                                                    fontFamily: 'Times News Roman',
                                                    data: [<?= $getFungsio['caring'] ?>, <?= $getFungsio['cooperativeness'] ?>, <?= $getFungsio['problem_solving'] ?>, <?= $getFungsio['responsibility'] ?>, <?= $getFungsio['decision'] ?>, <?= $getFungsio['time'] ?>, <?= $getFungsio['communicative'] ?>, <?= $getFungsio['politeness'] ?>, <?= $getFungsio['openMinded'] ?>, <?= $getFungsio['trust'] ?>],
                                                    borderColor: [
                                                        'blue',
                                                        'blue',
                                                        'blue',
                                                        'blue',
                                                        'blue',
                                                        'blue',
                                                        'blue',
                                                        'blue',
                                                        'blue'
                                                    ],
                                                    borderWidth: 5,
                                                }],
                                                pointLabelFontSize: 14,
                                            },
                                            options: {
                                                scale: {
                                                    ticks: {
                                                        min: 0,
                                                        max: 4,
                                                        stepSize: 0.5,
                                                        fontSize: 14
                                                    },
                                                    gridLines: {
                                                        color: ['gray', 'gray', 'gray', 'gray', 'gray', 'gray', 'gray', 'gray']
                                                    },
                                                    pointLabels: {
                                                        fontColor: 'black',
                                                        fontFamily: 'Times News Roman',
                                                        fontSize: 12
                                                    }
                                                },
                                                legend: {
                                                    display: false
                                                },
                                                tooltips: {
                                                    callbacks: {
                                                        label: function(tooltipItem) {
                                                            return tooltipItem.yLabel;
                                                        }
                                                    }
                                                }
                                            }
                                        });

                                        function beforePrintHandler() {
                                            for (var id in Chart.instances) {
                                                Chart.instances[id].resize();
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                            <p class="mt-2" style="text-align: center;">Rata-rata: <?= number_format((float)$getFungsio['overall'], 1, ',', '') ?>/4,0⭐</p>
                            <?php
                            if ($getMahasiswa['jabatan'] != 'Internship') {
                            ?>
                                <li>Penilaian Kumulatif Fungsionaris BEM</li>
                            <?php
                            } else {
                            ?>
                                <li>Penilaian Kumulatif <i>Internship</i> BEM</li>
                            <?php
                            }
                            ?>

                            <style>
                                .table-container {
                                    display: grid;
                                    place-items: center;
                                    position: relative;
                                }

                                table {
                                    position: relative;
                                    top: 1vh;
                                    <?php
                                    if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum' || $getMahasiswa['jabatan'] == 'Kepala Bidang' || $getMahasiswa['jabatan'] == 'Wakil Kepala Bidang') {
                                    ?>left: -12vw;
                                    <?php
                                    }
                                    ?>
                                }
                            </style>

                            <div class="table-container">
                                <table style="border:1px solid black;font-family:Times New Roman;">
                                    <thead style="font-weight: bold; border:1px solid black; text-align: center;">
                                        <tr>
                                            <th style="border: 1px solid black;width:23%;line-height: 1.2;">Kriteria</th>
                                            <th style="border: 1px solid black;padding:10px 20px;line-height: 1.2;"><?= $getMahasiswa['nama'] ?></th>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <th style="border: 1px solid black;padding:0px 20px;line-height: 1.2;">Departemen<br><?= $getMahasiswa['singkatan'] ?></th>
                                                <th style="border: 1px solid black;padding:0px 20px;line-height: 1.2;">Bidang <?= $getMahasiswa['id_bidang'] ?></th>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <th style="border: 1px solid black;padding:0px 20px;line-height: 1.2;">Bidang <?= $getMahasiswa['id_bidang'] ?></th>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                    ?>
                                                        <th style="border: 1px solid black;padding:0px 20px;line-height: 1.2;"> Bidang <?= $i ?></th>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                    ?>
                                                        <th style="border: 1px solid black;padding:0px 20px;line-height: 1.2;">Departemen<br><?= $getDepartemenBidang['singkatan'] ?></th>
                                                    <?php
                                                    }
                                                    ?>
                                                    <th style="border: 1px solid black;padding:0px 20px;line-height: 1.2;">Bidang <?= $getMahasiswa['id_bidang'] ?></th>
                                                <?php
                                                }
                                            }

                                            if ($getMahasiswa['jabatan'] != 'Internship') {
                                                ?>
                                                <th style="border: 1px solid black;padding:0px 20px;line-height: 1.2;">Semua Anggota BEM</th>
                                            <?php
                                            } else {
                                            ?>
                                                <th style="border: 1px solid black;padding:0px 20px;line-height: 1.2;">Semua <i>Intern</i> BEM</th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody style="border:1px solid black; text-align: center;">
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;padding:0px 10px;">Caring</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['caring'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['caring'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['caring'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['caring'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.caring) as caring FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['caring'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.caring) as caring FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['caring'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['caring'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['caring'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;">Cooperativeness</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['cooperativeness'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['cooperativeness'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['cooperativeness'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['cooperativeness'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.cooperativeness) as cooperativeness FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['cooperativeness'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.cooperativeness) as cooperativeness FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['cooperativeness'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['cooperativeness'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['cooperativeness'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;">Problem Solving</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['problem_solving'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['problem_solving'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['problem_solving'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['problem_solving'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.problem_solving) as problem_solving FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['problem_solving'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.problem_solving) as problem_solving FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['problem_solving'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['problem_solving'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['problem_solving'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;">Responsibility</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['responsibility'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['responsibility'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['responsibility'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['responsibility'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.responsibility) as responsibility FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['responsibility'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.responsibility) as responsibility FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['responsibility'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['responsibility'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['responsibility'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;">Decision</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['decision'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['decision'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['decision'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['decision'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.decision) as decision FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['decision'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.decision) as decision FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['decision'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['decision'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['decision'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;">Time</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['time'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['time'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['time'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['time'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.time) as time FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['time'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.time) as time FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['time'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['time'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['time'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;">Communicative</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['communicative'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['communicative'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['communicative'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['communicative'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.communicative) as communicative FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['communicative'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.communicative) as communicative FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['communicative'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['communicative'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['communicative'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;padding:0px 10px;">Politeness</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['politeness'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['politeness'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['politeness'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['politeness'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.politeness) as politeness FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['politeness'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.politeness) as politeness FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['politeness'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['politeness'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['politeness'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;">Open Minded</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['openMinded'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['openMinded'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['openMinded'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['openMinded'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.openMinded) as openMinded FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['openMinded'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.openMinded) as openMinded FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['openMinded'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['openMinded'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['openMinded'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;">Trustworthy</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['trust'], 2, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['trust'], 2, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['trust'], 2, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['trust'], 2, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT AVG(a.trust) as trust FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['trust'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT AVG(a.trust) as trust FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['trust'], 2, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['trust'], 2, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['trust'], 2, ',', '') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; font-weight: bold;">Rating</td>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getFungsio['overall'], 1, ',', '') ?></td>
                                            <?php
                                            if ($getMahasiswa['jabatan'] != 'Ketua BEM' && $getMahasiswa['jabatan'] != 'Sekretaris Umum' && $getMahasiswa['jabatan'] != 'Bendahara Umum' && $getMahasiswa['jabatan'] != 'Kepala Bidang' && $getMahasiswa['jabatan'] != 'Wakil Kepala Bidang') {
                                            ?>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['overall'], 1, ',', '') ?></td>
                                                <td style="border: 1px solid black;"><?= number_format((float)$getBidang['overall'], 1, ',', '') ?></td>
                                                <?php
                                            } else {
                                                if ($getMahasiswa['jabatan'] == 'Ketua BEM' || $getMahasiswa['jabatan'] == 'Sekretaris Umum' || $getMahasiswa['jabatan'] == 'Bendahara Umum') {
                                                ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['overall'], 1, ',', '') ?></td>
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $getBidangisql = "SELECT (AVG(a.caring) + AVG(a.cooperativeness) + AVG(a.problem_solving) + AVG(a.responsibility) + AVG(a.decision) + AVG(a.time) + AVG(a.communicative) + AVG(a.politeness) + AVG(a.openMinded) + AVG(a.trust)) / 10 as overall FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id WHERE b.id_bidang = ? AND a.caring != 0";
                                                        $getBidangistmt = $pdo->prepare($getBidangisql);
                                                        $getBidangistmt->execute([$i]);
                                                        $getBidangi = $getBidangistmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getBidangi['overall'], 1, ',', '') ?></td>
                                                    <?php
                                                    }
                                                } else {
                                                    $getDepartemenBidangsql = "SELECT * FROM bem_departemen_2024 WHERE bidang = ?";
                                                    $getDepartemenBidangstmt = $pdo->prepare($getDepartemenBidangsql);
                                                    $getDepartemenBidangstmt->execute([$getMahasiswa['id_bidang']]);
                                                    while ($getDepartemenBidang = $getDepartemenBidangstmt->fetch()) {
                                                        $getDepartemensql = "SELECT (AVG(a.caring) + AVG(a.cooperativeness) + AVG(a.problem_solving) + AVG(a.responsibility) + AVG(a.decision) + AVG(a.time) + AVG(a.communicative) + AVG(a.politeness) + AVG(a.openMinded) + AVG(a.trust)) / 10 as overall FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_departemen_2024 c ON b.id_departemen = c.id WHERE c.nama = ? AND a.caring != 0";
                                                        $getDepartemenstmt = $pdo->prepare($getDepartemensql);
                                                        $getDepartemenstmt->execute([$getDepartemenBidang['nama']]);
                                                        $getDepartemen = $getDepartemenstmt->fetch();
                                                    ?>
                                                        <td style="border: 1px solid black;"><?= number_format((float)$getDepartemen['overall'], 1, ',', '') ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td style="border: 1px solid black;"><?= number_format((float)$getBidang['overall'], 1, ',', '') ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <td style="border: 1px solid black;"><?= number_format((float)$getBEM['overall'], 1, ',', '') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <style>
                                .page_break {
                                    page-break-before: always;
                                }
                            </style>
                            <div class="page_break"></div>

                            <br>
                            <br>

                            <ul style="list-style-type: square;text-align: justify;">
                                <li>Value PETRA dan #SATU</li>
                                <?php if ($getMahasiswa['jabatan'] != 'Internship') {?>
                                <ol type="i">
                                    <li>Caring (Proaktif)</li>
                                    <h5 style="font-size: 12pt;">Fungsio memilki kepekaan dan peduli dengan keadaan di sekitarnya, berinisiatif untuk membantu baik secara emosional dan fisikal.</h5>
                                    <li>Cooperativeness (Proaktif)</li>
                                    <h5 style="font-size: 12pt;">Fungsio ringan tangan untuk bekerja sama dan tidak semaunya sendiri, serta aktif dalam memberikan solusi/masukan yang membangun kepada fungsio lain.</h5>
                                    <li>Problem Solving (Progresif)</li>
                                    <h5 style="font-size: 12pt;">Saat fungsio dihadapkan dengan masalah, fungsio tersebut mampu menyelesaikan masalah yang ada dengan penuh integritas, sehingga layak dipercaya untuk menerima tanggung jawab.</h5>
                                    <li>Responsibility (Progresif)</li>
                                    <h5 style="font-size: 12pt;">Fungsio dapat bertanggung jawab akan tugas yang telah diberikan dan menyelesaikan sesuatu yang sudah dimulainya baik karena hasil keputusan atau akibat dari suatu tindakannya sendiri.</h5>
                                    <li>Decision Making (Progresif)</li>
                                    <h5 style="font-size: 12pt;">Fungsio dapat melihat pola kesalahan yang telah terjadi sebelumnya serta menerima masukan dan menggunakannya sebagai bahan pertimbangan untuk mengambil keputusan yang terbaik.</h5>
                                    <li>Time Management (Professional)</li>
                                    <h5 style="font-size: 12pt;">Fungsio dapat mengatur waktunya dengan baik sehingga tugas-tugasnya dapat terselesaikan tepat waktu.</h5>
                                    <li>Communicative (Professional)</li>
                                    <h5 style="font-size: 12pt;">Fungsio dapat mengkomunikasikan pendapat dan kendalanya dengan cara yang efektif sehingga meminimalisir adanya miskomunikasi dalam kerja sama.</h5>
                                    <li>Politeness (Professional)</li>
                                    <h5 style="font-size: 12pt;">Fungsio mampu berkomunikasi dengan pihak internal maupun eksternal dengan tata cara yang baik dan benar, sehingga mampu menjalin kolaborasi yang berdampak.</h5>
                                    <li>Open Mindedness (Potensial)</li>
                                    <h5 style="font-size: 12pt;">Fungsio terbuka untuk menerima kritik atau saran dari orang lain dan bersedia mempertimbangkannya demi mewujudkan tujuan-tujuan organisasi dengan lebih baik lagi.</h5>
                                    <li>Trustworthy (Potensial)</li>
                                    <h5 style="font-size: 12pt;">Fungsio dapat dipercaya untuk menyelesaikan suatu tugas dan mampu mempertanggungjawabkan tindakannya, serta senantiasa bersikap jujur dan menepati janji.</h5>
                                </ol>
                                <?php }else{?>
                                    <ol type="i">
                                    <li>Caring (Proaktif)</li>
                                    <h5 style="font-size: 12pt;">Intern memilki kepekaan dan peduli dengan keadaan di sekitarnya, berinisiatif untuk membantu baik secara emosional dan fisikal.</h5>
                                    <li>Cooperativeness (Proaktif)</li>
                                    <h5 style="font-size: 12pt;">Intern ringan tangan untuk bekerja sama dan tidak semaunya sendiri, serta aktif dalam memberikan solusi/masukan yang membangun kepada intern lain.</h5>
                                    <li>Problem Solving (Progresif)</li>
                                    <h5 style="font-size: 12pt;">Saat intern dihadapkan dengan masalah, intern tersebut mampu menyelesaikan masalah yang ada dengan penuh integritas, sehingga layak dipercaya untuk menerima tanggung jawab.</h5>
                                    <li>Responsibility (Progresif)</li>
                                    <h5 style="font-size: 12pt;">Intern dapat bertanggung jawab akan tugas yang telah diberikan dan menyelesaikan sesuatu yang sudah dimulainya baik karena hasil keputusan atau akibat dari suatu tindakannya sendiri.</h5>
                                    <li>Decision Making (Progresif)</li>
                                    <h5 style="font-size: 12pt;">Intern dapat melihat pola kesalahan yang telah terjadi sebelumnya serta menerima masukan dan menggunakannya sebagai bahan pertimbangan untuk mengambil keputusan yang terbaik.</h5>
                                    <li>Time Management (Professional)</li>
                                    <h5 style="font-size: 12pt;">Intern dapat mengatur waktunya dengan baik sehingga tugas-tugasnya dapat terselesaikan tepat waktu.</h5>
                                    <li>Communicative (Professional)</li>
                                    <h5 style="font-size: 12pt;">Intern dapat mengkomunikasikan pendapat dan kendalanya dengan cara yang efektif sehingga meminimalisir adanya miskomunikasi dalam kerja sama.</h5>
                                    <li>Politeness (Professional)</li>
                                    <h5 style="font-size: 12pt;">Intern mampu berkomunikasi dengan pihak internal maupun eksternal dengan tata cara yang baik dan benar, sehingga mampu menjalin kolaborasi yang berdampak.</h5>
                                    <li>Open Mindedness (Potensial)</li>
                                    <h5 style="font-size: 12pt;">Intern terbuka untuk menerima kritik atau saran dari orang lain dan bersedia mempertimbangkannya demi mewujudkan tujuan-tujuan organisasi dengan lebih baik lagi.</h5>
                                    <li>Trustworthy (Potensial)</li>
                                    <h5 style="font-size: 12pt;">Intern dapat dipercaya untuk menyelesaikan suatu tugas dan mampu mempertanggungjawabkan tindakannya, serta senantiasa bersikap jujur dan menepati janji.</h5>
                                </ol>
                                <?php }?>
                            </ul>
                        </ol>

                        <br>
                    <?php
                    // }
                    ?>
                    <li>Testimoni</li>
                    <ul style="list-style-type:disc; text-align: justify;">
                        <?php
                        $getTestimonisql = "SELECT testimoni FROM bem_kuartal1_2024 WHERE id_fungsionaris = ? AND status = 2";
                        $getTestimonistmt = $pdo->prepare($getTestimonisql);
                        $getTestimonistmt->execute([$_GET['id']]);
                        $charactersCount = 0;
                        $break = false;
                        while ($getTestimoni = $getTestimonistmt->fetch()) {
                        ?>
                            <li><?= $getTestimoni['testimoni'] ?></li>
                            <?php
                            $charactersCount += strlen($getTestimoni['testimoni']);
                            if ($charactersCount > 1000 && $break == false) {
                                $break = true;
                            ?>
                                <div class="page_break"></div>
                                <br>
                                <br>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </ol>
            </ol>
        </div>

    </div>
</body>

</html>