<?php
     // Total tomas reportadas
    global $mysqli;
    $tot_gestores = 0;
	
    $query17 = "SELECT count(id_gestor_catastral) AS tot_gestores
			  FROM gestor_catastral 
			  WHERE id_gestor_catastral > 0 
			   AND estado_gestor_catastral = 1 ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
		 $tot_gestores = $obj17['tot_gestores'];
    }
$result17->free();	

    // Total Citas Medicas = 1
    global $mysqli;
    $tot_contratos = 0;
	
    $query19 = "SELECT count(id_contratos_gestor) AS tot_contratos
			  FROM contratos_gestor 
			  WHERE id_contratos_gestor > 0 
		      AND estado_contratos_gestor = 1 ";
    $result19 = $mysqli->query($query19);
    while ($obj19 = $result19->fetch_array()) {
		 $tot_contratos = $obj19['tot_contratos'];
    }
$result19->free();	

    // Total permisos remunerados = 3
    global $mysqli;
    $tot_contra1 = 0;
	
    $query20 = "SELECT count(id_contratos_gestor) AS tot_contra1
			  FROM contratos_gestor 
			  WHERE id_contratos_gestor > 0 
			  AND id_tipo_contrato_gestor = '1' 
		      AND estado_contratos_gestor = 1 ";
    $result20 = $mysqli->query($query20);
    while ($obj20 = $result20->fetch_array()) {
		 $tot_contra1 = $obj20['tot_contra1'];
    }
$result20->free();	

    // Total otros permisos
    global $mysqli;
    $tot_contra2 = 0;
	
    $query22 = "SELECT count(id_contratos_gestor) AS tot_contra2
			  FROM contratos_gestor 
			  WHERE id_contratos_gestor > 0 
			  AND id_tipo_contrato_gestor = '2' 
		      AND estado_contratos_gestor = 1 ";
    $result22 = $mysqli->query($query22);
    while ($obj22 = $result22->fetch_array()) {
		 $tot_contra2 = $obj22['tot_contra2'];
    }
$result22->free();	
 
?>
 
 <div class="row">

<div class="col-lg-3 col-xs-6">
<!-- small box -->
<div class="small-box bg-aqua">
<div class="inner">
<h3><?php echo $tot_gestores; ?></h3>

<p>Total Gestores</p>
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
<h3><?php echo $tot_contratos; ?><sup style="font-size: 20px"></sup></h3>

<p>Total Contratos</p>
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
<h3><?php echo $tot_contra1; ?></h3>

<p>Contratos Tipo 1</p>
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
<h3><?php echo $tot_contra2; ?></h3>

<p>Contratos Tipo 2</p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
<a href="#" class="small-box-footer"><?php echo utf8_encode('Más info..'); ?><i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
</div>

