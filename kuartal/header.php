<?php
require_once '../phps/connect.php';
if (!isset($_SESSION['nrp'])) {
	exit(header("Location: index.php"));
}
require_once '../misc/credits.php';

$rowMahasiswa = getCVData($_SESSION['nrp']);
$angkatan = '20' . substr($_SESSION['nrp'], 3, 2);
$id_jurusan = substr($_SESSION['nrp'], 0, 3);

if (!isAdmin($_SESSION['nrp']) && $_SESSION['nrp'] != 'c14190033') {
	if (isPageAdmin($_SESSION['page'])) {
		?>
		<meta http-equiv="refresh" content="0; url=https://bem-internal.petra.ac.id/reach/home.php?status=6">
	<?php
		// exit(header("Location: ./home.php?status=6"));
	}
}

if ($_SESSION['page'] == 'search') {
	if (isset($_GET['value'])) {
		if (strlen(trim($_GET['value'])) < 4 && $_GET['value'] != 1 || strlen(trim($_GET['value'])) > 30 && $_GET['value'] != 1) {
			?>
			<meta http-equiv="refresh" content="0; url=https://bem-internal.petra.ac.id/reach/home.php?status=4">
		<?php
			// exit(header("Location: ./home.php?status=4"));
		} else {
			$bb = ['c14190033', 'b11190077'];
			if ($_GET['value'] == 1) {
				if (!isAdmin($_SESSION['nrp']) && !in_array($_SESSION['nrp'], $bb)) {
					?>
					<meta http-equiv="refresh" content="0; url=https://bem-internal.petra.ac.id/reach/home.php?status=5">
				<?php
					// exit(header("Location: home.php?status=5"));
				}
			}
		}
	} else {
		?>
		<meta http-equiv="refresh" content="0; url=https://bem-internal.petra.ac.id/reach/home.php?status=4">
	<?php
		// exit(header("Location: ./home.php?status=4"));
	}
}

if ($_SESSION['page'] == 'view_profile') {
	if (isset($_GET['nrp'])) {
		if (strlen(trim($_GET['nrp'])) != 9) {
			?>
			<meta http-equiv="refresh" content="0; url=https://bem-internal.petra.ac.id/reach/home.php?status=4">
		<?php
			// exit(header("Location: ./home.php?status=4"));
		}
		if ($rowMahasiswa['status'] == 0) {
			?>
			<meta http-equiv="refresh" content="0; url=https://bem-internal.petra.ac.id/reach/explore.php">
		<?php
			// exit(header("Location: ./explore.php"));
		}
	} else {
		?>
		<meta http-equiv="refresh" content="0; url=https://bem-internal.petra.ac.id/reach/home.php?status=4">
	<?php
		// exit(header("Location: ./home.php?status=4"));
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once '../phps/include.php'; ?>
</head>

<style>
	* {
		letter-spacing: .5;
		font-family: Recoleta;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none
	}

	input,
	textarea {
		-webkit-user-select: text;
		-khtml-user-select: text;
		-moz-user-select: text;
		-ms-user-select: text;
		user-select: text
	}

	img {
		-webkit-user-drag: none;
		-khtml-user-drag: none;
		-moz-user-drag: none;
		-o-user-drag: none
	}

	::-moz-selection {
		color: #3c6cb4;
		background: #fdcd5f
	}

	::selection {
		color: #3c6cb4;
		background: #fdcd5f
	}

	.form-control:focus {
		border-color: #fdcd5f;
		box-shadow: 0 0 0 .2rem #fdcd5f
	}

	#search_mhs {
		width: 230px;
		letter-spacing: 3px;
		border-radius: 25px !important;
		background-color: #f9ead5 !important;
		color: #3c6cb4 !important
	}

	@media screen and (max-width:1270px) and (min-width:768px) {
		@supports not (-webkit-touch-callout:none) {
			#search_mhs {
				width: 170px
			}
		}
	}

	#search_mhs:focus {
		border-color: #3c6cb4;
		box-shadow: 0 0 0 .2rem #3c6cb4
	}

	.logOut .jconfirm-title {
		padding-top: 20px !important
	}

	.navbar-brand h3 {
		margin-top: 10px
	}

	.nav-link {
		margin-top: 3px;
		transition: 50ms
	}

	.nav-link:hover {
		transition: 50ms;
		font-weight: 700
	}

	#search_mahasiswa {
		margin-right: 20px;
		margin-top: 15px
	}

	@media screen and (max-width:1200px) {
		#search_mahasiswa {
			margin-right: 0
		}
	}

	.navbar-toggler {
		margin-right: 10px !important
	}

	.jconfirm-box-container .jconfirm-box {
		background-image: url(assets/background/details.png);
		background-size: cover;
		box-shadow: none !important;
		border-radius: 25px !important
	}

	.green-so,
	.red-so {
		border-radius: 25px !important;
		width: 120px
	}

	select {
		-webkit-appearance: none
	}

	pre {
		white-space: pre-wrap;
		white-space: -moz-pre-wrap;
		white-space: -pre-wrap;
		white-space: -o-pre-wrap;
		word-wrap: break-word;
		overflow-wrap: anywhere !important;
		font-family: Recoleta;
		font-size: 12pt !important;
		color: #3c6cb4 !important;
		overflow-x: hidden
	}

	.animated-icon2 {
		width: 30px;
		height: 20px;
		position: relative;
		margin: 0;
		-webkit-transform: rotate(0);
		-moz-transform: rotate(0);
		-o-transform: rotate(0);
		transform: rotate(0);
		-webkit-transition: .5s ease-in-out;
		-moz-transition: .5s ease-in-out;
		-o-transition: .5s ease-in-out;
		transition: .5s ease-in-out;
		cursor: pointer
	}

	.animated-icon2 span {
		display: block;
		position: absolute;
		height: 3px;
		width: 100%;
		border-radius: 9px;
		opacity: 1;
		left: 0;
		-webkit-transform: rotate(0);
		-moz-transform: rotate(0);
		-o-transform: rotate(0);
		transform: rotate(0);
		-webkit-transition: .25s ease-in-out;
		-moz-transition: .25s ease-in-out;
		-o-transition: .25s ease-in-out;
		transition: .25s ease-in-out
	}

	.animated-icon2 span {
		background: #3c6cb4
	}

	.animated-icon2 span:nth-child(1) {
		top: 0
	}

	.animated-icon2 span:nth-child(2),
	.animated-icon2 span:nth-child(3) {
		top: 10px
	}

	.animated-icon2 span:nth-child(4) {
		top: 20px
	}

	.animated-icon2.open span:nth-child(1) {
		top: 11px;
		width: 0%;
		left: 50%
	}

	.animated-icon2.open span:nth-child(2) {
		-webkit-transform: rotate(45deg);
		-moz-transform: rotate(45deg);
		-o-transform: rotate(45deg);
		transform: rotate(45deg)
	}

	.animated-icon2.open span:nth-child(3) {
		-webkit-transform: rotate(-45deg);
		-moz-transform: rotate(-45deg);
		-o-transform: rotate(-45deg);
		transform: rotate(-45deg)
	}

	.animated-icon2.open span:nth-child(4) {
		top: 11px;
		width: 0%;
		left: 50%
	}

	.navbar-light .navbar-toggler {
		border: none;
		color: #3c6cb4;
		outline: 0
	}

	.grecaptcha-badge {
		visibility: hidden
	}

	.search-mhs-btn:focus {
		outline: 0 !important;
		box-shadow: none !important
	}
</style>

<section>
	<div class="navigation">
		<nav class="navbar navbar-expand-xl navbar-light" style="background-color: #fdcd5f; padding: 5px;"
			id="navigation-bar">
			<a class="navbar-brand" href="../home.php">
				<h3 style="padding-left: 20px;">R E <img src="../assets/svg/bunga.svg"
						style="width: 17px;margin-top:-5px;"> A C H</h3>
			</a>

			<button class="navbar-toggler second-button" type="button" data-toggle="collapse"
				data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false"
				aria-label="Toggle navigation">
				<div class="animated-icon2"><span></span><span></span><span></span><span></span></div>
			</button>

			<div class="collapse navbar-collapse" id="navbarToggler">
				<ul class="navbar-nav pl-2" style="text-align: center; font-size: 14pt;width:97%;">
					<?php
					if ($_SESSION['page'] == 'profile') {
						echo '<li class="nav-item active" style="padding: 0px 15px;">
							<a class="nav-link" href="profile.php" style="color: #3c6cb4;"><b>Profile</b></a>
							</li>';
					} else {
						echo '<li class="nav-item" style="padding: 0px 15px">
							<a class="nav-link" href="profile.php" style="color: #3c6cb4;">Profile</a>
							</li>';
					}
					?>

					<?php
					if ($_SESSION['page'] == 'performance') {
						echo '<li class="nav-item active" style="padding: 0px 15px">
							<a class="nav-link" href="performance.php" style="color: #3c6cb4;"><b>Performance</b></a>
							</li>';
					} else {
						echo '<li class="nav-item" style="padding: 0px 15px">
							<a class="nav-link" href="performance.php" style="color: #3c6cb4;">Performance</a>
							</li>';
					}
					?>

					<?php
					if ($_SESSION['page'] == 'explore') {
						echo '<li class="nav-item active" style="padding: 0px 15px">
							<a class="nav-link" href="explore.php" style="color: #3c6cb4;"><b>Explore</b></a>
							</li>';
					} else {
						echo '<li class="nav-item" style="padding: 0px 15px">
							<a class="nav-link" href="explore.php" style="color: #3c6cb4;">Explore</a>
							</li>';
					}
					?>

					<?php
					if ($_SESSION['page'] == 'faq') {
						echo '<li class="nav-item active" style="padding: 0px 15px">
							<a class="nav-link" href="faq.php" style="color: #3c6cb4;"><b>FAQ</b></a>
							</li>';
					} else {
						echo '<li class="nav-item" style="padding: 0px 15px">
							<a class="nav-link" href="faq.php" style="color: #3c6cb4;">FAQ</a>
							</li>';
					}
					?>

					<?php
					if ($_SESSION['page'] == 'HaveanEvent') {
						echo '<li class="nav-item active" style="padding: 0px 15px">
							<a class="nav-link" href="have_event.php" style="color: #3c6cb4;"><b>Have an Event?</b></a>
							</li>';
					} else {
						echo '<li class="nav-item" style="padding: 0px 15px">
							<a class="nav-link" href="have_event.php" style="color: #3c6cb4;">Have an Event?</a>
							</li>';
					}
					?>

					<?php
					if (isAdmin($_SESSION['nrp']) || $_SESSION['nrp'] == 'c14190033') {
						if ($_SESSION['page'] == 'database') {
							echo '<li class="nav-item active" style="padding: 0px 15px">
							<a class="nav-link" href="database.php" style="color: #3c6cb4;"><b>Database</b></a>
							</li>';
						} else {
							echo '<li class="nav-item" style="padding: 0px 15px">
							<a class="nav-link" href="database.php" style="color: #3c6cb4;">Database</a>
							</li>';
						}
					}
					?>

					<li class="nav-item" style="padding: 0px 15px">
						<a class="nav-link" onclick="signOut()" style="cursor: pointer; color: #3c6cb4;"><i
								class="fa fa-sign-out" style="padding-right: 5px; color: #3c6cb4;"></i>Sign Out</a>
					</li>
				</ul>
				<form action="phps/search_mahasiswa.php" method="post" id="search_mahasiswa" style="display: flex;"
					class="justify-content-center">
					<div class="form-group">
						<input type="search" id="search_mhs" name="search_mhs" class="form-control"
							placeholder="Find Here..." minlength="4" maxlength="30" required />
					</div>
					<button type="submit" id="submit" class="search-mhs-btn btn-primary" style="height: 38px;">
						<i class="fas fa-search"></i>
					</button>
				</form>
			</div>
		</nav>
	</div>

	<script>
		function expandNavbar() { window.innerWidth < 1357 ? (document.getElementById("navigation-bar").classList.remove("navbar-expand-xl"), document.getElementById("navigation-bar").classList.add("navbar-expand-xxl")) : (document.getElementById("navigation-bar").classList.remove("navbar-expand-xxl"), document.getElementById("navigation-bar").classList.add("navbar-expand-xl")) } function signOut() { $.confirm({ title: '<span style="color: #3C6CB4;">SIGN OUT?</span>', theme: "modern", type: "orange", icon: "fas fa-question", columnClass: "logOut col-md-5", buttons: { logoutUser: { text: "SIGN OUT", btnClass: "green-so btn-green", action: function () { window.location.href = "phps/signout.php" } }, cancel: { text: "CANCEL", btnClass: "red-so btn-red", action: function () { } } }, content: "<div style='color: #3C6CB4; font-size: 12pt;'>\"Kamu tahu, bahwa setiap orang, baik hamba, maupun orang merdeka, kalau ia telah berbuat sesuatu yang baik, ia akan menerima balasannya dari Tuhan.\"<br><b>Efesus 6:8</b></div><br>" }) } var style = "color: rgb(249, 162, 34);font-size: 40px;font-weight: bold;text-shadow: 1px 1px 5px rgb(249, 162, 34);filter: dropshadow(color=rgb(249, 162, 34), offx=1, offy=1);padding: 10px;"; console.log("%c© MMXXI R E A C H", style), console.log("%cAll Glory to God Almighty", "color: gray; font-size: 7pt; padding: 10px;"), $(document).ready(function () { $(".second-button").on("click", function () { $(".animated-icon2").toggleClass("open") }), $("img, svg, #profile-pic, .display-photo, .carousel").bind("contextmenu", function (n) { return !1 }) }), expandNavbar(), window.addEventListener("resize", function (n) { expandNavbar() }, !0);
	</script>
</section>