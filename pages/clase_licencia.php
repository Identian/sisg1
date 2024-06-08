<?php
$query7 = sprintf("SELECT id_clase_licencia, nombre_clase_licencia FROM clase_licencia where estado_clase_licencia=1 order by id_clase_licencia"); 
$select7 = mysql_query($query7, $conexion) or die(mysql_error());
$row7 = mysql_fetch_assoc($select7);
$totalRows7 = mysql_num_rows($select7);
if (0<$totalRows7){
do {
	echo '<option value="'.$row7['id_clase_licencia'].'">'.strtoupper($row7['nombre_clase_licencia']).'</option>';
	 } while ($row7 = mysql_fetch_assoc($select7)); 
} else {}	 
mysql_free_result($select7);
?>