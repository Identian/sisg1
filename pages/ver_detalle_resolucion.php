<?php 
session_start();

if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 
	require_once('listas.php');
	$idper=intval($_POST['option']);
	
	
$numpr=privilegios(19,$_SESSION['snr']);


	
	
$query = sprintf("SELECT * FROM resolucion where id_resolucion=".$idper." and estado_resolucion=1 limit 1");
$select = mysql_query($query, $conexion) or die(mysql_error());
$row_sel = mysql_fetch_assoc($select);
echo '<div style="padding: 10px 30px 30px 30px">';

if (1==$_SESSION['rol'] or 0<$numpr) {
	?>

<form action="" method="POST" name="form1">

<div class="form-group text-left"> 
<input type="hidden" name="id_resolucion" value="<?php echo $row_sel['id_resolucion']; ?>">
<label  class="control-label">VIGENCIA:</label>   
<input class="form-control numero" maxlength="2" readonly="readonly" name="vigencia" value="<?php echo $row_sel['vigencia']; ?>" required>
</div>
<div class="form-group text-left"> 
<label  class="control-label">RESOLUCION:</label>   
<input  class="form-control numero" name="resolucion" readonly="readonly"  value="<?php echo $row_sel['resolucion']; ?>" required>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA:</label>   
<input type="date" class="form-control" name="fecha_exp_resolucion"  value="<?php echo $row_sel['fecha_exp_resolucion']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">ASUNTO:</label>   
<textarea class="form-control" name="nombre_resolucion" ><?php echo $row_sel['nombre_resolucion']; ?></textarea>
</div>

<div class="form-group text-left"> 
<label  class="control-label">MUNICIPIO: 
</label>   
<select  class="form-control" name="id_municipio" >
<option value=""></option>
<?php

$querym = sprintf("SELECT * FROM municipio where estado_municipio=1 order by nombre_municipio"); 
$selectm = mysql_query($querym, $conexion) or die(mysql_error());
$rowm = mysql_fetch_assoc($selectm);
$totalRowsm = mysql_num_rows($selectm);
if (0<$totalRowsm){
do {
	echo '<option value="'.$rowm['id_municipio'].'" ';
	if ($row_sel['id_municipio']==$rowm['id_municipio']) { echo 'selected';} else {}
	echo '>'.$rowm['nombre_municipio'].'</option>';

	 } while ($rowm = mysql_fetch_assoc($selectm)); 
} else {
	
}	 
mysql_free_result($selectm);

?>

</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label">TIPO DE OFICINA:</label>   
<?php echo quees('tipo_oficina', $row_sel['id_tipo_oficina']);?>
<!--<select  class="form-control" name="id_tipo_oficina" id="id_tipo_oficina4" >-->
<?php
/*
$query = sprintf("SELECT id_tipo_oficina, nombre_tipo_oficina FROM tipo_oficina where estado_tipo_oficina=1 order by id_tipo_oficina"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_oficina'].'" ';
	if ($row_sel['id_tipo_oficina']==$row['id_tipo_oficina']) { ECHO 'selected';} else {}
	echo '>'.$row['nombre_tipo_oficina'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
*/
?>
<!--</select>-->
</div>
<div class="form-group text-left"> 
<label  class="control-label">OFICINA:</label>   



<select  class="form-control" name="codigo_oficina" >
<?php
if(1==$row_sel['id_tipo_oficina']) {
$query = sprintf("SELECT id_area, nombre_area FROM area where estado_area=1 order by nombre_area"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_area'].'" ';
	if ($row_sel['codigo_oficina']==$row['id_area']) { ECHO 'selected';} else {}
	echo '>'.$row['nombre_area'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}

} else if (2==$row_sel['id_tipo_oficina']) {
$query = sprintf("SELECT id_oficina_registro, nombre_oficina_registro FROM oficina_registro where estado_oficina_registro=1 order by nombre_oficina_registro"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_oficina_registro'].'" ';
	if ($row_sel['codigo_oficina']==$row['id_oficina_registro']) { ECHO 'selected';} else {}
	echo '>'.$row['nombre_oficina_registro'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}

} else if (3==$row_sel['id_tipo_oficina']) {
$query = sprintf("SELECT id_notaria, nombre_notaria FROM notaria where estado_notaria=1 order by nombre_notaria"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_notaria'].'" ';
	if ($row_sel['codigo_oficina']==$row['id_notaria']) { ECHO 'selected';} else {}
	echo '>'.$row['nombre_notaria'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}


} else if (4==$row_sel['id_tipo_oficina']) {
$query = sprintf("SELECT id_curaduria, nombre_curaduria FROM curaduria where estado_curaduria=1 order by nombre_curaduria"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_curaduria'].'" ';
	if ($row_sel['codigo_oficina']==$row['id_curaduria']) { ECHO 'selected';} else {}
	echo '>'.$row['nombre_curaduria'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}


} else {}

	 
mysql_free_result($select);
?>
</select>

</div>
<div class="form-group text-left"> 
<label  class="control-label">QUIEN SOLICITA:</label>   
<input type="text" class="form-control" name="quien_solicita" placeholder="Nombre opcional" value="<?php echo $row_sel['quien_solicita']; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label">SOLICITANTE: 
</label>   
<select  class="form-control" name="id_funcionario_solicita" >
<option value=""></option>
<?php

$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where estado_funcionario=1 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'" ';
	if ($row_sel['id_funcionario_solicita']==$row['id_funcionario']) { echo 'selected';} else {}
	echo '>'.$row['nombre_funcionario'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {
	
}	 
mysql_free_result($select);

?>

</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">AREA:</label>   
<select  class="form-control" name="id_area" required>
<?php
$query = sprintf("SELECT id_area, nombre_area FROM area where estado_area=1 order by nombre_area"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_area'].'" ';
	if ($row_sel['id_area']==$row['id_area']) { ECHO 'selected';} else {}
	echo '>'.$row['nombre_area'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>

</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">GRUPO DEL AREA:</label>   
<select  class="form-control" name="id_grupo_area" required>
<?php
$query = sprintf("SELECT id_grupo_area, nombre_grupo_area FROM grupo_area where estado_grupo_area=1 order by nombre_grupo_area"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_grupo_area'].'" ';
	if ($row_sel['id_grupo_area']==$row['id_grupo_area']) { ECHO 'selected';} else {}
	echo '>'.$row['nombre_grupo_area'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FUNCIONARIO QUE LA HACE:</label>   
<select  class="form-control" name="id_funcionario_hace" >
<option value=""></option>
<?php
$query = sprintf("SELECT DISTINCT(funcionario.id_funcionario), nombre_funcionario FROM funcionario, resolucion where funcionario.id_funcionario=resolucion.id_funcionario_hace and estado_resolucion=1 order by funcionario.nombre_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'" ';
	if ($row_sel['id_funcionario_hace']==$row['id_funcionario']) { echo 'selected';} else {}
	echo '>'.$row['nombre_funcionario'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">HORA DE LA RESOLUCIÓN:</label>  
<input type="text" class="form-control" name="hora_resolucion"   value="<?php echo $row_sel['hora_resolucion']; ?>">

</div>
<div class="form-group text-left"> 
<label  class="control-label">NÚMEROS DE FOLIOS:</label>   
<input type="text" class="form-control" name="num_folios"   value="<?php echo $row_sel['num_folios']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">FUNCIONARIO QUE FIRMA:</label>   
<select  class="form-control" name="id_funcionario_firma" >
<option></option>
<?php
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_tipo_oficina=1 and estado_funcionario=1 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'" ';
	if ($row_sel['id_funcionario_firma']==$row['id_funcionario']) { ECHO 'selected';} else {}
	echo '>'.$row['nombre_funcionario'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success"><input type="hidden" name="table" value="actualizar_resolucion">
<span class="glyphicon glyphicon-ok">
</span> Actualizar</button></div></form>
	
	<hr>
	<?php
	
}	else { 

echo '<b>Vigencia: </b>'.$row_sel['vigencia'].'<br>';
echo '<b>Resolución:</b> '.$row_sel['resolucion'].'<br>';
echo '<b>Fecha de expedición:</b> '.$row_sel['fecha_exp_resolucion'].'<br>';
echo '<b>Asunto:</b> '.$row_sel['nombre_resolucion'].'<br>';

if (isset($row_sel['id_tipo_oficina']) && ""!=$row_sel['id_tipo_oficina']) {
echo '<b>Tipo de oficina: </b>';

echo quees('tipo_oficina', $row_sel['id_tipo_oficina']);

echo '<br><b>Oficina: </b>';

if (1==$row_sel['id_tipo_oficina']) {
echo quees('area', $row_sel['codigo_oficina']);
} else if (2==$row_sel['id_tipo_oficina']) {
echo quees('oficina_registro', $row_sel['codigo_oficina']);
} else if (3==$row_sel['id_tipo_oficina']) {
echo quees('notaria', $row_sel['codigo_oficina']);
} else if (4==$row_sel['id_tipo_oficina']) {
echo quees('curaduria', $row_sel['codigo_oficina']);


} else {}

echo '<br>';
}	else {
	echo '<b>Tipo de oficina: </b> '.$row_sel['nombre_oficina'].'<br>';	
	}


if (1==$row_sel['id_tipo_oficina']) {
echo '<b>Grupo: </b> ';
echo quees('grupo_area', $row_sel['id_grupo_area']);
echo '<br>';
} else {}



if (isset($row_sel['id_tipo_oficina']) and ""!=$row_sel['quien_solicita']) {
echo '<b>Solicitante: </b> ';
echo  $row_sel['quien_solicita'];
echo '<br>';
} else {}





echo '<b>Número de folios: </b> ';
echo ''.$row_sel['num_folios'].'';
echo '<br>';
echo '<b>Firmado por: </b> ';
$name=quees('funcionario', $row_sel['id_funcionario_firma']);
echo strtoupper($name);
echo '<br>';
echo '';

}

mysql_free_result($select);
?>
<hr>
<b>Subir resolución: </b>

<form action=""  method="POST" name="form34sfg1ftregg" enctype="multipart/form-data">
<div class="form-group text-left">
<input type="file" name="file" required>
<input type="hidden" name="resolucionfile" value="<?php echo $idper; ?>">
<span style="color:#aaa;font-size:13px;">PDF inferior a 15 Mg</span>
 &nbsp;  &nbsp;  <button type="submit" class="btn btn-xs btn-success">
<span class="glyphicon glyphicon-user"></span> &nbsp; Subir &nbsp; </button>
</div>
</form>

<hr>
<?php

if (isset($row_sel['url_resolucion'])){
	
	
echo '<form action="" method="POST" name="fo5445r655465464G">';
echo ' <a href="files/resoluciones/'.$row_sel['url_resolucion'].'" target="_blank"><img src="images/pdf.png"> Resolución</a> ';



//echo '<a href="resoluciones&'.$row_sel['id_resolucion'].'&0.jsp" style="color:#B40404;"><span class="glyphicon glyphicon-trash" ></span></a>';



echo '<input type="hidden" name="borrar_documento_resolucion" value="'.$row_sel['id_resolucion'].'">
<button type="submit" class="glyphicon glyphicon-trash"></button></form>';

echo '<br>'; 

} else { }




$actualizar5 = mysql_query("SELECT * from documento_resolucion where id_resolucion=".$idper." and estado_documento_resolucion=1", $conexion);
$row_sel15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {

 do {


echo '<form action="" method="POST" name="for654G">';
echo '<a href="files/resoluciones/'.$row_sel15['nombre_documento_resolucion'].'" target="_blank"><img src="images/pdf.png"> Resolución </a>';
		
echo '<input type="hidden" name="borrar_documento" value="'.$row_sel15['id_documento_resolucion'].'">
<button type="submit" class="glyphicon glyphicon-trash"></button></form>';
	

		echo '<br>'; 
 } while ($row_sel15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);






echo '</div>';
	
	
	} else {}
	
} else {}

?>


