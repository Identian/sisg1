<?php
if (isset($_POST['option'])) {
$option=$_POST['option'];
require_once('../conf.php');
$option1=str_replace("id_","",$option);

$query = sprintf("SELECT * FROM ".$option1); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
echo '<select  class="form-control" name="'.$option.'" ';

if ('departamento'==$option1) { echo 'id="departamento" '; } else {}

echo ' required>';
    echo '<option value=""> - - Seleccionar Opción - - </option>';
	do {
	echo '<option value="'.$row['id_'.$option1].'">'.$row['nombre_'.$option1].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
echo '</select>';
}else {}

?>
