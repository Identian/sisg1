<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
require_once('../conf.php'); 

$idchat=intval($_POST['option']);
$idchata=$idchat;
/*
$hostname_conexion2="192.168.80.12";
$database_conexioncc = "mibew";
$username_conexioncc = "chat";
$password_conexioncc = "SNRadmin2020";
*/


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













?>

<body>
<div style="margin:5px 20px 20px 10px;padding:5px 20px 20px 10px;font-size:10px;">
<table style="width:100%;">
<?php 
//echo conversacion_chat($idchat); 

$queryw = "select thread.username, thread.agentname, thread.threadid, message.tmessage, message.ikind, message.dtmcreated 
from thread, message where thread.threadid=message.threadid and thread.threadid=".$idchat."";
$resultw = $mysqlic->query($queryw);

$mensajec='';

while ($objw = $resultw->fetch_array()) {
	$alwe = date('Y-m-d H:i:s', $objw['dtmcreated']);
	
	
	$men=utf8_encode($objw['tmessage']);
	$bus='Correo Electrónico:';
 
if (strrpos($men, $bus) === false) {		
	} else {
		$men2=explode(' ', $men);		
		$mensajec.='||'.$men2[2].'||';
	}	

if (1==$objw['ikind']) {	
$quien='Visitante:';
	} else if (2==$objw['ikind']) {
$quien='Funcionario:';
	} else {
$quien='Sistema:';	
	}
	
	
	
printf ('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', utf8_encode($objw['username']), $objw['agentname'], $alwe, $quien, utf8_encode($objw['tmessage']));

$mensajec.=utf8_encode($objw['tmessage']).'__';

}

$info=explode('||', $mensajec);
$corr=$info[1];

$infor=explode('__', $mensajec);
$mensa1=array_reverse($infor);
$mensa=$mensa1[1];

$corres='correo&'.$corr.'&'.$mensa.'.jsp';

//printf ('<div class="row"><div class="col-md-12"><a href="mailto:%s?subject=Respuesta_Chat&body=La SNR informa " target="_blank">Enviar correo</a> a %s</div></div>', $corr, $corr);
 
 
 
 

 
 
$resultw->free();


?> 
</table>
<?php
 function formulario($forma,$idchat2) {
	echo '<hr><form name="ewerwerwre" action="" method="post">
	Para: <input type="text" name="correoa"  style="width:100%;" value="'.$forma.'">
	<input type="text" name="idchat" value="'.$idchat2.'" readonly>
	<br><textarea name="respuestachat" placeholder="Mensaje" style="width:100%;"></textarea>
	<br><input type="submit" value="Enviar">
	</form>';
}
echo formulario($corr,$idchata);
 
 
?>
</div>
<body>
<?php } else { }?>