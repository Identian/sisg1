<?php
$nump122=privilegios(122,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump122) {

?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3>
			  <?php	  
			  echo existencia('votacion_cscr_2022');

			  ?></h3>
              <p>Cantidad de votos</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo existencia('oficina_registro'); ?></h3>

              <p>Oficinas de registro</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>
<?php echo $realdate; ?>
			  </h3>
			 
              <p>Año</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $realdate; ?></h3>
              <p>Año</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-3">
<?php 

$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2022-11-17 18:00:00");

 if (1==1) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal">
        RESULTADOS
      </button></h3>
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-5">


</div>

<div class="col-md-4">

	   </div>
  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th>FECHA</th>
   <th>REGISTRADOR</th>
   <th>CORREO PERSONAL</th>
<TH>HASH DEL VOTO</TH>	
<TH>TIPO</TH>			  
</tr>
</thead>
<tbody>
<?php 



$query4="SELECT id_votacion_cscr_2022, id_candidato_votacion_cscr_2022, fecha_votacion_cscr_2022, nombre_funcionario, correo_funcionario, nombre_votacion_cscr_2022, nombre_cargo_nomina  
from 
votacion_cscr_2022, funcionario, cargo_nomina  
where votacion_cscr_2022.id_funcionario=funcionario.id_funcionario and votacion_cscr_2022.cargo=cargo_nomina.id_cargo_nomina and estado_votacion_cscr_2022=1";



$result = $mysqli->query($query4);
$var1=array();
$var2=array();
$var3=array();
				
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
				
if (1==intval($row['id_candidato_votacion_cscr_2022'])) {
	array_push($var1, 1);
}	else if (2==intval($row['id_candidato_votacion_cscr_2022'])) {
		array_push($var2, 2);
	}	else if (3==intval($row['id_candidato_votacion_cscr_2022'])) {
			array_push($var3, 3);
		}	else{}
		
		
echo '<td>'.$row['fecha_votacion_cscr_2022'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp" target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>'.$row['correo_funcionario'].'</td>';
echo '<td>'.$row['nombre_votacion_cscr_2022'].'</td>';
echo '<td>'.$row['nombre_cargo_nomina'].'</td>';

?>

                  </tr>
                <?php } 
				

$result->free();





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

		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Resultados</h4>
      </div>
      <div class="modal-body">


REGISTRADOR PRINCIPAL
<div class="form-group text-left siimpedimento"> 
<label  class="control-label"> Plancha 1:</label> 
Martha Perez / Luz Quintero<br>
15
</div>


<div class="form-group text-left siimpedimento"> 
<label  class="control-label"> Plancha 2:</label> 
Hernan Zuluaga / Cleofe Rugeles<br>
8
</div>

<HR>
REGISTRADOR SECCIONAL

<div class="form-group text-left siimpedimento"> 
<label  class="control-label"> Plancha 1:</label> 
Luisa Ballen / Deyanira Mendez<br>
34
</div>

<div class="form-group text-left siimpedimento"> 
<label  class="control-label"> Plancha 2:</label> 
Gustavo Aguirre / Eduard Gomez<br>
14
</div>




      </div>
    </div>
  </div>
</div>



<?php } else { }?>



