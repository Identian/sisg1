<?php

	function pdfVersion($filename)
{ 
    $fp = @fopen($filename, 'rb');
 
    if (!$fp) {
        return 0;
    }
 
    /* Reset file pointer to the start */
    fseek($fp, 0);
 
    /* Read 20 bytes from the start of the PDF */
    preg_match('/\d\.\d/',fread($fp,20),$match);
 
    fclose($fp);
 
    if (isset($match[0])) {
        return $match[0];
    } else {
        return 0;
    }
}


if (isset($_GET['i']) and ""!=$_GET['i']) {
	
	
	
	




	
$identificador=$_GET['i'];
	
	
$directoryftp='files/salidas/'.$identificador.'/';


	
$select4 = mysql_query("select * from salida_menor where identificador_sm='$identificador' limit 1", $conexion);
$row4 = mysql_fetch_assoc($select4);
$totalRows4 = mysql_num_rows($select4);
if (0<$totalRows4) {
$id_notaria=$row4['id_notaria'];
$id_funcionario=$row4['id_funcionario'];
$id_tipo_poder=$row4['id_tipo_poder'];
$fecha_poder=$row4['fecha_poder'];
$id_tipo_autorizacion_salida=$row4['id_tipo_autorizacion_salida'];
$numero_escritura=$row4['numero_escritura'];
$fecha_escritura=$row4['fecha_escritura'];
$fecha_escritura_vigencia=$row4['fecha_escritura_vigencia'];
$hora_vigencia=$row4['hora_vigencia'];
$id_tipo_custodia=$row4['id_tipo_custodia'];
$id_tipo_documento_menor=$row4['id_tipo_documento_menor'];
$identificacion_menor=$row4['identificacion_menor'];
$nombre_menor=$row4['nombre_menor'];
$id_tipo_documento_padre=$row4['id_tipo_documento_padre'];
$identificacion_padre=$row4['identificacion_padre'];
$nombre_padre=$row4['nombre_padre'];
$id_tipo_documento_madre=$row4['id_tipo_documento_madre'];
$identificacion_madre=$row4['identificacion_madre'];
$nombre_madre=$row4['nombre_madre'];
$sale_dif_padres=$row4['sale_dif_padres'];
$id_tipo_documento_psale=$row4['id_tipo_documento_psale'];
$identificacion_psale=$row4['identificacion_psale'];
$nombre_psale=$row4['nombre_psale'];
$fecha_salida=$row4['fecha_salida'];
$fecha_salida_hasta=$row4['fecha_salida_hasta'];
$nombre_salida_menor=$row4['nombre_salida_menor'];
$id_pais=$row4['id_pais'];
$fecha_retorno=$row4['fecha_retorno'];
$fecha_retorno_hasta=$row4['fecha_retorno_hasta'];
$motivo_noretorno=$row4['motivo_noretorno'];
$file_autenticacion=$row4['file_autenticacion'];
$file_civil=$row4['file_civil'];
$fecha_carga=$row4['fecha_carga'];



mysql_free_result($select4);


	
	
$select = mysql_query("SELECT codigo_dane, nombre_notaria, email_notaria, nombre_municipio, nombre_funcionario, nombre_departamento FROM departamento, notaria, municipio, funcionario, posesion_notaria 
WHERE funcionario.id_cargo=1 AND funcionario.id_tipo_oficina=3 AND posesion_notaria.id_funcionario=funcionario.id_funcionario and estado_funcionario=1 
and estado_posesion_notaria=1 AND fecha_fin is null AND notaria.id_notaria=posesion_notaria.id_notaria AND departamento.id_departamento=notaria.id_departamento and
notaria.id_departamento=municipio.id_departamento AND notaria.codigo_municipio=municipio.codigo_municipio and notaria.id_notaria=".$id_notaria." and estado_notaria=1  limit 1", $conexion);
$row = mysql_fetch_assoc($select);
$codigo_dane=$row['codigo_dane'];
$nombre_notaria=$row['nombre_notaria'];
$nombre_municipio=$row['nombre_municipio'];
$email_notaria=$row['email_notaria'];
$nombre_funcionario=$row['nombre_funcionario'];
$nombre_departamento=$row['nombre_departamento'];

mysql_free_result($select);



$selectr = mysql_query("select nombre_pais from pais where id_pais=".$id_pais." and estado_pais=1", $conexion);
$rowr = mysql_fetch_assoc($selectr);
$nombre_pais= $rowr['nombre_pais'];
mysql_free_result($selectr);


$selectraap = mysql_query("select nombre_tipo_poder from tipo_poder where id_tipo_poder=".$id_tipo_poder." and estado_tipo_poder=1", $conexion);
$rowraap = mysql_fetch_assoc($selectraap);
$nombre_tipo_poder= $rowraap['nombre_tipo_poder'];
mysql_free_result($selectraap);

$selectraa = mysql_query("select nombre_tipo_autorizacion_salida from tipo_autorizacion_salida where id_tipo_autorizacion_salida=".$id_tipo_autorizacion_salida." and estado_tipo_autorizacion_salida=1", $conexion);
$rowraa = mysql_fetch_assoc($selectraa);
$nombre_tipo_autorizacion_salida= $rowraa['nombre_tipo_autorizacion_salida'];
mysql_free_result($selectraa);


$selectraac = mysql_query("select nombre_tipo_custodia from tipo_custodia where id_tipo_custodia=".$id_tipo_custodia." and estado_tipo_custodia=1", $conexion);
$rowraac = mysql_fetch_assoc($selectraac);
$nombre_tipo_custodia= $rowraac['nombre_tipo_custodia'];
mysql_free_result($selectraac);

$proposito=substr ($nombre_salida_menor, 0, 57); 


$doc_menor=sigladoc($id_tipo_documento_menor);

$doc_padre=sigladoc($id_tipo_documento_padre);

$doc_madre=sigladoc($id_tipo_documento_madre);

$doc_psale=sigladoc($id_tipo_documento_psale);





$qr='https://sisg.supernotariado.gov.co/qrcode/salida&'.$identificador.'.gif';


	
require('fpdf/fpdf.php');
$pdf = new FPDF();


$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$pdf->image('images/cabezotesnr-2019.jpg',12,13,182);
$pdf->image('images/footer-snr-2019.jpg',12,265,182);

$pdf->Image(''.$qr.'',160,40,30,0,'GIF');
$pdf->Text(17,50,utf8_decode("SUPERINTENDENCIA DE NOTARIADO Y REGISTRO"));
$pdf->Text(17,55,utf8_decode("AUTORIZACIÓN DE SALIDA DE MENOR"));
$pdf->Text(17,60,utf8_decode("IDENTIFICADOR: ".$identificador));
$pdf->Text(17,65,utf8_decode("FECHA DE CREACIÓN: ".$fecha_carga));
$pdf->Text(17,80,utf8_decode("----------------------------------------------------------------------------------------------------------------------------------------------------"));

$pdf->Text(17,95,utf8_decode("Resumen de la información reportada por el Notario de conformidad con lo contemplado en el artículo 110 de la"));
$pdf->Text(17,100,utf8_decode("Ley 1098 del 2006, Decreto 960 de 1970 y Decreto 1260 de 1970."));

$pdf->Text(17,115,utf8_decode("Código de la Notaria: ".$codigo_dane));
$pdf->Text(17,120,utf8_decode("Notaria: ".$nombre_notaria));
$pdf->Text(17,125,utf8_decode("Departamento: ".$nombre_departamento));
$pdf->Text(17,130,utf8_decode("Municipio: ".$nombre_municipio));
$pdf->Text(17,135,utf8_decode("Email: ".$email_notaria));
$pdf->Text(17,140,utf8_decode("Nombre del Notario(a): ".$nombre_funcionario));




$pdf->Text(17,145,utf8_decode("Fecha de la autorización: ".$fecha_poder));
$pdf->Text(17,150,utf8_decode("Tipo de autorización: ".$nombre_tipo_poder));
$pdf->Text(17,155,utf8_decode("Solicitante u otorgante: ".$nombre_tipo_autorizacion_salida));


if (3==intval($id_tipo_poder)) {
$pdf->Text(17,160,utf8_decode("Número de escritura: ".$numero_escritura));
$pdf->Text(17,165,utf8_decode("Fecha de la escritura: ".$fecha_escritura));

} else if (4==intval($id_tipo_poder)) {
$pdf->Text(17,160,utf8_decode("Número de escritura: ".$numero_escritura.", Fecha de certificado vigencia: ".$fecha_escritura_vigencia));
$pdf->Text(17,165,utf8_decode("Fecha de la escritura: ".$fecha_escritura.", Hora del certificado: ".$hora_vigencia));

} else { 
$pdf->Text(17,160,utf8_decode("Número de escritura: No aplica"));
$pdf->Text(17,165,utf8_decode("Fecha de la escritura: No aplica"));
}

$pdf->Text(17,170,utf8_decode("Tipo de custodia: ".$nombre_tipo_custodia));
$pdf->Text(17,175,utf8_decode("Tipo de documento del menor: ".$doc_menor));
$pdf->Text(17,180,utf8_decode("Número de identificación: ".$identificacion_menor));
$pdf->Text(17,185,utf8_decode("Nombre del menor: ".$nombre_menor));

if (isset($identificacion_padre) && ""!=$identificacion_padre) {
$pdf->Text(17,190,utf8_decode("Tipo de documento del padre: ".$doc_padre));
$pdf->Text(17,195,utf8_decode("Número de identificación: ".$identificacion_padre));
$pdf->Text(17,200,utf8_decode("Nombre del padre: ".$nombre_padre));
} else {
$pdf->Text(17,190,utf8_decode("Tipo de documento del padre: No registro"));
$pdf->Text(17,195,utf8_decode("Número de identificación: No registro"));
$pdf->Text(17,200,utf8_decode("Nombre del padre: No registro"));
}

if (isset($identificacion_madre) && ""!=$identificacion_madre) {
$pdf->Text(17,205,utf8_decode("Tipo de documento de la madre: ".$doc_madre));
$pdf->Text(17,210,utf8_decode("Número de identificación: ".$identificacion_madre));
$pdf->Text(17,215,utf8_decode("Nombre de la madre: ".$nombre_madre));
} else {
$pdf->Text(17,205,utf8_decode("Tipo de documento de la madre: No registro"));
$pdf->Text(17,210,utf8_decode("Número de identificación: No registro"));
$pdf->Text(17,215,utf8_decode("Nombre de la madre: No registro"));
}


if (1==intval($sale_dif_padres)) {
$pdf->Text(17,220,utf8_decode("Sale del pais con una persona diferente a los padres: Si"));
$pdf->Text(17,225,utf8_decode("Tipo de documento de la persona que sale con el menor: ".$doc_psale));
$pdf->Text(17,230,utf8_decode("Número de identificación: ".$identificacion_psale));
$pdf->Text(17,235,utf8_decode("Nombre de la persona que sale con el menor: ".$nombre_psale));
}else if (0==intval($sale_dif_padres)) {
$pdf->Text(17,220,utf8_decode("Sale del pais con una persona diferente a los padres: No"));
$pdf->Text(17,225,utf8_decode("x"));
$pdf->Text(17,230,utf8_decode("x"));
$pdf->Text(17,235,utf8_decode("x"));
}else if (2==intval($sale_dif_padres)) {
$pdf->Text(17,220,utf8_decode("Sale del pais con una persona diferente a los padres: SI"));
$pdf->Text(17,225,utf8_decode("Viaja con personal de la aerolinea o empresa de transporte."));
$pdf->Text(17,230,utf8_decode("x"));
$pdf->Text(17,235,utf8_decode("x"));
} else {
$pdf->Text(17,220,utf8_decode("Sale del pais con una persona diferente a los padres: No"));
$pdf->Text(17,225,utf8_decode("x"));
$pdf->Text(17,230,utf8_decode("x"));
$pdf->Text(17,235,utf8_decode("x"));
}




$pdf->Text(17,240,utf8_decode("Fecha de salida: ".$fecha_salida.' / '.$fecha_salida_hasta));
$pdf->Text(17,245,utf8_decode("Proposito: ".$proposito));
if (1==$id_tipo_poder) {
$pdf->Text(17,250,utf8_decode("Pais: ".$nombre_pais));
$pdf->Text(17,255,utf8_decode("Fecha de retorno: ".$fecha_retorno." - ".$fecha_retorno_hasta));
} else {}


//$pdf->Write(5,'xxxx');
//$pdf->Output();


$pdf->Output('F', $directoryftp.$identificador.'.pdf', true);
chmod($directoryftp.$identificador.'.pdf',0777);



$updateSQL = "UPDATE salida_menor SET actualizacion=null where identificador_sm='$identificador' limit 1";
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());



} else {}

} else {}
 ?>


<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">
    <h3  class="box-title">
	Salida de menores
    </h3>
	  </div>
	  
	  
	  
	<!--  
	
<form class="navbar-form" name="fote5656rtrmrter1erteg" method="get" action="">

<div class="input-group">
<div class="input-group-btn">Buscar Radicado: 

</div>
<div class="input-group-btn">
<input type="hidden" name="q" value="salida_menor_pdf">
<input type="text" name="i" placeholder="" class="form-control" required ></div>
    
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"> Buscar </button> 
</div>
</div>

</form>
-->

<hr>
<table class="table" border="1">
<?php



//$queryj="select * from salida_menor where estado_salida_menor=1 order by id_salida_menor desc limit 3000";

$queryj="SELECT identificador_sm, file_autenticacion, file_civil FROM salida_menor WHERE estado_salida_menor=1 AND respuesta_migra IS NULL AND id_salida_menor>141";
$selectj = mysql_query($queryj, $conexion) or die(mysql_error());
$rowj = mysql_fetch_assoc($selectj);
$totalRowsj = mysql_num_rows($selectj);
if (0<$totalRowsj){	
$totovar='';
do { 
echo '<tr>';
$infosm=$rowj['identificador_sm'];


echo '<td>';
if (file_exists('files/salidas/'.$infosm.'/'.$infosm.'.pdf')) {
//echo '<a href="files/salidas/'.$infosm.'/'.$infosm.'.pdf">';
echo 'files/salidas/'.$infosm.'/'.$infosm.'.pdf';

echo ' - '.pdfVersion('files/salidas/'.$infosm.'/'.$infosm.'.pdf');

//echo ' - '.round((filesize('files/salidas/'.$infosm.'/'.$infosm.'.pdf'))/1048576, 2).' Mg';

//echo '</a>';

$totovar.='1';

chmod('files/salidas/'.$infosm.'/'.$infosm.'.pdf',0777);



} else { 
echo '<a href="https://sisg.supernotariado.gov.co/salida_menor_pdf&'.$infosm.'.jsp">'.$infosm.'</a>';
echo ' - No';
}
echo '</td>';







echo '<td>';
if (file_exists('files/salidas/'.$infosm.'/auto'.$infosm.'.pdf')) {
echo 'files/salidas/'.$infosm.'/auto'.$infosm.'.pdf';
$verauto=pdfVersion('files/salidas/'.$infosm.'/auto'.$infosm.'.pdf');
echo ' - '.$verauto;
if ('1.4'==$verauto){
$totovar.='1';
} else {}
} else { 
}
echo '</td>';






echo '<td>';
if (file_exists('files/salidas/'.$infosm.'/civil'.$infosm.'.pdf')) {
echo 'files/salidas/'.$infosm.'/civil'.$infosm.'.pdf';
$vercivil=pdfVersion('files/salidas/'.$infosm.'/civil'.$infosm.'.pdf');
echo ' - '.$vercivil;
if ('1.4'==$vercivil){
$totovar.='1';
} else {}
} else { 
}
echo '</td>';




echo '<td>';
if (file_exists('files/salidas/'.$infosm.'/AutoDocumentacion.txt')) {
echo 'files/salidas/'.$infosm.'/AutoDocumentacion.txt';
echo ' - '.round((filesize('files/salidas/'.$infosm.'/AutoDocumentacion.txt'))/1024, 2).' Kb';
$totovar.='1';
} else { 
}
echo '</td>';


echo '<td>';
if ('1111'==$totovar) {
echo '<a href="http://192.168.80.100:8081/test.php?iden='.$infosm.'" target="_blank">WS</a>';
} else { 
}
echo '</td>';


echo '</tr>';

$totovar='';
} while ($rowj = mysql_fetch_assoc($selectj)); 
	}
mysql_free_result($selectj);		
?>


</table>




</div>
</div>
</div>
</div>