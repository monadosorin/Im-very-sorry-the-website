<?php
    include '../../../phps/connect.php';

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

    if (!isset($_GET["nrp"]) && !isset($_GET["name"])) {
        http_response_code(400);
        echo json_encode(array(
            "success" => false,
            "message" => "Missing nrp or name parameter"
        ));
        exit();
    }

    if (isset($_GET["nrp"])) {
        if (strlen($_GET["nrp"]) != 9) {
            http_response_code(400);
            echo json_encode(array(
                "success" => false,
                "message" => "NRP must be 9 digits"
            ));
            exit();
        }

        $nrp = "AND nrp = '{$_GET['nrp']}'";
    } else {
        $nrp = "";
    }

    isset($_GET["name"]) ? $name = "AND nama LIKE '%{$_GET['name']}%'" : $name = "";

    $sql = "SELECT * FROM mahasiswa_cv
            WHERE 1
            {$nrp}
            {$name}
            ORDER BY angkatan DESC, nama ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([]);

    $BASE_URL_CV_PHOTO = "https://bem-internal.petra.ac.id/reach/uploads/cv_photo";

    $response = array();
    $response["success"] = true;
    while ($row = $stmt->fetch()) {
        if (empty($row["updated_on"])) continue;

        $row["photo_filepath"] = "{$BASE_URL_CV_PHOTO}/{$row["photo_filepath"]}";
        $response["data"][] = array(
            "id" => $row["id"],
            "nrp" => $row["nrp"],
            "name" => $row["nama"],
            "angkatan" => $row["angkatan"],
            "jurusan" => $row["jurusan"],
            "pengalaman" => $row["pengalaman"],
            "portfolio" => $row["portfolio"],
            "date_of_birth" => $row["tanggal_lahir"],
            "instagram" => $row["instagram"],
            "photo_filepath" => $row["photo_filepath"],
            "last_updated" => $row["updated_on"]
        );

        if (empty($row["portfolio"])) unset($response["data"][count($response["data"]) - 1]["portfolio"]);
    }
    if (empty($response["data"])) $response["message"] = "No data found";

    http_response_code(200);

    echo json_encode($response);
?>