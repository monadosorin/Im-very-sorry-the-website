<?php
    include 'connect.php';

    header("Content-Type: application/json");

    if (isset($_GET['id'])) {
        if ($_GET['id'] == 1) {
            //database acara
            $sql = "SELECT * FROM event ORDER BY year DESC";
        } else if ($_GET['id'] == 2) {
            //database divisi
            $sql = "SELECT a.id, a.nama, b.name as acara, b.year as tahun_acara FROM divisi_event a JOIN event b ON a.id_event = b.id ORDER BY a.id DESC";
        } else if ($_GET['id'] == 3) {
            //database panitia
            $sql = "SELECT a.id, a.nrp, a.nama, jabatan, c.nama as divisi, d.name as acara, d.year as tahun_acara FROM panitia_event a JOIN divisi_event c ON a.id_divisi = c.id JOIN event d ON a.id_event = d.id ORDER BY a.id DESC";
        } else if ($_GET['id'] == 4) {
            //filter testimoni
            $sql = "SELECT a.id, a.nrp, a.nama, a.nrp_penilai, a.nama_penilai, c.name as acara, testimoni, a.submitted_on FROM data_performance a JOIN event c ON a.id_event = c.id WHERE a.status = 0 ORDER BY a.id DESC LIMIT 100";
        } else if ($_GET['id'] == 5) {
            //assessment history
            $sql = "SELECT a.id, a.nrp, a.nama, b.jabatan, d.nama as divisi, name as acara, year as tahun_acara, submitted_on FROM data_performance a JOIN panitia_event b ON a.id_panitia = b.id JOIN event c ON a.id_event = c.id JOIN divisi_event d ON b.id_divisi = d.id WHERE nrp_penilai = '" . $_SESSION['nrp'] . "' ORDER BY a.id DESC";
        } else if ($_GET['id'] == 6) {
            //testimoni pribadi
            $sql = "SELECT a.id, a.nrp, a.nama, a.nrp_penilai, a.nama_penilai, c.name as acara, testimoni, a.filtered_by FROM data_performance a JOIN event c ON a.id_event = c.id WHERE a.status = 1 ORDER BY a.id DESC LIMIT 500";
        } else if ($_GET['id'] == 7) {
            //history filter testimoni
            $sql = "SELECT a.id, a.nrp, a.nama, a.nrp_penilai, a.nama_penilai, c.name as acara, testimoni, a.status, a.filtered_by FROM data_performance a JOIN event c ON a.id_event = c.id WHERE a.status IN (1, 2, 3) ORDER BY a.id DESC";
        } else if ($_GET['id'] == 8) {
            if (!isset($_GET['angkatan']) && !isset($_GET['divisi']) && !isset($_GET['fakultas']) && !isset($_GET['jurusan'])) {
                $angkatan = "";
                $divisi = "";
                $fakultas = "";
                $jurusan = "";
                $pengalaman = "";
            } else {
                if ($_GET['angkatan'] == "") {
                    $angkatan = "";
                } else {
                    $angkatan = "AND angkatan = " . $_GET['angkatan'];
                }
                if ($_GET['divisi'] == "") {
                    $pengalaman = "";
                    $divisi = "";
                } else {
                    if ($_GET['divisi'] == 'Acara') {
                        $pengalaman = "AND (pengalaman LIKE '%acara%' OR pengalaman LIKE '%mc %' OR pengalaman LIKE 'mc %' OR pengalaman LIKE '%mc' OR pengalaman LIKE '%master of ceremony%' OR pengalaman LIKE '%event%')";
                        $divisi = "AND (b.nama LIKE '%acara%' OR b.nama LIKE '%event%')";
                    } else if ($_GET['divisi'] == 'PDD') {
                        $pengalaman = "AND (pengalaman LIKE '%pdd %' OR pengalaman LIKE 'pdd %' OR pengalaman LIKE '%pdd' OR pengalaman LIKE '%,pdd %' OR pengalaman LIKE '%.pdd %' OR pengalaman LIKE '%publikasi%' OR pengalaman LIKE '%dekor%' OR pengalaman LIKE '%dokumentasi%' OR pengalaman LIKE '%publication%' OR pengalaman LIKE '%decoration%' OR pengalaman LIKE '%documentation%' OR pengalaman LIKE '%creative%' OR pengalaman LIKE '%fotografer%' OR pengalaman LIKE '%photography%' OR pengalaman LIKE '%layout%' OR pengalaman LIKE '%illus%' OR pengalaman LIKE '%ilus%' OR pengalaman LIKE '%pubdekdok%')";
                        $divisi = "AND (b.nama LIKE '%pdd%' OR b.nama LIKE '%publikasi%' OR b.nama LIKE '%dekor%' OR b.nama LIKE '%dokumentasi%' OR b.nama LIKE '%creative%' OR b.nama LIKE '%fotografer%' OR b.nama LIKE '%layout%' OR b.nama LIKE '%illus%' OR b.nama LIKE '%ilus%' OR b.nama LIKE '%photography%' OR b.nama LIKE '%publication%' OR b.nama LIKE '%decoration%' OR b.nama LIKE '%documentation%' OR b.nama LIKE '%pubdekdok%')";
                    } else if ($_GET['divisi'] == 'Sekretariat') {
                        $pengalaman = "AND (pengalaman LIKE '%sekret%' OR pengalaman LIKE '%gsab%' OR pengalaman LIKE '%sekkon%' OR pengalaman LIKE '%sekon%' OR pengalaman LIKE '%secretary%' OR pengalaman LIKE '%sekben%')";
                        $divisi = " AND (b.nama LIKE '%sekret%' OR b.nama LIKE '%sekkon%' OR b.nama LIKE '%sekon%' OR b.nama LIKE '%secretary%' OR b.nama LIKE '%sekben%')";
                    } else if ($_GET['divisi'] == 'Public Relation') {
                        $pengalaman = "AND (pengalaman LIKE '%public relation%' OR pengalaman LIKE '%hubungan masyarakat%' OR pengalaman LIKE '%humas%' OR pengalaman LIKE '% pr %' OR pengalaman LIKE 'pr %' OR pengalaman LIKE '% pr' OR pengalaman LIKE '%,pr %' OR pengalaman LIKE '%.pr %' OR pengalaman LIKE '%&pr %' OR pengalaman LIKE '%pubsek%' OR pengalaman LIKE '%pubsekhum%')";
                        $divisi = "AND (b.nama LIKE '%public relation%' OR b.nama LIKE '%hubungan masyarakat%' OR b.nama LIKE '%humas%' OR b.nama LIKE '% pr %' OR b.nama LIKE 'pr %' OR b.nama LIKE '% pr' OR b.nama LIKE '%&pr %' OR b.nama LIKE '%pubsek%' OR b.nama LIKE '%pubsekhum%')";
                    } else if ($_GET['divisi'] == 'Perlengkapan') {
                        $pengalaman = "AND (pengalaman LIKE '%perkap%' OR pengalaman LIKE '%transka%' OR pengalaman LIKE '%transakap%' OR pengalaman LIKE '%perleng%' OR pengalaman LIKE '%supply%' OR pengalaman LIKE '%equipment%')";
                        $divisi = " AND (b.nama LIKE '%perkap%' OR b.nama LIKE '%transka%' OR b.nama LIKE '%transakap%' OR b.nama LIKE '%perleng%' OR b.nama LIKE '%supply%' OR b.nama LIKE '%equipment%')";
                    } else if ($_GET['divisi'] == 'Konsumsi') {
                        $pengalaman = "AND (pengalaman LIKE '%konsum%' OR pengalaman LIKE '%sekkon%' OR pengalaman LIKE '%sekon%' OR pengalaman LIKE '%konkes%' OR pengalaman LIKE '%consumption%')";
                        $divisi = " AND (b.nama LIKE '%konsum%' OR b.nama LIKE '%sekkon%' OR b.nama LIKE '%sekon%' OR b.nama LIKE '%konkes%' OR b.nama LIKE '%consumption%')";
                    } else if ($_GET['divisi'] == 'IT') {
                        $pengalaman = "AND (pengalaman LIKE '% it %' OR pengalaman LIKE 'it %' OR pengalaman LIKE '% it' OR pengalaman LIKE '%,it %' OR pengalaman LIKE '%.it %' OR pengalaman LIKE '%&it %' OR pengalaman LIKE '%information%' OR pengalaman LIKE '%informasi%' OR pengalaman LIKE '%sistem%' OR pengalaman LIKE '%system%' OR pengalaman LIKE '%technology%' OR pengalaman LIKE '%teknologi%') AND pengalaman NOT LIKE '%step towards it%'";
                        $divisi = "AND (b.nama LIKE '% it %' OR b.nama LIKE 'it %' OR b.nama LIKE '%&it %' OR pengalaman LIKE '% it' OR b.nama LIKE 'it' OR b.nama LIKE '%information%' OR b.nama LIKE '%informasi%' OR b.nama LIKE '%sistem%' OR b.nama LIKE '%system%' OR b.nama LIKE '%technology%' OR b.nama LIKE '%teknologi%')";
                    } else if ($_GET['divisi'] == 'Sponsor') {
                        $pengalaman = "AND (pengalaman LIKE '%sponsor%' OR pengalaman LIKE '%danus%' OR pengalaman LIKE '% dana%' OR pengalaman LIKE '%dana usaha%')";
                        $divisi = "AND (b.nama LIKE '%sponsor%' OR b.nama LIKE '%danus%' OR b.nama LIKE '%dana%' OR b.nama LIKE '%dana usaha%')";
                    } else if ($_GET['divisi'] == 'Keamanan') {
                        $pengalaman = "AND (pengalaman LIKE '%keamanan%' OR pengalaman LIKE '%transkaman%' OR pengalaman LIKE '%transkapman%' OR pengalaman LIKE '%perkapman%' OR pengalaman LIKE '%security%' OR pengalaman LIKE '%tata aturan%')";
                        $divisi = "AND (b.nama LIKE '%keamanan%' OR b.nama LIKE '%transkaman%' OR b.nama LIKE '%transkapman%' OR b.nama LIKE '%perkapman%' OR b.nama LIKE '%security%' OR b.nama LIKE '%tata aturan%')";
                    } else if ($_GET['divisi'] == 'Kesehatan') {
                        $pengalaman = "AND (pengalaman LIKE '%kesehatan%' OR pengalaman LIKE '%konkes%' OR pengalaman LIKE '%health%')";
                        $divisi = "AND (b.nama LIKE '%kesehatan%' OR b.nama LIKE '%konkes%' OR b.nama LIKE '%health%')";
                    } else if ($_GET['divisi'] == 'Materi') {
                        $pengalaman = "AND (pengalaman LIKE '%materi%')";
                        $divisi = "AND (b.nama LIKE '%materi%')";
                    } else if ($_GET['divisi'] == 'Peran') {
                        $pengalaman = "AND (pengalaman LIKE '%peran%' OR pengalaman LIKE '%frontline%' OR pengalaman LIKE '%front line%' OR pengalaman LIKE '% fl %' OR pengalaman LIKE 'fl %' OR pengalaman LIKE '%,fl %' OR pengalaman LIKE '%.fl %')";
                        $divisi = "AND (b.nama LIKE '%peran%' OR b.nama LIKE '%frontline%' OR b.nama LIKE '%front line%' OR b.nama LIKE 'fl')";
                    } else if ($_GET['divisi'] == 'Asisten Tutor') {
                        $pengalaman = "AND (pengalaman LIKE '%asisten tutor%' OR pengalaman LIKE '% astor%' OR pengalaman LIKE '%tutor assistant%')";
                        $divisi = "AND (b.nama LIKE '%asisten tutor%' OR b.nama LIKE '%astor%' OR b.nama LIKE '%tutor assistant%')";
                    }
                }
                if ($_GET['fakultas'] == "") {
                    $fakultas = "";
                } else {
                    $fakultas = "AND SUBSTRING_INDEX(jurusan, ' - ', 1) = '" . $_GET['fakultas'] . "'";
                }
                if ($_GET['jurusan'] == "") {
                    $jurusan = "";
                } else {
                    $jurusan = "AND SUBSTRING_INDEX(jurusan, ' - ', -1) = '" . $_GET['jurusan'] . "'";
                }
            }

            $sql = "SELECT nrp, nama, SUBSTRING_INDEX(jurusan, ' - ', 1) as fakultas, SUBSTRING_INDEX(jurusan, ' - ', -1) as program, angkatan, photo_filepath FROM mahasiswa_cv WHERE status > 0 AND nrp NOT IN ('c14190034') " . $angkatan . " " . $pengalaman . " " . $fakultas . " " . $jurusan . "UNION DISTINCT SELECT c.nrp, c.nama, SUBSTRING_INDEX(SUBSTRING_INDEX(c.jurusan, ' - ', 1), ' - ', -1) as fakultas, SUBSTRING_INDEX(SUBSTRING_INDEX(c.jurusan, ' - ', 2), ' - ', -1) as jurusan, c.angkatan, c.photo_filepath FROM panitia_event a JOIN divisi_event b ON a.id_divisi = b.id JOIN mahasiswa_cv c ON a.nrp = c.nrp WHERE c.status > 0 " . $divisi . " " . $angkatan . " " . $fakultas . " " . $jurusan . " ORDER BY RAND()";
        } else if ($_GET['id'] == 9) {
            //testimoni tidak lolos
            $sql = "SELECT a.id, a.nrp, a.nama, a.nrp_penilai, a.nama_penilai, c.name as acara, testimoni, a.filtered_by FROM data_performance a JOIN event c ON a.id_event = c.id WHERE a.status = 3 ORDER BY a.id DESC";
        } else if ($_GET['id'] == 10) {
            //assessment history bem
            $sql = "SELECT a.id, b.nrp, b.nama, CASE
                WHEN b.id_jabatan IN (1, 2, 3, 4, 5, 9) THEN c.nama
                WHEN b.id_jabatan IN (6, 7, 8, 10, 11) THEN CONCAT(c.nama, ' ', d.singkatan)
                END as jabatan, b.id_bidang, a.submitted_on FROM bem_kuartal1_2024 a JOIN bem_fungsionaris_2024 b ON a.id_fungsionaris = b.id JOIN bem_jabatan_2024 c ON b.id_jabatan = c.id LEFT JOIN bem_departemen_2024 d ON b.id_departemen = d.id WHERE a.id_fungsionaris_penilai = (SELECT id FROM bem_fungsionaris_2024 WHERE nrp = '" . $_SESSION['nrp'] . "') ORDER BY a.id DESC";
        } else if ($_GET['id'] == 11 || $_GET['id'] == 12 || $_GET['id'] == 13) {
            if ($_GET['id'] == 11) {
                //filter testimoni bem
                $status = '(0)';
            } else if ($_GET['id'] == 12) {
                //testimoni tidak lolos
                $status = '(1)';
            } else if ($_GET['id'] == 13) {
                //filter history
                $status = '(1, 2)';
            }
            $sql = "SELECT b.nrp, b.nama, b.id_bidang, b.id as id_fungsio,
            CASE
                WHEN b.id_jabatan IN (1, 2, 3, 4, 5, 9) THEN d.nama
                WHEN b.id_jabatan IN (6, 7, 8, 10, 11) THEN CONCAT(d.nama, ' ', c.singkatan)
                        END as jabatan, 
                        c.nama as departemen
            FROM bem_fungsionaris_2024 b LEFT JOIN bem_departemen_2024 c ON b.id_departemen = c.id JOIN bem_jabatan_2024 d ON b.id_jabatan = d.id  
            where b.id in (select id_fungsionaris from bem_kuartal1_2024)
            ORDER BY `b`.`nama` ASC;";
        } else if ($_GET['id'] == 14) {
            //status fungsionaris bem
            $sql = "SELECT DISTINCT b.nrp, b.nama, CASE
                    WHEN b.id_jabatan IN (1, 2, 3, 4, 5, 9) THEN c.nama
                    WHEN b.id_jabatan IN (6, 7, 8, 10, 11) THEN CONCAT(c.nama, ' ', d.singkatan)
                    END as jabatan, b.id_bidang, (SELECT COUNT(*) FROM  bem_kuartal1_2024 WHERE id_fungsionaris_penilai = e.id_fungsionaris_penilai) as status FROM bem_fungsionaris_2024 b LEFT JOIN bem_kuartal1_2024 e ON b.id = e.id_fungsionaris_penilai JOIN bem_jabatan_2024 c ON b.id_jabatan = c.id LEFT JOIN bem_departemen_2024 d ON b.id_departemen = d.id";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $result = array();
        while ($row = $stmt->fetch()) {
            array_push($result, $row);
        }
        echo json_encode($result);
    }
?>