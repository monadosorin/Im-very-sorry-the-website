<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'edit_divisi';
require_once './header.php';

if (isset($_GET['id'])) {
    $sql = "SELECT a.id, b.id as id_acara, a.nama, b.name as acara FROM divisi_event a JOIN event b ON a.id_event = b.id WHERE a.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch();

    $sqlAcara = "SELECT * FROM event";
    $stmtAcara = $pdo->prepare($sqlAcara);
    $stmtAcara->execute([]);
}
?>

<head>
    <title>REACH - Edit Divisi <?= $row['nama']; ?></title>
</head>

<body>
    <div class="container mb-5">
        <div class="row justify-content-center">
            <h1 class="title"><i class="fas fa-edit"></i> EDIT DIVISI</h1>
        </div>
        <form action="phps/update_divisi.php" method="POST">
            <div class="form-group">
                <input hidden name="id" value="<?= $row['id'] ?>" />
                <center><label for="nama" style="font-weight: bold;" class="mt-3">Nama Divisi</label></center>
                <input type="text" style="text-align: center;" id="nama" name="nama" placeholder="Ex: Konsumsi" class="form-control" maxlength="30" value="<?= $row['nama'] ?>" required>
                <?php
                $checkAssessmentsql = "SELECT nrp FROM data_performance WHERE id_divisi = ?";
                $checkAssessmentstmt = $pdo->prepare($checkAssessmentsql);
                $checkAssessmentstmt->execute([$_GET['id']]);
                if ($checkAssessmentstmt->rowCount() == 0) {
                ?>
                    <center><label for="event" style="font-weight: bold;" class="mt-3">Acara</label></center>
                    <select class="form-control" id="event" name="event" style="height:40px; font-size: 12pt;" required>
                        <option value="">Pilih acara...</option>
                        <?php
                        while ($rowAcara = $stmtAcara->fetch()) { ?>
                            <option value="<?php echo $rowAcara['id']; ?>"><?php echo $rowAcara['name']; ?></option>
                        <?php  } ?>
                    </select>
                <?php
                } else {
                ?>
                    <center><label for="event" style="font-weight: bold;" class="mt-3">Acara</label></center>
                    <select class="form-control" id="event" name="event" style="height:40px; font-size: 12pt;" disabled>
                        <option value="">Pilih acara...</option>
                        <?php
                        while ($rowAcara = $stmtAcara->fetch()) { ?>
                            <option value="<?php echo $rowAcara['id']; ?>"><?php echo $rowAcara['name']; ?></option>
                        <?php  } ?>
                    </select>
                <?php
                }
                ?>
                <br>
                <p style="text-align: center; color: red;" class="mx-2">PERHATIAN: Divisi Yang Sudah Pernah Diberikan Assessment di Acara Yang Dilakukan Input Tidak Dapat Mengganti Acara</p>
                <center><input type="submit" id="submit" name="submit" value="Update Data Divisi" class="btn btn-success container-fluid" style="width: 200px;"></center>
                <center><a href="database_divisi.php" class="btn btn-danger container-fluid mt-3" style="width: 200px;"><b>Cancel</b></a></center>
            </div>
        </form>
    </div>

    <script>
        $('select[name="event"]').val('<?= $row['id_acara']; ?>');
    </script>
</body>

</html>