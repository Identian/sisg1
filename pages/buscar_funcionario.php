<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=intval($_POST['option']);
//echo '<script>alert("'.$parametro.'");</script>';
$actualizar5 = mysql_query("SELECT id_funcionario, nombre_funcionario FROM funcionario where cedula_funcionario='$parametro' and estado_funcionario=1 order by nombre_funcionario limit 1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<select name="asignarnuevof"  style="width:200px;">';
 do {
echo '<option value="'.$row15['id_funcionario'].'" selected>';
			 echo ''.$row15['nombre_funcionario'].'</option>'; 
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);

echo '</select><button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button>';
} else {}
} else {}
?>


			 
 


