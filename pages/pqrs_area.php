

<!--http://www.chartjs.org/docs/latest/charts/bar.html-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>


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
			  
$reghtpo = mysql_query("SELECT id_solicitud_pqrs FROM asignacion_pqrs where id_tipo_oficina=1 and estado_asignacion_pqrs=1", $conexion) or die(mysql_error());
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

<div class="col-md-8">
            
<div class="panel panel-default">
  <div class="panel-body">
<H3>Areas: En tramite vs. Vencimiento</H3>
<div style="text-align:right">(# area, En tramite, Vencidas x 10.) <a href="xls/pqrs_area.xls"><img src="images/excel.png"></a>
</div>
<br><br>
<div style="width:100%;"><canvas id="chartjs-6" class="chartjs"></canvas></div>
<br>
<br>
<script>new Chart(document.getElementById("chartjs-6"),
{"type":"bubble",
"data":
{"datasets":[{"Tipos":"PQRS",
"label":"PQRS AREA",
"data":[

<?php 

	

$queryn="SELECT id_area, nombre_area FROM area where id_area!=21 and estado_area=1 order by id_area";
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
$totalRowsn = mysql_num_rows($selectn);
if (0<$totalRowsn){
do {
	
$arrayvencida = array();
	
$ida=$rown['id_area'];
//$ttt=intval($row_reghtp['id_area']);
//$tramite= estadopqrs(1, $ida, 2);
//$vencidas=(pqrsvencidas(1, $ida))/10;



$select = mysql_query("select id_estado_solicitud, solicitud_pqrs.id_solicitud_pqrs, fecha_radicado from asignacion_pqrs, solicitud_pqrs where (id_estado_solicitud=2 or id_estado_solicitud=4) and asignacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs and asignacion_pqrs.id_tipo_oficina=1 and asignacion_pqrs.codigo_oficina=".$ida." and estado_asignacion_pqrs=1 and estado_solicitud_pqrs=1", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
$tramite=$totalRows;
if (0<$totalRows){
do {
	
	

$idsol=$row['id_solicitud_pqrs'];
$query48 = sprintf("SELECT clase_oac.terminos_ampliados FROM clasificacion_pqrs, clase_oac where clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac and clasificacion_pqrs.id_solicitud_pqrs=".$idsol." limit 1"); 
$select8 = mysql_query($query48, $conexion) or die(mysql_error());
$row8 = mysql_fetch_assoc($select8);
if (0<$row8['terminos_ampliados']){
$fechavence=fechahabil($row['fecha_radicado'],$row8['terminos_ampliados']);
if ($realdate<=$fechavence) {
} else {
	array_push($arrayvencida, 1);
}
}


	 } while ($row = mysql_fetch_assoc($select)); 
	 
	mysql_free_result($select);
	 
} else { } 


	
	
	
$vencidas1=array_sum($arrayvencida);
$vencidas=$vencidas1/10;


echo '{"x":'.$ida.',"y":'.$tramite.',"r":'.$vencidas.'},';

unset($arrayvencida); 

} while ($rown = mysql_fetch_assoc($selectn)); 

} else {}	 

mysql_free_result($selectn);
?>

{"x":30,"y":1,"r":1}

],
"backgroundColor":"rgb(214, 39, 40)"}
]}});
</script>


</div>
</div>
</div>

<div class="col-md-4">          
<div class="panel panel-default">
  <div class="panel-body">
  <h3>AREAS - NIVEL CENTRAL </h3>
<?php 
$query="select * from area where estado_area=1 and id_area!=21";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	$area_nc=$row['id_area'];
echo ''.$area_nc.'. <a href="analisis_oficina&'.$area_nc.'-1.jsp">'.$row['nombre_area'].'</a>, Total: ';


$querycn="SELECT count(solicitud_pqrs.id_solicitud_pqrs) as totalcn FROM solicitud_pqrs, asignacion_pqrs WHERE solicitud_pqrs.id_solicitud_pqrs=asignacion_pqrs.id_solicitud_pqrs 
AND asignacion_pqrs.id_tipo_oficina=1 and estado_solicitud_pqrs=1 and estado_asignacion_pqrs=1  
and asignacion_pqrs.codigo_oficina=".$area_nc."";
$selectcn = mysql_query($querycn, $conexion);
$rowcn = mysql_fetch_assoc($selectcn);
echo $rowcn['totalcn'].' PQRSD.';





echo '<br>';

} while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);
?>
</div>
</div>
</div>
</div>
