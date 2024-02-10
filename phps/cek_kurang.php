<?php
    require "connect.php";

    $getFungsiosql = "SELECT * FROM bem_fungsionaris_2024";
    $getFungsiostmt = $pdo->prepare($getFungsiosql);
    $getFungsiostmt->execute();

    echo "<title>Cek Kurang BEM Reach</title>";

    //Start Looping
    while($getFungsio = $getFungsiostmt->fetch()){
        //var_dump($getFungsio);
        echo "<b>" . $getFungsio['id'] . " - " . $getFungsio['nrp'] . " - " . $getFungsio['nama'] . "</b><br>";
        $kurang = 0;

        //Start Check

        // PIC BEM
        //ANC
        // if ($getFungsio['nrp'] == 'A11190054') {
        //     $nrpKetuaUKM = '("F11190007")';
        // }
        // if ($getFungsio['nrp'] == 'F11200065') {
        //     $nrpKetuaUKM = '("F11190042","F11200047")';
        // }
        // if ($getFungsio['nrp'] == 'E12200150') {
        //     $nrpKetuaUKM = '("F11190052", "D12190157")';
        // }
        // if ($getFungsio['nrp'] == 'C14200040') {
        //     $nrpKetuaUKM = '("B11190045", " B12190032")';
        // }
        // if ($getFungsio['nrp'] == 'D11200097') {
        //     $nrpKetuaUKM = '("D12190093", "E12200089")';
        // }
        //SPORT
        // if ($getFungsio['nrp'] == 'D11200114') {
        //     $nrpKetuaUKM = '("D12190027", "C14200050")';
        // }
        // if ($getFungsio['nrp'] == 'D11190462') {
        //     $nrpKetuaUKM = '("C14200090", "D11200047")';
        // }
        // if ($getFungsio['nrp'] == 'F11200026') {
        //     $nrpKetuaUKM = '("C14190154", "C13200013")';
        // }
        // if ($getFungsio['nrp'] == 'D12200029') {
        //     $nrpKetuaUKM = '("D11190402", "D11200039", "E12200097")';
        // }
        // if ($getFungsio['nrp'] == 'D11200379') {
        //     $nrpKetuaUKM = '("D11190006", "C14200127", "E12200039")';
        // }
        // //IR
        // if ($getFungsio['nrp'] == 'D11200348') {
        //     $nrpKetuaUKM = '("C14200191")';
        // }
        // if ($getFungsio['nrp'] == 'D11200030') {
        //     $nrpKetuaUKM = '("E11190004")';
        // }
        // if ($getFungsio['nrp'] == 'A11200063') {
        //     $nrpKetuaUKM = '("B12190064")';
        // }

        // KETUA UKM
        //ANC
        // if ($getFungsio['nrp'] == 'F11190007') {
        //     $nrpPICBEM = '("A11190054")';
        // }
        // if ($getFungsio['nrp'] == 'B11190045' || $getFungsio['nrp'] == 'B12190032') {
        //     $nrpPICBEM = '("C14200040")';
        // }
        // if ($getFungsio['nrp'] == 'F11190052' || $getFungsio['nrp'] == 'D12190157') {
        //     $nrpPICBEM = '("E12200150")';
        // }
        // if ($getFungsio['nrp'] == 'F11190042' || $getFungsio['nrp'] == 'F11200047') {
        //     $nrpPICBEM = '("F11200065")';
        // }
        // if ($getFungsio['nrp'] == 'D12190093' || $getFungsio['nrp'] == 'E12200089') {
        //     $nrpPICBEM = '("D11200097")';
        // }
        //SPORT
        // if ($getFungsio['nrp'] == 'D12190027' || $getFungsio['nrp'] == 'C14200050') {
        //     $nrpPICBEM = '("D11200114")';
        // }
        // if ($getFungsio['nrp'] == 'C14200090' || $getFungsio['nrp'] == 'D11200047') {
        //     $nrpPICBEM = '("D11190462")';
        // }
        // if ($getFungsio['nrp'] == 'C14190154' || $getFungsio['nrp'] == 'C13200013') {
        //     $nrpPICBEM = '("F11200026")';
        // }
        // if ($getFungsio['nrp'] == 'D11190402' || $getFungsio['nrp'] == 'D11200039'
        // || $getFungsio['nrp'] == 'E12200097') {
        //     $nrpPICBEM = '("D12200029")';
        // }
        // if ($getFungsio['nrp'] == 'D11190006' || $getFungsio['nrp'] == 'C14200127' || $getFungsio['nrp'] == 'E12200039') {
        //     $nrpPICBEM = '("D11200379")';
        // }
        //IR
        // if ($getFungsio['nrp'] == 'C14200191') {
        //     $nrpPICBEM = '("D11200348")';
        // }
        // if ($getFungsio['nrp'] == 'E11190004') {
        //     $nrpPICBEM = '("D11200030")';
        // }
        // if ($getFungsio['nrp'] == 'B12190064') {
        //     $nrpPICBEM = '("A11200063")';
        // }

        // ASSESSMENT
        if (!isset($_POST['id'])) {
            // ALUR PENILAIAN:
            // https://drive.google.com/file/d/10u6OonBog78CnMWi2zmtSBk7BwYmQH94/view

            if ($getFungsio['id_jabatan'] == 1 || $getFungsio['id_jabatan'] == 8 || $getFungsio['id_jabatan'] == 9) {
                // BPH
                $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Ketua BEM', 'Sekretaris Umum', 'Bendahara Umum') AND a.nrp != ?
                UNION
                SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Bidang', 'Wakil Kepala Bidang') 
                UNION
                SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Departemen', 'Wakil Kepala Departemen') AND a.id_departemen = ?";
                $stmtFungsio = $pdo->prepare($sqlFungsio);
                $stmtFungsio->execute([$getFungsio['nrp'], $getFungsio['id_departemen']]);
            } else if ($getFungsio['id_jabatan'] == 2 || $getFungsio['id_jabatan'] == 3) {
                // KAWAKABID
                $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Ketua BEM', 'Sekretaris Umum', 'Bendahara Umum')
                UNION
                SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Bidang', 'Wakil Kepala Bidang') AND a.nrp != ?
                UNION
                SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Departemen', 'Wakil Kepala Departemen') AND a.id_bidang = ?";
                $stmtFungsio = $pdo->prepare($sqlFungsio);
                $stmtFungsio->execute([$getFungsio['nrp'], $getFungsio['id_bidang']]);
            } else if ($getFungsio['id_jabatan'] == 4 || $getFungsio['id_jabatan'] == 5 || $getFungsio['id_jabatan'] == 6 || $getFungsio['id_jabatan'] == 10) {
                // KAWAKADEPT, ANGGOTA, KETUA UKM
                if ($getFungsio['id_bidang'] == 1) {    
                    //KHUSUS BIDANG 1
                    if ($getFungsio['id_jabatan'] == 6) {
                        // ANGGOTA
                        $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Departemen', 'Wakil Kepala Departemen', 'Fungsionaris', 'Internship') AND a.id_departemen = ? AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Ketua BEM', 'Sekretaris Umum', 'Bendahara Umum') AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Bidang', 'Wakil Kepala Bidang') AND a.id_bidang = ?";
                        $stmtFungsio = $pdo->prepare($sqlFungsio);
                        $stmtFungsio->execute([$getFungsio['id_departemen'], $getFungsio['nrp'], $getFungsio['nrp'], $getFungsio['id_bidang']]);
                    }else if ($getFungsio['id_jabatan'] == 10) {
                        // Ketua UKM
                        echo "<b>Role: Ketua UKM </b><br>";
                        $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Departemen', 'Wakil Kepala Departemen', 'Fungsionaris', 'Internship') AND a.id_departemen = ? AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Ketua BEM', 'Sekretaris Umum', 'Bendahara Umum') AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Bidang', 'Wakil Kepala Bidang') AND a.id_bidang = ?";
                        $stmtFungsio = $pdo->prepare($sqlFungsio);
                        $stmtFungsio->execute([$getFungsio['id_departemen'], $getFungsio['nrp'], $getFungsio['nrp'], $getFungsio['id_bidang']]);
                    } else {
                        // KAWAKADEPT
                        $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Departemen', 'Wakil Kepala Departemen', 'Fungsionaris', 'Internship', 'Ketua UKM') AND a.id_departemen = ? AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Ketua BEM', 'Sekretaris Umum', 'Bendahara Umum') AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Bidang', 'Wakil Kepala Bidang') AND a.id_bidang = ?";
                        $stmtFungsio = $pdo->prepare($sqlFungsio);
                        $stmtFungsio->execute([$getFungsio['id_departemen'], $getFungsio['nrp'], $getFungsio['nrp'], $getFungsio['id_bidang']]);
                    }
                } else {
                    if ($getFungsio['id_jabatan'] == 6) {
                        // ANGGOTA
                        $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Departemen', 'Wakil Kepala Departemen', 'Fungsionaris', 'Internship') AND a.id_departemen = ? AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Ketua BEM', 'Sekretaris Umum', 'Bendahara Umum') AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Bidang', 'Wakil Kepala Bidang') AND a.id_bidang = ?";
                        $stmtFungsio = $pdo->prepare($sqlFungsio);
                        $stmtFungsio->execute([$getFungsio['id_departemen'], $getFungsio['nrp'], $getFungsio['nrp'], $getFungsio['id_bidang']]);
                    } else {
                        // KAWAKADEPT
                        $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Departemen', 'Wakil Kepala Departemen', 'Fungsionaris', 'Internship') AND a.id_departemen = ? AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Ketua BEM', 'Sekretaris Umum', 'Bendahara Umum') AND a.nrp != ?
                        UNION
                        SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Bidang', 'Wakil Kepala Bidang') AND a.id_bidang = ?";
                        $stmtFungsio = $pdo->prepare($sqlFungsio);
                        $stmtFungsio->execute([$getFungsio['id_departemen'], $getFungsio['nrp'], $getFungsio['nrp'], $getFungsio['id_bidang']]);
                    }
                }
            } else {
                // INTERNSHIP --> di comment soalnya intern ga nilai siapa"
                // $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Kepala Departemen', 'Wakil Kepala Departemen', 'Sekretaris Umum', 'Bendahara Umum') AND a.id_departemen = ?";
                // $stmtFungsio = $pdo->prepare($sqlFungsio);
                // $stmtFungsio->execute([$getFungsio['id_departemen']]);
            }
        } 
        //else {
        // // TESTIMONI
        // // kebalikan dari assessment

        //     if ($getFungsio['id_jabatan'] == 1 || $getFungsio['id_jabatan'] == 2 || $getFungsio['id_jabatan'] == 3
        //     ) {
        //         // BPH
        //         $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama NOT IN ('Ketua BEM', 'Sekretaris Umum', 'Bendahara Umum', 'Kepala Bidang', 'Wakil Kepala Bidang') AND a.id_departemen != ?
        //         ORDER BY
        //         CASE c.nama
        //             WHEN 'Ketua BEM' THEN 1
        //             WHEN 'Sekretaris Umum' THEN 2
        //             WHEN 'Bendahara Umum' THEN 3
        //             WHEN 'Kepala Bidang' THEN 4
        //             WHEN 'Wakil Kepala Bidang' THEN 5
        //             WHEN 'Kepala Departemen' THEN 6
        //             WHEN 'Wakil Kepala Departemen' THEN 7
        //             WHEN 'Fungsionaris' THEN 8
        //             WHEN 'Ketua UKM' THEN 9
        //             WHEN 'Internship' THEN 10
        //         END, a.id_bidang, departemen";
        //         $stmtFungsio = $pdo->prepare($sqlFungsio);
        //         $stmtFungsio->execute([$getFungsio['id_departemen']]);
        //     } else if ($getFungsio['id_jabatan'] == 4 || $getFungsio['id_jabatan'] == 5) {
        //         // KAWAKABID
        //         $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama NOT IN ('Ketua BEM', 'Sekretaris Umum', 'Bendahara Umum', 'Kepala Bidang', 'Wakil Kepala Bidang') AND IF (a.id_bidang = ?, c.nama NOT IN ('Kepala Departemen', 'Wakil Kepala Departemen'), c.nama IN ('Kepala Departemen', 'Wakil Kepala Departemen', 'Fungsionaris', 'Ketua UKM', 'Internship'))
        //         ORDER BY
        //         CASE c.nama
        //             WHEN 'Ketua BEM' THEN 1
        //             WHEN 'Sekretaris Umum' THEN 2
        //             WHEN 'Bendahara Umum' THEN 3
        //             WHEN 'Kepala Bidang' THEN 4
        //             WHEN 'Wakil Kepala Bidang' THEN 5
        //             WHEN 'Kepala Departemen' THEN 6
        //             WHEN 'Wakil Kepala Departemen' THEN 7
        //             WHEN 'Fungsionaris' THEN 8
        //             WHEN 'Ketua UKM' THEN 9
        //             WHEN 'Internship' THEN 10
        //         END, a.id_bidang, departemen";
        //         $stmtFungsio = $pdo->prepare($sqlFungsio);
        //         $stmtFungsio->execute([$getFungsio['id_bidang']]);
        //     } else if ($getFungsio['id_jabatan'] == 6 || $getFungsio['id_jabatan'] == 7 || $getFungsio['id_jabatan'] == 8 || $getFungsio['id_jabatan'] == 9) {
        //         // KAWAKADEPT, ANGGOTA, KETUA UKM, PIC BEM
        //         if ($getFungsio['id_bidang'] == 1) {
        //             if ($getFungsio['id_jabatan'] == 9) {
        //                 // KETUA UKM
        //                 $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE a.nrp != ? AND a.nrp NOT IN " . $nrpPICBEM . "
        //                 ORDER BY
        //                 CASE c.nama
        //                     WHEN 'Ketua BEM' THEN 1
        //                     WHEN 'Sekretaris Umum' THEN 2
        //                     WHEN 'Bendahara Umum' THEN 3
        //                     WHEN 'Kepala Bidang' THEN 4
        //                     WHEN 'Wakil Kepala Bidang' THEN 5
        //                     WHEN 'Kepala Departemen' THEN 6
        //                     WHEN 'Wakil Kepala Departemen' THEN 7
        //                     WHEN 'Fungsionaris' THEN 8
        //                     WHEN 'Ketua UKM' THEN 9
        //                     WHEN 'Internship' THEN 10
        //                 END, a.id_bidang, departemen";
        //                 $stmtFungsio = $pdo->prepare($sqlFungsio);
        //                 $stmtFungsio->execute([$getFungsio['nrp']]);
        //             } else if ($getFungsio['id_jabatan'] == 8) {
        //                 // ANGGOTA
        //                 $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE a.id_departemen != ?
        //                 UNION
        //                 SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE IF (a.id_jabatan = 9, c.nama IN ('Ketua UKM') AND a.id_departemen = ? AND a.nrp NOT IN " . $nrpKetuaUKM . ", 0)";
        //                 $stmtFungsio = $pdo->prepare($sqlFungsio);
        //                 $stmtFungsio->execute([$getFungsio['id_departemen'], $getFungsio['id_departemen']]);
        //             } else {
        //                 // KAWAKADEPT
        //                 $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE IF (a.id_bidang = ?, c.nama NOT IN ('Kepala Bidang', 'Wakil Kepala Bidang', 'Kepala Departemen', 'Wakil Kepala Departemen') AND a.id_departemen != ?, 1)
        //                 UNION
        //                 SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE IF (a.id_jabatan = 9, c.nama IN ('Ketua UKM') AND a.id_departemen = ?, 0)";
        //                 $stmtFungsio = $pdo->prepare($sqlFungsio);
        //                 $stmtFungsio->execute([$getFungsio['id_bidang'], $getFungsio['id_departemen'], $getFungsio['id_departemen']]);
        //             }
        //         } else {
        //             if ($getFungsio['id_jabatan'] == 8) {
        //                 // ANGGOTA
        //                 $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE a.id_departemen != ?
        //                 ORDER BY
        //                 CASE c.nama
        //                     WHEN 'Ketua BEM' THEN 1
        //                     WHEN 'Sekretaris Umum' THEN 2
        //                     WHEN 'Bendahara Umum' THEN 3
        //                     WHEN 'Kepala Bidang' THEN 4
        //                     WHEN 'Wakil Kepala Bidang' THEN 5
        //                     WHEN 'Kepala Departemen' THEN 6
        //                     WHEN 'Wakil Kepala Departemen' THEN 7
        //                     WHEN 'Fungsionaris' THEN 8
        //                     WHEN 'Ketua UKM' THEN 9
        //                     WHEN 'Internship' THEN 10
        //                 END, a.id_bidang, departemen";
        //                 $stmtFungsio = $pdo->prepare($sqlFungsio);
        //                 $stmtFungsio->execute([$getFungsio['id_departemen']]);
        //             } else {
        //                 // KAWAKADEPT
        //                 $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE IF (a.id_bidang = ?, c.nama NOT IN ('Kepala Bidang', 'Wakil Kepala Bidang', 'Kepala Departemen', 'Wakil Kepala Departemen') AND a.id_departemen != ?, 1)
        //                 ORDER BY
        //                 CASE c.nama
        //                     WHEN 'Ketua BEM' THEN 1
        //                     WHEN 'Sekretaris Umum' THEN 2
        //                     WHEN 'Bendahara Umum' THEN 3
        //                     WHEN 'Kepala Bidang' THEN 4
        //                     WHEN 'Wakil Kepala Bidang' THEN 5
        //                     WHEN 'Kepala Departemen' THEN 6
        //                     WHEN 'Wakil Kepala Departemen' THEN 7
        //                     WHEN 'Fungsionaris' THEN 8
        //                     WHEN 'Ketua UKM' THEN 9
        //                     WHEN 'Internship' THEN 10
        //                 END, a.id_bidang, departemen";
        //                 $stmtFungsio = $pdo->prepare($sqlFungsio);
        //                 $stmtFungsio->execute([$getFungsio['id_bidang'], $getFungsio['id_departemen']]);
        //             }
        //         }
        //     } else {
        //         // INTERNSHIP
        //         $sqlFungsio = "SELECT a.id, a.nama, a.nrp, c.nama as jabatan, a.id_bidang, b.singkatan as departemen FROM bem_fungsionaris_2024 a LEFT JOIN bem_departemen_2024 b ON a.id_departemen = b.id JOIN bem_jabatan_2024 c ON a.id_jabatan = c.id WHERE c.nama IN ('Fungsionaris') AND a.id_departemen = ?";
        //         $stmtFungsio = $pdo->prepare($sqlFungsio);
        //         $stmtFungsio->execute([$getFungsio['id_departemen']]);
        //     }
        // }

        while ($rowFungsio = $stmtFungsio->fetch()) {
            // buat ngecek apakah fungsio ini sudah pernah dinilai oleh nrp yang bersangkutan
            $sqlCek = "SELECT * FROM bem_kuartal1_2024 WHERE id_fungsionaris = ? AND id_fungsionaris_penilai = ?";
            $stmtCek = $pdo->prepare($sqlCek);
            $stmtCek->execute([$rowFungsio['id'], $getFungsio['id']]);
            if ($stmtCek->rowCount() == 0) {
                $kurang++;
                echo "<span style='color: red;'><b>[X]";
                if ($rowFungsio['jabatan'] == 'Kepala Bidang' || $rowFungsio['jabatan'] == 'Wakil Kepala Bidang') {
                    echo strtoupper($rowFungsio['nrp']) . " - " . $rowFungsio['nama'] . " - " . $rowFungsio['jabatan'] . " " . $rowFungsio['id_bidang']. "<br>";
                } else if ($rowFungsio['jabatan'] == 'Kepala Departemen' || $rowFungsio['jabatan'] == 'Wakil Kepala Departemen' || $rowFungsio['jabatan'] == 'Fungsionaris' || $rowFungsio['jabatan'] == 'Internship' || $rowFungsio['jabatan'] == 'Ketua UKM') {
                    echo strtoupper($rowFungsio['nrp']) . " - " . $rowFungsio['nama'] . " - " . $rowFungsio['jabatan'] . " " . $rowFungsio['departemen']. "<br>";
                } else {
                    echo strtoupper($rowFungsio['nrp']) . " - " . $rowFungsio['nama'] . " - " . $rowFungsio['jabatan']. "<br>";
                }
                echo "</b></span>";
            }else{
                echo "<span style='color: green;'>";
                if ($rowFungsio['jabatan'] == 'Kepala Bidang' || $rowFungsio['jabatan'] == 'Wakil Kepala Bidang') {
                    echo strtoupper($rowFungsio['nrp']) . " - " . $rowFungsio['nama'] . " - " . $rowFungsio['jabatan'] . " " . $rowFungsio['id_bidang']. "<br>";
                } else if ($rowFungsio['jabatan'] == 'Kepala Departemen' || $rowFungsio['jabatan'] == 'Wakil Kepala Departemen' || $rowFungsio['jabatan'] == 'Fungsionaris' || $rowFungsio['jabatan'] == 'Internship' || $rowFungsio['jabatan'] == 'Ketua UKM') {
                    echo strtoupper($rowFungsio['nrp']) . " - " . $rowFungsio['nama'] . " - " . $rowFungsio['jabatan'] . " " . $rowFungsio['departemen']. "<br>";
                } else {
                    echo strtoupper($rowFungsio['nrp']) . " - " . $rowFungsio['nama'] . " - " . $rowFungsio['jabatan']. "<br>";
                }
                echo "</span>";
            }
        }
        if($kurang > 0){
            echo "<span style='color: red;'><b>Total Kurang: " . $kurang . "</b></span>";
        }else{
            echo "<span style='color: green;'><b>Lengkap</b></span>";
        }
        echo "<br><br>";
        //End Check
    }//END LOOP

    
?>