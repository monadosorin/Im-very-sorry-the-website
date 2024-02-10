<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'faq';
require_once './header.php';
?>

<style>
    body{background-image:url(assets/background/cv.png);background-size:cover;background-color:#c55d50}::-webkit-scrollbar{width:8px;border-radius:10px}::-webkit-scrollbar-track{background:#c55d50}::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}.faq-container{padding:50px 200px}.faq-drawer{margin-bottom:30px}.faq-drawer__content-wrapper{font-size:1.25em;line-height:1.4em;max-height:0;overflow:hidden;transition:.25s ease-in-out}.faq-drawer__content{color:#fff;margin-top:10px}.faq-drawer__title{border-top:#fdcd5f 1px solid;cursor:pointer;display:block;font-size:1.25em;font-weight:700;padding:30px 0 0 0;position:relative;margin-bottom:0;transition:all .25s ease-out;color:#fff}.faq-drawer__title::after{border-style:solid;border-width:1px 1px 0 0;content:" ";display:inline-block;float:right;height:10px;left:2px;position:relative;right:20px;top:2px;transform:rotate(135deg);transition:.35s ease-in-out;vertical-align:top;width:10px}.faq-drawer__title:hover{color:#fdcd5f}.faq-drawer__trigger:checked+.faq-drawer__title+.faq-drawer__content-wrapper{max-height:1000px}.faq-drawer__trigger:checked+.faq-drawer__title::after{transform:rotate(-45deg);transition:.25s ease-in-out}input[type=checkbox]{display:none}@media only screen and (max-width:768px){.faq-container{padding:80px!important}}@media only screen and (max-width:768px){body{background-image:none}}.btn-red{border-radius:25px!important}
</style>

<body>
    <div class="container faq-container" data-aos="fade-up">
        <div class="title-row mx-2">
            <h2 class="title" style="color: #FDCD5F; letter-spacing: 5px;">Frequently Asked Questions</h2>
        </div>

        <div class="faq-drawer mt-4">
            <input class="faq-drawer__trigger" id="faq-drawer" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer">Mengapa <i>bubble</i> testimoni terdapat dua warna yang berbeda?</label>
            <div class="faq-drawer__content-wrapper">
                <div class="faq-drawer__content">
                    <p>
                        Warna pada <i>bubble</i> testimoni mewakili testimoni yang bersifat <b>publik</b> atau <b>personal</b>.<br><br><i>Bubble</i> testimoni yang berwarna <span style="font-weight: bold; color: #fbead6;">krem (terang)</span> mewakili testimoni yang memuat kinerja dan kualitas individu dalam suatu kepanitiaan. Testimoni ini bersifat publik sehingga akan muncul pada profil dan <b>dapat dilihat</b> oleh Petranesians lainnya.<br><br><i>Bubble</i> testimoni yang berwarna <span style="font-weight: bold; color: #f2bc8d;">jingga (gelap)</span> mewakili testimoni yang hanya berisi kritik, saran, apresiasi, atau impresi terhadap Petranesian dalam suatu kepanitiaan. Testimoni ini bersifat pribadi sehingga <b>hanya dapat dilihat</b> oleh Petranesian yang dituju.
                    </p>
                </div>
            </div>
        </div>

        <div class="faq-drawer">
            <input class="faq-drawer__trigger" id="faq-drawer-2" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-2">Mengapa testimoni yang saya berikan tidak muncul pada profile Petranesian yang dituju?</label>
            <div class="faq-drawer__content-wrapper">
                <div class="faq-drawer__content">
                    <p>
                        Semua testimoni yang diberikan akan <b>disaring</b> terlebih dahulu oleh <b>Departemen HRD BEM UK Petra</b> untuk menentukan apakah testimoni bersifat <b>publik</b> atau <b>personal</b>. Testimoni yang bersifat <b>personal</b> hanya dapat dilihat oleh Petranesian yang dituju saja dan tidak dapat dilihat oleh Petranesians lainnya. Testimoni yang berisi <i>hate speech</i> <b>tidak akan ditampilkan</b> karena tidak layak untuk dilihat oleh pribadi, terlebih bagi Petranesians lainnya.
                    </p>
                </div>
            </div>
        </div>

        <div class="faq-drawer">
            <input class="faq-drawer__trigger" id="faq-drawer-3" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-3">Apakah terdapat ketentuan khusus untuk foto pada halaman Profile?</label>
            <div class="faq-drawer__content-wrapper">
                <div class="faq-drawer__content">
                    <p>
                        Tidak ada ketentuan khusus untuk foto pada halaman <a href="./profile.php" style="color: white; text-decoration: none; font-weight: bold;">Profile</a>. Petranesians bebas menggunakan foto apapun <b>selama</b> masih menunjukkan <b>wajah asli yang sopan dan rapi</b>. Petranesians tidak wajib untuk menggunakan foto 3x4.
                    </p>
                </div>
            </div>
        </div>

        <div class="faq-drawer">
            <input class="faq-drawer__trigger" id="faq-drawer-4" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-4">Mengapa saat mengisi CV (Curriculum Vitae) Petranesians diminta data berupa Alamat, Nomor HP, ID LINE tetapi tidak ditampilkan pada profil?</label>
            <div class="faq-drawer__content-wrapper">
                <div class="faq-drawer__content">
                    <p>
                        Alamat, Nomor HP, dan ID LINE adalah data dan informasi yang bersifat pribadi sehingga <b>tidak ditampilkan</b> pada profil agar tidak disalahgunakan. Data dan informasi tersebut disimpan pada <i>database</i> R E A C H dan hanya digunakan jika memang dibutuhkan.
                    </p>
                </div>
            </div>
        </div>

        <div class="faq-drawer">
            <input class="faq-drawer__trigger" id="faq-drawer-5" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-5">Bagaimana cara memberikan testimoni yang berkualitas agar lolos filter dan ditampilkan pada profil Petranesian yang bersangkutan?</label>
            <div class="faq-drawer__content-wrapper">
                <div class="faq-drawer__content">
                    <p>
                        Testimoni yang berkualitas dapat berisi <b>gabungan</b> dari <b>kesan, pesan, maupun kritik yang membangun</b> terhadap kinerja Petranesian yang spesifik.<br><br>
                        <b>Contoh:</b><br>
                        <i>“Selama kepanitiaan X, Aldi memberikan performa kerja yang sangat baik. Walaupun Aldi adalah orang yang pelupa, ia mampu mengatasinya dengan berusaha membuat banyak catatan kecil di HP-nya. Dengan cara itu ia bahkan mampu menyelesaikan semua tugas sebelum deadline dengan hasil yang maksimal. Aldi juga ringan tangan untuk membantu pekerjaan anggota lainnya. Terima kasih banyak, Aldi!”</i>
                    </p>
                </div>
            </div>
        </div>

        <div class="faq-drawer">
            <input class="faq-drawer__trigger" id="faq-drawer-6" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-6">Bagaimana contoh testimoni yang biasanya bersifat personal?</label>
            <div class="faq-drawer__content-wrapper">
                <div class="faq-drawer__content">
                    <p>
                        Testimoni yang hanya terdiri dari <b>1-3 kata saja</b> dan testimoni yang cenderung mengarah ke <b>percakapan</b> tidak akan ditampilkan ke publik. Testimoni tersebut hanya dapat dilihat oleh Petranesian yang dituju saja dan tidak dapat dilihat oleh Petranesians lainnya.<br><br>
                        <b>Contoh:</b><br>
                        <i>“Mantab!” “Semangat kuliahnya!” “Sudah bagus.” “Good luck!” “Thank you, guys!”<br>
                            “Makasih pol Shania uda bantuin aku begadang bikin rally games. Kalo gak ada kamu, pasti aku keteteran pol! Bersyukur banget bisa kenal sama Shania!”<br>
                            “Ryan asik banget orangnya. Apalagi waktu Raplen 1 Ryan kena hukuman bikin story IG. Nguakak pol!”</i>
                    </p>
                </div>
            </div>
        </div>

        <div class="faq-drawer">
            <input class="faq-drawer__trigger" id="faq-drawer-7" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-7">Apakah perbedaan dari 'Berikan Penilaian untuk Panitia' dan 'Berikan Testimoni untuk Panitia'? Apakah keduanya wajib?</label>
            <div class="faq-drawer__content-wrapper">
                <div class="faq-drawer__content">
                    <p>
                        Penilaian terhadap panitia di acara yang Petranesians ikuti <b><u>wajib</u></b> untuk dilakukan pada halaman <b>'Berikan Penilaian untuk Panitia'</b> yang mencakup penilaian dari aspek <i>Time Management, Cooperative, Problem Solving, Open Minded,</i> dan <i>Emotional Stability</i>. Sedangkan pemberian testimoni pada halaman <b>'Berikan Testimoni untuk Panitia'</b> tidak wajib untuk dilakukan karena bersifat <b>opsional</b>. Daftar nama Petranesians yang terdapat pada halaman <b>'Berikan Penilaian untuk Panitia'</b> tidak akan ditampilkan kembali pada halaman <b>'Berikan Testimoni untuk Panitia'</b>.
                    </p>
                </div>
            </div>
        </div>

        <div class="faq-drawer">
            <input class="faq-drawer__trigger" id="faq-drawer-8" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-8">Tips menjadi Petranesian yang profesional dan berkualitas?</label>
            <div class="faq-drawer__content-wrapper">
                <div class="faq-drawer__content">
                    <p>
                        Segala pesan, apresiasi, kritik, maupun saran yang diterima Petranesians hendaknya disikapi dengan penuh kebijaksanaan, kesabaran, kerendahan hati, dan dijadikan sebagai evaluasi diri sendiri. Hal-hal tersebut bertujuan untuk membangun dan membentuk karakter Petranesians yang lebih baik lagi di masa depan.<br><br>
                        Petranesians tidak perlu khawatir saat diberikan testimoni yang kesannya seperti 'menjatuhkan' karena setiap testimoni pasti akan disaring dengan sungguh-sungguh terlebih dahulu sesuai dengan ketentuan yang telah ditetapkan sebelumnya. Sesuai dengan <b>tujuan utama R E A C H</b>, <i>platform</i> ini hendak membantu Petranesians dalam proses pemilihan kepanitiaan kedepannya. 😉<br><br>

                        <i>Good luck and be the next <span onclick='rickyCiputra()' style='cursor: pointer;'>Ricky Ciputra</span>!</i> ✨<br>
                        <i>#BukaTelinga #BukaMata #BukaHati</i>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function rickyCiputra(){$.confirm({title:'<span style="color:#3C6CB4;">Ricky Ciputra</span>',typeAnimated:!0,theme:"modern",draggable:!1,columnClass:"col-md-7",buttons:{cancel:{text:"Close",btnClass:"btn-red"}},content:'\n                <div style="color: #3C6CB4; font-size: 14pt;">\n                    <p style="text-align: center;">\n                        Ketua Badan Eksekutif Mahasiswa Universitas Kristen Petra 2020/2021\n                    </p>\n                </div>\n            '})}
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
		AOS.init();
	</script>
</body>

</html>