<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'panduan_excel';
require_once './header.php';
?>

<style>
    td {
        vertical-align: middle !important;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center mx-2">
                <h3 class="title">Panduan Menambah Divisi & Panitia<br>(Excel)</h3>
            </div>
            <div class="mt-3" style="text-align: center; display: grid; place-items: center;">
                <p>Silakan download <b>file template Excel</b> melalui tombol di bawah ini terlebih dahulu.</p>
                <a href="./misc/excel/Template Tambah Panitia.xlsx" class="btn btn-success mb-3" style="width: 190px;"><i class="fas fa-download"></i> Template Excel</a>
                <p>Isi kolom yang tersedia sesuai dengan judul masing-masing kolom mulai dari <b>NRP, Nama Lengkap Panitia, Kode Jabatan,</b> dan <b>Divisi</b>. Untuk kolom <b>Kode Jabatan</b>, silakan mengisi antara angka <b>1, 2, atau 3</b>. File template yang sudah diberikan harap <b>jangan diubah pengaturannya</b> termasuk <b>dihias (menambah border, warna, dsb.)</b> karena sudah diatur sedemikian rupa agar dapat dibaca oleh sistem. Pengisian kolom harap <b>jangan menggunakan rumus/fungsi</b> karena tidak dapat terbaca oleh sistem.
                </p>
            </div>
        </div>

        <div class="row" style="overflow-x: auto;">
            <div class="col-12" style="overflow-x: auto;">
                <table class="table table-hovered table-striped" id="acaraTable" style="color: #412c27; width: 100%">
                    <thead style="text-align: center; font-weight: bold;">
                        <tr>
                            <td>NRP</td>
                            <td>Nama Lengkap Panitia</td>
                            <td>Kode Jabatan</td>
                            <td>Divisi</td>
                        </tr>
                    </thead>
                    <tbody id="acaraTableBody" style="text-align: center;">
                        <tr>
                            <td>C14190001</td>
                            <td>Calvert Tanudihardjo</td>
                            <td>1</td>
                            <td>Pusat</td>
                        </tr>
                        <tr>
                            <td>C14190002</td>
                            <td>Nicholas Sebastian</td>
                            <td>2</td>
                            <td>IT</td>
                        </tr>
                        <tr>
                            <td>C14190003</td>
                            <td>Handrian Alandi</td>
                            <td>3</td>
                            <td>Perlengkapan</td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-weight: bold; text-align: center;">Contoh Pengisian Excel</p>
            </div>
        </div>
        <div class="container mb-4" style="text-align: center;">
            <p>Keterangan untuk <b>Kode Jabatan</b>:<br><b>1</b> untuk <b>Badan Pengurus Harian</b><br><b>2</b> untuk <b>Koordinator atau Wakil Koordinator</b><br><b>3</b> untuk <b>Anggota Divisi</b></p>
            <p>Jangan lupa untuk selalu pastikan data yang dilakukan input sudah <b>valid dan benar</b>. Terdapat <b><i>error checking</i></b> pada sistem untuk beberapa kesalahan, seperti <b>NRP yang double, NRP yang tidak sesuai format 9 karakter, dan Kode Jabatan yang tidak sesuai</b>.</p>
            <p>Semoga dengan fitur ini dapat memudahkan teman-teman HRD supaya dapat membawa R E A C H menjadi lebih baik lagi. Tuhan memberkati. 😁</p>
        </div>
        <center>
            <a href="database.php" class="btn btn-danger mb-5" style="font-weight: bold;">Back</a>
        </center>
    </div>
</body>

</html>