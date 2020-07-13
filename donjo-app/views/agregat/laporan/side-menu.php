<input id="kategori" name="kategori" type="hidden" value="<?= $kategori ?>" />
<div id="penduduk" class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Statistik Penduduk</h3>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
	   <li <?php if ($jenis=="umur"): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/umur')?>">Umur</a></li>
      <li <?php if ($jenis=="pendidikan"): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/pendidikan')?>">Pendidikan</a></li>
      <li <?php if ($jenis=="pekerjaan"): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/pekerjaan')?>">Pekerjaan</a></li>
      <li <?php if ($jenis=="statKwn"): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/statKwn')?>">Status Perkawinan</a></li>
      <li <?php if ($jenis=="agama"): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/agama')?>">Agama</a></li>
      <li <?php if ($lap==4): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/4')?>">Jenis Kelamin</a></li>
      <li <?php if ($lap==5): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/5')?>">Warga Negara</a></li>
      <li <?php if ($lap==6): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/6')?>">Status Penduduk</a></li>
      <li <?php if ($lap==7): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/7')?>"> Golongan Darah</a></li>
      <li <?php if ($lap==9): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/9')?>">Penyandang Cacat</a></li>
      <li <?php if ($lap==17): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/17')?>">Akte Kelahiran</a></li>
      <li <?php if ($lap==18): ?>class="active"<?php endif; ?>><a href="<?=site_url('agregat_dukcapil/index/18')?>">Kepemilikan KTP</a></li>
		</ul>
	</div>
</div>
