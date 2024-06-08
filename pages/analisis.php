<?php
$nump65=privilegios(65,$_SESSION['snr']);
?>
<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php  echo existencia('curaduria'); ?></h3>

              <p>Curadurias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="https://sisg.supernotariado.gov.co/xlsx/curaduria.xls" class="small-box-footer">Periodos no reportados. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
		
		 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo existencia('radicacion_curaduria'); ?></h3>

              <p>Radicaciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
		
		 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php 
			  //https://sisg.supernotariado.gov.co/xlsx/radicacion_curaduria.xls
$select55 = mysql_query("select count(id_licencia_curaduria) as totall from licencia_curaduria where estado_licencia_curaduria=1 and situacion_licencia=1", $conexion);
$row55 = mysql_fetch_assoc($select55);
echo intval($row55['totall']);
mysql_free_result($select55);

			 // echo existencia('licencia_curaduria'); 
			 
			 //https://sisg.supernotariado.gov.co/xlsx/licencia_curaduria.xls
			 ?></h3>


              <p>Licencias</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
		
	
		  

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
			 echo existencia('expensa_curaduria');
			  ?>
			  </h3>

              <p>Informes de tarifas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="expensa_reporte.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
       
     
		
		

      </div>
	  
	  


  <div class="row">

<div class="col-md-6" >
  
<div class="box">


<div class="box-header with-border">
                  <h3 class="box-title">Estadisticas de Curadurias</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
	<?php if (1==$_SESSION['rol'] or 0<$nump65){ ?>
	<hr>
	
<form action="xls/curadurias.xls" method="POST" name="for556546tgmgjht1">
<div class="row">

<div class="col-md-3">
CURADURIA
<select style="width:100%;"name="id_curaduria">
<option selected></option>
<?php echo lista('curaduria'); ?>
</select>
</div>

<div class="col-md-3">
TIPO DE FECHA
<select  name="tipo_fecha">
<option selected>TIPO F.</option>
<option value="fecha_licencia_real">Fecha de subida</option>
<option value="fecha_ejecutoria">Fecha ejecutoria</option>
<option value="fecha_radicacion">Fecha de radicación</option>
<option value="fecha_expedicion">Fecha de expedición</option>
</select>
</div>

<div class="col-md-2"> 
<input type="text" class="datepickera" style="width:100px;" name="fecha_desde" placeholder="Fecha desde" required readonly="readonly" >
</div>
<div class="col-md-2"> 
<input type="test"  class="datepickera" style="width:100px;" name="fecha_hasta" required placeholder="Fecha hasta" readonly="readonly">
</div>
<div class="col-md-2"> 
<button type="submit" class="btn btn-success">
Descargar</button>
</div>
</div>
</form>

<hr>

	
<form action="xls/curadurias.xls" method="POST" name="for5tgmgjht1">
<div class="row">
<div class="col-md-3">
TODAS LAS LICENCIAS
<select style="width:100%;"name="tipo_fecha">
<option selected>TIPO F.</option>
<option value="fecha_licencia_real">Fecha de subida</option>
<option value="fecha_ejecutoria">Fecha ejecutoria</option>
<option value="fecha_radicacion">Fecha de radicación</option>
<option value="fecha_expedicion">Fecha de expedición</option>
</select>
</div>

<div class="col-md-3"> 
<input type="text" class="form-control datepickera" name="fecha_desde" placeholder="Fecha desde" required readonly="readonly" >
</div>
<div class="col-md-3"> 
<input type="test"  class="form-control datepickera" name="fecha_hasta" required placeholder="Fecha hasta" readonly="readonly">
</div>
<div class="col-md-1"> 
<button type="submit" class="btn btn-success">
Descargar</button>
</div>
</div>
</form>

<hr>


<form action="xls/radicaciones_curadurias.xls" method="POST" name="for5t435435gmgjht1">
<div class="row">
<div class="col-md-3">
RADICACIONES
</div>

<div class="col-md-3"> 
<input type="text" class="form-control datepickera" name="fecha_desde" placeholder="Fecha desde" required readonly="readonly" >
</div>
<div class="col-md-3"> 
<input type="test"  class="form-control datepickera" name="fecha_hasta" required placeholder="Fecha hasta" readonly="readonly">
</div>
<div class="col-md-1"> 
<button type="submit" class="btn btn-success">
Descargar</button>
</div>
</div>
</form>




<?php } else {} ?>
	<hr>
	
	
<!--<div style="text-align:right"><a href="xls/curadurias.xls"><img src="images/excel.png"></a></div>	-->
	
<?php

$array0 = array();
$array1 = array();
	
$query_reghtp = "SELECT * FROM curaduria, municipio, departamento where  municipio.id_departamento=departamento.id_departamento and curaduria.id_departamento=departamento.id_departamento and curaduria.id_municipio=municipio.codigo_municipio order by departamento.id_departamento,municipio.nombre_municipio,curaduria.id_curaduria";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
    
	
	
 echo '<b>'.$row_reghtp['nombre_departamento'].' - '.$row_reghtp['nombre_municipio'].' - '.$row_reghtp['nombre_curaduria'].':</b> ';
 $id=intval($row_reghtp['id_curaduria']);
 
if (15==$id) {
	echo ' <a href="https://sisg.supernotariado.gov.co/mapa_bogota.jsp" target="blank"> Mapa </a> ';
} else { }
 
 if (16==$id) {
	echo ' <a href="https://sisg.supernotariado.gov.co/mapa_bogota_obras.jsp" target="blank"> Mapa </a> ';
} else { }
 
 
 $select = mysql_query("select count(id_licencia_curaduria) as total from licencia_curaduria where licencia_curaduria.id_curaduria=".$id." and estado_licencia_curaduria=1 and situacion_licencia=1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows=intval($row['total']);

echo 'Total: '.$totalRows;

array_push($array0, $totalRows);



mysql_free_result($select);



 
 
$select = mysql_query("select count(licencia_cerrada) as totale from licencia_curaduria where licencia_curaduria.id_curaduria=".$id." and estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1", $conexion);
$row = mysql_fetch_assoc($select);
$tramite=intval($row['totale']);
mysql_free_result($select);

array_push($array1, $tramite); 

echo ', &nbsp;  Cerradas: '.$tramite;

 if (1==$_SESSION['rol'] or 0<$nump65){ 
echo ' <a href="xls/licencias&'.$id.'&0.xls"><img src="images/excel.png"></a>';
} else {}

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

 
$todas=intval(array_sum($array0));
$cerradas=intval(array_sum($array1));
 mysql_free_result($reghtp);
 

?>


</div>
</div>
</div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>


        <div class="col-md-6">

		<div class="info-box">
<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Curadores</span>
<span class="info-box-number">
<a href="curadores.jsp">DIRECTORIO DE CURADORES</a>
</span>
</div>
</div>


<?php if (1==$_SESSION['rol'] or 0<$nump65){ ?>




		<div class="info-box">
<span class="info-box-icon bg-yellow"><i class="fa fa-flag-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Grupo interdisciplinario</span>
<span class="info-box-number">
<a href="analisis_curaduria_interdisciplinario.jsp">Areas de conocimiento</a>
</span>
</div>
</div>


		<div class="info-box">
<span class="info-box-icon bg-info"><i class="fa fa-flag-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Curadores</span>
<span class="info-box-number">
<a href="xls/faltas_curadores.xls">Faltas temporales y absolutas</a>
</span>
</div>
</div>

<?php } else {} ?>

		
	
		 
		
		
		
		       <div class="box">
          <div class="box-header with-border">
                  <h3 class="box-title">Mapa</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
            <div class="box-body" style="min-height:380px;">
			
<div id="mapid" style="width: 100%; min-height: 540px;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
</div>
			
			 </div>
        </div>
		
		
		
		
		
		
          <div class="box">
          <div class="box-header with-border">
                  <h3 class="box-title">Consolidado</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
            <div class="box-body" style="min-height:380px;">
			<?php if (1==$_SESSION['rol'] or 0<$nump65){ ?>
			Reporte de radicaciones urbanisticas: 
			<a href="xls/radicacion_urbanistica.xls"><img src="images/xls.png"> Más de 5 correcciones</a> 
			
			<hr>
			Reporte completo de licencias: 
			 <a href="xls/licencias_modalidades&2017.xls"><img src="images/xls.png"> 2017</a> / 
			<a href="xls/licencias_modalidades&2018.xls"><img src="images/xls.png"> 2018</a> / 
			<a href="xls/licencias_modalidades&2019.xls"><img src="images/xls.png"> 2019</a> / 
			<a href="xls/licencias_modalidades&2020.xls"><img src="images/xls.png"> 2020</a> /
			<a href="xls/licencias_modalidades&2021.xls"><img src="images/xls.png"> 2021</a> /
			<a href="xls/licencias_modalidades&2022.xls"><img src="images/xls.png"> 2022</a> / 
			<a href="xls/licencias_modalidades&2023.xls"><img src="images/xls.png"> 2023</a> 
			
			
			<br>
			
			<?php } ?>
<div id="chart"></div>
			
			 </div>
        </div>

		
		
		
		
		                   <div class="box">
						 
						    <div class="box-header with-border">
                  <h3 class="box-title">Tipos de licencia</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
			
<?php


$query_reghtp = "SELECT * FROM clase_licencia where estado_clase_licencia=1  order by id_clase_licencia";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
    
	$array0 = array();
	
 echo '<b>'.$row_reghtp['nombre_clase_licencia'].':</b> ';
 $ttt=intval($row_reghtp['id_clase_licencia']);
 

$select = mysql_query("select id_clase_licencia from tipo_autorizacion_licencia where estado_tipo_autorizacion_licencia=1 and situacion_tipo_autorizacion_licencia=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
if ($ttt==$row['id_clase_licencia']) {
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
</div>
</div>






		                   <div class="box">
						 
						    <div class="box-header with-border">
                  <h3 class="box-title">Usos aprobados</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
			
<?php


$query_reghtp = "SELECT * FROM uso_aprobado where estado_uso_aprobado=1 order by id_uso_aprobado";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion) or die(mysql_error());
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
    
	$array0 = array();
	
 echo '<b>'.$row_reghtp['nombre_uso_aprobado'].':</b> ';
 $ttt=intval($row_reghtp['id_uso_aprobado']);
 

$select = mysql_query("select id_uso_aprobado from uso_aprobado_licencia, licencia_curaduria where uso_aprobado_licencia.id_licencia_curaduria=licencia_curaduria.id_licencia_curaduria and licencia_curaduria.estado_licencia_curaduria=1 and estado_uso_aprobado_licencia=1 and situacion_uso_aprobado_licencia=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
if ($ttt==$row['id_uso_aprobado']) {
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
</div>
</div>








<!--

 <div class="box">
						 
						    <div class="box-header with-border">
                  <h3 class="box-title">Cantidad por mes</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">

			<?php 
			/*
$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 07 AND YEAR(fecha_licencia_real) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<b>Julio 2018: </b>'.$row['cantidad'].'';
mysql_free_result($select);

$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 08 AND YEAR(fecha_licencia_real) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Agosto 2018: </b>'.$row['cantidad'].'';
mysql_free_result($select);

$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 09 AND YEAR(fecha_licencia_real) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Septiembre 2018: </b>'.$row['cantidad'].'';
mysql_free_result($select);

$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 10 AND YEAR(fecha_licencia_real) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Octubre 2018: </b>'.$row['cantidad'].'';
mysql_free_result($select);

$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 11 AND YEAR(fecha_licencia_real) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Noviembre 2018: </b>'.$row['cantidad'].'';
mysql_free_result($select);

$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 12 AND YEAR(fecha_licencia_real) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Diciembre 2018: </b>'.$row['cantidad'].'';
mysql_free_result($select);



$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 01 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Enero 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);


$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 02 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Febrero 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);

$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 03 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Marzo 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);

$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 04 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Abril 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);


$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 05 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Mayo 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);


$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 06 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Junio 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);

$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 07 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Julio 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);


$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 08 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Agosto 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);


$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 09 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Septiembre 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);


$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 10 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Octubre 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);


$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 11 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Noviembre 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);

$query="select count(id_licencia_curaduria) as cantidad from licencia_curaduria where estado_licencia_curaduria=1 and licencia_cerrada=1 and situacion_licencia=1 and MONTH(fecha_licencia_real) = 12 AND YEAR(fecha_licencia_real) = 2019";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<br><b>Diciembre 2019: </b>'.$row['cantidad'].'';
mysql_free_result($select);
*/

?>
			
			
			
	
			
</div>
</div>
-->


			
			</div>
			

</div>

<?php 


?>

<script type='text/javascript'>//<![CDATA[
window.onload=function(){
var chart = c3.generate({
    data: {
        columns: [
            ['data1', <?php  echo $todas; ?>],
            ['data2', 0],
        ],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "Licencias: <?php echo $todas; ?>"
    }
});

setTimeout(function () {
    chart.load({
        columns: [
            ["Finalizadas:  <?php  echo $cerradas; ?>", <?php echo $cerradas; ?>],
            ["Pendiente de finalizar: <?php $pendientes=$todas-$cerradas; echo $pendientes; ?>", <?php echo $pendientes; ?>],
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
		
$query="select * from curaduria where latitud_c is not null and estado_curaduria=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	
do { ?>


	L.marker([<?php echo $row['latitud_c']; ?>, <?php echo $row['longitud_c']; ?>]).addTo(mymap)
   .bindPopup('<?php echo $row['nombre_curaduria'].' - '.$row['direccion_curaduria']; ?>');
   
   

<?php
} while ($row = mysql_fetch_assoc($select)); 
	}
mysql_free_result($select);		
		
		
		
		
	
?>

</script>










