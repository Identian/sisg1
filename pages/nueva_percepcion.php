<?php

if (isset($_GET['i']) &&  (2==$_SESSION['snr_tipo_oficina'] or 24 == $_SESSION['snr_grupo_area'] or 1==$_SESSION['rol'])) {
	$id=intval($_GET['i']);



if (1==$_SESSION['snr_tipo_oficina']){
$valp=0;
$nomp='Oficina de Atención al Ciudadano';
} else if (2==$_SESSION['snr_tipo_oficina']){
$valp=$_SESSION['id_oficina_registro'];
$nomp=quees('oficina_registro', $valp);
} else {}



if ((isset($_POST["table"])) && ($_POST["table"] == "percepcion_oac")) { 

$insertSQL = sprintf("INSERT INTO percepcion_oac (id_ciudadano, modulo_atencion, id_funcionario_atendio, id_servicio_oac, calificacion_servicio, nombre_percepcion_oac, claridad_lenguaje, agilidad_atencion, calidad_respuesta, tiempo_respuesta, amabilidad_atencion, observaciones, fecha_percepcion_oac, estado_percepcion_oac, id_oficina_registro, id_tipo_ciudadano) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
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
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo $insertado;
} else {
	
}



?>



<div class="row">

<div class="col-md-9" >
  
<div class="box">


<div class="box-header with-border">
<h3 class="box-title"><b>Nueva Percepción: </b> <?php echo $nomp; ?></h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
			
	<div class="row" >
	 <div class="col-md-6">
			<?php
		
global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}
	
$query4 = sprintf("SELECT * FROM ciudadano where id_ciudadano='$id' and estado_ciudadano=1 limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
if (0<count($row4)){
$nombre = $row4['nombre_ciudadano'];
$identificacion = $row4['identificacion'];
$correo_ciudadano = $row4['correo_ciudadano'];
$direccion_ciudadano = $row4['direccion_ciudadano'];
$id_ciudadano=$row4['id_ciudadano'];
$dep=$row4['id_departamento'];
$mun=$row4['id_municipio'];
$tipod=$row4['id_tipo_documento'];
$telefono=$row4['telefono_ciudadano'];
$etnia=$row4['id_etnia'];
} else { }
$result4->free();

echo '<b>Nombre:</b> '.$nombre.'<br>';
echo '<b>Tipo de documento:</b> ';
echo ''.quees('tipo_documento', $tipod).'<br>';
echo '<b>Identificación:</b> '.$identificacion.'<br>';
echo '<b>Etnia:</b> ';
echo ''.quees('etnia', $etnia).'<br>';
echo '<b>E-mail:</b> '.$correo_ciudadano.'<br>';
echo '<b>Telefono:</b> '.$telefono.'<br>';
echo '<b>Dirección:</b> '.$direccion_ciudadano.'<br>';
?>
</div>
 <div class="col-md-6">
<?php
echo '<b>Departamento:</b> ';
echo ''.quees('departamento', $dep).'<br>';
echo '<b>Municipio:</b> ';
echo ''.quees('municipio', $mun).'<br>';

?>
</div>
</div>		
			


<form action="" method="POST" name="for3456345m1">
<hr>

<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE LA PERCEPCIÓN:</label> 
</div>
</div>
<div class="col-md-8">
<input type="date" class="form-control" name="fecha_percepcion_oac" style="width:180px;" required>
</div>
</div>










<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> EL CIUDADANO ES:</label> 
<select  class="form-control" name="id_tipo_ciudadano" required>
<option value="" selected></option>
<?php
$query = sprintf("SELECT * FROM tipo_ciudadano where estado_tipo_ciudadano=1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
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
$select = mysql_query($query, $conexion) or die(mysql_error());

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
</center>
</B>
</div>
</div>

</div>
<hr>
<div class="form-group text-left"> 
<label  class="control-label">CLARIDAD DEL LENGUAJE:</label> 
<select  class="form-control" name="claridad_lenguaje" >
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">AGILIDAD EN LA ATENCIÓN:</label> 
<select  class="form-control" name="agilidad_atencion" >
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CALIDAD DE LA RESPUESTA:</label> 
<select  class="form-control" name="calidad_respuesta" >
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">TIEMPO DE RESPUESTA:</label> 
<select  class="form-control" name="tiempo_respuesta" >
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">AMABILIDAD EN LA ATENCION:</label> 
<select  class="form-control" name="amabilidad_atencion" >
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">OBSERVACIONES Y/O SUGERENCIAS:</label> 
<textarea class="form-control" name="observaciones" style="height:200px;"></textarea>
</div>

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="percepcion_oac">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div></form>




</div>
</div>
</div>




<div class="col-md-3">

	  <div class="box box-success direct-chat direct-chat-warning" >
                <div class="box-header with-border">
                  <h3 class="box-title">PQRS del mismo Ciudadano</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
				<div  class="modal-body" style="max-height:450px;">
		

			<?php
			
		
$query48 = sprintf("SELECT * FROM solicitud_pqrs, ciudadano where ciudadano.id_ciudadano=".$id."  and solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and estado_solicitud_pqrs=1 order by id_solicitud_pqrs desc"); 
$result8 = $mysqli->query($query48);

	while($row9 = $result8->fetch_array(MYSQLI_ASSOC)) {
		
			echo '<a href="solicitud_pqrs&'.$row9['id_solicitud_pqrs'].'.jsp">'.$row9['radicado'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row9['fecha_radicado'].'</span><br>';
			echo $row9['nombre_solicitud_pqrs'].'<hr>';
			
			
			
	}
	$result8->free();
?>
		

		
<?php
		
$actualizar57ll = mysql_query("SELECT * FROM radi_cert where identificacion='$identificacion' and estado_radi_cert=1", $conexion) or die(mysql_error());
$row157ll = mysql_fetch_assoc($actualizar57ll);
$total557ll = mysql_num_rows($actualizar57ll);
if (0<$total557ll) {
 do { 
 
		echo '<a href="https://sisg.supernotariado.gov.co/radicado_anterior&'.$row157ll['id_radi_cert'].'.jsp">Certicamara '.$row157ll['radi_cert'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row157ll['fecha_radi_cert'].'</span><br>';
			echo $row157ll['nombre_radi_cert'].'<hr>';
 
 } while ($row157ll = mysql_fetch_assoc($actualizar57ll)); 
  mysql_free_result($actualizar57ll);
} else {}
?>




		

		
			
			</div>
			</div>	
	</div>
	

</div>



</div>

<?php } else { echo ''; }