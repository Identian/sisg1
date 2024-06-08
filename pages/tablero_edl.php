<?php
     // Total tomas reportadas
    global $mysqli;
    $tot_eva = 0;
	$tot_rea = 0;
	$tot_area = 0;
	$fecha_desde = ' ';
	$fecha_hasta = ' ';
	
    $query17 = "SELECT * FROM periodos_edl
                WHERE periodo_activo_edl = 1 
				AND estado_periodos_edl = 1 ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
       $fecha_desde = $obj17['fechaper_desde'];
	   $fecha_hasta = $obj17['fechaper_desde'];
    }
$result17->free();	

    // Total Citas Medicas = 1
    global $mysqli;
    $tot_cm1 = 0;
	
    $query19 = "SELECT count(id_eval_funcionario_edl) AS tot_eva
			  FROM eval_funcionario_edl 
			  WHERE id_eval_funcionario_edl > 0 
			  AND periodo_desde >= $fecha_desde
			  AND periodo_hasta <= $fecha_hasta
			  AND estado_funcionario_edl = 1 ";
    $result19 = $mysqli->query($query19);
    while ($obj19 = $result19->fetch_array()) {
		 $tot_eva = $obj19['tot_eva'];
    }
$result19->free();	

    // Total evaluaciones realizadas
    global $mysqli;
    $tot_pr3 = 0;
	
    $query20 = "SELECT count(id_eval_funcionario_edl) AS tot_rea
			  FROM eval_funcionario_edl 
			  WHERE id_eval_funcionario_edl > 0 
			  AND periodo_desde >= $fecha_desde
			  AND periodo_hasta <= $fecha_hasta
			  AND estado_eva_jime = 1
			  AND estado_eva_jarea = 1
			  AND estado_funcionario_edl = 1 ";
    $result20 = $mysqli->query($query20);
    while ($obj20 = $result20->fetch_array()) {
		 $tot_rea = $obj20['tot_rea'];
    }
$result20->free();	


$tot_pend = $tot_eva - $tot_rea; 
 
    // Total del Area
    global $mysqli;
    $tot_pr3 = 0;
	
    $query20 = "SELECT count(id_eval_funcionario_edl) AS tot_area
			  FROM eval_funcionario_edl 
			  WHERE id_eval_funcionario_edl > 0 
			  AND periodo_desde >= $fecha_desde
			  AND periodo_hasta <= $fecha_hasta
			  AND (id_funcionario_jefe_inme = '$id_funcionario' 
			     OR id_funcionario_jefe_area = '$id_funcionario')
			  AND estado_funcionario_edl = 1 ";
    $result20 = $mysqli->query($query20);
    while ($obj20 = $result20->fetch_array()) {
		 $tot_area = $obj20['tot_area'];
    }
$result20->free();	
 
 
 
?>
 
 <div class="row">

<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-aqua">
<div class="inner">
<h3><?php echo $tot_eva; ?></h3>

<p><?php echo utf8_encode('Total Evaluaciones del Período'); ?></p>
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
<h3><?php echo $tot_rea; ?><sup style="font-size: 20px"></sup></h3>

<p><?php echo utf8_encode('Evaluaciones Realizadas'); ?></p>
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
<h3><?php echo $tot_pend; ?></h3>

<p><?php echo utf8_encode('Pendientes por Evaluación'); ?></p>
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
<h3><?php echo $tot_area; ?></h3>

<p><?php echo utf8_encode('Total del Area'); ?></p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
<a href="#" class="small-box-footer"><?php echo utf8_encode('Más info..'); ?><i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
</div>

