<?php
if (3>$_SESSION['snr_tipo_oficina']) {
	$nump146=privilegios(146,$_SESSION['snr']);
	
	if (24==$_SESSION['snr_grupo_area'] or 0<$nump146) {
		?>
		
  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3><?php $actualizar55 = mysql_query("SELECT count(id_solicitud_pqrs) as tota FROM solicitud_pqrs where estado_solicitud_pqrs=1", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo $row155['tota'];
mysql_free_result($actualizar55);
 ?>
 </h3>

              <p>PQRS Pendientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="" class="small-box-footer" data-toggle="modal" data-target="#controlpqrs">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> 
<?php $actualizar55c = mysql_query("SELECT COUNT(id_solicitud_pqrs) as totac FROM clasificacion_pqrs where estado_clasificacion_pqrs=1", $conexion);
$row155c = mysql_fetch_assoc($actualizar55c);
echo $row155c['totac'];
mysql_free_result($actualizar55c);
 ?>
</h3>

              <p>PQRS Clasificadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#popupclasificadas">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
<?php $actualizar55ca = mysql_query("SELECT COUNT(id_solicitud_pqrs) as totaca FROM asignacion_pqrs where estado_asignacion_pqrs=1", $conexion);
$row155ca = mysql_fetch_assoc($actualizar55ca);
echo $row155ca['totaca'];
mysql_free_result($actualizar55ca);
 ?>
</h3>

              <p>PQRS Direccionadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
			
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#popupdireccionadas">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3><?php echo existenciaunica('solicitud_pqrs', 'id_estado_solicitud', 3); ?></h3>
              <p>PQRS RETORNADAS A OAC.</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#popupretornadas">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
			
			
			
          </div>
        </div>
		
	 
      </div>
	  
	
	<?php } else {
	?>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3><span class="" id="todas"></span>
 </h3>
<p><?php	if (isset($_GET['i']) && ""!=$_GET['i']) {
		echo 'PQRS asignadas';
			} else {  echo 'PQRS pendientes'; } ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="xls/pqrs_pendientes&0&<?php echo $_SESSION['snr']; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> 
<span class="" id="ampli"></span>
</h3>

              <p>PQRS ampliadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="xls/pqrs_pendientes&0&<?php echo $_SESSION['snr']; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
		

		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
<?php	if (isset($_GET['i']) && ""!=$_GET['i']) {
		echo '<h3>0</h3><p>PQRS </p>';
			} else {  echo '<h3><span class="" id="hoy"></span></h3><p>PQRS vencen hoy</p>'; } ?>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
			
            <a href="xls/pqrs_pendientes&0&<?php echo $_SESSION['snr']; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3><span class="" id="vencidas"></span></h3>
                 <p><?php	if (isset($_GET['i']) && ""!=$_GET['i']) {
		echo 'PQRS';
			} else {  echo 'PQRS vencidas'; } ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="xls/pqrs_pendientes&0&<?php echo $_SESSION['snr']; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
			
			
			
          </div>
        </div>
		
	 
      </div>
	
	
	<?php
	
	
	} 
	
	
} else {}
?>


	
	
	
	
<div class="row">
<div class="col-md-12">
  <div class="box box-info">
<?php
if (2<$_SESSION['snr_tipo_oficina']) { 

//if (1==$_SESSION['rol']) {
//$idofici=3;
$idofici=$_SESSION['snr_tipo_oficina'];
//$idvigilado=391;
$idvigilado=$_SESSION['id_vigilado'];

$query = sprintf("SELECT * FROM requerir_pqrs where radicado_requerimiento is not null and id_tipo_oficina=".$idofici." and id_vigilado=".$idvigilado." and estado_requerir_pqrs=1");
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);

if (0<$totalRows){
?>
<div class="box-header with-border">
<table class="table table-striped table-bordered table-hover" id="pqrsvigilados">
<thead>
<tr align='center' valign='middle'>
<th>Radicado</th>
<th>Fecha de solicitud</th>
<th>Plazo</th>
<th>Estado</th>
<th>Fecha de respuesta</th>
<th></th>
</tr>
</thead><tbody>
<?php
do {
echo '<tr>';
echo '<td>'.$row['radicado_requerimiento'].'</td>';
echo '<td>'.$row['fecha_solicitudr'].'</td>';
$fecharnotario=fechahabil($row['fecha_solicitudr'],5);
echo '<td>'.$fecharnotario.'</td>';
echo '<td>';
if (isset($row['fecha_respuestar'])){
	echo 'Finalizada';
} else {
	echo 'Pendiente';
}

echo '</td>';
echo '<td>'.$row['fecha_respuestar'].'</td>';
echo '<td><a href="requerimiento_respuesta&'.$row['id_solicitud_pqrs'].'.jsp">';
if (isset($row['fecha_respuestar'])){
	echo '<span class="label label-success"><i class="glyphicon glyphicon-search"></i> Ver</span>';
} else {
	echo '<span class="label label-warning"><i class="glyphicon glyphicon-search"></i> Responder</span>';
}


echo '</a></td>';
} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);
?>	
</tbody></table>
	  <script>
					      	$(document).ready(function() {
							  $('#pqrsvigilados').DataTable({
							    "language": {
							      "url": "/json/tablacastellano.json"
							    },
								"aaSorting": [[ 1, "desc"]]
							  });
							});
					    </script>				
					</div>
					

 <?php		

} else {	
echo '<div class="box-header with-border">0 registros</div>';
}


 } else {

  
// PQRS PARA SNR


if ((isset($_POST['buscar']) && ""!=$_POST['buscar']) or 24==$_SESSION['snr_grupo_area'] or 0<$nump146) {
			
			
			
if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
$query = "SELECT * from solicitud_pqrs where estado_solicitud_pqrs=1 and ".$_POST['campo']." like '%".$_POST['buscar']."%'";
			} else {
if (0<$nump146) {
$query = "SELECT * from solicitud_pqrs where estado_solicitud_pqrs=1 and id_estado_solicitud in (2, 3) and pqrs_direccionada!=1";		
} else {
	
	
function gestion_pqrs($func) {
global $mysqli;
$query = "SELECT id_gestion_pqrs as nume FROM gestion_pqrs where id_funcionario=".$func." and estado_gestion_pqrs=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$resuln=" and id_gestion_pqrs=".$row['nume']." and id_estado_solicitud in (2, 3) ";
} else { $resuln=" and  id_estado_solicitud=3 "; }
return $resuln;
$result->free();
	}
$infopqrs=gestion_pqrs($_SESSION['snr']);
	
$query = "SELECT * from solicitud_pqrs where estado_solicitud_pqrs=1 ".$infopqrs." and pqrs_direccionada!=1";		
	
}
			}
		
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);


	

	
?>
<div class="box-header with-border">

<div class="col-md-4">
</div>
<div class="col-md-8">
<form action="" method="post" name="rtret">
<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected>- - - Buscar por:  - - - - </option>
 		  <option value="radicado">Radicado entrada</option>
		   <option value="radicado_respuesta">Radicado de respuesta</option>
		    <!-- <option value="identificacion">Identificación Ciudadano</option>-->
		  </select>
</div>
<div class="input-group-btn"><input type="text" style="width:250px;" name="buscar" placeholder="Buscar" class="form-control" required ></div>
 
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
</div>
</form>
</div>

<?php if (1==$_SESSION['rol']) { } else { ?>
<style>
    .dataTables_filter {
          display: none;
        }
	
      </style>
<?php }


if (0<$totalRows){

 ?>
<table class="table table-striped table-bordered table-hover" id="pqrssnr">
<thead>
<tr align='center' valign='middle'>
<th>Radicado</th>
<th>Fecha de solicitud</th>
<th>Estado</th>
<th>Asignación</th>
<th>Canal</th>
<th>Respuesta</th>
<th></th>
</tr>
</thead><tbody>
<?php


do {
echo '<tr>';
echo '<td>'.$row['radicado'].'</td>';
echo '<td>'.$row['fecha_radicado'].'</td>';
echo '<td>';
if (1==$row['id_estado_solicitud']) {
	echo 'Radicación';
} else if (2==$row['id_estado_solicitud']) {
echo 'En tramite';
} else if (3==$row['id_estado_solicitud']) {
echo 'Retornada';
} else if (4==$row['id_estado_solicitud']) {
echo 'Respuesta preliminar';
} else if (5==$row['id_estado_solicitud']) {
echo 'Finalizada';
} else if (6==$row['id_estado_solicitud']) {
echo 'Ampliación / Req.';
} else if (7==$row['id_estado_solicitud']) {
echo 'Respuesta Req.';
} else {}
echo '</td>';


echo '<td>';
if (1==$row['pqrs_direccionada']) {
	echo 'Si';
} else { echo 'No'; }
 echo '</td>';
 
 
 
 echo '<td>';
if (1==$row['id_canal_pqrs']) {
	echo 'Web';
} else if (2==$row['id_canal_pqrs']) {
echo 'Presencial en OAC';
} else if (3==$row['id_canal_pqrs']) {
echo 'Ventanilla';
} else if (4==$row['id_canal_pqrs']) {
echo 'Correo electrónico';
} else if (5==$row['id_canal_pqrs']) {
echo 'Teléfono';
} else if (6==$row['id_canal_pqrs']) {
echo 'Correspondencia Fisica';
} else if (7==$row['id_canal_pqrs']) {
echo 'Chat';
} else if (8==$row['id_canal_pqrs']) {
echo 'Cartelera virtual en Portal';
} else {}
echo '</td>';




 
 
 echo '<td>';
if (isset($row['radicado_respuesta'])) {
	echo $row['radicado_respuesta'];
} else { echo 'No'; }
 echo '</td>';
 
 
echo '<td><a href="solicitud_pqrs&'.$row['id_solicitud_pqrs'].'.jsp">';
echo '<span class="label label-warning"><i class="glyphicon glyphicon-search"></i> Acceder</span></a></td>';
} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);



?>	
</tbody></table>
<?php
} else {	
echo '<div class="box-header with-border">0 registros</div>';
}	
?>
	<script>
				$(document).ready(function() {
					$('#pqrssnr').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50], [50] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 1, "asc"]]
					});
				});
				
										
			
		
				
			</script>					
					</div>
					

 <?php	



	
		




///PERSONAL
		
			
				} else {
				
				
				
function cantuser($solici) {
global $mysqli;
$query4 = sprintf("SELECT funcionario.id_funcionario, id_cargo, lider_pqrs FROM asignacion_pqrs_funcionario, funcionario, solicitud_pqrs 
WHERE asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario and
 asignacion_pqrs_funcionario.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs 
AND solicitud_pqrs.id_solicitud_pqrs=".$solici." AND estado_asignacion_pqrs_funcionario=1 AND estado_solicitud_pqrs=1"); 
$result4 = $mysqli->query($query4);
$cuenta=array();
$funcionarios=array();
while ($obj = $result4->fetch_array()) {
	array_push($cuenta, $obj['id_funcionario']);
	if (1<$obj['id_cargo'] && 0==$obj['lider_pqrs']) {
	array_push($funcionarios, $obj['id_funcionario']);
	} else {
		
	}
}
$todos=count($cuenta);
$todosfuncionarios=count($funcionarios);
$res=$todos.'</td><td>'.$todosfuncionarios;
return $res;
$result4->free();
}
			









			
				
				if (isset($_GET['i']) && ""!=$_GET['i']) {
					$userpqt=$_GET['i'];
					$userpq=" and asignacion_pqrs_funcionario.id_funcionario=".$userpqt."  ";
				} else {
					$userpqt=$_SESSION['snr'];
					$userpq=" and asignacion_pqrs_funcionario.id_funcionario=".$userpqt."  AND solicitud_pqrs.id_estado_solicitud!=5  ";
					}
				
				$query = sprintf("SELECT solicitud_pqrs.id_solicitud_pqrs, radicado, radicado_respuesta, id_estado_solicitud, fecha_radicado, terminos_dias, 
terminos_ampliados, fecha_inicio_ampliacion, dias_ampliacion
 FROM solicitud_pqrs, asignacion_pqrs_funcionario, clasificacion_pqrs, clase_oac 
WHERE  solicitud_pqrs.id_solicitud_pqrs=asignacion_pqrs_funcionario.id_solicitud_pqrs 
and clasificacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs
AND clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac
and estado_asignacion_pqrs_funcionario=1 
 ".$userpq."   
 and estado_solicitud_pqrs=1 AND estado_asignacion_pqrs_funcionario=1  
 AND estado_clasificacion_pqrs=1   AND estado_clase_oac=1
 order by solicitud_pqrs.id_solicitud_pqrs desc");
 
				
				

$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);

?>

<div class="box-header with-border">

<div class="col-md-4">
</div>
<div class="col-md-8">
<form action="" method="post" name="rtret">
<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected>- - - Buscar por:  - - - - </option>
 		  <option value="radicado">Radicado entrada</option>
		   <option value="radicado_respuesta">Radicado de respuesta</option>
		    <!-- <option value="identificacion">Identificación Ciudadano</option>-->
		  </select>
</div>
<div class="input-group-btn"><input type="text" style="width:250px;" name="buscar" placeholder="Buscar" class="form-control" required ></div>
 
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
</div>
</form>
</div>


<?php

if (0<$totalRows) {
	
$realdate= date("Y-m-d");
$menosundia = date('Y-m-d', strtotime('+1 day', strtotime($realdate)));
$menosdosdia = date('Y-m-d', strtotime('+2 day', strtotime($realdate)));

$ampli = array();
$arrayven = array();
$array1nn = array();
	
	
?>


<?php if (1==$_SESSION['rol']) { } else { ?>
<style>
    .dataTables_filter {
          display: none;
        }
	
      </style>
<?php } ?>
<table class="table table-striped table-bordered table-hover" id="pqrssnr">
<thead>
<tr align='center' valign='middle'>
<th>Radicado</th>
<th>Fecha de solicitud</th>
<th>Estado</th>
<th>Terminos iniciales</th>
<th>Ampliación</th>
<th>Fecha vencimiento</th>
<th>Alerta</th>
<th>Respuesta</th>
<th># Personas</th>
<th># F. Internos</th>
<th></th>
</tr>
</thead><tbody>
<?php


do {
	
$solip=$row['id_solicitud_pqrs'];
echo '<tr>';
echo '<td>'.$row['radicado'].'</td>';
echo '<td>'.$row['fecha_radicado'].'</td>';
echo '<td>';
if (1==$row['id_estado_solicitud']) {
	echo 'Radicación';
} else if (2==$row['id_estado_solicitud']) {
echo 'En tramite';
} else if (3==$row['id_estado_solicitud']) {
echo 'Retornada';
} else if (4==$row['id_estado_solicitud']) {
echo 'Respuesta preliminar';
} else if (5==$row['id_estado_solicitud']) {
echo 'Finalizada';
} else if (6==$row['id_estado_solicitud']) {
echo 'Ampliación / Req.';
} else if (7==$row['id_estado_solicitud']) {
echo 'Respuesta Req.';
} else {}
echo '</td>';

echo '<td>'.$row['terminos_dias'].'</td>';
echo '<td>';

if (isset($row['dias_ampliacion'])) {
array_push($ampli, 1);
	echo $row['dias_ampliacion'];
} else {}
echo '</td>';

echo '<td>';

	if (isset($row['dias_ampliacion']) && isset($row['fecha_inicio_ampliacion'])) {
$fechavence=fechahabil($row['fecha_inicio_ampliacion'],$row['dias_ampliacion']);	
	} else {
		
		
$fecha_rad = strtotime($row['fecha_radicado']);
$fecha_entrada = strtotime('2022-05-18');

if($fecha_rad >= $fecha_entrada) {
$fechavence=fechahabil($row['fecha_radicado'],$row['terminos_dias']);
} else {
$fechavence=fechahabil($row['fecha_radicado'],$row['terminos_ampliados']);
}

		

	}

echo $fechavence;

echo '</td>';

echo '<td>';

if ($realdate>$fechavence) {
	array_push($arrayven, 1);
		
} else {
	
	
if ($realdate==$fechavence) {

echo 'Hoy vence PQRS';

	array_push($array1nn, 1);
} else {
	

if ($menosundia==$fechavence) {

echo 'Mañana vence PQRS';

//array_push($array1nn, 1);
	} 
	
else {
	
	if ($menosdosdia==$fechavence) {

echo 'En dos dias vence PQRS';

//array_push($array1nn, 1);


	} else {
	
echo '';	
}
		
}
	
}

}

echo '</td>';


echo '<td>';
if (isset($row['radicado_respuesta'])) {
	echo $row['radicado_respuesta'];
} else { echo 'No'; }
 echo '</td>';
 
 echo '<td>';
 
 	if (isset($_GET['i']) && ""!=$_GET['i']) {
		echo 'N</td><td>N';
			} else {
				 echo cantuser($solip);
		}
				
echo '</td>';

echo '<td>';
if (5==$row['id_estado_solicitud']) {
	echo '<a href="solicitud_pqrs&'.$solip.'.jsp"><span class="label label-success"><i class="glyphicon glyphicon-search"></i> Finalizada</span></a>';
} else {
echo '<a href="solicitud_pqrs&'.$solip.'.jsp"><span class="label label-warning"><i class="glyphicon glyphicon-search"></i> Acceder</span></a>';
}
echo '</td>';

echo '</tr>';
} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);

$ampliacion=array_sum($ampli);
$hoyv=array_sum($array1nn);
$vencidas=array_sum($arrayven); 

?>	
</tbody></table>




	<script>
				$(document).ready(function() {
					$('#pqrssnr').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50], [50] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>					
					
		<script>
var tramitet=<?php echo $totalRows; ?>;
document.getElementById("todas").innerHTML=tramitet;
</script>
<script>
var tramitea=<?php echo $ampliacion; ?>;
document.getElementById("ampli").innerHTML=tramitea;
</script>
<script>
var tramitehoy=<?php echo $hoyv; ?>;
document.getElementById("hoy").innerHTML=tramitehoy;
</script>
<script>
var tramitev=<?php echo $vencidas; ?>;
document.getElementById("vencidas").innerHTML=tramitev;

</script>			

 <?php	



} else {	
echo '<div class="box-header with-border">0 registros</div>';
}

echo '</div>';


} 



 } ?>
        
          </div>
        </div>

</div>




<?php

	if (24==$_SESSION['snr_grupo_area'] or 0<$nump146) {
		?>



	<div class="modal fade" id="controlpqrs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Control de PQRS</h4>
      </div>
      <div class="modal-body">
	  
	  			
<?php
$arraye1 = array();
$arraye2 = array();
$arraye3 = array();
$arraye4 = array();
$arraye5 = array();	
$arraye6 = array();	
$arraye7 = array();	

$selecte = mysql_query("select id_estado_solicitud from solicitud_pqrs where estado_solicitud_pqrs=1", $conexion) or die(mysql_error());
$rowe = mysql_fetch_assoc($selecte);
$totalRowse = mysql_num_rows($selecte);
if (0<$totalRowse){
do {
	
	
if (1==$rowe['id_estado_solicitud']) {
array_push($arraye1, 1);
} else { array_push($arraye1, 0); }

if (2==$rowe['id_estado_solicitud']) {
array_push($arraye2, 1);
} else { array_push($arraye2, 0); }


if (3==$rowe['id_estado_solicitud']) {
array_push($arraye3, 1);
} else { array_push($arraye3, 0); }

if (4==$rowe['id_estado_solicitud']) {
array_push($arraye4, 1);
} else { array_push($arraye4, 0); }

if (5==$rowe['id_estado_solicitud']) {
array_push($arraye5, 1);
} else { array_push($arraye5, 0); }


if (6==$rowe['id_estado_solicitud']) {
array_push($arraye6, 1);
} else { array_push($arraye6, 0); }


if (7==$rowe['id_estado_solicitud']) {
array_push($arraye7, 1);
} else { array_push($arraye7, 0); }



 } while ($rowe = mysql_fetch_assoc($selecte)); 
} else { } 
mysql_free_result($selecte);


$rangoe=100/$totalRowse;


$tramitee1=intval(array_sum($arraye1));
echo 'Proceso de radicación: '.$tramitee1.'';
$infoe1=$rangoe*$tramitee1;
?>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($infoe1); ?>%">
     <?php echo round($infoe1,1); ?>%
  </div> 
</div>
<hr>
<?php
//if (0<$nump146 or 1==$_SESSION['rol']) {
$actualizar5 = mysql_query("SELECT id_solicitud_pqrs, radicado, fecha_radicado, nombre_canal_pqrs FROM solicitud_pqrs, canal_pqrs where solicitud_pqrs.id_canal_pqrs=canal_pqrs.id_canal_pqrs and id_estado_solicitud=1 and estado_solicitud_pqrs=1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
echo '<ul>';
 do {
echo '<li>';

echo '<a href="https://sisg.supernotariado.gov.co/anexos_pqrs&'.$row15['id_solicitud_pqrs'].'.jsp">'.$row15['radicado'].'</a>  ';

echo ' <span style="color:#777;">(Fecha: '.$row15['fecha_radicado'].')<span> <i>'.$row15['nombre_canal_pqrs'].'</i></li>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
echo '</ul><hr>';
} else {}
mysql_free_result($actualizar5); 
//} else {}
?>




<?php
$tramitee2=intval(array_sum($arraye2));
echo 'Gestíon: '.$tramitee2.'<br>';
$infoe2=$rangoe*$tramitee2;
?>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($infoe2); ?>%">
     <?php echo round($infoe2,1); ?>%
  </div>
</div>
<?php
$tramitee3=intval(array_sum($arraye3));
echo 'Retorno: '.$tramitee3.'<br>';
$infoe3=$rangoe*$tramitee3;
?>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($infoe3); ?>%">
     <?php echo round($infoe3,1); ?>%
  </div>
</div>
<?php
$tramitee4=intval(array_sum($arraye4));
echo 'Respuesta preliminar: '.$tramitee4.'<br>';
$infoe4=$rangoe*$tramitee4;
?>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($infoe4); ?>%">
     <?php echo round($infoe4,1); ?>%
  </div>
</div>
<?php
$tramitee5=intval(array_sum($arraye5));
echo 'Finalizado: '.$tramitee5.'<br>';
$infoe5=$rangoe*$tramitee5;
?>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($infoe5); ?>%">
     <?php echo round($infoe5,1); ?>%
  </div>
</div>



<?php
$tramitee6=intval(array_sum($arraye6));
echo 'Requerimiento en curso: '.$tramitee6.'<br>';
$infoe6=$rangoe*$tramitee6;
?>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($infoe6); ?>%">
     <?php echo round($infoe6,1); ?>%
  </div>
</div>
<?php
$tramitee7=intval(array_sum($arraye7));
echo 'Con respuesta del requerimiento: '.$tramitee7.'<br>';
$infoe7=$rangoe*$tramitee7;
?>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($infoe7); ?>%">
     <?php echo round($infoe7,1); ?>%
  </div>
</div>
	 
	  </div> 
</div> 
</div> 
</div> 

	
	
	
<div class="modal fade" id="popupclasificadas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">PQRS sin clasificar:</h4>
</div> 
<div id="nuevaAventura" class="modal-body">
<?php

$actualizar579km = mysql_query("select radicado, id_solicitud_pqrs, fecha_radicado
from solicitud_pqrs where not id_solicitud_pqrs in
(select id_solicitud_pqrs from clasificacion_pqrs where estado_clasificacion_pqrs=1) and estado_solicitud_pqrs=1 order by fecha_radicado desc", $conexion);
$row1579km = mysql_fetch_assoc($actualizar579km);
$totalRowskm = mysql_num_rows($actualizar579km);
echo $totalRowskm.' PQRSD sin clasificar:<br>';
if (0<$totalRowskm){
echo '<br><ol>';
 do { 
echo '<li><a href="solicitud_pqrs&'.$row1579km['id_solicitud_pqrs'].'.jsp" target=_blank">'.$row1579km['radicado'].'</a> <span style="color:#999;">('.$row1579km['fecha_radicado'].')</span>';
echo '</li>';


 } while ($row1579km = mysql_fetch_assoc($actualizar579km)); 
  mysql_free_result($actualizar579km);
  echo '</ol>';
}
?>


</div>
</div> 
</div> 
</div> 




<div class="modal fade" id="popupdireccionadas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">PQRS sin direccionar:</h4>
</div> 
<div id="nuevaAventura" class="modal-body">
<?php

$actualizar579km = mysql_query("select radicado, id_solicitud_pqrs, fecha_radicado
from solicitud_pqrs where not id_solicitud_pqrs in
(select id_solicitud_pqrs from asignacion_pqrs where estado_asignacion_pqrs=1) and estado_solicitud_pqrs=1 
order by fecha_radicado desc", $conexion);
$row1579km = mysql_fetch_assoc($actualizar579km);
$totalRowskm = mysql_num_rows($actualizar579km);
echo $totalRowskm.' PQRSD sin direccionar:<br>';
if (0<$totalRowskm){
echo '<br><ol>';
 do { 
echo '<li><a href="solicitud_pqrs&'.$row1579km['id_solicitud_pqrs'].'.jsp" target=_blank">'.$row1579km['radicado'].'</a> <span style="color:#999;">('.$row1579km['fecha_radicado'].')</span>';
echo '</li>';


 } while ($row1579km = mysql_fetch_assoc($actualizar579km)); 
  mysql_free_result($actualizar579km);
  echo '</ol>';
}
?>


</div>
</div> 
</div> 
</div> 


	
	
	
	
	<div class="modal fade" id="popupretornadas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">PQRS Retornadas:</h4>
</div> 
<div id="nuevaAventura" class="modal-body">
<br>
<?php

$actualizar579k = mysql_query("SELECT id_solicitud_pqrs, radicado FROM solicitud_pqrs where id_estado_solicitud=3 and estado_solicitud_pqrs=1", $conexion) or die(mysql_error());
$row1579k = mysql_fetch_assoc($actualizar579k);
$totalRowsk = mysql_num_rows($actualizar579k);
echo $totalRowsk.' PQRSD retornadas a la oficina de atención al ciudadano.';
if (0<$totalRowsk){
echo '<br><ol>';
 do { 
echo '<li><a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$row1579k['id_solicitud_pqrs'].'.jsp" target=_blank">'.$row1579k['radicado'].'</a>';
echo '</li>';


 } while ($row1579k = mysql_fetch_assoc($actualizar579k)); 
  mysql_free_result($actualizar579k);
  echo '</ol>';
}
?>


</div>
</div> 
</div> 
</div> 

	<?php } else {} ?>
