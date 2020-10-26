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
						<div align="center"><u><h4  class="kop">SURAT KETERANGAN KEMATIAN SUAMI/ISTRI</h4></u></div>
						<div align="center"><h4  class="kop">Nomor : <?= $input['nomor']?></h4></div>
					</table>
					<table width="100%">
						<tr>
						<!-- 	<td class="indentasi"> --><!-- Yang bertanda tangan dibawah ini :<?= unpenetration($input['jabatan'])?> <?= unpenetration($desa['nama_desa'])?>, Kecamatan <?= unpenetration($desa['nama_kecamatan'])?>,
								<?= ucwords($this->setting->sebutan_kabupaten)?> <?= unpenetration($desa['nama_kabupaten'])?>, Provinsi <?= unpenetration($desa['nama_propinsi'])?> menerangkan dengan sebenarnya bahwa: -->
							<td>	
								<p>Yang bertanda tangan di bawah ini menerangkan dengan sesungguhnya bahwa:</p>
							</td>
						</tr>
					</table>
					<div id="isi3">
						<tr></tr>
						<tr></tr>
						<tr></tr>
						<tr>
							<td>
							<!-- 	<table width="100%">
									<tr><td width="20%">Nama</td><td width="2%">:</td><td width="64%"><?= unpenetration($input['pamong'])?></td></tr>
									<tr><td width="20%">Jabatan</td><td width="2%">:</td><td width="64%"><?= unpenetration($input['jabatan'])?></td></tr>
								</table> -->
								<!-- <p>dengan ini menerangkan bahwa :</p> -->
								<!-- <table width="100%" style="margin-bottom: 3px;">
									<tr><td>A. Data Ayah</td></tr>
								</table> -->
								<table width="100%">
									<tr><td width="37%">Nama Lengkap</td><td width="2%">:</td><td width="61%"><?= $input['nama']?></td></tr>
									<tr><td>Bin</td><td>:</td><td><?= $input['binti']?></td></tr>
									<tr><td>NIK</td><td>:</td><td><?= $input['nik']?></td></tr>
									<tr><td>Tempat dan tanggal lahir</td><td>:</td><td><?= $input['tempat_lahir']?>, <?= date('d-m-Y', strtotime($input['tgl_lahir'])); ?></td></tr>
									<tr><td>Kewarganegaraan</td><td>:</td><td><?= $input['kewarganegraan']?></td></tr>
									<tr><td>Agama</td><td>:</td><td><?= $input['agama']?></td></tr>
									<tr><td>Pekerjaan</td><td>:</td><td><?= $input['pekerjaan']?></td></tr>
									<tr><td>Alamat</td><td>:</td><td><?= $input['alamat']?></td></tr>
									<tr><td>Telah meninggal dunia pada tanggal</td><td>:</td><td><?= $input['tgl_meninggal']?></td></tr>
									<tr><td>Di</td><td>:</td><td><?= $input['tempat_meninggal']?></td></tr>
								</table>
							
								<table width="100%" style="margin-top: 3px; margin-bottom: 0px;">
									<tr><td><p>Yang bersangkutan adalah suami/istri dari:</p> </td></tr>
								</table>
								<table width="100%">
									<tr><td width="37%">Nama Lengkap</td><td width="2%">:</td><td width="61%"><?= unpenetration($data['nama'])?></td></tr>
									<tr><td>Bin</td><td>:</td><td><?= $input['bin']?></td></tr>
									<tr><td>Nomor KTP</td><td>:</td><td><?= $data['nik']?></td></tr>
									<tr><td>Tempat dan Tgl. Lahir </td><td>:</td><td><?= ($data['tempatlahir'])?>, <?= tgl_indo($data['tanggallahir'])?> </td></tr>
									<tr><td>Kewarganegaraan </td><td>:</td><td><?= $data['warganegara']?></td></tr>
									<tr><td>Agama</td><td>:</td><td><?= $data['agama']?></td></tr>
									<tr><td>Pekerjaan</td><td>:</td><td><?= $data['pekerjaan']?></td></tr>
									<tr><td>Alamat / Tempat Tinggal</td><td>:</td><td>RT. <?= $data['rt']?>, RW. <?= $data['rw']?>, Pedukuhan <?= ununderscore(unpenetration($data['alamat']))?>, <?= ucwords($this->setting->sebutan_desa)?> <?= unpenetration($data['kel_name'])?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat)?> <?= unpenetration($data['kec_name'])?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat)?> <?= unpenetration($data['kab_name'])?></td></tr>
								</table>
								<table width="100%">
									<tr><td><p>Demikian surat keterangan ini dibuat dengan mengingat sumpah jabatan dan untuk digunakan seperlunya.</p> </td></tr>
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
							<tr></tr>
							<tr></tr>
							<tr></tr>
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


