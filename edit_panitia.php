<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'edit_panitia';
require_once './header.php';

if (isset($_GET['id'])) {
    $sql = "SELECT a.id, a.nama, nrp, jabatan, b.id as acara, c.id as divisi FROM panitia_event a JOIN event b ON a.id_event = b.id JOIN divisi_event c ON a.id_divisi = c.id WHERE a.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch();

    $sqlAcara = "SELECT * FROM event";
    $stmtAcara = $pdo->prepare($sqlAcara);
    $stmtAcara->execute([]);
}
?>

<head>
    <title>REACH - Edit Panitia <?= $row['nama']; ?></title>
</head>

<body>
    <div class="container mb-5">
        <div class="row justify-content-center">
            <h1 class="title"><i class="fas fa-edit"></i>EDIT PANITIA</h1>
        </div>
        <form action="phps/update_panitia.php" method="POST">
            <div class="form-group">
                <input hidden name="id" value="<?= $row['id'] ?>" />
                <center><label for="nrp" style="font-weight: bold;" class="mt-3">NRP</label></center>
                <input type="text" style="text-align: center;" id="nrp" name="nrp" placeholder="Ex: c14190001" class="form-control" minlength="9" maxlength="9" value="<?= $row['nrp']; ?>" required>
                <center><label for="nama" style="font-weight: bold;" class="mt-3">Nama Lengkap</label></center>
                <input type="text" style="text-align: center;" id="nama" name="nama" placeholder="Input nama lengkap panitia" class="form-control" value="<?= $row['nama']; ?>" required>
                <center><label for="jabatan" style="font-weight: bold;" class="mt-3">Jabatan</label></center>
                <select class="form-control" id="jabatan" name="jabatan" style="height:40px; font-size: 12pt;" required>
                    <option value="">Pilih jabatan...</option>
                    <option value="Badan Pengurus Harian">Badan Pengurus Harian (BPH)</option>
                    <option value="Koordinator atau Wakil Koordinator">Koordinator atau Wakil Koordinator</option>
                    <option value="Anggota Divisi">Anggota Divisi</option>
                </select>
                <?php
                $checkAssessmentsql = "SELECT nrp FROM data_performance WHERE id_panitia = ?";
                $checkAssessmentstmt = $pdo->prepare($checkAssessmentsql);
                $checkAssessmentstmt->execute([$_GET['id']]);
                if ($checkAssessmentstmt->rowCount() == 0) {
                ?>
                    <center><label for="acara" style="font-weight: bold;" class="mt-3">Acara</label></center>
                    <select class="form-control" id="acara" name="acara" style="height:40px; font-size: 12pt;" onchange="toggle_divisi()" required>
                        <option value="">Pilih acara...</option>
                        <?php
                        while ($rowAcara = $stmtAcara->fetch()) { ?>
                            <option value="<?php echo $rowAcara['id']; ?>"><?php echo $rowAcara['name']; ?></option>
                        <?php  } ?>
                    </select>
                    <center><label for="divisi" style="font-weight: bold;" class="mt-3">Divisi</label></center>
                    <select class="form-control" id="divisi" name="divisi" style="height:40px; font-size: 12pt;" required>
                        <option value="" id="pil-div">Pilih divisi...</option>
                    </select>
                    <center>
                        <p style="color: red; font-weight: bold; margin-top: 10px;" id="no-div" hidden>Belum Ada Divisi Yang Ditambahkan Pada Acara Ini</p>
                    </center>
                <?php
                } else {
                ?>
                    <center><label for="acara" style="font-weight: bold;" class="mt-3">Acara</label></center>
                    <select class="form-control" id="acara" name="acara" style="height:40px; font-size: 12pt;" onchange="toggle_divisi()" disabled>
                        <option value="">Pilih acara...</option>
                        <?php
                        while ($rowAcara = $stmtAcara->fetch()) { ?>
                            <option value="<?php echo $rowAcara['id']; ?>"><?php echo $rowAcara['name']; ?></option>
                        <?php  } ?>
                    </select>
                    <center><label for="divisi" style="font-weight: bold;" class="mt-3">Divisi</label></center>
                    <select class="form-control" id="divisi" name="divisi" style="height:40px; font-size: 12pt;" disabled>
                        <option value="" id="pil-div">Pilih divisi...</option>
                    </select>
                <?php
                }
                ?>
            </div>
            <br>
            <p style="text-align: center; color: red;" class="mx-2">PERHATIAN: Panitia Yang Sudah Pernah Diberikan Assessment di Acara Yang Dilakukan Input Tidak Dapat Mengganti Acara dan Divisi</p>
            <center><input type="submit" id="submit-panit" name="submit" value="Update Data Panitia" class="btn btn-success container-fluid" style="width: 200px;"></center>
            <center><a href="database_panitia.php" class="btn btn-danger container-fluid mt-3" style="width: 200px;"><b>Cancel</b></a></center>
        </form>
    </div>

    <script>
        $('select[name="jabatan"]').val('<?= $row['jabatan']; ?>');
        $('select[name="acara"]').val('<?= $row['acara']; ?>');
        var acara = $("#acara").val();

        function toggle_divisi(){if(""==$("#acara").val())$("#divisi").prop("disabled",!0),$("#divisi").html('<option value="">Pilih divisi...</option>'),$("#no-div").prop("hidden",!0),$("#divisi").prop("required",!0),$("#divisi").removeAttr("hidden"),$("#submit-panit").removeAttr("disabled");else{$("#divisi").removeAttr("disabled"),$("#divisi").prop("required",!0);var i=$("#acara").val();$.ajax({url:"phps/get_division_by_event.php",data:{acara:i},method:"POST",success:function(i){"false"==i?($("#no-div").removeAttr("hidden"),$("#divisi").removeAttr("required"),$("#divisi").prop("hidden",!0),$("#submit-panit").prop("disabled",!0)):($("#no-div").prop("hidden",!0),$("#divisi").prop("required",!0),$("#divisi").removeAttr("hidden"),$("#submit-panit").removeAttr("disabled"),$("#divisi").html('<option value="">Pilih divisi...</option>'+i))}})}}$.ajax({url:"phps/get_division_by_event.php",data:{acara:acara},method:"POST",success:function(i){"false"==i?($("#no-div").removeAttr("hidden"),$("#divisi").removeAttr("required"),$("#divisi").prop("hidden",!0),$("#submit-panit").prop("disabled",!0)):($("#no-div").prop("hidden",!0),$("#divisi").prop("required",!0),$("#divisi").removeAttr("hidden"),$("#submit-panit").removeAttr("disabled"),$("#divisi").html('<option value="">Pilih divisi...</option>'+i),$('select[name="divisi"]').val("<?= $row['divisi']; ?>"))}});
    </script>
</body>

</html>