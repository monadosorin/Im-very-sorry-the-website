<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'filter_testimoni';
require_once './header.php';
?>

<style>
    pre {
        color: black !important;
    }

    .swal2-container {
        z-index: 100000000000000;
    }
</style>

<body>
    <div class="container-fluid" style="margin-top: 30px;">
        <div class="title-row row mx-4">
            <h1 class="title"><i class="fas fa-filter"></i> FILTER TESTIMONI</h1>
        </div>
        <div class="title-row row mx-4">
            <p class="title">untuk mempersingkat waktu <i>loading entries</i>, <i>entries</i> yang ditampilkan akan dibatasi sebanyak maksimal 100 <i>entries</i></p>
        </div>
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
                            <td>Submitted On</td>
                        </tr>
                    </thead>
                    <tbody id="testimoniTableBody" style="text-align: center;">

                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="testimoni_pribadi.php" class="btn btn-secondary container-fluid my-3" style="width: 220px;"><b>Testimoni Pribadi</b></a></center>
        <center><a href="testimoni_tidak_lolos.php" class="btn btn-danger container-fluid mb-3" style="width: 220px;"><b>Testimoni Tidak Lolos</b></a></center>
        <center><a href="filter_history.php" class="btn btn-success container-fluid mb-3" style="width: 220px;"><b>Filter History</b></a></center>
        <center><a href="database.php" class="btn btn-warning container-fluid mb-5" style="width: 220px;"><b>Back</b></a></center>
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
                        id: 4
                    },
                    success: function(t) {
                        $("#testimoniTable").dataTable().fnDestroy();
                        for (var e = t, n = "", a = 1, r = 0; r < e.length; r++) {
                            var i = e[r];
                            (n += "<tr>"),
                            (n += "<td>" + a + "</td>"),
                            (n += "<td>" + i.nrp.toUpperCase() + "</td>"),
                            (n += "<td>" + i.nama + "</td>"),
                            pic && ((n += "<td>" + i.nrp_penilai.toUpperCase() + "</td>"), (n += "<td>" + i.nama_penilai + "</td>")),
                                (n += "<td>" + i.acara + "</td>"),
                                (testimoni = i.testimoni.replace(/'/g, "").replace(/"/g, "")),
                                (n +=
                                    "<td class='btn-col'><a type='button' style='-webkit-appearance: none;' class='btn btn-warning' data-id='" +
                                    i.id +
                                    "' data-testimoni='" +
                                    testimoni +
                                    "' data-nama='" +
                                    i.nama +
                                    "' data-acara='" +
                                    i.acara +
                                    "' onclick='viewTestimoni(this)'><b>View</b></a></td>"),
                                (n += "<td>" + i.submitted_on + " WIB</td>"),
                                (n += "</tr>"),
                                (a += 1);
                        }
                        $("#testimoniTableBody").html(n), Search($("#testimoniTable").DataTable({
                            oLanguage: {
                                sEmptyTable: "Terima Kasih! Semua Testimoni Sudah Dilakukan Filter"
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
                n = t.getAttribute("data-id"),
                a = t.getAttribute("data-nama"),
                r = t.getAttribute("data-acara");
            $.confirm({
                title: "View Testimoni",
                typeAnimated: !0,
                theme: "modern",
                draggable: !1,
                onOpen: function() {
                    setTimeout(() => {
                        this.$content.html(
                            '\n                        <div class="mb-3" style="color: black; text-align: center; font-size: 14pt; max-height: 400px; text-transform: none;">\n                        <b><span id="nama-testi">' +
                            a +
                            '</span></b><br>\n                        <span id="acara-testi"><i>' +
                            r +
                            '</i></span><br><br>\n                        <pre><span id="testimoni-testi">' +
                            e +
                            "</span></pre>\n                        </div>\n                    "
                        );
                    }, 100);
                },
                columnClass: "col-md-5",
                buttons: {
                    lolos: {
                        text: "LOLOS",
                        btnClass: "btn-green",
                        action: function() {
                            if (
                                ($.ajax({
                                        url: "phps/update_testimoni.php",
                                        method: "POST",
                                        data: {
                                            id: n,
                                            ajaxid: 1
                                        },
                                        success: function(t) {
                                            "true" == t
                                                ?
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Lolos!",
                                                    showConfirmButton: !1,
                                                    timer: 800
                                                }) :
                                                "false" == t && Swal.fire({
                                                    position: "center",
                                                    icon: "error",
                                                    title: "Terjadi Error di Server! <br>Silakan Coba Ulangi Kembali.",
                                                    showConfirmButton: !1,
                                                    timer: 3e3
                                                });
                                        },
                                    }),
                                    null == $(t).parent().parent().next().find(".btn-col").children().attr("data-nama"))
                            ) {
                                if (
                                    ((a = $(t).parent().parent().prev().find(".btn-col").children().attr("data-nama")),
                                        (e = $(t).parent().parent().prev().find(".btn-col").children().attr("data-testimoni")),
                                        (n = $(t).parent().parent().prev().find(".btn-col").children().attr("data-id")),
                                        (r = $(t).parent().parent().prev().find(".btn-col").children().attr("data-acara")),
                                        null == a)
                                )
                                    return show(), !0;
                                (t = $(t).parent().parent().prev().find(".btn-col").children()), $(t).parent().parent().next().remove();
                            } else
                                (a = $(t).parent().parent().next().find(".btn-col").children().attr("data-nama")),
                                (e = $(t).parent().parent().next().find(".btn-col").children().attr("data-testimoni")),
                                (n = $(t).parent().parent().next().find(".btn-col").children().attr("data-id")),
                                (r = $(t).parent().parent().next().find(".btn-col").children().attr("data-acara")),
                                (t = $(t).parent().parent().next().find(".btn-col").children()),
                                $(t).parent().parent().prev().remove();
                            return (document.getElementById("nama-testi").innerHTML = a), (document.getElementById("acara-testi").innerHTML = "<i>" + r + "</i>"), (document.getElementById("testimoni-testi").innerHTML = e), !1;
                        },
                    },
                    tidak_lolos: {
                        text: "TIDAK LOLOS",
                        btnClass: "btn-red",
                        action: function() {
                            if (
                                ($.ajax({
                                        url: "phps/update_testimoni.php",
                                        method: "POST",
                                        data: {
                                            id: n,
                                            ajaxid: 4
                                        },
                                        success: function(t) {
                                            "true" == t
                                                ?
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Tidak Lolos!",
                                                    showConfirmButton: !1,
                                                    timer: 800
                                                }) :
                                                "false" == t && Swal.fire({
                                                    position: "center",
                                                    icon: "error",
                                                    title: "Terjadi Error di Server! <br>Silakan Coba Ulangi Kembali.",
                                                    showConfirmButton: !1,
                                                    timer: 3e3
                                                });
                                        },
                                    }),
                                    null == $(t).parent().parent().next().find(".btn-col").children().attr("data-nama"))
                            ) {
                                if (
                                    ((a = $(t).parent().parent().prev().find(".btn-col").children().attr("data-nama")),
                                        (e = $(t).parent().parent().prev().find(".btn-col").children().attr("data-testimoni")),
                                        (n = $(t).parent().parent().prev().find(".btn-col").children().attr("data-id")),
                                        (r = $(t).parent().parent().prev().find(".btn-col").children().attr("data-acara")),
                                        null == a)
                                )
                                    return show(), !0;
                                (t = $(t).parent().parent().prev().find(".btn-col").children()), $(t).parent().parent().next().remove();
                            } else
                                (a = $(t).parent().parent().next().find(".btn-col").children().attr("data-nama")),
                                (e = $(t).parent().parent().next().find(".btn-col").children().attr("data-testimoni")),
                                (n = $(t).parent().parent().next().find(".btn-col").children().attr("data-id")),
                                (r = $(t).parent().parent().next().find(".btn-col").children().attr("data-acara")),
                                (t = $(t).parent().parent().next().find(".btn-col").children()),
                                $(t).parent().parent().prev().remove();
                            return (document.getElementById("nama-testi").innerHTML = a), (document.getElementById("acara-testi").innerHTML = "<i>" + r + "</i>"), (document.getElementById("testimoni-testi").innerHTML = e), !1;
                        },
                    },
                    pribadi: {
                        text: "PRIBADI",
                        btnClass: "btn-secondary",
                        action: function() {
                            if (
                                ($.ajax({
                                        url: "phps/update_testimoni.php",
                                        method: "POST",
                                        data: {
                                            id: n,
                                            ajaxid: 2
                                        },
                                        success: function(t) {
                                            "true" == t
                                                ?
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Testimoni Pribadi!",
                                                    showConfirmButton: !1,
                                                    timer: 800
                                                }) :
                                                "false" == t && Swal.fire({
                                                    position: "center",
                                                    icon: "error",
                                                    title: "Terjadi Error di Server! <br>Silakan Coba Ulangi Kembali.",
                                                    showConfirmButton: !1,
                                                    timer: 3e3
                                                });
                                        },
                                    }),
                                    null == $(t).parent().parent().next().find(".btn-col").children().attr("data-nama"))
                            ) {
                                if (
                                    ((a = $(t).parent().parent().prev().find(".btn-col").children().attr("data-nama")),
                                        (e = $(t).parent().parent().prev().find(".btn-col").children().attr("data-testimoni")),
                                        (n = $(t).parent().parent().prev().find(".btn-col").children().attr("data-id")),
                                        (r = $(t).parent().parent().prev().find(".btn-col").children().attr("data-acara")),
                                        null == a)
                                )
                                    return show(), !0;
                                (t = $(t).parent().parent().prev().find(".btn-col").children()), $(t).parent().parent().next().remove();
                            } else
                                (a = $(t).parent().parent().next().find(".btn-col").children().attr("data-nama")),
                                (e = $(t).parent().parent().next().find(".btn-col").children().attr("data-testimoni")),
                                (n = $(t).parent().parent().next().find(".btn-col").children().attr("data-id")),
                                (r = $(t).parent().parent().next().find(".btn-col").children().attr("data-acara")),
                                (t = $(t).parent().parent().next().find(".btn-col").children()),
                                $(t).parent().parent().prev().remove();
                            return (document.getElementById("nama-testi").innerHTML = a), (document.getElementById("acara-testi").innerHTML = "<i>" + r + "</i>"), (document.getElementById("testimoni-testi").innerHTML = e), !1;
                        },
                    },
                    close: {
                        text: "CLOSE",
                        btnClass: "btn-blue",
                        action: function() {
                            show();
                        },
                    },
                    back: {
                        text: "BACK",
                        btnClass: "btn-warning",
                        action: function() {
                            return (
                                null == $(t).parent().parent().prev().find(".btn-col").children().attr("data-nama") ?
                                alert('This is the first testimonial in the table. Close the "View Testimoni" box to refresh the table and see if there are other new testimonials available.') :
                                ((a = $(t).parent().parent().prev().find(".btn-col").children().attr("data-nama")),
                                    (e = $(t).parent().parent().prev().find(".btn-col").children().attr("data-testimoni")),
                                    (n = $(t).parent().parent().prev().find(".btn-col").children().attr("data-id")),
                                    (r = $(t).parent().parent().prev().find(".btn-col").children().attr("data-acara")),
                                    (t = $(t).parent().parent().prev().find(".btn-col").children()),
                                    (document.getElementById("nama-testi").innerHTML = a),
                                    (document.getElementById("acara-testi").innerHTML = "<i>" + r + "</i>"),
                                    (document.getElementById("testimoni-testi").innerHTML = e)),
                                !1
                            );
                        },
                    },
                    next: {
                        text: "NEXT",
                        btnClass: "btn-warning",
                        action: function() {
                            return (
                                null == $(t).parent().parent().next().find(".btn-col").children().attr("data-nama") ?
                                alert('This is the last testimonial in table. Close the "View Testimoni" box to refresh the table and see if there are other new testimonials available.') :
                                ((a = $(t).parent().parent().next().find(".btn-col").children().attr("data-nama")),
                                    (e = $(t).parent().parent().next().find(".btn-col").children().attr("data-testimoni")),
                                    (n = $(t).parent().parent().next().find(".btn-col").children().attr("data-id")),
                                    (r = $(t).parent().parent().next().find(".btn-col").children().attr("data-acara")),
                                    (t = $(t).parent().parent().next().find(".btn-col").children()),
                                    (document.getElementById("nama-testi").innerHTML = a),
                                    (document.getElementById("acara-testi").innerHTML = "<i>" + r + "</i>"),
                                    (document.getElementById("testimoni-testi").innerHTML = e)),
                                !1
                            );
                        },
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