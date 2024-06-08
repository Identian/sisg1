<?php
$nump117 = privilegios(117, $_SESSION['snr']);

if (isset($_GET['i'])) {
$id=intval($_GET['i']);



if ((1==$_SESSION['rol'] or 0<$nump117) && isset($_POST['reiniciar']) && ""!=$_POST['reiniciar']) {
$reiniciar=intval($_POST['reiniciar']);
$query888557 = "UPDATE compromiso_edl SET nota=null, confirmacion_nota=null WHERE id_concertacion_edl=".$reiniciar." and estado_compromiso_edl=1"; 
$result44855 = $mysqli->query($query888557); 

$query8885576 = "UPDATE competencia_edl SET nota=null, confirmacion_nota=null WHERE id_concertacion_edl=".$reiniciar." and estado_competencia_edl=1"; 
$result448556 = $mysqli->query($query8885576); 
} else { }




if ((1==$_SESSION['rol'] or 0<$nump117) && isset($_POST['aprobar_compromiso']) && ""!=$_POST['aprobar_compromiso']) {
	
$reiniciar22=intval($_POST['aprobar_compromiso']);
$query8885578 = "UPDATE compromiso_edl SET aceptado=null WHERE id_concertacion_edl=".$reiniciar22." and estado_compromiso_edl=1"; 
$result448558 = $mysqli->query($query8885578); 

$query88855769 = "UPDATE competencia_edl SET aceptado=null WHERE id_concertacion_edl=".$reiniciar22." and estado_competencia_edl=1"; 
$result4485569 = $mysqli->query($query88855769); 
} else { }





if (isset($_POST['act_evaluador']) && ""!=$_POST['act_evaluador']) {
$act_evaluador=$_POST['act_evaluador'];
$query888557 = "UPDATE edl SET nombre_edl=".$act_evaluador." WHERE id_edl=".$id.""; 
$result44855 = $mysqli->query($query888557); 
} else {}


if (isset($_POST['act_comision']) && ""!=$_POST['act_comision']) {
$act_comision=$_POST['act_comision'];
$query8885579 = "UPDATE edl SET comision_edl=".$act_comision." WHERE id_edl=".$id.""; 
$result44855 = $mysqli->query($query8885579); 
} else {}




function evaluador($idevaluador,$idr) {
global $mysqli;
$query4hj = sprintf("SELECT count(edl.id_edl) as cuentaf from  edl, concertacion_edl   
WHERE 
edl.id_edl=concertacion_edl.id_edl AND 
( edl.id_funcionario=".$idevaluador." or edl.nombre_edl=".$idevaluador." 
OR concertacion_edl.id_evaluador=".$idevaluador." OR 
concertacion_edl.id_comision=".$idevaluador.") 
 and estado_edl=1 and edl.id_edl=".$idr."   "); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();
if (0<count($row4hj)){
$reshhj=intval($row4hj['cuentaf']);
} else {
$reshhj=0;
}
return $reshhj;
$result4hj->free();
}






if (1==1) {
$queryauto="SELECT concertacion_edl.id_concertacion_edl, fecha_acep_auto, acep_auto 
from concertacion_edl, compromiso_edl WHERE 
 concertacion_edl.id_concertacion_edl= compromiso_edl.id_concertacion_edl 
 and fecha_acep_auto<'$realdate' AND acep_auto IS NULL 
 AND aceptado IS null GROUP BY concertacion_edl.id_concertacion_edl";
 $resultauto = $mysqli->query($queryauto);
while($rowauto = $resultauto->fetch_array()) {
$auto=$rowauto['id_concertacion_edl'];
$query888 = "UPDATE concertacion_edl SET acep_auto=1 WHERE id_concertacion_edl=".$auto.""; 
$result448 = $mysqli->query($query888); 
$query889 = "UPDATE compromiso_edl SET aceptado=1, fecha_aceptado=now() WHERE id_concertacion_edl=".$auto." and aceptado is null";  
$result4489 = $mysqli->query($query889);
$query8810 = "UPDATE competencia_edl SET aceptado=1, fecha_aceptado=now() WHERE id_concertacion_edl=".$auto." and aceptado is null";  
$result44810 = $mysqli->query($query8810);
 } 
$resultauto->free();

} else {}


if (1==$_SESSION['rol'] or 0<$nump117) {
$query477="SELECT count(edl.id_edl) as cuentaedl from edl where id_edl=".$id." "; //LIMIT 500 OFFSET ".$pagina."
} else {


$cuentaeva=evaluador($_SESSION['snr'],$id);
if (0<$cuentaeva) {

$query477="SELECT count(edl.id_edl) as cuentaedl from  edl, concertacion_edl   
WHERE 
edl.id_edl=concertacion_edl.id_edl AND 
( edl.id_funcionario=".$_SESSION['snr']." or edl.nombre_edl=".$_SESSION['snr']." 
OR concertacion_edl.id_evaluador=".$_SESSION['snr']." OR 
concertacion_edl.id_comision=".$_SESSION['snr'].") 
 and estado_edl=1 and edl.id_edl=".$id."   ";
 

} else {

$query477="SELECT count(edl.id_edl) as cuentaedl from edl where (id_funcionario=".$_SESSION['snr']." or nombre_edl=".$_SESSION['snr'].") 
 and estado_edl=1 and id_edl=".$id." ";

	
}

}

$result77 = $mysqli->query($query477);
$row477 = $result77->fetch_array();
$res77=$row477['cuentaedl'];
$result77->free();


if (0<$res77) {





if ((isset($_POST["evi"])) && (""!=$_POST["evi"])) { 


$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'xls', 'xlsx');


$directoryftp="filesnr/evidenciaedl/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'edl-'.$_SESSION['snr'].'-'.$identi;

$archivo = $_FILES['file']['tmp_name'];

$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;


if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
 


$insertSQL = sprintf("INSERT INTO evidencias_edl (id_funcionario, fecha_evidencia, 
nombre_evidencias_edl, id_edl, url, estado_evidencias_edl) 
VALUES (%s, now(), %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST['evi'], "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
//echo $insertSQL;
   
  } else {
$files='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
  }
} else { 
$files='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}
		

} else { 
$files='';	
	}	
	
} else {}
	  








if (isset($_POST['cambio_comision']) && ''!=$_POST['cambio_comision']) {

$updateSQL778 = sprintf("UPDATE concertacion_edl SET desde=%s, hasta=%s, 
id_evaluador=%s, id_comision=%s, tipo_concertacion=%s, motivo_parcial=%s  
   where id_concertacion_edl=%s and id_edl=%s",
   GetSQLValueString($_POST['cambio_desde'], "date"),
   GetSQLValueString($_POST['cambio_hasta'], "date"),
   GetSQLValueString($_POST['cambio_evaluador'], "int"),
   GetSQLValueString($_POST['cambio_comision'], "int"),
   GetSQLValueString($_POST['cambio_tipo_concertacion'], "text"), 
    GetSQLValueString($_POST['cambio_motivo_parcial'], "text"), 
    GetSQLValueString($_POST['cambio_concertacion'], "int"),
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);

echo $actualizado;	
	} else {}
	


	
if ((isset($_POST["desde"])) && (""!=$_POST["desde"])) {
if (isset($_POST['id_evaluador']) && ""!=$_POST['id_evaluador']) {
		$evalua=$_POST['id_evaluador'];
	} else { $evalua=$_SESSION['snr']; }
	
	
function estadofechas($idec,$fechaa,$fechab) {
global $mysqli;
$query4 = sprintf("SELECT count(id_concertacion_edl) as contad  
FROM concertacion_edl where id_edl=".$idec." 
 AND desde <=  '$fechaa' AND hasta >='$fechaa' 
and estado_concertacion_edl=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$res=$row4['contad'];
return $res;
$result4->free();
}

$infofechas=estadofechas($id,$_POST['desde'],$_POST['hasta']);
//echo '<h1>'.$infofechas.'</h1>';
if (0<$infofechas) {
	echo '<script type="text/javascript">swal(" ERROR !", " Las fechas seleccionadas no son validas, por favor revisar. !", "error");</script>';	
} else {
	
	
$insertSQL = sprintf("INSERT INTO concertacion_edl (
id_edl, id_evaluado, desde, hasta, id_evaluador, id_comision, 
tipo_concertacion, estado_concertacion_edl) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST['id_evaluado'], "int"),
GetSQLValueString($_POST['desde'], "date"), 
GetSQLValueString($_POST['hasta'], "date"), 
GetSQLValueString($evalua, "int"), 
GetSQLValueString($_POST['id_comision'], "int"), 
GetSQLValueString('Calificaci&oacute;n definitiva', "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
//echo $insertado;

}
}
	
	
	
	
if ((isset($_POST["id_metas_edl"])) && (""!=$_POST["id_metas_edl"])) {
	
	
function estadocompromiso($ti) {
global $mysqli;
$query4 = sprintf("SELECT count(id_compromiso_edl) as contadora, SUM(porcentaje) AS por 
FROM compromiso_edl where id_concertacion_edl=".$ti." and estado_compromiso_edl=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$res=$row4['contadora'].'--'.intval($row4['por']);
return $res;
$result4->free();
}

$infocompro=estadocompromiso($_POST['id_concertacion_edl']);

$infocompro2=explode("--",$infocompro);	



$porcen=$_POST['porcentaje']+intval($infocompro2[1]);

//echo $infocompro2[0].'//'.$porcen;

if (5>=$infocompro2[0] and 100>=intval($porcen)) {
	
$insertSQL2 = sprintf("INSERT INTO compromiso_edl (
id_concertacion_edl, id_metas_edl, nombre_compromiso_edl, porcentaje, estado_compromiso_edl) 
VALUES (%s, %s, %s, %s, %s)", 
GetSQLValueString($_POST['id_concertacion_edl'], "int"), 
GetSQLValueString($_POST['id_metas_edl'], "int"), 
GetSQLValueString($_POST['nombre_compromiso_edl'], "text"), 
GetSQLValueString($_POST['porcentaje'], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL2, $conexion);


if (100==$porcen)  {
$emailu=correofuncionario($_POST['usereva']);
$subject = 'EDL - SNR.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que su evaluador ha realizado la concertación de compromisos. A través del Módulo EDL-SISG, deberá ingresar para revisar y aceptar o rechazar la propuesta de su evaluador. <br>Recuerde descargar el PDF de la concertación.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/consulta_edl&'.$id.'.jsp">https://sisg.supernotariado.gov.co/consulta_edl&'.$id.'.jsp</a>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
//$cabeceras .= 'cc: edl@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);



$date_now = date('Y-m-d');
$date_past = strtotime('+5 day', strtotime($date_now));
$fechan = date('Y-m-d', $date_past);

$updateSQL7789 = sprintf("UPDATE concertacion_edl SET fecha_acep_auto=%s    
   where id_concertacion_edl=%s and id_edl=%s",
   GetSQLValueString($fechan, "date"),
   GetSQLValueString($_POST['id_concertacion_edl'], "int"),
   GetSQLValueString($id, "int"));
 $Result89 = mysql_query($updateSQL7789, $conexion);


}


} else {
echo '<script type="text/javascript">swal(" ERROR !", " Debe ser maximo 5 compromisos o 100% en la suma de los mismos. !", "error");</script>';	
}

}




if ((isset($_POST["id_competencia_edl"])) && (""!=$_POST["id_competencia_edl"])) {
	
function estadocompetencia($tio) {
global $mysqli;
$query4 = sprintf("SELECT count(id_competencia_edl) as contad  
FROM competencia_edl where id_concertacion_edl=".$tio." and estado_competencia_edl=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$res=$row4['contad'];
return $res;
$result4->free();
}

$infocomproc=estadocompetencia($_POST['id_concertacion_edlcom']);

if (5>$infocomproc) {
	
$insertSQL3 = sprintf("INSERT INTO competencia_edl (
id_concertacion_edl, id_competencias_edl, estado_competencia_edl) 
VALUES (%s, %s, %s)", 
GetSQLValueString($_POST['id_concertacion_edlcom'], "int"), 
GetSQLValueString($_POST['id_competencia_edl'], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL3, $conexion);

} else {
echo '<script type="text/javascript">swal(" ERROR !", " Debe ser maximo 5 competencias. !", "error");</script>';	
}

}




$arraynotas=array();
$arraycomision=array();
$arrayacepcomp=array();

$cuentaevaluador=count($_POST);
if (isset($_POST['id_concertacion_com']) && ""!=$_POST['id_concertacion_com']) {
	
foreach ($_POST as $key => $value) {
	
$campo=explode('-',$key);
$compromiso=$campo[1];
$valor=$value;

	if ('notacompromiso'==$campo[0]){

$updateSQL778 = sprintf("UPDATE compromiso_edl SET nota=%s, confirmacion_nota=NULL   
   where id_compromiso_edl=%s and id_concertacion_edl=%s",
   GetSQLValueString($valor, "int"),
   GetSQLValueString($compromiso, "int"),
   GetSQLValueString($_POST['id_concertacion_com'], "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);

 if (0==intval($valor)) {
	array_push($arraynotas, 1);
} else {
	array_push($arraynotas, 1);
}



	} else if ('notacompetencia'==$campo[0]) {
	$competencia=$campo[1];
	$updateSQL778 = sprintf("UPDATE competencia_edl SET nota=%s, confirmacion_nota=NULL    
   where id_competencia_edl=%s and id_concertacion_edl=%s",
   GetSQLValueString($valor, "int"),
   GetSQLValueString($competencia, "int"),
   GetSQLValueString($_POST['id_concertacion_com'], "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);


		
		
	} else if ('aprobarcompromiso'==$campo[0]) {
		
	$acompromiso=$campo[1];
	$updateSQL778 = sprintf("UPDATE compromiso_edl SET confirmacion_nota=%s  
   where id_compromiso_edl=%s and id_concertacion_edl=%s",
   GetSQLValueString($valor, "int"),
   GetSQLValueString($acompromiso, "int"),
   GetSQLValueString($_POST['id_concertacion_com'], "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 
 
 if (0==intval($valor)) {
	array_push($arraycomision, 1);
} else {
	array_push($arraycomision, 1);
}



	} else if ('aprobarcompetencia'==$campo[0]) {
		
	$acompetencia=$campo[1];
	$updateSQL778 = sprintf("UPDATE competencia_edl SET confirmacion_nota=%s  
   where id_competencia_edl=%s and id_concertacion_edl=%s",
   GetSQLValueString($valor, "int"),
   GetSQLValueString($acompetencia, "int"),
   GetSQLValueString($_POST['id_concertacion_com'], "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 



	} else if ('aprobarconcertacioncompromiso'==$campo[0]) {
		
	$acompromisoa=$campo[1];
	$updateSQL778 = sprintf("UPDATE compromiso_edl SET aceptado=%s     
   where id_compromiso_edl=%s and id_concertacion_edl=%s",
   GetSQLValueString($valor, "int"),
   GetSQLValueString($acompromisoa, "int"),
   GetSQLValueString($_POST['id_concertacion_com'], "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 
if (0==intval($valor)) {
	array_push($arrayacepcomp, 1);
} else {
	array_push($arrayacepcomp, 0);
}



$query88855 = "UPDATE concertacion_edl SET acep_auto=0 WHERE id_concertacion_edl=".intval($_POST['id_concertacion_com']).""; 
$result44855 = $mysqli->query($query88855); 



 
	} else if ('aprobarconcertacioncompetencia'==$campo[0]) {
		
	$acompetenciaa=$campo[1];
	$updateSQL778 = sprintf("UPDATE competencia_edl SET aceptado=%s    
   where id_competencia_edl=%s and id_concertacion_edl=%s",
   GetSQLValueString($valor, "int"),
   GetSQLValueString($acompetenciaa, "int"),
   GetSQLValueString($_POST['id_concertacion_com'], "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 
if (0==intval($valor)) {
	array_push($arrayacepcomp, 1);
} else {
	array_push($arrayacepcomp, 0);
}


	} else {	}
	
}



$resultadonotas=array_sum($arraynotas);

 if (0<$resultadonotas) {
	 
	 $id=intval($_GET['i']);
	 
	 if (3629==$id) {
		 $emailu='giovanni.ortegon@supernotariado.gov.co';
	 } else {
		$emailu=correofuncionario($_POST['userevaluador']); 
	 }
	 
//$emailu=correofuncionario($_POST['userevaluador']);
$subject = 'EDL - SNR.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que se ha realizado una calificación a través del Módulo EDL-SISG.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/consulta_edl&'.$id.'.jsp">Ver el registro EDL.</a>';
$cuerpo .= "<br><br>";
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
//$cabeceras .= 'cc: evaluaciondesempeno@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);

 } else {}
	 
	
	
$resultadoaceptacion=array_sum($arrayacepcomp);

 if (0<$resultadoaceptacion) {



$emailu=correofuncionario($_POST['userevaluador']);
$subject = 'EDL - SNR.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que se ha rechazado la concertación a través del Módulo EDL-SISG.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/consulta_edl&'.$id.'.jsp">Ver el registro EDL.</a>';
$cuerpo .= "<br><br>".$_POST['userevaluador'];
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
//$cabeceras .= 'cc: evaluaciondesempeno@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);


	} else {
		
//$emailu=correofuncionario($_POST['userevaluador']);
$subject = 'EDL - SNR.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que se ha aceptado la concertación de compromisos a través del Módulo EDL-SISG.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/consulta_edl&'.$id.'.jsp">Ver el registro EDL.</a>';
$cuerpo .= "<br><br>";
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
//$cabeceras .= 'cc: evaluaciondesempeno@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
//mail($emailu,$subject,$cuerpo,$cabeceras);
	
		
	}
	
	
	
	$resultadocomision=array_sum($arraycomision);

 if (0<$resultadocomision) {
	
$emailu=correofuncionario($_POST['userevaluador']);
$subject = 'EDL - SNR.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que la comisión evaluadora ha realizado la gestión de la evaluación.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/consulta_edl&'.$id.'.jsp">Ver el registro EDL.</a>';
$cuerpo .= "<br><br>";
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'cc: evaluaciondesempeno@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);
 } else {}
	
	
	
	
	
	
	
	
	
}













	
	
$query = sprintf("SELECT * FROM edl, funcionario where edl.id_funcionario=funcionario.id_funcionario and
id_edl=".$id." limit 1"); 
$select = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select);
$tota = mysql_num_rows($select);
if (0<$tota) {
	
	
if (isset($_POST['correoevaluado']) && 1==$_POST['correoevaluado']) {
$emailu=$row1['correo_funcionario'];
$subject = 'EDL - SNR.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que ha actualizado su EDL. A través del Módulo EDL-SISG, deberá ingresar para revisar y aceptar o rechazar la propuesta de su evaluador.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/consulta_edl&'.$id.'.jsp">https://sisg.supernotariado.gov.co/consulta_edl&'.$id.'.jsp</a>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
//$cabeceras .= 'cc: edl@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);
echo '<script type="text/javascript">swal(" OK !", " Enviado Correctamente  !", "success");</script>';


} else {}
	
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
	
?>

<script>
function correorecurso() {
	alert('Debe escribir un correo al evaluador y comisión evaluadora adjuntando y explicando las evidencias.');
}
</script>


<div class="row">

<div class="box">
<div class="box-header with-border">
<div class="col-md-5">
<?php
echo 'Fecha de creación: '.$row1['fecha_edl'];
$ano=$row1['ano'];
$periodo=$row1['periodo'];
echo '<br>Periodo: '.$ano.'-';

if (1==$periodo) {
	echo 'I';
} else {
	echo 'II';
}
$idevaluado=$row1['id_funcionario'];
echo '<br>Evaluado: <a href="usuario&'.$idevaluado.'.jsp" target="_blank">'.$row1['nombre_funcionario'].'</a>';


if (1==$_SESSION['rol'] or 0<$nump117) { 

echo '

   <form class="navbar-form" name="fo45452342343345rm1" method="post" action="" id="forma1">
             Evaluador: <a href="usuario&'.$row1['nombre_edl'].'.jsp" target="_blank">'.quees('funcionario',$row1['nombre_edl']).'</a> 
              <select class="select2ComisionNuevo" style="width:200px" name="act_evaluador" required>
                <option value=""></option>';
$query5 = "SELECT id_funcionario, nombre_funcionario  FROM funcionario where id_tipo_oficina<3 and id_cargo<3 order by nombre_funcionario";
$result5 = $mysqli->query($query5);
while ($obj5 = $result5->fetch_array()) {
echo '<option value='.$obj5['id_funcionario'].'>'.$obj5['nombre_funcionario'].'</option>';
    }
$result5->free();

echo '</select>
              <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-refresh" title="Cambiar"></span></button>
            </form>';


echo '  <form class="navbar-form" name="fo4545254654342343354645rm1" method="post" action="" id="forma2">
             Comision: <a href="usuario&'.$row1['comision_edl'].'.jsp" target="_blank">'.quees('funcionario',$row1['comision_edl']).'</a> 
              <select class="select2ComisionNuevo" style="width:200px" name="act_comision" required>
                <option value=""></option>';
$query6 = "SELECT id_funcionario, nombre_funcionario  FROM funcionario where id_tipo_oficina<3 and id_cargo=1 order by nombre_funcionario";
$result6 = $mysqli->query($query6);
while ($obj6 = $result6->fetch_array()) {
echo '<option value='.$obj6['id_funcionario'].'>'.$obj6['nombre_funcionario'].'</option>';
    }
$result6->free();

echo '</select>
              <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-refresh" title="Cambiar"></span></button>
            </form>';
?>
<script>
$(document).ready(function() {
            $(".select2ComisionNuevo").select2({
                dropdownParent: $('#forma1')
            });
			
			 $(".select2ComisionNuevo").select2({
                dropdownParent: $('#forma2')
            });
			
        });
</script>

<?php
} else {}


?>


<br>
<br>
<?php if (3>$_SESSION['snr_grupo_cargo']) { ?>
<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
Nueva concertación para <?php echo $ano.'-'.$periodo; ?>
</button> 

<a href="https://supernotariadoyregistro-my.sharepoint.com/:v:/g/personal/giovanni_ortegon_supernotariado_gov_co/EZUe2ovcYolLrXNt5ftyUCcB6jUhYGApJTiKMI59V4773w?e=wFljIw&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZyIsInJlZmVycmFsQXBwUGxhdGZvcm0iOiJXZWIiLCJyZWZlcnJhbE1vZGUiOiJ2aWV3In19" target="_blank">Manual de uso</a>
<?php } else {} ?>
</div>





<div class="col-md-3">
<form action="" method="post" name="ewr43443555435ewr" enctype="multipart/form-data" >
Cargar evidencias<br>
<input type="file" name="file" required >
<input type="text" value="" placeholder="Nombre de evidencia" style="width:80%" name="evi" required>
<button type="submit" class="btn btn-xs btn-success">
<span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>
</form>
	<?php
$select = mysql_query("select * from evidencias_edl where id_edl=".$id." and estado_evidencias_edl=1 order by id_evidencias_edl", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo '<ol>';
do {
	echo '<li><a href="filesnr/evidenciaedl/'.$row['url'].'" target="_blank" title="'.$row['fecha_evidencia'].'"';
	echo '>'.$row['nombre_evidencias_edl'].'</a>';
	
	if (1==$_SESSION['rol'] or 0<$nump117 or $idevaluado==$_SESSION['snr']) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$row['id_evidencias_edl'].'" name="evidencias_edl" id="'.$row['id_evidencias_edl'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	
	
	
	echo '</li>';
	 } while ($row = mysql_fetch_assoc($select));
echo '</ol>';	 
} else {}	 
mysql_free_result($select);
?>

</div>


<div class="col-md-3">

<form action="" method="post" name="ewr43e3534553656435ewr" >
<input type="hidden" value="1" name="correoevaluado">
<button type="submit" class="btn btn-xs btn-warning" style="width:100%;"><span class="fa fa-file"></span> 
Comunicar por correo</button>
</form>

<br>
<br>
<a href="pdf/formato_edl&<?php echo $id; ?>.pdf">
<button type="button" class="btn btn-xs btn-success" style="width:100%;"><span class="fa fa-file"></span> 
Guardar evaluación</button>
</a>

</div>


</div>
</div>

</div>


<?php


$arrayconcertacion=array();
$arrayfinal=array();

$query466="SELECT * from concertacion_edl where id_edl=".$id." and estado_concertacion_edl=1 ORDER BY id_concertacion_edl asc  "; 
$result66 = $mysqli->query($query466);

while($row = $result66->fetch_array()) {
	
	
array_push($arrayconcertacion, 1);
$id_concertacion=$row['id_concertacion_edl'];


echo '<div class="row"><div class="col-md-12">
<div class="box box-header">';

if (1==$_SESSION['rol']) {
	echo '<i style="color:#ccc;">C'.$id_concertacion.'</i> ';
} else { }


echo 'Fecha de concertación: ';
echo ''.$row['nombre_concertacion_edl'];
echo ', Desde '.$row['desde'];
echo ', Hasta '.$row['hasta'];
echo ', Dias: ';
$diasedl=calculadias($row['desde'],$row['hasta']);
echo $diasedl;
$idfuncionario=$row['id_evaluado'];
$idevaluador=$row['id_evaluador'];
$idcomision=$row['id_comision'];

echo  '<div class="box-tools">';

if ($idevaluador==$_SESSION['snr'] or $idcomision==$_SESSION['snr'] or 0<$nump117 or 1==$_SESSION['rol']) {
echo '<a href="" title="Actualizar" id="'.$id_concertacion.'" class="ver_concertacion" data-toggle="modal" data-target="#popupconcertacion"><button class="btn btn-xs btn-info">
<span class="fa fa-file"></span> Actualizar</button></a> ';
} else {}
 
  if ($idfuncionario==$_SESSION['snr'] or 1==$_SESSION['rol']) {
echo ' <a href="" title="Revisar" id="'.$id_concertacion.'" class="ver_aceptar" data-toggle="modal" data-target="#popupaceptar"><button class="btn btn-xs btn-warning">
<span class="fa fa-edit"></span> Revisar compromisos</button></a>';
 } else {}
 
 
 if ($idevaluador==$_SESSION['snr']) {
echo ' <a href="" title="Evaluar" id="'.$id_concertacion.'" class="ver_eva" data-toggle="modal" data-target="#popupeval"><button class="btn btn-xs btn-success">
<span class="fa fa-edit"></span> Evaluar</button></a>';
 } else {}

if ($idcomision==$_SESSION['snr'] or 1==$_SESSION['rol']) {
echo ' <a href="" title="Confirmar" id="'.$id_concertacion.'" class="ver_confirmar" data-toggle="modal" data-target="#popupconfirmar"><button class="btn btn-xs btn-success">
<span class="fa fa-user"></span> Revisar evaluación</button></a>';
} else {}



if (1==$_SESSION['rol'] or 0<$nump117) {
echo ' <a title="Reiniciar nota y aprobación." id="'.$id_concertacion.'" class="nreinicio" data-toggle="modal" data-target="#popupreiniciar" ><button class="btn btn-xs btn-danger">
<span class="fa fa-close"></span> Reiniciar</button></a>';
} else {}

if (1==$_SESSION['rol'] or 0<$nump117) {
echo ' <a title="Reiniciar aceptación" id="'.$id_concertacion.'" class="borraraceptacioncompromiso" data-toggle="modal" data-target="#popupaprobar_compromiso" ><button class="btn btn-xs btn-info">
<span class="fa fa-close"></span>Quitar aceptación</button></a>';
} else {}

if (1==$_SESSION['rol'] or 0<$nump117) {
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_concertacion.' " name="concertacion_edl" id="'.$id_concertacion.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else {}

echo '</div>';
echo '<br><b>Evaluador:</b> '.quees('funcionario',$row['id_evaluador']);
echo ', <b>Comisión evaluadora:</b> '.quees('funcionario',$row['id_comision']);
echo '<br><b>Tipo:</b> '.$row['tipo_concertacion'].'. '.$row['motivo_parcial'].'';

if (1==$row['acep_auto']) {
echo '<br>Concertación automática al superar fecha '.$row['fecha_acep_auto'].'';
} else {}

//echo '<br>Enlace externo de evaluación: <a href="#" target="_blank">https://servicios.supernotariado.gov.co/edl/'.$id_concertacion.'5tnj'.$id_concertacion.'.html</a> ';


echo '<hr><b>Compromisos</b> (de 3 a 5, inferior a 100%) '; 
 if ($idevaluador==$_SESSION['snr'])  {
echo '<a href="" title="Nuevo compromiso" id="'.$id_concertacion.'" class="ver_compro" data-toggle="modal" data-target="#popupcompro">
<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span>
Nuevo </button></a> ';
} else {}

 echo '<a href="https://supernotariadoyregistro-my.sharepoint.com/:v:/g/personal/giovanni_ortegon_supernotariado_gov_co/EZUe2ovcYolLrXNt5ftyUCcB6jUhYGApJTiKMI59V4773w?e=wFljIw&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZyIsInJlZmVycmFsQXBwUGxhdGZvcm0iOiJXZWIiLCJyZWZlcnJhbE1vZGUiOiJ2aWV3In19" target="_blank">Manual de uso</a>';


$query44="SELECT * from compromiso_edl, metas_edl where 
compromiso_edl.id_metas_edl=metas_edl.id_metas_edl  
and id_concertacion_edl=".$id_concertacion."  and estado_compromiso_edl=1";
$result4 = $mysqli->query($query44);
echo '<table class="table table-bordered table-striped"><tr><th>#</th><th>Meta</th><th>Compromiso</th>
<th>%</th><th>Evaluado</th><th>Nota-Evaluador</th><th>Comisión</th><th></th></tr>';
$i=1;
$arraycompromisos=array();
$compromisosaceptados=array();
$todoscompromisos=array();
while($row4 = $result4->fetch_array()) {
array_push($todoscompromisos, 1);
$id_compromiso=$row4['id_compromiso_edl'];
echo '<tr title="'.$id_compromiso.'">';
echo '<td>'.$i++.'</td>';
echo '<td>'.$row4['nombre_metas_edl'].'</td>';
echo '<td>'.$row4['nombre_compromiso_edl'].'</td>';
echo '<td>'.$row4['porcentaje'].'%</td>';
echo '<td>';
if (isset($row4['aceptado'])) {
if (1==$row4['aceptado']) {
	
	array_push($compromisosaceptados, 1);
	
	echo '<span class="label label-success" title="'.$row4['fecha_aceptado'].'">Aceptado</span>';
} else {
	echo '<span class="label label-danger">No aceptado</span>';
} } else { echo '<span style="color:#B52824">Pendiente</span>'; }
echo '</td>';

echo '<td>';
if (isset($row4['nota'])) {
echo '<span class="badge bg-yellow">'.$row4['nota'].'</span> ';
} else { echo '<span style="color:#B52824">Pendiente</span>';}

echo '</td>';

echo '<td>';

if (isset($row4['confirmacion_nota']) && isset($row4['nota'])) {
if (1==$row4['confirmacion_nota']) {
 echo 'Aprobada: ';

$fnota=($row4['porcentaje']/100)*$row4['nota'];

array_push($arraycompromisos, $fnota);
 
} else { echo 'Rechazada'; }
 



} else { echo '<span style="color:#B52824">Pendiente</span>'; }



echo '</td>';

echo '<td>';
if (1==$row4['aceptado']) {} else {
if ($idevaluador==$_SESSION['snr'] or 1==$_SESSION['rol'] or 0<$nump117) {
echo '<a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_compromiso.' " name="compromiso_edl" id="'.$id_compromiso.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else {}
}
echo '</td>';
echo '</tr>';
}
echo '</table>';

$result4->free();


$tcompro=array_sum($todoscompromisos);
$taceptados=array_sum($compromisosaceptados);
	
if ($tcompro==$taceptados) {
	echo '<b>Todos los compromisos han sido aceptados</b><br>';
} else {
	echo '<b style="color:#B52824;">NO todos los compromisos han sido aceptados.</b><br>';
}

if (0<count($arraycompromisos)  or 0<$nump117 or 1==$_SESSION['rol']) {
$valcomp= array_sum($arraycompromisos);
$notafcom=$valcomp*0.8;
echo 'Promedio de compromisos: '.round($valcomp, 2);
echo ', Nota de compromisos (sobre 80%): '.round($notafcom, 2);
} else {}







$arraycompetencias=array();

echo '<hr><form  name="fo32445324345rm1" method="post" action="">
<b>Competencias:</b> (de 3 a 5) ';

 if ($idevaluador==$_SESSION['snr']) {
echo '<select name="id_competencia_edl" style="min-width:200px;" required>
                  <option></option>';
				//  echo lista('competencias_edl');
				
$query98 = "SELECT * FROM competencias_edl WHERE estado_competencias_edl=1 ";  // and vigencia_comp=".$ano." 
   $result98 = $mysqli->query($query98);
   while ($obj98 = $result98->fetch_array()) {
echo '<option value="'.$obj98['id_competencias_edl'].'">'.$obj98['nombre_competencias_edl'].'</option>';
   }
   $result98->free();
   
   
				
				 echo ' </select>
				 <input type="hidden" name="id_concertacion_edlcom" value="'.$id_concertacion.'">
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>';
} else {}
		  
		  echo '</form>';

$query443="SELECT * from competencia_edl, competencias_edl where 
competencia_edl.id_competencias_edl=competencias_edl.id_competencias_edl 
and id_concertacion_edl=".$id_concertacion." and estado_competencia_edl=1 ";
$result43 = $mysqli->query($query443);
echo '<table class="table table-bordered table-striped"><tr><th>#</th><th>Competencia</th><th>Descripción</th>
<th>Conducta asociada</th><th>Evaluado</th>
<th>Nota-Evaluador</th><th>Comisión</th><th></th></tr>';
$e=1;


$competenciasaceptadas=array();
$todoscompetencias=array();

while($row43 = $result43->fetch_array()) {
array_push($todoscompetencias, 1);
$idcom=$row43['id_competencia_edl'];
echo '<tr title="'.$idcom.'">';
echo '<td>'.$e++.'</td>';	
echo '<td>'.$row43['nombre_competencias_edl'].'</td>';
echo '<td>'.$row43['definicion_edl'].'</td>';
echo '<td>'.$row43['conducta_asociada'].'</td>';
echo '<td>';
if (isset($row43['aceptado'])) {
if (1==$row43['aceptado']) {
	echo '<span class="label label-success" title="'.$row4['fecha_aceptado'].'">Aceptado</span>';
array_push($competenciasaceptadas, 1);
} else {
	echo '<span class="label label-danger">No aceptado</span>';
} } else { echo '<span style="color:#B52824">Pendiente</span>'; }
echo '</td>';
echo '<td>';
if (isset($row43['nota']) && ""!=$row43['nota']) {
echo '<span class="badge bg-yellow">';
echo notacompetencia($row43['nota']);
echo '</span> ';
} else { echo '<span style="color:#B52824">Pendiente</span>'; }

echo '</td>';

echo '<td>';

if (isset($row43['confirmacion_nota']) && isset($row43['nota'])) {
if (1==$row43['confirmacion_nota']) {
 echo 'Aprobada ';
 


} else { echo 'Rechazada'; } 




} else { echo '<span style="color:#B52824">Pendiente</span>'; }

array_push($arraycompetencias, $row43['nota']);

echo '</td>';


echo '<td>';
if (1==$row43['aceptado']) {} else {
if ($idevaluador==$_SESSION['snr'] or 1==$_SESSION['rol'] or 0<$nump117) {
echo '<a style="color:#ff0000;cursor: pointer" title="Borrar '.$idcom.' " name="competencia_edl" id="'.$idcom.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else {}
}
echo '</td>';

echo '</tr>';
}
echo '</table>';

$result43->free();



$tcompe=array_sum($todoscompetencias);
$tacepcompe=array_sum($competenciasaceptadas);

if ($tcompe==$tacepcompe) {
	echo '<b>Todas las competencias han sido aceptadas</b><br>';
} else {
	echo '<b style="color:#B52824;">NO todas las competancias han sido aceptadas.</b><br>';
}




echo '<br><a href="pdf/formato_edl&'.$id.'.pdf">
<button type="button" class="btn btn-xs  btn-success"><span class="fa fa-file"></span>  
Imprimir concertación </button></a>
 &nbsp;  &nbsp; 

<a href="" onclick="correorecurso1()">
<button type="button" class="btn btn-xs  btn-warning"><span class="fa fa-user"></span>  
Interponer recurso de reposición </button></a>

<br>';

$totcom=count($arraycompetencias);
if (0<$totcom  or 0<$nump117 or 1==$_SESSION['rol']) {
$valcomp= array_sum($arraycompetencias);
$notafcomp1=$valcomp/$totcom;
$notafcomp=$notafcomp1*0.2;

echo 'Promedio de competencias: '.$notafcomp1;
echo ', Nota de competencias (sobre 20%): '.$notafcomp;



} else {}


if ((0<$notafcom && 0<$notafcomp && 0<$totcom)  or 0<$nump117 or 1==$_SESSION['rol']) {
$final=$notafcom+$notafcomp;
echo '<h3><b>Nota</b> (Compromisos + competencias): 
<b>'.round($final, 2).'</h3><br>';

//echo 'Dias evaluados: </b>'.$diasedl.' ';


$respe=$diasedl*100;

$respo=$respe/182;

$ssfinal=$final*($respo/100);



$resp=round($ssfinal, 2);
//echo ' / <b>Nota de acuerdo con los dias:</b> '.$resp.'';
array_push($arrayfinal, $resp);
} else {}



echo '</div></div></div>';


 } 
$result66->free();
	



$fifi=count($arrayfinal);
$fifi2=count($arrayconcertacion);
if (0<$fifi && 0<$fifi2) {
$notafinal= array_sum($arrayfinal);

if (100<$notafinal) {
	$notafinal2=100;
} else {
	$notafinal2=$notafinal;
}

echo '<a href="pdf/formato_edl&'.$id.'.pdf" class="btn btn-success"><b> 
Imprimir</b> </a>';
}

?>

	
	




	



















 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">
		NUEVA CONCERTACIÓN PARA <?php echo $ano.'-'.$periodo; ?></h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for464324324563m1">

<input type="hidden" name="id_evaluado" value="<?php echo $idevaluado ;?>" >

<?php
if (2024==$ano && 1==$periodo) {
	$desde='2024-02-01';
	$hasta='2024-07-31';
} else 	if (2023==$ano && 2==$periodo) {
	$desde='2023-08-01';
	$hasta='2024-01-31';
} else if (2023==$ano && 1==$periodo) {
	$desde='2023-02-01';
	$hasta='2023-07-31';
} else if (2022==$ano && 2==$periodo) {
	$desde='2022-08-01';
	$hasta='2023-01-31';
} else {
	$desde='';
	$hasta='';
}
?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Desde:</label> 
<input type="text" class="form-control datepicker"  name="desde" value="<?php echo $desde; ?>" readonly  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Hasta:</label> 
<input type="text" class="form-control  datepicker"  name="hasta" value="<?php echo $hasta; ?>" readonly  required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Evaluador:</label> 
 
<input type="text" class="form-control" value="<?php echo $_SESSION['snr_nombre']; ?>" name="evaluadorpredefinido" readonly >
<br>
Otro evaluador:  <input id="consultanombreevaluador" value="" style="width:200px;" placeholder="Buscar por nombre">
<button type="button" class="btn btn-xs btn-warning" id="nombreevaluador" title="Buscar">
<span class="glyphicon glyphicon-search"></span></button>
<!--name="id_evaluador"-->
<div id="resultadonombreevaluador">
</div>

</div>





<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Comisión evaluadora:</label> 
<input id="consultanombrecomision" value="" style="width:200px;" placeholder="Buscar por nombre" required>
<button type="button" class="btn btn-xs btn-warning" id="nombrecomision" title="Buscar">
<span class="glyphicon glyphicon-search"></span></button>
<div id="resultadonombrecomision">
</div>
</div>



<div class="modal-footer botonenviaredl" style="display:none;"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>






<div class="modal fade bd-example-modal-lg" id="popupcompro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Nuevo compromiso</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="respuestacompro" class="modal-body">

 <form action="" method="POST" name="form43134555" >
    
<input type="hidden" name="usereva" value="<?php echo $idevaluado; ?>">
    <div class="form-group text-left"> 
        <label  class="control-label">Meta del Área:</label>   
        <select class="form-control" name="id_metas_edl" required >
        <option value="" selected></option>
        <?php 
//$id_grupo_area=$_SESSION['snr_grupo_area'];
//echo listaparamentro('metas_edl', 'id_grupo_area', 'id_grupo_area', $id_grupo_area);

 $query = "SELECT * FROM metas_edl WHERE id_grupo_area=".$_SESSION['snr_grupo_area']." and vigencia=".$ano." and  estado_metas_edl=1 ";
   $result = $mysqli->query($query);
   while ($obj = $result->fetch_array()) {
echo '<option value="'.$obj['id_metas_edl'].'">'.$obj['nombre_metas_edl'].'</option>';
   }
   $result->free();
   

?>
<option value="167">No vinculado a las actividades del plan anual de gestión</option>		
<?php if (2==$_SESSION['snr_tipo_oficina']) {?>
<option value="168">Optimizar los servicios internos y externos de las ORIP de la jurisdicción, en búsqueda del mejoramiento del servicio registral.</option>				
<?php } else {} ?>  
</select>
	   
    </div>
    
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Compromiso Laboral:</label>   
        <textarea placeholder="Debe ser un parrafo, el verbo + objeto + la condiciòn del resultado." rows="5" cols="40" class="form-control"  name="nombre_compromiso_edl" required ></textarea>
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Peso Porcentual: (De 0 a 100)</label>   
     
	<input type="text" maxlength="2" class="form-control numero"  name="porcentaje"  value="" required >
	<input type="hidden" id="id_concertacion" name="id_concertacion_edl"  value=""  >
	
	</div>
	
	<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>

	
   </div>
    </div>
  </div>
</div>









<div class="modal fade " id="popupconcertacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog ">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Actualizar</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="respuestaconcertacion" class="modal-body">

   </div>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-lg" id="popupaceptar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Aceptación de concertación</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="respuestaaceptar" class="modal-body">

	
   </div>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-lg" id="popupeval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Evaluación</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="respuestaeval" class="modal-body">

	
   </div>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-lg" id="popupconfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Confirmar</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="respuestaconfirmar" class="modal-body">

	
   </div>
    </div>
  </div>
</div>





<div class="modal fade bd-example" id="popupreiniciar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Confirmar reinicio de aceptación, nota y aprobación</b><span style="font-weight: bold;"></span></h4>
</div> 
<form action="" method="POST" name="form43134354555" >
<input type="hidden" id="reinicio" name="reiniciar" value="">
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Confirmar reinicio </button>
</div>
</form>
    </div>
  </div>
</div>






<div class="modal fade bd-example" id="popupaprobar_compromiso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Confirmar reinicio aceptación</b><span style="font-weight: bold;"></span></h4>
</div> 
<form action="" method="POST" name="form43654343134354555" >
<input type="hidden" id="aprobar_compromiso" name="aprobar_compromiso" value="">
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Confirmar cambio de aceptación </button>
</div>
</form>
    </div>
  </div>
</div>


<?php 
}
} else { echo 'No tiene acceso.'; }
} ?>



