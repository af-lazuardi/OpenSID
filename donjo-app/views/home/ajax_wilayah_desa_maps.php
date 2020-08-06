<script>

var infoWindow;
window.onload = function()
{

  //Jika posisi kantor rt belum ada, maka posisi peta akan menampilkan seluruh Indonesia
	<?php if (!empty($desa['lat']) && !empty($desa['lng'])): ?>
    var posisi = [<?=$desa['lat'].",".$desa['lng']?>];
    var zoom = <?=$desa['zoom'] ?: 18?>;
	<?php else: ?>
    var posisi = [-1.0546279422758742,116.71875000000001];
    var zoom = 4;
	<?php endif; ?>
	//Menggunakan https://github.com/codeofsumit/leaflet.pm
	//Inisialisasi tampilan peta
  var peta_desa = L.map('map').setView(posisi, zoom);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
	{
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    id: 'mapbox.streets'
  }).addTo(peta_desa);

  //Tombol uplad import file GPX
  var style = {
    color: 'red',
    opacity: 1.0,
    fillOpacity: 1.0,
    weight: 4,
    clickable: false
  };

  L.Control.FileLayerLoad.LABEL = '<img class="icon" src="<?= base_url()?>assets/images/folder.svg" alt="file icon"/>';
  control = L.Control.fileLayerLoad({
    fitBounds: true,
    layerOptions: {
      style: style,
      pointToLayer: function (data, latlng) {
        return L.circleMarker(
          latlng,
          { style: style }
        );
      }
    }
  });
  control.addTo(peta_desa);
  control.loader.on('data:loaded', function (e) {
    var layer = e.layer;
    console.log(layer);
  });

  //Tombol yang akan dimunculkan dipeta
  var options =
	{
    position: 'topright', // toolbar position, options are 'topleft', 'topright', 'bottomleft', 'bottomright'
    drawMarker: false, // adds button to draw markers
    drawCircleMarker: false, // adds button to draw markers
    drawPolyline: false, // adds button to draw a polyline
    drawRectangle: false, // adds button to draw a rectangle
    drawPolygon: true, // adds button to draw a polygon
    drawCircle: false, // adds button to draw a cricle
    cutPolygon: false, // adds button to cut a hole in a polygon
    editMode: true, // adds button to toggle edit mode for all layers
    removalMode: true, // adds a button to remove layers
  };

  //Menambahkan toolbar ke peta
  peta_desa.pm.addControls(options);

  //Menambahkan Peta wilayah
  peta_desa.on('pm:create', function(e)
	{
    var type = e.layerType;
    var layer = e.layer;
    var latLngs;

    if (type === 'circle') {
       latLngs = layer.getLatLng();
    }
    else
       latLngs = layer.getLatLngs();

    var p = latLngs;
    var polygon = L.polygon(p, { color: '#A9AAAA', weight: 4, opacity: 1 }).addTo(peta_desa);

    polygon.on('pm:edit', function(e)
  	{
      document.getElementById('path').value = getLatLong('Poly', e.target).toString();
    })

  });

  //Menghapus Peta wilayah
  peta_desa.on('pm:globalremovalmodetoggled', function(e)
	{
    document.getElementById('path').value = '';
  })

  //Merubah Peta wilayah yg sudah ada
  <?php if (!empty($desa['path'])): ?>
  var daerah_desa = <?=$desa['path']?>;

  //Titik awal dan titik akhir poligon harus sama
  daerah_desa[0].push(daerah_desa[0][0]);

  var poligon_desa = L.polygon(daerah_desa).addTo(peta_desa);
  poligon_desa.on('pm:edit', function(e)
	{
    document.getElementById('path').value = getLatLong('Poly', e.target).toString();
  })
  setTimeout(function() {peta_desa.invalidateSize();peta_desa.fitBounds(poligon_desa.getBounds());}, 500);
  <?php endif; ?>

   //Fungsi
  function getLatLong(x, y)
	{
    var hasil;
    if (x == 'Rectangle' || x == 'Line' || x == 'Poly')
		{
      hasil = JSON.stringify(y._latlngs);
    }
		else
		{
      hasil = JSON.stringify(y._latlng);
    }
    hasil = hasil.replace(/\}/g, ']').replace(/(\{)/g, '[').replace(/(\"lat\"\:|\"lng\"\:)/g, '');
    return hasil;
  }

}; //EOF window.onload
</script>
<style>
	#map
	{
		width:100%;
		height:65vh
	}
  .icon {
    max-width: 70%;
    max-height: 70%;
    margin: 4px;
  }

</style>
<!-- Menampilkan OpenStreetMap -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Peta Wilayah <?= ucwords($this->setting->sebutan_desa." ".$desa['nama_desa'])?></h1>
		<ol class="breadcrumb">
      <li><a href="<?= site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url("hom_desa/konfigurasi")?>"> Identitas <?=ucwords($this->setting->sebutan_desa)?></a></li>
			<li class="active">Peta Wilayah <?= ucwords($this->setting->sebutan_desa." ".$desa['nama_desa'])?></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
        <div class="box box-info">
  				<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
  					<div class="box-body">
  						<div class="row">
  							<div class="col-sm-12">
							    <div id="map">
                    <input type="hidden" id="path" name="path" value="<?= $desa['path']?>">
                  </div>
       	       </div>
          	</div>
            <div class='box-footer'>
              <div class='col-xs-12'>
                <button type='reset' class='btn btn-social btn-flat btn-danger btn-sm invisible' ><i class='fa fa-times'></i> Batal</button>
                <button type='submit' class='btn btn-social btn-flat btn-info btn-sm pull-right'><i class='fa fa-check'></i> Simpan</button>
              </div>
            </div>
          </form>
				</div>
			</div>
		</div>
	</section>
</div>

<script>

  $(document).ready(function(){
      $('#simpan_kantor').click(function(){
      if (!$('#validasi').valid()) return;

      var path = $('#path').val();
      $.ajax(
			{
        type: "POST",
        url: "<?=$form_action?>",
        dataType: 'json',
        data: {path: path},
			});
		});
	});
</script>
<script src="<?= base_url()?>assets/js/validasi.js"></script>
<script src="<?= base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url()?>assets/js/leaflet.filelayer.js"></script>
<script src="<?= base_url()?>assets/js/togeojson.js"></script>
