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

    $sql = "SELECT DISTINCT fakultas
            FROM jurusanpcu
            ORDER BY fakultas";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([]);

    $response = array();
    $response["success"] = true;
    while ($row = $stmt->fetch()) $response["data"][] = $row;
    if (empty($response["data"])) $response["message"] = "No data found";

    http_response_code(200);

    echo json_encode($response);
?>