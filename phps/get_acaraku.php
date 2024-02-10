<?php 
include_once 'connect.php'; 
require_once '../libs/vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 
//  https://www.codexworld.com/import-excel-file-data-into-mysql-database-using-php/ 
if($_SERVER['REQUEST_METHOD'] === "POST"){ 
    $response = array(
        "status" => 0,
        "invalid_columns" => [],
        "msg" => 'Sorry, an error has occured'
    );
    $id = $_POST['id'];
    //cek apakah orang ini memiliki hak sebagai ketua untuk submit data panitia
    $stmt = $pdo->prepare("SELECT * FROM event where id=? and nrp_ketua = ?");
    $stmt->execute([$id,$_SESSION['nrp']]);
    if($stmt->rowCount() <= 0){
        // jika orangnya adalah pic reach diperbolehkan
        if(isAdmin($_SESSION['nrp'])){
            // cek apakah acaranya ada
            $stmt = $pdo->prepare("SELECT * FROM event where id=?");
            $stmt->execute([$id]);
            if($stmt->rowCount() <= 0){
                $response = array(
                    "status" => 2,
                    "invalid_columns" => [],
                    "msg" => 'Acara ini tidak ada pada database'
                );
                echo json_encode($response);
                exit();    
            }
        }else{
            $response = array(
                "status" => 2,
                "invalid_columns" => [],
                "msg" => 'Tidak bisa tambah panitia pada acara ini'
            );
            echo json_encode($response);
            exit();
        }

    }


    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
    
    if(!empty($_FILES['fileExcel']['name']) && in_array($_FILES['fileExcel']['type'], $excelMimes)){
        if(is_uploaded_file($_FILES['fileExcel']['tmp_name'])){ 

            // Pindah file excel ke simpan
            $excel_name = basename($_FILES['fileExcel']['name']);
            $excel_file_type = strtolower(pathinfo($excel_name, PATHINFO_EXTENSION));
            $new_excel_name = $id . "." . $excel_file_type;
            $target_file_excel = "../misc/excel/" . $new_excel_name;
        
            $upload = move_uploaded_file($_FILES["fileExcel"]["tmp_name"], $target_file_excel);
            if ($upload) {
            } else {
                $response['msg'] = 'Sorry, an error has occured. Error code : Fail save excel file';
                echo json_encode($response);
                exit();
            }

            $reader = new Xlsx(); 
            // $spreadsheet = $reader->load($_FILES['fileExcel']['tmp_name']); 
            $spreadsheet = $reader->load($target_file_excel); 
            $worksheet = $spreadsheet->getActiveSheet();  
            $worksheet_arr = $worksheet->toArray(); 
 
            unset($worksheet_arr[0]); 
 
            foreach($worksheet_arr as $row){ 
                // cek nrp dll valid gk
                if(empty($row[0]) && empty($row[1]) && empty($row[2]) && empty($row[3])){ 
                    continue;
                }

                // NRP
                if(empty($row[0])){
                    array_push($response['invalid_columns'], 'NRP (Tidak boleh dikosongkan. 9 karakter)');
                }else{
                    $nrp = htmlspecialchars($row[0]);
                    $nrp = strtolower((string) $nrp); 
                    if(strlen($nrp) != 9){
                        array_push($response['invalid_columns'], 'NRP (9 karakter)');
                    }
                }

                // Nama
                if(empty($row[1])){
                    array_push($response['invalid_columns'], 'Nama (Tidak boleh dikosongkan. max 747 huruf, min 1 huruf)');
                }else{
                    $nama = (string) htmlspecialchars($row[1]); 
                    if(strlen($nama) > 747 && strlen($nama) <= 0){
                        array_push($response['invalid_columns'], 'Nama (max 747 huruf, min 1 huruf)');
                    }
                }

                // Jabatan
                if(empty($row[2])){
                    array_push($response['invalid_columns'], 'Jabatan (tidak boleh dikosongkan. Pilihan : 1, 2,3. Keterangan ada di Panduan pengisian excel panitia)');
                }else{
                    $jabatan = (string) htmlspecialchars($row[2]); 
                    if($jabatan != '1' && $jabatan != '2' && $jabatan != '3'){
                        array_push($response['invalid_columns'], 'Jabatan (Pilihan : 1, 2, 3. Keterangan ada di Panduan pengisian excel panitia)');
                    }
                    if ($jabatan == 1) {
                        $jabatan = 'Badan Pengurus Harian';
                    } else if ($jabatan == 2) {
                        $jabatan = 'Koordinator atau Wakil Koordinator';
                    } else if ($jabatan == 3) {
                        $jabatan = 'Anggota Divisi';
                    }
                }

                // Divisi
                if(empty($row[3])){
                    array_push($response['invalid_columns'], 'Divisi (Tidak boleh dikosongkan. max 300 huruf, huruf besar/kecil diseragamkan, min 1 huruf)');
                }else{
                    $divisi = (string) htmlspecialchars($row[3]);
                    if(strlen($divisi) > 300 && strlen($divisi) <= 0){
                        array_push($response['invalid_columns'], 'Divisi (max 300 huruf, huruf besar/kecil diseragamkan, min 1 huruf)');
                    }
                }

                if (count($response['invalid_columns']) > 0){
                    $response['status'] = 2;
                    $response['msg'] = 'Tolong perbaiki data pada kolom berikut : ';
                    echo json_encode($response);
                    exit();
                }

                $event = $id;

                // cek apakah nde divisi event divisi wes ada? kalo blm ada tambahin divisi_event
                $stmt = $pdo->prepare("SELECT * FROM divisi_event WHERE id_event = ? AND nama = ?");
                $stmt->execute([$event, $divisi]);
                if($stmt->rowCount() <= 0){
                    $stmt = $pdo->prepare("INSERT into divisi_event (nama,id_event) values (?,?)");
                    $stmt->execute([$divisi,$event]);
                }

                // ambil id divisi
                $stmt = $pdo->prepare("SELECT * FROM divisi_event WHERE id_event = ? AND nama = ?");
                $stmt->execute([$event, $divisi]);
                $divisi = $stmt->fetch();
                $divisi = $divisi['id'];

                $stmt = $pdo->prepare("SELECT * FROM panitia_event WHERE nrp = ? AND id_event = ?");
                $stmt->execute([$nrp, $event]);
                if($stmt->rowCount() > 0){
                    // jika data sudah ada di update saja
                    $stmt = $pdo->prepare("UPDATE panitia_event set nama =?, jabatan = ?, id_divisi = ? where nrp =? and id_event = ? ");
                    $stmt->execute([$nama, $jabatan, $divisi,$nrp, $event]);
                }else{
                    // tambah data baru
                    $stmt = $pdo->prepare("INSERT INTO panitia_event (nrp, nama, jabatan, id_divisi, id_event) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$nrp, $nama, $jabatan, $divisi, $event]);
                }
            }
            $response['status'] = 1;
            $response['msg'] = 'Data panitia berhasil ditambahkan!';
           
        }else{ 
            $response['status'] = 3;
            $response['msg'] = 'Sorry, fail to move files, please try again or contact our PIC Id Line';
        } 
    }else{ 
        $response['status'] = 4;
        $response['msg'] = 'Only .xlx or .xlsx are allowed';
    } 
    echo json_encode($response);
    exit();
} 
 
?>