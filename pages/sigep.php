<?php if (1==$_SESSION['rol']) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-md-12">
		  
  <form class="navbar-form" name="fo5435435rm1" method="post" action="">

             <div class="input-group">
			 <b>CONSULTA SIGEP</b>
			 </div>
    
			   <div class="input-group">
			   Tipo de documento
         <select class="form-control" name="tipo" required>
	  <option></option>
<option value="CEDULA DE CIUDADANIA">CEDULA DE CIUDADANIA</option>


	  </select>
	  
			  </div>
			  
			  
		
			  
			  
			  
			  
			   <div class="input-group">
			   Número de documento
              <input name="numero"  class="form-control numero"  value="<?php echo $_POST['numero']; ?>" required>
			  </div>
			  
			  
              <div class="input-group">
                <button type="submit" class="btn  btn-success">Consultar</button>
              </div>

          
          </form>
		  

<?php
if (isset($_POST['numero'])) {


$tipo=$_POST['tipo'];
$numero=$_POST['numero'];
echo $tipo.': '.$numero.'<br>';


$li=array( 
 'tipoDocumento'=>$tipo,
 'numerodocumento'=>$numero);
	 
$ws=json_encode($li);

$datos=base64_encode($ws);


//AUTENTICACION

$aacurl = curl_init();

curl_setopt_array($aacurl, array(
  CURLOPT_URL => 'http://192.168.80.110/r1/CO/GOB/DAFP-0022/SIGEP/wsAutenticacion',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'ewogICJub21icmVVc3VhcmlvIjogIjc5ODY4NTEyIiwKICAiY29udHJhc2VuYUUiOiAiMUo4N0tNZlF1dSt2cnY0RUJ0TkpDQT09IiwKICAiY29kaWdvU2lnZXAiOiAiMDAyNyIKfQ==',
  CURLOPT_HTTPHEADER => array(
    'Accept: text/plain',
    'Content-Type: text/plain',
    'typeResponse: json',
    'x-road-client: CO/GOB/SNR-0027/FM-SIR',
    'Cookie: .AspNet.Cookies=atUeqeP2EfWCoxlaziLJN_DLBc2v4ZO5tnF9WzatksJqozTBJ8w-pGWyxUatX0Sa3Pt0t-sU7WkDjsOWCHiy3nDeA4GXmTjNnbHv9ueml5uIWbPz1Atz6Yoyfcsp2bZcZXSJYINoiVVXTi0pMH4b84bG4GBzh9WIUEjoRiK01-TRaO9DTsFsS2kCewySjrN1ZG5vodagF1iqAAGPvfEa3z9ioggEyvm2OCmrkGC4Xezl_uSh2kZQ_shAqrkNwCD0MiaLc4ItUMV_pGhN8zc3pFHIEj7xr_qLW1IKiBhQKqYVIihV7MlQ8PnlLxn4tH4kv2P2rV7a1F6vVcuA-zSqHliMXHLGJ_FFN3z1M3LBeFQ3h6Jm0QT7ov3Aiw3YnMTgr3zNaZohQ_Gpph_OR4n76XEKgfhInBAk4suXX1ut1hGdYhSWuODokudNeSGwMy-nJUk83UFGpJMmBAh5J953nQCLG0Y5XkpYimjmW8JfOuJZbDRzmhsoys5LpXF3XnLyHaJLEjV1zi-bhoSs3XjPGQ'
  ),
));

$aaresponse = curl_exec($aacurl);

curl_close($aacurl);

$aaresponses=base64_decode($aaresponse);

$obje=json_decode($aaresponses);

$clave= $obje->autenticacion->token;

echo '<hr>';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.80.110/r1/CO/GOB/DAFP-0022/SIGEP/wsConsultaHojaVida',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: text/plain',
    'Content-Type: text/plain',
    'typeResponse: json',
    'x-road-client: CO/GOB/SNR-0027/FM-SIR',
    'token: '.$clave.'',
    'json: '.$datos.'',
    'Cookie: .AspNet.Cookies=atUeqeP2EfWCoxlaziLJN_DLBc2v4ZO5tnF9WzatksJqozTBJ8w-pGWyxUatX0Sa3Pt0t-sU7WkDjsOWCHiy3nDeA4GXmTjNnbHv9ueml5uIWbPz1Atz6Yoyfcsp2bZcZXSJYINoiVVXTi0pMH4b84bG4GBzh9WIUEjoRiK01-TRaO9DTsFsS2kCewySjrN1ZG5vodagF1iqAAGPvfEa3z9ioggEyvm2OCmrkGC4Xezl_uSh2kZQ_shAqrkNwCD0MiaLc4ItUMV_pGhN8zc3pFHIEj7xr_qLW1IKiBhQKqYVIihV7MlQ8PnlLxn4tH4kv2P2rV7a1F6vVcuA-zSqHliMXHLGJ_FFN3z1M3LBeFQ3h6Jm0QT7ov3Aiw3YnMTgr3zNaZohQ_Gpph_OR4n76XEKgfhInBAk4suXX1ut1hGdYhSWuODokudNeSGwMy-nJUk83UFGpJMmBAh5J953nQCLG0Y5XkpYimjmW8JfOuJZbDRzmhsoys5LpXF3XnLyHaJLEjV1zi-bhoSs3XjPGQ'
  ),
));

$response1 = curl_exec($curl);

curl_close($curl);


$response= base64_decode($response1);

//var_dump($response);


$info = str_replace(array(",", "{", "}", "[", "]"), '<br>', $response);


$infor = str_replace("<br><br>", "<br>", $info);


echo $infor;


echo '<hr>';

$obj=json_decode($response);


$celu=$obj->hojaVidaPersona->datoContato->numCelular;

$dire=$obj->hojaVidaPersona->datoContato->direccionResidencia;

$nacim=$obj->hojaVidaPersona->fechaNacimiento;

$correoalt=$obj->hojaVidaPersona->correoElectronico;

//echo $celu.$dire.$nacim.$correoalt;


echo '<hr>'.$response;

}
?>

</div>
</div>
</div>
</div>
</div>
<?php } ?>