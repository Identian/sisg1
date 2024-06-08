<?php
$nump74=privilegios(74,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump74) {


?>
 
  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3>393</h3>

              <p>Notarias 3 categoria</p>
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
              <h3><?php $votos=existencia('votacion_fc'); echo $votos; ?></h3>

              <p>Votos</p>
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
             
 <h3> <?php $total=393; $final=($votos*100)/$total;  echo round($final, 2); ?></h3>
			 
              <p>% votacion_fc</p>
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
              <h3><?php echo existencia('notaria'); ?></h3>
              <p>Notarias</p>
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
Fondo cuenta
</div>
	  
	  
	  
	   <div class="col-md-8">
	<!--
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">Buscar 
<select class="form-control" name="campo" required>
          <option value="" selected> - - Buscar por: - -  </option>
 <option value="mes">Mes</option>
<option value="ano">Año</option>
<option value="nombre_tipo_derecho_preferencia">Tipo de estado contable</option>
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
 <th>HASH</th>
 <th>NOTARIA</th>
<th>NOTARIO</th>
<th>FECHA</th>	  
</tr>
</thead>
<tbody>
<?php 
$query4="select nombre_votacion_fc, fecha_votacion_fc, notaria.id_notaria, nombre_notaria, funcionario.id_funcionario, nombre_funcionario FROM votacion_fc, notaria, funcionario WHERE votacion_fc.id_funcionario=funcionario.id_funcionario AND 
votacion_fc.id_notaria=notaria.id_notaria  AND estado_votacion_fc=1";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id=$row['id_votacion_fc'];
echo '<td>'.$row['nombre_votacion_fc'].'</td>';
echo '<td>'.$row['nombre_notaria'].'</td>';
echo '<td>'.$row['nombre_funcionario'].'</td>';
echo '<td>'.$row['fecha_votacion_fc'].'</td>';

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



<?php if (1==1) { ?>
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
				  <a href="control_candidato_votacion_fc.jsp" target="_blank">Planchas inscritas</a>
                </div>
			

 <div class="box-body">

<?php

$condicion="";
$query_reghtp = "SELECT count(id_votacion_fc) as total1 FROM votacion_fc where id_candidato_votacion_fc=1 and estado_votacion_fc=1 ".$condicion."";  
$reghtp = mysql_query($query_reghtp, $conexion);
$row_reghtp = mysql_fetch_assoc($reghtp);
$tramite=intval($row_reghtp['total1']);
echo 'Plancha 1: '.$tramite;
$rango=100/$votos;
$info=$rango*$tramite;
?><br>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo intval($info); ?>%">
<?php echo round($info,1); ?>%
</div></div>


<?php
$query_reghtp = "SELECT count(id_votacion_fc) as total2 FROM votacion_fc where id_candidato_votacion_fc=2 and estado_votacion_fc=1 ".$condicion.""; 
$reghtp = mysql_query($query_reghtp, $conexion);
$row_reghtp = mysql_fetch_assoc($reghtp);
$tramite=intval($row_reghtp['total2']);
echo 'Plancha 2: '.$tramite;
$rango=100/$votos;
$info=$rango*$tramite;
?><br>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo intval($info); ?>%">
<?php echo round($info,1); ?>%
</div></div>



<?php
$query_reghtp = "SELECT count(id_votacion_fc) as total FROM votacion_fc where id_candidato_votacion_fc=0 and estado_votacion_fc=1 ".$condicion.""; 
$reghtp = mysql_query($query_reghtp, $conexion);
$row_reghtp = mysql_fetch_assoc($reghtp);
$tramite=intval($row_reghtp['total']);
echo 'Voto en blanco: '.$tramite;
$rango=100/$votos;
$info=$rango*$tramite;
?><br>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo intval($info); ?>%">
<?php echo round($info,1); ?>%
</div></div>


</div>
</div>

              </div>
          </div> 
     </div> 
</div> 




<?php 
} else {}
} else { } ?>



