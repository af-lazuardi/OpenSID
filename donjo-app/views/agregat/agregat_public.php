<div class="box box-info">
						<div class="box-body">
							<div class="col-sm-12">
								<form id="main" name="main" action="" method="post" class="form-horizontal">
													<div class="form-group">
														<label for="nik"  class="col-sm-3 control-label">Tahun</label>
														<div class="col-sm-6 col-lg-4">
															<select class="form-control  input-sm " id="nik" name="tahun" value="<?= $export_date['tahun'] ?>"style ="width:100%;" >
																<option value="">-- Tahun --</option>
																<option value="2018">2018</option>
																<option value="2017">2017</option>
																<option value="2016">2016</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="nik"  class="col-sm-3 control-label">Semester</label>
														<div class="col-sm-6 col-lg-4">
															<select class="form-control  input-sm" id="nik" name="semester"  value="<?= $export_date['semester'] ?>" style ="width:100%;" >
																<option value="">-- Semester --</option>
																<option value="1">1</option>
																<option value="2">2</option>
															</select>
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
										<?php foreach ($content AS $data): $i++;?>
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