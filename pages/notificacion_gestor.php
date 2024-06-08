<?php

$nump147=privilegios(147,$_SESSION['snr']);
// $nump147 = 100;

$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;


if (1==$_SESSION['rol'] or 0<$nump147) {

	$id_funcionario = $_SESSION['snr'];
	 
	$query5 = sprintf("SELECT * FROM funcionario
                  where id_funcionario = '$id_funcionario' 
				  and estado_funcionario = 1 "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){
       $id_cargo = $row5['id_cargo'];
	   $nombre_funcionario = $row5['nombre_funcionario'];
	   $id_tipo_oficina = $row5['id_tipo_oficina'];
	   $id_grupo_area = $row5['id_grupo_area'];
	   $id_oficina_registro = $row5['id_oficina_registro'];
   }
 
   if (isset($_GET['i'])) { 
   $id_gestor_catastral=intval($_GET['i']);
   $nombre_gestor_catastral = ' ';
	$query8 = sprintf("SELECT * FROM gestor_catastral
                  where id_gestor_catastral = '$id_gestor_catastral' 
				  and estado_gestor_catastral = 1 "); 
    $select8 = mysql_query($query8, $conexion) or die(mysql_error());
    $row8 = mysql_fetch_assoc($select8);
    $totalRows8 = mysql_num_rows($select8);
    if ($totalRows8 > 0){
       $nombre_gestor_catastral = $row8['nombre_gestor_catastral'];
   }
   
   
   } else {
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
   }

    } else { 
    echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 
 
// ojo pendiente - revisar
if (isset($_GET["e"]) && ""!=$_GET["e"]) {
    $id_notificaciones_gestor = intval($_GET["e"]);

	$query84 = "UPDATE notificaciones_gestor SET estado_notificaciones_gestor = 0  WHERE id_notificaciones_gestor = ".$id_notificaciones_gestor." limit 1";  
  
   $Result1 = mysql_query($query84, $conexion);
 
   echo $hecho;

 } else {
  
 }

 include('tablero_gestor.php');
 
 
if (isset($_POST['archgestor']) && $_POST['archgestor'] == 'gestor') {

	$id_funcionario = $_POST['id_funcionario'];
	$id_gestor_catastral = $_POST['id_gestor_catastral'];
	$plazo_respuesta = $_POST['plazo_respuesta'];

		
	$insertSQL = sprintf("INSERT INTO notificaciones_gestor (
      id_gestor_catastral, id_tipo_notificacion, detalle_notificacion, 
	  id_funcionario, plazo_respuesta, fecha_registro) 
	  VALUES (%s, %s, %s, %s, %s, now())", 
      GetSQLValueString($id_gestor_catastral, "text"),
      GetSQLValueString($_POST['id_tipo_notificacion'], "int"),
      GetSQLValueString($_POST['detalle_notificacion'], "text"),
      GetSQLValueString($id_funcionario, "text"),
	  GetSQLValueString($plazo_respuesta, "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

// correo al gestor

   $id_gestor_catastral=intval($_GET['i']);
   $nombre_gestor_catastral = ' ';
	$query8 = sprintf("SELECT * FROM gestor_catastral
                  where id_gestor_catastral = '$id_gestor_catastral' 
				  and estado_gestor_catastral = 1 "); 
    $select8 = mysql_query($query8, $conexion) or die(mysql_error());
    $row8 = mysql_fetch_assoc($select8);
    $totalRows8 = mysql_num_rows($select8);
    if ($totalRows8 > 0){
       $nombre_gestor_catastral = $row8['nombre_gestor_catastral'];
	   $correo_gestor = $row8['correo_gestor'];
   }

$correo_gestor = 'oscar.ortegon@supernotariado.gov.co';

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
      $emailune = $correo_gestor;
      $subject = 'Nueva Notificación IVC Catastro';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "SISG - le informa que Usted tiene una nueva Notificación para ser respondida en ".$plazo_respuesta." dia(s)";
      $cuerpo .= "<br><br>";
	  $cuerpo .= '<br>Solicitante: '.$nombre_funcionario.'<br>';
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      mail($emailune, $subject, $cuerpo, $cabeceras);


//     echo '<h1>Mensaje enviado a '.$emailune.'</h1>';



// echo '<meta http-equiv="refresh" content="0;URL= ./notificacion_gestor&'.$id_gestor_catastral.'.jsp" />';
	  
 }

// ************************************************
// Crea nuevo tipo de notificacion
// ************************************************

if (isset($_POST['archtipono']) && $_POST['archtipono'] == 'archtipono') {
		
	$insertSQL10 = sprintf("INSERT INTO tipo_notificacion (
      nombre_tipo_notificacion) 
	  VALUES (%s)", 
      GetSQLValueString($_POST['nombre_tipo_notificacion'], "text")); 
      $Result10 = mysql_query($insertSQL10, $conexion) or die(mysql_error());

// echo '<meta http-equiv="refresh" content="0;URL= ./notificacion_gestor&'.$id_gestor_catastral.'.jsp" />';
	  
 }
 
 
// ************************************************
// Actualiza control de visualizacion
// ************************************************

if (isset($_POST['enterado'])){

	$id_notificaciones_gestor = $_POST['id_notificaciones_gestor2'];
	$id_gestor_catastral = $_POST['id_gestor_catastral2'];
    $control_visualizacion = 1;
	
    $updateSQL40 = sprintf("UPDATE notificaciones_gestor 
	        SET control_visualizacion =%s
			WHERE id_notificaciones_gestor = %s",                  
	GetSQLValueString($control_visualizacion, "int"),
	GetSQLValueString($id_notificaciones_gestor, "int"));
    $Result40 = mysql_query($updateSQL40, $conexion) or die(mysql_error());
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./notificacion_gestor&'.$id_gestor_catastral.'.jsp" />';

 }
 
 // ************************************************
// Actualiza Notifiacion
// ************************************************

if (isset($_POST['modificado'])){

	$id_notificaciones_gestor = $_POST['id_notificaciones_gestor3'];
	$id_gestor_catastral = $_POST['id_gestor_catastral3'];
	$id_tipo_notificacion = $_POST['id_tipo_notificacion3'];
    $detalle_notificacion = $_POST['detalle_notificacion3'];
	$plazo_respuesta = $_POST['plazo_respuesta3'];
	
    $updateSQL40 = sprintf("UPDATE notificaciones_gestor 
	        SET id_tipo_notificacion =%s, detalle_notificacion =%s,
			plazo_respuesta = %s
			WHERE id_notificaciones_gestor = %s",                  
	GetSQLValueString($id_tipo_notificacion, "int"),
	GetSQLValueString($detalle_notificacion, "text"),
	GetSQLValueString($plazo_respuesta, "text"),
	GetSQLValueString($id_notificaciones_gestor, "int"));
    $Result40 = mysql_query($updateSQL40, $conexion) or die(mysql_error());
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./notificacion_gestor&'.$id_gestor_catastral.'.jsp" />';

 }
 
 
 
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
		  <ul class="nav navbar-nav">
			    <li><a href="catastro_gestor.jsp" style="font-size:15px;"><b>GESTOR CATASTRAL - NOTIFICACIONES</b></a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>

	  
	  
	  
<div class="row">
<div class="col-md-12">

 <div class="box box-info">
  <div class="box-header with-border">
        <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Notificación al Gestor</button>&nbsp;
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#listanota"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Tipo Notificación</button>&nbsp;
		<?php } ?>
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  
				  <th width = "90px">Id Notificación</th>
				  <th width = "70px">Id Gestor</th>
				  <th width = "180px">Gestor Catastral</th>
				  <th width = "160px">Fecha</th>
				  <th width = "110px">Plazo (en días)</th>
				  <th width = "130px">Quedan (en días)</th>
                  <th width = "780px">Notificación</th>
				  <th width = "100px">Estado</th>
                 <th colspan="4">Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query75 = sprintf("SELECT a.id_gestor_catastral, nombre_gestor_catastral,
			                                  id_notificaciones_gestor, a.id_tipo_notificacion,
											  c.nombre_tipo_notificacion, a.plazo_respuesta, CURDATE() hoy,
											  DATEDIFF(DATE_ADD(a.fecha_registro, INTERVAL a.plazo_respuesta DAY), CURDATE()) quedan,
			                                  detalle_notificacion, a.fecha_registro, control_visualizacion
			                                FROM notificaciones_gestor a
											LEFT JOIN gestor_catastral b
											ON a.id_gestor_catastral = b.id_gestor_catastral
											LEFT JOIN tipo_notificacion c
											ON a.id_tipo_notificacion = c.id_tipo_notificacion
                          WHERE estado_notificaciones_gestor = 1 
						  AND a.id_gestor_catastral = ".$id_gestor_catastral.
						 " ORDER BY fecha_registro desc, control_visualizacion ");
              $select75 = mysql_query($query75, $conexion) or die(mysql_error());
              while($row75 = mysql_fetch_array($select75)) {
				  
            ?>
          <tr>
		     <?php 
			 $nombre_gestor_catastral = $row75['nombre_gestor_catastral'];
		     $id_notificaciones_gestor = $row75['id_notificaciones_gestor'];
			 $id_tipo_notificacion = $row75['id_tipo_notificacion'];
			 $nombre_tipo_notificacion = $row75['nombre_tipo_notificacion'];
			 $detalle_notificacion = $row75['detalle_notificacion'];
             $detalle_notificacion2 = substr($row75['detalle_notificacion'],0,50).' ...........';
			 $fecha_registro = $row75['fecha_registro'];
			 $hoy = $row75['hoy'];
			 $quedan = $row75['quedan'];
			 if ($quedan < 0) {
				$quedan = 0; 
			 }
			 $plazo_respuesta = $row75['plazo_respuesta'];
			 $control_visualizacion = $row75['control_visualizacion'];
			 $des_visualizacion = "Por Consultar";
			 if ($control_visualizacion > 0) {
			    $des_visualizacion = "Consultado";
			 }
			 
			$sw5 = 0;
			
	         ?>
             
			 <td width = "90px"><?php echo $id_notificaciones_gestor; ?></td>
             <td width = "90px"><?php echo $id_gestor_catastral; ?></td>
			 <td width = "180px"><?php echo $nombre_gestor_catastral; ?></td>
			 <td width = "160px"><?php echo $fecha_registro; ?></td>
			 <td width = "70px"><?php echo $plazo_respuesta; ?></td>
			 <td width = "70px"><?php echo $quedan; ?></td>
			 <td style = "display: none"><?php echo $detalle_notificacion; ?></td>
             <td width = "780px" style ="font-size: 16px;"><?php echo $detalle_notificacion2; ?></td>
			 <?php if ($control_visualizacion< 1) { ?>
               <td width = "100px" style="color:#FF0000;"><?php echo $des_visualizacion; ?></td>
			 <?php } else { ?>
			   <td width = "100px" style="color:#000000;"><?php echo $des_visualizacion; ?></td>
			   <?php } ?>
			   <td style = "display: none"><?php echo $id_tipo_notificacion; ?></td>
			   <td style = "display: none"><?php echo $nombre_tipo_notificacion; ?></td>
             <td>
                <button type="button" class="btn btn-primary btn-xs editbtn" title="Consulta Notificacion"><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
             </td>
             <td>
			    <?php if((($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) and $control_visualizacion  < 1)) { // Grupo Catastro ?>
                <button type="button" class="btn btn-success btn-xs modibtn" title="Modificación"><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
				<?php } ?>
             </td>
             <?php if($control_visualizacion  < 1) { ?>
             <td>
                <a href="notificacion_gestor&<?php echo $id_gestor_catastral; ?>&<?php echo $id_notificaciones_gestor; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar"  ><span class="glyphicon glyphicon-trash"></span></a>
             </td>
			<?php } }?>
          </tr>
         
         
          <script>

              $(document).ready(function() {
            $('#tab_sucesiones').DataTable({
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
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->

<?php
// Nueva Notificacion al Gestor
// **********************************
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>NUEVA NOTIFICACIÓN</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                   <form action="" method="POST" name="form1" enctype="multipart/form-data">
 				        <input type="hidden" name="id_funcionario" id="id_funcionario"   value="<?php echo $id_funcionario; ?>" >
						<input type="hidden" name="id_gestor_catastral" id="id_gestor_catastral"   value="<?php echo $id_gestor_catastral; ?>" >
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Gestor Catastral:</label>
                              <input type="text" class="form-control" name="nombre_gestor_catastral" id="nombre_gestor_catastral" readonly="readonly" value="<?php echo $nombre_gestor_catastral; ?>">
                         </div>
						 
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Notificación:</label> 
                              <select class="form-control" name="id_tipo_notificacion" id="id_tipo_notificacion" requiered >
                              <option value="" selected></option>
                              <?php echo lista('tipo_notificacion'); ?>
                              </select>
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label">Detalle Notificación:</label>   
                              <textarea rows="5" cols="20" class="form-control" id="detalle_notificacion"  name="detalle_notificacion" value=""></textarea>
	                     </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Plazo Respuesta (en días):</label>
                              <input type="number" class="form-control" name="plazo_respuesta" id="plazo_respuesta" value="" requiered >
                         </div>
						 
				   		 <div class="modal-footer">
						      <span style="color:#ff0000;">(*) Campos obligatorios</span>
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="archgestor" value="gestor">
                              <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div> 

<?php
// Nuevo Tipo de Notificacion
// ********************************
?>

<div class="modal fade" id="listanota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>NUEVO TIPO DE NOTIFICACIÓN</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                   <form action="" method="POST" name="form1" enctype="multipart/form-data">
 				        <input type="hidden" name="id_funcionario" id="id_funcionario"   value="<?php echo $id_funcionario; ?>" >
						<input type="hidden" name="id_gestor_catastral" id="id_gestor_catastral"   value="<?php echo $id_gestor_catastral; ?>" >
                         <div class="form-group text-left"> 
                              <label  class="control-label">Tipo de Notificación:</label>   
                              <textarea rows="3" cols="20" class="form-control" id="nombre_tipo_notificacion"  name="nombre_tipo_notificacion" value=""></textarea>
	                     </div>

				   		 <div class="modal-footer">
						      <span style="color:#ff0000;">(*) Campos obligatorios</span>
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="archtipono" value="archtipono">
                              <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div> 



<?php
// Consulta Notificacion
// ***************************
?>

<div class="modal fade"  id="consunoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<!-- <button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button> -->
<h4 class="modal-title" id="myModalLabel"><b>CONSULTA NOTIFICACIÓN</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4366224"  enctype="multipart/form-data">

	<input type="hidden" name="id_gestor_catastral2" id="id_gestor_catastral2"   value="" >
	<input type="hidden" name="id_notificaciones_gestor2" id="id_notificaciones_gestor2"   value="" >
	<input type="hidden" name="fecha_registro2" id="fecha_registro2"   value="" >
	
    <div class="form-group text-left"> 
      <label  class="control-label">Gestor Catastral:</label>   
      <input type="text" class="form-control" name="nombre_gestor_catastral2" id="nombre_gestor_catastral2" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Tipo Notificación:</label>   
      <input type="text" class="form-control" name="id_tipo_notificacion2" id="id_tipo_notificacion2" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
       <label  class="control-label">Detalle Notificación:</label>   
       <textarea rows="5" cols="20" class="form-control" id="detalle_notificacion2"  name="detalle_notificacion2" value="" readonly="readonly"></textarea>
	</div>
    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> 
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button> -->
        <button type="submit" class="btn btn-success"><input type="hidden" name="enterado" id="enterado" value="enterado">
        <span class="glyphicon glyphicon-ok"></span>Enterado</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>

<?php
// Modificacion Notificacion
// ********************************
?>

<div class="modal fade"  id="modinoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN NOTIFICACIÓN</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4388224"  enctype="multipart/form-data">

	<input type="hidden" name="id_gestor_catastral3" id="id_gestor_catastral3"   value="" >
	<input type="hidden" name="id_notificaciones_gestor3" id="id_notificaciones_gestor3"   value="" >
	<input type="hidden" name="fecha_registro3" id="fecha_registro3"   value="" >
	
    <div class="form-group text-left"> 
      <label  class="control-label">Gestor Catastral:</label>   
      <input type="text" class="form-control" name="nombre_gestor_catastral3" id="nombre_gestor_catastral3" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Notificación:</label> 
      <select class="form-control" name="id_tipo_notificacion3" id="id_tipo_notificacion3" requiered >
      <option value="" selected></option>
        <?php echo lista('tipo_notificacion'); ?>
      </select>
    </div>

    <div class="form-group text-left"> 
       <label  class="control-label">Detalle Notificación:</label>   
       <textarea rows="5" cols="20" class="form-control" id="detalle_notificacion3"  name="detalle_notificacion3" value="" ></textarea>
	</div>
    	
    <div class="form-group text-left"> 
      <label  class="control-label">Plazo (en días):</label>   
      <input type="text" class="form-control" name="plazo_respuesta3" id="plazo_respuesta3" value="">
    </div>

    <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> 
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="modificado" id="modificado" value="modificado">
        <span class="glyphicon glyphicon-ok"></span>Actualizar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<script>
     $(document).ready(function() {
      $('.editbtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#consunoti").modal("show");
          $('#id_notificaciones_gestor2').val(data[0]);
		  $('#id_gestor_catastral2').val(data[1]);
          $('#nombre_gestor_catastral2').val(data[2]);
		  $('#fecha_registro2').val(data[3]);
		  $('#detalle_notificacion2').val(data[4]);
		  $('#id_tipo_notificacion2').val(data[7] + ' - ' + data[8]);
//		  $('#nombre_tipo_notificacion2').val(data[8]);
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.modibtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#modinoti").modal("show");
          $('#id_notificaciones_gestor3').val(data[0]);
		  $('#id_gestor_catastral3').val(data[1]);
          $('#nombre_gestor_catastral3').val(data[2]);
		  $('#fecha_registro3').val(data[3]);
		  $('#plazo_respuesta3').val(data[4]);
		  $('#detalle_notificacion3').val(data[6]);
		  $('#id_tipo_notificacion3').val(data[9]);
		  $('#nombre_tipo_notificacion3').val(data[10]);
      });  
    });

</script>


<script>
    function validages() {
        var cod_gestor_cat = document.getElementById('cod_gestor_catastral').value;
		// alert (' Codigo: ' + cod_gestor_cat); tot = cod1+'-'+cod2;
        jQuery.ajax({
        type: "POST",url: "pages/valida_gestor.php",
		data: "cod_gestor_cat="+cod_gestor_cat,
		async: true,
         success: function(b) {
               validacion = b;
			   // alert (' RESP: ' + validacion);
			   if(validacion ==  10) {
			     alert (cod_gestor_cat + ' Ya existe....!!!');
			     document.getElementById('cod_gestor_catastral').value = ' ';
			     document.getElementById('cod_gestor_catastral').focus();
			   } else {
			     document.getElementById('nombre_gestor_catastral').focus();
			   }
         }
        });				
    }
</script>


<?php

function nivelc($id_funcionario, $id_grupo_area) {
		
global $mysqli;
 
    $query17 = "SELECT id_funcionario, nombre_funcionario
			  FROM funcionario 
			  WHERE id_funcionario != '$id_funcionario'
			   AND id_grupo_area = '$id_grupo_area'
			   AND id_cargo in(1,2,4)  
			   AND estado_funcionario =1 
			   UNION
			   SELECT 0, 'SIN REEMPLAZO' ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj17['id_funcionario'], $obj17['nombre_funcionario']);
    }
$result17->free();	
 }

 function ofireg($id_funcionario, $id_oficina_registro) {
    global $mysqli;		
    $query18 = "SELECT id_funcionario, nombre_funcionario
			  FROM funcionario 
			  WHERE id_funcionario != '$id_funcionario' 
			   AND id_oficina_registro = '$id_oficina_registro' 
			   AND id_cargo in(1,2,4)  
			   AND estado_funcionario =1 
			   UNION
			   SELECT 0, 'SIN REEMPLAZO' ";
    $result18 = $mysqli->query($query18);
    while ($obj18 = $result18->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj18['id_funcionario'], $obj18['nombre_funcionario']);
    }
   $result18->free();	
 }
 
function deptociud() {
		
global $mysqli;
 
    $query17 = "SELECT m.id_municipio id_municipio, 
	          concat(nombre_municipio,' - ', nombre_departamento) nom_municipio
			  FROM departamento d, municipio m 
			  WHERE d.id_departamento = m.id_departamento
			   AND d.estado_departamento = 1 
			   AND m.estado_municipio = 1
				ORDER BY nom_municipio ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj17['id_municipio'], $obj17['nom_municipio']);
    }
$result17->free();	
 }

function funcatastro() {
		
global $mysqli;
 
    $query37 = "SELECT id_funcionario, nombre_funcionario
			  FROM funcionario 
			  WHERE id_tipo_oficina = 7
			   AND estado_funcionario =1 ";
    $result37 = $mysqli->query($query37);
    while ($obj37 = $result37->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj37['id_funcionario'], $obj37['nombre_funcionario']);
    }
$result37->free();	
 }
 
 
 ?>

 
