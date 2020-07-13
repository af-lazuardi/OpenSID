<div class="artikel" id="<?php echo 'artikel-'.$single_artikel['judul']?>">
	<h2 style="margin-top: 15px">Produk Hukum Desa</h2>
	<hr>
	<div class="teks">
		<p>
			Daftar Produk Hukum <?php echo ucwords($this->setting->sebutan_desa)." "?>
			<?php echo ucwords($desa['nama_desa'])?> adalah sebagai berikut : 
		</p>
		
		 <div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
			        <th width="1%">No</th>
			        <th>Nomor</th>
			        <th>Tahun</th>
			        <th>Judul</th>
			        <th>Keterangan</th>
			        <th>File</th>
			        <th>Status</th>
			    </tr>
			</thead>
			<tbody>
			    <?php 
					$no = 1;
		            foreach ($prokum as $result) {
		            	$id = $result['id'];
		            	$judul = $result['nama'];
		            	$file = $result['satuan'];
		                $j = json_decode($result['attr']);
		                $keterangan = $j->uraian;
		                $no_ditetapkan = $j->no_ditetapkan;
		                $tahun_ditetapkan = $j->tahun_ditetapkan;
		                $status = $j->status;
				?>
			    <tr>
			        <td style="text-align: center;"><?php echo $no++; ?></td>
					<td style="text-align: center;"><?php echo $no_ditetapkan; ?></td>
					<td style="text-align: center;"><?php echo $tahun_ditetapkan; ?></td>
					<td><?php echo $judul; ?></td>
					<td><?php echo $keterangan; ?></td>
					<td>
						<form method="post">
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<a href="<?=site_url("first/tampil_dokumen/".$id)?>" ><?php echo $file; ?></a>
						</form>
					</td>
					<td><?php echo $status; ?></td>

			    </tr>
			    <?php } ?> <!-- Selesai loop -->
			</tbody>
			</table>
		</div>

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