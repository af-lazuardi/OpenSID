<html>
	<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
	<?php $this->load->view('print/headjs.php');?>
	<body>
		<div id="content" class="container_12 clearfix">
			<div id="content-main" class="grid_7">
				<link href="<?= base_url()?>assets/css/surat.css" rel="stylesheet" type="text/css" />
				<div>
					<table width="100%">
						<?php $this->load->view('print/kop'); ?>
						<div align="center"><u><h4 class="kop_nama_surat">PENGANTAR SURAT KETERANGAN CATATAN KEPOLISIAN</h4></u></div>
						<div align="center"><h4 class="kop3">Nomor : <?= $input['nomor']?></h4></div>
					</table>
					<div class="clear"></div>
					<div class="clear"></div>
					<table width="100%">
						<tr>
							<!-- <td class="indentasi">
								Yang bertanda tangan dibawah ini C <?= unpenetration($desa['nama_desa'])?>, Kecamatan <?= unpenetration($desa['nama_kecamatan'])?>,
								<?= ucwords($this->setting->sebutan_kabupaten)?> <?= unpenetration($desa['nama_kabupaten'])?>, Provinsi <?= unpenetration($desa['nama_propinsi'])?> menerangkan dengan sebenarnya bahwa:
							</td> -->
							<td>
								<p>Yang bertanda tangan dibawah ini menerangkan dengan sebenarnya bahwa :</p>
							</td>
						</tr>
					</table>
					<div id="isi3">
						<table width="100%">
							<tr><td width="23%">Nama Lengkap</td><td width="3%">:</td><td width="64%"><?= unpenetration($data['nama'])?></td></tr>
							<tr><td width="23%">NIK/ No KTP</td><td width="3%">:</td><td width="64%"><?= $data['nik']?></td></tr>
							<tr><td>Tempat dan Tgl. Lahir </td><td>:</td><td><?= ($data['tempatlahir'])?>, <?= tgl_indo($data['tanggallahir'])?> </td></tr>
							<tr><td>Jenis Kelamin</td><td>:</td><td><?= $data['sex']?></td></tr>
							<tr><td>Alamat / Tempat Tinggal</td><td>:</td><td>RT. <?= $data['no_rt']?>, RW. <?= $data['no_rw']?>, Pedukuhan <?= unpenetration(ununderscore($data['alamat_sekarang']))?>, <?= ucwords($this->setting->sebutan_desa)?> <?= unpenetration($desa['nama_desa'])?>, Kec. <?= unpenetration($desa['nama_kecamatan'])?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat)?> <?= unpenetration($desa['nama_kabupaten'])?></td></tr>
							<tr><td>Agama</td><td>:</td><td><?= $data['agama']?></td></tr>
							<tr><td>Status</td><td>:</td><td><?= $data['status_kawin']?></td></tr>
							<tr><td>Pendidikan</td><td>:</td><td><?= $data['pendidikan']?></td></tr>
							<tr><td>Pekerjaan</td><td>:</td><td><?= $data['pekerjaan']?></td></tr>
							<tr><td>Kewarganegaraan </td><td>:</td><td><?= $data['warganegara']?></td></tr>
						</table>
						<?php
						if ($input['pelanggaran'] == 'Pernah'){
						?>
						<table>
							<tr>
								<td>Orang tersebut diatas <?= $input['pelanggaran_hukum']?> berurusan dengan Kepolisian yang berhubungan dengan pelanggaran hukum dalam kasus <?= $input['kasus_hukum']?>.</td>
							</tr>
						</table>
						<?php
						}else{
						?>
						<table>
							<tr>
								<td>Orang tersebut diatas <?= $input['pelanggaran_hukum']?> berurusan dengan Kepolisian yang berhubungan dengan pelanggaran hukum.</td>
							</tr>
						</table>
						<?php
						}
						?>
						<table width="100%">
							<tr><td>Demikian surat ini dibuat dengan sebenarnya untuk mendapatkan Surat Keterangan Catatan Kepolisian (SKCK).</td></tr>
						</table>
					</div>

					<table width="100%">
						<tr><td width="10%"></td><td width="50%"></td><td align="center"><?= unpenetration($desa['nama_desa'])?>, <?= $tanggal_sekarang?></td></tr>
						<tr><td></td><td width="55%"></td><td align="center"><?= ($input['pilih_atas_nama'])?></td></tr>
						<tr><td width="10%"></td><td width="30%"></td><td align="center"><?= unpenetration($input['jabatan'])?></td></tr>
						<tr><td> <td></td><td align="center"><br/><br/><br/>( <?= unpenetration($input['pamong'])?> )</td></tr>
					</table>
				</div>
			</div>
			<div id="aside"> </div>
		</div>
	</body>
</html>
