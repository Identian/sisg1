<?php

if (isset($_GET['i']) && "" != $_GET['i']) {
  $id = $_GET['i'];





$nump31 = privilegios(31, $_SESSION['snr']);


 if (0<$nump31) { 
$_SESSION['permiso31']=31;
 } else { $_SESSION['permiso31']=0; }  
 

if (1==$_SESSION['rol'] or 0<$nump31) {

  $query_update = sprintf("SELECT * FROM oficina_registro WHERE oficina_registro.id_oficina_registro = %s", GetSQLValueString($id, "int"));
  $update = mysql_query($query_update, $conexion) or die(mysql_error());
  $row_update = mysql_fetch_assoc($update);
  $totalRows_update = mysql_num_rows($update);
  if (0 < $totalRows_update) {
    mysql_free_result($update);
?>




    <div class="row">
      <div class="col-md-12">


        <div class="box box-primary">
          <div class="box-body box-profile">



            <ul style="list-style:none;">
			 
      <div class="col-md-6">
			<li >
                <b>ORIP: </B><?php echo $row_update['nombre_oficina_registro']; ?>
              </li>
			
              <li >
                  <b>Departamento:</b> <?php echo quees('departamento', $row_update['id_departamento']); ?> / <?php echo nombre_municipio($row_update['codigo_municipio'], $row_update['id_departamento']); ?>
                </li>
              <li >
                <b>Teléfono:</b> <?php echo $row_update['telefono_oficina_registro']; ?>
              </li>

           

              <li >
                <b>Email:</b> <?php echo $row_update['correo_oficina_registro']; ?>
              </li>
              <li >
                <b>Dirección:</b> <?php echo $row_update['direccion_oficina_registro']; ?>
              </li>
              <li >
                <b>Horario:</b> <?php echo $row_update['horario_oficina_registro']; ?>
              </li>

 </div>
      <div class="col-md-6">

              <li >
                <b>Circulo Registral:</b>
                <?php echo $row_update['circulo']; ?>
              </li>

              <li >
                <b>Regional:</b> <?php echo quees('region', $row_update['id_region']); ?>
              </li>

              <li >
                <b>Sistema Misional:</b> <?php echo quees('oficina_registro_sismisional', $row_update['id_oficina_registro_sismisional']); ?>
              </li>




              <li >
                <b>Iris:</b> <?php if (1 == $row_update['iris']) {
                                                                    echo 'Si';
                                                                  } else {
                                                                    echo 'No';
                                                                  } ?>
              </li>

         
		  <li >
                <b>COMPRENSIÓN REGISTRAL: </b> 
				
				<?php
              
                $actualizar57ll = mysql_query("SELECT id_municipio_orip, nombre_municipio from municipio_orip, municipio where municipio_orip.id_departamento=municipio.id_departamento and municipio_orip.codigo_municipio=municipio.codigo_municipio and  id_oficina_registro=".$id."  and estado_municipio_orip=1 order by nombre_municipio", $conexion);
                $row157ll = mysql_fetch_assoc($actualizar57ll);
                $total557ll = mysql_num_rows($actualizar57ll);
                if (0 < $total557ll) {
                  do {


               echo ''.$row157ll['nombre_municipio'].', ';
         

                   
                  } while ($row157ll = mysql_fetch_assoc($actualizar57ll));
                  mysql_free_result($actualizar57ll);
                } else {
                }
                
				
				
           
				
                ?>
              </li>

		
</div>
         
            </ul>



			

          </div>
          <!-- /.box-body -->

        </div>




      </div>
      <!-- /.col -->
	  </div>
	  <div class="row">
	  
	  
	  
	  
	  
	  
      <div class="col-md-12">
        <div class="nav-tabs-custom">
<br>
           <form class="navbar-form" name="fotertrm5435435rter1erteg" method="post" action="">
<B>  DIGITALIZACIÓN</B> 
              <div class="input-group">
                <div class="input-group-btn">
                  <select class="form-control" name="campo" required>
                    <option value="" selected> - - Buscar por: - - </option>
 
<option value="codigo">Nombre</option> 
<option value="fechaapertura">Fecha de apertura</option> 
<option value="fechafingestion">Fecha final de gestión</option> 
<option value="fechafinprincipal">Fecha Final principal</option> 
<option value="fechafinhistorico">Fecha final historico</option>
                  </select>
                </div><!-- /btn-group -->
                <div class="input-group-btn">
                  <input type="text" name="buscar" placeholder="" class="form-control" required></div>
                <!-- /input-group -->
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                </div>
              </div>

            </form>

          <div class="tab-content">
            <div class="active tab-pane" id="activity">

              <div class="post">
                <div class="user-block">
                  <div class="col-xs-12 table-responsive ">




	
                    <?php
					
$dbpostgres2='ORIP'.$id;
$conexionpostgres2="host=192.168.80.181 port=5432 dbname=".$dbpostgres2." user=admin password=Superadmin2022";
$conexionpostgresql2 = pg_connect($conexionpostgres2);
if(!$conexionpostgresql2){
     echo 'ERROR';
} else {
	   
	   
	   if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                $infobus = " where " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
                
              } else {
                $infobus = " limit 100";
              }
			  
			  
$query = "SELECT * FROM contenedor ".$infobus.""; //where codigo='232-0000001'
$resultado2 = pg_query ($query);
$num_resultados = pg_num_rows ($resultado2);
 	 




  
					
				


                    ?>

<style>
        .dataTables_filter {
          display: none;
        }
      </style>
	
                    <table class="table table-striped table-bordered table-hover" id="detallefun">
                    
					  <thead><tr align='center' valign='middle'>
<td>Nombre</td> 
<td>Paginas</td> 
<td>Fecha apertura</td> 
<td>Fecha fin gestion</td> 
<td>Fecha fin principal</td> 
<td>Fecha fin historico</td>
<!--<td>Archivos</td>		-->		  
					  </tr></thead><tbody>
					  
                        <?php
                   
							
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado2);

$idcontenedor=$row['idcontenedor'];
							
echo '<tr>';
echo '<td>';
echo ' <a href="" class="buscardigitalizacion2018" id="'.$idcontenedor.'#'.$row['codigo'].'#'.$id.'"  title="Archivos" data-toggle="modal" data-target="#popupactualizardigitalizacion2018"> <i class="fa fa-folder-open-o"></i> '.$row['codigo'].'</a> ';
echo '</td>';
echo '<td>'.$row['contenido'].'</td>';
echo '<td>'.$row['fechaapertura'].'</td>';
echo '<td>'.$row['fechafingestion'].'</td>';
echo '<td>'.$row['fechafinprincipal'].'</td>';
echo '<td>'.$row['fechafinhistorico'].'</td>';
echo '</tr>';
 }


  pg_free_result($resultado2);
  pg_close($conexionpostgresql2);  

  }
  
/*
if (76==$id) {

$idcontenedor=$row['idcontenedor'];
$querym = "SELECT * FROM usaid2018detalle where idcontenedor=".$idcontenedor." and id_oficina_registro=76";
$resultadom = $mysqli->query($querym);
	 while ($obj = $resultadom->fetch_array()) {
       echo  '<a href="./Digitalizaciones/Acacias/DatairisAcacias/DATA/2/2/'.$infob.'/Files/'.$obj['nombre'].'" target="_blank">'.$obj['nombre'].'</a><br>';
    }
	$resultadom->free();
	
//echo '<a href="./Digitalizaciones/Acacias/" target="_blank">pdf</a>';

} else if (14==$id) {
echo '<a href="./migracionorip/USAIDGDSANMARTIN/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (22==$id) {
echo '<a href="./migracionorip/USAIDGDCHAPARRAL/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (69==$id) {
echo '<a href="./migracionorip/USAIDGDTUMACO2/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (110==$id) {
echo '<a href="./migracionorip/USAIDGDCARMEN/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';



} else { echo ''; }
*/



             
                        ?>
						<script>
				$(document).ready(function() {
					$('#detallefun').DataTable({
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
						"aaSorting": [[ 1, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
                        
                      </tbody>
                    </table>

</div>
                </div>
              </div>
            </div>






            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>




<div class="modal fade" id="popupactualizardigitalizacion2018" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Archivos</b></h4>
</div> 
<div id="ver_actualizardigitalizacion2018" class="modal-body"> 

</div>
</div> 
</div> 
</div>




<?php
 
  }
   } else {}
}
?>


