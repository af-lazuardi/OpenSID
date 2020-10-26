<style>
	.error {
		color: #dd4b39;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Surat Keterangan Nikah N1</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_desa/about')?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?= site_url('surat')?>"> Daftar Cetak Surat</a></li>
			<li class="active">Surat Keterangan Nikah N1</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?=site_url("surat")?>" class="btn btn-social btn-flat btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Kembali Ke Daftar Wilayah">
							<i class="fa fa-arrow-circle-left "></i>Kembali Ke Daftar Cetak Surat
						</a>
					</div>
					<div class="box-body">
					<form action="" id="main" name="main" method="POST" class="form-horizontal">
							<div class="form-group">
								<label for="nik"  class="col-sm-3 control-label">NIK</label>
							
								<div class="col-sm-4">
									<input class="form-control input-sm" id="nik"  value="<?= $individu['nik']?>" name="nik" style ="width:100%;">
								</div>
									<div class="col-sm-2">
										<button class="btn btn-sosial btn-flat btn-success btn-sm" onclick="formAction('main')"><i class="fa fa-plus"></i>Validasi</button>
									</div>
								
							</div>
						</form>
						<form id="validasi" action="<?= $form_action?>" method="POST" target="_blank" class="form-surat form-horizontal">
							<input type="hidden" id="url_surat" name="url_surat" value="<?= $url ?>">
							<input type="hidden" id="url_remote" name="url_remote" value="<?= site_url('surat/nomor_surat_duplikat')?>">
							<?php if ($individu): ?>
								<?php include("donjo-app/views/surat/form/konfirmasi_pemohon.php"); ?>
							<?php	endif; ?>
							<div class="row jar_form">
								<label for="nomor" class="col-sm-3"></label>
								<div class="col-sm-8">
									<input class="required" type="hidden" name="nik" value="<?= $individu['nik']?>">
								</div>
							</div>
							<div class="form-group">
								<label for="nomor"  class="col-sm-3 control-label">Nomor Surat</label>
								<div class="col-sm-8">
									<input  id="nomor" class="form-control input-sm required" type="text" placeholder="Nomor Surat" name="nomor" value="<?= $surat_terakhir['no_surat_berikutnya'];?>">
									<p class="help-block text-red small"><?= $surat_terakhir['ket_nomor']?><strong><?= $surat_terakhir['no_surat'];?></strong> (tgl: <?= $surat_terakhir['tanggal']?>)</p>
								</div>
							</div>
							<div class="form-group">
								<label for="status_perkawinan"  class="col-sm-3 control-label">Status Perkawinan</label>
								<div class="col-sm-1" style="font-weight: bold; font-size: 10px;">
									<input type="radio" name="status_perkawinan" value="Jejaka">Jejaka </br>
									<input type="radio" name="status_perkawinan" value="Janda">Duda
									
								</div>
								<div class="col-sm-1" style="font-weight: bold; font-size: 10px;">
									<input type="radio" name="status_perkawinan" value="Perawan">Perawan </br>
									<input type="radio" name="status_perkawinan" value="Janda">Janda
								</div>
							</div>
							<div class="form-group">
								<label for="nama_mantan"  class="col-sm-3 control-label">Nama Istri/Suami terdahulu</label>
								<div class="col-sm-4">
									<input type="text" name="nama_mantan" class="form-control input-sm " placeholder="Nama Istri / Suami terdahulu">

								</div>
							</div>

							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:20px;padding-top:10px;padding-bottom:10px"><strong>DATA AYAH</strong></label>
							</div>
							<br><br>
							<div class="form-group">
								<label for="nama_ayah"  class="col-sm-3 control-label">Nama Lengkap dan alias</label>
								<div class="col-sm-4">
									<input type="text" name="nama_ayah" class="form-control input-sm" placeholder="Nama ">

								</div>
							</div>
							<div class="form-group">
								<label for="nik_ayah"  class="col-sm-3 control-label">NIK</label>
								<div class="col-sm-4">
									<input type="text" name="nik_ayah" class="form-control input-sm" placeholder="NIK ">

								</div>
							</div>
							<div class="form-group">
								<label for="tempat_lahir"  class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
								<div class="col-sm-4">
									<input type="text" name="tempat_lahir_ayah" class="form-control input-sm" placeholder="Tempat Lahir">

								</div>
								<div class="col-sm-2">
									<input type="date" name="tgl_lahir_ayah" class="form-control input-sm" placeholder="">

								</div>
							</div>
							<div class="form-group">
								<label for="kewarganegaraan"  class="col-sm-3 control-label">Kewarganegaraan</label>
								<div class="col-sm-4">
									<input type="text" name="kewarganegaraan_ayah" class="form-control input-sm" placeholder="Kewarganegaraan">

								</div>
							</div>
							<div class="form-group">
								<label for="agama"  class="col-sm-3 control-label">Agama</label>
								<div class="col-sm-4">
									<input type="text" name="agama_ayah" class="form-control input-sm" placeholder="Agama">

								</div>
							</div>
							<div class="form-group">
								<label for="pekerjaan"  class="col-sm-3 control-label">Pekerjaan</label>
								<div class="col-sm-4">
									<input type="text" name="pekerjaan_ayah" class="form-control input-sm" placeholder="Pekerjaan">

								</div>
							</div>
							<div class="form-group">
								<label for="alamat"  class="col-sm-3 control-label">Alamat</label>
								<div class="col-sm-4">
									<input type="text" name="alamat_ayah" class="form-control input-sm" placeholder="Alamat">

								</div>
							</div>

							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:20px;padding-top:10px;padding-bottom:10px"><strong>DATA IBU</strong></label>
							</div>
							<br><br>
							<div class="form-group">
								<label for="nama_ayah"  class="col-sm-3 control-label">Nama Lengkap dan alias</label>
								<div class="col-sm-4">
									<input type="text" name="nama_ibu" class="form-control input-sm " placeholder="Nama ">

								</div>
							</div>
							<div class="form-group">
								<label for="nik_ayah"  class="col-sm-3 control-label">NIK</label>
								<div class="col-sm-4">
									<input type="text" name="nik_ibu" class="form-control input-sm " placeholder="NIK ">

								</div>
							</div>
							<div class="form-group">
								<label for="tempat_lahir"  class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
								<div class="col-sm-4">
									<input type="text" name="tempat_lahir_ibu" class="form-control input-sm " placeholder="Tempat Lahir">

								</div>
								<div class="col-sm-2">
									<input type="date" name="tgl_lahir_ibu" class="form-control input-sm " placeholder="">

								</div>
							</div>
							<div class="form-group">
								<label for="kewarganegaraan"  class="col-sm-3 control-label">Kewarganegaraan</label>
								<div class="col-sm-4">
									<input type="text" name="kewarganegaraan_ibu" class="form-control input-sm " placeholder="Kewarganegaraan">

								</div>
							</div>
							<div class="form-group">
								<label for="agama"  class="col-sm-3 control-label">Agama</label>
								<div class="col-sm-4">
									<input type="text" name="agama_ibu" class="form-control input-sm " placeholder="Agama">

								</div>
							</div>
							<div class="form-group">
								<label for="pekerjaan"  class="col-sm-3 control-label">Pekerjaan</label>
								<div class="col-sm-4">
									<input type="text" name="pekerjaan_ibu" class="form-control input-sm " placeholder="Pekerjaan">

								</div>
							</div>
							<div class="form-group">
								<label for="alamat"  class="col-sm-3 control-label">Alamat</label>
								<div class="col-sm-4">
									<input type="text" name="alamat_ibu" class="form-control input-sm " placeholder="Alamat">

								</div>
							</div>
							<div style="margin-top:50px;padding-top:10px;padding-bottom:10px"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tertanda Atas Nama</label>
								<div class="col-sm-6 col-lg-4">
									<select class="form-control input-sm" name="atas_nama">
										<option value="">Atas Nama</option>
										<option value="An. Lurah <?= unpenetration($desa['nama_desa'])?>"> An. Lurah <?= unpenetration($desa['nama_desa'])?> </option>
										<!-- <option value="Ub. Lurah <?= unpenetration($desa['nama_desa'])?>"> Ub. Lurah <?= unpenetration($desa['nama_desa'])?> </option> -->
									</select>
								</div>
							</div>
							<?php include("donjo-app/views/surat/form/_pamong.php"); ?>
						</form>
					</div>
					<?php include("donjo-app/views/surat/form/tombol_cetak.php"); ?>
				</div>
			</div>
		</div>
	</section>
</div>
