
  
  
 
<div class="row">

<div class="col-md-9">
            
<div class="panel panel-default">
  <div class="panel-body">
 
	
<?php

if (isset($_GET['i'])) {
  $id=intval($_GET['i']);
  
$updateSQL7799 = sprintf("UPDATE soporte SET gestionada=%s WHERE id_soporte=%s",                  
					  GetSQLValueString(1, "int"),
					  GetSQLValueString($id, "int"));
$Result17799 = mysql_query($updateSQL7799, $conexion) or die(mysql_error());
  
   } else {
	
   } 


$array0 = array();


echo ' <h3> Incidencias - Soporte</h3><hr>';

//echo '<div style="text-align:right"><a href="xls/pqrs&'.$codigoo.'&'.$tipo_oficina.'.xls"><img src="images/excel.png"></a></div>';
 


 

$select = mysql_query("select id_soporte, funcionario.id_funcionario, nombre_funcionario, fecha_soporte, gestionada, nombre_soporte from soporte, funcionario where soporte.id_funcionario=funcionario.id_funcionario and estado_soporte=1 order by id_soporte desc", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){

do {
	
	
if (1==$row['gestionada']) {
array_push($array0, 1);
} else { array_push($array0, 0); }

?>

<div class="panel panel-default" id="<?php echo $row['id_soporte']; ?>">
  <div class="panel-heading"><?php 
  if (isset($row['gestionada']) && 1==$row['gestionada']) {
	echo '<i class="glyphicon glyphicon-ok" style="color:#00A65A;"></i>';  
  } else {
	 echo '<a href="incidencias&'.$row['id_soporte'].'.jsp"><i class="glyphicon glyphicon-warning-sign" style="color:#F39C12;"></i></a>';  
  }
  ?> &nbsp;  <?php echo $row['fecha_soporte']; ?> <b><a href="usuario&<?php echo $row['id_funcionario']; ?>.jsp"><?php echo $row['nombre_funcionario']; ?></a> </b></div>
  <div class="panel-body">
 <?php echo $row['nombre_soporte'].''; ?>
  </div>
</div>
<?php


	
	
	
	
	
	 } while ($row = mysql_fetch_assoc($select)); 
	 

} else { } 
mysql_free_result($select);



$todas=intval(array_sum($array0));


 ?>
  
 <br>


 <?php
 echo '<hr>';
 
unset($array0);


$todas1=$totalRows-$todas;

?>



</div>
</div>
</div>

<div class="col-md-3">
 <div class="panel panel-default">
  <div class="panel-body">
<h3>Resumen</h3>
<hr>
<div id="chart"></div>

</div>
</div>

</div>
</div>





<script type='text/javascript'>//<![CDATA[
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
        title: "Incidencias: <?php echo $totalRows; ?>"
    }
});

setTimeout(function () {
    chart.load({
        columns: [
		["Gestionadas:  <?php echo $todas; ?>",  <?php echo $todas; ?>],  
		["Incidencias:  <?php echo $todas1; ?>",  <?php echo $todas1; ?>],  
		
		
          
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


