<?php
    require "connect.php";

    if (isset($_POST['acara'])) {
        $getDivisisql = 'SELECT * FROM divisi_event WHERE id_event = ?';
        $getDivisistmt = $pdo->prepare($getDivisisql);
        $getDivisistmt->execute([$_POST['acara']]);

        if ($getDivisistmt->rowCount() == 0) {
            echo "false";
            exit();
        }

        while ($getDivisirow = $getDivisistmt->fetch()) {
            $namaDivisi = $getDivisirow['nama'];
            $idDivisi = $getDivisirow['id'];
            echo "<option value='$idDivisi'>$namaDivisi</option>";
        }
    } else {
        exit();
    }
