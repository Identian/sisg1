<?php if (1==$_SESSION['rol']) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-md-12">
		  
  <form class="navbar-form" name="fo544535435rm1" method="post" action="">

  
			   <div class="input-group">
			   
              <input name="numero"  placeholder="Número de identificación" class="form-control numero"  value="<?php echo $_POST['numero']; ?>" required>
			  </div>
			  
			  
              <div class="input-group">
                <button type="submit" class="btn  btn-success">Consultar</button>
              </div>

          
          </form>
		  

<?php
if (isset($_POST['numero'])) {


$numero=$_POST['numero'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.80.110/r1/CO/GOB/PGN-0878/SIRI/wsAntecedentes/CC/'.$numero.'?UsuarioExpide=SNR-0027',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'X-road-client: CO/GOB/SNR-0027/FM-SIR',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

//var_dump($response);


$obj=json_decode($response);


$array=$obj->datoConsultado;


foreach ($array as $item) {

	
	 
    foreach($item as $key => $value) {
        echo $value.'<br>';
if (100<strlen($value)) {
	$file=$value;
} else {}
	
    }
	
	
}




echo '<form action="https://servicios.supernotariado.gov.co/generarpdf/" method="post" name="45435435" target="_blank"><input type="hidden" name="basepdf" value="'.$file.'"><button class="btn btn-xs btn-success" type="submit">Descargar</button></form>';



$n=1;
foreach ($array as $character) {
	$n=$n+1;
	if (3==$n) {
$cedula=$character->valorDato;
	} else if (6==$n) {
$pnombre=$character->valorDato;
	} else if (7==$n) {
$snombre=$character->valorDato;
	} else if (4==$n) {
$papellido=$character->valorDato;
	} else if (5==$n) {
$sapellido=$character->valorDato;
	} else if (8==$n) {
$expecedula=$character->valorDato;

		} else {}

}

$namep=$pnombre.' '.$snombre.' '.$papellido.' '.$sapellido;
echo $namep;



}
?>

</div>
</div>
</div>
</div>
</div>
<?php } ?>