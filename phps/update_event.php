<?php
require_once "./connect.php";

$target_dir = "../uploads/";
$random_str = RandomString();
$allowed = array('png', 'jpg', 'jpeg');

if (isset($_POST)) {
    $acaraChecksql = "SELECT * FROM event WHERE name = ? AND id != ?";
    $acaraCheckstmt = $pdo->prepare($acaraChecksql);
    if ($acaraCheckstmt->execute([$_POST['name'], $_POST['id']])) {
        if ($acaraCheckstmt->rowCount() >= 1) {
            header("Location: ../database_acara.php?stat=3");
            exit();
        } else {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $type = ucwords($_POST['type']);
            $status = $_POST['status'];
            $organizer = $_POST['organizer'];
            $url = $_POST['url'];
            $year = $_POST['year'];

            if (file_exists($_FILES['poster']['tmp_name']) && is_uploaded_file($_FILES['poster']['tmp_name'])) {
                // DELETE PREVIOUS POSTER FROM SERVER
                $getAcarasql = "SELECT * FROM event WHERE name = ? AND id = ?";
                $getAcarastmt = $pdo->prepare($getAcarasql);
                $getAcarastmt->execute([$_POST['name'], $_POST['id']]);
                $getAcara = $getAcarastmt->fetch();

                unlink("../uploads/poster/" . $getAcara['poster_filepath']);

                $poster_name = basename($_FILES['poster']['name']);
                $poster_file_type = strtolower(pathinfo($poster_name, PATHINFO_EXTENSION));
                $new_poster_name = $name . "_" . $random_str . "." . $poster_file_type;
                $target_file_poster = $target_dir . "poster/" . $new_poster_name;

                if (in_array($poster_file_type, $allowed)) {
                    if ($_FILES["poster"]["size"] > (1048576 * 5)) {
                        header("Location: ../database_acara.php?status=5");
                        exit();
                    }

                    if (compressImage($_FILES['poster']['tmp_name'], $target_file_poster, 50)) {
                        $updateAcarasql = "UPDATE `event` SET `name` = ?, `type` = ?, `status` = ?, `organizer` = ?, `year` = ?, `url` = ?, `poster_filepath` = ? WHERE id = ?";
                        $updateAcarastmt = $pdo->prepare($updateAcarasql);
                        if ($updateAcarastmt->execute([$name, $type, $status, $organizer, $year, $url, $new_poster_name, $id])) {
                            header("Location: ../database_acara.php?stat=1");
                            exit();
                        } else {
                            header("Location: ../database_acara.php?stat=2");
                            exit();
                        }
                    } else {
                        header("Location: ../database_acara.php?status=2");
                        exit();
                    }
                } else {
                    header("Location: ../database_acara.php?status=7");
                    exit();
                }
            } else {
                $updateAcarasql = "UPDATE `event` SET `name` = ?, `type` = ?, `status` = ?, `organizer` = ?, `year` = ?, `url` = ? WHERE id = ?";
                $updateAcarastmt = $pdo->prepare($updateAcarasql);
                if ($updateAcarastmt->execute([$name, $type, $status, $organizer, $year, $url, $id])) {
                    header("Location: ../database_acara.php?stat=1");
                    exit();
                } else {
                    header("Location: ../database_acara.php?stat=2");
                    exit();
                }
            }
        }
    } else {
        header("Location: ../database_acara.php?stat=2");
        exit();
    }
} else {
    header("Location: ../database_acara.php?stat=2");
    exit();
}
?>