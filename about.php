<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'about';
include './header.php';
?>

<style>
    body{background-color:#7c6ed1;height:100vh;width:100vw}.wrapper{height:calc(100vh - 80px);width:100vw}.container-menu{height:100%;position:relative;display:grid;place-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;overflow-y:scroll;padding:0!important;margin-bottom:0!important}.menu .container-menu{background-color:#95cee4;overflow-x:hidden}.menu{display:grid;place-items:center;grid-template-rows:50px auto;height:95%;position:relative;padding:35px;overflow-x:hidden}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}.bar{width:100%;height:100%;background-color:#fdcd5f;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#d67c57;left:0;height:100%;display:grid;place-items:center;width:50px;color:#fff;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red}.content-container{color:#3c6cb4;z-index:2;padding:50px}.bg-aboutus{top:0;z-index:1;position:relative;object-fit:cover}.aboutus-text{letter-spacing:5px;color:#3c6cb4;margin-bottom:0;grid-column:2}.bg-mobile{display:none}@media screen and (max-width:767px){.bg-mobile{display:block}}.bg-container{top:0;left:0;width:100%;position:absolute}.abbreviation img{height:calc(100vh - calc(100vh - 100%))}.re-img{height:calc(100vh - calc(100vh - 100%))}@media screen and (max-width:992px){.abbreviation img{width:90%;height:auto}}.content{text-align:justify}.reach-title{font-size:52pt;text-align:center}.ukpetra_bem{width:350px}.dept-logo{width:50px}.reach-flower-title{width:43px;margin-top:-16px}.why-text{letter-spacing:3.5px;font-size:70pt;font-weight:700}.reach-text{font-size:42pt;margin-top:-20px}.flower-text{width:35px;margin-top:-13px}.re-mobile{display:none}.question-mark{color:#fbead6;font-size:135.5pt;font-weight:700;position:absolute;top:-46px;left:290px}.tutorial{width:90%;height:500px}#captcha-text{text-align:center}@media screen and (max-width:768px){#captcha-text{font-size:10pt}.tutorial{height:300px}.aboutus-text{text-align:center}.content-container{padding:20px;padding-top:40px}.content{text-align:center;font-size:15pt}.reach-title{font-size:33pt}.ukpetra_bem{width:215px}.reach-flower-title{width:23px;margin-top:-10px}.why-reach{display:grid;place-items:center}.why-text{font-size:52pt}.reach-text{font-size:33pt}.flower-text{width:20px;margin-top:-8px}.re-mobile{display:block}.abbreviation{display:none}.re-img{width:220px;margin-top:10px}.question-mark{display:none}.menu{padding:20px}}.container-menu::-webkit-scrollbar{width:15px}.container-menu::-webkit-scrollbar-track{background:#95cee4}.container-menu::-webkit-scrollbar-thumb{background:#3c6cb4;border-right:8px #95cee4 solid;border-top:10px #95cee4 solid;border-bottom:10px #95cee4 solid;background-clip:padding-box}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.menu{padding:20px}}.why-reach{position:relative}
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
					<h3 class="aboutus-text">About</h3>
				</div>
			</div>
			<div class="container-menu">
				<div class="bg-container">
					<img class="bg-aboutus" src="./assets/background/about_alt.png" alt="Background - About" style="width: 100%;">
					<div class="bg-mobile">
						<img class="bg-profile" src="./assets/background/performance.png" alt="Background - About" style="width: 100%;">
						<img class="bg-profile" src="./assets/background/performance.png" alt="Background - About" style="width: 100%;">
					</div>
				</div>

				<div class="content-container">
					<div class="row">
						<div class="col-12 title-row mb-4">
							<h1 class="reach-title">R E <img src="./assets/svg/bunga.svg" class="reach-flower-title"> A C H</h1>
							<center>
								<a href="http://bem.petra.ac.id/" target="_blank">
									<img class="ukpetra_bem" src="./assets/image/ukpetra_bem.png" alt="UK Petra - BEM">
								</a>
							</center>
						</div>
					</div>

					<div class="row justify-content-center my-5 abbreviation">
						<img src="./assets/svg/singkatan.svg" alt="Re-Authorization, Re-Cognition, Re-Hire" style="width: 90%;">
					</div>

					<div class="re-mobile">
						<center>
							<img src="./assets/image/reauthorization.png" class="re-img" alt="Re-Authorization"><br>
							<img src="./assets/image/recognition.png" class="re-img" alt="Re-Cognition"><br>
							<img src="./assets/image/rehire.png" class="re-img" alt="Re-Hire">
						</center>
					</div>

					<div class="mt-5">
						<h3 class="content mt-5">
							<b>RE-ACH</b> merupakan sebuah <i>platform</i> untuk mencatat <b>performa kerja</b> Mahasiswa/i Universitas Kristen Petra di dalam kepanitiaan, di mana BEM UK Petra berharap <b>RE-ACH</b> dapat membantu proses pemilihan kepanitiaan ke depannya.
						</h3>
					</div>

					<div class="why-reach mt-4">
						<h3 class="why-text mt-3">
							<span style="color: green;">W</span>
							<span style="color: #cc6516;">H</span>
							<span>Y</span>
						</h3>
						<span class="question-mark">?</span>
						<h1 class="reach-text">R E <img src="./assets/svg/bunga.svg" class="flower-text"> A C H</h1>
					</div>

					<div>
						<h3 class="content mt-3 mb-5">
							Saat pertama kali Petranesians melengkapi <b>Curriculum Vittae (CV)</b>, tentu data yang digunakan adalah data yang resmi <b>(authorized)</b> dan sudah disetujui untuk dipublikasikan. Lalu, ketika Petranesians mendaftar dalam kepanitiaan, CV tersebut akan diterima dan dikenali <b>(recognized)</b> oleh pihak kegiatan yang selanjutnya akan terpilih beberapa Petranesians untuk dipekerjakan <b>(hired)</b> dan memiliki kesempatan untuk melayani di kegiatan tersebut. Setelah melayani di kegiatan tersebut, Petranesians dapat menambahkan pengalaman pada Curriculum Vittae (CV) masing-masing sehingga proses <b>RE-ACH</b> akan berjalan terus-menerus.
						</h3>
					</div>

					<div style="display: grid; place-items: center;" class="mb-5">
						<h3 style="font-weight: bold; letter-spacing: 5px; color: #CC6516; text-align: center;">Watch the Tutorial</h3>
						<iframe class="tutorial" src="https://www.youtube.com/embed/pkJAJ2kEwno" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen data-aos="flip-up"></iframe>
					</div>

					<center class="mb-5">
						<img class="dept-logo" src="./assets/image/HRD.png" alt="HRD">
						<img class="dept-logo" src="./assets/image/IS.png" alt="IS">
						<img class="dept-logo" src="./assets/image/SNC.png" alt="SNC">
					</center>

					<p id="captcha-text" class="mt-5 mb-3 mx-2">
						REACH is protected by reCAPTCHA and the Google
						<a href="https://policies.google.com/privacy" style="text-decoration: none;">Privacy Policy</a> and
						<a href="https://policies.google.com/terms" style="text-decoration: none;">Terms of Service</a> apply.<br>
						<a href="https://youtu.be/lUTvB1O8eEg" target="_blank" style="text-decoration: none">What is reCAPTCHA used for?</a>
					</p>
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