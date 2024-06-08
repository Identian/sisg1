 
 <?php
 
 $url = 'http://192.168.210.150:9002/api/rest/query/consolidador/cuentas/';

 /*
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  echo $data->fecha_antropomeria;
  curl_close($ch);
print_r($data);
*/



$output = file_get_contents($url);
$characters = json_decode($output); 
		  
		 echo '#';
		// echo $characters->resultados[0]->tipo_cuenta;		 
		 echo $characters->cantidadRegistros;	 
		 echo '<br>';	 
	$n= count($characters->resultados);
	 echo '<table border="1">';	
for($x = 0; $x < $n; $x++) {	
	 echo '<tr>';
	 echo '<td>';
	 echo $characters->resultados[$x]->codigo_sucursal;
	 echo '</td><td>';
	 echo $characters->resultados[$x]->codigo_banco;
	 echo '</td><td>';
	echo $characters->resultados[$x]->nro_cuenta;
	 echo '</td><td>';
	  echo $characters->resultados[$x]->tipo_cuenta;
	   echo '</td><td>';
	   	echo $characters->resultados[$x]->estado;
	 echo '</td>'; 
    echo '</tr>';
}
 echo '</table>';



 
 
  $urlinsert = 'http://192.168.210.150:9002/api/rest/insert/';
  
 /*
$array = array(
    "tabla" => "cuentas",
    "dataSource" => "JSON",
    "datos" => array(
     "codigo_sucursal" => "888",
     "codigo_banco" => "88",
	 "nro_cuenta" => "8888",
      "tipo_cuenta" => "P",
	  "estado" => "A"
		  
		  
         )
);*/


$array= '
{
 "tabla": "cuentas",
    "dataSource":"JSON",
    "datos": {
     "codigo_sucursal": "888",
     "codigo_banco": "88",
	 "nro_cuenta": "8888",
      "tipo_cuenta": "P",
	  "estado": "A"
}
}
';

//echo $array;



$age = array("sql"=>"SELECT TPROPIETARIO.PRO_IDENTIFICACION, TPROPIETARIO.PRO_PRIMERNOMBRE, TPROPIETARIO.PRO_SEGUNDONOMBRE, TPROPIETARIO.PRO_PRIMERAPELLIDO, TPROPIETARIO.PRO_SEGUNDOAPELLIDO, TMATRICULA.MAT_MATRICULA, TMATRICULA.MAT_CEDULACATASTRAL, TMATRICULA.MAT_FECHACREACION, TMATRICULA.MAT_ESTMATRICULA, TMATRICULA.MATIDCIRCULO, TCIRCULO.CIR_NOMBRE, TMATRICULA.MAT_DIRECCION FROM TCIRCULO, TPROPIETARIO, TMATRICULAPROPIETARIO, TMATRICULA WHERE TCIRCULO.CIR_IDCIRCULO=TMATRICULA.MATIDCIRCULO AND TMATRICULAPROPIETARIO.MAPIDMATRICULA=TMATRICULA.MAT_IDMATRICULA AND TPROPIETARIO.PRO_IDPROPIETARIO=TMATRICULAPROPIETARIO.MAPIDPROPIETARIO AND  TPROPIETARIO.PRO_IDENTIFICACION=53096514", 
"dataSource"=>"ncentral", 
"desde"=>1,
"hasta"=>100
);

echo json_encode($age);
?>


 <!--<script src="../plugins/jQuery/jquery.min.js"></script>-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script>
      $(document).ready(function(){
	  $('#enviar').click(function (){
		 // var arreglo = <?php echo $age;?>;
		  
			
		  var arreglo = {'sql':'SELECT TPROPIETARIO.PRO_IDENTIFICACION, TPROPIETARIO.PRO_PRIMERNOMBRE, TPROPIETARIO.PRO_SEGUNDONOMBRE, TPROPIETARIO.PRO_PRIMERAPELLIDO, TPROPIETARIO.PRO_SEGUNDOAPELLIDO, TMATRICULA.MAT_MATRICULA, TMATRICULA.MAT_CEDULACATASTRAL, TMATRICULA.MAT_FECHACREACION, TMATRICULA.MAT_ESTMATRICULA, TMATRICULA.MATIDCIRCULO, TCIRCULO.CIR_NOMBRE, TMATRICULA.MAT_DIRECCION FROM TCIRCULO, TPROPIETARIO, TMATRICULAPROPIETARIO, TMATRICULA WHERE TCIRCULO.CIR_IDCIRCULO=TMATRICULA.MATIDCIRCULO AND TMATRICULAPROPIETARIO.MAPIDMATRICULA=TMATRICULA.MAT_IDMATRICULA AND TPROPIETARIO.PRO_IDPROPIETARIO=TMATRICULAPROPIETARIO.MAPIDPROPIETARIO AND  TPROPIETARIO.PRO_IDENTIFICACION=53096514', 
		  'desde':1, 
		  'hasta':100
		  }
	/*		
arreglo["sql"] = "SELECT TPROPIETARIO.PRO_IDENTIFICACION, TPROPIETARIO.PRO_PRIMERNOMBRE, TPROPIETARIO.PRO_SEGUNDONOMBRE, TPROPIETARIO.PRO_PRIMERAPELLIDO, TPROPIETARIO.PRO_SEGUNDOAPELLIDO, TMATRICULA.MAT_MATRICULA, TMATRICULA.MAT_CEDULACATASTRAL, TMATRICULA.MAT_FECHACREACION, TMATRICULA.MAT_ESTMATRICULA, TMATRICULA.MATIDCIRCULO, TCIRCULO.CIR_NOMBRE, TMATRICULA.MAT_DIRECCION FROM TCIRCULO, TPROPIETARIO, TMATRICULAPROPIETARIO, TMATRICULA WHERE TCIRCULO.CIR_IDCIRCULO=TMATRICULA.MATIDCIRCULO AND TMATRICULAPROPIETARIO.MAPIDMATRICULA=TMATRICULA.MAT_IDMATRICULA AND TPROPIETARIO.PRO_IDPROPIETARIO=TMATRICULAPROPIETARIO.MAPIDPROPIETARIO AND  TPROPIETARIO.PRO_IDENTIFICACION=53096514";
arreglo["desde"] = 1;
arreglo["hasta"] = 100;
*/
			
			
			
			
					//$( "#vero" ).html(info);
						jQuery.ajax({
                                type: "POST",
								url: "https://192.168.210.150:19002/api/rest/queryNative/",
								//url: "https://sisg.supernotariado.gov.co/demo/demo.php",
								data: arreglo,
								async: true,
                                success: function(b) {
                                        $("#vero").html(b);		
                                }
                        })
                });
})

</script>		
				
	  
<button id="enviar">
Ver</button>


<div id='vero' style="border:2px solid#888;">

</div>



