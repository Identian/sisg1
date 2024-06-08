

  <div class="row">
 <div class="col-md-12">
        <div class="nav-tabs-custom">
<br>
           <form class="navbar-form" name="fotertrm5435435rter1erteg" method="post" action="">

 Criterios de busqueda por dependencia y sede<br><br>
<table border="1">
<tr><td>Cod dependencia</td><td>Cod SGD</td><td>Dependencia</td><td>Cod Sede</td><td>Nombre de la Sede</td></tr>
<tr><td>1</td><td>A0001</td><td>DESPACHO</td><td>1</td><td>DIRECCIÓN TÉCNICA DE REGISTRO</td></tr>
<tr><td>2</td><td>A002 </td><td>GRUPO ADMINISTRATIVO Y TECNOLÓGICO</td><td>1</td><td>DIRECCIÓN TÉCNICA DE REGISTRO</td></tr>
<tr><td>3</td><td>A003 </td><td>OFIC. DE REGISTRO DE INSTRUMENTOS PÚBLICOS – ORIP CARTAGENA</td><td>1</td><td>DIRECCIÓN TÉCNICA DE REGISTRO</td></tr>
<tr><td>10</td><td>A010 </td><td>ORIP CARTAGENA</td><td>1</td><td>DIRECCIÓN TÉCNICA DE REGISTRO</td></tr>
<tr><td>4</td><td>A004 </td><td>ARCHIVO CENTRAL – BODEGA FUNZA OFC PRODUCTORA</td><td>2</td><td>ARCHIVO CENTRAL – BODEGA FUNZA</td></tr>
<tr><td>5</td><td>A005 </td><td>SECRETARÍA GENERAL</td><td>3</td><td>DESPACHO DEL SUPERINTENDENTE</td></tr>
<tr><td>6</td><td>A006 </td><td>OFICINA ASESORA DE PLANEACIÓN</td><td>3</td><td>DESPACHO DEL SUPERINTENDENTE</td></tr>
<tr><td>7</td><td>A007 </td><td>--</td><td>3</td><td>DESPACHO DEL SUPERINTENDENTE</td></tr>
<tr><td>8</td><td>A008 </td><td>OFICINA DE CONTROL DISCIPLINARIO INTERNO</td><td>3</td><td>DESPACHO DEL SUPERINTENDENTE</td></tr>
<tr><td>9</td><td>A009 </td><td>ORIP BOGOTÁ - ZONA CENTRO</td><td>3</td><td>DESPACHO DEL SUPERINTENDENTE</td></tr>
<tr><td>11</td><td>A011 </td><td>GRUPO TESORERÍA</td><td>4</td><td>DIRECCIÓN ADMINISTRATIVA Y FINANCIERA</td></tr>
</table>
<hr>



<B>  Busqueda (707.692 registros):</B> 
              <div class="input-group">
                <div class="input-group-btn">
                  <select class="form-control" name="campo" required>
                    <option value="" selected> - - Buscar por: - - </option>
<option>Asunto</option>
<option>Circulo Registral </option>
<option>Codigo Libro</option>
<option>Código Serie Documental </option>
<option>Código Subserie Documental</option>
<option>Color Libro </option>
<option>Departamento y Municipo </option>
<option>Dependencia Jerárquica</option>
<option>Entidad Origen</option>
<option>Entidad Origen (otras)</option>
<option>Fecha de Escritura</option>
<option>Fecha del acto</option>
<option>Fecha documento </option>
<option>Fecha documento Acto  </option>
<option>Fecha final </option>
<option>Fecha inicial </option>
<option>Fecha Turno </option>
<option>Libro Par/Impar </option>
<option>Libro Tipo A / Tipo B </option>
<option>No. De expediente o Unidad Documental </option>
<option>No. de libro o correlativo, que será alfanumérico.</option>
<option>No. documento </option>
<option>Nombre</option>
<option>Número de Instrumento </option>
<option>Número del acto </option>
<option>Número Turno</option>
<option>Observaciones </option>
<option>Oficina Productora</option>
<option>Página Acto </option>
<option>Personas o Empresas Intervinientes</option>
<option>Rango de Partidas Año (Desde) </option>
<option>Rango de Partidas Año (Hasta) </option>
<option>Rango de Partidas Año Final Serie ""DESDE""   </option>
<option>Rango de Partidas Año Final Serie ""HASTA""   </option>
<option>Rango de Partidas Año Inicial Serie ""DESDE""   </option>
<option>Rango de Partidas Año Inicial Serie ""HASTA""  </option>
<option>Serie Documental</option>
<option>Subserie Documental </option>
<option>Tipo de instrumento con el que se hizo el Acto</option>
<option>Tipo de Libro Principal </option>
<option>Total Folios</option>
<option>Ubicación Territorial </option>
<option>Ubicación topográfica caja</option>
<option>Ubicación topográfica carpeta </option>
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
                $infobus = " and campo like '%" . utf8_decode($_POST['campo']) . "%' and valor like '%" . utf8_decode($_POST['buscar']) . "%' limit 400";
                
              } else {
                $infobus = " limit 200";
              }
			  
                    $queryn = "SELECT * FROM digitaemtel where id_digitaemtel is not null ".$infobus."";
                    
					//echo  $queryn;
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
					  <th>Libro</th><th>Campo</th><th>Valor</th><th>Archivo</th>
					  </tr></thead><tbody>
					  
                        <?php
                        do {
                          echo '<tr>';
                    
echo '<td>'.$row['libro'].'</td>';
echo '<td>'.utf8_encode($row['campo']).'</td>';
echo '<td>'.utf8_encode($row['valor']).'</td>';
$url=explode('-',$row['url']);
$url1=$url[0];
echo '<td><a href="./GestionDMigraEmtel/EMTEL_SNR/'.$url1.'/Digitalizacion/'.$row['url'].'" target="_blank">'.$row['url'].'</a></td>';

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
						"aaSorting": [[ 3, "desc"]]
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





