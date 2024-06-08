<?php
$idfun = $_SESSION['snr'];
$idofici = $_SESSION['snr_tipo_oficina'];
if (isset($_SESSION['id_oficina_registro'])  and 2 == $_SESSION['snr_tipo_oficina']) {
  $idvigilado = $_SESSION['id_oficina_registro'];
} else if ((1 == $_SESSION['rol'])  and "" != $_GET['i']) {
  $idvigilado = $_GET['i'];
} else {
  $idvigilado = 0;
}

$nump56 = privilegios(56, $_SESSION['snr']); // Admin_Tesoreria_Devoluciones 
$nump57 = privilegios(57, $_SESSION['snr']); // Admin_Presupuesto_Devoluciones
$nump58 = privilegios(58, $_SESSION['snr']); // Admin_Contabilidad_Devoluciones
$nump59 = privilegios(59, $_SESSION['snr']); // Usuarios_Presupuesto_Devoluciones
$nump60 = privilegios(60, $_SESSION['snr']); // Usuarios_Contabilidad_Devoluciones
$nump61 = privilegios(61, $_SESSION['snr']); // Usuarios_Tesoreria_Devoluciones
$principal_devolucion = privreg($idvigilado, $idfun, 3, 7);
$seccional_devolucion = privreg($idvigilado, $idfun, 3, 8);

$privregcorreccion=privreg($idvigilado, $idfun, 1, 1);
$privreg=privreg($idvigilado, $idfun, 1, 2);

require_once "controlador/privilegio_registro.php";
require_once "modelo/privilegio_registro.php";
?>

<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo existencialimitada('oficina_registro', 'id_oficina_registro_sismisional', 1); ?></h3>
        <p>En SIR</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo existencialimitada('oficina_registro', 'id_oficina_registro_sismisional', 2); ?></h3>
        <p>En Folio</p>
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
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>195</h3>

        <p>ORIP´S</p>
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
    <div class="small-box bg-red">
      <div class="inner">
        <h3>5</h3>

        <p>Regionales</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>




<?php if (2==$_SESSION['snr_tipo_oficina']) { ?>
<div class="row">
  <div class="col-md-12">
    <nav class="navbar navbar-default" style="background:#fff;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="navbar-brand"> ORIP <?php if (0 != $idvigilado) {
                                              echo '<a href="orip&' . $idvigilado . '.jsp">';
                                              echo quees('oficina_registro', $idvigilado);
                                              echo '</a>';
                                            } else {
                                            }
                                            ?></span>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

           
            <li><a href="percepcion&<?php echo $idvigilado; ?>.jsp">Percepción</a></li>

 <li><a href="privilegios_registro&<?php echo $idvigilado; ?>.jsp">Privilegios</a></li>
 
 <li><a href="reporte_diario_orip.jsp">Reporte diario</a></li>

            <!--
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Comodato <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="comodato_encuesta&<?php //echo $idvigilado; 
                                                ?>.jsp">Comodato Impresoras</a></li>
                <li><a href="#">Comodato Computadores</a></li>
              </ul>
            </li>
			-->


            <!--<li><a href="#">Boletines</a></li>
			 <li><a href="#">Situaciones administrativas</a></li>
            <li><a href="#">Devoluciones</a></li>-->
           

<?php if (1 == $_SESSION['rol'] or 0<$privregcorreccion or 0< $privreg) { ?>
            <li><a href="no_conformidad&<?php echo $idvigilado; ?>.jsp">Salida no conforme</a></li>
			<!-- <li><a href="comodato_encuesta&<?php // echo $idvigilado; ?>.jsp">Encuesta Impresoras</a></li>-->
		
<?php } ?>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>

<?php } else {} ?>





<div class="row">
  <div class="col-md-12">
    <!-- TABLE: LATEST ORDERS -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><strong>Oficinas De Registro De Instrumentos Públicos</strong></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="menuorip">
            <thead>
              <tr>
                <th>Regional</th>
                <th>Departamento</th>
                <th>Orip</th>
                <th>Misional</th>
                <th>Circulo</th>
                <th>Telefono</th>
                <th style="min-width:340px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query4 = sprintf("SELECT * FROM oficina_registro, region, municipio, departamento, oficina_registro_sismisional  where region.id_region=oficina_registro.id_region and municipio.id_departamento=departamento.id_departamento and oficina_registro.id_departamento=departamento.id_departamento and  oficina_registro.id_municipio=municipio.codigo_municipio and oficina_registro.id_departamento=municipio.id_departamento and  oficina_registro_sismisional.id_oficina_registro_sismisional=oficina_registro.id_oficina_registro_sismisional and estado_oficina_registro=1");
              $result = $mysqli->query($query4);
              while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              ?>
                <tr>
                  <td><?php echo $row['nombre_region']; ?></td>
                  <td><?php echo $row['nombre_departamento']; ?></td>
                  <td><?php echo $row['nombre_oficina_registro']; ?></td>
                  <td><?php echo $row['nombre_oficina_registro_sismisional']; ?></td>
                  <td><?php echo $row['circulo']; ?></td>
                  <td><?php echo $row['telefono_oficina_registro']; ?></td>
                  <td style="width:340px;">
                    <?php
             
				  
               echo ' <a href="orip&' . $row['id_oficina_registro'] . '.jsp" title="Detalle" ><i class="fa fa-search"></i></a>&nbsp;';

             if (2>=$_SESSION['snr_tipo_oficina']) { 
                      echo ' <a href="privilegios_registro&' . $row['id_oficina_registro'] . '.jsp" title="Acceso módulos" class="btn-sm btn-primary"><i class="fa fa-key" aria-hidden="true"></i></a>&nbsp;';

                      echo ' <a href="percepcion&' . $row['id_oficina_registro'] . '.jsp" title="Percepción ciudadana" class="btn-sm btn-danger"><i class="fa fa-users" aria-hidden="true"></i></a>&nbsp; ';

                          echo '  <a href="gsa_general&orden.jsp" style="background:#0066f7" title="Servicios Admnistrativos" class="btn-sm btn-success"><i class="fa fa-fw fa-truck"></i></a>&nbsp;';

                          echo '&nbsp;<div class="btn-group">
                              <a href="" style="background:#25ea3d" title="Ambiental" class="btn-sm btn-success" data-toggle="dropdown"><i class="fa fa-fw fa-leaf"></i></a>&nbsp;
                              <ul class="dropdown-menu">
                                <li><a href="ambiental_consumo&' . $row['id_oficina_registro'] . '.jsp">Consumo</a></li>
                                <li><a href="ambiental_puntos.jsp">Puntos Ecologicos</a></li>
                              </ul>
                            </div>';
     
	  echo '  <a href="analisis_oficina&' . $row['id_oficina_registro'] . '-2.jsp" style="background:#B52824" title="PQRSD" class="btn-sm btn-success"><i class="fa fa-user"></i></a>&nbsp;';
			} else {}    
				 


				 if (1 == $_SESSION['rol'] or 0<$privregcorreccion or 0<$privreg or (2 == $_SESSION['snr_tipo_oficina'] and 1 == $_SESSION['snr_grupo_cargo'])) {
							   
					echo '<a href="no_conformidad&' . $row['id_oficina_registro'] . '.jsp" title="No conformidad" class="btn-sm btn-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a> &nbsp;';
		

					   } else { }
						
                          
        if (1 == $_SESSION['rol']) {
						echo '	 <a href="comodato_encuesta&' . $row['id_oficina_registro'] . '.jsp" title="Encuesta de impresoras" class="btn-sm btn-info"><i class="fa fa-print" aria-hidden="true"></i></a>&nbsp;';
        } else {}
        if (1 == $_SESSION['rol'] || 0 < $nump56 || 0 < $nump57 || 0 < $nump58 || 0 < $nump59 || 0 < $nump60 || 0 < $nump61 || 0 < $principal_devolucion || 0 < $seccional_devolucion) {
            echo '  <a href="devolucion_dinero.jsp" title="Devoluciones" class="btn-sm btn-success"><i class="fa fa-usd" aria-hidden="true"></i></a>&nbsp;';
        }
                    ?>
                  </td>
                </tr>
              <?php
              } // cierre de while
              ?>
			  <script>
				$(document).ready(function() {
					$('#menuorip').DataTable({
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
			
            
            </tbody>
          </table>

        </div> <!-- /.table-responsive -->

      </div> <!-- /.box-body -->

    </div> <!-- /.box -->

  </div> <!-- col-md-12 -->
</div> <!-- row -->