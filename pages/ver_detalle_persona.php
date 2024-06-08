<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	
	
$numero=$_POST['option'];

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

$obj=json_decode($response);
$array=$obj->datoConsultado;

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

$expecedula1= explode(" ", $expecedula);
$expecedula2=$expecedula1[0];
if (5<strlen($namep)) {
?>


<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA EXPEDICIÓN DE CEDULA:</label>
              <input type="text" class="form-control datepickera" readonly name="fecha_exp_cedula" value="<?php echo $expecedula2;?>" required>
            </div>

<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE (Fuente: Procuraduria):</label>
              <input type="text" class="form-control" name="nombre_funcionario" readonly value="<?php echo $namep;?>" required>
            </div>


<?php } else { ?>
	
	<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA EXPEDICIÓN DE CEDULA:</label>
              <input type="text" class="form-control datepickera" name="fecha_exp_cedula" required>
            </div>
			
			
			
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE:</label>
              <input type="text" class="form-control" name="nombre_funcionario" required>
            </div>
<?php }


}
  ?>