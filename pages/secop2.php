<?php if (1==$_SESSION['rol']) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-md-12">
		  
  <form class="navbar-form" name="fo5435435rm1" method="post" action="">

             <div class="input-group">
			 <b>CONSULTA SECOP II</b>
			 </div>
    
			   <div class="input-group">
			   Tipo de documento
         <select class="form-control" name="tipo" >
	  <option></option>
<option value="CC">CEDULA DE CIUDADANIA</option>


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

$ani=date('y');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.80.110/r1/CO/GOB/CCE-8033/CERTICON/wsConsultaContratosEntidad/pro/2000-01-01/20'.$ani.'-12-31/'.$tipo.'/'.$numero.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'x-road-client: CO/GOB/SNR-0027/FM-SIR',
    'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ1NXMzckM0cnAzdDQifQ.Y_bn-wolLvuKcQ8yeH5jbUnsTO-OYc-PnhL3HYaoVwk',
    'Cookie: .AspNet.Cookies=cz60Z1mEiQqaDWuuafrrEB--74aj9nwAWbjTdZgYAg7NXO_EKEgNR89vJDJeljuKg0EbRfgZurC3rkOO6YYquAktVrTiP6evWUxZ8FxL-x-DZbenbzrFG_MgOkO-QMj72QD80AXIf8w7tQ5t5z6k79ZN_qpA451DZY0lnnXSrS5IfTHkOwZlR7cQX0obKFkyzdfaZ00qtGssGSCFkXU3VeeuZ8_uJZUuyx7JuhtjnOfXNAeGQv22vzVsq6BI_8hZumVgGUZaMMITfO6UjIM_iEvCQmQgElajMSwJVzp8QBCC_OgQrY7gzKIxfYSDN40MQeW3wqYPsy18yEPJ7T7E7irU6hOPfGXjYNtyl8fWizmdykYsgGM9zx27iGFMXl634eoAjOZolaY_WWysaKY1M8q8KgR88qozwdTM5inXIWYDcpAedwLKA5JYsUf9vdEWfCHI9CCieCKuT16if2qam0yUs-OpoJi7OehN6rbJ8imSTAsjscpH1wWTJTnZS0TZ; JSESSIONID=ytsOGqhCfxtV6ebGsvhEqVGqpxODYr-jW5Z1EWQWxFVjXucQzVUg!-848547927'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

/*
echo $response;

var_dump($response);

echo '<hr>';
$obj=json_decode($response);

$array=$obj->contratosSECOPII;

foreach ($array as $character) {
	
echo $character->nombredelaEntidad;
echo ', ';
echo $character->numerodelContrato;
echo ', ';
echo $character->fechaIniciodelContrato;
echo ', ';
echo $character->fechaFindelContrato;
echo ', <a href="';
echo $character->link;
echo '" target="_blank">Contrato</a><hr>';
}*/


$info = str_replace(array(",", "{", "}", "[", "]"), '<br>', $response);


$infor = str_replace("<br><br>", "<br>", $info);


echo $infor;



}
?>

</div>
</div>
</div>
</div>
</div>
<?php } ?>