<?php
if (isset($_POST['tipo_ausen']) and ""!=$_POST['tipo_ausen']) {

require_once('../conf.php'); 
// $id_funcionario = $_SESSION['snr'];
$array=explode("-", $_POST['tipo_ausen']);
$id_tipo_permiso = intval($array[0]);
$id_funcionario = $array[1];


//echo '<script>alert("'.$parametro.'");</script>';
$actualizar5 = mysql_query("SELECT ifnull(sum(num_dias),0) AS tot_dias, 
     sum(num_horas) As tot_horas
     FROM detalle_permiso 
	 WHERE id_funcionario='$id_funcionario' 
	 AND id_tipo_permiso = '$id_tipo_permiso' 
	 AND estado_detalle_permiso = 1 limit 500", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
$had = 0;
$difer = 0;
$total_ausen = 'NO hay Permisos...!!! ';
$tot_dias = 0;
$tot_horas = 0;

if (0<$total55) {
	$tot_dias = $row15['tot_dias'];
	$tot_horas = $row15['tot_horas'];
	
	if($tot_horas >= 8) {
		$had = intval($tot_horas / 8);
		$difer = $tot_horas - $had;
		$tot_dias = $tot_dias + $had;
		$tot_horas = $tot_horas - ($had * 8);
	}	
	$total_ausen = 'Total Días: '.number_format($tot_dias).' Total Horas: '.number_format($tot_horas);
	
 }
 echo $total_ausen;
} 


?>


			 
 


