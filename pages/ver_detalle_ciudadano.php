<?php
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=explode('---', $_POST['option']);
$id1=$id[0];
$id_ventanilla=$id[1];
require_once('../conf.php'); 
$realdate=date('Y-m-d');
$query_update = sprintf("SELECT * FROM ciudadano WHERE id_tipo_documento=1 and identificacion = %s limit 1", GetSQLValueString($id1, "int"));
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
?>

<input type="hidden"  name="id_ciudadano"  value="<?php echo $row_update['id_ciudadano']; ?>" required>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre del Ciudadano:</label> 
<input type="text" class="form-control" name="nombre_ciudadano" readonly value="<?php echo $row_update['nombre_ciudadano']; ?>" required>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> E-mail:</label> 
<input type="text" class="form-control" name="correo_ciudadano" readonly value="<?php echo $row_update['correo_ciudadano']; ?>" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Disponibilidad:</label> 
<select  class="form-control" name="id_agenda_ventanilla" required>
<option value="" selected></option>
<?php
$query = sprintf("select id_agenda_ventanilla, nombre_agenda_ventanilla FROM agenda_ventanilla where 
id_ventanilla=".$id_ventanilla." and not id_agenda_ventanilla IN (select id_agenda_ventanilla from cita_ventanilla WHERE fecha_cita='$realdate' AND estado_cita_ventanilla=1) "); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_agenda_ventanilla'].'">'.$row['nombre_agenda_ventanilla'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 

mysql_free_result($select);
?>
</select>
</div>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="instruccion_admin">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

<?php 
} else { ?>
<div class="form-group text-left"> 
<label  class="control-label">No existe el ciudadano, se debe crear.</label> 
</div>
<?php }
mysql_free_result($update);
} else { }?>




