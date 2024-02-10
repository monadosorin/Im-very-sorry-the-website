<?php
require_once "./connect.php";

$recaptcha_response = $_POST['g-recaptcha-response'];
$recaptcha_secret = "6LdukNYaAAAAALrB99OlKmo9Bm7xc8Mlp429t2Xl";

if (validateCaptcha($recaptcha_response, $recaptcha_secret)) {
    setTimezoneWIB();
    $target_dir = "../uploads/";
    $random_str = RandomString();
    $allowed = array('png', 'jpg', 'jpeg');

    if (isset($_POST['nama']) && isset($_POST['tempat_lahir']) && isset($_POST['tanggal_lahir']) && isset($_POST['alamat']) && isset($_POST['nomor_hp']) && isset($_POST['id_line']) && isset($_POST['instagram']) && isset($_POST['kelebihan']) && isset($_POST['kekurangan']) && isset($_POST['pengalaman'])) {
        if ($_POST['nama'] == NULL || $_POST['tempat_lahir'] == NULL || $_POST['tanggal_lahir'] == NULL || $_POST['alamat'] == NULL || $_POST['nomor_hp'] == NULL || $_POST['id_line'] == NULL || $_POST['instagram'] == NULL || $_POST['kelebihan'] == NULL || $_POST['kekurangan'] == NULL || $_POST['pengalaman'] == NULL) {
            header("Location: ../profile.php?status=6");
            exit();
        } else {
            if(!isset($_SESSION['nrp'])){
                header('Location: https://bem-internal.petra.ac.id/reach/index.php');
            }
            $cekUpdatePengalamansql = "SELECT * FROM mahasiswa_cv WHERE nrp = ?";
            $cekUpdatePengalamanstmt = $pdo->prepare($cekUpdatePengalamansql);
            if ($cekUpdatePengalamanstmt->execute([$_SESSION['nrp']])) {
                $cekUpdatePengalamanrow = $cekUpdatePengalamanstmt->fetch();

                if ($cekUpdatePengalamanrow['pengalaman'] == $_POST['pengalaman']) {
                    $timestamp = $cekUpdatePengalamanrow['updated_on'];
                } else {
                    $timestamp = date("d-m-Y H:i:s");
                }

                $currTime = date("d-m-Y H:i:s");
                $nrp = $_SESSION['nrp'];

                $nama = trim(ucwords(sanitizeString($_POST['nama'])));
                if (strlen(sanitizeString($_POST['nama'])) < 3 || strlen(sanitizeString($_POST['nama'])) > 40) {
                    suspiciousAttempt($nrp, 'Invalid Length - Nama (' . strlen(sanitizeString($_POST['nama'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $tempat_lahir = trim(sanitizeString($_POST['tempat_lahir']));
                if (strlen(sanitizeString($_POST['tempat_lahir'])) > 81) {
                    suspiciousAttempt($nrp, 'Exceeded Length - Tempat Lahir (' . strlen(sanitizeString($_POST['tempat_lahir'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $tanggal_lahir = sanitizeString($_POST['tanggal_lahir']);
                $alamat = trim(sanitizeString($_POST['alamat']));
                if (strlen(sanitizeString($_POST['tanggal_lahir'])) > 200) {
                    suspiciousAttempt($nrp, 'Exceeded Length - Alamat (' . strlen(sanitizeString($_POST['tanggal_lahir'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $nomor_hp = trim(sanitizeString($_POST['nomor_hp']));
                if (strlen(sanitizeString($_POST['nomor_hp'])) < 6 || strlen(sanitizeString($_POST['nomor_hp'])) > 20) {
                    suspiciousAttempt($nrp, 'Invalid Length - Nomor HP (' . strlen(sanitizeString($_POST['nomor_hp'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $id_line = trim(sanitizeString($_POST['id_line']));
                if (strlen(sanitizeString($_POST['id_line'])) < 4 || strlen(sanitizeString($_POST['id_line'])) > 40) {
                    suspiciousAttempt($nrp, 'Invalid Length - ID LINE (' . strlen(sanitizeString($_POST['id_line'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $instagram = trim(str_replace("@", "", sanitizeString($_POST['instagram'])));
                if (strlen(sanitizeString($_POST['instagram'])) > 30) {
                    suspiciousAttempt($nrp, 'Exceeded Length - Instagram (' . strlen(sanitizeString($_POST['instagram'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $kelebihan = trim(sanitizeString($_POST['kelebihan']));
                if (strlen(sanitizeString($_POST['kelebihan'])) > 400) {
                    suspiciousAttempt($nrp, 'Exceeded Length - Kelebihan (' . strlen(sanitizeString($_POST['kelebihan'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $kekurangan = trim(sanitizeString($_POST['kekurangan']));
                if (strlen(sanitizeString($_POST['kekurangan'])) > 400) {
                    suspiciousAttempt($nrp, 'Exceeded Length - Kekurangan (' . strlen(sanitizeString($_POST['kekurangan'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $ipk = 0;
                $pengalaman = trim(sanitizeString($_POST['pengalaman']));
                if (strlen(sanitizeString($_POST['pengalaman'])) > 2000) {
                    suspiciousAttempt($nrp, 'Exceeded Length - Pengalaman (' . strlen(sanitizeString($_POST['pengalaman'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $portfolio = trim(sanitizeString($_POST['portfolio']));
                if (strlen(sanitizeString($_POST['portfolio'])) > 1000) {
                    suspiciousAttempt($nrp, 'Exceeded Length - Portfolio (' . strlen(sanitizeString($_POST['portfolio'])) . ')', $currTime);
                    header("Location: ../profile.php?status=8");
                    exit();
                }
                $jurusan = $_POST['jurusan'];
                $angkatan = intval('20' . substr($nrp, -6, 2));

                $fakultasJurusan = explode(" - ", $jurusan, 2);
                $fakultasStr = $fakultasJurusan[0];
                $jurusanStr = $fakultasJurusan[1];

                $checkFakJursql = "SELECT * FROM jurusanpcu WHERE fakultas = ? AND jurusan = ?";
                $checkFakJurstmt = $pdo->prepare($checkFakJursql);
                if ($checkFakJurstmt->execute([$fakultasStr, $jurusanStr])) {
                    if ($checkFakJurstmt->rowCount() == 0) {
                        suspiciousAttempt($nrp, 'Invalid Value - Fakultas (' . $fakultasStr . ') & Jurusan (' . $jurusanStr . ')', $currTime);
                        header("Location: ../profile.php?status=8");
                        exit();
                    }

                    // file_exists gk bisa di mac - 11 November 2023
                    // if (file_exists($_FILES['photo']['tmp_name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) { // dibuat 2021
                    if(isset($_FILES['photo']['tmp_name'])){
                        if ($cekUpdatePengalamanrow['status'] > 0) {
                            // DELETE PREVIOUS IMAGE FROM THE SERVER
                            unlink("../uploads/cv_photo/" . $cekUpdatePengalamanrow['photo_filepath']);
                        }

                        $photo_name = basename($_FILES['photo']['name']);
                        $photo_file_type = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
                        $new_photo_name = $nrp . "_" . $nama . $random_str . "." . $photo_file_type;
                        $target_file_photo = $target_dir . "cv_photo/" . $new_photo_name;

                        if (in_array($photo_file_type, $allowed)) {
                            // EXCEEDS 5 MB SIZE LIMIT
                            if ($_FILES["photo"]["size"] > (1048576 * 5)  || $_FILES["photo"]["size"] == 0 ) {
                                suspiciousAttempt($nrp, 'Exceeded File Size Limit - Image (' . $_FILES["photo"]["size"] . ')', $currTime);
                                header("Location: ../profile.php?status=5");
                                exit();
                            }

                            if (compressImage($_FILES['photo']['tmp_name'], $target_file_photo, 50)) {
                                // SUCCESSFULLY UPLOADED
                                $updateCVsql = "UPDATE `mahasiswa_cv` SET `nama` = ?, `tempat_lahir` = ?, `tanggal_lahir` = ?, `alamat` = ?, `nomor_hp` = ?, `id_line` = ?, `instagram` = ?, `kelebihan` = ?, `kekurangan` = ?, `ipk` = ?, `pengalaman` = ?, `portfolio` = ?, `jurusan` = ?, `angkatan` = ?, `status` = ?, `updated_on` = ?, `photo_filepath` = ? WHERE nrp = ?";
                                $updateCVstmt = $pdo->prepare($updateCVsql);
                                if ($updateCVstmt->execute([$nama, $tempat_lahir, $tanggal_lahir, $alamat, $nomor_hp, $id_line, $instagram, $kelebihan, $kekurangan, $ipk, $pengalaman, $portfolio, $jurusan, $angkatan, 1, $timestamp, $new_photo_name, $nrp])) {
                                    header("Location: ../home.php?status=1");
                                    exit();
                                } else {
                                    header("Location: ../profile.php?status=6");
                                    exit();
                                }
                            } else {
                                // NOT SUCCESSFULLY UPLOADED
                                header("Location: ../profile.php?status=6");
                                exit();
                            }
                        } else {
                            suspiciousAttempt($nrp, 'Invalid File Type - Image (' . $photo_file_type . ')', $currTime);
                            header("Location: ../profile.php?status=7");
                            exit();
                        }
                    } else {
                        if ($cekUpdatePengalamanrow['status'] == 0) {
                            suspiciousAttempt($nrp, 'Removed "Required" in Photo', $currTime);
                            header("Location: ../profile.php?status=8");
                            exit();
                        } else {
                            $updateCVsql = "UPDATE `mahasiswa_cv` SET `nama` = ?, `tempat_lahir` = ?, `tanggal_lahir` = ?, `alamat` = ?, `nomor_hp` = ?, `id_line` = ?, `instagram` = ?, `kelebihan` = ?, `kekurangan` = ?, `ipk` = ?, `pengalaman` = ?, `portfolio` = ?, `jurusan` = ?, `angkatan` = ?, `status` = ?, `updated_on` = ? WHERE nrp = ?";
                            $updateCVstmt = $pdo->prepare($updateCVsql);
                            if ($updateCVstmt->execute([$nama, $tempat_lahir, $tanggal_lahir, $alamat, $nomor_hp, $id_line, $instagram, $kelebihan, $kekurangan, $ipk, $pengalaman, $portfolio, $jurusan, $angkatan, 1, $timestamp, $nrp])) {
                                header("Location: ../home.php?status=1");
                                exit();
                            } else {
                                header("Location: ../profile.php?status=6");
                                exit();
                            }
                        }
                    }
                } else {
                    header("Location: ../profile.php?status=6");
                    exit();
                }
            } else {
                header("Location: ../profile.php?status=6");
                exit();
            }
        }
    } else {
        header("Location: ../profile.php?status=6");
        exit();
    }
} else {
    header("Location: ../profile.php?status=4");
    exit();
}
?>