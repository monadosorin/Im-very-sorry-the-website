<?php
    require "connect.php";

    if (isset($_POST['acara'])) {
        $getJabatanUsersql = "SELECT * FROM panitia_event WHERE nrp = ? AND id_event = ?";
        $getJabatanUserstmt = $pdo->prepare($getJabatanUsersql);
        $getJabatanUserstmt->execute([$_SESSION['nrp'], $_POST['acara']]);
        $getJabatanUserrow = $getJabatanUserstmt->fetch();

        // ASSESSMENT
        if (!isset($_POST['id'])) {
            // bph: sesama bph, semua koor wakoor
            // koor-wakoor: semua bph, sesama koor-wakoor, semua anggota divisinya
            // anggota: koor-wakoor, sesama anggota

            //monggo direnungi
            if ($getJabatanUserrow['jabatan'] == 'Badan Pengurus Harian') {
                $sqlMahasiswa = "SELECT a.id, a.nrp, a.nama, jabatan, c.nama as divisi FROM panitia_event a JOIN divisi_event c ON a.id_divisi = c.id WHERE jabatan IN ('Badan Pengurus Harian', 'Koordinator atau Wakil Koordinator') AND a.id_event = ? AND a.nrp != ? ORDER BY
                CASE jabatan
                    WHEN 'Badan Pengurus Harian' THEN 1
                    WHEN 'Koordinator atau Wakil Koordinator' THEN 2
                    WHEN 'Anggota Divisi' THEN 3
                END, divisi";
                $stmtMahasiswa = $pdo->prepare($sqlMahasiswa);
                $stmtMahasiswa->execute([$_POST['acara'], $_SESSION['nrp']]);
            } else if ($getJabatanUserrow['jabatan'] == 'Koordinator atau Wakil Koordinator') {
                $sqlMahasiswa = "SELECT a.id, a.nrp, a.nama, jabatan, c.nama as divisi FROM panitia_event a JOIN divisi_event c ON a.id_divisi = c.id WHERE jabatan IN ('Badan Pengurus Harian', 'Koordinator atau Wakil Koordinator') AND a.id_event = ? AND a.nrp != ? UNION SELECT a.id, a.nrp, a.nama, jabatan, c.nama as divisi FROM panitia_event a JOIN divisi_event c ON a.id_divisi = c.id WHERE jabatan = 'Anggota Divisi' AND a.id_event = ? AND a.nrp != ? AND a.id_divisi = ? ORDER BY
                CASE jabatan
                    WHEN 'Badan Pengurus Harian' THEN 1
                    WHEN 'Koordinator atau Wakil Koordinator' THEN 2
                    WHEN 'Anggota Divisi' THEN 3
                END, divisi";
                $stmtMahasiswa = $pdo->prepare($sqlMahasiswa);
                $stmtMahasiswa->execute([$_POST['acara'], $_SESSION['nrp'], $_POST['acara'], $_SESSION['nrp'], $getJabatanUserrow['id_divisi']]);
            } else if ($getJabatanUserrow['jabatan'] == 'Anggota Divisi') {
                $sqlMahasiswa = "SELECT a.id, a.nrp, a.nama, jabatan, c.nama as divisi FROM panitia_event a JOIN divisi_event c ON a.id_divisi = c.id WHERE jabatan IN ('Koordinator atau Wakil Koordinator', 'Anggota Divisi') AND a.id_event = ? AND a.nrp != ? AND a.id_divisi = ? ORDER BY
                CASE jabatan
                    WHEN 'Badan Pengurus Harian' THEN 1
                    WHEN 'Koordinator atau Wakil Koordinator' THEN 2
                    WHEN 'Anggota Divisi' THEN 3
                END, divisi";
                $stmtMahasiswa = $pdo->prepare($sqlMahasiswa);
                $stmtMahasiswa->execute([$_POST['acara'], $_SESSION['nrp'], $getJabatanUserrow['id_divisi']]);
            }
        } else {
            // TESTIMONI
            // kebalikan dari assessment

            if ($getJabatanUserrow['jabatan'] == 'Badan Pengurus Harian') {
                $sqlMahasiswa = "SELECT a.id, a.nrp, a.nama, jabatan, c.nama as divisi FROM panitia_event a JOIN divisi_event c ON a.id_divisi = c.id WHERE jabatan NOT IN ('Badan Pengurus Harian', 'Koordinator atau Wakil Koordinator') AND a.id_event = ? AND a.nrp != ? ORDER BY
                    CASE jabatan
                        WHEN 'Badan Pengurus Harian' THEN 1
                        WHEN 'Koordinator atau Wakil Koordinator' THEN 2
                        WHEN 'Anggota Divisi' THEN 3
                    END, divisi";
                $stmtMahasiswa = $pdo->prepare($sqlMahasiswa);
                $stmtMahasiswa->execute([$_POST['acara'], $_SESSION['nrp']]);
            } else if ($getJabatanUserrow['jabatan'] == 'Koordinator atau Wakil Koordinator') {
                $sqlMahasiswa = "SELECT a.id, a.nrp, a.nama, jabatan, c.nama as divisi FROM panitia_event a JOIN divisi_event c ON a.id_divisi = c.id WHERE jabatan NOT IN ('Badan Pengurus Harian', 'Koordinator atau Wakil Koordinator') AND a.id_event = ? AND a.nrp != ? AND a.id_divisi != ? ORDER BY
                    CASE jabatan
                        WHEN 'Badan Pengurus Harian' THEN 1
                        WHEN 'Koordinator atau Wakil Koordinator' THEN 2
                        WHEN 'Anggota Divisi' THEN 3
                    END, divisi";
                $stmtMahasiswa = $pdo->prepare($sqlMahasiswa);
                $stmtMahasiswa->execute([$_POST['acara'], $_SESSION['nrp'], $getJabatanUserrow['id_divisi']]);
            } else if ($getJabatanUserrow['jabatan'] == 'Anggota Divisi') {
                $sqlMahasiswa = "SELECT a.id, a.nrp, a.nama, jabatan, c.nama as divisi FROM panitia_event a JOIN divisi_event c ON a.id_divisi = c.id WHERE a.id_event = ? AND a.nrp != ? AND a.id_divisi != ? ORDER BY
                    CASE jabatan
                        WHEN 'Badan Pengurus Harian' THEN 1
                        WHEN 'Koordinator atau Wakil Koordinator' THEN 2
                        WHEN 'Anggota Divisi' THEN 3
                    END, divisi";
                $stmtMahasiswa = $pdo->prepare($sqlMahasiswa);
                $stmtMahasiswa->execute([$_POST['acara'], $_SESSION['nrp'], $getJabatanUserrow['id_divisi']]);
            }
        }

        while ($rowMahasiswa = $stmtMahasiswa->fetch()) {
            //buat ngecek apakah mahasiswa ini sudah pernah dinilai oleh nrp yang bersangkutan di acara yang bersangkutan juga
            $sqlCek = "SELECT * FROM data_performance WHERE nrp = ? AND id_event = ? AND nrp_penilai = ?";
            $stmtCek = $pdo->prepare($sqlCek);
            $stmtCek->execute([$rowMahasiswa['nrp'], $_POST['acara'], $_SESSION['nrp']]);
            if ($stmtCek->rowCount() == 0) {
                echo "<option value='" . $rowMahasiswa['id'] . "'>" . strtoupper($rowMahasiswa['nrp']) . " - " . $rowMahasiswa['nama'] . " - " . $rowMahasiswa['jabatan'] . " - " . $rowMahasiswa['divisi'] . "</option>";
            }
        }

        // var_dump($rowMahasiswa);
    } else {
        exit();
    }
?>