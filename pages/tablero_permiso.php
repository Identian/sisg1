<?php
     // Total tomas reportadas
    global $mysqli;
    $tot_ausen = 0;
	
    $query17 = "SELECT ifnull(count(id_funcpermiso),0) AS tot_ausen
			  FROM funcpermiso 
			  WHERE id_funcpermiso > 0
              AND year(fecha_inicio) = year(SYSDATE())			  
			  AND estado_funcpermiso = 1 ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
		 $tot_ausen = $obj17['tot_ausen'];
    }
$result17->free();	

    // Total Citas Medicas = 1
    global $mysqli;
    $tot_cm1 = 0;
	
    $query19 = "SELECT count(id_funcpermiso) AS tot_cm1
			  FROM funcpermiso 
			  WHERE id_funcpermiso > 0 
			  AND year(fecha_inicio) = year(SYSDATE())
			  AND id_tipo_permiso = 1
			  AND estado_funcpermiso = 1 ";
    $result19 = $mysqli->query($query19);
    while ($obj19 = $result19->fetch_array()) {
		 $tot_cm1 = $obj19['tot_cm1'];
    }
$result19->free();	

    // Total permisos remunerados = 3
    global $mysqli;
    $tot_pr3 = 0;
	
    $query20 = "SELECT count(id_funcpermiso) AS tot_pr3
			  FROM funcpermiso 
			  WHERE id_funcpermiso > 0 
			  AND year(fecha_inicio) = year(SYSDATE())
			  AND id_tipo_permiso = 3
			  AND estado_funcpermiso = 1  ";
    $result20 = $mysqli->query($query20);
    while ($obj20 = $result20->fetch_array()) {
		 $tot_pr3 = $obj20['tot_pr3'];
    }
$result20->free();	

    // Total otros permisos
    global $mysqli;
    $tot_otrosau = 0;
	
    $query22 = "SELECT count(id_funcpermiso) AS tot_otrosau
			  FROM funcpermiso 
			  WHERE id_funcpermiso > 0 
			  AND year(fecha_inicio) = year(SYSDATE())
			  AND id_tipo_permiso not in(1,3) 
			  AND estado_funcpermiso = 1  ";
    $result22 = $mysqli->query($query22);
    while ($obj22 = $result22->fetch_array()) {
		 $tot_otrosau = $obj22['tot_otrosau'];
    }
$result22->free();	

$tot_pend = $tot_ausen - ($tot_cm1 + $tot_pr3); 
 
?>
 
 <div class="row">

<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-aqua">
<div class="inner">
<h3><?php echo $tot_ausen; ?></h3>

<p><?php echo utf8_encode('Total Permisos'); ?></p>
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
<h3><?php echo $tot_cm1; ?><sup style="font-size: 20px"></sup></h3>

<p><?php echo utf8_encode('Citas Médicas'); ?></p>
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
<h3><?php echo $tot_pr3; ?></h3>

<p><?php echo utf8_encode('Permisos Remunerados'); ?></p>
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
<h3><?php echo $tot_pend; ?></h3>

<p><?php echo utf8_encode('Otros Permisos'); ?></p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
<a href="#" class="small-box-footer"><?php echo utf8_encode('Más info..'); ?><i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
</div>

