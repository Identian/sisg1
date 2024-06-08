<?php
if (isset($_POST['varios']) and ""!=$_POST['varios']) {

require_once('../conf.php'); 
// $id_funcionario = $_SESSION['snr'];
$array=explode("*", $_POST['varios']);
$id_funcionario = intval($array[0]);
$periodo_desde = $array[1];
$periodo_hasta = $array[2];
$sw5 = 0;

$id_funcionario_jefe_inme = 0;
$exi_periodo_desde = ' ';
$exi_periodo_hasta = ' ';
$nombre_funcionario = ' ';
$permitido = 0;

//echo '<script>alert("'.$parametro.'");</script>';

	$query2 = sprintf("SELECT fechaper_desde
	FROM periodos_edl 
	WHERE periodo_activo_edl = 1 
	AND ('$periodo_desde' between fechaper_desde and fechaper_hasta) 
	AND estado_periodos_edl = 1"); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);
    $totalreg2 = mysql_num_rows($select2);

    if ($totalreg2 > 0) {
       $permitido = 100;
    }

	$query4 = sprintf("SELECT fechaper_hasta
	FROM periodos_edl 
	WHERE periodo_activo_edl = 1 
	AND ('$periodo_hasta' between fechaper_desde and fechaper_hasta) 
	AND estado_periodos_edl = 1"); 
    $select4 = mysql_query($query4, $conexion) or die(mysql_error());
    $row4 = mysql_fetch_assoc($select4);
    $totalreg4 = mysql_num_rows($select4);

    if ($totalreg4 > 0) {
       $permitido = 100;
    }

// consulta cargo del funcionario evaluado
$query5 =  sprintf("SELECT id_funcionario_jefe_inme, 
     nombre_funcionario, 
     periodo_desde, periodo_hasta 
     FROM eval_funcionario_edl e, funcionario f 
	 WHERE e.id_funcionario='$id_funcionario' 
	 AND '$periodo_desde' between periodo_desde and periodo_hasta 
	 AND id_funcionario_jefe_inme = f.id_funcionario 
	 AND estado_funcionario = 1 limit 1");
$select5 = mysql_query($query5, $conexion) or die(mysql_error());	  
$row5 = mysql_fetch_assoc($select5);
$totalreg5 = mysql_num_rows($select5);

if ($totalreg5 > 0) {
	$id_funcionario_jefe_inme = $row5['id_funcionario_jefe_inme'];
	$nombre_funcionario = $row5['nombre_funcionario'];
	$exi_periodo_desde = $row5['periodo_desde'];
	$exi_periodo_hasta = $row5['periodo_hasta'];
	$sw5 = 10;
 }

if ($sw5 < 10) {

// consulta rango superior
$query1 =sprintf("SELECT id_funcionario_jefe_inme, 
     nombre_funcionario, 
     periodo_desde, periodo_hasta 
     FROM eval_funcionario_edl e, funcionario f 
	 WHERE e.id_funcionario='$id_funcionario' 
	 AND '$periodo_hasta' between periodo_desde and periodo_hasta 
	 AND id_funcionario_jefe_inme = f.id_funcionario 
	 AND estado_funcionario = 1 limit 1");
$select1 = mysql_query($query1, $conexion) or die(mysql_error());	  
$row1 = mysql_fetch_assoc($select1);
$totalreg1 = mysql_num_rows($select1);

if ($totalreg1 > 0) {
	$id_funcionario_jefe_inme = $row1['id_funcionario_jefe_inme'];
	$nombre_funcionario = $row1['nombre_funcionario'];
	$exi_periodo_desde = $row1['periodo_desde'];
	$exi_periodo_hasta = $row1['periodo_hasta'];
	$sw5 = 10;
 }
} 
 
 $total = $sw5.'*'.$nombre_funcionario.'*'.$exi_periodo_desde.'*'.$exi_periodo_hasta.'*'.$permitido;
 echo $total;
} 


?>


			 
 


