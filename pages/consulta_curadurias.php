<?php
$nump107=privilegios(107,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump107) {
?>
 
 

  <div class="row">
  
  
  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php  echo existencia('curaduria'); ?></h3>

              <p>Curadurias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="https://sisg.supernotariado.gov.co/xlsx/curaduria.xls" class="small-box-footer">Periodos no reportados. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
		
		 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo existencia('radicacion_curaduria'); ?></h3>

              <p>Radicaciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="https://sisg.supernotariado.gov.co/xlsx/radicacion_curaduria.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
		
		 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php 
			  
$select55 = mysql_query("select count(id_licencia_curaduria) as totall from licencia_curaduria where estado_licencia_curaduria=1 and situacion_licencia=1", $conexion);
$row55 = mysql_fetch_assoc($select55);
echo intval($row55['totall']);
mysql_free_result($select55);

			 // echo existencia('licencia_curaduria'); ?></h3>

              <p>Licencias</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="https://sisg.supernotariado.gov.co/xlsx/licencia_curaduria.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
		
	
		  

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
			 echo date('Y');
			  ?>
			  </h3>

              <p>Año</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="expensa_reporte.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  


<form action="" method="POST" name="for5435435tret5464563m1">
 
  <div class="col-md-4">

<label  class="control-label"><span style="color:#ff0000;">*</span> Opcion de busqueda:</label> 
</div>
<div class="col-md-3">
<select class="form-control" name="campo" >
<option selected></option>
<option value="inmueble_licencia.direccion_inmueble">Dirección</option>
<option value="inmueble_licencia.cedula_catastral">Cédula catastral</option>
<option value="inmueble_licencia.fmi_matricula">Folio de matricula</option>
<option value="inmueble_licencia.nombre_licencia_curaduria">Número de licencia</option>
<option value="inmueble_licencia.n_acto_administrativo">Acto administrativo</option>

</select>
	  </div>
  <div class="col-md-3">

<input type="text" class="form-control" name="buscar">
	  </div>
  <div class="col-md-2">

<button type="submit" class="btn btn-xs btn-success">
<span class="glyphicon glyphicon-ok"></span> Buscar </button>
	  </div>




</form>


	  
	  
	 
  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
<style>


.dataTables_filter {
display:none;
}



.dataTables_paginate {
display:none;
}

			</style> 
			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th>CURADURIA</th>
   <th>LICENCIA</th>
	<th>MATRICULA</th>
<th>CEDULA CATASTRAL</th>
<th>ACTO ADMIN</th>
	
<TH></TH>				  
</tr>
</thead>
<tbody>
<?php 

if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
				
				$pagina=0;
				} else {
					
				$infobus=" and id_licencia_curaduria=0 ";

				
				}
 


$query4="SELECT * from inmueble_licencia, licencia_curaduria, curaduria where licencia_curaduria.id_curaduria=curaduria.id_curaduria and  licencia_curaduria.id_licencia_curaduria=inmueble_licencia.id_licencia_curaduria
and estado_inmueble_licencia=1 ".$infobus." limit 1000";

//echo $query4;

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_licencia_curaduria'];
echo '<td>'.$row['nombre_curaduria'].'</td>';
echo '<td>'.$row['nombre_licencia_curaduria'].'</td>';
echo '<td>'.$row['fmi_matricula'].'</td>';
echo '<td>'.$row['cedula_catastral'].'</td>';

echo '<td>'.$row['n_acto_administrativo'].'</td>';
echo '<td>';
echo '<a href="licencia&'.$id_res.'.jsp">Licencia</a>';
echo '</td>';
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
						"aaSorting": [[ 1, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php //if (1==$_SESSION['rol'] or 0<$nump73) { ?>




<?php } else { }?>



