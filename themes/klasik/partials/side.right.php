<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-primary box-solid">
	<div class="box-body">
	<form method=get action="<?php echo site_url('first');?>" class="form-inline">
		<input type="text" name="cari" class="form-control" maxlength="50" value="<?= $cari ?>" placeholder="Cari artikel...">
		<button type="submit" class="btn btn-primary">Cari</button>
	</form>
	</div>
</div>
<?php 
$id = $this->db->database;
// $id = "sendangsaridb";

$get_peringkat = cget('dapetapa/'.$id.'/'.str_pad((date('m')-1),2,"0",STR_PAD_LEFT).'/'.date('Y'));

$get_prkt = $get_peringkat['result'];
?>

<?php 

if (!empty($get_prkt)) {
	foreach ($get_prkt as $pr) {
?>
<div class="box box-primary box-solid">
	<div class="box-body" style="background: #000; color: #fff; font-weight: bold; padding: 20px; ">
		<center>
			<!-- <h1><?=$pr['peringkat'];?></h1> -->
			<h3>Website Desa ini : <br>
				<?=$pr['caption'];?>
					
			</h3>
		</center>	
	</div>
</div>
<?php 
	}
}
?>
<!-- Tampilkan Widget -->

<div class="box box-primary box-solid">
	<div class="box-body">
		<a href="/simdes" class="btn btn-success" target="_blank" style="width: 100%;">
			<!-- <i class="fa fa-arrow-right" ></i> Aplikasi SIMDES -->
			<img src="<?php echo base_url(); ?>desa/logo/logo-simdes.png" style="width: 100%; height: auto;">
		</a>
	</div>
	<div class="box-body">
		<a href="http://siapdes.kulonprogokab.go.id/siapdes/" class="btn btn-success" target="_blank" style="width: 100%;">
			<!-- <i class="fa fa-arrow-right" ></i> Aplikasi SIAPDES -->
			<img src="<?php echo base_url(); ?>desa/logo/logo-siapdes.png" style="width: 100%; height: auto;">
		</a>
	</div>
	<div class="box-body">
		<a href="https://www.lapor.go.id/" class="btn btn-success" target="_blank" style="width: 100%;">
			<!-- <i class="fa fa-arrow-right" ></i> Aplikasi LAPOR  -->
			<img src="<?php echo base_url(); ?>desa/logo/lapor-logo.png" style="width: 100%; height: auto;">
		</a>
	</div>
</div>

<?php
if ($w_cos):
	foreach ($w_cos as $data):
		$widget = trim($data['isi']);
		if ($data["jenis_widget"] == 1):
			include("donjo-app/views/widgets/".$widget);
		elseif ($data["jenis_widget"] == 2):
			include($widget);
		else: ?>
			<div class="box box-primary box-solid">
				<div class="box-header">
					<h3 class="box-title"><?=$data["judul"]?></h3>
				</div>
				<div class="box-body">
					<?=html_entity_decode($data['isi'])?>
				</div>
			</div>
		<?php endif;
	endforeach;
endif;
?>
