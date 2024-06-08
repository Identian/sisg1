<!--
https://leafletjs.com/examples/quick-start/
-->

<?php
if (isset($_GET['i'])) {
	$id=intval($_GET['i']);
} else {$id=0; }

if (isset($_GET['e'])) {
	$ed=intval($_GET['e']);
} else { $ed=0; }
	?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>


		
	

<div class="row">
<div class="col-md-8">     



  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
			  


     


<div class="row">
<div class="col-md-3">
<H2>Notarias</H2>
</div>
<form action="" method="post" name="re3245345ewf">
<div class="col-md-6"> 
<input type="text" class="form-control" style="width:100%;" name="notaria" placeholder="Buscar Notaria" required >
</div>
<div class="col-md-3"> 
<button type="submit" style="width:100%;" class="btn btn-success">
<span class="glyphicon glyphicon-search"></span> Buscar </button>
</div>
</form>
</div>
<br>
<div id="mapid" style="width: 100%; min-height: 520px;z-index:1;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
</div>

	    <div>

          </div>
		  
  </div>
            </div>
          </div>

</div>

<div class="col-md-4"> 


<div class="info-box bg-blue">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Requerimientos</span>
          <span class="info-box-number"><span id="requeririnotarios"></span></span>
          <!-- The progress section is optional -->
          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            SNR
          </span>
        </div><!-- /.info-box-content -->
      </div>
	  

   <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Licencias y permisos</span>
          <span class="info-box-number"><?php echo existencia('permiso'); ?>
</span>
          <!-- The progress section is optional -->
          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
           SNR
          </span>
        </div><!-- /.info-box-content -->
      </div>
	  
	  
	  
	    
	  
	  
	    <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Sucesiones</span>
          <span class="info-box-number"><?php echo existencia('sucesion'); ?>
</span>
          <!-- The progress section is optional -->
          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
          SNR
          </span>
        </div><!-- /.info-box-content -->
      </div>
	  
	  
	  
	    <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Testamentos
</span>
          <span class="info-box-number"><?php echo existencia('testamento'); ?>
</span>
          <!-- The progress section is optional -->
          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            SNR
          </span>
        </div><!-- /.info-box-content -->
      </div>
	  
	  <!--
	    <div class="info-box bg-purple">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Registros Civiles de Matrimonio</span>
          <span class="info-box-number">443.267
</span>
         
          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
           De 2011 a hasta II trimestre de 2019
          </span>
        </div>
      </div>-->
	  
	  	      <div class="info-box bg-purple">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Apostillas</span>
          <span class="info-box-number"><?php echo existencia('apostilla'); ?>
</span>
          <!-- The progress section is optional -->
          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
          SNR
          </span>
        </div><!-- /.info-box-content -->
      </div>
	  
	  
  
	  
	      <div class="info-box bg-blue-light">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Salidas de menores</span>
          <span class="info-box-number"><?php echo existencia('salida_menor'); ?>
</span>
          <!-- The progress section is optional -->
          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
         SNR
          </span>
        </div><!-- /.info-box-content -->
      </div>
	  
	  
	  





</div>

</div>



<div class="row"> 

<div class="col-md-3"> 

<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Licencias y permisos</h3>
				
<?php
			
$array0 = array();
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();



$query_reghtp = "SELECT * FROM tipo_encargo where estado_tipo_encargo=1 ";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
    
	$array0 = array();
	
 echo '<b>'.$row_reghtp['nombre_tipo_encargo'].':</b> ';
 $ttt=intval($row_reghtp['id_tipo_encargo']);
 

$select = mysql_query("select id_tipo_encargo from dia_licencia where estado_dia_licencia=1 ", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
if ($ttt==$row['id_tipo_encargo']) {
array_push($array0, 1);
} else { array_push($array0, 0); }



 } while ($row = mysql_fetch_assoc($select)); 
} else { } 
mysql_free_result($select);




$tramite=intval(array_sum($array0));
echo $tramite;



$rango=100/$totalRows;
$info=$rango*$tramite;


?>
  
 <br>


<div class="progress">

    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($info); ?>%">
     <?php echo round($info,1); ?>%
  </div>

</div>


 <?php

 

 } while ($row_reghtp = mysql_fetch_assoc($reghtp));
 mysql_free_result($reghtp);
?>

<hr><b>Total: </b>
<?php echo $totalRows; ?>


	
<?php 


$query = sprintf("SELECT count(id_permiso) as tpermiso FROM permiso where estado_permiso=1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
echo '<br><b>Actos administrativos: </b>'.$row['tpermiso'].'<br>';
mysql_free_result($select);





if (1==$_SESSION['snr_tipo_oficina']) {


?>
<hr>
	   <form action="xls/reporte_permisos_notarios.xls" method="post" name="form1" id="form1">
	   
	   <div class="form-group text-left"> 
Reporte de permisos y licencias: 
<input required type="text"  class="form-control datepicker" name="desde" placeholder="Desde"  readonly="readonly" value=""  />

<input required type="text"  class="form-control datepicker" name="hasta" placeholder="Hasta" readonly="readonly" value=""  />
 &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;<button type="submit" class="btn btn-xs btn-success">
<span class="glyphicon glyphicon-search"></span> Descargar excel </button>
</div>

	  <!-- <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo:</label> 




<select name="id_tipo_encargo"   class="form-control">
	  <option value="" selected></option>
	  <?php
	  /*
$query_rese = "SELECT * FROM tipo_encargo order by id_tipo_encargo";
$rese = mysql_query($query_rese, $conexion) or die(mysql_error());
$row_rese = mysql_fetch_assoc($rese);
	do { 
	   echo '<option value="'.$row_rese['id_tipo_encargo'].'" ';
	   echo '>'.$row_rese['nombre_tipo_encargo'].'</option>'; 
     } while ($row_rese = mysql_fetch_assoc($rese));
	mysql_free_result($rese);
	*/
	?>
	  </select>
	  
</div>-->






	   </form>
	   
<?php } else { 


}?>
</div>
</div>
</div>

</DIV>





<div class="col-md-3"> 



		<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Categorias</h3>
<?php 

/*
echo '<a href="mapa_notarias&'.$id.'&0.jsp" ';
 if ($ed==0) { echo 'style="color:#ff0000;"';
 } else { }
echo '>Todas</a><hr>';
*/




$array0 = array();
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();



$query_reghtp = "SELECT * FROM categoria_notaria where estado_categoria_notaria=1 ";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
    
	$array0 = array();
	
 echo '<b>'.$row_reghtp['nombre_categoria_notaria'].':</b> ';
 $ttt=intval($row_reghtp['id_categoria_notaria']);
 

$select = mysql_query("select id_categoria_notaria from notaria where estado_notaria=1 ", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
if ($ttt==$row['id_categoria_notaria']) {
array_push($array0, 1);
} else { array_push($array0, 0); }



 } while ($row = mysql_fetch_assoc($select)); 
} else { } 
mysql_free_result($select);




$tramite=intval(array_sum($array0));
echo $tramite;



$rango=100/$totalRows;
$info=$rango*$tramite;


?>
  
 <br>


<div class="progress">

    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($info); ?>%">
     <?php echo round($info,1); ?>%
  </div>

</div>


 <?php

 

 } while ($row_reghtp = mysql_fetch_assoc($reghtp));
 mysql_free_result($reghtp);
?>




</div>
</div>
</div>



<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Mapas de calor</h3>
<br>
				     <a href="mapa_notarias_calor.jsp" class="btn btn-xs btn-warning btn-block">Por ubicación</a>
					 <br>
                     <a href="mapa_notarias_permisos.jsp" class="btn btn-xs btn-warning btn-block">Por permisos</a>
					 <br>
                     <a href="" class="btn btn-xs btn-warning btn-block">Por requerimientos</a>
</div>
</div>
</div>



 <?php  if (1==$_SESSION['rol'] or 45==$_SESSION['snr_grupo_area']  or 46==$_SESSION['snr_grupo_area'] or 17==$_SESSION['snr_grupo_area'] or 22==$_SESSION['snr_grupo_area'] ) { ?>
<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Reportes</h3>
<br>
<a href="xls/posesion_notarias.xls" class="btn btn-xs btn-success btn-block">Posesiones de Notarios</a>
<br>
<a href="xls/requerimientos_notarias.xls" class="btn btn-xs btn-success btn-block">Requerimientos de Notarios</a>
<!--<br>
<a href="notaria_dian_reportes.jsp" class="btn btn-xs btn-success btn-block">Reporte de la DIAN</a>-->
<br>
<a href="xls/cobertura_notarias.xls" class="btn btn-xs btn-success btn-block">Cobertura de Notarias</a>
</div>
</div>
</div>
	 <?php } else { }?>



<!--
<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Departamento</h3>
<?php 
/*
echo '<a href="mapa_notarias&0&'.$ed.'.jsp" ';
 if ($ed==0) { echo 'style="color:#ff0000;"';
 } else { }
echo '>Todos</a><hr>';

$query="select * from departamento where estado_departamento=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
echo '<a href="mapa_notarias&'.$id.'&'.$row['id_departamento'].'.jsp" ';

 if ($ed==$row['id_departamento']) { echo 'style="color:#ff0000;"';
 } else { }
 
echo '>'.$row['nombre_departamento'].'</a> ';

echo '<br>';
} while ($row = mysql_fetch_assoc($select)); 

echo '<br>';
} else {}	 

mysql_free_result($select);
*/

?>
</div>
</div>
</div>
-->



</div>
<div class="col-md-3"> 



          <div class="box">
          <div class="box-header with-border">
                  <h3 class="box-title">Requerimientos</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
            <div class="box-body" style="min-height:380px;">
			
<div id="chart"></div>
<center>
			<a href="https://sisg.supernotariado.gov.co/control_req_tras.jsp" class="btn btn-xs btn-primary btn-block">Tablero de control</a>
			 </center>
			 </div>
        </div>
		
		
		
		
		
		
		
		
		
		<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>Liquidación de herencia</h3>
<br>
Abiertas: 
<?php

// 1 = Abierta, 2 = Terminada, 3 = Reportada en otra Notaría

$query22 = sprintf("SELECT count(id_sucesion) total_abiertas
			  FROM sucesion 
              WHERE id_estado_sucesion = 1
			  AND estado_sucesion = 1 ");
$select22 = mysql_query($query22, $conexion);
$row22 = mysql_fetch_assoc($select22);

$query33 = sprintf("SELECT count(id_sucesion) total_terminadas
			  FROM sucesion 
              WHERE id_estado_sucesion = 2
			  AND estado_sucesion = 1 ");
$select33 = mysql_query($query33, $conexion) ;
$row33 = mysql_fetch_assoc($select33);

$query44 = sprintf("SELECT count(id_sucesion) total_otrasNota
			  FROM sucesion 
              WHERE id_estado_sucesion = 3
			  AND estado_sucesion = 1 ");
$select44 = mysql_query($query44, $conexion);
$row44 = mysql_fetch_assoc($select44);

echo $row22['total_abiertas'];
echo '<br>Terminadas: ';
echo $row33['total_terminadas'];
echo '<br>En otras Notarias: ';
echo $row44['total_otrasNota'];
?>
</div>
</div>
</div>

		
		
		
</div>


<div class="col-md-3"> 


	<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
  
          <h3>Actos juridicos</h3>

          <div class="table-responsive">
            <table class="table">
			
		<?php 

$query="select * from acto_juridico where estado_acto_juridico=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
echo '<tr>';

echo '<td>'.$row['nombre_acto_juridico'].'</td>';
echo '<td>'.$row['cantidad'].'</td>';

echo '</tr>';
} while ($row = mysql_fetch_assoc($select)); 


} else {}	 

mysql_free_result($select);	
			?>
			
           
            </table>
          </div>
        </div>
		</div>
		</div>


	<div class="box ">
		 <div class="box-body">
              <div class="table-responsive">
  
          <h3>Notarias por municipio</h3>

          <div class="table-responsive">
            <table class="table">
			
		<?php 

$query7="SELECT nombre_municipio, divipola, COUNT( * ) Total
FROM notaria, municipio WHERE notaria.divipola=municipio.divipolaf
GROUP BY divipola
HAVING COUNT( * ) >1
ORDER BY Total desc";
$select7 = mysql_query($query7, $conexion);
$row7 = mysql_fetch_assoc($select7);
$totalRows7 = mysql_num_rows($select7);
if (0<$totalRows7){
do {
echo '<tr>';

echo '<td>'.$row7['nombre_municipio'].'</td>';
echo '<td>'.$row7['Total'].'</td>';

echo '</tr>';
} while ($row7 = mysql_fetch_assoc($select7)); 


} else {}	 

mysql_free_result($select7);	
			?>
			
           
            </table>
          </div>
        </div>
		</div>
		</div>
		




</div>



</div>


<?php

$array0 = array();


$select = mysql_query("select * from requerir_pqrs where estado_requerir_pqrs=1 and radicado_requerimiento is not null", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {

	
if (isset($row['radicado_respuesta'])) {
array_push($array0, 1);
} else { array_push($array0, 0); }



 } while ($row = mysql_fetch_assoc($select)); 
} else { } 
mysql_free_result($select);


$tramite=intval(array_sum($array0));


$info=$totalRows-$tramite;

$totalreq=$totalRows;

?>

<script type='text/javascript'>

window.onload=function(){
var chart = c3.generate({
    data: {
        columns: [
            ['data1', <?php echo $totalRows; ?>],
            ['data2', 0],
        ],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "Requerimientos: <?php echo $totalRows; ?>"
    }
});

setTimeout(function () {
    chart.load({
        columns: [
            ["Con respuesta:  <?php echo $info; ?>", <?php echo $info; ?>],
            ["Sin respuesta: <?php echo $tramite; ?>", <?php echo $tramite; ?>],
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

if (0==$id) {
	$id_tipo_obra="";
} else
{ $id_tipo_obra=" and id_tipo_obra=".$id.""; }

if (0==$ed) {

	$id_localidad="";
} else {
		$id_localidad=" and id_localidad=".$ed."";
	 }


	 
	 	 if (isset($_POST['notaria']) and ""!=$_POST['notaria']) {

	
	$notariab=$_POST['notaria'];
	
$notariabus=" and nombre_notaria like '%$notariab%' "; 
} else {
$notariabus="";
 }
 
		
$query="select  latitud, longitud, nombre_notaria, id_notaria from notaria where latitud!=''".$notariabus."";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	
do { ?>


	L.marker([<?php echo $row['latitud']; ?>, <?php echo $row['longitud']; ?>]).addTo(mymap)
   .bindPopup('<?php echo ''.$row['nombre_notaria'].'  <a href="notaria&'.$row['id_notaria'].'.jsp" target="black"> + Info</a>'; ?>');
   
   

<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
		
		
		
		

?>




var requeririnotarios='<?php echo $totalreq; ?>';
document.getElementById("requeririnotarios").innerHTML=requeririnotarios;

</script>


