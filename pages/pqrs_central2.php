

<div class="row">
<div class="col-md-12" >
 <div class="panel panel-default">
  <div class="panel-body">
  <h4>Nivel Central</h4>
				<br>
	
<?php



$query_reghtp = "SELECT id_area, nombre_area FROM area where id_area!=21 and estado_area=1 order by id_area limit 12";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
$array0 = array();
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();
$arrayvencida = array();




 
  $ttt=intval($row_reghtp['id_area']);
  
 echo '<b>';
if (1==$_SESSION['rol']){ 
	 echo '<a href="area&'.$ttt.'.jsp"><span class="fa fa-search-plus"></span></a> ';
 } else {}
 echo $row_reghtp['nombre_area'].':</b><a href="analisis_oficina&'.$ttt.'-1.jsp"> <i class="glyphicon glyphicon-search" style="color:#999;"></i> Consultar </a><br>';

 

$select = mysql_query("select id_estado_solicitud, solicitud_pqrs.id_solicitud_pqrs, fecha_radicado from asignacion_pqrs, solicitud_pqrs where asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=1 and asignacion_pqrs.codigo_oficina='$ttt' and estado_asignacion_pqrs=1 and estado_solicitud_pqrs=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
	
	

if (2==$row['id_estado_solicitud'] or 4==$row['id_estado_solicitud']) {

$idsol=$row['id_solicitud_pqrs'];
$query48 = sprintf("SELECT clase_oac.terminos_dias FROM clasificacion_pqrs, clase_oac where clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and clasificacion_pqrs.id_solicitud_pqrs=".$idsol." and estado_clasificacion_pqrs=1 limit 1"); 
$select8 = mysql_query($query48, $conexion) or die(mysql_error());
$row8 = mysql_fetch_assoc($select8);
if (0<$row8['terminos_dias']){
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_dias']);
if ($realdate<=$fechavence) {
} else {
	array_push($arrayvencida, 1);
	
	if (3==$ttt){
	echo '<br>'.$idsol.'<br>';
	} else {}
	
	
}
}
mysql_free_result($select8);

} else {}

	
	
	
	
	
if (1<$row['id_estado_solicitud']) {
array_push($array0, 1);
} else { array_push($array0, 0); }



if (2==$row['id_estado_solicitud']) {
array_push($array1, 1);

/*
$idsol=$row['id_solicitud_pqrs'];
$query48 = sprintf("SELECT clase_oac.terminos_dias FROM clasificacion_pqrs, clase_oac where clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and clasificacion_pqrs.id_solicitud_pqrs=".$idsol." and estado_clasificacion_pqrs=1 and estado_clase_oac=1 limit 1"); 
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



	if (3==$row['id_estado_solicitud']) {
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
echo ' Retornadas: '.$retornadas.' ';


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


