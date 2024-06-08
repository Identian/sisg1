<?php

$nump147=privilegios(147,$_SESSION['snr']);


$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;
$id_tipo_ausentismo = 0;

// if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {
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
	   $id_tipo_oficina = $row5['id_tipo_oficina'];
	   $id_grupo_area = $row5['id_grupo_area'];
	   $id_oficina_registro = $row5['id_oficina_registro'];
   }
 
   if (isset($_GET['i'])) { 
//   $id_gestor_catastral=intval($_GET['i']);
   $id_contratos_gestor = intval($_GET['i']);
   } else {
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
   }

    } else { 
    echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 
 
if ($id_contratos_gestor > 0) { // Hasta el final
	
//	$id_gestor_catastral=intval($_GET['i']);
	 $id_contratos_gestor = intval($_GET['i']);
	
    $query4 = sprintf("SELECT e.id_contratos_gestor, e.id_gestor_catastral, 
	                                          cod_gestor_catastral,
			                                  nombre_gestor_catastral, a.id_natu_juridica_gestor, nit_gestor, 
											  a.digito_verificacion, a.repre_legal,
											  dir_gestor, tel_gestor, correo_gestor, acto_adtvo_habili,
											  acto_adtvo_prestaser,
											  fecha_habilitacion, jurisdiccion_xhabilitacion,
											  jurisdiccion_xcontrato, fecha_inicio, fecha_fin,
											  nombre_natu_juridica_gestor,
											  a.id_funcionario_catastro, d.nombre_funcionario,
											  e.num_contrato, e.repre_legal repre_legalcontra, e.id_tipo_contrato_gestor, 
											  f.nombre_tipo_contrato_gestor, e.detalle_otros, e.objeto_contrato,
											  e.obligaciones_partes, e.valor_contrato, e.duracion_meses,
											  e.duracion_dias, e.fecha_firma_contrato, e.fecha_inicio_servicio,
											  e.fecha_fin_servicio
	 FROM contratos_gestor e
	  LEFT JOIN gestor_catastral a
	  ON e.id_gestor_catastral = a.id_gestor_catastral
      LEFT JOIN natu_juridica_gestor g
	 ON a.id_natu_juridica_gestor = g.id_natu_juridica_gestor
 	 LEFT JOIN funcionario d
	 ON a.id_funcionario_catastro = d.id_funcionario
	LEFT JOIN tipo_contrato_gestor f
	ON e.id_tipo_contrato_gestor = f.id_tipo_contrato_gestor
    WHERE e.id_contratos_gestor = '$id_contratos_gestor'
	 AND e.estado_contratos_gestor = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
    $id_contratos_gestor = $row4['id_contratos_gestor'];
	$id_gestor_catastral = $row4['id_gestor_catastral'];
    $cod_gestor_catastral = $row4['cod_gestor_catastral'];
	$nombre_gestor_catastral = $row4['nombre_gestor_catastral'];
	$id_natu_juridica_gestor = $row4['id_natu_juridica_gestor'];
	$nombre_natu_juridica_gestor = $row4['nombre_natu_juridica_gestor'];
	$natu_juridica = $row4['id_natu_juridica_gestor'].' - '.$row4['nombre_natu_juridica_gestor'];
	$nit_gestor = $row4['nit_gestor'];
	$digito_verificacion = $row4['digito_verificacion'];
	$tnit_gestor = $row4['nit_gestor'].'-'.$row4['digito_verificacion'];
	$repre_legal = $row4['repre_legal'];
	$id_funcionario_catastro = $row4['id_funcionario_catastro'];
	$nombre_funcionario = $row4['nombre_funcionario'];
	$dir_gestor = $row4['dir_gestor'];
	$tel_gestor = $row4['tel_gestor'];
	$totel = strlen ($tel_gestor);
	$ttel_gestor = $tel_gestor;
	$correo_gestor = $row4['correo_gestor'];
	$acto_adtvo_habili = $row4['acto_adtvo_habili'];
	$acto_adtvo_prestaser = $row4['acto_adtvo_prestaser'];
	$fecha_habilitacion= $row4['fecha_habilitacion'];
	$fecha_inicio = $row4['fecha_inicio'];
	$fecha_fin= $row4['fecha_fin'];
	$jurisdiccion_xhabilitacion = $row4['jurisdiccion_xhabilitacion'];
	$jurisdiccion_xcontrato = $row4['jurisdiccion_xcontrato'];

	$num_contrato  =  $row4['num_contrato'];
	$repre_legalcontra  =  $row4['repre_legalcontra'];
	$id_tipo_contrato_gestor  =  $row4['id_tipo_contrato_gestor'];
	$nombre_tipo_contrato_gestor  =  $row4['nombre_tipo_contrato_gestor'];
	$detalle_otros  =  $row4['detalle_otros'];
	$objeto_contrato  =  $row4['objeto_contrato'];
	$obligaciones_partes  =  $row4['obligaciones_partes'];
	$valor_contrato  =  $row4['valor_contrato'];
	$duracion_meses  =  $row4['duracion_meses'];
	$duracion_dias  =  $row4['duracion_dias'];
	$fecha_firma_contrato  =  $row4['fecha_firma_contrato'];
	$fecha_inicio_servicio  =  $row4['fecha_inicio_servicio'];
	$fecha_fin_servicio  =  $row4['fecha_fin_servicio'];
 }


mysql_free_result($select4);


if ((isset($_POST["insertmcontra"])) && ($_POST["insertmcontra"] == "mcontrato")) { // 1
     $num_otrosi = $_POST['num_otrosi'];
	 $id_contratos_gestor = $_POST['id_contratos_gestor'];
	 $nombre_modifi_contratos_gestor = 'OTROSI CONTRATO';
     $nombre_img2 = ' ';
	 $nombre_img3 = ' ';
	 $detalle_otros = ' ';
	 $num_otrosi2 = 0;
	 if (isset($_POST["detalle_otros"]) && strlen($_POST["detalle_otros"]) > 5) {
	    $detalle_otros = $_POST['detalle_otros'];
	 } else {
	 $detalle_otros = ' ';
	 }

global $mysqli;
 
    $query37 = "SELECT *
			  FROM modifi_contratos_gestor 
			  WHERE id_contratos_gestor = $id_contratos_gestor
			   AND num_otrosi = $num_otrosi 
			   AND estado_modifi_contratos_gestor = 1 ";
    $result37 = $mysqli->query($query37);
    while ($obj37 = $result37->fetch_array()) {
        $num_otrosi2 = $obj37['num_otrosi'];
    }
$result37->free();	

if ($num_otrosi != $num_otrosi2) {
    // FILE = CONTRATO	
   if (isset($_FILES['file5']) and strlen($_FILES['file5']['name']) > 4){ // 2
//     if (1 == 1){ 
	 
      $tipoArchivo=explode("/",$_FILES["file5"]["type"]);
      $ubicacion="filesnr/catastrosnr/";
	  $NomImagen2=$_FILES['file5']['name'];
	  $totarchivo=explode(".",$_FILES["file5"]["name"]);
	  $nombre_img2='CONTRATO-'.$id_contratos_gestor.'-'.$num_otrosi.'-'.$aleatorio.'.pdf';
      $NomImagenR=$ubicacion."/".$nombre_img2;

      if (($_FILES['file5']['name'] == !NULL) && ($_FILES['file5']['size'] <= 11534336)) { // 3
	    if ($_FILES["file5"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file5']['tmp_name'],$NomImagenR);
				  
        } else { 
		     $nombre_img2= ' ';
			} // fin 4 
      } else { 
	          $nombre_img2= ' ';
		} // fin 3
  } else { 
      $nombre_img2= ' ';
  } // fin 2
	
		
	$insertSQL5 = sprintf("INSERT INTO modifi_contratos_gestor (
      id_contratos_gestor, num_otrosi, id_moditipo_contrato_gestor, 
      detalle_otros, objeto_modifi_contrato, fecha_modifi_contrato, 
	  fecha_inicio_prorroga, fecha_fin_prorroga, fecha_fin_contrato, 
	  fecha_inicio_suspension, fecha_fin_suspension, valor_modificacion, 
	  docto_otrosi, nombre_modifi_contratos_gestor, fecha_registro) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now())", 
      GetSQLValueString($_POST['id_contratos_gestor'], "int"), 
      GetSQLValueString($_POST['num_otrosi'], "text"), 
	  GetSQLValueString($_POST['id_moditipo_contrato_gestor'], "text"), 
      GetSQLValueString($detalle_otros, "text"), 
	  GetSQLValueString($_POST['objeto_modifi_contrato'], "text"),
	  GetSQLValueString($_POST['fecha_modifi_contrato'], "date"),
      GetSQLValueString($_POST['fecha_inicio_prorroga'], "date"), 
      GetSQLValueString($_POST['fecha_fin_prorroga'], "date"), 
	  GetSQLValueString($_POST['fecha_fin_contrato'], "date"),
	  GetSQLValueString($_POST['fecha_inicio_suspension'], "date"),
	  GetSQLValueString($_POST['fecha_fin_suspension'], "date"),
      GetSQLValueString($_POST['valor_modificacion'], "text"),
	  GetSQLValueString($nombre_img2, "text"),
	  GetSQLValueString($nombre_modifi_contratos_gestor, "text")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());
	  
//  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_gestor&'.$id_gestor_catastral.'.jsp" />';
}
} 
?>

<script>
     $(document).ready(function() {
      $('.nuevoc').on('click', function() {   
	 alert ('entro en llamdo de nvocontrato');	  
          $("#contrato").modal("show");
      });  
    });

</script>

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
			    <li><a href="consulta_gestor&<?php echo $id_gestor_catastral; ?>.jsp"><b>GESTOR CATASTRAL</b></a></li>
            </ul>
        </div>
		 
      </div>
    </nav>
  </div>
</div>

<?php
// *******************************
// Consulta Gestor
// *******************************		
?>

<div class="row">
    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <div class="row-md-6 text-left">
                 <h3 class="box-title"><b>CONTRATO DEL GESTOR CATASTRAL</b></h3> &nbsp; &nbsp; 
<!--     		     <a id="" class="ventana1" data-toggle="modal" data-target="#updgestor" href="" title="Modificar Gestor"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></a> -->
                 <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
				 <button type="button" class="btn btn-xs btn-warning modicoge"><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
				 <?php } ?>
   </div>
             <input type="hidden" class="form-control" name="tot_causantes" id="tot_causantes" readonly="readonly" value="">
		  <div class="row-md-6 text-right">
	</div>
	    <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Gestor:</label>   
                       <?php echo $row4['cod_gestor_catastral'].' - '.$row4['nombre_gestor_catastral']; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Naturaleza Jurídica:</label>   
                       <?php echo $nombre_natu_juridica_gestor; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">NIT Gestor:</label>   
                       <?php echo $tnit_gestor; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Representante Legal:</label>   
                       <?php echo $row4['repre_legal']; ?>
                    </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Dirección Gestor:</label>   
                        <?php echo $row4['dir_gestor']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Teléfono Gestor:</label>   
                        <?php echo $ttel_gestor; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Correo Gestor:</label>   
                        <?php echo $row4['correo_gestor']; ?>
                  </div>
				  <div class="form-group text-left"> 
                        <label  class="control-label"> Fecha Habilitación:</label>   
                        <?php echo $row4['fecha_habilitacion']; ?>
                  </div>
            </div>
            <div class="col-md-6">
                  <div class="form-group text-left"> 
                        <label  class="control-label">Número Contrato:</label>   
                        <?php echo $row4['num_contrato']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Representante Legal Contrato:</label>   
                        <?php echo $row4['repre_legalcontra']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Tipo Contrato:</label>   
                        <?php echo $row4['nombre_tipo_contrato_gestor']; ?>
                  </div>
				  <?php if ($id_natu_juridica_gestor < 1 || $id_natu_juridica_gestor == 9) { ?>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Detalle Otros:</label>   
                        <?php echo $row4['detalle_otros']; ?>
                  </div>
				  <?php } ?>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Valor Contrato:</label>   
                        <?php echo number_format($row4['valor_contrato']); ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Duración Contrato:</label>   
                        <?php echo $row4['duracion_meses'].' Meses y '.$row4['duracion_dias'].' Días'; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Firma Contrato:</label>   
                        <?php echo $row4['fecha_firma_contrato']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Inicio Servicio:</label>   
                        <?php echo $row4['fecha_inicio_servicio']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Terminación Servicio:</label>   
                        <?php echo $row4['fecha_fin_servicio']; ?>
                  </div>
				</div>  
             </div>
        </div>
  </div>
  </div>
   </div> 
 </div>

<?php

// **********************************************
// Nueva Modificacion al Contrato Gestor
// **********************************************
?>
<div class="modal fade" id="ncontrato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVA MODIFICACIÓN AL CONTRATO</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form4311567534555"  enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_contratos_gestor" name="id_contratos_gestor" value="<?php echo $id_contratos_gestor; ?>">
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Número Otrosi Contrato:</label>   
        <input type="text" class="form-control" id="num_otrosi" name="num_otrosi" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Objeto Modificación Contrato:</label>   
		<textarea type="text"  rows="5" cols="40" class="form-control" id="objeto_modifi_contrato"  name="objeto_modifi_contrato"  value="" required></textarea>
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Modificación Contrato:</label>   
        <input type="date" class="form-control" id="fecha_modifi_contrato" name="fecha_modifi_contrato" value="" required >
    </div>

    <div id = "detotros2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Detalle Otros:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="detalle_otros"  name="detalle_otros"  value=""></textarea>
    </div>

    <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Modificación Contrato:</label> 
        <select class="form-control" name="id_moditipo_contrato_gestor" id="id_moditipo_contrato_gestor" onChange = "valotros();">
        <option value="" selected></option>
          <?php echo lista('moditipo_contrato_gestor'); ?>
        </select>
    </div>

    <div id = "valotrosi2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Valor Modificación Contrato:</label>   
        <input type="number" class="form-control text-right" id="valor_modificacion" name="valor_modificacion" value="">
    </div>

    <div id = "fincontra2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Contrato:</label>   
        <input type="date" class="form-control" id="fecha_fin_contrato" name="fecha_fin_contrato" value="">
    </div>

    <div id = "iniprorro2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio Prorroga:</label>   
        <input type="date" class="form-control" id="fecha_inicio_prorroga" name="fecha_inicio_prorroga" value="">
    </div>

    <div id = "finprorro2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Prorroga:</label>   
        <input type="date" class="form-control" id="fecha_fin_prorroga" name="fecha_fin_prorroga" value="">
    </div>

    <div id = "inisuspe2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio Suspensión:</label>   
        <input type="date" class="form-control" id="fecha_inicio_suspension" name="fecha_inicio_suspension" value="">
    </div>

    <div id = "finsuspe2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Suspension:</label>   
        <input type="date" class="form-control" id="fecha_fin_suspension" name="fecha_fin_suspension" value="">
    </div>

    <div id = "acontrato" class="form-group text-left" style="display:block;"> 
        <label  class="control-label"> ADJUNTAR CONTRATO:</label> 
        <input type="file" value=""  id="file5" name="file5" required>
        <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
    </div>

	<div class="modal-footer">
        <span style="color:#ff0000;">(*) Campos obligatorios</span>
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="insertmcontra" value="mcontrato">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 


 
 <?php
 // *************************************************
 // Detalle Modificaciones al contrato Gestor
 // *************************************************
 ?>
 
 		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'MODIFICACIONES AL CONTRATOS DEL GESTOR'; ?>
					   </h4>
                       <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>					   
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ncontrato"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Modificación al Contrato</a> 
					   </h4> 
					   <?php } ?>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID</th>
                                <th>Num Otrosi</th>
								<th>Tipo Modificación</th>
                                <th>Descripción Tipo</th>
								<th style="display:none;">Detalle Otros</th>
								<th>Objeto Modificación</th>
                                <th>Fecha Modificación</th>
								<th style="display:none;">Fecha Inicio Prorroga</th>
								<th style="display:none;">Fecha Fin Prorroga</th>
								<th style="display:none;">Fecha Fin Contrato</th>
								<th style="display:none;">Fecha Inicio Suspension</th>
								<th style="display:none;">Fecha Fin Suspension</th>
                                <th>Valor Modificación</th>
                                <th colspan="4">Acción</th>
                             </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT id_modifi_contratos_gestor, 
			    id_contratos_gestor, num_otrosi, a.id_moditipo_contrato_gestor,
			    b.nombre_moditipo_contrato_gestor, detalle_otros, objeto_modifi_contrato, 
				fecha_modifi_contrato, fecha_inicio_prorroga, fecha_fin_prorroga,
				fecha_fin_contrato, fecha_inicio_suspension, fecha_fin_suspension,
				valor_modificacion, docto_otrosi
	            FROM modifi_contratos_gestor a
				LEFT JOIN moditipo_contrato_gestor b
				ON a.id_moditipo_contrato_gestor = b.id_moditipo_contrato_gestor
                WHERE id_contratos_gestor = '$id_contratos_gestor'  
				AND estado_modifi_contratos_gestor = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	 
			      $id_modifi_contratos_gestor = $row62['id_modifi_contratos_gestor'];
                  $id_contratos_gestor = $row62['id_contratos_gestor'];			  
            ?>
          <tr>
             <td><?php echo $row62['id_modifi_contratos_gestor']; ?></td>
             <td><?php echo $row62['num_otrosi'];?></td>
			 <td><?php echo $row62['id_moditipo_contrato_gestor']; ?></td>
             <td><?php echo $row62['nombre_moditipo_contrato_gestor']; ?></td>
			 <td style="display:none;"><?php echo $row62['detalle_otros']; ?></td>
			 <td><?php echo $row62['objeto_modifi_contrato']; ?></td>
			 <td><?php echo $row62['fecha_modifi_contrato']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_inicio_prorroga']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_fin_prorroga']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_fin_contrato']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_inicio_suspension']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_fin_suspension']; ?></td>
             <td><?php echo $row62['valor_modificacion']; ?></td>
		     <?php if(strlen($row62['docto_otrosi']) > 4  && strlen($row62['docto_otrosi']) > 4) { ?> 
		     <td> 
			    <a href="filesnr/catastrosnr/<?php echo $row62['docto_otrosi']; ?>"  title="Contrato" target = '_blank' >
		       <img src="images/pdf.png"></a>
			 </td>
		     <?php } else { echo ""; } ?>
		     
		     <td> 
			 <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
               <button type="button" class="btn btn-primary btn-xs editbtn" title="Consultar Modificación al Contrato"><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="modifi_contratos_gestor" id="<?php echo $row62['id_modifi_contratos_gestor']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
			 <?php } ?>
			 </td>
          </tr>
          <?php } ?> 
          </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->


<?php
// ********************************************************
// MODIFICACION DATOS CONTRATO GESTOR
// ********************************************************
?>
		
<div class="modal fade" id="updgestor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN DATOS CONTRATO GESTOR</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="post" name="form43257435224">

    <input type="hidden" class="form-control" name="id_gestor_catastral" id="id_gestor_catastral" value="<?php echo $id_gestor_catastral; ?>">
	<input type="hidden" class="form-control" name="id_contratos_gestor" id="id_contratos_gestor" value="<?php echo $id_contratos_gestor; ?>">

    <div class="form-group text-left"> 
        <label  class="control-label">Gestor:</label>   
        <?php echo $row4['cod_gestor_catastral'].' - '.$row4['nombre_gestor_catastral']; ?>
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">Número Contrato:</label>   
      <input type="text" class="form-control" name="num_contrato" value="<?php echo $num_contrato; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Representante Legal Contrato:</label>   
      <input type="text" class="form-control" name="repre_legal" value="<?php echo $repre_legalcontra; ?>">
    </div>
	
    <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Contrato:</label> 
        <select class="form-control" name="id_tipo_contrato_gestor" id="id_tipo_contrato_gestor" onChange = "valtipoc();">
        <option value="<?php echo $id_tipo_contrato_gestor ?>" selected><?php echo $nombre_tipo_contrato_gestor ?></option>
          <?php echo lista('tipo_contrato_gestor'); ?>
        </select>
    </div>
	
    <div id = "detotros3" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Detalle Otros:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="detalle_otros3"  name="detalle_otros3"  value=""><?php echo $detalle_otros ?></textarea>
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">Objeto del contrato:</label>   
      <textarea type="text"  rows="5" cols="40" class="form-control" id="objeto_contrato"  name="objeto_contrato"  value=""><?php echo $objeto_contrato ?></textarea>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Obligaciones Partes:</label>   
      <textarea type="text"  rows="5" cols="40" class="form-control" id="obligaciones_partes"  name="obligaciones_partes"  value=""><?php echo $obligaciones_partes ?></textarea>
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Valor Contrato:</label>   
      <input type="number" class="form-control text-right" name="valor_contrato" value="<?php echo $valor_contrato; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Duración en Meses:</label>   
      <input type="text" class="form-control" name="duracion_meses" value="<?php echo $duracion_meses; ?>">
    </div>

     <div class="form-group text-left"> 
      <label  class="control-label">Duración en Días:</label>   
      <input type="text" class="form-control" name="duracion_dias" value="<?php echo $duracion_dias; ?>">
    </div>

   <div class="form-group text-left"> 
      <label  class="control-label">Fecha Firma Contrato:</label>   
      <input type="date" class="form-control" name="fecha_firma_contrato" value="<?php echo $fecha_firma_contrato; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Fecha Inicio Servicio:</label>   
      <input type="date" class="form-control" name="fecha_inicio_servicio" value="<?php echo $fecha_inicio_servicio; ?>">
    </div>

   <div class="form-group text-left"> 
      <label  class="control-label">Fecha Terminación Servicio:</label>   
      <input type="date" class="form-control" name="fecha_fin_servicio" value="<?php echo $fecha_fin_servicio; ?>">
    </div>

	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="mcontragestor" value="mcgestor">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>

<?php
// **************************************************
// Modificacion de la modifi Contrato Gestor
// **************************************************
?>

<div class="modal fade"  id="modiconges" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>ACTUALIZACIÓN MODIFICACIÓN CONTRATO GESTOR</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4324424" enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_contratos_gestor5" id="id_contratos_gestor5" readonly="readonly" value="<?php echo $id_contratos_gestor; ?>">
	<input type="hidden" class="form-control" name="id_modifi_contratos_gestor5" id="id_modifi_contratos_gestor5" readonly="readonly" value="<?php echo $id_gestor_catastral; ?>">

	
    <div class="form-group text-left"> 
      <label  class="control-label">Número Contrato:</label>   
      <input type="text" class="form-control" name="num_otrosi5" id="num_otrosi5" readonly="readonly" value="">
    </div>

    <div  id ="detotros5" class="form-group text-left" style="display:none;"> 
      <label  class="control-label">Detalle Otros:</label>   
      <textarea type="text"  rows="5" cols="40" class="form-control" id="detalle_otros5"  name="detalle_otros5"  value=""></textarea>
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">Objeto Modificación Contrato:</label>   
	  <textarea type="text"  rows="5" cols="40" class="form-control" id="objeto_modifi_contrato5"  name="objeto_modifi_contrato5"  value="" required></textarea>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Modificación Contrato:</label>   
      <input type="date" class="form-control" name="fecha_modifi_contrato5" id="fecha_modifi_contrato5" value="" required >
    </div>
	
    <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Modificación Contrato:</label> 
        <select class="form-control" name="id_moditipo_contrato_gestor5" id="id_moditipo_contrato_gestor5" onChange = "tipomodc();">
        <option value="" selected></option>
          <?php echo lista('moditipo_contrato_gestor'); ?>
        </select>
    </div>

    <div id = "valotrosi5" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Valor Modificación Contrato:</label>   
        <input type="number" class="form-control text-right" id="valor_modificacion5" name="valor_modificacion5" value="">
    </div>

    <div id = "fincontra5" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Contrato:</label>   
        <input type="date" class="form-control" id="fecha_fin_contrato5" name="fecha_fin_contrato5" value="">
    </div>

    <div id = "iniprorro5" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio Prorroga:</label>   
        <input type="date" class="form-control" id="fecha_inicio_prorroga5" name="fecha_inicio_prorroga5" value="">
    </div>

    <div id = "finprorro5" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Prorroga:</label>   
        <input type="date" class="form-control" id="fecha_fin_prorroga5" name="fecha_fin_prorroga5" value="">
    </div>

    <div id = "inisuspe5" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio Suspensión:</label>   
        <input type="date" class="form-control" id="fecha_inicio_suspension5" name="fecha_inicio_suspension5" value="">
    </div>

    <div id = "finsuspe5" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Suspension:</label>   
        <input type="date" class="form-control" id="fecha_fin_suspension5" name="fecha_fin_suspension5" value="">
    </div>

    <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actmodcontra" value="modcontrato">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>





<?php 
}

// mysql_free_result($update);

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

<?php

// *************************************************
// Registro Modificacion al contrato Gestor
// *************************************************

if (isset($_POST['mcontragestor']) && $_POST['mcontragestor'] == 'mcgestor'){

	$id_gestor_catastral = $_POST['id_gestor_catastral'];
    $id_contratos_gestor = $_POST['id_contratos_gestor'];
// archiva documento
/*
   if (""!=$_FILES['file']['tmp_name']) { // 2

      $id_ausentismo2 = $_POST['id_ausentismo2'];
   

      $tipoArchivo=explode("/",$_FILES["file"]["type"]);
      $ubicacion="filesnr/ausentismosnr/";
	  $NomImagen=$_FILES['file']['name'];
	  $totarchivo=explode(".",$_FILES["file"]["name"]);
	  $aleatorio = aleatorio(100);
	  
	 //  echo $totarchivo[0];
	 $nombre_img=$id_ausentismo.'-'.$id_funcionario.'-'.$aleatorio.'.pdf';
	 
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
      $NomImagenR=$ubicacion."/".$nombre_img;
	 
     

      if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 11534336)) { // 3
	    if ($_FILES["file"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file']['tmp_name'],$NomImagenR);
			
//          $nombrebre_orig= ucwords($nombrefile);
//          $hash=md5($files);
            $id_tipo_docto_ausentismo = 1; // 1 = Resolucion
            $descrip_docto_ausentismo = "RESOLUCION DEL AUSENTISMO";
			
            $insertSQL = sprintf("INSERT INTO docto_ausentismo (id_ausentismo, 
		    id_tipo_docto_ausentismo, nombre_docto_ausentismo, 
			descrip_docto_ausentismo, estado_docto_ausentismo, 
		    fecha_registro) 
            VALUES (%s, %s, %s, %s, 1, now())", 
            GetSQLValueString($id_ausentismo2, "int"), 
            GetSQLValueString($id_tipo_docto_ausentismo, "int"),
            GetSQLValueString($nombre_img, "text"),
			GetSQLValueString( $descrip_docto_ausentismo, "text"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
		  
 //           echo $insertado;
            echo ' ';
        } else { $valido=0; echo  $doc_no_tipo;
	           echo ' ';
			} // fin 4 
      } else { $valido=0; echo $doc_tam;
	         echo ' ';
		} // fin 3
		
		
  }	
*/	
	$detalle_otros = ' ';
	
	 if (isset($_POST["detalle_otros3"]) && strlen($_POST["detalle_otros3"]) > 5) {
	    $detalle_otros = $_POST['detalle_otros3'];
	 } else {
	 $detalle_otros = ' ';
	 }

	
    $updateSQL37 = sprintf("UPDATE contratos_gestor 
	        SET num_contrato = %s,
			repre_legal = %s, 
	        id_tipo_contrato_gestor = %s,
			detalle_otros = %s,
			objeto_contrato = %s,
			obligaciones_partes = %s,
			valor_contrato = %s,
			duracion_meses = %s,
			duracion_dias = %s,
			fecha_firma_contrato = %s,
			fecha_inicio_servicio = %s,
			fecha_fin_servicio = %s
			WHERE id_contratos_gestor = %s",                  
	GetSQLValueString($_POST['num_contrato'], "text"),
	GetSQLValueString($_POST['repre_legal'], "text"),
	GetSQLValueString($_POST['id_tipo_contrato_gestor'], "text"),
	GetSQLValueString($detalle_otros, "text"),
	GetSQLValueString($_POST['objeto_contrato'], "text"),
	GetSQLValueString($_POST['obligaciones_partes'], "text"),
	GetSQLValueString($_POST['valor_contrato'], "text"),
	GetSQLValueString($_POST['duracion_meses'], "text"),
	GetSQLValueString($_POST['duracion_dias'], "text"),
	GetSQLValueString($_POST['fecha_firma_contrato'], "date"),
	GetSQLValueString($_POST['fecha_inicio_servicio'], "date"),
	GetSQLValueString($_POST['fecha_fin_servicio'], "date"),
	GetSQLValueString($id_contratos_gestor, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./modi_contrato_gestor&'.$id_contratos_gestor.'.jsp" />';
 }

?>

<?php

// *****************************************
// Registro de Modificacion Contrato
// *****************************************

if (isset($_POST['actmodcontra']) && $_POST['actmodcontra'] == 'modcontrato'){

	$id_modifi_contratos_gestor = $_POST['id_modifi_contratos_gestor5'];
	$id_contratos_gestor = $_POST['id_contratos_gestor5'];
	$detalle_otros = ' ';
	
	 if (isset($_POST["detalle_otros5"]) && strlen($_POST["detalle_otros5"]) > 5) {
	    $detalle_otros = $_POST['detalle_otros5'];
	 } else {
	 $detalle_otros = ' ';
	 }

    $updateSQL37 = sprintf("UPDATE modifi_contratos_gestor 
	        SET num_otrosi = %s,	
			detalle_otros = %s,
			objeto_modifi_contrato = %s,
			fecha_modifi_contrato = %s,
			fecha_inicio_prorroga = %s,
			fecha_fin_prorroga = %s,
			fecha_fin_contrato = %s,
			fecha_inicio_suspension = %s,
			fecha_fin_suspension = %s,
			valor_modificacion = %s
			WHERE id_modifi_contratos_gestor = %s",                  
	GetSQLValueString($_POST['num_otrosi5'], "text"),
	GetSQLValueString($detalle_otros, "text"),
	GetSQLValueString($_POST['objeto_modifi_contrato5'], "text"),
	GetSQLValueString($_POST['fecha_modifi_contrato5'], "date"),
	GetSQLValueString($_POST['fecha_inicio_prorroga5'], "text"),
	GetSQLValueString($_POST['fecha_fin_prorroga5'], "text"),
	GetSQLValueString($_POST['fecha_fin_contrato5'], "text"),
	GetSQLValueString($_POST['fecha_inicio_suspension5'], "text"),
	GetSQLValueString($_POST['fecha_fin_suspension5'], "text"),
	GetSQLValueString($_POST['valor_modificacion5'], "text"),
	GetSQLValueString($id_modifi_contratos_gestor, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./modi_contrato_gestor&'.$id_contratos_gestor.'.jsp" />';
 }

?>


<?php
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
?>

<script>
    function valcontrato() {
	var natu_jurigestor = document.getElementById('id_natu_juridica_gestor').value;
		if ( natu_jurigestor <= 3 || natu_jurigestor == 6) {
			acontrato.style.display='block';
			document.getElementById('id_municipio').focus();
		} else {
			acontrato.style.display='none';
//			document.getElementById('file').value = ' ';
			document.getElementById('id_municipio').focus();
        }
    }
</script>

<script>
    function valtipoc() {
	
	var id_moditipo_contrato_gestor = document.getElementById('id_tipo_contrato_gestor').value;
//    alert ("valor: " + id_moditipo_contrato_gestor);
	if (id_moditipo_contrato_gestor == 1) { // Consutoria
			   detotros3.style.display='none';
			   document.getElementById('objeto_contrato').focus();
	} 
	if (id_moditipo_contrato_gestor == 2) { // prestacion de servicios
			   detotros3.style.display='none';
			   document.getElementById('objeto_contrato').focus();
	} 
	 if (id_moditipo_contrato_gestor == 3) { // otros
			   detotros3.style.display='block';
			   document.getElementById('detalle_otros3').focus();
	} 

}
</script>

<script>
    function valotros() {
	
	var id_moditipo_contrato_gestor = document.getElementById('id_moditipo_contrato_gestor').value;
//    alert ("valor: " + id_moditipo_contrato_operador);
	if (id_moditipo_contrato_gestor == 1) { // prorroga
			   detotros2.style.display='none';
			   valotrosi2.style.display='none';
			   inisuspe2.style.display='none';
			   finsuspe2.style.display='none';
			   fincontra2.style.display='none';
			   iniprorro2.style.display='block';
			   finprorro2.style.display='block';
			   document.getElementById('detalle_otros').value = ' ';
			   document.getElementById('fecha_inicio_suspension').value = ' ';
			   document.getElementById('fecha_fin_suspension').value = ' ';
			   document.getElementById('fecha_fin_contrato').value = ' ';
			   document.getElementById('valor_modificacion').value = 0;
			   document.getElementById('fecha_inicio_prorroga').focus();
	} 
	if (id_moditipo_contrato_gestor == 2) { // adicion
			   detotros2.style.display='none';
			   iniprorro2.style.display='none';
			   finprorro2.style.display='none';
			   inisuspe2.style.display='none';
			   finsuspe2.style.display='none';
			   fincontra2.style.display='none';
			   valotrosi2.style.display='block';
			   document.getElementById('detalle_otros').value = ' ';
			   document.getElementById('fecha_inicio_prorroga').value = ' ';
			   document.getElementById('fecha_fin_prorroga').value = ' ';
			   document.getElementById('fecha_inicio_suspension').value = ' ';
			   document.getElementById('fecha_fin_suspension').value = ' ';
			   document.getElementById('fecha_fin_contrato').value = ' ';
			   document.getElementById('valor_modificacion').value = 0;
			   document.getElementById('valor_modificacion').focus();
	} 
	 if (id_moditipo_contrato_gestor == 3) { // cesion
			   detotros2.style.display='block';
			   iniprorro2.style.display='none';
			   finprorro2.style.display='none';
			   inisuspe2.style.display='none';
			   finsuspe2.style.display='none';
			   fincontra2.style.display='none';
			   valotrosi2.style.display='none';
			   document.getElementById('fecha_inicio_prorroga').value = ' ';
			   document.getElementById('fecha_fin_prorroga').value = ' ';
			   document.getElementById('fecha_inicio_suspension').value = ' ';
			   document.getElementById('fecha_fin_suspension').value = ' ';
			   document.getElementById('fecha_fin_contrato').value = ' ';
			   document.getElementById('valor_modificacion').value = 0;
			   document.getElementById('valor_modificacion').focus();
	} 
	 if (id_moditipo_contrato_gestor == 4) { // terminacion
			   fincontra2.style.display='block';
			   detotros2.style.display='none';
			   iniprorro2.style.display='none';
			   finprorro2.style.display='none';
			   valotrosi2.style.display='none';
			   inisuspe2.style.display='none';
			   finsuspe2.style.display='none';
			   document.getElementById('detalle_otros').value = ' ';
			   document.getElementById('fecha_inicio_prorroga').value = ' ';
			   document.getElementById('fecha_fin_prorroga').value = ' ';
			   document.getElementById('fecha_inicio_suspension').value = ' ';
			   document.getElementById('fecha_fin_suspension').value = ' ';
			   document.getElementById('valor_modificacion').value = 0;
			   document.getElementById('fecha_fin_contrato').focus();
	} 
	if (id_moditipo_contrato_gestor == 5) { // suspension
			   inisuspe2.style.display='block';
			   finsuspe2.style.display='block';
			   detotros2.style.display='none';
			   iniprorro2.style.display='none';
			   finprorro2.style.display='none';
			   fincontra2.style.display='none';
			   valotrosi2.style.display='none';
			   document.getElementById('detalle_otros').value = ' ';
			   document.getElementById('fecha_inicio_prorroga').value = ' ';
			   document.getElementById('fecha_fin_prorroga').value = ' ';
			   document.getElementById('fecha_fin_contrato').value = ' ';
			   document.getElementById('valor_modificacion').value = 0;
			   document.getElementById('fecha_inicio_suspension').focus();
	} 
	if (id_moditipo_contrato_gestor == 6) { // otros
			   detotros2.style.display='block';
			   iniprorro2.style.display='none';
			   finprorro2.style.display='none';
			   fincontra2.style.display='none';
			   inisuspe2.style.display='none';
			   finsuspe2.style.display='none';
			   valotrosi2.style.display='none';
			   document.getElementById('fecha_inicio_prorroga').value = ' ';
			   document.getElementById('fecha_fin_prorroga').value = ' ';
			   document.getElementById('fecha_inicio_suspension').value = ' ';
			   document.getElementById('fecha_fin_suspension').value = ' ';
			   document.getElementById('fecha_fin_contrato').value = ' ';
			   document.getElementById('valor_modificacion').value = 0;
			   document.getElementById('detalle_otros').focus();
	}
}
</script>

<script>
    function tipomodc() {
	
	var id_moditipo_contrato_gestor = document.getElementById('id_moditipo_contrato_gestor5').value;
//    alert ("valor: " + id_moditipo_contrato_operador);
	if (id_moditipo_contrato_gestor == 1) { // prorroga
			   detotros5.style.display='none';
			   valotrosi5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   fincontra5.style.display='none';
			   iniprorro5.style.display='block';
			   finprorro5.style.display='block';
			   document.getElementById('detalle_otros5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension5').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   document.getElementById('fecha_inicio_prorroga5').focus();
	} 
	if (id_moditipo_contrato_gestor == 2) { // adicion
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   fincontra5.style.display='none';
			   valotrosi5.style.display='block';
			   document.getElementById('detalle_otros5').value = ' ';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension5').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   document.getElementById('valor_modificacion5').focus();
	} 
	 if (id_moditipo_contrato_gestor == 3) { // cesion
			   detotros5.style.display='block';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   fincontra5.style.display='none';
			   valotrosi5.style.display='none';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension5').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   document.getElementById('valor_modificacion5').focus();
	} 
	 if (id_moditipo_contrato_gestor == 4) { // terminacion
			   fincontra5.style.display='block';
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   valotrosi5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   document.getElementById('detalle_otros5').value = ' ';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   document.getElementById('fecha_fin_contrato5').focus();
	} 
	if (id_moditipo_contrato_gestor == 5) { // suspension
			   inisuspe5.style.display='block';
			   finsuspe5.style.display='block';
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   fincontra5.style.display='none';
			   valotrosi5.style.display='none';
			   document.getElementById('detalle_otros5').value = ' ';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   document.getElementById('fecha_inicio_suspension5').focus();
	} 
	if (id_moditipo_contrato_gestor == 6) { // otros
			   detotros5.style.display='block';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   fincontra5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   valotrosi5.style.display='none';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   document.getElementById('detalle_otros5').focus();
	}
}
</script>


<script>
    function televal() {
	var tel_gestor = document.getElementById('tel_gestor').value;

	var lontel = tel_gestor.length;

//		alert("longitud tel: " + lontel);
		if (lontel < 7 || (lontel > 7 && lontel < 10)) {
		   alert("Número incorrecto (Teléfono de 7 digitos o Celular de 10 digitos) ...!!!");
		   document.getElementById('tel_gestor').focus();
		} 
    }
</script>

<script>
     $(document).ready(function() {
	  $('.modicoge').on('click', function() { 
	  $("#updgestor").modal("show");
     var id_tipo_contrato_gestor = document.getElementById('id_tipo_contrato_gestor').value;
     if (id_tipo_contrato_gestor == 3) {
	    detotros3.style.display='block';
	 }
	  })
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
          $("#modiconges").modal("show");
          $('#id_modifi_contratos_gestor').val(data[0]);
          $('#num_otrosi5').val(data[1]);
          $('#id_moditipo_contrato_gestor5').val(data[2]);
//		  $('#nombre_moditipo_contrato_gestor2').val(data[3]);
          $('#detalle_otros5').val(data[4]);
          $('#objeto_modifi_contrato5').val(data[5]);
		  $('#fecha_modifi_contrato5').val(data[6]);
		  $('#fecha_inicio_prorroga5').val(data[7]);
		  $('#fecha_fin_prorroga5').val(data[8]);
		  $('#fecha_fin_contrato5').val(data[9]);
		  $('#fecha_inicio_suspension5').val(data[10]);
		  $('#fecha_fin_suspension5').val(data[11]);
          $('#valor_modificacion5').val(data[12]);
		  
	id_moditipo_contrato_gestor = data[2];
// 	alert("vr modicontra: " + id_moditipo_contrato_gestor);
	
	if (id_moditipo_contrato_gestor == 1) { // prorroga
			   detotros5.style.display='none';
			   valotrosi5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   fincontra5.style.display='none';
			   iniprorro5.style.display='block';
			   finprorro5.style.display='block';
			   document.getElementById('detalle_otros5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension5').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   document.getElementById('fecha_inicio_prorroga5').focus();
	} 
	if (id_moditipo_contrato_gestor == 2) { // adicion
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   fincontra5.style.display='none';
			   valotrosi5.style.display='block';
			   document.getElementById('detalle_otros5').value = ' ';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension5').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_otrosi5').value = '';
			   document.getElementById('valor_otrosi5').focus();
	} 
	 if (id_moditipo_contrato_gestor == 3) { // cesion
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   valotrosi5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   fincontra5.style.display='none';
			   valotrosi5.style.display='none';
			   document.getElementById('detalle_otros5').value = ' ';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension5').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   document.getElementById('id_moditipo_contrato_gestor5').focus();
	} 
	 if (id_moditipo_contrato_gestor == 4) { // terminacion
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   valotrosi5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   document.getElementById('detalle_otros5').value = ' ';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   fincontra5.style.display='block';
			   document.getElementById('fecha_fin_contrato5').focus();
	} 
	if (id_moditipo_contrato_gestor == 5) { // suspension
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   fincontra5.style.display='none';
			   valotrosi5.style.display='none';
			   document.getElementById('detalle_otros5').value = ' ';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   inisuspe5.style.display='block';
			   finsuspe5.style.display='block';
			   document.getElementById('fecha_inicio_suspension5').focus();
	} 
	if (id_moditipo_contrato_gestor == 6) { // otros
			   detotros5.style.display='block';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   fincontra5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   valotrosi5.style.display='none';
			   document.getElementById('fecha_inicio_prorroga5').value = ' ';
			   document.getElementById('fecha_fin_prorroga5').value = ' ';
			   document.getElementById('fecha_inicio_suspension5').value = ' ';
			   document.getElementById('fecha_fin_suspension5').value = ' ';
			   document.getElementById('fecha_fin_contrato5').value = ' ';
			   document.getElementById('valor_modificacion5').value = 0;
			   document.getElementById('detalle_otros5').focus();		 
     }
		 
      });  
    });

</script>
