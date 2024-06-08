<?php
if (isset($_GET['i'])) {
	$id=$_GET['i'];
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }


//curaduria, funcionario where curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria='$id' limit 1");
$query = sprintf("SELECT * FROM departamento,municipio,oficina_registro  where departamento.id_departamento=oficina_registro.id_departamento and municipio.codigo_municipio=oficina_registro.codigo_municipio and id_oficina_registro='$id' limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
$name = $row1['nombre_oficina_registro'];
$dep = $row1['nombre_departamento'];
$ciudad = $row1['nombre_municipio'];
$tele = $row1['telefono_oficina_registro'];
$celu = $row1['nombre_oficina_registro'];
$dire = $row1['direccion_oficina_registro'];
$nombre = $row1['nombre_oficina_registro'];
$correo = $row1['correo_oficina_registro'];
/*
$query = sprintf("SELECT * FROM boletin_orips where id_oficina_registro='$id' "); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
*/


?>
<!-- CODIGO PARA EXCEL http://www.phpzag.com/export-data-to-excel-with-php-and-mysql/ VER LINK
?php
ini_set('max_execution_time', 10000000);     // para aumentar el tiempo de ejecución


header('Content-Type: text/html; charset=utf-8');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte.xls")
?>-->



	<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
              <h3>0</h3>

              <p>Informacion 1</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
		  </div>
		  

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>0</h3>

              <p>Informacion 2</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>0<sup style="font-size: 20px"></sup></h3>

              <p>Informacion 3</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
		 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>0</h3>

              <p>Informacion 4</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		

      </div>
	
	
<div class="row">
<div class="col-md-9">
<div class="box box-info">

<form class="navbar-form" name="form1" method="post" action="">
<div class="row">
<div class="col-md-2">
<a href="nuevo_boletin_orip&<?php echo $id; ?>.jsp" class="btn btn-success" ><span class="glyphicon glyphicon-plus-sign"></span> Nuevo </a>
</div>

<script>
function next() {
document.getElementById("formnext").submit(); 
}
</script>


</div>
</form>

<a title="Exportar a Excel" href="boletin_orip&1.jsp"><img src="images/excel.png"></a>   
    
 <div class="box-body">
              <div class="table-responsive">
                <table id="boletin_orip" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Fecha del Informe</th>
                        <th>Oficina de Registro</th>
                        <th>Ingresos Recibidos En La Oficina</th>
                        
                        <th>Valor Recaudado En Bancos</th>
                        <th>Recaudado Por Datafono</th>
                        <th>Recaudado Extensiones Caja</th>
                        <th>Recaudado Por Vur</th>
                        <th>Total Ingresos Derechos Registro</th>
                        
                        <th>Recaudado En Bancos</th>
                        <th>Recaudado Por Datafono</th>
                        <th>Recaudado Extensiones Caja</th>
                        <th>Recaudado En Vur</th>
                        <th>Expedidos Por Otras ORIPS</th> 
                        <th>Recaudo Por Internet</th>
                        <th>Total Ingresos Por Certificados</th>
                        
                        <th>Volumetria Certificados</th>
                        <th>Volumetria Internet</th>
                        
                        <th>TOTAL INGRESOS ORDINARIOS</th>
                        
                        <th>Reproducción De Sellos</th>
                        <th>Sobrantes</th>
                        <th>Copias</th>

                        <th>Volumetria Copias</th>

                        <th>TOTAL INGRESOS EXTRAORDINARIOS</th>
                        
                        <th>Saldo Anticipado Que Viene</th>
                        <th>Anticipados Constituidos al Día</th>
                        <th>Anticipados Cancelados al Día</th>

                        <th>TOTAL SALDO DIARIO DEL ANTICIPADO</th> 

                        <th>Saldo Inicial en Bancos</th>
                        <th>Saldo Final en Bancos</th>

                        <th>TOTAL CONCILIACION DIARIA</th>

                        
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
    
   
<!-- /.box-header 
<div class="box-body">

<div class="table-responsive">

<table id="example1" class="table table-bordered table-striped">
<thead>        
<tr>
<th>Fecha del Informe</th>
<th>Oficina de Registro</th>
<th>Ingresos Recibidos En La Oficina</th>


<th>Valor Recaudado En Bancos</th>
<th>Recaudado Por Datafono</th>
<th>Recaudado Extensiones Caja</th>
<th>Recaudado Por Vur</th>
<th>Total Ingresos Derechos Registro</th>    


<th>Recaudado En Bancos</th>
<th>Recaudado Por Datafono</th>
<th>Recaudado Extensiones Caja</th>
<th>Recaudado En Vur</th>
<th>Expedidos Por Otras ORIPS</th> 
<th>Recaudo Por Internet</th>
<th>Total Ingresos Por Certificados</th>

<th>Volumetria Certificados</th>
<th>Volumetria Internet</th>

<th>TOTAL INGRESOS ORDINARIOS</th>



<th>Reproducción De Sellos</th>
<th>Sobrantes</th>
<th>Copias</th>

<th>Volumetria Copias</th>

<th>TOTAL INGRESOS EXTRAORDINARIOS</th>    



<th>Saldo Anticipado Que Viene</th>
<th>Anticipados Constituidos al Día</th>
<th>Anticipados Cancelados al Día</th>

<th>TOTAL SALDO DIARIO DEL ANTICIPADO</th> 



<th>Saldo Inicial en Bancos</th>
<th>Saldo Final en Bancos</th>



<th>TOTAL CONCILIACION DIARIA</th>
</tr>
</thead>
<tbody>
?php


if (0<$totalRows){
do {
$c1= $row["odr_mvrb"]; 
$c2= $row["odr_rd"]; 
$c3= $row["odr_rec"]; 
$c4= $row["odr_rv"]; 

$c5= $row["oc_ro"]; 
$c6= $row["oc_rd"]; 
$c7= $row["oc_rec"]; 
$c8= $row["oc_rv"]; 
$c9= $row["oc_eoo"]; 
$c10= $row["oc_ri"]; 

$c11= $row["ie_irs"]; 
$c12= $row["ie_is"]; 
$c13= $row["ie_ic"];

$c14= $row["a_sav"]; 
$c15= $row["a_consd"]; 
$c16= $row["a_cancd"];

$c17= $row["tiro"];  


echo '<tr>';	
echo '<td>'.$row['f_be'].'</td>';
echo '<td>'.$row['id_oficina_registro'].'</td>';
echo '<td>'.number_format((float)$row['tiro'],2,",",".").'</td>';

echo '<td>'.number_format((float)$row['odr_mvrb'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['odr_rd'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['odr_rec'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['odr_rv'],2,",",".").'</td>';
$ct=$c1+$c2+$c3+$c4; echo '<td>'.number_format((float)$ct,2,",",".").'</td>';               

echo '<td>'.number_format((float)$row['oc_ro'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['oc_rd'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['oc_rec'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['oc_rv'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['oc_eoo'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['oc_ri'],2,",",".").'</td>';
$ct2=$c5+$c6+$c7+$c8+$c9+$c10; echo '<td>'.number_format((float)$ct,2,",",".").'</td>';

echo '<td>'.$row['oc_vc'].'</td>';
echo '<td>'.$row['oc_vri'].'</td>';

$ctordinarios=$c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8+$c9+$c10; echo '<td>'.number_format((float)$ctordinarios,2,",",".").'</td>'; 

echo '<td>'.number_format((float)$row['ie_irs'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['ie_is'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['ie_ic'],2,",",".").'</td>';

echo '<td>'.$row['ie_vc'].'</td>';

$ct3=$c11+$c12+$c13; echo '<td>'.number_format((float)$ct3,2,",",".").'</td>';


echo '<td>'.number_format((float)$row['a_sav'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['a_consd'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['a_cancd'],2,",",".").'</td>';
$ct4=$c14+$c15-$c16; echo '<td>'.number_format((float)$ct4,2,",",".").'</td>';


echo '<td>'.number_format((float)$row['sib'],2,",",".").'</td>';
echo '<td>'.number_format((float)$row['sfb'],2,",",".").'</td>';


$ct5=$c17-$ct-$ct2-$ct3-$ct4; echo '<td>'.number_format((float)$ct5,2,",",".").'</td>';
   
echo '<td class="opciones">';
//echo '<a href="" title="Modificar Licencia"><img src="images/edit.png"></a> &nbsEnero
echo '</td>';

echo '<tr>';
} while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>		  

</tbody>
</table>
</div>




<!-- /.table-responsive 
</div>

<!-- /.box-footer -->
</div>
<!-- /.box -->
</div>


<div class="col-md-3">




<div class="box box-solid">
<div class="box-header with-border">
<h3 class="box-title"><b>Información</b></h3>

<div class="box-tools">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div>
</div>
<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked">

<li><a ><i class="glyphicon glyphicon-home"></i> ORIP    <span class="pull-right"> <?php echo $name; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-map-marker"></i> Departamento     <span class="pull-right"><?php echo $dep; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-map-marker"></i> Municipio <span class="pull-right"><?php echo $ciudad; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-user"></i> Registrador <span class="pull-right"><?php echo $nombre; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-envelope"></i> <span  style="font-size:80%" class="pull-right"><?php echo $correo; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-earphone"></i> Telefono <span class="pull-right"><?php echo $tele; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-phone"></i> Celular <span class="pull-right"><?php echo $celu; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-home"></i> Dirección <span style="font-size:13px" class="pull-right"><?php echo $dire; ?></span></a></li>

</ul>
</div>

</div>

      
		

<div class="box box-warning direct-chat direct-chat-warning" >
<div class="box-header with-border">
<h3 class="box-title">Recaudos al Año</h3>

<div class="box-tools pull-right">

<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>


</div>
</div>
<!-- /.box-header -->
<div class="box-body" >
<div class="direct-chat-messages" style="min-height:400px;">

<div id="chart"></div>

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
            ['data1', 100],
            ['data2', 0],
        ],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "Estadistica"
    }
});

setTimeout(function () {
    chart.load({
        columns: [
            ["Enero", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
            ["Febrero", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
            ["Marzo", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
            ["Abril", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
            ["Mayo", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
            ["Junio", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
            ["Julio", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
            ["Agosto", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
            ["Septiembre", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
            ["Octubre", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
            ["Noviembre", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
            ["Diciembre", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],

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

        
