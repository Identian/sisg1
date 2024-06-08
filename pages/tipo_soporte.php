<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=intval($_POST['option']);
//echo '<script>alert("'.$parametro.'");</script>';
$actualizar5 = mysql_query("SELECT * FROM tipo_subadjunto where id_tipo_adjunto=".$parametro." and estado_tipo_subadjunto=1 order by nombre_tipo_subadjunto", $conexion);
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
	echo '<option value="" selected></option>';
do {
echo '<option value="'.$row15['id_tipo_subadjunto'].'">';
	echo $row15['nombre_tipo_subadjunto'];
	echo '</option>'; 
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);


} else {
	echo '';
	
}
} else {}
?>


			 
 


