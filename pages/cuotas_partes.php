<!DOCTYPE html>
<html lang="es">
<head>
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<?php

$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;

// $nump117=privilegios(117,$_SESSION['snr']);
//$nump117 = 100;

$nump66=privilegios(66,$_SESSION['snr']);
$nump68=privilegios(68,$_SESSION['snr']);


if (1==$_SESSION['rol'] or (0<$nump66 or 0<$nump68)) {

// consulta fecha de corte

$fecha_corte_ant_cp = '';
$fecha_corte_act_cp = '';
	
$query5 = mysql_query("SELECT * 
     FROM corte_cuota_parte 
	 WHERE id_corte_cuota_parte ='1' 
	 AND estado_corte_cuota_parte = 1 limit 1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($query5);
$total55 = mysql_num_rows($query5);

if (0<$total55) {
	$fecha_corte_ant_cp = $row15['fecha_corte_ant_cp'];
	$fecha_corte_act_cp = $row15['fecha_corte_act_cp'];
 }

// Registra nueva Entidad CP
// ***************************

if (isset($_POST['archperfun']) && $_POST['archperfun'] == 'archperfun') {

	$nombre_entidad_cuota_parte = $_POST['nombre_entidad_cuota_parte'];
    $nit_entidad = $_POST['nit_entidad'];
	$correo_entidad = $_POST['correo_entidad'];
	$telefono_entidad = $_POST['telefono_entidad'];
    
	$query = sprintf("SELECT count(id_entidad_cuota_parte) as tot_cp 
      FROM entidad_cuota_parte
      where nombre_entidad_cuota_parte = '$nombre_entidad_cuota_parte' 
      AND estado_entidad_cuota_parte = 1 "); 
    $select = mysql_query($query, $conexion);
    $rowt = mysql_fetch_assoc($select);
 if (0<$rowt['tot_cp']) {
	echo $repetido; 
 } else {		
	$insertSQL = sprintf("INSERT INTO entidad_cuota_parte (
      nombre_entidad_cuota_parte, nit_entidad, correo_entidad, telefono_entidad) 
	  VALUES (%s, %s, %s, %s)", 
      GetSQLValueString($nombre_entidad_cuota_parte, "text"),
      GetSQLValueString($nit_entidad, "text"),	  
	  GetSQLValueString($correo_entidad, "text"),
	  GetSQLValueString($telefono_entidad, "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
    }	 

//  echo '<meta http-equiv="refresh" content="0;URL= ./cuotas_partes.jsp" />';
 }	




// *************************************************
// Actualizar fecha de corte y generación períodos
// *************************************************

if (isset($_POST['actfechac']) && $_POST['actfechac'] == 'actfechac'){

    $fecha_corte_act_cp = $_POST['fecha_corte_act_cp'];
	$factor_periodo = $_POST['factor_periodo'];
    $anno_cp = 0;
	
    $updateSQL35 = sprintf("UPDATE corte_cuota_parte
	        SET fecha_corte_act_cp = %s,
			    fecha_corte_ant_cp = %s,
				factor_periodo = %s
			WHERE id_corte_cuota_parte = 1",
			GetSQLValueString($fecha_corte_act_cp, "date"),
			GetSQLValueString($fecha_corte_act_cp, "date"),
			GetSQLValueString($factor_periodo, "int"));
    $Result135 = mysql_query($updateSQL35, $conexion) or die(mysql_error());

    $query2 = sprintf("SELECT year(fecha_corte_act_cp) As anno_cp,
    fecha_corte_act_cp	
	FROM corte_cuota_parte 
	WHERE id_corte_cuota_parte = 1"); 
    $select2 = mysql_query($query2, $conexion);
    $row2 = mysql_fetch_assoc($select2);
    $anno_cp = $row2['anno_cp'];
	$fecha_periodo = $row2['fecha_corte_act_cp'];

    $query3 = sprintf("SELECT vr_salario_min 
	FROM salario_min_cp 
	WHERE anno_sal_min = '$anno_cp' 
	AND estado_salario_min_cp = 1"); 
    $select3 = mysql_query($query3, $conexion);
    $row3 = mysql_fetch_assoc($select3);
    $vr_salario_min = $row3['vr_salario_min'];
    $factor_sal_min = 15;
	$total_max = $vr_salario_min * $factor_sal_min;

// print_r("fecha periodo: ",$fecha_periodo);


// borra logicamente los registro del periodo que esta generando
	
   $query84 = "UPDATE periodo_cuota_parte set estado_periodo_cuota_parte = 0 WHERE fecha_periodo = '".$fecha_periodo."' ";  

   $Result1 = mysql_query($query84, $conexion);
	

	$query5 = "SELECT b.id_causante_cuota_parte, 
    b.id_entidad_cuota_parte, b.porce_participacion,	
	a.anno_cuota_parte, a.vr_pension, a.vr_cuota_parte
	FROM cuota_parte_anuales a 
	LEFT JOIN causante_cuota_parte  b 
	ON (a.id_causante_cuota_parte = b.id_causante_cuota_parte 
	  AND  b.estado_causante_cuota_parte = 1)
	WHERE a.anno_cuota_parte = '$anno_cp' 
	AND a.estado_cuota_parte_anuales = 1 ";
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
	 while ($row_reg = mysql_fetch_array($select5)) {
	    $id_estados_causante_cp = 0;
		$id_causante_cuota_parte = $row_reg['id_causante_cuota_parte'];
	    $query7 = "SELECT id_estados_causante_cp 
	               FROM causante_cuota_parte 
	               WHERE id_causante_cuota_parte = '$id_causante_cuota_parte' 
	               AND estado_causante_cuota_parte = 1 ";
        $select7 = mysql_query($query7, $conexion) or die(mysql_error());
	    while ($row_reg7 = mysql_fetch_array($select7)) {
		   $id_estados_causante_cp = $row_reg7['id_estados_causante_cp'];

	    }

        if ($id_estados_causante_cp == 1) {	// Causante Activo
        $id_causante_cuota_parte = $row_reg['id_causante_cuota_parte'];
		$id_entidad_cuota_parte = $row_reg['id_entidad_cuota_parte'];
		$porce_participacion = $row_reg['porce_participacion'];
		$anno_cuota_parte = $row_reg['anno_cuota_parte'];
		$vr_pension = $row_reg['vr_pension'];
		$vr_cuota_parte = $row_reg['vr_cuota_parte'];
		$vr_cuota_parte2 = $row_reg['vr_cuota_parte'];
		$vr_cuota_parte3 = 0;
		$nombre_periodo_cuota_parte = 'CUOTA PARTE PENSIONAL';
		$abono_cuota_parte = 0;
        $vr_intereses = 0;
		$abono_intereses = 0;
		$dias_mora = 0;
/*
	if ($factor_periodo > 1) {
		if ($vr_cuota_parte2 > $total_max) {
			$vr_cuota_parte2 = $total_max;
		}
		
	} else {
		$vr_cuota_parte2 = 0;
	}
*/

	if ($factor_periodo < 1) {
			$factor_periodo = 1;
		}

	if ($factor_periodo > 2) {
			$factor_periodo = 2;
		}

    $vr_cuota_parte3 = $vr_cuota_parte * $factor_periodo; 

		
	$insertSQL = sprintf("INSERT INTO periodo_cuota_parte (
      id_causante_cuota_parte, id_entidad_cuota_parte, 
	  nombre_periodo_cuota_parte, fecha_periodo,
	  factor_periodo, fecha_corte_periodo, vr_pension, 
	  porce_participacion, vr_cuota_parte, abono_cuota_parte, 
	  vr_intereses, abono_intereses, dias_mora) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
	  %s, %s, %s)", 
      GetSQLValueString($id_causante_cuota_parte, "int"), 
      GetSQLValueString($id_entidad_cuota_parte, "int"), 
	  GetSQLValueString($nombre_periodo_cuota_parte, "text"),
	  GetSQLValueString($fecha_periodo, "date"),
	  GetSQLValueString($factor_periodo, "int"),
	  GetSQLValueString($fecha_periodo, "date"),
	  GetSQLValueString($vr_pension, "text"),
	  GetSQLValueString($porce_participacion, "text"),
	  GetSQLValueString($vr_cuota_parte3, "text"),
	  GetSQLValueString($abono_cuota_parte, "text"),
	  GetSQLValueString($vr_intereses, "text"),
	  GetSQLValueString($abono_intereses, "text"),
	  GetSQLValueString($dias_mora, "text")
	  ); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
     }
	 }


	echo $hecho;
    		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./cuotas_partes.jsp" />';
 }


// *************************************************
// Genera y liquida dias de mora e intereses
// *************************************************

if (isset($_POST['genliqcp']) && $_POST['genliqcp'] == 'genliqcp'){


    $query2 = sprintf("SELECT year(fecha_corte_act_cp) As anno_cp,
    fecha_corte_act_cp	
	FROM corte_cuota_parte 
	WHERE id_corte_cuota_parte = 1"); 
    $select2 = mysql_query($query2, $conexion);
    $row2 = mysql_fetch_assoc($select2);
    $anno_cp = $row2['anno_cp'];
// 	$fecha_periodo = $row2['fecha_corte_act_cp'];
	$f_periodo = $row2['fecha_corte_act_cp'];

	$query64 = sprintf("update periodo_cuota_parte a
     join tasa_mensual_cp b 
     on (year(a.fecha_periodo) = year(b.fecha_tasa) 
	 AND   month(a.fecha_periodo) = month(b.fecha_tasa)
	 AND b.estado_tasa_mensual_cp = 1)   
     set a.tasa_mensual = b.tasa_mensual   
     WHERE estado_periodo_cuota_parte = 1; "); 
    $select64 = mysql_query($query64, $conexion) or die(mysql_error());
/*
	$query64 = sprintf("update periodo_cuota_parte
     set dias_mora =  DATEDIFF($fecha_periodo, fecha_periodo) 
     WHERE (vr_cuota_parte - abono_cuota_parte) > 0 
     AND estado_periodo_cuota_parte = 1; "); 
    $select64 = mysql_query($query64, $conexion) or die(mysql_error());


	$query64 = sprintf("update periodo_cuota_parte
     set vr_intereses = ((1 + (tasa_mensual / 100)) POW(TRUNCATE(dias_mora / 365)) * (vr_cuota_parte - abono_cuota_parte)) - (vr_cuota_parte - abono_cuota_parte)
     WHERE (vr_cuota_parte - abono_cuota_parte) > 0 
     AND estado_periodo_cuota_parte = 1; "); 
    $select64 = mysql_query($query64, $conexion) or die(mysql_error());
*/

     $deleteSQL = "UPDATE periodo_cp_tem set estado_periodo_cp_tem = 0";
     mysql_select_db($database_conexion, $conexion);
     $Result145 = mysql_query($deleteSQL, $conexion) or die(mysql_error());


	$query5 = "SELECT id_periodo_cuota_parte, 
	 tasa_mensual, fecha_periodo, vr_intereses, 
     (vr_cuota_parte - abono_cuota_parte) saldo_cp,
	 estado_cp, prescribe 
	FROM periodo_cuota_parte 
	WHERE (vr_cuota_parte - abono_cuota_parte) > 0 
	AND fecha_corte_periodo < '$f_periodo'
	AND estado_periodo_cuota_parte = 1 ";
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
	 while ($row_reg = mysql_fetch_array($select5)) {
        $id_periodo_cuota_parte = $row_reg['id_periodo_cuota_parte'];
		$tasa_mensual = $row_reg['tasa_mensual'];
		$saldo_cp = $row_reg['saldo_cp'];
		$fecha_periodo = $row_reg['fecha_periodo'];
		$vr_intereses5 = $row_reg['vr_intereses'];
        $vr_intereses = 0;
		$estado_cp = $row_reg['estado_cp'];
		$prescribe = $row_reg['prescribe'];

    $query4 = sprintf("SELECT DATEDIFF('$f_periodo', '$fecha_periodo') AS dias_mora"); 
    $select4 = mysql_query($query4, $conexion);
    $row4 = mysql_fetch_assoc($select4);
    $dias_mora = $row4['dias_mora'];


        $vr_intereses = intval((((1 + ($tasa_mensual / 100))^($dias_mora / 365) * $saldo_cp) - $saldo_cp) / 10);
//		$vr_intereses = ((1 + ($tasa_mensual / 100))^($dias_mora / 365) * $saldo_cp);
        
		if ($vr_intereses5 > 0) {
		   $vr_intereses = intval((((1 + ($tasa_mensual / 100))^(30 / 365) * $saldo_cp) - $saldo_cp) / 10);
		}
		
		if ($vr_intereses < 0) {
		$vr_intereses = $vr_intereses * - 1;	
		}
	
		if ($dias_mora <= 30) {
			$vr_intereses = 0;
			$dias_mora = 0;
		}
       
	if ($estado_cp == 3) { // prescritas
		$vr_intereses = 0;
		$dias_mora = 0;
	} 

	if ($prescribe >= 1) { // Solo intereses o ambas
		$vr_intereses = 0;
		$dias_mora = 0;
	} 
		
	$insertSQL = sprintf("INSERT INTO periodo_cp_tem (
      id_periodo_cuota_parte, vr_intereses, dias_mora) 
	  VALUES (%s, %s, %s)", 
      GetSQLValueString($id_periodo_cuota_parte, "int"), 
      GetSQLValueString($vr_intereses, "text"),
	  GetSQLValueString($dias_mora, "int")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
?>	  

<?php
// barra de progreso

/*Establecemos un número aleatorio entre 1 y 3000*/
$num = rand(1,3000);
/*Establecemos un número aleatorio entre 1 y el número que se genera aleatoriamente*/
$porcentaje = rand(1,$num);
/*Calculamos el porcentaje con los valores anteriores, y lo mostramos sin decimales*/
$resporcentaje = round(($porcentaje/$num) *100,0);
/*Imprimimos los resultados en texto*/
echo "El $porcentaje es el $resporcentaje% de $num";
?>

<style type="text/CSS">
/*Establecemos al ancho y alto del div exterior. Además le daremos un tamaño al borde y un color*/    
.divexterior{
    height: 25px;
    width: 400px;
    border: solid 1px #000;
}
/*Establecemos el div interior. Como ancho le vamos a dar el valor de la variable $resporcentaje. Este div lo vamos a colorear un con gradiente*/
.divinterior{
    height: 25px;
    width: <?php echo $resporcentaje; ?>%;
    border-right: solid 1px #000;
    color: #fff;
    background: rgb(2,0,36);
    background: linear-gradient(86deg, rgba(2,0,36,1) 0%, rgba(181,181,214,1) 0%, rgba(0,212,255,1) 100%);
}
</style>

<!--Estos div los utilizaremos para crear la barra de progreso. El exterior será el borde que se verá por fuera y el interior será el que se va a colorear con un gradiente de azules-->

<div class="divexterior">
    <div class="divinterior"><?php echo $resporcentaje; ?>%</div>
</div>

<?php 
//	  
	  

	 }

	$query64 = sprintf("update periodo_cuota_parte a
     join periodo_cp_tem b 
     on (a.id_periodo_cuota_parte = b.id_periodo_cuota_parte 
	 AND b.estado_periodo_cp_tem = 1)
     set a.vr_intereses = a.vr_intereses + b.vr_intereses,
         a.dias_mora = b.dias_mora, a.fecha_corte_periodo = '$f_periodo' 	 
     WHERE estado_periodo_cuota_parte = 1; "); 
    $select64 = mysql_query($query64, $conexion) or die(mysql_error());


	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./cuotas_partes.jsp" />';
 }



 
// *************************************************
// Actualizar Entidad
// *************************************************

if (isset($_POST['modientidad']) && $_POST['modientidad'] == 'modientidad'){

    $id_entidad_cuota_parte = $_POST['id_entidad_cuota_parte2'];
	$nombre_entidad_cuota_parte = $_POST['nombre_entidad_cuota_parte2'];
	$nit_entidad = $_POST['nit_entidad2'];
	$correo_entidad = $_POST['correo_entidad2'];
	$telefono_entidad = $_POST['telefono_entidad2'];

    $updateSQL35 = sprintf("UPDATE entidad_cuota_parte
	        SET nombre_entidad_cuota_parte = %s,
			    nit_entidad = %s,
				correo_entidad = %s,
				telefono_entidad = %s
			WHERE id_entidad_cuota_parte = %s",
			GetSQLValueString($nombre_entidad_cuota_parte, "text"),
			GetSQLValueString($nit_entidad, "text"),
			GetSQLValueString($correo_entidad, "text"),
			GetSQLValueString($telefono_entidad, "text"),
			GetSQLValueString($id_entidad_cuota_parte, "int"));
    $Result135 = mysql_query($updateSQL35, $conexion) or die(mysql_error());

	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./cuotas_partes.jsp" />';
 }
 

// eliminar registro

if (isset($_GET["i"]) && ""!=$_GET["i"]) {
    $id_entidad_cuota_parte = intval($_GET["i"]);
	
    $query5 = sprintf("SELECT count(*) As totcausante  
	FROM causante_cuota_parte 
	WHERE id_entidad_cuota_parte = '$id_entidad_cuota_parte'  
	AND   estado_causante_cuota_parte = 1 "); 
    $select5 = mysql_query($query5, $conexion);
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    $totcausante = $row5['totcausante'];
	
if ($totcausante > 0) { 

$noborrar='<script type="text/javascript">swal(" ERROR!", " Esta Entidad tiene Causantes... NO se puede borrar..!!!", "error"); </script>';

echo $noborrar; 


} else {


   $query84 = "UPDATE entidad_cuota_parte SET estado_entidad_cuota_parte = 0  WHERE id_eval_funcionario_edl = ".$id_entidad_cuota_parte." limit 1";  
 
   $Result1 = mysql_query($query84, $conexion);

   echo $actualizado;

 } 
}

include('tablero_cuotas_partes.php');
 
?> 
 

<div class="row">
  <div class="col-md-12">
    <nav class="navbar navbar-default" style="background:#fff;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
			
          </button>
		  <p style="font-size: 20px"><b>CUOTAS PARTES - LIQUIDACIÓN</b></p>
        </div>
      </div>
    </nav>
  </div>
</div>

	  
	  
	  
<div class="row">
<div>

 <div class="box box-info">
  <div class="box-header with-border">
 <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
  <div class="col-md-1">
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#creaperfun"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Entidad</button>&nbsp;
  </div>
  
	<div class="col-md-2">
    	<div class="input-group-btn">
	        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#activ_periodo"><span class="glyphicon glyphicon-list-alt"></span>GENERACIÓN PERÍODOS</button>&nbsp;
        </div>
	</div>	

	<div class="col-md-2">
    	<div class="input-group-btn">
	        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#liqui_periodo"><span class="glyphicon glyphicon-list-alt"></span>LIQUIDACIÓN PERÍODOS</button>&nbsp;
        </div>
	</div>	
 <?php } ?>

	<div class="col-md-2">

                    <li class="nav-item dropdown" style="list-style:none !important; float:left;">
                      
                      <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <b>Opciones CP</b>
                      </a>
                    
	                  <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 500;">
  				        <?php
                              $query = sprintf("SELECT *
					                   FROM opcion_cuota_parte 
					                   WHERE estado_opcion_cuota_parte=1 order by id_opcion_cuota_parte"); 
                              $select = mysql_query($query, $conexion) or die(mysql_error());
                              $row = mysql_fetch_assoc($select);
                              $totalRows = mysql_num_rows($select);
                              if (0<$totalRows){
                                 do { 
								  $nprog = $row['nombre_url_cp'];
								  $nopcion = $row['nombre_opcion_cuota_parte'];
                              ?>
					              
                              <a class="dropdown-item" width="1200px;" href="<?php echo $nprog; ?>"><?php echo utf8_encode($nopcion); ?></a><br>
                              <?php
               				   } while ($row = mysql_fetch_assoc($select)); 
                               } else {}	 
                               mysql_free_result($select);
				        ?> 
                      </div>
                    </li>
 	</div>	
    <div id="projects_table_filter" class="dataTables_filter">
	<form action="" method="POST" name="for585858m1" > 
      <div class="input-group">
        <div class="input-group-btn">
          <select class="form-control" name="campo" required>
            <option value="" selected> - - Buscar por: - -  </option>
 		    <option value="nit_cp">N I T</option>
		    <option value="entidad_cp">Entidad</option>
			<option value="correo_cp">Correo</option>
          </select>
        </div>
        <div class="input-group-btn"><input type="text" name="buscar" placeholder="Buscar" class="form-control" required >
		</div>
        <div class="input-group-btn">
            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
        </div>
      </div>
	  </form>
      </div>

<div class="row">
<div class="col-md-12">
  
    <div class="box-body">
	<style>
     .dataTables_filter {
     display:true;
     }
	</style>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_cuotaspar" class="dataTables_filter">
           <thead>
                <tr style = "color: black">
                  <th>Id CP</th>
				  <th>NIT</th>
				  <th>Entidad</th>
                  <th>Correo Electrónico</th>
                  <th>Teléfono</th>
                 <th colspan="4">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php
			  $datobus = ' ';
			  if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
	            $nom_campo = $_POST['campo'];
				$vr_campo = "'%".$_POST['buscar']."%'";
				if ($nom_campo == 'nit_cp'){
					$nom_campo = 'a.nit_entidad';
				}
				if ($nom_campo == 'entidad_cp'){
					$nom_campo = 'a.nombre_entidad_cuota_parte';
				}
				if ($nom_campo == 'correo_cp'){
					$nom_campo = 'a.correo_entidad';
				}
			    $datobus = ' AND '.$nom_campo.' LIKE '.$vr_campo;
			  }	  
				  
//			print_r("campo: ".$datobus);
			
              $query87 = "SELECT a.id_entidad_cuota_parte, a.nombre_entidad_cuota_parte, 
			                      a.nit_entidad, a.correo_entidad, a.telefono_entidad  
                             	  FROM entidad_cuota_parte a 
                          WHERE a.estado_entidad_cuota_parte = 1 
						  ".$datobus." limit 500 ";
              $select87 = mysql_query($query87, $conexion) or die(mysql_error());
              while($row_reg = mysql_fetch_array($select87)) {
            ?>
          <tr style = "color: black">
		     <?php 
			 $id_entidad_cuota_parte = $row_reg['id_entidad_cuota_parte'];
		     $nombre_entidad_cuota_parte = $row_reg['nombre_entidad_cuota_parte'];
			 $nit_entidad = $row_reg['nit_entidad'];
			 $correo_entidad = $row_reg['correo_entidad'];
			 $telefono_entidad = $row_reg['telefono_entidad'];

			$sw5 = 0;
			
	         ?>
             <td><?php echo $id_entidad_cuota_parte; ?></td>
			 <td><?php echo $nit_entidad; ?></td>
			 <td><?php echo $nombre_entidad_cuota_parte; ?></td>
<!--			 <td style = "display: none"><?php echo $fecha_concertacion; ?></td> -->
             <td><?php echo $correo_entidad; ?></td>
             <td><?php echo $telefono_entidad; ?></td>
			 <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
        	 <td>
                <button type="button" class="btn btn-info btn-xs modimebtn" title="Actualizar Entidad"><span  class="glyphicon glyphicon-hand-up"></span></button>&nbsp;
             </td> 
             <td style="color:#000000;">
                <a href="cuotas_partes&<?php echo $id_entidad_cuota_parte; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar registro"  ><span class="glyphicon glyphicon-trash"></span></a>
             </td>
			<?php } ?> 
			<?php } ?>
          </tr>

      <?php } 
	  mysql_free_result($select87);
	  ?> <!-- CIERRE PRIMER WHILE -->

          <script>

              $(document).ready(function() {
            $('#tab_cuotaspar').DataTable({
              "lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
//			    searching: true,
//				 paging: true,
//				 "bFilter": true,
//               "dom": 'pfrtip',
//			   "searchPanes": {
//				 "paging": true,
//                 "searching": true				 
//			   },
//			  "sSearch":         "Buscar:",
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              }
            });
          });

          </script>
		  <script>
$(document).on('keyup', "input[type='search']", function(){ 	
$('#tab_cuotaspar').DataTable.fnFilter($(this).value); });
</script> 
            </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
	</div>
	</div>
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->



<?php
// Generacion de periodos de evaluacion
// *************************************
?>

<div class="modal fade"  id="periodos_edl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"  style="color:#000000;"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>PERIODOS DE EVALUACION - EDL</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4377224"  enctype="multipart/form-data">

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA DESDE:</label>   
      <input type="date" class="form-control" name="fechaper_desde" id="fechaper_desde" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA HASTA:</label>   
      <input type="date" class="form-control" name="fechaper_hasta" id="fechaper_hasta" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">NOMBRE DEL PERIODO:</label>   
      <input type="text" class="form-control" name="nombre_periodos_edl" id="nombre_periodos_edl" value="" required >
    </div>

    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="creaperiodo" id="creaperiodo" value="creaperiodo">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<?php
// Fecha de corte y Generación períodos
// *****************************************
?>

<div class="modal fade"  id="activ_periodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"  style="color:#000000;"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>GENERACIÓN PERÍODOS - CUOTA PARTE</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224"  enctype="multipart/form-data">
<!--
    <input type="hidden" class="form-control" name="id_funcionario2" id="id_funcionario2" readonly="readonly" value="<?php // echo $id_funcionario2; ?>">
    <input type="hidden" class="form-control" name="id_cargo2" id="id_cargo2" readonly="readonly" value="<?php // echo $id_cargo; ?>">
-->
    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Anterior:</label>   
      <input type="date" class="form-control" name="fecha_corte_ant_cp" id="fecha_corte_ant_cp" value="<?php echo $fecha_corte_ant_cp; ?>" readonly="readonly" >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Período (fin de mes):</label>   
      <input type="date" class="form-control" name="fecha_corte_act_cp" id="fecha_corte_act_cp" value="" onChange = "valfechas();" required >
    </div>
    	
    <div class="form-group text-left"> 
      <label  class="control-label">Factor de Pago (1 o 2):</label>   
      <input type="number" class="form-control" name="factor_periodo" id="factor_periodo" value="" required >
    </div>
 
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actfechac" value="actfechac">
        <span class="glyphicon glyphicon-ok"></span>Guardar y Generar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>



<?php
// Liquidación períodos
// ***********************
?>

<div class="modal fade"  id="liqui_periodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"  style="color:#000000;"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>LIQUIDACIÓN PERÍODOS - CUOTA PARTE</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224"  enctype="multipart/form-data">
<!--
    <input type="hidden" class="form-control" name="id_funcionario2" id="id_funcionario2" readonly="readonly" value="<?php // echo $id_funcionario2; ?>">
    <input type="hidden" class="form-control" name="id_cargo2" id="id_cargo2" readonly="readonly" value="<?php // echo $id_cargo; ?>">

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Anterior:</label>   
      <input type="date" class="form-control" name="fecha_corte_ant_cp" id="fecha_corte_ant_cp" value="<?php // echo $fecha_corte_ant_cp; ?>" readonly="readonly" >
    </div>
-->
    <div class="form-group text-left"> 
      <label  class="control-label">Período Actual:</label>   
      <input type="date" class="form-control" name="fecha_corte_act_cp" id="fecha_corte_act_cp" value="<?php echo $fecha_corte_act_cp; ?>" readonly='readonly' >
    </div>
    	
    <div class="form-group text-left"> 
      <label  class="control-label">Cálculo de días de mora e Intereses por cada Cuota Parte !!!</label>   
    </div>
 
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="genliqcp" value="genliqcp">
        <span class="glyphicon glyphicon-ok"></span>Generar y Liquidar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<!-- Modal: modifica Entidad  -->
<div class="modal fade" id="modifienti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>MODIFICACION ENTIDAD</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">
                   
				   <input type="hidden" name="id_entidad_cuota_parte2" id="id_entidad_cuota_parte2"   value="" >
				   
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>NIT Entidad:</label>   
	                    <input type="text"  class="form-control" id="nit_entidad2" name="nit_entidad2" value="" required >
                   </div>
   
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Entidad:</label>   
	                    <input type="text"  class="form-control" id="nombre_entidad_cuota_parte2" name="nombre_entidad_cuota_parte2" value="" required >
                   </div>
   
                    <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Correo Electrónico:</label>   
	                    <input type="text"  class="form-control" id="correo_entidad2" name="correo_entidad2" value="" required >
                   </div>
    
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Teléfono Entidad:</label>   
	                    <input type="text"  class="form-control" id="telefono_entidad2" name="telefono_entidad2" value=""  onChange = "valpeso();" required >
                   </div>

                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="modientidad" value="modientidad">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
 
				</form>
              </div>
          </div> 
     </div> 
</div> 



<!-- Modal: crear Entidad -->
<div class="modal fade" id="creaperfun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="color:#000000;"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>NUEVA ENTIDAD</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">

<!--				   <input type="hidden" name="id_funcionario_jefe_inme" id="id_funcionario_jefe_inme"   value="<?php echo $id_funcionario2; ?>" > -->

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>NIT Entidad:</label>   
                        <input type="text" class="form-control" name="nit_entidad" id="nit_entidad" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Entidad:</label>   
                        <input type="text" class="form-control" name="nombre_entidad_cuota_parte" id="nombre_entidad_cuota_parte" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Correo electrónico:</label>   
                        <input type="text" class="form-control" name="correo_entidad" id="correo_entidad" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Teléfono:</label>   
                        <input type="text" class="form-control" name="telefono_entidad" id="telefono_entidad" value="" required >
                   </div>

                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="archperfun" value="archperfun">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
				</form>
              </div>
          </div> 
     </div> 
</div> 

<div class="modal fade" id="infobcecpsp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>BCE CUOTAS PARTES SIN PRESCRIBIR</b></h4>
              </div> 
              <div id="nAventura" class="modal-body"> 

                   <form action="" method="POST" name="form3">
<!--
				         <input type="hidden" name="id_notaria2" id="id_notaria2"   value="<?php // echo $id; ?>" >
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Año Desde (AAAA):</label> 
                              <input type="number" class="form-control" id="anno_desde2"  name="anno_desde2" value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Año Hasta (AAAA):</label> 
                              <input type="number" class="form-control" id="anno_hasta2"  name="anno_hasta2" onchange ="valrango();" value="" required >
                         </div>
-->						     
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Desea Generarlo (S/N):</label> 
                              <input type="text" class="form-control" id="cpsn2"  name="cpsn2" value="" required >
                         </div>

                		 <div class="modal-footer">
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="genrepsp" value="genrepsp">
                              <span class="glyphicon glyphicon-ok"></span>Generar</button></br>
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div>

<div class="modal fade" id="infobcecppr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>BCE CUOTAS PARTES PRESCRITAS</b></h4>
              </div> 
              <div id="nAventura" class="modal-body"> 

                   <form action="" method="POST" name="form3">
<!--
				         <input type="hidden" name="id_notaria2" id="id_notaria2"   value="<?php // echo $id; ?>" >
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Año Desde (AAAA):</label> 
                              <input type="number" class="form-control" id="anno_desde2"  name="anno_desde2" value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Año Hasta (AAAA):</label> 
                              <input type="number" class="form-control" id="anno_hasta2"  name="anno_hasta2" onchange ="valrango();" value="" required >
                         </div>
-->						     
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Desea Generarlo (S/N):</label> 
                              <input type="text" class="form-control" id="cpsn2"  name="cpsn2" value="" required >
                         </div>

                		 <div class="modal-footer">
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="genreppr" value="genreppr">
                              <span class="glyphicon glyphicon-ok"></span>Generar</button></br>
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div>

<?php

// Balance EXCEL sin prescribir
 
if (isset($_POST['genrepsp']) && $_POST['genrepsp'] == 'genrepsp') {
/*
    $id_notaria = $_POST['id_notaria2'];
	$anno_desde = $_POST['anno_desde2'];
	$anno_hasta = $_POST['anno_hasta2'];
	$annos = $anno_desde.'-'.$anno_hasta;
*/
    $cpsn2 = $_POST['cpsn2'];	
	if (strtoupper($cpsn2) == 'S') {
//       echo '<meta http-equiv="refresh" content="0;URL=xls/repbce_cp&'.$id_notaria.'&'.$annos.'.xls" />';
	   echo '<meta http-equiv="refresh" content="0;URL=xls/repbce_cpsp.xls" />';
	}
 }

// Balance EXCEL prescritas 
 
if (isset($_POST['genreppr']) && $_POST['genreppr'] == 'genreppr') {
/*
    $id_notaria = $_POST['id_notaria2'];
	$anno_desde = $_POST['anno_desde2'];
	$anno_hasta = $_POST['anno_hasta2'];
	$annos = $anno_desde.'-'.$anno_hasta;
*/
    $cpsn2 = $_POST['cpsn2'];	
	if (strtoupper($cpsn2) == 'S') {
//       echo '<meta http-equiv="refresh" content="0;URL=xls/repbce_cp&'.$id_notaria.'&'.$annos.'.xls" />';
	   echo '<meta http-equiv="refresh" content="0;URL=xls/repbce_cppr.xls" />';
	}
 } 
 
 
 ?>



<?php

 function lista2($table, $id) {
		
global $mysqli;
$query5 = "SELECT id_".$table.", nombre_".$table."  FROM ".$table." where  id_".$table." in (".$id.") ";
$result5 = $mysqli->query($query5);
while ($obj = $result5->fetch_array()) {
	$infoid='id_'.$table;
	$infonombre ='nombre_'.$table;
	$nom = $obj[$infonombre];
	$codifi = mb_detect_encoding($nom, "UTF-8, ISO-8859-1");
	$infonombre = iconv($codifi, 'UTF-8', $nom);
	
    printf ("<option value='%s'>%s</option>\n", $obj[$infoid], $infonombre);
 }

$result5->free();

}

 
 ?>
 


<script>
     $(document).ready(function() {
      $('.modimebtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#modifienti").modal("show");
          $('#id_entidad_cuota_parte2').val(data[0]);
          $('#nit_entidad2').val(data[1]);
		  $('#nombre_entidad_cuota_parte2').val(data[2]);
          $('#correo_entidad2').val(data[3]);
          $('#telefono_entidad2').val(data[4]);
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.editbtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#modiausen").modal("show");
          $('#id_ausentismo').val(data[0]);
		  $('#id_funcionario_jefe2').val(data[1]);
          $('#id_funcionario2').val(data[2]);
		  $('#nombre_funcionario2').val(data[3]);
		  $('#id_tipo_ausentismo2').val(data[4]);
		  $('#nombre_tipo_ausentismo2').val(data[5]);
          $('#mfecha_inicio2').val(data[6]);
		  $('#mfecha_final2').val(data[7]);
		  $('#id_funcionario_reempla2').val(data[8]);
		  $('#id_tipo_ausentismo2').val(data[9]);
		  $('#id_aprobacion_ausentismo2').val(data[10]);
//		  $('#nombre_aprobacion_ausentismo').val(data[11]);
		  $('#motivo_ausentismo2').val(data[12]);
		  $('#hora_inicio2').val(data[13]);
		  $('#hora_final2').val(data[14]);
		  $('#id_tipo_oficina2').val(data[15]);
		  $('#id_grupo_area2').val(data[16]);
		  $('#id_oficina_registro2').val(data[17]);
          $('#nombre_funcionario_reem2').val(data[18]);
		  
		  //		alert("difer: " + diasdif);
        if(data[6] == data[7]) {
			hdesde2.style.display='block';
			hhasta2.style.display='block';
         } else {
			document.getElementById('hora_inicio2').value = '00:00:00';
			document.getElementById('hora_final2').value = '00:00:00';
		 }
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.aprobjdtr').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#aprojedtr").modal("show");
          $('#id_ausentismo3').val(data[0]);
		  $('#id_funcionario_jefe3').val(data[1]);
          $('#id_funcionario3').val(data[2]);
		  $('#nombre_funcionario3').val(data[3]);
		  $('#id_tipo_ausentismo3').val(data[4]);
		  $('#nombre_tipo_ausentismo3').val(data[5]);
          $('#mfecha_inicio3').val(data[6]);
		  $('#mfecha_final3').val(data[7]);
		  $('#id_funcionario_reempla3').val(data[8]);
		  $('#id_tipo_ausentismo3').val(data[9]);
		  $('#id_aprobacion_ausentismo3').val(data[10]);
//		  $('#nombre_aprobacion_ausentismo3').val(data[11]);
		  $('#motivo_ausentismo3').val(data[12]);
		  $('#hora_inicio3').val(data[13]);
		  $('#hora_final3').val(data[14]);
		  $('#id_tipo_oficina3').val(data[15]);
		  $('#id_grupo_area3').val(data[16]);
		  $('#id_oficina_registro3').val(data[17]);
		  $('#nombre_funcionario_reem3').val(data[18]);
		  
        if(data[6] == data[7]) {
			hdesde3.style.display='block';
			hhasta3.style.display='block';
         } else {
			document.getElementById('hora_inicio3').value = '00:00:00';
			document.getElementById('hora_final3').value = '00:00:00';
		 }
		 

      jsofireg();
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.aprobtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#aprscrgral").modal("show");
          $('#id_ausentismo4').val(data[0]);
          $('#id_funcionario_jefe4').val(data[1]);
		  
          $('#nombre_funcionario4').val(data[3]);
          $('#nombre_tipo_ausentismo4').val(data[5]);
          $('#mfecha_inicio4').val(data[6]);
          $('#mfecha_final4').val(data[7]);
		  $('#id_funcionario_reempla4').val(data[8]);
		  $('#id_aprobacion_ausentismo4').val(data[10]);
		  $('#motivo_ausentismo4').val(data[12]);
		  $('#id_tipo_oficina4').val(data[15]);
		  $('#id_grupo_area4').val(data[16]);
		  $('#id_oficina_registro4').val(data[17]);
          $('#nombre_funcionario_reem4').val(data[18]); 
		  });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.rhaprobtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#aprrecurh").modal("show");
          $('#id_ausentismo5').val(data[0]);
          $('#id_funcionario_jefe5').val(data[1]);
		  
          $('#nombre_funcionario5').val(data[3]);
          $('#nombre_tipo_ausentismo5').val(data[5]);
          $('#mfecha_inicio5').val(data[6]);
          $('#mfecha_final5').val(data[7]);
		  $('#id_funcionario_reempla5').val(data[8]);
		  $('#id_aprobacion_ausentismo5').val(data[10]);
		  $('#motivo_ausentismo5').val(data[12]);
		  $('#id_tipo_oficina5').val(data[15]);
		  $('#id_grupo_area5').val(data[16]);
		  $('#id_oficina_registro5').val(data[17]);
          $('#nombre_funcionario_reem5').val(data[18]);
      });  
    });

</script>


<script>
    function valtipofun() {
	var tipo_funcionario = document.getElementById('tipo_funcionario').value;
	var id_funcionario2 = document.getElementById('id_funcionario2').value;
		if ( tipo_funcionario > 0) {
			funconsul.style.display='block';
			document.getElementById('id_funcionario_edl').focus();
		} else {
			funconsul.style.display='none';
			document.getElementById('id_funcionario_edl').value = id_funcionario2;
			document.getElementById('tipo_funcionario').focus();
        }
    }
</script>

<script>
    function valjefeinme() {
        var jefe_inme = document.getElementById('id_funcionario_jefe_inme').value;
		var id_funcionario = document.getElementById('id_funcionario3').value;
		var jefeyfun = jefe_inme+'-'+id_funcionario;	 			
        jQuery.ajax({
        type: "POST",url: "pages/valijefeinme.php",
		data: "valjinme="+jefeyfun,
		async: true,
         success: function(b) {
			   var sw5 = b * 1;
//			   alert('sw5 = ' + sw5);  
			   if (sw5 > 0) {
				alert('Cargo del Jefe inmediato es menor al del Funcionario....!!!');  
                document.getElementById('id_funcionario_jefe_inme').focus();				
			   } else {
				  document.getElementById('id_funcionario_jefe_area').focus(); 
			   }
               
         }
        });				
    }
</script>

<script>
    function valjefearea() {
        var jefe_area = document.getElementById('id_funcionario_jefe_area').value;
		var id_funcionario = document.getElementById('id_funcionario').value;
		var jefeyfun = jefe_area+'-'+id_funcionario;	 			
        jQuery.ajax({
        type: "POST",url: "pages/valijefeinme.php",
		data: "valjinme="+jefeyfun,
		async: true,
         success: function(b) {
			   var sw5 = b * 1;
			   if (sw5 > 0) {
				alert('Cargo del Jefe Area es menor al del Funcionario....!!!');  
//                document.getElementById('id_funcionario_jefe_area').focus();				
			   } else {
				  document.getElementById('id_funcionario_jefe_area').focus(); 
			   }
               
         }
        });				
    }
</script>

<script>
    function valtraslape() {
//		 alert('entro a la func '); 
        var periodo_desde = document.getElementById('periodo_desde').value;
		var periodo_hasta = document.getElementById('periodo_hasta').value;
		var id_funcionario = document.getElementById('id_funcionario3').value;
		var varios = id_funcionario+'*'+periodo_desde+'*'+periodo_hasta;	 			
        jQuery.ajax({
        type: "POST",url: "pages/valrangoper.php",
		data: "varios="+varios,
		async: true,
         success: function(total) {
			    var data = total.split('*');
//				alert('data0 = ' + data[0]);  
                if (data[0] > 0) {
				alert('Rango de fechas incluidas en otro: '+data[2]+' y '+data[3]+' Evaluador: '+data[1]);  
                document.getElementById('periodo_desde').focus();				
			   } else {
				  document.getElementById('proposito_empleo').focus(); 
			   }
               
         }
        });	
    }
</script>

<script>
    function valfechas() {
        var fecha_corte = document.getElementById('fecha_corte_act_cp').value;
		var fecha_anterior = document.getElementById('fecha_corte_ant_cp').value;
        jQuery.ajax({
        type: "POST",url: "pages/vfecha_cuota_parte.php",
		data: "fecha_corte="+fecha_corte,
		async: true,
         success: function(b) {
//			  alert("b: "+b);
			 if (Math.abs(Number(b)) > 31) {
			   alert("Fecha mayor a 30 dias...!!!");
			   document.getElementById('fecha_corte_act_cp').value = fecha_anterior;
               document.getElementById('fecha_corte_act_cp').focus();
			 } else {
				document.getElementById('fecha_corte_act_cp').focus(); 
			 }  
         }
        });				
    }
</script>


 
<?php  

function periodosedl() {
	global $mysqli;
	$query = "SELECT * FROM periodos_edl WHERE estado_periodos_edl=1 ";
    $resultado = $mysqli->query($query);
	 while ($obj = $resultado->fetch_object()) {
        printf ("<option value='%s'>%s</option>\n", $obj->id_periodos_edl, $obj->fechaper_desde. ' - '.$obj->fechaper_hasta);
    }
}

function subalternos($id_grupo_area) {
		
global $mysqli;
$query5 = "SELECT id_funcionario, nombre_funcionario  
FROM funcionario 
WHERE  id_grupo_area = $id_grupo_area 
AND estado_funcionario = 1 ";
$result5 = $mysqli->query($query5);
while ($obj = $result5->fetch_array()) {
//	$nom = $obj[$infonombre];
//	$codifi = mb_detect_encoding($nom, "UTF-8, ISO-8859-1");
//	$infonombre = iconv($codifi, 'UTF-8', $nom);
	
    printf ("<option value='%s'>%s</option>\n", $obj->id_funcionario, $obj->nombre_funcionario);
 }

/*
function listas() {
	global $mysqli;
	$query = "SELECT * FROM perfil where estado_perfil=1 ";
$resultado = $mysqli->query($query);
	 while ($obj = $resultado->fetch_object()) {
        printf ("<option value='%s'>%s</option>\n", $obj->id_perfil, $obj->nombre_perfil);
    }
*/

$result5->free();
}


// Registra periodos de evaluacion
// ********************************

if (isset($_POST['creaperiodo'])) {

    $fechaper_desde = $_POST['fechaper_desde'];
    $fechaper_hasta = $_POST['fechaper_hasta'];
	$nombre_periodos_edl = $_POST['nombre_periodos_edl'];


	$insertSQL = sprintf("INSERT INTO periodos_edl (
      nombre_periodos_edl, fechaper_desde, fechaper_hasta) 
	  VALUES (%s, %s, %s)", 
      GetSQLValueString($nombre_periodos_edl, "text"), 
	  GetSQLValueString($fechaper_desde, "date"),
	  GetSQLValueString($fechaper_hasta, "date")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
		 
    echo '<meta http-equiv="refresh" content="0;URL= ./edl_fun.jsp" />';

 }




// *************************************************
// Registro de Perfil de trabajo 
// *************************************************

if (isset($_POST['activperfil'])){

      $id_funcionario = $_POST['id_funcionario2'];
//	  $id_cargo = $_POST['id_cargo2'];
//      $id_periodos_edl = $_POST['id_periodos_edl'];
	  $tipo_funcionario = $_POST['tipo_funcionario'];
//	  $id_funcionario_edl = $_POST['id_funcionario_edl'];

    if ($tipo_funcionario == 0) {
	    $id_funcionario_edl = $_POST['id_funcionario2'];
    }
/*
      $nombre_periodos_edl = ' ';
	  $fechaper_desde = ' ';
	  $fechaper_hasta = ' ';

	$query7 = sprintf("SELECT * FROM periodos_edl
                  where id_periodos_edl = '$id_periodos_edl' 
				  and estado_periodos_edl = 1 "); 
    $select7 = mysql_query($query7, $conexion) or die(mysql_error());
    $row7 = mysql_fetch_assoc($select7);
    $totalRows7 = mysql_num_rows($select7);
    if ($totalRows7 > 0){
       $nombre_periodos_edl = $row7['nombre_periodos_edl'];
	   $fechaper_desde = $row7['fechaper_desde'];
	   $fechaper_hasta = $row7['fechaper_hasta'];
   }
*/

    $updateSQL37 = sprintf("UPDATE perfil_activo_edl 
	        SET tipo_funcionario = %s		
			WHERE id_funcionario = %s",                  
	GetSQLValueString($tipo_funcionario, "int"),
	GetSQLValueString($id_funcionario, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

/*			
      $insertSQL = sprintf("INSERT INTO periodo_activo_edl ( 
		    id_funcionario, nombre_periodo_activo_edl, 
			id_periodos_edl, fechaper_desde, fechaper_hasta,
			id_funcionario_edl, tipo_funcionario) 
            VALUES (%s, %s, %s, %s, %s, %s, %s)", 
            GetSQLValueString($id_funcionario, "int"), 
            GetSQLValueString($nombre_periodos_edl, "text"),
			GetSQLValueString($id_periodos_edl, "int"),
            GetSQLValueString($fechaper_desde, "date"),
            GetSQLValueString($fechaper_hasta, "date"),
			GetSQLValueString($id_funcionario_edl, "int"),
			GetSQLValueString($tipo_funcionario, "int"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
*/		

	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./edl_fun.jsp" />';
 }

// } else {}
 
?>

 
