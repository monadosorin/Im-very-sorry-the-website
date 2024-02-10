<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'home';
require_once './header.php';

if (isset($_GET['status'])) {
	if ($_GET['status'] == 0) {
		echo '<script>',
		'window.history.pushState("","","./home.php");',
		'	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/server_error.gif",
				imageHeight: 150,
                title: "Terjadi Error di Server!<br>Silakan Coba Ulangi Kembali",
                showConfirmButton: false,
                timer: 2000
                })',
		'</script>';
	} else if ($_GET['status'] == 1) {
		echo '<script>',
		'window.history.pushState("","","./home.php");',
		'	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/success_1.gif",
				imageHeight: 150,
                title: "Sukses Menyimpan CV!",
                showConfirmButton: false,
                timer: 2000
                })',
		'</script>';
	} else if ($_GET['status'] == 2) {
		echo '<script>',
		'window.history.pushState("","","./home.php");',
		'	Swal.fire({
                position: "center",
                imageUrl: "' . randomWelcomeEmoji() . '",
				imageHeight: 150,
                title: "Selamat Datang!",
                showConfirmButton: false,
                timer: 2000
                })',
		'</script>';
	} else if ($_GET['status'] == 3) {
		echo '<script>',
		'window.history.pushState("","","./home.php");',
		'	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/thankyou.gif",
				imageHeight: 150,
                title: "Terima Kasih!",
                showConfirmButton: false,
                timer: 2000
                })',
		'</script>';
	} else if ($_GET['status'] == 4) {
		echo '<script>',
		'window.history.pushState("","","./home.php");',
		'	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_1.gif",
				imageHeight: 150,
                title: "Invalid URL Parameter!",
                showConfirmButton: false,
                timer: 2000
                })',
		'</script>';
	} else if ($_GET['status'] == 5) {
		echo '<script>',
		'window.history.pushState("","","./home.php");',
		'	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_1.gif",
				imageHeight: 150,
                title: "Minimal 4 Karakter!",
                showConfirmButton: false,
                timer: 2000
                })',
		'</script>';
	} else if ($_GET['status'] == 6) {
		echo '<script>',
		'window.history.pushState("","","./home.php");',
		'	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_2.gif",
				imageHeight: 150,
                title: "Don\'t Play-Play Bosque!",
                showConfirmButton: false,
                timer: 2000
                })',
		'</script>';
	} else if ($_GET['status'] == 7) {
		echo '<script>',
		'window.history.pushState("","","./home.php");',
		'	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/invalid_2.gif",
				imageHeight: 150,
                title: "Don\'t Modify the URL!",
                showConfirmButton: false,
                timer: 2000
                })',
		'</script>';
	} else if ($_GET['status'] == 69420) {
		echo '<script>',
		'window.history.pushState("","","./home.php");',
		'	Swal.fire({
                position: "center",
                imageUrl: "./assets/gif/pensiun.gif",
				imageHeight: 150,
                title: `<a style="outline: 0px!important;cursor: pointer!important;text-decoration: none!important;color: unset!important;" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Anaknya Udah Pensiun</a>`,
                showConfirmButton: false,
                timer: 2000
                })',
		'</script>';
	}
}

// $nrp = $_SESSION['nrp'];

// $cekFungsionarissql = "SELECT * FROM bem_fungsionaris_2023 WHERE nrp = ?";
// $cekFungsionarisstmt = $pdo->prepare($cekFungsionarissql);
// $cekFungsionarisstmt->execute([$nrp]);
// var_dump($cekFungsionarisstmt->fetch());
?>

<style>
	.menu-title-text,
	.problems-text {
		margin-bottom: 0
	}

	.menu-text,
	.menu-title-text,
	.problems-text {
		letter-spacing: 5px;
		color: #3c6cb4
	}

	.container,
	.row {
		margin-right: 0 !important;
		margin-left: 0 !important
	}

	.link-how-to,
	.link-how-to:hover {
		text-decoration: none
	}

	.about-container:hover .about-text,
	.assessment-container:hover .assessment-text,
	.link-how-to,
	.problems-container:hover .problems-text {
		font-weight: 700
	}

	body {
		height: 100vh;
		width: 100vw;
		overflow: hidden;
		background-color: #7c6ed1
	}

	.wrapper {
		display: grid;
		align-items: center;
		height: calc(100vh - 80px);
		position: absolute;
		bottom: 0;
		width: 100vw;
		grid-template-rows: 60% 30% 10%
	}

	.bar,
	.bg-home,
	.close-menu,
	.container,
	.menu {
		height: 100%
	}

	.container {
		position: relative;
		display: grid;
		place-items: center;
		width: 100%;
		max-width: unset !important
	}

	.bg-home {
		z-index: -1;
		position: absolute;
		object-fit: cover
	}

	.bar,
	.menu,
	.subdiv-parent {
		position: relative;
		display: grid;
		place-items: center
	}

	.menu {
		grid-template-rows: 50px auto;
		width: 400px
	}

	.bar {
		width: 100%;
		background-color: #fdcd5f;
		grid-template-columns: 50px auto
	}

	.close-menu {
		background-color: #d4b646;
		left: 0;
		display: grid;
		place-items: center;
		width: 50px;
		color: #3c6cb4;
		font-size: 24pt;
		grid-column: 1
	}

	.content-container {
		color: #3c6cb4
	}

	.problems-text {
		grid-column: 2
	}

	.board {
		max-width: 700px
	}

	.subdiv-parent {
		width: 700px;
		margin-top: 120px
	}

	.about,
	.assessment,
	.problems {
		width: 120px;
		height: calc(100vh - calc(100vh - 100%))
	}

	.about-container,
	.assessment-container,
	.problems-container {
		position: absolute;
		width: 150px;
		transition: .3s
	}

	.about-container {
		left: 115px;
		top: -82px
	}

	.about-container:hover,
	.assessment-container:hover,
	.problems-container:hover {
		transform: scale(1.1);
		transition: .3s
	}

	.problems-container {
		left: 270px;
		top: -95px
	}

	.assessment-container {
		left: 425px;
		top: -116px
	}

	.menu-text {
		text-align: center;
		margin-top: 2px;
		font-size: 14pt
	}

	.menu-parent {
		position: relative;
		width: 400px;
		height: 300px;
		box-shadow: 17px 17px #594f8b;
		transition: .3s
	}

	.footer-svg,
	.new {
		width: 200px
	}

	.menu-parent:hover {
		transition: .3s;
		transform: scale(1.05)
	}

	.new {
		position: absolute;
		left: 300px;
		top: 10px
	}

	.footer-container {
		display: grid;
		place-items: center
	}

	@media screen and (max-width:768px) {
		.board {
			width: 300px;
			height: 45px
		}

		.about,
		.about-container,
		.assessment,
		.assessment-container,
		.problems,
		.problems-container {
			width: 40px
		}

		.about-container {
			left: 45px;
			top: -23px
		}

		.problems-container {
			left: 130px;
			top: -27px
		}

		.assessment-container {
			left: 215px;
			top: -34px
		}

		.menu,
		.menu-parent {
			width: 250px;
			height: 300px
		}

		.subdiv-parent {
			width: 300px;
			margin-top: 0
		}

		.new {
			width: 100px;
			left: 200px;
			top: 30px
		}

		.menu-text {
			font-size: 10pt;
			margin-top: 1px;
			letter-spacing: 1px
		}
	}

	@media screen and (max-height:750px) {
		@media (orientation:landscape) {
			.menu-parent {
				height: 250px
			}
		}
	}

	@media screen and (max-width:1366px) {
		@media (orientation:portrait) {
			.wrapper {
				padding-top: 17% !important
			}
		}

		@supports (-webkit-touch-callout:none) {
			@media (orientation:landscape) {
				.wrapper {
					padding-top: 5% !important
				}
			}
		}
	}

	#my-best-friend-cool-website-svg {
		position: fixed;
		bottom: 30px;
		left: 30px;
		width: 100px
	}

	#how-to-svg,
	.how-to-clickable {
		position: fixed;
		bottom: 15px;
		right: 15px;
		width: 90px
	}

	.swal2-container {
		z-index: 100000000000000
	}

	.btn-red {
		border-radius: 25px !important
	}

	.how-to-clickable {
		height: 90px;
		cursor: pointer
	}

	.jconfirm-content {
		max-height: 50vh;
		padding: 15px
	}

	@media screen and (max-width:768px) {
		.menu-title-text {
			font-size: 16pt
		}

		@supports (-webkit-touch-callout:none) {
			.wrapper {
				padding-top: 25% !important
			}
		}

		#my-best-friend-cool-website-svg {
			visibility: hidden
		}

		#how-to-svg,
		.how-to-clickable {
			bottom: 10px;
			right: 10px;
			width: 70px
		}

		.how-to-clickable {
			height: 70px
		}
	}

	.accordion-body {
		padding: 15px
	}

	.container {
		padding-left: 0 !important;
		padding-right: 0 !important
	}

	.link-how-to {
		color: #3c6cb4
	}

	.jconfirm.jconfirm-modern .jconfirm-box div.jconfirm-title-c {
		padding-bottom: 0 !important
	}

	.faq-container {
		padding: 50px 200px
	}

	.faq-drawer {
		margin-bottom: 30px
	}

	.faq-drawer__content-wrapper {
		font-size: 14pt;
		line-height: 1.4em;
		max-height: 0;
		overflow: hidden;
		transition: .25s ease-in-out
	}

	.faq-drawer__content {
		color: #3c6cb4;
		margin-top: 10px
	}

	.faq-drawer__title {
		border-top: 1px solid #c55d50;
		cursor: pointer;
		display: block;
		font-size: 14pt;
		font-weight: 700;
		padding: 30px 0 0;
		position: relative;
		margin-bottom: 0;
		transition: .25s ease-out;
		color: #3c6cb4
	}

	.faq-drawer__title::after {
		border-style: solid;
		border-width: 1px 1px 0 0;
		content: " ";
		display: inline-block;
		float: right;
		height: 10px;
		left: 2px;
		position: relative;
		right: 20px;
		top: 2px;
		transform: rotate(135deg);
		transition: .35s ease-in-out;
		width: 10px
	}

	.faq-drawer__trigger:checked+.faq-drawer__title+.faq-drawer__content-wrapper {
		max-height: 1500px
	}

	.faq-drawer__trigger:checked+.faq-drawer__title::after {
		transform: rotate(-45deg);
		transition: .25s ease-in-out
	}

	input[type=checkbox] {
		display: none
	}

	.jconfirm-content::-webkit-scrollbar {
		width: 8px;
		border-radius: 10px
	}

	.jconfirm-content::-webkit-scrollbar-track {
		background: #c55d50
	}

	.jconfirm-content::-webkit-scrollbar-thumb {
		background: padding-box #fdcd5f
	}

	/* .event-card{content:url(assets/image/bsb-mobile.png)} */
</style>

<body>
	<div class="wrapper">
		<img class="bg-home" src="./assets/background/home.png" alt="Background - Home" style="width: 100%;">
		<div class="menu-grand-parent row justify-content-center" data-aos="zoom-in">
			<div class="menu-parent">
				<!-- <a href="http://bem.petra.ac.id/work/event" style="text-decoration: none;" target="_blank"> -->
				<a href="https://www.instagram.com/bempetra/" style="text-decoration: none;" target="_blank">
					<div class="menu">
						<div class="bar">
							<div class="close-menu">
								<i class="fas fa-times"></i>
							</div>
							<div>
								<!-- <h3 class="menu-title-text">Events</h3> -->
								<h3 class="menu-title-text">#SATU 23/24</h3>
							</div>
						</div>
						<div class="container">
							<!-- <img class="bg-home" src="./assets/background/horses.png" alt="Events" style="width: 100%;"> -->
							<img class="bg-home event-card" src="./assets/image/2122.jpg" alt="BEM 21/22" style="width: 100%;">
						</div>
					</div>
					<img src="./assets/image/new.png" alt="NEW" class="new">
				</a>
			</div>
		</div>
		<div class="parent-menu row justify-content-center" data-aos="fade-up">
			<div class="subdiv-parent">
				<a href="./about.php">
					<div class="row justify-content-center about-container">
						<img src="./assets/image/about.png" alt="About" class="about">
						<h3 class="menu-text about-text">About</h3>
					</div>
				</a>
				<a href="./problems.php">
					<div class="row justify-content-center problems-container">
						<img src="./assets/image/problems.png" alt="Problems" class="problems">
						<h3 class="menu-text problems-text">Problems</h3>
					</div>
				</a>
				<a href="./choose_assessment.php">
					<div class="row justify-content-center assessment-container">
						<img src="./assets/image/assessment.png" alt="Assessment" class="assessment">
						<h3 class="menu-text assessment-text">Assessment</h3>
					</div>
				</a>
				<img src="./assets/image/board.png" alt="Board" class="board">
			</div>
		</div>
		<div class="footer-container">
			<img src="./assets/svg/footer.svg" alt="Footer" class="footer-svg">
		</div>
		<div class="my-best-friend-cool-website-container">
			<a href="http://bem.petra.ac.id/store/" target="_blank">
				<img src="./assets/svg/bempetrastore_animated.svg" alt="BEM Petra Store" data-bs-toggle='tooltip' data-bs-placement='left' title='Check this out!' id="my-best-friend-cool-website-svg">
			</a>
		</div>
		<object type="image/svg+xml" data="./assets/svg/how_to.svg" alt="How to" id="how-to-svg"></object>
		<div class="how-to-clickable" data-bs-toggle='tooltip' data-bs-placement='top' title='Bingung, ya?' onclick="howTo()"></div>
	</div>

	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	<script>
		<?php
		if ($rowMahasiswa['status'] == 0) {
		?>

			function firstTime() {
				$.confirm({
					title: '<span style="color: #3C6CB4;">Hello, Petranesian! 👋</span>',
					typeAnimated: !0,
					theme: "modern",
					draggable: !1,
					columnClass: "col-md-8",
					buttons: {
						cancel: {
							text: "OKE",
							btnClass: "btn-red"
						}
					},
					content: '<div class="mb-3" style="text-transform: none; color: #3C6CB4; font-size: 14pt; max-height: 300px;">Sepertinya #KAMU belum mengisi Curriculum Vitae, nih... Jika ini merupakan saat pertamamu login di platform <b>RE-ACH</b>, silakan mengisi Curriculum Vitae #KAMU terlebih dahulu pada halaman <a href="./profile.php" target="_blank" style="text-decoration:none;color: #3C6CB4;font-weight:bold;">Profile</a> sebelum melakukan penilaian panitia (apabila ada) dan menggunakan berbagai fitur menarik pada platform <b>RE-ACH</b>.\n\t\t\t\t<br>\n\t\t\t\t<br>\n\t\t\t\tMelalui <b>RE-ACH</b>, kamu dapat melihat lebih dari <b><?= intval(getPetranesiansHitzCount() / 10) * 10 ?></b> profil Petranesians lain yang sudah terhubung di platform ini. Jadi, tunggu apalagi? Yuk, segera isi CV-mu di halaman <a href="./profile.php" target="_blank" style="text-decoration:none;color: #3C6CB4;font-weight:bold;">Profile</a> yah, Petranesian! 🙌</div>'
				})
			}
			firstTime();
		<?php
		}
		?>

		function howTo() {
			$.confirm({
				title: '<span style="color: #3C6CB4;">Bingung, ya?</span>',
				typeAnimated: !0,
				theme: "material",
				draggable: !1,
				columnClass: "col-md-8",
				buttons: {
					cancel: {
						text: "OKE PAHAM",
						btnClass: "btn-red"
					}
				},
				content: '\n\t\t\t\t\t<div style="text-transform: none; color: #3C6CB4; font-size: 14pt; text-align: center;"> \n                        <p>\n\t\t\t\t\t\t\tSelamat datang di <b>RE-ACH</b>, Petranesian! Lagi bingung, ya? Jangan khawatir! Klik saja salah satu tombol di bawah ini, siapa tahu bisa menjawab gimana caranya jadi <b>Petranesian HITZ</b> lewat <b>RE-ACH</b>. 😎\n                        </p>\n                    \n\t\t\t\t\t\t<div>\n\t\t\t\t\t\t\t<div class="faq-drawer mt-4">\n\t\t\t\t\t\t\t\t<input class="faq-drawer__trigger" id="faq-drawer" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer">Harus ngapain dulu, ya?</label>\n\t\t\t\t\t\t\t\t<div class="faq-drawer__content-wrapper">\n\t\t\t\t\t\t\t\t\t<div class="faq-drawer__content">\n\t\t\t\t\t\t\t\t\t\t<p>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<a class="link-how-to" href="./profile.php" target="_blank">\n\t\t\t\t\t\t\t\t\t\t\t\t<img src="./assets/image/profile_pointer.png" alt="" width="500px">\n\t\t\t\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\tPertama-tama, isi terlebih dahulu <b>CV-mu</b> pada halaman <a class="link-how-to" href="./profile.php" target="_blank">Profile</a>. Dengan mengisi data ini, nantinya Petranesians lain akan bisa melihat profil dan kinerjamu selama berpanitia di UKP, loh! \n\t\t\t\t\t\t\t\t\t\t\tFYI, banyak fitur menarik di <b>RE-ACH</b> yang hanya akan terbuka setelah Petranesian mengisi <b>CV</b>!\n\t\t\t\t\t\t\t\t\t\t</p>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\n\t\t\t\t\t\t\t<div class="faq-drawer mt-4">\n\t\t\t\t\t\t\t\t<input class="faq-drawer__trigger" id="faq-drawer2" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer2">Bagaimana caranya melakukan penilaian panitia?</label>\n\t\t\t\t\t\t\t\t<div class="faq-drawer__content-wrapper">\n\t\t\t\t\t\t\t\t\t<div class="faq-drawer__content">\n\t\t\t\t\t\t\t\t\t\t<p>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<a class="link-how-to" href="./choose_assessment.php" target="_blank">\n\t\t\t\t\t\t\t\t\t\t\t\t<img src="./assets/image/assessment_pointer.png" alt="" width="500px">\n\t\t\t\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\tJika Petranesian sudah terdaftar dalam sebuah kepanitiaan, Petranesian bisa masuk ke halaman <a class="link-how-to" href="./choose_assessment.php" target="_blank">Assessment</a> untuk memberikan <b>penilaian</b> terhadap kinerja teman-teman sepanitia Petranesian loh! Caranya mudah:\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<ol style="text-align: justify;">\n\t\t\t\t\t\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t\t\t\t\t\tKlik tombol <b>‘Berikan Penilaian untuk Panitia’</b> (bersifat <b>wajib</b>) untuk menilai panitia yang bekerja langsung denganmu!\n\t\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t\t\t\t\t\tBerikan penilaian untuk setiap panitia berdasarkan <b>kriteria</b> yang telah ditentukan!\n\t\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t\t\t\t\t\tJangan lupa juga memberikan <b>testimoni</b> selama bekerja dengan panitia tersebut beserta <b>kritik dan saran yang membangun</b> melalui kolom <b>‘Testimoni’</b>!  \n\t\t\t\t\t\t\t\t\t\t\t\t\t<b>Catatan:</b> Testimoni yang masuk akan bersifat <b>anonim</b>, namun tetap <b>perhatikan kesopanan</b> dalam berkomentar ya, teman-teman!\n\t\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t\t\t\t\t\tSetelah selesai, klik tombol <b>‘Submit Assessment’</b> untuk menyimpan penilaian dan testimoni, lalu ulangi proses yang sama untuk menilai panitia-panitia lainnya.\n\t\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t\t\t\t\t\tUntuk memberikan testimoni untuk panitia selain yang berada di daftar penilaian wajibmu, klik tombol <b>‘Berikan Testimoni untuk Panitia’</b>! (bersifat <b>opsional</b>)\n\t\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t\t\t\t\t\tSetelah menyelesaikan penilaian, jangan lupa juga untuk memberikan <b>kritik dan saranmu</b> untuk <b>RE-ACH</b>!\n\t\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t\t</ol>\n\t\t\t\t\t\t\t\t\t\t</p>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\n\t\t\t\t\t\t\t<div class="faq-drawer mt-4">\n\t\t\t\t\t\t\t\t<input class="faq-drawer__trigger" id="faq-drawer3" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer3">Bagaimana caranya melihat rata-rata nilai yang sudah kita miliki selama berpanitia?</label>\n\t\t\t\t\t\t\t\t<div class="faq-drawer__content-wrapper">\n\t\t\t\t\t\t\t\t\t<div class="faq-drawer__content">\n\t\t\t\t\t\t\t\t\t\t<p>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<a class="link-how-to" href="./performance.php" target="_blank">\n\t\t\t\t\t\t\t\t\t\t\t\t<img src="./assets/image/performance_pointer.png" alt="" width="500px">\n\t\t\t\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\tKlik menu <a class="link-how-to" href="./performance.php" target="_blank">Performance</a> untuk melihat hasil <b>rata-rata penilaian dan testimoni</b> Petranesians lain terhadap kinerja Petranesian di kepanitiaan-kepanitiaan Petranesian sebelumnya! \n\t\t\t\t\t\t\t\t\t\t</p>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\n\t\t\t\t\t\t\t<div class="faq-drawer mt-4">\n\t\t\t\t\t\t\t\t<input class="faq-drawer__trigger" id="faq-drawer4" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer4">Pengen kepoin Petranesians lain, nih!</label>\n\t\t\t\t\t\t\t\t<div class="faq-drawer__content-wrapper">\n\t\t\t\t\t\t\t\t\t<div class="faq-drawer__content">\n\t\t\t\t\t\t\t\t\t\t<p>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<a class="link-how-to" href="./explore.php" target="_blank">\n\t\t\t\t\t\t\t\t\t\t\t\t<img src="./assets/image/explore_pointer.png" alt="" width="500px">\n\t\t\t\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\tPada halaman <a class="link-how-to" href="./explore.php" target="_blank">Explore</a>, Petranesian bisa melihat <b>lebih dari <?= intval(getPetranesiansHitzCount() / 10) * 10 ?></b> profil, penilaian, dan kinerja dari semua Petranesians yang sudah terhubung di <b>RE-ACH</b>! Eits, tapi tunggu dulu.. sebelum bisa mengakses halaman <a class="link-how-to" href="./explore.php" target="_blank">Explore</a>, Petranesian <b>wajib mengisi CV</b> terlebih dahulu pada halaman <a class="link-how-to" href="./profile.php" target="_blank">Profile</a>, ya!\n\t\t\t\t\t\t\t\t\t\t</p>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\n\t\t\t\t\t\t\t<div class="faq-drawer mt-4">\n\t\t\t\t\t\t\t\t<input class="faq-drawer__trigger" id="faq-drawer5" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer5">Masih punya banyak pertanyaan?</label>\n\t\t\t\t\t\t\t\t<div class="faq-drawer__content-wrapper">\n\t\t\t\t\t\t\t\t\t<div class="faq-drawer__content">\n\t\t\t\t\t\t\t\t\t\t<p>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<a class="link-how-to" href="./faq.php" target="_blank">\n\t\t\t\t\t\t\t\t\t\t\t\t<img src="./assets/image/faq_pointer.png" alt="" width="500px">\n\t\t\t\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t\t\t\tBuat Petranesian yang masih punya banyak pertanyaan lanjutan, langsung aja cek halaman <a class="link-how-to" href="./faq.php" target="_blank">FAQ</a>! Di sana ada banyak <b>pertanyaan-pertanyaan yang sering diajukan</b> oleh Petranesians lain yang mungkin juga bisa menjawab pertanyaanmu, loh! Tetapi, jika Petranesian punya pertanyaan selain yang sudah tercantum di <a class="link-how-to" href="./faq.php" target="_blank">FAQ</a>, Petranesian bisa <b>tanyakan</b> pada halaman <a class="link-how-to" href="./problems.php" target="_blank">Problems</a>!\n\t\t\t\t\t\t\t\t\t\t</p>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n        \t\t\t </div>\n\t\t\t\t'
			})
		}
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')),
			tooltipList = tooltipTriggerList.map(function(t) {
				return new bootstrap.Tooltip(t)
			});
		AOS.init();
	</script>
</body>

</html>