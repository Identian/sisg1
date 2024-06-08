<!--
https://leafletjs.com/examples/quick-start/
-->

<?php

$query22="select count(id_ausentismo) as totalgral, 
 DATE_FORMAT(now(), "%Y") anno_actual
FROM ausentismo 
WHERE  DATE_FORMAT(fecha_inicio, "%Y") = DATE_FORMAT(now(), "%Y")
AND    estado_ausentismo = 1 ";
$selectx = mysql_query($query22, $conexion) or die(mysql_error());
$rowx = mysql_fetch_assoc($selectx);
$totalgral = $rowx['totalgral'];
$anno_actual = $rowx['anno_actual'];

mysql_free_result($selectx);

?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>

<script src="dist/js/leaflet-heat.js"></script>


<div class="row">
<div class="col-md-9">     
    <div class="box">
		 <div class="box-body">
              <div class="table-responsive">
                 <h3><?php echo "<b>"."Analisis - Mapa de calor Ausentismos || Población: ".number_format($totalgral)."</b>";?></h3>
                 <div id="mapid" style="width: 100%; min-height: 720px; position: relative;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
                 </div>
              </div>
          </div>
    </div>
</div>
<div class="col-md-3"> 
<div class="box ">
   <div class="box-body">
     <div class="table-responsive">
       <h3>Filtros</h3><br>
	   <form action="" method="POST" name="form1" >

	      <div class="form-group text-left"> 
             <label class="control-label">Fecha Desde:</label>   
             <input type="date" class="form-control" name="fecha_desde"  id="fecha_desde" value="" required >
          </div>

	      <div class="form-group text-left"> 
             <label  class="control-label">Fechas Hasta:</label>   
             <input type="date" class="form-control datepickerjo" name="fecha_hasta" id="fecha_hasta" value="" required >
          </div>

	      <div class="form-group text-left"> 
             <label  class="control-label">Tipo de Oficina:</label>
             <select class="form-control" name="id_tipo_oficina" id="id_tipo_oficina" required>
             <option value="" selected></option>
             <?php echo lista('tipo_oficina'); ?>
             </select>
          </div>

	      <div class="form-group text-left"> 
             <label  class="control-label">Tipo de Ausentismo:</label>
             <select class="form-control" name="id_tipo_ausentismo" id="id_tipo_ausentismo" required>
             <option value="" selected></option>
             <?php echo lista('tipo_ausentismo'); ?>
             </select>
          </div>

  	      <div class="form-group text-left"> 
              <input type="submit" name="Filtrar" class="btn btn-primary" value="Filtrar" >
          </div>

      </form>			
    </div>
  </div>
</div>

<div class="box ">
<div class="box-body">
<div class="table-responsive">
<?php 
$totalr = 0;
if(isset($_POST['Filtrar']) && $_POST['Filtrar'] =='Filtrar'){
  
  $fecha_desde = $_POST['fecha_desde'];
  $fecha_hasta = $_POST['fecha_hasta'];
  $id_tipo_oficina = $_POST['id_tipo_oficina'];
  $id_tipo_ausentismo = $_POST['id_tipo_ausentismo'];

  $totalr= estadisau($fecha_desde, $fecha_hasta, $id_tipo_oficina, $id_tipo_ausentismo);

//  echo "totalr: ".$totalr."<br>";
  
  
$query5="SELECT nombre_tipo_oficina 
FROM tipo_oficina 
where id_tipo_oficina = '$id_tipo_oficina' ";
$select5 = mysql_query($query5, $conexion) or die(mysql_error());
$row5 = mysql_fetch_assoc($select5);
$nombre_tipo_oficina = $row5['nombre_tipo_oficina'];

$query8="SELECT nombre_tipo_ausentismo 
FROM tipo_ausentismo 
where id_tipo_ausentismo = '$id_tipo_ausentismo' ";
$select8 = mysql_query($query8, $conexion) or die(mysql_error());
$row8 = mysql_fetch_assoc($select8);
$nombre_tiau = $row8['nombre_tipo_ausentismo'];
$codifi = mb_detect_encoding($nombre_tiau, "UTF-8, ISO-8859-1");
$nombre_tipo_ausentismo = iconv($codifi, 'UTF-8', $nombre_tiau);

echo "<b>Tipo de Oficina:</b>  ".$id_tipo_oficina.' - '.$nombre_tipo_oficina."<br>";
echo "<b>Ausentismo:</b>  ".$id_tipo_ausentismo.' - '.$nombre_tipo_ausentismo."<br>";
echo "<b>Fecha desde:</b> ".$fecha_desde."<br>";
echo "<b>Fecha hasta:</b> ".$fecha_hasta."<br>";

?>

<?php  
  
} else {
  $query10="SELECT curdate() fechahoy ";
  $select10 = mysql_query($query10, $conexion) or die(mysql_error());
  $row10 = mysql_fetch_assoc($select10);
  $id_natu_juridica = 0;
  $fecha_desde = $row10['fechahoy'];
  $fecha_hasta = $row10['fechahoy'];;
	
}	
?>

<h4><?php echo "Total Registros: ".number_format($totalr); ?></h4>
<p> </p> 
<h4>OFICINAS</h4>

<?php
// $id_tipo_oficina = 2;

if ($id_tipo_oficina == 1) { // Nivel Central
    $query="select * from grupo_area 
    where estado_grupo_area=1";
    $select = mysql_query($query, $conexion) or die(mysql_error());
    $row = mysql_fetch_assoc($select);
   $totalRows = mysql_num_rows($select);
   $nombre_oficina=$row['nombre_grupo_area'];
}

if ($id_tipo_oficina == 2) { // Oficinas de Registro
    $query="select * from oficina_registro 
    where estado_oficina_registro=1";
    $select = mysql_query($query, $conexion) or die(mysql_error());
    $row = mysql_fetch_assoc($select);
    $totalRows = mysql_num_rows($select);
}

 $select87 = mysql_query($query, $conexion) or die(mysql_error());
 while($row_au = mysql_fetch_array($select87)) { 
  if($id_tipo_oficina == 1) {
    $id_grupo_area=$row_au['id_grupo_area'];
    $nombre_oficina=$row_au['nombre_grupo_area'];
    $condi = " AND fun.id_grupo_area=".$id_grupo_area;
 } 
 if($id_tipo_oficina == 2) {
    $nombre_oficina=$row_au['nombre_oficina_registro'];
	$id_oficina_registro=$row_au['id_oficina_registro'];
	$condi = " AND fun.id_oficina_registro=".$id_oficina_registro;
 }
$queryb="SELECT count(id_ausentismo) as totalau, 
sum(num_dias) totdias,  sum(num_horas) tothoras 
from detalle_ausentismo au, funcionario fun
WHERE au.id_funcionario = fun.id_funcionario".$condi.  
" AND fun.id_tipo_oficina = '".$id_tipo_oficina."' 
 AND au.id_tipo_ausentismo = '".$id_tipo_ausentismo."' 
 AND au.fecha_secuencia between '".$fecha_desde."' 
 AND '".$fecha_hasta."' and estado_detalle_ausentismo = 1";
$selectb = mysql_query($queryb, $conexion) or die(mysql_error());
$rowb = mysql_fetch_assoc($selectb);
// $infotob = $rowb['totalau'];
$totdias   = $rowb['totdias'];
$tothoras   = $rowb['tothoras'];
$infotob = $totdias + intval($tothoras / 8);

 $infotob = 200;

?>

<?php if($infotob > 0){ ?>
<p style="font size=8"><?php echo  $nombre_oficina.'<br>'.'  Cantidad: '.number_format($infotob); ?></p> 
<?php 
 }
 
 if($totalr > 0){
   $info3=($infotob*100)/$totalr;
 } else {
   $info3= 0;
 }
 
 if($info3 > 0) {
   $adi = round($info3 * 5, 2);
 ?>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo round($info3, 2) + $adi; ?>%">
<?php echo round($info3, 2); ?>%
</div>
</div>
<?php
 }
}
	
// mysql_free_result($select);		
?>
</div>
</div>
</div>	

</div>
</div>

<script>
function listanp(){
// alert("entro en listanp ");
 var  valor = document.getElementById('id_grn_juridica').value;
      jQuery.ajax({
      type: "POST",
      url: "pages/listasg.php",     // el archivo al cual va la petición 
      data: 'id_grupo='+valor,     // el parametro POST
      async: true,
      success: function(b) {
        jQuery('#id_natu_juridica').html(b);   // Escoges el ID donde se preentara la info
      }
    });
    
  }
 </script>


<script>

var map = L.map('mapid').setView([4.612, -74.072], 6);
var tiles = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '<a href="http://osm.org/copyright">OpenStreetMap</a>',}).addTo(map);

var heat = L.heatLayer([
<?php	

if ($id_tipo_oficina == 1) {
	
$query="select * 
from grupo_area 
where estado_grupo_area=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do { ?>
[<?php 
$id_grupo_area=$row['id_grupo_area'];
$nombre_grupo_area=$row['nombre_grupo_area'];

$query4 = "SELECT count(id_ausentismo) as totalp, 
sum(num_dias) totdias,  sum(num_dias) tothoras 
from detalle_ausentismo au, funcionario fun
WHERE au.id_funcionario = fun.id_funcionario 
AND fun.id_tipo_oficina = ".$id_tipo_oficina." 
AND fun.id_grupo_area = ".$id_grupo_area." 
AND au.id_tipo_ausentismo = ".$id_tipo_ausentismo." 
AND au.fecha_inicio between '".$fecha_desde."' 
AND '".$fecha_hasta."' and estado_ausentismo = 1";

$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$qausen=$row4['totalp'];
$totdias=$row4['totadias'];
$tothoras=$row4['tothoras'];

$result4->free();
?>
<p style="font size=8"><?php echo  $nombre_grupo_area.'  - Cantidad: '.number_format($qausen).'  - Total Dias:  '.number_format($totdias).'  - Total Horas:  '.number_format($tothoras); ?></p> 
<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);
}		


if ($id_tipo_oficina == 2) {
	
$query="select * 
from oficina_registro 
where latitud is not null 
and estado_oficina_registro=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do { ?>
[<?php 

$id_oficina_registro=$row['id_oficina_registro'];

$query4 = "SELECT count(id_ausentismo) as totalp, 
sum(num_dias) totdias,  sum(num_dias) tothoras 
from detalle_ausentismo au, funcionario fun
WHERE au.id_funcionario = fun.id_funcionario 
AND fun.id_tipo_oficina = ".$id_tipo_oficina." 
AND fun.id_oficina_registro = ".$id_oficina_registro." 
AND au.id_tipo_ausentismo = ".$id_tipo_ausentismo." 
AND au.fecha_inicio between '".$fecha_desde."' 
AND '".$fecha_hasta."' and estado_ausentismo = 1";

$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$qausen=$row4['totalp'];
$totdias=$row4['totadias'];
$tothoras=$row4['tothoras'];

$result4->free();


echo $row['latitud']; ?>, <?php echo $row['longitud']; ?>, <?php echo $qausen; ?>],
<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);
}		
?>

[4.65, -74.2, 1]  // lat, lng, intensity
], {radius: 25}).addTo(map);

</script>

