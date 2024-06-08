<?php
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=$_POST['option'];
require_once('../conf.php'); 


echo '<div style="padding: 10px 10px 10px 20px">';

$query_update = sprintf("SELECT * FROM agenda_ventanilla WHERE id_ventanilla = %s and estado_agenda_ventanilla=1", GetSQLValueString($id, "int"));
$select = mysql_query($query_update, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo '<ol>';
do {
$idbb=$row['nombre_agenda_ventanilla'];
	echo '<li>';
	echo ' &nbsp;  &nbsp;  &nbsp; <b>'.$row['nombre_agenda_ventanilla'].' </b>';
if (1==$_SESSION['rol']) { 
//	echo ' <a style="color:#f2f2f2;cursor: pointer" title="Borrar" name="agenda_ventanilla" id="'.$idbb.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	echo '</li>';

	 } while ($row = mysql_fetch_assoc($select)); 

echo '</ol>';
} else { echo 'No existen registros'; }	 
mysql_free_result($select);


echo '</div>';


} else { }

?>



