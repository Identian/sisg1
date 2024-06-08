<?php 
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 
	require_once('listas.php');
	$idper=intval($_POST['option']);
	
$query = sprintf("SELECT * FROM situacion_curaduria where id_situacion_curaduria=".$idper." ");
$select = mysql_query($query, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($select);
echo '<div style="padding: 30px 30px 30px 30px">';


?>


<form action="" method="POST" name="form1" enctype="multipart/form-data">



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CURADOR:</label> 
<select  class="form-control" name="id_funcionario" required>
<option value=""></option>
<?php 
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where estado_funcionario=1 and id_tipo_oficina=4 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'" ';
	if ($row_update['id_funcionario']==$row['id_funcionario']) {
		echo 'selected';
	} else {}
	echo '>'.strtoupper($row['nombre_funcionario']).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">ACTO DE NOMBRAMIENTO:</label> 
<select  class="form-control" name="id_tipo_acto" >
<option value=""></option>
<?php 
$query = sprintf("SELECT id_tipo_acto, nombre_tipo_acto FROM tipo_acto where estado_tipo_acto=1 order by id_tipo_acto"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_acto'].'" ';
	if ($row_update['id_tipo_acto']==$row['id_tipo_acto']) {
		echo 'selected';
	} else {}
	echo '>'.strtoupper($row['nombre_tipo_acto']).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label">NÚMERO DE ACTO:</label> 
<input type="text" class="form-control numero" name="nombre_situacion_curaduria" value="<?php echo $row_update['nombre_situacion_curaduria'];?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE NOMBRAMIENTO:</label> 
<input type="date" class="form-control" name="fecha_nombramiento" value="<?php echo $row_update['fecha_nombramiento'];?>"   >
</div>
</div>
</div>


<div class="row">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DECRETO DE ACTO DE NOMBRAMIENTO:</label> 
<input type="file" class="form-control" required  name="file" >
</div>
</div>



<div class="form-group text-left"> 
<label  class="control-label">MODALIDAD DE SELECCIÓN:</label> 
<select class="form-control" name="modalidad_seleccion"  >
<option value=""></option>
<?php 
$query = sprintf("SELECT id_modalidad_s_curaduria, nombre_modalidad_s_curaduria FROM modalidad_s_curaduria where estado_modalidad_s_curaduria=1 order by id_modalidad_s_curaduria"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_modalidad_s_curaduria'].'" ';
	if ($row_update['modalidad_seleccion']==$row['id_modalidad_s_curaduria']) {
		echo 'selected';
	} else {}
	echo '>'.strtoupper($row['nombre_modalidad_s_curaduria']).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">ENTIDAD QUE DESIGNA:</label> 
<select class="form-control" name="entidad_designa">
<option value=""></option>
<?php 
$query = sprintf("SELECT id_entidad_d_curaduria, nombre_entidad_d_curaduria FROM entidad_d_curaduria where estado_entidad_d_curaduria=1 order by id_entidad_d_curaduria"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_entidad_d_curaduria'].'" ';
	if ($row_update['entidad_designa']==$row['id_entidad_d_curaduria']) {
		echo 'selected';
	} else {}
	echo '>'.strtoupper($row['nombre_entidad_d_curaduria']).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<script>
function cur_nombra_propiedad() {
	
	var cura= document.getElementById("cura_nombra_propiedad").value;
	if (1==cura) {
		document.getElementById("termina").style="display:none;";
	} else {
		
	}
}

</script>
<div class="form-group text-left"> 
<label  class="control-label">TIPO DE NOMBRAMIENTO:</label> 
<select  class="form-control" name="id_tipo_nombramiento" id="cura_nombra_propiedad" onchange="cur_nombra_propiedad();" >
<option value=""></option>
<?php 
$query = sprintf("SELECT id_tipo_nombramiento, nombre_tipo_nombramiento FROM tipo_nombramiento where estado_tipo_nombramiento=1 order by id_tipo_nombramiento"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_nombramiento'].'" ';
	if ($row_update['id_tipo_nombramiento']==$row['id_tipo_nombramiento']) {
		echo 'selected';
	} else {}
	echo '>'.strtoupper($row['nombre_tipo_nombramiento']).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label">NÚMERO - ACTA DE POSESIÓN:</label> 
<input type="text" class="form-control numero" name="n_acta_posesion" value="<?php echo $row_update['n_acta_posesion'];?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label">FECHA - ACTA DE POSESIÓN:</label> 
<input type="date" required class="form-control " name="fecha_acta_posesion"  value="<?php echo $row_update['fecha_acta_posesion'];?>" >
</div>
</div>
</div>


<div class="row">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO DEL ACTA DE POSESION:</label> 
<input type="file" class="form-control" required  name="fileacta" >
</div>
</div>



<div class="form-group text-left" id="termina" style=""> 
<label  class="control-label">FECHA DE TERMINACIÓN:</label> 
<input type="date"  class="form-control "  name="fecha_terminacion" value="<?php echo $row_update['fecha_terminacion'];?>"  >
</div>


<!--
<div class="row">
<div class="col-md-8">
<div class="form-group text-left"> 
<label  class="control-label">EXPERIENCIA LABORAL EN EL EJERCICIO DE ACTIVIDADES DE DESARROLLO O PLANIFICACIÓN URBANA:</label> 
<select class="form-control" name="experiencia"  >
<option value=""></option>
<option value="Si" <?php //if ("Si"==$row_update['experiencia']) { echo 'selected'; } else { } ?>>Si</option>
<option value="No" <?php //if ("No"==$row_update['experiencia']) { echo 'selected'; } else { } ?>>No</option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><br>AÑOS DE EXPERIENCIA:</label> 
<input type="text" class="form-control numero" name="anos_experiencia" value="<?php echo $row_update['anos_experiencia'];?>"  >
</div>
</div>
</div>
-->


<input type="hidden"  name="id_situacion_curaduria" value="<?php echo $row_update['id_situacion_curaduria'];?>"  >
<input type="hidden"  name="actualizacion_curaduria" value="1"  >




<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success"><input type="hidden" name="table" value="situacion_curaduria"><span class="glyphicon glyphicon-ok">
</span> Actualizar </button></div></form>


<?php
echo '</div>';
	mysql_free_result($select);
} else {}

?>
