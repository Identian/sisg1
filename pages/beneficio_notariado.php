<?php
$nump62=privilegios(62,$_SESSION['snr']);
$nump63=privilegios(63,$_SESSION['snr']);
$nump64=privilegios(64,$_SESSION['snr']);
$nump105=privilegios(105,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 0<$nump62 or 0<$nump63 or 0<$nump64 or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) { 


if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) {
if (1==$_SESSION['rol']) {
$id_notaria=intval($_POST["id_notaria"]);
} else {
$id_notaria=intval($_SESSION['id_vigilado']);
}
} else {  }



global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}

function borrardocumentob($id_ben, $docb) {
global $mysqli;
$query88 = "UPDATE beneficio_notaria SET b".$docb."=NULL WHERE id_beneficio_notaria=".$id_ben." and id_analista is not null and estado_beneficio_notaria=1 limit 1";  
$result44 = $mysqli->query($query88);
return;
$result44->free();
}


function borrardocumentonotario($id_ben, $docb, $notaria) {
global $mysqli;
$query88 = "UPDATE beneficio_notaria SET b".$docb."=NULL WHERE id_beneficio_notaria=".$id_ben." and id_notaria=".$notaria." and id_analista is not null and estado_beneficio_notaria=1 limit 1";  
$result44 = $mysqli->query($query88);
return;
$result44->free();
echo '<meta http-equiv="refresh" content="0;url=./beneficio_notariado.jsp">';
}


function actualizarobservaciones($idbr1, $obsrev1, $obsdaf1) {
global $mysqli;
$query88 = "UPDATE beneficio_notaria SET observacion_revision='$obsrev1', observacion_daf='$obsdaf1' WHERE id_beneficio_notaria=".$idbr1."  and estado_beneficio_notaria=1 limit 1";  
$result44 = $mysqli->query($query88);
return;
$result44->free();
echo '<meta http-equiv="refresh" content="0;url=./beneficio_notariado.jsp">';
}

if (""!==$_POST["observacion_revision"] or ""!==$_POST["observacion_daf"])
{ 
$obsrev=$_POST["observacion_revision"];
$obsdaf=$_POST["observacion_daf"];
$idbr=intval($_POST["id_beneficio_notaria"]);
echo actualizarobservaciones($idbr, $obsrev, $obsdaf);
 } else { }
	


if (1==$_SESSION['rol'] && isset($_GET["i"]) && ""!=$_GET["i"]) {
$info=explode("-", $_GET["i"]);
$id_b=intval($info[0]);
$doc=intval($info[1]);
echo borrardocumentob($id_b, $doc);
} else {}


if (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'] && isset($_GET["i"]) && ""!=$_GET["i"]) {
$info=explode("-", $_GET["i"]);
$id_b=intval($info[0]);
$doc=intval($info[1]);
echo borrardocumentonotario($id_b, $doc, $id_notaria);
} else {}




function verpdf($filename) {
$namefile=explode("-", $filename);
$namef=$namefile[0];
if ('benNot'==$namef) {
//$namedocp='<img src="images/pdf.png">';
$namedocp='<span class="fa fa-file-pdf-o" style="color:#B40404;"></span>';
} else if ('actualizado'==$namef) {
$namedocp='<span class="fa fa-file-pdf-o" style="color:#00A4CC;"></span>';
} else { $namedocp=''; }
return $namedocp;
}
//style="width:40px;color:#008D4C;"


/*
if ((isset($_POST["mes_beneficio"])) && ($_POST["mes_beneficio"] != "") && (3==$_SESSION['snr_tipo_oficina'])) { 


$mes_beneficio=$_POST["mes_beneficio"];

$query = sprintf("SELECT count(id_beneficio_notaria) as tot FROM beneficio_notaria where id_notaria=".$id_notaria." and mes_beneficio='$mes_beneficio' and estado_beneficio_notaria=1"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
if (0<$row['tot']){ 
echo '<script type="text/javascript">swal(" ERROR !", " Ya se encuentra la Notaria con el mes seleccionado. !", "error");</script>';
	
} else {


$ruta_archivo = 'benNot-'.$_SESSION['snr'].'-'.date("YmdGis");

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$directoryftp="filesnr/beneficio_notariado/";

$archivo2 = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo2);
$tam_archivo3= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

if ($tamano_archivo>=intval($tam_archivo3)) {
	
if ('pdf'==$extension)  { 
  $filet = $ruta_archivo.'.pdf';
  $mover_archivos = move_uploaded_file($archivo2, $directoryftp.$filet);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);

$insertSQL = sprintf("INSERT INTO beneficio_notaria (
id_notaria, fecha_beneficio, mes_beneficio, b0, estado_beneficio_notaria) 
 VALUES (%s, now(), %s, %s, %s)", 
GetSQLValueString($id_notaria, "int"), 
GetSQLValueString($mes_beneficio, "text"),
 GetSQLValueString($filet, "text"), 
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;


  } else { 
  $filet='';
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
$filet='';
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
		}
		
		
}
mysql_free_result($select);
} else { }
	
	*/
	
	
if (isset($_POST['doc']) and (10>=intval($_POST['doc'])) and isset($_POST['idb']) and ""!=$_POST['idb'] and (3==$_SESSION['snr_tipo_oficina'] or 1==$_SESSION['rol']) ) {

$id_anexo=$_POST['doc'];
$idb=$_POST['idb'];

$ana=intval($_POST['analistasnr']);
if (1==$ana) {
$ruta_archivo = 'actualizado-'.$id_anexo.'-'.$_SESSION['snr'].'-'.date("YmdGis");
} else {
$ruta_archivo = 'benNot-'.$id_anexo.'-'.$_SESSION['snr'].'-'.date("YmdGis");
}

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$directoryftp="filesnr/beneficio_notariado/";

$archivo2 = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo2);
$tam_archivo3= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

if ($tamano_archivo>=intval($tam_archivo3)) {
	

//if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
if ('pdf'==$extension)  { 
  $filet = $ruta_archivo.'.pdf';
  $mover_archivos = move_uploaded_file($archivo2, $directoryftp.$filet);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  /*
 if (0==$id_anexo) {
$updateSQL = "UPDATE beneficio_notaria SET b0='$filet' WHERE id_beneficio_notaria=".$idb." and estado_beneficio_notaria=1";	 
 } else if (1==$id_anexo) {
$n_empleados_abril=$_POST['n_empleados_abril'];
$planilla_abril=$_POST['planilla_abril'];
$updateSQL = "UPDATE beneficio_notaria SET b1='$filet', n_empleados_abril=".$n_empleados_abril.", planilla_abril=".$planilla_abril." WHERE id_beneficio_notaria=".$idb." and estado_beneficio_notaria=1";	 
 } else if (2==$id_anexo){ 
$planilla_mes_anterior=$_POST['planilla_mes_anterior'];
$updateSQL = "UPDATE beneficio_notaria SET b2='$filet', planilla_mes_anterior=".$planilla_mes_anterior." WHERE id_beneficio_notaria=".$idb." and estado_beneficio_notaria=1";
  } else if (3==$id_anexo){ 
$n_empleados_mes=$_POST['n_empleados_mes'];
$updateSQL = "UPDATE beneficio_notaria SET b3='$filet', n_empleados_mes=".$n_empleados_mes." WHERE id_beneficio_notaria=".$idb."  and estado_beneficio_notaria=1";
   } else if (4==$id_anexo){ 
$nombre_contador=$_POST['nombre_contador'];
$cedula_contador=$_POST['cedula_contador'];
$tarjeta_contador=$_POST['tarjeta_contador'];
$updateSQL = "UPDATE beneficio_notaria SET b4='$filet', nombre_contador='$nombre_contador', cedula_contador=".$cedula_contador.", tarjeta_contador='$tarjeta_contador' WHERE id_beneficio_notaria=".$idb."  and estado_beneficio_notaria=1";
    } else if (5==$id_anexo){ 
$updateSQL = "UPDATE beneficio_notaria SET b5='$filet' WHERE id_beneficio_notaria=".$idb."  and estado_beneficio_notaria=1";
   } else if (6==$id_anexo){ 
$banco=$_POST['banco'];
$tipo_cuenta=$_POST['tipo_cuenta'];
$numero_cuenta=$_POST['numero_cuenta'];
$updateSQL = "UPDATE beneficio_notaria SET b6='$filet', banco='$banco', tipo_cuenta='$tipo_cuenta', numero_cuenta=".$numero_cuenta." WHERE id_beneficio_notaria=".$idb."  and estado_beneficio_notaria=1";
*/

//} else 
	if (9==$id_anexo){ 
$updateSQL = "UPDATE beneficio_notaria SET b9='$filet' WHERE id_beneficio_notaria=".$idb."  and estado_beneficio_notaria=1";
   
   
} else {}
 

	  $Result1 = mysql_query($updateSQL, $conexion);
	  mysql_free_result($Result1);
    echo $insertado;



$querya = sprintf("SELECT id_analista, nombre_notaria, mes_beneficio FROM notaria, beneficio_notaria where notaria.id_notaria=beneficio_notaria.id_notaria and id_analista is not null and id_beneficio_notaria=".$idb." and estado_beneficio_notaria=1 limit 1"); 
$selecta = mysql_query($querya, $conexion);
$rowa = mysql_fetch_assoc($selecta);
if (isset($rowa['id_analista'])) {
$correofuna=intval($rowa["id_analista"]);
$correoaviso=correofuncionario($correofuna);
//$correoaviso='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Documento actualizado / acuerdo 01 de 2020';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'><br>";
$cuerpo .= 'Vicky informa que se ha actualizado un documento reportado como NO apto en el marco del acuerdo 01 de 2020 - Notariado';
$cuerpo .= '<br><br>Notaria: '.$rowa["nombre_notaria"].', mes: '.$rowa["mes_beneficio"].', Documento N.: '.$id_anexo.'';
$cuerpo .='<br><br>Debe acceder a la dirección web:<br><br><a href="https://sisg.supernotariado.gov.co/beneficio_notariado.jsp">https://sisg.supernotariado.gov.co/beneficio_notariado.jsp</a>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($correoaviso,$subject,$cuerpo,$cabeceras);	
} else { }
mysql_free_result($selecta);

  } else { 
  $filet='';
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
$filet='';
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
		}
		

 } else {}
 
 


if (isset($_POST['doc']) and (7==intval($_POST['doc']) or 8==intval($_POST['doc'])) and isset($_POST['idb']) and ""!=$_POST['idb'] && 1==$_SESSION['rol']) {

$id_anexo=$_POST['doc'];
$idb=$_POST['idb'];

 if (7==$id_anexo){ 
$confirmacion=$_POST['confirmacion'];
$updateSQLr = "UPDATE beneficio_notaria SET confirmacion='$confirmacion' WHERE id_beneficio_notaria=".$idb."  and estado_beneficio_notaria=1";
} else if (8==$id_anexo){ 
$daf=$_POST['daf'];
$updateSQLr = "UPDATE beneficio_notaria SET daf='$daf' WHERE id_beneficio_notaria=".$idb."  and estado_beneficio_notaria=1";
 } else {}
$Result1r = mysql_query($updateSQLr, $conexion);
mysql_free_result($Result1r);
$insertado;
 } else {}
 
 
 
 
 
 

if (isset($_POST["rev"]) && (1==$_SESSION['rol'] or 0<$nump105)) {
	
$idbr=intval($_POST["rev"]);
	
$querya = sprintf("SELECT fecha_envio_rev FROM beneficio_notaria where id_beneficio_notaria=".$idbr." and estado_beneficio_notaria=1 limit 1"); 
$selecta = mysql_query($querya, $conexion);
$rowa = mysql_fetch_assoc($selecta);
if (isset($rowa['fecha_envio_rev']) && ""!=$rowa['fecha_envio_rev']) {
/*	
$updateSQL444 = sprintf("UPDATE beneficio_notaria SET nombre_beneficio_notaria=%s, 
 rb0=%s, rb1=%s, rb2=%s, rb3=%s, rb4=%s, rb5=%s, rb6=%s, rb9=%s 
 where id_beneficio_notaria=%s",
 GetSQLValueString($_POST["nombre_beneficio_notaria"], "text"), 
 GetSQLValueString($_POST["rb0"], "text"), 
 GetSQLValueString($_POST["rb1"], "text"), 
 GetSQLValueString($_POST["rb2"], "text"), 
 GetSQLValueString($_POST["rb3"], "text"), 
 GetSQLValueString($_POST["rb4"], "text"), 
 GetSQLValueString($_POST["rb5"], "text"), 
 GetSQLValueString($_POST["rb6"], "text"), 
 GetSQLValueString($_POST["rb9"], "text"), 
 GetSQLValueString($idbr, "int"));
$Result44 = mysql_query($updateSQL444, $conexion);
*/
$updateSQL444 = sprintf("UPDATE beneficio_notaria SET rb9=%s 
 where id_beneficio_notaria=%s",
 
 GetSQLValueString($_POST["rb9"], "text"), 
 GetSQLValueString($idbr, "int"));
$Result44 = mysql_query($updateSQL444, $conexion);

	
} else {
	
	
$updateSQL444 = sprintf("UPDATE beneficio_notaria SET rb9=%s, fecha_envio_rev=now() 
 where id_beneficio_notaria=%s", 
 GetSQLValueString($_POST["rb9"], "text"), 
 GetSQLValueString($idbr, "int"));
$Result44 = mysql_query($updateSQL444, $conexion);

}
echo $insertado;



if ('No'==$_POST["rb9"] or 'No'==$_POST["rb6"] or 'No'==$_POST["rb5"] or 'No'==$_POST["rb4"] or 'No'==$_POST["rb3"] or 'No'==$_POST["rb2"] or 'No'==$_POST["rb1"]) {

$mensaje= 'Observación: '.$_POST["nombre_beneficio_notaria"]; 
$emailu=$_POST["emailn"]; 
//$emailu='giovanni.ortegon@supernotariado.gov.co'; 
$subject = 'Resultado de la aplicación del Decreto 805 de 2020';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'><br>";
$cuerpo .= '<br>La Superintendencia de Notariado y Registro informa que al menos uno de los documentos anexados en el marco del decreto 805 de 2020 no cumple con las caracteristicas solicitadas. El siguiente listado enuncia el resultado con Si (Valido) y con No (No valido):<br><br>';
$cuerpo .= 'Formulario de solicitud en formato PDF: ';
/*$cuerpo .= '<b>'.$_POST["rb0"].'</b><br><br>ANEXOS:<br><br>';
$cuerpo .= '1. Constancia de pago al Sistema General del Seguridad Social, de la Planilla Integrada de Liquidación de Aportes (PILA) correspondiente al mes de abril de 2020: ';
$cuerpo .= '<b>'.$_POST["rb1"].'</b><br><br>';
$cuerpo .= '2. Constancia de pago al Sistema General del Seguridad Social, según la Planilla Integrada de Liquidación de Aportes (PILA) correspondiente al mes inmediatamente anterior a aquel para el cual se solicita el apoyo: ';
$cuerpo .= '<b>'.$_POST["rb2"].'</b><br><br>';
$cuerpo .= '3. Certificación emitida por el suscrito, en la que señalo el número de empleados dependientes que se mantendrán durante el mes correspondiente al otorgamiento del subsidio: ';
$cuerpo .= '<b>'.$_POST["rb3"].'</b><br><br>';
$cuerpo .= '4. Certificación emitida por contador público en la que señala que los recursos del beneficio económico otorgados en el mes anterior, fueron destinados en su integridad al pago de las obligaciones laborales de los empleados de la notaría (para la segunda solicitud en adelante): '; 
$cuerpo .= '<b>'.$_POST["rb4"].'</b><br><br>';
$cuerpo .= '5. Copia de los comprobantes de pago de nómina a los empleados relacionados en la Planilla Integrada de Liquidación de Aportes (PILA) correspondiente al mes  inmediatamente anterior a aquel para el cual se solicita se otorgue el beneficio: ';
$cuerpo .= '<b>'.$_POST["rb5"].'</b><br><br>';
$cuerpo .= '6. Certificado de cuenta bancaria a nombre del notario titular que se postula: ';
$cuerpo .= '<b>'.$_POST["rb6"].'</b><br><br>';
*/
$cuerpo .= '7. Certificado del contador Público: ';
$cuerpo .= '<b>'.$_POST["rb9"].'</b><br><br>';

$cuerpo .= '<br>'.$mensaje.''; 
$cuerpo .='<br><br>Puede volver a anexar dichos documentos antes de 3 dias hábiles desde la primera revisión mediante la dirección web:<br><br><a href="https://sisg.supernotariado.gov.co/beneficio_notariado.jsp">https://sisg.supernotariado.gov.co/beneficio_notariado.jsp</a>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';

$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);


/*
 if ('No'==$_POST["rb0"]) {
$updateSQL5 = "UPDATE beneficio_notaria SET b0=NULL WHERE id_beneficio_notaria=".$idbr." and estado_beneficio_notaria=1";	 
 } else {} 
 if ('No'==$_POST["rb1"]) {
$updateSQL5 = "UPDATE beneficio_notaria SET b1=NULL WHERE id_beneficio_notaria=".$idbr." and estado_beneficio_notaria=1";	 
 } else {} 
 if ('No'==$_POST["rb2"]){ 
$updateSQL5 = "UPDATE beneficio_notaria SET b2=NULL WHERE id_beneficio_notaria=".$idbr." and estado_beneficio_notaria=1";
  } else  {} 
  if ('No'==$_POST["rb3"]){ 
$updateSQL5 = "UPDATE beneficio_notaria SET b3=NULL WHERE id_beneficio_notaria=".$idbr."  and estado_beneficio_notaria=1";
   } else {} 
   if ('No'==$_POST["rb4"]){ 
$updateSQL5 = "UPDATE beneficio_notaria SET b4=NULL WHERE id_beneficio_notaria=".$idbr."  and estado_beneficio_notaria=1";
    } else {} 
	if ('No'==$_POST["rb5"]){ 
$updateSQL5 = "UPDATE beneficio_notaria SET b5=NULL WHERE id_beneficio_notaria=".$idbr."  and estado_beneficio_notaria=1";
   } else {} 
   if ('No'==$_POST["rb6"]){ 
$updateSQL5 = "UPDATE beneficio_notaria SET b6=NULL WHERE id_beneficio_notaria=".$idbr."  and estado_beneficio_notaria=1";
} else {}
 */
 
if ('No'==$_POST["rb9"]){ 
$updateSQL5 = "UPDATE beneficio_notaria SET b9=NULL WHERE id_beneficio_notaria=".$idbr."  and estado_beneficio_notaria=1";
} else {}

	 
	  $Result15 = mysql_query($updateSQL5, $conexion);
	  mysql_free_result($Result15);
	 
/*
if ('No'==$_POST["rb0"]){ echo borrardocumentob($idbr, 0); } else { }
if ('No'==$_POST["rb1"]){ echo borrardocumentob($idbr, 1); } else { }
if ('No'==$_POST["rb2"]){ echo borrardocumentob($idbr, 2); } else { }
if ('No'==$_POST["rb3"]){ echo borrardocumentob($idbr, 3); } else { }
if ('No'==$_POST["rb4"]){ echo borrardocumentob($idbr, 4); } else { }
if ('No'==$_POST["rb5"]){ echo borrardocumentob($idbr, 5); } else { }
if ('No'==$_POST["rb6"]){ echo borrardocumentob($idbr, 6); } else { }
*/
if ('No'==$_POST["rb9"]){ echo borrardocumentob($idbr, 9); } else { }
	 
}	  

}



if (isset($_POST["id_analista"]) && ""!=$_POST["id_analista"] && 
isset($_POST["asignacion"]) && ""!=$_POST["asignacion"] && 1==$_SESSION['rol']) {
$asignacion=intval($_POST["asignacion"]);
$correofun=intval($_POST["id_analista"]);

$updateSQL5a = "UPDATE beneficio_notaria SET id_analista=".$correofun." WHERE id_beneficio_notaria=".$asignacion." and id_analista is null and estado_beneficio_notaria=1";
$Result15a = mysql_query($updateSQL5a, $conexion);
mysql_free_result($Result15a);
echo $insertado;

$correofuncionario=correofuncionario($correofun);
$subject = 'Asignación de revisión';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'><br>";
$cuerpo .= 'Vicky informa que se ha asignado una nueva revisión de documentos en el marco del acuerdo 01 de 2020 - Notariado';
$cuerpo .='<br><br>Debe acceder a la dirección web:<br><br><a href="https://sisg.supernotariado.gov.co/beneficio_notariado.jsp">https://sisg.supernotariado.gov.co/beneficio_notariado.jsp</a>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>'; 
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($correofuncionario,$subject,$cuerpo,$cabeceras);
	
} else {}

?>  
<style>
.fa-folder-open {color:#B40404;}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Apoyo económico para Notarios</h3>
Documentos asociados: <a href="documentos/acuerdo01.pdf" target="_blank">Acuerdo 01 de 2020</a> &nbsp; / &nbsp;    
<a href="documentos/abc-notariado.pdf" target="_blank">ABC del Decreto 805/2020</a>&nbsp;  /  &nbsp; 
<a href="https://www.youtube.com/watch?v=xldthbnab5E" target="_blank">Manual del módulo</a>
<?php if (1==$_SESSION['snr_tipo_oficina']) { ?>
/  &nbsp;  <a href="apoyo_notariado.jsp" target="_blank">Tablero de control</a>
<?php } else {} ?>

				<br>





<div class="box-header with-border">


	<div class="row">
	
	
	
	<div class="col-md-2">
	
<?php	
$fecha_actual = strtotime($realdate);
$fecha_limite = strtotime("2020-08-18");
/*
if($fecha_actual > $fecha_limite)
	{
	echo '';
	} else { */
	
	

//if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) { 
	//echo '<button class="btn btn-success"  data-toggle="modal" data-target="#popupcorrespondencia"><span class="glyphicon glyphicon-file"></span> Nuevo </button> ';
 //} else {} 
	//}
 ?>
		</div>
		
		
		<div class="col-md-5">
		<?php if (3==$_SESSION['snr_tipo_oficina']) { 
		echo 'Debe anexar cada documento utilizando el icono de la carpeta en color rojo. <i class="fa fa-folder-open" ></i>';
		} else { ?>
			<form class="navbar-form" name="fotertrm3252345rter1erteg" method="POST"  enctype="multipart/form-data">

				<div class="input-group">
					<div class="input-group-btn">Buscar 
						<select class="form-control" name="campo" required>
							<option value="" selected> - - Buscar por: - -  </option>
							<option value="mes_beneficio">Mes</option>
							<option value="nombre_notaria">Notaria</option>
						</select>
					</div>
					<div class="input-group-btn">
						<input type="text" name="buscar" placeholder="Buscar" class="form-control" required ></div>

						<div class="input-group-btn">
							<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
						</div>
					</div>

				</form>
		<?php } ?>
		</div>
	
	
	
	
				<div class="col-md-5">
			<?php if (3==$_SESSION['snr_tipo_oficina']) { 
		echo 'Debe confirmar el envio de la solicitud una vez adjunte todos los documentos solicitados.';
		} else { 

		if (0<$nump63 or 1==$_SESSION['rol']) { ?>
				<form class="navbar-form" name="formatobuscar2" method="POST">
					
						<div class="input-group">
						
							<div class="input-group-btn">Buscar 
								<select class="form-control" name="campo2" required>
								<option value="" selected> - - Funcionario responsable: - -  </option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and id_perfil=62 and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion);
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {
							echo '<option value="'.$rowop['id_funcionario'].'" ';
							echo '>'.$rowop['nombre_funcionario'].'</option>';
							
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>	
								</select>
							</div>

							

							<div class="input-group-btn">
								<button type="submit" class="btn btn-warning" name="btnbuscar2" value="1"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
							</div>
						</div>
				</form> 
		<?php } else {}
		}?>
			</div>
	
	
	
	
	</div>



<!-- FINAL box-tools pull-right -->
</div>




<style>
.dataTables_filter {
		display:none;
	}

.letrapeq {
	font-size:4px;
	color:#fff;
}



</style> 


<div class="box-body">
	<div class="table-responsive">


<table  class="table table-striped table-bordered table-hover" id="inforesoluciones" cellspacing="0" width="100%">
<thead>
<tr align="center" valign="middle">
<?php if (3==$_SESSION['snr_tipo_oficina']) { } else { ?>
<th></th>
<?php } ?>
<th>Notaria</th><th>Mes</th><th title="Solicitud">Sol.</th><th title="Revisión de la Solicitud">RevSol</th><th>Doc 1</th><th>Rev 1</th><th>Doc 2</th><th>Rev 2</th>
<th>Doc 3</th><th>Rev 3</th><th>Doc 4</th><th>Rev 4</th><th>Doc 5</th><th>Rev 5</th>



<th title="Certificado del Contador Público.">Cert. Contador</th>
<th title="Revisión del Certificado del Contador Público.">Rev. Cert. Cont.</th>




<th>Doc 6</th>



<th>N cuenta</th>

<th>Rev 6</th><th title="Confirmación">Confirmación</th>
<th>Info.</th>
<?php if (3==$_SESSION['snr_tipo_oficina']) { } else { ?>
<th>Cert. DAF</th>
<th title="Revisión y Analisis">Revisión</th>
<th title="Resultado de documentos">ResDoc</th>
<th title="Resultado completo. Documentos y DAF">ResCompleto</th>
<?php } ?>
</tr>
</thead><tbody>
	



<?php
$si='Si <span class="fa fa-check" style="color:#398439"></span>';
$no='No <span class="fa fa-close" style="color:#B40404"></span>';



if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";	
$mese= "";
} else {  
$infobus=""; 
if (3==$_SESSION['snr_tipo_oficina']) {
$mese= "";
} else {
$mese= " and mes_beneficio not in ('Junio') ";
//$mese= " and mes_beneficio not in ('Junio', 'Julio', 'Agosto') ";	
}
}

if (isset($_POST['campo2']) && ""!=$_POST['campo2']) {
$id_fun_res=intval($_POST['campo2']);
$infofun=" and beneficio_notaria.id_analista=".$id_fun_res." ";
} else {
$infofun="";
}


if (0<$nump62) {
$id_funcionario=intval($_SESSION['snr']);
if (0<$nump63) { 
$infofuncionario=""; 
} else {
$infofuncionario=" and beneficio_notaria.id_analista=".$id_funcionario." ";
}
} else {
$infofuncionario="";
}




if (0<$nump105) {
$infocontador=" and beneficio_notaria.analista_b9=".$_SESSION['snr']." ";
} else {
$infocontador="";
}




if (3==$_SESSION['snr_tipo_oficina']) {
	$id_notaria=$_SESSION['id_vigilado'];
	$notaria=" and beneficio_notaria.id_notaria=".$id_notaria." ";
} else {
	$notaria="";
}
							
$query = "SELECT * FROM notaria, beneficio_notaria   
WHERE 
beneficio_notaria.id_notaria=notaria.id_notaria 
AND estado_notaria=1 
AND estado_beneficio_notaria=1 
".$infobus." ".$infofun." ".$notaria." ".$infofuncionario." ".$mese." ".$infocontador." order by id_beneficio_notaria desc";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$nn = mysql_num_rows($select);
if (0<$nn) {
do {
	$idb=$row['id_beneficio_notaria'];
	
if (isset($row['fecha_envio_rev'])) {
$fechaf=$row['fecha_envio_rev'];
$fechaf2 = date('Y-m-d', strtotime($fechaf));
$fecha_ven=fechahabil($fechaf2,3);
$fecha_vence='<span style="font-size:10px;">'.$fecha_ven.'</span>';
} else {
$fecha_vence='';
}



echo '<tr>';
if (3==$_SESSION['snr_tipo_oficina']) { } else {
echo '<td>';

echo '<span class="letrapeq">'.$idb.'</span><a href="auditoria&'.$idb.'.jsp" target="_blank">Auditar</a>';
echo '</td>';

}
echo '<td><a href="notaria&'.$row['id_notaria'].'.jsp" target="_blank">'.$row['nombre_notaria'].'</a><br>';
echo ''.$row['fecha_beneficio'].'</td>';
echo '<td>'.$row['mes_beneficio'].'</td>';
echo '<td>';
if (isset($row['b0'])) {
echo '<a href="filesnr/beneficio_notariado/'.$row['b0'].'" download>';
echo verpdf($row['b0']);
echo '</a>';
if ((1==$_SESSION['rol']  or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) && 'No'==$row['rb0']) { echo ' <a href="beneficio_notariado&'.$idb.'-0.jsp" class="confirmationdel" title="Borrar documento" style="color:#000;"><span class="fa fa-trash-o"></span></a>';	} else {}
} else {
echo '<a href="" id="'.$idb.'-0" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><i class="fa fa-folder-open" ></i></a>';
}
echo '</td><td>';
if (isset($row['rb0'])) {
	if ('Si'==$row['rb0']) {
echo $si;
} else {
echo $no;
}
} else {
echo 'R.';
}
echo '</td><td>';
if (isset($row['b1'])) {
echo 'Ok <a href="filesnr/beneficio_notariado/'.$row['b1'].'" target="_blank">';
echo verpdf($row['b1']);
echo '</a>';
if ((1==$_SESSION['rol']  or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) && 'No'==$row['rb1']) { echo ' <a href="beneficio_notariado&'.$idb.'-1.jsp" class="confirmationdel" title="Borrar documento" style="color:#000;"><span class="fa fa-trash-o"></span></a>';	} else {}

} else {
echo '<a href="" id="'.$idb.'-1" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><i class="fa fa-folder-open" ></i></a>';
}
echo '</td><td>';
if (isset($row['rb1'])) {
	if ('Si'==$row['rb1']) {
echo $si;
} else {
echo $no;
}
} else {
echo 'R.';
}
echo '</td>';

echo '<td>';
if (isset($row['b2'])) {
echo 'Ok <a href="filesnr/beneficio_notariado/'.$row['b2'].'" target="_blank">';
echo verpdf($row['b2']);
echo '</a>';
if ((1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) && 'No'==$row['rb2']) { echo ' <a href="beneficio_notariado&'.$idb.'-2.jsp" class="confirmationdel" title="Borrar documento" style="color:#000;"><span class="fa fa-trash-o"></span></a>';	} else {}

} else {
echo '<a href="" id="'.$idb.'-2" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><i class="fa fa-folder-open" ></i></a>';
}
echo '</td><td>';
if (isset($row['rb2'])) {
	if ('Si'==$row['rb2']) {
echo $si;
} else {
echo $no;
}
} else {
echo 'R.';
}
echo '</td>';

echo '<td>';
if (isset($row['b3'])) {
echo 'Ok <a href="filesnr/beneficio_notariado/'.$row['b3'].'" target="_blank">';
echo verpdf($row['b3']);
echo '</a>';
if ((1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) && 'No'==$row['rb3']) { echo ' <a href="beneficio_notariado&'.$idb.'-3.jsp" class="confirmationdel" title="Borrar documento" style="color:#000;"><span class="fa fa-trash-o"></span></a>';	} else {}

} else {
echo '<a href="" id="'.$idb.'-3" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><i class="fa fa-folder-open" ></i></a>';
}
echo '</td><td>';
if (isset($row['rb3'])) {
	if ('Si'==$row['rb3']) {
echo $si;
} else {
echo $no;
}
} else {
echo 'R.';
}
echo '</td>';


echo '<td>';
if (isset($row['b4'])) {
echo 'Ok <a href="filesnr/beneficio_notariado/'.$row['b4'].'" target="_blank">';
echo verpdf($row['b4']);
echo '</a>';
if ((1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) && 'No'==$row['rb4']) { echo ' <a href="beneficio_notariado&'.$idb.'-4.jsp" class="confirmationdel" title="Borrar documento" style="color:#000;"><span class="fa fa-trash-o"></span></a>';	} else {}

} else {
echo '<a href="" id="'.$idb.'-4" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><i class="fa fa-folder-open" ></i></a>';
}
echo '</td><td>';
if (isset($row['rb4'])) {
	if ('Si'==$row['rb4']) {
echo $si;
} else {
echo $no;
}
} else {
echo 'R.';
}
echo '</td>';



echo '<td>';
if (isset($row['b5'])) {
echo 'Ok <a href="filesnr/beneficio_notariado/'.$row['b5'].'" target="_blank">';
echo verpdf($row['b5']);
echo '</a>';
if ((1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) && 'No'==$row['rb5']) { echo ' <a href="beneficio_notariado&'.$idb.'-5.jsp" class="confirmationdel" title="Borrar documento" style="color:#000;"><span class="fa fa-trash-o"></span></a>';	} else {}

} else {
echo '<a href="" id="'.$idb.'-5" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><i class="fa fa-folder-open" ></i></a>';
}
echo '</td><td>';
if (isset($row['rb5'])) {
	if ('Si'==$row['rb5']) {
echo $si;
} else {
echo $no;
}
} else {
echo 'R.';
}
echo '</td>';





echo '<td>';
//if( 'Junio'==$row['mes_beneficio'])  { } else {

$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);

$fecha_inicio = strtotime("2021-11-05 08:00:00");
$fecha_limite = strtotime("2021-11-09 23:59:59");


	//if($fecha_actual < $fecha_limite) {


if( 'Si'==$row['confirmacion'])  {


if (isset($row['b9'])) {
echo 'Ok <a href="filesnr/beneficio_notariado/'.$row['b9'].'" target="_blank">';
echo verpdf($row['b9']);
echo '</a>';
/*if ((1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) && 'No'==$row['rb5']) 
{ echo ' <a href="beneficio_notariado&'.$idb.'-9.jsp" class="confirmationdel" title="Borrar documento" style="color:#000;"><span class="fa fa-trash-o"></span></a>';
	} else {}*/

} else {
//echo '<a href="" id="'.$idb.'-9" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><i class="fa fa-folder-open" ></i></a>';
}
echo '</td><td>';
if (isset($row['rb9'])) {
	if ('Si'==$row['rb9']) {
echo $si;
} else {
echo $no;
}
} else {
echo 'R.';
}


} else {  }

//	} else {}
//}
echo '</td>';


 


echo '<td>';
if (isset($row['b6'])) {
echo 'Ok <a href="filesnr/beneficio_notariado/'.$row['b6'].'" target="_blank">';
echo verpdf($row['b6']);
echo '</a>';
if ((1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo'])) && 'No'==$row['rb6']) { echo ' <a href="beneficio_notariado&'.$idb.'-6.jsp" class="confirmationdel" title="Borrar documento" style="color:#000;"><span class="fa fa-trash-o"></span></a>';	} else {}

} else {
echo '<a href="" id="'.$idb.'-6" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><i class="fa fa-folder-open" ></i></a>';
}
echo '</td>';

echo '<td>';
echo $row['numero_cuenta'];
echo '</td>';

echo '<td>';
if (isset($row['rb6'])) {
	if ('Si'==$row['rb6']) {
echo $si;
} else {
echo $no;
}
} else {
echo 'R.';
}
echo '</td>';



 


echo '<td>';
if (isset($row['confirmacion'])){
if( 'Si'==$row['confirmacion'])  {
echo $si.'';
} else {
echo $no.'';
} } else {
	echo 'No confirmo';
//echo '<a href="" id="'.$idb.'-7" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><button class="btn btn-xs btn-success">Enviar</button></a>';
}
echo '</td>';





echo '<td>';
echo '<a href="" id="'.$idb.'" data-toggle="modal" data-target="#popuprev_observacion" class="buscar_rev_observacion"><button class="btn btn-xs btn-info"><i class="fa fa-file"></i></button></a>';
echo '</td>';



if (3==$_SESSION['snr_tipo_oficina']) { } else {
echo '<td>';
if (isset($row['daf']) && ""!=$row['daf']) {	
if ('Si'==$row['daf']) {
echo $si.'';
} else {
echo $no.'';
}
} else {
if ((0<$nump64 or 1==$_SESSION['rol']) && ('Si'==$row['confirmacion'])) {
echo '<a href="" id="'.$idb.'-8" data-toggle="modal" data-target="#popupbeneficio" class="buscar_beneficio"><button class="btn btn-xs btn-warning"><i class="fa fa-bank"></i></button></a>';
	} else { echo 'R.'; }
}
echo '</td>';


echo '<td>';


if (isset($row['id_analista'])) {
echo 'A ';
} else { 
if ((0<$nump63 or 1==$_SESSION['rol']) && ('Si'==$row['confirmacion'])) {
echo 'F <a href="" id="'.$idb.'" title="'.$idb.'" data-toggle="modal" data-target="#popuprev_asignacion" class="buscar_rev_asignacion"><button class="btn btn-xs btn-success"><i class="fa fa-user"></i></button></a>';
} else { echo ''; }
}

if ((0<$nump63 or 1==$_SESSION['rol']) && ('Si'==$row['confirmacion']))  {   
	
echo '<a  href="" id="'.$idb.'"  data-toggle="modal" data-target="#popuprev_beneficio_nota" class="buscar_rev_beneficio_nota"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button></a>';
} else { echo ''; }

echo '</td>';



echo '<td>';
if (('Si'==$row['rb0']) && ('Si'==$row['rb1']) && ('Si'==$row['rb2']) && ('Si'==$row['rb3']) && ('Si'==$row['rb4']) && ('Si'==$row['rb5']) && ('Si'==$row['rb6']) && 'Si'==$row['confirmacion']) {
echo $si;
} else {
echo $no;
}
echo '</td>';


echo '<td>';
if (('Si'==$row['rb0']) && ('Si'==$row['rb1']) && ('Si'==$row['rb2']) && ('Si'==$row['rb3']) && ('Si'==$row['rb4']) && ('Si'==$row['rb5']) && ('Si'==$row['rb6']) && 'Si'==$row['confirmacion'] && 'Si'==$row['daf']) {
echo $si;
} else {
echo $no;
}
echo '</td>';





}


echo '</tr>';


					} while ($row = mysql_fetch_assoc($select)); 
					
} else {}
					mysql_free_result($select);

					?>
				</tbody>

			</table>

			<script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						}
					});
				});
				
			//	,						"aaSorting": [[ 1, "desc"]]
			
		
				
			</script>				
		</div>


	</div>




</div>
</div>
</div>
</div>





<div class="modal fade" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Solicitud de beneficio</label> <span id="radicor"></span></h4>
			<b>Recuerde que el proceso inicia una vez sean cargados todos los documentos.</b>
			</div> 
			<div class="modal-body"> 

<form action="" method="POST" name="for545m1" enctype="multipart/form-data">
<?php if (1==$_SESSION['rol']) { ?>
<div class="form-group text-left"> 
<label  class="control-label">Notaria de prueba:</label> 
<select  class="form-control" name="id_notaria" required>
<option value=""></option>
	<?php				
					$queryop = sprintf("SELECT * FROM notaria order by nombre_notaria");
					$selectop = mysql_query($queryop, $conexion);
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {
							echo '<option value="'.$rowop['id_notaria'].'" ';
							echo '>'.$rowop['nombre_notaria'].'</option>';
							
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>	
</select>
</div>
<?php } else {} ?>


<script>


function fileValidation(){
    var fileInput = document.getElementById('filel');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension .pdf.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
</script>
<div class="form-group text-left"> 
<label  class="control-label">Formulario de solicitud en formato PDF. <a href="documentos/anexo1.pdf" target="_blank">(Descargar anexo 1)</a></label> 
<input type="file" title="Solo PDF" id="filel" onchange="return fileValidation()" name="file" required class="form-control">
</div>
<div id="imagePreview"></div>


<div class="form-group text-left"> 
<label  class="control-label">Mes del beneficio al que quiere aplicar:</label> 
<select class="form-control" name="mes_beneficio"  >
<option value="" selected></option>
<option value="Septiembre">Septiembre</option>
</select>
</div>

<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div></form>



			</div>
		</div> 
	</div> 
</div> 




<div class="modal fade" id="popupbeneficio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Documentos Asociados</label></h4>
			</div> 
			<div class="ver_beneficio" class="modal-body"> 

			</div>
		</div> 
	</div> 
</div> 






<div class="modal fade bd-example-modal-lg" id="popuprev_beneficio_nota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Revisión</label></h4>
			</div> 
			<div class="ver_revbeneficio_nota" class="modal-body"> 


			</div>
		</div> 
	</div> 
</div>


<div class="modal fade" id="popuprev_asignacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Asignación</label></h4>
			</div> 
			<div class="ver_asignacion" class="modal-body"> 


			</div>
		</div> 
	</div> 
</div>




<div class="modal fade" id="popuprev_observacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Observación de la Notaria</label></h4>
			</div> 
			<?php
			if (1==$_SESSION['rol'] or 0<$nump62 or 0<$nump63 or 0<$nump64) { 
?>
			<div class="ver_observacion" class="modal-body"> 


			</div>
			<?php } else {} ?>
		</div> 
	</div> 
</div>





<?php } else { echo 'No tiene acceso'; }
//}
?>









