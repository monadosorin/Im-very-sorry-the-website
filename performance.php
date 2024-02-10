<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'performance';
require_once 'header.php';

if (!isset($_GET['event'])) {
    $rowAVGPerformance = getAveragePerformance($_SESSION['nrp']);
    $peopleCount = getPeopleCount($_SESSION['nrp']);
} else {
    $rowAVGPerformance = getAveragePerformance($_SESSION['nrp'], $_GET['event']);
    $peopleCount = getPeopleCount($_SESSION['nrp'], $_GET['event']);
}
?>

<style>
    body{background-color:#7c6ed1;height:100vh;width:100vw;overflow:hidden}.progress{background-color:#d67c57;border-radius:10px}.wrapper{height:calc(100vh - 80px);width:100vw}.container-menu{scroll-behavior:smooth;height:100%;position:relative;display:grid;place-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;overflow-y:scroll;padding:40px!important;margin-bottom:0!important}.menu{display:grid;place-items:center;grid-template-rows:50px auto;height:95%;position:relative;padding:35px;overflow-x:hidden}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}.menu .container-menu{background-color:#95cee4;overflow-x:hidden}.bar{width:100%;height:100%;background-color:#d67c57;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#fdcd5f;left:0;height:100%;display:grid;place-items:center;width:50px;color:#3c6cb4;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red;color:#fff}.content-container{color:#3c6cb4}.performance-title{letter-spacing:5px;color:#fdcd5f;margin-bottom:0;grid-column:2}.bg-performance{z-index:0;position:absolute;object-fit:cover;height:100vh}label{color:#fff}input,select,textarea{border:none!important;border-radius:10px!important;color:#fff!important}.container-menu::-webkit-scrollbar{width:15px}.container-menu::-webkit-scrollbar-track{background:#95cee4}.container-menu::-webkit-scrollbar-thumb{background:#3c6cb4;border-right:8px #95cee4 solid;border-top:10px #95cee4 solid;border-bottom:10px #95cee4 solid;background-clip:padding-box}@media screen and (max-width:992px){.performance-title{font-size:20pt}.performance-text{text-align:center}.select-container{display:grid;place-items:center}}.detail-btn{width:35px;margin-bottom:10px;margin-left:5px;cursor:pointer}.select-performance{width:80%}@media screen and (max-width:768px){.performance-text{font-size:1.75rem;text-align:center}.assessment-container{padding-left:30px}.select-performance{width:100%}.menu{padding:20px}}@media screen and (max-width:400px){.container-menu{padding:20px!important}}.container-testi{background-color:transparent!important}.jconfirm-box-container .jconfirm-box{background-image:url(assets/background/details.png);background-size:cover;box-shadow:none!important}.performance-container{display:block}.performance-container-mobile{display:none}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.menu{padding:20px}.card-columns{display:block!important;-webkit-column-count:1!important;-moz-column-count:1!important;column-count:1!important}.performance-container{display:none}.performance-container-mobile{display:block}}.btn-red{border-radius:25px!important}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;font-weight:700;-webkit-appearance:none}.btn:hover{transition:.3s;background:#7c6ed1;color:#fff}
</style>

<body>
    <script>
        function displayRadarChart(e, n, r, a, o, t) {
            var l = document.getElementById(t).getContext("2d");
            new Chart(l, {
                type: "radar",
                data: {
                    labels: ["TM", "C", "PS", "OM", "ES"],
                    datasets: [{
                        label: "Average Performance",
                        fontFamily: "Recoleta",
                        data: [e, n, r, a, o],
                        backgroundColor: ["rgba(242,213,150,0.3)"],
                        borderColor: ["red", "green", "blue", "orange", "brown"],
                        borderWidth: 5
                    }],
                    pointLabelFontSize: 14
                },
                options: {
                    scale: {
                        ticks: {
                            min: 0,
                            max: 4,
                            stepSize: .5,
                            fontSize: 14
                        },
                        gridLines: {
                            color: ["green", "green", "green", "green", "green", "green", "green", "green"]
                        },
                        pointLabels: {
                            fontColor: "#3C6CB4",
                            fontFamily: "Recoleta",
                            fontSize: 12
                        }
                    },
                    legend: {
                        labels: {
                            fontSize: 16
                        }
                    }
                }
            })
        }
    </script>

    <div class="wrapper">
        <div class="menu" data-aos="zoom-in">
            <div class="bar">
                <a href="home.php" style="height: 100%; text-decoration: none;">
                    <div class="close-menu">
                        <i class="fas fa-times"></i>
                    </div>
                </a>
                <div>
                    <h3 class="performance-title">Performance</h3>
                </div>
            </div>
            <div class="container-menu">
                <img class="bg-performance" src="./assets/background/performance.png" alt="Background - Performance" style="width: 100%;" id="section_content">
                <div class="content-container mt-3">

                    <div class="average-rating row">

                        <div class="select-container col-12 col-lg-6 mb-5">
                            <div class="select-performance">
                                <h2 class="performance-text">My Performance</h2>
                                <label for="appearance" style="color: #3C6CB4;">Choose an Appearance</label>
                                <select class="form-control" id="appearance" name="appearance" style="height:40px; font-size: 12pt; background-color:#FDCD5F; color:#3C6CB4!important; border-radius:25px!important;">
                                    <option value="Stars">Stars</option>
                                    <option value="Radar Chart">Radar Chart</option>
                                </select>
                                <label for="event" class="mt-3" style="color: #3C6CB4;">Your Event(s)</label>
                                <select class="form-control" id="event" name="event" style="height:40px; font-size: 12pt; background-color:#FDCD5F; color:#3C6CB4!important; border-radius: 25px!important;">
                                    <option value="">Choose an event...</option>
                                    <?php getEventList($_SESSION['nrp']); ?>
                                </select>
                            </div>

                            <?php
                            if (isset($_GET['event'])) {
                                $rowEvent = getEvent($_GET['event']);
                            ?>
                                <a type="button" class="btn btn-warning mt-4" id="overall" style='width: 250px;'>See Overall Performance</a>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="assessment-container col-12 col-lg-6">

                            <div class="title-row row">
                                <?php
                                if (!isset($_GET['event'])) {
                                ?>
                                    <div class="performance-container">
                                        <h2 id="sub-title">Overall Performance <i style="font-size: 22pt; color: #8A82D1;" class="fas fa-star"></i> <?= roundFloat(getOverallPerformance($_SESSION['nrp']), 2) ?></h2>
                                    </div>

                                    <div class="performance-container-mobile col-12">
                                        <div class="row mx-2 justify-content-center">
                                            <h3 style="text-align: center;">Overall Performance</h3>
                                        </div>
                                        <div class="row mx-2 justify-content-center">
                                            <p style="font-weight: bold; text-align: center; font-size: 40pt;"><?= roundFloat(getOverallPerformance($_SESSION['nrp']), 2) ?></p>
                                        </div>
                                        <div class="row mx-2 justify-content-center" style="margin-top: -25px;">
                                            <?php displayStars(getOverallPerformance($_SESSION['nrp'])) ?>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="performance-container">
                                        <h2 id="sub-title"><a style="text-decoration: none; color: #3C6CB4;" target="_blank" href="<?= htmlspecialchars($rowEvent['url']) ?>"><?= htmlspecialchars($rowEvent['name']) ?></a> <i style="font-size: 22pt; color: #8A82D1;" class="fas fa-star"></i> <?= roundFloat(getOverallPerformance($_SESSION['nrp'], $_GET['event']), 2) ?></h2>
                                    </div>

                                    <div class="performance-container-mobile col-12">
                                        <div class="row mx-2 justify-content-center">
                                            <h3 style="text-align: center;"><a style="text-decoration: none; color: #3C6CB4;" target="_blank" href="<?= htmlspecialchars($rowEvent['url']) ?>"><?= htmlspecialchars($rowEvent['name']) ?></a></h3>
                                        </div>
                                        <div class="row mx-2 justify-content-center">
                                            <p style="font-weight: bold; text-align: center; font-size: 40pt;"><?= roundFloat(getOverallPerformance($_SESSION['nrp'], $_GET['event']), 2) ?></p>
                                        </div>
                                        <div class="row mx-2 justify-content-center" style="margin-top: -25px;">
                                            <?php displayStars(getOverallPerformance($_SESSION['nrp'], $_GET['event']), 2) ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="title-row row mb-4">
                                <?php
                                if (!isset($_GET['event'])) {
                                    if ($peopleCount == 0) {
                                ?>
                                        <h6 style="text-align: center;" id="desc-title">Anda Belum Pernah Diberi Assessment!<h5>
                                            <?php
                                        } else {
                                            ?>
                                                <div class="performance-container">
                                                    <h5 style="text-align: center;" id="desc-title">rated by <b><?= $peopleCount ?></b> committee(s) on <b><?= getEventCount($_SESSION['nrp']) ?></b> event(s)</h5>
                                                </div>

                                                <div class="performance-container-mobile col-12">
                                                    <div class="row mx-2 mt-3 justify-content-center">
                                                        <h5 style="text-align: center;" class="title-performance">rated by <b><?= $peopleCount ?></b> committee(s)</h5>
                                                    </div>
                                                    <div class="row mx-2 mb-3 justify-content-center">
                                                        <h5 style="text-align: center;" class="title-performance">on <b><?= getEventCount($_SESSION['nrp']) ?></b> event(s)</h5>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    } else {
                                        if ($peopleCount == 0) {
                                            ?>
                                                <h6 style="text-align: center;" id="desc-title">Anda Belum Pernah Diberi Assessment di Acara Ini!<h5>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <div class="performance-container">
                                                            <h5 style="text-align: center;" id="desc-title">rated by <b><?= $peopleCount ?></b> committee(s)</h5>
                                                        </div>

                                                        <div class="performance-container-mobile col-12 mb-3">
                                                            <div class="row mx-2 mt-3 justify-content-center">
                                                                <h5 style="text-align: center;" class="title-performance">rated by <b><?= $peopleCount ?></b> committee(s)</h5>
                                                            </div>
                                                        </div>
                                                <?php
                                                }
                                            }
                                                ?>
                            </div>

                            <div class="radar-outer-row row justify-content-center">
                                <div class="radar-row row" hidden>
                                    <canvas id="performanceChart" width="300" height="300"></canvas>
                                    <script>
                                        <?php
                                        if ($rowAVGPerformance['time_management'] != NULL) {
                                        ?>
                                            displayRadarChart(<?= $rowAVGPerformance['time_management'] ?>, <?= $rowAVGPerformance['cooperative'] ?>, <?= $rowAVGPerformance['problem_solving'] ?>, <?= $rowAVGPerformance['open_minded'] ?>, <?= $rowAVGPerformance['emotional_stability'] ?>, "performanceChart");

                                        <?php
                                        } else {
                                        ?>
                                            displayRadarChart(0, 0, 0, 0, 0, "performanceChart");
                                        <?php
                                        }
                                        ?>
                                    </script>
                                </div>
                            </div>

                            <div class="star-row row justify-content-center" style="margin-bottom: 20px;">

                                <?php
                                $performance = array(
                                    array("Time Management", "fas fa-hourglass-half"),
                                    array("Cooperative", "far fa-handshake"),
                                    array("Problem Solving", "fas fa-puzzle-piece"),
                                    array("Open Minded", "fas fa-brain"),
                                    array("Emotional Stability", "fas fa-heartbeat")
                                );

                                for ($i = 0; $i < count($performance); $i++) {
                                    $performanceCode = strtolower(preg_replace('/\s+/', '_', $performance[$i][0]));
                                ?>
                                    <div id="textbox">
                                        <div class="alignleft">
                                            <h3 style="margin-bottom: 3.5vh;" class="title-performance"><i class="<?= $performance[$i][1] ?>"></i> <?= $performance[$i][0] ?></h3>
                                        </div>
                                        <div class="alignright">
                                            <?php displayStars($rowAVGPerformance[$performanceCode]) ?>
                                            <span class="title-performance">&nbsp;<?= roundFloat($rowAVGPerformance[$performanceCode], 2) ?></span>
                                            <img src="./assets/svg/details.svg" alt="Details" class="detail-btn" onclick="performanceDetails(this)" data-performance="<?= $performance[$i][0] ?>">
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>

                        <div class="col-12 mb-3 mt-3">
                            <hr style="border: 1px solid purple; width: 100%;">
                            <div class="row mx-2 mt-4 justify-content-center">
                                <h3 style="font-weight: bold; text-align: center; letter-spacing: 5px;">Testimoni</h3>
                            </div>
                            <hr style="border: 1px solid purple; width: 100%;">
                            <div class="mt-1 justify-content-center" id="testimoni-row">
                                <?php
                                if (!isset($_GET['event'])) {
                                    displayTestimonial($_SESSION['nrp']);
                                } else {
                                    displayTestimonial($_SESSION['nrp'], $_GET['event']);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-container">
            <img src="./assets/svg/footer.svg" alt="Footer" class="footer-svg">
        </div>
    </div>

    <script>
        <?php
        if (!isset($_GET['event'])) {
        ?>
            function performanceDetails(t){var a=t.getAttribute("data-performance");$.ajax({url:"phps/get_performance_details.php",method:"POST",data:{performance:a},success:function(t){var e=$.parseJSON(t),s=e.b;e.c>s&&(s=e.c),e.d>s&&(s=e.d),e.e>s&&(s=e.e);var i='\n                <div class="row justify-content-center" style="color: black; width: 100%;">\n                    <div class="row ml-1 justify-content-center" style="width: 100%;">\n                        <div style="float: left; width: 20%;">\n                            <span style="font-size: 20pt; color: #3c6cb4;">4</span> <i style="font-size: 20pt;color:#7d6ad2;" class="fas fa-star"></i>\n                        </div>\n                        <div class="progress" style="margin-left: 1vw; float: right; width: 75%; height: 4vh;">\n                            <div class="progress-bar bg-warning" role="progressbar" style="font-size: 14pt; color: black; width: '+e.b/s*100+'%;" aria-valuenow="'+e.b+'" aria-valuemin="0" aria-valuemax="'+s+'">';0!=e.b?i+=e.b+"</div>":i+="</div>",i+='\n                        </div>\n                    </div>\n                    <div class="row ml-1 mt-3 justify-content-center" style="width: 100%;">\n                        <div style="float: left; width: 20%;">\n                            <span style="font-size: 20pt; color: #3c6cb4;">3</span> <i style="font-size: 20pt;color:#7d6ad2;" class="fas fa-star"></i>\n                        </div>\n                        <div class="progress" style="margin-left: 1vw; float: right; width: 75%; height: 4vh;">\n                            <div class="progress-bar bg-warning" role="progressbar" style="font-size: 14pt; color: black; width: '+e.c/s*100+'%;" aria-valuenow="'+e.c+'" aria-valuemin="0" aria-valuemax="'+s+'">',0!=e.c?i+=e.c+"</div>":i+="</div>",i+='\n                        </div>\n                    </div>\n                    <div class="row ml-1 mt-3 justify-content-center" style="width: 100%;">\n                        <div style="float: left; width: 20%;">\n                            <span style="font-size: 20pt; color: #3c6cb4;">2</span> <i style="font-size: 20pt;color:#7d6ad2;" class="fas fa-star"></i>\n                        </div>\n                        <div class="progress" style="margin-left: 1vw; float: right; width: 75%; height: 4vh;">\n                            <div class="progress-bar bg-warning" role="progressbar" style="font-size: 14pt; color: black; width: '+e.d/s*100+'%;" aria-valuenow="'+e.d+'" aria-valuemin="0" aria-valuemax="'+s+'">',0!=e.d?i+=e.d+"</div>":i+="</div>",i+='\n                        </div>\n                    </div>\n                    <div class="row ml-1 mt-3 justify-content-center" style="width: 100%;">\n                        <div style="float: left; width: 20%;">\n                            <span style="font-size: 20pt; color: #3c6cb4;">1</span> <i style="font-size: 20pt;color:#7d6ad2;" class="fas fa-star"></i>\n                        </div>\n                        <div class="progress" style="margin-left: 1vw; float: right; width: 75%; height: 4vh;">\n                            <div class="progress-bar bg-warning" role="progressbar" style="font-size: 14pt; color: black; width: '+e.e/s*100+'%;" aria-valuenow="'+e.e+'" aria-valuemin="0" aria-valuemax="'+s+'">',0!=e.e?i+=e.e+"</div>":i+="</div>",i+="\n                        </div>\n                    </div>\n                </div>\n                ",$.confirm({title:'<h2 style="color: #3c6cb4;"><b>'+a+'</b></h2><h5 style="color: #3c6cb4;">Performance Details</h5>',typeAnimated:!0,theme:"modern",draggable:!1,onOpen:function(){setTimeout(()=>{this.$content.html(i)},100)},columnClass:"col-12 col-md-7",buttons:{cancel:{text:"Close",btnClass:"btn-red",action:function(){}}},content:'\n            <div style="height: 100px; display: grid; place-items: center;">\n                <div class="spinner-border text-primary" role="status">\n                    <span class="sr-only">Loading...</span>\n                </div>\n            </div>\n            '})},error:function(t){alert("Mohon maaf, terjadi error di server. Silakan coba ulangi kembali.")}})}
        <?php
        } else {
        ?>
            function performanceDetails(t){var e=t.getAttribute("data-performance");$.ajax({url:"phps/get_performance_details.php",method:"POST",data:{performance:e,event:<?= $_GET['event'] ?>},success:function(t){var a=$.parseJSON(t),s=a.b;a.c>s&&(s=a.c),a.d>s&&(s=a.d),a.e>s&&(s=a.e);var i='\n                <div class="row justify-content-center" style="color: black; width: 100%;">\n                    <div class="row ml-1 justify-content-center" style="width: 100%;">\n                        <div style="float: left; width: 20%;">\n                            <span style="font-size: 20pt; color: #3c6cb4;">4</span> <i style="font-size: 20pt;color:#7d6ad2;" class="fas fa-star"></i>\n                        </div>\n                        <div class="progress" style="margin-left: 1vw; float: right; width: 75%; height: 4vh;">\n                            <div class="progress-bar bg-warning" role="progressbar" style="font-size: 14pt; color: black; width: '+a.b/s*100+'%;" aria-valuenow="'+a.b+'" aria-valuemin="0" aria-valuemax="'+s+'">';0!=a.b?i+=a.b+"</div>":i+="</div>",i+='\n                        </div>\n                    </div>\n                    <div class="row ml-1 mt-3 justify-content-center" style="width: 100%;">\n                        <div style="float: left; width: 20%;">\n                            <span style="font-size: 20pt; color: #3c6cb4;">3</span> <i style="font-size: 20pt;color:#7d6ad2;" class="fas fa-star"></i>\n                        </div>\n                        <div class="progress" style="margin-left: 1vw; float: right; width: 75%; height: 4vh;">\n                            <div class="progress-bar bg-warning" role="progressbar" style="font-size: 14pt; color: black; width: '+a.c/s*100+'%;" aria-valuenow="'+a.c+'" aria-valuemin="0" aria-valuemax="'+s+'">',0!=a.c?i+=a.c+"</div>":i+="</div>",i+='\n                        </div>\n                    </div>\n                    <div class="row ml-1 mt-3 justify-content-center" style="width: 100%;">\n                        <div style="float: left; width: 20%;">\n                            <span style="font-size: 20pt; color: #3c6cb4;">2</span> <i style="font-size: 20pt;color:#7d6ad2;" class="fas fa-star"></i>\n                        </div>\n                        <div class="progress" style="margin-left: 1vw; float: right; width: 75%; height: 4vh;">\n                            <div class="progress-bar bg-warning" role="progressbar" style="font-size: 14pt; color: black; width: '+a.d/s*100+'%;" aria-valuenow="'+a.d+'" aria-valuemin="0" aria-valuemax="'+s+'">',0!=a.d?i+=a.d+"</div>":i+="</div>",i+='\n                        </div>\n                    </div>\n                    <div class="row ml-1 mt-3 justify-content-center" style="width: 100%;">\n                        <div style="float: left; width: 20%;">\n                            <span style="font-size: 20pt; color: #3c6cb4;">1</span> <i style="font-size: 20pt;color:#7d6ad2;" class="fas fa-star"></i>\n                        </div>\n                        <div class="progress" style="margin-left: 1vw; float: right; width: 75%; height: 4vh;">\n                            <div class="progress-bar bg-warning" role="progressbar" style="font-size: 14pt; color: black; width: '+a.e/s*100+'%;" aria-valuenow="'+a.e+'" aria-valuemin="0" aria-valuemax="'+s+'">',0!=a.e?i+=a.e+"</div>":i+="</div>",i+="\n                        </div>\n                    </div>\n                </div>\n                ",$.confirm({title:'<h2 style="color: #3c6cb4;"><b>'+e+'</b></h2><h5 style="color: #3c6cb4;">Performance Details</h5>',typeAnimated:!0,theme:"modern",draggable:!1,onOpen:function(){setTimeout(()=>{this.$content.html(i)},100)},columnClass:"col-12 col-md-7",buttons:{cancel:{text:"Close",btnClass:"btn-red",action:function(){}}},content:'\n            <div style="height: 100px; display: grid; place-items: center;">\n                <div class="spinner-border text-primary" role="status">\n                    <span class="sr-only">Loading...</span>\n                </div>\n            </div>\n            '})},error:function(t){alert("Mohon maaf, terjadi error di server. Silakan coba ulangi kembali.")}})}
        <?php
        }
        ?>

        2==performance.navigation.type&&location.reload(!0),$(document).ready(function(){var e=$(window).innerHeight();$("body").css({height:e})}),$("#overall").click(function(){window.location.href="performance.php?appearance="+$("#appearance").val()}),$("#event").change(function(){""!=$("#event").val()?window.location.href="performance.php?event="+$("#event").val()+"&appearance="+$("#appearance").val():window.location.href="performance.php?appearance="+$("#appearance").val()}),$("#appearance").change(function(){"Radar Chart"==$("#appearance").val()?($(".star-row").prop("hidden",!0),$(".radar-row").removeAttr("hidden"),$(".title-row").addClass("justify-content-center")):"Stars"==$("#appearance").val()&&($(".radar-row").prop("hidden",!0),$(".star-row").removeAttr("hidden"),$(".title-row").removeClass("justify-content-center"))});function scrollSmoothTo(o){document.getElementById(o).scrollIntoView({block:"start",behavior:"smooth"})}

        <?php
        if (isset($_GET['event'])) {
        ?>
            $('select[name="event"]').val('<?= $_GET['event']; ?>');
        <?php
        }
        ?>

        <?php
        if (isset($_GET['appearance'])) {
            if ($_GET['appearance'] == 'Stars') {
        ?>
                $(".radar-row").prop("hidden", !0), $(".star-row").removeAttr("hidden"), $(".title-row").removeClass("justify-content-center");
            <?php
            } else if ($_GET['appearance'] == 'Radar Chart') {
            ?>
                $(".star-row").prop("hidden", !0), $(".radar-row").removeAttr("hidden"), $(".title-row").addClass("justify-content-center");
            <?php
            }
            ?>
            $('select[name="appearance"]').val('<?= $_GET['appearance']; ?>');
        <?php
        }
        ?>
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
        $(".container-menu").on('scroll', function() {
            AOS.refresh();
        });
    </script>
</body>

</html>