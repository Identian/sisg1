<?php
$nump106=privilegios(106,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump106) {


?>
 
  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('notaria'); ?></h3>

              <p>Notarias</p>
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
              <h3><?php echo existencia('requerir_pqrs'); ?></h3>

              <p>Requerimientos /traslados</p>
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
             
 <h3>195</h3>
			 
              <p>Orips</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
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
Control de requerimientos
</div>
	  
	  
	  
	   <div class="col-md-8">

</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th>PQRS</th>
 <th>Tipo</th>
<th>Notaria</th>
<th>Radicado</th>	
<th>Solicitud</th>	
<th>Respuesta</th>

<th>Analisis</th>
<th></th>		  
</tr>
</thead>
<tbody>
<?php 
$query4="select solicitud_pqrs.id_solicitud_pqrs, radicado, tipo_req_tras, id_vigilado, 
radicado_requerimiento, fecha_solicitudr, fecha_respuestar, id_requerir_pqrs   
FROM requerir_pqrs, solicitud_pqrs WHERE requerir_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and estado_requerir_pqrs=1";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
echo '<td><a href="solicitud_pqrs&'.$row['id_solicitud_pqrs'].'.jsp" target="blank">'.$row['radicado'].'</a></td>';
				
$id=$row['tipo_req_tras'];
if (0==$id) {
echo '<td>Requerimiento</td>';
} else {
echo '<td>Traslado</td>';
}
echo '<td>';
echo quees('notaria',$row['id_vigilado']);
echo '</td>';
echo '<td>'.$row['radicado_requerimiento'].'</td>';
echo '<td>'.$row['fecha_solicitudr'].'</td>';

echo '<td>'.$row['fecha_respuestar'].'</td>';
echo '<td>';
if ($row['fecha_solicitudr']<=$row['fecha_respuestar']) { echo 'En terminos';  } else { echo 'Fuera de terminos'; }
echo '</td>';
echo '<td><a href="movimiento_pqrs&'.$row['id_solicitud_pqrs'].'.jsp"><i class="fa fa-file"></i></a></td>';
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
						"aaSorting": [[ 4, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->



<?php if (1==1) { ?>


<?php 
} else {}
} else { } ?>



