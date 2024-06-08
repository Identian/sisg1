<?php
$query = sprintf("SELECT id_vigencia_licencia, nombre_vigencia_licencia FROM vigencia_licencia where estado_vigencia_licencia=1 order by id_vigencia_licencia"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_vigencia_licencia'].'">'.$row['nombre_vigencia_licencia'].' meses</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>