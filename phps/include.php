<!-- RECAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js?render=6LdukNYaAAAAAJwNQk4_DFZxIqKcQHCLIvxcMD86"></script>

<!-- META TAGS -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta http-equiv="Cache-Control" content="no-store" />
<meta name="keywords" content="reach, petra, panitia, bem, ukp, hrd, assessment, performance, explore, petranesian, uk petra">
<meta name="description" content="RE-ACH merupakan sebuah platform untuk mencatat performa kerja Mahasiswa/i Universitas Kristen Petra di dalam kepanitiaan yang dinaungi oleh BEM UK Petra">
<meta name="author" content="BEM Universitas Kristen Petra">

<!-- TITLE -->
<?php
$pageTitle = array(
    array("index", "BEM UK Petra"),
    array("home", "Home"),
    array("profile", "Profile"),
    array("performance", "Performance"),
    array("explore", "Explore Petranesians"),
    array("recommendation", "Recommendation (beta)"),
    array("faq", "Frequently Asked Questions"),
    array("HaveanEvent", "Have an Event?"),
    array("about", "About"),
    array("problems", "Problems"),
    array("suggestions", "Suggestions"),
    array("choose_assessment", "Please Choose One"),
    array("assessment", "Assessment"),
    array("testimonial", "Testimonial"),
    array("assessment_history", "Assessment History"),
    array("search", "Search Results"),
    array("database", "Database"),
    array("database_acara", "Database Acara"),
    array("database_divisi", "Database Divisi"),
    array("database_panitia", "Database Panitia"),
    array("database_suggestions", "Kritik & Saran"),
    array("filter_testimoni", "Filter Testimoni"),
    array("testimoni_pribadi", "Testimoni Pribadi"),
    array("testimoni_tidak_lolos", "Testimoni Tidak Lolos"),
    array("filter_history", "Filter History"),
    array("panduan_excel", "Panduan Menambah Divisi & Panitia (Excel)")
);

for ($i = 0; $i < count($pageTitle); $i++) {
    if ($_SESSION['page'] == $pageTitle[$i][0]) {
?>
        <title>REACH – <?= $pageTitle[$i][1] ?></title>
<?php
    }
}
?>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://bem-internal.petra.ac.id/reach/">
<meta property="og:title" content="REACH - BEM UK Petra">
<meta property="og:description" content="RE-ACH merupakan sebuah platform untuk mencatat performa kerja Mahasiswa/i Universitas Kristen Petra di dalam kepanitiaan yang dinaungi oleh BEM UK Petra">
<meta property="og:image" content="https://bem-internal.petra.ac.id/reach/assets/meta/reach_logo.jpg">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="https://bem-internal.petra.ac.id/reach/">
<meta name="twitter:title" content="REACH - BEM UK Petra">
<meta name="twitter:description" content="RE-ACH merupakan sebuah platform untuk mencatat performa kerja Mahasiswa/i Universitas Kristen Petra di dalam kepanitiaan yang dinaungi oleh BEM UK Petra">
<meta name="twitter:image" content="https://bem-internal.petra.ac.id/reach/assets/meta/reach_logo.jpg">

<!-- CSS -->
<link rel="stylesheet" href="./style/style.css">

<!-- FONT -->
<link rel="stylesheet" href="./assets/fonts/Recoleta/stylesheet.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

<!-- ICON -->
<link rel="apple-touch-icon" sizes="180x180" href="./assets/ico/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="./assets/ico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="./assets/ico/favicon-16x16.png">
<link rel="manifest" href="./assets/ico/site.webmanifest">
<link rel="mask-icon" href="./assets/ico/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<!-- LIBS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- MISC -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
</script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.5/dist/sweetalert2.all.min.js" integrity="sha256-vT8KVe2aOKsyiBKdiRX86DMsBQJnFvw3d4EEp/KRhUE=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>