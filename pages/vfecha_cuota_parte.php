<?php
if (isset($_POST['fecha_corte']) and ""!=$_POST['fecha_corte']) {

require_once('../conf.php'); 
$fecha_corte = $_POST['fecha_corte'];
$id_corte_cuota_parte = 1;
$tot_dias = 0;
$tot_dias_corte = 0;
$tot_dias_ant = 0;


$actualizar4 = mysql_query("SELECT to_days('".$fecha_corte."') tot_dias_corte ", $conexion) or die(mysql_error());
$row4 = mysql_fetch_assoc($actualizar4);
$total4 = mysql_num_rows($actualizar4);
$tot_dias_corte = $row4['tot_dias_corte'];

$actualizar5 = mysql_query("SELECT to_days(fecha_corte_ant_cp) tot_dias_ant
     FROM corte_cuota_parte 
	 WHERE id_corte_cuota_parte ='$id_corte_cuota_parte' 
	 AND estado_corte_cuota_parte = 1 limit 1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);

if ($total55 > 0) {
	$tot_dias_ant = $row15['tot_dias_ant'];
 } else {
	$tot_dias_ant = 0; 
 }
 $tot_dias = abs($tot_dias_corte - $tot_dias_ant);
 
 echo $tot_dias;
} 


?>


			 
 


