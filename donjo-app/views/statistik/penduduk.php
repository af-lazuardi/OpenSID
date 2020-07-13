<style type="text/css">
  .disabled
	{
     pointer-events: none;
     cursor: default;
  }
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Statistik Kependudukan</h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Statistik Kependudukan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div class="col-md-4">
          <?php $this->load->view('statistik/laporan/side-menu.php')?>
				</div>
				<div class="col-md-8">
					<div class="box box-info">
            <div class="box-header with-border">
							<a href="<?=site_url("statistik/dialog_cetak/$lap/$export_date[tahun]/$export_date[semester]")?>" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Laporan" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Laporan"><i class="fa fa-print "></i>Cetak
            	</a>
							<a href="<?=site_url("statistik/dialog_unduh/$lap/$export_date[tahun]/$export_date[semester]")?>" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Laporan" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Laporan"><i class="fa fa-print "></i>Unduh
            	</a>
							<a href="<?=site_url("statistik/graph/$lap/$export_date[tahun]/$export_date[semester]")?>" class="btn btn-social btn-flat bg-orange btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Grafik Data">
								<i class="fa  fa-bar-chart"></i>Grafik Data
            	</a>
							<a href="<?=site_url("statistik/pie/$lap/$export_date[tahun]/$export_date[semester]")?>" class="btn btn-social btn-flat btn-primary btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Pie Data">
								<i class="fa fa-pie-chart"></i>Pie Data
            	</a>
						
						</div>
						<div class="box-body">
              <div>
                <form id="main" name="main" action="" method="post" class="form-horizontal">
                          <div class="form-group">
                            <label for="nik"  class="col-sm-1 control-label">Tahun</label>
                            <div class="col-sm-4 col-lg-2">
                              <select class="form-control  input-sm " id="nik" name="tahun" value="<?= $export_date['tahun'] ?>"style ="width:100%;" >
                                <option value="">-- Tahun --</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                                <option value="2014">2014</option>
                                <option value="2013">2013</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nik"  class="col-sm-1 control-label">Semester</label>
                            <div class="col-sm-4 col-lg-2">
                              <select class="form-control  input-sm" id="nik" name="semester"  value="<?= $export_date['semester'] ?>" style ="width:100%;" >
                                <option value="">-- Semester --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nik"  class="col-sm-1 control-label"></label>
                            <div class="col-sm-4 col-lg-2">

                            <button type="submit" class="btn btn-sosial btn-flat btn-success btn-sm" onclick="formAction('main')"><i class="fa fa-plus"></i>Tampilkan</button>
                            </div>
                          </div>
                </form>
                <br>
                <?php if($main == null) { ?>
                  <h3 class="text-center text-danger">Data Belum Tersedia</h3>
                <?php } ?>

              </div>
							<div class="col-sm-12">
								<?php if ($lap < 50): ?>
									<h4 class="box-title"><b>Data Kependudukan menurut <?= ($stat);?></b></h4>
								<?php else: ?>
									<h4 class="box-title"><b>Data Peserta Program <?= ($program['nama'])?></b></h4>
								<?php endif; ?>
								<div class="table-responsive">
									<table class="table table-bordered dataTable table-striped table-hover nowrap">
										<thead class="bg-gray color-palette">
											<tr>
												<th width='5%'>No</th>
												<?php if ($o==2): ?>
                          <th><a href="<?= site_url("statistik/index/$lap/1")?>"><?= $judul_kelompok ?> <i class='fa fa-sort-asc fa-sm'></i></a></th>
                        <?php elseif ($o==1): ?>
                          <th><a href="<?= site_url("statistik/index/$lap/2")?>"><?= $judul_kelompok ?> <i class='fa fa-sort-desc fa-sm'></i></a></th>
                        <?php else: ?>
                          <th><a href="<?= site_url("statistik/index/$lap/1")?>"><?= $judul_kelompok ?> <i class='fa fa-sort fa-sm'></i></a></th>
                        <?php endif; ?>
                        <?php if ($o==6): ?>
                          <th nowrap colspan="2"><a href="<?= site_url("statistik/index/$lap/5")?>">Jumlah <i class='fa fa-sort-asc fa-sm'></i></a></th>
                        <?php elseif ($o==5): ?>
                          <th nowrap colspan="2"><a href="<?= site_url("statistik/index/$lap/6")?>">Jumlah <i class='fa fa-sort-desc fa-sm'></i></a></th>
                        <?php else: ?>
                          <th nowrap colspan="2"><a href="<?= site_url("statistik/index/$lap/5")?>">Jumlah <i class='fa fa-sort fa-sm'></i></a></th>
                        <?php endif; ?>

												<?php if ($lap<20 OR ($lap>50 AND $program['sasaran']==1)): ?>
													<?php if ($o==4): ?>
                            <th nowrap colspan="2"><a href="<?= site_url("statistik/index/$lap/3")?>">Laki-Laki <i class='fa fa-sort-asc fa-sm'></i></a></th>
                          <?php elseif ($o==3): ?>
                            <th nowrap colspan="2"><a href="<?= site_url("statistik/index/$lap/4")?>">Laki-Laki <i class='fa fa-sort-desc fa-sm'></i></a></th>
                          <?php else: ?>
                            <th nowrap colspan="2"><a href="<?= site_url("statistik/index/$lap/3")?>">Laki-Laki <i class='fa fa-sort fa-sm'></i></a></th>
                          <?php endif; ?>
													<?php if ($o==8): ?>
                            <th nowrap colspan="2"><a href="<?= site_url("statistik/index/$lap/7")?>">Perempuan <i class='fa fa-sort-asc fa-sm'></i></a></th>
                          <?php elseif ($o==7): ?>
                            <th nowrap colspan="2"><a href="<?= site_url("statistik/index/$lap/8")?>">Perempuan <i class='fa fa-sort-desc fa-sm'></i></a></th>
                          <?php else: ?>
                            <th nowrap colspan="2"><a href="<?= site_url("statistik/index/$lap/7")?>">Perempuan <i class='fa fa-sort fa-sm'></i></a></th>
                          <?php endif; ?>
												<?php endif; ?>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($main as $data): ?>
												<?php if ($lap>50) $tautan_jumlah = site_url("program_bantuan/detail/1/$lap"); ?>
												<tr>
													<td><?= $data['no']?></td>
													<td><?= strtoupper($data['nama']);?></td>
													<td>
														<?php if ($lap==21 OR $lap==22 OR $lap==23 OR $lap==24 OR $lap==25 OR $lap==26 OR $lap==27 OR "$lap"=='kelas_sosial'): ?>
															<a href="<?= site_url("keluarga/statistik/$lap/$data[id]")?>/0" <?php if ($data['id']=='JUMLAH'): ?>class="disabled"<?php endif; ?>><?= $data['jumlah']?></a>
														<?php else: ?>
															<?php if ($lap<50) $tautan_jumlah = site_url("penduduk/statistik/$lap/$data[id]"); ?>
															<a href="<?= $tautan_jumlah ?>/0" <?php if ($data['id']=='JUMLAH'): ?> class="disabled"<?php endif; ?>><?= $data['jumlah']?></a>
														<?php endif; ?>
													</td>
													<td><?= $data['persen'];?></td>
													<?php if ($lap==21 OR $lap==22 OR $lap==23 OR $lap==24 OR $lap==25 OR $lap==26 OR $lap==27 OR "$lap"=='kelas_sosial'):
															$tautan_jumlah = site_url("keluarga/statistik/$lap/$data[id]");
															elseif ($lap<50): $tautan_jumlah = site_url("penduduk/statistik/$lap/$data[id]");endif;
													?>
													<?php if ($lap<20 OR ($lap>50 AND $program['sasaran']==1)): ?>
														<td><a href="<?= $tautan_jumlah?>/1" <?php if ($data['id']=='JUMLAH'): ?>class="disabled"<?php endif; ?>><?= $data['laki']?></a></td>
														<td><?= $data['persen1'];?></td>
														<td><a href="<?= $tautan_jumlah?>/2" <?php if ($data['id']=='JUMLAH'): ?>class="disabled"<?php endif; ?>><?= $data['perempuan']?></a></td>
														<td><?= $data['persen2'];?></td>
													<?php endif; ?>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
