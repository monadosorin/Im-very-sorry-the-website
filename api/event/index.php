<?php
    include '../../phps/connect.php';

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

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

    isset($_GET['type']) ? $type = "AND type = '{$_GET['type']}'" : $type = "";
    isset($_GET['status']) ? $status = "AND status = '{$_GET['status']}'" : $status = "";
    isset($_GET['year']) ? $year = "AND year = {$_GET['year']}" : $year = "";
    isset($_GET['organizer']) ? $organizer = "AND organizer = '{$_GET['organizer']}'" : $organizer = "";

    $sql = "SELECT * FROM event
            WHERE 1
            {$type}
            {$status}
            {$year}
            {$organizer}
            ORDER BY RAND(), id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([]);

    $BASE_URL_POSTER = "https://bem-internal.petra.ac.id/reach/uploads/poster";

    $response = array();
    $response["success"] = true;
    while ($row = $stmt->fetch()) {
        $row["poster_filepath"] = "{$BASE_URL_POSTER}/{$row["poster_filepath"]}";
        $response["data"][] = $row;
    }
    if (empty($response["data"])) $response["message"] = "No data found";

    http_response_code(200);

    echo json_encode($response);
?>