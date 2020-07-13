<div class="content-wrapper">
	<section class="content-header">
		<h1>Laporan Datang</h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Laporan Datang</li>
            <li><?php echo $jenis; ?></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
    <div class="row">
			
				<div class="col-md-12">
                <div class="box box-info">
					<div class="box-header with-border">
									<a href="<?=site_url("laporan_dukcapil/cetak/$jenis/$export_date[startDate]/$export_date[endDate]")?>" class="btn btn-social btn-flat bg-purple btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank" title="Cetak Data">
										<i class="fa fa-print"></i>Cetak
						</a>
					</div>
						<div class="box-body">
							<div class="col-sm-12">
								<form id="main" name="main" action="" method="post" class="form-horizontal">
									<div class="form-group">
										<label for="berlaku_dari" class="col-sm-3 control-label">Dari - Sampai</label>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal" value="<?= $export_date['startDate'] ?>" name="startDate" class="form-control input-sm datepicker required" type="text"/>
											</div>
										</div>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal" value="<?= $export_date['endDate'] ?>"  class="form-control input-sm datepicker required" name="endDate" type="text"/>
											</div>
										</div>
								</div>
													<div class="form-group">
														<label for="nik"  class="col-sm-3 control-label"></label>
														<div class="col-sm-6 col-lg-4">
			
														<button type="submit" class="btn btn-sosial btn-flat btn-success btn-sm" onclick="formAction('main')"><i class="fa fa-plus"></i>Tampilkan</button>
														</div>
													</div>
								</form>

								<?php echo $data; ?>
								<table class="table table-bordered dataTable table-hover">
									<thead>
										<th>No</th>
										<th>No Datang</th>
										<th>Nik</th>
										<th>Nama</th>
										<th>Alamat</th>
										<th>Desa</th>
										<th>Kecamatan</th>
										<th>kabupaten</th>
										<th>Provinsi</th>
										<th>Tgl Datang</th>
									</thead>
									<tbody>
										<?php foreach ($content AS $data): $i++;?>
										<tr>
											<td><?= $i?></td>
											<td><?= $data->noPindah?></td>
											<td><?= $data->nik?></td>
											<td><?= $data->namaLgkp?></td>
											<td><?= $data->alamatAsal?></td>
											<td><?= $data->desaAsal?></td>
											<td><?= $data->kecamatanAsal?></td>
											<td><?= $data->kabupatenAsal?></td>
											<td><?= $data->provinsiAsal?></td>
											<td><?= $data->createdDate?></td>
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