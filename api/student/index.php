<?php
    include '../../phps/connect.php';

    header('Content-Type: application/json');

    date_default_timezone_set('Asia/Jakarta');
    $month = date('m');
    $year = date('Y');
    $day = date('d');

    $token = "RwG{$month}ne{$year}Kc{$day}C9w";

    $headers = getallheaders();
    $auth_header = $headers['Authorization'];
    $auth_token = explode(" ", $auth_header)[1];
    
    if ($auth_token != $token) {
        http_response_code(401);
        echo json_encode(array(
            "success" => false,
            "message" => "Unauthorized"
        ));
        exit();
    }

    isset($_GET['faculty']) ? $faculty = "AND SUBSTRING_INDEX(jurusan, ' - ', 1) = '{$_GET['faculty']}'" : $faculty = "";
    isset($_GET['batch']) ? $batch = "AND angkatan = {$_GET['batch']}" : $batch = "";
    isset($_GET['major']) ? $major = "AND SUBSTRING_INDEX(jurusan, ' - ', -1) = '{$_GET['major']}'" : $major = "";

    if (isset($_GET['division'])) {
        if ($_GET['division'] == 'Acara') {
            $experience = "AND (pengalaman LIKE '%acara%' OR pengalaman LIKE '%mc %' OR pengalaman LIKE 'mc %' OR pengalaman LIKE '%mc' OR pengalaman LIKE '%master of ceremony%' OR pengalaman LIKE '%event%')";
            $division = "AND (b.nama LIKE '%acara%' OR b.nama LIKE '%event%')";
        } else if ($_GET['division'] == 'PDD') {
            $experience = "AND (pengalaman LIKE '%pdd %' OR pengalaman LIKE 'pdd %' OR pengalaman LIKE '%pdd' OR pengalaman LIKE '%,pdd %' OR pengalaman LIKE '%.pdd %' OR pengalaman LIKE '%publikasi%' OR pengalaman LIKE '%dekor%' OR pengalaman LIKE '%dokumentasi%' OR pengalaman LIKE '%publication%' OR pengalaman LIKE '%decoration%' OR pengalaman LIKE '%documentation%' OR pengalaman LIKE '%creative%' OR pengalaman LIKE '%fotografer%' OR pengalaman LIKE '%photography%' OR pengalaman LIKE '%layout%' OR pengalaman LIKE '%illus%' OR pengalaman LIKE '%ilus%' OR pengalaman LIKE '%pubdekdok%')";
            $division = "AND (b.nama LIKE '%pdd%' OR b.nama LIKE '%publikasi%' OR b.nama LIKE '%dekor%' OR b.nama LIKE '%dokumentasi%' OR b.nama LIKE '%creative%' OR b.nama LIKE '%fotografer%' OR b.nama LIKE '%layout%' OR b.nama LIKE '%illus%' OR b.nama LIKE '%ilus%' OR b.nama LIKE '%photography%' OR b.nama LIKE '%publication%' OR b.nama LIKE '%decoration%' OR b.nama LIKE '%documentation%' OR b.nama LIKE '%pubdekdok%')";
        } else if ($_GET['division'] == 'Sekretariat') {
            $experience = "AND (pengalaman LIKE '%sekret%' OR pengalaman LIKE '%gsab%' OR pengalaman LIKE '%sekkon%' OR pengalaman LIKE '%sekon%' OR pengalaman LIKE '%secretary%' OR pengalaman LIKE '%sekben%')";
            $division = " AND (b.nama LIKE '%sekret%' OR b.nama LIKE '%sekkon%' OR b.nama LIKE '%sekon%' OR b.nama LIKE '%secretary%' OR b.nama LIKE '%sekben%')";
        } else if ($_GET['division'] == 'Public Relation') {
            $experience = "AND (pengalaman LIKE '%public relation%' OR pengalaman LIKE '%hubungan masyarakat%' OR pengalaman LIKE '%humas%' OR pengalaman LIKE '% pr %' OR pengalaman LIKE 'pr %' OR pengalaman LIKE '% pr' OR pengalaman LIKE '%,pr %' OR pengalaman LIKE '%.pr %' OR pengalaman LIKE '%&pr %' OR pengalaman LIKE '%pubsek%' OR pengalaman LIKE '%pubsekhum%')";
            $division = "AND (b.nama LIKE '%public relation%' OR b.nama LIKE '%hubungan masyarakat%' OR b.nama LIKE '%humas%' OR b.nama LIKE '% pr %' OR b.nama LIKE 'pr %' OR b.nama LIKE '% pr' OR b.nama LIKE '%&pr %' OR b.nama LIKE '%pubsek%' OR b.nama LIKE '%pubsekhum%')";
        } else if ($_GET['division'] == 'Perlengkapan') {
            $experience = "AND (pengalaman LIKE '%perkap%' OR pengalaman LIKE '%transka%' OR pengalaman LIKE '%transakap%' OR pengalaman LIKE '%perleng%' OR pengalaman LIKE '%supply%' OR pengalaman LIKE '%equipment%')";
            $division = " AND (b.nama LIKE '%perkap%' OR b.nama LIKE '%transka%' OR b.nama LIKE '%transakap%' OR b.nama LIKE '%perleng%' OR b.nama LIKE '%supply%' OR b.nama LIKE '%equipment%')";
        } else if ($_GET['division'] == 'Konsumsi') {
            $experience = "AND (pengalaman LIKE '%konsum%' OR pengalaman LIKE '%sekkon%' OR pengalaman LIKE '%sekon%' OR pengalaman LIKE '%konkes%' OR pengalaman LIKE '%consumption%')";
            $division = " AND (b.nama LIKE '%konsum%' OR b.nama LIKE '%sekkon%' OR b.nama LIKE '%sekon%' OR b.nama LIKE '%konkes%' OR b.nama LIKE '%consumption%')";
        } else if ($_GET['division'] == 'IT') {
            $experience = "AND (pengalaman LIKE '% it %' OR pengalaman LIKE 'it %' OR pengalaman LIKE '% it' OR pengalaman LIKE '%,it %' OR pengalaman LIKE '%.it %' OR pengalaman LIKE '%&it %' OR pengalaman LIKE '%information%' OR pengalaman LIKE '%informasi%' OR pengalaman LIKE '%sistem%' OR pengalaman LIKE '%system%' OR pengalaman LIKE '%technology%' OR pengalaman LIKE '%teknologi%') AND pengalaman NOT LIKE '%step towards it%'";
            $division = "AND (b.nama LIKE '% it %' OR b.nama LIKE 'it %' OR b.nama LIKE '%&it %' OR pengalaman LIKE '% it' OR b.nama LIKE 'it' OR b.nama LIKE '%information%' OR b.nama LIKE '%informasi%' OR b.nama LIKE '%sistem%' OR b.nama LIKE '%system%' OR b.nama LIKE '%technology%' OR b.nama LIKE '%teknologi%')";
        } else if ($_GET['division'] == 'Sponsor') {
            $experience = "AND (pengalaman LIKE '%sponsor%' OR pengalaman LIKE '%danus%' OR pengalaman LIKE '% dana%' OR pengalaman LIKE '%dana usaha%')";
            $division = "AND (b.nama LIKE '%sponsor%' OR b.nama LIKE '%danus%' OR b.nama LIKE '%dana%' OR b.nama LIKE '%dana usaha%')";
        } else if ($_GET['division'] == 'Keamanan') {
            $experience = "AND (pengalaman LIKE '%keamanan%' OR pengalaman LIKE '%transkaman%' OR pengalaman LIKE '%transkapman%' OR pengalaman LIKE '%perkapman%' OR pengalaman LIKE '%security%' OR pengalaman LIKE '%tata aturan%')";
            $division = "AND (b.nama LIKE '%keamanan%' OR b.nama LIKE '%transkaman%' OR b.nama LIKE '%transkapman%' OR b.nama LIKE '%perkapman%' OR b.nama LIKE '%security%' OR b.nama LIKE '%tata aturan%')";
        } else if ($_GET['division'] == 'Kesehatan') {
            $experience = "AND (pengalaman LIKE '%kesehatan%' OR pengalaman LIKE '%konkes%' OR pengalaman LIKE '%health%')";
            $division = "AND (b.nama LIKE '%kesehatan%' OR b.nama LIKE '%konkes%' OR b.nama LIKE '%health%')";
        } else if ($_GET['division'] == 'Materi') {
            $experience = "AND (pengalaman LIKE '%materi%')";
            $division = "AND (b.nama LIKE '%materi%')";
        } else if ($_GET['division'] == 'Peran') {
            $experience = "AND (pengalaman LIKE '%peran%' OR pengalaman LIKE '%frontline%' OR pengalaman LIKE '%front line%' OR pengalaman LIKE '% fl %' OR pengalaman LIKE 'fl %' OR pengalaman LIKE '%,fl %' OR pengalaman LIKE '%.fl %')";
            $division = "AND (b.nama LIKE '%peran%' OR b.nama LIKE '%frontline%' OR b.nama LIKE '%front line%' OR b.nama LIKE 'fl')";
        } else if ($_GET['division'] == 'Asisten Tutor') {
            $experience = "AND (pengalaman LIKE '%asisten tutor%' OR pengalaman LIKE '% astor%' OR pengalaman LIKE '%tutor assistant%')";
            $division = "AND (b.nama LIKE '%asisten tutor%' OR b.nama LIKE '%astor%' OR b.nama LIKE '%tutor assistant%')";
        }
    } else {
        $division = "";
        $experience = "";
    }

    $sql = "SELECT
            nrp,
            nama,
            SUBSTRING_INDEX(jurusan, ' - ', 1) as fakultas,
            SUBSTRING_INDEX(jurusan, ' - ', -1) as program,
            angkatan,
            photo_filepath
            FROM mahasiswa_cv
            WHERE status > 0
            {$batch}
            {$experience}
            {$faculty}
            {$major}
            UNION DISTINCT SELECT
            c.nrp,
            c.nama,
            SUBSTRING_INDEX(SUBSTRING_INDEX(c.jurusan, ' - ', 1), ' - ', -1) as fakultas,
            SUBSTRING_INDEX(SUBSTRING_INDEX(c.jurusan, ' - ', 2), ' - ', -1) as jurusan,
            c.angkatan,
            c.photo_filepath
            FROM panitia_event a
            JOIN divisi_event b ON a.id_divisi = b.id
            JOIN mahasiswa_cv c ON a.nrp = c.nrp
            WHERE c.status > 0
            {$batch}
            {$faculty}
            {$major}
            {$division}
            ORDER BY RAND()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([]);

    $BASE_URL_CV_PHOTO = "https://bem-internal.petra.ac.id/reach/uploads/cv_photo";

    $response = array();
    $response["success"] = true;
    while ($row = $stmt->fetch()) {
        $row["photo_filepath"] = "{$BASE_URL_CV_PHOTO}/{$row["photo_filepath"]}";
        $response["data"][] = $row;
    }
    if (empty($response["data"])) $response["message"] = "No data found";

    http_response_code(200);

    echo json_encode($response);
?>