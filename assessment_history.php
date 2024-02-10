<?php
require_once './phps/connect.php';
$_SESSION['page'] = 'assessment_history';
require_once './header.php';
?>

<style>
    body{background-image:url(assets/background/cv.png);color:#fff!important;background-color:#c55d50}table{color:#fff!important;background-color:#d67c55}td{vertical-align:middle!important}::-webkit-scrollbar{width:8px;border-radius:10px}::-webkit-scrollbar-track{background:#c55d50}::-webkit-scrollbar-thumb{background:#fdcd5f;background-clip:padding-box}.btn{transition:.3s;background-color:#fdcd5f;border:none;border-radius:25px;color:#000;-webkit-appearance:none;font-weight:700}.btn:hover{transition:.3s;background:#7c6ed1!important;color:#fff!important}
</style>

<body>
    <div class="container-fluid" style="margin-top: 30px;" data-aos="fade-up">
        <div class="title-row row mx-4">
            <h1 class="title" style="letter-spacing:5px; color:#FDCD5F;"><i class="fas fa-history"></i> Assessment History</h1>
        </div>
        <?php
        $cekTestimonisql = "SELECT * FROM data_performance WHERE nrp_penilai = ?";
        $cekTestimonistmt = $pdo->prepare($cekTestimonisql);
        $cekTestimonistmt->execute([$_SESSION['nrp']]);
        if ($cekTestimonistmt->rowCount() > 0) {
        ?>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2" style="padding-top: 30px;">
                    <select class="form-control" id="filter_acara" name="filter_acara" style="height:40px; font-size: 12pt; border-radius: 25px; background-color: #D67C55; color: white; border: none;">
                        <option value="">Lihat berdasarkan acara...</option>
                        <?php getEventList($_SESSION['nrp'], true) ?>
                    </select>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="row" style="margin-top: 20px; overflow-x: auto;">
            <div class="col-12" style="overflow-x: auto;">
                <table class="table table-hovered table-striped" id="historyTable" style="color: #412c27; width: 100%">
                    <thead style="text-align: center; font-weight: bold;">
                        <tr>
                            <td style="width: 5%;">#</td>
                            <td>NRP</td>
                            <td>Nama</td>
                            <td>Jabatan</td>
                            <td>Divisi</td>
                            <td>Acara</td>
                            <td>Tanggal dan Waktu Submit</td>
                        </tr>
                    </thead>
                    <tbody id="historyTableBody" style="text-align: center;">

                    </tbody>
                </table><br>
            </div>
        </div>
        <center><a href="choose_assessment.php" class="btn mb-5" style="width: 150px;">Back</a></center>
    </div>

    <script>
        function show(){$("#historyTableBody").html("<span>Harap tunggu...</span>"),$.ajax({url:"phps/refresh_data.php",type:"get",dataType:"json",data:{id:5},success:function(a){$("#historyTable").dataTable().fnDestroy();for(var t=a,e="",r=1,n=0;n<t.length;n++){var d=t[n];e+="<tr>",e+="<td>"+r+"</td>",e+="<td>"+d.nrp.toUpperCase()+"</td>",e+="<td>"+d.nama+"</td>",e+="<td>"+d.jabatan+"</td>",e+="<td>"+d.divisi+"</td>",e+="<td>"+d.acara+"</td>",e+="<td style='width: 20%;'>"+d.submitted_on+" WIB</td>",e+="</tr>",r+=1}$("#historyTableBody").html(e),Search($("#historyTable").DataTable({oLanguage:{sEmptyTable:"Anda Masih Belum Pernah Melakukan Assessment"}}))},error:function(a){alert("Mohon maaf, terjadi error di server. Silakan coba ulangi kembali.")}})}function Search(a){$("#filter_acara").on("change",function(){a.columns(5).search(this.value).draw()})}$(document).ready(function(){show()});
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