<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'view_profile';
require_once './header.php';

$getMahasiswarow = getDataCV(sanitizeString($_GET['nrp']));
$rowAVGPerformance = getAveragePerformance(sanitizeString($_GET['nrp']));
$fakultasJurusan = explode(" - ", $getMahasiswarow['jurusan'], 2);
$fakultasStr = $fakultasJurusan[0];
$jurusanStr = $fakultasJurusan[1];
?>

<head>
	<title>
		<?php
		if ($getMahasiswarow['status'] == 0) {
		?>
			REACH – 404 NOT FOUND
		<?php
		} else {
		?>
			REACH – <?= sanitizeString($getMahasiswarow['nama']) ?>
		<?php
		}
		?>
	</title>
</head>

<style>
	body{background-color:#7c6ed1;height:100vh;width:100vw;overflow:hidden}.wrapper{height:calc(100vh - 80px);width:100vw}.container-menu{overflow-x:hidden;scroll-behavior:smooth;height:100%;position:relative;display:grid;place-items:center;margin-right:0!important;margin-left:0!important;width:100%;max-width:unset!important;overflow-y:scroll;padding:0!important;margin-bottom:0!important}.menu .container-menu{background-color:#95cee4}.menu{display:grid;place-items:center;grid-template-rows:50px auto;height:95%;position:relative;padding:35px;overflow-x:hidden}.footer-container{display:grid;place-items:center}.footer-svg{width:200px}.bar{width:100%;height:100%;background-color:#d67c57;display:grid;place-items:center;position:relative;grid-template-columns:50px auto}.close-menu{background-color:#fdcd5f;left:0;height:100%;display:grid;place-items:center;width:50px;color:#3c6cb4;font-size:24pt;grid-column:1;transition:.5s}.close-menu:hover{transition:.5s;background-color:red;color:#fff}.content-container{color:#3c6cb4;width:100%}.vp-text{letter-spacing:5px;color:#fdcd5f;margin-bottom:0;grid-column:2}.bg-profile{z-index:0;position:absolute;object-fit:cover;height:100vh}label{color:#fff}input,select,textarea{border:none!important;border-radius:10px!important;color:#fff!important}::-webkit-scrollbar{width:8px;border-radius:10px}::-webkit-scrollbar-track{background:#c55d50}::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}.container-menu::-webkit-scrollbar{width:15px}.container-menu::-webkit-scrollbar-track{background:#95cee4}.container-menu::-webkit-scrollbar-thumb{background:#3c6cb4;border-right:8px #95cee4 solid;border-top:10px #95cee4 solid;border-bottom:10px #95cee4 solid;background-clip:padding-box}.image-container{position:relative;width:100%;padding-top:20%}#profile-pic{transition:.5s;position:absolute;top:0;left:0;vertical-align:middle;width:100%;height:100%;object-fit:contain;-webkit-filter:drop-shadow(5px 5px 5px #222);filter:drop-shadow(5px 5px 5px #222)}#profile-pic:hover{transition:.5s;transform:scale(1.1)}@media screen and (max-width:1250px){.image-container{padding-top:15%}}@media screen and (max-width:992px){.vp-text{font-size:20pt}.image-container{padding-top:60%}}.half-star,.star{color:#d67c57!important}.blank-star{color:#7c6ed1!important}.jconfirm-box-container .jconfirm-box{background-image:url(assets/background/details.png);background-size:cover;box-shadow:none!important}@media screen and (max-width:1366px){@supports (-webkit-touch-callout:none){.wrapper{height:90%;position:fixed}}}@media screen and (max-width:768px){.wrapper{height:90%;position:fixed}@supports (-webkit-touch-callout:none){.wrapper{height:89%;position:fixed}}.card-columns{display:block!important;-webkit-column-count:1!important;-moz-column-count:1!important;column-count:1!important}.image-container{padding-top:100%}.menu{padding:20px}}.btn:hover{transition:.3s;background:#7c6ed1;color:#fff}.btn-red{border-radius:40px!important}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;-webkit-appearance:none}.image-container{position:relative}#bday-gif{width:100px;position:absolute;top:0;right:0}.btn-portfolio{background:#b60102;color:white;}.jconfirm-content{max-height:50vh;-ms-overflow-style:none;}.jconfirm.jconfirm-modern .jconfirm-box div.jconfirm-title-c{padding-bottom:0!important;}.jconfirm-content::-webkit-scrollbar{width:8px;border-radius:10px}.jconfirm-content::-webkit-scrollbar-track{background:#c55d50}.jconfirm-content::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}@media screen and (max-width:768px){#testi-content-container{max-height:300px;padding:15px;}.jconfirm-content{scrollbar-width: none;}.jconfirm-content::-webkit-scrollbar{display:none;}}
</style>

<body>
	<div class="wrapper">
		<div class="menu" data-aos="zoom-in">
			<div class="bar">
				<a onclick="window.close()" style="height: 100%; text-decoration: none; cursor: pointer;">
					<div class="close-menu">
						<i class="fas fa-times"></i>
					</div>
				</a>

				<div>
					<?php
					if ($getMahasiswarow['status'] == 0) {
					?>
						<h3 class="vp-text">404 NOT FOUND</h3>
					<?php
					} else {
					?>
						<h3 class="vp-text">View Profile</h3>
					<?php
					}
					?>
				</div>
			</div>
			<div class="container-menu">
				<img class="bg-profile" src="./assets/background/performance.png" alt="" style="width: 100%;" id="section_content">
				<div class="content-container mt-3">
					<?php
					if ($getMahasiswarow['status'] == 0) {
					?>
						<div class="row mx-4 justify-content-center mb-3">
							<img src="./assets/gif/not_found.gif" style="width: 150px;z-index:1;">
						</div>
						<div class="row mx-4 justify-content-center">
							<h1 class="title" style="z-index:1; color: red; letter-spacing: 5px;">INVALID PARAMETER</h1>
						</div>
						<div class="row mx-4 justify-content-center">
							<h3 class="title" style="z-index:1; color: red;">PLEASE DON'T MODIFY THE URL!</h3>
						</div>
						<style>
							.container-menu {
								overflow: hidden;
							}
						</style>
					<?php
					} else {
					?>
						<div class="container-fluid mt-3" style="width: 90%;">
							<div class="row justify-content-center">
								<div class="col-12 col-lg-4 my-3 image-container">
									<a href='https://www.instagram.com/<?= sanitizeString($getMahasiswarow['instagram']) ?>/' target="_blank">
										<img src='uploads/cv_photo/<?= sanitizeString($getMahasiswarow['photo_filepath']) ?>' alt='<?= sanitizeString($getMahasiswarow['nama']) ?>' id="profile-pic">
										<?php
										if (checkBirthdayToday(sanitizeString($_GET['nrp']))) {
											?>
											<a style='text-decoration: none; color: #3C6CB4;' href='mailto:<?= sanitizeString($_GET['nrp']) ?>@john.petra.ac.id?subject=Happy%20Birthday, <?= sanitizeString($getMahasiswarow['nama']) ?>!&body=I hope you are enjoying your special day—may life continue to bring you the best days ahead. Wishing you the best birthday! 🎉%0D%0A%0D%0ABest Regards,%0D%0A<?= sanitizeString($rowMahasiswa['nama']) ?>%0D%0A%0D%0ASent from REACH – BEM UK Petra%0D%0Ahttps://bem-internal.petra.ac.id/reach/%0D%0A%0D%0A' target='_blank'><img src='./assets/gif/cake.gif' id="bday-gif"></a>
											<?php
										}
										?>
									</a>
								</div>
								<div class="col-12 col-lg-4 mt-4" style="display: grid; place-items: center; text-align: center;">
									<div class="biodata-row row mx-2">
											<h6>Nama</h6>
										</div>
										<div class="biodata-row row mx-2">
											<h5 style="font-weight: bold;">
												<?= sanitizeString($getMahasiswarow['nama']) ?>
											</h5>
										</div>
										<div class="biodata-row row mx-2 mt-4">
											<h6>NRP</h6>
										</div>
										<div class="biodata-row row mx-2">
											<h5 style="font-weight: bold;"><?= strtoupper($getMahasiswarow['nrp']) ?></h5>
										</div>
										<div class="biodata-row row mx-2 mt-4">
											<h6>Program Studi</h6>
										</div>
										<div class="biodata-row row mx-2">
											<h5 style="font-weight: bold;"><?= $jurusanStr ?></h5>
										</div>
										<div class="biodata-row row mx-2 mt-4">
											<h6>Angkatan</h6>
										</div>
										<div class="biodata-row row mx-2">
											<h5 style="font-weight: bold;"><?= $getMahasiswarow['angkatan'] ?></h5>
										</div>
										<div class="biodata-row row mx-2 mt-4">
											<h6>Pengalaman Organisasi dan Kepanitiaan</h6>
										</div>
										<div class="biodata-row row mx-2">
											<a type='button' class='btn btn-warning' <?php
																						if ($getMahasiswarow['nrp'] == 'c14190033') {
																							$pengalaman = $getMahasiswarow['pengalaman'];
																						} else {
																							$pengalaman = sanitizeString($getMahasiswarow['pengalaman']);
																						}
																						?> data-pengalaman="<?= $pengalaman ?>" data-nama='<?= sanitizeString($getMahasiswarow['nama']) ?>' onclick='viewExperience(this)' style='width: 180px;'><b>See Experiences</b></a>
										</div>
										<?php
											if ($getMahasiswarow['portfolio'] != NULL) {
												?>
												<div class="biodata-row row mx-2 mt-2">
													<a type='button' class='btn btn-portfolio' href="<?= sanitizeString($getMahasiswarow['portfolio']) ?>" target="_blank" style='width: 180px;'><b><i class="fas fa-search"></i>&nbsp;&nbsp;View Portfolio</b></a>
												</div>
												<?php
											}
										?>

										<hr style="border: 1px solid purple; width: 100%;" class="mt-5" id="hr-line">
								</div>

								<div class="col-12 col-lg-4 my-4" id="performance-container">
									<div class="row mx-2 justify-content-center">
										<h3 style="text-align: center;">Overall Performance</h3>
									</div>
									<div class="row mx-2 justify-content-center">
										<p style="font-weight: bold; text-align: center; font-size: 40pt;"><?= roundFloat(getOverallPerformance(sanitizeString($_GET['nrp'])), 2) ?></p>
									</div>
									<div class="row mx-2 justify-content-center" style="margin-top: -25px;">
										<?php displayStars(getOverallPerformance(sanitizeString($_GET['nrp']))) ?>
									</div>
									<div class="row mx-2 mt-3 justify-content-center">
										<h5 style="text-align: center;">rated by <b><?= getPeopleCount(sanitizeString($_GET['nrp'])) ?></b> committee(s)</h5>
									</div>
									<div class="row mx-2 mb-3 justify-content-center">
										<h5 style="text-align: center;">on <b><?= getEventCount(sanitizeString($_GET['nrp'])) ?></b> event(s)</h5>
									</div>

									<?php
									$performance = array(
										"Time Management",
										"Cooperative",
										"Problem Solving",
										"Open Minded",
										"Emotional Stability"
									);

									for ($i = 0; $i < count($performance); $i++) {
										$performanceCode = strtolower(preg_replace('/\s+/', '_', $performance[$i]));
									?>
										<div class="row mx-2 justify-content-center">
											<div id="performance-element">
												<p class="alignleft"><?= $performance[$i] ?></p>
												<p class="alignright"><i style="font-size: 14pt;color: #D67C57" class="fas fa-star"></i> <?= roundFloat($rowAVGPerformance[$performanceCode], 2) ?></p>
												<div style="clear: both;"></div>
											</div>
										</div>
									<?php
									}
									?>

								</div>
								<div class="col-12 mb-3 mx-2">
									<hr style="border: 1px solid purple; width: 100%;">
									<div class="row mx-2 mt-4 justify-content-center">
										<h3 style="font-weight: bold; text-align: center; letter-spacing: 5px;">Testimoni</h3>
									</div>
									<hr style="border: 1px solid purple; width: 100%;">
									<div class="mx-2 mt-1 justify-content-center" id="testimoni-row">
										<?php displayTestimonial(sanitizeString($_GET['nrp']), NULL, true) ?>
									</div>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="footer-container">
            <img src="./assets/svg/footer.svg" alt="Footer" class="footer-svg">
        </div>
	</div>

	<script>
		function viewExperience(t){var n=t.getAttribute("data-nama"),e=t.getAttribute("data-pengalaman");$.confirm({title:'<span style="color:#3C6CB4;">Pengalaman Organisasi dan Kepanitiaan<br>'+n+"</span>",typeAnimated:!0,theme:"modern",draggable:!1,onOpen:function(){setTimeout(()=>{this.$content.html('\n                        <div style="color: #3C6CB4; text-align: center; font-size: 12pt;text-transform: none;"><pre id="testi-content-container">'+e+"</pre><p style=\"text-align: center; font-size: 10pt; color: #7D6AD2;\">LAST UPDATED ON <b><?= htmlspecialchars($getMahasiswarow['updated_on']); ?> WIB</b></p></div>\n                    ")},100)},columnClass:"col-md-7",buttons:{cancel:{text:"Close",btnClass:"btn-red",action:function(){}}},content:'\n            <div style="height: 100px; display: grid; place-items: center;">\n                <div class="spinner-border text-primary" role="status">\n                    <span class="sr-only">Loading...</span>\n                </div>\n            </div>\n            '})}function scrollSmoothTo(t){document.getElementById(t).scrollIntoView({block:"start",behavior:"smooth"})}
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