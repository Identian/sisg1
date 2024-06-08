<?php
ini_set('max_execution_time', 10000000);  
require_once('../conf.php');	
function fechahabil($f1a,$dias) {
$holiday = array(
'01-01', //Año Nuevo
'07-01', //Día de los Reyes Magos
'25-03', //Día de San José
'18-04', //Jueves Santo (Semana Santa)
'19-04', //Viernes Santo (Semana Santa)
'01-05', //Día del Trabajo
'03-06', //Corpus Christi
'24-06', //Sagrado Corazón
'01-07', //San Pedro y San Pablo
'20-07', //Día de la Independencia
'07-08', //Batalla de Boyaca
'19-08', //La asunción de la Virgen
'14-10', //Día de la raza
'04-11', //Día de Todos los Santos
'11-11', //Independencia de Cartagena
'08-12', //Día de la Inmaculada Concepción
'25-12', //Navidad
 );

if (5==$dias) {
$nuevafecha = date('Y-m-d', strtotime('+7 day', strtotime($f1a)));
} else if (10==$dias) {
$nuevafecha = date('Y-m-d', strtotime('+15 day', strtotime($f1a)));	
} else if (15==$dias) {
$nuevafecha = date('Y-m-d', strtotime('+21 day', strtotime($f1a)));		
} else if (30==$dias) {
$nuevafecha = date('Y-m-d', strtotime('+42 day', strtotime($f1a)));
} else {
$nuevafecha = $f1a;
}

$startDate = new DateTime($f1a);    
$endDate = new DateTime($nuevafecha);    
$interval = new DateInterval('P1D');   
$date_range = new DatePeriod($startDate, $interval ,$endDate); 
$working_days = array();
foreach($date_range as $date){
   
if($date->format("N")>5 or in_array($date->format("d-m"),$holiday))
        $working_days[] = $date->format("Y-m-d"); 
}
$info= count($working_days);
$info2=$info+$dias;
$nuevafecha = date('Y-m-d', strtotime('+'.$info2.' day', strtotime($f1a)));

if (6==date('N', strtotime($nuevafecha))) {
$nuevafecha1=date('Y-m-d', strtotime('+2 day', strtotime($nuevafecha)));
} else if(7==date('N', strtotime($nuevafecha))) {
$nuevafecha1=date('Y-m-d', strtotime('+1 day', strtotime($nuevafecha)));
} else { 
$nuevafecha1=$nuevafecha;
}

return $nuevafecha1;
 }
 

   
$query = "SELECT correo_funcionario, solicitud_pqrs.id_solicitud_pqrs, radicado, fecha_radicado, terminos_dias 
 FROM solicitud_pqrs, asignacion_pqrs_funcionario, funcionario, clasificacion_pqrs, clase_oac 
WHERE  solicitud_pqrs.id_solicitud_pqrs=asignacion_pqrs_funcionario.id_solicitud_pqrs 
AND asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario 
and clasificacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs 
AND clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac 
and estado_asignacion_pqrs_funcionario=1 AND fecha_radicado>='2019-08-01' 
AND (solicitud_pqrs.id_estado_solicitud=2 OR solicitud_pqrs.id_estado_solicitud=4) 
 and estado_solicitud_pqrs=1 AND estado_asignacion_pqrs_funcionario=1   
 AND estado_clasificacion_pqrs=1   AND estado_clase_oac=1 
 order by solicitud_pqrs.id_solicitud_pqrs asc "; 



$selectnoti = mysql_query($query, $conexion) or die(mysql_error());
$rownoti = mysql_fetch_assoc($selectnoti);
$totalRows = mysql_num_rows($selectnoti);
if (0<$totalRows){

$realdate= date("Y-m-d");
//$menosundia = date('Y-m-d', strtotime('+1 day', strtotime($realdate)));
$menosdosdia = date('Y-m-d', strtotime('+2 day', strtotime($realdate)));


do {
	
$fechavence=fechahabil($rownoti['fecha_radicado'],$rownoti['terminos_dias']);
	


	
if ($menosdosdia==$fechavence) {

echo '<br>'.$rownoti['correo_funcionario'].' <a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$rownoti['id_solicitud_pqrs'].'.jsp">'.$rownoti['radicado'].'</a>';

}	
else {
	
}


	
	
  } while ($rownoti = mysql_fetch_assoc($selectnoti)); 
  
   
} else {

}	 
mysql_free_result($selectnoti);


?>