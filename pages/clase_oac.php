<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=$_POST['option'];
$actualizar5 = mysql_query("SELECT * FROM clase_oac WHERE id_categoria_oac='$parametro' and estado_clase_oac=1 order by id_clase_oac", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_clase_oac'].'" ';
   echo '>'.$row15['nombre_clase_oac'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);


} else {}
} else {}
?>