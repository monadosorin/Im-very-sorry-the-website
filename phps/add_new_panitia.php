<?php
require_once './connect.php';

if (isset($_POST['nrp']) && isset($_POST['nama']) && isset($_POST['jabatan']) && isset($_POST['acara']) && isset($_POST['divisi'])) {
    $panitiaChecksql = "SELECT * FROM panitia_event WHERE nrp = ? AND id_event = ?";
    $panitiaCheckstmt = $pdo->prepare($panitiaChecksql);
    if ($panitiaCheckstmt->execute([$_POST['nrp'], $_POST['acara']])) {
        if ($panitiaCheckstmt->rowCount() >= 1) {
            header("Location: ../database.php?stat=7");
            exit();
        } else {
            $nrp = strtolower($_POST['nrp']);
            $nama = ucwords(trim($_POST['nama']));
            $jabatan = $_POST['jabatan'];
            $divisi = $_POST['divisi'];
            $acara = $_POST['acara'];
            
            $stmt = $pdo->prepare("INSERT INTO `panitia_event`(`id`, `nrp`, `nama`, `jabatan`, `id_event`, `id_divisi`) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([NULL, $nrp, $nama, $jabatan, $acara, $divisi])) {
                header("Location: ../database.php?stat=8");
                exit();
            } else {
                header("Location: ../database.php?stat=2");
                exit();
            }
        }
    } else {
        header("Location: ../database.php?stat=2");
        exit();
    }
} else {
    header("Location: ../database.php?stat=2");
    exit();
}
?>