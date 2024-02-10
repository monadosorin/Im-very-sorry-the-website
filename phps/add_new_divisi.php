<?php
require_once './connect.php';

if (isset($_POST['nama']) && isset($_POST['event'])) {
    $nama = trim($_POST['nama']);
    $event = $_POST['event'];

	$divisiChecksql = "SELECT * FROM divisi_event WHERE nama = ? AND id_event = ?";
    $divisiCheckstmt = $pdo->prepare($divisiChecksql);
	if ($divisiCheckstmt->execute([$nama, $event])) {
		if ($divisiCheckstmt->rowCount() >= 1) {
			header("Location: ../database.php?stat=5");
			exit();
		} else {
			$stmt = $pdo->prepare("INSERT INTO `divisi_event`(`id`, `nama`, `id_event`) VALUES (?, ?, ?)");
			if ($stmt->execute([NULL, $nama, $event])) {
				header("Location: ../database.php?stat=6");
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
