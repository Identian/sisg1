<?php

$nump170=privilegios(170,$_SESSION['snr']);
 		 
if(1==$_SESSION['rol'] or 0<$nump170) {



?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('acoso'); ?></h3>

              <p>Registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>20<?php echo $anoactual; ?></h3>

              <p>Año</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>5</h3>
			  
              <p>Regionales</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>195</h3>
              <p>Oficinas de registro</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">
 
  
  <p>
  <b>Resultados de Acoso</b>


  </p>
  

	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
                <thead>
 <tr align="center" valign="middle">

<th>Fecha</th>
<th>¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por ser percibido(a) demasiado joven o viejo(a)?</th>
<th>¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por su origen étnico, color de piel o lenguaje: como el color de la piel, el lugar de nacimiento, la forma de vestirse, el idioma, la forma de hablar o sus prácticas culturales?</th>
<th>¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por ser hombre o mujer?</th>
<th>¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por su orientación sexual o identidad de género?</th>
<th>¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por su nivel educativo?</th>
<th>¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por sus posturas políticas?</th>
<th>¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por tener capacidades diferentes?</th>
<th>¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por alguno de estos motivos sus rasgos físicos o apariencia externa: por su peso, su estatura, tener una cicatriz o una marca de nacimiento, un tatuaje, arete o la forma de vestir?</th>
<th>¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por pertenecer o no a una religión?</th>
<th>¿Ha experimentado alguna forma de acoso u hostigamiento laboral por alguna de las siguientes prácticas mediado por miradas obscenas o petición de pláticas relacionadas con asuntos sexuales y/o proposiciones o peticiones directas o indirectas para establecer una relación sexual?</th>
<th>¿Ha experimentado alguna forma de acoso u hostigamiento laboral mediado por el contacto físico no deseado?</th>
<th>¿Ha experimentado alguna forma de acoso u hostigamiento laboral por alguna de las siguientes prácticas por ell ofrecimiento de recompensas o incentivos laborales a cambio de favores sexuales?</th>
<th>¿Ha experimentado alguna forma de acoso u hostigamiento laboral pa través de presiones o amenazas con daños o castigos en caso de no acceder a proporcionar favores sexuales?</th>

</tr>

	 </thead>
<tbody>
				
<?php 

$query4="SELECT * from acoso where estado_acoso=1  "; 

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
<td><?php echo $row['fecha_acoso']; ?></td>
<td><?php echo $row['acoso1']; ?></td>
<td><?php echo $row['acoso2']; ?></td>
<td><?php echo $row['acoso3']; ?></td>
<td><?php echo $row['acoso4']; ?></td>
<td><?php echo $row['acoso5']; ?></td>
<td><?php echo $row['acoso6']; ?></td>
<td><?php echo $row['acoso7']; ?></td>
<td><?php echo $row['acoso8']; ?></td>
<td><?php echo $row['acoso9']; ?></td>
<td><?php echo $row['acoso10']; ?></td>
<td><?php echo $row['acoso11']; ?></td>
<td><?php echo $row['acoso12']; ?></td>
<td><?php echo $row['acoso13']; ?></td>

</tr>
                <?php } ?>

				
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
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->








	  



<?php 
} else { echo 'No tiene acceso. ';} ?>





