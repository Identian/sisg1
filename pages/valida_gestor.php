<?php
if (isset($_POST['cod_gestor_cat']) and ""!=$_POST['cod_gestor_cat']) {

require_once('../conf.php'); 
// $id_funcionario = $_SESSION['snr'];
$cod_gestor_cat = trim($_POST['cod_gestor_cat']);

//echo '<script>alert("'.$parametro.'");</script>';
$actualizar5 = mysql_query("SELECT nombre_gestor_catastral AS nom_gestor
     FROM gestor_catastral 
	 WHERE trim(cod_gestor_catastral) = '$cod_gestor_cat' 
	 AND estado_gestor_catastral = 1 limit 1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
$ws5 = 0;

if ($total55  > 0) {
	$ws5 = 10;
 }
 echo $ws5;
} 


?>


			 
 


