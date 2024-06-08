<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=intval($_POST['option']);
//echo '<script>alert("'.$parametro.'");</script>';
$actualizar5 = mysql_query("SELECT id_ciudadano, nombre_ciudadano, identificacion FROM ciudadano where identificacion='$parametro' and estado_ciudadano=1 order by nombre_ciudadano", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
do {
echo '<option value="'.$row15['id_ciudadano'].'">';
	echo ''.utf8_decode($row15['nombre_ciudadano']).' - '.$row15['identificacion'];
	echo '</option>'; 
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);


} else {
	echo '<option value="">No existe la identificación, se debe crear el ciudadano.</option>';
	echo '<option value="21373">Registar como ciudadano anónimo.</option>';
	
	
}
} else {}
?>


			 
 


