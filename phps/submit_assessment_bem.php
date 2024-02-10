<?php
require "connect.php";

define('TIMEZONE', 'Asia/Jakarta');
date_default_timezone_set(TIMEZONE);

if (isset($_POST['caringValue']) && $_POST['caringValue'] && isset($_POST['cooperativenessValue']) && $_POST['cooperativenessValue'] && isset($_POST['psValue']) && $_POST['psValue'] && isset($_POST['responsibilityValue']) && $_POST['responsibilityValue'] && isset($_POST['decisionValue']) && $_POST['decisionValue'] && isset($_POST['timeValue']) && $_POST['timeValue'] && isset($_POST['communicativeValue']) && $_POST['communicativeValue'] && isset($_POST['politenessValue']) && $_POST['politenessValue'] && isset($_POST['openMindedValue']) && $_POST['openMindedValue'] && isset($_POST['trustValue']) && $_POST['trustValue'] && isset($_POST['testimoni']) && $_POST['testimoni'] && isset($_POST['id']) && $_POST['id']) {
    $timestamp = date("d-m-Y H:i:s");

    $caring = $_POST['caringValue'];
    $cooperativeness = $_POST['cooperativenessValue'];
    $problem_solving = $_POST['psValue'];
    $responsibility = $_POST['responsibilityValue'];
    $decision = $_POST['decisionValue'];
    $time = $_POST['timeValue'];
    $communicative = $_POST['communicativeValue'];
    $politeness = $_POST['politenessValue'];
    $openMinded = $_POST['openMindedValue'];
    $trust = $_POST['trustValue'];
    $testimoni = $_POST['testimoni'];
    $id = $_POST['id'];
    $nrp_penilai = $_SESSION['nrp'];

    $getDataPanitiasql = 'SELECT * FROM bem_fungsionaris_2024 WHERE id = ?';
    $getDataPanitiastmt = $pdo->prepare($getDataPanitiasql);
    $getDataPanitiastmt->execute([$id]);
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
        $submitPerformancestmt->execute([$getDataPanitiarow['id'], $getDataPenilairow['id'], $caring, $cooperativeness, $problem_solving, $responsibility, $decision, $time, $communicative, $politeness, $openMinded, $trust, $testimoni, 0, $timestamp, '']);
    }

    echo "true";
} else {
    echo "false";
}
?>