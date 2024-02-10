<?php
    include 'connect.php';

    header("Content-Type: application/json");

    if (isset($_POST['status']) && isset($_POST['tahun'])) {
        if ($_POST['status'] != '' && $_POST['tahun'] != '') {
            $eventssql = "SELECT * FROM event WHERE status = ? AND year = ? ORDER BY id DESC";
            $eventsstmt = $pdo->prepare($eventssql);
            $eventsstmt->execute([$_POST['status'], $_POST['tahun']]);
        } else if ($_POST['status'] != '' && $_POST['tahun'] == '') {
            $eventssql = "SELECT * FROM event WHERE status = ? ORDER BY id DESC";
            $eventsstmt = $pdo->prepare($eventssql);
            $eventsstmt->execute([$_POST['status']]);
        } else if ($_POST['tahun'] != '' && $_POST['status'] == '') {
            $eventssql = "SELECT * FROM event WHERE year = ? ORDER BY id DESC";
            $eventsstmt = $pdo->prepare($eventssql);
            $eventsstmt->execute([$_POST['tahun']]);
        } else {
            $eventssql = "SELECT * FROM event ORDER BY id DESC";
            $eventsstmt = $pdo->prepare($eventssql);
            $eventsstmt->execute();
        }
    } else {
        $eventssql = "SELECT * FROM event ORDER BY id DESC";
        $eventsstmt = $pdo->prepare($eventssql);
        $eventsstmt->execute();
    }

    if (isset($_POST['search'])) {
        $eventssql = "SELECT * FROM event WHERE name LIKE ? ORDER BY id DESC";
        $eventsstmt = $pdo->prepare($eventssql);
        $eventsstmt->execute(['%' . $_POST['search'] . '%']);
    }

    $result = array();
    while($row = $eventsstmt->fetch()){
        array_push($result, $row);
    }
    echo json_encode($result);
?>
