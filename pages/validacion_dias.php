<?php
//error_reporting(E_ALL & ~E_DEPRECATED);

function permiso($user, $fechaoriginal, $tipo_enc)
{

//PRODUCCION

$hostname_conexion = "192.168.80.11";
$database_conexion = "sisg";
$username_conexion = "sisg";
$password_conexion = "C0l0mb1@19*";

/*
$hostname_conexion = "localhost";
$database_conexion = "sisg";
$username_conexion = "root";
$password_conexion = "SNRAdmin2016*";
*/

//PRUEBAS
/*
$hostname_conexion = "localhost";
$database_conexion = "sisg";
$username_conexion = "root";
$password_conexion = "C0l0mb142019*";

*/


$conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 


$anoactual=date("Y").'-';
$timestamp1=strtotime($fechaoriginal);
$domingo=date('w', $timestamp1);

if ($domingo==0) {
$permi=0; 	
echo '<div style="width:100%;background:#B40404;color:#fff;text-align: center;">No se puede ingresar la fecha11: '.$fechaoriginal.'. Es dia domingo</div>';
} else {


$query_reseot = "SELECT id_dia_licencia FROM dia_licencia, permiso 
where dia_licencia.id_tipo_encargo NOT IN (5, 6) 
and dia_licencia.id_permiso=permiso.id_permiso 
and permiso.id_funcionario='$user' 
and permiso.estado_permiso=1 
and dia_licencia.estado_dia_licencia=1 
and dia_licencia.confirmado=1 
and dia_licencia.fecha_permiso='$fechaoriginal' 
";


//and dia_licencia.hora_desde is null
$reseot = mysql_query($query_reseot, $conexion);
$tott = mysql_num_rows($reseot);

if (0<$tott) {
	
$permi=0; 
echo '<div style="width:100%;background:#B40404;color:#fff;text-align: center;">No se puede ingresar la fecha22: '.$fechaoriginal.'. Ya se encuentra registrada</div>';
} else { 
 

if (1==$tipo_enc) {  // licencia ordinaria  (no puede superar 90 dias al año)
$regabr = mysql_query("SELECT id_dia_licencia 
	FROM permiso, dia_licencia 
	WHERE permiso.id_permiso=dia_licencia.id_permiso 
	and permiso.id_funcionario='$user' 
	and permiso.estado_permiso=1 
	and permiso.modificacion=0 
	and dia_licencia.estado_dia_licencia=1 
	and permiso.aprobacion=1 
	and dia_licencia.confirmado=1 
	and dia_licencia.id_tipo_encargo=1  
	and YEAR(dia_licencia.fecha_permiso) = YEAR('$fechaoriginal')", $conexion) ;
$totalabr = mysql_num_rows($regabr);
if (90>=$totalabr) {
$permi=1; } 
else {
$permi=0; 
echo '<div style="width:100%;background:#B40404;color:#fff;text-align: center;">No se puede ingresar la fecha33: '.$fechaoriginal.'. El tipo de licencia ordinaria no puede superar los 90 dias</div>';
}
}







else if (2==$tipo_enc) {  // permiso    (no pueden ser mas de 3 dias de forma consecutiva)
$masundia = date("Y-m-d", strtotime($fechaoriginal ."+ 1 days"));
$masdosdia = date("Y-m-d", strtotime($fechaoriginal ."+ 2 days"));
$mastresdia = date("Y-m-d", strtotime($fechaoriginal ."+ 3 days"));
$menosundia = date("Y-m-d", strtotime($fechaoriginal ."- 1 days"));
$menosdosdia = date("Y-m-d", strtotime($fechaoriginal ."- 2 days"));
$menostresdia = date("Y-m-d", strtotime($fechaoriginal ."- 3 days"));

//$suma=0;
$array = array();
$arraysuma = array();
$arrayresta = array();

$arraysumades = array();
$arraysumaant = array();



$query_reseo = "SELECT dia_licencia.fecha_permiso FROM dia_licencia, tipo_encargo, permiso where  dia_licencia.id_permiso=permiso.id_permiso and permiso.id_funcionario='$user' and dia_licencia.id_tipo_encargo=tipo_encargo.id_tipo_encargo and permiso.estado_permiso=1 and dia_licencia.estado_dia_licencia=1 and dia_licencia.confirmado=1 and dia_licencia.id_tipo_encargo=2 order by dia_licencia.fecha_permiso";
$reseo = mysql_query($query_reseo, $conexion);
$row_reseo = mysql_fetch_assoc($reseo);
do { 
	array_push($array, $row_reseo['fecha_permiso']);
} while ($row_reseo = mysql_fetch_assoc($reseo));
mysql_free_result($reseo);


if (in_array($fechaoriginal, $array)) {
array_push($arraysuma, 1);
} else {array_push($arraysuma, 0);}
 
if (in_array($masundia, $array)) {
array_push($arraysuma, 1);
array_push($arraysumades, 1);
} else {
array_push($arraysuma, 0);
array_push($arraysumades, 0);
}

if (in_array($masdosdia, $array)) {
array_push($arraysuma, 1);
array_push($arraysumades, 1);
} else {
array_push($arraysuma, 0);
array_push($arraysumades, 0);
}
   
if (in_array($mastresdia, $array)) {
array_push($arraysuma, 1);
array_push($arraysumades, 1);
} else {
array_push($arraysuma, 0);
array_push($arraysumades, 0);
}
   
if (in_array($menosundia, $array)) {
array_push($arraysuma, 1);
array_push($arraysumaant, 1);
} else {
array_push($arraysuma, 0);
array_push($arraysumaant, 0);
}
   
if (in_array($menosdosdia, $array)) {
array_push($arraysuma, 1);
array_push($arraysumaant, 1);
} else {
array_push($arraysuma, 0);
array_push($arraysumaant, 0);
}
   
if (in_array($menostresdia, $array)) {
array_push($arraysuma, 1);
array_push($arraysumaant, 1);
} else {
array_push($arraysuma, 0);
array_push($arraysumaant, 0);
}



$suma=array_sum($arraysuma);
$sumades=array_sum($arraysumades);
$sumaant=array_sum($arraysumaant);

if (5<=$suma or 3<=$sumades or 3<=$sumaant ) { 
$permi=0;
echo '<div style="width:100%;background:#B40404;color:#fff;text-align: center;">No se puede ingresar la fecha44: '.$fechaoriginal.'. Los permisos no pueden registrarce mas de tres dias en forma consecutiva</div>';
} else {
$permi=1;
}
}




else if (3==$tipo_enc) {
$regabr = mysql_query("select id_dia_licencia from permiso, dia_licencia where permiso.id_permiso=dia_licencia.id_permiso and permiso.id_funcionario='$user' and permiso.estado_permiso=1 and permiso.modificacion=0 and dia_licencia.estado_dia_licencia=1 and permiso.aprobacion=1 and dia_licencia.confirmado=1 and dia_licencia.id_tipo_encargo=3 and dia_licencia.fecha_permiso like '%$anoactual%'", $conexion) or die(mysql_error());
$totalabr = mysql_num_rows($regabr);
if (180>=$totalabr) {
$permi=1; } 
else {
$permi=0; 
echo '<div style="width:100%;background:#B40404;color:#fff;text-align: center;">No se puede ingresar la fecha55: '.$fechaoriginal.'. El tipo de licencia por incapacidad no puede superar los 180 dias.</div>';
}
}


else if (4==$tipo_enc) {
$permi=1; 
} 

else if (5==$tipo_enc) {
$permi=1; 
} 

else if (6==$tipo_enc) {
$permi=1; 
} 
	
	
	
	


}
}
return $permi;
}

?>