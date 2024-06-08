<?php
$nump111=privilegios(111,$_SESSION['snr']);

if (2>$_SESSION['snr_tipo_oficina']) { 

?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('curaduria'); ?></h3>

              <p>Curadurias</p>
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
              <h3><?php echo existencia('relacion_curaduria'); ?></h3>

              <p>Personal de curadurias</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="xls/personal_curadurias.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3><?php echo existencia('situacion_curaduria'); ?></h3>
			  
              <p>Registros de situaciones</p>
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
              <h3><?php echo $realdate; ?></h3>
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
  
  
  
  <div class="col-md-12">
 
  
<h3>Analisis de grupo interdisciplinario por Curaduria</h3>
  

	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Curaduria</th>
<th>Ingeniero civil</th>
<th>Abogado</th>
<th>Arquitecto</th>
<th style="width:100px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

function grupoi($idcur) {
global $mysqli;

$array0 = array();
$array1 = array();
$array2 = array();
$queryk = "SELECT id_curaduria, funcionario.id_funcionario, profesion FROM relacion_curaduria, funcionario WHERE 
relacion_curaduria.id_funcionario=funcionario.id_funcionario and id_curaduria=".$idcur." AND estado_relacion_curaduria=1 AND estado_activo=1";
$result48k = $mysqli->query($queryk);
while ($obj5k = $result48k->fetch_array()) {
$profesion=$obj5k['profesion'];

if ('Ingeniero civil'==$profesion) {
array_push($array0, 1); 
} else if ('Abogado'==$profesion)  {
array_push($array1, 1); 	
} else if ('Arquitecto'==$profesion)  {
array_push($array2, 1); 	
} else {}

}

$result48k->free();

$ing=intval(array_sum($array0));
$abo=intval(array_sum($array1));
$arq=intval(array_sum($array2));
return ''.$ing.'</td><td>'.$abo.'</td><td>'.$arq.'';

}




$query4="SELECT * FROM curaduria where estado_curaduria=1";

$result = $mysqli->query($query4);
while($rowcc = $result->fetch_array()) {

echo '<tr>';
echo '<td title="">'.$rowcc['nombre_curaduria'].'</td>';



echo '<td>'.grupoi($rowcc['id_curaduria']).'</td>';  // *3



echo '<td>';
echo '<a href="curaduria&'.$rowcc['id_curaduria'].'.jsp"><span class="fa fa-home" style="color:#B40404"></span></a> ';
  echo '</td></tr>';
 }
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


<?php 


} else {} ?>



