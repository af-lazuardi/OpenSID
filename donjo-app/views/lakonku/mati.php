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
							<div class="col-sm-12">
							<h3>Pelaporan Kematian Lakonku</h3>
								<?php echo $status; ?>
								<?php echo $data; ?>
								<table class="table table-bordered dataTable table-hover">
									<thead>
										<th>No</th>
										<th>Nik</th>
										<th>Nama</th>
										<th>Tgl Lahir</th>
										<th>Alamat</th>
										<th>Tempat Mati</th>
										<th>Tgl Mati</th>
										<th>Setujui</th>
										<th>Detail</th>
										
									</thead>
									<tbody>
										<?php foreach ($content AS $data): $i++;?>
										<tr>
											<td><?= $i?></td>
											<td><?= $data->nik?></td>
											<td><?= $data->namaLgkp?></td>
											<td><?= $data->tglLhr?></td>
											<td><?= $data->alamat." RT ".$data->noRt?></td>
											<td><?= $data->tempatMati?></td>
											<td><?= $data->tglMati?></td>
											<td><?= $data->approveDesa?></td>
											<td><a href="<?= site_url("lakonku/detail/$data->nik")?>" class="btn btn-info">Detail</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
        				</div>
        			</div>
        		</div>
        	</div>
    </section>
 </div>