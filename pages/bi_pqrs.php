

<!--http://www.chartjs.org/docs/latest/charts/bar.html-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<div class="row">

<div class="col-md-8">
            
<div class="panel panel-default">
  <div class="panel-body">
<H3>Areas: En tramite vs. Vencimiento</H3>
<div style="width:100%;"><canvas id="chartjs-6" class="chartjs"></canvas></div>
<script>new Chart(document.getElementById("chartjs-6"),
{"type":"bubble",
"data":
{"datasets":[{"Tipos":"PQRS",
"label":"PQRS AREA",
"data":[

<?php 
$query="select * from area where estado_area=1 and id_area!=21";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
$ida=$row['id_area'];
$tramite= estadopqrs(1, $ida, 2);
$vencidas=(pqrsvencidas(1, $ida))/10;

echo '{"x":'.$ida.',"y":'.$tramite.',"r":'.$vencidas.'},';

} while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);
?>

{"x":30,"y":1,"r":1}

],
"backgroundColor":"rgb(214, 39, 40)"}
]}});
</script>
<hr>

  <H3>Historico</H3>
<div style="width:100%;"><canvas id="chartjs-7" class="chartjs"></canvas></div>
<script>new Chart(document.getElementById("chartjs-7"),
{"type":"line",
"data":{"labels":["Junio","Julio","Agosto","Septiembre","Octubre","Noviembre"],
"datasets":[{"label":"PQRS","data":[
<?php 
$query="SELECT count(id_solicitud_pqrs) as valorf FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 06 AND YEAR(fecha_radicado) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo $row['valorf'].',';
mysql_free_result($select);

$query="SELECT count(id_solicitud_pqrs) as valorf FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 07 AND YEAR(fecha_radicado) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo $row['valorf'].',';
mysql_free_result($select);

$query="SELECT count(id_solicitud_pqrs) as valorf FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 08 AND YEAR(fecha_radicado) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo $row['valorf'].',';
mysql_free_result($select);

$query="SELECT count(id_solicitud_pqrs) as valorf FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 09 AND YEAR(fecha_radicado) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo $row['valorf'].',';
mysql_free_result($select);

$query="SELECT count(id_solicitud_pqrs) as valorf FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 10 AND YEAR(fecha_radicado) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo $row['valorf'].',';
mysql_free_result($select);

$query="SELECT count(id_solicitud_pqrs) as valorf FROM solicitud_pqrs WHERE estado_solicitud_pqrs=1 and MONTH(fecha_radicado) = 11 AND YEAR(fecha_radicado) = 2018";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo $row['valorf'].',';
mysql_free_result($select);

?>
],
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},
"options":{}});
</script>

</div>
</div>
</div>

<div class="col-md-4">          
<div class="panel panel-default">
  <div class="panel-body">
  <h3>AREAS - NIVEL CENTRAL</h3>
<?php 
$query="select * from area where estado_area=1 and id_area!=21";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
echo '<a href="bi_pqrs&'.$row['id_area'].'.jsp">'.$row['id_area'].'. '.$row['nombre_area'].'</a><br>';

} while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);
?>
</div>
</div>
</div>
</div>
