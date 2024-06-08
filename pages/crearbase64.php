<?php
ini_set('max_execution_time', 10000000);     // para aumentar el tiempo de ejecución
$iden='5001002296QGWC';
$ruta='files/salidas/'.$iden.'/'.$iden.'.pdf';
$b64Doc = base64_encode(file_get_contents($ruta));
//echo $b64Doc;

$fp = fopen('files/salidas/'.$iden.'/'.$iden.'.txt', "w");
fwrite($fp,$b64Doc);
fclose($fp);
?>