<?php
if (isset($_GET['i'])) {
$id=intval($_GET['i']);


if (0==$id) {
$nombre_o='Oficina de Atención al ciudadano';
} else {

$query = sprintf("SELECT * FROM oficina_registro where id_oficina_registro='$id' limit 1"); 
$select = mysql_query($query, $conexion);
$row_update = mysql_fetch_assoc($select);
$nombre_o='ORIP - '.$row_update['nombre_oficina_registro']; 
}




if (1==$_SESSION['snr_tipo_oficina']){
$valp=0;
} else if (2==$_SESSION['snr_tipo_oficina']){
$valp=$_SESSION['id_oficina_registro']; 
} else { }





if ((isset($_POST["table"])) && ($_POST["table"] == "percepcion_oac") && (3>$_SESSION['snr_tipo_oficina'])) { 

if (isset($_POST["cedula_percepcion"]) and ""!=$_POST["cedula_percepcion"]) {

$cedulap=$_POST["cedula_percepcion"];

$queryk = sprintf("SELECT count(id_ciudadano) as totalc FROM ciudadano where identificacion='$cedulap' and estado_ciudadano=1"); 
$selectk = mysql_query($queryk, $conexion);
$rowk = mysql_fetch_assoc($selectk);
$totalRowskk=$rowk['totalc'];
	
} else {

	$totalRowskk=0;
}



if (0<$totalRowskk){
echo'<script type="text/javascript">swal(" ERROR !", " La Cedula si existe en el sistema. El registro no se pudo y debe realizar como anónimo. !", "error");</script>';
} else {

	


if (isset($_POST['claridad_lenguaje']) and isset($_POST['agilidad_atencion']) and isset($_POST['calidad_respuesta']) and isset($_POST['tiempo_respuesta']) and isset($_POST['amabilidad_atencion']))
{


$insertSQL = sprintf("INSERT INTO percepcion_oac (id_ciudadano, cedula_percepcion, modulo_atencion, id_funcionario_atendio, id_servicio_oac, calificacion_servicio, nombre_percepcion_oac, claridad_lenguaje, agilidad_atencion, calidad_respuesta, tiempo_respuesta, amabilidad_atencion, observaciones, fecha_percepcion_oac, estado_percepcion_oac, id_oficina_registro, id_tipo_ciudadano) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString(21373, "int"), 
GetSQLValueString($_POST["cedula_percepcion"], "text"), 
GetSQLValueString($_POST["modulo_atencion"], "int"), 
GetSQLValueString($_POST["id_funcionario_atendio"], "int"), 
GetSQLValueString($_POST["id_servicio_oac"], "int"), 
GetSQLValueString($_POST["calificacion_servicio"], "int"), 
GetSQLValueString($_POST["nombre_percepcion_oac"], "text"), 
GetSQLValueString($_POST["claridad_lenguaje"], "int"), 
GetSQLValueString($_POST["agilidad_atencion"], "int"), 
GetSQLValueString($_POST["calidad_respuesta"], "int"), 
GetSQLValueString($_POST["tiempo_respuesta"], "int"), 
GetSQLValueString($_POST["amabilidad_atencion"], "int"), 
GetSQLValueString($_POST["observaciones"], "text"), 
GetSQLValueString($_POST["fecha_percepcion_oac"], "date"), 
GetSQLValueString(1, "int"),
GetSQLValueString($valp, "int"),
GetSQLValueString($_POST["id_tipo_ciudadano"], "int"));
$Result = mysql_query($insertSQL, $conexion);

echo $insertado;

} else {
	
	echo '<script type="text/javascript">swal(" ERROR !", " Los campos con * en rojo son obligatorios.", "error");</script>';

}

}
} else {
	
}






?>





<div class="modal fade" id="popupnewpercepcionoficina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Percepción Anónima - 
<?php 
echo $nombre_o;
 ?></label></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="POST" name="for3234456345m1">



<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label">Existe Cedula:</label> 
<input type="checkbox"  id="ver_cedula" >
</div>
</div>
<div class="col-md-8">
<input type="text" class="form-control" placeholder="Cedula" name="cedula_percepcion" id="cedula_percepcion" style="display:none;">
</div>
</div>




<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA:</label> 
</div>
</div>
<div class="col-md-8">
<input type="date" class="form-control datepicker" readonly="readonly" name="fecha_percepcion_oac" style="width:180px;" required>
</div>
</div>










<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> EL CIUDADANO ES:</label> 
<select  class="form-control" name="id_tipo_ciudadano" required>
<option value="" selected></option>
<?php
$query = sprintf("SELECT * FROM tipo_ciudadano where estado_tipo_ciudadano=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_ciudadano'].'">'.strtoupper(utf8_encode($row['nombre_tipo_ciudadano'])).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>




<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MODULO DE ATENCION:</label> 
</div>
</div>
<div class="col-md-8">
<select class="form-control" name="modulo_atencion" style="width:80px;" required> 
<option value="" selected></option>
 <?php 
        for ($i = 1; $i <= 20; $i++){
          
            echo '<option>'.$i.'</option>';

        };

    ?>
</select>
</div>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> SERVIDOR PÚBLICO QUE LO ATENDIO:</label> 
<select  class="form-control" name="id_funcionario_atendio" required>
<option value="" selected></option>

<?php
if (0==$valp) {
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_grupo_area=24 and id_tipo_oficina=1 and estado_funcionario=1 order by nombre_funcionario"); 
} else {
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_oficina_registro=".$valp." and estado_funcionario=1 order by nombre_funcionario"); 
}
$select = mysql_query($query, $conexion);

$row = mysql_fetch_assoc($select);

$totalRows = mysql_num_rows($select);

if (0<$totalRows){

do {

	echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

?>
<option value="0" title="Persona que opera servicios como Reval, Kioscos, entre otros.">AGENTE DE SERVICIO</option>
</select>
</div>


<div class="row">
<div class="col-md-6">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE SERVICIO UTILIZADO:</label> 
<select  class="form-control" name="id_servicio_oac" required>
<option value="" selected></option>
<?php echo lista('servicio_oac'); ?>
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CALIFICACION DEL SERVICIO:</label> 
<select  class="form-control" name="calificacion_servicio" required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
</div>
</div>



<div class="form-group text-left"> 
<label  class="control-label">COMENTARIO SOBRE LA CALIFICACIÓN:</label> 
<textarea name="nombre_percepcion_oac" style="width:100%;height:200px;"></textarea>
</div>
<hr>
<div class="row">
<div class="col-md-12">
<div class="form-group text-left"> 
<b><center>
CALIFIQUE LA PRESTACIÓN DEL SERVICIO RECIBIDO EN ESTA OFICINA, EN CUANTO A:
<br>(Todas las preguntas son obligatorias)
</center>
</B>
</div>
</div>

</div>
<hr>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CLARIDAD DEL LENGUAJE:</label> 
<select  class="form-control" name="claridad_lenguaje" id="claridad_lenguaje" required >
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> AGILIDAD EN LA ATENCIÓN:</label> 
<select  class="form-control" name="agilidad_atencion" id="agilidad_atencion"  required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CALIDAD DE LA RESPUESTA:</label> 
<select  class="form-control" name="calidad_respuesta" id="calidad_respuesta"  required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIEMPO DE RESPUESTA:</label> 
<select  class="form-control" name="tiempo_respuesta" id="tiempo_respuesta"  required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> AMABILIDAD EN LA ATENCION:</label> 
<select  class="form-control" name="amabilidad_atencion" id="amabilidad_atencion"  required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">OBSERVACIONES Y/O SUGERENCIAS:</label> 
<textarea class="form-control" name="observaciones" style="height:200px;"></textarea>
</div>

<div class="modal-footer">
<span style="color:#ff0000;">* Obligatorio</span>

<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="percepcion_oac">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div></form>


</div>
</div> 
</div> 
</div> 











	<div class="row">
<div class="col-md-12">
	<div class="box box-info">


            <div class="box-body">
			
              <div class="table-responsive">
			  
			  
			<div  class="modal-body">
			
			
			
<div  class="modal-body">

<div class="col-md-6">




<h4>PERCEPCIÓN - <?php echo $nombre_o; ?>	</h4>
<?php

if ((1==$_SESSION['rol']) or (1==$_SESSION['snr_tipo_oficina'] and 24==$_SESSION['snr_grupo_area']) or ((2==$_SESSION['snr_tipo_oficina']) and $id==intval($_SESSION['id_oficina_registro']))) {


?>
 <a href="" class="btn btn-warning" data-toggle="modal" data-target="#popupnewpercepcionoficina">
<span class="glyphicon glyphicon-plus-sign"></span> Percepción anónima </a>
<?php } else { }?>


<br><br><br>





<hr>



<?php
if (isset($_POST['servicio']) and isset($_POST['fecha_desde']) && ""!=$_POST['fecha_desde'] && isset($_POST['fecha_hasta']) && ""!=$_POST['fecha_hasta']) {
	
	$inp=$_POST['servicio'];
	
	$fecha_desde=$_POST['fecha_desde'];
	 $fecha_hasta=$_POST['fecha_hasta'];
	 
	 if (0==$_POST['servicio']) {
	  $infoservicio='';
	 } else {
	 $infoservicio=' and servicio_oac.id_servicio_oac='.$inp.' ';
	 }
	 
	 
	  $infop= "".$infoservicio." and fecha_percepcion_oac>='$fecha_desde' and fecha_percepcion_oac<='$fecha_hasta' ";
	 

	 
} else {
	$infop='';
	?>
	
	
	<br><br><br>
<div style="width:100%;">
<canvas id="chartjs-7" class="chartjs">
</canvas></div>
	
	<?php
}


$query55 = sprintf("SELECT * FROM percepcion_oac, servicio_oac where percepcion_oac.id_servicio_oac=servicio_oac.id_servicio_oac and id_oficina_registro=".$id." ".$infop." and estado_percepcion_oac=1 and estado_servicio_oac=1 order by fecha_percepcion_oac desc");
$select55 = mysql_query($query55, $conexion);
$row55 = mysql_fetch_assoc($select55);
$totalRows55 = mysql_num_rows($select55);

if (isset($_POST['servicio']) and isset($_POST['fecha_desde']) && ""!=$_POST['fecha_desde'] && isset($_POST['fecha_hasta']) && ""!=$_POST['fecha_hasta']) {
	
echo '<h1>'.$totalRows55.' encuestas entre '.$fecha_desde.' a '.$fecha_hasta.'</h1><br><br>';
} else {}
?>

<br><br><br><br>

<?PHP 

$arrayc = array();
$queryc = sprintf("SELECT count(id_percepcion_oac) as total, sum(calificacion_servicio) as calificacion_servicio, sum(claridad_lenguaje) as claridad_lenguaje,  
sum(agilidad_atencion) as agilidad_atencion, sum(calidad_respuesta) as calidad_respuesta, 
sum(tiempo_respuesta) as tiempo_respuesta, sum(amabilidad_atencion) as amabilidad_atencion
FROM percepcion_oac, servicio_oac where percepcion_oac.id_servicio_oac=servicio_oac.id_servicio_oac and id_oficina_registro=".$id." ".$infop." and estado_percepcion_oac=1");
$selectc = mysql_query($queryc, $conexion);
$row_reseoc = mysql_fetch_assoc($selectc);
$totalRowsc = mysql_num_rows($selectc);
if (0<$totalRowsc) {
$totalcc=$row_reseoc['total'];
array_push($arrayc, $row_reseoc['calificacion_servicio']);
array_push($arrayc, $row_reseoc['claridad_lenguaje']);
array_push($arrayc, $row_reseoc['agilidad_atencion']);
array_push($arrayc, $row_reseoc['calidad_respuesta']);
array_push($arrayc, $row_reseoc['tiempo_respuesta']);
array_push($arrayc, $row_reseoc['amabilidad_atencion']);
}
mysql_free_result($selectc);

$sumac=array_sum($arrayc);
//echo 'Puntaje: '.$sumac;
echo 'Encuentas: '.$totalcc;
$infoc=$sumac/$totalcc;
$infoe=round($infoc,0);
echo ', Satisfaccion: '.$infoe;
echo ', Umbral: 24';
if (24<=$infoe) {
	echo '<br>Resultado: Usuarios satisfechos';
} else {
   echo '<br>Resultado: Usuarios insatisfechos';
}

$ff=$infoe*100;
$ffr=$ff/30;
$rrrr=round($ffr,0);
?>
<div class="progress">
<div class="progress-bar progress-bar-info" style="width: <?php echo $rrrr; ?>%">
<?php echo $rrrr; ?>%
</div>
</div>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-knob/js/jquery.knob.js"></script>
   
<div class="col-md-12 text-center">
<!--<input type="text" class="knob" value="-80" data-min="-150" data-max="150" data-width="90" data-height="90" data-fgColor="#00a65a">-->
<input type="text" class="knob" data-readonly="true" value="<?php echo $infoe; ?>" data-max="30" data-width="60" data-height="60" data-fgColor="#337AB7">
	  <div class="knob-label">Satisfacción sobre 30 puntos</div>
                </div>
				
				






</div>


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

$querybk="select AVG(calificacion_servicio) as totalp from percepcion_oac, servicio_oac where percepcion_oac.id_servicio_oac=servicio_oac.id_servicio_oac and id_oficina_registro=".$id." ".$infop." and percepcion_oac.id_servicio_oac=".$infopk." and estado_percepcion_oac=1";
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




<?php


$querybk="select AVG(claridad_lenguaje) as totalc from percepcion_oac, servicio_oac where percepcion_oac.id_servicio_oac=servicio_oac.id_servicio_oac and id_oficina_registro=".$id." ".$infop." and estado_percepcion_oac=1";
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
$querybk="select AVG(agilidad_atencion) as totalc from percepcion_oac, servicio_oac where percepcion_oac.id_servicio_oac=servicio_oac.id_servicio_oac and id_oficina_registro=".$id." ".$infop." and estado_percepcion_oac=1";
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
$querybk="select AVG(calidad_respuesta) as totalc from percepcion_oac, servicio_oac where percepcion_oac.id_servicio_oac=servicio_oac.id_servicio_oac and id_oficina_registro=".$id." ".$infop." and estado_percepcion_oac=1";
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
$querybk="select AVG(tiempo_respuesta) as totalc from percepcion_oac, servicio_oac where percepcion_oac.id_servicio_oac=servicio_oac.id_servicio_oac and id_oficina_registro=".$id." ".$infop." and estado_percepcion_oac=1";
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
$querybk="select AVG(amabilidad_atencion) as totalc from percepcion_oac, servicio_oac where percepcion_oac.id_servicio_oac=servicio_oac.id_servicio_oac and id_oficina_registro=".$id." ".$infop." and estado_percepcion_oac=1";
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











<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>new Chart(document.getElementById("chartjs-7"),
{"type":"line",
"data":{"labels":["Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","Enero","Febrero","Marzo","Abril","Mayo","Junio"],
"datasets":[{"label":"Percepción 2023-2024","data":[
<?php 




$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 07 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 08 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);

$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 09 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);



$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 10 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 11 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 12 AND YEAR(fecha_percepcion_oac) = 2023 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);



$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 01 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);

$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 02 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);




$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 03 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);



$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 04 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 05 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


$query1="SELECT count(id_percepcion_oac) as valorf FROM percepcion_oac where id_oficina_registro='$id' and MONTH(fecha_percepcion_oac) = 06 AND YEAR(fecha_percepcion_oac) = 2024 and estado_percepcion_oac=1";
$select1 = mysql_query($query1, $conexion);
$row1 = mysql_fetch_assoc($select1);
echo $row1['valorf'].',';
mysql_free_result($select1);


?>


],
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},
"options":{}});
</script>


<HR>

  
		<script>
  $(function () {
    /* jQueryKnob */

    $(".knob").knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */
  })
  
  
  
</script>

</div>















	<div class="row">
<div class="col-md-12">


<hr>
<form action="" method="POST" name="fo324234r5tgmgjht1" class="fobliga">
<div class="row">
<div class="col-md-4">
<select class="form-control" name="servicio" required style="width:100%;">
<option value="" selected>- - Tipo de servicio - -</option>
<option value="0">Todos</option>
<?php echo lista('servicio_oac'); ?>
</select>
</div>
<div class="col-md-2"> 
<input type="text" class="form-control datepicker" required name="fecha_desde" id="fecha_desde" placeholder="Fecha desde"  readonly="readonly" >
</div>
<div class="col-md-2"> 
<input type="text"  class="form-control datepicker" required name="fecha_hasta"  id="fecha_hasta" placeholder="Fecha hasta" readonly="readonly">
</div>
<div class="col-md-2"> 
<button type="submit" class="btn btn-danger">
<span class="glyphicon glyphicon-search"></span> Buscar </button>
</div>


<div class="col-md-2" style="text-align:right">
<?php
//echo '<a href="xls/pqrs&'.$codigoo.'&'.$tipo_oficina.'.xls"><img src="images/excel.png"></a>';
 ?>

</div>


</div>

</form>

<hr>
<br>
<table id="lista" class="table">
<thead><tr align="center" valign="middle">

<th>ID</th><th >FECHA</th><th>CIUDADANO</th><th>SERVICIO</th><th>CALIFICACION</th><th>CLARIDAD DE LENGUAJE</th><th>AGILIDAD DE ATENCION</th><th>CALIDAD DE RESPUESTA</th><th>TIEMPO DE RESPUESTA</th><th>AMABILIDAD DE ATENCION</th>
<th style="width:110px;"></th>

</tr>

</thead>
<tbody>
<?php
if (0<$totalRows55) {

do {
	echo '<tr>';
echo '<td STYLE="color:#777;">'.$row55['id_percepcion_oac'].'</td>';
echo '<td>'.$row55['fecha_percepcion_oac'].'</td>';
echo '<td><a href="https://sisg.supernotariado.gov.co/ciudadano&'.$row55['id_ciudadano'].'.jsp"><span class="glyphicon glyphicon-user"></span></a></td>';
echo '<td>'.$row55['nombre_servicio_oac'].'</td>';
	//array_push($arrayc, intval($row_reseo['calificacion_servicio']));
echo '<td>'.calificacion($row55['calificacion_servicio']).'</td>';
//	array_push($arrayc, $row_reseo['claridad_lenguaje']);
echo '<td>'.calificacion($row55['claridad_lenguaje']).'</td>';
//	array_push($arrayc, $row_reseo['agilidad_atencion']);
echo '<td>'.calificacion($row55['agilidad_atencion']).'</td>';
//	array_push($arrayc, $row_reseo['calidad_respuesta']);
echo '<td>'.calificacion($row55['calidad_respuesta']).'</td>';
//	array_push($arrayc, $row_reseo['tiempo_respuesta']);
echo '<td>'.calificacion($row55['tiempo_respuesta']).'</td>';
//	array_push($arrayc, $row_reseo['amabilidad_atencion']);
echo '<td>'.calificacion($row55['amabilidad_atencion']).'</td>';
echo '<td><a href="" class="buscar_percepcion" id='.$row55['id_percepcion_oac'].' data-toggle="modal" data-target="#popupnewpercepcion"><span class="glyphicon glyphicon-search"></span></a> &nbsp; ';


if (1==$_SESSION['rol']) {
echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="percepcion_oac" id="'.$row55['id_percepcion_oac'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else { }

echo '</td></tr>';
} while ($row55 = mysql_fetch_assoc($select55));
mysql_free_result($select55);



} else {}
echo '</tbody></table>';


?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="popupnewpercepcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Percepción</label></h4>
</div> 
<div class="ver_percepcion" class="modal-body"> 





</div>
</div> 
</div> 
</div> 



<?php
} else { }
?>






