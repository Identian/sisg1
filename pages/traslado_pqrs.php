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
             
 <h3>
3</h3>
			 
              <p>Categorias</p>
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
			<h3>
       
	   <?php echo existencia('requerir_pqrs'); ?>
			 </h3>
              <p>Requerimientos a Notarias</p>
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
  
  
  

	  
	  
	  
	   <div class="col-md-8">
	<!--
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">Buscar 
<select class="form-control" name="campo" required>
          <option value="" selected> - - Buscar por: - -  </option>
 <option value="mes">Mes</option>
<option value="ano">Año</option>
<option value="nombre_tipo_estado_contable">Tipo de estado contable</option>
		  </select>
</div>
<div class="input-group-btn">
<input type="text" name="buscar" placeholder="" class="form-control" required ></div>
   
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>

</form>-->


</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th>Fecha solicitud</th>
 <th>Radicado</th>
<th>Notaria</th>
<th>Estado</th>
<th>Respuesta</th>
<th>Fecha Respuesta</th>
<th style=""></th>	  
</tr>
</thead>
<tbody>
<?php 

if (3==$_SESSION['snr_tipo_oficina']) { 

//if (1==$_SESSION['rol']) {
//$idofici=3;
$idofici=$_SESSION['snr_tipo_oficina'];
//$idvigilado=391;
$idvigilado=$_SESSION['id_vigilado'];

 

$query4="SELECT * FROM solicitud_pqrs, asignacion_pqrs, notaria WHERE solicitud_pqrs.id_solicitud_pqrs=asignacion_pqrs.id_solicitud_pqrs AND asignacion_pqrs.id_tipo_oficina=3 AND asignacion_pqrs.codigo_oficina=notaria.id_notaria and asignacion_pqrs.codigo_oficina=".$idvigilado." AND asignacion_pqrs.estado_asignacion_pqrs=1 AND estado_solicitud_pqrs=1";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_solicitud_pqrs'];


	echo '<td>'.$row['fecha_radicado'].'</td>';
	echo '<td>'.$row['radicado'].'</td>';
		echo '<td>'.$row['nombre_notaria'].'</td>';
		
		echo '<td>';
		
		if (isset($row['radicado_respuesta'])) {
			echo 'Finalizada';
		} else { echo 'Pendiente'; }
		
		echo '</td>';
echo '<td>'.$row['radicado_respuesta'].'</td>';
echo '<td>'.$row['fecha_respuestaf'].'</td>';
echo '<td>';
	
	echo ' <a href="solicitud_pqrs&'.$id_res.'.jsp" ><span class="glyphicon glyphicon-edit"></span> Responder</a>';

echo '</td>';
?>
      
                  </tr>
                <?php } ?>

				
                </tbody>
<?php } else {} ?>
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









