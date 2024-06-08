	 <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3><?php $actualizar55 = mysql_query("SELECT count(id_solicitud_pqrs) as tota FROM solicitud_pqrs where estado_solicitud_pqrs=1", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo $row155['tota'];
mysql_free_result($actualizar55);

 ?></h3>

              <p>Total de PQRS</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
			  <?php 
			  
$reghtpo = mysql_query("SELECT COUNT(id_solicitud_pqrs) as Totale FROM asignacion_pqrs where id_tipo_oficina=1 and estado_asignacion_pqrs=1", $conexion);
$reghtpov = mysql_fetch_assoc($reghtpo);
echo $reghtpov['Totale'];
mysql_free_result($reghtpo);	
			  
			 ?>
			 </h3>

              <p>PQRS NIVEL CENTRAL</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php 
			 
$reghtpon = mysql_query("SELECT COUNT(id_solicitud_pqrs) as Totalet FROM asignacion_pqrs where id_tipo_oficina=2 and estado_asignacion_pqrs=1", $conexion);
$reghtpovn = mysql_fetch_assoc($reghtpon);
echo $reghtpovn['Totalet'];
mysql_free_result($reghtpon);	

			 ?></h3>

              <p>PQRS ORIP</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer" >Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3><?php echo existencia('oficina_registro'); ?></h3>
              <p>ORIP</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
			
			
			
          </div>
        </div>
		
	 
      </div>
	  

<div class="row">

<div class="col-md-6" >
         
                         <div class="panel panel-default">
  <div class="panel-body">
  <h4>ORIP</h4>
  

<?php


$query_reghtp = "SELECT id_oficina_registro, nombre_oficina_registro, nombre_region FROM oficina_registro, region where oficina_registro.id_region=region.id_region and estado_oficina_registro=1 order by nombre_oficina_registro limit 99";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion);
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
   
   $array0 = array();
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();
$arrayvencida= array();

 echo '';
 

 $ttt88=intval($row_reghtp['id_oficina_registro']);
 
 
  echo '<b>';

echo '<a href="orip&'.$ttt88.'.jsp"><span class="fa fa-search-plus"></span></a> ';

  echo $row_reghtp['nombre_region'].' / ';
  
   echo $row_reghtp['nombre_oficina_registro'].':</b><a href="analisis_oficina&'.$ttt88.'-2.jsp"> <i class="glyphicon glyphicon-search" style="color:#999;"></i> Consultar </a><br>';


$select = mysql_query("select fecha_inicio_ampliacion, dias_ampliacion, id_estado_solicitud, solicitud_pqrs.id_solicitud_pqrs, fecha_radicado from asignacion_pqrs, solicitud_pqrs where asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=2 and asignacion_pqrs.codigo_oficina='$ttt88' and estado_asignacion_pqrs=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
if (2==$row['id_estado_solicitud'] or 4==$row['id_estado_solicitud'] or 6==$row['id_estado_solicitud']or 7==$row['id_estado_solicitud'] ) {

$idsol=$row['id_solicitud_pqrs'];

if (isset($row['dias_ampliacion']) && ""!=$row['dias_ampliacion']) {
$fechavence=fechahabil($row['fecha_inicio_ampliacion'],$row['dias_ampliacion']);
} else {
	/*
$query48 = sprintf("SELECT clase_oac.terminos_ampliados FROM clasificacion_pqrs, clase_oac where clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and clasificacion_pqrs.id_solicitud_pqrs=".$idsol." and estado_clasificacion_pqrs=1 limit 1"); 
$select8 = mysql_query($query48, $conexion) or die(mysql_error());
$row8 = mysql_fetch_assoc($select8);
if (0<$row8['terminos_ampliados']){
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_ampliados']);
}*/
$query48 = sprintf("SELECT clase_oac.terminos_ampliados, clase_oac.terminos_dias FROM clasificacion_pqrs, clase_oac where clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and clasificacion_pqrs.id_solicitud_pqrs=".$idsol." and estado_clasificacion_pqrs=1 limit 1"); 
$select8 = mysql_query($query48, $conexion);
$row8 = mysql_fetch_assoc($select8);

$fecha_rad = strtotime($row['fecha_radicado']);
$fecha_entrada = strtotime('2022-05-18');

if($fecha_rad >= $fecha_entrada) {
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_dias']);
} else {
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_ampliados']);
}
mysql_free_result($select8);

}

if ($realdate<=$fechavence) {
} else {
	array_push($arrayvencida, 1);
}

} else {}
	
	
	
if (1<$row['id_estado_solicitud']) {
array_push($array0, 1);
} else { array_push($array0, 0); }



	if (2==$row['id_estado_solicitud']) {
array_push($array1, 1);


} else { array_push($array1, 0); }


	if (4==$row['id_estado_solicitud']) {
array_push($array2, 1);
} else { array_push($array2, 0); }



	if (5==$row['id_estado_solicitud']) {
array_push($array3, 1);
} else { array_push($array3, 0); }



	if (6==$row['id_estado_solicitud']) {
array_push($array4, 1);
} else { array_push($array4, 0); }
	
	
	 } while ($row = mysql_fetch_assoc($select)); 
} else { } 
mysql_free_result($select);



$todasvencidas=intval(array_sum($arrayvencida));

$todas=intval(array_sum($array0));
echo ' PQRS: '.$todas.', ';


$tramite=array_sum($array1);
echo ' En tramite: '.$tramite.', ';


$proyectadas=array_sum($array2);
echo ' Respuesta preliminar: '.$proyectadas.', ';



$conrespuesta=array_sum($array3);
echo ' Finalizadas: '.$conrespuesta.', ';


$retornadas=array_sum($array4);
echo ' Ampliadas: '.$retornadas.' ';


if (0<$todas){
$rango=100/$todas;
} else {$rango=0; }
$tramite1=$rango*$tramite;
$proyectadas1=$rango*$proyectadas;
$conrespuesta1=$rango*$conrespuesta;
$retornadas1=$rango*$retornadas;




 ?>
  
 <br>
<?php //echo $todas; ?>




<div class="progress">
  <div class="progress-bar progress-bar-warning" style="width: <?php echo intval($tramite1); ?>%">
     <?php echo round($tramite1,1); ?>%
  </div>
  <div class="progress-bar" style="width: <?php echo intval($proyectadas1); ?>%">
    <?php echo round($proyectadas1,1); ?>%
  </div>

    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($conrespuesta1); ?>%">
     <?php echo round($conrespuesta1,1); ?>%
  </div>
  <div class="progress-bar progress-bar-danger" style="width: <?php echo intval($retornadas1); ?>%">
    <?php echo round($retornadas1,1); ?>%
  </div>
</div>

<div class="row" >
<div class="col-md-4">
<?php
if (0<$totalRows) {
echo 'PQRSD Vencidas: '.$todasvencidas.'';
$info44=($todasvencidas*100)/$totalRows;
} else {
	echo 'PQRSD Vencidas: 0';
	$info44=0;
}
?>
</div>
<div class="col-md-8" >
<div class="progress">
    <div class="progress-bar progress-bar-danger" style="width: <?php echo intval($info44); ?>%">
     <?php echo round($info44, 1); ?> %
  </div>
</div>
</div>
</div>



 <?php
 echo '<hr>';
 
unset($array0);
unset($array1);
unset($array2);
unset($array3);
unset($array4); 
 unset($arrayvencida); 
 
 
 } while ($row_reghtp = mysql_fetch_assoc($reghtp));
 mysql_free_result($reghtp);
?>



</div>
</div>
</div>
		


		
		
		
		
		<div class="col-md-6" >
              <!-- DIRECT CHAT -->
                         <div class="panel panel-default">
  <div class="panel-body">
  <h4>ORIP</h4>
<!--<div style="text-align:right"><a href="xls/pqrs_orip.xls"><img src="images/excel.png"></a></div>-->
	
<?php


$query_reghtp = "SELECT id_oficina_registro, nombre_oficina_registro, nombre_region FROM oficina_registro, region where oficina_registro.id_region=region.id_region and estado_oficina_registro=1 order by nombre_oficina_registro limit 99,100";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
   
   $array0 = array();
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();
$arrayvencida= array();

 echo '';
 

 $ttt99=intval($row_reghtp['id_oficina_registro']);
   
     echo '<b>';

echo '<a href="orip&'.$ttt99.'.jsp"><span class="fa fa-search-plus"></span></a> ';

     echo $row_reghtp['nombre_region'].' / ';
   echo $row_reghtp['nombre_oficina_registro'].':</b><a href="analisis_oficina&'.$ttt99.'-2.jsp"> <i class="glyphicon glyphicon-search" style="color:#999;"></i> Consultar </a><br>';


$select = mysql_query("select fecha_inicio_ampliacion, dias_ampliacion, id_estado_solicitud, solicitud_pqrs.id_solicitud_pqrs, fecha_radicado from asignacion_pqrs, solicitud_pqrs where asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=2 and asignacion_pqrs.codigo_oficina='$ttt99' and estado_asignacion_pqrs=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
	
	
if (2==$row['id_estado_solicitud'] or 4==$row['id_estado_solicitud'] or 6==$row['id_estado_solicitud']or 7==$row['id_estado_solicitud'] ) {

$idsol=$row['id_solicitud_pqrs'];

if (isset($row['dias_ampliacion']) && ""!=$row['dias_ampliacion']) {
$fechavence=fechahabil($row['fecha_inicio_ampliacion'],$row['dias_ampliacion']);
} else {
	/*
$query48 = sprintf("SELECT clase_oac.terminos_ampliados FROM clasificacion_pqrs, clase_oac where clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and clasificacion_pqrs.id_solicitud_pqrs=".$idsol." and estado_clasificacion_pqrs=1 limit 1"); 
$select8 = mysql_query($query48, $conexion) or die(mysql_error());
$row8 = mysql_fetch_assoc($select8);
if (0<$row8['terminos_ampliados']){
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_ampliados']);
}
*/
$query48 = sprintf("SELECT clase_oac.terminos_ampliados, clase_oac.terminos_dias FROM clasificacion_pqrs, clase_oac where clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and clasificacion_pqrs.id_solicitud_pqrs=".$idsol." and estado_clasificacion_pqrs=1 limit 1"); 
$select8 = mysql_query($query48, $conexion);
$row8 = mysql_fetch_assoc($select8);

$fecha_rad = strtotime($row['fecha_radicado']);
$fecha_entrada = strtotime('2022-05-18');

if($fecha_rad >= $fecha_entrada) {
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_dias']);
} else {
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_ampliados']);
}
mysql_free_result($select8);

}

if ($realdate<=$fechavence) {
} else {
	array_push($arrayvencida, 1);
}

} else {}
	

	
	
	
if (1<$row['id_estado_solicitud']) {
array_push($array0, 1);
} else { array_push($array0, 0); }



	if (2==$row['id_estado_solicitud']) {
array_push($array1, 1);

/*
$idsol=$row['id_solicitud_pqrs'];
$query48 = sprintf("SELECT clase_oac.terminos_dias FROM clasificacion_pqrs, clase_oac where clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and clasificacion_pqrs.id_solicitud_pqrs=".$idsol." limit 1"); 
$select8 = mysql_query($query48, $conexion) or die(mysql_error());
$row8 = mysql_fetch_assoc($select8);
if (0<$row8['terminos_dias']){
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_dias']);
if ($realdate<=$fechavence) {
} else {
	array_push($arrayvencida, 1);
}
}
mysql_free_result($select8);


*/


} else { array_push($array1, 0); }


	if (4==$row['id_estado_solicitud']) {
array_push($array2, 1);
} else { array_push($array2, 0); }



	if (5==$row['id_estado_solicitud']) {
array_push($array3, 1);
} else { array_push($array3, 0); }



	if (6==$row['id_estado_solicitud']) {
array_push($array4, 1);
} else { array_push($array4, 0); }
	
	
	 } while ($row = mysql_fetch_assoc($select)); 
} else { } 
mysql_free_result($select);



$todasvencidas=intval(array_sum($arrayvencida));

$todas=intval(array_sum($array0));
echo ' PQRS: '.$todas.', ';


$tramite=array_sum($array1);
echo ' En tramite: '.$tramite.', ';


$proyectadas=array_sum($array2);
echo ' Respuesta preliminar: '.$proyectadas.', ';



$conrespuesta=array_sum($array3);
echo ' Finalizadas: '.$conrespuesta.', ';


$retornadas=array_sum($array4);
echo ' Ampliadas: '.$retornadas.' ';


if (0<$todas){
$rango=100/$todas;
} else {$rango=0; }
$tramite1=$rango*$tramite;
$proyectadas1=$rango*$proyectadas;
$conrespuesta1=$rango*$conrespuesta;
$retornadas1=$rango*$retornadas;




 ?>
  
 <br>
<?php //echo $todas; ?>




<div class="progress">
  <div class="progress-bar progress-bar-warning" style="width: <?php echo intval($tramite1); ?>%">
     <?php echo round($tramite1,1); ?>%
  </div>
  <div class="progress-bar" style="width: <?php echo intval($proyectadas1); ?>%">
    <?php echo round($proyectadas1,1); ?>%
  </div>

    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($conrespuesta1); ?>%">
     <?php echo round($conrespuesta1,1); ?>%
  </div>
  <div class="progress-bar progress-bar-danger" style="width: <?php echo intval($retornadas1); ?>%">
    <?php echo round($retornadas1,1); ?>%
  </div>
</div>

<div class="row" >
<div class="col-md-4">
<?php
if (0<$totalRows) {
echo 'PQRSD Vencidas: '.$todasvencidas.'';
$info44=($todasvencidas*100)/$totalRows;
} else {
	echo 'PQRSD Vencidas: 0';
	$info44=0;
}
?>
</div>
<div class="col-md-8" >
<div class="progress">
    <div class="progress-bar progress-bar-danger" style="width: <?php echo intval($info44); ?>%">
     <?php echo round($info44, 1); ?> %
  </div>
</div>
</div>
</div>



 <?php
 echo '<hr>';
 
unset($array0);
unset($array1);
unset($array2);
unset($array3);
unset($array4); 
unset($arrayvencida); 

 
 
 } while ($row_reghtp = mysql_fetch_assoc($reghtp));
 mysql_free_result($reghtp);
?>



</div>
</div>
</div>




</div>

