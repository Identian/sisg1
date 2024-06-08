<?php
$query = sprintf("SELECT id_departamento, nombre_departamento FROM departamento where estado_departamento=1 order by id_departamento"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_departamento'].'">'.$row['nombre_departamento'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>