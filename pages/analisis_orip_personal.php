<?php

$nump53=privilegios(53,$_SESSION['snr']);

	 if (1==$_SESSION['rol'] or 0<$nump53) { ?>



<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
              <h3><?php  echo existencia('personal_orip');?></h3>
              <p>Total de encuestas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
		  </div>
		  

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
$queryn = sprintf("SELECT sum(p30) as tot from personal_orip where estado_personal_orip=1 ");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
echo $rown['tot'];
mysql_free_result($selectn);
			  ?>
			  </h3>

              <p>Personas requeridas para tareas que No estan atendidas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php 
$queryn = sprintf("SELECT sum(p31) as tot from personal_orip where estado_personal_orip=1 ");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
echo $rown['tot'];
mysql_free_result($selectn);
			  ?></h3>

              <p>Personas para tareas que requiren refuerzo</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
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
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		

      </div>
	  


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Personal de Oficinas de Registro</h3> 	
				
<div class="row">
<div class="col-md-12" >

<div class="box box-solid">
            <div class="box-header with-border">

            </div>
            <div class="box-body">

            <div class="col-md-8" >
<?php
global $mysqli;
$mysqli = new mysqli($hostname_conexion2, $username_conexion2, $password_conexion2, $database_conexion2);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}

function reactivacion_suma($preg) {
global $mysqli;
$query4 = sprintf("SELECT SUM(".$preg.") as rest FROM personal_orip where estado_personal_orip=1"); 
$result4 = $mysqli->query($query4);
$obj = $result4->fetch_array(MYSQLI_ASSOC);
printf ("%s", $obj['rest']);
//return $res;
$result4->free();
}


$queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=3 and estado_encuesta_orip=1 and tipo_pregunta=1");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
      echo '<b>Sumatoria total de elementos</b><br>';    
 do {
echo ''.$rown['id_encuesta_orip'].'. ';
echo ''.$rown['nombre_encuesta_orip'].': ';
echo '<b>';
$pre='p'.$rown['id_encuesta_orip'];
echo reactivacion_suma($pre);
echo '</b><br>';
} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


?>
           
</div>
<div class="col-md-4" >
<div id="chart"></div>


<?php   
//echo '<b>Escritorios remotos:</b> ';
//echo existencialimitada('funcionario', 'remoto', 1);

?>

<script type='text/javascript'>//<![CDATA[
window.onload=function(){
var chart = c3.generate({
    data: {
        columns: [
            ['data1', <?php 
		
			$total=195; echo $total; ?>],
            ['data2', 0],
        ],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "ORIPS: <?php echo $total; ?>"
    }
});

setTimeout(function () {
    chart.load({
        columns: [
            ["Con encuesta:  <?php 
			
$reghtpf = mysql_query("select COUNT(id_oficina_registro) as final from personal_orip where estado_personal_orip=1", $conexion) ;
$rowccf = mysql_fetch_assoc($reghtpf);
$finalizadas=$rowccf['final'];
			
			 echo $finalizadas; ?>", <?php echo $finalizadas; ?>],
            ["Pendientes: <?php $pendientes=$total-$finalizadas; echo $pendientes; ?>", <?php echo $pendientes; ?>],
        ]
    });
}, 1500);

setTimeout(function () {
    chart.unload({
        ids: 'data1'
    });
    chart.unload({
        ids: 'data2'
    });
}, 1500);
}
</script>
 </div>
 </div>
	  
</div>
</div>



		<div class="box-body">		
				
				
				
				
				
				
				
				

        <!--    <a href="xls/reactivacion_orip.xls"><img src="images/excel.png"> Descargar reporte completo</a><br>-->
          <table class="table table-striped table-bordered table-hover" id="detallecontrol">
            <thead>
            <tr>
			<th>Fecha</th>
			<th>Regional</th>
        <th>Departamento</th>
              <th>Orip</th>
			  <!--
 <th>Capacitación en Bioseguridad</th>
        <th>Acceso al correo electrónico</th>
              <th>Acceso a Sir ó Folio</th>
			   <th>Fumigación últimos 6 meses</th>-->

<?php

$queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=3 and estado_encuesta_orip=1");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
     
      do {

echo '<th>'.$rown['nombre_encuesta_orip'].'';
echo '</th>';


} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);

?>
			   <th></th>
            </tr>
            </thead>
            <tbody>

            <?php         
$queryn = sprintf("SELECT * from personal_orip, oficina_registro, region, departamento where  oficina_registro.id_region=region.id_region and oficina_registro.id_departamento=departamento.id_departamento and personal_orip.id_oficina_registro=oficina_registro.id_oficina_registro and estado_personal_orip=1 order by fecha DESC");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
      do {
  echo '<tr><td>'.$rown['fecha'].'</td><td>'.$rown['nombre_region'].'</td><td>'.$rown['nombre_departamento'].'</td>';
echo '<td>'.$rown['nombre_oficina_registro'].'</td>';

echo '<td>'.$rown['p1'].'</td>';
echo '<td>'.$rown['p2'].'</td>';
echo '<td>'.$rown['p3'].'</td>';
echo '<td>'.$rown['p4'].'</td>';
echo '<td>'.$rown['p5'].'</td>';
echo '<td>'.$rown['p6'].'</td>';
echo '<td>'.$rown['p7'].'</td>';
echo '<td>'.$rown['p8'].'</td>';
echo '<td>'.$rown['p9'].'</td>';
echo '<td>'.$rown['p10'].'</td>';
echo '<td>'.$rown['p11'].'</td>';
echo '<td>'.$rown['p12'].'</td>';
echo '<td>'.$rown['p13'].'</td>';
echo '<td>'.$rown['p14'].'</td>';
echo '<td>'.$rown['p15'].'</td>';
echo '<td>'.$rown['p16'].'</td>';
echo '<td>'.$rown['p17'].'</td>';
echo '<td>'.$rown['p18'].'</td>';
echo '<td>'.$rown['p19'].'</td>';
echo '<td>'.$rown['p20'].'</td>';
echo '<td>'.$rown['p21'].'</td>';
echo '<td>'.$rown['p22'].'</td>';
echo '<td>'.$rown['p23'].'</td>';
echo '<td>'.$rown['p24'].'</td>';
echo '<td>'.$rown['p25'].'</td>';
echo '<td>'.$rown['p26'].'</td>';
echo '<td>'.$rown['p27'].'</td>';
echo '<td>'.$rown['p28'].'</td>';
echo '<td>'.$rown['p29'].'</td>';
echo '<td>'.$rown['p30'].'</td>';
echo '<td>'.$rown['p31'].'</td>';
echo '<td>'.$rown['p32'].'</td>';


echo '<td><a href="orip&'.$rown['id_oficina_registro'].'.jsp" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-search"></span> Ver</a></td></tr>';
} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


?>
<script>
						$(document).ready(function() {
						$('#detallecontrol').DataTable({
							"scrollX": true,
							dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5',
									'csvHtml5'
									// 'pdfHtml5'
								],
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
			    </div>
<?php } ?>

