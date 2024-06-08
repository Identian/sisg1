<?php

$nump147=privilegios(147,$_SESSION['snr']);


$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;
$id_tipo_ausentismo = 0;

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
   $id_gestor_catastral=intval($_GET['i']);
   } else {
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
   }

    } else { 
    echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 
 
if ($id_gestor_catastral > 0) { // Hasta el final
	
	$id_gestor_catastral=intval($_GET['i']);
	
	
// aqui

if ((isset($_POST["insertcontra"])) && ($_POST["insertcontra"] == "contrato")) { // 1
     $num_contrato = $_POST['num_contrato'];
     $nombre_img2 = ' ';
	 $nombre_img3 = ' ';
	 $detalle_otros = ' ';
	 $num_contrato2 = 0;
	 if (isset($_POST["detalle_otros"]) && strlen($_POST["detalle_otros"]) > 5) {
	    $detalle_otros = $_POST['detalle_otros'];
	 } else {
	 $detalle_otros = ' ';
	 }

global $mysqli;
 
    $query37 = "SELECT *
			  FROM contratos_gestor 
			  WHERE id_gestor_catastral = $id_gestor_catastral
			   AND num_contrato = $num_contrato 
			   AND estado_contratos_gestor = 1 ";
    $result37 = $mysqli->query($query37);
    while ($obj37 = $result37->fetch_array()) {
        $num_contrato2 = $obj37['num_contrato'];
    }
$result37->free();	

if ($num_contrato != $num_contrato2) {
    // FILE = CONTRATO	
   if (isset($_FILES['file2']) and strlen($_FILES['file2']['name']) > 4){ // 2
//     if (1 == 1){ 
	 
      $tipoArchivo=explode("/",$_FILES["file2"]["type"]);
      $ubicacion="filesnr/catastrosnr/";
	  $NomImagen2=$_FILES['file2']['name'];
	  $totarchivo=explode(".",$_FILES["file2"]["name"]);
	  $nombre_img2='CONTRATO-'.$id_gestor_catastral.'-'.$num_contrato.'-'.$aleatorio.'.pdf';
      $NomImagenR=$ubicacion."/".$nombre_img2;

      if (($_FILES['file2']['name'] == !NULL) && ($_FILES['file2']['size'] <= 11534336)) { // 3
	    if ($_FILES["file2"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file2']['tmp_name'],$NomImagenR);
				  
        } else { 
		     $nombre_img2= ' ';
			} // fin 4 
      } else { 
	          $nombre_img2= ' ';
		} // fin 3
  } else { 
      $nombre_img2= ' ';
  } // fin 2
	
// FILE = CAMARA
   if (isset($_FILES['file3']) and strlen($_FILES['file3']['name']) > 4){ // 2
//     if (1 == 1){ 
	 
      $tipoArchivo=explode("/",$_FILES["file3"]["type"]);
      $ubicacion="filesnr/catastrosnr/";
	  $NomImagen3=$_FILES['file3']['name'];
	  $totarchivo=explode(".",$_FILES["file3"]["name"]);
	  $nombre_img3='CAMARA-'.$id_gestor_catastral.'-'.$num_contrato.'-'.$aleatorio.'.pdf';
      $NomImagenR=$ubicacion."/".$nombre_img3;

      if (($_FILES['file3']['name'] == !NULL) && ($_FILES['file3']['size'] <= 11534336)) { // 3
	    if ($_FILES["file3"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file3']['tmp_name'],$NomImagenR);
				  
        } else { 
		     $NomImagen3= ' ';
			} // fin 4 
      } else { 
	          $NomImagen3= ' ';
		} // fin 3
  } else { 
      $NomImagen3= ' ';
  } // fin 3

		
	$insertSQL5 = sprintf("INSERT INTO contratos_gestor (
      id_gestor_catastral, num_contrato, repre_legal, 
	  id_tipo_contrato_gestor, detalle_otros, 
	  objeto_contrato, obligaciones_partes, valor_contrato, 
	  duracion_meses, duracion_dias, fecha_firma_contrato, 
      fecha_inicio_servicio, fecha_fin_servicio, docto_contrato, docto_camara, fecha_registro) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now())", 
      GetSQLValueString($id_gestor_catastral, "int"), 
      GetSQLValueString($_POST['num_contrato'], "text"), 
	  GetSQLValueString($_POST['repre_legal'], "text"), 
      GetSQLValueString($_POST['id_tipo_contrato_gestor'], "int"), 
      GetSQLValueString($detalle_otros, "text"), 
	  GetSQLValueString($_POST['objeto_contrato'], "text"),
	  GetSQLValueString($_POST['obligaciones_partes'], "text"),
      GetSQLValueString($_POST['valor_contrato'], "text"), 
      GetSQLValueString($_POST['duracion_meses'], "int"), 
	  GetSQLValueString($_POST['duracion_dias'], "int"),
	  GetSQLValueString($_POST['fecha_firma_contrato'], "date"),
	  GetSQLValueString($_POST['fecha_inicio_servicio'], "date"),
      GetSQLValueString($_POST['fecha_fin_servicio'], "date"),
	  GetSQLValueString($nombre_img2, "text"),
	  GetSQLValueString($nombre_img3, "text")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());
	  
//  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_gestor&'.$id_gestor_catastral.'.jsp" />';
}
} 

if ((isset($_POST["insertmuni"])) && ($_POST["insertmuni"] == "insertmuni")) { // 1
     $id_gestor_catastral = $_POST['id_gestor_catastral'];
     $id_municipio = $_POST['id_municipio'];
	 $id_municipio2 = 0;
global $mysqli;
 
    $query37 = "SELECT *
			  FROM municipio_gestor 
			  WHERE id_gestor_catastral = '$id_gestor_catastral'
			   AND id_municipio = '$id_municipio' 
			   AND estado_municipio_gestor = 1 ";
    $result37 = $mysqli->query($query37);
    while ($obj37 = $result37->fetch_array()) {
        $id_municipio2 = $obj37['id_municipio_gestor'];
    }
$result37->free();	

if ($id_municipio != $id_municipio2) {

	$insertSQL5 = sprintf("INSERT INTO municipio_gestor (
     id_gestor_catastral, id_municipio) 
	  VALUES (%s, %s)", 
      GetSQLValueString($id_gestor_catastral, "int"), 
      GetSQLValueString($id_municipio, "int")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());
	  
//  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_gestor&'.$id_gestor_catastral.'.jsp" />';
}
} 

// *****************************************
// Registro de Modificacion Contrato Gestor
// *****************************************

if (isset($_POST['actcontra']) && $_POST['actcontra'] == 'contrato'){

	$id_contratos_gestor = $_POST['id_contratos_gestor'];

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
			fecha_fin_servicio = %s,
			docto_contrato = %s,
			docto_camara = %s
			WHERE id_contratos_gestor = %s",                  
	GetSQLValueString($_POST['num_contrato2'], "text"),
	GetSQLValueString($_POST['repre_legal2'], "text"),
	GetSQLValueString($_POST['id_tipo_contrato_gestor2'], "text"),
	GetSQLValueString($_POST['detalle_otros2'], "text"),
	GetSQLValueString($_POST['objeto_contrato2'], "text"),
	GetSQLValueString($_POST['obligaciones_partes2'], "text"),
	GetSQLValueString($_POST['valor_contrato2'], "text"),
	GetSQLValueString($_POST['duracion_meses2'], "text"),
	GetSQLValueString($_POST['duracion_dias2'], "text"),
	GetSQLValueString($_POST['fecha_firma_contrato2'], "date"),
	GetSQLValueString($_POST['fecha_inicio_servicio2'], "date"),
	GetSQLValueString($_POST['fecha_fin_servicio2'], "date"),
	GetSQLValueString($docto_contrato, "text"),
	GetSQLValueString($docto_camara, "text"),
	GetSQLValueString($id_contratos_gestor, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
 	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_gestor&'.$id_gestor_catastral.'.jsp" />';
 }



// *****************************************
// Registro Modificacion Gestor
// *****************************************

if (isset($_POST['modigestor']) && $_POST['modigestor'] == 'gestor'){

	$id_gestor_catastral = $_POST['id_gestor_catastral'];

// archiva documento

   if (isset($_FILES['file11']) and strlen($_FILES['file11']['name']) > 4){ // 2
       $txtImagen1 = $_FILES['file11']['name'];
//      $tipoArchivo=explode("/",$_FILES["file1"]["type"]);
	  $tipoArchivo=$_FILES["file11"]["type"];
      $ubicacion="filesnr/catastrosnr";
	  $NomImagen1=$_FILES['file11']['name'];
	  $num_alea = rand(5, 95);
	  $totarchivo=explode(".",$_FILES["file11"]["name"]);
//	  $nombre_img1='DOCTO-'.$id_gestor_catastral.'-'.$aleatorio.$num_alea.'.'.$tipoArchivo;

	  $NomImagenR1=$ubicacion."/".$NomImagen1;
//      $nombre_catastro_carguedoc = $nombre_img1;
	  
      if (($_FILES['file11']['name'] == !NULL) && ($_FILES['file11']['size'] <= 20534336)) { 
	  
	    move_uploaded_file($_FILES['file11']['tmp_name'],$NomImagenR1);

      } 
  } else {
	  $nom_estudios_previos = $_POST['nom_estudios_previos'];
	  if (strlen($nom_estudios_previos) > 12 and $nom_estudios_previos != 'PENDIENTE') {
		 $txtImagen1 = $nom_estudios_previos;
	  } else {
		$txtImagen1 = 'PENDIENTE';    
	  }
		  
	 
  }

   if (isset($_FILES['file2']) and strlen($_FILES['file2']['name']) > 4){ // 2
	  $txtImagen2 = $_FILES['file2']['name'];
//      $tipoArchivo=explode("/",$_FILES["file1"]["type"]);
	  $tipoArchivo=$_FILES["file2"]["type"];
      $ubicacion="filesnr/catastrosnr";
	  $NomImagen2=$_FILES['file2']['name'];
	  $num_alea = rand(5, 95);
	  $totarchivo=explode(".",$_FILES["file2"]["name"]);
//	  $nombre_img1='DOCTO-'.$id_gestor_catastral.'-'.$aleatorio.$num_alea.'.'.$tipoArchivo;

	  $NomImagenR2=$ubicacion."/".$NomImagen2;
//      $nombre_catastro_carguedoc = $nombre_img1;
	  
      if (($_FILES['file2']['name'] == !NULL) && ($_FILES['file2']['size'] <= 20534336)) { 
	  
	    move_uploaded_file($_FILES['file2']['tmp_name'],$NomImagenR2);

      } 
  } else {
	  $nom_hdv_doctos = $_POST['nom_hdv_doctos'];
	  if (strlen($nom_hdv_doctos) > 12 and $nom_hdv_doctos != 'PENDIENTE') {
		 $txtImagen2 = $nom_hdv_doctos;
	  } else {
		$txtImagen2 = 'PENDIENTE';    
	  }
  }


   if (isset($_FILES['file3']) and strlen($_FILES['file3']['name']) > 4){ // 2
	  $txtImagen3 = $_FILES['file3']['name'];
//      $tipoArchivo=explode("/",$_FILES["file1"]["type"]);
	  $tipoArchivo=$_FILES["file3"]["type"];
      $ubicacion="filesnr/catastrosnr";
	  $NomImagen3=$_FILES['file3']['name'];
	  $num_alea = rand(5, 95);
	  $totarchivo=explode(".",$_FILES["file3"]["name"]);
//	  $nombre_img1='DOCTO-'.$id_gestor_catastral.'-'.$aleatorio.$num_alea.'.'.$tipoArchivo;

	  $NomImagenR3=$ubicacion."/".$NomImagen3;
//      $nombre_catastro_carguedoc = $nombre_img1;
	  
      if (($_FILES['file3']['name'] == !NULL) && ($_FILES['file3']['size'] <= 20534336)) { 
	  
	    move_uploaded_file($_FILES['file3']['tmp_name'],$NomImagenR3);

      } 
  } else {
	  $nom_contrato = $_POST['nom_contrato'];
	  if (strlen($nom_contrato) > 12 and $nom_contrato != 'PENDIENTE') {
		 $txtImagen3 = $nom_contrato;
	  } else {
		$txtImagen3 = 'PENDIENTE';    
	  }
  }
	
	
	
    $updateSQL37 = sprintf("UPDATE gestor_catastral 
	        SET cod_gestor_catastral = %s,
			nombre_gestor_catastral = %s, 
	        id_natu_juridica_gestor = %s,
			nit_gestor = %s,
			digito_verificacion = %s,
			repre_legal = %s,
			dir_gestor = %s,
			tel_gestor = %s,
			correo_gestor = %s,
			acto_adtvo_habili = %s,
			acto_adtvo_prestaser = %s,
			fecha_habilitacion = %s,
			fecha_inicio = %s,
			fecha_fin = %s,
			jurisdiccion_xhabilitacion = %s,
			jurisdiccion_xcontrato = %s,
			fecha_jurisdiccion_contrato = %s,
			id_funcionario_catastro = %s,
			nom_estudios_previos = %s, 
	        nom_hdv_doctos = %s, 
			nom_contrato = %s
			WHERE id_gestor_catastral = %s",                  
	GetSQLValueString($_POST['cod_gestor_catastral'], "text"),
	GetSQLValueString($_POST['nombre_gestor_catastral'], "text"),
	GetSQLValueString($_POST['id_natu_juridica_gestor'], "text"),
	GetSQLValueString($_POST['nit_gestor'], "text"),
	GetSQLValueString($_POST['digito_verificacion'], "text"),
	GetSQLValueString($_POST['repre_legal'], "text"),
	GetSQLValueString($_POST['dir_gestor'], "text"),
	GetSQLValueString($_POST['tel_gestor'], "text"),
	GetSQLValueString($_POST['correo_gestor'], "text"),
	GetSQLValueString($_POST['acto_adtvo_habili'], "text"),
	GetSQLValueString($_POST['acto_adtvo_prestaser'], "text"),
	GetSQLValueString($_POST['fecha_habilitacion'], "date"),
	GetSQLValueString($_POST['fecha_inicio'], "date"),
	GetSQLValueString($_POST['fecha_fin'], "date"),
	GetSQLValueString($_POST['jurisdiccion_xhabilitacion'], "text"),
	GetSQLValueString($_POST['jurisdiccion_xcontrato'], "text"),
	GetSQLValueString($_POST['fecha_jurisdiccion_contrato'], "date"),
	GetSQLValueString($_POST['id_funcionario_catastro'], "int"),
	GetSQLValueString($txtImagen1, "text"),
	GetSQLValueString($txtImagen2, "text"),
	GetSQLValueString($txtImagen3, "text"),
	GetSQLValueString($id_gestor_catastral, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_gestor&'.$id_gestor_catastral.'.jsp" />';
 }

    $query4 = sprintf("SELECT id_gestor_catastral, cod_gestor_catastral,
			                                  nombre_gestor_catastral, a.id_natu_juridica_gestor, nit_gestor, 
											  a.digito_verificacion, repre_legal,
											  dir_gestor, tel_gestor, correo_gestor, acto_adtvo_habili,
											  acto_adtvo_prestaser,
											  fecha_habilitacion, jurisdiccion_xhabilitacion, 
											  jurisdiccion_xcontrato, fecha_inicio, fecha_fin,
											  nombre_natu_juridica_gestor, fecha_jurisdiccion_contrato, 
											  a.id_funcionario_catastro, d.nombre_funcionario,
											  a.nom_estudios_previos, a.nom_hdv_doctos,
											  a.nom_contrato
     FROM gestor_catastral a
	 LEFT JOIN natu_juridica_gestor g
	 ON a.id_natu_juridica_gestor = g.id_natu_juridica_gestor
 	 LEFT JOIN funcionario d
	 ON a.id_funcionario_catastro = d.id_funcionario
    WHERE a.id_gestor_catastral = '$id_gestor_catastral' 
	 AND estado_gestor_catastral = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
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
	$fecha_jurisdiccion_contrato = $row4['fecha_jurisdiccion_contrato'];
	$nom_estudios_previos = $row4['nom_estudios_previos'];
	$nom_hdv_doctos = $row4['nom_hdv_doctos'];
	$nom_contrato = $row4['nom_contrato'];
 }


mysql_free_result($select4);


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
			    <li><a href="catastro_gestor.jsp"><b>GESTOR CATASTRAL</b></a></li>
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
                 <h3 class="box-title"><b>CONSULTA GESTOR CATASTRAL</b></h3> &nbsp; &nbsp; 
				 <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
    		     <a id="" class="ventana1" data-toggle="modal" data-target="#updgestor" href="" title="Modificar Gestor"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></a>
                 <?php } ?>
			 </div>
             <input type="hidden" class="form-control" name="tot_causantes" id="tot_causantes" readonly="readonly" value="">
		  <div class="row-md-6 text-right">
	</div>
	    <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Código Gestor:</label>   
                       <?php echo $row4['cod_gestor_catastral']; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Nombre Gestor:</label>   
                       <?php echo utf8_encode($row4['nombre_gestor_catastral']); ?>
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
                </div>

                <div class="col-md-6">
                  <div class="form-group text-left"> 
                        <label  class="control-label">Correo Gestor:</label>   
                        <?php echo $row4['correo_gestor']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label"> Acto Administrativo Res. Habilitación:</label>   
                        <?php echo $row4['acto_adtvo_habili']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label"> Fecha Habilitación:</label>   
                        <?php echo $row4['fecha_habilitacion']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Inicio:</label>   
                        <?php echo $row4['fecha_inicio']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Fecha Terminación Jurisdicción Contrato:</label>   
                        <?php echo $row4['fecha_jurisdiccion_contrato']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Jurisdicción x Habilitación:</label>   
                        <?php echo $row4['jurisdiccion_xhabilitacion']; ?>
                  </div>
				</div>  
             </div>
        </div>
  </div>
  </div>
   </div> 
 </div>

<?php

// ********************************
// Nuevo Contrato Gestor
// ********************************
?>
<div class="modal fade" id="ncontrato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVO CONTRATO</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form4311567534555"  enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_gestor_catastral" name="id_gestor_catastral" value="<?php echo $id_gestor_catastral; ?>">
	<input type="hidden" class="form-control" id="id_natu_juridica_gestor" name="id_natu_juridica_gestor" value="<?php echo $id_natu_juridica_gestor; ?>">
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Número Contrato:</label>   
        <input type="text" class="form-control" id="num_contrato" name="num_contrato" value="" required >
    </div>
    <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Contrato:</label> 
        <select class="form-control" name="id_tipo_contrato_gestor" id="id_tipo_contrato_gestor" onChange = "valotros();">
        <option value="" selected></option>
          <?php echo lista('tipo_contrato_gestor'); ?>
        </select>
    </div>
    <div id = "detotros" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Detalle Otros:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="detalle_otros"  name="detalle_otros"  value=""></textarea>
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Representante Legal:</label>   
        <input type="text" class="form-control" id="repre_legal" name="repre_legal" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Objeto Contrato:</label>   
		<textarea type="text"  rows="5" cols="40" class="form-control" id="objeto_contrato"  name="objeto_contrato"  value="" required></textarea>
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Obligaciones entre las Partes:</label>   
		<textarea type="text"  rows="5" cols="40" class="form-control" id="obligaciones_partes"  name="obligaciones_partes"  value="" required></textarea>
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Valor Contrato:</label>   
        <input type="number" class="form-control text-right" id="valor_contrato" name="valor_contrato" value="" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Duración Meses:</label>   
        <input type="number"  class="form-control" id="duracion_meses" name="duracion_meses" value="" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Duración Días:</label>   
        <input type="number"  class="form-control" id="duracion_dias" name="duracion_dias" value="" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Firma Contrato:</label>   
        <input type="date" class="form-control" id="fecha_firma_contrato" name="fecha_firma_contrato" value="" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio Servicio:</label>   
        <input type="date" class="form-control" id="fecha_inicio_servicio" name="fecha_inicio_servicio" value="" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Terminación Servicio:</label>   
        <input type="date" class="form-control" id="fecha_fin_servicio" name="fecha_fin_servicio" value="" required >
    </div>
	<?php if ($id_natu_juridica_gestor < 4 or $id_natu_juridica_gestor == 6) { ?>
    <div id = "acontrato" class="form-group text-left" style="display:block;"> 
        <label  class="control-label"> ADJUNTAR CONTRATO:</label> 
        <input type="file" value=""  id="file2" name="file2" required >
        <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
    </div>

    <div id = "acamara" class="form-group text-left" style="display:block;"> 
        <label  class="control-label"> ADJUNTAR CAMARA COMERCIO:</label> 
        <input type="file" value=""  id="file3" name="file3" required >
        <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
    </div>
    <?php } ?>
	<div class="modal-footer">
        <span style="color:#ff0000;">(*) Campos obligatorios</span>
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="insertcontra" value="contrato">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 

<?php

// ********************************
// Nuevo Municipio Gestor
// ********************************
?>
<div class="modal fade" id="nmunicipio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVO MUNICIPIO</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form431156755"  enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_gestor_catastral" name="id_gestor_catastral" value="<?php echo $id_gestor_catastral; ?>">
	<div class="form-group text-left"> 
	     <label  class="control-label"><span style="color:#ff0000;">*</span> Municipio Gestor:</label> 
	     <select class="form-control" name="id_municipio" id="id_municipio" required>
         <option value="" selected></option>
         <?php echo deptociud(); ?>
         </select>
    </div>

	<div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="insertmuni" value="insertmuni">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 


 
 <?php
 // ************************************
 // Detalle de contratos Gestor
 // ************************************
 ?>
 
 		<div class="row">
			<div class="col-md-8">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'CONTRATOS DEL GESTOR'; ?>
					   </h4> 
                       <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ncontrato"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Contrato</a> 
					   </h4> 
					   <?php } ?>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID</th>
                                <th>Tipo Contrato</th>
								<th>Nombre Tipo Contrato</th>
                                <th>Duración Meses</th>
								<th>Duración Días</th>
                                <th>Fecha Firma</th>
								<th>Fecha Inicio</th>
                                <th>Fecha Terminación</th>
                                <th>Valor Contrato</th>
                                <th colspan="4">Accion</th>
                             </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT id_contratos_gestor, 
			    a.id_tipo_contrato_gestor, objeto_contrato, 
				duracion_meses, duracion_dias, fecha_firma_contrato,
			    fecha_inicio_servicio, fecha_fin_servicio, nombre_tipo_contrato_gestor,
				valor_contrato, docto_contrato, docto_camara
	            FROM contratos_gestor a
				LEFT JOIN tipo_contrato_gestor b
				ON a.id_tipo_contrato_gestor = b.id_tipo_contrato_gestor
                WHERE id_gestor_catastral = '$id_gestor_catastral'  
				AND estado_contratos_gestor = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	 
                  $id_contratos_gestor = $row62['id_contratos_gestor'];			  
            ?>
          <tr>
             <td><?php echo $row62['id_contratos_gestor']; ?></td>
            <td><?php echo $row62['id_tipo_contrato_gestor'];?></td> 
			 <td><?php echo $row62['nombre_tipo_contrato_gestor']; ?></td>
			 <td><?php echo $row62['duracion_meses']; ?></td>
			 <td><?php echo $row62['duracion_dias']; ?></td>
			 <td><?php echo $row62['fecha_firma_contrato']; ?></td>
             <td><?php echo $row62['fecha_inicio_servicio']; ?></td>
             <td><?php echo $row62['fecha_fin_servicio']; ?></td>
             <td><?php echo number_format($row62['valor_contrato']); ?></td>
		     <?php if(strlen($row62['docto_contrato']) > 4  && strlen($row62['docto_camara']) > 4) { ?> 
		     <td> 
			    <a href="filesnr/catastrosnr/<?php echo $row62['docto_contrato']; ?>"  title="Contrato" target = '_blank' >
		       <img src="images/pdf.png"></a>
			 </td>
             <td>			 
	            <a href="filesnr/catastrosnr/<?php echo $row62['docto_camara']; ?>"  title="Camara Comercio" target = '_blank' >
		       <img src="images/pdf.png"></a>
	         </td>
		     <?php } else { echo ""; } ?>
             <td>
			 <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
                <a href="modi_contrato_gestor&<?php echo $id_contratos_gestor; ?>.jsp"><span class="btn btn-info btn-xs" title="Modificaciones al Contrato">Modificación al Contrato</a> &nbsp;
			 <?php } ?>
             </td>
		     
		     <td> 
			 <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="contratos_gestor" id="<?php echo $row62['id_contratos_gestor']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
			 <?php } ?>
			 </td>
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
 // ************************************
 // Detalle de Municipios por Gestor
 // ************************************
 ?>
 
			<div class="col-md-4">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'MUNICIPIOS DEL GESTOR'; ?>
					   </h4> 
					   <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>  
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#nmunicipio"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Municipio</a> 
					   </h4> 
					   <?php } ?>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID</th>
                                <th>Departamento</th>
                                <th>Municipio</th>
								<th>Indicativo</th>
                                <th colspan="4">Accion</th>
                             </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT a.id_municipio_gestor, 
			    b.id_departamento, nombre_municipio,
				nombre_departamento, b.indicativo
	            FROM municipio_gestor a
				LEFT JOIN municipio c
				ON a.id_municipio = c.id_municipio 
			    LEFT JOIN departamento b
				ON c.id_departamento = b.id_departamento
                WHERE id_gestor_catastral = '$id_gestor_catastral'  
				AND estado_municipio_gestor = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	 
            ?>
          <tr>
             <td><?php echo $row62['id_municipio_gestor']; ?></td>
            <td><?php echo $row62['nombre_departamento'];?></td> 
			 <td><?php echo $row62['nombre_municipio']; ?></td>
			 <td><?php echo $row62['indicativo']; ?></td>
		     <td> 
			 <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="municipio_gestor" id="<?php echo $row62['id_municipio_gestor']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
			 <?php } ?>
			 </td>
          </tr>
          <?php } ?> 
          </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div>
</div><!-- col-md-12 -->


</div><!-- row -->

<?php
// *************************************
// MODIFICACION GESTOR
// **************************************
?>
		
<div class="modal fade" id="updgestor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN GESTOR</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="post" name="form43257435224" enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_gestor_catastral" id="id_gestor_catastral" value="<?php echo $id_gestor_catastral; ?>">
	<input type="hidden" class="form-control" name="nom_estudios_previos" id="nom_estudios_previos" value="<?php echo $nom_estudios_previos; ?>">
	<input type="hidden" class="form-control" name="nom_hdv_doctos" id="nom_hdv_doctos" value="<?php echo $nom_hdv_doctos; ?>">
	<input type="hidden" class="form-control" name="nom_contrato" id="nom_contrato" value="<?php echo $nom_contrato; ?>">

    <div class="form-group text-left"> 
      <label  class="control-label">Código Gestor:</label>   
      <input type="text" class="form-control" name="cod_gestor_catastral" value="<?php echo $cod_gestor_catastral; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Nombre Gestor:</label>   
      <input type="text" class="form-control" name="nombre_gestor_catastral" value="<?php echo $nombre_gestor_catastral; ?>">
    </div>
	
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Naturaleza Jurídica:</label>
        <select class="form-control" name="id_natu_juridica_gestor" id="id_natu_juridica_gestor">
        <option value="<?php echo $id_natu_juridica_gestor; ?>" selected><?php echo $nombre_natu_juridica_gestor ?></option>
        <?php echo lista('natu_juridica_gestor'); ?>
        </select>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">NIT Gestor:</label>   
      <input type="text" class="form-control" name="nit_gestor" value="<?php echo $nit_gestor; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Digito Verificación NIT:</label>   
      <input type="text" class="form-control" name="digito_verificacion" value="<?php echo $digito_verificacion; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Representante Legal:</label>   
      <input type="text" class="form-control" name="repre_legal" value="<?php echo $repre_legal; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Dirección Gestor:</label>   
      <input type="text" class="form-control" name="dir_gestor" value="<?php echo $dir_gestor; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Teléfono Gestor:</label>   
      <input type="text" class="form-control" name="tel_gestor" value="<?php echo $tel_gestor; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Correo Gestor:</label>   
      <input type="text" class="form-control" name="correo_gestor" value="<?php echo $correo_gestor; ?>" onChange = "televal();">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Acto Administrativo Res. Habilitación:</label>   
      <input type="text" class="form-control" name="acto_adtvo_habili" value="<?php echo $acto_adtvo_habili; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Acto Administrativo Prestac. Servicio:</label>   
      <input type="text" class="form-control" name="acto_adtvo_prestaser" value="<?php echo $acto_adtvo_prestaser; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Fecha Habilitación:</label>   
      <input type="date" class="form-control" name="fecha_habilitacion" value="<?php echo $fecha_habilitacion; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Fecha Inicio:</label>   
      <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Fecha Terminación Contrato:</label>   
      <input type="date" class="form-control" name="fecha_fin" value="<?php echo $fecha_fin; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Jurisdicción x Habilitación:</label>   
      <input type="text" class="form-control" name="jurisdiccion_xhabilitacion" value="<?php echo $jurisdiccion_xhabilitacion; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Jurisdicción x Contrato:</label>   
      <input type="text" class="form-control" name="jurisdiccion_xcontrato" value="<?php echo $jurisdiccion_xcontrato; ?>">
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Fecha Terminación Jurisdicción Contrato:</label>   
      <input type="date" class="form-control" name="fecha_jurisdiccion_contrato" value="<?php echo $fecha_jurisdiccion_contrato; ?>">
    </div>

	<div class="form-group text-left"> 
		<label  class="control-label"><span style="color:#ff0000;">*</span> Usuario Gestor:</label> 
		<select class="form-control" name="id_funcionario_catastro" id="id_funcionario_catastro" required>
        <option value="<?php echo $id_funcionario_catastro; ?>" selected><?php echo $nombre_funcionario; ?></option>
        <?php echo funcatastro(); ?>
        </select>
    </div>

    <div id = "acontrato" class="form-group text-left" style="display:block;"> 
        <label  class="control-label"> Acto Adtvo de Habilitación:</label><?php echo ' Nombre archivo: -> '.$nom_estudios_previos; ?>
        <input type="file" value=""  id="file11" name="file11">
        <span class="mensajeaclaracion">(Solo admite el formato PDF)</span>
    </div>

    <div id = "acontrato" class="form-group text-left" style="display:block;"> 
        <label  class="control-label"> Acto Adtvo Prestación Servicio:</label><?php echo ' Nombre archivo: -> '.$nom_hdv_doctos; ?> 
        <input type="file" value=""  id="file2" name="file2">
        <span class="mensajeaclaracion">(Solo admite el formato PDF)</span>
    </div>

    <div id = "acontrato" class="form-group text-left" style="display:block;"> 
        <label  class="control-label"> Cronograma de Habilitación:</label><?php echo ' Nombre archivo: -> '.$nom_contrato; ?> 
        <input type="file" value=""  id="file3" name="file3">
        <span class="mensajeaclaracion">(Solo admite el formato PDF)</span>
    </div>

	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="modigestor" value="gestor">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>

<?php
// ***************************
// Modificacion Contrato
// ***************************
?>

<div class="modal fade"  id="modiausen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN CONTRATO</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4324424" enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_gestor_catastral" id="id_gestor_catastral" readonly="readonly" value="<?php echo $id_gestor_catastral; ?>">

	
    <div class="form-group text-left"> 
      <label  class="control-label">ID Contrato:</label>   
      <input type="text" class="form-control" name="id_contratos_gestor" id="id_contratos_gestor" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Contrato:</label> 
        <select class="form-control" name="id_tipo_contrato_gestor2" id="id_tipo_contrato_gestor2" onChange = "valotros2();">
        <option value="<?php echo $id_tipo_contrato_gestor ?>" selected><?php echo $nombre_tipo_contrato_gestor ?></option>
          <?php echo lista('tipo_contrato_gestor'); ?>
        </select>
    </div>

    <div id = "detotros2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Detalle Otros:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="detalle_otros2"  name="detalle_otros2"  value=""></textarea>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Objeto Contrato:</label>   
      <textarea type="text"  rows="5" cols="40" class="form-control" id="objeto_contrato2"  name="objeto_contrato2"  value=""  required></textarea>
	</div>

     <div class="form-group text-left"> 
      <label  class="control-label">Obligaciones entre las Partes:</label>   
	  <textarea type="text"  rows="5" cols="40" class="form-control" id="obligaciones_partes2"  name="obligaciones_partes2"  value=""  required></textarea>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Valor Contrato:</label>   
      <input type="text" class="form-control" name="valor_contrato2" id="valor_contrato2" value="" required >
    </div>

   <div class="form-group text-left"> 
      <label  class="control-label">Duración Contrato en Meses:</label>   
      <input type="text" class="form-control" name="duracion_meses2" id="duracion_meses2" value="" required >
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">Duración Contrato en Días:</label>   
      <input type="text" class="form-control" name="duracion_dias2" id="duracion_dias2" value="" required >
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Firma Contrato:</label>   
      <input type="date" class="form-control" name="fecha_firma_contrato2" id="fecha_firma_contrato2" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Inicio Servicio:</label>   
      <input type="date" class="form-control" name="fecha_inicio_servicio2" id="fecha_inicio_servicio2" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Fin Servicio:</label>   
      <input type="date" class="form-control" name="fecha_fin_servicio2" id="fecha_fin_servicio2" value="" required >
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actcontra" value="contrato">
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
			  WHERE id_tipo_oficina = 5 
			   AND estado_funcionario = 1 ";
    $result37 = $mysqli->query($query37);
    while ($obj37 = $result37->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj37['id_funcionario'], $obj37['nombre_funcionario']);
    }
$result37->free();	
 }

?>

<?php

// modif gestor
?>

<?php

// modifi de contratos


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
    function valotros() {
	var tipo_contrages = document.getElementById('id_tipo_contrato_gestor').value;
		if ( tipo_contrages == 3) {
			detotros.style.display='block';
			document.getElementById('detalle_otros').focus();
		} else {
			detotros.style.display='none';
			document.getElementById('detalle_otros').value = ' ';
			document.getElementById('repre_legal').focus();
        }
    }
</script>

<script>
    function valotros2() {
	var tipo_contrages = document.getElementById('id_tipo_contrato_gestor2').value;
		if ( tipo_contrages == 3) {
			detotros2.style.display='block';
			document.getElementById('detalle_otros2').focus();
		} else {
			detotros2.style.display='none';
			document.getElementById('detalle_otros2').value = ' ';
			document.getElementById('objeto_contrato2').focus();
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
          $("#modiausen").modal("show");
          $('#id_contratos_gestor').val(data[0]);
          $('#id_tipo_contrato_gestor2').val(data[1]);
          $('#nombre_tipo_contrato_gestor2').val(data[2]);
		  $('#obligaciones_partes2').val(data[2]);
          $('#duracion_meses2').val(data[3]);
          $('#duracion_dias2').val(data[4]);
		  $('#fecha_firma_contrato2').val(data[4]);
		  $('#fecha_inicio_servicio2').val(data[5]);
		  $('#fecha_fin_servicio2').val(data[5]);
          $('#valor_contrato2').val(data[6]);
      });  
    });

</script>
