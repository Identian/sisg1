<div class="row">
 <div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-body">

  
<h4>PERCEPCIÓN - NACIONAL: 
<?php echo existencia('percepcion_oac').' registros.';?>
</h4>

<div style="text-align:right"><a href="xls/percepcion.xls"><img src="images/excel.png"></a></div>


<div style="width:100%;height:200px;">
<canvas id="chartjs-7" class="chartjs" style="width:100%;height:200px;">
</canvas></div>
</div>
</div>
</div>
</div>



<div class="row">
 <div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-body">				
<div class="col-md-6">

<?php
$queryk="SELECT * FROM servicio_oac where estado_servicio_oac=1";
$selectk = mysql_query($queryk, $conexion);
$rowk = mysql_fetch_assoc($selectk);
$totalRowsk = mysql_num_rows($selectk);
if (0<$totalRowsk){	
do { ?>
<?php
$infopk=$rowk['id_servicio_oac'];
$querybk="select AVG(calificacion_servicio) as totalp from percepcion_oac where  estado_percepcion_oac=1";
$selectbk = mysql_query($querybk, $conexion);
$rowbk = mysql_fetch_assoc($selectbk);
$infotobk= $rowbk['totalp'];
echo $rowk['nombre_servicio_oac']; 
echo '. <span class="azul">Promedio: '.round($infotobk, 1).'</span>'; 
$info3k=($infotobk*100)/5;
$unfg=$infotobk*20;
mysql_free_result($selectbk);
 ?>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo round($unfg, 0); ?>%">
<?php echo round($unfg, 1); ?>%
</div>
</div>
<?php
} while ($rowk = mysql_fetch_assoc($selectk)); 
	}
mysql_free_result($selectk);	

?>



</div>

<div class="col-md-6">


<?php


$querybk="select AVG(claridad_lenguaje) as totalc from percepcion_oac where  estado_percepcion_oac=1";
$selectbk = mysql_query($querybk, $conexion);
$rowbk = mysql_fetch_assoc($selectbk);
$infotobk= $rowbk['totalc'];
echo 'Claridad de lenguaje'; 
echo '. <span class="azul">Promedio: '.round($infotobk, 1).'</span>'; 
$info3k=($infotobk*100)/5;
$unfg=$infotobk*20;
mysql_free_result($selectbk);
 ?>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo round($unfg, 0); ?>%">
<?php echo round($unfg, 1); ?>%
</div>
</div>

<?php
$querybk="select AVG(agilidad_atencion) as totalc from percepcion_oac where estado_percepcion_oac=1";
$selectbk = mysql_query($querybk, $conexion);
$rowbk = mysql_fetch_assoc($selectbk);
$infotobk= $rowbk['totalc'];
echo 'Agilidad de atención'; 
echo '. <span class="azul">Promedio: '.round($infotobk, 1).'</span>'; 
$info3k=($infotobk*100)/5;
$unfg=$infotobk*20;
mysql_free_result($selectbk);
 ?>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo round($unfg, 0); ?>%">
<?php echo round($unfg, 1); ?>%
</div>
</div>

<?php
$querybk="select AVG(calidad_respuesta) as totalc from percepcion_oac where  estado_percepcion_oac=1";
$selectbk = mysql_query($querybk, $conexion);
$rowbk = mysql_fetch_assoc($selectbk);
$infotobk= $rowbk['totalc'];
echo 'Calidad de la Respuesta'; 
echo '. <span class="azul">Promedio: '.round($infotobk, 1).'</span>'; 
$info3k=($infotobk*100)/5;
$unfg=$infotobk*20;
mysql_free_result($selectbk);
 ?>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo round($unfg, 0); ?>%">
<?php echo round($unfg, 1); ?>%
</div>
</div>


<?php
$querybk="select AVG(tiempo_respuesta) as totalc from percepcion_oac where  estado_percepcion_oac=1";
$selectbk = mysql_query($querybk, $conexion);
$rowbk = mysql_fetch_assoc($selectbk);
$infotobk= $rowbk['totalc'];
echo 'Tiempo de la Respuesta'; 
echo '. <span class="azul">Promedio: '.round($infotobk, 1).'</span>'; 
$info3k=($infotobk*100)/5;
$unfg=$infotobk*20;
mysql_free_result($selectbk);
 ?>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo round($unfg, 0); ?>%">
<?php echo round($unfg, 1); ?>%
</div>
</div>

<?php
$querybk="select AVG(amabilidad_atencion) as totalc from percepcion_oac where estado_percepcion_oac=1";
$selectbk = mysql_query($querybk, $conexion);
$rowbk = mysql_fetch_assoc($selectbk);
$infotobk= $rowbk['totalc'];
echo 'Amabilidad en la atención'; 
echo '. <span class="azul">Promedio: '.round($infotobk, 1).'</span>'; 
$info3k=($infotobk*100)/5;
$unfg=$infotobk*20;
mysql_free_result($selectbk);
 ?>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo round($unfg, 0); ?>%">
<?php echo round($unfg, 1); ?>%
</div>
</div>
</div>
</div>
</div>
</div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>new Chart(document.getElementById("chartjs-7"),
{"type":"line",
"data":{"labels":["Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","Enero","Febrero","Marzo","Abril","Mayo","Junio"],
"datasets":[{"label":"Percepción a nivel nacional 2023-2024","data":[
<?php 



$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where MONTH(fecha_percepcion_oac) = 07 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where MONTH(fecha_percepcion_oac) = 08 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where MONTH(fecha_percepcion_oac) = 09 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);

$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where MONTH(fecha_percepcion_oac) = 10 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where MONTH(fecha_percepcion_oac) = 11 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);

$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where MONTH(fecha_percepcion_oac) = 12 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query2="SELECT count(id_percepcion_oac) as valorf24 FROM percepcion_oac where  MONTH(fecha_percepcion_oac) = 01 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
echo $row2['valorf24'].',';
mysql_free_result($select2);



$query2="SELECT count(id_percepcion_oac) as valorf24 FROM percepcion_oac where  MONTH(fecha_percepcion_oac) = 02 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
echo $row2['valorf24'].',';
mysql_free_result($select2);



$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where  MONTH(fecha_percepcion_oac) = 03 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where  MONTH(fecha_percepcion_oac) = 04 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);



$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where  MONTH(fecha_percepcion_oac) = 05 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where  MONTH(fecha_percepcion_oac) = 06 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


?>


],
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},
"options":{}});
</script>





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
			  
<h3>Analisis por volumen de encuestas</h3>
     
	 
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
<h3>Encuestas de Percepción por Regional <?php
$totalr=existencia('percepcion_oac');
?>
</h3>
<?php 




$query="select * from region where estado_region=1";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){	
do { ?>
<?php

$infop=$row['id_region'];
$queryb="select count(id_percepcion_oac) as totalp from oficina_registro, percepcion_oac where oficina_registro.id_oficina_registro=percepcion_oac.id_oficina_registro and oficina_registro.id_region=".$infop." ";
$selectb = mysql_query($queryb, $conexion);
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
                <h3>Indicadores</h3>
Claridad de lenguaje. <br>
Agilidad de atención.<br>
Calidad de la Respuesta.<br>
Tiempo de la Respuesta. <br>
Amabilidad en la atención.<br>
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
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do { ?>
[<?php echo $row['latitud']; ?>, <?php echo $row['longitud']; ?>, <?php echo cantpercepcion($row['id_oficina_registro']); ?>],
<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
?>
[4.65, -74.2, 1]  // lat, lng, intensity
], {radius: 25}).addTo(map);



</script>







