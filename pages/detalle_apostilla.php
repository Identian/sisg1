<?php
if (isset($_GET['i']) && ""!=isset($_GET['i']) && isset($_GET['e'])) {
	
$files=$_GET['i'];


$documentof3='filesnr/apostilla/'.$files.'.pdf';


if (file_exists($documentof3)) {



$json1 = file_get_contents('https://sisg.supernotariado.gov.co/wsrest/wsMetadataPDF//'.$files.'.json');
$json2 = json_decode($json1, true);
$res= $json2['estado'];
if (1==$res) {
	
echo 'Documento con metadados <br>';
$xml= $json2['data'];
//echo $xml;
$info=explode('<IdAutoridad>', $xml);
$info2=$info[1];
$info3=explode('</IdAutoridad>', $info2);
$code=$info3[0];
echo 'Codigo de autoridad en el documento: '.$code.'<br>';
echo 'Codigo de autoridad del registro: '.$_GET['e'].'<br>';
if ($code==$_GET['e']) {
	echo 'Mismo codigo en el sistema y en el documento pdf.';
} else {
	echo '<b>Diferente</b> codigo en el sistema y en el documento pdf. <b>Debe volver a radicarlo.</b>';
}

$json10 = file_get_contents('https://sisg.supernotariado.gov.co/wsrest/wsVersionPDF/'.$files.'.json');
$json20 = json_decode($json10, true);
echo '<br>Version del PDF: ';
echo $json20['pdfVersion'];
echo '<br>';


ECHO 'Firma digital en el documento: ';
$json15 = file_get_contents('https://sisg.supernotariado.gov.co/firmado/'.$files.'.json');
$res = json_decode($json15);
var_dump($res->pdfSignatureInfo[0]->certificateInfo->subjectOIDs->CN);

echo '<br>Nombre del que genero el radicado: ';

function autoridad($fun) {
global $mysqli;
$funi=$fun.'.pdf';
$query4hj = sprintf("SELECT nombre_funcionario, identificador_a FROM funcionario, apostilla where funcionario.id_funcionario=apostilla.id_funcionario and apostilla.filefirmado='$funi' "); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();
$reshhj=$row4hj['nombre_funcionario'].'-'.$row4hj['identificador_a'];
return $reshhj;
$result4hj->free();
}

$vare=autoridad($files);
$name=explode('-',$vare);
echo $name[0];
echo '<br>Los nombres deben ser iguales.';

echo '<br>Por favor valide el documento con el código de radicación: '.$name[1];
echo '<br>En el sitio web: <a href="https://tramites.cancilleria.gov.co/ApostillaLegalizacion/validacionDocumento/superNotariado.aspx?c=23" target="_blank">De Cancilleria</a>';


} else {
	//echo 'Documento sin metadatos, <b>debe volver a radicarlo.</b>';
}



}


} else {}


?>