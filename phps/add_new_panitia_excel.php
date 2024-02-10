<?php
// require_once "./connect.php";
// require_once "../libs/PHPExcel.php";

// if (file_exists($_FILES['excel']['tmp_name']) && is_uploaded_file($_FILES['excel']['tmp_name']) && isset($_POST['acara'])) {
//     $id_event = $_POST['acara'];

//     $excel_name = basename($_FILES['excel']['name']);
//     $excel_file_type = strtolower(pathinfo($excel_name, PATHINFO_EXTENSION));
//     $new_excel_name = $id_event . "." . $excel_file_type;
//     $target_file_excel = "../misc/excel/" . $new_excel_name;

//     $upload = move_uploaded_file($_FILES["excel"]["tmp_name"], $target_file_excel);
//     if ($upload) {
//         // echo "Successfully Uploaded!";
//     } else {
//         // echo "Not Successfully Uploaded!";
//         header("Location: ../database.php?stat=2");
//         exit();
//     }

//     $excel = $target_file_excel;
//     $reader = PHPExcel_IOFactory::createReaderForFile($excel);
//     $excel_Obj = $reader->load($excel);

//     // GET THE FIRST SHEET INDEX IN EXCEL
//     $worksheet = $excel_Obj->getSheet('0');
//     // echo $worksheet->getCell('A1')->getValue();
//     $rowCount = $worksheet->getHighestDataRow();
//     $columnCountAlphabet = $worksheet->getHighestDataColumn();
//     $columnCount = PHPExcel_Cell::columnIndexFromString($columnCountAlphabet);

//     // CEK FORMAT NRP & JABATAN
//     $nrpArr = [];
//     $invalidFormatNRP = [];
//     $doubleNRP = [];
//     $invalidJabatan = [];
//     $valid = true;
//     for ($row = 2; $row <= $rowCount; $row++) {
//         $checkValue =
//         strtolower(trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0) . $row)->getValue()));
//         if ($checkValue == '') {
//             break;
//         }

//         $nrp = strtolower(trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0) . $row)->getValue()));
//         if (strlen($nrp) != 9) {
//             $valid = false;
//             if (!in_array($nrp, $invalidFormatNRP)) {
//                 array_push($invalidFormatNRP, $nrp);
//             }
//         }
//         if (!in_array($nrp, $nrpArr)) {
//             array_push($nrpArr, $nrp);
//         } else {
//             $valid = false;
//             if (!in_array($nrp, $doubleNRP)) {
//                 array_push($doubleNRP, $nrp);
//             }
//         }

//         $jabatan = trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(2) . $row)->getValue());
//         if ($jabatan < 1 || $jabatan > 3) {
//             $valid = false;
//             if (!in_array($jabatan, $invalidJabatan)) {
//                 array_push($invalidJabatan, $jabatan);
//             }
//         }
//     }

//     if ($valid) {
//         $divisiArr = [];
//         for ($row = 2; $row <= $rowCount; $row++) {
//             $checkValue =
//             strtolower(trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0) . $row)->getValue()));
//             if ($checkValue == '') {
//                 break;
//             }
            
//             $divisi = trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(3) . $row)->getValue());
//             // DIVISI BELUM ADA DI ARRAY -> INSERT
//             if (!in_array($divisi, $divisiArr)) {
//                 array_push($divisiArr, $divisi);

//                 // just in case
//                 $checkDivisisql = "SELECT * FROM divisi_event WHERE nama = ? AND id_event = ?";
//                 $checkDivisistmt = $pdo->prepare($checkDivisisql);
//                 $checkDivisistmt->execute([$divisi, $id_event]);
//                 if ($checkDivisistmt->rowCount() == 0) {
//                     // DIVISI BELUM ADA DI DATABASE -> INSERT
//                     $insertDivisisql = "INSERT INTO `divisi_event`(`nama`, `id_event`) VALUES (?, ?)";
//                     $insertDivisistmt = $pdo->prepare($insertDivisisql);
//                     $insertDivisistmt->execute([$divisi, $id_event]);
//                 }
//             }

//             // GET DIVISI
//             $getDivisisql = "SELECT * FROM divisi_event WHERE nama = ? AND id_event = ?";
//             $getDivisistmt = $pdo->prepare($getDivisisql);
//             $getDivisistmt->execute([$divisi, $id_event]);
//             $getDivisi = $getDivisistmt->fetch();

//             // INSERT PANITIA -> DATABASE
//             $nrp = strtolower(trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0) . $row)->getValue()));
//             $nama = trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(1) . $row)->getValue());
//             $jabatan = trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(2) . $row)->getValue());
//             if ($jabatan == 1) {
//                 $jabatan = 'Badan Pengurus Harian';
//             } else if ($jabatan == 2) {
//                 $jabatan = 'Koordinator atau Wakil Koordinator';
//             } else if ($jabatan == 3) {
//                 $jabatan = 'Anggota Divisi';
//             }

//             // just in case
//             $panitiaChecksql = "SELECT * FROM panitia_event WHERE nrp = ? AND id_event = ?";
//             $panitiaCheckstmt = $pdo->prepare($panitiaChecksql);
//             $panitiaCheckstmt->execute([$nrp, $id_event]);
//             if ($panitiaCheckstmt->rowCount() == 0) {
//                 $insertPanitiasql = "INSERT INTO `panitia_event`(`nrp`, `nama`, `jabatan`, `id_divisi`, `id_event`) VALUES (?, ?, ?, ?, ?)";
//                 $insertPanitiastmt = $pdo->prepare($insertPanitiasql);
//                 $insertPanitiastmt->execute([$nrp, $nama, $jabatan, $getDivisi['id'], $id_event]);
//             }
//         }
//         unlink($target_file_excel);
//         header("Location: ../database.php?stat=8");
//         exit();
//     } else {
//         unlink($target_file_excel);
//         header("Location: ../database.php?stat=9&format=" . urlencode(serialize($invalidFormatNRP)) . "&double=" . urlencode(serialize($doubleNRP)) . "&jabatan=" . urlencode(serialize($invalidJabatan)));
//         exit();
//     }
// } else {
//     header("Location: ../database.php?stat=2");
//     exit();
// }
?>