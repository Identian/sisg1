<?php

$userpostgres 		= "adminnotariadigitales@dbnotariadigitales";
$passwordpostgres 	= "2020NotariasD12020";
$dbpostgres			= "notaria_digital";
$portpostgres 		= "5432";
$hostpostgres 		= "dbnotariadigitales.postgres.database.azure.com";

$conexionpostgres = pg_pconnect("host=" . $hostpostgres . " port=" . $portpostgres . " dbname=" . $dbpostgres . " user=" . $userpostgres . " password=" . $passwordpostgres . "") or die("No se ha podido conectar");


function ver() {

$query = "select * from notaria"; 

$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	$anexos=''; 
for ($i=0; $i<$num_resultados; $i++)
   {
//$todosLosVideos[] = pg_fetch_array ($resultado);
$rowi = pg_fetch_array ($resultado);

$anexos.= $rowi["nombre_notaria"].'<br>';



 
 }
 
  pg_free_result($resultado);
  return $anexos;

  pg_close($conexionpostgres);
}

echo ver();

?>