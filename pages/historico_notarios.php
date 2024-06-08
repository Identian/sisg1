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
			  //echo existencia('pamplonacons');

			  ?></h3>
              <p>Registros</p>
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
 <th>Nombres</th>
   <th>Apellidos</th>
   <th>Círculo Notarial</th>
<TH>Notaría</TH>	
<TH>Resolucion</TH>			  
</tr>
</thead>
<tbody>
<?php 



$query4="SELECT a.pers_nombres AS Nombres, a.pers_primerapellido AS Apellidos, a.pers_segundoapellido AS '', a.cino_nombre AS 'Círculo Notarial', a.depe_codigo AS '', a.ciud_codigo AS '', a.nota_numero AS '',
a.nota_nombre AS Notaría, a.acad_numero AS 'Resolucion', a.acad_fecha AS '', a.conc_descripcion AS Concepto, a.nomb_tipo AS Tipo, a.nomb_expedidopor AS 'Expedido por Gobierno', a.nomb_actaposecion AS 'Acta Posessión',
a.nomb_fechaposecion AS 'Fecha Inicio', a.nomb_posecionadoante AS 'Posesionado Ante', a.nomb_fechacierre AS 'Fecha Cierre'
FROM pamplonacons a WHERE a.pers_documento LIKE '%32514812%' ORDER BY a.acad_fecha";



$result = $mysqli->query($query4);
$var1=array();
$var2=array();
$var3=array();
				
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
<?php
echo '<td>'.$row['Nombres'].'</td>';
echo '<td>'.$row['Apellidos'].'</td>';
echo '<td>'.$row['Círculo Notarial'].'</td>';
echo '<td>'.$row['Notaría'].'</td>';
echo '<td>'.$row['Resolucion'].'</td>';

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







<?php } else { }?>



