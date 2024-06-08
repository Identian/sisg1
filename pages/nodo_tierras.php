<?php if (1==$_SESSION['rol']) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-md-12">
		  
  <form class="navbar-form" name="fo5435435rm1" method="post" action="">

             <div class="input-group">
			 <b>Consulta estado de WS</b>
			 </div>
    
			   <div class="input-group">
			 <select class="form-control" name="tipo" >
	  <option></option>
<option>nodo_usuario</option>
<option>nodo_servicio</option>
<option>nodo_usuario_servicio</option>
	  </select>
	  
			  </div>
			  
			  
			
			  
			  
              <div class="input-group">
                <button type="submit" class="btn  btn-success">Consultar</button>
              </div>

          
          </form>
		  

<?php
if (isset($_POST['tipo'])) {


$tipo=$_POST['tipo']; //nodo_usuario_servicio

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.210.130:8080/wsNodoTierras/'.$tipo.'.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);


//var_dump($response);


//$info = str_replace(array(",", "{", "}", "[", "]"), '<br>', $response);


//$infor = str_replace("<br><br>", "<br>", $info);



//echo $infor;

$obj=json_decode($response);

echo '<table class="table table-bordered" style="width:100%">';
foreach ($obj as $item) {

		echo '<tr>';
    foreach($item as $key => $value) {
        echo '<td>'.$key.': '.$value.'</td>';

	
    }
	echo '</tr>';
	
}
echo '</table>';



}
?>

</div>
</div>
</div>
</div>
</div>
<?php } ?>