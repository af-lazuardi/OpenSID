<div class="form-group">
	<label for="nik"  class="col-sm-3 control-label">NIK Pemohon<?= $pemohon?></label>
	<div class="col-sm-6 col-lg-4">
  		<input class="form-control required input-sm" name="nik" value="<?=$individu['eksis'];?>" id="nik">
	</div>
</div>
<div class="form-group">
	<label for="nik"  class="col-sm-3 control-label">NIK Kepala KK <?= $pemohon?></label>
	<div class="col-sm-6 col-lg-4">
  		<input class="form-control required input-sm" name="nik_kk" value="<?=$kepala_kk['eksis'];?>" id="nik_kk">
	</div>
	<div class="col-sm-6 col-lg-2">
		<button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check"></i> Cek NIK</button>
	</div>
</div>
