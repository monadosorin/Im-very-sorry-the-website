<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'choose_assessment';
require_once './header.php';
?>

<style>
    body{background-color:#7c6ed1;height:100vh;width:100vw;overflow:hidden}.wrapper{height:calc(100vh - 80px);width:100vw}.container-menu{height:100%;position:relative;display:grid;place-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;overflow-y:scroll!important;padding:0!important;margin-bottom:0!important;overflow-y:hidden}.menu{display:grid;place-items:center;grid-template-rows:50px auto;height:95%;position:relative;padding:35px;overflow-x:hidden}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}.bar{width:100%;height:100%;background-color:#d67c57;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#fdcd5f;left:0;height:100%;display:grid;place-items:center;width:50px;color:#3c6cb4;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red;color:#fff}.content-container{color:#3c6cb4;padding:50px;z-index:3}.assessment-text{letter-spacing:5px;color:#fff;margin-bottom:0;grid-column:2}.bg-assessment{top:0;z-index:1;position:relative;object-fit:cover}.bg-container{top:0;left:0;width:100%;position:absolute}label{color:#3c6cb4;font-weight:700}input,select,textarea{background:#d67c55!important;border:none!important;border-radius:10px!important;color:#fff!important}.container-menu::-webkit-scrollbar{width:15px}.container-menu::-webkit-scrollbar-track{background:#f9ead5}.container-menu::-webkit-scrollbar-thumb{background:#3c6cb4;border-right:8px #f9ead5 solid;border-top:10px #f9ead5 solid;border-bottom:10px #f9ead5 solid;background-clip:padding-box}.choose{font-size:16pt;width:500px}@media screen and (max-width:400px){.assessment-text{font-size:12pt}}.menu .container-menu{background-color:#f9ead5}.jconfirm-box-container .jconfirm-box{background-image:url(assets/background/details.png);background-size:cover;box-shadow:none!important}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.menu{padding:20px}.content-container{padding:15px}.assessment-text{font-size:14pt}.choose{font-size:12pt;width:100%}}.long-btn{display:grid;place-items:center}.btn{transition:.3s;border:none;-webkit-appearance:none}.choose:hover{transition:.3s;background:#7c6ed1!important;color:#fff}
</style>

<body>
    <div class="wrapper">
        <div class="menu" data-aos="zoom-in">
            <div class="bar">
                <a href="home.php" style="height: 100%; text-decoration: none;">
                    <div class="close-menu">
                        <i class="fas fa-times"></i>
                    </div>
                </a>
                <div>
                    <h3 class="assessment-text">Please Choose One</h3>
                </div>
            </div>
            <div class="container-menu justify-content-center">
                <div class="bg-container">
                    <img class="bg-assessment" src="./assets/background/assessment.png" alt="Background - Assessment" style="width: 100%;">
                </div>
                <div class="content-container justify-content-center">
                    <div class="col-12 long-btn">
                        <a href="give_assessment.php" class="btn btn-warning choose mb-3" style="border-radius: 25px; background-color: #D67C57; color: white; border: none;"><b>Berikan Penilaian untuk Panitia</b></a>
                    </div>
                    <div class="col-12 long-btn">
                        <a href="give_testimonial.php" class="btn btn-warning choose" style="border-radius: 25px; background-color: #fdcd5f;"><b>Berikan Testimoni untuk Panitia</b></a>
                    </div>
                    <p class="mt-4 mx-3" style="text-align: center;">Tombol berwarna <b>jingga</b> bersifat <b>wajib</b> sedangkan tombol berwarna <b>kuning</b> bersifat <b>opsional</b>.</p>
                    <?php
                                // var_dump(cekAnggotaBEM($_SESSION['nrp']));
                            if (cekAnggotaBEM($_SESSION['nrp'])) {
                            ?>
                        <hr class="my-5">

                        <?php
                                if (!cekMagangBEM($_SESSION['nrp'])) {
                        ?>
                            <div class="col-12 long-btn">
                                <a href="give_assessment_bem.php" class="btn btn-warning choose mb-3" style="border-radius: 25px; background-color: #D67C57; color: white; border: none;"><b>Berikan Penilaian untuk Fungsionaris BEM</b></a>
                            </div>
                        <?php
                                }
                                if (cekKetuaUKMBEM($_SESSION['nrp']) || cekPICBEM($_SESSION['nrp']) || cekMagangBEM($_SESSION['nrp'])) {
                                    if (cekKetuaUKMBEM($_SESSION['nrp']) || cekMagangBEM($_SESSION['nrp'])) {
                                        $subject = 'Fungsionaris BEM';
                                        if (cekKetuaUKMBEM($_SESSION['nrp'])) {
                                            $status = 'ukm';
                                        } else {
                                            $status = 'magang';
                                        }
                                    } else {
                                        $subject = 'Ketua UKM';
                                        $status = 'ukm';
                                    }
                        ?>
                            <!-- <div class="col-12 long-btn">
                                <a href="give_testimonial_bem.php?id=<?= $status ?>" class="btn btn-warning choose mb-3" style="border-radius: 25px; background-color: #3B6CB4; color: white; border: none;"><b>Berikan Testimoni untuk <?= $subject ?></b></a>
                            </div> -->
                        <?php
                                }
                        ?>
                        <div class="col-12 long-btn">
                            <a href="give_testimonial_bem.php" class="btn btn-warning choose" style="border-radius: 25px; background-color: #fdcd5f;"><b>Berikan Testimoni untuk Fungsionaris BEM</b></a>
                        </div>
                        <?php
                                if (cekKetuaUKMBEM($_SESSION['nrp']) || cekMagangBEM($_SESSION['nrp'])) {
                        ?>
                            <p class="mt-4 mx-3" style="text-align: center;">Tombol berwarna <b>kuning</b> bersifat <b>wajib</b>.</p>
                        <?php
                                } else if (cekPICBEM($_SESSION['nrp'])) {
                        ?>
                            <p class="mt-4 mx-3" style="text-align: center;">Tombol berwarna <b>jingga</b> dan <b>biru</b> bersifat <b>wajib</b> sedangkan tombol berwarna <b>kuning</b> bersifat <b>opsional</b>.</p>
                        <?php
                                } else {
                        ?>
                            <p class="mt-4 mx-3" style="text-align: center;">Tombol berwarna <b>jingga</b> bersifat <b>wajib</b> sedangkan tombol berwarna <b>kuning</b> bersifat <b>opsional</b>.</p>
                    <?php
                                }
                            }
                    ?>
                </div>
            </div>
        </div>
        <div class="footer-container">
            <img src="./assets/svg/footer.svg" alt="Footer" class="footer-svg">
        </div>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
		AOS.init();
        $(".container-menu").on('scroll', function() {
			AOS.refresh();
        });
	</script>
</body>

</html>