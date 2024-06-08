<?php

  
$hora= date("H");
/*
if (18<=$hora) {
$updateSQL76 = "UPDATE configuracion SET valor=0 WHERE id_configuracion=14";
$Result176 = mysql_query($updateSQL76, $conexion);
mysql_free_result($Result176);
} else {}*/


if (1==$_SESSION['snr_tipo_oficina']) {

//echo $_SESSION['username_iris'];
$actualizar6 = mysql_query("SELECT valor FROM configuracion WHERE id_configuracion=14 limit 1", $conexion);
$row16 = mysql_fetch_assoc($actualizar6);
$valor = $row16['valor'];

if (0==$valor) { ?>
<div class="row">
<div class="col-md-12" >
<div class="panel panel-default">
  <div class="panel-body">
<h4>El sistema de gestión documental se encuentra en mantenimiento. Lamentamos el inconveniente.</h4>
<br>		
</div>
</div>
</div>
</div>
<?php
} else {
	 

	

require_once('pages/listas.php');
$nump36=privilegios(36,$_SESSION['snr']);

if ("0"!=$_SESSION['username_iris']) {
$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {	 
$username_iris=$_SESSION['username_iris'];
$queryi = "SELECT idusuario, nombre, apellido FROM usuario where username='$username_iris' limit 1"; 
$resultadoi = pg_query ($queryi);
$num_resultadosi = pg_num_rows ($resultadoi);	 
for ($i=0; $i<$num_resultadosi; $i++)
   {
$rowi = pg_fetch_array ($resultadoi);
$id_iris=$rowi['idusuario'];
$_SESSION['idiris']=$id_iris;
$nombre_iris=$rowi['nombre'];
$apellido_iris=$rowi['apellido'];
 }

$nombrec_iris=$nombre_iris.' '.$apellido_iris;

  pg_free_result($resultadoi);
  }
  pg_close($conexionpostgresql);  
  
} else { }
  
  
  
  
  

if ((isset($_POST["asunto_correspondencia"])) && ("" != $_POST["asunto_correspondencia"] ) && isset($_POST["para"]) && ""!=$_POST["para"] && "0"!=$_SESSION['username_iris']) { 




if ($_POST["parados"]==$_POST["para"]){
$para=$_POST["para"];
$paraint=$_POST["paraint"];
} else {
$para=$_POST["para"];
$paraint='1642';
}




  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 
	 


	 
$id_tipo_correspondencia=$_POST["id_tipo_correspondencia"];	 
	 
$id_tipo_documento=$_POST["id_tipo_documento"];
	 
if (('ER'==$id_tipo_correspondencia) && (0<$nump36 or 1==$_SESSION['rol'] or 40==$_SESSION['snr_grupo_area']) ) {
$id_iris='1642';
$nombrec_iris=$_POST['de'];
$recibida='true';
$interno='false';
$idestado=8;
$ruta_archivo = '3-'.$_SESSION['snr'].'-'.date("YmdGis");
} else if ('IE'==$id_tipo_correspondencia) {
$recibida='false';
$interno='true';	
$idestado=20;
$ruta_archivo = '1-'.$_SESSION['snr'].'-'.date("YmdGis");
} else if ('EE'==$id_tipo_correspondencia) {
$recibida='false';
$interno='false';
$idestado=15;
$ruta_archivo = '2-'.$_SESSION['snr'].'-'.date("YmdGis");
} else { }
	 
	 
$anoiris=date("Y");
$infoiris='SNR'.$anoiris.$id_tipo_correspondencia;
$query = "SELECT codigo FROM correspondencia where codigo like '%$infoiris%' order by idcorrespondencia desc limit 1"; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$info2iris=$row['codigo'];
 }


$info3iris=explode($anoiris.$id_tipo_correspondencia, $info2iris);
$info4iris=intval($info3iris[1]);
$info5iris=$info4iris+1;
$info6iris = trim(substr('000000'.$info5iris,-6));
$radicado_salida='SNR'.$anoiris.$id_tipo_correspondencia.$info6iris;


$fechairis=date("Y-m-d H:i:s");
$fechaenvio=date("Y-m-d ").'00:00:00';


$textoiris4=strip_tags($_POST["descripcion_correspondencia"]);
$string = preg_replace("/[\r\n|\n|\r]+/", " ", $textoiris4);

$textoiris=$_POST["asunto_correspondencia"].': '.$string.' - '.$files;

$consultab = sprintf("INSERT INTO correspondencia (
idcorreoprioridad, 
idtipodocumento, 
codigo, 
referencia, 
asunto, 
idestado, 
idcorreovia, 
recibida, 
interna, 
deint, 
de, 
paraint, 
para,  
folios, 
anexos, 
contenido, 
fechaenvio, 
fecharecepcion, 
descripcion, 
creado, 
fcreado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString('1', "text"), 
GetSQLValueString($id_tipo_documento, "text"), 
GetSQLValueString($radicado_salida, "text"), 
GetSQLValueString($_POST["referencia"], "text"), 
GetSQLValueString($_POST["asunto_correspondencia"], "text"), 
GetSQLValueString($idestado, "text"), 
GetSQLValueString($_POST["idcorreovia"], "int"), 
GetSQLValueString($recibida, "text"), 
GetSQLValueString($interno, "text"), 
GetSQLValueString('5,'.$id_iris.' ', "text"), 
GetSQLValueString($nombrec_iris.' [USUARIO]', "text"), 
GetSQLValueString('5,'.$paraint.' ', "text"), 
GetSQLValueString($para.' / ', "text"), 
GetSQLValueString($_POST["folios"], "text"), 
GetSQLValueString($_POST["anexos"], "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString($fechaenvio, "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($textoiris, "text"),
GetSQLValueString($id_iris, "text"),
GetSQLValueString($fechairis, "text"));


$resultado = pg_query ($consultab);


  pg_free_result($resultado);
  pg_close($conexionpostgresql);  

  }
  
  
$query55="SELECT count(id_correspondencia) as valorfm FROM correspondencia WHERE nombre_correspondencia='$radicado_salida' and estado_correspondencia=1";
$select55 = mysql_query($query55, $conexion);
$row55 = mysql_fetch_assoc($select55);
if (0<$row55['valorfm']){
echo '<script type="text/javascript">swal(" ERROR !", " Error de red, Genere nuevamente radicado !", "error");</script>';

} else {



echo '<script type="text/javascript">swal(" OK !", " Radicado: '.$radicado_salida.'  ", "success");</script>';


$insertSQL = sprintf("INSERT INTO correspondencia (
nombre_correspondencia, 
referencia, 
cedula_contratista, 
id_tipo_correspondencia, 
id_funcionario_de, 
id_funcionario_para, 
fecha_correspondencia, 
asunto_correspondencia, 
descripcion_correspondencia, 
id_tipo_oficina_de, 
codigo_oficina_de, 
id_tipo_oficina_para, 
codigo_oficina_para, 
ruta_documento, 
estado_correspondencia) VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($radicado_salida, "text"), 
GetSQLValueString($_POST["referencia"], "text"), 
GetSQLValueString($_POST["cedula_contratista"], "int"), 
GetSQLValueString($_POST["id_tipo_documento"], "text"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($paraint, "int"),                        
GetSQLValueString($_POST["asunto_correspondencia"], "text"), 
GetSQLValueString($_POST["descripcion_correspondencia"], "text"), 
GetSQLValueString($_SESSION['snr_tipo_oficina'], "int"), 
GetSQLValueString($_SESSION['snr_area'], "int"), 
GetSQLValueString($_POST["id_tipo_oficina_para"], "int"), 
GetSQLValueString($_POST["codigo_oficina_para"], "int"), 
GetSQLValueString($ruta_archivo.'.pdf', "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

mysql_free_result($Result);

}
mysql_free_result($select55);


if ('1296'==$paraint){
$emailu='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Nueva Correspondencia: '.$radicado_salida.'';
$cuerpo  = 'Nueva Correspondencia: '.$radicado_salida.'';
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);

} else {}


if (isset($_FILES['filet']['name']) && ""!=$_FILES['filet']['name']) {



  

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$directoryftp="filesnr/iris/";

 
$archivo = $_FILES['filet']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['filet']['size'];
$nombrefile = strtolower($_FILES['filet']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

if ($tamano_archivo>=intval($tam_archivo2)) {
	
	
	
//if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
if ('pdf'==$extension)  { 
  $files = $ruta_archivo.'.pdf';
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
//$seguridad=md5($files.$id_ciudadano);
  





// correspondenciacontenido

$idradi=strip_tags($radicado_salida);
$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
$query = "SELECT * FROM correspondencia where codigo= '$idradi' "; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$idcorrespondencia=$row['idcorrespondencia'];
$william=$row['paraint'];

 }
 
  

  
  
  
  
$dateiris=date("Y-m-d H:i:s");


$conn_id = ftp_connect($ftp_server);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


$remotef = 'Correo/'.$idcorrespondencia.'/Files';
if (ftp_mkdir($conn_id, $remotef)) {
 echo "";
} else {
 echo "";
}


$file = $directoryftp.$files;  
$remote_file = 'Correo/'.$idcorrespondencia.'/Files/'.$files;


if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
 echo "";
} else {
 echo "";
}
ftp_close($conn_id);







$consultab = sprintf("INSERT INTO correspondenciacontenido (
idcorrespondencia, 
idtipodocumento, 
idsubclasedocumento, 
indice, 
upd, 
mostrar, 
nombre, 
extension, 
dir, 
pag, 
crc, audita, fechaaudita, audita2, fechaaudita2, creado, fcreado, modificado, fmodificado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($idcorrespondencia, "text"), 
GetSQLValueString('0', "text"), 
GetSQLValueString('0', "text"),
GetSQLValueString('1', "text"), //incremental
GetSQLValueString('0', "text"),
GetSQLValueString('f', "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString('Pdf', "text"),
GetSQLValueString('1', "text"),
GetSQLValueString('1', "text"),
GetSQLValueString('', "text"),
GetSQLValueString('0', "text"),
GetSQLValueString('', "text"),
GetSQLValueString('0', "text"),
GetSQLValueString('', "text"),
GetSQLValueString('1642', "text"),
GetSQLValueString($dateiris, "text"),
GetSQLValueString('0', "text"),
GetSQLValueString('', "text"));

  
$resultado = pg_query ($consultab);

  pg_free_result($resultado);
  pg_close($conexionpostgresql);  
}


  
  
if ('5,2480 '==$william) {
$emailu='amira.morales@supernotariado.gov.co';
$subject = 'Nuevo archivo anexado en Iris';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky informa que se adjunto nuevo archivo en Iris con el radicado ".$idradi." <br>";
$cuerpo .= '<br><br><a href="https://sisg.supernotariado.gov.co/correspondencia&'.$idradi.'.jsp">'.$idradi.'</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
//$cabeceras .= 'Bcc: giovanni.ortegon@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

mail($emailu,$subject,$cuerpo,$cabeceras);

	
} else {}



  } else { 
  $files='';
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
$files='';
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
		}

} else { 
$files='';
		}





} else { }
	
	
	
	

//ANEXAR DOCUMENTOS EN IRIS (MAS DOCUMENTOS)



if (isset($_POST['idcorrespondencia_anexa']) && ""!=$_POST['idcorrespondencia_anexa'] && isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');
$directoryftp="filesnr/iris/";

if (isset($_POST['id_tipo_documento_anexo']) && ""!=$_POST['id_tipo_documento_anexo']) {
$ruta_archivo2 = $_POST['id_tipo_documento_anexo'].'-'.$_SESSION['snr'].'-'.date("YmdGis");
} else {
$ruta_archivo2 = '4-'.$_SESSION['snr'].'-'.date("YmdGis");
}

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
  $filep = $ruta_archivo2.'.pdf';
  $mover_archivos = move_uploaded_file($archivo2, $directoryftp.$filep);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
//$seguridad=md5($files.$id_ciudadano);
  
// correspondenciacontenido


$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  

$idcorrespondencia=$_POST['idcorrespondencia_anexa'];
$parafuncionario=$_POST['idparaint'];

  
  
  

  
$dateiris=date("Y-m-d H:i:s");


$conn_id = ftp_connect($ftp_server);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


$remotef = 'Correo/'.$idcorrespondencia.'/Files';
if (ftp_mkdir($conn_id, $remotef)) {
 echo "";
} else {
 echo "";
}



$file2 = $directoryftp.$filep;  
$remote_file2 = 'Correo/'.$idcorrespondencia.'/Files/'.$filep;


if (ftp_put($conn_id, $remote_file2, $file2, FTP_BINARY)) {
 echo "";
} else {
 echo "";
}
ftp_close($conn_id);



$consultab = sprintf("INSERT INTO correspondenciacontenido (
idcorrespondencia, 
idtipodocumento, 
idsubclasedocumento, 
indice, 
upd, 
mostrar, 
nombre, 
extension, 
dir, 
pag, 
crc, audita, fechaaudita, audita2, fechaaudita2, creado, fcreado, modificado, fmodificado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($idcorrespondencia, "text"), 
GetSQLValueString('0', "text"), 
GetSQLValueString('0', "text"),
GetSQLValueString('1', "text"), //incremental
GetSQLValueString('0', "text"),
GetSQLValueString('f', "text"),
GetSQLValueString($filep, "text"), 
GetSQLValueString('Pdf', "text"),
GetSQLValueString('1', "text"),
GetSQLValueString('1', "text"),
GetSQLValueString('', "text"),
GetSQLValueString('0', "text"),
GetSQLValueString('', "text"),
GetSQLValueString('0', "text"),
GetSQLValueString('', "text"),
GetSQLValueString('1642', "text"),
GetSQLValueString($dateiris, "text"),
GetSQLValueString('0', "text"),
GetSQLValueString('', "text"));

  
$resultado = pg_query ($consultab);

  pg_free_result($resultado);
  pg_close($conexionpostgresql);  
}

  echo $insertado;
  
  
$radicadou=$_POST['radicadou'];

  
if (2480==$parafuncionario) {
$emailu='amira.morales@supernotariado.gov.co';
$subject = 'Nuevo archivo anexado en Iris';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky informa que se adjunto nuevo archivo en Iris con el radicado ".$radicadou." <br>";
$cuerpo .= '<br><br><a href="https://sisg.supernotariado.gov.co/correspondencia&'.$radicadou.'.jsp">'.$radicadou.'</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
//$cabeceras .= 'Bcc: giovanni.ortegon@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

mail($emailu,$subject,$cuerpo,$cabeceras);
  
} else {}
  
  
  
  
  

if ((isset($_POST["radicadou"])) && ($_POST["radicadou"] != "")) {
$radicadou=$_POST["radicadou"];
$id_anexo=intval($_POST["id_tipo_documento_anexo"]);


 if (4==$id_anexo) {
$updateSQL = "UPDATE correspondencia SET anexos=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";	 
 } else if (5==$id_anexo){ 
$updateSQL = "UPDATE correspondencia SET factura=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";
  } else if (6==$id_anexo){ 
$updateSQL = "UPDATE correspondencia SET cuenta_pagar=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";
   } else if (7==$id_anexo){ 
$updateSQL = "UPDATE correspondencia SET obligaciones=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";
    } else if (8==$id_anexo){ 
$updateSQL = "UPDATE correspondencia SET orden_pago=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";
   } else if (9==$id_anexo){ 
$updateSQL = "UPDATE correspondencia SET certificado_cumplimiento=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";
 } else {}
	 
	  $Result1 = mysql_query($updateSQL, $conexion);
	  mysql_free_result($Result1);
}





  } else { 
  $filep='';
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
$filep='';
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
		}

} else { 
$filep='';
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// ACTUALIZAR ASIGNACION
		
		
		
if ((isset($_POST["reasignar-funcionario"])) && ("" != $_POST["reasignar-funcionario"] )){ 

$fechairis_re=date("Y-m-d H:i:s");

$deint_realignado=$_POST["paraint_re"];
$de_reasignado=$_POST["para_re"];
$radicadoact=$_POST["radicado_re"];

$parare=explode("-", $_POST["reasignar-funcionario"]);
$paraint_reasignado=$parare[0];
$para_reasignado=$parare[1];


  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 
$consultabre = sprintf("UPDATE correspondencia SET paraint=%s, para=%s, modificado=%s, idestado=12, fmodificado=%s where codigo=%s",
GetSQLValueString('5,'.$paraint_reasignado.' ', "text"), 
GetSQLValueString($para_reasignado.' / ', "text"), 
GetSQLValueString($_SESSION['idiris'], "int"), 
GetSQLValueString($fechairis_re, "text"), 
GetSQLValueString($radicadoact, "text"));

$resultadore = pg_query ($consultabre);


  pg_free_result($resultadore);
  pg_close($conexionpostgresql);  

  }
  
  
  if ('1296'==$paraint_reasignado){
$emailu='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Nueva Correspondencia: '.$radicadoact.'';
$cuerpo  = 'Nueva Correspondencia: https://sisg.supernotariado.gov.co/correspondencia&'.$radicadoact.'.jsp';
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);

} else {}
  
echo  $actualizado;

if ('1296'==$paraint_reasignado){
$emailu='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Nueva Correspondencia: '.$radicado_salida.'';
$cuerpo  = 'Nueva Correspondencia: '.$radicado_salida.'';
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);

} else {}

  
  }
	





// ACTUALIZACION TIPO DE DOCUMENTO
if ((isset($_POST["id_tipo_documento_cambio"])) && ($_POST["id_tipo_documento_cambio"] != "")) {
$radicadotipodoc=$_POST["radicado_update_tipo_doc"];
$id_tipo_documento_u=intval($_POST["id_tipo_documento_cambio"]);
  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else { 
$consultabre = sprintf("UPDATE correspondencia SET idtipodocumento=%s, modificado=1642, fmodificado=%s where codigo=%s",
GetSQLValueString($id_tipo_documento_u, "int"), 
GetSQLValueString($fechairis_re, "text"), 
GetSQLValueString($radicadotipodoc, "text"));
$resultadore = pg_query ($consultabre);
  pg_free_result($resultadore);
  pg_close($conexionpostgresql);  
  }
$updateSQL2 = "UPDATE correspondencia SET id_tipo_correspondencia=".$id_tipo_documento_u." WHERE nombre_correspondencia='$radicadotipodoc' and estado_correspondencia=1";	 
 $Result12 = mysql_query($updateSQL2, $conexion);
echo  $actualizado;
mysql_free_result($Result12);
 }
 
 
 
 // ACTUALIZACION ASUNTO
if ((isset($_POST["asunto_cambio"])) && ($_POST["asunto_cambio"] != "")) {
$radicado_asunto_cambio=$_POST["radicado_asunto_cambio"];
$asunto_cambio=$_POST["asunto_cambio"];
  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else { 
$consultabre = sprintf("UPDATE correspondencia SET asunto=%s, modificado=1642, fmodificado=%s where codigo=%s",
GetSQLValueString($asunto_cambio, "text"), 
GetSQLValueString($fechairis_re, "text"), 
GetSQLValueString($radicado_asunto_cambio, "text"));
$resultadore = pg_query ($consultabre);
  pg_free_result($resultadore);
  pg_close($conexionpostgresql);  
  }
$updateSQL2 = "UPDATE correspondencia SET asunto_correspondencia=".$asunto_cambio." WHERE nombre_correspondencia='$radicado_asunto_cambio' and estado_correspondencia=1";	 
 $Result12 = mysql_query($updateSQL2, $conexion);
echo  $actualizado;
mysql_free_result($Result12);
 }
 
 
 
 
 
  // INSERTAR RADICADO
if ((isset($_POST["radicado_insertar"])) && ($_POST["radicado_insertar"] != "")) {
$radicado_insertar=$_POST["radicado_insertar"];
$queryop = sprintf("SELECT count(id_correspondencia) as totc FROM correspondencia where nombre_correspondencia='$radicado_insertar'");
$selectop = mysql_query($queryop, $conexion);
$rowop = mysql_fetch_assoc($selectop);
   if(0<$rowop['totc']){
     echo $repetido;
  } else { 
  
$insertSQLrr = sprintf("INSERT INTO correspondencia (
nombre_correspondencia, 
referencia, 
id_tipo_correspondencia, 
id_funcionario_de, 
id_funcionario_para, 
fecha_correspondencia, 
asunto_correspondencia, 
descripcion_correspondencia, 
estado_correspondencia) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($radicado_insertar, "text"), 
GetSQLValueString($_POST["referencia_insertar"], "text"), 
GetSQLValueString($_POST["tipodocumento_insertar"], "text"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString(1642, "int"),    
GetSQLValueString($_POST["fcreado_insertar"], "text"),                     
GetSQLValueString($_POST["asunto_insertar"], "text"), 
GetSQLValueString($_POST["descripcion_insertar"], "text"), 
GetSQLValueString(1, "int"));
$Resultrr = mysql_query($insertSQLrr, $conexion);

echo  $insertado;
mysql_free_result($Resultrr);
  }
  
  mysql_free_result($selectop);
  
 }
 
?>


	  
	  
	  
	  
<div class="modal fade bd-example-modal-lg" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva Correspondencia</h4>
      </div>
      <div class="modal-body">
	
	 
        
<form action="" method="POST" name="for543543m1" enctype="multipart/form-data" >
<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label">REFERENCIA:</label> 
<input type="text" class="form-control mayuscula" name="referencia" maxlength="49" placeholder="" >
</div>

<?php
$nump146=privilegios(146,$_SESSION['snr']);
 if (1==$_SESSION['rol'] or 0<$nump146) { ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CANAL DE ENTRADA:</label> 
<select  class="form-control" name="idcorreovia" required>
<option value="" selected></option>
<option value="1">Correo Certificado</option>
<option value="3">Correo Electronico</option>
<option value="8">Personal</option>
<option value="9">Correo Simple</option>
<!--<option value="10">Correo Simple</option>-->
<option value="12">Web</option>
<option value="13">Telefonico</option>
<option value="14">Correo Electronico Certificado</option>
</select>
</div>
<?php } else {?>
<input type="hidden"  name="idcorreovia" value="3">
<?php } ?>

</div>


<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE CORRESPONDENCIA:</label> 
<select  class="form-control" name="id_tipo_correspondencia" id="id_tipo_correspondencia" required>
<option value="" selected></option>
<?php if (1==$_SESSION['rol'] or  0<$nump36 or 40==$_SESSION['snr_grupo_area']) { ?>
<option value="ER" >Externo Recibido ER</option>
<?php } else { } ?>
<option value="IE" >Interno Enviado IE</option>
<option value="EE" >Externo Enviado EE</option>
</select>
</div>




<?php
$nump146=privilegios(146,$_SESSION['snr']);
 if (1==$_SESSION['rol'] or 0<$nump146) { ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE FOLIOS:</label> 
<input type="text" class="form-control numero" name="folios" required >
</div>
<?php } else {?>
<input type="hidden"  name="folios" value="1">
<?php } ?>


</div>
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DE:</label> 
<input type="text" class="form-control mayuscula" name="de" id="de_iris" required readonly="readonly" value="<?php echo $nombrec_iris;?>">
</div>


<?php
$nump146=privilegios(146,$_SESSION['snr']);
 if (1==$_SESSION['rol'] or 0<$nump146) { ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE ANEXOS:</label> 
<input type="text" class="form-control numero" name="anexos" required >
</div>
<?php } else {?>
<input type="hidden"  name="anexos" value="1">
<?php } ?>



</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> PARA:</label> 
<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#directivos">Seleccionar destinatario</button>
<input type="text" class="form-control" name="para" readonly="readonly" id="para" required>
<input type="hidden" class="form-control" name="paraint" readonly="readonly" id="paraint">
<input type="hidden" class="form-control" name="parados" id="parados">
</div>
</div>
<div class="col-md-4">

<div class="form-group text-left"> 
<label  class="control-label"> TIPO DE OFICINA:</label> 
<select class="form-control" name="id_tipo_oficina_para" id="id_tipo_oficina2" >
<option value="" selected></option>
<option value="1" >Nivel central</option>
<option value="2" >Oficinas de Registro</option>
<option value="3" >Notarias</option>
<option value="4" >Curadurias</option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"> OFICINA DESTINO:</label> 
<select  class="form-control" name="codigo_oficina_para" id="listado_oficinas" >
<option value="" selected></option>

</select>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ASUNTO:</label> 
<input type="text" class="form-control" name="asunto_correspondencia" maxlength="250" required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DOCUMENTO:</label> 
<select  class="form-control" name="id_tipo_documento" id="id_tipo_documentoc" required>
<option value="" selected></option>
<?php
$queryb = sprintf("SELECT * FROM tipo_documento_iris where idtipodocumento!=305 and estado_tipo_documento_iris=1"); 
$selectb = mysql_query($queryb, $conexion);
$rowb = mysql_fetch_assoc($selectb);
$totalRowsb = mysql_num_rows($selectb);
if (0<$totalRowsb){
do {
	echo '<option value="'.$rowb['idtipodocumento'].'">'.$rowb['nombre_tipo_documento_iris'].'</option>';
	
	} while ($rowb = mysql_fetch_assoc($selectb)); 
	
	IF (1==$_SESSION['rol'] or 40==$_SESSION['snr_grupo_area']) {
	echo '<option value="305">CUENTA DE COBRO</option>';
	} else { }
	
} else {}	 
mysql_free_result($selectb);
?>
</select>
</div>


<?php IF (1==$_SESSION['rol'] or 40==$_SESSION['snr_grupo_area']) {   ?>
	<div class="form-group text-left" id="cedulac" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CEDULA DEL CONTRATISTA:</label> 
<input type="text" class="form-control numero" name="cedula_contratista" id="cedulacontratista">
</div>
<?php	} else { }
	?>


</div>
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DESCRIPCIÓN:</label> 
<textarea class="form-control" name="descripcion_correspondencia" maxlength="500" required ></textarea>
</div>
</div>
<script>
function fileValidation2(){
	var filexInput = document.getElementById('file');
    var filePath = filexInput.value;
    var allowedExtensions = /(.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension .pdf.');
		filexInput.value = '';
        return false;
    }else{
        //Image preview
        if (filexInput.files && filexInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview2').innerHTML = 'ok';
            };
            reader.readAsDataURL(filexInput.files[0]);
        }
    }
}

function fileValidation(){
    var fileInput = document.getElementById('filet');
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
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label">Documento (Solo un pdf): <div id="imagePreview"></div></label> 
<input type="file" class="form-control" name="filet" id="filet" onchange="return fileValidation()" >
</div>




</div>
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<?php //if (1==$_SESSION['rol']) {?>
<button type="submit" class="btn btn-success desaparecerboton" >
<input type="hidden" name="table" value="resoluciondatos">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
<?php // } else {} ?>
</div></form>


      </div>
    </div>
  </div>
</div>

 
 
 
 
 
 
 
 
 <div class="modal fade" id="directivos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Directorio</h4>
      </div>
      <div class="modal-body">
        
<div class="form-group text-left"> 

<?php
/*
$querymm = sprintf("SELECT nombre_funcionario FROM funcionario where id_cargo=1 and id_tipo_oficina=1 and estado_funcionario=1"); 
$selectmm = mysql_query($querymm, $conexion) or die(mysql_error());
$rowmm = mysql_fetch_assoc($selectmm);
$totalRowsmm = mysql_num_rows($selectmm);
if (0<$totalRowsmm){
do {

echo '<a class="enviodirectivo" data-dismiss="modal" style="cursor:pointer;" id="'.$rowmm['nombre_funcionario'].'">'.$rowmm['nombre_funcionario'].'</a><br>'; 

	 } while ($rowmm = mysql_fetch_assoc($selectmm)); 
} else {}	 
mysql_free_result($selectmm);
*/
/*
 $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
$limitep=1400;
$pagina=0;
$consultab="select idusuario, nombre, apellido from usuario WHERE activo='true' ORDER BY nombre, apellido DESC OFFSET ".$pagina." LIMIT ".$limitep;
$resultado = pg_query ($consultab);
$num_resultados = pg_num_rows ($resultado);

if (0<$num_resultados) { 
for ($i=0; $i<$num_resultados; $i++)
   {
	   $row = pg_fetch_array ($resultado);
echo '<a class="enviodirectivo" data-dismiss="modal" style="cursor:pointer;" title="'.$row["idusuario"].'" id="'.$row["nombre"].' '.$row["apellido"].'">'.$row["nombre"].' '.$row["apellido"].'</a><br>'; 

}
  pg_free_result($resultado);
  pg_close($conexionpostgresql);
} 
  }
  */
?>
<script>
 // Write on keyup event of keyword input element
 $(document).ready(function(){
 $("#search").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#mytable tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });
});
</script>
<div class="input-group-btn"><input type="text" id="search" name="buscar" placeholder="Buscar Texto" class="form-control" required >
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
<br>
<table class="table" id="mytable">
<tr><td><a class="enviodirectivo" data-dismiss="modal" style="cursor:pointer;" title="1642" id=""><b>NO ES SERVIDOR PÚBLICO DE LA SNR (NIVEL CENTRAL)</b></a></td></tr>
<?php
$query = sprintf("SELECT * FROM usuario_iris where estado_usuario_iris=1 order by nombre_usuario_iris"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do { ?>

<tr><td><a class="enviodirectivo" data-dismiss="modal" style="cursor:pointer;" title="<?php echo $row['codigo_usuario_iris']; ?>" id="<?php echo $row['nombre_usuario_iris']; ?>"><?php echo $row['nombre_usuario_iris'].' '.$row['desc']; ?></a></td></tr>

<?php	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>


</table>
</div>


      </div>
    </div>
  </div>
</div>



 

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border" >

  <div class="col-md-8">

	  <form class="navbar-form" name="for3254m1frteerteg" method="post" action="correspondencia.jsp">
<div class="input-group">

<!--<div id="loaddb" style="width:30px;display:none;"><img src="images/loaddb.gif" style="width:30px"></div>-->

<div class="input-group-btn">


<select class="form-control" name="via" required>
          <option value="" selected="">- - - Buscar:  - - - - </option>
 		  <option value="de">De</option>
		   <option value="para">Para</option>
		   <option value="referencia">Referencia</option>
		   <option value="asunto">Asunto</option>
		  </select>
</div>
<div class="input-group-btn"><input value="<?php if (isset($_POST["nombre"]) and ""!=$_POST["nombre"]) { echo strtoupper($_POST["nombre"]); } else {} ?>" type="text" style="width:250px;" name="nombre" id="nombre_dir" placeholder="Buscar" class="form-control" required>
</div>
<script>
function solodirectivos() {
	alert("Busqueda disponible solo para directivos o funcionarios que encarguen.");
}

</script>
 
<div class="input-group-btn"> 
<?php if (1==$_SESSION['guardar_pdf'] or 1==$_SESSION['rol'] or 40==$_SESSION['snr_grupo_area']) { echo '<button type="submit" class="btn btn-success">'; } else { echo '<button type="button" onclick="solodirectivos()" class="btn btn-success">'; }  ?>
<span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
 <?php // if (1==$_SESSION['rol']) { ?>
<div class="input-group-btn">
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#directivos">Directorio de IRIS</button>
</div>
 <?php // } ?>
</div>
</form>



	  
	  
	  
	  </div>
<div class="col-md-4">		  
<form class="navbar-form" name="form1trterteg" method="post" action="" ><!-- onsubmit="document.getElementById('loaddb').style='block';"-->
<div class="input-group">
<div class="input-group-btn">
<input type="text" name="radicado" class="form-control" value="<?php if (isset($_GET['i'])) { echo $_GET['i']; } else {} ?>" style="width:250px;" placeholder="Número de radicado" required>
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>
</form>
</div>
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div> <!-- FINAL box-tools pull-right -->
</div> <!-- FINAL box-header with-border -->

<div class="row">

<div class="box-header" >
<div class="col-md-8">	
	 <script>
	function  faltauseriris() {
		  alert("Falta configurar su usuario de IRIS. Enviar correo a enrique.montanez@supernotariado.gov.co ó ana.diaz@supernotariado.gov.co");
	  }
	  </script>
   <button <?php  if ("0"==$_SESSION['username_iris']) { echo 'onclick="faltauseriris()"'; } else { echo 'data-toggle="modal" data-target="#miModal"'; }?> type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span>
        Nueva correspondencia
      </button>  
	  
	   &nbsp; &nbsp; &nbsp; <a href="https://youtu.be/MfJrMjTq8h0" target="_blank"> Ver Manual</a>
	   
	  <br>
	  </div>
<div class="col-md-2">
<form action=""  method="POST" name="f3244orm353454sfg1ftregg" >
<input type="hidden" name="via" value="para">
<input type="hidden" name="nombre" value="<?php echo $nombrec_iris; ?>">
<button <?php  if ("0"==$_SESSION['username_iris']) { echo 'onclick="faltauseriris()"'; } else { echo 'type="submit"';} ?> class="btn btn-primary" ><span class="fa fa-envelope-o"></span> Mis recibidos </button>
</form>
</div>
<div class="col-md-2">
<form action=""  method="POST" name="f34343244orm353454sfg1ftregg" >
<input type="hidden" name="via" value="de">
<input type="hidden" name="nombre" value="<?php echo $nombrec_iris; ?>">
<button <?php  if ("0"==$_SESSION['username_iris']) { echo 'onclick="faltauseriris()"'; } else { echo 'type="submit"';} ?>  class="btn btn-danger" ><span class="fa fa-mail-forward"></span> Mis enviados </button>
</form>
 </div>	  
</div>
</div>



    <div class="box-body" style="min-height:700px;">
      <div class="table-responsive">
	  

<?php 

function saberestado($codee) 
{
 if (1==$codee) { $estadoiris='ACTIVO'; }
else if (2==$codee) { $estadoiris='INACTIVO'; }
else if (3==$codee) { $estadoiris='PRESTADO'; }
else if (4==$codee) { $estadoiris='EN PROCESO'; }
else if (5==$codee) { $estadoiris='Recibido'; }
else if (6==$codee) { $estadoiris='Enviado'; }
else if (7==$codee) { $estadoiris='ATRASADO'; }
else if (13==$codee) { $estadoiris='Para Reasignar'; }
else if (14==$codee) { $estadoiris='Para Enviar'; }
else if (15==$codee) { $estadoiris='Enviada'; }
else if (8==$codee) { $estadoiris='Radicada'; }
else if (10==$codee) { $estadoiris='Listada'; }
else if (11==$codee) { $estadoiris='Mostrada'; }
else if (12==$codee) { $estadoiris='Reasignada'; }
else if (16==$codee) { $estadoiris='CONTESTADA'; }
else if (19==$codee) { $estadoiris='PARA PLANILLA'; }
else if (20==$codee) { $estadoiris='Interna'; }
else if (17==$codee) { $estadoiris='ATRASADA'; }
else {$estadoiris='';}
 return $estadoiris;
}



	
if ((isset($_POST["radicado"]) and ""!=$_POST["radicado"]) or (isset($_GET['i']))) {
  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else { 
  
  
  if (isset($_GET['i'])){
	$radicado=$_GET['i'];  
  } else {
	$radicado=$_POST["radicado"];  
  }

$limitep=50;
$pagina=0;
$consultab="select idcorrespondencia, referencia, idestado, fcreado, codigo, asunto, de, para, fechaenvio from correspondencia WHERE codigo like '%$radicado%' or referencia like '%$radicado%' ORDER BY fcreado DESC OFFSET ".$pagina." LIMIT ".$limitep;
$resultado = pg_query ($consultab);
$num_resultados = pg_num_rows ($resultado);

if (0<$num_resultados) { 

echo ' Registros: '.$num_resultados.'<br>';
?>
<table class="table" style="max-width:100%;">
<tr>
<th>Radicado</th>
<th>Referencia</th>
<!--<th>Folios</th>-->
<th>De</th>
<th>Para</th>
<th>Estado</th>
<th>Asunto</th>
<th>Pdf</th>
</tr>
<?php
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
echo '<tr title="'.$row["fcreado"].'">';
echo '<td>';
 $radi=$row["codigo"];
 echo $radi;
echo ' </td>';
echo '<td>';
 echo $row["referencia"];
echo ' </td>';
echo '<td>';
echo $row["de"];
echo '</td>';
echo '<td>';
echo $row["para"];
echo '</td>';
echo '<td>';
echo saberestado($row["idestado"]);
echo ' </td>';
echo '<td>';
echo $row["asunto"];
echo '</td>';
echo '<td>';
echo '<a name="'.$radi.'" href="" class="buscar_correspondencia" id="'.$radi.'" data-toggle="modal" data-target="#popupcorrespondencia"><img src="images/pdf.png"></a>';

if (1==$_SESSION['rol']) {
	echo '<a href="tramite_notaria&'.$radi.'.jsp" ><img src="images/file.png"></a>';
} else {}
echo '</td>';
echo '</tr>';

}
   
  pg_free_result($resultado);
  pg_close($conexionpostgresql);
   echo '</table>';

 
   
   
   } else { }
  }
  
} else { echo 'Puede consultar documentos por nombre del funcionario ó por número de radicado.'; }





if (isset($_POST["nombre"]) and ""!=$_POST["nombre"] && isset($_POST["via"]) and ""!=$_POST["via"]) {	
$via=$_POST["via"];
$name=strtoupper($_POST["nombre"]);
  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {

$limitep=100;
$pagina=0;


$consultab = "select idcorrespondencia, referencia, idestado, fcreado, codigo, asunto, de, para, fechaenvio from correspondencia where ".$via." like '%".$name."%' order by idcorrespondencia desc OFFSET ".$pagina." LIMIT ".$limitep;



$resultado = pg_query ($consultab);
$num_resultados = pg_num_rows ($resultado);

if (0<$num_resultados) { 
echo ' Registros: '.$num_resultados.'<br>';
?>
<table class="table" style="max-width:100%;">
<tr>
<th>Radicado</th>
<th>Referencia.</th>
<!--<th>Folios</th>-->
<th>De</th>
<th>Para</th>
<th>Estado</th>
<th>Asunto</th>
<th style="width:70px;">Pdf</th>
</tr>
<?php
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
echo '<tr title="'.$row["fcreado"].'">';
echo '<td>';
 $radi=$row["codigo"];
 echo $radi;
echo ' </td>';
echo '<td>';
 echo $row["referencia"];
echo ' </td>';
//echo '<td>';
//echo $row["folios"];
//echo '</td>';
echo '<td>';
echo $row["de"];
echo '</td>';
echo '<td>';
echo $row["para"];
echo '</td>';
echo '<td>';
echo saberestado($row["idestado"]);
echo ' </td>';
echo '<td>';
echo $row["asunto"];
echo '</td>';
echo '<td>';
echo '<a name="'.$radi.'" href="" class="buscar_correspondencia" id="'.$radi.'" data-toggle="modal" data-target="#popupcorrespondencia"><img src="images/pdf.png"></a>';
if (1==$_SESSION['rol']) {
	echo ' <a href="tramite_notaria&'.$radi.'.jsp" ><img src="images/file.png"></a> ';
	
	echo ' <a href="" ><img src="images/file.png"></a> '; 
} else {}
echo '</td>';
echo '</tr>';

}
   
  pg_free_result($resultado);
  pg_close($conexionpostgresql);
   echo '</table>';

 
   
   
   } else { }
  }
  
} else { echo ''; }








?>






        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div> <!-- FINAL DE ROW -->



<div class="modal fade bd-example-modal-lg" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Correspondencia</label> <span id="radicor"></span></h4>
</div> 
<div class="ver_correspondencia" class="modal-body"> 





</div>
</div> 
</div> 
</div> 



<?php
 }

 mysql_free_result($actualizar6);
 
 } else { }?>





