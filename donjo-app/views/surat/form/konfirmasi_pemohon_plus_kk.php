<div class="row">
	<label class="col-sm-3 control-label">
		&nbsp;
	</label>
	<div class="col-sm-8">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th colspan="3" class="text-center">Detil Data</th>
				</tr>
				<tr>
					<th width="33.3%"></th>
					<th width="33.3%">Pemohon</th>
					<th width="33.3%">Kepala Keluarga</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Nomor KK</td>
					<td><?=$individu['no_kk'];?></td>
					<td><?=$kepala_kk['no_kk'];?></td>
				</tr>
				<tr>
					<td>Nama Lengkap</td>
					<td><?=$individu['nama'];?></td>
					<td><?=$kepala_kk['nama'];?></td>
				</tr>
				<tr>
					<td>Tempat  / Tanggal Lahir</td>
					<td><?=$individu['tempatlahir'].", ".tgl_indo($individu['tanggallahir']);?></td>
					<td><?=$kepala_kk['tempatlahir'].", ".tgl_indo($kepala_kk['tanggallahir']);?></td>
				</tr>
				<tr>
					<td>Umur</td>
					<td><?=$individu['umur'];?></td>
					<td><?=$kepala_kk['umur'];?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><?=$individu['alamat_wilayah'];?></td>
					<td><?=$kepala_kk['alamat_wilayah'];?></td>
				</tr>
				<tr>
					<td>Pendidikan</td>
					<td><?=$individu['pendidikan'];?></td>
					<td><?=$kepala_kk['pendidikan'];?></td>
				</tr>
				<tr>
					<td>Agama</td>
					<td><?=$individu['agama'];?></td>
					<td><?=$kepala_kk['agama'];?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


<!-- <div class="form-group konfirmasi">
<label for="keperluan"  class="col-sm-3 control-label">Nama Lengkap</label>
	<div class="col-sm-4">
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


<div class="form-group konfirmasi">
<label for="keperluan"  class="col-sm-3 control-label">Nama Lengkap</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($kepala_kk['nama']);?> " disabled="">
	</div>
</div>
<div class="form-group konfirmasi">
	<label for="keperluan"  class="col-sm-3 control-label">Tempat  / Tanggal Lahir / Umur</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($kepala_kk['tempatlahir']);?> " disabled="">
	</div>
	<div class="col-sm-2">
  	<input class="form-control input-sm" type="text" value="<?= strtoupper(tgl_indo ($kepala_kk['tanggallahir']));?> " disabled="">
	</div>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($kepala_kk['umur']);?> TAHUN" disabled="">
	</div>
</div>
<div class="form-group konfirmasi">
	<label for="keperluan"  class="col-sm-3 control-label">Alamat</label>
	<div class="col-sm-8">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($kepala_kk['alamat_wilayah']); ?>" disabled="">
	</div>
</div>
<div class="form-group konfirmasi">
	<label for="keperluan"  class="col-sm-3 control-label">Pendidikan / Warga Negara /Agama</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($kepala_kk['pendidikan']);?>" disabled="">
	</div>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" value="<?= strtoupper($kepala_kk['warganegara']);?>" disabled="">
	</div>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" value=" <?= strtoupper($kepala_kk['agama']);?>" disabled="">
	</div>
</div> -->