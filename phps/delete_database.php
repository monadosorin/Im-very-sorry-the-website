<?php
require_once 'connect.php';

if (isset($_POST['id']) && isset($_POST['ajaxid'])) {
    $getEventsql = "SELECT * FROM event WHERE id = ?";
    $getEventstmt = $pdo->prepare($getEventsql);
    $getEventstmt->execute([$_POST['id']]);
    $getEvent = $getEventstmt->fetch();

    if ($_POST['ajaxid'] == 1) {
        //delete event

        // DELETE POSTER FROM SERVER
        unlink("../uploads/poster/" . $getEvent['poster_filepath']);

        $stmt = $pdo->prepare("DELETE FROM event WHERE id = ?");
        $stmt->execute([$_POST['id']]);

        $stmt = $pdo->prepare("DELETE FROM divisi_event WHERE id_event = ?");
        $stmt->execute([$_POST['id']]);

        $stmt = $pdo->prepare("DELETE FROM panitia_event WHERE id_event = ?");
        $stmt->execute([$_POST['id']]);

        $stmt = $pdo->prepare("DELETE FROM data_performance WHERE id_event = ?");
        $stmt->execute([$_POST['id']]);
    } else if ($_POST['ajaxid'] == 2) {
        //delete divisi
        $stmt = $pdo->prepare("DELETE FROM divisi_event WHERE id = ?");
        $stmt->execute([$_POST['id']]);

        $stmt = $pdo->prepare("DELETE FROM panitia_event WHERE id_divisi = ?");
        $stmt->execute([$_POST['id']]);

        $stmt = $pdo->prepare("DELETE FROM data_performance WHERE id_divisi = ?");
        $stmt->execute([$_POST['id']]);
    } else if ($_POST['ajaxid'] == 3) {
        //delete panitia
        $stmt = $pdo->prepare("DELETE FROM panitia_event WHERE id = ?");
        $stmt->execute([$_POST['id']]);

        $stmt = $pdo->prepare("DELETE FROM data_performance WHERE id_panitia = ?");
        $stmt->execute([$_POST['id']]);
    }

    echo "true";
} else {
    echo "false";
}
?>