<?php
    require "./connect.php";

    if (isset($_POST['fakultas'])) {
        $getProgramStudisql = "SELECT * FROM jurusanpcu WHERE fakultas = ?";
        $getProgramStudistmt = $pdo->prepare($getProgramStudisql);
        $getProgramStudistmt->execute([$_POST['fakultas']]);

        while ($getProgramStudirow = $getProgramStudistmt->fetch()) {
            $programStudi = $getProgramStudirow['jurusan'];
            echo "<option value='$programStudi'>$programStudi</option>";
        }
    } else {
        $getProgramStudisql = "SELECT jurusan FROM jurusanpcu ORDER BY id_jurusan, fakultas";
        $getProgramStudistmt = $pdo->prepare($getProgramStudisql);
        $getProgramStudistmt->execute([]);

        while ($getProgramStudirow = $getProgramStudistmt->fetch()) {
            $programStudi = $getProgramStudirow['jurusan'];
            echo "<option value='$programStudi'>$programStudi</option>";
        }
    }
?>