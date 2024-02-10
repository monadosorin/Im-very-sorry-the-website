<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'database_suggestions';
require_once './header.php';
?>

<style>
    td {
        vertical-align: middle !important;
    }

    table {
        table-layout: fixed;
    }

    @media screen and (max-width: 1000px) {
        table {
            table-layout: auto;
        }
    }
</style>

<body>
    <div class="container-fluid" style="margin-top: 30px;">
        <div class="row mx-4 justify-content-center">
            <h1 class="title">Kritik & Saran</h1>
        </div>
        <div class="row" style="margin-top: 20px; overflow-x: auto;">
            <div class="col-12" style="overflow-x: auto;">
                <table class="table table-hovered table-striped" id="suggestionsTable" style="color: #412c27; width: 100%">
                    <thead style="text-align: center; font-weight: bold;">
                        <tr>
                            <td style="width: 5%;">#</td>
                            <td style="width: 10%;">NRP</td>
                            <td style="width: 20%;">Nama</td>
                            <td style=" width: 50%;">Kritik & Saran</td>
                            <td style="width: 15%;">Submitted On</td>
                        </tr>
                    </thead>
                    <tbody id="suggestionsTableBody" style="text-align: center;">
                        <?php
                        $rowSuggestionssql = "SELECT * FROM suggestions ORDER BY id DESC";
                        $rowSuggestionsstmt = $pdo->prepare($rowSuggestionssql);
                        $rowSuggestionsstmt->execute();
                        $num = 1;
                        while ($rowSuggestions = $rowSuggestionsstmt->fetch()) {
                        ?>
                            <tr>
                                <td><?= $num ?></td>
                                <td><?= strtoupper($rowSuggestions['nrp']) ?></td>
                                <td><?= $rowSuggestions['nama'] ?></td>
                                <td style="word-wrap: break-word"><?= $rowSuggestions['suggestions'] ?></td>
                                <td><?= $rowSuggestions['submitted_on'] ?> WIB</td>
                            </tr>
                        <?php
                            $num++;
                        }
                        ?>
                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="database.php" class="btn btn-warning container-fluid mb-5" style="width: 150px;"><b>Back</b></a></center>
    </div>

    <script>
        $('#suggestionsTable').DataTable({
            "oLanguage": {
                "sEmptyTable": "Belum Ada Kritik & Saran"
            }
        });
    </script>
</body>

</html>