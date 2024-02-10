<?php
require_once "./connect.php";

$recaptcha_response = $_POST['g-recaptcha-response'];
$recaptcha_secret = "6LdukNYaAAAAALrB99OlKmo9Bm7xc8Mlp429t2Xl";

if (validateCaptcha($recaptcha_response, $recaptcha_secret)) {
    setTimezoneWIB();
    if (isset($_POST['testimoni']) && isset($_POST['id_panitia'])) {
        if ($_POST['testimoni'] == NULL || $_POST['id_panitia'] == NULL) {
            header('Location: ../give_testimonial.php?status=1');
            exit();
        } else {
            $timestamp = date("d-m-Y H:i:s");

            $testimoni = trim(sanitizeString($_POST['testimoni']));
            if (strlen(sanitizeString($_POST['testimoni'])) < 10) {
                suspiciousAttempt($_SESSION['nrp'], 'Testimonial - Reduced Length (' . strlen(sanitizeString($_POST['testimoni'])) . ')', $timestamp);
                header('Location: ../give_testimonial.php?status=3');
                exit();
            } else if (strlen(sanitizeString($_POST['testimoni'])) > 1000) {
                suspiciousAttempt($_SESSION['nrp'], 'Testimonial - Exceeded Length (' . strlen(sanitizeString($_POST['testimoni'])) . ')', $timestamp);
                header('Location: ../give_testimonial.php?status=4');
                exit();
            } else {
                $id_panitia = $_POST['id_panitia'];
                $nrp_penilai = $_SESSION['nrp'];

                $getDataPanitiasql = 'SELECT * FROM panitia_event WHERE id = ?';
                $getDataPanitiastmt = $pdo->prepare($getDataPanitiasql);
                if ($getDataPanitiastmt->execute([$id_panitia])) {
                    $getDataPanitiarow = $getDataPanitiastmt->fetch();

                    $id_event = $getDataPanitiarow['id_event'];

                    $getDataPenilaisql = 'SELECT * FROM panitia_event WHERE nrp = ? AND id_event = ?';
                    $getDataPenilaistmt = $pdo->prepare($getDataPenilaisql);
                    if ($getDataPenilaistmt->execute([$nrp_penilai, $id_event])) {
                        $getDataPenilairow = $getDataPenilaistmt->fetch();

                        $checkAssessmentsql = "SELECT * FROM data_performance WHERE nrp = ? AND nrp_penilai = ? AND id_event = ?";
                        $checkAssessmentstmt = $pdo->prepare($checkAssessmentsql);
                        if ($checkAssessmentstmt->execute([$getDataPanitiarow['nrp'], $nrp_penilai, $id_event])) {
                            if ($checkAssessmentstmt->rowCount() == 0) {
                                $submitPerformancesql = "INSERT INTO `data_performance` (`id`, `nrp`, `nrp_penilai`, `time_management`, `cooperative`, `problem_solving`, `open_minded`, `emotional_stability`, `testimoni`, `id_event`, `status`, `submitted_on`, `filtered_by`, `id_divisi`, `id_panitia`, `nama`, `nama_penilai`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                $submitPerformancestmt = $pdo->prepare($submitPerformancesql);
                                if ($submitPerformancestmt->execute([$getDataPanitiarow['nrp'], $nrp_penilai, 0, 0, 0, 0, 0, $testimoni, $id_event, 0, $timestamp, '', $getDataPanitiarow['id_divisi'], $getDataPanitiarow['id'], $getDataPanitiarow['nama'], $getDataPenilairow['nama']])) {
                                    header('Location: ../give_testimonial.php?status=2');
                                    exit();
                                } else {
                                    header('Location: ../give_testimonial.php?status=1');
                                    exit();
                                }
                            } else {
                                header('Location: ../give_testimonial.php?status=1');
                                exit();
                            }
                        } else {
                            header('Location: ../give_testimonial.php?status=1');
                            exit();
                        }
                    } else {
                        header('Location: ../give_testimonial.php?status=1');
                        exit();
                    }
                } else {
                    header('Location: ../give_testimonial.php?status=1');
                    exit();
                }
            }
        }
    } else {
        header('Location: ../give_testimonial.php?status=1');
        exit();
    }
} else {
    header('Location: ../give_testimonial.php?status=0');
    exit();
}
?>