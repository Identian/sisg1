<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {

$hostname_conexion2 = "192.168.80.12";
$database_conexion2 = "sisg";
$username_conexion2 = "sisg";
$password_conexion2 = "C0l0mb1@19*";

global $mysqli;
$mysqli = new mysqli($hostname_conexion2, $username_conexion2, $password_conexion2, $database_conexion2);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}

	
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
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL ENCARGADO (Fuente: Procuraduria):</label>
              <input type="text" class="form-control" name="nombre_encargado" readonly value="<?php echo $namep;?>" required>
            </div>


<?php } else { ?>
	
<!-- <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL ENCARGADO:</label>
              <input type="text" class="form-control" name="nombre_encargado" required>
            </div>-->
<?php }




function existesisg($cedula) {
global $mysqli;
$query4hj = sprintf("SELECT nombre_funcionario FROM funcionario where cedula_funcionario=".$cedula." and estado_funcionario=1"); 
$result4hj = $mysqli->query($query4hj);
$row4hj = $result4hj->fetch_array();
if (0<count($row4hj)){
$reshhj='Si existe '.$row4hj['nombre_funcionario'].' en SISG.';
} else {
$reshhj='No existe la persona en SISG. Por favor agregarla: <a href="personal_notaria.jsp" target="_blank">Personas en Notarias</a>';
}
return $reshhj;
$result4hj->free();
}

echo existesisg($numero);


}
  ?>