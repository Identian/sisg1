<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$ed=$_POST['option'];

$info=explode('-',$ed);
$tablam=$info[0];
$regm=$info[1];
require_once('../conf.php'); 

?>
 

<div style="padding: 10px 10px 10px 10px">

    
<form action="" method="POST" name="for543643432563m1"  >
<input type="hidden"  name="id_macroprocesou"  value="<?php echo $regm; ?>"  >

<?php
$varm=' id_'.$tablam.'='.$regm.' and estado_'.$tablam.'=1';
//echo $varm;
$consulta = mysql_query("SELECT * FROM ".$tablam." WHERE ".$varm." limit 1", $conexion);
$row1 = mysql_fetch_assoc($consulta);
$nn = mysql_num_rows($consulta);
if (0<$nn) {
	?>
<div class="form-group text-left"> 
<label  class="control-label">Macroproceso: </label>   
<input type="text" class="form-control" name="nombre_macroproceso"  value="<?php echo $row1['nombre_macroproceso']; ?>"  >
</div>


<div class="form-group text-left"> 
<label  class="control-label">Tipo de Macroproceso </label>   
<select  class="form-control" name="id_tipo_macroprocesou">
<option></option>
<?php
$query = sprintf("SELECT * FROM tipo_macroproceso where estado_tipo_macroproceso=1 order by id_tipo_macroproceso"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_macroproceso'].'"  ';
	
	if ($row1['id_tipo_macroproceso']==$row['id_tipo_macroproceso']) { echo 'selected';} else {} 
	
	echo '>'.$row['nombre_tipo_macroproceso'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Descripción Macroproceso </label>   
<textarea type="text" class="form-control" name="descripcion_macroproceso"><?php echo $row1['descripcion_macroproceso']; ?>
</textarea>
</div>


<div class="form-group text-left"> 
<span style="color:#ff0000;">* Obligatorio</span> 
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Actualizar</button>
</div>



<?php
} else {}

mysql_free_result($consulta);

?>


</form>


<?php } else { }?>



