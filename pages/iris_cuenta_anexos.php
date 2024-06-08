<?php

global $conexionpostgresql;
$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 

function idanexoiris($radicado) {

global $conexionpostgresql;
$query = "SELECT * FROM correspondencia where codigo= '$radicado' "; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$idcorrespondencia=$row['idcorrespondencia'];
 }
return $idcorrespondencia;
}



	 
	  
function anexosiris($idanexo,$nombre,$documento) {

global $conexionpostgresql;

$consultab = "INSERT INTO correspondenciacontenido (
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
crc, audita, audita2, creado, modificado) 
VALUES ('$idanexo', '0', '0', '1', '0', 'f', '$documento', 'pdf', '1', '1', '', '0', '0', '1642', '0');";

$resultado = pg_query ($consultab);
  pg_free_result($resultado);
  pg_close($conexionpostgresql); 

return '';

  
}




function anexosftpiris($idcorrespondencia,$documento) {

global $conexionpostgresql;
//$ftp_server = "192.168.10.239";
$ftp_server	= "192.168.10.22";
$ftp_user_name = "SISG";
$ftp_user_pass = "SISG2018";


$dateiris=date("Y-m-d H:i:s");


$conn_id = ftp_connect($ftp_server);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


$remotef = 'Correo/'.$idcorrespondencia.'/Files';
if (ftp_mkdir($conn_id, $remotef)) {
 echo "";
} else {
ftp_mkdir($conn_id, $remotef);
}

$directoryftp='filesnr/cuenta_cobro/';

$files=$documento;
$file = $directoryftp.$files; 

$remote_file = 'Correo/'.$idcorrespondencia.'/Files/'.$files;


if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
 echo "";
} else {
 echo "";
}
ftp_close($conn_id);

 
}


  
  }
	
	
	
//echo anexosiris('SNR2022ER087870','Oferta','portal-tyc_colegio_lujan23.pdf');
	?>