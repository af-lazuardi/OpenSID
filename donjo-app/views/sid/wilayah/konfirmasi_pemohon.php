<?php if($individu['status_data'] !=null) {?>
<div class="form-group konfirmasi">
<label for="keperluan"  class="col-sm-3 control-label"></label>
	<div class="col-sm-4 ">
		<p class="text-danger"><?php echo $individu['status_data']; ?></p>
	</div>
</div>
<?php } else { ?>

<div class="form-group konfirmasi">
<label for="keperluan"  class="col-sm-3 control-label">Nama Lengkap</label>
	<div class="col-sm-4">
		<input  type="hidden" value="<?= $individu['nik'];?> " name="id_kepala">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($individu['nama']);?> " disabled="">
	</div>
</div>
<div class="form-group konfirmasi">
	<label for="keperluan"  class="col-sm-3 control-label">Tempat  / Tanggal Lahir / Umur</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($individu['tempatlahir']);?> " disabled="">
	</div>
	<div class="col-sm-2">
  	<input class="form-control input-sm" type="text" value="<?= strtoupper(tgl_indo ($individu['tanggallahir']));?> " disabled="">
	</div>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($individu['umur']);?> TAHUN" disabled="">
	</div>
</div>
<div class="form-group konfirmasi">
	<label for="keperluan"  class="col-sm-3 control-label">Alamat</label>
	<div class="col-sm-8">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($individu['alamat_wilayah']); ?>" disabled="">
	</div>
</div>
<div class="form-group konfirmasi">
	<label for="keperluan"  class="col-sm-3 control-label">Pendidikan / Warga Negara /Agama</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($individu['pendidikan']);?>" disabled="">
	</div>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($individu['warganegara']);?>" disabled="">
	</div>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" value=" <?= strtoupper($individu['agama']);?>" disabled="">
	</div>
</div>
<?php } ?>