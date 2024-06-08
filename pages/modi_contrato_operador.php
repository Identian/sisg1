<?php

$nump147=privilegios(147,$_SESSION['snr']);


$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;
$id_tipo_ausentismo = 0;

//if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {
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

	 $id_contratos_operador = intval($_GET['i']);
	
    $query4 = sprintf("SELECT a.id_contratos_operador, 
			    a.id_operador_xgestor, a.num_contrato, a.id_tipo_contrato_operador,
				b.nombre_tipo_contrato_operador, a.detalle_otros, a.objeto_contrato, 
			    a.procesos_catastrales, a.id_producto_operador, 
				d.nombre_producto_operador, a.subproductos, 
				a.valor_contrato, a.duracion_meses, a.duracion_dias, 
				a.fecha_inicio_contrato, a.fecha_fin_contrato, a.fecha_inicio_servicio, 
				a.fecha_fin_servicio, a.id_municipio, c.nombre_municipio,
				m.id_departamento, m.nombre_departamento, m.indicativo,
				h.cod_gestor_catastral, h.nombre_gestor_catastral, 
				j.cod_operador_catastral, j.nombre_operador_catastral
	            FROM contratos_operador a
				LEFT JOIN tipo_contrato_operador b
				ON a.id_tipo_contrato_operador = b.id_tipo_contrato_operador
				LEFT JOIN operador_xgestor g
				ON a.id_operador_xgestor = g.id_operador_xgestor
				LEFT JOIN gestor_catastral h
				ON h.id_gestor_catastral = g.id_gestor_catastral
				LEFT JOIN operador_catastral j
				ON g.id_operador_catastral = j.id_operador_catastral
				LEFT JOIN producto_operador d
				ON a.id_producto_operador = d.id_producto_operador
	            LEFT JOIN municipio c
	            ON a.id_municipio = c.id_municipio 
	            LEFT JOIN departamento m
	            ON c.id_departamento = m.id_departamento
                WHERE a.id_contratos_operador = '$id_contratos_operador'  
				AND a.estado_contratos_operador = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
    $id_contratos_operador = $row4['id_contratos_operador'];
	$id_operador_xgestor = $row4['id_operador_xgestor'];
    $num_contrato = $row4['num_contrato'];
	$id_tipo_contrato_operador = $row4['id_tipo_contrato_operador'];
	$nombre_tipo_contrato_operador = $row4['nombre_tipo_contrato_operador'];
	$detalle_otros = $row4['detalle_otros'];
	$objeto_contrato = $row4['objeto_contrato'];
	$procesos_catastrales = $row4['procesos_catastrales'];
	$id_producto_operador = $row4['id_producto_operador'];
	$nombre_producto_operador = $row4['nombre_producto_operador'];
	$subproductos = $row4['subproductos'];
	$valor_contrato = $row4['valor_contrato'];
	$duracion_meses = $row4['duracion_meses'];
	$duracion_dias = $row4['duracion_dias'];
	$fecha_inicio_contrato  =  $row4['fecha_inicio_contrato'];
	$fecha_fin_contrato  =  $row4['fecha_fin_contrato'];
	$fecha_inicio_servicio  =  $row4['fecha_inicio_servicio'];
	$fecha_fin_servicio  =  $row4['fecha_fin_servicio'];
	$id_municipio = $row4['id_municipio'];
	$id_departamento = $row4['id_departamento'];
	$nombre_municipio =  $row4['nombre_municipio'];
	$nombre_departamento  =  $row4['nombre_departamento'];
	$indicativo = $row4['indicativo'];
	$cod_gestor_catastral  =  $row4['cod_gestor_catastral'];
	$nombre_gestor_catastral  =  $row4['nombre_gestor_catastral'];
	$cod_operador_catastral  =  $row4['cod_operador_catastral'];
	$nombre_operador_catastral  =  $row4['nombre_operador_catastral'];
	
 }


mysql_free_result($select4);


if ((isset($_POST["insertmcontra"])) && ($_POST["insertmcontra"] == "mcontrato")) { // 1
     $num_otrosi = $_POST['num_otrosi'];
	 $id_contratos_operador = $_POST['id_contratos_operador'];
	 $nombre_modifi_contratos_operador = 'OTROSI CONTRATO';
     $nombre_img2 = ' ';
	 $nombre_img3 = ' ';
	 $detalle_otros = ' ';
//	 $num_otrosi2 = 0;
	 if (isset($_POST["detalle_otros"]) && strlen($_POST["detalle_otros"]) > 5) {
	    $detalle_otros = $_POST['detalle_otros'];
	 } else {
	 $detalle_otros = ' ';
	 }
/*
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
*/


    // FILE = CONTRATO	
   if (isset($_FILES['file5']) and strlen($_FILES['file5']['name']) > 4){ // 2
//     if (1 == 1){ 
	 
      $tipoArchivo=explode("/",$_FILES["file5"]["type"]);
      $ubicacion="filesnr/catastrosnr/";
	  $NomImagen2=$_FILES['file5']['name'];
	  $totarchivo=explode(".",$_FILES["file5"]["name"]);
	  $nombre_img2='CONTRATO-'.$id_contratos_operador.'-'.$num_otrosi.'-'.$aleatorio.'.pdf';
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
	
		
	$insertSQL5 = sprintf("INSERT INTO modifi_contratos_operador (
      id_contratos_operador, id_moditipo_contrato_operador, 
      detalle_otros, objeto_modifi_contrato, fecha_modifi_contrato, 
	  num_otrosi, fecha_fin_contrato, 
	  fecha_inicio_suspension, fecha_fin_suspension, 
	  fecha_inicio_prorroga, fecha_fin_prorroga, docto_otrosi, 
	  nombre_modifi_contratos_operador, valor_modificacion, fecha_registro) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now())", 
      GetSQLValueString($_POST['id_contratos_operador'], "int"), 
      GetSQLValueString($_POST['id_moditipo_contrato_operador'], "int"), 
	  GetSQLValueString($detalle_otros, "text"), 
	  GetSQLValueString($_POST['objeto_modifi_contrato'], "text"),
	  GetSQLValueString($_POST['fecha_modifi_contrato'], "date"),
	  GetSQLValueString($_POST['num_otrosi'], "text"), 
	  GetSQLValueString($_POST['fecha_fin_contrato'], "date"),
	  GetSQLValueString($_POST['fecha_inicio_suspension'], "date"),
	  GetSQLValueString($_POST['fecha_fin_suspension'], "date"),
      GetSQLValueString($_POST['fecha_inicio_prorroga'], "date"), 
      GetSQLValueString($_POST['fecha_fin_prorroga'], "date"), 
      GetSQLValueString($nombre_img2, "text"),
      GetSQLValueString($nombre_modifi_contratos_operador, "text"),
	  GetSQLValueString($_POST['valor_modificacion'], "text")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());
	  
//  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_gestor&'.$id_gestor_catastral.'.jsp" />';

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
			    <li><a href="consulta_operador&<?php echo $id_contratos_gestor; ?>.jsp"><b>OPERADOR CATASTRAL</b></a></li>
            </ul>
        </div>
		 
      </div>
    </nav>
  </div>
</div>

<?php
// **********************************
// Consulta Contrato Operador
// **********************************		
?>

<div class="row">
    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <div class="row-md-6 text-left">
                 <h3 class="box-title"><b>CONTRATO DEL OPERADOR CATASTRAL</b></h3> &nbsp; &nbsp; 
<!--     		     <a id="" class="ventana1" data-toggle="modal" data-target="#updgestor" href="" title="Modificar Contrato Operador"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></a> -->
                 <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
				 <button type="button" class="btn btn-warning btn-xs modicontra" title="Modificar Contrato Operador">Modificar<span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
				 <?php } ?>
              </div>
			  </div>
			  </div>
		  <div class="row-md-6 text-right"></div>
	      <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Gestor Catastral:</label>   
                       <?php echo $nombre_gestor_catastral; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Operador Catastral:</label>   
                       <?php echo $nombre_operador_catastral; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Número Contrato:</label>   
                       <?php echo $num_contrato; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Tipo de Contrato Operador:</label>   
                       <?php echo $id_tipo_contrato_operador. ' - '.$nombre_tipo_contrato_operador; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Valor Contrato:</label>   
                       <?php echo number_format($valor_contrato); ?>
                    </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Duración en Meses:</label>   
                        <?php echo $duracion_meses; ?>
                  </div>
				  <div class="form-group text-left"> 
                        <label  class="control-label">Duración en Días:</label>   
                        <?php echo $duracion_dias; ?>
                  </div>  
            </div>
            <div class="col-md-6">
                  <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Inicio Contrato:</label>   
                        <?php echo $fecha_inicio_contrato; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Fin Contrato:</label>   
                        <?php echo $fecha_fin_contrato; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Inicio Servicio:</label>   
                        <?php echo $fecha_inicio_servicio; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Fin Servicio:</label>   
                        <?php echo $fecha_fin_servicio; ?>
                  </div>
                 <div class="form-group text-left"> 
                        <label  class="control-label">Municipio Gestor:</label>   
                        <?php echo $nombre_municipio. ' - '.$nombre_departamento; ?>
                  </div>
                </div>
				</div>  
             </div>
        </div>

<?php

// *************************************************
// Nueva Modificacion al Contrato Operador
// *************************************************
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
    <input type="hidden" class="form-control" id="id_contratos_operador" name="id_contratos_operador" value="<?php echo $id_contratos_operador; ?>">
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Número Otrosi Contrato:</label>   
        <input type="text" class="form-control" id="num_otrosi" name="num_otrosi" value="" required >
    </div>

    <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Modificación Contrato:</label> 
        <select class="form-control" name="id_moditipo_contrato_operador" id="id_moditipo_contrato_operador" onChange = "valotros();">
        <option value="" selected></option>
          <?php echo lista('moditipo_contrato_gestor'); ?>
        </select>
    </div>

    <div id = "detotros2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Detalle Otros:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="detalle_otros"  name="detalle_otros"  value=""></textarea>
    </div>
	
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Objeto Modificación Contrato:</label>   
		<textarea type="text"  rows="5" cols="40" class="form-control" id="objeto_modifi_contrato"  name="objeto_modifi_contrato"  value=""></textarea>
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Modificación Contrato:</label>   
        <input type="date" class="form-control" id="fecha_modifi_contrato" name="fecha_modifi_contrato" value="" required >
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

    <div id = "acontrato2" class="form-group text-left" style="display:block;"> 
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
					     <?php echo 'MODIFICACIONES A LOS CONTRATOS DEL OPERADOR'; ?>
					   </h4> 
					   <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ncontrato"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Modificación al Contrato</a> 
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
               $query62 = sprintf("SELECT id_modifi_contratos_operador,
			    id_contratos_operador, num_otrosi, a.id_moditipo_contrato_operador,
			    b.nombre_moditipo_contrato_operador, detalle_otros, objeto_modifi_contrato, 
				fecha_modifi_contrato, fecha_inicio_prorroga, fecha_fin_prorroga,
				fecha_fin_contrato, fecha_inicio_suspension, fecha_fin_suspension,
				valor_modificacion, docto_otrosi
	            FROM modifi_contratos_operador a
				LEFT JOIN moditipo_contrato_operador b
				ON a.id_moditipo_contrato_operador = b.id_moditipo_contrato_operador
                WHERE id_contratos_operador = '$id_contratos_operador'  
				AND estado_modifi_contratos_operador = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	 
			      $id_modifi_contratos_operador = $row62['id_modifi_contratos_operador'];
                  $id_contratos_operador = $row62['id_contratos_operador'];			  
            ?>
          <tr>
             <td><?php echo $row62['id_modifi_contratos_operador']; ?></td>
             <td><?php echo $row62['num_otrosi'];?></td>
			 <td><?php echo $row62['id_moditipo_contrato_operador']; ?></td>
             <td><?php echo $row62['nombre_moditipo_contrato_operador']; ?></td>
			 <td style="display:none;"><?php echo $row62['detalle_otros']; ?></td>
			 <td><?php echo $row62['objeto_modifi_contrato']; ?></td>
			 <td><?php echo $row62['fecha_modifi_contrato']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_inicio_prorroga']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_fin_prorroga']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_fin_contrato']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_inicio_suspension']; ?></td>
			 <td style="display:none;"><?php echo $row62['fecha_fin_suspension']; ?></td>
             <td><?php echo $row62['valor_modificacion']; ?></td>
		     <?php if(strlen($row62['docto_otrosi']) > 4) { ?> 
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
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN DATOS CONTRATO OPERADOR</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="post" name="form43257435224">

    <input type="hidden" class="form-control" name="id_gestor_catastral" id="id_gestor_catastral" value="<?php echo $id_gestor_catastral; ?>">
	<input type="hidden" class="form-control" name="id_contratos_operador" id="id_contratos_operador" value="<?php echo $id_contratos_operador; ?>">

    <div class="form-group text-left"> 
        <label  class="control-label">Gestor:</label> 
        <input type="text" class="form-control" name="cod_gestor_catastral" value="<?php echo $row4['cod_gestor_catastral'].' - '.$row4['nombre_gestor_catastral']; ?>" readonly="readonly">		
    </div>
	
    <div class="form-group text-left"> 
        <label  class="control-label">Operador:</label> 
        <input type="text" class="form-control" name="nombre_operador_catastra" value="<?php echo $row4['cod_operador_catastral'].' - '.$row4['nombre_operador_catastral']; ?>" readonly="readonly">		
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Número Contrato:</label>   
      <input type="text" class="form-control" name="num_contrato" value="<?php echo $num_contrato; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Contrato:</label> 
      <select class="form-control" name="id_tipo_contrato_operador" id="id_tipo_contrato_operador" required >
      <option value="" selected ></option>
         <?php echo lista('tipo_contrato_operador'); ?>
      </select>
    </div>

	
    <div class="form-group text-left"> 
      <label  class="control-label">Objeto del contrato:</label>   
      <textarea type="text"  rows="5" cols="40" class="form-control" id="objeto_contrato"  name="objeto_contrato"  value=""><?php echo $objeto_contrato; ?></textarea>
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Procesos Catastrales:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="procesos_catastrales"  name="procesos_catastrales"  value=""><?php echo $procesos_catastrales; ?></textarea>
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label"><span style="color:#ff0000;">*</span> Producto Operador:</label> 
      <select class="form-control" name="id_producto_operador" id="id_producto_operador" onChange = "valotros3();" required >
      <option value="" selected></option>
         <?php echo lista('producto_operador'); ?>
      </select>
    </div>
	
    <div id = "detotros" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Detalle Otros:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="detalle_otros"  name="detalle_otros"  value=""><?php echo $detalle_otros; ?></textarea>
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Subproducto:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="subproductos"  name="subproductos"  value=""><?php echo $subproductos; ?></textarea>
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Valor Contrato:</label>   
      <input type="number" class="form-control text-right" name="valor_contrato" value="<?php echo $valor_contrato; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Duración en Meses:</label>   
      <input type="number" class="form-control" name="duracion_meses" value="<?php echo $duracion_meses; ?>">
    </div>

     <div class="form-group text-left"> 
      <label  class="control-label">Duración en Días:</label>   
      <input type="number" class="form-control" name="duracion_dias" value="<?php echo $duracion_dias; ?>">
    </div>

   <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio Contrato:</label>   
        <input type="date" class="form-control" id="fecha_inicio_contrato" name="fecha_inicio_contrato" value="<?php echo $fecha_inicio_contrato; ?>" required >
    </div>
   <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Contrato:</label>   
        <input type="date" class="form-control" id="fecha_fin_contrato" name="fecha_fin_contrato" value="<?php echo $fecha_fin_contrato; ?>" required >
    </div>
   <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio Servicio:</label>   
        <input type="date" class="form-control" id="fecha_inicio_servicio" name="fecha_inicio_servicio" value="<?php echo $fecha_inicio_servicio; ?>" required >
    </div>
   <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Servicio:</label>   
        <input type="date" class="form-control" id="fecha_fin_servicio" name="fecha_fin_servicio" value="<?php echo $fecha_fin_servicio; ?>" required >
    </div>
	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="mcontraoper" value="mcoper">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>

<?php
// **************************************************
// Modificacion de la modifi Contrato Operador
// **************************************************
?>

<div class="modal fade"  id="modiconges" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>ACTUALIZACIÓN MODIFICACIÓN CONTRATO OPERADOR</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4324424" enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_contratos_operador" id="id_contratos_operador" readonly="readonly" value="<?php echo $id_contratos_operador; ?>">
	<input type="hidden" class="form-control" name="id_modifi_contratos_operador" id="id_modifi_contratos_operador" readonly="readonly" value="<?php echo $id_modifi_contratos_operador; ?>">

	
    <div class="form-group text-left"> 
      <label  class="control-label">Número Contrato:</label>   
      <input type="text" class="form-control" name="num_otrosi2" id="num_otrosi2" readonly="readonly" value="">
    </div>

    <div class="form-group text-left" style="display:none;"> 
      <label  class="control-label">Tipo Modificación Contrato:</label>   
      <input type="text" class="form-control" name="id_moditipo_contrato_gestor2" id="id_moditipo_contrato_gestor2" value="" readonly="readonly">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Tipo Modificación  Contrato:</label>   
      <input type="text" class="form-control" name="nombre_moditipo_contrato_gestor2" id="nombre_moditipo_contrato_gestor2" value="" readonly="readonly">
    </div>
	
    <div  id ="detotros5" class="form-group text-left" style="display:none;"> 
      <label  class="control-label">Detalle Otros:</label>   
      <textarea type="text"  rows="5" cols="40" class="form-control" id="detalle_otros2"  name="detalle_otros2"  value=""></textarea>
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">Objeto Modificación Contrato:</label>   
	  <textarea type="text"  rows="5" cols="40" class="form-control" id="objeto_modifi_contrato2"  name="objeto_modifi_contrato2"  value="" required></textarea>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Modificación Contrato:</label>   
      <input type="date" class="form-control" name="fecha_modifi_contrato2" id="fecha_modifi_contrato2" value="" required >
    </div>
	
    <div  id ="iniprorro5" class="form-group text-left" style="display:none;"> 
      <label  class="control-label">Fecha Inicio Prorroga:</label>   
      <input type="date" class="form-control" name="fecha_inicio_prorroga2" id="fecha_inicio_prorroga2" value="">
    </div>

    <div id ="finprorro5" class="form-group text-left" style="display:none;"> 
      <label  class="control-label">Fecha Fin Prorroga:</label>   
      <input type="date" class="form-control" name="fecha_fin_prorroga2" id="fecha_fin_prorroga2" value="">
    </div>

    <div id ="inisuspe5" class="form-group text-left" style="display:none;"> 
      <label  class="control-label">Fecha Inicio Suspensión:</label>   
      <input type="date" class="form-control" name="fecha_inicio_suspension2" id="fecha_inicio_suspension2" value="">
    </div>

    <div id ="finsuspe5"class="form-group text-left" style="display:none;"> 
      <label  class="control-label">Fecha Fin Suspensión:</label>   
      <input type="date" class="form-control" name="fecha_fin_suspension2" id="fecha_fin_suspension2" value="">
    </div>

    <div id ="fincontra5" class="form-group text-left" style="display:none;"> 
      <label  class="control-label">Fecha Fin Contrato:</label>   
      <input type="date" class="form-control" name="fecha_fin_contrato2" id="fecha_fin_contrato2" value="">
    </div>

    <div id ="valotrosi5" class="form-group text-left" style="display:none;"> 
      <label  class="control-label">Valor Modificación Contrato:</label>   
      <input type="number" class="form-control text-right" name="valor_otrosi2" id="valor_otrosi2" value="">
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

if (isset($_POST['mcontraoper']) && $_POST['mcontraoper'] == 'mcoper'){

	$id_gestor_catastral = $_POST['id_gestor_catastral'];
    $id_contratos_operador = $_POST['id_contratos_operador'];

	$detalle_otros = ' ';
	
	 if (isset($_POST["detalle_otros"]) && strlen($_POST["detalle_otros"]) > 5) {
	    $detalle_otros = $_POST['detalle_otros'];
	 } else {
	 $detalle_otros = ' ';
	 }

	
    $updateSQL37 = sprintf("UPDATE contratos_operador 
	        SET num_contrato = %s,
	        id_tipo_contrato_operador = %s,
			detalle_otros = %s,
			objeto_contrato = %s,
			procesos_catastrales = %s,
			id_producto_operador = %s,
			subproductos = %s,
			valor_contrato = %s,
			duracion_meses = %s,
			duracion_dias = %s,
			fecha_inicio_contrato = %s,
			fecha_fin_contrato = %s,
			fecha_inicio_servicio = %s,
			fecha_fin_servicio = %s
			WHERE id_contratos_operador = %s",                  
	GetSQLValueString($_POST['num_contrato'], "text"),
	GetSQLValueString($_POST['id_tipo_contrato_operador'], "text"),
	GetSQLValueString($detalle_otros, "text"),
	GetSQLValueString($_POST['objeto_contrato'], "text"),
	GetSQLValueString($_POST['procesos_catastrales'], "text"),
	GetSQLValueString($_POST['id_producto_operador'], "text"),
	GetSQLValueString($_POST['subproductos'], "text"),
	GetSQLValueString($_POST['valor_contrato'], "text"),
	GetSQLValueString($_POST['duracion_meses'], "int"),
	GetSQLValueString($_POST['duracion_dias'], "int"),
	GetSQLValueString($_POST['fecha_inicio_contrato'], "date"),
	GetSQLValueString($_POST['fecha_fin_contrato'], "date"),
	GetSQLValueString($_POST['fecha_inicio_servicio'], "date"),
	GetSQLValueString($_POST['fecha_fin_servicio'], "date"),
	GetSQLValueString($id_contratos_operador, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./modi_contrato_operador&'.$id_contratos_operador.'.jsp" />';
 }

?>

<?php

// *****************************************
// Registro de Modificacion Contrato
// *****************************************

if (isset($_POST['actmodcontra']) && $_POST['actmodcontra'] == 'modcontrato'){

	$id_modifi_contratos_operador = $_POST['id_modifi_contratos_operador'];
	$id_contratos_operador = $_POST['id_contratos_operador'];
	$detalle_otros = ' ';
	
	 if (isset($_POST["detalle_otros2"]) && strlen($_POST["detalle_otros2"]) > 5) {
	    $detalle_otros = $_POST['detalle_otros2'];
	 } else {
	 $detalle_otros = ' ';
	 }

    $updateSQL37 = sprintf("UPDATE modifi_contratos_operador 
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
			WHERE id_modifi_contratos_operador = %s",                  
	GetSQLValueString($_POST['num_otrosi2'], "text"),
	GetSQLValueString($detalle_otros, "text"),
	GetSQLValueString($_POST['objeto_modifi_contrato2'], "text"),
	GetSQLValueString($_POST['fecha_modifi_contrato2'], "date"),
	GetSQLValueString($_POST['fecha_inicio_prorroga2'], "text"),
	GetSQLValueString($_POST['fecha_fin_prorroga2'], "text"),
	GetSQLValueString($_POST['fecha_fin_contrato2'], "text"),
	GetSQLValueString($_POST['fecha_inicio_suspension2'], "text"),
	GetSQLValueString($_POST['fecha_fin_suspension2'], "text"),
	GetSQLValueString($_POST['valor_otrosi2'], "text"),
	GetSQLValueString($id_modifi_contratos_operador, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./modi_contrato_operador&'.$id_contratos_operador.'.jsp" />';
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
	
	var id_moditipo_contrato_operador = document.getElementById('id_tipo_contrato_operador').value;
//    alert ("valor: " + id_moditipo_contrato_gestor);
	if (id_moditipo_contrato_gestor == 1) { // Consutoria
			   detotros.style.display='none';
			   document.getElementById('objeto_contrato').focus();
	} 
	if (id_moditipo_contrato_gestor == 2) { // prestacion de servicios
			   detotros.style.display='none';
			   document.getElementById('objeto_contrato').focus();
	} 
	 if (id_moditipo_contrato_gestor == 3) { // otros
			   detotros.style.display='block';
			   document.getElementById('detalle_otros').focus();
	} 

}
</script>

<script>
    function valotros() {
	
	var id_moditipo_contrato_operador = document.getElementById('id_moditipo_contrato_operador').value;
//    alert ("valor: " + id_moditipo_contrato_operador);
	if (id_moditipo_contrato_operador == 1) { // prorroga
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
	if (id_moditipo_contrato_operador == 2) { // adicion
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
	 if (id_moditipo_contrato_operador == 3) { // cesion
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
	 if (id_moditipo_contrato_operador == 4) { // terminacion
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
			   document.getElementById('detalle_otros').value = ' ';
			   document.getElementById('fecha_fin_contrato').focus();
	} 
	if (id_moditipo_contrato_operador == 5) { // suspension
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
			   document.getElementById('detalle_otros').value = ' ';
			   document.getElementById('fecha_inicio_suspension').focus();
	} 
	if (id_moditipo_contrato_operador == 6) { // otros
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
      $('.editbtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#modiconges").modal("show");
          $('#id_modifi_contratos_gestor').val(data[0]);
          $('#num_otrosi2').val(data[1]);
          $('#id_moditipo_contrato_gestor2').val(data[2]);
		  $('#nombre_moditipo_contrato_gestor2').val(data[3]);
          $('#detalle_otros2').val(data[4]);
          $('#objeto_modifi_contrato2').val(data[5]);
		  $('#fecha_modifi_contrato2').val(data[6]);
		  $('#fecha_inicio_prorroga2').val(data[7]);
		  $('#fecha_fin_prorroga2').val(data[8]);
		  $('#fecha_fin_contrato2').val(data[9]);
		  $('#fecha_inicio_suspension2').val(data[10]);
		  $('#fecha_fin_suspension2').val(data[11]);
          $('#valor_otrosi2').val(data[12]);
//		  alert("valor_otrosi2: " + data[12]);
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
			   document.getElementById('detalle_otros2').value = ' ';
			   document.getElementById('fecha_inicio_suspension2').value = ' ';
			   document.getElementById('fecha_fin_suspension2').value = ' ';
			   document.getElementById('fecha_fin_contrato2').value = ' ';
			   document.getElementById('valor_otrosi2').value = 0;
			   document.getElementById('fecha_inicio_prorroga2').focus();
	} 
	if (id_moditipo_contrato_gestor == 2) { // adicion
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   fincontra5.style.display='none';
			   valotrosi5.style.display='block';
			   document.getElementById('detalle_otros2').value = ' ';
			   document.getElementById('fecha_inicio_prorroga2').value = ' ';
			   document.getElementById('fecha_fin_prorroga2').value = ' ';
			   document.getElementById('fecha_inicio_suspension2').value = ' ';
			   document.getElementById('fecha_fin_suspension2').value = ' ';
			   document.getElementById('fecha_fin_contrato2').value = ' ';
//			   document.getElementById('valor_otrosi2').value = '';
			   document.getElementById('valor_otrosi2').focus();
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
			   document.getElementById('detalle_otros2').value = ' ';
			   document.getElementById('fecha_inicio_prorroga2').value = ' ';
			   document.getElementById('fecha_fin_prorroga2').value = ' ';
			   document.getElementById('fecha_inicio_suspension2').value = ' ';
			   document.getElementById('fecha_fin_suspension2').value = ' ';
			   document.getElementById('fecha_fin_contrato2').value = ' ';
			   document.getElementById('valor_otrosi2').value = 0;
			   document.getElementById('id_moditipo_contrato_gestor2').focus();
	} 
	 if (id_moditipo_contrato_gestor == 4) { // terminacion
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   valotrosi5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   document.getElementById('detalle_otros2').value = ' ';
			   document.getElementById('fecha_inicio_prorroga2').value = ' ';
			   document.getElementById('fecha_fin_prorroga2').value = ' ';
			   document.getElementById('fecha_inicio_suspension2').value = ' ';
			   document.getElementById('fecha_fin_suspension2').value = ' ';
			   document.getElementById('valor_otrosi2').value = 0;
			   fincontra5.style.display='block';
			   document.getElementById('detalle_otros2').value = ' ';
			   document.getElementById('fecha_fin_contrato2').focus();
	} 
	if (id_moditipo_contrato_gestor == 5) { // suspension
			   detotros5.style.display='none';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   fincontra5.style.display='none';
			   valotrosi5.style.display='none';
			   document.getElementById('detalle_otros2').value = ' ';
			   document.getElementById('fecha_inicio_prorroga2').value = ' ';
			   document.getElementById('fecha_fin_prorroga2').value = ' ';
			   document.getElementById('fecha_fin_contrato2').value = ' ';
			   document.getElementById('valor_otrosi2').value = 0;
			   inisuspe5.style.display='block';
			   finsuspe5.style.display='block';
			   document.getElementById('detalle_otros2').value = ' ';
			   document.getElementById('fecha_inicio_suspension2').focus();
	} 
	if (id_moditipo_contrato_gestor == 6) { // otros
			   detotros5.style.display='block';
			   iniprorro5.style.display='none';
			   finprorro5.style.display='none';
			   fincontra5.style.display='none';
			   inisuspe5.style.display='none';
			   finsuspe5.style.display='none';
			   valotrosi5.style.display='none';
			   document.getElementById('fecha_inicio_prorroga2').value = ' ';
			   document.getElementById('fecha_fin_prorroga2').value = ' ';
			   document.getElementById('fecha_inicio_suspension2').value = ' ';
			   document.getElementById('fecha_fin_suspension2').value = ' ';
			   document.getElementById('fecha_fin_contrato2').value = ' ';
			   document.getElementById('valor_otrosi2').value = 0;
			   document.getElementById('detalle_otros2').focus();		 
     }
		 
      });  
    });

</script>

<script>
    function valotros3() {
//	alert('valotros');
	var productoper = document.getElementById('id_producto_operador').value;
		if ( productoper == 3) {
			detotros.style.display='block';
			document.getElementById('detalle_otros').focus();
		} else {
			detotros.style.display='none';
			document.getElementById('detalle_otros').value = ' ';
			document.getElementById('subproductos').focus();
        }
    }
</script>

<script>
/*
    $(document).ready(function() {
    var id_tipo_contrato_operador = '<?php echo $id_tipo_contrato_operador; ?>';
	alert ("tipo c: " + id_tipo_contrato_operador);

	})
*/
</script>

<script>
    $(document).ready(function() {
    $('.modicontra').on('click', function() {          
/*
	  $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
*/		  
    $("#updgestor").modal("show");
	var id_tipo_contrato_operador = '<?php echo $id_tipo_contrato_operador; ?>';
	var id_producto_operador = '<?php echo $id_producto_operador; ?>';
	var id_municipio = '<?php echo $id_municipio; ?>';
	
          $('#id_tipo_contrato_operador').val(id_tipo_contrato_operador);
		  $('#id_producto_operador').val(id_producto_operador);
		  $('#id_municipio').val(id_municipio);

		if (id_producto_operador == 3) {
			detotros.style.display='block';
			document.getElementById('detalle_otros').focus();
		} else {
			detotros.style.display='none';
			document.getElementById('detalle_otros').value = ' ';
			document.getElementById('subproductos').focus();
        }
		  
/*
          $('#id_funcionario_jefe4').val(data[1]);
          $('#nombre_funcionario4').val(data[3]);
*/

		  });  
    });

</script>