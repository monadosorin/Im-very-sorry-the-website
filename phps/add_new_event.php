<?php
require_once './connect.php';

$target_dir = "../uploads/";
$random_str = RandomString();
$allowed = array('png', 'jpg', 'jpeg');

if (isset($_POST['name']) && isset($_POST['type']) && isset($_POST['status']) && isset($_POST['organizer']) && isset($_POST['url']) && isset($_POST['year'])) {
	$acaraChecksql = "SELECT * FROM event WHERE name = ?";
    $acaraCheckstmt = $pdo->prepare($acaraChecksql);
	if ($acaraCheckstmt->execute([$_POST['name']])) {
		if ($acaraCheckstmt->rowCount() >= 1) {
			header("Location: ../database.php?stat=4");
			exit();
		} else {
			$name = trim($_POST['name']);
			$type = ucwords($_POST['type']);
			$status = $_POST['status'];
			$organizer = $_POST['organizer'];
			$url = $_POST['url'];
			$year = $_POST['year'];

			if (file_exists($_FILES['poster']['tmp_name']) && is_uploaded_file($_FILES['poster']['tmp_name'])) {
				$poster_name = basename($_FILES['poster']['name']);
				$poster_file_type = strtolower(pathinfo($poster_name, PATHINFO_EXTENSION));
				$new_poster_name = str_replace("/", "", $name) . "_" . $random_str . "." . $poster_file_type;
				$target_file_poster = $target_dir . "poster/" . $new_poster_name;

				if (in_array($poster_file_type, $allowed)) {
					if ($_FILES["poster"]["size"] > (1048576 * 5)) {
						header("Location: ../database.php?status=5");
						exit();
					}

					if (compressImage($_FILES['poster']['tmp_name'], $target_file_poster, 50)) {
						$stmt = $pdo->prepare("INSERT INTO `event` (`id`, `name`, `type`, `status`, `organizer`, `url`, `year`, `poster_filepath`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
						if ($stmt->execute([NULL, $name, $type, $status, $organizer, $url, $year, $new_poster_name])) {
							header("Location: ../database.php?stat=1");
							exit();
						} else {
							header("Location: ../database.php?stat=2");
							exit();
						}
					} else {
						header("Location: ../database.php?status=6");
						exit();
					}
				} else {
					header("Location: ../database.php?status=7");
					exit();
				}
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