<?php
require_once './connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Nerima nama dan token
    if(isset($_POST['name']) && isset($_POST['nrp'])){
        //anggap bahwa id acara pasti sudah ada
        $bool = true;
        $msg = "success";
        //apakah subquery perlu di query sendiri in case nama acara tidak ditemukan
        //query id acara
        $getIdEventQuery = "SELECT id FROM `event` WHERE name = ?";
        $stmt = $pdo->prepare($getIdEventQuery);
        if($stmt->execute([$_POST['name']])){
            $idEvent = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
           
        //query nrp yang sudah dinilai oleh nrp penilai
        $getPerformanceQuery = "SELECT nrp FROM `data_performance` WHERE id_event = ? AND nrp_penilai = ?";
        $stmt = $pdo->prepare($getPerformanceQuery);

        if($stmt->execute([$idEvent, $_POST['nrp']])){
            $nrpPerformance = $stmt->fetchAll(PDO::FETCH_COLUMN);
            //list panitia yang perlu dinilai kecuali dirinya sendiri (BPH menilai sesama bph, semua koor, wakoor) ambil dari phps/get_list_mahasiswa.php line 18
            $getPanitiaQuery = "
            SELECT  a.nrp as nrp FROM panitia_event a 
            JOIN divisi_event c ON a.id_divisi = c.id WHERE jabatan IN ('Badan Pengurus Harian', 'Koordinator atau Wakil Koordinator') AND a.id_event = ? AND a.nrp != ? 
            ";
            $stmt2 = $pdo->prepare($getPanitiaQuery);

            if($stmt2->execute([$idEvent, $_POST['nrp']])){
                $nrpPanitia = $stmt2->fetchAll();
                foreach ($nrpPanitia as $value) {
                    if(!in_array($value['nrp'], $nrpPerformance)){
                        $bool = false;
                        // TODO Ngereturn siapa aja yg blm dinilai 
                        // SELECT  a.nrp as nrp, a.nama as nama FROM panitia_event a 
                        // JOIN divisi_event c ON a.id_divisi = c.id WHERE jabatan IN ('Badan Pengurus Harian', 'Koordinator atau Wakil Koordinator') AND a.id_event = 82 AND a.nrp != 'A11220010' and a.nrp not in (
                        // SELECT nrp FROM `data_performance` WHERE id_event = ? AND nrp_penilai = ?
                        // );
                        $msg = "Pastikan semua panitia sudah dinilai di Reach";
                        break;
                    }
                }
            }else{
                $bool = false;
                $msg = "error pengambilan data";
            }

        }else{
            $bool = false;
            $msg = "error pengambilan data";
        }
    }else{
        $bool = false;
        $msg = "Acara Tidak Ditemukan";
    }
        $response["status"] = $bool;
        $response["msg"] = $msg;
        $jsonResponse = json_encode($response, JSON_PRETTY_PRINT);
        $jsonResponse = str_replace('\\/', '/', $jsonResponse);
        echo $jsonResponse;

    }
}else{
    http_response_code(404);
}
?>