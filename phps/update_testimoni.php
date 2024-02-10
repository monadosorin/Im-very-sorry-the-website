<?php
require "connect.php";

if (isset($_POST['id']) && isset($_POST['ajaxid'])) {
    if ($_POST['ajaxid'] == 1) {
        //lolos
        $updateStatusTestisql = "UPDATE `data_performance` SET `status` = 2, `filtered_by` = ? WHERE id = ?";
    } else if ($_POST['ajaxid'] == 2) {
        //pribadi
        $updateStatusTestisql = "UPDATE `data_performance` SET `status` = 1, `filtered_by` = ? WHERE id = ?";
    } else if ($_POST['ajaxid'] == 3) {
        //undo
        $updateStatusTestisql = "UPDATE `data_performance` SET `status` = 0, `filtered_by` = ? WHERE id = ?";
    } else if ($_POST['ajaxid'] == 4) {
        //tidak lolos
        $updateStatusTestisql = "UPDATE `data_performance` SET `status` = 3, `filtered_by` = ? WHERE id = ?";
    }
    //PENILAIAN KUARTAL 1 BEM 2021/2022
    else if ($_POST['ajaxid'] == 5) {
        //lolos
        $updateStatusTestisql = "UPDATE `bem_kuartal1_2024` SET `status` = 2, `filtered_by` = ? WHERE id = ?";
    } else if ($_POST['ajaxid'] == 6) {
        //tidak lolos
        $updateStatusTestisql = "UPDATE `bem_kuartal1_2024` SET `status` = 1, `filtered_by` = ? WHERE id = ?";
    } else if ($_POST['ajaxid'] == 7) {
        //undo
        $updateStatusTestisql = "UPDATE `bem_kuartal1_2024` SET `status` = 0, `filtered_by` = ? WHERE id = ?";
    }
    $updateStatusTestistmt = $pdo->prepare($updateStatusTestisql);
    $updateStatusTestistmt->execute([$_SESSION['nrp'], $_POST['id']]);

    echo "true";
} else {
    echo "false";
}
?>