<?php
require_once 'connect.php';

if (isset($_POST['id_event'])) {
    if(!isset($_SESSION['nrp'])){
        echo 'login';
        exit;
    }
    $nrp_admin = $_SESSION['nrp'];
    if(!isAdmin($nrp_admin)){
        echo 'noaccess';
        exit();
    }
    $id_event = $_POST['id_event'];
    $stmt = $pdo->prepare("UPDATE event set validity = 2 where id = ?");
    $berhasil = $stmt->execute([$id_event]);
    if($berhasil){
        echo 'success';
    }else{
        echo 'gagal';
    }
}