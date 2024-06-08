<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=intval($_POST['option']);
//echo '<script>alert("'.$parametro.'");</script>';
$actualizar5 = mysql_query("SELECT id_ciudadano, nombre_ciudadano, identificacion FROM ciudadano where identificacion='$parametro' and estado_ciudadano=1 order by nombre_ciudadano", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<select name="asignarnuevociudadano"  style="width:300px;" required>';
 do {
echo '<option value="'.$row15['identificacion'].'" selected>';
			 echo ''.utf8_decode($row15['nombre_ciudadano']).' - '.$row15['identificacion'].'</option>'; 
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);

echo '</select><button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-user"></span> Asociar</button>';
} else {
	
	echo 'No existe, <a href="ciudadanos.jsp" target="_blanck">se debe crear el Ciudadano.</a>';
	
}
} else {}
?>


			 
 


