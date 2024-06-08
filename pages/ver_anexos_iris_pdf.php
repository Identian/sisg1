<?php

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


//$anexos.= '<a download="'.$docm.'.pdf" href="pdfview/?q='.base64_encode($rowi["idcorrespondencia"]).'_'.base64_encode($rowi["nombre"]).'.pdf" target="_blank" style="text-decoration:none;"><img src="images/pdf.png"></a><br>';
$anexos.= ' <a download="'.$docm.'.pdf" href="file_sgd/?q='.base64_encode($rowi["idcorrespondencia"]).'_'.base64_encode($rowi["nombre"]).'.pdf" style="color:#ED1C27;"><img src="images/pdf.png"></a><br>';



 
 }
 
  pg_free_result($resultado);
  return $anexos;

  pg_close($conexionpostgres);
}

?>