<?php
require_once './connect.php';
if (!isset($_SESSION['nrp'])) {
    echo 'login';
    exit();
}
if(isset($_POST['nama']) && isset($_POST['tahun']) && isset($_POST['status']) && isset($_POST['penyelenggara']) && isset($_POST['tipe']) && isset($_POST['urlAcara'])){
    $nrp = $_SESSION['nrp'];
    $namaAcara = htmlspecialchars($_POST['nama']);
    if(ctype_digit($_POST['tahun'])){
        $tahun  = (int) htmlspecialchars($_POST['tahun']);
    }else{
        echo 'tahun';
        exit;
    }
    $jenisKepanitiaan = htmlspecialchars($_POST['status']);
    $tipe = htmlspecialchars($_POST['tipe']);
    $urlAcara = htmlspecialchars($_POST['urlAcara']);
    $penyelenggara = htmlspecialchars($_POST['penyelenggara']);
    $tokenBiro = null;
    $status = 'On Going';
    $proposal = '';

    if(strpos($urlAcara,'https://') == 0 || strpos($urlAcara,'http://') == 0){

    }else{
        echo 'urlAcara';
        exit;
    }

    $response ='berhasil';

    if($jenisKepanitiaan == 'openrec'){
        // TODO random token buat web utama
    }elseif($jenisKepanitiaan == 'closerec'){
    
    }else{
        echo 'play';
        exit;
    }

    if($penyelenggara == 'BEM UK Petra'){
        $tokenBiro = generateRandomString();
        
    }elseif($penyelenggara == 'other'){
        $proposal = htmlspecialchars($_POST['linkproposal']);
        $penyelenggara = htmlspecialchars($_POST['penyelenggara-luar']);

        // Check if the input starts with the specified URL
        if (strpos($proposal, 'https://docs.google.com/document/') === 0) {
            // starts with https://docs..
        } else {
            echo 'docs';
            exit();
        }
    }else{
        echo 'play';
        exit;
    }

    // cek apakah udah ngisi sebelumnya
    $stmt = $pdo->prepare("SELECT * FROM event where name = ?");
    $stmt->execute([
        $namaAcara
    ]);
    if($stmt->rowCount() > 0){
        echo 'sudah';
        exit();
    }

    // insert acara baru
    $stmt = $pdo->prepare("INSERT INTO event (`name`,`type`,`status`,`organizer`,`url`,`year`,`jenis_kepanitiaan`,`nrp_ketua`) values (?,?,?,?,?,?,?,?)");
    $berhasil = $stmt->execute([
        $namaAcara,$tipe,$status,$penyelenggara,$urlAcara,$tahun,$jenisKepanitiaan,$nrp
    ]);
    if(!$berhasil){
        echo 'gagal';
        exit();
    }

    // ambil id event
    $stmt = $pdo->prepare("SELECT * FROM event where name = ? and type = ? and status = ? and organizer = ? and url = ? and year = ? and jenis_kepanitiaan = ?");
    $stmt->execute([
        $namaAcara,$tipe,$status,$penyelenggara,$urlAcara,$tahun,$jenisKepanitiaan
    ]);
    $kegiatan = $stmt->fetch();
    $id_event = $kegiatan['id'];

    if(isset($tokenBiro) && $tokenBiro != null){
        $stmt = $pdo->prepare("UPDATE event set token_reach_biro =? where id = ?");
        $berhasil = $stmt->execute([$tokenBiro,$id_event]);
        if(!$berhasil){
            echo 'gagal';
            exit();
        }
        $response .= '?tokenBiro='.$tokenBiro;
        // sendEmaiTokenBiroReach
        $curl = curl_init('https://bem.petra.ac.id/mailer-queue/public/api/sendTokenReachBiro');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-Type: application/json','Authorization: Bearer '.$_SESSION['token']));
        
        $data = [];
        $data['subject'] = 'BEM 2023/2024 | Token untuk Birokrasi dari Reach';
        $data['to'] = $_SESSION['nrp'].'@john.petra.ac.id';
        $data['nama'] = $namaAcara;
        $data['message'] = $tokenBiro;

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $resp2 = curl_exec($curl);
        $resp2 = json_decode($resp2);
        if($resp2->status == 'success'){
        }else{
            echo 'email';
            exit();
        }
        // END KIRIM EMAIL TOKEN BIRO
    }
    if(isset($proposal) && $proposal != ''){
        $stmt = $pdo->prepare("UPDATE event set link_proposal =? where id = ?");
        $berhasil = $stmt->execute([$proposal,$id_event]);
        if(!$berhasil){
            echo 'gagal';
            exit();
        }
    }

    echo $response;

}
function generateRandomString($length = 6) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}
?>