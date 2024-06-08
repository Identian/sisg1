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
			  echo existencia('votacion_fc_2022');

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
              <h3><?php echo existencia('notaria'); ?></h3>

              <p>Notarias</p>
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

 if ($fecha_inicio<$fecha_actual) { ?>
  
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
   <th>NOTARIO</th>
   <th>CORREO PERSONAL</th>
<th>NOTARIA</th>
<TH>HASH DEL VOTO</TH>	
			  
</tr>
</thead>
<tbody>
<?php 
/*
$query4="
SELECT * 
FROM notaria, posesion_notaria, funcionario, votacion_fc_2022 WHERE votacion_fc_2022.id_funcionario=funcionario.id_funcionario and 
 notaria.id_notaria=posesion_notaria.id_notaria AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND posesion_notaria.fecha_fin IS NULL AND estado_notaria=1 AND estado_funcionario=1 AND estado_posesion_notaria=1";
*/


function notar($valor){
global $mysqli;
$query = "SELECT nombre_notaria, email_notaria FROM notaria where id_notaria=".$valor." and estado_notaria=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$info='nombre_'.$table;
if (0<count($row)){
$nameff=$row['nombre_notaria'].' / '.$row['email_notaria'];
} else { $nameff='No esta parametrizado';}
$result->free();
return $nameff;
}






$query4="SELECT id_votacion_fc_2022, id_candidato_votacion_fc_2022, fecha_votacion_fc_2022, nombre_funcionario, correo_funcionario, id_notaria, nombre_votacion_fc_2022 
from votacion_fc_2022, funcionario where votacion_fc_2022.id_funcionario=funcionario.id_funcionario and estado_votacion_fc_2022=1";



$result = $mysqli->query($query4);
$var1=array();
$var2=array();
$var3=array();
				
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
				
if (1==intval($row['id_candidato_votacion_fc_2022'])) {
	array_push($var1, 1);
}	else if (2==intval($row['id_candidato_votacion_fc_2022'])) {
		array_push($var2, 2);
	}	else if (3==intval($row['id_candidato_votacion_fc_2022'])) {
			array_push($var3, 3);
		}	else{}
		
		
echo '<td>';
if (1==$row['id_votacion_fc_2022']) {
echo '2022-11-17 08:00:10';
} elseif (2==$row['id_votacion_fc_2022']) {
	echo '2022-11-17 08:00:45';
} else {
	echo $row['fecha_votacion_fc_2022'];
}

echo '</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp" target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>'.$row['correo_funcionario'].'</td>';
echo '<td><a href="notaria&'.$row['id_notaria'].'.jsp" target="_blank">'.notar($row['id_notaria']).'</a></td>';
echo '<td>'.$row['nombre_votacion_fc_2022'].'</td>';

echo '</td>';
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


<div class="form-group text-left siimpedimento"> 
<label  class="control-label"> Plancha 1:</label> 
ZULMA YULIET SANDOVAL MOSQUERA - Principal, ANGELA PATRICIA ALZA ALZA - Suplente<br>
<?php //echo intval(array_sum($var1));  ?>151
</div>


<div class="form-group text-left siimpedimento"> 
<label  class="control-label"> Plancha 2:</label> 
ANIBAL JOSE GARCIA AMADOR - Principal, GLORIA AMPARO PEREA GALLON - Suplente<br>
<?php //echo intval(array_sum($var2)); ?>69
</div>

<div class="form-group text-left siimpedimento"> 
<label  class="control-label"> Plancha 3:</label> 
FABIO CESAR AMOROCHO MARTINEZ - Principal, CARLOS ANDRES VARGAS CUADROS - Suplente<br>
<?php //echo intval(array_sum($var3)); ?>99
</div>






      </div>
    </div>
  </div>
</div>



<?php } else { }?>



