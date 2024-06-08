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

$nump66=privilegios(66,$_SESSION['snr']);
$nump68=privilegios(68,$_SESSION['snr']);


if (1==$_SESSION['rol'] or (0<$nump66 or 0<$nump68)) {

// consulta fecha de corte
/*
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


// *************************************************
// Actualizar fecha de corte
// *************************************************

if (isset($_POST['actfechac']) && $_POST['actfechac'] == 'actfechac'){

    $fecha_corte_act_cp = $_POST['fecha_corte_act_cp'];

    $updateSQL35 = sprintf("UPDATE corte_cuota_parte
	        SET fecha_corte_act_cp = %s,
			    fecha_corte_ant_cp = %s
			WHERE id_corte_cuota_parte = 1",
			GetSQLValueString($fecha_corte_act_cp, "date"),
			GetSQLValueString($fecha_corte_act_cp, "date"));
    $Result135 = mysql_query($updateSQL35, $conexion) or die(mysql_error());

	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./cuotas_partes.jsp" />';
 }
*/ 

// eliminar registro Cuota Parte Anual

if (isset($_POST['borraridcpa']) and ""!=$_POST['borraridcpa'] and isset($_POST['borrarcpa']) and ""!=$_POST['borrarcpa']) {
 echo borrarsucesion($_POST["borrarsuce"], $_POST["borraridsuce"]);
} else {}

if (isset($_GET["i"]) && ""!=$_GET["i"]) {
    $id_causante_cuota_parte = intval($_GET["i"]);
	
    $query5 = sprintf("SELECT count(*) to totcausante  
	FROM pago_detalle_cp 
	WHERE id_causante_cuota_parte = '$id_causante_cuota_parte'  
	AND   estado_pago_detalle_cp = 1 "); 
$select5 = mysql_query($query5, $conexion);
$row5 = mysql_fetch_assoc($select5);
$totalRows5 = mysql_num_rows($select5);
$totcausante = $row5['totcausante'];
if ($totcausante > 0) { 

$noborrar='<script type="text/javascript">swal(" ERROR!", " Este Causante tiene Pagos... NO se puede borrar..!!!", "error"); </script>';

echo $noborrar; 


} else {


   $query84 = "UPDATE causante_cuota_parte SET estado_causante_cuota_parte = 0  WHERE id_causante_cuota_parte = ".$id_causante_cuota_parte." limit 1";  
 
   $Result1 = mysql_query($query84, $conexion);

   echo $actualizado;

 } 
}


// Registra nuevo Causante
// ***********************************

if (isset($_POST['archperfun'])) {
	$id_entidad_cuota_parte = $_POST['id_entidad_cuota_parte'];
    $id_tipo_documento_causante = $_POST['id_tipo_documento_causante'];
	$cedula_causante = $_POST['cedula_causante'];

    $query52 = sprintf("SELECT count(*) AS totcausante  
	FROM causante_cuota_parte 
	WHERE id_entidad_cuota_parte = '$id_entidad_cuota_parte' 
    AND id_tipo_documento_causante = '$id_tipo_documento_causante'  	
	AND cedula_causante = '$cedula_causante' 
	AND estado_causante_cuota_parte = 1 "); 
    $select52 = mysql_query($query52, $conexion);
    $row52 = mysql_fetch_assoc($select52);
    $totalRows52 = mysql_num_rows($select52);
    $totcausante = $row52['totcausante'];
    if ($totcausante > 0) { 

       $noborrar='<script type="text/javascript">swal(" ERROR!", " Ya existe el Causante...!!!", "error"); </script>';

echo $noborrar; 


} else {

	$id_entidad_cuota_parte = $_POST['id_entidad_cuota_parte'];
    $id_tipo_documento_causante = $_POST['id_tipo_documento_causante'];
	$cedula_causante = $_POST['cedula_causante'];
	$nombre_causante_cuota_parte = $_POST['nombre_causante_cuota_parte'];
    if(strlen ($_POST['nombre_sustituto_cuota_parte']) > 1) {
	   $id_tipo_documento_sustituto = $_POST['id_tipo_documento_sustituto'];
	   $cedula_sustituto = $_POST['cedula_sustituto'];
	   $nombre_sustituto_cuota_parte = $_POST['nombre_sustituto_cuota_parte'];
	} else {
	   $id_tipo_documento_sustituto = 0;
	   $cedula_sustituto = ' ';
	   $nombre_sustituto_cuota_parte = ' ';
	}
	$porce_participacion = $_POST['porce_participacion'];
	$num_resolucion = $_POST['num_resolucion'];
	$fecha_causacion = $_POST['fecha_causacion'];
	$fecha_status_juridico = $_POST['fecha_status_juridico'];
		
	$insertSQL = sprintf("INSERT INTO causante_cuota_parte (
      id_entidad_cuota_parte, nombre_causante_cuota_parte, 
	  id_tipo_documento_causante, cedula_causante,
      nombre_sustituto_cuota_parte, id_tipo_documento_sustituto, 
	  cedula_sustituto, porce_participacion, num_resolucion, 
	  fecha_causacion, fecha_status_juridico) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($id_entidad_cuota_parte, "int"), 
	  GetSQLValueString($nombre_causante_cuota_parte, "text"),
	  GetSQLValueString($id_tipo_documento_causante, "int"),
	  GetSQLValueString($cedula_causante, "text"),
	  GetSQLValueString($nombre_sustituto_cuota_parte, "text"),
	  GetSQLValueString($id_tipo_documento_sustituto, "int"),
	  GetSQLValueString($cedula_sustituto, "text"),
	  GetSQLValueString($porce_participacion, "text"),
	  GetSQLValueString($num_resolucion, "text"),
	  GetSQLValueString($fecha_causacion, "date"),
	  GetSQLValueString($fecha_status_juridico, "date")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
    }	 

// echo '<meta http-equiv="refresh" content="0;URL= ./causantes_cp.jsp" />';
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
        </div>
		<div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			    <li style="font-size: 18px; color: black;"><a href="cuotas_partes.jsp"><b>CAUSANTES - CUOTAS PARTES</b></a></li>
            </ul>
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
  <div class="col-md-2">
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#creaperfun"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Causante</button>&nbsp;
  </div>
 <?php } ?>
 
    <div id="projects_table_filter" class="dataTables_filter">
	<form action="" method="POST" name="for585858m1" > 
      <div class="input-group">
        <div class="input-group-btn">
          <select class="form-control" name="campo" required>
            <option value="" selected> - - Buscar por: - -  </option>
		    <option value="entidad_cp">Entidad</option>
 		    <option value="cedula_causante">Cedula</option>
			<option value="nombre_causante">Nombre Causante</option>
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
	  
<!-- 
  <div class="col-md-2">
    <ul class="input-group-btn">
	   <li><a href="histo_cp_causante.jsp" type="button" class="btn btn-warning btn-sm" ><span class="glyphicon glyphicon-list-alt"></span> CUOTAS PARTES CAUSANTE</a></li>
    </ul>
  </div>

	<div class="col-md-1">
    	<div class="input-group-btn">
	        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#activ_periodo"><span class="glyphicon glyphicon-list-alt"></span>FECHA DE CORTE</button>&nbsp;
        </div>
	</div>	
-->
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
	<style>
     .dataTables_filter {
     display:true;
     }
	</style>

<div class="row">
<div class="col-md-12">
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_causantes">
           <thead>
                <tr style = "color: black">
                  <th>Id Causante</th>
				  <th>Entidad</th>
				  <th>Cédula Causante</th>
                  <th>Nombre Causante</th>
				  <th>Cédula Sustituto</th>
                  <th>Nombre Sustituto</th>
                  <th>Num Resolución</th>
				  <th>Estado Causante</th>
                 <th colspan="4">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php
			
			  $datobus = ' ';
			  if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
	            $nom_campo = $_POST['campo'];
				$vr_campo = "'%".$_POST['buscar']."%'";
				if ($nom_campo == 'cedula_causante'){
					$nom_campo = 'a.cedula_causante';
				}
				if ($nom_campo == 'entidad_cp'){
					$nom_campo = 'b.nombre_entidad_cuota_parte';
				}
				if ($nom_campo == 'nombre_causante'){
					$nom_campo = 'a.nombre_causante_cuota_parte';
				}
			    $datobus = ' AND '.$nom_campo.' LIKE '.$vr_campo;
			  }	  
			
              $query87 = "SELECT * 
                          FROM causante_cuota_parte a, entidad_cuota_parte b, 
						  estados_causante_cp c 
                          WHERE a.id_entidad_cuota_parte = b.id_entidad_cuota_parte 
						  AND a.id_estados_causante_cp = c.id_estados_causante_cp 
						  AND a.estado_causante_cuota_parte = 1 ".$datobus." limit 500 ";
              $select87 = mysql_query($query87, $conexion) or die(mysql_error());
              while($row_reg = mysql_fetch_array($select87)) {
            ?>
          <tr style = "color: black">
		     <?php 
			 $id_causante_cuota_parte = $row_reg['id_causante_cuota_parte'];
		     $nombre_entidad = $row_reg['nombre_entidad_cuota_parte'];
			 $id_tipo_documento_causante = $row_reg['id_tipo_documento_causante'];
			 $cedula_causante = $row_reg['cedula_causante'];
			 $nombre_causante = $row_reg['nombre_causante_cuota_parte'];
			 $id_tipo_documento_sustituto = $row_reg['id_tipo_documento_sustituto'];
			 $cedula_sustituto = $row_reg['cedula_sustituto'];
			 $nombre_sustituto = $row_reg['nombre_sustituto_cuota_parte'];
			 $porce_participacion = $row_reg['porce_participacion'];
			 $num_resolucion = $row_reg['num_resolucion'];
			 $fecha_causacion = $row_reg['fecha_causacion'];
			 $fecha_status_juridico = $row_reg['fecha_status_juridico'];
             $nombre_estados_causante_cp = $row_reg['nombre_estados_causante_cp'];
			$sw5 = 0;
			
	         ?>
             <td><?php echo $id_causante_cuota_parte; ?></td>
			 <td><?php echo $nombre_entidad; ?></td>
			 <td style = "display: none"><?php echo $id_tipo_documento_causante; ?></td>
             <td><?php echo $cedula_causante; ?></td>
             <td><?php echo $nombre_causante; ?></td>
			 <td style = "display: none"><?php echo $id_tipo_documento_sustituto; ?></td>
             <td><?php echo $cedula_sustituto; ?></td>
             <td><?php echo $nombre_sustituto; ?></td>
			 <td style = "display: none"><?php echo $porce_participacion; ?></td>
			 <td><?php echo $num_resolucion; ?></td>
			 <td style = "display: none"><?php echo $fecha_causacion; ?></td>
			 <td><?php echo $nombre_estados_causante_cp; ?></td>
			 
			 <td style = "display: none"><?php echo $fecha_status_juridico; ?></td>
			 
        	 <td>
                <a href="consulta_causante_cp&<?php echo $id_causante_cuota_parte; ?>.jsp"><span class="btn btn-info btn-xs" title="Consultar registro"><span  class="glyphicon glyphicon-hand-up"></span></a> &nbsp;
             </td> 
			 <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
             <td style="color:#000000;">
                <a href="causantes_cp&<?php echo $id_causante_cuota_parte; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar registro"  ><span class="glyphicon glyphicon-trash"></span></a>
             </td>
			<?php } ?>
			<?php } ?>
          </tr>

      <?php } 
	  mysql_free_result($select87);
	  ?> <!-- CIERRE PRIMER WHILE -->

          <script>

              $(document).ready(function() {
            $('#tab_causantes').DataTable({
              "lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              }
            });
          });

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
// Actualizar fecha de corte 
// *****************************************
?>

<div class="modal fade"  id="activ_periodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"  style="color:#000000;"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>ACTUALIZAR FECHA DE CORTE - CP</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_funcionario2" id="id_funcionario2" readonly="readonly" value="<?php echo $id_funcionario2; ?>">
    <input type="hidden" class="form-control" name="id_cargo2" id="id_cargo2" readonly="readonly" value="<?php echo $id_cargo; ?>">

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Anterior:</label>   
      <input type="date" class="form-control" name="fecha_corte_ant_cp" id="fecha_corte_ant_cp" value="<?php echo $fecha_corte_ant_cp; ?>" readonly="readonly" >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Corte (fin de mes):</label>   
      <input type="date" class="form-control" name="fecha_corte_act_cp" id="fecha_corte_act_cp" value="" onChange = "valfechas();" required >
    </div>
    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actfechac" value="actfechac">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>

<?php
// Activacion de perfil 
// *****************************************
?>

<div class="modal fade"  id="activ_perfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"  style="color:#000000;"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>ACTIVACIÓN DE PERFIL - EDL</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_funcionario2" id="id_funcionario2" readonly="readonly" value="<?php echo $id_funcionario2; ?>">
    <input type="hidden" class="form-control" name="id_cargo2" id="id_cargo2" readonly="readonly" value="<?php echo $id_cargo; ?>">

	<div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Perfil:</label> 
        <select class="form-control" name="tipo_funcionario" id="tipo_funcionario" onChange = "valtipofun();" required >
        <option value="0" selected>Evaluado</option>
        <option value="1" >Evaluador</option>
        <option value="2" >Comisión Evaluadora</option>
        </select>
    </div>

    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="activperfil" value="activperfil">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>




<!-- Modal: Nuevo Causante  -->
<div class="modal fade" id="creaperfun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="color:#000000;"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>NUEVO CAUSANTE</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">

<!--				   <input type="hidden" name="id_funcionario_jefe_inme" id="id_funcionario_jefe_inme"   value="<?php echo $id_funcionario2; ?>" > -->
	               <div class="form-group text-left"> 
                     <label  class="control-label"><span style="color:#ff0000;">*</span> Entidad:</label> 
                     <select class="form-control" name="id_entidad_cuota_parte" id="id_entidad_cuota_parte" required >
                        <option value="" selected></option>
                        <?php echo entidadescp('entidad_cuota_parte'); ?>
                      </select>
                   </div>

	               <div class="form-group text-left"> 
                     <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Docto Causante:</label> 
                     <select class="form-control" name="id_tipo_documento_causante" id="id_tipo_documento_causante" required >
                        <option value="" selected></option>
                        <?php echo lista('tipo_documento'); ?>
                      </select>
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Num Docto Cuasante:</label>   
                        <input type="number" class="form-control" name="cedula_causante" id="cedula_causante" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Nombre del Cuasante:</label>   
                        <input type="txt" class="form-control" name="nombre_causante_cuota_parte" id="nombre_causante_cuota_parte" value="" required >
                   </div>

	               <div class="form-group text-left"> 
                     <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Docto Sustituto:</label> 
                     <select class="form-control" name="id_tipo_documento_sustituto" id="id_tipo_documento_sustituto" >
                        <option value="" selected></option>
                        <?php echo lista('tipo_documento'); ?>
                      </select>
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Num Docto Sustituto:</label>   
                        <input type="number" class="form-control" name="cedula_sustituto" id="cedula_sustituto" value="" >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Nombre del Sustituto:</label>   
                        <input type="txt" class="form-control" name="nombre_sustituto_cuota_parte" id="nombre_sustituto_cuota_parte" value="">
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Porcentaje Participación:</label>   
                        <input type="txt" class="form-control" name="porce_participacion" id="porce_participacion" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Num Resolución:</label>   
                        <input type="txt" class="form-control" name="num_resolucion" id="num_resolucion" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Fecha Causación:</label>   
                        <input type="date" class="form-control" name="fecha_causacion" id="fecha_causacion" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Fecha Estatus Jurídico:</label>   
                        <input type="date" class="form-control" name="fecha_status_juridico" id="fecha_status_juridico" value="" required >
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
			 if (Number(b) > 31) {
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

function entidadescp() {
	global $mysqli;
	$query = "SELECT * FROM entidad_cuota_parte 
	WHERE estado_entidad_cuota_parte = 1 
	ORDER BY nombre_entidad_cuota_parte ";
    $resultado = $mysqli->query($query);
	 while ($obj = $resultado->fetch_object()) {
        printf ("<option value='%s'>%s</option>\n", $obj->id_entidad_cuota_parte, utf8_encode($obj->nombre_entidad_cuota_parte));
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

 
