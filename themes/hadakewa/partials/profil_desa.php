

<div class="artikel" id="<?php echo 'artikel-'.$single_artikel['judul']?>">
	<h2 style="margin-top: 15px">Profil Monografi Desa</h2>
	<hr>
	<div class="teks">
		<p>
			<img src="<?=base_url('desa/logo/'.$main['logo']);?>"><br>
			<small>Logo desa <?php echo ucwords($this->setting->sebutan_desa)." "?>
			<?php echo ucwords($desa['nama_desa'])?></small><br><br>
		</p>

		<table class="table table-bordered">
			<tbody>
				<tr><td width="40%">Nama Desa</td><td width="50%"><?=$main['nama_desa'];?></td></tr>
				<tr><td>Nama Kepala Desa</td><td><?=$main['nama_kepala_desa'];?></td></tr>
				<tr><td>Alamat Kantor Desa</td><td><?=$main['alamat_kantor'];?></td></tr>
				<tr><td>Telepon</td><td><?=$main['telepon'];?></td></tr>
				<tr><td>Email</td><td><?=$main['email_desa'];?></td></tr>
				<tr><td>Website</td><td><?=$main['website'];?></td></tr>
				<tr><td>Kecamatan</td><td><?=$main['nama_kecamatan'];?></td></tr>
				<tr><td>Kode Pos</td><td><?=$main['kode_pos'];?></td></tr>
				<tr><td>Nama Camat</td><td><?=$main['nama_kepala_camat'];?></td></tr>
				<tr><td>Kabupaten</td><td><?=$main['nama_kabupaten'];?></td></tr>
				<tr><td>Provinsi</td><td><?=$main['nama_propinsi'];?></td></tr>
				<tr><td>Koordinat</td><td><?=$main['lat'];?> LS, <?=$main['lng'];?> BT</td></tr>

			</tbody>
		</table>

		<div class="form-group" style="clear:both;">
			<ul id="pageshare" title="Bagikan ke teman anda" class="pagination">
				<li class="sbutton" id="fb"><a name="fb_share" href="http://www.facebook.com/sharer.php?u=<?php echo site_url().'first/artikel/'.$single_artikel['id']?>"><i class="fa fa-facebook-square"></i>&nbsp;Share</a></li>
				<li class="sbutton" id="rt"><a href="http://twitter.com/share" class="twitter-share-button"><i class="fa fa-twitter"></i>&nbsp;Tweet</a></li>
				<li class="sbutton" id="gpshare"><a href="https://plus.google.com/share?url=<?php echo site_url().'first/artikel/'.$single_artikel['id'].'&hl=id'?>"><i class="fa fa-google-plus" style="color:red"></i>&nbsp;Bagikan</a></li>
				<li class="sbutton" id="wa_share"><a href="whatsapp://send?text=<?php echo site_url().'first/artikel/'.$single_artikel['id']?>"><i class="fa fa-whatsapp" style="color:green"></i>&nbsp;WhatsApp</a></li>
			</ul>
			<!--
			<script src=\"http://static.ak.fbcdn.net/connect.php/js/FB.Share\" type=\"text/javascript\"></script>
			<script src=\"http://platform.twitter.com/widgets.js\" type=\"text/javascript\"></script>
			-->
		</div>

	</div>
</div>