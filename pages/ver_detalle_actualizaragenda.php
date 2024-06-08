<?php
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=$_POST['option'];
require_once('../conf.php'); 


$query_update = sprintf("SELECT * FROM ventanilla WHERE id_ventanilla = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	
?>
 
<div style="padding: 10px 10px 10px 10px">
 
<form action="" method="POST" name="for54454324435354r65464563m1" >

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO:</label> 
<input type="text" class="form-control numero" name="numero_ventanillaact" value="<?php echo $row_update['numero_ventanilla']; ?>" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TRAMITE:</label> 
<select type="text" class="form-control" name="nombre_ventanillaact"  required>
<option value="<?php echo $row_update['nombre_ventanilla']; ?>" selected><?php echo $row_update['nombre_ventanilla']; ?></option>
<?php if (0==$row_update['id_oficina_registro']) {
echo '<option value="Atención de ciudadanos">Atención de ciudadanos</option>';
} else { ?>
<option value="Entrega de Documentos">Entrega de Documentos</option>
<option value="Correcciones">Correcciones</option>
<option value="Liquidación">Liquidación</option>
<option value="Radicación de documentos">Radicación de documentos</option>
<option value="Liquidación y Radicación de documentos">Liquidación y Radicación de documentos</option>
<option value="REVAL Generación de certificados tradición y de pertenencia">REVAL Generación de certificados tradición y de pertenencia</option>
<?php } ?>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ASIGNACIÓN:</label> 
<select  class="form-control" name="id_funcionario" required>
<?php
if (0==$row_update['id_oficina_registro']) {
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_grupo_area=24 and estado_funcionario=1 order by nombre_funcionario"); 	
} else {
$idorip=$row_update['id_oficina_registro'];
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_oficina_registro=".$idorip." and estado_funcionario=1 order by nombre_funcionario"); 
}
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_funcionario'].'" ';
	if ($row['id_funcionario']==$row_update['id_funcionario']) { echo ' selected';} else {}
	echo '>'.$row['nombre_funcionario'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 

mysql_free_result($select);
?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RECESO:</label> 
<select class="form-control" name="receso"  required>
<option value="0" <?php if (0==$row_update['receso']) { echo 'selected'; } else { } ?>>12:00 a 13:00</option>
<option value="1" <?php if (1==$row_update['receso']) { echo 'selected'; } else { } ?>>13:00 a 14:00</option>
<option value="2" <?php if (2==$row_update['receso']) { echo 'selected'; } else { } ?>>Sin receso</option>

</select>
</div>


<div class="modal-footer">
<input type="hidden"  name="id_ventanillaact"   value="<?php echo $row_update['id_ventanilla']; ?>">

<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div>

</form>

<br><br>
      </div>



<?php 
} else {}
mysql_free_result($update);
} else { }?>



