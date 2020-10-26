<style>
	.error {
		color: #dd4b39;
	}
</style>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'textarea'});</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Surat Keterangan Nikah N2</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_desa/about')?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?= site_url('surat')?>"> Daftar Cetak Surat</a></li>
			<li class="active">Surat Keterangan Nikah N2</li>
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
							<!-- <div class="form-group">
								<label for="status_perkawinan"  class="col-sm-3 control-label">Status Perkawinan</label>
								<div class="col-sm-1" style="font-weight: bold; font-size: 10px;">
									<input type="radio" name="status_perkawinan" value="Jejaka">Jejaka </br>
									<input type="radio" name="status_perkawinan" value="Janda">Duda
									
								</div>
								<div class="col-sm-1" style="font-weight: bold; font-size: 10px;">
									<input type="radio" name="status_perkawinan" value="Perawan">Perawan </br>
									<input type="radio" name="status_perkawinan" value="Janda">Janda
								</div>
							</div> -->
							<div class="form-group">
								<label for="perihal_surat"  class="col-sm-3 control-label">Perihal</label>
								<div class="col-sm-4">
									<input type="text" name="perihal_surat" class="form-control input-sm required" placeholder="Perihal Surat">
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_surat"  class="col-sm-3 control-label">Tanggal Surat</label>
								<div class="col-sm-4">
									<input type="date" name="tgl_surat" class="form-control input-sm required" placeholder="Tanggal Surat">
								</div>
							</div>
							<!-- <div class="form-group">
								<label for="tujuan_surat"  class="col-sm-3 control-label">Tujuan</label>
								<div class="col-sm-4">
									<input type="text" name="tujuan_surat" class="form-control input-sm required" placeholder="Tujuan Surat">
								</div>
							</div>
 -->


							<!-- <div class="form-group">
								<label for="nama_suami"  class="col-sm-3 control-label">Nama Calon Suami</label>
								<div class="col-sm-4">
									<input type="text" name="nama_suami" class="form-control input-sm required" placeholder="Nama">
								</div>
							</div> -->
							<div class="form-group">
								<label for="nama_istri"  class="col-sm-3 control-label">Nama Calon Istri</label>
								<div class="col-sm-4">
									<input type="text" name="nama_istri" class="form-control input-sm required" placeholder="Nama">
								</div>
							</div>
							<div class="form-group">
								<label for="hari_acara"  class="col-sm-3 control-label">Hari, Tanggal dan Jam Acara</label>
								<div class="col-sm-2">
									<input type="text" name="hari_acara" class="form-control input-sm required" placeholder="Hari">
								</div>
								<div class="col-sm-2">
									<input type="date" name="tgl_acara" class="form-control input-sm required" placeholder="Tanggal">
								</div>
								<div class="col-sm-2">
									<input type="time" name="jam_acara" class="form-control input-sm required" placeholder="Jam">
								</div>
							</div>
							<div class="form-group">
								<label for="tempat_acara"  class="col-sm-3 control-label">Tempat Acara</label>
								<div class="col-sm-4">
									<input type="text" name="tempat_acara" class="form-control input-sm required" placeholder="Tempat">
								</div>
							</div>


							<div class="form-group">
								<label for="lampiran"  class="col-sm-3 control-label">Lampiran Surat</label>
								<div class="col-sm-4">
									<textarea  id="mytextarea" name="lampiran"  style="height: 300px;"></textarea>
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
