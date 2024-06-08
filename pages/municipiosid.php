<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=$_POST['option'];
$actualizar5 = mysql_query("SELECT nombre_municipio, id_municipio, codigo_municipio FROM municipio WHERE id_departamento='$parametro' and estado_municipio=1 order by nombre_municipio", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 //echo '<option value="" selected></option>';
 do {
   echo '<option value="'.$row15['id_municipio'].'" ';
   echo '>'.$row15['nombre_municipio'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);


} else {}
} else {}
?>