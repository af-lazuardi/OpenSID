<html>
	<?php $this->load->view('print/headjs.php');?>
	<body>
		<div id="content" class="container_12 clearfix">
			<div id="content-main" class="grid_7">
				<link href="<?= base_url()?>assets/css/surat.css" rel="stylesheet" type="text/css" />
				<div>
					<table width="100%">
						<img src="<?php echo base_url(); ?>assets/images/KOP.jpg" style="width: 100%;">
						<!-- <tr>
							<img src="<?= LogoDesa($desa['logo']);?>" alt=""  width="100" height="80" class="logo">
						</tr> -->
						<!-- <div class="header"> -->
							<!-- <h4 class="kop">PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten)?> <?= strtoupper(unpenetration($desa['nama_kabupaten']))?> </h4>
							<h4 class="kop">KECAMATAN <?= strtoupper(unpenetration($desa['nama_kecamatan']))?> </h4>
							<h4 class="kop"><?= strtoupper($this->setting->sebutan_desa)?> <?= strtoupper(unpenetration($desa['nama_desa']))?></h4>
							<h5 class="kop2"><?= ($desa['alamat_kantor'])?> </h5> -->
							
						<!-- </div> -->
						<div align="center"><u><h4  class="kop">SURAT PENGANTAR PERKAWINAN</h4></u></div>
						<div align="center"><h4  class="kop">Nomor : <?= $input['nomor']?></h4></div>
					</table>
					<div id="isi3">
						<tr><td>	
								<p>Yang bertanda tangan di bawah ini menjelaskan dengan sesungguhnya bahwa:</p>
							</td>
						</tr>
						<tr></tr>
						<tr></tr>
						<tr>
							<td>
							<!-- 	<table width="100%">
									<tr><td width="20%">Nama</td><td width="2%">:</td><td width="64%"><?= unpenetration($input['pamong'])?></td></tr>
									<tr><td width="20%">Jabatan</td><td width="2%">:</td><td width="64%"><?= unpenetration($input['jabatan'])?></td></tr>
								</table> -->
								<!-- <p>dengan ini menerangkan bahwa :</p> -->
								<table width="100%">
									<tr><td width="37%">Nama Lengkap</td><td width="2%">:</td><td width="61%"><b><?= unpenetration($data['nama'])?></b></td></tr>
									<tr><td>Nomor KTP</td><td>:</td><td><?= $data['nik']?></td></tr>
									<tr><td>Tempat dan Tgl. Lahir </td><td>:</td><td><?= ($data['tempatlahir'])?>, <?= tgl_indo($data['tanggallahir'])?> </td></tr>
									<tr><td>Jenis Kelamin</td><td>:</td><td><?= $data['sex']?></td></tr>
									<tr><td>Alamat / Tempat Tinggal</td><td>:</td><td>RT. <?= $data['rt']?>, RW. <?= $data['rw']?>, Pedukuhan <?= ununderscore(unpenetration($data['alamat']))?>, <?= ucwords($this->setting->sebutan_desa)?> <?= unpenetration($data['kel_name'])?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat)?> <?= unpenetration($data['kec_name'])?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat)?> <?= unpenetration($data['kab_name'])?></td></tr>
									<tr><td >Agama</td><td>:</td><td><?= $data['agama']?></td></tr>
									<tr><td >Status</td><td>:</td><td><?= $data['status_kawin']?></td></tr>
									<tr><td >Pendidikan</td><td>:</td><td><?= $data['pendidikan']?></td></tr>
									<tr><td >Pekerjaan</td><td>:</td><td><?= $data['pekerjaan']?></td></tr>
									<tr><td >Kewarganegaraan </td><td>:</td><td><?= $data['warganegara']?></td></tr>
									<tr><td >Status Perkawinan </td><td>:</td><td><?= $input['status_perkawinan']?></td></tr>
									<tr><td >Nama Istri / Suami terdahulu </td><td>:</td><td><?= $input['nama_mantan']?></td></tr>
								</table>
								<table width="100%" style="margin-bottom: 3px;">
									<tr><td>Adalah benar anak dari perkawinan seorang pria:</td></tr>
								</table>
								<table width="100%">
									<tr><td width="37%">Nama Lengkap dan alias</td><td width="2%">:</td><td width="61%"><b><?= $input['nama_ayah']?></b></td></tr>
									<tr><td>NIK</td><td>:</td><td><?= $input['nik_ayah']?></td></tr>
									<tr><td>Tempat dan tanggal lahir</td><td>:</td><td><?= $input['tempat_lahir_ayah']?><?php if (empty($input['tgl_lahir_ayah'])){}else{?>,<?= date('d-m-Y', strtotime($input['tgl_lahir_ayah'])); }?></td></tr>
									<tr><td>Kewarganegaraan</td><td>:</td><td><?= $input['kewarganegaraan_ayah']?></td></tr>
									<tr><td>Agama</td><td>:</td><td><?= $input['agama_ayah']?></td></tr>
									<tr><td>Pekerjaan</td><td>:</td><td><?= $input['pekerjaan_ayah']?></td></tr>
									<tr><td>Alamat</td><td>:</td><td><?= $input['alamat_ayah']?></td></tr>
								</table>
								<table width="100%">
									<tr><td>dengan seorang wanita:</td></tr>
									<tr><td width="37%">Nama Lengkap dan alias</td><td width="2%">:</td><td width="61%"><b><?= $input['nama_ibu']?></b></td></tr>
									<tr><td>NIK</td><td>:</td><td><?= $input['nik_ibu']?></td></tr>
									<tr><td>Tempat dan tanggal lahir</td><td>:</td><td><?= $input['tempat_lahir_ibu']?><?php if (empty($input['tgl_lahir_ibu'])){}else{?>,<?= date('d-m-Y', strtotime($input['tgl_lahir_ibu'])); }?></td></tr>
									<tr><td>Kewarganegaraan</td><td>:</td><td><?= $input['kewarganegaraan_ibu']?></td></tr>
									<tr><td>Agama</td><td>:</td><td><?= $input['agama_ibu']?></td></tr>
									<tr><td>Pekerjaan</td><td>:</td><td><?= $input['pekerjaan_ibu']?></td></tr>
									<tr><td>Alamat</td><td>:</td><td><?= $input['alamat_ibu']?></td></tr>
								</table>
								<table width="100%">
									<tr><td>Demikian surat pengantar ini dibuat dengan mengingat sumpah jabatan dan untuk dipergunakan sebagaimana mestinya. </td></tr>
								</table>
							</td>
						</tr>
					</div>
					<table width="100%">
							<tr><td></td><td width="55%"></td><td align="center"><?= unpenetration($desa['nama_desa'])?>, <?= $tanggal_sekarang?></td></tr>
							<tr><td></td><td width="55%"></td><td align="center"><?= ($input['atas_nama'])?></td></tr>
							<tr><td></td><td width="55%"></td><td align="center"><?= unpenetration($input['jabatan'])?>,</td></tr>
					</table>
					<!-- <?php $this->load->view('print/ttd.php');?> -->
					
				</div>
				<table width="100%">
					<table width="100%">
					<table width="100%">
					<table width="100%">
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
						<tr><td></td><td width="55%"></td><td align="center"><b><u><?= unpenetration($input['pamong'])?> </u></td></tr>
						<tr><td></td><td width="55%"></td><td align="center"><?= ($input['pamong_nip'])?></td></tr>
				</table>
			</div>
			<div id="aside"></div>
			<div id="footer" class="container_12"></div>
		</div>
	</body>
</html>

