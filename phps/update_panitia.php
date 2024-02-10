<?php
require_once "./connect.php";

if (isset($_POST)) {
    $panitiaChecksql = "SELECT * FROM panitia_event WHERE nrp = ? AND id_event = ? AND id != ?";
    $panitiaCheckstmt = $pdo->prepare($panitiaChecksql);
    if ($panitiaCheckstmt->execute([$_POST['nrp'], $_POST['acara'], $_POST['id']])) {
        if ($panitiaCheckstmt->rowCount() >= 1) {
            header("Location: ../database_panitia.php?stat=3");
            exit();
        } else {
            $checkAssessmentsql = "SELECT nrp FROM data_performance WHERE id_panitia = ?";
            $checkAssessmentstmt = $pdo->prepare($checkAssessmentsql);
            if ($checkAssessmentstmt->execute([$_POST['id']])) {
                $id = $_POST['id'];
                $nrp = strtolower($_POST['nrp']);
                $nama = ucwords($_POST['nama']);
                $jabatan = $_POST['jabatan'];
                if ($checkAssessmentstmt->rowCount() == 0) {
                    $acara = $_POST['acara'];
                    $divisi = $_POST['divisi'];
                    $updateDivisisql = "UPDATE `panitia_event` SET `nrp` = ?, `jabatan` = ?, `id_divisi` = ?, `id_event` = ?, `nama` = ? WHERE id = ?";
                    $updateDivisistmt = $pdo->prepare($updateDivisisql);
                    if ($updateDivisistmt->execute([$nrp, $jabatan, $divisi, $acara, $nama, $id])) {
                        $updatePerformancesql = "UPDATE `data_performance` SET `nrp` = ?, `nama` = ?, `id_divisi` = ?, `id_event` = ? WHERE id_panitia = ?";
                        $updatePerformancestmt = $pdo->prepare($updatePerformancesql);
                        if ($updatePerformancestmt->execute([$nrp, $nama, $divisi, $acara, $id])) {
                            header("Location: ../database_panitia.php?stat=1");
                            exit();
                        } else {
                            header("Location: ../database_panitia.php?stat=2");
                            exit();
                        }
                    } else {
                        header("Location: ../database_panitia.php?stat=2");
                        exit();
                    }
                } else {
                    $updateDivisisql = "UPDATE `panitia_event` SET `nrp` = ?, `jabatan` = ?, `nama` = ? WHERE id = ?";
                    $updateDivisistmt = $pdo->prepare($updateDivisisql);
                    if ($updateDivisistmt->execute([$nrp, $jabatan, $nama, $id])) {
                        $updatePerformancesql = "UPDATE `data_performance` SET `nrp` = ?, `nama` = ? WHERE id_panitia = ?";
                        $updatePerformancestmt = $pdo->prepare($updatePerformancesql);
                        if ($updatePerformancestmt->execute([$nrp, $nama, $id])) {
                            header("Location: ../database_panitia.php?stat=1");
                            exit();
                        } else {
                            header("Location: ../database_panitia.php?stat=2");
                            exit();
                        }
                    } else {
                        header("Location: ../database_panitia.php?stat=2");
                        exit();
                    }
                }
            } else {
                header("Location: ../database_panitia.php?stat=2");
                exit();
            }
        }
    } else {
        header("Location: ../database_panitia.php?stat=2");
        exit();
    }
} else {
    header("Location: ../database_panitia.php?stat=2");
    exit();
}
?>