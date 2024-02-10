<?php
require_once "connect.php";
require_once "../libs/PHPExcel.php";

if (file_exists($_FILES['excel']['tmp_name']) && is_uploaded_file($_FILES['excel']['tmp_name'])) {
    $excel_name = basename($_FILES['excel']['name']);
    $target_file_excel = "../misc/excel/" . $excel_name;

    $upload = move_uploaded_file($_FILES["excel"]["tmp_name"], $target_file_excel);
    if ($upload) {
        // echo "Successfully Uploaded!";
    } else {
        // echo "Not Successfully Uploaded!";
        header("Location: ../database.php?stat=2");
        exit();
    }

    $excel = $target_file_excel;
    $reader = PHPExcel_IOFactory::createReaderForFile($excel);
    $excel_Obj = $reader->load($excel);

    // GET THE FIRST SHEET INDEX IN EXCEL
    $worksheet = $excel_Obj->getSheet('0');
    // echo $worksheet->getCell('A1')->getValue();
    $rowCount = $worksheet->getHighestDataRow();
    $columnCountAlphabet = $worksheet->getHighestDataColumn();
    $columnCount = PHPExcel_Cell::columnIndexFromString($columnCountAlphabet);

    echo "<p>Data yang ditampilkan pada tabel di bawah ini adalah hanya NRP dan Nama Lengkap yang <b><u>tidak sesuai</u></b> dengan database.</p><table style='text-align: center; border-spacing: 0;' border='1'><tr style='font-weight:bold;'><td style='width: 50px;'>Row</td><td style='width: 100px;'>NRP</td><td style='width: 200px;'>Nama Lengkap<br>(input)</td><td style='width: 200px;'>Nama Lengkap<br>(database)</td><td style='width: 120px;'>Kode Jabatan</td></tr>";

    $checkFalse = false;
    for ($row = 2; $row <= $rowCount; $row++) {
        $checkValue =
        strtolower(trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0) . $row)->getValue()));
        if ($checkValue == '') {
            break;
        }
        // NRP DINILAI
        $nrp = strtolower(trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0) . $row)->getValue()));
        $nama = ucwords(strtolower(trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(1) . $row)->getValue())));
        $kode_jabatan = ucwords(strtolower(trim($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(2) . $row)->getValue())));

        if (strlen($nrp) == 9) {
           $getNamaMhs = getStudentNameFinger($nrp);
        } else {
            $nrp = "<b style='color:red;'>" . $nrp . "</b>";
        }

        if ($getNamaMhs == "") {
            $getNamaMhs = "<b style='color:red;'>NOT FOUND</b>";
        }

        if ($kode_jabatan < 1 || $kode_jabatan > 3) {
            $kode_jabatan = "<b style='color:red;'>" . $kode_jabatan . "</b>";
        }

        $namaExplode = explode(' ', $nama);
        $namaPCUExplode = explode(' ', $getNamaMhs);
        if ($namaExplode[0] != $namaPCUExplode[0] || $namaExplode[1] != $namaPCUExplode[1]) {
            echo "<tr><td>" . $row . "</td><td>" . strtoupper($nrp) . "</td><td>" . $nama . "</td><td>" . $getNamaMhs . "</td><td>" . $kode_jabatan . "</td></tr>";
            $checkFalse = true;
        }

        // echo "<tr><td>" . $row . "</td><td>" . strtoupper($nrp) . "</td><td>" . $nama . "</td><td>" . $getNamaMhs . "</td></tr>";
    }

    if (!$checkFalse) {
        echo "<tr><td colspan='4'>All data is good!</td></tr>";
    }

    echo "</table><br><a href='../database.php'>Back</a>";

    unlink($target_file_excel);
} else {
    header("Location: ../database.php?stat=2");
    exit();
}
?>