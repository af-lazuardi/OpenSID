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
						<div align="center"><u><h4  class="kop">FORMULIR PERMOHONAN KEHENDAK PERKAWINAN</h4></u></div>
						<!-- <div align="center"><h4  class="kop">Nomor : <?= $input['nomor']?></h4></div> -->
					</table>
					<table width="100%">
						<tr>
							<td style="padding-right: 250px;">	
								<p>Perihal : <?= $input['perihal_surat']?></p>
							</td>
							<td><?= strtoupper(unpenetration($desa['nama_desa']))?>, <?= date('d-m-Y', strtotime($input['tgl_surat'])); ?></td>
						</tr>
					</table>
					<table width="100%">
						<tr>
							<td>	
								<p>Kepada yth,</p>
								<p>Kepala KBRI/KJRI/KUA Kepanewon <?= strtoupper(unpenetration($desa['nama_kecamatan']))?></p>
								<p>di <?= strtoupper(unpenetration($desa['nama_desa']))?></p>
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
									<tr><td>Dengan hormat, kami mengajukan permohonan kehendak perkawinan untuk atas nama calon suami : <b><?= unpenetration($data['nama'])?></b> dengan calon istri : <b><?= $input['nama_istri']?></b> pada hari <b><?= $input['hari_acara']?></b> tanggal <b><?= date('d-m-Y', strtotime($input['tgl_acara'])); ?></b> jam <b><?= $input['jam_acara']?> WIB</b> bertempat di <b><?= $input['tempat_acara']?></b></td></tr>
								</table>
								<table width="100%" style="margin-bottom: 3px;">
									<tr><td style="padding-left: 50px;">Bersama ini kami sampaikan surat-surat yang diperlukan ntuk diperiksa sebagai berikut: </td></tr>
									<tr><td style="padding-left: 50px;"><p><?= $input['lampiran']?></p></td></tr>
								</table>
								<table width="100%">
									<tr><td>Demikian permohonan ini kami sampaikan, kiranya dapat diperiksa, dihadiri dan dicatat sesuai dengan ketentuan peraturan perundang-undangan.</td></tr>
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
					<tr><td width="50%" align="center">Diterima tanggal,.....................</td><td width="1%"></td><td align="center"><center></center></td></tr>
					<tr><td width="50%" align="center">Yang Menerima,</td><td width="1%"></td><td align="center"><center></center></td></tr>
					<tr><td width="50%" align="center">Kepala KUA/Penghulu/PPN Luar Negeri</td><td width="1%"></td><td align="center"><center>Pemohon</center></td></tr>
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
					<tr><td  align="center">( .................................... )<td></td><td align="center"><center>( <b><?= unpenetration($data['nama'])?></b> )</center></td></tr>
				</table>
				<!-- <table width="100%" style="margin-top: 100px;">
						<tr></tr>
						<tr></tr>
						<tr></tr>
						<tr><td></td><td width="55%"></td><td align="center"><?= unpenetration($desa['nama_desa'])?>, <?= $tanggal_sekarang?></td></tr>
						<tr><td></td><td width="55%"></td><td align="center"><?= ($input['atas_nama'])?></td></tr>
						<tr><td></td><td width="55%"></td><td align="center"><?= unpenetration($input['jabatan'])?>,</td></tr>
				</table>
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
				</table> -->
			</div>
			<div id="aside"></div>
			<div id="footer" class="container_12"></div>
		</div>
	</body>
</html>

