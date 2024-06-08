<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=intval($_POST['option']);
require_once('../conf.php'); 
?>
 
<div style="padding: 10px 10px 10px 10px">
<form action="" method="post" name="ewrewr">
<div class="form-group text-left"> 
<label  class="control-label">Entidad:</label> 
<select name="nombre_entidad_reparto2" class="form-control" required>
<option></option>
<?php
$query = sprintf("SELECT * FROM entidad_reparto where estado_entidad_reparto=1 order by nombre_entidad_reparto"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_entidad_reparto'].'">'.$row['nombre_entidad_reparto'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 

mysql_free_result($select);
?>
</select>

</div>



<div class="modal-footer">

<button type="submit" class="btn btn-success" >
<input type="hidden" name="reparto_proyecto" value="<?php echo $id; ?>">
<span class="glyphicon glyphicon-ok"></span> Cambiar </button>
</div>
</form>


</div>

<?php
} else {}
?>


