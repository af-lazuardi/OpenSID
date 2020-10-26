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
							<u>
								<h4  class="kop">FORMULIR PEMBERITAHUAN KEKURANGAN SYARAT/PENOLAKAN</h4>
								<h4  class="kop">PERKAWINAN ATAU RUJUK</h4>
							</u>

							<h3 style="padding-top: 10px;"><b>KANTOR URUSAN AGAMA</b></h3>
							<h3><b>KECAMATAN <?= strtoupper(unpenetration($desa['nama_kecamatan']))?></b></h3>
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
								Calon pengantin/Wali<br>
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
								<table width="100%">
									<tr><td>Dengan hormat, setelah dilakukan pemeriksaan terhadap persyaratan pendaftaran perkawinan yang diatur dalam peraturan perundang-undangan bahwa permohonan pendaftaran perkawinan atau rujuk Saudari : <b><?= unpenetration($data['nama'])?></b> dengan Saudara : <b><?= $input['nama_suami']?></b> diberitahukan sebagai berikut :</td></tr>
								</table>
								<table width="100%" style="margin-bottom: 3px;">
									<tr>
										<td style="padding-left: 50px;">
											<input type="checkbox" <?php if($input['opsi_pelaksanaan']=='Dilaksanakan'){echo 'checked';} ?> >Perkawinan dapat dilaksanakan dengan melengkapi persyaratan <br>
											<p> 
												<?php if($input['opsi_pelaksanaan']=='Dilaksanakan'){echo $input['persyaratan'];} ?>
											</p>
											<input type="checkbox" <?php if($input['opsi_pelaksanaan']=='Tidak Dilaksanakan'){echo 'checked';}?>>Tidak dapat dilaksanakan (ditolak) karena tidak melengkapi persyaratan berupa <br>
											<p> 
												<?php if($input['opsi_pelaksanaan']=='Tidak Dilaksanakan'){echo $input['persyaratan'];} ?>
											</p>
										</td>
									</tr>
								</table>
								<table width="100%">
									<tr><td>Demikian agar menjadi dimaklumi.</td></tr>
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
					
					<!-- <?php $this->load->view('print/ttd.php');?> -->
					
				</div>
				<table width="100%">
					<tr>
						<td width="50%" align="center"></td>
						<td width="1%"></td>
						<td align="center"><center>Wassalam,</center></td>
					</tr>
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

