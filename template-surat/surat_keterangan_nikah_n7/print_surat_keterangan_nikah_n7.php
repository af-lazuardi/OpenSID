<html>
	<?php $this->load->view('print/headjs.php');?>
	<body>
		<div id="content" class="container_12 clearfix">
			<div id="content-main" class="grid_7">
				<link href="<?= base_url()?>assets/css/surat.css" rel="stylesheet" type="text/css" />
				<div>
					<table width="100%">
						<!-- <img src="<?php echo base_url(); ?>assets/images/KOP.jpg" style="width: 100%;"> -->
						<!-- <tr>
							<img src="<?= LogoDesa($desa['logo']);?>" alt=""  width="100" height="80" class="logo">
						</tr> -->
						<!-- <div class="header"> -->
							<!-- <h4 class="kop">PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten)?> <?= strtoupper(unpenetration($desa['nama_kabupaten']))?> </h4>
							<h4 class="kop">KECAMATAN <?= strtoupper(unpenetration($desa['nama_kecamatan']))?> </h4>
							<h4 class="kop"><?= strtoupper($this->setting->sebutan_desa)?> <?= strtoupper(unpenetration($desa['nama_desa']))?></h4>
							<h5 class="kop2"><?= ($desa['alamat_kantor'])?> </h5> -->
							
						<!-- </div> -->
						<div align="center">
							<u><h4  class="kop">FORMULIR REKOMENDASI PERKAWINAN</h4></u>
							<h3 style="padding-top: 10px;"><b>KECAMATAN <?= strtoupper(unpenetration($desa['nama_kecamatan']))?></b></h3>
							<h3><b>KABUPATEN/KOTA <?= strtoupper(unpenetration($desa['nama_kabupaten']))?></b></h3>
						</div>
						<!-- <div align="center"><h4  class="kop">Nomor : <?= $input['nomor']?></h4></div> -->
					</table>
					<table width="100%">
						<tr>
							<td width="5%">Nomor</td>
							<td width="1%">:</td>
							<td width="60%"><?= $input['nomor']?></td>
							<td style="text-align: right;"><?= strtoupper(unpenetration($desa['nama_desa']))?>, <?= date('d-m-Y', strtotime($input['tgl_surat'])); ?></td>
						</tr>
						<tr>
							<td width="5%">Lampiran</td>
							<td width="1%">:</td>
							<td width="20%"><?= $input['lampiran']?></td>
						</tr>
						<tr>
							<td width="5%">Perihal</td>
							<td width="1%">:</td>
							<td width="20%"><?= $input['perihal_surat']?></td>
						</tr>
					</table>
					<table width="100%">
						<tr>
							<td>	
								<p>Kepada Yth,<br>
								Kepala KBRI / KJRI / KUA Kecamatan <?= strtoupper(unpenetration($desa['nama_kecamatan']))?><br>
								di <?= strtoupper(unpenetration($desa['nama_desa']))?></p>
							</td>
						</tr>
					</table>
					<div id="isi3">
						<tr></tr>
						<tr></tr>
						<tr></tr>
						<tr>
							<td>
								<table width="100%" style="margin-top: 3px; margin-bottom: 0px;">
									<tr><td><p>Berdasarkan Peraturan Menteri Agama Nomor 19 Tahun 2018 tentang Pencatatan Perkawinan, telah datang ke kantor kami seorang laki-laki / perempuan:</p> </td></tr>
								</table>
								<table width="100%">
									<tr><td width="37%">Nama Lengkap</td><td width="2%">:</td><td width="61%"><b><?= unpenetration($data['nama'])?></b></td></tr>
									<tr><td>Bin</td><td>:</td><td><?= $input['bin']?></td></tr>
									<tr><td>NIK</td><td>:</td><td><?= $data['nik']?></td></tr>
									<tr><td>Tempat dan Tgl. Lahir </td><td>:</td><td><?= ($data['tempatlahir'])?>, <?= tgl_indo($data['tanggallahir'])?> </td></tr>
									<tr><td>Jenis Kelamin</td><td>:</td><td><?= $data['sex']?></td></tr>
									<tr><td>Alamat / Tempat Tinggal</td><td>:</td><td>RT. <?= $data['rt']?>, RW. <?= $data['rw']?>, Pedukuhan <?= ununderscore(unpenetration($data['alamat']))?>, <?= ucwords($this->setting->sebutan_desa)?> <?= unpenetration($data['kel_name'])?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat)?> <?= unpenetration($data['kec_name'])?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat)?> <?= unpenetration($data['kab_name'])?></td></tr>
									<tr><td>Agama</td><td>:</td><td><?= $data['agama']?></td></tr>
									<tr><td>Status</td><td>:</td><td><?= $data['status_kawin']?></td></tr>
									<tr><td>Pendidikan</td><td>:</td><td><?= $data['pendidikan']?></td></tr>
									<tr><td>Pekerjaan</td><td>:</td><td><?= $data['pekerjaan']?></td></tr>
									<tr><td>Kewarganegaraan </td><td>:</td><td><?= $data['warganegara']?></td></tr>
									<tr><td>Nomor Paspor</td><td>:</td><td><?= $input['no_pas']?></td></tr>
								</table>
								<table width="100%" style="margin-top: 3px; margin-bottom: 0px;">
									<tr><td><p>Akan melaksanakan perkawinan di wilayah Saudara dengan seorang laki-laki / perempuan:</p> </td></tr>
								</table>
								<table width="100%">
									<tr><td width="37%">Nama Lengkap</td><td width="2%">:</td><td width="61%"><b><?= $input['nama']?></b></td></tr>
									<tr><td>Bin</td><td>:</td><td><?= $input['binti']?></td></tr>
									<tr><td>NIK</td><td>:</td><td><?= $input['nik']?></td></tr>
									<tr><td>Tempat dan tanggal lahir</td><td>:</td><td><?= $input['tempat_lahir']?>, <?= date('d-m-Y', strtotime($input['tgl_lahir'])); ?></td></tr>
									<tr><td>Jenis Kelamin</td><td>:</td><td><?= $input['jk']?></td></tr>
									<tr><td>Agama</td><td>:</td><td><?= $input['agama']?></td></tr>
									<tr><td>Kewarganegaraan</td><td>:</td><td><?= $input['kewarganegraan']?></td></tr>
									<tr><td>Pekerjaan</td><td>:</td><td><?= $input['pekerjaan']?></td></tr>
									<tr><td>Alamat</td><td>:</td><td><?= $input['alamat']?></td></tr>
									<tr><td>Nomor Paspor</td><td>:</td><td><?= $input['no_paspor']?></td></tr>
									<tr><td>Status Perkawinan</td><td>:</td><td><?= $input['status_perkawinan']?></td></tr>
								</table>
								<table width="100%">
									<tr><td><p>Berdasarkan persyaratan yang telah ditentukan dalam PMA Nomor 19 Tahun 2018 kami lampirkan persyaratan permohonan pendaftaran kehendak perkawinan.</p> </td></tr>
								</table>
							</td>
						</tr>
						<table>
								<tr></tr>
								<tr></tr>
								<tr></tr>
								<tr></tr>
								<tr></tr>
						</table>
					</div>
				<table width="100%">
					<tr>
						<td width="50%" align="center"></td>
						<td width="1%"></td>
						<td align="center"><center>Kepala/Penghulu</center></td>
					</tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr><td  align="center"><td></td><td align="center"><center>( .................................... )</center></td></tr>
				</table>
			</div>
			<div id="aside"></div>
			<div id="footer" class="container_12"></div>
		</div>
	</body>
</html>


