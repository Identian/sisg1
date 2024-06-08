<?php

if (1==$_SESSION['snr_tipo_oficina']) { 



?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('resolucion'); ?></h3>

              <p>Resoluciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="entidades_reparto.jsp" class="small-box-footer">Ir a Entidades <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="" class="small-box-footer">Descargar Reporte <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>3</h3>
			  
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
              <h3><?php echo existencia('notaria'); ?></h3>
              <p>Notarias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="xls/repartos.xls" class="small-box-footer">Descargar. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
 
	  
	

<div class="col-md-4">
 RESOLUCIONES DE NOTARIADO
</div>
<div class="col-md-8">
<form action="" method="post" name="rtret">
<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected>- - - Buscar por:  - - - - </option>
 		  <option value="nombre_notaria">Notaria</option>
		   <option value="resolucion">Numero de resolución</option>
		   <option value="nombre_resolucion">Asunto</option>
		  
		  </select>
</div>
<div class="input-group-btn"><input type="text" style="width:250px;" name="buscar" placeholder="Buscar" class="form-control" required ></div>
 
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
</div>
</form>
</div>
	
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
<style>
    .dataTables_filter {
          display: none;
        }
	
      </style>
			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
		
                <thead>
 <tr align="center" valign="middle">
				  <th>VIGENCIA</th>
				  <th>RESOLUCION</th>
				    <th>FECHA</th>
		<th>NOTARIA</th>
					<th>ASUNTO</th>
		
		
				  <th>FOLIOS</th>
			
				  <th style="min-width:60px;"></th>
</tr>
</thead>
<?php 


						
				if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {			
				$infop=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
		
				} else {
					
				$infop='';
				
				
				}	



	 	 

$query4 = "SELECT id_resolucion, vigencia, resolucion, nombre_resolucion, fecha_exp_resolucion, num_folios, url_resolucion, nombre_notaria, email_notaria FROM resolucion, notaria where resolucion.codigo_oficina=notaria.id_notaria  and estado_resolucion=1 AND id_tipo_oficina=3  ".$infop." ORDER BY id_resolucion desc LIMIT 500 ";


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tbody>
				<tr>
				<?php
echo '<td>'.$row['vigencia'].'</td>';
echo '<td>'.$row['resolucion'].' '.$row['bis'].'</td>';
echo '<td>'.$row['fecha_exp_resolucion'].'</td>';
echo '<td>'.$row['nombre_notaria'].'</td>';

echo '<td>'.$row['nombre_resolucion'].'</td>';

echo '<td>'.$row['num_folios'].'</td>';


echo '<td>';


if (isset($row['url_resolucion'])){
if (18==$row['vigencia']) {
echo ' <a href="files/'.$row['url_resolucion'].'" target="_blank"><img src="images/pdf.png"></a> '; 
} else {
echo ' <a href="files/resoluciones/'.$row['url_resolucion'].'" target="_blank"><img src="images/pdf.png"></a> '; 
}
} else { }

$actualizar5 = mysql_query("SELECT * from documento_resolucion where id_resolucion=".$row['id_resolucion']." and estado_documento_resolucion=1", $conexion);
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {
echo ' <a href="files/resoluciones/'.$row15['nombre_documento_resolucion'].'" target="_blank"><img src="images/pdf.png"></a> '; 
} while ($row15 = mysql_fetch_assoc($actualizar5)); 
 mysql_free_result($actualizar5);
} else {}
  
  
	if (1==$_SESSION['rol']) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="resolucion" id="'.$row['id_resolucion'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	

echo '</td></tr>';
}
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
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->





	  



<?php } else { } ?>


