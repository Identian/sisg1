<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  /> <!-- https://animate.style/ -->
  

	 <div class="row">
               <div class="col-lg-3 col-xs-6 animate__animated animate__fadeInDown">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3><?php $actualizar55 = mysql_query("SELECT count(id_funcionario) as tota FROM funcionario where id_tipo_oficina=1 and id_cargo!=8 and estado_funcionario=1", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo $row155['tota'];
mysql_free_result($actualizar55);

 ?></h3>

              <p>Servidores públicos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6 animate__animated animate__fadeInDown">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
			  <?php 

$reghtpo = mysql_query("SELECT count(id_funcionario) as Totale FROM funcionario where id_tipo_oficina=1 and id_cargo in (1, 2, 3, 4, 6, 7) and estado_funcionario=1", $conexion);
			  
$reghtpov = mysql_fetch_assoc($reghtpo);
echo $reghtpov['Totale'];
mysql_free_result($reghtpo);	
			  
			 ?>
			 </h3>

              <p>Funcionarios</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6 animate__animated animate__fadeInDown">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php 
$reghtpon = mysql_query("SELECT count(id_funcionario) as Totalet FROM funcionario where id_tipo_oficina=1 and id_cargo=5 and estado_funcionario=1", $conexion);
$reghtpovn = mysql_fetch_assoc($reghtpon);
echo $reghtpovn['Totalet'];
mysql_free_result($reghtpon);	

			 ?></h3>

              <p>Contratistas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer" >Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
          </div>
        </div>
		
	  <div class="col-lg-3 col-xs-6 animate__animated animate__fadeInDown">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3><?php echo existencia('area'); ?></h3>
              <p>AREAS</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#popupretornadas">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
			
			
			
          </div>
        </div>
		
	 
      </div>
	  
	  


<div class="row">
<div class="col-md-6" >
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
  
 echo '';

	 echo '<a href="area&'.$ttt.'.jsp"><span class="fa fa-search-plus"></span> ';

 echo $row_reghtp['nombre_area'].'</a><br>';

 

$select = mysql_query("select dias_ampliacion, fecha_inicio_ampliacion, id_estado_solicitud, solicitud_pqrs.id_solicitud_pqrs, fecha_radicado from asignacion_pqrs, solicitud_pqrs where asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=1 and asignacion_pqrs.codigo_oficina=".$ttt." and estado_asignacion_pqrs=1 and estado_solicitud_pqrs=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
	
	

if (2==$row['id_estado_solicitud'] or 4==$row['id_estado_solicitud'] or 6==$row['id_estado_solicitud'] or 7==$row['id_estado_solicitud']) {

$idsol=$row['id_solicitud_pqrs'];

if (isset($row['dias_ampliacion']) && ""!=$row['dias_ampliacion']) {
$fechavence=fechahabil($row['fecha_inicio_ampliacion'],$row['dias_ampliacion']);
} else {
	
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

/*if (0<$row8['terminos_ampliados']){
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_ampliados']);
}
*/
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

echo '<a href="analisis_oficina&'.$ttt.'-1.jsp"> <b>  Consultar PQRS </b> </a> ';
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
  <h4>Nivel Central</h4>
				<br>
	
<?php


$query_reghtp = "SELECT id_area, nombre_area FROM area where id_area!=21 and estado_area=1 order by id_area limit 12,13 ";  
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
   
   $array0 = array();
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();
$array5 = array();
$array6 = array();
$arrayvencida= array();

 echo '';
 

 $ttt=intval($row_reghtp['id_area']);
 
  echo '';

	 echo '<a href="area&'.$ttt.'.jsp"><span class="fa fa-search-plus"></span> ';

 
  echo $row_reghtp['nombre_area'].'</a><br>';


$select = mysql_query("select fecha_inicio_ampliacion, dias_ampliacion, id_estado_solicitud, solicitud_pqrs.id_solicitud_pqrs, fecha_radicado from asignacion_pqrs, solicitud_pqrs where asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=1 and asignacion_pqrs.codigo_oficina='$ttt' and estado_asignacion_pqrs=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	

if (2==$row['id_estado_solicitud'] or 4==$row['id_estado_solicitud'] or 6==$row['id_estado_solicitud']or 7==$row['id_estado_solicitud'] ) {

$idsol=$row['id_solicitud_pqrs'];

if (isset($row['dias_ampliacion']) && ""!=$row['dias_ampliacion']) {
$fechavence=fechahabil($row['fecha_inicio_ampliacion'],$row['dias_ampliacion']);
} else {
	
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


/*if (0<$row8['terminos_ampliados']){
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_ampliados']);
}
*/
mysql_free_result($select8);

}

$realdate1=intval(strtotime($realdate));
$fechavence1=intval(strtotime($fechavence));
if ($realdate <= $fechavence) {
} else {
	array_push($arrayvencida, 1);
	if (1==$_SESSION['rol'] && 25==$ttt) {
		//echo '<h3>'.$realdate1.'/'.$fechavence1.'</h3>';
	} else {}
}

} else {}


	
	
if (1<$row['id_estado_solicitud']) {
array_push($array0, 1);
} else { array_push($array0, 0); }



if (2==$row['id_estado_solicitud']) {
array_push($array1, 1);


} else { array_push($array1, 0); }


	if (6==$row['id_estado_solicitud']) {
array_push($array4, 1);
} else { array_push($array4, 0); }


	if (4==$row['id_estado_solicitud']) {
array_push($array2, 1);
} else { array_push($array2, 0); }



	if (5==$row['id_estado_solicitud']) {
array_push($array3, 1);
} else { array_push($array3, 0); }



	if (6==$row['id_estado_solicitud']) {
array_push($array5, 1);
} else { array_push($array5, 0); }


	if (7==$row['id_estado_solicitud']) {
array_push($array6, 1);
} else { array_push($array6, 0); }
	
	
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


if (24==$ttt){
	
$re=array_sum($array5);
echo ', Requeridas: '.$re.' ';

$res=array_sum($array6);
echo ', Con respuesta al requerimiento: '.$res.' ';
	
} else {}




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
echo '<a href="analisis_oficina&'.$ttt.'-1.jsp"><b>  Consultar PQRS </b></a>';
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


