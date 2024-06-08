
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
		<!--<a href="pqrs_area.jsp">-->
		<a style=" cursor: pointer;" data-toggle="modal" data-target="#miModal">
		
	
	  
	  
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-floppy-disk"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PQRS por areas N.C.</span>
			  
			  <span class="info-box-number"><?php 
			  
$reghtpo = mysql_query("SELECT id_solicitud_pqrs FROM asignacion_pqrs where id_tipo_oficina=1 and estado_asignacion_pqrs=1 ", $conexion);
//$rowcco = mysql_fetch_assoc($reghtpo);
$totuu = mysql_num_rows($reghtpo );
echo $totuu;	
			  
			 ?></span>
			  
              
            </div>
          
          </div>
      </a>
        </div>
    
        <div class="col-md-3">
	<!--	<a href="mapa_calor.jsp">
		<a href="xls/pqrs_orip.xls">-->
		<a style=" cursor: pointer;" data-toggle="modal" data-target="#miModalorip">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-inbox"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PQRS por ORIP y Región</span>
	
			 <span class="info-box-number"> <?php 
			 
$reghtpoH = mysql_query("SELECT id_solicitud_pqrs FROM asignacion_pqrs where id_tipo_oficina=2 and estado_asignacion_pqrs=1 ", $conexion);
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
	   
	   
	   
	          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
$query = sprintf("SELECT count(id_percepcion_oac) as tper FROM percepcion_oac where id_oficina_registro=0 and estado_percepcion_oac=1"); 
$select = mysql_query($query, $conexion);
$row_update = mysql_fetch_assoc($select);
$nper= $row_update['tper']; 
echo $nper; 
?></h3>

              <p>Percepción en OAC</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="percepcion&0.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
	   
	   
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3>
<?php echo existencia('percepcion_oac'); ?>
 
			  </h3>

              <p>Percepción nacional</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
		   <a href="percepcion_reporte.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
 
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('mensaje_correo'); ?></h3>

              <p>Notificaciones de PQRSD realizadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
             <a href="notificacion_pqrs.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
 
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo existencia('conocimiento_pqrs'); ?></h3>

              <p>PQRS asignadas para Conocimiento</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
              <a href="xls/pqrs_conocimiento.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
	 
      </div>
	  
	  
	  
	  
<?php if (1==$_SESSION['rol'] or  2>$_SESSION['snr_tipo_oficina']) { ?>
	  


	   <div class="row">
  <div class="col-md-12">
  <div class="info-box">
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="xls/pqrs_area.xls" >
                <span class="badge bg-green" ><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> AREAS
              </a>
</div>

<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="xls/pqrs_orip.xls">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> ORIPS
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="xls/agendamientos&0.xls">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> Agendamiento OAC
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="xls/agendamientos&138.xls" >
                <span class="badge bg-green" ><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> Agendamiento Cali
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="xls/agendamientos&192.xls">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> Agendamiento Ubate
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="xls/reparto_pqrs.xls">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> Reporte de repartos
              </a>
</div>
			  </div>
			   </div>
			  </div>


<?php } ?>
	  
	  
	  
	  
	 
	
	
	
	  
	  
	  
<div class="row">
 <div class="col-md-12">

		<div class="panel panel-default">
  <div class="panel-body">
<div style="width:100%;height:200px;"><canvas id="chartjs-7" class="chartjs" style="width:100%;height:200px;"></canvas></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script>new Chart(document.getElementById("chartjs-7"),
{"type":"line",
"data":{"labels":["Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","Enero","Febrero","Marzo","Abril","Mayo","Junio"],
"datasets":[{"label":"Historico - PQRS 2023-2024","data":[
<?php 





$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 07 AND YEAR(fecha_radicado) = 2023";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);


$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 08 AND YEAR(fecha_radicado) = 2023";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);


$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 09 AND YEAR(fecha_radicado) = 2023";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);

$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 10 AND YEAR(fecha_radicado) = 2023";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);

$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 11 AND YEAR(fecha_radicado) = 2023";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);


$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 12 AND YEAR(fecha_radicado) = 2023";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);




$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 01 AND YEAR(fecha_radicado) = 2024";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);


$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 02 AND YEAR(fecha_radicado) = 2024";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);



$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 03 AND YEAR(fecha_radicado) = 2024";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);


$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 04 AND YEAR(fecha_radicado) = 2024";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);

$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 05 AND YEAR(fecha_radicado) = 2024";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);

$query="SELECT count(id_solicitud_pqrs) as valorfm FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 06 AND YEAR(fecha_radicado) = 2024";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
echo $row['valorfm'].',';
mysql_free_result($select);



?>
],
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},
"options":{}});
</script>

</div> 
</div> 	  
</div> 
</div> 



<div class="row">

        <div class="col-md-6">

          <div class="box">
          <div class="box-header with-border">
                  <h3 class="box-title">Consolidado de PQRS</h3>
<?php
if (1==$_SESSION['rol'] && 1==2) {
?>
<div style="text-align:right"><a href="xls/pqrs_total.xls"><img src="images/excel.png"></a></div>
<?php } else {} ?>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body" style="min-height:440px;">
			
<div id="chart"></div>
			
			 </div>
        </div>

			
			</div>
			
			 <div class="col-md-6">
			<div class="box">
			 <div class="box-header with-border">
                  <h3 class="box-title">Canales de atención a PQRS</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
			

 <div class="box-body">
  
	
	
<?php


$query_reghtp = "SELECT * FROM canal_pqrs where estado_canal_pqrs=1 and id_canal_pqrs!=7 order by id_canal_pqrs";  
$reghtp = mysql_query($query_reghtp, $conexion);
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
    
	$array0 = array();
	
 echo '<b>'.$row_reghtp['nombre_canal_pqrs'].':</b> ';
 $ttt=intval($row_reghtp['id_canal_pqrs']);
 

$select = mysql_query("select id_canal_pqrs from solicitud_pqrs where estado_solicitud_pqrs=1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
if ($ttt==$row['id_canal_pqrs']) {
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

<a href="chat.jsp" ><b>Chat</b></a><br>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: 1%">
     %
  </div>
</div>

</div>
</div>
</div>
			 
			 
			 
			 </div>
			 
			

</div>

<script type='text/javascript'>//<![CDATA[
window.onload=function(){
var chart = c3.generate({
    data: {
        columns: [
            ['data1', <?php 
			
$reghtp = mysql_query("select count(id_solicitud_pqrs) as tots from solicitud_pqrs where estado_solicitud_pqrs=1", $conexion);
$rowcc = mysql_fetch_assoc($reghtp);
			$total=$rowcc['tots']; echo $total; ?>],
            ['data2', 0],
        ],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "PQRS: <?php echo $total; ?>"
    }
});

setTimeout(function () {
    chart.load({
        columns: [
            ["Finalizadas:  <?php 
			
$reghtpf = mysql_query("select count(id_solicitud_pqrs) as final from solicitud_pqrs where id_estado_solicitud=5 and estado_solicitud_pqrs=1", $conexion);
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





<div class="row">

<div class="col-md-6" >
          
                         <div class="box">
						 
						    <div class="box-header with-border">
                  <h3 class="box-title">Tipos de PQRS</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
			
<?php


$query_reghtp = "SELECT * FROM categoria_pqrs where estado_categoria_pqrs=1 order by id_categoria_pqrs";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion);
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
    
	$array0 = array();
	
 echo '<b>'.$row_reghtp['nombre_categoria_pqrs'].':</b> ';
 $ttt=intval($row_reghtp['id_categoria_pqrs']);
 

$select = mysql_query("select id_categoria_pqrs from solicitud_pqrs where estado_solicitud_pqrs=1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
if ($ttt==$row['id_categoria_pqrs']) {
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













     <div class="box">
						 
						    <div class="box-header with-border">
                  <h3 class="box-title">Estados internos</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
			
<?php
$arraye1 = array();
$arraye2 = array();
$arraye3 = array();
$arraye4 = array();
$arraye5 = array();	
$arraye6 = array();	
$arraye7 = array();	

$selecte = mysql_query("select id_estado_solicitud from solicitud_pqrs where estado_solicitud_pqrs=1", $conexion);
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
echo 'Ampliación / Requerimiento: '.$tramitee6.'<br>';
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



 <br>





</div>
</div>











</div>

		


		
		
<div class="col-md-6" >
                                <div class="box">
						 
						    <div class="box-header with-border">
                  <h3 class="box-title">Categorias de PQRS</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
			
<?php


$query_reghtp = "SELECT * FROM categoria_oac where estado_categoria_oac=1 order by id_categoria_oac";  //OFFSET 13
$reghtp = mysql_query($query_reghtp, $conexion);
$row_reghtp = mysql_fetch_assoc($reghtp);
$totalRows_reghtp = mysql_num_rows($reghtp);
 do {
   
    
	$array0 = array();
	
 echo '<b>'.$row_reghtp['nombre_categoria_oac'].':</b> ';
 $ttt=intval($row_reghtp['id_categoria_oac']);
 

$select = mysql_query("select id_categoria_oac from clasificacion_pqrs where estado_clasificacion_pqrs=1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
if ($ttt==$row['id_categoria_oac']) {
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























 <div class="box">
						 
<div class="box-header with-border">
                  <h3 class="box-title">Gestión de PQRS</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">

PQRS Clasificadas: 

<?php $actualizar55c = mysql_query("SELECT COUNT(id_solicitud_pqrs) as totac FROM clasificacion_pqrs where estado_clasificacion_pqrs=1", $conexion);
$row155c = mysql_fetch_assoc($actualizar55c);
$clasi= $row155c['totac'];
mysql_free_result($actualizar55c);

echo $clasi;
$faltaclasi=$total-$clasi;
echo ', Pendientes: '.$faltaclasi;

$infoec=($clasi*100)/$total;

?>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($infoec); ?>%">
     <?php echo round($infoec,1); ?>%
  </div>
  </div>
  
PQRS Direccionadas: <?php $actualizar55ca = mysql_query("SELECT COUNT(id_solicitud_pqrs) as totaca FROM asignacion_pqrs where estado_asignacion_pqrs=1", $conexion);
$row155ca = mysql_fetch_assoc($actualizar55ca);
$dir= $row155ca['totaca'];
mysql_free_result($actualizar55ca);

echo $dir;
$faltadir=$total-$dir;
echo ', Pendientes: '.$faltadir;

$infoecd=($dir*100)/$total;

?>
<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: <?php echo intval($infoecd); ?>%">
     <?php echo round($infoecd,1); ?>%
  </div>
  </div>
  

  


<?php if (1==$_SESSION['rol']) { 
echo '<hr>';
$selectcc = mysql_query("SELECT id_solicitud_pqrs, COUNT( * ) Totale
FROM clasificacion_pqrs WHERE estado_clasificacion_pqrs=1 GROUP BY id_solicitud_pqrs HAVING COUNT( * ) >1", $conexion);
$rowcc = mysql_fetch_assoc($selectcc);
$totalRowscc = mysql_num_rows($selectcc);
if (0<$totalRowscc){
	echo '<hr>Clasificaciones duplicadas: <br>';
do {
	echo ''.$rowcc['id_solicitud_pqrs'].': '.$rowcc['Totale'].' veces<br>';
} while ($rowcc = mysql_fetch_assoc($selectcc)); 
} else { } 
mysql_free_result($selectcc);





$selectaa = mysql_query("SELECT id_solicitud_pqrs, COUNT( * ) Totals
FROM asignacion_pqrs WHERE estado_asignacion_pqrs=1 GROUP BY id_solicitud_pqrs HAVING COUNT( * ) >1", $conexion);
$rowaa = mysql_fetch_assoc($selectaa);
$totalRowsaa = mysql_num_rows($selectaa);
if (0<$totalRowsaa){
	echo '<hr>Direccionamiento duplicado: <br>';
do {
echo ''.$rowaa['id_solicitud_pqrs'].': '.$rowaa['Totals'].' veces<br>';
} while ($rowaa = mysql_fetch_assoc($selectaa)); 
} else { } 
mysql_free_result($selectaa);




 } else { } 
 
 ?> 
</div>
</div>		
</div>




 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Reporte de PQRSD por Area en Nivel central</h4>
      </div>
      <div class="modal-body">
        
<form action="xls/pqrs_area.xls" method="POST" name="for242354354r6544324464563m1" target="_blank">

<div class="form-group text-left"> 
<label  class="control-label">Fecha inicial:</label> 
<input type="text" class="form-control datepicker" name="fecha_inicial"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Fecha final:</label> 
<input type="text" class="form-control datepicker" name="fecha_final"  required>
</div>

<?php
$horao=date('H:i:s');
$fecha_actual = strtotime($horao);
$fecha_inicio = strtotime("08:00:00");
$fecha_limite = strtotime("17:00:00");
if ($fecha_actual>=$fecha_limite  or $fecha_actual<=$fecha_inicio or 1==$_SESSION['rol'])
	{
	
		?>
<div class="modal-footer">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Descargar </button>
</div>
	<?php 
	
	} else { echo 'Reporte disponible de 6:00 pm a 8:00 am'; } ?>

</form>


      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="miModalorip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Reporte de PQRSD por Oficina de Registro</h4>
      </div>
      <div class="modal-body">
        
<form action="xls/pqrs_orip.xls" method="POST" name="for242354332454r6544324464563m1" target="_blank">

<div class="form-group text-left"> 
<label  class="control-label">Fecha inicial:</label> 
<input type="text" class="form-control datepicker" name="fecha_inicial"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Fecha final:</label> 
<input type="text" class="form-control datepicker" name="fecha_final"  required>
</div>


<?php

if ($fecha_actual>=$fecha_limite  or $fecha_actual<=$fecha_inicio  or 1==$_SESSION['rol'])
{
		?>
<div class="modal-footer">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Descargar </button>
</div>
	<?php 
	} else { echo 'Reporte disponible de 6:00 pm a 8:00 am'; }
	?>
	

</form>


      </div>
    </div>
  </div>
</div>


 








