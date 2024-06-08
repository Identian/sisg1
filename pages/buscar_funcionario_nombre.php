<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
require_once('../conf.php'); 
$parametro=$_POST['option'];
$actualizar5 = mysql_query("SELECT id_funcionario, nombre_funcionario FROM funcionario where nombre_funcionario like '%$parametro%' and estado_funcionario=1 and id_tipo_oficina<3 order by nombre_funcionario", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<select name="id_funcionario_solicita"  class="form-control" required>';
 do {
echo '<option value="'.$row15['id_funcionario'].'" selected>';
			 echo ''.strtoupper($row15['nombre_funcionario']).'</option>'; 
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);

echo '</select>';

} else {
	
	//echo '<input type="text" name="quien_solicita" value="" class="form-control" placeholder="Como no existe, escribir el nombre completo" required>';
	
}
} else {}
?>


			 
 


