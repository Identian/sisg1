<?php if (1==$_SESSION['rol']) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-md-12">
		  
  <form class="navbar-form" name="fo5435435rm1" method="post" action="">

             <div class="input-group">
			 <b>Consulta indice de propietario</b>
			 </div>
    
			   <div class="input-group">
			   Tipo de documento
         <select class="form-control" name="tipo" >
	  <option></option>
<option value="CC">Cedula</option>


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
$curl = curl_init();

$tipo=$_POST['tipo'];

$numero=$_POST['numero'];

echo $tipo.$numero;

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.202.60:8001/transformador/snr/ConsultaIndicePropietariosActualesREST/documento',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"tipoConsulta":"VUR",
"numeroDirecciones":"0",
"numeroPropietarios":"0",
"numeroIdentificacion":"'.$numero.'",
"tipoId":"'.$tipo.'",
"sistemaUsuario":"Exentos",
"clave":"22"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

//var_dump($response);


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