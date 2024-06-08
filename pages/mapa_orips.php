<!--
https://leafletjs.com/examples/quick-start/
-->

<?php
if (isset($_GET['i'])) {
	$id=intval($_GET['i']);
} else {$id=0; }

if (isset($_GET['e'])) {
	$ed=intval($_GET['e']);
} else {$ed=0; }
	?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>


	
	
<div class="row">

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
<a href="orips.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-aqua">
<div class="inner">
<h3>155</h3>
<p>En SIR</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="orips.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-green">
<div class="inner">
<h3>40</h3>
<p>En Folio</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a href="orips.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>



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
<a href="orips.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
</div>



	 





 <div class="row">
  <div class="col-md-12">
  <div class="info-box">
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="pqrs_orip.jsp" >
                <span class="badge bg-green" ><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> PQRSD
              </a>
</div>

<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="analisis_orip_personal.jsp">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> PERSONAL
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="reactivacion_orip.jsp">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> REACTIVACIÓN
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="analisis_orip_suministro.jsp" >
                <span class="badge bg-green" ><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> SUMINISTROS
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="no_conformidad_estadistica.jsp">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> NO CONFORMIDAD
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="ambiental_estadistica.jsp">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> AMBIENTAL
              </a>
</div>
			  </div>
			   </div>
			  </div>



			  
	
	

<div class="row">
<div class="col-md-9">     
  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
			  

			  
			  
                <h3>Oficinas de registro</h3>
     

	 
<div id="mapid" style="width: 100%; min-height: 540px;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
</div>


  </div>
            </div>
          </div>

</div>
<div class="col-md-3"> 

<div class="box ">
<div class="box-body">
<div class="table-responsive">
<h3>Direcciones regionales</h3>
<?php 

$totalr=existenciaunica('oficina_registro', 'estado_oficina_registro', 1);


$query="select * from region where estado_region=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){	
do { ?>
<?php

$infop=$row['id_region'];
$queryb="select count(id_oficina_registro) as totalp from oficina_registro where id_region=".$infop." and estado_oficina_registro=1";
$selectb = mysql_query($queryb, $conexion) or die(mysql_error());
$rowb = mysql_fetch_assoc($selectb);
$infotob= $rowb['totalp'];

 echo $row['nombre_region']; 

 echo ': '.$infotob; 
 
 $info3=($infotob*100)/$totalr;
 
 ?>
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: <?php echo round($info3, 2); ?>%">
<?php echo round($info3, 2); ?>%
</div>
</div>
<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
?>

</div>
</div>
</div>	



<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Tableros de control</h3>
<br>

<a href="pqrs_orip.jsp" class="btn btn-xs btn-warning btn-block">PQRSD</a>
<a href="mapa_calor.jsp" class="btn btn-xs btn-warning btn-block">Mapa de calor de PQRS</a>
<a href="reactivacion_orip.jsp" class="btn btn-xs btn-warning btn-block">Reactivación</a>
<a href="reactivacion_analisis.jsp" class="btn btn-xs btn-warning btn-block">Bioseguridad</a>

</div>
</div>
</div>



</div>
</div>


<script>

	var mymap = L.map('mapid').setView([4.629, -74.092], 6);  // toda colombia 6

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		
		//https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw
		
		
		maxZoom: 18,
		attribution: 'OpenStreetMap' +
			'' +
			'',
		id: 'open.streets'
	}).addTo(mymap);

	

	
	
	<?php 
		
$query="select * from oficina_registro where latitud is not null and estado_oficina_registro=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	
do { ?>


	L.marker([<?php echo $row['latitud']; ?>, <?php echo $row['longitud']; ?>]).addTo(mymap)
   .bindPopup('<?php echo $row['nombre_oficina_registro'].'  <a href="orip&'.$row['id_oficina_registro'].'.jsp" target="black"> + Info</a> '; ?>');
   
   

<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
		
		
		
		

?>

</script>


