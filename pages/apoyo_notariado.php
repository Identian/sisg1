<?php if (1==$_SESSION['snr_tipo_oficina']) {
	?>
<div class="row">

<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-aqua">
<div class="inner">
<h3>
<?php $actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and mes_beneficio='Junio'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
$totalr= $row155['tot'];
echo $totalr;
mysql_free_result($actualizar55);
 ?>
</h3>
<p>Solicitudes de apoyo en Junio</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-green">
<div class="inner">
<h3><?php $actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and mes_beneficio='Julio'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo  $row155['tot'];
mysql_free_result($actualizar55);
 ?></h3>
<p>Solicitudes de apoyo en Julio</p>
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
 $actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and mes_beneficio='Agosto'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo  $row155['tot'];
mysql_free_result($actualizar55);
 ?>
 </h3>
<p>Solicitudes de apoyo en Agosto</p>
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
 $actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and mes_beneficio='Septiembre'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo  $row155['tot'];
mysql_free_result($actualizar55);
 ?></h3>
<p>Solicitudes de apoyo en Septiembre</p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
<a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<!-- ./col -->
</div>



	 



<!--

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
  <a class="btn btn-app" style="width:100%;" href="orips.jsp">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> ORIPs
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="orips.jsp">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> REGIONALES
              </a>
</div>
			  </div>
			   </div>
			  </div>
-->


			  
	
	

<div class="row">
<div class="col-md-6">     
  <div class="box ">
		 <div class="box-body">
              <div class="table-responsive">			  
                <h3>Resumen de apoyo a Notarias</h3><br>
<?php 

$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
$analisistt=$row155['tot'];
echo 'Solicitudes hechas: '.$analisistt.'<br>';
mysql_free_result($actualizar55);



$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb0 is not null", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
$analisis=$row155['tot'];
echo 'Cantidad de analisis hechos: '.$analisis.'<br>';
mysql_free_result($actualizar55);

$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb0='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación a la solicitud: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);


$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb1='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación al Doc 1: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);

$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb2='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación al Doc 2: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);

$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb3='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación al Doc 3: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);

$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb4='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación al Doc 4: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);

$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb5='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación al Doc 5: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);

$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb6='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación al Doc 6: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);


$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb9='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación al Certificado del contador público: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);


$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and rb0='Si' and rb1='Si' and rb2='Si' and rb3='Si' and rb4='Si' and rb5='Si' and rb6='Si' and confirmacion='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación a todos los documentos requeridos: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);


$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and daf='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación por DAF: '.$row155['tot'].'<br>';
mysql_free_result($actualizar55);


$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and daf='Si' and rb0='Si' and rb1='Si' and rb2='Si' and rb3='Si' and rb4='Si' and rb5='Si' and rb6='Si' and confirmacion='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Aprobación completa: <b>'.$row155['tot'].'</b><br>';
mysql_free_result($actualizar55);


$actualizar55 = mysql_query("select sum(n_empleados_mes) as mes from beneficio_notaria where estado_beneficio_notaria=1 and daf='Si' and rb0='Si' and rb1='Si' and rb2='Si' and rb3='Si' and rb4='Si' and rb5='Si' and rb6='Si' and confirmacion='Si'", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Número de empleados aprobados: <b>'.$row155['mes'].'</b> (de acuerdo con las aprobaciones completas.)<br>';
mysql_free_result($actualizar55);


$actualizar55 = mysql_query("select count(id_beneficio_notaria) as ttt from beneficio_notaria where estado_beneficio_notaria=1 and b9 is not null", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo '<hr>Cantidad de certificaciones del contador: <b>'.$row155['ttt'].'</b><br>';
mysql_free_result($actualizar55);


$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tttr from beneficio_notaria where estado_beneficio_notaria=1 and rb9 is not null", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo 'Cantidad de revisiones de certificaciones del contador: <b>'.$row155['tttr'].'</b><hr>';
mysql_free_result($actualizar55);
 ?>

<a href="xls/reporte_apoyo_economico&Junio.xls"><img src="images/excel.png"> Descargar Listado de aprobación Junio.</a>
 <br>
 <a href="xls/reporte_apoyo_economico&Julio.xls"><img src="images/excel.png"> Descargar Listado de aprobación Julio.</a>
 <br>
 <a href="xls/reporte_apoyo_economico&Agosto.xls"><img src="images/excel.png"> Descargar Listado de aprobación Agosto.</a>
 <br>
 <a href="xls/reporte_apoyo_economico&Septiembre.xls"><img src="images/excel.png"> Descargar Listado de aprobación Septiembre.</a>
 <br>
 <a href="xls/reporte_noaprobado_apoyo_economico.xls"><img src="images/excel.png"> Descargar Listado de NO aprobados.</a>
 <br>
 
 
 <a href="xls/reporte_banco_apoyo_economico.xls"><img src="images/excel.png"> Descargar reporte de banco.</a>
 <br>
 
 
 <a href="xls/observaciones_apoyo_economico.xls"><img src="images/excel.png"> Descargar Listado de Observaciones.</a>
 <br>
 
 <div id="chart"></div>
  <?php if (1==$_SESSION['rol']) { ?>
<center><a href="xlsx/beneficio_notaria.xls"><img src="images/excel.png">Datos</a></center>
<?php } ?>
<script type='text/javascript'>//<![CDATA[
window.onload=function(){
var chart = c3.generate({
    data: {
        columns: [
            ['data1', <?php 
			$total=$totalr; echo $total; ?>],
            ['data2', 0],
        ],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "Solicitudes: <?php echo $analisistt; ?>"
    }
});

setTimeout(function () {
    chart.load({
        columns: [
            ["Analizadas:  <?php 
			

$finalizadas=$analisis;
			
			 echo $finalizadas; ?>", <?php echo $finalizadas; ?>],
            ["Por analizar: <?php $pendientes=$analisistt-$finalizadas; echo $pendientes; ?>", <?php echo $pendientes; ?>],
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

<br><br>
  </div>
            </div>
          </div>

</div>
<div class="col-md-6"> 

<div class="box ">
<div class="box-body">
<div class="table-responsive">
<h3>Analistas</h3>


<?php 


$actualizar55 = mysql_query("select count(id_beneficio_notaria) as tot from beneficio_notaria where estado_beneficio_notaria=1 and id_analista is not null", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
$totanalistas=$row155['tot'];
echo '<b>Cantidad de asignaciones: '.$totanalistas.'</b><br><br>';
mysql_free_result($actualizar55);



$query="SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and id_perfil=62  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC";
$select = mysql_query($query, $conexion) ;
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){	
do { 

$infop=$row['id_funcionario'];
$queryb="select count(id_beneficio_notaria) as totalp from beneficio_notaria where id_analista=".$infop." and estado_beneficio_notaria=1";
$selectb = mysql_query($queryb, $conexion);
$rowb = mysql_fetch_assoc($selectb);
$infotob= $rowb['totalp'];

 echo $row['nombre_funcionario']; 

 echo ': '.$infotob; 
 
 $info3=($infotob*100)/$totanalistas;
 
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





</div>
</div>

<?php } else {} ?>
