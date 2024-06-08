<?php
$idfun=$_SESSION['snr'];
$idofici=$_SESSION['snr_tipo_oficina'];
if (isset($_SESSION['id_vigilado'])) {
    $idvigilado=$_SESSION['id_vigilado'];
	$sucesion=privilegiosnotariado($idvigilado, 2, $_SESSION['snr']);
	$salida=privilegiosnotariado($idvigilado, 9, $_SESSION['snr']);
	$personal=privilegiosnotariado($idvigilado, 11, $_SESSION['snr']);
	$apostilla=privilegiosnotariado($idvigilado, 13, $_SESSION['snr']);
} else {
	$idvigilado=0;
	$sucesion=0;
	$salida=0;
	$personal=0;
	$apostilla=0;
}

$nump18=privilegios(18,$_SESSION['snr']); // Sucesion
$nump97=privilegios(97,$_SESSION['snr']); // Digitalizacion notarial
$nump54=privilegios(54,$_SESSION['snr']); // testamentos


 ?>


	<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existenciaunica('notaria', 'id_categoria_notaria', 1); ?></h3>

              <p>Notarias 1 Categoria</p>
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
              <h3><?php echo existenciaunica('notaria', 'id_categoria_notaria', 2); ?></h3>

              <p>Notarias 2 Categoria</p>
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
              <h3><?php echo existenciaunica('notaria', 'id_categoria_notaria', 3); ?></h3>

              <p>Notarias 3 Categoria</p>
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

              <p>Total de Notarias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		

      </div>
	  
	  
	  
<?php
 IF ((3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) or 0<$sucesion or 0<$salida or 0<$personal or 0<$apostilla) { 

if (1==$_SESSION['rol']) {
	$id=395;
} else { $id=$_SESSION['id_vigilado']; }
?>
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
		</div>
 <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			
			 <li><a href="notaria&<?php echo $id; ?>.jsp"><b>NOTARIA 	 
     <?php echo quees('notaria', $id);?>
		  </b></a></li>
		  

             
			 
			   <?php if (($_SESSION['snr_tipo_oficina'] == 3 && 1==$_SESSION['snr_grupo_cargo']) or 1==$_SESSION['rol']) { ?> 
			  <li><a href="privilegios_notariado.jsp">Acceso a módulos</a></li>
             <?php } else {} ?>
			 
			  <li><a href="sucesion.jsp">Liq. Herencia</a></li>
			 <li><a href="salida_menor.jsp">Salida de menores</a></li>
			 <li><a href="notaria_datos_facturacion.jsp">Facturación</a></li>
            <li><a href="personal_notaria.jsp" title="">Personal</a></li>
	<li><a href="apostilla.jsp" title="Apostilla">Apostilla</a></li>
	
		<?php if (1==2) { ?> 
<li><a href="apostilla.jsp" title="Apostilla">Apostilla</a></li>
		<li><a href="certificacion.jsp" title="Certificaciones">Certificaciones</a></li>
	<li><a href="digitalizacion_notarial.jsp" title="Digitalización">Digitalización</a></li>
  <li><a href="local_notaria.jsp" title="">Local</a></li>	  	
 <li><a href="historico_notarias.jsp" title="Consulta historica">Historial</a></li>
	
		<?php } ?> 



            </ul>
          </div>
		 
      </div>
    </nav>
  </div>
</div>
	  <?php } else {}  ?>

	 


<div class="row">
  <div class="col-md-12">
    <div class="box ">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>

       <div class="box-body">
          <table class="table table-striped table-bordered table-hover" id="datoscontrato">
                <thead>
                    <tr>
                        <th>Cod Dane</th>
						<th>Departamento</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
						<th>SIN</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Acciones</th>        
                    </tr>
                </thead>
                <tbody> 
                  <?php 
                    $query4 = sprintf("SELECT * FROM notaria, departamento where notaria.id_departamento=departamento.id_departamento and estado_notaria=1");              
                    $result = $mysqli->query($query4);
                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                ?>
                <tr>
			
				  <?php $id_notaria = $row['id_notaria']; ?>
                  <td><?php echo $row['codigo_dane']; ?></td>
				  	<td><?php echo $row['nombre_departamento']; ?></td>
                  <td style="width: 200px;"><?php echo $row['nombre_notaria']; ?></td>
                  <td><?php echo $row['id_categoria_notaria']; ?></td>
				  <td><?php if (1==$row['sin']) { echo 'Si'; } else { echo 'No';}  ?></td>
                  <td style="width: 80px;"><?php echo trim($row['telefono_notaria']); ?></td>
                  <td style="width: 180px !important;"><?php echo $row['email_notaria']; ?></td>
				  <td>
            &nbsp;&nbsp;<a href="notaria&<?php echo $id_notaria; ?>.jsp"><span class="glyphicon glyphicon-search" ></span></a>&nbsp;&nbsp;
			
			
			
				  <?php	if (1==$_SESSION['rol'] or 0<$nump18 or 0<$nump97 or 0<$nump54) { ?>
                    <li class="nav-item dropdown" style="list-style:none !important; float:left;"> 
                      <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         M&oacute;dulo
                      </a>
                    
	                  <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 500;">
  				        <?php
                              $query = sprintf("SELECT nombre_url_notariado, nombre_modulo_notariado 
					                   FROM modulo_notariado 
					                   WHERE estado_modulo_notariado=1 order by id_modulo_notariado"); 
                              $select = mysql_query($query, $conexion) or die(mysql_error());
                              $row = mysql_fetch_assoc($select);
                              $totalRows = mysql_num_rows($select);
                              if (0<$totalRows){
                                 do { 
								  $nprog = $row['nombre_url_notariado'].'&'.$id_notaria.'.jsp';
								  $nopcion = $row['nombre_modulo_notariado'];
                              ?>
					              
                              <a class="dropdown-item" href="<?php echo $nprog; ?>"><?php echo $nopcion; ?></a><br>
                              <?php
               				   } while ($row = mysql_fetch_assoc($select)); 
                               } else {}	 
                               mysql_free_result($select);
				        ?> 
						<a class="dropdown-item" href="digitalizacion_notarial&<?php echo $id_notaria; ?>.jsp">Digitalización</a><br>
													  
                      </div>
                    </li>
                  <?php } ?>

				  </td>

                </tr>
            <?php
              } // cierre de while
            ?>

                <script>
                $(document).ready(function() {
                $('#datoscontrato').DataTable({
				"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                  }
                });
                });
                </script>
                </tbody>
          </table>
      </div><!-- /.box-body -->
    </div> <!-- box -->
  </div> <!-- col-md-12 -->
</div> <!-- row -->