<?php

if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 0<$_SESSION['posesionnotaria'])) { 


if (1==$_SESSION['rol'] && isset($_POST['tipo_accion']) && ""!=$_POST['tipo_accion']) {	
$numv=intval($_POST['reparto_proyectoid']);
$updateSQL778 = sprintf("UPDATE reparto SET tipo_accion=%s, descripcion_accion=%s where id_reparto=%s", 
GetSQLValueString($_POST['tipo_accion'], "int"), 
GetSQLValueString($_POST['descripcion_accion'], "text"),   
GetSQLValueString($numv, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;

}




?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('reparto'); ?></h3>

              <p>Total de repartos por SNR</p>
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
            <a href="https://sisg.supernotariado.gov.co/xls/reparto_notarial.xls" class="small-box-footer">Descargar Reporte <i class="fa fa-arrow-circle-right"></i></a>
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
              <h3><?php //echo cuenta('1','52','8','1');?>195</h3>
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
  
  <?php 
  		 if (1==$_SESSION['rol'] && isset($_GET['i'])) {
  echo quees('notaria', $_GET['i']); } else {	
    echo quees('notaria', $_SESSION['posesionnotaria']);
  }
 ?>

  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Id</th>
 <th>Fecha</th>
 <th>Matriculas</th>
 <th>Intervinientes</th>
 <th>Proyecto</th>
 <th>Código</th>
 <th>Categoria</th>
 <th>Cuantia</th>
<th>Entidad</th>			 	
<th style="min-width:150px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

		 if (1==$_SESSION['rol'] && isset($_GET['i'])) {
$query4="SELECT * from reparto, entidad_reparto, categoria_reparto where reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto and reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto and id_notaria=".$_GET['i']." and estado_reparto=1"; 
		 } else {			 
		$query4="SELECT * from reparto, entidad_reparto, categoria_reparto where reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto and reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto and id_notaria=".$_SESSION['posesionnotaria']." and estado_reparto=1"; 
		 }
$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {
?>  
<tr>
				<?php
$id_res=$row['id_reparto'];

echo '<td>'.$id_res.'</td>';
echo '<td>'.$row['fecha_reparto'].'</td>';
echo '<td>'.$row['matriculas'].'</td>';
echo '<td>'.$row['intervinientes'].'</td>';
echo '<td>';
echo $row['nombre_reparto'];
echo '</td>';
echo '<td>'.$row['codigo'].'</td>';


echo '<td>'.$row['nombre_categoria_reparto'].'</td>';
echo '<td>'.$row['cuantia'].'</td>';




echo '<td>'.$row['nombre_entidad_reparto'].'</td><td>';


if (isset($row['url']) && "web.pdf"!=$row['url']) {
echo ' <a href="filesnr/reparto/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';
} else {}


$hash2=$row['hash'];
echo ' <a href="https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash2.'.pdf" download=""> <span class="btn btn-xs btn-success">Acta</span></a> ';





if (1==$_SESSION['rol']) {
	echo ' <a href="" class="cambiar_reparto btn btn-xs btn-warning" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupreparto">Modificar</a> ';
} else {}


if (1==intval($row['tipo_accion'])) {
	echo '<br><b>Anulado.</b> '.$row['descripcion_accion'];
} else if (2==intval($row['tipo_accion'])) {
	echo '<br><b>Por restitución.</b> '.$row['descripcion_accion'];
} else {}


	
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





<div class="modal fade bd-example-modal-lg" id="popupreparto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Actualizar reparto</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="ver_cambio_reparto" class="modal-body">

   </div>
    </div>
  </div>
</div>



<?php
} else {
	ECHO 'No tiene permisos de visualización. Solo para Notarios';
} ?>



