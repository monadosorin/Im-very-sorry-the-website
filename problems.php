<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'problems';
require_once './header.php';
?>

<style>
    body{background-color:#7c6ed1;height:100vh;width:100vw;overflow:hidden}.wrapper{height:calc(100vh - 80px);width:100vw}.container-menu{height:100%;position:relative;display:grid;align-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;padding-bottom:0!important}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}.bg-contactus{z-index:-1;position:absolute;object-fit:cover;height:100%}.menu{display:grid;place-items:center;grid-template-rows:50px auto;min-height:calc(100vh - 200px);position:relative;padding:35px}.bar{width:100%;height:100%;background-color:#fdcd5f;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#d67c57;left:0;height:100%;display:grid;place-items:center;width:50px;color:#fff;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red}.content-container{color:#3c6cb4}.problems-text{letter-spacing:5px;color:#3c6cb4;margin-bottom:0;grid-column:2}.colors{margin-top:-100px}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.colors{margin-top:0}.title{font-size:24pt!important}.contact{font-size:16pt!important}.menu{padding:20px}.menu{height:95%}}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#3c6cb4}.btn:hover{transition:.3s;background:#7c6ed1;color:#fff}
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
                    <h3 class="problems-text">Problems</h3>
                </div>
            </div>
            <div class="container-menu">
                <img class="bg-contactus" src="./assets/background/contactus.png" alt="Background - Problems" style="width: 100%;">
                <div class="content-container">
                    <div class="row justify-content-center mx-3 mt-5">
                        <h3 class="title label-question" style="font-size: 30pt;"><b>Any Questions, Problems, or Ideas?</b></h3>
                    </div>
                    <div class="row justify-content-center mx-3 mb-5">
                        <h3 style="text-align: center;" class="contact">
                            Contact R E A C H's Official LINE Account<br>
                            <center><a href="http://line.me/ti/p/~@140vntco" target="_blank" class="btn btn-success mt-3" style='width: 200px;'><b>Click Here</b></a></center>
                        </h3>
                    </div>
                    <div class="row justify-content-center mx-3 mb-5">
                        <h3 style="text-align: center;" class="contact">
                            Or Drop Your Thoughts Here<br>
                            <center><a href="./suggestions.php" class="btn btn-success mt-3" style='width: 200px;'><b>Click Here</b></a></center>
                        </h3>
                    </div>
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