<?php
    require_once './connect.php';

    if (isset($_POST['search_mhs'])) {
        header("Location: ../search.php?value=" . sanitizeString($_POST['search_mhs']));
        exit();
    } else {
        header("Location: ../home.php?status=4");
        exit();
    }
?>