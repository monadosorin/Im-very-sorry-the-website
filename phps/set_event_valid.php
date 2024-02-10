<?php
require_once "./connect.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama_kegiatan = $_POST['nama_kegiatan'];
    // cek nama kegiatannya ada gak
    $stmt = $pdo->prepare("SELECT * FROM `event` where lower(`name`) = lower(?) and token_used = 1");
    $stmt->execute([$nama_kegiatan]);
    if($stmt->rowCount() > 0){
        $stmt = $pdo->prepare("UPDATE `event` set validity = 1 where lower(`name`) = lower(?) and token_used = 1");
        $berhasil = $stmt->execute([$nama_kegiatan]);   
        if($berhasil){
            echo 'true';
        }else{
            echo 'false';
        }
    }else{
        echo 'tidakDitemukan';
    }
}