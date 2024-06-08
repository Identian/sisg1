<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 
	require_once('listas.php');

if (1==$_SESSION['rol']) {
$idbe=intval($_POST['option']);
$query="SELECT * FROM tramite_interno where id_tramite_interno=".$idbe." and estado_tramite_interno=1 limit 1";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
?>
<div style="padding:10px 10px 10px 10px">
<form action="" method="POST" name="for4354m1">

<div class="form-group text-left"> 
<label  class="control-label">DANE:</label> 
<?php echo $row['n_dane']; ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label">DANS:</label> 
<?php echo $row['n_dans']; ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE GESTION:</label> 
<select  class="form-control" name="tipo_gestion" required>
<option value="<?php echo $row['tipo_gestion']; ?>" selected><?php echo $row['tipo_gestion']; ?></option>
<option value="Tramite">Tramite</option>
<option value="Archivo">Archivo</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> VIA DE ENTRADA:</label> 
<select class="form-control" name="via_entrada"  required>
<option value="<?php echo $row['via_entrada']; ?>" selected><?php echo $row['via_entrada']; ?></option>

  <option value="Iris">Iris</option>
  <option value="Delegada de Notariado">Delegada de Notariado</option>
<option value="Correo">Correo</option>
<option value="Otra..">Otra..</option>
  </select>


</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICADO:</label> 
<input type="text" readonly class="form-control" name="radicado" value="<?php echo $row['radicado']; ?>" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>  RADICADO SALIDA:</label> 
<input type="text" class="form-control" name="radicado_salida" value="<?php echo $row['radicado_salida']; ?>" required >
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESTADO:</label> 
<select  class="form-control" name="resuelto"  required>
<option value="<?php echo $row['resuelto']; ?>" selected><?php if (1==$row['resuelto']) { echo 'Resuelto'; } else { echo 'No resuelto'; }  ?></option>
<option value="1">Resuelto</option>
<option value="0">No Resuelto</option>
</select>
</div>

<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> VIA DE TRAMITE:</label> 
<select  class="form-control" name="via_tramite" required readonly>
<option value="" selected></option>
<option value=""></option>
</select>
</div>-->

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> PROCEDIMIENTO:</label> 
<select  class="form-control" name="id_procedimiento_interno" id="id_procedimiento_interno" required>
<option value="<?php echo $row['id_procedimiento_interno']; ?>" selected><?php echo quees('procedimiento_interno', $row['id_procedimiento_interno']); ?></option>
<?php echo lista('procedimiento_interno'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TRAMITE:</label> 
<select  class="form-control" name="id_accion_interna" id="id_accion_interna" required>
<option value="<?php echo $row['id_accion_interna']; ?>" selected><?php echo quees('accion_interna', $row['id_accion_interna']); ?></option>
<?php echo lista('accion_interna'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FOLIOS:</label> 
<input type="text" class="form-control numero" name="folios" value="<?php echo $row['folios']; ?>" >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE SOLICITANTE:</label> 
<select class="form-control" name="tipo_solicitante" required="">
  <option value="<?php echo $row['tipo_solicitante']; ?>" selected><?php echo $row['tipo_solicitante']; ?></option>
  <option value="Funcionario">Funcionario</option>
  <option value="Notaria">Notaria</option>
<option value="Particular">Particular</option>
  </select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NOTARIA:</label> 
<select class="form-control" name="id_notaria" >
<option value="<?php echo $row['id_notaria']; ?>" selected><?php if (isset($row['id_notaria'])) { echo quees('notaria', $row['id_notaria']); } else {} ?></option>
<?php echo lista('notaria'); ?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">NOMBRE DEL SOLICITANTE:</label> 
<input type="text" class="form-control" name="solicitante" value="<?php echo $row['solicitante']; ?>" required >
</div>


<div class="form-group text-left"> 
<label  class="control-label">CEDULA DEL SOLICITANTE:</label> 
<input type="text" class="form-control numero" name="cedula" value="<?php echo $row['cedula']; ?>" >
</div>


<div class="form-group text-left"> 
<label  class="control-label">DETALLE DEL TRAMITE:</label> 
<textarea class="form-control" name="detalle_tramite"><?php echo $row['detalle_tramite']; ?></textarea>
</div>

<div class="form-group text-left"> 
<label  class="control-label">FUNCIONARIO QUE ENTREGA:</label> 
<select  class="form-control" name="id_funcionario_entrega" >
<?php
$queryt = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_grupo_area=46 and estado_funcionario=1 order by nombre_funcionario"); 
$selectt = mysql_query($queryt, $conexion) ;
$rowt = mysql_fetch_assoc($selectt);
$totalRowst = mysql_num_rows($selectt);
if (0<$totalRowst){
do {
	echo '<option value="'.$rowt['id_funcionario'].'" ';
	
	if ($row['id_funcionario_entrega']==$rowt['id_funcionario']) { echo 'selected'; } else {}
	echo '>'.$rowt['nombre_funcionario'].'</option>';
	 } while ($rowt = mysql_fetch_assoc($selectt)); 
} else {}	 
mysql_free_result($selectt);
?>
</select>
</div>
<!--
<div class="form-group text-left"> 
<label  class="control-label">N DE DANE:</label> 
<select  class="form-control" name="n_dane" >
<option value="" selected></option>
<option value=""></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">N DE DANS:</label> 
<select  class="form-control" name="n_dans" >
<option value="" selected></option>
<option value=""></option>
</select>
</div>
-->
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FUNCIONARIO RESPONSABLE:</label> 
<select  class="form-control" name="id_funcionario_responsable" required>
<?php
$queryt = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_grupo_area=46 and estado_funcionario=1 order by nombre_funcionario"); 
$selectt = mysql_query($queryt, $conexion) ;
$rowt = mysql_fetch_assoc($selectt);
$totalRowst = mysql_num_rows($selectt);
if (0<$totalRowst){
do {
	echo '<option value="'.$rowt['id_funcionario'].'" ';
	
	if ($row['id_funcionario_responsable']==$rowt['id_funcionario']) { echo 'selected'; } else {}
	echo '>'.$rowt['nombre_funcionario'].'</option>';
	 } while ($rowt = mysql_fetch_assoc($selectt)); 
} else {}	 
mysql_free_result($selectt);
?>

</select>
</div>
<hr>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE CORREO:</label> 
<input type="date" class="form-control " value="<?php echo $row['fecha_correo']; ?>" name="fecha_correo"   >
</div>
<div class="form-group text-left"> 
<label  class="control-label">DEL CORREO:</label> 
<input type="text" class="form-control" name="de_correo" value="<?php echo $row['de_correo']; ?>" >
</div>
<div class="form-group text-left"> 
<label  class="control-label">PARA EL CORREO:</label> 
<input type="text" class="form-control" name="para_correo" value="<?php echo $row['para_correo']; ?>" >
</div>
<div class="form-group text-left"> 
<label  class="control-label">ASUNTO DEL CORREO:</label> 
<textarea type="text" class="form-control" name="asunto"><?php echo $row['asunto']; ?></textarea>
</div>





<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<input type="hidden"  name="id_tramite_interno" value="<?php echo $row['id_tramite_interno']; ?>" >
<input type="hidden" name="tipo" value="actualizar" >
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>

</form>
<?php } ?>
</div>
<?php
mysql_free_result($select);
 } else {} 
 ?>
