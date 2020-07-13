<div class="form-group">
	<label class="control-label col-sm-4" for="nama">Uraian Singkat</label>
	<div class="col-sm-6">
		<input name="attr[uraian]" class="form-control input-sm" type="text" value="<?=$dokumen['attr']['uraian']?>"></input>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-4" for="nama">Nomor Ditetapkan</label>
	<div class="col-sm-6">
		<input name="attr[no_ditetapkan]" class="form-control input-sm" type="text" value="<?=$dokumen['attr']['no_ditetapkan']?>"></input>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-4" for="nama">Tahun Ditetapkan</label>
	<div class="col-sm-6">
		<input name="attr[tahun_ditetapkan]" class="form-control input-sm" type="text" value="<?=$dokumen['attr']['tahun_ditetapkan']?>"></input>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-4" for="nama">Status</label>
	<div class="col-sm-6">
		<input type="radio" name="attr[status]" value="Berlaku" <?php if($dokumen['attr']['status']=='Berlaku'){echo 'checked';}?>>Berlaku</input></br>
		<input type="radio" name="attr[status]" value="Tidak Berlaku" <?php if($dokumen['attr']['status']=='Tidak Berlaku'){echo 'checked';}?>>Tidak Berlaku</input>
	</div>
</div>