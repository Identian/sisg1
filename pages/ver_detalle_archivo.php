<?php
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=$_POST['option'];
require_once('../conf.php'); 


$query_update = sprintf("SELECT * FROM archivo WHERE id_archivo = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	
?>
 
<div style="padding: 10px 10px 10px 10px">
 
<form action="" method="POST" name="for54364563m1" enctype="multipart/form-data" >

<div class="form-group text-left"> 
<label  class="control-label">NÚMERO:</label>   
<input type="text" class="form-control" name="numero_archivo"   value="<?php echo $row_update['numero_archivo']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE PUBLICACIÓN:</label>   
<input type="date" class="form-control" name="fecha_publicacion"  value="<?php echo $row_update['fecha_publicacion']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE DESFIJACIÓN:</label>   
<input type="date" class="form-control" name="fecha_desfijacion"  value="<?php echo $row_update['fecha_desfijacion']; ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label">ASUNTO:</label>   
<textarea class="form-control" name="nombre_archivo" ><?php if (0==$row_update['codificado']) { echo utf8_encode($row_update['nombre_archivo']); } else { echo $row_update['nombre_archivo']; }  ?></textarea>
</div>

<div class="form-group text-left"> 
<label  class="control-label">NORMATIVIDAD:</label>   
<select  class="form-control" name="id_normatividad" >
<?php

$query = sprintf("SELECT * FROM normatividad where estado_normatividad=1 order by id_normatividad"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {

	echo '<option value="'.$row['id_normatividad'].'" ';
	
	if ($row_update['id_normatividad']==$row['id_normatividad']) { echo 'selected';} else {}
	echo '>'.$row['nombre_normatividad'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 
mysql_free_result($select);
?>

</select>
</div>

<div class="modal-footer">
<?php echo ' <a href="files/'.$row_update['carpeta'].'/'.$row_update['url'].'" target="_blank"><img src="images/pdf.png"> Documento</a>';
?>
</div>




<div class="modal-footer">
<input type="hidden"  name="id_archivo"   value="<?php echo $row_update['id_archivo']; ?>">

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



