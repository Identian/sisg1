<?php
if (isset($_GET['c']) && ""!=$_GET['c']) {
$valor=$_GET['c'];
	
$curl = curl_init();
curl_setopt_array($curl, array(
 // CURLOPT_URL => 'http://192.168.239.21/r1/CO-QA/GOB/SNR-0027/FM-SIR-QA/ConsultarPredios',
    CURLOPT_URL => 'http://192.168.80.110/r1/CO/GOB/SNR-0027/FM-SIR/ConsultarPredios',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,  //"000000020131000",
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "GetData": {
        "password": "q878eRs4#",
        "referenciaCatastral": "'.$valor.'",   
        "departamento": "25",
        "ip": "181.0.0.1",
        "indPazySalvo": true,
        "usuario": "MunChia",
        "notaria": "NOTARIA1",
        "entidad": "VUR",
        "municipio": "175",
        "matricula": ""
    }
}',
  CURLOPT_HTTPHEADER => array(
    'debug: true',
   // 'X-road-client: CO-QA/GOB/SNR-0027/FM-SIR-QA',
	 'X-road-client: CO/GOB/SNR-0027/FM-SIR',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

  $data = json_decode($response);
  $url=$data->Archivo;
  //echo $url;
  if (isset($url) && ""!=$url) {
  
  $aviso= '<br><b>Resultado: <a href="'.$url.'">Descargar Paz y salvo de la alcaldia de chia.</a></b>';
  } else { $aviso='<br><b>No se encontro registros asociados</b>';}
} else {
	
	 $aviso='';
	
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Certificado</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
$(document).ready(function() {
		$('#cert').click(function (){
		  //var cert =document.getElementById("idcert").value;
			 var cert =$('#idcert').value;	  
		var paginac = "/"+ cert +".html";
  location.href=paginac;			  
	});
	});
	
	</script>
  </head>
  <body>
    <div class="container">
      <form class="form-signin" method="get" name="rr">
        <h2 class="form-signin-heading">Ingrese el número de la referencia catastral:</h2>
        <label for="inputEmail" class="sr-only">Número</label>
		<br>
        <input type="text" id="idcert" name="c" value="<?php if (isset($_GET['c'])){ echo $_GET['c']; } else {} ?>" class="form-control" placeholder="Número" required autofocus>
        <br>
             <button class="btn btn-primary btn-block" type="submit" id="cert">Buscar</button>
      </form>
<br>
<center>
<?php echo $aviso; ?>
</center>
</div>
</body>
</html>
