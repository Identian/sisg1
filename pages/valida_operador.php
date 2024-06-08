<?php
if (isset($_POST['cod_operador_cat']) and ""!=$_POST['cod_operador_cat']) {

require_once('../conf.php'); 
// $id_funcionario = $_SESSION['snr'];
$cod_operador_cat =$_POST['cod_operador_cat'];

//echo '<script>alert("'.$parametro.'");</script>';
$actualizar5 = mysql_query("SELECT nombre_operador_catastral AS nom_operador
     FROM operador_catastral 
	 WHERE cod_operador_catastral='$cod_operador_cat' 
	 AND estado_operador_catastral = 1 limit 1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
$ws5 = 0;

if ($total55  > 0) {
	$ws5 = 10;
 }
 echo $ws5;
} 

?>


			 
 


