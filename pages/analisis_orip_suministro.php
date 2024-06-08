<?php

$nump53=privilegios(53,$_SESSION['snr']);

	 if (1==$_SESSION['rol'] or 0<$nump53) { ?>


<script>
function toggleCheckbox(element)
 {
	var url=document.getElementById("url").value;
location.href = "https://sisg.supernotariado.gov.co/analisis_orip_suministro&"+url+".jsp";
 }
 
</script>

<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
              <h3><?php  echo existencia('suministro_orip');?></h3>
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
$queryn = sprintf("select count(oficina_registro.id_oficina_registro) as tot from suministro_orip, oficina_registro WHERE oficina_registro.id_oficina_registro=suministro_orip.id_oficina_registro 
and id_suministro_orip IN (SELECT max(id_suministro_orip) AS max_reac
FROM suministro_orip WHERE estado_suministro_orip=1
GROUP BY id_oficina_registro)");

$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
$unicas=$rown['tot'];
echo $unicas;
mysql_free_result($selectn);
			  ?>
			  </h3>

              <p>Encuestas unicas</p>
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
$queryn = sprintf("SELECT count(id_suministro_orip) as tot from suministro_orip where fecha_suministro>='$realdate' and estado_suministro_orip=1 ");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
echo $rown['tot'];
mysql_free_result($selectn);
			  ?></h3>

              <p>Cantidad de encuestas hoy</p>
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
				<h3>Suministros en Oficinas de Registro</h3> 	
				
<div class="row">
<div class="col-md-12" >

<div class="box box-solid">
            <div class="box-header with-border">

            </div>
            <div class="box-body">

            <div class="col-md-7" >
<?php
global $mysqli;
$mysqli = new mysqli($hostname_conexion2, $username_conexion2, $password_conexion2, $database_conexion2);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}

function suma($preg) {
global $mysqli;
$query4 = sprintf("SELECT SUM(".$preg.") as rest from suministro_orip, oficina_registro WHERE oficina_registro.id_oficina_registro=suministro_orip.id_oficina_registro 
and id_suministro_orip IN (SELECT max(id_suministro_orip) AS max_reac
FROM suministro_orip WHERE estado_suministro_orip=1
GROUP BY id_oficina_registro)"); 
$result4 = $mysqli->query($query4);
$obj = $result4->fetch_array(MYSQLI_ASSOC);
printf ("%s", $obj['rest']);
//return $res;
$result4->free();
}



function nencuestas($ofi) {
global $mysqli;
$query4 = sprintf("SELECT count(id_suministro_orip) as tote from suministro_orip WHERE id_oficina_registro=".$ofi." and estado_suministro_orip=1"); 
$result4 = $mysqli->query($query4);
$obj = $result4->fetch_array(MYSQLI_ASSOC);
printf ("%s", $obj['tote']);
//return $res;
$result4->free();
}



$queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=4 and estado_encuesta_orip=1 and tipo_pregunta=1");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
      echo '<b>Sumatoria total de elementos</b><br><br>';    
 do {
echo ''.$rown['nombre_encuesta_orip'].': ';
echo '<b>';
$pre='p'.$rown['id_encuesta_orip'];
echo suma($pre);
echo '</b><br>';
} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);



if (isset($_GET['i']))
{
	$id=intval($_GET['i']);
} else {
	$id=38;
}

echo '<br><select name="reg" id="url" onchange="toggleCheckbox()">';
echo '<option value="38">Café</option>';
$queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=4 and id_encuesta_orip>38 and id_encuesta_orip<53 and estado_encuesta_orip=1");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn); 
      do {
echo '<option value="'.$rown['id_encuesta_orip'].'"';
if ($id==$rown['id_encuesta_orip']) {
	echo 'selected';
} else {}

echo '>'.$rown['nombre_encuesta_orip'].'</option>';
} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);
echo '</select><br>';

$valp='p'.$id;
$queryne = sprintf("select ".$valp." from suministro_orip, oficina_registro WHERE oficina_registro.id_oficina_registro=suministro_orip.id_oficina_registro 
and id_suministro_orip IN (SELECT max(id_suministro_orip) AS max_reac
FROM suministro_orip WHERE estado_suministro_orip=1
GROUP BY id_oficina_registro)");

$selectne = mysql_query($queryne, $conexion);
$rowne = mysql_fetch_assoc($selectne);


$Suficientes=0;
	$Escasa=0;
	$No_hay=0;
	
      do {
		  if ('Suficientes'==$rowne[$valp]) {
			$Suficientes=$Suficientes+1;  
		  } else if ('Escasa'==$rowne[$valp]) {
		  $Escasa=$Escasa+1;
		   } else if ('No hay'==$rowne[$valp]) {
		$No_hay=$No_hay+1;
		  } else { }
} while ($rowne = mysql_fetch_assoc($selectne));

mysql_free_result($selectne);


	$su=round((($Suficientes*100)/$unicas), 2);
	$es=round((($Escasa*100)/$unicas), 2);
	$nh=round((($No_hay*100)/$unicas), 2);
	

	
	echo '<br>Suficientes: '.$Suficientes.' ';?>
	<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($su); ?>%">
     <?php echo round($su,1); ?>%
  </div>
</div>
<?php echo 'Escaso: '.$Escasa.' ';?>
	<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($es); ?>%">
     <?php echo round($es,1); ?>%
  </div>
</div>
<?php	echo 'No hay: '.$No_hay.'';?>
	<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($nh); ?>%">
     <?php echo round($nh,1); ?>%
  </div>
</div>

			  
			  
</div>
<div class="col-md-5" >
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
			
$finalizadas=$unicas;
			
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
			  <th># encuestas</th>
			  <!--
 <th>Capacitación en Bioseguridad</th>
        <th>Acceso al correo electrónico</th>
              <th>Acceso a Sir ó Folio</th>
			   <th>Fumigación últimos 6 meses</th>-->

<?php

$queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=4 and estado_encuesta_orip=1");
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
$queryn = sprintf("select * from suministro_orip, oficina_registro, region, departamento WHERE
oficina_registro.id_region=region.id_region AND oficina_registro.id_departamento=departamento.id_departamento 
and oficina_registro.id_oficina_registro=suministro_orip.id_oficina_registro and id_suministro_orip IN (SELECT max(id_suministro_orip) AS max_reac
FROM suministro_orip WHERE estado_suministro_orip=1
GROUP BY id_oficina_registro) ORDER BY oficina_registro.id_oficina_registro");

$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
      do {
  echo '<tr><td>'.$rown['fecha_suministro'].'</td><td>'.$rown['nombre_region'].'</td><td>'.$rown['nombre_departamento'].'</td>';
echo '<td>'.$rown['nombre_oficina_registro'].'</td>';

echo '<td>';
echo nencuestas($rown['id_oficina_registro']);
echo '</td>';
echo '<td>'.$rown['p33'].'</td>';
echo '<td>'.$rown['p34'].'</td>';
echo '<td>'.$rown['p35'].'</td>';
echo '<td>'.$rown['p36'].'</td>';
echo '<td>'.$rown['p37'].'</td>';
echo '<td>'.$rown['p38'].'</td>';
echo '<td>'.$rown['p39'].'</td>';
echo '<td>'.$rown['p40'].'</td>';
echo '<td>'.$rown['p41'].'</td>';
echo '<td>'.$rown['p42'].'</td>';
echo '<td>'.$rown['p43'].'</td>';
echo '<td>'.$rown['p44'].'</td>';
echo '<td>'.$rown['p45'].'</td>';
echo '<td>'.$rown['p46'].'</td>';
echo '<td>'.$rown['p47'].'</td>';
echo '<td>'.$rown['p48'].'</td>';
echo '<td>'.$rown['p49'].'</td>';
echo '<td>'.$rown['p50'].'</td>';
echo '<td>'.$rown['p51'].'</td>';
echo '<td>'.$rown['p52'].'</td>';
echo '<td>'.$rown['p53'].'</td>';


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

