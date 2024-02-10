<?php
require "connect.php";
//echo "aman";
define('TIMEZONE', 'Asia/Jakarta');
date_default_timezone_set(TIMEZONE);

if (isset($_POST['testimoni']) && $_POST['testimoni'] && isset($_POST['id_fungsio']) && $_POST['id_fungsio']) {
    $timestamp = date("d-m-Y H:i:s");

    $testimoni = trim(htmlspecialchars($_POST['testimoni']));
    if (strlen($testimoni) < 10) {
        header('Location: ../give_testimonial_bem.php?status=3');
        exit();
    }
    $id_fungsio = $_POST['id_fungsio'];
    $nrp_penilai = $_SESSION['nrp'];

    $getDataPanitiasql = 'SELECT * FROM bem_fungsionaris_2024 WHERE id = ?';
    $getDataPanitiastmt = $pdo->prepare($getDataPanitiasql);
    $getDataPanitiastmt->execute([$id_fungsio]);
    $getDataPanitiarow = $getDataPanitiastmt->fetch();

    $getDataPenilaisql = 'SELECT * FROM bem_fungsionaris_2024 WHERE nrp = ?';
    $getDataPenilaistmt = $pdo->prepare($getDataPenilaisql);
    $getDataPenilaistmt->execute([$nrp_penilai]);
    $getDataPenilairow = $getDataPenilaistmt->fetch();

    $checkAssessmentsql = "SELECT * FROM bem_kuartal1_2024 WHERE id_fungsionaris = ? AND id_fungsionaris_penilai = ?";
    $checkAssessmentstmt = $pdo->prepare($checkAssessmentsql);
    $checkAssessmentstmt->execute([$getDataPanitiarow['id'], $getDataPenilairow['id']]);
    if ($checkAssessmentstmt->rowCount() == 0) {
        $submitPerformancesql = "INSERT INTO `bem_kuartal1_2024` (`id`, `id_fungsionaris`, `id_fungsionaris_penilai`, `caring`, `cooperativeness`, `problem_solving`, `responsibility`, `decision`, `time`, `communicative`, `politeness`, `openMinded`, `trust`, `testimoni`, `status`, `submitted_on`, `filtered_by`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $submitPerformancestmt = $pdo->prepare($submitPerformancesql);
        $submitPerformancestmt->execute([$getDataPanitiarow['id'], $getDataPenilairow['id'], 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, $testimoni, 0, $timestamp, '']);
    }
    
    if (isset($_GET['id'])) {
        header('Location: ../give_testimonial_bem.php?status=2&id=' . $_GET['id']);
    } else {
        header('Location: ../give_testimonial_bem.php?status=2');
    }
    exit();
} else {
    header('Location: ../give_testimonial_bem.php?status=1');
    exit();
}
?>