<?php
    require "connect.php";

    if (isset($_POST['performance'])) {
        $performance = strtolower(str_replace(' ', '_', $_POST['performance']));
        if (isset($_POST['event'])) {
            $getPerformancesql = 'SELECT COUNT(*) as a, (SELECT COUNT(*) as x FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ? AND id_event = ?) as b, (SELECT COUNT(*) as x FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ? AND id_event = ?) as c, (SELECT COUNT(*) as x FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ? AND id_event = ?) as d, (SELECT COUNT(*) as x FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ? AND id_event = ?) as e FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ? AND id_event = ?';
            $getPerformancestmt = $pdo->prepare($getPerformancesql);
            $getPerformancestmt->execute([$_SESSION['nrp'], 4, $_POST['event'], $_SESSION['nrp'], 3, $_POST['event'], $_SESSION['nrp'], 2, $_POST['event'], $_SESSION['nrp'], 1, $_POST['event'], $_SESSION['nrp'], 5, $_POST['event']]);
            $rowGetPerformance = $getPerformancestmt->fetch();
        } else {
            $getPerformancesql = 'SELECT COUNT(*) as a, (SELECT COUNT(*) as x FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ?) as b, (SELECT COUNT(*) as x FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ?) as c, (SELECT COUNT(*) as x FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ?) as d, (SELECT COUNT(*) as x FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ?) as e FROM data_performance WHERE nrp = ? AND ' . $performance . ' = ?';
            $getPerformancestmt = $pdo->prepare($getPerformancesql);
            $getPerformancestmt->execute([$_SESSION['nrp'], 4, $_SESSION['nrp'], 3, $_SESSION['nrp'], 2, $_SESSION['nrp'], 1, $_SESSION['nrp'], 5]);
            $rowGetPerformance = $getPerformancestmt->fetch();
        }

        echo json_encode($rowGetPerformance);
    } else {
        exit();
    }
?>