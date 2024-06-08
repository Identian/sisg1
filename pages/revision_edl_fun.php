<?php
$nump117=privilegios(117,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 3==$_SESSION['vinculacion'] or 4==$_SESSION['vinculacion']) { 	
  

if (isset($_POST['reclamo'])) {
/*
$insertSQL = sprintf("INSERT INTO evaluacion_edl (
nombre_evaluacion_edl, id_funcionario, fecha_inicial, fecha_final, nota, fecha_evaluacion_edl, url, estado_evaluacion_edl) 
VALUES (%s, %s, %s, %s, %s, now(), %s, %s)", 

GetSQLValueString($_POST["nombre_evaluacion_edl"], "text"), 
GetSQLValueString($funcionarioedl, "int"),
GetSQLValueString($_POST["fecha_inicial"], "date"),
GetSQLValueString($_POST["fecha_final"], "date"),
GetSQLValueString($_POST["nota"], "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
 echo $insertado;
   */
}
 else { }

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('eval_funcionario_edl'); ?></h3>

              <p>Edl</p>
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
EDL
</div>
	

	
   <div class="box-body" style="background:#fff;">
      <div class="table-responsive">
      METAS	  
				

					<style>
.dataTables_filter {
display:none;
}
			</style>
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
                <thead>
 <tr align="center" valign="middle">
	 <th>Meta</th>
	 <th>Compromiso</th>
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>			
<?php 
$query4="SELECT * from metas_funcionario_edl, metas_edl, eval_funcionario_edl 
where metas_funcionario_edl.id_metas_edl=metas_edl.id_metas_edl 
and metas_funcionario_edl.id_eval_funcionario_edl=eval_funcionario_edl.id_eval_funcionario_edl 
 and id_funcionario=".$_SESSION['snr']." ORDER BY id_metas_funcionario_edl desc  "; //LIMIT 500 OFFSET ".$pagina."



//".$_SESSION['snr']."
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_metas_funcionario_edl'];
echo '<td>'.$row['nombre_metas_edl'].'</td>';
echo '<td>'.$row['compromiso_laboral'].'</td>';

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
									//'excelHtml5'
									
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




   <div class="box-body" style="background:#fff;">
					<style>
.dataTables_filter {
display:none;
}
			</style>

      <div class="table-responsive">
			
	COMPETENCIAS
<table  class="table display" id="inforesoluciones5" cellspacing="0" width="100%">
                <thead>
 <tr align="center" valign="middle">
	 <th>Competencia</th>
	 <th>Definición</th>
	 <th>Conducta Asociada</th>
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>			
<?php 

$query5="SELECT * from competencia_funcionario_edl, competencias_edl, eval_funcionario_edl 
where competencia_funcionario_edl.id_competencia_funcionario_edl=competencias_edl.id_competencias_edl 
and competencia_funcionario_edl.id_eval_funcionario_edl=eval_funcionario_edl.id_eval_funcionario_edl 
 and eval_funcionario_edl.id_funcionario=".$_SESSION['snr']." and estado_competencia_funcionario_edl=1 ORDER BY id_competencia_funcionario_edl";

$result5 = $mysqli->query($query5);
while($row5 = $result5->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_compe=$row['id_competencia_funcionario_edl'];
echo '<td>'.$row5['nombre_competencias_edl'].'</td>';
echo '<td>'.$row5['definicion_edl'].'</td>';
echo '<td>'.$row5['conducta_asociada'].'</td>';


?>
      
                  </tr>
                <?php } ?>

				
                </tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones5').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									// 'excelHtml5'
									
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

</div>
</div>
</div>
</div>

<?php } else {
echo 'No tiene acceso dado que el tipo de vinculación no es provisional o empleo temporal'; }
