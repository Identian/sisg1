<?php
require_once('listas2.php');

// $hostname_conexion2 = "192.168.80.11";
// $database_conexion2 = "sisg";
// $username_conexion2 = "sisg";
// $password_conexion2 = "C0l0mb1@19*";
$hostname_conexion2 = "192.168.80.175";
$database_conexion2 = "sisg";
$username_conexion2 = "root";
$password_conexion2 = "M01ses8o8o";

global $mysqli;
$mysqli = new mysqli($hostname_conexion2, $username_conexion2, $password_conexion2, $database_conexion2);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}


function dep_mun() {
	global $mysqli;
	$querym = "SELECT * FROM departamento, municipio where departamento.id_departamento=municipio.id_departamento and estado_municipio=1 ";
$resultadom = $mysqli->query($querym);
	 while ($obj = $resultadom->fetch_object()) {
        printf ("<option value='%s-%s'>%s, %s</option>\n",  $obj->id_departamento,  $obj->codigo_municipio, $obj->nombre_departamento, $obj->nombre_municipio);
    }
	$resultadom->free();
}



function aleatorio($ale){
$ale2=rand(1, $ale);
return $ale2;
}


$anom=date("Y");
$mesm=date("m");
$diam=date("d");





function fechahabil($f1a,$dias) {
global $mysqli;
$query = "SELECT * FROM festivo where estado_festivo=1";
$result = $mysqli->query($query);
$holiday=array();
while ($obj = $result->fetch_array()) {
array_push($holiday, $obj['nombre_festivo']);
    }
$result->free();
//print_r($holiday);

if ((6==date('N', strtotime($f1a))) or (7==date('N', strtotime($f1a))) or (in_array($f1a,$holiday))) {
$limite=$dias;
} else {
$limite=$dias+1;
}

$fechaInicio=strtotime($f1a);
$mas100 = date('Y-m-d', strtotime('+150 day', strtotime($f1a)));
$fechaFin=strtotime($mas100);
$grupo=array();
for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
$nuevafecha= date("Y-m-d", $i);	

if (6==date('N', strtotime($nuevafecha))) {
} else {
	if (7==date('N', strtotime($nuevafecha))) {
} else { 
if (in_array($nuevafecha,$holiday)) {
} else {
	array_push($grupo, $nuevafecha);
}
}
}
$total= count($grupo);
if ($limite==$total) {
	$resultado=end($grupo);
	break; 
}
}
return $resultado;
 }
 


 
 
 
 function calculatiempo($fecha1,$fecha2)
{
    $na = new DateTime($fecha1);
    $ah = new DateTime($fecha2);
    $diferenciar = $ah->diff($na);
    return $diferenciar->format("%y");
}




 
 
  
 function calculadias($fecha11,$fecha22)
{
    $na1 = new DateTime($fecha11);
    $ah2 = new DateTime($fecha22);
    $diferenciard = $ah2->diff($na1);
    return $diferenciard->format("%a");
}
 


function calculaedad($fecha_nacimiento)
{
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}
 
 
 
 function calculameses($fecha_nacimiento)
{
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%m");
}


 
 
 
 function cuentamodradicaciones($radi) {
global $mysqli;
$query4 = sprintf("SELECT count(id_traza_radicacion) as contadoree FROM traza_radicacion where id_radicacion_curaduria=".$radi." and estado_traza_radicacion=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$res=$row4['contadoree'];
return $res;
$result4->free();
}




 
 
function quenombreporcedula($cedula) {
global $mysqli;
$query4hj = sprintf("SELECT nombre_funcionario FROM funcionario where cedula_funcionario=".$cedula." and estado_funcionario=1"); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();
if (0<count($row4hj)){
$reshhj=$row4hj['nombre_funcionario'];
} else {
$reshhj='No existe';
}
return $reshhj;
$result4hj->free();
}


 
 
 


function pqrsvencidas($tipo_oficinaa, $codigoa) {
global $mysqli;
$realdatea=date("Y-m-d");

$query48 = sprintf("SELECT solicitud_pqrs.id_solicitud_pqrs, fecha_radicado, terminos_dias, terminos_ampliados FROM solicitud_pqrs, asignacion_pqrs, clasificacion_pqrs, clase_oac where (solicitud_pqrs.id_estado_solicitud=2 or solicitud_pqrs.id_estado_solicitud=4) and solicitud_pqrs.id_solicitud_pqrs=clasificacion_pqrs.id_solicitud_pqrs and solicitud_pqrs.id_solicitud_pqrs=asignacion_pqrs.id_solicitud_pqrs and clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and asignacion_pqrs.id_solicitud_pqrs=clasificacion_pqrs.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=".$tipo_oficinaa." and asignacion_pqrs.codigo_oficina=".$codigoa."  and estado_asignacion_pqrs=1 and estado_solicitud_pqrs=1 and estado_clasificacion_pqrs=1 and estado_clase_oac=1 "); 
$result48 = $mysqli->query($query48);
$array0 = array();

while ($obj5 = $result48->fetch_array()) {

//$fechavence= fechahabil($obj5['fecha_radicado'],$obj5['terminos_dias']);
$fechavence= fechahabil($obj5['fecha_radicado'],$obj5['terminos_ampliados']);

if ($realdatea<=$fechavence) {
} else {
	array_push($array0, 1);
}

}
$vencidas=array_sum($array0);
unset($array0);
return $vencidas;
$result48->free();
}




function correofuncionario($correofun) {
global $mysqli;
$query4hj = sprintf("SELECT correo_funcionario FROM funcionario where id_funcionario=".$correofun." and estado_funcionario=1"); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();
$reshhj=$row4hj['correo_funcionario'];
return $reshhj;
$result4hj->free();
}



function numero_municipio($dep,$muni) {
global $mysqli;
$query4hj = sprintf("SELECT id_municipio FROM municipio where id_departamento=".$dep." and codigo_municipio=".$muni." and estado_municipio=1"); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();
$reshhj=$row4hj['id_municipio'];
return $reshhj;
$result4hj->free();
}








function cualid($cc) {
global $mysqli;
$query4hj = sprintf("SELECT id_funcionario FROM funcionario where cedula_funcionario=".$cc." and estado_funcionario=1 limit 1"); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();

if (0<count($row4hj)){
$nameffe=$row4hj['id_funcionario'];
} else { $nameffe=0;}

return $nameffe;
$result4hj->free();
}



function cualcargo($ccc) {
global $mysqli;
$query4hjw = sprintf("SELECT nombre_cargo, nombre_grupo_area FROM funcionario, grupo_area, cargo where funcionario.id_grupo_area=grupo_area.id_grupo_area 
and funcionario.id_cargo=cargo.id_cargo and id_funcionario=".$ccc." and estado_funcionario=1 limit 1"); 
$result4hjw = $mysqli->query($query4hjw);
$row4hjw = $result4hjw->fetch_array();
$reshhjw=$row4hjw['nombre_cargo'].' / '.$row4hjw['nombre_grupo_area'];
return $reshhjw;
$result4hjw->free();
}




function quienrespondio($funres) {
global $mysqli;
$query4h = sprintf("SELECT nombre_funcionario FROM funcionario, respuesta_pqrs where funcionario.id_funcionario=respuesta_pqrs.id_funcionario and respuesta_pqrs.id_solicitud_pqrs=".$funres." and estado_respuesta_pqrs=1"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['nombre_funcionario'];
return $reshh;
$result4h->free();
}



function tipooficinafun($funci) {
global $mysqli;
$query4h = sprintf("SELECT id_tipo_oficina FROM funcionario where id_funcionario=".$funci." and estado_funcionario=1"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=intval($row4h['id_tipo_oficina']);
return $reshh;
$result4h->free();
}



function cargo($funcic) {
global $mysqli;
$query4hc = sprintf("SELECT * FROM cargo_nomina where id_cargo_nomina=".$funcic." and estado_cargo_nomina=1"); 
$result4hc = $mysqli->query($query4hc);
$row = $result4hc->fetch_array(MYSQLI_ASSOC);
$reshhc=''.$row['nivel_cargo_nomina'].', '.$row['nombre_cargo_nomina'].', '.$row['cod_cargo_nomina'].', grado '.$row['grado_cargo_nomina'].'';
//$reshhc='snr';
return $reshhc;
$result4hc->free();
}





function sigladoc($funrestt) {
$funrestt2=intval($funrestt);
global $mysqli;
$query4ht = sprintf("SELECT sigla FROM tipo_documento where id_tipo_documento=".$funrestt2.""); 
$result4ht = $mysqli->query($query4ht);
$row4ht = $result4ht->fetch_array(MYSQLI_ASSOC);
$reshht=$row4ht['sigla'];
return $reshht;
$result4ht->free();
}


function dias_terminos($clases,$fecharad) {
global $mysqli;
$hoy=date('Y-m-d');
$query4hf = sprintf("SELECT terminos_dias, terminos_ampliados FROM clase_oac where id_clase_oac=".$clases." and estado_clase_oac=1 limit 1"); 
$result4hf = $mysqli->query($query4hf);
$row4hf = $result4hf->fetch_array(MYSQLI_ASSOC);


$fecha_rad = strtotime($fecharad);
$fecha_entrada = strtotime('2022-05-18');
	
if($fecha_rad >= $fecha_entrada) {
$reshhf=$row4hf['terminos_dias'];
} else {
$reshhf=$row4hf['terminos_ampliados'];
}
return $reshhf;
$result4hf->free();
}



function cualpqrs($infoid) {
global $mysqli;
$query4hf = sprintf("SELECT radicado FROM solicitud_pqrs where id_solicitud_pqrs=".$infoid." and estado_solicitud_pqrs=1"); 
$result4hf = $mysqli->query($query4hf);
$row4hf = $result4hf->fetch_array(MYSQLI_ASSOC);
$reshhf=$row4hf['radicado'];
return $reshhf;
$result4hf->free();
}




function estadopqrs($tipo_ofi, $codigoo, $estadop) {
global $mysqli;
$query4 = sprintf("SELECT count(id_asignacion_pqrs) as contadora FROM asignacion_pqrs, solicitud_pqrs where asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and solicitud_pqrs.id_estado_solicitud=".$estadop." and id_tipo_oficina=".$tipo_ofi." and codigo_oficina=".$codigoo." and estado_asignacion_pqrs=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contadora'];
return $res;
$result4->free();
}





function existencialimitada($tablei, $campoi, $idi) {
global $mysqli;
$query4 = sprintf("SELECT count(id_".$tablei.") as contador FROM ".$tablei." where ".$campoi."!=".$idi." and estado_".$tablei."=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contador'];
return $res;
$result4->free();
}




function existenciaunica($tablei, $campoi, $idi) {
global $mysqli;
$query4 = sprintf("SELECT count(id_".$tablei.") as contador FROM ".$tablei." where ".$campoi."=".$idi." and estado_".$tablei."=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contador'];
return $res;
$result4->free();
}


function existenciamotivo($tablei, $campoi, $idi) {
global $mysqli;
$query4 = sprintf("SELECT count(id_".$tablei.") as contador FROM ".$tablei." where ".$campoi."=".$idi." and estado_".$tablei."=1 and id_motivo_oac!=0"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contador'];
return $res;
$result4->free();
}


			
function privreg($orip, $user, $modulo, $accion) {
global $mysqli;
$queryn = "select count(id_privilegio_registro) as tot from privilegio_registro where id_oficina_registro=".$orip." and 
id_modulo_registro=".$modulo." and id_perfil_registro=".$accion." and id_funcionario=".$user." and estado_privilegio_registro=1";
$result4mn = $mysqli->query($queryn);
$row4mn = $result4mn->fetch_array(MYSQLI_ASSOC);
$resmn=$row4mn['tot'];
return $resmn;
$result4mn->free();
}




function calificacion($tableim) {
global $mysqli;
$query4m = sprintf("SELECT nombre_calificacion FROM calificacion where id_calificacion=".$tableim." limit 1"); 
$result4m = $mysqli->query($query4m);
$row4m = $result4m->fetch_array(MYSQLI_ASSOC);
$resm=$row4m['nombre_calificacion'];
return $resm;
$result4m->free();
}




function existencia($tablei) {
global $mysqli;
$query4 = sprintf("SELECT count(id_".$tablei.") as contador FROM ".$tablei." where estado_".$tablei."=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contador'];
return $res;
$result4->free();
}





function jefearea($area) {
global $mysqli;
$query4 = sprintf("SELECT id_funcionario FROM funcionario, grupo_area WHERE funcionario.id_grupo_area=grupo_area.id_grupo_area and id_cargo=1 and id_area=".$area." limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['id_funcionario'];
return $res;
$result4->free();
}


function jeferegion($region) {
global $mysqli;
$query4 = sprintf("SELECT id_funcionario FROM funcionario, region WHERE id_cargo=1 and id_region=".$region." and id_tipo_oficina=1 and funcionario.id_grupo_area=region.id_grupo_area limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['id_funcionario'];
return $res;
$result4->free();
}



function region($idorip){
global $mysqli;
$query = "SELECT oficina_registro.id_region FROM region, oficina_registro where region.id_region=oficina_registro.id_region and id_oficina_registro=".$idorip." limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
$resulnombre=$row['id_region'];
return $resulnombre;
$result->free();
}




function cuenta_pqrs($tableio) {
global $mysqli;
$query4 = sprintf("SELECT count(DISTINCT id_solicitud_pqrs) as total FROM ".$tableio." WHERE estado_".$tableio."=1 "); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['total'];
return $res;
$result4->free();
}


function quees($table, $valor){
global $mysqli;
$query = "SELECT nombre_".$table." FROM ".$table." where id_".$table."=".$valor." and estado_".$table."=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$info='nombre_'.$table;
if (0<count($row)){
$nameff=$row[$info];
} else { $nameff='No esta parametrizado';}
$result->free();
return $nameff;
}



function regional($regional){
global $mysqli;
$query = "SELECT nombre_region FROM region, oficina_registro where region.id_region=oficina_registro.id_region and id_oficina_registro=".$regional." limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$resulnombre=$row['nombre_region'];
} else { $resulnombre='';
}
return $resulnombre;
$result->free();
}



function nombretabla($table, $valor){
global $mysqli;
$query = "SELECT nombre_".$table." FROM ".$table." where id_".$table."=".$valor." and estado_".$table."=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$info='nombre_'.$table;
if (0<count($row)){
$resulnombre=$row[$info];
} else { $resulnombre='Sin dato';
}
return $resulnombre;
$result->free();
}


function tipodociris($valoriris){
global $mysqli;
$query = "SELECT nombre_tipo_documento_iris FROM tipo_documento_iris where idtipodocumento=".$valoriris." and estado_tipo_documento_iris=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
if (0<count($row)){
printf ("%s", $row['nombre_tipo_documento_iris']);
} else { echo 'No esta parametrizado';}
$result->free();
}





function quegrupoes($valorfun){
global $mysqli;
$query = "SELECT nombre_grupo_area from grupo_area, funcionario where grupo_area.id_grupo_area=funcionario.id_grupo_area and id_funcionario=".$valorfun." limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
if (0<count($row)){
printf ("%s", $row['nombre_grupo_area']);
} else { echo '';}
$result->free();
}




function areanc($grupo) {
global $mysqli;
$query4hcf = sprintf("SELECT nombre_area FROM area, grupo_area where area.id_area=grupo_area.id_area 
and id_grupo_area=".$grupo." and estado_area=1"); 
$result4hcf = $mysqli->query($query4hcf);
$rowf = $result4hcf->fetch_array(MYSQLI_ASSOC);
$reshhcf=$rowf['nombre_area'];
return $reshhcf;
$result4hcf->free();
}



function queoripes($valorfuno){
global $mysqli;
$query = "SELECT nombre_oficina_registro from oficina_registro, funcionario where oficina_registro.id_oficina_registro=funcionario.id_oficina_registro and id_funcionario=".$valorfuno." limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
if (0<count($row)){
printf ("ORIP %s", $row['nombre_oficina_registro']);
} else { echo '';}
$result->free();
}



function quetipodeoficina($valorofi){
global $mysqli;
$queryoo = "SELECT id_tipo_oficina from funcionario where id_funcionario=".$valorofi." limit 1";
$resultoo = $mysqli->query($queryoo);
$rowoo = $resultoo->fetch_array(MYSQLI_ASSOC);
if (1==$rowoo['id_tipo_oficina']){
echo quegrupoes($valorofi);
} else if (2==$rowoo['id_tipo_oficina']){
echo queoripes($valorofi);
} else { echo '';}

$resultoo->free();
}




function cedula($valoru){
global $mysqli;
$query = "SELECT cedula_funcionario FROM funcionario where id_funcionario=".$valoru." and estado_funcionario=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
if (0<count($row)){
printf ("%s", $row['cedula_funcionario']);
} else { echo 'No esta parametrizado';}
$result->free();
}




function curaduria($valor){
global $mysqli;
$query = "SELECT nombre_curaduria, nombre_departamento, nombre_municipio FROM curaduria, departamento, municipio where
departamento.id_departamento=municipio.id_departamento and curaduria.id_departamento=departamento.id_departamento and
curaduria.id_municipio=municipio.codigo_municipio and
curaduria.id_curaduria=".$valor." and curaduria.estado_curaduria=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
if (0<count($row)){
echo $row['nombre_departamento'].' - ';
echo $row['nombre_municipio'].' - ';
echo $row['nombre_curaduria'];
} else { echo 'No esta parametrizado';}
$result->free();
}





function curaduriacurador($fun){
global $mysqli;
$realdate=date('Y-m-d');
$query = "SELECT curaduria.id_curaduria, nombre_curaduria from curaduria, situacion_curaduria where situacion_curaduria.id_funcionario=".$fun." and curaduria.id_curaduria=situacion_curaduria.id_curaduria AND (situacion_curaduria.fecha_terminacion IS NULL OR situacion_curaduria.fecha_terminacion>='$realdate') limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$name='<a href="curaduria&'.$row['id_curaduria'].'.jsp" target="_blank">'.$row['nombre_curaduria'].'</a>';
} else { 
$name='Exusuario';
}
return $name;
$result->free();
}




function curaduriaequipo($fun){
global $mysqli;
$query = "SELECT curaduria.id_curaduria, nombre_curaduria from curaduria, relacion_curaduria where relacion_curaduria.id_funcionario=".$fun." and curaduria.id_curaduria=relacion_curaduria.id_curaduria and estado_relacion_curaduria=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$name= '<a href="curaduria&'.$row['id_curaduria'].'.jsp" target="_blank">'.$row['nombre_curaduria'].'</a>';
} else { 
$name='Exusuario';
}
return $name;
$result->free();
}





function permisopruebacuraduria($valor){
/* $arraydd=array(27, 4, 44, 86, 81, 100);
 if(in_array($valor, $arraydd)) {
	 $valorfin=1;
 } else {
	 $valorfin=0;
 }
 */
 $valorfin=1;
 return $valorfin;
}



function listapercuraduria($per,$cura){
global $mysqli;
$query = "SELECT id_relacion_curaduria from relacion_curaduria where id_funcionario=".$per." 
and id_curaduria=".$cura." and estado_relacion_curaduria=1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$ig=1;
} else { 


$query22 = "SELECT id_situacion_curaduria from situacion_curaduria where id_funcionario=".$per." 
and id_curaduria=".$cura." and fecha_terminacion>='$realdate' and estado_situacion_curaduria=1";
$result22 = $mysqli->query($query22);
$row22 = $result22->fetch_array();
if (0<count($row22)){
$ig=1;
} else { 
$ig=0;
}
$result22->free();
 }
$result->free();
return $ig;
}




function tiposlicencia($valorl) {
global $mysqli;
$queryk = "select nombre_clase_licencia from clase_licencia, tipo_autorizacion_licencia where 
clase_licencia.id_clase_licencia=tipo_autorizacion_licencia.id_clase_licencia and tipo_autorizacion_licencia.id_licencia_curaduria=".$valorl."  
and estado_clase_licencia=1 and estado_tipo_autorizacion_licencia=1 and situacion_tipo_autorizacion_licencia=1";
$result48k = $mysqli->query($queryk);
while ($obj5k = $result48k->fetch_array()) {

echo $obj5k['nombre_clase_licencia'].' - ';


}
$result48k->free();
}





function mese($argk)
{
if ('01'==$argk) { 
$ar23r = 'enero';
} else if ('02'==$argk) {
$ar23r = 'febrero';
} else if ('03'==$argk) {
$ar23r = 'marzo';
} else if ('04'==$argk) {
$ar23r = 'abril';
} else if ('05'==$argk) {
$ar23r = 'mayo';
} else if ('06'==$argk) {
$ar23r = 'junio';
} else if ('07'==$argk) {
$ar23r = 'julio';
} else if ('08'==$argk) {
$ar23r = 'agosto';
} else if ('09'==$argk) {
$ar23r = 'septiembre';
} else if ('10'==$argk) {
$ar23r = 'octubre';
} else if ('11'==$argk) {
$ar23r = 'noviembre';
} else if ('12'==$argk) {
$ar23r = 'diciembre';
} else {
$ar23r = '';
}
return $ar23r;
}





function borrarregistro($table1, $idbo) {
global $mysqli;
$idbor=intval($idbo);
$query88 = "UPDATE ".$table1." SET estado_".$table1."=0 WHERE id_".$table1."=".$idbor." limit 1";  
$result44 = $mysqli->query($query88);
return;
}




function nombre_municipio($mun, $dep){
global $mysqli;
$query = "SELECT nombre_municipio FROM municipio where codigo_municipio=".$mun." and id_departamento=".$dep." and estado_municipio=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
if (0<count($row)){
printf ("%s", $row['nombre_municipio']);
} else { echo 'No esta parametrizado';}
$result->free();
}



function correooficina($tipofi,$ofi) {
global $mysqli;
if (2==$tipofi){
$query = "SELECT correo_oficina_registro as correooficina FROM notaria where id_oficina_registro=".$ofi."  limit 1";
} else if (3==$tipofi) {
$query = "SELECT email_notaria as correooficina FROM notaria where id_notaria=".$ofi."  limit 1";
} else {
$query = "SELECT correo_funcionario as correooficina FROM funcionario where id_funcionario=1226  limit 1";	
}

$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
if (0<count($row)){
$correoofi= $row['correooficina'];
} else { $correoofi='giovanni.ortegon@supernotariado.gov.co'; }
$result->free();
return $correoofi;
}







function listadocumento() {
global $mysqli;
$query = "SELECT id_tipo_documento, nombre_tipo_documento  FROM tipo_documento where persona_natural=1 and  estado_tipo_documento=1 ";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
printf ("<option value='%s'>%s</option>\n", $obj['id_tipo_documento'], $obj['nombre_tipo_documento']);
    }
$result->free();
}



 
 
 


function listanotarias() {
global $mysqli;
$query = "SELECT id_notaria, nombre_notaria, codigo_notaria, nombre_departamento FROM notaria, departamento where notaria.id_departamento=departamento.id_departamento and estado_notaria=1 order by nombre_departamento asc, codigo_notaria ASC";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
        printf ("<option value='%s'>%s - %s</option>\n", $obj['id_notaria'], $obj['nombre_departamento'], $obj['nombre_notaria']);
    }
$result->free();
}



function lista($table, $limite) {
		
if (isset($limite) && ""!=$limite){
$limite1=" limit ".$limite." ";
} else {
$limite1=" ";
}

global $mysqli;
$query = "SELECT id_".$table.", nombre_".$table."  FROM ".$table." where  estado_".$table."=1 order by nombre_".$table." ASC  ".$limite1." ";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
	$infoid='id_'.$table;
	$infonombre='nombre_'.$table;
	
        printf ("<option value='%s'>%s</option>\n", $obj[$infoid], $obj[$infonombre]);
    }

$result->free();

}









function opciones($table,$condicion) {
global $mysqli;
$query = "SELECT id_".$table.", nombre_".$table."  FROM ".$table." where  estado_".$table."=1 ".$condicion." order by id_".$table."  ";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
	$infoid='id_'.$table;
	$infonombre='nombre_'.$table;
        printf ("<option value='%s'>%s</option>\n", $obj[$infoid], $obj[$infonombre]);
    }
$result->free();
}




function tablatabla($tables) {
global $mysqli;
$query = "SELECT id_".$tables.", nombre_".$tables."  FROM ".$tables." where  estado_".$tables."=1";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
	$infoid='id_'.$tables;
	$infonombre='nombre_'.$tables;
        printf ("<tr><td>%s</td><td>%s</td></tr>", $obj[$infoid], $obj[$infonombre]);
    }
$result->free();
}




function listaparamentro($tabla, $nombrecampo, $valorcampo, $parametro)
{
   global $mysqli;
   $query = "SELECT id_" . $tabla . ", nombre_" . $tabla . ", $valorcampo FROM " . $tabla . " WHERE " . $nombrecampo . "='" . $parametro . "' AND estado_" . $tabla . "=1 ";
   $result = $mysqli->query($query);
   while ($obj = $result->fetch_array()) {
      printf("<option value='%s'>%s</option>\n", $obj['id_' . $tabla . ''], $obj['nombre_' . $tabla . '']);
   }
   $result->free();
}


function cantpqrs($idi) {
global $mysqli;
$query4 = sprintf("SELECT count(id_asignacion_pqrs) as contador FROM asignacion_pqrs where id_tipo_oficina=2 and codigo_oficina=".$idi." and estado_asignacion_pqrs=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contador']*25;
return $res;
$result4->free();
}


function adjuntos_nc_funcionario($table1, $table2, $cod_admin, $Idcontrato){
global $mysqli;
$query = "SELECT * FROM ".$table1.", ".$table2." WHERE id_nc_tipofile=".$cod_admin."  and
".$table1.".id_".$table2."=".$table2.".id_".$table2." and  ".$table2.".id_nc_contrato=".$Idcontrato." and
estado_".$table1."=1";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$adjunto = $row['send_nc_doc'];
return intval($adjunto);
$result->free();
}


function cantpercepcion($idi) {
global $mysqli;
$query4 = sprintf("SELECT count(id_percepcion_oac) as contadorp FROM percepcion_oac where id_oficina_registro=".$idi." and estado_percepcion_oac=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contadorp'];
return $res;
$result4->free();
}




function circulo($idi) {
global $mysqli;
$query4 = sprintf("SELECT circulo FROM oficina_registro where id_oficina_registro=".$idi.""); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['circulo'];
return $res;
$result4->free();
}




function privilegios($idperfil, $idfun) {
global $mysqli;
//count(id_funcionario_perfil)
$query4p = sprintf("SELECT ifnull(count(id_funcionario_perfil),0) as contadorp FROM funcionario_perfil where id_perfil=".$idperfil." and id_funcionario=".$idfun." and estado_funcionario_perfil=1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array(MYSQLI_ASSOC);
$resp=$row4p['contadorp'];
return $resp;
$result4p->free();
}




function agenda($idfun) {
global $mysqli;
//count(id_funcionario_perfil)
$query4p = sprintf("SELECT ifnull(count(id_funcionario),0) as contadorpa FROM ventanilla where id_funcionario=".$idfun." and estado_ventanilla=1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array(MYSQLI_ASSOC);
$resp=$row4p['contadorpa'];
return $resp;
$result4p->free();
}



function existenciaubicacion($idfuncionario) {
global $mysqli;
$query4p = sprintf("SELECT count(id_punto_ubicacion_enlace) as contadorp FROM punto_ubicacion_enlace where id_funcionario=".$idfuncionario." and estado_punto_ubicacion_enlace=1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array(MYSQLI_ASSOC);
$resp=$row4p['contadorp'];
return $resp;
$result4p->free();
}


function votacion($valor) {
global $mysqli;
$query4p = sprintf("select count(notario_propiedad.id_funcionario) as contadornn 
from notario_propiedad, notaria, funcionario where
notario_propiedad.id_notaria=notaria.id_notaria  and  notario_propiedad.id_funcionario=funcionario.id_funcionario AND 
 notario_propiedad.id_funcionario=".$valor." and estado_notario_propiedad=1 limit 1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array(MYSQLI_ASSOC);
$resp=$row4p['contadornn'];
return $resp;
$result4p->free();
}


function votacionfc($valorfc) {
global $mysqli;
$query4p = sprintf("SELECT COUNT(funcionario.id_funcionario) AS totfc 
FROM funcionario, posesion_notaria, notaria
WHERE funcionario.id_funcionario=posesion_notaria.id_funcionario 
and posesion_notaria.id_notaria=notaria.id_notaria 
AND notaria.id_categoria_notaria=3 and fecha_fin is null and 
estado_posesion_notaria=1 and posesion_notaria.id_funcionario=".$valorfc." limit 1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array(MYSQLI_ASSOC);
$resp=$row4p['totfc'];
return $resp;
$result4p->free();
}




function notariotitular($notariaid) {
global $mysqli;
$query4p = sprintf("SELECT funcionario.id_funcionario  
FROM funcionario, posesion_notaria, notaria
WHERE funcionario.id_funcionario=posesion_notaria.id_funcionario 
and posesion_notaria.id_notaria=notaria.id_notaria and fecha_fin is null and 
estado_posesion_notaria=1 and posesion_notaria.id_notaria=".$notariaid." limit 1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array(MYSQLI_ASSOC);
$resp2=$row4p['id_funcionario'];
return $resp2;
$result4p->free();
}



function contacto($valor) {
global $mysqli;
$query4p = sprintf("select nombre_funcionario, telefono_funcionario from funcionario where id_funcionario=".$valor." and estado_funcionario=1 limit 1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array(MYSQLI_ASSOC);
$resp=$row4p['nombre_funcionario'].' / '.$row4p['telefono_funcionario'];
return $resp;
$result4p->free();
}

 




function privilegiosnotariado($idnotar, $idmodulo, $idfunnota) {
global $mysqli;
$query4pn = sprintf("SELECT count(id_privilegio_notariado) as contadornota FROM privilegio_notariado where id_notaria=".$idnotar." and id_modulo_notariado=".$idmodulo." and id_funcionario=".$idfunnota." and estado_privilegio_notariado=1"); 
$result4pn = $mysqli->query($query4pn);
$row4pn = $result4pn->fetch_array(MYSQLI_ASSOC);
$respn=$row4pn['contadornota'];
return $respn;
$result4pn->free();
}





function curadores($curador) {
		
global $mysqli;
$query = "SELECT * FROM funcionario where id_tipo_oficina=4 and estado_funcionario=1  order by nombre_funcionario";
$result = $mysqli->query($query);



while ($obj = $result->fetch_array()) {
	
	if ($curador==$obj['id_funcionario']) {
		$selected='selected';
	} else {
		$selected='';
	}
	
        printf ("<option value='%s' ".$selected.">%s</option>\n", $obj['id_funcionario'], $obj['nombre_funcionario']);
    }

$result->free();

}






function listapordefecto($table, $limite, $pordefecto) {
		
if (isset($limite) && ""!=$limite){
$limite=" limit ".$limite." ";
} else {
$limite=" ";
}

if (isset($pordefecto) && ""!=$pordefecto){
$pordefecto=$pordefecto;
} else {
$pordefecto="";
}


global $mysqli;
$query = "SELECT id_".$table.", nombre_".$table."  FROM ".$table." where  estado_".$table."=1 order by nombre_".$table." ".$limite." ";
$result = $mysqli->query($query);

while ($obj = $result->fetch_array()) {
	$infoid='id_'.$table;
	$infonombre='nombre_'.$table;
	
	echo '<option value="'.$obj[$infoid].'"';
	
	if ($pordefecto==$obj[$infoid]) {
		  echo ' selected';
	} else {
		  echo '';
	}
	
	echo '>'.$obj[$infonombre].'</option>';
	
    }

$result->free();

}


function listapordefectocondicion($table, $limite, $pordefecto, $condicion)
{
   if (isset($limite) && "" != $limite) {
      $limite = " limit " . $limite . " ";
   } else {
      $limite = " ";
   }
   if (isset($pordefecto) && "" != $pordefecto) {
      $pordefecto = $pordefecto;
   } else {
      $pordefecto = "";
   }
   global $mysqli;
   $query = "SELECT id_" . $table . ", nombre_" . $table . "  FROM " . $table . " where  estado_" . $table . "=1 " . $condicion . " order by nombre_" . $table . " " . $limite . " ";
   $result = $mysqli->query($query);
   while ($obj = $result->fetch_array()) {
      $infoid = 'id_' . $table;
      $infonombre = 'nombre_' . $table;
      echo '<option value="' . $obj[$infoid] . '"';

      if ($pordefecto == $obj[$infoid]) {
         echo ' selected';
      } else {
         echo '';
      }
      echo '>' . $obj[$infonombre] . '</option>';
   }
   $result->free();
}




function perfildeusuario($user) {
		
global $mysqli;
$query = "SELECT nombre_perfil  FROM funcionario_perfil, perfil  where funcionario_perfil.id_perfil=perfil.id_perfil  and  funcionario_perfil.id_funcionario=".$user." and estado_funcionario_perfil=1 order by perfil.nombre_perfil";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
       echo $obj['nombre_perfil'].'<br>';
    }

$result->free();

}



function tiempo_transcurrido($fecha_nacimiento)
{
 /*  $fecha_actual = date('Y-m-d');
   
   if(!strlen($fecha_actual))
   {
      $fecha_actual = date('Y-m-d');
   }

  
   $array_nacimiento = explode ( "-", $fecha_nacimiento ); 
   $array_actual = explode ( "-", $fecha_actual ); 

   $anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años 
   $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
   $dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días 


   if ($dias < 0) 
   { 
      --$meses; 

    
      switch ($array_actual[1]) { 
         case 1: 
            $dias_mes_anterior=31;
            break; 
         case 2:     
            $dias_mes_anterior=31;
            break; 
         case 3:  
            if (bisiesto($array_actual[2])) 
            { 
               $dias_mes_anterior=29;
               break; 
            } 
            else 
            { 
               $dias_mes_anterior=28;
               break; 
            } 
         case 4:
            $dias_mes_anterior=31;
            break; 
         case 5:
            $dias_mes_anterior=30;
            break; 
         case 6:
            $dias_mes_anterior=31;
            break; 
         case 7:
            $dias_mes_anterior=30;
            break; 
         case 8:
            $dias_mes_anterior=31;
            break; 
         case 9:
            $dias_mes_anterior=31;
            break; 
         case 10:
            $dias_mes_anterior=30;
            break; 
         case 11:
            $dias_mes_anterior=31;
            break; 
         case 12:
            $dias_mes_anterior=30;
            break; 
      } 

      $dias=$dias + $dias_mes_anterior;

      if ($dias < 0)
      {
         --$meses;
         if($dias == -1)
         {
            $dias = 30;
         }
         if($dias == -2)
         {
            $dias = 29;
         }
      }
   }


   if ($meses < 0) 
   { 
      --$anos; 
      $meses=$meses + 12; 
   }

   $tiempo = $anos.' años, '.$meses.' meses, ' .$dias.' dias';
*/
$tiempo='.';
   return $tiempo;
   //http://foros.cristalab.com/calculo-de-edad-mostrado-en-anos-meses-y-dias.-t74491/
 
}
