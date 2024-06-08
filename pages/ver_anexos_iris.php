<?php

function saberdoc($coda) 
{
 if (1==$coda) { $estadod='Interno Enviado'; }
else if (2==$coda) { $estadod='Externo Enviado'; }
else if (3==$coda) { $estadod='Externo Recibido'; }
else if (4==$coda) { $estadod='Anexo'; }
else if (5==$coda) { $estadod='Cuenta por pagar'; }
else if (6==$coda) { $estadod='Factura equivalente'; }
else if (7==$coda) { $estadod='Obligaciones'; }
else if (8==$coda) { $estadod='Orden de pago'; }
else if (9==$coda) { $estadod='Certificado de cumplimiento'; }
else if (10==$coda) { $estadod='Devolución completa'; }
else if (11==$coda) { $estadod='Aclaración de devolución'; }
else {$estadod='';}
 return $estadod;
}



$userpostgres 		= "postgres";
$passwordpostgres 	= "postgres";
$dbpostgres			= "SNR";
$portpostgres 		= "5432";
$hostpostgres 		= "192.168.10.22";

$conexionpostgres = pg_pconnect("host=" . $hostpostgres . " port=" . $portpostgres . " dbname=" . $dbpostgres . " user=" . $userpostgres . " password=" . $passwordpostgres . "") or die("No se ha podido conectar");


function ver_anexos_iris($docm) {

$query = "select correspondenciacontenido.idcorrespondencia,  correspondenciacontenido.nombre, correspondenciacontenido.creado, correspondenciacontenido.fcreado from correspondencia, correspondenciacontenido WHERE correspondenciacontenido.idcorrespondencia=correspondencia.idcorrespondencia and correspondencia.codigo='$docm'"; 

$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	$anexos=''; 
for ($i=0; $i<$num_resultados; $i++)
   {
//$todosLosVideos[] = pg_fetch_array ($resultado);
$rowi = pg_fetch_array ($resultado);

$numb=$i+1;


if (1642==$rowi["creado"]) {
$archid=explode("-",$rowi["nombre"]);
$narchi=$archid[0];

$anexos.= '<a href="pdfview/?q='.base64_encode($rowi["idcorrespondencia"]).'_'.base64_encode($rowi["nombre"]).'.pdf" target="_blank" style="text-decoration:none;"><img src="images/pdf.png"> Anexo '.$numb.'</a> / ';
$anexos.= saberdoc($narchi);
$anexos.= '<br>';
} else {

$anexos.= '<a href="pdfview/?q='.base64_encode($rowi["idcorrespondencia"]).'_'.base64_encode($rowi["nombre"]).'.pdf" target="_blank" style="text-decoration:none;"><img src="images/pdf.png"> Anexo '.$numb.'</a><br>';

	}

 
 }
 
  pg_free_result($resultado);
  return $anexos;

  pg_close($conexionpostgres);
}

?>