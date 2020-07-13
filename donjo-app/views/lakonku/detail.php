<div class="content-wrapper">
	<section class="content-header">
		<h1>Lakonku</h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Pelaporan Kematian</li>
            <li><?php echo $jenis; ?></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
    <div class="row">
			
				<div class="col-md-12">
                <div class="box box-info">
					<div class="box-header with-border">
									<a href="<?=site_url("agregat_dukcapil/cetak/$jenis/$export_date[tahun]/$export_date[semester]")?>" class="btn btn-social btn-flat bg-purple btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank" title="Cetak Data">
										<i class="fa fa-print"></i>Cetak
						</a>
									<a href="<?=site_url("agregat_dukcapil/excel/$lap")?>" class="btn btn-social btn-flat bg-navy btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank" title="Download Data">
										<i class="fa fa-download"></i>Unduh
						</a>
									<a href="<?=site_url("agregat_dukcapil/graph/$lap")?>" class="btn btn-social btn-flat bg-orange btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Grafik Data">
										<i class="fa  fa-bar-chart"></i>Grafik Data
						</a>
									<a href="<?=site_url("agregat_dukcapil/pie/$lap")?>" class="btn btn-social btn-flat btn-primary btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Pie Data">
										<i class="fa fa-pie-chart"></i>Pie Data
						</a>
					</div>
				
						<div class="box-body">
						<h3>Data Detail Pelaporan Kematian</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>NIK</label>
										<input class="form-control input-sm" type="text" value="<?= strtoupper($nik);?> " disabled="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>NAMA</label>
										<input class="form-control input-sm" type="text" value="<?= strtoupper($namaLgkp);?> " disabled="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>JENIS KELAMIN</label>
										<input class="form-control input-sm" type="text" value="<?= strtoupper($jenisKlmin);?> " disabled="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Tempat Lahir</label>
										<input class="form-control input-sm" type="text" value="<?= strtoupper($tmptLhr);?> " disabled="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Tgl Lahir</label>
										<input class="form-control input-sm" type="text" value="<?= strtoupper($tglLhr);?> " disabled="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Alamat</label>
										<input class="form-control input-sm" type="text" value="<?= strtoupper($alamat);?> " disabled="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Tempat Mati</label>
										<input class="form-control input-sm" type="text" value="<?= strtoupper($tempatMati);?> " disabled="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Tgl Mati</label>
										<input class="form-control input-sm" type="text" value="<?= strtoupper($tglMati);?> " disabled="">
									</div>
								</div>
							</div>
						
							<form method="POST" action="">
								<input type="hidden" name="nik" value="<?= strtoupper($nik);?> ">
								<input type="submit" name="submit" class="btn btn-danger btn-sm" value="setujui">
							</form>		
								
        				</div>
        			</div>
        		</div>
        	</div>
    </section>
 </div>