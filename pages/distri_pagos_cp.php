<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<?php

$nump66=privilegios(66,$_SESSION['snr']);
$nump68=privilegios(68,$_SESSION['snr']);

if (isset($_GET['i']) && (1==$_SESSION['rol'] or (0<$nump66 or 0<$nump68))) {
	
	$id_causante_cuota_parte = $_GET['i'];
  
//   if (isset($_GET['i'])) {
	
   

   $id_causante_cuota_parte = intval($_GET['i']);


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
			    <li><a href="pagos_entidad_cp&<?php echo $id_causante_cuota_parte; ?>.jsp"><b>DISTRIBUCIÓN PAGOS CUOTA PARTE</b></a></li>
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
        	 <hr>
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
 // **********************************************
 // Detalle de distribución de Pagos Cuotas Parte
 // **********************************************
 ?>
 
 		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'Distribución pagos Cuota Parte'; ?>
					   </h4> 
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID Reg</th>
                                <th>ID pago</th>
								<th>Valor CP</th>
								<th>Fecha Período</th>
								<th>Num Cpbte</th>
								<th>Fecha Pago</th>
								<th>Valor Pago</th>
								<th>Abono CP</th>
								<th>Abono Intereses</th>
                                <th colspan="4">Accion</th>
                             </tr>
                </thead>
            <tbody>

            <?php
               $query62 = sprintf("SELECT a.id_pago_detalle_cp,
                a.id_periodo_cuota_parte, a.id_pago_cuota_parte,			   
			    a.id_causante_cuota_parte, a.abono_cp_detalle,
				a.abono_inter_cp_detalle,  
				b.fecha_pago, b.num_cpbte, b.vr_pago, 
                c.fecha_periodo, c.vr_cuota_parte, c.factor_periodo
	            FROM pago_detalle_cp a  
				LEFT JOIN pago_cuota_parte b 
				ON a.id_pago_cuota_parte = b.id_pago_cuota_parte 
                LEFT JOIN periodo_cuota_parte c 
                ON a.id_periodo_cuota_parte = c.id_periodo_cuota_parte				
                WHERE a.id_causante_cuota_parte = '$id_causante_cuota_parte'  
				AND a.estado_pago_detalle_cp = 1 ORDER BY b.fecha_pago, c.fecha_periodo "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
            ?>
          <tr>
             <td><?php echo $row62['id_pago_detalle_cp']; ?></td>
             <td><?php echo $row62['id_pago_cuota_parte']; ?></td>
			 <td><?php echo number_format($row62['vr_cuota_parte']); ?></td>
			 <td><?php echo $row62['fecha_periodo'];?></td> 
			 <td><?php echo $row62['num_cpbte']; ?></td>
			 <td><?php echo $row62['fecha_pago']; ?></td>
			 <td><?php echo number_format($row62['vr_pago']); ?></td>
			 <td><?php echo number_format($row62['abono_cp_detalle']); ?></td>
			 <td><?php echo number_format($row62['abono_inter_cp_detalle']); ?></td>
			 <?php if (1==$_SESSION['rol'] or 10<$nump66) { ?>
		     <td> 
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="pago_detalle_cp" id="<?php echo $row62['id_pago_detalle_cp']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
			 </td>
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
 
<?php  
 
 } else {
      echo 'No tiene acceso.';
}



?>

 
