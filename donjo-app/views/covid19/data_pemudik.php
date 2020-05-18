<style>
	.input-sm
	{
		padding: 4px 4px;
	}
</style>


<div class="content-wrapper">
	<section class="content-header">
		<h1><?=$title_header?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?=$title_breadcumb?></li>
		</ol>
	</section>

	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs -->
				<div class="nav-tabs-custom">
				  <ul class="nav nav-tabs">
				    <li class="<?php ($selected_nav=='pemudik') and print('active'); ?>"><a href="<?=site_url('covid19/pemudik')?>">Pemudik</a></li>
				    <li class="<?php ($selected_nav=='penduduk') and print('active'); ?>"><a href="<?=site_url('covid19/penduduk')?>">Penduduk</a></li>
				  </ul>
				  <div class="tab-content">
				    <div class="tab-pane <?php ($selected_nav=='pemudik') and print('active'); ?>">
				    	<?php $this->load->view('covid19/table_pemudik') ?>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane <?php ($selected_nav=='penduduk') and print('active'); ?>">
				    	<?php $this->load->view('covid19/table_penduduk') ?>
				    </div>
				    <!-- /.tab-pane -->
				  </div>
				  <!-- /.tab-content -->
				</div>
				<!-- nav-tabs-custom -->
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('global/confirm_delete');?>

<div class="modal fade" id="modalBox" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'></h4>
			</div>
			<div class="fetched-data"></div>
		</div>
	</div>
</div>
