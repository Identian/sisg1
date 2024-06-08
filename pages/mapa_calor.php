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

<script src="dist/js/leaflet-heat.js"></script>


<div class="row">
<div class="col-md-9">     



  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
			  
<h3>Analisis - Mapa de calor</h3>
     
	 
<div id="mapid" style="width: 100%; min-height: 620px; position: relative;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
</div>


  </div>
            </div>
          </div>

</div>
<div class="col-md-3"> 

<div class="box ">
<div class="box-body">
<div class="table-responsive">
<h3>PQRS por Regional</h3>
<?php 

$totalr=existenciaunica('asignacion_pqrs', 'id_tipo_oficina', 2);


$query="select * from region where estado_region=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){	
do { ?>
<?php

$infop=$row['id_region'];
$queryb="select count(id_asignacion_pqrs) as totalp from oficina_registro, asignacion_pqrs where oficina_registro.id_oficina_registro=asignacion_pqrs.codigo_oficina and asignacion_pqrs.id_tipo_oficina=2 and oficina_registro.id_region=".$infop." ";
$selectb = mysql_query($queryb, $conexion) or die(mysql_error());
$rowb = mysql_fetch_assoc($selectb);
$infotob= $rowb['totalp'];

 echo $row['nombre_region']; 

 echo ': '.$infotob; 
 
 $info3=($infotob*100)/$totalr;
 
 ?>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo round($info3, 2); ?>%">
<?php echo round($info3, 2); ?>%
</div>
</div>
<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
?>
</div>
</div>
</div>	




<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Estados de PQRS</h3>
<?php 

$query="select * from estado_solicitud where id_estado_solicitud!=3 and id_estado_solicitud!=1 and estado_estado_solicitud=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
echo '<a href="mapa.jsp">Solo ORIP</a><br>';
do {
echo '<a href="mapa&0&'.$row['id_estado_solicitud'].'.jsp">'.$row['nombre_estado_solicitud'].'</a> ';
if ($ed==$row['id_estado_solicitud']) { echo '<span class="glyphicon glyphicon-pushpin" style="color:#888;"></span>';
$color=$row['color'];
 } else {}
echo '<br>';
} while ($row = mysql_fetch_assoc($select)); 
echo '<a href="mapa&0&6.jsp">Vencidas</a> ';
if ($ed==6) { echo '<span class="glyphicon glyphicon-pushpin" style="color:#888;"></span>';
$color='#f03';
 } else {}
echo '<br>';
} else {}	 

mysql_free_result($select);


?>
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
$query="select * from oficina_registro where latitud is not null and estado_oficina_registro=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do { ?>
[<?php echo $row['latitud']; ?>, <?php echo $row['longitud']; ?>, <?php echo cantpqrs($row['id_oficina_registro']); ?>],
<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
?>
[4.65, -74.2, 1]  // lat, lng, intensity
], {radius: 25}).addTo(map);



</script>

