<?php
	if (isset($_GET['i'])) {
	$id=$_GET['i'];

?>

<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  

<div class="col-md-4">
 Validación de licencias
</div>
<div class="col-md-8">

	 <h3><?php echo quees('curaduria', $id); ?>
	 
	  <a href="https://sisg.supernotariado.gov.co/xls/licencias&<?php echo $id; ?>&0.xls"><img src="images/xls.png"> En repositorio</a>
	  
	 </h3>
	    
	  						<form method='post' enctype="multipart/form-data" name="adjuntar_documento">
	          					<label>Carga Archivo de Licencias en formato .csv (Única columna)</label>			              		
								
								<input type="hidden" name="soporte"> 
								<input type="file" name="sel_file" class="adjuntar">  
						  
			              		<input type='submit' name='subirmaxivo' value=' Agregar archivo ' class="btn btn-xs btn-success">

					    	</form>


</div>
	
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones22" cellspacing="0" width="100%">
	
<thead>
 <tr align="center" valign="middle">
 <th>Número</th>	 	
<th>Resultado</th>		  
</tr>
</thead>

<tbody>

<?php
	  if(isset($_POST['soporte']))
                      {
						  
						    echo '<tr><td><b>Radicado</b></td><td><b>Resultado</b></td></tr>';  
							
							
						  $array1 = array();
						  
                          //Aquí es donde seleccionamos nuestro csv
                           $fname = $_FILES['sel_file']['name'];
                           //echo 'Cargando nombre del archivo: '.$fname.' <br>';
                           $chk_ext = explode(".",$fname);
                   
                           if(strtolower(end($chk_ext)) == "csv")
                           {
                               //si es correcto, entonces damos permisos de lectura para subir
                               $filename = $_FILES['sel_file']['tmp_name'];
                               $handle = fopen($filename, "r");
                   
                               while (($data = fgetcsv($handle, 99999, ";")) !== FALSE)
                               {
								  
		$val1=$data[0];
		$val=trim($val1);
	   echo '<tr>';
	    echo '<td>';
		echo $val;
		echo '</td>';

	echo '<td>';
			
		
$actualizar5u = mysql_query("SELECT count(id_licencia_curaduria) as totfac FROM licencia_curaduria WHERE id_curaduria=".$id." and nombre_licencia_curaduria='$val' and estado_licencia_curaduria=1 ", $conexion);
$row15u = mysql_fetch_assoc($actualizar5u);
$totfac=$row15u['totfac'];
   
   if (0<$totfac) {		
			
			
 echo 'Si' ; 
array_push($array1, 1);

} else {
	
	 echo 'No existe' ; 
	
	
}			   
	
	echo '</td>';
		 echo '</tr>';
	
							   
							 
							   }
                           
						 
                               fclose($handle);
                          
                           }
                           else
                           {
                              echo '<tr><td>El formato no es el correcto</td><td></td></tr>';
                           }
						   
						   
						  
						 
						   
                      } else {}
					  ?>

</tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 <?php
						    $tramite=array_sum($array1);
						     echo 'Cantidad de coincidencias: '.$tramite.''; 		
		 ?>
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->

<?php


} else {}
?>

