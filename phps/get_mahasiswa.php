<?php
require "connect.php";

if (isset($_POST['id_mhs'])) {
    if (!isset($_POST['bem'])) {
        $sql = "SELECT a.nrp, a.nama, jabatan, b.nama as divisi, c.name as acara FROM panitia_event a JOIN divisi_event b ON a.id_divisi = b.id JOIN event c ON a.id_event = c.id WHERE a.id = ?";
    } else {
        $sql = "SELECT a.id, a.nama, a.nrp, a.id_bidang, c.nama as jabatan, b.nama as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE a.id = ?";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['id_mhs']]);
    $row = $stmt->fetch();

    echo json_encode($row);
} else {
    exit();
}
?>