<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'suggestions';
require_once './header.php';

if (isset($_GET['status'])) {
    if ($_GET['status'] == 0) {
        echo '<script>',
        'window.history.pushState("","","./suggestions.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/bye_5.gif",
				imageHeight: 150,
                title: "Captcha Gagal! Silakan Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    }
    if ($_GET['status'] == 1) {
        echo '<script>',
        'window.history.pushState("","","./suggestions.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_3.gif",
				imageHeight: 150,
                title: "Maksimal 1000 Karakter!",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    }
    if ($_GET['status'] == 2) {
        echo '<script>',
        'window.history.pushState("","","./suggestions.php");',
        '	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/server_error.gif",
				imageHeight: 150,
                title: "Terjadi Error di Server!<br>Silakan Coba Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
        '</script>';
    }
}
?>

<style>
    body{background-color:#7c6ed1;height:100vh;width:100vw;overflow:hidden}.wrapper{height:calc(100vh - 80px);width:100vw}.container-menu{height:100%;position:relative;display:grid;place-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;padding-bottom:0!important}.bg-contactus{z-index:-1;position:absolute;object-fit:cover;height:100%}.menu{display:grid;place-items:center;grid-template-rows:50px auto;min-height:calc(100vh - 200px);position:relative;padding:35px}.bar{width:100%;height:100%;background-color:#fdcd5f;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#d67c57;left:0;height:100%;display:grid;place-items:center;width:50px;color:#fff;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red}.content-container{color:#3c6cb4;width:60%}.problems-text{letter-spacing:5px;color:#3c6cb4;margin-bottom:0;grid-column:2}.colors{margin-top:-100px}#label-sugg{font-weight:700;font-size:24pt;text-align:center}.g-recaptcha>div{width:100%!important}.g-recaptcha>div>div{margin:4px auto!important;width:auto!important;height:auto!important}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.colors{margin-top:0}.title{font-size:24pt!important}.contact{font-size:16pt!important}.menu{padding:20px;height:95%}#label-sugg{font-size:18pt}.content-container{width:95%}}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;font-weight:700}.btn:hover{transition:.3s;background:#7c6ed1;color:#fff}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}
</style>

<body>
    <div class="wrapper">
        <div class="menu" data-aos="zoom-in">
            <div class="bar">
                <a href="problems.php" style="height: 100%; text-decoration: none;">
                    <div class="close-menu">
                        <i class="fas fa-times"></i>
                    </div>
                </a>
                <div>
                    <h3 class="problems-text">Suggestions</h3>
                </div>
            </div>
            <div class="container-menu">
                <img class="bg-contactus" src="./assets/background/contactus.png" alt="Background - Suggestions" style="width: 100%;">
                <div class="content-container">
                    <div class="justify-content-center mx-3 mt-4">
                        <form action="phps/submit_suggestions.php" method="post" enctype="multipart/form-data" id="form_suggestions">
                            <center><label for="suggestions" id="label-sugg">Drop Your Suggestions Here</label></center>
                            <textarea type="text" class="form-control" id="suggestions" name="suggestions" style="font-size: 12pt; text-align: center; color: #3C6CB4 !important; background-color: #EAD8C0;" rows="4" placeholder="Silakan berikan kritik atau saran Anda di kolom ini (maksimal 1000 karakter)" maxlength="1000" required></textarea>
                            <center>
                                <button class="g-recaptcha submit btn btn-warning mt-3 mb-5" data-sitekey="6LdukNYaAAAAAJwNQk4_DFZxIqKcQHCLIvxcMD86" data-callback='onSubmit' data-action='suggestion' style="width: 150px;">Submit</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-container">
            <img src="./assets/svg/footer.svg" alt="Footer" class="footer-svg">
        </div>
    </div>

    <script>
        function onSubmit(t){document.getElementById("form_suggestions").reportValidity()&&($(".submit").html("Submitting..."),document.getElementById("form_suggestions").submit())}
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