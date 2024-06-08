<?php
     // Total Entidades
    global $mysqli;
    $tot_cp = 0;
	
    $query17 = "SELECT count(id_entidad_cuota_parte) AS tot_cp
			  FROM entidad_cuota_parte 
			  WHERE id_entidad_cuota_parte > 0
              AND estado_entidad_cuota_parte = 1 ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
		 $tot_cp = $obj17['tot_cp'];
    }
$result17->free();	

    // Total Causantes
    global $mysqli;
    $tot_causante = 0;
	
    $query19 = "SELECT count(id_causante_cuota_parte) AS tot_causante
			  FROM causante_cuota_parte 
			  WHERE id_causante_cuota_parte > 0 
			  AND estado_causante_cuota_parte = 1 ";
    $result19 = $mysqli->query($query19);
    while ($obj19 = $result19->fetch_array()) {
		 $tot_causante = $obj19['tot_causante'];
    }
$result19->free();	

    // Ultima fecha de corte
    global $mysqli;
    $fecha_corte = '';
	
    $query20 = "SELECT fecha_corte_act_cp AS fecha_corte
			  FROM corte_cuota_parte 
			  WHERE id_corte_cuota_parte > 0 
			  AND estado_corte_cuota_parte = 1  ";
    $result20 = $mysqli->query($query20);
    while ($obj20 = $result20->fetch_array()) {
		 $fecha_corte = $obj20['fecha_corte'];
    }
$result20->free();	

    // Ultimo salario minimo
    global $mysqli;
    $max_sal_minimo = 0;
	$tot_sal = '';
    $query22 = "SELECT vr_salario_min, max(anno_sal_min) AS max_sal_minimo
			  FROM salario_min_cp 
			  WHERE id_salario_min_cp > 0 
			  AND estado_salario_min_cp = 1 
			  GROUP BY vr_salario_min ";
    $result22 = $mysqli->query($query22);
    while ($obj22 = $result22->fetch_array()) {
		 $vr_salario_min = $obj22['vr_salario_min'];
		 $max_sal_minimo = $obj22['max_sal_minimo'];
		 $tot_sal = $max_sal_minimo.' : '.number_format($vr_salario_min,0);
    }
$result22->free();	
 
?>
 
 <div class="row">

<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-aqua">
<div class="inner">
<h3><?php echo $tot_cp; ?></h3>

<p><?php echo utf8_encode('Total Entidades'); ?></p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
<a href="#" class="small-box-footer"><?php echo utf8_encode('Más info..'); ?><i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-green">
<div class="inner">
<h3><?php echo $tot_causante; ?><sup style="font-size: 20px"></sup></h3>

<p><?php echo utf8_encode('Total Causantes'); ?></p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a href="#" class="small-box-footer"><?php echo utf8_encode('Más info..'); ?><i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-yellow">
<div class="inner">
<h3><?php echo $fecha_corte; ?></h3>

<p><?php echo utf8_encode('Fecha Última de Corte'); ?></p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
<a href="#" class="small-box-footer"><?php echo utf8_encode('Más info..'); ?><i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-red">
<div class="inner">
<h3><?php echo $tot_sal; ?></h3>

<p><?php echo utf8_encode('último Salario Mínimo'); ?></p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
<a href="#" class="small-box-footer"><?php echo utf8_encode('Más info..'); ?><i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
</div>

