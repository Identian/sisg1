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
   $id_gestor_catastral=intval($_GET['i']);
   } else {
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
   }

    } else { 
    echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 
 
if ($id_gestor_catastral > 0) { // Hasta el final
	
	$id_gestor_catastral=intval($_GET['i']);
	
	
    $query4 = sprintf("SELECT id_gestor_catastral, cod_gestor_catastral,
			                                  nombre_gestor_catastral, a.id_natu_juridica_gestor, nit_gestor, 
											  a.digito_verificacion, repre_legal,
											  dir_gestor, tel_gestor, correo_gestor, acto_adtvo_habili,
											  acto_adtvo_prestaser,
											  fecha_habilitacion, jurisdiccion_xhabilitacion, 
											  jurisdiccion_xcontrato, fecha_inicio, fecha_fin,
											  nombre_natu_juridica_gestor,
											  a.id_funcionario_catastro, d.nombre_funcionario
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
 }


mysql_free_result($select4);


if ((isset($_POST["insertcontra"])) && ($_POST["insertcontra"] == "contrato")) { // 1
     $id_tipo_archivo = $_POST['id_tipo_archivo'];
//	 $id_gestor_catastral = $_POST['id_gestor_catastral'];
	 if ($id_tipo_archivo == 1) { // pdf
	    $nom_tipo_archivo = 'pdf';
		$vali_docto = 'application/pdf';
	 } 
	 if ($id_tipo_archivo == 2) { // doc
	    $nom_tipo_archivo = 'doc';
		$vali_docto = 'application/doc';
	 } 
	 if ($id_tipo_archivo == 3) { // xls
	    $nom_tipo_archivo = 'xls';
		$vali_docto = 'application/xls';
	 } 

/*
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
*/

    // FILE = GESTOR	
   if (isset($_FILES['file2']) and strlen($_FILES['file2']['name']) > 4){ // 2
//     if (1 == 1){ 
	 
      $tipoArchivo=explode("/",$_FILES["file2"]["type"]);
      $ubicacion="filesnr/catastrosnr/";
	  $NomImagen2=$_FILES['file2']['name'];
	  $num_alea = rand(5, 95);
	  $totarchivo=explode(".",$_FILES["file2"]["name"]);
//	  $nombre_img2='DOCTO-'.$id_gestor_catastral.'-'.$num_contrato.'-'.$aleatorio.'.pdf';
	  $nombre_img2='DOCTO-'.$id_gestor_catastral.'-'.$aleatorio.$num_alea.'.'.$nom_tipo_archivo;
      $NomImagenR=$ubicacion."/".$nombre_img2;
      $nombre_catastro_carguedoc = $nombre_img2;
	  
      if (($_FILES['file2']['name'] == !NULL) && ($_FILES['file2']['size'] <= 11534336)) { 
	  
	    move_uploaded_file($_FILES['file2']['tmp_name'],$NomImagenR);
	  
	  
//	    if ($_FILES["file2"]["type"] == "application/pdf") {

/*
		if ($_FILES["file2"]["type"] == $vali_docto) {

            move_uploaded_file($_FILES['file2']['tmp_name'],$NomImagenR);
				  
        } else { 
		     $nombre_img2= ' ';
			} // fin 4 
*/			
			
      } else { 
	          $nombre_img2= ' ';
		} // fin 3
  } else { 
      $nombre_img2= ' ';
  } // fin 2
	
		
	$insertSQL5 = sprintf("INSERT INTO catastro_carguedoc (
      id_gestor_catastral, id_tipo_archivo, nombre_catastro_carguedoc, 
	  descrip_catastro_carguedoc, fecha_registro) 
	  VALUES (%s, %s, %s, %s, now())", 
      GetSQLValueString($id_gestor_catastral, "int"), 
      GetSQLValueString($_POST['id_tipo_archivo'], "text"), 
	  GetSQLValueString($nombre_catastro_carguedoc, "text"), 
      GetSQLValueString($_POST['descrip_catastro_carguedoc'], "text")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());
	  
//  echo '<meta http-equiv="refresh" content="0;URL= ./catastro_carguedoc&'.$id_gestor_catastral.'.jsp" />';

} 


?>

<script>
     $(document).ready(function() {
      $('.nuevoc').on('click', function() {   
	 alert ('entro en llamado de cargue');	  
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
                 <h3 class="box-title"><b>GESTOR CATASTRAL</b></h3> &nbsp; &nbsp; 
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
                        <label  class="control-label">Acto Administrativo Res. Habilitación:</label>   
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
                        <label  class="control-label">Fecha Terminación:</label>   
                        <?php echo $row4['fecha_fin']; ?>
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
// Nuevo Documento Gestor
// ********************************
?>
<div class="modal fade" id="ncontrato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVO DOCUMENTO GESTOR</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form4311567534555"  enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_gestor_catastral" name="id_gestor_catastral" value="<?php echo $id_gestor_catastral; ?>">
	<input type="hidden" class="form-control" id="id_natu_juridica_gestor" name="id_natu_juridica_gestor" value="<?php echo $id_natu_juridica_gestor; ?>">
    <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Archivo:</label> 
        <select class="form-control" name="id_tipo_archivo" id="id_tipo_archivo" required >
        <option value="" selected></option>
          <?php echo lista('tipo_archivo'); ?>
        </select>
    </div>
    <div id = "detotros" class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Descripción Archivo:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="descrip_catastro_carguedoc"  name="descrip_catastro_carguedoc"  value="" required ></textarea>
    </div>
    <div id = "acontrato" class="form-group text-left" style="display:block;"> 
        <label  class="control-label"> ADJUNTAR ARCHIVO:</label> 
        <input type="file" value=""  id="file2" name="file2">
        <span class="mensajeaclaracion">(Solo admite el formato PDF / DOC / XLS inferior a 5 Megas.)</span>
    </div>

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
 // ************************************
 // Detalle de documentos Gestor
 // ************************************
 ?>
 
 		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'DOCUMENTOS DEL GESTOR'; ?>
					   </h4> 
					   <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ncontrato"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Documento</a> 
					   </h4> 
					   <?php } ?>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID Cargue Docto</th>
                                <th>ID Gestor</th>
                                <th>Tipo Archivo</th>
								<th>Nombre Archivo</th>
                                <th>Detalle Archivo</th>
                                <th colspan="4">Acción</th>
                             </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT id_catastro_carguedoc, 
			    id_gestor_catastral, a.id_tipo_archivo, nombre_tipo_archivo,
			    nombre_catastro_carguedoc, descrip_catastro_carguedoc
	            FROM catastro_carguedoc a
				LEFT JOIN tipo_archivo b
				ON a.id_tipo_archivo = b.id_tipo_archivo
                WHERE a.id_gestor_catastral = '$id_gestor_catastral'  
				AND estado_catastro_carguedoc = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	 
                  $id_catastro_carguedoc = $row62['id_catastro_carguedoc'];
                  $id_tipo_archivo = $row62['id_tipo_archivo'];	
                 
                 if ($id_tipo_archivo == 1 ) { // pdf
					 $ima_tipoarch = 'images/pdf.png';
				 }				 
                 if ($id_tipo_archivo == 2 ) { // doc
					 $ima_tipoarch = 'images/doc.png';
				 }				 
                 if ($id_tipo_archivo == 3 ) { // xls
					 $ima_tipoarch = 'images/xls.png';
				 }				 
            ?>
          <tr>
             <td><?php echo $row62['id_catastro_carguedoc']; ?></td>
            <td><?php echo $row62['id_gestor_catastral'];?></td> 
			 <td><?php echo $row62['nombre_tipo_archivo']; ?></td>
			 <td><?php echo $row62['nombre_catastro_carguedoc']; ?></td>
			 <td><?php echo $row62['descrip_catastro_carguedoc']; ?></td>
		     <?php if(strlen($row62['nombre_catastro_carguedoc']) > 4) { ?> 
		     <td> 
			    <a href="filesnr/catastrosnr/<?php echo $row62['nombre_catastro_carguedoc']; ?>"  title="<?php echo $row62['descrip_catastro_carguedoc']; ?>" target = '_blank' >
		       <img src="<?php echo $ima_tipoarch; ?>"></a>
			 </td>
		     <?php } else { echo ""; } ?>
		     
		     <td> 
			 <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="catastro_carguedoc" id="<?php echo $row62['id_catastro_carguedoc']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
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
