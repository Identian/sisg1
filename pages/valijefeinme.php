<?php
if (isset($_POST['valjinme']) and ""!=$_POST['valjinme']) {

require_once('../conf.php'); 
// $id_funcionario = $_SESSION['snr'];
$array=explode("-", $_POST['valjinme']);
$id_funcionario_jefe_inme = intval($array[0]);
$id_funcionario = intval($array[1]);

//echo '<script>alert("'.$parametro.'");</script>';

// consulta cargo del funcionario evaluado
$query1 = mysql_query("SELECT ifnull(grado_cargo, 0) grado_cargo, id_cargo,
     id_grupo_area, id_cargo_nomina_encargo
     FROM funcionario 
	 WHERE id_funcionario='$id_funcionario' 
	 AND estado_funcionario = 1 limit 1", $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($query1);
$totalreg1 = mysql_num_rows($query1);
$id_cargo_fun = 0;
$id_cargo_inme = 0;
$id_proposito_edl = 0;

if ($totalreg1 > 0) {
	$grado_cargo_fun = $row1['grado_cargo'] * 1;
	$id_cargo_fun = $row1['id_cargo'] * 1;
	$id_grupo_area = $row1['id_grupo_area'];
	$id_cargo_nomina_fun = $row1['id_cargo_nomina_encargo'];
//	$id_grupo_area = 20;
//	$id_cargo_nomina = 20;
 }

/*
// consulta id_proposito_edl 
$query21 = mysql_query("SELECT id_proposito_edl, nombre_proposito_edl  
     FROM proposito_edl 
	 WHERE id_grupo_area = '$id_grupo_area' 
     AND id_cargo_nomina = '$id_cargo_nomina' 	 
	 AND estado_proposito_edl = 1 limit 1", $conexion) or die(mysql_error());
$row21 = mysql_fetch_assoc($query21);
$totalreg21 = mysql_num_rows($query21);
if ($totalreg21 > 0) {
	$id_proposito_edl = $row21['id_proposito_edl'] * 1;
	$nombre_proposito_edl = $row21['nombre_proposito_edl'];
 }
*/

// consulta cargo del jefe inmediato 
$query1 = mysql_query("SELECT grado_cargo, id_cargo_nomina_encargo 
     FROM funcionario 
	 WHERE id_funcionario='$id_funcionario_jefe_inme' 
	 AND estado_funcionario = 1 limit 1", $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($query1);
$totalreg1 = mysql_num_rows($query1);
$id_cargo_inme = 0;

if ($totalreg1 > 0) {
	$grado_cargo_inme = $row1['grado_cargo'] * 1;
	$id_cargo_nomina_ji = $row1['id_cargo_nomina_encargo'];
 }
 
 $sw5 = 0;
if ($id_cargo_nomina_fun < $id_cargo_nomina_ji) {
	$sw5 = 10;
} 
 
 echo $sw5.'*'.$id_cargo_nomina.'*'.$id_proposito_edl.'*'.$nombre_proposito_edl;
} 


?>


			 
 


