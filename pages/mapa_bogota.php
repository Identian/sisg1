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
<div class="col-md-9">     



  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
			  
<h3>Mapa de calor</h3>
     

<div class="row">
<div class="col-md-4">
Licencias de obra ejecutoriadas:
</div>
<form action="" method="post" name="reewf">
<div class="col-md-3"> 
<input type="text" class="form-control datepickera" style="z-index:9;" name="fecha_desde" placeholder="Fecha desde" required readonly="readonly">
</div>
<div class="col-md-3"> 
<input type="test"  class="form-control datepickera" style="z-index:9;" name="fecha_hasta"  placeholder="Fecha hasta" required readonly="readonly">
</div>
<div class="col-md-2"> 
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-search"></span> Buscar </button>
</div>
</form>




</div>
	 <br>
	 
	 
<div id="mapid" style="width: 100%; min-height: 620px; position: relative;z-index:1;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
</div>



		  
		  
		  
		  
		    <div>
			<?php
if (0==$ed) { } else {
echo '<hr>';

$query="select * from barrio where id_localidad=".$ed." and estado_barrio=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo '<ul>';
do {

echo '<li>'.$row['nombre_barrio'].'</li>';

} while ($row = mysql_fetch_assoc($select)); 

echo '</ul>';
} else {}	 

mysql_free_result($select);




}
?>
          </div>
		  
	  </div>
            </div>
          </div>	  
		  

</div>
<div class="col-md-3"> 

<div class="box ">
<div class="box-body">
<div class="table-responsive">
<h3>Tipos de tramites (533.691)</h3>

<?php 

echo '<a href="mapa_bogota&0&'.$ed.'.jsp" ';
 if ($id==0) { echo 'style="color:#ff0000;"';
 } else { }
echo '>Todas las licencias</a><hr>';



$totalr=533691;


$query="select * from tipo_obra where estado_tipo_obra=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){	
do { ?>
<?php


$infotob= $row['cantidad'];



echo '<a href="mapa_bogota&'.$row['id_tipo_obra'].'&'.$ed.'.jsp" ';
 if ($id==$row['id_tipo_obra']) { echo 'style="color:#ff0000;"';
 } else { }

echo '>'.$row['nombre_tipo_obra'].'</a> ';


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
                <h3>Localidades</h3>
<?php 

echo '<a href="mapa_bogota&'.$id.'&0.jsp" ';
 if ($ed==0) { echo 'style="color:#ff0000;"';
 } else { }
echo '>Todas las localidades</a><hr>';



$query="select * from localidad where estado_localidad=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
echo '<a href="mapa_bogota&'.$id.'&'.$row['id_localidad'].'.jsp" ';

 if ($ed==$row['id_localidad']) { echo 'style="color:#ff0000;"';
 } else { }
 
echo '>'.$row['nombre_localidad'].'</a> ';

echo '<br>';
} while ($row = mysql_fetch_assoc($select)); 

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
var map = L.map('mapid').setView([4.612, -74.072], 11);
var tiles = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '<a href="http://osm.org/copyright">OpenStreetMap</a>',
}).addTo(map);

var heat = L.heatLayer([
<?php		
if (0==$id) {
	$id_tipo_obra="";
} else
{ $id_tipo_obra=" and id_tipo_obra=".$id.""; }

if (0==$ed) {

	$id_localidad="";
} else {
		$id_localidad=" and id_localidad=".$ed."";
	 }

	 
	 if (isset($_POST['fecha_desde']) and ""!=$_POST['fecha_desde']) {
	$fecha_desde=$_POST['fecha_desde'];
	
	$fecha_hasta=$_POST['fecha_hasta'];
	
$bfechas=" and fecha_ejecutoria>='$fecha_desde' and fecha_ejecutoria<='$fecha_hasta' "; 
} else {
$bfechas='';
 }

	 
		
$query="select latitud, longitud from licencia_obra where latitud is not null and longitud is not null ".$bfechas."  ".$id_tipo_obra." ".$id_localidad." limit 1000";

$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do { ?>
[<?php echo $row['latitud']; ?>, <?php echo $row['longitud']; ?>, 8],
<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
?>
[4.65, -74.2, 1]  // lat, lng, intensity
], {radius: 15}).addTo(map);



</script>

