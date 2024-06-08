<?php
$nump69 = privilegios(69, $_SESSION['snr']);
$nump75 = privilegios(75, $_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump75 or 0<$nump69) {
	
	
?>
   <div class="row">
    <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php
$select77n = mysql_query("select count(id_notaria) as cuentann from notaria where sin=1 ", $conexion);
$row77n = mysql_fetch_assoc($select77n);
$notsin=$row77n['cuentann'];
mysql_free_result($select77n);
			  echo $notsin;
			  ?>
			  </h3>

              <p>SIN</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#miModal">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php 
$select77 = mysql_query("select count(id_notaria_facturacion) as cuentan from notaria_facturacion, notaria where notaria_facturacion.id_notaria=notaria.id_notaria and sin=1 and  fecha_actualizacion is not null and estado_notaria_facturacion=1", $conexion);
$row77 = mysql_fetch_assoc($select77);
$diligenciado=$row77['cuentan'];
echo $diligenciado;
mysql_free_result($select77);
			  ?></h3>

              <p>Diligenciados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="" class="small-box-footer">Más info.</a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
<?php 
$select2 = mysql_query("select count(id_notaria) as tot from notaria_facturacion where instalada=1", $conexion);
$row2 = mysql_fetch_assoc($select2);
echo $row2['tot'];
mysql_free_result($select2);
			  ?>

			  </h3>

              <p>Instaladas</p>
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
              <h3><?php 

$select2 = mysql_query("select count(id_notaria) as tot from notaria_facturacion where evidencia is not null", $conexion);
$row2 = mysql_fetch_assoc($select2);
echo $row2['tot'];

mysql_free_result($select2);

			  ?></h3>
              <p>Habilitadas con evidencia</p>
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
<a href="https://sisg.supernotariado.gov.co/documentos/SIN-SERVIDOR.exe" target="_blank">Descargar SIN Servidor</a> &nbsp; 
  <a href="documentos/Manual_SIN.pdf" target="_blank"><b>Manual de SIN</b></a>  
 <BR>  <a href="https://sisg.supernotariado.gov.co/documentos/SIN_CLIENTE.exe" target="_blank">Descargar SIN Cliente</a>
<!--<br><a href="documentos/SISG.exe">Descargar Instalador F.E.</a>-->
  <br>	<a href="https://sisg.supernotariado.gov.co/documentos/SISG.exe" target="_blank">Descargar Instalador web F.E. </a> 
	
	 / <a href="https://we.tl/t-xC3A3zRsOv" target="_blank">Descarga rapida</a>
	</div>
	  
	  
	  
<div class="col-md-4">
<a href="documentos/Manual_FE.html" target="_blank"><img src="images/youtube.fw.png" style="width:20px;height:20px;"> <b>Ver manual F.E.</b></a>	
<BR><a href="https://catalogo-vpfe-hab.dian.gov.co/User/PersonLogin" target="_blank">Acceder a DIAN habilitación</a>	
<BR><a href="https://catalogo-vpfe.dian.gov.co/User/PersonLogin" target="_blank">Acceder a DIAN producción, operación</a>	
	
</div>

<div class="col-md-4">
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">
<div class="input-group">
<div class="input-group-btn">
<input type="text" name="buscar_notaria" placeholder="Buscar globalmente Notaria" class="form-control" required ></div>
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>
</form>
</div>
  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
<style>




			</style> 
			
<table  class="table table-striped table-bordered table-hover" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th></th>
 <th>DEPARTAMENTO</th>
<th>NOTARIA</th>
<th>Con formulario</th>
<th>Fecha registro</th>
<th>Data correcta</th>
<th title="Asignado">Asignada.</th>
<th title="Instalada y configurada">Instalada</th>
<th title="Habilitada">Habilitada con evid.</th>
<!--<th>CORREO DE RUT</th>-->
<th>NIT</th>
<th>Celular</th>
<th>Telefono</th>
<!--<th>Dirección</th>-->
<th>Nombre</th>
<th>ANYDESK</th>
<!--<th>Seguimiento</th>-->
				  
</tr>
</thead>
<tbody>
<?php 

if (isset($_POST['buscar_notaria']) && ""!=$_POST['buscar_notaria']) {
	$bus=$_POST['buscar_notaria'];
				
				$infop=" and notaria.nombre_notaria like '%".$bus."%' ";
				$asignacion='';
			
				} else {
					
				$infop='';
				
				if (1==$_SESSION['rol'] or 0<$nump69) {
					
					if (2286==$_SESSION['snr']) {
						$asignacion=" and id_funcionario=".$_SESSION['snr']." ";
					} else {
						
						
if (isset($_GET['i']) && ""!=$_GET['i']) {
$asignacion=" and id_funcionario=".$_GET['i']." ";
} else {
$asignacion='';
}
						
						
					}
					
					
				} else {
					$asignacion=" and id_funcionario=".$_SESSION['snr']." ";
				}
					
					

				
				}
 

$query4="SELECT * from notaria_facturacion, notaria, departamento where notaria.id_departamento=departamento.id_departamento and notaria_facturacion.id_notaria=notaria.id_notaria and estado_notaria_facturacion=1 and sin=1 ".$infop." ".$asignacion." ORDER BY fecha_actualizacion desc LIMIT 700"; //   OFFSET ".$pagina." ";    --- LIMIT 500 OFFSET ".$pagina."

$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {


$id_fac=$row['id_notaria_facturacion'];

echo '<tr>';
echo '<td><span style="font-size:9px;color:#fff;">'.$id_fac.'</span></td>';
echo '<td>'.$row['nombre_departamento'].'</td>';
echo '<td><a href="notaria&'.$id_fac.'.jsp" target="_blank">'.$row['nombre_notaria'].'</a> ';
//echo '<a href="factura_notariado/'.$id_fac.'.json" target="_blank"><i class="fa fa-file"></i></a>';
echo '</td><td>';

if (isset($row['fecha_actualizacion']) && ""!=$row['fecha_actualizacion']) {
	echo 'Si <i class="fa fa-check" style="color:#00A65A"></i>';
} else {
	echo 'No <i class="fa fa-close" style="color:#B40404"></i>';
}

echo '</td>';

echo '<td>'.$row['fecha_actualizacion'].'</td>';

echo '<td>';
if (1==$row['permiso_actualizacion']) {
	echo 'No <i class="fa fa-close" style="color:#B40404"></i>';
} else {
	echo 'Si <i class="fa fa-check" style="color:#00A65A"></i>';
}
echo ' <a href="notaria_datos_facturacion&'.$id_fac.'.jsp" target="_blank">Ver</a> ';
echo '</td>';








echo '<td>'; 
if (isset($row['id_funcionario'])) {
	echo 'Si, <a href="usuario&'.$row['id_funcionario'].'.jsp" target="_blank">';
	echo contacto($row['id_funcionario']);
	echo '</a>';
} else {
	echo 'No ';
}
	
	echo '</td>';
	
	
	echo '<td>'; 
if (1==$row['instalada']) {
	echo 'Si <i class="fa fa-check" style="color:#00A65A"></i>';
} else {
	echo 'No <i class="fa fa-close" style="color:#B40404"></i>';
}

	echo '</td>';
	


	echo '<td>'; 
if (isset($row['evidencia']) && ""!=$row['evidencia']) {
	echo 'Si <i class="fa fa-check" style="color:#00A65A"></i><a href="filesnr/fe/'.$row['evidencia'].'" target="_blank">Ver</a>';
} else {
	echo 'No <i class="fa fa-close" style="color:#B40404"></i>';
}
echo '</td>';
//echo '<td>'.$row['correo_rut'].'</td>';
echo '<td>'.$row['nit'].'</td>';
echo '<td>'.$row['celular_n'].'</td>';
echo '<td>'.$row['telefono_notaria'].'</td>';
//echo '<td>'.$row['direccion_n'].'</td>';
/*echo '<td>'.$row['cod_postal'].'</td>';
echo '<td>'.$row['id_sw'].'</td>';
echo '<td>'.$row['testsetid'].'</td>';
echo '<td>'.$row['llave_tecnica'].'</td>';
echo '<td>'.$row['prefijo'].'</td>';
echo '<td>'.$row['rango_desde'].'</td>';
echo '<td>'.$row['rango_hasta'].'</td>';
echo '<td>'.$row['rango_fecha_desde'].'</td>';
echo '<td>'.$row['rango_fecha_hasta'].'</td>';*/
echo '<td>'.$row['nombre_notario'].'</td>';
/*echo '<td>'.$row['vigencia_desde'].'</td>';
echo '<td>'.$row['vigencia_hasta'].'</td>';
echo '<td>'.$row['velocidad_internet'].'</td>';
echo '<td>'.$row['estabilidad_internet'].'</td>';*/
echo '<td>'.$row['anydesk'].'</td>';
//echo '<td>'.$row['seguimiento'].'</td>';
/*echo '<td>';

 if (1==$row['estabilidad_internet']) { echo 'Siempre hay internet'; } 
 else if (2==$row['estabilidad_internet']) { echo 'Falla el internet menos de 1 hora al dia'; } 
 else  if (3==$row['estabilidad_internet']) { echo 'Falla el internet menos de 2 hora al dia'; } 
 else  if (4==$row['estabilidad_internet']) { echo 'Falla el internet menos de 6 hora al dia'; } 
 else if (5==$row['estabilidad_internet']) { echo 'Falla el internet un dia a la semana'; } 
 else  if (6==$row['estabilidad_internet']) { echo 'Falla el internet varios dias a la semana'; } 
 else {}


echo '</td>';
*/
/*echo '<td>'.$row['resolucion_dian'].'</td>';
echo '<td>'.$row['fecha_resolucion_dian'].'</td>';


echo '<td>';
echo '<a href="factura_notariado/'.$id_fac.'.json" target="_blank"><b>JSON</b></a>';

echo '</td>';*/
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
						"aaSorting": [[ 0, "asc"]]
					});
				});
				
								
			
		
				
			</script>
			
 <?php
/*
 if (isset($_POST['buscar'])) { } else {
	 

$totalr=$diligenciado;
if (200<$totalr) {
$maxp=$totalr/200;
$maxp2=intval($maxp);
$maxp3=$maxp2*200;
  
 if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
		
		
echo '<hr>Paginación:  &nbsp;  <a href="reporte_fac_notaria.jsp">Inicio</a> &nbsp;  ';

if (200<$pagina) {
$menosp=$pagina-200;
echo ' <a href="reporte_fac_notaria&'.$menosp.'.jsp">Anterior</a> &nbsp;  ';	
} else {
echo '';
}


if ($pagina<$maxp3) {
$masp=$pagina+200;
echo '<a href="reporte_fac_notaria&'.$masp.'.jsp">Siguiente</a> &nbsp; ';
} else {
echo '';
}


echo '<a href="reporte_fac_notaria&'.$maxp3.'.jsp">Final</a> ';
	
		
	 } else {

	 

echo '<hr>Paginación:  &nbsp;  <a href="reporte_fac_notaria&200.jsp">Siguiente</a> &nbsp; 
<a href="reporte_fac_notaria&'.$maxp3.'.jsp">Final</a> ';
		
	 }
} else {}
		 } */
	 ?>
		 
		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->




 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Asignaciones</h4>
      </div>
      <div class="modal-body">

<?php
$selectk = mysql_query("SELECT id_funcionario_perfil, nombre_funcionario, funcionario.id_funcionario FROM funcionario_perfil, funcionario  where funcionario_perfil.id_perfil=75  and  funcionario_perfil.id_funcionario=funcionario.id_funcionario and estado_funcionario_perfil=1 and estado_funcionario=1 order by nombre_funcionario", $conexion);
$rowk = mysql_fetch_assoc($selectk);
$totalRowsk = mysql_num_rows($selectk);
if (0<$totalRowsk){
	echo '<ul style="list-style:none;">';  // 
do {
echo '<li>';
echo '<a href="reporte_fac_notaria&'.$rowk['id_funcionario'].'.jsp"><span class="fa fa-user"></span></a> ';
echo $rowk['nombre_funcionario'];

$select77n = mysql_query("select count(id_notaria) as cuentann from notaria_facturacion where instalada=0 and id_funcionario=".$rowk['id_funcionario']." ", $conexion);
$row77n = mysql_fetch_assoc($select77n);
echo ' - '.$row77n['cuentann'];
mysql_free_result($select77n);


echo '</li>';
 } while ($rowk = mysql_fetch_assoc($selectk)); 
 echo '</ul>';
} else { } 
mysql_free_result($selectk);
?>

     </div>
    </div>
  </div>
</div>




<?php

}
?>



