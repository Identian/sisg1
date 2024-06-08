<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=$_POST['option'];
$actualizar5 = mysql_query("SELECT nombre_modalidad_licencia, id_modalidad_licencia FROM modalidad_licencia WHERE id_clase_licencia='$parametro' order by nombre_modalidad_licencia", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {

 do {
   echo '<option value="'.$row15['id_modalidad_licencia'].'" ';
   echo '>'.$row15['nombre_modalidad_licencia'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);


} else {
	echo '<option value="17"> - NO APLICA - </option>';
}
} else {}
?>


