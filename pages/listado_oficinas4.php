<link rel="stylesheet" href="plugins/chosenselect/chosen.css">
<script src="plugins/chosenselect/chosen.js" type="text/javascript"></script>
<script type="text/javascript">
 var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Registro no encontrado!'},
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro1=explode('|', $_POST['option']);

$parametro=$parametro1[0];

echo '<select class="form-control chosen-select" style="width: 100%;" name="codigo_oficina" required>';



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

$actualizar5 = mysql_query("SELECT * FROM notaria where  estado_notaria=1 order by nombre_notaria", $conexion) or die(mysql_error());
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

	
	
	
	
	
	
} else { echo '<option value="" selected></option>'; }

echo '</select>';

} else {
	
	 
}
?>