<div class="content-wrapper">
	<section class='content-header'>
		<h1>Pelaporan Kelahiran</h1>
		<ol class='breadcrumb'>
			<li><a href='<?= site_url()?>'><i class='fa fa-home'></i> Home</a></li>
			<li class='active'>Panduan Pembuatan Surat</li>
		</ol>
	</section>
	<section class='content'>
		<div class='row'>
			<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							DATA KEMATIAN
						</div>
						<div class="box-body">	
							<form class="form-horizontal">
									<div class="form-group">
										<label for="nik"  class="col-sm-1 control-label">NIK</label>
									
										<div class="col-sm-4">
											<input class="form-control input-sm" id="nik"  value="<?= $individu['nik']?>" name="nik" style ="width:100%;">
										</div>
										<div class="col-sm-4">
												<a href="#" class="btn btn-sosial btn-flat btn-success btn-sm" id="buttonNikJenasah"><i class="fa fa-plus"></i>Validasi</a>
										</div>
										
									</div>
							</form>
							<form class="form-surat form-horizontal">
							<?php include("donjo-app/views/dukcapil/form_kematian/konfirmasi_jenazah.php"); ?>
							</form>
					</div>

					<div class="box box-info">
						<div class="box-header with-border">
							DATA IBU
						</div>
						<div class="box-body">
							<form action="" id="main" name="main" method="POST" class="form-horizontal">
									<div class="form-group">
										<label for="nik"  class="col-sm-1 control-label">NIK</label>
									
										<div class="col-sm-4">
											<input class="form-control input-sm" id="nik"  value="<?= $individu['nik']?>" name="nik" style ="width:100%;">
										</div>
										<div class="col-sm-4">
												<button class="btn btn-sosial btn-flat btn-success btn-sm" onclick="formAction('main')"><i class="fa fa-plus"></i>Validasi</button>
										</div>
										
									</div>
							</form>
							<form class="form-surat form-horizontal">
							<?php include("donjo-app/views/dukcapil/form_kematian/konfirmasi_ibu.php"); ?>
							</form>
					</div>

					<div class="box box-info">
						<div class="box-header with-border">
							DATA AYAH
						</div>
						<div class="box-body">
							<form action="" id="main" name="main" method="POST" class="form-horizontal">
									<div class="form-group">
										<label for="nik"  class="col-sm-1 control-label">NIK</label>
									
										<div class="col-sm-4">
											<input class="form-control input-sm" id="nik"  value="<?= $individu['nik']?>" name="nik" style ="width:100%;">
										</div>
										<div class="col-sm-4">
												<button class="btn btn-sosial btn-flat btn-success btn-sm" onclick="formAction('main')"><i class="fa fa-plus"></i>Validasi</button>
										</div>
										
									</div>
							</form>
							<form class="form-surat form-horizontal">
							<?php include("donjo-app/views/dukcapil/form_kematian/konfirmasi_ayah.php"); ?>
							</form>
					</div>

					<div class="box box-info">
						<div class="box-header with-border">
							DATA PELAPOR
						</div>
						<div class="box-body">
							<form action="" id="main" name="main" method="POST" class="form-horizontal">
									<div class="form-group">
										<label for="nik"  class="col-sm-1 control-label">NIK</label>
									
										<div class="col-sm-4">
											<input class="form-control input-sm" id="nik"  value="<?= $individu['nik']?>" name="nik" style ="width:100%;">
										</div>
										<div class="col-sm-4">
										<a href="#" class="btn btn-sosial btn-flat btn-success btn-sm" id="buttonNikPelapor"><i class="fa fa-plus"></i>Validasi</a>
										</div>
										
									</div>
							</form>
							<form class="form-surat form-horizontal">
							<?php include("donjo-app/views/dukcapil/form_kematian/konfirmasi_pelapor.php"); ?>
							</form>
					</div>

					<div class="box box-info">
						<div class="box-header with-border">
							DATA SAKSI 1
						</div>
						<div class="box-body">
							<form action="" id="main" name="main" method="POST" class="form-horizontal">
									<div class="form-group">
										<label for="nik"  class="col-sm-1 control-label">NIK</label>
									
										<div class="col-sm-4">
											<input class="form-control input-sm" id="nik"  value="<?= $individu['nik']?>" name="nik" style ="width:100%;">
										</div>
										<div class="col-sm-4">
												<button class="btn btn-sosial btn-flat btn-success btn-sm" onclick="formAction('main')"><i class="fa fa-plus"></i>Validasi</button>
										</div>
										
									</div>
							</form>
							<form class="form-surat form-horizontal">
							<?php include("donjo-app/views/dukcapil/form_kematian/konfirmasi_saksi1.php"); ?>
							</form>
					</div>

					<div class="box box-info">
						<div class="box-header with-border">
							DATA SAKSI 2
						</div>
						<div class="box-body">
							<form action="" id="main" name="main" method="POST" class="form-horizontal">
									<div class="form-group">
										<label for="nik"  class="col-sm-1 control-label">NIK</label>
									
										<div class="col-sm-4">
											<input class="form-control input-sm" id="nik"  value="<?= $individu['nik']?>" name="nik" style ="width:100%;">
										</div>
										<div class="col-sm-4">
												<button class="btn btn-sosial btn-flat btn-success btn-sm" onclick="formAction('main')"><i class="fa fa-plus"></i>Validasi</button>
										</div>
										
									</div>
							</form>
							<form class="form-surat form-horizontal">
							<?php include("donjo-app/views/dukcapil/form_kematian/konfirmasi_saksi2.php"); ?>
							</form>
					</div>

					<div class="box box-info">
						<div class="box-body">
							<button class="btn btn-social btn-flat btn-success btn-sm pull-right">Simpan</button>
						</div>
					</div>
			</div>
		</div>
	</section>
</div>

<script>
$("#buttonNikJenasah").click(function(){
  $.get("./ajaxValidasi?nik=3401052910860001", function(data, status){
    console.log( data );
	$("#namaJenasah").val(data.nama);
	$("#jenisKlminJenasah").val(data.jenis_klmin);
	$("#agamaJenazah").val(data.agama);
	$("#tmptLhrJenazah").val(data.tempatlahir);
	$("#tglLhrJenazah").val(data.tanggallahir);
	$("#alamatJenazah").val(data.alamat);
	$("#noRtJenazah").val(data.no_rt);
	$("#noRwJenazah").val(data.no_rw);
	$("#desaJenazah").val(data.kel_name);
	$("#kecamatanJenazah").val(data.kec_name);
	$("#kabupatenJenazah").val(data.kab_name);
	$("#provinsiJenazah").val(data.prop_name);
  });
});


$("#buttonNikPelapor").click(function(){
  $.get("./ajaxValidasi?nik=3401052910860001", function(data, status){
    console.log( data );
	$("#namaPelapor").val(data.nama);
	$("#jenisKlminPelapor").val(data.jenis_klmin);
	$("#agamaPelapor").val(data.agama);
	$("#tmptLhrPelapor").val(data.tempatlahir);
	$("#tglLhrPelapor").val(data.tanggallahir);
	$("#alamatPelapor").val(data.alamat);
	$("#noRtPelapor").val(data.no_rt);
	$("#noRwPelapor").val(data.no_rw);
	$("#desaPelapor").val(data.kel_name);
	$("#kecamatanPelapor").val(data.kec_name);
	$("#kabupatenPelapor").val(data.kab_name);
	$("#provinsiPelapor").val(data.prop_name);
  });
});
</script>
