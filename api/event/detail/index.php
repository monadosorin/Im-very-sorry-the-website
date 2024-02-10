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

    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(array(
            "success" => false,
            "message" => "Missing id parameter"
        ));
        exit();
    }

    $sql = "SELECT *
            FROM event
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);

    $BASE_URL_POSTER = "https://bem-internal.petra.ac.id/reach/uploads/poster";

    $response = array();
    $response["success"] = true;

    while ($row = $stmt->fetch()) {
        $row["poster_filepath"] = "{$BASE_URL_POSTER}/{$row["poster_filepath"]}";
        $response["data"][] = $row;
    }

    $sql = "SELECT de.nama as division
            FROM divisi_event de
            JOIN event e
            ON de.id_event = e.id
            WHERE e.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
    while ($row = $stmt->fetch()) {
        $response["data"][0]["divisions"][] = $row;
    }

    http_response_code(200);
    
    if (empty($response["data"])) {
        $response["success"] = false;
        $response["message"] = "No event with id {$_GET['id']} found";
        http_response_code(404);
    }

    echo json_encode($response);
?>