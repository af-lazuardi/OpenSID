<div class="artikel" id="<?php echo 'artikel-'.$single_artikel['judul']?>">
	<h2 style="margin-top: 15px">Produk Hukum Desa</h2>
	<hr>
	<div class="teks">
		<p>
			Daftar Produk Hukum <?php echo ucwords($this->setting->sebutan_desa)." "?>
			<?php echo ucwords($desa['nama_desa'])?> adalah sebagai berikut : 
		</p>
		<?php 
		foreach ($prokum as $result) {
			$file = $result['satuan'];
			$id = $result['id'];
		?>
		 	<embed src="<?php echo base_url("desa/upload/dokumen/".$file); ?>" width="100%" height="330"> </embed>
		 	</br></br></br>
		 	<form action="<?=site_url("first/download/".$id)?>" method="post">
				<button type="submit" class="btn btn-primary" style="float: right;">Download</button>
			</form>
		<?php } ?>

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