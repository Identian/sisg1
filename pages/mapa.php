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
        <div class="col-md-3">
		
		<a href="tipificacion_pqrs.jsp">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-save"></i></span>

            <div class="info-box-content">
              <span>Tipificación PQRS</span>
			  <span class="info-box-number"><?php echo existencia('clase_oac'); ?> clases</span>
              
			 
            </div>
         
          </div>
    </a>
        </div>

       
    
       
   
  <div class="col-md-3">
		<a href="pqrs_area.jsp">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-floppy-disk"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PQRS por areas N.C.</span>
			  
			  <span class="info-box-number"><?php 
			  
$reghtpo = mysql_query("SELECT id_solicitud_pqrs FROM asignacion_pqrs where id_tipo_oficina=1 and estado_asignacion_pqrs=1 ", $conexion) or die(mysql_error());
//$rowcco = mysql_fetch_assoc($reghtpo);
$totuu = mysql_num_rows($reghtpo );
echo $totuu;	
			  
			 ?></span>
			  
              
            </div>
          
          </div>
      </a>
        </div>
    
        <div class="col-md-3">
		<a href="mapa_calor.jsp">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-inbox"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PQRS por ORIP y Región</span>
	
			 <span class="info-box-number"> <?php 
			 
			 $reghtpoH = mysql_query("SELECT id_solicitud_pqrs FROM asignacion_pqrs where id_tipo_oficina=2 and estado_asignacion_pqrs=1 ", $conexion) or die(mysql_error());
//$rowcco = mysql_fetch_assoc($reghtpo);
$totuuH = mysql_num_rows($reghtpoH );
echo $totuuH;

			 ?></span>
              
            </div>
        
          </div>
     </a>
        </div>
		
   
        <div class="col-md-3">
		<a href="xls/pqrs_retornadas.xls">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-hdd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PQRS retornadas</span>
			  <span class="info-box-number"><?php echo existencia('retorno_pqrs');?></span>
              <span class="info-box-number"><img src="images/excel.png"></span>
            </div>
        
          </div>
   </a>
        </div>
 
		
		
       
		
      </div>
	  
	
	

<div class="row">
<div class="col-md-9">     



  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
			  

			  
			  
                <h3>Analisis PQRS por Geo-referencia</h3>
     

<div style="text-align:right"><a href="xls/pqrs_orip.xls"><img src="images/excel.png"></a></div>
<br>
	 
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
<h3>PQRS por Regional</h3>
<?php 

$totalr=existenciaunica('asignacion_pqrs', 'id_tipo_oficina', 2);


$query="select * from region where estado_region=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){	
do { ?>
<?php

$infop=$row['id_region'];
$queryb="select count(id_asignacion_pqrs) as totalp from oficina_registro, asignacion_pqrs where oficina_registro.id_oficina_registro=asignacion_pqrs.codigo_oficina and asignacion_pqrs.id_tipo_oficina=2 and oficina_registro.id_region=".$infop." ";
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

<hr>
<a href="mapa_calor.jsp">MAPA DE CALOR - NIVEL NACIONAL</a>
<br>

</div>
</div>
</div>	




<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Estados de PQRS</h3>
<?php 

$query="select * from estado_solicitud where id_estado_solicitud!=3 and id_estado_solicitud!=1 and estado_estado_solicitud=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
echo '<a href="mapa.jsp">Solo ORIP</a><br>';
do {
echo '<a href="mapa&0&'.$row['id_estado_solicitud'].'.jsp">'.$row['nombre_estado_solicitud'].'</a> ';
if ($ed==$row['id_estado_solicitud']) { echo '<span class="glyphicon glyphicon-pushpin" style="color:#888;"></span>';
$color=$row['color'];
 } else {}
echo '<br>';
} while ($row = mysql_fetch_assoc($select)); 
echo '<a href="mapa&0&6.jsp">Vencidas</a> ';
if ($ed==6) { echo '<span class="glyphicon glyphicon-pushpin" style="color:#888;"></span>';
$color='#f03';
 } else {}
echo '<br>';
} else {}	 

mysql_free_result($select);


//echo pqrsvencidas(2, 11);

?>
</div>
</div>
</div>





				
   <!--
  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Regiones</h3>
<?php 
/*
$query="select * from region where estado_region=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
echo '<a href="">'.$row['nombre_region'].'</a><br>';
} while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);


//echo pqrsvencidas(2, 11);
*/
?>
</div>
</div>
</div>-->
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
	if (0!=$ed) {
		
$query="select * from oficina_registro where latitud is not null and estado_oficina_registro=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	
do { ?>
	L.circle([<?php echo $row['latitud']; ?>, <?php echo $row['longitud']; ?>], {
		color: '<?php echo $color; ?>',  //borde
		fillColor: '<?php echo $color; ?>',
		fillOpacity: 0.5,
		radius: <?php 
		if(6==$ed){
		$inf=pqrsvencidas(2, $row['id_oficina_registro']); $inf1=25*$inf; echo $inf1;
		} else {
		$inf=estadopqrs(2, $row['id_oficina_registro'], $ed); $inf1=25*$inf; echo $inf1;	
		}
		?>
	}).addTo(mymap).bindPopup("<?php echo $row['nombre_oficina_registro'].': '.$inf; ?> PQRS.");
	

<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);


	} else{
		
		
$query="select * from oficina_registro where latitud is not null and estado_oficina_registro=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	
do { ?>


	L.marker([<?php echo $row['latitud']; ?>, <?php echo $row['longitud']; ?>]).addTo(mymap)
   .bindPopup('<?php echo $row['nombre_oficina_registro'].' - '.$row['direccion_oficina_registro']; ?>');
   
   

<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
		
		
		
		
	}
?>

</script>


