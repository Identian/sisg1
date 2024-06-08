<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {	
require_once('../conf.php'); 
session_start();


 function calculadias($fecha11,$fecha22)
{
    $na1 = new DateTime($fecha11);
    $ah2 = new DateTime($fecha22);
    $diferenciard = $ah2->diff($na1);
    return $diferenciard->format("%a");
}



function notacompetencia($va) {
if (100==$va) {
$info='Muy alto';
} else if (80==$va) {
$info='Alto';
} else if (60==$va) {
$info='Aceptable';	
} else if (40==$va) {
$info='Bajo';		
} else {
$info='Error';	
}
return $info;
}








$reg=explode('-', $_POST['option']);




$anor=intval($reg[0]);
$per=intval($reg[1]);
$funr=intval($reg[2]);
$query235 = "SELECT * FROM concertacion_edl, edl, funcionario where edl.id_funcionario=funcionario.id_funcionario and 
concertacion_edl.id_edl=edl.id_edl and edl.ano=".$anor." and edl.periodo=".$per." and edl.id_funcionario=".$funr."
and estado_concertacion_edl=1 and estado_edl=1";



$result235 = mysql_query($query235);	
$row = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);



if (0<$totalRows){

	
$arrayconcertacion=array();
$arrayfinal=array();
$arraydias=array();


do {
$ider=$row['id_concertacion_edl'];
$evaluacionedl=$row['id_edl'];
echo 'Evaluado:  ';
echo  $row['nombre_funcionario'];


$idevalua=$row['id_funcionario'];
$anot=$row['ano'];
$periodot=$row['periodo'];

echo '<br>Periodo: '.$anot.'-'.$periodot;


array_push($arrayconcertacion, 1);

$arraycompromisos=array();
$compromisosaceptados=array();
$todoscompromisos=array();
$arraycompetencias=array();
$competenciasaceptadas=array();
$todoscompetencias=array();
$arrayacepcomp=array();


echo '<br>Desde '.$row['desde'];
echo ', Hasta '.$row['hasta'];
echo '';
$diasedl=calculadias($row['desde'],$row['hasta']);
echo '<br>';

array_push($arraydias, $diasedl);


$sqln="SELECT * from compromiso_edl, metas_edl where 
compromiso_edl.id_metas_edl=metas_edl.id_metas_edl  
and id_concertacion_edl=".$ider." and aceptado=1 and estado_compromiso_edl=1 ";
$select1 = mysql_query($sqln, $conexion);
$row4 = mysql_fetch_assoc($select1);
$totalRows1 = mysql_num_rows($select1);




if (0<$totalRows1){
$i=1;
do {
	
	array_push($todoscompromisos, 1);
	
$compromiso=$row4['id_compromiso_edl'];


if (1==$row4['aceptado']) {
	
	array_push($compromisosaceptados, 1);
} else {

	
} 



if (isset($row4['confirmacion_nota'])) {
if (1==$row4['confirmacion_nota']) {

$fnota=($row4['porcentaje']/100)*$row4['nota'];

array_push($arraycompromisos, $fnota);

} else { 

 } 
} else { 


 }
 
 
	 } while ($row4 = mysql_fetch_assoc($select1)); 
} else {}	 
mysql_free_result($select1);


$tcompro=array_sum($todoscompromisos);
$taceptados=array_sum($compromisosaceptados);




if (0<count($arraycompromisos)  or 0<$nump117 or 1==$_SESSION['rol']) {
$valcomp= array_sum($arraycompromisos);
$notafcom=$valcomp*0.8;
echo 'Promedio de compromisos: '.round($valcomp, 2);
echo ', Nota de compromisos (sobre 80%): '.round($notafcom, 2);
} else {}




$select12 = mysql_query("SELECT * from competencia_edl, competencias_edl where 
competencia_edl.id_competencias_edl=competencias_edl.id_competencias_edl 
and id_concertacion_edl=".$ider." and aceptado=1 and estado_competencia_edl=1 ", $conexion);
$row42 = mysql_fetch_assoc($select12);
$totalRows12 = mysql_num_rows($select12);
if (0<$totalRows12){
$e=1;
do {
	array_push($todoscompetencias, 1);
$competencia=$row42['id_competencia_edl'];


if (1==$row42['aceptado']) {
array_push($competenciasaceptadas, 1);
} else {
}



if (isset($row42['confirmacion_nota'])) {
if (1==$row42['confirmacion_nota']) {
	array_push($arraycompetencias, $row42['nota']);

} else { 

 } 
} else { 

 }

	 } while ($row42 = mysql_fetch_assoc($select12)); 
} else {}	 
mysql_free_result($select12);


$tcompe=array_sum($todoscompetencias);
$tacepcompe=array_sum($competenciasaceptadas);



$totcom=count($arraycompetencias);
if (0<$totcom) {
$valcomp= array_sum($arraycompetencias);
$notafcomp1=$valcomp/$totcom;
$notafcomp=$notafcomp1*0.2;

echo '<br>Promedio de competencias: '.$notafcomp1;
echo ', Nota de competencias (sobre 20%): '.$notafcomp;



} else {}




if (0<$notafcom && 0<$notafcomp && 0<$totcom) {

$final=$notafcom+$notafcomp;
echo '<br><b>Nota</b> (Compromisos + competencias): '.round($final, 2).'<br>';

echo 'Dias evaluados: '.$diasedl.' ';

$respe=$diasedl*100;


$respo=$respe/182;

$ssfinal=$final*($respo/100);

$resp=round($ssfinal, 2);
echo ' / Nota: '.$resp.'<br><br>';
array_push($arrayfinal, $resp);
} else {}



	 } while ($row = mysql_fetch_assoc($result235)); 
	 

$fifi=count($arrayfinal);
$fifi2=count($arrayconcertacion);

$diasfinal= array_sum($arraydias);

if (0<$fifi && 0<$fifi2) {
$notafinal= array_sum($arrayfinal);



if (100<$notafinal) {
	$notafinal2=100;
} else {
	$notafinal2=$notafinal;
}


echo '<br><br><b>';
echo 'Dias contabilizados: '.$diasfinal.'<br>';

if (1<$fifi && 1<$fifi2) {
$finale=$notafinal2;
echo 'Nota final (Sumatoria de los periodos): '.$finale.'';
$tipo_edl='Parciales';
} else {
$finale=$final;
echo 'Nota final: '.$finale.'';	
$tipo_edl='Definitiva';
}
echo '</b> ';


echo '<br><a href="consulta_edl&'.$evaluacionedl.'.jsp" target="_blank">Ver detalles</a>';





}




//$query887oo = "UPDATE evaluacion_edl SET nota_sistema='$finale', tipo_edl='$tipo_edl' WHERE id_funcionario=".$idevalua." and ano=".$anot." and periodo=".$periodot." and estado_evaluacion_edl=1 limit 1";  
//$result447oo = $mysqli->query($query887oo);



	} else { echo 'No tiene permisos'; }
mysql_free_result($result235);






} else {}
?>


