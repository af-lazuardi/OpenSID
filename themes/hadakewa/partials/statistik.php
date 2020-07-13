<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">
      <?php if($export_date['tahun'] !=null) { ?>
        <h3 class="text-center">TAHUN : <?= $export_date['tahun']?> SEMESTER : <?= $export_date['semester']?></h3>
      <?php } ?>
    </h3>
    <div class="box-tools pull-right">
      <div class="btn-group-xs">";

      </div>
    </div>
  </div>
  <div class="box-body">
    <form id="main" name="main" action="" method="post" class="form-horizontal">
              <div class="form-group">
                <label for="nik"  class="col-sm-3 control-label">Tahun</label>
                <div class="col-sm-6 col-lg-4">
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
    <?php if($stat == null) { ?>
      <h3 class="text-center text-danger">Data Belum Tersedia</h3>
    <?php } ?>

  </div>
</div>



<?php if($tipe==1){?>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function () {

        chart = new Highcharts.Chart({
            chart: { renderTo: 'container'},
            title:0,
					xAxis: {
                        categories: [
						<?php  $i=0;foreach($stat as $data){$i++;?>
						  <?php if($data['jumlah'] != "-" AND $data['nama']!= "TOTAL" AND $data['nama']!= "JUMLAH"){echo "'$i',";}?>
						<?php }?>
						]
					},
				plotOptions: {
					series: {
						colorByPoint: true
					},
					column: {
						pointPadding: -0.1,
						borderWidth: 0
					}
				},
					legend: {
                        enabled:false
					},
            series: [{
                type: 'column',
                name: 'Jumlah Populasi',
				shadow:1,
				border:1,
                data: [
						<?php  foreach($stat as $data){?>
							<?php if($data['jumlah'] != "-" AND $data['nama']!= "TOTAL" AND $data['nama']!= "JUMLAH"){?>
								['<?php echo $data['nama']?>',<?php echo $data['jumlah']?>],
							<?php }?>
						<?php }?>
                ]
            }]
        });
    });

});
</script>
<?php }else{?>

<script type="text/javascript">
$(function () {
    var chart;

    $(document).ready(function () {

    	// Build the chart
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container'
            },
            title:0,
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Jumlah Populasi',
				shadow:1,
				border:1,
                data: [
						<?php  foreach($stat as $data){?>
							<?php if($data['jumlah'] != "-" AND $data['nama']!= "TOTAL" AND $data['nama']!= "JUMLAH"){?>
								['<?php echo $data['nama']?>',<?php echo $data['jumlah']?>],
							<?php }?>
						<?php }?>
                ]
            }]
        });
    });

});
</script>
<?php }?>
<script src="<?php echo base_url()?>assets/js/highcharts/highcharts.js"></script>
<script src="<?php echo base_url()?>assets/js/highcharts/highcharts-more.js"></script>
<script src="<?php echo base_url()?>assets/js/highcharts/exporting.js"></script>
<style>
	tr.lebih{
		display:none;
	}
</style>
<script>
$(function(){
	$('#showData').click(function(){
		$('tr.lebih').show();
		$('#showData').hide();
	});
});
</script>
<?php

	echo "
	<div class=\"box box-danger\">
		<div class=\"box-header with-border\">
			<h3 class=\"box-title\">Grafik Data Demografi Berdasar ". $heading."</h3>
			<div class=\"box-tools pull-right\">
				<div class=\"btn-group-xs\">";
					$strC = ($tipe==1)? "btn-primary":"btn-default";
					echo "<a href=\"".site_url("first/statistik/$st/1")."\" class=\"btn ".$strC." btn-xs\">Bar Graph</a>";
					$strC = ($tipe==0)? "btn-primary":"btn-default";
					echo "<a href=\"".site_url("first/statistik/$st/0")."\" class=\"btn ".$strC." btn-xs\">Pie Cart</a>
				</div>
			</div>
		</div>
		<div class=\"box-body\">
			<div id=\"container\"></div>
			<div id=\"contentpane\">
				<div class=\"ui-layout-north panel top\"></div>
			</div>
		</div>
	</div>

	<div class=\"box box-danger\">
		<div class=\"box-header with-border\">
			<h3 class=\"box-title\">Tabel Data Demografi Berdasar ". $heading."</h3>
		</div>
		<div class=\"box-body\">
			<div class=\"table-responsive\">
			<table class=\"table table-striped\">
				<thead>
				<tr>
					<th rowspan=\"2\">No</th>
					<th rowspan=\"2\" style='text-align:left;'>Kelompok</th>
					<th colspan=\"2\">Jumlah</th>";
          if($jenis_laporan == 'penduduk'){
            echo "<th colspan=\"2\">Laki-laki</th>
            <th colspan=\"2\">Perempuan</th>";
          }
					echo "
        </tr>
				<tr>
					<th style='text-align:right'>n</th><th style='text-align:right'>%</th>";
          if($jenis_laporan == 'penduduk'){
  					echo "<th style='text-align:right'>n</th><th style='text-align:right'>%</th>
  					<th style='text-align:right'>n</th><th style='text-align:right'>%</th>";
          }
          echo "
				</tr>
				</thead>
				<tbody>";
				$i=0; $l=0; $p=0;
				$hide="";$h=0;
				$jm = count($stat);
				foreach($stat as $data){
					$h++;
					if($h > 10 AND $jm > 11)$hide="lebih";
					echo "<tr class=\"$hide\">
						<td class=\"angka\">".$data['no']."</td>
						<td>".$data['nama']."</td>
						<td class=\"angka\">".$data['jumlah']."</td>
						<td class=\"angka\">".$data['persen']."</td>";
          if($jenis_laporan == 'penduduk'){
            echo "<td class=\"angka\">".$data['laki']."</td>
            <td class=\"angka\">".$data['persen1']."</td>
            <td class=\"angka\">".$data['perempuan']."</td>
            <td class=\"angka\">".$data['persen2']."</td>";
          }
					echo "</tr>";
					$i=$i+$data['jumlah'];
					$l=$l+$data['laki']; $p=$p+$data['perempuan'];
				}
				echo "
				</tbody>
			</table>";
			if($hide=="lebih"){
				echo "
				<div style='margin-left:20px;'>
				<button class='uibutton special' id='showData'>Selengkapnya...</button>
				</div>
				";
			}

		echo "
		</div>
		</div>
	</div>";
