<?php
require_once "./connect.php";

$recaptcha_response = $_POST['g-recaptcha-response'];
$recaptcha_secret = "6LdukNYaAAAAALrB99OlKmo9Bm7xc8Mlp429t2Xl";

if (validateCaptcha($recaptcha_response, $recaptcha_secret)) {
    if (isset($_POST['suggestions'])) {
        if ($_POST['suggestions'] == NULL) {
            header("Location: ../suggestions.php?status=2");
            exit();
        } else {
            $timestamp = date("d-m-Y H:i:s");

            $suggestions = trim(sanitizeString($_POST['suggestions']));
            if (strlen(sanitizeString($_POST['suggestions'])) > 1000) {
                suspiciousAttempt($_SESSION['nrp'], 'Exceeded Length - Suggestions (' . strlen(sanitizeString($_POST['suggestions'])) . ')', $timestamp);
                header("Location: ../suggestions.php?status=1");
                exit();
            }

            $getNamaCVsql = "SELECT * FROM mahasiswa_cv WHERE nrp = ? AND nama != ''";
            $getNamaCVstmt = $pdo->prepare($getNamaCVsql);
            if ($getNamaCVstmt->execute([$_SESSION['nrp']])) {
                if ($getNamaCVstmt->rowCount() == 0) {
                    $getNamaDBsql = "SELECT * FROM mahasiswapcu WHERE nrp = ?";
                    $getNamaDBstmt = $pdo->prepare($getNamaDBsql);
                    if ($getNamaDBstmt->execute([$_SESSION['nrp']])) {
                        if ($getNamaDBstmt->rowCount() == 0) {
                            $nama = getStudentNameFinger($_SESSION['nrp']);
                            $angkatan = '20' . substr($_SESSION['nrp'], 3, 2);
                            $id_jurusan = substr($_SESSION['nrp'], 0, 3);
                            insertMahasiswaPCU($_SESSION['nrp'], $nama, $angkatan, $id_jurusan);
                        } else {
                            $getNamaDB = $getNamaDBstmt->fetch();
                            $nama = $getNamaDB['nama'];
                        }
                    } else {
                        header("Location: ../suggestions.php?status=2");
                        exit();
                    }
                } else {
                    $getNamaCV = $getNamaCVstmt->fetch();
                    $nama = $getNamaCV['nama'];
                }
            } else {
                header("Location: ../suggestions.php?status=2");
                exit();
            }

            $submitSuggestionssql = "INSERT INTO `suggestions`(`id`, `nrp`, `nama`, `suggestions`, `submitted_on`) VALUES (NULL, ?, ?, ?, ?)";
            $submitSuggestionsstmt = $pdo->prepare($submitSuggestionssql);
            if ($submitSuggestionsstmt->execute([$_SESSION['nrp'], $nama, $suggestions, $timestamp])) {
                header('Location: ../home.php?status=3');
                exit();
            } else {
                header("Location: ../suggestions.php?status=2");
                exit();
            }
        }
    } else {
        header("Location: ../suggestions.php?status=2");
        exit();
    }
} else {
    header('Location: ../suggestions.php?status=0');
    exit();
}
?>