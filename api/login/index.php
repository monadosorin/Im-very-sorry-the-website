<?php
    include '../../phps/connect.php';

    header('Content-Type: application/json');

    if (!isset($_POST['nrp']) || !isset($_POST['password'])) {
        http_response_code(400);
        echo json_encode(array(
            "success" => false,
            "message" => "Missing credentials"
        ));
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user = strtolower($_POST['nrp']);
        $pass = $_POST['password'];
        $imap = false;
        $timeout = 30;
        $fp = fsockopen($host = 'john.petra.ac.id', $port = 110, $errno, $errstr, $timeout);
        $errstr = fgets($fp);
        if (substr($errstr, 0, 1) == '+') {
            fputs($fp, "USER " . $user . "\n");
            $errstr = fgets($fp);
            if (substr($errstr, 0, 1) == '+') {
                fputs($fp, "PASS " . $pass . "\n");
                $errstr = fgets($fp);
                if (substr($errstr, 0, 1) == '+') {
                    $imap = true;
                }
            }
        }
    }

    if ($imap) {
        http_response_code(200);
        echo json_encode(array(
            "success" => true,
            "message" => "Successfully logged in"
        ));
        exit();
    }

    http_response_code(401);
    echo json_encode(array(
        "success" => false,
        "message" => "Wrong credentials"
    ));
    exit();
?>