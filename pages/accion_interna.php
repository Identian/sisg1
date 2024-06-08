<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
require_once('../conf.php'); 

$parametro=intval($_POST['option']);
$actualizar5 = mysql_query("SELECT * FROM accion_interna WHERE id_procedimiento_interno=".$parametro." and estado_accion_interna=1 order by nombre_accion_interna", $conexion);
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<option value="" selected> - - </option>';
 do {
   echo '<option value="'.$row15['id_accion_interna'].'" ';
   echo '>'.$row15['nombre_accion_interna'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);


} else {}
} else {}
?>