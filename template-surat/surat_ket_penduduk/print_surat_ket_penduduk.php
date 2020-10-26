<html>
	<?php $this->load->view('print/headjs.php');?>
	<body>
		<div id="content" class="container_12 clearfix">
			<div id="content-main" class="grid_7">
				<link href="<?= base_url()?>assets/css/surat.css" rel="stylesheet" type="text/css" />
				<div>
					<table width="100%">
						<?php $this->load->view('print/kop'); ?>
						<div align="center"><u><h4 class="kop">SURAT KETERANGAN PENDUDUK</h4></u></div>
						<div align="center"><h4 class="kop3">Nomor : <?= $input['nomor']?></h4></div>
						<tr>
							<div class="clear"></div>
							<td class="indentasi">Yang bertanda tangan dibawah ini <?= unpenetration($input['jabatan'])?> <?= unpenetration($desa['nama_desa'])?>, Kecamatan <?= unpenetration($desa['nama_kecamatan'])?>,
								<?= ucwords($this->setting->sebutan_kabupaten)?> <?= unpenetration($desa['nama_kabupaten'])?>, Provinsi <?= unpenetration($desa['nama_propinsi'])?> menerangkan dengan sebenarnya bahwa:
							</td>
						</tr>
					</table>
					<div id="isi3">
						<table width="100%">
							<tr><td width="23%">Nama Lengkap</td><td width="3%">:</td><td width="64%"><?= unpenetration($data['nama'])?></td></tr>
							<tr><td width="23%">NIK/ No KTP</td><td width="3%">:</td><td width="64%"><?= $data['nik']?></td></tr>
							<tr><td>Tempat dan Tgl. Lahir </td><td>:</td><td><?= ($data['tempatlahir'])?>, <?= tgl_indo($data['tanggallahir'])?> </td></tr>
							<tr><td>Jenis Kelamin</td><td>:</td><td><?= $data['sex']?></td></tr>
							<tr><td>Alamat/ Tempat Tinggal</td><td>:</td><td>RT. <?= $data['no_rt']?>, RW. <?= $data['no_rw']?>, Dusun <?= ununderscore(unpenetration($data['alamat_sekarang']))?>, <?= ucwords($this->setting->sebutan_desa)?> <?= unpenetration($desa['nama_desa'])?>, Kec. <?= unpenetration($desa['nama_kecamatan'])?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat)?> <?= unpenetration($desa['nama_kabupaten'])?></td></tr>
							<tr><td>Agama</td><td>:</td><td><?= $data['agama']?></td></tr>
							<tr><td>Status</td><td>:</td><td><?= $data['status_kawin']?></td></tr>
							<tr><td>Pendidikan</td><td>:</td><td><?= $data['pendidikan']?></td></tr>
							<tr><td>Pekerjaan</td><td>:</td><td><?= $data['pekerjaan']?></td></tr>
							<tr><td>Kewarganegaraan </td><td>:</td><td><?= $data['warganegara']?></td></tr>
							<tr><td>Berlaku mulai </td><td>:</td><td><?= tgl_indo(tgl_indo_in($input['berlaku_dari']))?> sampai dengan  <?= tgl_indo(tgl_indo_in($input['berlaku_sampai']))?></td></tr>
							<tr><td>Keperluan </td><td>:</td><td> <?= $input['keterangan']?></td></tr>
							<tr>
								<td  class="indentasi" colspan="3">
									Bahwa orang tersebut adalah benar-benar warga kami yang bertempat tinggal di Dusun <?= ununderscore(unpenetration($data['alamat_sekarang']))?>, RT. <?= $data['no_rt']?>, <?= unpenetration($data['alamat_sekarang'])?>, <?= unpenetration($desa['nama_kecamatan'])?>, <?= unpenetration($desa['nama_kabupaten'])?> tercatat dalam
									No. KK: <?= $data['no_kk']?> dengan NIK: <?= $data['nik']?>, kepala keluarga : <?= unpenetration($data['kepala_kk'])?>.
								</td>
							</tr>
						</table>

						<?php $this->load->view('print/ttd.php');?>
	
					</div>
				</div>
			</div>
			<div id="aside"></div>
			<div id="footer" class="container_12"></div>
		</div>
	</body>
</html>

