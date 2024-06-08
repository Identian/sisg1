<?php
session_start();

if (isset($_GET['q']))
{
	
ini_set('max_execution_time', 10000000);    

header('Content-Type: text/html; charset=utf-8');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte.xls");

$q=$_GET['q'];


$n=$_POST['fecha_inicio'];
$f=$_POST['fecha_fin'];

$date_inputi = getDate(strtotime($n)); 
$fi=$date_inputi[0];  

$date_inputf = getDate(strtotime($f)); 
$ff=$date_inputf[0];  



$hostname_conexion2="192.168.80.13";
$database_conexioncc = "prdchat";
$username_conexioncc = "chatsnr";
$password_conexioncc = "CHATadmin2021";



global $mysqlic;
$mysqlic = new mysqli($hostname_conexion2, $username_conexioncc, $password_conexioncc, $database_conexioncc);
if (mysqli_connect_errno()) {
    printf("error", $mysqlic->connect_error);
    exit();
}




function conversacion_chat($idcon,$idcon2) {	
global $mysqlic;
$queryw = "select thread.username, thread.agentname, thread.threadid, message.tmessage, message.ikind, message.dtmcreated 
from thread, message 
where thread.threadid=message.threadid and message.dtmcreated>=".$idcon." and message.dtmcreated<=".$idcon2." order by message.threadid, message.messageid limit 50000";
$resultw = $mysqlic->query($queryw);


echo '<table>';
echo '<tr><td>ID</td><td>VISITANTE</td><td>FUENTE DE TEXTO</td><td>FUNCIONARIO</td><td>FECHA</td><td>MENSAJE</td></tr>';

while ($objw = $resultw->fetch_array()) {
	$alwe = date('Y-m-d H:i:s', $objw['dtmcreated']);
	

if (1==$objw['ikind']) {	
$quien='Visitante';
	} else if (2==$objw['ikind']) {
$quien='Funcionario';
	} else {
$quien='Sistema';	
	}
	
	
	
echo '<tr><td>'.$objw['threadid'].'</td><td>'.$objw['username'].'</td><td>'.$quien.'</td><td>'.$objw['agentname'].'</td><td>'.$alwe.'</td><td>'.$objw['tmessage'].'</td></tr>';


}

echo '</table>';


 
$resultw->free();

}

echo conversacion_chat($fi,$ff);

 } else { }
 
 
 
 ?>

