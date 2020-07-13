

<div class="artikel" id="<?php echo 'artikel-'.$single_artikel['judul']?>">
	<h2 style="margin-top: 15px">Daftar Pedukuhan</h2>
	<hr>
	<div class="teks">
		<p>
			<?php echo ucwords($this->setting->sebutan_desa)." "?>
			<?php echo ucwords($desa['nama_desa'])?> terdiri dari <?=count($main);?> pedukuhan, yaitu sebagai berikut : 
		</p>
		<table class="table table-bordered">
			<thead>
				<tr>
					<td>No</td>
					<td>Nama Pedukuh</td>
					<td>Nama Dukuh</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				if (!empty($main)) {
					foreach ($main as $p) {
				?>
					<tr>
						<td class="text-center"><?=($no++);?></td>
						<td><?=str_replace("_", " ", $p['dusun']);?></td>
						<td><?=$p['nama'];?></td>
					</tr>
				<?php 
					}
				}
				?>

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