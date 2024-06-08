<?php
$nump55=privilegios(55,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump55) { 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('certificado_funcionario'); ?></h3>

              <p>Certificaciones</p>
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
             
 <h3><?php echo existencia('notaria'); ?></h3>
			  
              <p>Notarias</p>
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
  
  
  
<div class="col-md-4">

</div>
	  
	  
	  
<div class="col-md-8">

</div>

  
  
</div> 

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
				
			<th>Notaria</th>
				  <th>Cédula</th>
				  <th>Nombre Notario</th>
				  <th>Fecha Certificado</th>
				  <th>Destino</th>
			  <th>Certificado</th>
</tr>
</thead>
<tbody>
				
<?php 

/*
$query4="SELECT nombre_departamento, nombre_notaria AS notaria, a.id_categoria_notaria AS categoria, cedula_funcionario AS cedula,
nombre_funcionario AS 'nombre_notario', d.url, d.fecha_certificado AS 'fecha_certificado', d.destino
FROM notaria a, posesion_notaria b, funcionario c, certificado_funcionario d, departamento e
WHERE a.id_notaria = b.id_notaria AND c.id_funcionario = b.id_funcionario AND b.id_funcionario=c.id_funcionario AND a.id_departamento=e.id_departamento
AND b.id_notaria=a.id_notaria AND d.id_funcionario=c.id_funcionario AND b.estado_posesion_notaria=1 AND fecha_fin IS NULL ORDER BY d.fecha_certificado DESC";
*/


$query4="SELECT nombre_notaria, url, nombre_funcionario, cedula_funcionario, destino, fecha_certificado 
FROM certificado_funcionario, funcionario, notaria  
WHERE certificado_funcionario.codigo_oficina=notaria.id_notaria and oficina=3 and 
certificado_funcionario.id_funcionario= funcionario.id_funcionario and estado_certificado_funcionario=1 ORDER BY fecha_certificado DESC ";



$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
<?php
echo '<td>'.$row['nombre_notaria'].'</td>';
echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td>'.$row['nombre_funcionario'].'</td>';
echo '<td>'.$row['fecha_certificado'].'</td>';
echo '<td>'.$row['destino'].'</td>';
echo '<td><a href="pdf/tiemposervicio&'.$row['url'].'.pdf" target="_blank"><span class="fa fa-file"></span></td>';
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









<?php } else { }
 ?>



