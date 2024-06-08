<?php

$nump74=privilegios(74,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump74) {

}
?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('candidato_votacion'); ?></h3>

              <p>Cantidad de inscritos</p>
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
<?php echo existencia('notario_propiedad'); ?>
			  </h3>

              <p>Notarios en propiedad</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#miModal">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>908</h3>
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

	  </div>
	  
	  
	  
	   <div class="col-md-8">
	


</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
<style>



			</style> 
			
<table  class="table table-striped table-bordered table-hover" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th>Plancha</th>
  <th>Fecha</th>
				  <th>Notario principal</th>
				  <th>Notaria principal</th>
				  <th>Notario suplente</th>
				  <th>Notaria suplente</th>
				  <th style="min-width:35px;"></th>
				  
</tr>
</thead>
<?php 

if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
				$infop=$infobus;
				$pagina=0;
				} else {
					
				$infop='';
				
	if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
	 } else {
		$pagina=0;  
	 }
				
				}
 

$query4="SELECT * from candidato_votacion where estado_candidato_votacion=1 ".$infop." ORDER BY id_candidato_votacion  LIMIT 200 OFFSET ".$pagina." "; //LIMIT 500 OFFSET ".$pagina."

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tbody>
				<tr>
				<?php
echo '<td>';
echo $row['id_candidato_votacion'];
echo '</td>';
echo '<td>';
echo $row['nombre_candidato_votacion'];
echo '</td>';
echo '<td>';
echo quees('funcionario', $row['id_funcionario1']);
echo '</td>';
echo '<td>';
echo quees('notaria', $row['id_notaria1']);
echo '</td>';
echo '<td>';
echo quees('funcionario', $row['id_funcionario2']);
echo '</td>';
echo '<td>';
echo quees('notaria', $row['id_notaria2']);
echo '</td>';
echo '<td>';
$idf1=$row['id_funcionario1'];
echo  '<a href="inscripcion_votacion_2020&'.$idf1.'.jsp"  target="_blank">Ver</a> ';
echo ' <a href="filesnr/votacion/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';

echo '</td>';
?>
      
                  </tr>
                <?php } ?>

				
                </tbody>
          
         </table>
		 
		 
		  <script>
            $(document).ready(function() {
              $('#inforesoluciones').DataTable({
                "lengthMenu": [
                  [25, 50, 100, 250, 500],
                  [25, 50, 100, 250, 500]
                ],
                "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
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
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Notarios en propiedad</h4>
      </div>
      <div class="modal-body">
        
<?php 

$query = "SELECT nombre_funcionario, funcionario.id_funcionario FROM notario_propiedad, funcionario where notario_propiedad.id_funcionario=funcionario.id_funcionario and estado_notario_propiedad=1"; 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
echo $totalRows.'<hr>';
if (0<$totalRows){
do {

	echo ''.$row['id_funcionario'].';'.$row['nombre_funcionario'].';<a href="usuario&'.$row['id_funcionario'].'.jsp" target="_blank">Ver</a><br>';


	 } while ($row = mysql_fetch_assoc($select)); 
} else {	
}	 
mysql_free_result($select);
 ?>


      </div>
    </div>
  </div>
</div>

