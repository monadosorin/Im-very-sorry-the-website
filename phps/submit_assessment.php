<?php
require_once "./connect.php";

$recaptcha_response = $_POST['response'];
$recaptcha_secret = "6LdukNYaAAAAALrB99OlKmo9Bm7xc8Mlp429t2Xl";

if (validateCaptcha($recaptcha_response, $recaptcha_secret)) {
    setTimezoneWIB();
    if (isset($_POST['tmValue']) && isset($_POST['cValue']) && isset($_POST['psValue']) && isset($_POST['omValue']) && isset($_POST['esValue']) && isset($_POST['testimoni']) && isset($_POST['id']) && isset($_POST['id_event'])) {
        if ($_POST['tmValue'] == NULL || $_POST['cValue'] == NULL || $_POST['psValue'] == NULL || $_POST['omValue'] == NULL || $_POST['esValue'] == NULL || $_POST['testimoni'] == NULL || $_POST['id'] == NULL || $_POST['id_event'] == NULL) {
            echo "false";
            exit();
        } else {
            $timestamp = date("d-m-Y H:i:s");

            $time_management = $_POST['tmValue'];
            $cooperative = $_POST['cValue'];
            $problem_solving = $_POST['psValue'];
            $open_minded = $_POST['omValue'];
            $emotional_stability = $_POST['esValue'];
            if ($time_management < 0 || $time_management > 4 || $cooperative < 0 || $cooperative > 4 || $problem_solving < 0 || $problem_solving > 4 || $open_minded < 0 || $open_minded > 4 || $emotional_stability < 0 || $emotional_stability > 4) {
                suspiciousAttempt($_SESSION['nrp'], 'Assessment - Invalid Rating (' . $time_management . ', ' . $cooperative . ', ' . $problem_solving . ', ' . $open_minded . ', ' . $emotional_stability . ')', $timestamp);
                echo "invalid-rating";
                exit();
            } else {
                $testimoni = trim(sanitizeString($_POST['testimoni']));
                if (strlen(sanitizeString($_POST['testimoni'])) > 1000) {
                    suspiciousAttempt($_SESSION['nrp'], 'Assessment - Exceeded Testimoni Length (' . strlen(sanitizeString($_POST['testimoni'])) . ')', $timestamp);
                    echo "max-testi";
                    exit();
                } else if (strlen(sanitizeString($_POST['testimoni'])) < 10) {
                    suspiciousAttempt($_SESSION['nrp'], 'Assessment - Reduced Testimoni Length (' . strlen(sanitizeString($_POST['testimoni'])) . ')', $timestamp);
                    echo "min-testi";
                    exit();
                }
                $id_panitia = $_POST['id'];
                $nrp_penilai = $_SESSION['nrp'];
                $id_event = $_POST['id_event'];

                $getDataPanitiasql = 'SELECT * FROM panitia_event WHERE id = ?';
                $getDataPanitiastmt = $pdo->prepare($getDataPanitiasql);
                if ($getDataPanitiastmt->execute([$id_panitia])) {
                    $getDataPanitiarow = $getDataPanitiastmt->fetch();

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
                                if ($submitPerformancestmt->execute([$getDataPanitiarow['nrp'], $nrp_penilai, $time_management, $cooperative, $problem_solving, $open_minded, $emotional_stability, $testimoni, $id_event, 0, $timestamp, '', $getDataPanitiarow['id_divisi'], $getDataPanitiarow['id'], $getDataPanitiarow['nama'], $getDataPenilairow['nama']])) {
                                    echo "true";
                                    exit();
                                } else {
                                    echo "false";
                                    exit();
                                }
                            } else {
                                echo "false";
                                exit();
                            }
                        } else {
                            echo "false";
                            exit();
                        }
                    } else {
                        echo "false";
                        exit();
                    }
                } else {
                    echo "false";
                    exit();
                }
            }
        }
    } else {
        echo "false";
        exit();
    }
} else {
    echo "grecaptcha-failed";
    exit();
}
?>