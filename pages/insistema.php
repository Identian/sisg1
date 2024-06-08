<?php 
$uri='http://192.168.202.57/';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	

$a1=$_POST;
$a2=array("usuario"=>"1226","url"=>"sisg");
$arrayfinal= array_merge($a1,$a2);
echo json_encode($arrayfinal);

	
	/*
$campos = json_encode($_POST);
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $uri.'wsInSistema/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$campos,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic c2VjdXJpdHk6c2VjdXI=',
    'Content-Type: application/json'
  ),
));
$response = curl_exec($curl);
curl_close($curl);

$resp = json_decode($response);
$res=$resp->respuesta;
if (1==$res) {
	echo $insertado;
} else {}
*/


} else {}
//wsrest/wsInSistema/
?>
<form action="" method="post" name="form1">
<input type="text" name="nombre_aplicacion" value="sisg">
<input type="int" name="estado_aplicacion" value="1">
<input type="date" name="nombre_area" value="2022-09-25">
<textarea name="descripcion_aplicacion">Sistema Integrado</textarea>
<input type="text" name="form" value="aplicacion">
<input type="submit"  value="enviar">
</form>