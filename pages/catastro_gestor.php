<?php

$nump147=privilegios(147,$_SESSION['snr']);


$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;

if (1==$_SESSION['rol'] or 0<$nump147) {

   if (isset($_GET['i'])) { 
	
	  $id_funcionario=intval($_GET['i']); 
	//  echo "id: ".$id_funcionario;
	  
    } else {
	  $id_funcionario = $_SESSION['snr'];
	}  
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
	   
//	   echo "id func: ".$id_funcionario."  -  ";
//	   echo "tipo of: ".$id_tipo_oficina."  -  ";
//	   echo "grupo_area: ".$id_grupo_area."  -  ";
//	   echo "oficina_registro: ".$id_tipo_oficina;
	   
   }
	  
} else { 
     echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 

$sw5 = 0;


if($id_tipo_oficina == 1 or  $_SESSION['rol'] == 1) { // Grupo Catastral a Admon
  $privi = " ";
  $sw5 = 10;
  
} 

// NOTA: para los Gestores Catastrales  Tipo Oficina = 6 (catastro) y 
// se debe crear otro grupo <> IVC CATASTRAL


if($id_tipo_oficina == 6) { // Gestores Catastrales
  $privi = " AND a.id_funcionario_catastro = '$id_funcionario' ";
  $sw5 = 10;
} 



if($sw5 == 0) {
  echo '<meta http-equiv="refresh" content="0;URL=./" />';
}

if (isset($_GET["e"]) && ""!=$_GET["e"]) {
    $id_gestor_catastral=intval($_GET["e"]);

   $query84 = "UPDATE gestor_catastral SET estado_gestor_catastral = 0  WHERE id_gestor_catastral = ".$id_gestor_catastral." limit 1";  
   $query86 = "UPDATE contratos_gestor SET estado_contratos_gestor = 0  WHERE id_gestor_catastral = ".$id_gestor_catastral." limit 50";  
 
   $Result1 = mysql_query($query84, $conexion);
   $Result12 = mysql_query($query86, $conexion);
 
   echo $hecho;

 } else {
  
 }

 include('tablero_gestor.php');

if (isset($_POST['archgestor']) && $_POST['archgestor'] == 'gestor') {

	$id_funcionario = $_POST['id_funcionario'];

   if (isset($_FILES['file1']) and strlen($_FILES['file1']['name']) > 4){ // 2
       $txtImagen1 = $_FILES['file1']['name'];
//      $tipoArchivo=explode("/",$_FILES["file1"]["type"]);
	  $tipoArchivo=$_FILES["file1"]["type"];
      $ubicacion="filesnr/catastrosnr";
	  $NomImagen1=$_FILES['file1']['name'];
	  $num_alea = rand(5, 95);
	  $totarchivo=explode(".",$_FILES["file1"]["name"]);
//	  $nombre_img1='DOCTO-'.$id_gestor_catastral.'-'.$aleatorio.$num_alea.'.'.$tipoArchivo;

	  $NomImagenR1=$ubicacion."/".$NomImagen1;
//      $nombre_catastro_carguedoc = $nombre_img1;
	  
      if (($_FILES['file1']['name'] == !NULL) && ($_FILES['file1']['size'] <= 11534336)) { 
	  
	    move_uploaded_file($_FILES['file1']['tmp_name'],$NomImagenR1);

      } 
  } else {
	 $txtImagen1 = 'PENDIENTE';  
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
	  
      if (($_FILES['file2']['name'] == !NULL) && ($_FILES['file2']['size'] <= 11534336)) { 
	  
	    move_uploaded_file($_FILES['file2']['tmp_name'],$NomImagenR2);

      } 
  } else {
	 $txtImagen2 = 'PENDIENTE';  
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
	  
      if (($_FILES['file3']['name'] == !NULL) && ($_FILES['file3']['size'] <= 11534336)) { 
	  
	    move_uploaded_file($_FILES['file3']['tmp_name'],$NomImagenR3);

      } 
  } else {
	 $txtImagen3 = 'PENDIENTE';  
  }
	
		
	$insertSQL = sprintf("INSERT INTO gestor_catastral (
      cod_gestor_catastral, nombre_gestor_catastral, id_natu_juridica_gestor,
      nit_gestor, digito_verificacion, repre_legal, dir_gestor, tel_gestor, 
	  correo_gestor, acto_adtvo_habili, acto_adtvo_prestaser, fecha_habilitacion, fecha_inicio,
	  fecha_fin, cargo_gestor, jurisdiccion_xhabilitacion, jurisdiccion_xcontrato, 
	  fecha_jurisdiccion_contrato, pagina_web,
	  enlace_designado, telefono_enlace, correo_enlace, cargo_enlace, nom_estudios_previos, 
	  nom_hdv_doctos, nom_contrato, id_funcionario_catastro, id_funcionario) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
	  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
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
	  GetSQLValueString($_POST['cargo_gestor'], "text"),
      GetSQLValueString($_POST['jurisdiccion_xhabilitacion'], "text"),
	  GetSQLValueString($_POST['jurisdiccion_xcontrato'], "text"),
	  GetSQLValueString($_POST['fecha_jurisdiccion_contrato'], "date"),
	  GetSQLValueString($_POST['pagina_web'], "text"),
	  GetSQLValueString($_POST['enlace_designado'], "text"),
	  GetSQLValueString($_POST['telefono_enlace'], "text"),
	  GetSQLValueString($_POST['correo_enlace'], "text"),
	  GetSQLValueString($_POST['cargo_enlace'], "text"),
	  GetSQLValueString($txtImagen1, "text"),
	  GetSQLValueString($txtImagen2, "text"),
	  GetSQLValueString($txtImagen3, "text"),
	  GetSQLValueString($_POST['id_funcionario_catastro'], "int"),
      GetSQLValueString($id_funcionario, "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

// echo '<meta http-equiv="refresh" content="0;URL= ./catastro_gestor.jsp" />';
	  
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
		  MÓDULO DE GESTORES CATASTRALES
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
       <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Gestor</button>&nbsp;
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
	   <?php } ?>
    </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  <th>Id Gestor</th>
				  <th>Código</th>
                  <th>Nombre</th>
				  <th>Correo Electrónico</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Habilitación</th>
				  <th>Acto Adtvo Habili</th>
				  <th>Acto Adtvo PrestServ</th>
				  <th>Cronograma Habilitación</th>
                 <th colspan="4">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT id_gestor_catastral, cod_gestor_catastral,
			                                  nombre_gestor_catastral, id_natu_juridica_gestor, repre_legal,
											  dir_gestor, tel_gestor, correo_gestor, acto_adtvo_habili,
											  fecha_habilitacion, fecha_inicio, fecha_fin, jurisdiccion_xhabilitacion,
											  nom_estudios_previos, nom_hdv_doctos, nom_contrato 
			                                FROM gestor_catastral a
                          WHERE a.estado_gestor_catastral = 1 ".$privi." order by a.fecha_inicio ");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {
				  
            ?>
          <tr>
		     <?php 
			 $id_gestor_catastral = $row_dian['id_gestor_catastral'];
		     $cod_gestor_catastral = $row_dian['cod_gestor_catastral'];
             $nombre_gestor_catastral = $row_dian['nombre_gestor_catastral'];
			 $natu_juridica = $row_dian['id_natu_juridica_gestor'];
			 $repre_legal = $row_dian['repre_legal'];
			 $dir_gestor = $row_dian['dir_gestor'];
			 $tel_gestor = $row_dian['tel_gestor'];
			 $correo_gestor = $row_dian['correo_gestor'];
			 $acto_adtvo = $row_dian['acto_adtvo_habili'];
			 $fecha_habilitacion = $row_dian['fecha_habilitacion'];
			 $fecha_inicio = $row_dian['fecha_inicio'];
			 $fecha_fin = $row_dian['fecha_fin'];
			 $jurisdiccion = $row_dian['jurisdiccion_xhabilitacion'];
			 $nom_estudios_previos = $row_dian['nom_estudios_previos'];
			 $nom_hdv_doctos = $row_dian['nom_hdv_doctos'];
			 $nom_contrato = $row_dian['nom_contrato'];
			 $tot_sv = 0;
              $query75 = sprintf("SELECT count(id_notificaciones_gestor) tot_sv
			                                FROM notificaciones_gestor 
                          WHERE estado_notificaciones_gestor = 1 
						  AND id_gestor_catastral = ".$id_gestor_catastral.
						 " AND control_visualizacion = 0  ");
              $select75 = mysql_query($query75, $conexion) or die(mysql_error());
              while($row75 = mysql_fetch_array($select75)) {
                 $tot_sv = $row75['tot_sv'];
			  }	 
			$sw5 = 0;
			
	         ?>
             <td  width = "100px" style="font-size:14px;"><?php echo $id_gestor_catastral; ?></td>
			 <td  width = "100px" style="font-size:14px;"><?php echo $cod_gestor_catastral; ?></td>
			 <td width = "380px" style="font-size:14px;"><?php echo $nombre_gestor_catastral; ?></td>
             <td width = "280px" style="font-size:14px;"><?php echo $correo_gestor; ?></td>
             <td width = "90px" style="font-size:14px;"><?php echo $fecha_inicio;?></td>
             <td width = "90px" style="font-size:14px;"><?php echo $fecha_habilitacion;?></td>
		     <?php if('PENDIENTE' != $row_dian['nom_estudios_previos']){ ?> 
		     <td> 
			    <a href="filesnr/catastrosnr/<?php echo $row_dian['nom_estudios_previos']; ?>" target = '_blank' >
		       <img src="images/pdf.png"></a>
	         </td>
		     <?php } else { ?>
			   <td><img src="images/alert.png"></td>
			 <?php  } ?>
			 
		     <?php if('PENDIENTE' != $row_dian['nom_hdv_doctos']){ ?> 
		     <td> 
			    <a href="filesnr/catastrosnr/<?php echo $row_dian['nom_hdv_doctos']; ?>" target = '_blank' >
		       <img src="images/pdf.png"></a>
	         </td>
		     <?php } else { ?>
			   <td><img src="images/alert.png"></td>
			 <?php  } ?>

		     <?php if('PENDIENTE' != $row_dian['nom_contrato']){ ?> 
		     <td> 
			    <a href="filesnr/catastrosnr/<?php echo $row_dian['nom_contrato']; ?>" target = '_blank' >
		       <img src="images/pdf.png"></a>
	         </td>
		     <?php } else { ?>
			   <td><img src="images/alert.png"></td>
			 <?php  } ?>
			 
			 
             <td>
                <a href="consulta_gestor&<?php echo $id_gestor_catastral; ?>.jsp"><span class="btn btn-info btn-xs" title="Consultar"><span  class="glyphicon glyphicon-hand-up"></span></a> &nbsp;
             </td>
             <td>
                <a href="notificacion_gestor&<?php echo $id_gestor_catastral; ?>.jsp"><span class="btn btn-success btn-xs" title="Notificaciones"><span  class="glyphicon glyphicon-check">&nbsp;<?php echo $tot_sv; ?></span></a> &nbsp;
             </td>
             <td>
                <a href="catastro_carguedoc&<?php echo $id_gestor_catastral; ?>.jsp"><span class="btn btn-warning btn-xs" title="Gestor - Cargue Documentos"><span  class="glyphicon glyphicon-file"></span></a> &nbsp;
             </td>
             <td>
                <a href="catastro_operador&<?php echo $id_gestor_catastral; ?>.jsp"><span class="btn btn-warning btn-xs" title="Operadores"><span  class="glyphicon glyphicon-user"></span></a> &nbsp;
             </td>             <td>
			 <?php if($id_tipo_oficina == 1 and ($id_grupo_area == 41 or $_SESSION['rol'] == 1)) { // Super Delegada para el Registro ?>
                <a href="catastro_gestor&<?php echo $id_funcionario; ?>&<?php echo $id_gestor_catastral; ?>.jsp" class="confirmationdel" style="color:#ff0000; font-size:20px; cursor: pointer" title="Borrar"  ><span class="glyphicon glyphicon-trash"></span></a>
                 <?php } ?>
             </td>
			<?php } ?>
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


<!-- Modal myModal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>NUEVO GESTOR</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                   <form action="" method="POST" name="form1" enctype="multipart/form-data">
				        <input type="hidden" name="id_funcionario" id="id_funcionario"   value="<?php echo $id_funcionario; ?>" >
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Código Gestor:</label>   
                              <input type="text" class="form-control" id="cod_gestor_catastral" name="cod_gestor_catastral"  value="" onChange = "validages();" required >
                         </div>
                       
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Nombre Gestor:</label>   
                              <input type="text" class="form-control" id="nombre_gestor_catastral" name="nombre_gestor_catastral"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Naturaleza Jurídica:</label> 
                              <select class="form-control" name="id_natu_juridica_gestor" id="id_natu_juridica_gestor" onChange = "valcontrato();" >
                              <option value="" selected></option>
                              <?php echo lista('natu_juridica_gestor'); ?>
                              </select>
                         </div>
						 
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> NIT Gestor:</label>   
                              <input type="number" class="form-control" id="nit_gestor" name="nit_gestor"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span>Digito Verificación NIT:</label>   
                              <input type="number" class="form-control" id="digito_verificacion" name="digito_verificacion"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Representante Legal:</label>   
                              <input type="text" class="form-control" id="repre_legal" name="repre_legal"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Cargo Gestor:</label>   
                              <input type="text" class="form-control" id="cargo_gestor" name="cargo_gestor"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span>Dirección Gestor:</label>   
                              <input type="text" class="form-control" id="dir_gestor" name="dir_gestor"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Teléfono Gestor:</label>   
                              <input type="text" class="form-control" id="tel_gestor" name="tel_gestor"  value="" onChange = "televal();" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Correo Gestor:</label>   
                              <input type="text" class="form-control" id="correo_gestor" name="correo_gestor"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Acto Adtvo x Habilitación:</label>   
                              <input type="text" class="form-control" id="acto_adtvo_habili" name="acto_adtvo_habili"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Acto Adtvo x Prestación Servicios:</label>   
                              <input type="text" class="form-control" id="acto_adtvo_prestaser" name="acto_adtvo_prestaser"  value="" required >
                         </div>

                         <div class="form-group text-left" id = "fhabili"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Habilitación:</label>   
                              <input type="date" class="form-control" id="fecha_habilitacion" name="fecha_habilitacion"  value="" required >
                         </div>

                         <div class="form-group text-left" id = "finicio"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio:</label>   
                              <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"  value="" required >
                         </div>

                         <div class="form-group text-left" id = "ffin"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Terminación Contrato:</label>   
                              <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Jurisdicción x Habilitación:</label>   
                              <input type="text" class="form-control" id="jurisdiccion_xhabilitacion" name="jurisdiccion_xhabilitacion"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Jurisdicción x Contrato:</label>   
                              <input type="text" class="form-control" id="jurisdiccion_xcontrato" name="jurisdiccion_xcontrato"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Final Jurisdicción x Contrato:</label>   
                              <input type="date" class="form-control" id="fecha_jurisdiccion_contrato" name="fecha_jurisdiccion_contrato"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Página web:</label>   
                              <input type="text" class="form-control" id="pagina_web" name="pagina_web"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Enlace Designado:</label>   
                              <input type="text" class="form-control" id="enlace_designado" name="enlace_designado"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Teléfono Enlace:</label>   
                              <input type="text" class="form-control" id="telefono_enlace" name="telefono_enlace"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Correo Enlace:</label>   
                              <input type="text" class="form-control" id="correo_enlace" name="correo_enlace"  value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Cargo Enlace:</label>   
                              <input type="text" class="form-control" id="cargo_enlace" name="cargo_enlace"  value="" required >
                         </div>

	                     <div class="form-group text-left"> 
		                    <label  class="control-label"><span style="color:#ff0000;">*</span> Usuario Gestor:</label> 
		                    <select class="form-control" name="id_funcionario_catastro" id="id_funcionario_catastro" required>
                            <option value="" selected></option>
                            <?php echo funcatastro(); ?>
                            </select>
                         </div>

                         <div id = "acontrato" class="form-group text-left" style="display:block;"> 
                            <label  class="control-label"> Acto Adtvo de Habilitación:</label> 
                            <input type="file" value=""  id="file1" name="file1">
                            <span class="mensajeaclaracion">(Solo admite el formato PDF)</span>
                         </div>

                         <div id = "acontrato" class="form-group text-left" style="display:block;"> 
                            <label  class="control-label"> Acto Adtvo Prestación Servicio:</label> 
                            <input type="file" value=""  id="file2" name="file2">
                            <span class="mensajeaclaracion">(Solo admite el formato PDF)</span>
                         </div>

                         <div id = "acontrato" class="form-group text-left" style="display:block;"> 
                            <label  class="control-label"> Cronograma de Habilitación:</label> 
                            <input type="file" value=""  id="file3" name="file3">
                            <span class="mensajeaclaracion">(Solo admite el formato PDF)</span>
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

<script>
    function valcontrato() {
	var natu_jurigestor = document.getElementById('id_natu_juridica_gestor').value;
		if ( natu_jurigestor <= 3 || natu_jurigestor == 6) {
			fhabili.style.display='block';
			finicio.style.display='block';
			ffin.style.display='block';
			document.getElementById('fecha_habilitacion').value = "";
			document.getElementById('fecha_inicio').value = "";
			document.getElementById('fecha_fin').value = "";

			document.getElementById('nit_gestor').focus();
		} else {
			fhabili.style.display='none';
			finicio.style.display='none';
			ffin.style.display='none';
			document.getElementById('fecha_habilitacion').value = "2019-05-25";
			document.getElementById('fecha_inicio').value = "2019-05-25";
			document.getElementById('fecha_fin').value = "2019-05-25";
			document.getElementById('nit_gestor').focus();
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
// debe ser 6 (id_tipo_oficina = 6)		
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
 
 	
?>

 
