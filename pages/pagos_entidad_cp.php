<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<?php

$nump66=privilegios(66,$_SESSION['snr']);
$nump68=privilegios(68,$_SESSION['snr']);

function php_console_log( $data, $comment = NULL ) {	
    $output='';	
    if(is_string($comment))
        $output .= "<script>console.warn( '$comment' );";
    elseif($comment!=NULL)
        $comment==NULL;//Si se pasa algo que no sea un string se pone a NULL para que no de problemas
    if ( is_array( $data ) ) {
        if($comment==NULL)
            $output .= "<script>console.warn( 'Array PHP:' );";
        $output .= "console.log( '[" . implode( ',', $data) . "]' );</script>";
    } else if ( is_object( $data ) ) {
        $data    = var_export( $data, TRUE );
        $data    = explode( "\n", $data );
        if($comment==NULL)
            $output .= "<script>console.warn( 'Objeto PHP:' );";
        foreach( $data as $line ) {
            if ( trim( $line ) ) {
                $line    = addslashes( $line );
                $output .= "console.log( '{$line}' );";
            }
        }
        $output.="</script>";
    } else {
        if($comment==NULL)
            $output .= "<script>console.warn( 'Valor de variable PHP:' );";
        $output .= "console.log( '$data' );</script>";
    }
        
    echo $output;
}
     
if (isset($_GET['i']) && (1==$_SESSION['rol'] or (0<$nump66 or 0<$nump68))) {
	
	$id_causante_cuota_parte = $_GET['i'];
  
//   if (isset($_GET['i'])) {
	
   

   $id_causante_cuota_parte = intval($_GET['i']);


// *********************************
// Registra nuevo pago Cuota Parte
// ***********************************

if (isset($_POST['insertcp']) and $_POST['insertcp'] == 'insertcp') {
    $fecha_desde = (isset($_POST['fecha_desde']))? $_POST['fecha_desde']: null;
//  $fecha_desde = $_POST['fecha_desde'];
	$resolucion = (isset($_POST['resolucion']))? $_POST['resolucion']: null;
	$id_causante_cuota_parte = $_POST['id_causante_cuota_parte'];
    $id_entidad_cuota_parte = $_POST['id_entidad_cuota_parte'];
	$nombre_pago_cuota_parte = 'PAGO CUOTA PARTE';
    $fecha_pago = $_POST['fecha_pago'];
	$num_cpbte = $_POST['num_cpbte'];
	$vr_pago = $_POST['vr_pago'];
    $vr_pago2 = $_POST['vr_pago'];
	$abono_cp = 0;
	$abono_intereses = 0;
	
	  $query15 = "SELECT year('".$fecha_desde."') AS anno_desde,
                 month('".$fecha_desde."') AS mes_desde "; 
  $select15 = mysql_query($query15, $conexion);
  $rowt15 = mysql_fetch_assoc($select15);
  $anno_desde = $rowt15['anno_desde'];
  $mes_desde = $rowt15['mes_desde'];

          $query86 = "UPDATE periodo_cuota_parte SET estado_cp = 2 
           WHERE (year(fecha_periodo) <= ".$anno_desde."  
		   AND month(fecha_periodo) <= ".$mes_desde.")  
           AND estado_periodo_cuota_parte = 1 
           AND id_causante_cuota_parte = ".$id_causante_cuota_parte;  
          $Result1 = mysql_query($query86, $conexion);

	
  $query = sprintf("SELECT count(id_pago_cuota_parte) as tot_cp 
  FROM pago_cuota_parte
  where id_causante_cuota_parte = '$id_causante_cuota_parte' 
  AND fecha_pago = '$fecha_pago' 
  AND num_cpbte = '$num_cpbte'  
  AND estado_pago_cuota_parte = 1 "); 
  $select = mysql_query($query, $conexion);
  $rowt = mysql_fetch_assoc($select);
  
  if (0<$rowt['tot_cp']) {
	echo $repetido; 
  } else {
	  
	$insertSQL = sprintf("INSERT INTO pago_cuota_parte (
      id_causante_cuota_parte, id_entidad_cuota_parte, 
	  nombre_pago_cuota_parte, fecha_pago, fecha_desde,
      resolucion, num_cpbte, vr_pago) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($id_causante_cuota_parte, "int"), 
      GetSQLValueString($id_entidad_cuota_parte, "int"), 
	  GetSQLValueString($nombre_pago_cuota_parte, "text"),
	  GetSQLValueString($fecha_pago, "date"),
	  GetSQLValueString($fecha_desde, "date"),
	  GetSQLValueString($resolucion, "text"),
	  GetSQLValueString($num_cpbte, "text"),
	  GetSQLValueString($vr_pago, "number")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

    $id_pago_cuota_parte = mysql_insert_id($conexion);

    $query2 = sprintf("SELECT year(fecha_corte_act_cp) As anno_cp,
    fecha_corte_act_cp	
	FROM corte_cuota_parte 
	WHERE id_corte_cuota_parte = 1"); 
    $select2 = mysql_query($query2, $conexion);
    $row2 = mysql_fetch_assoc($select2);
    $anno_cp = $row2['anno_cp'];
	$f_periodo = $row2['fecha_corte_act_cp'];

	$query5 = "SELECT id_periodo_cuota_parte, 
    (vr_cuota_parte - abono_cuota_parte) As saldo_cp,
	 (vr_intereses - abono_intereses) As saldo_intereses
	FROM periodo_cuota_parte 
	WHERE id_causante_cuota_parte = '$id_causante_cuota_parte' 
	AND (vr_cuota_parte - abono_cuota_parte) > 0 
	AND estado_cp in(1)  
	AND estado_periodo_cuota_parte = 1 
	ORDER BY fecha_periodo ";
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
	 while ($row_reg = mysql_fetch_array($select5)) {
		$id_periodo_cp = $row_reg['id_periodo_cuota_parte'];
        $saldo_cp = $row_reg['saldo_cp'];	
        $saldo_intereses = $row_reg['saldo_intereses'];
		if ($vr_pago2 > 0) {
        if ($saldo_intereses <= $vr_pago2) {
			$abono_intereses = $saldo_intereses;
			$vr_pago2 = $vr_pago2 - $abono_intereses;
		} else {
			$abono_intereses = $vr_pago2;
			$abono_cp = 0;
			$vr_pago2 = 0;
		}

        if ($saldo_cp <= $vr_pago2) {
			$abono_cp = $saldo_cp;
			$vr_pago2 = $vr_pago2 - $abono_cp;
		} else {
			$abono_cp = $vr_pago2;
			$vr_pago2 = 0;
		}
    if ($abono_cp > 0 or $abono_intereses > 0 ) {
    $nombre_pago_detalle_cp = 'Detalle pago';
	$insertSQL2 = sprintf("INSERT INTO pago_detalle_cp (
      id_periodo_cuota_parte, id_causante_cuota_parte, 
	  id_pago_cuota_parte, nombre_pago_detalle_cp, 
	  abono_cp_detalle, abono_inter_cp_detalle) 
	  VALUES (%s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($id_periodo_cp, "int"), 
      GetSQLValueString($id_causante_cuota_parte, "int"), 
	  GetSQLValueString($id_pago_cuota_parte, "int"),
	  GetSQLValueString($nombre_pago_detalle_cp, "text"),
	  GetSQLValueString($abono_cp, "text"),
	  GetSQLValueString($abono_intereses, "text")); 
      $Result2 = mysql_query($insertSQL2, $conexion) or die(mysql_error());
	  
	  $abono_cp = 0;
	  $abono_intereses = 0;
    }


// lo nuevo


// Carga la distribución del detalle del pago con la vista consol_cuota_parte

	$query64 = sprintf("update periodo_cuota_parte a
     join consol_cuota_parte b 
     on a.id_periodo_cuota_parte = b.id_periodo_cuota_parte   
     set a.abono_cuota_parte = b.tot_abono,
         a.abono_intereses = b.tot_inter, a.fecha_corte_periodo = '$f_periodo'  
     WHERE a.id_causante_cuota_parte = b.id_causante_cuota_parte 
	 AND a.id_periodo_cuota_parte = b.id_periodo_cuota_parte; "); 
    $select64 = mysql_query($query64, $conexion) or die(mysql_error());

     }
    }
//	$resultado5->free();



	echo $hecho;

  }		 

//	echo '<meta http-equiv="refresh" content="0;URL= ./pagos_entidad_cp&'.$id_causante_cuota_parte.'.jsp" />';
 }	

// Modifica Causante
// ******************

if (isset($_POST['actcausante']) and $_POST['actcausante'] == 'actcausante') {

	$id_causante_cuota_parte = $_POST['id_causante_cuota_parte'];
    $id_entidad_cuota_parte = $_POST['id_entidad_cuota_parte'];
 	$id_tipo_documento_causante = $_POST['id_tipo_documento_causante'];
	$cedula_causante = $_POST['cedula_causante'];
	$nombre_causante_cuota_parte = $_POST['nombre_causante_cuota_parte'];
	$id_tipo_documento_sustituto = $_POST['id_tipo_documento_sustituto'];
	$cedula_sustituto = $_POST['cedula_sustituto'];
	$nombre_sustituto_cuota_parte = $_POST['nombre_sustituto_cuota_parte'];
	$porce_participacion = $_POST['porce_participacion'];
	$num_resolucion = $_POST['num_resolucion'];
	$fecha_causacion = $_POST['fecha_causacion'];
	$fecha_status_juridico = $_POST['fecha_status_juridico'];


    $updateSQL37 = sprintf("UPDATE causante_cuota_parte 
	        SET id_entidad_cuota_parte = %s,	
			id_tipo_documento_causante = %s,
			cedula_causante = %s,
			nombre_causante_cuota_parte = %s,
			id_tipo_documento_sustituto = %s,
			cedula_sustituto = %s,
			nombre_sustituto_cuota_parte = %s,
			porce_participacion = %s,
			num_resolucion = %s,
			fecha_causacion = %s,
			fecha_status_juridico = %s
			WHERE id_causante_cuota_parte = %s",                  
	GetSQLValueString($id_entidad_cuota_parte, "int"),
	GetSQLValueString($id_tipo_documento_causante, "int"),
	GetSQLValueString($cedula_causante, "text"),
	GetSQLValueString($nombre_causante_cuota_parte, "text"),
	GetSQLValueString($id_tipo_documento_sustituto, "int"),
	GetSQLValueString($cedula_sustituto, "text"),
	GetSQLValueString($nombre_sustituto_cuota_parte, "text"),
	GetSQLValueString($porce_participacion, "text"),
	GetSQLValueString($num_resolucion, "text"),
	GetSQLValueString($fecha_causacion, "date"),
	GetSQLValueString($fecha_status_juridico, "date"),
	GetSQLValueString($id_causante_cuota_parte, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_causante_cp&'.$id_causante_cuota_parte.'.jsp" />';

 }

// Modifica pago Cuota Parte
// ********************************

if (isset($_POST['modificpa']) and $_POST['modificpa'] == 'modificpa') {

	$id_pago_cuota_parte = $_POST['id_pago_cuota_parte2'];
    $fecha_pago = $_POST['fecha_pago2'];
	$num_cpbte = $_POST['num_cpbte2'];

    $updateSQL37 = sprintf("UPDATE pago_cuota_parte 
	        SET fecha_pago = %s,	
			num_cpbte = %s
			WHERE id_pago_cuota_parte = %s",                  
	GetSQLValueString($fecha_pago, "date"),
	GetSQLValueString($num_cpbte, "text"),
	GetSQLValueString($id_pago_cuota_parte, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_causante_cp&'.$id_causante_cuota_parte.'.jsp" />';

 }

if (isset($_POST['borrarcpa']) and ""!=$_POST['borrarcpa'] and isset($_POST['borraridcpa']) and ""!=$_POST['borraridcpa']) {
  echo borcuotapar($_POST["borrarcpa"], $_POST["borraridcpa"]);
// echo borrarcpa('cuota_parte_anuales', 2);
} else {}
		

    $query4 = sprintf("SELECT a.id_entidad_cuota_parte, b.nombre_entidad_cuota_parte,
                      a.id_tipo_documento_causante, a.id_tipo_documento_sustituto,
                      c.nombre_tipo_documento	ntipo_docto_causante,
                      d.nombre_tipo_documento	ntipo_docto_sustituto,					  
	                  a.cedula_causante, a.cedula_sustituto,
                      a.nombre_causante_cuota_parte, a.nombre_sustituto_cuota_parte,					  
					  a.porce_participacion, a.num_resolucion, a.fecha_causacion,
	                  a.fecha_status_juridico
                      FROM causante_cuota_parte a 
			          LEFT JOIN entidad_cuota_parte b
					  ON a.id_entidad_cuota_parte = b.id_entidad_cuota_parte
					  LEFT JOIN tipo_documento c
					  ON a.id_tipo_documento_causante = c.id_tipo_documento 
					  LEFT JOIN tipo_documento d
					  ON a.id_tipo_documento_sustituto = d.id_tipo_documento 
                      WHERE a.id_causante_cuota_parte = '$id_causante_cuota_parte' 
					  AND a.estado_causante_cuota_parte = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
	$id_entidad = $row4['id_entidad_cuota_parte'];
	$nombre_entidad = $row4['nombre_entidad_cuota_parte'];
    $id_tipo_documento_causante = $row4['id_tipo_documento_causante'];
	$id_tipo_documento_sustituto = $row4['id_tipo_documento_sustituto'];
    $ntipo_docto_causante = $row4['ntipo_docto_causante'];
	$ntipo_docto_sustituto = $row4['ntipo_docto_sustituto'];
	$cedula_causante = $row4['cedula_causante'];
	$cedula_sustituto = $row4['cedula_sustituto'];
	$nombre_causante = $row4['nombre_causante_cuota_parte'];
	$nombre_sustituto = $row4['nombre_sustituto_cuota_parte'];
	$porce_participacion = $row4['porce_participacion'];
	$num_resolucion = $row4['num_resolucion'];
	$fecha_causacion = $row4['fecha_causacion'];
	$fecha_status_juridico = $row4['fecha_status_juridico'];
 }

// borra pago entidad_cuota_parte

if (isset($_GET["e"]) && ""!=$_GET["e"]) {
    $id_pago_cuota_parte = intval($_GET["e"]);
	
    $query5 = sprintf("SELECT count(*) As totpagos  
	FROM pago_cuota_parte 
	WHERE id_pago_cuota_parte = '$id_pago_cuota_parte'  
	AND   estado_pago_cuota_parte = 1 "); 
    $select5 = mysql_query($query5, $conexion);
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    $totpagos = $row5['totpagos'];
	
if ($totpagos > 0) { 

    $query22 = sprintf("SELECT *   
	FROM pago_detalle_cp  
    WHERE id_pago_cuota_parte = '$id_pago_cuota_parte'  
	AND estado_pago_detalle_cp = 1 "); 
    $select22 = mysql_query($query22, $conexion) or die(mysql_error());
	while ($row22 = mysql_fetch_assoc($select22)) {
                $id_pago_detalle_cp = $row22['id_pago_detalle_cp'];		
				$id_periodo_cuota_parte = $row22['id_periodo_cuota_parte'];
				$abono_cp_detalle = $row22['abono_cp_detalle'];
				$abono_inter_cp_detalle = $row22['abono_inter_cp_detalle'];
				
   $query84 = "UPDATE periodo_cuota_parte SET 
   abono_cuota_parte = abono_cuota_parte - ".$abono_cp_detalle." ,
   abono_intereses = abono_intereses - ".$abono_inter_cp_detalle."     
   WHERE id_periodo_cuota_parte = ".$id_periodo_cuota_parte." limit 1";  
   $Result1 = mysql_query($query84, $conexion);

	}

   $query86 = "UPDATE pago_cuota_parte SET estado_pago_cuota_parte = 0 
   WHERE id_pago_cuota_parte = ".$id_pago_cuota_parte." limit 1";  
   $Result1 = mysql_query($query86, $conexion);

   $query87 = "UPDATE pago_detalle_cp SET estado_pago_detalle_cp = 0 
   WHERE id_pago_cuota_parte = ".$id_pago_cuota_parte." limit 1";  
   $Result1 = mysql_query($query87, $conexion);
	
   echo $actualizado;

} else {
 } 
}

//


    $anno_cp = 0;
	$vr_cuota_parte = 0;

	$query2 = sprintf("SELECT id_causante_cuota_parte, max(anno_cuota_parte) anno_cp,
	max(vr_cuota_parte) valor_cp
	FROM cuota_parte_anuales 
	WHERE id_causante_cuota_parte = '$id_causante_cuota_parte' 
	and estado_cuota_parte_anuales=1
	GROUP BY id_causante_cuota_parte "); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);
    $anno_cp = $row2['anno_cp'];
	$vr_cuota_parte = number_format($row2['valor_cp']); // para mostrar en Cabecera

    mysql_free_result($select2);

  

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
		</div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			    <li><a href="consulta_causante_cp&<?php echo $id_causante_cuota_parte; ?>.jsp"><b>PAGOS ENTIDAD CUOTA PARTE</b></a></li>
            </ul>
        </div>
		 
      </div>
    </nav>
  </div>
</div>	  
	  
<div class="row">

    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Entidad:</label>   
                       <?php echo utf8_encode($nombre_entidad); ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Nombre Causante:</label>   
                       <?php echo $cedula_causante.' - '.$nombre_causante; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Nombre Sustituto:</label>   
                       <?php echo $cedula_sustituto.' - '.$nombre_sustituto; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Porcentaje Participación:</label>   
                       <?php echo $porce_participacion; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Num Resolución:</label>   
                       <?php echo $num_resolucion; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Fecha Causanción:</label>   
                       <?php echo $fecha_causacion; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Fecha Estatus Jurídico:</label>   
                       <?php echo $fecha_status_juridico; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Cuota Parte Anual:</label>   
                       <?php echo $anno_cp.' - $'.$vr_cuota_parte; ?>
				    </div>  
				</div>  
             </div>
        </div>
  </div>
  </div>
</div> 




 <?php
 // ************************************
 // Detalle de Pago Cuota Parte
 // ************************************
 ?>
 
 		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'Pago Cuota Parte'; ?>
					   </h4> 
					<?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
					<div class="col-md-4">
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#npagofun"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Pago Cuota Parte</a> 
					   </h4> 
					</div>
					<?php } ?>
                    <div class="col-md-4">
	                   <a href="distri_pagos_cp&<?php echo $id_causante_cuota_parte; ?>.jsp" type="button" class="btn btn-warning btn-sm" ><span class="glyphicon glyphicon-list-alt"></span> DISTRIBUCIÓN PAGOS</a>
                    </div>
                    <div class="row">
                      <div class="col-md-12">

                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID Reg</th>
                                <th>ID Causante</th>
								<th>Causante</th>
								<th>Sustituto</th>
								<th>Fecha Pago</th>
								<th>Num Compbte</th>
								<th>Valor Pago</th>
                                <th colspan="4">Accion</th>
                             </tr>
                </thead>
            <tbody>

            <?php
               $query62 = sprintf("SELECT a.id_pago_cuota_parte, 
			    a.id_causante_cuota_parte, b.nombre_causante_cuota_parte,
				b.nombre_sustituto_cuota_parte,  
				a.fecha_pago, a.num_cpbte, a.vr_pago  
	            FROM pago_cuota_parte a  
				LEFT JOIN causante_cuota_parte b 
				ON a.id_causante_cuota_parte = b.id_causante_cuota_parte 
                WHERE a.id_causante_cuota_parte = '$id_causante_cuota_parte'  
				AND a.estado_pago_cuota_parte = 1 ORDER BY a.fecha_pago "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
//			    $id_causante_cuota_parte = $row62['id_causante_cuota_parte'];
				$id_pago_cuota_parte = $row62['id_pago_cuota_parte'];
				
			    $query64 = sprintf("SELECT ifnull(sum(abono_inter_cp_detalle + abono_cp_detalle),0) abonos 
	            FROM pago_detalle_cp  
                WHERE id_pago_cuota_parte = '$id_pago_cuota_parte'			
				AND estado_pago_detalle_cp = 1 "); 
                $select64 = mysql_query($query64, $conexion) or die(mysql_error());
				$row64 = mysql_fetch_assoc($select64)
            ?>
          <tr>
             <td><?php echo $row62['id_pago_cuota_parte']; ?></td>
             <td><?php echo $row62['id_causante_cuota_parte']; ?></td>
             <td><?php echo utf8_encode($row62['nombre_causante_cuota_parte']);?></td> 
			 <td><?php echo utf8_encode($row62['nombre_sustituto_cuota_parte']);?></td> 
			 <td><?php echo $row62['fecha_pago']; ?></td>
			 <td><?php echo $row62['num_cpbte']; ?></td>
			 <td><?php echo number_format($row62['vr_pago']); ?></td>
			 <td style = "display: none"><?php echo number_format($row62['abono_inter']); ?></td>
			 <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
             <td>
				<button type="button" class="btn btn-info btn-xs modimebtn" title="Modificación Pago Cuota Parte"><span  class="glyphicon glyphicon-hand-up"></span></button>&nbsp;
             </td>
			 <?php if (1==$_SESSION['rol'] or 0<$nump66) { $id_causante_cuota_parte = $_GET['i']; ?>
			   <!-- <a style="color:#ff0000;cursor: pointer" title="Borrar" name="pago_cuota_parte" id="<?php echo $row62['id_pago_cuota_parte']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a> -->
			 <td style="color:#000000;">
                <a href="pagos_entidad_cp&<?php echo $id_causante_cuota_parte; ?>&<?php echo $id_pago_cuota_parte; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar registro"  ><span class="glyphicon glyphicon-trash"></span></a>
             </td>

			 <?php } ?>
			 <?php } ?>
         </tr>
          <?php } ?> 
          </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div>
</div><!-- col-md-12 -->
</div>
</div><!-- col-md-12 -->

<?php

// ********************************
// Nuevo Pago Cuota Parte
// ********************************
?>
<div class="modal fade" id="npagofun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVO PAGO CUOTA PARTE</b><span style="font-weight: bold;"></span></h4>
</div> 

<div class="modal-body"> 
  <form action="" method="POST" name="form43114555"  enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_causante_cuota_parte" name="id_causante_cuota_parte" value="<?php echo $id_causante_cuota_parte; ?>">
	<input type="hidden" class="form-control" id="id_entidad_cuota_parte" name="id_entidad_cuota_parte" value="<?php echo $id_entidad; ?>">

    <div class="form-group text-left"> 
        <label  class="control-label">Causante:</label>   
        <input type="text" class="form-control" name="nombre_causante" id="nombre_causante" value="<?php echo $nombre_causante; ?>" readonly = "readonly" >
    </div>

<!--	<div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Entidad:</label> 
        <select class="form-control" name="id_entidad_cuota_parte" id="id_entidad_cuota_parte" required >
        <option value="" selected></option>
        <?php echo lista('entidad_cuota_parte'); ?>
        </select>
    </div>
-->
    <div class="form-group text-left"> 
        <label  class="control-label">Entidad:</label>   
        <input type="text" class="form-control" name="nombre_entidade" id="nombre_entidad" value="<?php echo $nombre_entidad; ?>" readonly = "readonly" >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Fecha Desde (Por Prescribir):</label>   
        <input type="date" class="form-control" name="fecha_desde" id="fecha_desde" value="" >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Num Resolución:</label>   
        <input type="text" class="form-control" name="resolucion" id="resolucion" value="" >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Fecha Pago:</label>   
        <input type="date" class="form-control" name="fecha_pago" id="fecha_pago" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Num Compbte:</label>   
        <input type="text" class="form-control" name="num_cpbte" id="num_cpbte" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Valor Pago:</label>   
        <input type="number" class="form-control" name="vr_pago" id="vr_pago" value="" required >
    </div>

	<div class="modal-footer">
        <span style="color:#ff0000;">(*) Campos obligatorios</span>
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="insertcp" value="insertcp">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 

<!-- Modal: modifica Pago Cuota Parte -->
<div class="modal fade" id="modificp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>MODIFICACION PAGO CUOTA PARTE</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">
                   
				   <input type="hidden" name="id_pago_cuota_parte2" id="id_pago_cuota_parte2"   value="" >
				   
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Causante:</label>   
                        <input type="text" class="form-control" name="nombre_causante2" id="nombre_causante2" value="" readonly ="readonly" >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Fecha Pago:</label>   
                        <input type="date" class="form-control" name="fecha_pago2" id="fecha_pago2" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Num Compbte:</label>   
                        <input type="text" class="form-control" name="num_cpbte2" id="num_cpbte2" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Valor Pago:</label>   
                        <input type="number" class="form-control" name="vr_pago2" id="vr_pago2" value="" readonly ="readonly" >
                   </div>

                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="modificpa" value="modificpa">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
				</form>
              </div>
          </div> 
     </div> 
</div> 

<form method="POST" action="" name="borrar_cpa">
<input type="hidden" name="borraridcpa" id="borraridcpa" value="">
<input type="hidden" name="borrarcpa" id="borrarcpa" value="">

<?php
	
function entidadescp($tabla) {
	global $mysqli;
	$query = "SELECT * FROM entidad_cuota_parte 
	WHERE estado_entidad_cuota_parte = 1 
	ORDER BY nombre_entidad_cuota_parte ";
    $resultado5 = $mysqli->query($query);
	 while ($obj = $resultado5->fetch_object()) {
		$id_entidad = 'id_entidad_cuota_parte';
        $nombre_entidad = 'nombre_entidad_cuota_parte';		
        printf ("<option value='%s'>%s</option>\n", $obj[$id_entidad], utf8_encode($obj[$nombre_entidad]));
    }
	$result5->free();
}

function borcuotapar($table1, $idbo) {
    global $mysqli;
	$id_causante = 0;
	$query = "SELECT id_causante_cuota_parte 
	FROM cuota_parte_anuales 
	WHERE id_cuota_parte_anuales = '$idbo' 
	AND estado_cuota_parte_anuales = 1 ";
    $resultado5 = $mysqli->query($query);
    $row4h = $resultado5->fetch_array(MYSQLI_ASSOC);
    $id_causante = $row4h['id_causante_cuota_parte'];
	$resultado5->free();

    global $mysqli;
	$totcpm = 0;
	$query2 = "SELECT count(id_periodo_cuota_parte) AS totcpm 
	FROM periodo_cuota_parte 
	WHERE id_causante_cuota_parte = '$id_causante'
	AND estado_periodo_cuota_parte = 1 ";
    $resultado6 = $mysqli->query($query2);
    $row6h = $resultado6->fetch_array(MYSQLI_ASSOC);
    $totcpm = $row6h['totcpm'];
	$resultado6->free();

    global $mysqli;

    if ($totcpm <= 0) {
       $idbor=intval($idbo);
       $query88 = "UPDATE ".$table1." SET estado_".$table1."=0 WHERE id_".$table1."=".$idbor." limit 1";  
       $result44 = $mysqli->query($query88);
       return;
       $result44->free();
    }
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
          $("#modificp").modal("show");
          $('#id_pago_cuota_parte2').val(data[0]);
          $('#nombre_causante2').val(data[2]);
		  $('#fecha_pago2').val(data[4]);
		  $('#num_cpbte2').val(data[5]);
		  var vr_pago = data[6]; 
              vr_pago2 = Number(vr_pago.replace(/,/g, ""));
          $('#vr_pago2').val(vr_pago2);
      });  
    });

</script>


<script>
     $(document).ready(function() {
      $('.modievibtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#modieviden").modal("show");
          $('#id_evidencias_edl78').val(data[0]);
          $('#id_metas_funcionario_edl78').val(data[1]);
          $('#nombre_meta_funcionario_edl78').val(data[2]);
          $('#nombre_evidencias_edl78').val(data[3]);
          $('#ubicacion_evidencia78').val(data[4]);
		  $('#fecha_evidencia78').val(data[5]);
		  $('#observa_evidencia78').val(data[6]);
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.calijibtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#calimeta").modal("show");
          $('#id_metas_funcionario_edl85').val(data[0]);
          $('#nombre_meta_funcionario_edl85').val(data[2]);
          $('#compromiso_laboral85').val(data[3]);
          $('#peso_porcentual85').val(data[4]);
		  $('#eval_porcentual85').val(data[5]);
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
     $(document).ready(function() {
      $('.calijiedl').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#calicompefun").modal("show");
          $('#id_competencia_funcionario_edl65').val(data[0]);
          $('#nombre_competencias_edl65').val(data[1]);
		  
          $('#definicion_edl65').val(data[2]);
          $('#conducta_asociada65').val(data[3]);
          $('#nombre_niveles_desarrollo_edl65').val(data[4]);
//		  alert ("cali: " + data[5]);
		  $('#descrip_cualitativa65').val(data[6]);
		  $('#id_niveles_desarrollo_edl65').val(data[7]);
      });  
    });

</script>

<script>
    function calcuotap() {
	var vr_pension = document.getElementById('vr_pension').value;
	var porce_participacion = document.getElementById('porce_participacion').value;
//	alert('vr_pension = ' + vr_pension);
//	alert('porce_participacion = ' + porce_participacion);
	var vr_cuota_parte = Math.round(Number(vr_pension) * (Number(porce_participacion) / 100));

	document.getElementById('vr_cuota_parte').value = vr_cuota_parte;
	document.getElementById('vr_cuota_parte').focus();
 }
</script>

<script>
    function calcparte() {
	var vr_pension = document.getElementById('vr_pension2').value;
	var porce_participacion = document.getElementById('porce_participacion2').value;
//	alert('vr_pension = ' + vr_pension);
//	alert('porce_participacion = ' + porce_participacion);
	var vr_cuota_parte = Math.round(Number(vr_pension) * (Number(porce_participacion) / 100));

	document.getElementById('vr_cuota_parte2').value = vr_cuota_parte;
	document.getElementById('vr_cuota_parte2').focus();
 }
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
		var id_funcionario = document.getElementById('id_funcionario').value;
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
				$('.borrar_cpa').on('click', function () {
				 var opcion = confirm('¿Estas seguro de eliminar el registro?');		 
				 var may =this.id;
				 var mayk =this.name;
//	             alert('id: '+may);
//	             alert('tabla: '+mayk);
				 
		        if(opcion == true) {

                 document.getElementById("borraridcpa").value=may;
				 document.getElementById("borrarcpa").value=mayk;				 
				 
                 document.forms["borrar_cpa"].submit();
            	 } else {
		         return false;
	             }
	            });	
	
</script>
 
<?php  
 
 } else {
      echo 'No tiene acceso.';
}



?>

 
