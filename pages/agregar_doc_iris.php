<?php

if (isset($_POST['idcorrespondencia_anexa']) && ""!=$_POST['idcorrespondencia_anexa'] 
 && isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {




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




$idcorrespondencia=$_POST['idcorrespondencia_anexa'];

 
  
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



$userpostgres     = "postgres";
$passwordpostgres   = "postgres";
$dbpostgres        = "SNR";
$portpostgres     = "5432";
$hostpostgres     = "192.168.10.22";

$conexionpostgres = pg_pconnect("host=" . $hostpostgres . " port=" . $portpostgres . " dbname=" . $dbpostgres . " user=" . $userpostgres . " password=" . $passwordpostgres . "") or die("No se ha podido conectar");





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


  echo $insertado;
 






  } else { 
  $filep='';
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
$filep='';
echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}

} else { 
$filep='';
		}
		
		
		
		

?>