<div class="form-group">
	<label for="nik"  class="col-sm-3 control-label">NIK / Nama <?= $pemohon?></label>
	<div class="col-sm-6 col-lg-4">
  		<input class="form-control required input-sm" name="nik" id="nik_didapatkan" value="<?=$individu['id'];?>" id="nik" required>
  	<!-- <select class="form-control required input-sm select2-nik-ajax readonly-permohonan readonly-periksa" id="nik" name="nik" style ="width:100%;" data-filter-sex="<?= $filter_sex ?>" data-url="<?= site_url('surat/list_penduduk_ajax')?>" onchange="formAction('main')">
			<?php if ($individu): ?>
				<option value="<?= $individu['id']?>" selected><?= $individu['nik'].' - '.$individu['nama']?></option>
			<?php endif;?>
		</select> -->
	</div>
	<div class="col-sm-6 col-lg-2">
		<button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check"></i> Cek NIK</button>
	</div>
</div>
