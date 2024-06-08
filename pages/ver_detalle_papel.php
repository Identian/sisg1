<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
$idp=explode('-',$_POST['option']);
$provee=$idp[0];
$hoja=$idp[1];
?>
<div style="padding: 10px 10px 10px 10px">
<?php 

if (1==$provee) {
		echo 'Proveedor: Thomas greg<br>';
		echo 'Referencia: '.$hoja.'<br>';

//PO001188000
$curl2 = curl_init();
curl_setopt_array($curl2, array(
//  CURLOPT_URL => 'http://200.91.192.53:83/papelnotarial_qa/public/ConsultaPapelNotarial/informacionHoja',
  CURLOPT_URL => 'http://200.91.192.53:83/papelnotarial/public/ConsultaPapelNotarial/informacionHoja',
 
 CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
 "auth":{
"Usuario": "raycom",
"Contrasena": "aa33806def523479f2244ff7e491b9ce"
},
"numeroHoja" : "'.$hoja.'", 
"usoPapel" : "1"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: XSRF-TOKEN=eyJpdiI6ImZkUW5VN3M0cWU2QzlCeGpTb09RMUE9PSIsInZhbHVlIjoiV1lLOTA4NGVPKzBvWFhJdzhlRVwvSFBxR21nd1ZHVkxvVHorbTRLY3JCQUI4bjhrV3dSTytSMEdiXC81UDdSS1poOTVZUXh6SVI4bkxRdURzTG0yMlJqSE0wRGNjZkExd2NHNnVSZEZYaUF2ajdXV2U3WVFFSTJEV1VvTXJ0a0c5SiIsIm1hYyI6IjNmYWFmOGEzNjM0MjQwMmI3ZjMyZDFmOGRiMjkxNWM0ZDQxZmNiMGRjZmRjYzM0OTNmNmVlYWRlZTcxMDgxZDMifQ%3D%3D; iqVlfuZxqOeAzTnOPHMYs5klloHYLfUe7ySyhF3H=eyJpdiI6IjFpZys2TjZuNGx6dlBCbjNKOCtPdXc9PSIsInZhbHVlIjoidHZrTXFwcElHRHUwXC9vQ2U4RExhTVJXYUZPREF0VVZZdnBBOGZvNnhrTnlIcUhwMnhZVkY3QmlKU3ptN1FlWXdmbU9XcnZLc0FVaHBcL0RySDZSV1NkZ3FLY2VkSHdEdW5hdEtLYmF4UXdCTStNbDBwa1VmMFFZUCtIdzFsZjBRSk5scHFTWUFzR05BZ3BHZUZRS2hIMTNiSmRRRzgycHJjMmRoeU9UNDRjWHorQkJoQjQ0RFwvRXpQendJejdiYmg1SlRFRVVzYWFGOXBaWnFua2gzUXd6WnNlMEJhWEFqODBIbUZYbmhsVE1KSlBKOERzT1RUUzdxZDBWVk1PTExsbmxxdjRtdldJZHNDMzR4UU5nMnZmcGc9PSIsIm1hYyI6Ijk5Y2U0YTA1M2M5Zjk3OTg5NzUxZDA2YTk0YmNjMWZiNmExYWM2OTgxZWIxNTRkMTdjYjhmNmNiYThlZTBmMDYifQ%3D%3D; laravel_session=eyJpdiI6InltWENiUWxDZHkrUjJcL0hnQ1RHRVZnPT0iLCJ2YWx1ZSI6IjAwbWo3bE5tenlWVjRcL2ljR1hjTE9jXC9CXC9oWEFXWjFOdjE3V3RCZ01yZjd3TU1SVVpqcTd0TnhnQWg0Q2xjSFwvdGNONEFEMmhnVlpHcDBkb1dFVGtHOU5USlkyYjBXOEhvclFYRDk0a2swMXBWWVptdDc3c3EwM0Y2cVwvVnR4XC9jIiwibWFjIjoiYTcwYmM3N2VlYjZhYjQzMjM3YzUyYTA0ODFiZjQyZmExOWY1MWU3MDc5ZjRjMTJlMjA0OGMyNzIzOWE1YThmNSJ9'
  ),
));



$response2 = curl_exec($curl2);
curl_close($curl2);
$character2=json_decode($response2);


$code2=$character2->hoja->numeroHoja;
if (isset($code2) && ""!=$code2) {


echo 'Fecha impresion: '.$character2->hoja->fechaImpresion.'<br>';
echo 'Fecha entrega: '.$character2->hoja->fechaDespacho.'<br>';
echo 'Codigo: '.$character2->hoja->codigoSeguridad.'<br>';
echo 'Notaria: '.$character2->hoja->nombreNotaria.'<br>';

echo 'N. Perforado: '.$character2->hoja->codigoPerforado.'<br>';
echo 'Estado: ';

//.$character2->hoja->estado.
$estado2=$character2->hoja->estado;
if ('1'==$estado2) {
	echo 'Ingreso';
} else if ('2'==$estado2) {
	echo 'Egreso';
} else if ('3'==$estado2) {
	echo 'Asignado';
} else if ('4'==$estado2) {	
echo 'Archivado';	
} else if ('5'==$estado2) {
	echo 'Modificado';
} else if ('6'==$estado2) {
	echo 'Activo';

} else if ('7'==$estado2) {
	echo ' 
Asignado';
} else if ('8'==$estado2) {
	echo '
Inactivo';
} else if ('9'==$estado2) {
	echo '
Borrado';
} else if ('10'==$estado2) {
	echo '
Asignada';
} else if ('11'==$estado2) {
	echo '
Daño del papel en impresión';
} else if ('12'==$estado2) {
	echo '
Cambio por otra hoja';
} else if ('13'==$estado2) {
	echo '
Anulación definitiva';
} else if ('14'==$estado2) {
	echo '
Anulación de Hoja sin utilizar en las Asignaciones';
} else if ('15'==$estado2) {
	echo '
Anulación de Hoja sin utilizar en el inventario';
} else if ('16'==$estado2) {
	echo '
Inventario verificado';
} else if ('17'==$estado2) {
	echo '
Siniestro';
} else if ('18'==$estado2) {
	echo '
Hurto';
} else if ('19'==$estado2) {
	echo '
Pérdida o extravío';
} else if ('20'==$estado2) {
	echo '
Anulación definitiva';

} else {}

} else {
	echo 'No encontrado';
	
}
		
		
		
		
		
} else if (2==$provee) {
echo 'Proveedor: Segurdoc<br>';
echo 'Referencia: '.$hoja.'<br>';

			//https://segurdoclegis.com/?consecutivo=SAO300005001      SAO800000001
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://wcfpedidossegurdoc.segurdoclegis.com/api/consulta/'.$hoja.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic V1NzZWd1cmRvYzp3czNndXJkMGNfMjAxNw==',
    'Cookie: NSC_H16_MC_OPUBSJBEP_BQQSP_Q80=14b5a3d9ec0f49ae6fa9ac0aaca0a0a34e3fe448584af580e3cdc89a2ffaaed014a7c334'
  ),
));
$response = curl_exec($curl);
curl_close($curl);

$character=json_decode($response);



$code=$character->Consecutivo;
if (isset($code) && ""!=$code) {


echo 'Fecha impresion: '.$character->FechaImpresion.'<br>';
echo 'Fecha entrega: '.$character->FechaDespacho.'<br>';
echo 'Codigo: '.$character->Alfanumerico.'<br>';
echo 'Notaria: '.$character->Notaria.'<br>';

echo 'Tipo: '.$character->TipoPapel.'<br>';
echo 'Estado: ';
$estado=$character->IDEstadoDetalle;
if ('G'==$estado) {
	echo 'Generado';
} else if ('A'==$estado) {
	echo 'Asignado';
} else if ('D'==$estado) {
	echo 'Despachado';
} else if ('E'==$estado) {	
echo 'Entregado';	
} else if ('N'==$estado) {
	echo 'Novedad';
} else if ('U'==$estado) {
	echo 'Anulado';
} else {}
	          


} else {
	echo 'No encontrado';
	
}




} else if (3==$provee) {
	echo 'Proveedor: Cadena<br>';
	echo 'Referencia: '.$hoja.'<br>';
	
	
$curl3 = curl_init();

curl_setopt_array($curl3, array(
  CURLOPT_URL => 'https://webservicenotarios.cadena.com.co/api/ConsultaResma/ConsultarInformacionHoja/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "NumeroHoja": "'.$hoja.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic V2ViQVBJOlczYkFQSU4wNzRyMTBz',
    'Content-Type: application/json',
    'cache-control: no-cache',
    'Postman-Token: 3d2bb561-8766-4852-8512-4f03764573ca'
  ),
));



$response3 = curl_exec($curl3);
curl_close($curl3);
$character3=json_decode($response3);

$code3= $character3->Resultado;

if (isset($code3) && ""!=$code3) {

$obja = $character3->ListObjetoRetorno;

foreach ($obja as $charactera3) {
echo 'Fecha impresion: '.$charactera3->FechaImpresion.'<br>';
echo 'Fecha entrega: '.$charactera3->FechaDespacho.'<br>';
echo 'Codigo: '.$charactera3->Alfanumerico.'<br>';
echo 'Notaria: '.$charactera3->NombreNotaria.'<br>';
echo 'N. Perforado: '.$charactera3->DigitoPerforado.'<br>';
echo 'Estado: '.$charactera3->Estado.'<br>';
}
	
	


} else {
	echo 'No encontrado';
	
}




	
	
} else {}
	
?>
</div>
<?php 
} else { }
?>




