<?php
require_once "./connect.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $token = $_POST['token'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $stmt = $pdo->prepare("SELECT * FROM `event` where token_reach_biro = ? and lower(`name`) = lower(?)");
    $stmt->execute([$token,$nama_kegiatan]);
    if($stmt->rowCount() > 0){
        $eventRow = $stmt->fetch();
        if($eventRow['token_used'] == 1){
            echo 'sudah';
        }else{
            $stmt = $pdo->prepare("UPDATE `event` set token_used = 1 where id = ?");
            $stmt->execute([$eventRow['id']]);
            echo 'true';
        }
    }else{
        echo 'false';
    }

}