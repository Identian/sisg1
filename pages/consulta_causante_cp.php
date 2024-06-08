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


// *********************************
// Registra nueva Cuota Parte Anual
// ***********************************

if (isset($_POST['insertcp']) and $_POST['insertcp'] == 'insertcp') {

	$id_causante_cuota_parte = $_POST['id_causante_cuota_parte'];
    $anno_cuota_parte = $_POST['anno_cuota_parte'];
    $nombre_cuota_parte_anuales = 'Cuota Parte Anual ';
	$vr_pension = $_POST['vr_pension'];
	$vr_cuota_parte = $_POST['vr_cuota_parte'];

$query = sprintf("SELECT count(id_causante_cuota_parte) as tot_cp 
  FROM cuota_parte_anuales
  where anno_cuota_parte = '$anno_cuota_parte' 
  and id_causante_cuota_parte = '$id_causante_cuota_parte' 
  AND estado_cuota_parte_anuales=1 "); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
 if (0<$rowt['tot_cp']) {
	echo $repetido; 
 } else {		
	$insertSQL = sprintf("INSERT INTO cuota_parte_anuales (
      id_causante_cuota_parte, anno_cuota_parte, 
	  nombre_cuota_parte_anuales, 
	  vr_pension, vr_cuota_parte) 
	  VALUES (%s, %s, %s, %s, %s)", 
      GetSQLValueString($id_causante_cuota_parte, "int"), 
      GetSQLValueString($anno_cuota_parte, "int"), 
	  GetSQLValueString($nombre_cuota_parte_anuales, "text"),
	  GetSQLValueString($vr_pension, "text"),
	  GetSQLValueString($vr_cuota_parte, "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
  }		 

//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_causante_cp&'.$id_causante_cuota_parte.'.jsp" />';
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
	$id_estados_causante_cp = $_POST['id_estados_causante_cp'];


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
			fecha_status_juridico = %s,
			id_estados_causante_cp = %s 
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
	GetSQLValueString($id_estados_causante_cp, "int"),
	GetSQLValueString($id_causante_cuota_parte, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_causante_cp&'.$id_causante_cuota_parte.'.jsp" />';

 }

// Cambio Estado CP Mensual
// ************************

if (isset($_POST['cambiocpdet']) and $_POST['cambiocpdet'] == 'cambiocpdet') {

	$id_causante_cuota_parte = $_POST['id_causante_cuota_parte'];
    $fecha_desde_cp = $_POST['fecha_desde_cp55'];
 	$fecha_hasta_cp = $_POST['fecha_hasta_cp55'];
	$estadocp = $_POST['estadocp5'];
	$prescribe = $_POST['prescribe5'];

    $updateSQL37 = "UPDATE periodo_cuota_parte 
	        SET estado_cp = ".$estadocp.", prescribe = ".$prescribe." 	
			WHERE id_causante_cuota_parte = ".$id_causante_cuota_parte."  
			AND fecha_periodo between '".$fecha_desde_cp. "' AND '".$fecha_hasta_cp."' ";                  
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_causante_cp&'.$id_causante_cuota_parte.'.jsp" />';

 }



// Modifica Cuota Parte Anual
// ********************************

if (isset($_POST['modificpa']) and $_POST['modificpa'] == 'modificpa') {

	$id_cuota_parte_anuales = $_POST['id_cuota_parte_anuales2'];
    $vr_pension = $_POST['vr_pension2'];
	$vr_cuota_parte = $_POST['vr_cuota_parte2'];

    $updateSQL37 = sprintf("UPDATE cuota_parte_anuales 
	        SET vr_pension = %s,	
			vr_cuota_parte = %s
			WHERE id_cuota_parte_anuales = %s",                  
	GetSQLValueString($vr_pension, "text"),
	GetSQLValueString($vr_cuota_parte, "text"),
	GetSQLValueString($id_cuota_parte_anuales, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_causante_cp&'.$id_causante_cuota_parte.'.jsp" />';

 }

// Modifica Cuota Parte Anual
// ********************************

if (isset($_POST['modiprescr']) and $_POST['modiprescr'] == 'modiprescr') {

	$id_periodo_cuota_parte = $_POST['id_periodo_cuota_parte5'];
    $prescrita = $_POST['prescrita5'];

    $updateSQL57 = sprintf("UPDATE periodo_cuota_parte 
	        SET estado_cp = %s
			WHERE id_periodo_cuota_parte = %s",                  
	GetSQLValueString($prescrita, "text"),
	GetSQLValueString($id_periodo_cuota_parte, "int"));
    $Result157 = mysql_query($updateSQL57, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_causante_cp&'.$id_causante_cuota_parte.'.jsp" />';

 }

if (isset($_POST['borrarcpa']) and ""!=$_POST['borrarcpa'] and isset($_POST['borraridcpa']) and ""!=$_POST['borraridcpa']) {
//  echo borcpanual2($_POST["borrarcpa"], $_POST["borraridcpa"]);
// echo borrarcpa('cuota_parte_anuales', 2);

    $table1 = $_POST['borrarcpa'];
    $idbo = $_POST["borraridcpa"];

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
//       $result44->free();
    }

 echo $hecho;
// echo '<meta http-equiv="refresh" content="0;URL= ./consulta_causante_cp&'.$id_causante_cuota_parte.'.jsp" />';


} else {}
		

    $query4 = sprintf("SELECT a.id_entidad_cuota_parte, b.nombre_entidad_cuota_parte,
                      a.id_tipo_documento_causante, a.id_tipo_documento_sustituto,
                      c.nombre_tipo_documento	ntipo_docto_causante,
                      d.nombre_tipo_documento	ntipo_docto_sustituto,					  
	                  a.cedula_causante, a.cedula_sustituto,
                      a.nombre_causante_cuota_parte, a.nombre_sustituto_cuota_parte,					  
					  a.porce_participacion, a.num_resolucion, a.fecha_causacion,
	                  a.fecha_status_juridico, a.id_estados_causante_cp, 
					  e.nombre_estados_causante_cp 
                      FROM causante_cuota_parte a 
			          LEFT JOIN entidad_cuota_parte b
					  ON a.id_entidad_cuota_parte = b.id_entidad_cuota_parte
					  LEFT JOIN tipo_documento c
					  ON a.id_tipo_documento_causante = c.id_tipo_documento 
					  LEFT JOIN tipo_documento d
					  ON a.id_tipo_documento_sustituto = d.id_tipo_documento 
					  LEFT JOIN estados_causante_cp e 
					  ON a.id_estados_causante_cp = e.id_estados_causante_cp 
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
	$id_estados_causante_cp = $row4['id_estados_causante_cp'];
	$nombre_estados_causante_cp = $row4['nombre_estados_causante_cp'];
 }

    $anno_cp = 0;
	$vr_cuota_parte = 0;

	$query2 = sprintf("SELECT id_causante_cuota_parte, max(anno_cuota_parte) anno_cp,
	max(vr_cuota_parte) valor_cp
	FROM cuota_parte_anuales 
	WHERE id_causante_cuota_parte = '$id_causante_cuota_parte' 
	and estado_cuota_parte_anuales = 1
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
			    <li><a href="causantes_cp&<?php echo $id_causante_cuota_parte; ?>.jsp"><b>CONSULTA CAUSANTE - CUOTA PARTE</b></a></li>
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
			 <div class="row-md-3 text-left">
			   <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
			   <div class="col-md-2">
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modicau"><span class="glyphicon glyphicon-plus-sign"></span> Modificar Causante</button>&nbsp;
               </div>
               <?php } ?>
			   
<!--
	           <div class="col-md-2">
                 <ul class="input-group-btn">
			       <li><a href="periodos_causante_cp&<?php echo $id_causante_cuota_parte; ?>.jsp"><span class="btn btn-warning btn-xs" title="Periodos Cuota Parte">Periodos Cuota Parte</a></li>
                 </ul>
               </div>
-->
	           <div class="col-md-2">
                 <ul class="input-group-btn">
			       <li><a href="pdf/cuenta_cobro_cp&<?php echo $id_causante_cuota_parte; ?>.pdf" target='_blank' ><span class="btn btn-primary btn-xs" title="Cuenta de Cobro">Cuenta de Cobro</a></li>
				   
                 </ul>
               </div>

	           <div class="col-md-2">
                 <ul class="input-group-btn">
			       <li><a href="expediente_cp&<?php echo $id_causante_cuota_parte; ?>.jsp"><span class="btn btn-warning btn-xs" title="Cuenta de Cobro">Expedientes CP</a></li>
				   
                 </ul>
               </div>

	           <div class="col-md-2">
                 <ul class="input-group-btn">
			       <li><a href="correo_cp&<?php echo $id_causante_cuota_parte; ?>.jsp"><span class="btn btn-info btn-xs" title="Cuenta de Cobro">Correo Cuota Parte</a></li>
				   
                 </ul>
               </div>

	           <div class="col-md-2">
                 <ul class="input-group-btn">
			       <li><a href="pagos_entidad_cp&<?php echo $id_causante_cuota_parte; ?>.jsp"><span class="btn btn-danger btn-xs" title="Pagos Entidad">Pagos Entidad</a></li>
				 </ul>
               </div>
			 </div>
			 <br>
<!--			 
		  <div class="row-md-6 text-right">
	      </div> -->
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
                    <div class="form-group text-left"> 
                       <label  class="control-label">Estado Causante:</label>   
                       <?php echo $nombre_estados_causante_cp; ?>
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
// Modificacion Causante
// ************************
?>

<div class="modal fade" id="modicau" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="color:#000000;"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>MODIFICA CAUSANTE</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form177888" enctype="multipart/form-data">

                   <input type="hidden" class="form-control" name="id_causante_cuota_parte" id="id_causante_cuota_parte" readonly="readonly" value="<?php echo $id_causante_cuota_parte; ?>">

	               <div class="form-group text-left"> 
                     <label  class="control-label"><span style="color:#ff0000;">*</span> Entidad:</label> 
                     <select class="form-control" name="id_entidad_cuota_parte" id="id_entidad_cuota_parte" required >
                        <option value="<?php echo $id_entidad; ?>" ><?php echo $nombre_entidad; ?></option>
                        <?php echo lista('entidad_cuota_parte'); ?>
                      </select>
                   </div>

	               <div class="form-group text-left"> 
                     <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Docto Causante:</label> 
                     <select class="form-control" name="id_tipo_documento_causante" id="id_tipo_documento_causante" required >
                        <option value="<?php echo $id_tipo_documento_causante; ?>"><?php echo $ntipo_docto_causante; ?></option>
                        <?php echo lista('tipo_documento'); ?>
                      </select>
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Num Docto Cuasante:</label>   
                        <input type="number" class="form-control" name="cedula_causante" id="cedula_causante" value="<?php echo $cedula_causante; ?>" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Nombre del Cuasante:</label>   
                        <input type="txt" class="form-control" name="nombre_causante_cuota_parte" id="nombre_causante_cuota_parte" value="<?php echo $nombre_causante; ?>" required >
                   </div>

	               <div class="form-group text-left"> 
                     <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Docto Sustituto:</label> 
                     <select class="form-control" name="id_tipo_documento_sustituto" id="id_tipo_documento_sustituto" >
                        <option value="<?php echo $id_tipo_documento_sustituto; ?>"><?php echo $ntipo_docto_sustituto; ?></option>
                        <?php echo lista('tipo_documento'); ?>
                      </select>
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Num Docto Sustituto:</label>   
                        <input type="number" class="form-control" name="cedula_sustituto" id="cedula_sustituto" value="<?php echo $cedula_sustituto; ?>" >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Nombre del Sustituto:</label>   
                        <input type="txt" class="form-control" name="nombre_sustituto_cuota_parte" id="nombre_sustituto_cuota_parte" value="<?php echo $nombre_sustituto; ?>">
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Porcentaje Participación:</label>   
                        <input type="txt" class="form-control" name="porce_participacion" id="porce_participacion" value="<?php echo $porce_participacion; ?>" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Num Resolución:</label>   
                        <input type="txt" class="form-control" name="num_resolucion" id="num_resolucion" value="<?php echo $num_resolucion; ?>" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Fecha Causación:</label>   
                        <input type="date" class="form-control" name="fecha_causacion" id="fecha_causacion" value="<?php echo $fecha_causacion; ?>" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Fecha Estatus Jurídico:</label>   
                        <input type="date" class="form-control" name="fecha_status_juridico" id="fecha_status_juridico" value="<?php echo $fecha_status_juridico; ?>" required >
                   </div>

	               <div class="form-group text-left"> 
                     <label  class="control-label"><span style="color:#ff0000;">*</span> Estado Causante:</label> 
                     <select class="form-control" name="id_estados_causante_cp" id="id_estados_causante_cp" >
                        <option value="<?php echo $id_estados_causante_cp; ?>"><?php echo $nombre_estados_causante_cp; ?></option>
                        <?php echo lista('estados_causante_cp'); ?>
                      </select>
                   </div>

                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="actcausante" value="actcausante">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
				</form>
              </div>
          </div> 
     </div> 
</div> 


 <?php
 // ************************************
 // Detalle de Cuotas Partes Anual
 // ************************************
 ?>
 
 		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'Cuotas Partes Anual'; ?>
					   </h4>
                       <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>					   
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#nmetafun"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Cuota Parte Anual</a> 
					   </h4> 
					   <?php } ?>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID Reg</th>
                                <th>ID Causante</th>
								<th>Causante</th>
								<th>Sustituto</th>
								<th>Año</th>
								<th>Valor Pensión</th>
                                <th>Valor Cuota Parte</th>
				                <th colspan="4">Accion</th>
                             </tr>
                </thead>
            <tbody>

            <?php
               $query62 = sprintf("SELECT a.id_cuota_parte_anuales, 
			    a.id_causante_cuota_parte, b.nombre_causante_cuota_parte,
				b.nombre_sustituto_cuota_parte,  
				a.anno_cuota_parte, a.vr_pension, a.vr_cuota_parte
	            FROM cuota_parte_anuales a  
				LEFT JOIN causante_cuota_parte b 
				ON a.id_causante_cuota_parte = b.id_causante_cuota_parte 
                WHERE a.id_causante_cuota_parte = '$id_causante_cuota_parte'  
				AND a.estado_cuota_parte_anuales = 1 ORDER BY a.anno_cuota_parte "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	 
            ?>
          <tr>
             <td><?php echo $row62['id_cuota_parte_anuales']; ?></td>
             <td><?php echo $row62['id_causante_cuota_parte']; ?></td>
             <td><?php echo utf8_encode($row62['nombre_causante_cuota_parte']);?></td> 
			 <td><?php echo utf8_encode($row62['nombre_sustituto_cuota_parte']);?></td> 
			 <td><?php echo $row62['anno_cuota_parte']; ?></td>
			 <td><?php echo number_format($row62['vr_pension']); ?></td>
			 <td><?php echo number_format($row62['vr_cuota_parte']); ?></td>
			 <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
             <td>
				<button type="button" class="btn btn-info btn-xs modimebtn" title="Modificación Cuota Parte Anual"><span  class="glyphicon glyphicon-hand-up"></span></button>&nbsp;
             </td>
		     <td> 
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="cuota_parte_anuales" id="<?php echo $row62['id_cuota_parte_anuales']; ?>" class="borrar_cpa"><span class="glyphicon glyphicon-trash"></span></a>
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

// ********************************
// Nueva Cuota Parte Anual
// ********************************
?>
<div class="modal fade" id="nmetafun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVA CUOTA PARTE ANUAL</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form4311567534555"  enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_causante_cuota_parte" name="id_causante_cuota_parte" value="<?php echo $id_causante_cuota_parte; ?>">
	<input type="hidden" class="form-control" id="porce_participacion" name="porce_participacion" value="<?php echo $porce_participacion; ?>">

    <div class="form-group text-left"> 
        <label  class="control-label">Causante:</label>   
        <input type="text" class="form-control" name="nombre_causante" id="nombre_causante" value="<?php echo $nombre_causante; ?>" readonly = "readonly" >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Año (4 digitos):</label>   
        <input type="number" class="form-control" name="anno_cuota_parte" id="anno_cuota_parte" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Valor Pensión:</label>   
        <input type="number" class="form-control" name="vr_pension" id="vr_pension" value="" onChange = "calcuotap();" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Valor Cuota Parte:</label>   
        <input type="number" class="form-control" name="vr_cuota_parte" id="vr_cuota_parte" value="" readonly = "readonly" >
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

<!-- Modal: modifica Cuota Parte anual -->
<div class="modal fade" id="modificp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>MODIFICACION CUOTA PARTE ANUAL</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">
                   
				   <input type="hidden" name="id_cuota_parte_anuales2" id="id_cuota_parte_anuales2"   value="" >
				   <input type="hidden" name="porce_participacion2" id="porce_participacion2"   value="<?php echo $porce_participacion; ?>" >
				   
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Causante:</label>   
                        <input type="text" class="form-control" name="nombre_causante2" id="nombre_causante2" value="" readonly ="readonly" >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Año (4 digitos):</label>   
                        <input type="number" class="form-control" name="anno_cuota_parte2" id="anno_cuota_parte2" value="" readonly ="readonly" >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Valor Pensión:</label>   
                        <input type="number" class="form-control" name="vr_pension2" id="vr_pension2" value="" onChange = "calcparte();" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Valor Cuota Parte:</label>   
                        <input type="number" class="form-control" name="vr_cuota_parte2" id="vr_cuota_parte2" value="" required >
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

<!-- Modal: modifica Cuota Parte Mensual - Prescripcion -->
<div class="modal fade" id="modiprescri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>MODIFICACION CUOTA PARTE MENSUAL</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form33" enctype="multipart/form-data">
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>ID Registro:</label>   
                        <input type="number" class="form-control" name="id_periodo_cuota_parte5" id="id_periodo_cuota_parte5" value="" readonly ="readonly" >
                   </div>
                   
				   
				   
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Estado CP:</label>   
                        <select class="form-control" name="prescrita5" required>
                          <option value="" selected></option>
 		                  <option value="1">NORMAL</option>
		                  <option value="2">POR PRESCRIBIR</option>
						  <option value="3">PRESCRITA</option>
                        </select>
                   </div>

                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="modiprescr" value="modiprescr">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
				</form>
              </div>
          </div> 
     </div> 
</div> 


<?php

// *********************************
// Cambio Estado Cuota Parte Mensual
// *********************************
?>
<div class="modal fade" id="cambioecp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>CAMBIO ESTADO CUOTA PARTE MENSUAL</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form4311567534555"  enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_causante_cuota_parte" name="id_causante_cuota_parte" value="<?php echo $id_causante_cuota_parte; ?>">

    <div class="form-group text-left"> 
        <label  class="control-label">Causante:</label>   
        <input type="text" class="form-control" name="nombre_causante" id="nombre_causante" value="<?php echo $nombre_causante; ?>" readonly = "readonly" >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Fecha Desde:</label>   
        <input type="date" class="form-control" name="fecha_desde_cp55" id="fecha_desde_cp55" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Fecha Hasta:</label>   
        <input type="date" class="form-control" name="fecha_hasta_cp55" id="fecha_hasta_cp55" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Estado CP:</label>   
        <select class="form-control" name="estadocp5" required>
          <option value="" selected></option>
 		  <option value="1">NORMAL</option>
		  <option value="2">POR PRESCRIBIR</option>
		  <option value="3">PRESCRITA</option>
        </select>
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Prescribe:</label>   
        <select class="form-control" name="prescribe5" required>
          <option value="" selected></option>
 		  <option value="1">SOLO INTERESES</option>
		  <option value="2">CAPITAL E INTERESES</option>
        </select>
    </div>

	<div class="modal-footer">
        <span style="color:#ff0000;">(*) Campos obligatorios</span>
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="cambiocpdet" value="cambiocpdet">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 



 <?php
 // ************************************
 // Detalle de Cuotas Partes Mensual
 // ************************************
 ?>
 
 		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'Cuotas Partes Mensual'; ?>
					   </h4> 
                       <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>					   
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#cambioecp"><span class="glyphicon glyphicon-plus-sign"></span> Cambio Estado Cuota Parte</a> 
					   </h4> 
					   <?php } ?>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID Reg</th>
                                <th>ID Causante</th>
								<th>Fecha Período</th>
								<th>Num Pagos</th>
								<th>Valor Pensión</th>
								<th>Valor CP</th>
                                <th>Abono CP</th>
								<th>Saldo CP</th>
								<th>Valor Intereses</th>
                                <th>Abono Intereses</th>
								<th>Saldo Intereses</th>
								<th>Días Mora</th>
								<th>Estado CP</th>
				                <th colspan="4">Accion</th>
                             </tr>
                </thead>
            <tbody>

            <?php
               $query62 = sprintf("SELECT a.id_periodo_cuota_parte, 
			    a.id_causante_cuota_parte, b.nombre_causante_cuota_parte,
				b.nombre_sustituto_cuota_parte, b.porce_participacion, 
				a.fecha_periodo, a.factor_periodo, a.vr_pension, 
				a.vr_cuota_parte, a.abono_cuota_parte,
				(a.vr_cuota_parte - a.abono_cuota_parte) saldo_cp,
				a.vr_intereses, a.abono_intereses,
				(a.vr_intereses - a.abono_intereses) saldo_intereses,
				a.dias_mora, a.estado_cp
	            FROM periodo_cuota_parte a  
				LEFT JOIN causante_cuota_parte b 
				ON a.id_causante_cuota_parte = b.id_causante_cuota_parte 
                WHERE a.id_causante_cuota_parte = '$id_causante_cuota_parte'  
				AND a.estado_periodo_cuota_parte = 1 ORDER BY a.fecha_periodo "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {
				$estado_cp = $row62['estado_cp']; 
                if ($estado_cp == 1) {
					$dprescrita = 'NORMAL';
				} elseif ($estado_cp == 2) {
					$dprescrita = 'POR PRESCRIBIR';
				} elseif ($estado_cp == 3) {
					$dprescrita = 'PRESCRITA';
				}
				
            ?>
          <tr>
             <td><?php echo $row62['id_periodo_cuota_parte']; ?></td>
             <td><?php echo $row62['id_causante_cuota_parte']; ?></td>
<!--             <td><?php // echo utf8_encode($row62['nombre_causante_cuota_parte']);?></td> -->
<!--			 <td><?php // echo utf8_encode($row62['nombre_sustituto_cuota_parte']);?></td>  -->
			 <td><?php echo $row62['fecha_periodo']; ?></td>
			 <td><?php echo $row62['factor_periodo']; ?></td>
			 <td><?php echo number_format($row62['vr_pension']); ?></td>
			 <td><?php echo number_format($row62['vr_cuota_parte']); ?></td>
			 <td><?php echo number_format($row62['abono_cuota_parte']); ?></td>
			 <td><?php echo number_format($row62['saldo_cp']); ?></td>
			 <td><?php echo number_format($row62['vr_intereses']); ?></td>
			 <td><?php echo number_format($row62['abono_intereses']); ?></td>
			 <td><?php echo number_format($row62['saldo_intereses']); ?></td>
			 <td><?php echo number_format($row62['dias_mora']); ?></td>
			 <td><?php echo $dprescrita; ?></td>
<!--			 
             <td>
				<button type="button" class="btn btn-info btn-xs modcpmebtn" title="Modificación Cuota Parte Mensual"><span  class="glyphicon glyphicon-hand-up"></span></button>&nbsp;
             </td>
-->
             <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
             <td>
				<button type="button" class="btn btn-info btn-xs modipercp" title="Modificación Prescripción"><span  class="glyphicon glyphicon-hand-up"></span></button>&nbsp;
             </td>
		     <td> 
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="periodo_cuota_parte" id="<?php echo $row62['id_periodo_cuota_parte']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
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



<form method="POST" action="" name="borrar_cpa5">
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

/*
function borcpanual2($table1, $idbo) {
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
*/
	
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
          $('#id_cuota_parte_anuales2').val(data[0]);
          $('#nombre_causante2').val(data[2]);
//          document.getElementById('id_metas_edl8').value = data[1];
          var vr_pension = data[5]; 
		  var vr_cuota_parte = data[6]; 
              vr_pension = Number(vr_pension.replace(/,/g, ""));
			  vr_cuota_parte = Number(vr_cuota_parte.replace(/,/g, ""));
          $('#anno_cuota_parte2').val(data[4]);
          $('#vr_pension2').val(vr_pension);
		  $('#vr_cuota_parte2').val(vr_cuota_parte);
      });  
    });

</script>


<script>
     $(document).ready(function() {
      $('.modipercp').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#modiprescri").modal("show");
          $('#id_periodo_cuota_parte5').val(data[0]);
          $('#prescrita5').val(data[12]);
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
				 
                 document.forms["borrar_cpa5"].submit();
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

 
