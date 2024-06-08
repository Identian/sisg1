<!DOCTYPE html>
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




function periodosedl() {
	global $mysqli;
	$query = "SELECT * FROM periodos_edl WHERE estado_periodos_edl=1 ";
    $resultado = $mysqli->query($query);
	 while ($obj = $resultado->fetch_object()) {
        printf ("<option value='%s'>%s</option>\n", $obj->id_periodos_edl, $obj->fechaper_desde. ' - '.$obj->fechaper_hasta);
    }
}


// ********************************
// Creación reclamacion evaluado
// ********************************

if (isset($_POST['creareclamo']) and $_POST['creareclamo'] == 'creareclamo') {

	$id_eval_funcionario_edl = $_POST['id_eval_funcionario_edl9'];
	$nombre_reclamo_edl = $_POST['nombre_reclamo_edl9'];
	$num_radicado = $_POST['num_radicado9'];
	$fecha_reclamo = $_POST['fecha_reclamo9'];

      $insertSQL = sprintf("INSERT INTO reclamo_edl ( 
		    id_eval_funcionario_edl, nombre_reclamo_edl, 
			num_radicado, fecha_reclamo) 
            VALUES (%s, %s, %s, %s)", 
            GetSQLValueString($id_eval_funcionario_edl, "int"), 
            GetSQLValueString($nombre_reclamo_edl, "text"),
			GetSQLValueString($num_radicado, "text"),
            GetSQLValueString($fecha_reclamo, "date"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
	echo $hecho;
		 


 }

// ********************************
// Modificación reclamacion evaluado
// ********************************

if (isset($_POST['modifireclamo']) and $_POST['modifireclamo'] == 'modifireclamo') {

	$id_reclamo_edl = $_POST['id_reclamo_edl3'];
	$nombre_reclamo_edl = $_POST['nombre_reclamo_edl3'];
	$num_radicado = $_POST['num_radicado3'];
	$fecha_reclamo = $_POST['fecha_reclamo3'];

    $updateSQL37 = sprintf("UPDATE reclamo_edl 
	        SET num_radicado = %s,
			fecha_reclamo = %s,
            nombre_reclamo_edl = %s			
			WHERE id_reclamo_edl = %s",                  
	GetSQLValueString($num_radicado, "int"),
	GetSQLValueString($fecha_reclamo, "date"),
	GetSQLValueString($nombre_reclamo_edl, "text"), 
	GetSQLValueString($id_reclamo_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

	echo $hecho;
		 


 }





if (isset($_POST['actaprobedl']) and $_POST['actaprobedl'] == 'actaprobedl') {

	$id_eval_funcionario_edl = $_POST['id_eval_funcionario_edl6'];
	$id_funcionario = $_POST['id_funcionario6'];
	$aproba_edl_fun = $_POST['aproba_edl_fun6'];
    $updateSQL37 = sprintf("UPDATE eval_funcionario_edl 
	        SET aproba_edl_fun = %s,
			fecha_aprob_fun = now()
			WHERE id_eval_funcionario_edl = %s",                  
	GetSQLValueString($aproba_edl_fun, "int"),
	GetSQLValueString($id_eval_funcionario_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

	echo $hecho;

//	echo '<meta http-equiv="refresh" content="0;URL= ./reclamacion_edl&'.$id_eval_funcionario_edl.'.jsp" />';
//	echo '<meta http-equiv="refresh" content="0;URL= ./reclamacion_edl.jsp" />';
 }	





if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {
	
	$id_funcionario = $_SESSION['snr'];
	$id_funcionario2 = $_SESSION['snr'];

//	echo "id funcionario: ".$id_funcionario;
	
	$query2 = sprintf("SELECT id_periodos_edl, nombre_periodos_edl,
	fechaper_desde, fechaper_hasta, sysdate() hoy 
	FROM periodos_edl 
	WHERE periodo_activo_edl = 1 
	AND estado_periodos_edl = 1"); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);

    $id_periodos_edl = $row2['id_periodos_edl'];
	$nombre_periodo_edl = $row2['nombre_periodos_edl'];
	$fechaper_desde = $row2['fechaper_desde'];
	$fechaper_hasta = $row2['fechaper_hasta'];
    $hoy = $row2['hoy'];

   
	$query5 = sprintf("SELECT * FROM funcionario
                     WHERE id_funcionario = '$id_funcionario' 
				     AND estado_funcionario = 1 "); 
    $select5 = mysql_query($query5, $conexion) ;
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){ 
       $id_cargo = $row5['id_cargo'];
	   $nombre_funcionario_log = $row5['nombre_funcionario'];
	   $id_tipo_oficina = $row5['id_tipo_oficina'];
	   $id_grupo_area = $row5['id_grupo_area'];
	   $id_oficina_registro = $row5['id_oficina_registro'];
	   
//	   $nombre_perfil_activo_edl = $row5['nombre_perfil_activo_edl'];
//	   $tipo_funcionario = $row5['tipo_funcionario'];

    $query4 = sprintf("SELECT a.id_eval_funcionario_edl, a.id_funcionario, 
	                  a.id_funcionario_jefe_inme, 
	                  a.id_funcionario_jefe_area,
		              b.nombre_funcionario jefe_inme, d.nombre_funcionario jefe_area, 
					  a.fecha_concertacion, a.aproba_edl_fun, a.fecha_aprob_fun,
                      a.periodo_desde, a.periodo_hasta, 
					  c.fechaper_desde, c.fechaper_hasta,
					  a.estado_eva_jime, a.estado_eva_jarea,
					  case when a.estado_eva_jime > 0 
                      then 'CON Evaluación - EDL'
                      else 'SIN Evaluación - EDL'
                      end AS `destado_eva_jime`, 
					  case when a.estado_eva_jime > 0 
                      then 'CON Evaluación - EDL'
                      else 'SIN Evaluación - EDL'
                      end AS `destado_eva_jarea` 
                      FROM eval_funcionario_edl a 
			          LEFT JOIN funcionario b
					  ON a.id_funcionario_jefe_inme = b.id_funcionario
			          LEFT JOIN funcionario d
					  ON a.id_funcionario_jefe_area = d.id_funcionario
					  LEFT JOIN periodos_edl c
					  ON a.id_periodos_edl = c.id_periodos_edl
                      WHERE a.id_funcionario = '$id_funcionario' 
					  AND a.estado_eval_funcionario_edl = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
	$id_funcionario = $row4['id_funcionario'];
	$id_eval_funcionario_edl = $row4['id_eval_funcionario_edl']; 
    $jefe_inme = $row4['jefe_inme'];
	$jefe_area = $row4['jefe_area'];
	$fecha_concertacion = $row4['fecha_concertacion'];
//	$proposito_empleo = $row4['nombre_proposito_edl'];
	$periodo_desde = $row4['periodo_desde'];
	$periodo_hasta = $row4['periodo_hasta'];
	$estado_eva_jime = $row4['estado_eva_jime'];
	$estado_eva_jarea = $row4['estado_eva_jarea'];
	$destado_eva_jime = $row4['destado_eva_jime'];
	$destado_eva_jarea = $row4['destado_eva_jarea'];
    $id_funcionario_jefe_inme = $row4['id_funcionario_jefe_inme'];
	$id_funcionario_jefe_area = $row4['id_funcionario_jefe_area'];
	$aproba_edl_fun = $row4['aproba_edl_fun'];
	$fecha_aprob_fun = $row4['fecha_aprob_fun'];
/*
	$aprobacion_funcionario = 'CONCERTACIÓN PENDIENTE DE APROBACIÓN O RECHAZO'; 
	if ($aproba_edl_fun == 0) {
		$aprobacion_funcionario = 'CONCERTACIÓN PENDIENTE DE APROBACIÓN O RECHAZO'; 
	} 
	if ($aproba_edl_fun == 1) {
		$aprobacion_funcionario = 'CONCERTACIÓN APROBADA POR EL FUNCIONARIO'; 
	} else { // = 2
	  $aprobacion_funcionario = 'CONCERTACIÓN RECHAZADA POR EL FUNCIONARIO';
	}
*/	

    switch($aproba_edl_fun) {

    case 0:

    $aprobacion_funcionario = 'CONCERTACIÓN PENDIENTE DE APROBACIÓN O RECHAZO';

    break;

    case 1:

    $aprobacion_funcionario = 'CONCERTACIÓN APROBADA POR EL FUNCIONARIO';

    break;

    case 2:

    $aprobacion_funcionario = 'CONCERTACIÓN RECHAZADA POR EL FUNCIONARIO';

    break;

    default:

    $aprobacion_funcionario = 'valor no valido.';

}
 }
    
   } else {
      echo '1';
   }
   
	  
} else { 
     echo '2';
} 

// Actualiza aceptacion del funcionario
// ***********************************


// include('tablero_edl.php');
 
?> 
 <!--
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
			    <li><a href="revision_edl_fun.jsp"><b>EVALUACIÓN DEL DESEMPEÑO LABORAL - EDL</b></a></li>
            </ul>
        </div>
		 
      </div>
    </nav>
  </div>
</div>	  
	  -->
<div class="row">
    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <div class="row-md-3 text-left">
                 <h3 class="box-title"><b>RECLAMACIÓN ANTE COMISIÓN DE PERSONAL - EDL</b></h3> &nbsp; &nbsp; 
			 </div>
			 
		  <div class="row-md-6 text-right">
	      </div>
	    <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Evaluado:</label>   
                       <?php echo $nombre_funcionario_log; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Fecha de Concertación:</label>   
                       <?php echo $fecha_concertacion; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Período Desde:</label>   
                       <?php echo $periodo_desde; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Período Hasta:</label>   
                       <?php echo $periodo_hasta; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Estado EDL:</label>   
                       <?php echo $aprobacion_funcionario; ?>
                    </div>

                    </div>

                 <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Jefe Inmediato:</label>   
                       <?php echo $jefe_inme; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Estado EDL Jefe Inmediato:</label>   
                       <?php echo $destado_eva_jime; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Jefe Área:</label>   
                       <?php echo $jefe_area; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Estado EDL Jefe Área:</label>   
                       <?php echo $destado_eva_jarea; ?>
				    </div>  
				    <div>
                       <label  class="control-label">Fecha de Concertación:</label>   
                       <?php echo $fecha_aprob_fun; ?>
					</div>
				</div>  
             </div>
        </div>
  </div>
  </div>
</div> 



<?php
// Nueva Reclamacion Evaluado
// *************************************
?>

<div class="modal fade"  id="reclamo_edl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>RECLAMACIÓN EVALUADO - EDL</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4377664"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_eval_funcionario_edl9" id="id_eval_funcionario_edl9" readonly="readonly" value="<?php echo $id_eval_funcionario_edl; ?>">

	
    <div class="form-group text-left"> 
      <label  class="control-label">Evaluado:</label>   
      <input type="text" class="form-control" name="id_funcionario9" id="id_funcionario9" readonly="readonly" value="<?php echo $nombre_funcionario_log; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Num Radicado:</label>   
      <input type="number" class="form-control" name="num_radicado9" id="num_radicado9" value="" required >
    </div>

     <div class="form-group text-left"> 
      <label  class="control-label">Fecha Reclamo:</label>   
      <input type="date" class="form-control" name="fecha_reclamo9" id="fecha_reclamo9" value="" required >
    </div>
	
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Detalle del Reclamo:</label>   
        <textarea rows="5" cols="40" class="form-control" id="nombre_reclamo_edl9"  name="nombre_reclamo_edl9" value="" required ></textarea>
    </div>
 	
<!-- 
    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Testigo:</label>   
      <input type="date" class="form-control" name="fecha_testigo9" id="fecha_testigo9" value="" required >
    </div>


    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Datos Testigo:</label>   
        <textarea rows="5" cols="40" class="form-control" id="datos_testigo9"  name="datos_testigo9" value="" required ></textarea>
    </div>
 
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Decisión Comisión :</label>   
        <textarea rows="5" cols="40" class="form-control" id="decision_comision9"  name="decision_comision9" value="" required ></textarea>
    </div>
	
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Motivo Decisión:</label>   
        <textarea rows="5" cols="40" class="form-control" id="motivo_decision9"  name="motivo_decision9" value="" required ></textarea>
    </div>
	
 -->

    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="creareclamo" id="creareclamo" value="creareclamo">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>



<!-- Modal: modifica reclamacion -->
<div class="modal fade" id="modireclamo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>MODIFICACION RECLAMO</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">

				   <input type="hidden" name="id_eval_funcionario_edl3" id="id_eval_funcionario_edl3"   value="" >
                   <input type="hidden" name="id_reclamo_edl3" id="id_reclamo_edl3"   value="" >
				   
                   <div class="form-group text-left"> 
                        <label><i class="fa fa-calendar"><span style="color:#ff0000;">*</span></i> Num Radicado:</label>   
                        <input type="number" class="form-control" id="num_radicado3"name="num_radicado3" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Reclamo:</label>   
                        <input type="date" class="form-control" name="fecha_reclamo3" id="fecha_reclamo3" value="" required >
                   </div>

                  <div class="form-group text-left"> 
                       <label  class="control-label"><span style="color:#ff0000;">*</span>Detalle del Reclamo:</label>   
                       <textarea rows="5" cols="40" class="form-control" id="nombre_reclamo_edl3"  name="nombre_reclamo_edl3" value="" required ></textarea>
                  </div>
 

                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="modifireclamo" value="modifireclamo">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
				</form>
              </div>
          </div> 
     </div> 
</div> 

 <?php
 // ************************************
 // Detalle Reclamacion Evaluado
 // ************************************
 ?>
 
 		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
         		     <!--  <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#reclamo_edl"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Reclamación</a> -->
					   </h4> 
                       <div class="box-body">
					   <?php
/*	el que estaba antes	- tiene error de anbiguedad			   
$query="SELECT count(id_eval_funcionario_edl) as tevaluacion_edl from competencia_funcionario_edl, competencias_edl, eval_funcionario_edl 
where competencia_funcionario_edl.id_competencia_funcionario_edl=competencias_edl.id_competencias_edl 
and competencia_funcionario_edl.id_eval_funcionario_edl=eval_funcionario_edl.id_eval_funcionario_edl 
 and eval_funcionario_edl.id_funcionario=".$_SESSION['snr']." and estado_competencia_funcionario_edl=1 
 ORDER BY id_competencia_funcionario_edl";
 */
 
 $query="SELECT count(competencia_funcionario_edl.id_eval_funcionario_edl) as tevaluacion_edl 
 from competencia_funcionario_edl, eval_funcionario_edl 
where competencia_funcionario_edl.id_eval_funcionario_edl=eval_funcionario_edl.id_eval_funcionario_edl 
 and eval_funcionario_edl.id_funcionario=".$_SESSION['snr']." and estado_competencia_funcionario_edl=1";
 
 
 $select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);

$query8 ="SELECT count(metas_funcionario_edl.id_eval_funcionario_edl) as tmetas_edl 
 from metas_funcionario_edl, eval_funcionario_edl 
where metas_funcionario_edl.id_eval_funcionario_edl=eval_funcionario_edl.id_eval_funcionario_edl 
 and id_funcionario=".$_SESSION['snr']." ORDER BY id_metas_funcionario_edl desc";
 $select8 = mysql_query($query8, $conexion);
$rowt8 = mysql_fetch_assoc($select8);


if (0<$rowt['tevaluacion_edl'] and 0<$rowt8['tmetas_edl']) {
	
	
	if (0==$aproba_edl_fun) {
 ?>
					   
       <a id="" class="ventana1" data-toggle="modal" data-target="#eval_acepta" href="" title="Aceptación Funcionario"> 
	   <button type="button" class="btn btn-ms btn-success"> Realizar respuesta</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php 
	} else { echo 'EDL Aceptado'; }
				
				
				
				} else { echo 'El evaluador no ha cargado metas o compromisos.';} ?>       
<!--						<div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID</th>
								<th>Num Radicado</th>
                                <th>Fecha Reclamo</th>
								<th>Detalle del Reclamo</th>
                                <th colspan="4">Accion</th>
                             </tr>
                </thead>
            <tbody>
-->
            <?php
			/*
               $query62 = sprintf("SELECT a.id_reclamo_edl, 
			    a.id_eval_funcionario_edl, a.nombre_reclamo_edl, 
				a.num_radicado, a.fecha_reclamo
	            FROM reclamo_edl a
				LEFT JOIN eval_funcionario_edl b 
                ON (a.id_eval_funcionario_edl = b.id_eval_funcionario_edl 
                AND b.id_funcionario = '$id_funcionario') 
				WHERE a.estado_reclamo_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
*/			  
            ?>
    <!--      <tr>
             <td><?php //echo $row62['id_reclamo_edl']; ?></td>
            <td><?php //echo $row62['num_radicado'];?></td> 
			 <td><?php //echo $row62['fecha_reclamo']; ?></td>
			 <td><?php //echo $row62['nombre_reclamo_edl']; ?></td>
             <td>
			 <!-- ojo es porque se genera otra consulta y se crean reg de modificacion => que sea un MODAL -->
			 
              <!--  <button type="button" class="btn btn-primary btn-xs rhaprobtn" title="Modificación Reclamo"><span  class="glyphicon glyphicon-hand-up"></span></button>&nbsp;-->
            <!-- </td>
		     
		     <td> 
			  <!-- <a style="color:#ff0000;cursor: pointer" title="Borrar" name="reclamo_edl" id="<?php //echo $row62['id_reclamo_edl']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>-->
			<!-- </td>
          </tr>
          <?php //} ?> 
          </tbody>
        </table>
      </div> --><!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div>


   <div class="box-body" style="background:#fff;">
      <div class="table-responsive">
      METAS	  
				

					<style>
.dataTables_filter {
display:none;
}
			</style>
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
                <thead>
 <tr align="center" valign="middle">
	 <th>Meta</th>
	 <th>Compromiso</th>
	 <th>Peso porcentual</th>	  
</tr>
</thead>
<tbody>			
<?php 
$query4="SELECT * from metas_funcionario_edl, metas_edl, eval_funcionario_edl 
where metas_funcionario_edl.id_metas_edl=metas_edl.id_metas_edl 
and metas_funcionario_edl.id_eval_funcionario_edl=eval_funcionario_edl.id_eval_funcionario_edl 
and estado_metas_funcionario_edl = 1 
and id_funcionario=".$_SESSION['snr']." AND estado_eval_funcionario_edl = 1  ORDER BY id_metas_funcionario_edl desc  "; //LIMIT 500 OFFSET ".$pagina."

//".$_SESSION['snr']."
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_metas_funcionario_edl'];
echo '<td>'.$row['nombre_metas_edl'].'</td>';
echo '<td>'.$row['compromiso_laboral'].'</td>';
echo '<td>'.$row['peso_porcentual'].'</td>';

?>
      
                  </tr>
                <?php } ?>

				
                </tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									//'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->


    <div class="box-body" style="background:#fff;">
					<style>
.dataTables_filter {
display:none;
}
			</style>
      <div class="table-responsive">
			
	COMPETENCIAS
<table  class="table display" id="inforesoluciones5" cellspacing="0" width="100%">
                <thead>
 <tr align="center" valign="middle">
	 <th>Competencia</th>
	 <th>Definición</th>
	 <th>Conducta Asociada</th>
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>			
<?php 
/* como estaba antes
$query5="SELECT * from competencia_funcionario_edl, competencias_edl, eval_funcionario_edl 
where competencia_funcionario_edl.id_competencia_funcionario_edl=competencias_edl.id_competencias_edl 
and competencia_funcionario_edl.id_eval_funcionario_edl=eval_funcionario_edl.id_eval_funcionario_edl 
 and eval_funcionario_edl.id_funcionario=".$_SESSION['snr']." and estado_competencia_funcionario_edl=1 
 ORDER BY id_competencia_funcionario_edl";
 */
 
$query5="SELECT * from competencia_funcionario_edl, competencias_edl, eval_funcionario_edl 
where competencia_funcionario_edl.id_competencias_edl=competencias_edl.id_competencias_edl 
and competencia_funcionario_edl.id_eval_funcionario_edl=eval_funcionario_edl.id_eval_funcionario_edl 
 and eval_funcionario_edl.id_funcionario=".$_SESSION['snr']." AND estado_eval_funcionario_edl = 1 
 and estado_competencia_funcionario_edl=1 
 ORDER BY id_competencia_funcionario_edl";
 
//".$_SESSION['snr']."
$result5 = $mysqli->query($query5);
while($row5 = $result5->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_compe=$row['id_competencia_funcionario_edl'];
echo '<td>'.$row5['nombre_competencias_edl'].'</td>';
echo '<td>'.$row5['definicion_edl'].'</td>';
echo '<td>'.$row5['conducta_asociada'].'</td>';


?>
      
                  </tr>
                <?php } ?>

				
                </tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones5').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									// 'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->



</div><!-- col-md-12 -->

<?php

// ********************************
// Aceptacion funcionario
// ********************************
?>


<div class="modal fade" id="eval_acepta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>ACEPTACIÓN DEL FUNCIONARIO</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form46678655">
    <input type="hidden" class="form-control" id="id_eval_funcionario_edl6" name="id_eval_funcionario_edl6" value="<?php echo $id_eval_funcionario_edl; ?>">
	<input type="hidden" class="form-control" id="id_funcionario6" name="id_funcionario6" value="<?php echo $id_funcionario2; ?>">
 	<div class="form-group text-left"> 
	     <label  class="control-label"><span style="color:#ff0000;">*</span> Aceptación o Rechazo:</label> 
            <option value="" selected> </option>
	     <select class="form-control" name="aproba_edl_fun6" id="aproba_edl_fun6" required>
        <option value="1" selected>Aceptada</option>
        <option value="2" >Rechazada</option>
        </select>
    </div>

	<div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actaprobedl" value="actaprobedl">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
	
  </form>
</div>
</div> 
</div> 
</div> 


<script>
     $(document).ready(function() {
      $('.rhaprobtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#modireclamo").modal("show");
          $('#id_reclamo_edl3').val(data[0]);
          $('#num_radicado3').val(data[1]);
          $('#fecha_reclamo3').val(data[2]);
          $('#nombre_reclamo_edl3').val(data[3]);
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



 
