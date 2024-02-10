<?php
require_once "./connect.php";

if (isset($_POST)) {
    $divisiChecksql = "SELECT * FROM divisi_event WHERE nama = ? AND id_event = ? AND id != ?";
    $divisiCheckstmt = $pdo->prepare($divisiChecksql);
    if ($divisiCheckstmt->execute([$_POST['nama'], $_POST['event'], $_POST['id']])) {
        if ($divisiCheckstmt->rowCount() >= 1) {
            header("Location: ../database_divisi.php?stat=3");
            exit();
        } else {
            $checkAssessmentsql = "SELECT nrp FROM data_performance WHERE id_divisi = ?";
            $checkAssessmentstmt = $pdo->prepare($checkAssessmentsql);
            if ($checkAssessmentstmt->execute([$_GET['id']])) {
                $id = $_POST['id'];
                $nama = $_POST['nama'];
                if ($checkAssessmentstmt->rowCount() == 0) {
                    $event = $_POST['event'];
                    $updateDivisisql = "UPDATE `divisi_event` SET `nama` = ?, `id_event` = ? WHERE id = ?";
                    $updateDivisistmt = $pdo->prepare($updateDivisisql);
                    if ($updateDivisistmt->execute([$nama, $event, $id])) {
                        header("Location: ../database_divisi.php?stat=1");
                        exit();
                    } else {
                        header("Location: ../database_divisi.php?stat=2");
                        exit();
                    }
                } else {
                    $updateDivisisql = "UPDATE `divisi_event` SET `nama` = ? WHERE id = ?";
                    $updateDivisistmt = $pdo->prepare($updateDivisisql);
                    if ($updateDivisistmt->execute([$nama, $id])) {
                        header("Location: ../database_divisi.php?stat=1");
                        exit();
                    } else {
                        header("Location: ../database_divisi.php?stat=2");
                        exit();
                    }
                }
            } else {
                header("Location: ../database_divisi.php?stat=2");
                exit();
            }
        }
    } else {
        header("Location: ../database_divisi.php?stat=2");
        exit();
    }
} else {
    header("Location: ../database_divisi.php?stat=2");
    exit();
}
?>