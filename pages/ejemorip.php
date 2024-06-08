<?php

$hostname_conexionorip = "192.168.210.58";
$database_conexionorip = "usaid";
$username_conexionorip = "sisg";
$password_conexionorip = "Colombia2019*";
$conexionorip = mysql_pconnect($hostname_conexionorip, $username_conexionorip, $password_conexionorip); 
mysql_select_db($database_conexionorip, $conexionorip);

$queryn = "SELECT * FROM digitalizaciones_base where id_oficina_registro=64 limit 100";
	  

$selectn = mysql_query($queryn, $conexionorip) ;
$row = mysql_fetch_assoc($selectn);
					
$totalRows = mysql_num_rows($selectn);

if (0<$totalRows){

 do {

echo '<tr>';
                    
echo '<td>'.$row['ID_EXPEDIENTE'].'</td>';

echo '<td>';
if (2==$id) {
echo '<a href="./migracionorip/USAIDGDMONTELIBANO/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (14==$id) {
echo '<a href="./migracionorip/USAIDGDSANMARTIN/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (22==$id) {
echo '<a href="./migracionorip/USAIDGDCHAPARRAL/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (69==$id) {
echo '<a href="./migracionorip/USAIDGDTUMACO2/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (110==$id) {
echo '<a href="./migracionorip/USAIDGDCARMEN/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (67==$id) {
echo '<a href="./migracionorip/USAIDGDCUCUTA/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (64==$id) {
echo '<a href="./migracionorip/USAIDGDOCANA/Ocana/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (116==$id) {
echo '<a href="./migracionorip/USAIDGDMONTERIA/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else { echo $row['RUTA_PDF']; }
echo '</td>';

echo '<td>'.$row['UBICACION_TOPOGRAFICA_CAJA'].'</td>';
echo '<td>'.$row['UBICACION_TOPOGRAFICA_CARPETA'].'</td>';
echo '<td>'.$row['FOLIO_MATRICULA_INMOBILIARIA'].'</td>';
echo '<td>'.$row['FOLIO_INICIAL'].'</td>';
echo '<td>'.$row['FOLIO_FINAL'].'</td>';
echo '<td>'.$row['NOMBRE_DEPARTAMENTO'].'</td>';
echo '<td>'.$row['NOMBRE_MUNICIPIO'].'</td>';
echo '<td>'.$row['NOMBRE_VEREDA'].'</td>';
echo '<td>'.$row['TIPO_PREDIO'].'</td>';
echo '<td>'.$row['NUMERO_ANOTACION'].'</td>';
echo '<td>'.$row['TIPO_DOCUMENTO'].'</td>';
echo '<td>'.$row['NUMERO_DOCUMENTO'].'</td>';
echo '<td>'.$row['FECHA_DOCUMENTO'].'</td>';
echo '<td>'.$row['OFICINA_ORIGEN'].'</td>';
echo '<td>'.$row['NUMERO_RADICACION'].'</td>';
echo '<td>'.$row['FECHA_RADICACION'].'</td>';
echo '<td>'.$row['CODIGO_NATURALEZA_JURIDICA'].'</td>';
echo '<td>'.$row['ESPECIFICACION_NATURALEZA_JURIDICA'].'</td>';
echo '<td>'.$row['ESTADO_FOLIO'].'</td>';
echo '<td>'.$row['DIRECCION_ACTUAL'].'</td>';
echo '<td>'.$row['FALTA_FORMULARIO'].'</td>';
echo '<td>'.$row['FALTA_ANEXO'].'</td>';
echo '<td>'.$row['FALTA_TRAMITE'].'</td>';
echo '<td>'.$row['CONTIENE_PERIODICO'].'</td>';
echo '<td>'.$row['CONTIENE_MAPA'].'</td>';
echo '<td>'.$row['CONTIENE_CD'].'</td>';
echo '<td>'.$row['HASH_TIFF'].'</td>';
echo '<td>'.$row['RUTA_TIFF'].'</td>';
echo '<td>'.$row['HASH_PDF'].'</td>';






echo '<td>'.$row['OBSERVACIONES'].'</td>';
echo '<td>'.$row['PROVEEDOR'].'</td>';
echo '<td>'.$row['ESTADO'].'</td>';
                      echo '</tr>';
                        } while ($row = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);


                        ?>