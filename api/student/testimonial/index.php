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

    if (!isset($_GET["nrp"])) {
        http_response_code(400);
        echo json_encode(array(
            "success" => false,
            "message" => "Missing NRP parameter"
        ));
        exit();
    } else if (isset($_GET["nrp"]) && strlen($_GET["nrp"]) != 9) {
        http_response_code(400);
        echo json_encode(array(
            "success" => false,
            "message" => "NRP must be 9 digits"
        ));
        exit();
    } 

    $sql = "SELECT
            testimoni,
            name as acara
            FROM data_performance a
            JOIN event b ON a.id_event = b.id
            WHERE nrp = ?
            AND a.status IN (2)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['nrp']]);

    $response = array();
    $response["success"] = true;
    while ($row = $stmt->fetch()) $response["data"][] = $row;
    if (empty($response["data"])) $response["message"] = "No data found";

    http_response_code(200);

    echo json_encode($response);
?>