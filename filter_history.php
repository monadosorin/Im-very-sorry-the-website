<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'filter_history';
require_once './header.php';
?>

<style>
    pre {
        color: black !important;
    }
</style>

<body>
    <div class="container-fluid" style="margin-top: 30px;">
        <div class="title-row row mx-4">
            <h1 class="title"><i class="fas fa-history"></i> FILTER HISTORY</h1>
        </div>
        <!-- <div class="title-row row mx-4">
            <p class="title">untuk mempersingkat waktu <i>loading entries</i>, <i>entries</i> yang ditampilkan akan dibatasi sebanyak maksimal 500 <i>entries</i></p>
        </div> -->
        <?php
        $cekTestimonisql = "SELECT * FROM data_performance";
        $cekTestimonistmt = $pdo->prepare($cekTestimonisql);
        $cekTestimonistmt->execute();
        if ($cekTestimonistmt->rowCount() > 0) {
        ?>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                    <select class="selectpicker form-control" id="filter_acara" name="filter_acara" style="height:40px; font-size: 12pt;" data-live-search="true">
                        <option value="">Lihat berdasarkan acara...</option>
                        <?php
                        $getListEventsql = "SELECT * FROM event ORDER BY year DESC";
                        $getListEventstmt = $pdo->prepare($getListEventsql);
                        $getListEventstmt->execute([]);
                        while ($getListEventrow = $getListEventstmt->fetch()) {
                        ?>
                            <option value="<?= $getListEventrow['name']; ?>"><?= $getListEventrow['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="row" style="margin-top: 20px;overflow-x: auto;">
            <div class="col-12" style="overflow-x: auto;">
                <table class="table table-hovered table-striped" id="testimoniTable" style="color: #412c27; width: 100%">
                    <thead style="text-align: center; font-weight: bold;">
                        <tr>
                            <td style="width: 5%;">#</td>
                            <td>NRP</td>
                            <td>Nama</td>
                            <?php
                            if (isPIC($_SESSION['nrp'])) {
                            ?>
                                <td>NRP Penilai</td>
                                <td>Nama Penilai</td>
                            <?php
                            }
                            ?>
                            <td>Acara</td>
                            <td>Testimoni</td>
                            <td>Status</td>
                            <td>Filtered By</td>
                        </tr>
                    </thead>
                    <tbody id="testimoniTableBody" style="text-align: center;">

                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="testimoni_pribadi.php" class="btn btn-secondary container-fluid my-3" style="width: 220px;"><b>Testimoni Pribadi</b></a></center>
        <center><a href="testimoni_tidak_lolos.php" class="btn btn-danger container-fluid mb-3" style="width: 220px;"><b>Testimoni Tidak Lolos</b></a></center>
        <center><a href="filter_testimoni.php" class="btn btn-warning container-fluid mb-5" style="width: 220px;"><b>Back</b></a></center>
    </div>

    <script>
        <?php
        if (isPIC($_SESSION['nrp'])) {
        ?>
            var pic = true;
        <?php
        } else {
        ?>
            var pic = false;
        <?php
        }
        ?>

        function show() {
            $("#testimoniTableBody").html("<span>Harap tunggu...</span>"),
                $.ajax({
                    url: "phps/refresh_data.php",
                    type: "get",
                    dataType: "json",
                    data: {
                        id: 7
                    },
                    success: function(t) {
                        $("#testimoniTable").dataTable().fnDestroy();
                        for (var e = t, n = "", a = 1, i = 0; i < e.length; i++) {
                            var o = e[i];
                            (n += "<tr>"),
                            (n += "<td>" + a + "</td>"),
                            (n += "<td>" + o.nrp.toUpperCase() + "</td>"),
                            (n += "<td>" + o.nama + "</td>"),
                            pic && ((n += "<td>" + o.nrp_penilai.toUpperCase() + "</td>"), (n += "<td>" + o.nama_penilai + "</td>")),
                                (n += "<td>" + o.acara + "</td>"),
                                (testimoni = o.testimoni.replace(/'/g, "").replace(/"/g, "")),
                                (n += "<td><a type='button' style='-webkit-appearance: none;' class='btn btn-warning' data-id='" + o.id + "' data-testimoni='" + testimoni + "' onclick='viewTestimoni(this)'><b>View</b></a></td>"),
                                1 == o.status ?
                                (n += "<td style='color: gray; font-weight: bold;'>PRIBADI</td>") :
                                2 == o.status ?
                                (n += "<td style='color: green; font-weight: bold;'>LOLOS</td>") :
                                3 == o.status && (n += "<td style='color: red; font-weight: bold;'>TIDAK LOLOS</td>"),
                                (n += "<td>" + o.filtered_by.toUpperCase() + "</td>"),
                                (n += "</tr>"),
                                (a += 1);
                        }
                        $("#testimoniTableBody").html(n), Search($("#testimoniTable").DataTable({
                            oLanguage: {
                                sEmptyTable: "Belum Ada Testimoni Yang Dilakukan Filter"
                            }
                        }));
                    },
                    error: function(t) {
                        alert("Mohon maaf, terjadi error di server. Silakan coba ulangi kembali.");
                    },
                });
        }

        function Search(t) {
            $("#filter_acara").on("change", function() {
                var col_index = pic ? 5 : 3;
                t.columns(col_index).search(this.value).draw();
            });
        }

        function viewTestimoni(t) {
            var e = t.getAttribute("data-testimoni"),
                n = t.getAttribute("data-id");
            $.confirm({
                title: "View Testimoni",
                typeAnimated: !0,
                theme: "modern",
                draggable: !1,
                onOpen: function() {
                    setTimeout(() => {
                        this.$content.html(
                            '\n                        <div class="mb-3" style="color: black; text-align: center; font-size: 14pt; text-transform: none;"><pre id="testi-content-container">' + e + "</pre></div>\n                    "
                        );
                    }, 100);
                },
                columnClass: "col-md-6",
                buttons: {
                    confirm: {
                        text: "UNDO",
                        btnClass: "btn-green",
                        action: function() {
                            $.ajax({
                                url: "phps/update_testimoni.php",
                                method: "POST",
                                data: {
                                    id: n,
                                    ajaxid: 3
                                },
                                success: function(t) {
                                    show(),
                                        "true" == t ?
                                        Swal.fire({
                                            position: "center",
                                            icon: "success",
                                            title: "Berhasil Undo Testimoni!",
                                            showConfirmButton: !1,
                                            timer: 1500
                                        }) :
                                        "false" == t && Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "Terjadi Error di Server! <br>Silakan Coba Ulangi Kembali.",
                                            showConfirmButton: !1,
                                            timer: 3e3
                                        });
                                },
                            });
                        },
                    },
                    cancel: {
                        text: "CLOSE",
                        btnClass: "btn-red",
                        action: function() {}
                    },
                },
                content: '\n            <div style="height: 100px; display: grid; place-items: center;">\n                <div class="spinner-border text-primary" role="status">\n                    <span class="sr-only">Loading...</span>\n                </div>\n            </div>\n            ',
            });
        }
        $(document).ready(function() {
            show();
        });
    </script>
</body>

</html>