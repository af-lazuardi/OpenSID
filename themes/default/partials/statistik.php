<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

 <div class="box box-info">
						<div class="box-body">
							<div class="col-sm-12">
								<h3 class="text-center">DATA PENDUDUK MENURUT <?= strtoupper($agregat['jenis'])?></h3>
								<br>
								<?php if($agregat['export_date']['tahun'] !=null) { ?>
									<h3 class="text-center">TAHUN : <?= $agregat['export_date']['tahun']?> SEMESTER : <?= $agregat['export_date']['semester']?></h3>
								<?php } ?>
								<br>
								<form id="main" name="main" action="" method="post" class="form-horizontal">
													<div class="form-group">
														<label for="nik"  class="col-sm-3 control-label">Tahun</label>
														<div class="col-sm-6 col-lg-4">
															<?php 
															echo form_dropdown('tahun',array(""=>"Tahun","2018"=>"2018","2017"=>"2017","2016"=>"2016"),$ambil['tahun'],'class="form-control input-sm" id="nik"');
															?>
														</div>
													</div>
													<div class="form-group">
														<label for="nik"  class="col-sm-3 control-label">Semester</label>
														<div class="col-sm-6 col-lg-4">
															<?php 
															echo form_dropdown('semester',array(""=>"Semester","1"=>"1","2"=>"2"),$ambil['semester'],'class="form-control input-sm" id="nik"');
															?>
														</div>
													</div>
													<div class="form-group">
														<label for="nik"  class="col-sm-3 control-label"></label>
														<div class="col-sm-6 col-lg-4">
			
														<button type="submit" class="btn btn-sosial btn-flat btn-success btn-sm" onclick="formAction('main')"><i class="fa fa-plus"></i>Tampilkan</button>
														</div>
													</div>
								</form>
								<table class="table table-bordered dataTable table-hover">
									<thead>
										<th>No</th>
										<th>Kategori</th>
										<th>Laki-laki</th>
										<th>Perempuan</th>
										<th>Jumlah</th>
									</thead>
									<tbody>
										<?php foreach ($agregat['content'] AS $data): $i++;?>
										<tr>
											<td><?= $i?></td>
											<td><?= $data->kategori?></td>
											<td><?= $data->lakiLaki?></td>
											<td><?= $data->perempuan?></td>
											<td><?= $data->jumlah?></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
        				</div>
        			</div>
        		</div>