<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 


$parametro=intval($_POST['option']);
/*
if (0==$parametro) {
 echo '<option value="" selected>-- Seleccionar --</option>';
echo '<option value="1">Dependencias y Procesos Nivel Asistencial (Nivel central)</option>';
echo '<option value="2">Dependencias y Procesos Niveles Profesional y Técnico (Nivel central)</option>';
echo '<option value="3">Dirección Regional</option>';
echo '<option value="4">ORIP, Gesti&oacute;n Jur&iacute;dica</option>';
echo '<option value="5">ORIP, Gestión Tecnol&oacute;gica y Administrativa</option>';
echo '<option value="6">ORIP, Gestión Tecnol&oacute;gica y Administrativa Perfil Operativo</option>';
echo '<option value="7">REGISTRADOR PRINCIPAL</option>';
echo '<option value="8">REGISTRADOR SECCIONAL</option>';
echo '<option value="9">SECRETARIO EJECUTIVO </option>';
echo '<option value="10">AUXILIAR ADMINISTRATIVO</option>';
echo '<option value="11">Auxiliar Administrativo (Gestión Documental)</option>';





} else {

*/


$actualizar5 = mysql_query("SELECT * FROM grupo_area where id_area=".$parametro."", $conexion);

$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);

 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_grupo_area'].'" ';
   echo '>'.$row15['nombre_grupo_area'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);

//}


} else {
	
	 
}
?>