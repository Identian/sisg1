<?php
if (isset($_GET['i']) && "" != $_GET['i']) {
  $id = $_GET['i'];

$nump31 = privilegios(31, $_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump31) {

  $query_update = sprintf("SELECT * FROM oficina_registro WHERE oficina_registro.id_oficina_registro = %s", GetSQLValueString($id, "int"));
  $update = mysql_query($query_update, $conexion);
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

		<a href="expediente_orip&<?php echo $id; ?>.jsp">Expedientes</a>
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

<option>ID_EXPEDIENTE</option>
<option>UBICACION_TOPOGRAFICA_CAJA</option>
<option>UBICACION_TOPOGRAFICA_CARPETA</option>
<option>FOLIO_MATRICULA_INMOBILIARIA</option>
<option>FOLIO_INICIAL</option>
<option>FOLIO_FINAL</option>
<option>NOMBRE_DEPARTAMENTO</option>
<option>NOMBRE_MUNICIPIO</option>
<option>NOMBRE_VEREDA</option>
<option>TIPO_PREDIO</option>
<option>NUMERO_ANOTACION</option>
<option>TIPO_DOCUMENTO</option>
<option>NUMERO_DOCUMENTO</option>
<option>FECHA_DOCUMENTO</option>
<option>OFICINA_ORIGEN</option>
<option>NUMERO_RADICACION</option>
<option>FECHA_RADICACION</option>
<option>CODIGO_NATURALEZA_JURIDICA</option>
<option>ESPECIFICACION_NATURALEZA_JURIDICA</option>
<option>ESTADO_FOLIO</option>
<option>DIRECCION_ACTUAL</option>
<option>FALTA_FORMULARIO</option>
<option>FALTA_ANEXO</option>
<option>FALTA_TRAMITE</option>
<option>CONTIENE_PERIODICO</option>
<option>CONTIENE_MAPA</option>
<option>CONTIENE_CD</option>
<option>PROVEEDOR</option>
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
			
if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                $infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' limit 500";
                
              } else {
                $infobus = " limit 100";
              }
			  
			  
			  
if (67==$id) {					
		$queryn = "SELECT * FROM digitalizaciones_cucuta where id_oficina_registro=0 ".$infobus."";
} else if (64==$id){
		$queryn = "SELECT * FROM digitalizaciones_ocana where id_oficina_registro=".$id.$infobus."";	
}  else if (116==$id) {
		$queryn = "SELECT * FROM digitalizaciones_monteria where id_oficina_registro=".$id.$infobus."";
} else {	
	    $queryn = "SELECT * FROM digitalizaciones where id_oficina_registro=".$id.$infobus."";
}	  
			  
			  
			  
			  
                    
                    
					
					$selectn = mysql_query($queryn, $conexion) ;
                    $row = mysql_fetch_assoc($selectn);
					
$totalRows = mysql_num_rows($selectn);

if (0<$totalRows){
                    ?>

<style>
        .dataTables_filter {
          display: none;
        }
      </style>
	
                    <table class="table table-striped table-bordered table-hover" id="detallefun">
                    
					  <thead><tr align='center' valign='middle'>
					  <th>ID DE EXPEDIENTE</th><th>RUTA DE PDF</th><th>UBICACION DE TOPOGRAFICA DE CAJA</th><th>UBICACION DE TOPOGRAFICA DE CARPETA</th>
					  <th>FOLIO DE MATRICULA DE INMOBILIARIA</th><th>FOLIO DE INICIAL</th><th>FOLIO DE FINAL</th>
					  <th>NOMBRE DE DEPARTAMENTO</th><th>NOMBRE DE MUNICIPIO</th><th>NOMBRE DE VEREDA</th>
					  <th>TIPO DE PREDIO</th><th>NUMERO DE ANOTACION</th><th>TIPO DE DOCUMENTO</th>
					  <th>NUMERO DE DOCUMENTO</th><th>FECHA DE DOCUMENTO</th><th>OFICINA DE ORIGEN</th>
					  <th>NUMERO DE RADICACION</th><th>FECHA DE RADICACION</th><th>CODIGO DE NATURALEZA DE JURIDICA</th>
					  <th>ESPECIFICACION DE NATURALEZA DE JURIDICA</th><th>ESTADO DE FOLIO</th>
					  <th>DIRECCION DE ACTUAL</th><th>FALTA DE FORMULARIO</th><th>FALTA DE ANEXO</th>
					  <th>FALTA DE TRAMITE</th><th>CONTIENE DE PERIODICO</th><th>CONTIENE DE MAPA</th>
					  <th>CONTIENE DE CD</th><th>HASH DE TIFF</th><th>RUTA DE TIFF</th><th>HASH DE PDF</th><th>OBSERVACIONES</th>
					  <th>PROVEEDOR</th><th>ESTADO</th></tr></thead><tbody>
					  
                        <?php
                        do {
                          echo '<tr>';
                    
echo '<td>'.$row['ID_EXPEDIENTE'].'</td>';

echo '<td>';
if (2==$id) {
echo '<a href="./migracionorip/USAIDGDMONTELIBANO/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (14==$id) {
echo '<a href="./migracionorip/USAIDGDSANMARTIN/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (22==$id) {
echo '<a href="./migracionorip/USAIDGDCHAPARRAL/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (69==$id) {
echo '<a href="./migracionorip/USAIDGDTUMACO2/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (110==$id) {
	
	$v22=explode('Elcarmen/',$row['RUTA_PDF']);
	$v223=$v22[1];
	
echo '<a href="./migracionorip/USAIDGDCARMEN/'.$v223.'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (67==$id) {
echo '<a href="./migracionorip/USAIDGDCUCUTA/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (64==$id) {
echo '<a href="./migracionorip/USAIDGDOCANA/'.$row['RUTA_PDF'].'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else if (116==$id) {
	

	
		$v227=explode('Monteria/',$row['RUTA_PDF']);
	$v2237=$v227[1];
	
	
echo '<a href="./migracionorip/USAIDGDMONTERIA/'.$v2237.'" target="_blank">'.$row['RUTA_PDF'].'</a>';
} else { echo $row['RUTA_PDF']; }
echo '</td>';

echo '<td>'.$row['UBICACION_TOPOGRAFICA_CAJA'].'</td>';
echo '<td>'.$row['UBICACION_TOPOGRAFICA_CARPETA'].'</td>';
echo '<td>'.$row['FOLIO_MATRICULA_INMOBILIARIA'].'</td>';
echo '<td>'.$row['FOLIO_INICIAL'].'</td>';
echo '<td>'.$row['FOLIO_FINAL'].'</td>';
echo '<td>'.$row['NOMBRE_DEPARTAMENTO'].'</td>';
echo '<td>'.$row['NOMBRE_MUNICIPIO'].'</td>';
echo '<td>'.$row['NOMBRE_VEREDA'].'</td>';
echo '<td>'.$row['TIPO_PREDIO'].'</td>';
echo '<td>'.$row['NUMERO_ANOTACION'].'</td>';
echo '<td>'.$row['TIPO_DOCUMENTO'].'</td>';
echo '<td>'.$row['NUMERO_DOCUMENTO'].'</td>';
echo '<td>'.$row['FECHA_DOCUMENTO'].'</td>';
echo '<td>'.$row['OFICINA_ORIGEN'].'</td>';
echo '<td>'.$row['NUMERO_RADICACION'].'</td>';
echo '<td>'.$row['FECHA_RADICACION'].'</td>';
echo '<td>'.$row['CODIGO_NATURALEZA_JURIDICA'].'</td>';
echo '<td>'.$row['ESPECIFICACION_NATURALEZA_JURIDICA'].'</td>';
echo '<td>'.$row['ESTADO_FOLIO'].'</td>';
echo '<td>'.$row['DIRECCION_ACTUAL'].'</td>';
echo '<td>'.$row['FALTA_FORMULARIO'].'</td>';
echo '<td>'.$row['FALTA_ANEXO'].'</td>';
echo '<td>'.$row['FALTA_TRAMITE'].'</td>';
echo '<td>'.$row['CONTIENE_PERIODICO'].'</td>';
echo '<td>'.$row['CONTIENE_MAPA'].'</td>';
echo '<td>'.$row['CONTIENE_CD'].'</td>';
echo '<td>'.$row['HASH_TIFF'].'</td>';
echo '<td>'.$row['RUTA_TIFF'].'</td>';
echo '<td>'.$row['HASH_PDF'].'</td>';






echo '<td>'.$row['OBSERVACIONES'].'</td>';
echo '<td>'.$row['PROVEEDOR'].'</td>';
echo '<td>'.$row['ESTADO'].'</td>';
                      echo '</tr>';
                        } while ($row = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);


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
<?php } else { echo 'No existen registros';} ?>
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





<?php
 
  }
   } else {}
}
?>