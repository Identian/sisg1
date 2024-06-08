<?php
$nump116=privilegios(116,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump116) {


?>
 
  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3>195</h3>

              <p>Orips</p>
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
              <h3><?php $votos=existencia('votacion_juntac'); echo $votos; ?></h3>

              <p>Votantes</p>
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
             
 <h3> <?php 
echo $votos;
  ?>
  


</h3>	 
              <p>Votos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="" <?php if (1==1) { echo 'data-toggle="modal" data-target="#myModal" '; } else {} ?> class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo date('Y-m-d'); ?></h3>
              <p>Fecha</p>
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
  
  
  
  <div class="col-md-4">
Resultado de Votación
</div>
	  
	  
	  
	   <div class="col-md-8">

</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th>HASH</th>

<th>FUNCIONARIO</th>
<th>FECHA</th>	  
</tr>
</thead>
<tbody>
<?php 
$query4="select nombre_votacion_juntac, fecha_votacion_juntac, funcionario.id_funcionario, nombre_funcionario FROM votacion_juntac, funcionario WHERE votacion_juntac.id_funcionario=funcionario.id_funcionario AND 
 estado_votacion_juntac=1";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id=$row['id_votacion_juntac'];
echo '<td>'.$row['nombre_votacion_juntac'].'</td>';
echo '<td>'.$row['nombre_funcionario'].'</td>';
echo '<td>'.$row['fecha_votacion_juntac'].'</td>';

?>
      
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
						"aaSorting": [[ 2, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->



<?php if (1==$_SESSION['rol'] 
or 0<$nump116
) { ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>Resultado</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

		<div class="box">
			 <div class="box-header">
                  <h3 class="box-title">Votación</h3>
				 
                </div>
			

 <div class="box-body">

<a href="votacion_juntac.jsp" target="_blank">Candidatos</a>
<br>


<?php 
$query4="SELECT id_candidato_votacion_juntac, COUNT( * ) total
FROM votacion_juntac
GROUP BY id_candidato_votacion_juntac
HAVING COUNT( * ) >0";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {

if (0==$row['id_candidato_votacion_juntac']){
$plancha=	'Voto en blanco';
} else {
$plancha=$row['id_candidato_votacion_juntac'];
}
$tramite=intval($row['total']);
echo 'Candidato '.$plancha.': '.$tramite;
echo '<br>';
$rango=100/$votos;
$info=$rango*$tramite;


echo '<div class="progress">
<div class="progress-bar progress-bar-success" style="width:'.intval($info).'%">'.round($info,1).'%
</div></div>';

 } ?>
				
				
</div>
</div>

              </div>
          </div> 
     </div> 
</div> 




<?php 
} else {}
} else { } ?>


