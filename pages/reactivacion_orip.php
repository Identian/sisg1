<?php
/*
$nump52=privilegios(52,$_SESSION['snr']);
if (0<$nump52 or 1==$_SESSION['rol']) {
	*/
?>


<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
              <h3><?php  echo existencia('reactivacion_orip');?></h3>
              <p>Total de registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="xls/reactivacion_orip.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
		  </div>
		  
		  
		  
		  
		      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php 
$queryn = "SELECT count(DISTINCT(id_oficina_registro)) as tot from reactivacion_orip WHERE  estado_reactivacion_orip=1  ";
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
echo $rown['tot'];
mysql_free_result($selectn);
			  ?></h3>

              <p>ORIP con registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="xls/reactivacion_orip_filtro.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		  

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php

$queryn = sprintf("select count(id_reactivacion_orip) as tot from oficina_registro, reactivacion_orip WHERE oficina_registro.id_oficina_registro=reactivacion_orip.id_oficina_registro and id_reactivacion_orip IN (SELECT max(id_reactivacion_orip) AS max_reac 
FROM reactivacion_orip
WHERE estado_reactivacion_orip=1
GROUP BY id_oficina_registro) and personal='Si' and insumos='Si' and otros='Si'");

$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
echo $rown['tot'];
mysql_free_result($selectn);
			  ?>
			  </h3>

              <p>Orips que cumplen</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		


       
		 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>195</h3>

              <p>Orips</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="orips.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		

      </div>
	  


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Apertura de Oficinas de Registro</h3> 	
	<?php          
$queryn = sprintf("SELECT * from reactivacion_orip, oficina_registro, region, departamento where oficina_registro.id_region=region.id_region and oficina_registro.id_departamento=departamento.id_departamento and reactivacion_orip.id_oficina_registro=oficina_registro.id_oficina_registro and estado_reactivacion_orip=1 order by fecha_reactivacion_orip DESC");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
?>
            <a href="xls/reactivacion_orip.xls"><img src="images/excel.png"> Descargar reporte completo</a><br>
		<a href="xls/reactivacion_orip_filtro.xls"><img src="images/excel.png"> Descargar reporte consolidado - último registro por ORIP</a><br>
         

		 <table class="table table-striped table-bordered table-hover" id="detallecontrol">
            <thead>
            <tr>
			<th>Fecha</th>
			<th>Regional</th>
        <th>Departamento</th>
              <th>Orip</th>
              <th>Personal</th>
        <th>Insumos</th>
              <th>Otros</th>
			   <th>Estado</th>
			   <th>Resolución</th>
			   <th>F. apertura</th>
			   <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
      do {
  echo '<tr>
  <td>'.$rown['fecha_reactivacion_orip'].'</td>

  <td>'.$rown['nombre_region'].'</td><td>'.$rown['nombre_departamento'].'</td>';
echo '<td>'.$rown['nombre_oficina_registro'].'</td>';
echo '<td>'.$rown['personal'].'</td>';
echo '<td>'.$rown['insumos'].'</td>';
echo '<td>'.$rown['otros'].'</td>';
echo '<td>';
if ("Si"==$rown['personal'] && "Si"==$rown['insumos'] && "Si"==$rown['otros']) { 
echo 'Lista';
} else { echo 'Pendiente'; }
echo '</td>';
echo '<td>'.$rown['resolucion_r'].'</td>';
echo '<td>'.$rown['fecha_apertura'].'</td>';
echo '<td><a href="orip&'.$rown['id_oficina_registro'].'.jsp" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-search"></span> ver</a></td></tr>';
} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


?>
<script>
                  $(document).ready(function() {
                $('#detallecontrol').DataTable({
					//dom: 'Bfrtip',
              		//buttons: ['excelHtml5','csvHtml5'],
                  "lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                  }
                });
              });
            </script>
 </tbody>
          </table>
		  
		  </div>
		    </div>
			  </div>
			    </div>
<?php //} ?>