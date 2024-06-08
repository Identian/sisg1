<?php

if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=intval($_POST['option']);

require_once('../conf.php'); 


$query_update = "SELECT * FROM entidad_reparto where id_entidad_reparto= ".$id."  and estado_entidad_reparto=1 limit 1";
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	
?>
 
<div style="padding: 10px 10px 10px 10px">
 
<form action="" method="POST" name="for54432dsfds3m1">


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Entidad:</label> 
<input  type="text"  class="form-control" name="nombre_entidad_reparto2" value="<?php echo $row_update['nombre_entidad_reparto']; ?>" 
 required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NIT:</label> 
<input  type="text"  class="form-control" name="nit_entidad2" value="<?php echo $row_update['nit_entidad']; ?>" 
 required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo:</label> 
<input type="text" class="form-control" name="tipo2" value="<?php echo $row_update['tipo']; ?>" 
 required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Es entidad territorial:</label> 
<select class="form-control" name="tipo_entidad2"  required>
<option></option>
<option value="1" <?php if (1==$row_update['tipo_entidad']) { echo 'selectded'; } else {} ?> >Si</option>
<option value="0"  <?php if (0==$row_update['tipo_entidad']) { echo 'selectded'; } else {} ?>>No</option>
</select>

</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Correo electrónico: (Separado por ,)</label> 
<input type="text" class="form-control" name="correo_entidad2" value="<?php echo $row_update['correo_entidad']; ?>" 
 required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dirección:</label> 
<input  type="text"  class="form-control" name="direccion_entidad2" value="<?php echo $row_update['direccion_entidad']; ?>" 
 required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Exento:</label> 
<select type="text" class="form-control"  name="exento2"  required>
<option value="1" <?php if (1==$row_update['exento']) { echo 'selected'; } else {} ?> >Si</option>
<option value="0" <?php if (0==$row_update['exento']) { echo 'selected'; } else {} ?> >No</option>
</select>
</div>



<div class="modal-footer">
<input type="hidden"  name="id_entidad_reparto2"  value="<?php  echo $row_update['id_entidad_reparto']; ?>">

<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div>

</form>

<br>
<hr>


<form action="" method="POST" name="for3432454432dsfds3m1">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input  type="text"  class="form-control" name="nombre_permiso_entidad_reparto" value=""  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Numero de cedula:</label> 
<input  type="text"  class="form-control" name="cedula_ciudadano" value=""  required>
</div>


<div class="modal-footer">
<input type="hidden"  name="id_entidad_reparto3"  value="<?php  $enti=$row_update['id_entidad_reparto']; echo $enti; ?>">

<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Vincular </button>
</div>

</form>
<hr>
Personas vinculadas que pueden solicitar repartos:<br>
<?php
$query2 = sprintf("SELECT * FROM permiso_entidad_reparto where id_entidad_reparto=".$enti." and estado_permiso_entidad_reparto=1 "); 
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
$totalRows2 = mysql_num_rows($select2);
if (0<$totalRows2){
do {
	echo '<li>'.$row2['nombre_permiso_entidad_reparto'].' - '.$row2['cedula_ciudadano'].'</li>';
	 } while ($row2 = mysql_fetch_assoc($select2)); 
} else {}	 
mysql_free_result($select2);

?>

<br>
      </div>



<?php 
} else {}
mysql_free_result($update);
} else { }

?>




