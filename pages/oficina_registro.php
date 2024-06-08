<?php
$query = sprintf("SELECT id_oficina_registro, nombre_oficina_registro, circulo FROM oficina_registro where estado_oficina_registro=1 order by id_oficina_registro"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_oficina_registro'].'">'.$row['circulo'].' - '.$row['nombre_oficina_registro'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
