<!--
https://leafletjs.com/examples/quick-start/
-->

<?php


if (isset($_GET['i'])) {
	$id=intval($_GET['i']);
} else {$id=0; }

if (isset($_GET['e'])) {
	$ed=intval($_GET['e']);
} else {$ed=0; }
	?>

	  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>

<!--<script src="http://leaflet.github.io/Leaflet.heat/dist/leaflet-heat.js"></script>-->

<script src="dist/js/leaflet-heat.js"></script>




<div class="row">
<div class="col-md-12">     



  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
			  
<h3>Mapa de calor - Permisos</h3>
     


	 <br>
	 
	 
<div id="mapid" style="width: 100%; min-height: 620px; position: relative;z-index:1;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
</div>



		  
	  </div>
            </div>
          </div>	  
		  

</div>

</div>

<script>
var map = L.map('mapid').setView([4.612, -74.072], 6);
var tiles = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '<a href="http://osm.org/copyright">OpenStreetMap</a>',
}).addTo(map);

var heat = L.heatLayer([
<?php		
	
$query="select id_notaria, latitud, longitud from notaria where latitud!=''";

$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do { ?>
[<?php echo $row['latitud']; ?>, <?php echo $row['longitud']; ?>, <?php $tnota=existenciaunica('permiso', 'id_notaria', $row['id_notaria']); $nota2=$tnota/2;echo $nota2; ?>],
<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
?>
[4.65, -74.2, 3]  // lat, lng, intensity
], {radius: 15}).addTo(map);



</script>

