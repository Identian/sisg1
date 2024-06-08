<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro1=explode('|', $_POST['option']);


$parametro=$parametro1[0];
$coddep=$parametro1[1];
$codmun=$parametro1[2];




if (1==$parametro) {

$actualizar5 = mysql_query("SELECT * FROM area where id_area!=21 and estado_area=1 order by nombre_area", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_area'].'" ';
   echo '>'.$row15['nombre_area'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);
} else { '<option value="" selected>No existen opciones</option>';}

} elseif (2==$parametro) {
	
$actualizar5 = mysql_query("SELECT * FROM oficina_registro where id_departamento='$coddep' and codigo_municipio='$codmun' and estado_oficina_registro=1 order by nombre_oficina_registro", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_oficina_registro'].'" ';
   echo '>'.$row15['nombre_oficina_registro'].' / Circulo: '.$row15['circulo'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);
} else { '<option value="" selected>No existen opciones</option>';}	
	
} elseif (3==$parametro) {

$actualizar5 = mysql_query("SELECT * FROM notaria where id_departamento='$coddep' and codigo_municipio='$codmun' and  estado_notaria=1 order by nombre_notaria", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_notaria'].'" ';
   echo '>NOTARIA '.$row15['nombre_notaria'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);
} else { '<option value="" selected>No existen opciones</option>';}	



} elseif (4==$parametro) {

$actualizar5 = mysql_query("SELECT * FROM curaduria where id_departamento='$coddep' and id_municipio='$codmun' and  estado_curaduria=1 order by nombre_curaduria", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 echo '<option value="" selected>-- Seleccionar --</option>';
 do {
   echo '<option value="'.$row15['id_curaduria'].'" ';
   echo '>'.$row15['nombre_curaduria'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
  mysql_free_result($actualizar5);
} else { '<option value="" selected>No existen opciones</option>';}	

	
}

else { echo '<option value="" selected></option>'; }



} else {
	
	 
}
?>




<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $(function () {
	  $(".select2").select2({
    placeholder: "Seleccione una oficina",
    allowClear: true
});
  })
</script>
<select class="form-control" style="width:100%;" name="codigo_oficina"  required>';
</SELECT>-->

