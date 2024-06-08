<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro1=explode('|', $_POST['option']);

//$parametro=$parametro1[0];

$parametro=intval($_POST['option']);

if (1==$parametro) {

$actualizar5 = mysql_query("SELECT * FROM area where id_area!=21 and estado_area=1 order by nombre_area", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);

 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_area'].'" ';
   echo '>'.$row15['nombre_area'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);


} elseif (2==$parametro) {
	
$actualizar5 = mysql_query("SELECT * FROM oficina_registro where estado_oficina_registro=1 order by nombre_oficina_registro", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);

 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_oficina_registro'].'" ';
   echo '>'.$row15['nombre_oficina_registro'].' / Circulo: '.$row15['circulo'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);

	
} elseif (3==$parametro) {

$actualizar5 = mysql_query("SELECT id_notaria, nombre_notaria FROM notaria where  estado_notaria=1 order by nombre_notaria", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);

 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_notaria'].'" ';
   echo '>NOTARIA '.$row15['nombre_notaria'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);




} elseif (4==$parametro) {

$actualizar5 = mysql_query("SELECT id_curaduria, nombre_curaduria FROM curaduria where estado_curaduria=1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);

 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_curaduria'].'" ';
   echo '>'.$row15['nombre_curaduria'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);

	





} elseif (5==$parametro) {

$actualizar5 = mysql_query("SELECT id_sindicato, nombre_sindicato FROM sindicato WHERE estado_sindicato=1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);

 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_sindicato'].'" ';
   echo '>'.$row15['nombre_sindicato'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);

	
	
	
	
	
	
} else { echo ''; }



} else {
	
	 
}
?>