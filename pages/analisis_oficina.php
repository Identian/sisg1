<?php
if (isset($_GET['i'])) {

  
  $param=explode("-", $_GET['i']);
  $id=intval($param[0]);
  $tipo_oficina=intval($param[1]);
  
  
  ?>
<div class="row">

<div class="col-md-9">
            
<div class="panel panel-default">
  <div class="panel-body">
 
	
<?php



function dias_pasados($fecha_inicial,$fecha_final)
{
$dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
$dias = abs($dias); $dias = floor($dias);
return $dias;
}




$array0 = array();
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();
$array5 = array();
$array6 = array();
$array7 = array();
$arrayvencida = array();

if (1==$tipo_oficina){
$query_reghtp = "SELECT id_area, nombre_area FROM area where estado_area=1 and id_area=".$id." limit 1"; 
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
$name_oficina=$row_reghtp['nombre_area'];
$codigoo=intval($row_reghtp['id_area']);

} else if (2==$tipo_oficina) {
$query_reghtp = "SELECT id_oficina_registro, nombre_oficina_registro FROM oficina_registro where estado_oficina_registro=1 and id_oficina_registro=".$id." limit 1";  
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
$name_oficina=$row_reghtp['nombre_oficina_registro'];
$codigoo=intval($row_reghtp['id_oficina_registro']);

} else {
$codigoo=intval('100000000000');
}






echo ' <h3>'.$name_oficina.'</h3>';


?>

<div class="row">
<form action="" method="POST" name="for5tgmgjht1">
<div class="col-md-2"> 
<input type="text" class="form-control datepicker" name="fecha_desde" placeholder="Fecha desde" required readonly="readonly" >
</div>
<div class="col-md-2"> 
<input type="text"  class="form-control datepicker" name="fecha_hasta" required placeholder="Fecha hasta" readonly="readonly">
</div>
<div class="col-md-1"> 
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-search"></span> Buscar </button>
</div>
</form>

<div class="col-md-1"> 
</div>

<form action="<?php echo 'xls/pqrs&'.$codigoo.'&'.$tipo_oficina.'.xls'; ?>" method="POST" name="fo55r5556456tgmgjht1">
<div class="col-md-2"> 
<input type="text" class="form-control datepicker" name="fecha_desde" placeholder="Fecha desde" required readonly="readonly" >
</div>
<div class="col-md-2"> 
<input type="text"  class="form-control datepicker" name="fecha_hasta" required placeholder="Fecha hasta" readonly="readonly">
</div>
<div class="col-md-2"> 
<button type="submit" class="btn btn-success">
Descargar excel</button>
</div>
</form>
<!--<div class="col-md-6" style="text-align:right">
<?php
//echo '<a href="xls/pqrs&'.$codigoo.'&'.$tipo_oficina.'.xls"><img src="images/excel.png"></a>';
 ?>
</div>-->


</div>



<?php

$selectfr = mysql_query("select id_estado_solicitud from asignacion_pqrs, solicitud_pqrs where asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=".$tipo_oficina." and asignacion_pqrs.codigo_oficina=".$codigoo." and estado_asignacion_pqrs=1 and estado_solicitud_pqrs=1", $conexion);
$rowfr = mysql_fetch_assoc($selectfr);
$totalpqrs = mysql_num_rows($selectfr);

echo $totalpqrs.' PQRSD asignadas.';
if (0<$totalpqrs) {
$todas=$totalpqrs;

do {

if (2==$rowfr['id_estado_solicitud']) {
array_push($array1, 1);
} else { array_push($array1, 0); }

if (3==$rowfr['id_estado_solicitud']) {
array_push($array4, 1);
} else { array_push($array4, 0); }

if (4==$rowfr['id_estado_solicitud']) {
array_push($array2, 1);
} else { array_push($array2, 0); }

if (5==$rowfr['id_estado_solicitud']) {
array_push($array3, 1);
} else { array_push($array3, 0); }

if (6==$rowfr['id_estado_solicitud']) {
array_push($array6, 1);
} else { array_push($array6, 0); }

if (7==$rowfr['id_estado_solicitud']) {
array_push($array7, 1);
} else { array_push($array7, 0); }




	 } while ($rowfr = mysql_fetch_assoc($selectfr)); 
	

$tramite=array_sum($array1);
$proyectadas=array_sum($array2);
$conrespuesta=array_sum($array3);
$retornadas=array_sum($array4);
$requeridas=array_sum($array6);
$respuestarequerida=array_sum($array7);
	
mysql_free_result($selectfr);




} else { }




 if (isset($_POST['fecha_desde']) && ""!=$_POST['fecha_desde'] && isset($_POST['fecha_hasta']) && ""!=$_POST['fecha_hasta']) {
	 $fecha_desde=$_POST['fecha_desde'];
	 $fecha_hasta=$_POST['fecha_hasta'];
	 $bfechas=" and fecha_radicado>='$fecha_desde' and fecha_radicado<='$fecha_hasta' ";
	 $pagina=0;
 } else {
	 $bfechas="";
	 
	 if (isset($_GET['e']) && ""!=$_GET['e']) {
		$pagina=intval($_GET['e']);
	 } else {
		$pagina=0;  
	 }
	 
	 
 }

$select = mysql_query("select fecha_inicio_ampliacion, dias_ampliacion, id_estado_solicitud, radicado, solicitud_pqrs.id_solicitud_pqrs, solicitud_pqrs.fecha_radicado, fecha_respuestaf  from asignacion_pqrs, solicitud_pqrs where asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=".$tipo_oficina." and asignacion_pqrs.codigo_oficina=".$codigoo." and estado_asignacion_pqrs=1 and estado_solicitud_pqrs=1 ".$bfechas." order by id_estado_solicitud, fecha_radicado asc LIMIT 50 OFFSET ".$pagina."", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);





if (0<$totalRows){
	 echo '<table class="table"><tr style=" font-weight: bold;"><td>Estado</td><td>Radicado</td><td>Fecha radicado</td><td>Fecha de vencimiento</td><td>Resultado</td><td colspan="2" title="Funcionarios asignados (Sin incluir Jefe y lideres)">Fun. Asignado</td><td>Vistos buenos</td></tr>';
 
do {
	
array_push($array5, $row['id_solicitud_pqrs']);

$idsol=$row['id_solicitud_pqrs'];


if (isset($row['dias_ampliacion']) && ""!=$row['dias_ampliacion']) {
$venced='('.$row['dias_ampliacion'].' días ampliados desde '.$row['fecha_inicio_ampliacion'].') = ';
$fechavence=fechahabil($row['fecha_inicio_ampliacion'],$row['dias_ampliacion']);
} else {
	
$query48 = sprintf("SELECT clase_oac.terminos_dias, clase_oac.terminos_ampliados FROM clasificacion_pqrs, clase_oac where clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and clasificacion_pqrs.id_solicitud_pqrs=".$idsol." and estado_clasificacion_pqrs=1 limit 1"); 
$select8 = mysql_query($query48, $conexion);
$row8 = mysql_fetch_assoc($select8);

$fecha_rad = strtotime($row['fecha_radicado']);
$fecha_entrada = strtotime('2022-05-18');

if($fecha_rad >= $fecha_entrada) {

$venced='('.$row8['terminos_dias'].' días hábiles) = ';
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_dias']);
} else {
$venced='('.$row8['terminos_ampliados'].' días hábiles) = ';
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_ampliados']);
}

/*
if (0<$row8['terminos_ampliados']){
$venced='('.$row8['terminos_ampliados'].' días hábiles) = ';
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_ampliados']);
} else {
	$venced='';
	$fechavence='Sin terminos';
}*/


}



	



	
	
	
if (1<$row['id_estado_solicitud']) {
array_push($array0, 1);
} else { array_push($array0, 0); }

echo '<tr>';

if (2==$row['id_estado_solicitud']) {
array_push($array1, 1);

echo '<td>';
echo 'En tramite';
echo '</td><td>';
echo '<a href="solicitud_pqrs&'.$row['id_solicitud_pqrs'].'.jsp">'.$row['radicado'].'</a>';
echo '</td><td>'.$row['fecha_radicado'].'</td><td>';



echo $venced.$fechavence;

echo '</td><td>';

if ($realdate<=$fechavence) {
	echo '<i class="glyphicon glyphicon-warning-sign" style="color:#F39C12;"></i> PQRS en tramite';
} else {
	array_push($arrayvencida, 1);
	echo '<i class="glyphicon glyphicon-warning-sign" style="color:#ff0000;"></i> PQRS vencida';
}

echo '</td>';



echo '';

} else { array_push($array1, 0); }












	if (3==$row['id_estado_solicitud']) {
array_push($array4, 1);
echo '<td>';
echo 'Retornadas a OAC';
echo '</td><td>';
echo '<a href="solicitud_pqrs&'.$row['id_solicitud_pqrs'].'.jsp">'.$row['radicado'].'</a>';
echo '</td><td>'.$row['fecha_radicado'].'</td><td>'.$venced.$fechavence.'</td><td></td>';
} else { array_push($array4, 0); }
	





if (4==$row['id_estado_solicitud']) {
array_push($array2, 1);
echo '<td>';
echo 'Respuesta preliminar';
echo '</td><td>';
echo '<a href="solicitud_pqrs&'.$row['id_solicitud_pqrs'].'.jsp">'.$row['radicado'].'</a>';
echo '</td><td>'.$row['fecha_radicado'].'</td><td>'.$venced.$fechavence.'</td><td>';


if ($realdate<=$fechavence) {
   echo '<i class="glyphicon glyphicon-warning-sign" style="color:#337AB7;"></i> Por aprobar';
} else {
	array_push($arrayvencida, 1);
	echo '<i class="glyphicon glyphicon-warning-sign" style="color:#ff0000;"></i> PQRS vencida';
}


echo '</td>';
} else { array_push($array2, 0); }



	if (5==$row['id_estado_solicitud']) {
array_push($array3, 1);
echo '<td>';
echo 'Finalizadas';
echo '</td><td>';
echo '<a href="solicitud_pqrs&'.$row['id_solicitud_pqrs'].'.jsp">'.$row['radicado'].'</a>';
echo '</td><td>'.$row['fecha_radicado'].'</td><td>'.$venced.$fechavence.'</td><td><i class="glyphicon glyphicon-ok" style="color:#00A65A;"></i> Finalizada';


$diasp=dias_pasados($row['fecha_radicado'],$row['fecha_respuestaf']);
echo ', '.$diasp.' días';

echo ' </td>';
} else { array_push($array3, 0); }




	
	
	if (6==$row['id_estado_solicitud']) {
array_push($array6, 1);
echo '<td>';
echo 'Ampliación / Requerimiento';
echo '</td><td>';
echo '<a href="solicitud_pqrs&'.$row['id_solicitud_pqrs'].'.jsp">'.$row['radicado'].'</a>';
echo '</td><td>'.$row['fecha_radicado'].'</td><td>'.$venced.$fechavence.'</td><td>';

if ($realdate<=$fechavence) {
	echo '<i class="glyphicon glyphicon-warning-sign" style="color:#F39C12;"></i> PQRS en tramite';
} else {
	array_push($arrayvencida, 1);
	echo '<i class="glyphicon glyphicon-warning-sign" style="color:#ff0000;"></i> PQRS vencida';
}


echo '</td>';
} else { array_push($array6, 0); }

	
	
	if (7==$row['id_estado_solicitud']) {
array_push($array7, 1);
echo '<td>';
echo 'Respuesta de requerimiento';
echo '</td><td>';
echo '<a href="solicitud_pqrs&'.$row['id_solicitud_pqrs'].'.jsp">'.$row['radicado'].'</a>';
echo '</td><td>'.$row['fecha_radicado'].'</td><td>'.$venced.$fechavence.'</td><td>';

if ($realdate<=$fechavence) {
	echo '<i class="glyphicon glyphicon-warning-sign" style="color:#F39C12;"></i> PQRS en tramite';
} else {
	array_push($arrayvencida, 1);
	echo '<i class="glyphicon glyphicon-warning-sign" style="color:#ff0000;"></i> PQRS vencida';
}


echo '</td>';
} else { array_push($array7, 0); }


	
	
	echo '<td>';
$selectyy = mysql_query("select count(id_asignacion_pqrs_funcionario) as tfun  from asignacion_pqrs, asignacion_pqrs_funcionario, funcionario where (funcionario.id_cargo=4 or funcionario.id_cargo=5) and funcionario.lider_pqrs!=1 and asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario and asignacion_pqrs_funcionario.id_solicitud_pqrs=".$idsol." and asignacion_pqrs.id_solicitud_pqrs=asignacion_pqrs_funcionario.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=".$tipo_oficina." and asignacion_pqrs.codigo_oficina=".$codigoo." and estado_asignacion_pqrs=1 and estado_asignacion_pqrs_funcionario=1", $conexion) or die(mysql_error());
$rowyy = mysql_fetch_assoc($selectyy);
echo $rowyy['tfun'];

	echo '</td>';
	
	
		echo '<td>';
if (0<$rowyy['tfun']) { } else { echo '<i class="fa fa-flag" style="color:#ff0000;"></i>'; }
mysql_free_result($selectyy);
	echo '</td>';
	
	
	
		echo '<td>';
		
		
if (24==$id ){
$selectyyc = mysql_query("select count(id_correccion_pqrs) as tf  from correccion_pqrs where id_solicitud_pqrs=".$idsol." and seccion=2 and id_tipo_accion=1 and estado_correccion_pqrs=1", $conexion) ;
$rowyyc = mysql_fetch_assoc($selectyyc);
if (0<$rowyyc['tf']) {
	echo '<span class="glyphicon glyphicon-ok"></span> requerimiento. ';
} else {}

	
$selectyyc = mysql_query("select count(id_correccion_pqrs) as tfm  from correccion_pqrs where id_solicitud_pqrs=".$idsol." and seccion=3 and id_tipo_accion=1 and estado_correccion_pqrs=1", $conexion);
$rowyyc = mysql_fetch_assoc($selectyyc);
if (0<$rowyyc['tfm']) {
	echo ' / <span class="glyphicon glyphicon-ok"></span> pre-respuesta. ';
} else {}


$selectyyc = mysql_query("select count(id_correccion_pqrs) as tfmb  from correccion_pqrs where id_solicitud_pqrs=".$idsol." and seccion=1 and id_tipo_accion=1 and estado_correccion_pqrs=1", $conexion) ;
$rowyyc = mysql_fetch_assoc($selectyyc);
if (0<$rowyyc['tfmb']) {
	echo ' / <span class="glyphicon glyphicon-ok"></span> fondo.';
} else {}



} else {
	
	$selectyyc = mysql_query("select count(id_correccion_pqrs) as tfm  from correccion_pqrs where id_solicitud_pqrs=".$idsol." and seccion=1 and id_tipo_accion=1 and estado_correccion_pqrs=1", $conexion) ;
$rowyyc = mysql_fetch_assoc($selectyyc);
if (0<$rowyyc['tfm']) {
	echo 'V. bueno';
} else {}
	
}



	echo '</td>';
	
	
	
	echo '</tr>';
	
	
	
	 } while ($row = mysql_fetch_assoc($select)); 
	 
	 echo '</table>';
} else { } 
mysql_free_result($select);


//$todasvencidas=intval(array_sum($arrayvencida));




if (0<$todas){
$rango=100/$todas;
} else {$rango=0; }
$tramite1=$rango*$tramite;
$proyectadas1=$rango*$proyectadas;
$conrespuesta1=$rango*$conrespuesta;
$retornadas1=$rango*$retornadas;
$requeridas1=$rango*$requeridas;




$maxp=$totalpqrs/50;
$maxp2=intval($maxp);
$maxp3=$maxp2*50;
  
 if (isset($_GET['e']) && ""!=$_GET['e']) {
		$pagina=intval($_GET['e']);
		
		
echo '<hr>Paginación:  &nbsp;  <a href="analisis_oficina&'.$id.'-'.$tipo_oficina.'.jsp">Inicio</a> &nbsp;  ';

if (50<$pagina) {
$menosp=$pagina-50;
echo ' <a href="analisis_oficina&'.$id.'-'.$tipo_oficina.'&'.$menosp.'.jsp">Anterior</a> &nbsp;  ';	
} else {
echo '';
}


if ($pagina<$maxp3) {
$masp=$pagina+50;
echo '<a href="analisis_oficina&'.$id.'-'.$tipo_oficina.'&'.$masp.'.jsp">Siguiente</a> &nbsp; ';
} else {
echo '';
}


echo '<a href="analisis_oficina&'.$id.'-'.$tipo_oficina.'&'.$maxp3.'.jsp">Final</a> ';
	
		
	 } else {

	 

echo '<hr>Paginación:  &nbsp;  <a href="analisis_oficina&'.$id.'-'.$tipo_oficina.'&50.jsp">Siguiente</a> &nbsp; <a href="analisis_oficina&'.$id.'-'.$tipo_oficina.'&'.$maxp3.'.jsp">Final</a> ';
		
	 }
	 

 ?>
  
 <br>


 <?php
 echo '<hr>';
 
unset($array0);
unset($array1);
unset($array2);
unset($array3);
unset($array4); 
unset($array6); 
unset($array7); 
unset($arrayvencida); 

?>



</div>
</div>
</div>

<div class="col-md-3">

<!--
 <div class="panel panel-default">
  <div class="panel-body">
<h3>Estado general</h3>
<hr>
<?php
/*
if (0<$totalRows) {
echo 'PQRSD Vencidas: '.$todasvencidas.'';
$info44=($todasvencidas*100)/$totalRows;
} else {
	echo 'PQRSD Vencidas: 0';
	$info44=0;
}
*/
?>

<div class="progress">
    <div class="progress-bar progress-bar-danger" style="width: <?php //echo intval($info44); ?>%">
     <?php //echo round($info44, 1); ?> %
  </div>
</div>



</div>
</div>-->




 <div class="panel panel-default">
  <div class="panel-body">
<h3>Consolidado</h3>
<hr>
<div id="chart"></div>
<div>
<?php

	

//echo 'Ampliación / Requeridas: '.$requeridas.' ';

if (24==$id && 1==$tipo_oficina){
echo '<br>Con respuesta al requerimiento: '.$respuestarequerida.' ';
} else {}


?>

</div>
</div>
</div>




 <div class="panel panel-default">
  <div class="panel-body">
<h3>Recurso humano para PQRS</h3>
<hr>
<?php

if (1==$_SESSION['rol']) {
		
if (isset($_POST['asignarnuevof']) && ""!=$_POST['asignarnuevof']) {


$funciona=intval($_POST['asignarnuevof']);


$queryv = sprintf("SELECT asignacion_pqrs.id_solicitud_pqrs FROM asignacion_pqrs, solicitud_pqrs where asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs AND id_estado_solicitud!=5 and id_tipo_oficina=".$tipo_oficina." and codigo_oficina=".$id." and estado_asignacion_pqrs=1 and estado_solicitud_pqrs=1"); 
$selectv = mysql_query($queryv, $conexion);
$rowv = mysql_fetch_assoc($selectv);
$totalRowsv = mysql_num_rows($selectv);
if (0<$totalRowsv){
do {
       
$id_sol_pqrs=intval($rowv['id_solicitud_pqrs']);
	
$querypp = sprintf("SELECT count(id_funcionario) as totfunp FROM asignacion_pqrs_funcionario where id_funcionario=".$funciona." and id_solicitud_pqrs=".$id_sol_pqrs." and estado_asignacion_pqrs_funcionario=1"); 
$selectpp = mysql_query($querypp, $conexion);
$rowpp = mysql_fetch_assoc($selectpp);
if (0<$rowpp['totfunp']) {
	
} else {
	
$insertSQLdd8 = sprintf("INSERT INTO asignacion_pqrs_funcionario (nombre_asignacion_pqrs_funcionario, id_funcionario, id_solicitud_pqrs, estado_asignacion_pqrs_funcionario, fecha_asignacion_funcionario, id_funcionario_asigna) VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString('PQRS MASIVA', "text"),
GetSQLValueString($funciona, "int"),
GetSQLValueString($id_sol_pqrs, "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString(2319, "int"));
$Resultdd8 = mysql_query($insertSQLdd8, $conexion);
	
}

mysql_free_result($selectpp);  //   revisar

				 
} while ($rowv = mysql_fetch_assoc($selectv)); 
} else {}	 
mysql_free_result($selectv);

echo $insertado;		
				


	
} else {}
	
	?>
Asignar todas las PQRS a: 
<input class="numero" id="consultaf" value="" style="width:150px;" placeholder="Cedula" required>
<button type="button" class="btn btn-xs btn-warning" id="botonconsultaf">
<span class="glyphicon glyphicon-search"></span></button>
<form action="" method="POST" name="forasd435m4354351FGDG">
<div id="resultadoconsultaf">
</div>
</form>
<hr>
<?php
} else {}
	
	

	
if (1==$tipo_oficina) {
$area=$id;
$query = sprintf("SELECT funcionario.id_funcionario, nombre_funcionario, correo_funcionario, cedula_funcionario FROM funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and grupo_area.id_area='$area' and (funcionario.id_cargo=1 or funcionario.lider_pqrs=1) and estado_funcionario=1 order by id_funcionario"); 
}
else if (2==$tipo_oficina) {
$oficina=$id;
$query = sprintf("SELECT funcionario.id_funcionario, nombre_funcionario, correo_funcionario, cedula_funcionario FROM oficina_registro, funcionario where oficina_registro.id_oficina_registro='$oficina' and oficina_registro.id_oficina_registro=funcionario.id_oficina_registro and (funcionario.id_cargo=1 or funcionario.lider_pqrs=1) and estado_oficina_registro=1 order by funcionario.id_funcionario"); 
}
else {
$query = sprintf("SELECT funcionario.id_funcionario FROM funcionario where id_funcionario=000"); 
}

$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
echo $row['nombre_funcionario'];
if (1==$_SESSION['rol']) {
	echo ' - '.$row['cedula_funcionario'];
} else { }

echo '<br>';
} while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);



?>

</div>
</div>



</div>
</div>





<script type='text/javascript'>//<![CDATA[
window.onload=function(){
var chart = c3.generate({
    data: {
        columns: [
            ['data1', <?php echo $todas; ?>],
            ['data2', 0],
        ],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
	
			color: {
  pattern: ['#337AB7', '#00A65A', '#F39C12', '#ff54C432', '#ff0000']
},

    donut: {
        title: "PQRS: <?php echo $todas; ?>"
    }
});

setTimeout(function () {
    chart.load({
        columns: [
		["En tramite:  <?php echo $tramite; ?>",  <?php echo $tramite; ?>],  
		 ["Retornadas: <?php echo $retornadas; ?>", <?php echo $retornadas; ?>],
		  ["Respuesta preliminar:  <?php echo $proyectadas; ?>", <?php echo $proyectadas; ?>],
		   ["Ampliación / Req:  <?php echo $requeridas; ?>", <?php echo $requeridas; ?>],
			 ["Finalizadas:  <?php echo $conrespuesta; ?>", <?php echo $conrespuesta; ?>],
          
        ]
		


    });
}, 1500);

setTimeout(function () {
    chart.unload({
        ids: 'data1'
    });
    chart.unload({
        ids: 'data2'
    });
}, 1500);
}
</script>


<?php } else {  } ?>