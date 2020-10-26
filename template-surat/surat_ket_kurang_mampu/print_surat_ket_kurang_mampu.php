<?php $this->load->view('print/headjs.php');?>
<body>
	<div id="content" class="container_12 clearfix">
		<div id="content-main" class="grid_7">
			<link href="<?= base_url()?>assets/css/surat.css" rel="stylesheet" type="text/css" />
			<div>
				<table width="100%">
					<?php $this->load->view('print/kop'); ?>
				</table>
				<table width="100%">
				</table>
				<table width="100%">
				</table>
				<table width="100%">
					<div align="center"><u><h4 class="kop">SURAT KETERANGAN TIDAK MAMPU</h4></u></div>
					<div align="center"><h4 class="kop3">Nomor : 467.1/<?= $input['nomor']?><!-- /Kesra/<?= date("Y")?> --></h4></div>
				</table>
				<div class="clear"></div>
				<table width="100%">
				<!-- 	<tr><td class="indentasi">Yang bertanda tangan dibawah ini Kepala Desa <?= unpenetration($desa['nama_desa'])?> Kecamatan <?= unpenetration($desa['nama_kecamatan'])?> Kabupaten <?= unpenetration($desa['nama_kabupaten'])?> Provinsi <?= unpenetration($desa['nama_propinsi'])?> menerangkan dengan sebenarnya kepada :  </td></tr> -->
					<tr><td>Yang bertanda tangan dibawah ini menerangkan dengan sebenarnya bahwa :  </td></tr>
				</table>
				<div id="isi3">
					<table width="100%">
						<tr><td width="23%">Nama Lengkap</td><td width="3%">:</td><td width="64%"><b><?= unpenetration($kepalakk['nama'])?></td></tr>
						<tr><td width="23%">NIK / No KTP</td><td width="3%">:</td><td width="64%"><?= $kepalakk['nik']?></td></tr>
						<tr><td>Tempat dan Tgl. Lahir </td><td>:</td><td><?= ($kepalakk['tempatlahir'])?>, <?= tgl_indo($kepalakk['tanggallahir'])?> </td></tr>
						<tr><td>Jenis Kelamin</td><td>:</td><td><?= $kepalakk['sex']?></td></tr>
						<tr><td>Agama</td><td>:</td><td><?= $kepalakk['agama']?></td></tr>
						<tr><td>Pekerjaan</td><td>:</td><td><?= $kepalakk['pekerjaan']?></td></tr>
						<tr><td>Kewarganegaraan </td><td>:</td><td><?= $kepalakk['warganegara']?></td></tr>
						<tr><td>Alamat/ Tempat Tinggal</td><td>:</td><td>RT. <?= $kepalakk['no_rt']?> RW. <?= $kepalakk['no_rw']?> Pedukuhan <?= unpenetration(ununderscore($kepalakk['alamat_sekarang']))?> Desa <?= unpenetration($desa['nama_desa'])?> Kecamatan <?= unpenetration($desa['nama_kecamatan'])?> Kabupaten <?= unpenetration($desa['nama_kabupaten'])?></td></tr>
					</table>
					<table width="100%">
						<tr>
							<td>Jumlah keluarga <?=$input['jml_anggota_keluarga'];?> orang, 
							 mengaku berpenghasilan rata-rata per bulan sebesar Rp. <?= number_format($input['penghasilan_per_bulan'])?>
							 dan pengeluaran rata-rata per bulan sebesar Rp. <?= number_format($input['pengeluaran_per_bulan'])?>
							 Sehingga tidak mampu menanggung biaya <?= ($input['keperluan'])?> bagi <?=$data['hubungan'];?>-nya : </td>
						</tr>
					</table>
					<table width="100%">
							
						<tr><td width="23%">Nama Lengkap</td><td width="3%">:</td><td width="64%"><b><?= unpenetration($data['nama'])?></td></tr>
						<tr><td width="23%">NIK / No KTP</td><td width="3%">:</td><td width="64%"><?= $data['nik']?></td></tr>
						<tr><td>Tempat dan Tgl. Lahir </td><td>:</td><td><?= ($data['tempatlahir'])?>, <?= tgl_indo($data['tanggallahir'])?> </td></tr>
						<tr><td>Jenis Kelamin</td><td>:</td><td><?= $data['sex']?></td></tr>
						<tr><td>Agama</td><td>:</td><td><?= $data['agama']?></td></tr>
						<tr><td>Pekerjaan</td><td>:</td><td><?= $data['pekerjaan']?></td></tr>
						<tr><td>Kewarganegaraan </td><td>:</td><td><?= $data['warganegara']?></td></tr>
						<tr><td>Alamat/ Tempat Tinggal</td><td>:</td><td>RT. <?= $data['no_rt']?> RW. <?= $data['no_rw']?> Pedukuhan <?= unpenetration(ununderscore($data['alamat_sekarang']))?> Desa <?= unpenetration($desa['nama_desa'])?> Kecamatan <?= unpenetration($desa['nama_kecamatan'])?> Kabupaten <?= unpenetration($desa['nama_kabupaten'])?></td></tr>
							
					</table>
					<!-- <table width="100%">
						<tr><td><center><u><b><i>DAFTAR TANGGUNGAN KELUARGA</td><td></td></tr>
						<tr>
							<link href="<?= base_url()?>assets/css/report.css" rel="stylesheet" type="text/css">
							<table class="border thick">
								<thead>
									<tr class="border thick">
									<tr></tr>
									<?php if ($anggota): ?>
										<table width = 600 border =1>
											<thead>
												<tr>
													<th align="center" >No</th>
													<th align="center" >NIK</th>
													<th align="center" >Nama Lengkap</th>
													<th align="center" align="center">Jenis Kelamin</th>
													<th  align="center" >Tempat Tanggal Lahir</th>
													<th align="center" >SHDK</th>


												</tr>
											<tbody>
												<?php $i=0;?>
												<?php foreach ($anggota['content'] AS $individu1):
													if ($individu1['STAT_HBKEL'] == "KEPALA KELUARGA") continue;
													$i++;?>
													<tr>
														<td align="center"> <?= $i?></td>
														<td align="center"><?= $individu1['NIK']?></td>
														<td> <?= unpenetration($individu1['NAMA_LGKP'])?></td>
														<td align="center"><?= $individu1['JENIS_KLMIN']?></td>
														<td align="left"> <?= $individu1['TMPT_LHR']?>, <?= tgl_indo($individu1['TGL_LHR'])?></td>
														<td align="center"><?= $individu1['STAT_HBKEL']?></td>
													</tr>
												<?php endforeach;?>
											</tbody>
											<tr></tr>
											<tr></tr>
									<?php endif; ?>
									<tr></tr>
							</table> -->
							<table width="100%">
								<tr></tr>
								<tr></tr>
								<!-- <tr><td class="indentasi">Surat Keterangan ini dibuat untuk Keperluan : <b><?= $input['keperluan']?> -->
								<tr></tr>
							</table>
							<table width="100%">
								<tr></tr>
								<tr><td>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya</td></tr>
								<tr></tr>
							</table>
							<table>
								<tr></tr>
								<tr></tr>
								<tr></tr>
								<tr></tr>
								<tr></tr>
							</table>
						</div>
						
						<?php $this->load->view('print/ttd.php');?>
					</div>
				</div>
			</div>
			<div id="aside"></div>
		</div>
	</body>
</html>
