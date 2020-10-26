	<script>
		$(function()
		{
			$('#showData').click(function()
			{
				$("#kel").removeClass('hide');
				$('#showData').hide();
				$('#hideData').show();
			});

			$('#hideData').click(function()
			{
				$('#kel').addClass('hide');
				$('#hideData').hide();
				$('#showData').show();
			});
		$('#hideData').hide();
	});
</script>
<div class="content-wrapper">
	<?php $this->load->view("surat/form/breadcrumb.php"); ?>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border tdk-permohonan tdk-periksa">
						<a href="<?=site_url("surat")?>" class="btn btn-social btn-flat btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Kembali Ke Daftar Wilayah">
							<i class="fa fa-arrow-circle-left "></i>Kembali Ke Daftar Cetak Surat
           				</a>
					</div>
					<div class="box-body">
						<form action="" id="main" name="main" method="POST" class="form-horizontal">
							<?php include("donjo-app/views/surat/form/_cari_nik_kk.php"); ?>
						</form>
						<form id="validasi" action="<?= $form_action?>" method="POST" target="_blank" class="form-surat form-horizontal">
							<input type="hidden" id="url_surat" name="url_surat" value="<?= $url ?>">
							<input type="hidden" id="url_remote" name="url_remote" value="<?= site_url('surat/nomor_surat_duplikat')?>">
							<div class="row jar_form">
								<label for="nomor" class="col-sm-3"></label>
								<div class="col-sm-8">
									<input class="required" type="hidden" name="nik" value="<?= $individu['id']?>">
									<input class="required" type="hidden" name="nik_kk" value="<?= $kepala_kk['id']?>">
								</div>
							</div>
							<?php 
							include("donjo-app/views/surat/form/konfirmasi_pemohon_plus_kk.php");
							?>
							
							<?php include("donjo-app/views/surat/form/nomor_surat.php"); ?>
							<div class="form-group">
								<label for="jml_anggota_keluarga"  class="col-sm-3 control-label">Jumlah Anggota Keluarga</label>
								<div class="col-sm-4">
									<input type="number" name="jml_anggota_keluarga" class="form-control input-sm required" placeholder="Jumlah Anggota Keluarga">
								</div>
							</div>
							<div class="form-group">
								<label for="penghasilan_per_bulan"  class="col-sm-3 control-label">Penghasilan Per Bulan</label>
								<div class="col-sm-4">
									<input type="number" name="penghasilan_per_bulan" class="form-control input-sm required" placeholder="Penghasil Per Bulan">
								</div>
							</div>
							<div class="form-group">
								<label for="pengeluaran_per_bulan"  class="col-sm-3 control-label">Pengeluaran Per Bulan</label>
								<div class="col-sm-4">
									<input type="number" name="pengeluaran_per_bulan" class="form-control input-sm required" placeholder="Pengeluaran Per Bulan">
								</div>
							</div>
							<div class="form-group">
								<label for="keperluan"  class="col-sm-3 control-label">Keperluan</label>
								<div class="col-sm-4">
									<?=form_dropdown('keperluan', [
										'Pendidikan'=>'Pendidikan',
										'Pengobatan'=>'Pengobatan',
										'Lainnya'=>'Lainnya',
									], 
									'', 
									'class="form-control input-sm required"');
									?>
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
