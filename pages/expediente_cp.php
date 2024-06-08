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
// Registra nuevo expediente
// ***********************************

if (isset($_POST['insertexpcp']) and $_POST['insertexpcp'] == 'insertexpcp') {

	$id_causante_cuota_parte = $_POST['id_causante_cuota_parte'];
    $nombre_expediente_cp = $_POST['nombre_expediente_cp'];
	$tipo_name_file = $_POST['tipo_name_file'];

// archiva documento

   if (""!=$_FILES['file']['tmp_name']) { // 2


      $tipoArchivo=explode("/",$_FILES["file"]["type"]);
      $ubicacion="filesnr/cuota_parte/";
	  $NomImagen=$_FILES['file']['name'];
	  $totarchivo=explode(".",$_FILES["file"]["name"]);
	  $aleatorio = aleatorio(100);
	  
	 //  echo $totarchivo[0];
	 $nombre_img='EXPED_'.$id_causante_cuota_parte.'-'.$aleatorio.'.pdf';
	 
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
      $NomImagenR=$ubicacion."/".$nombre_img;
	 
     

      if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 11534336)) { // 3
	    if ($_FILES["file"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file']['tmp_name'],$NomImagenR);
			 
 //           echo $insertado;
            echo ' ';
        } 
		
		
     }
   }

	$insertSQL = sprintf("INSERT INTO expediente_cp (
      id_causante_cuota_parte, nombre_expediente_cp, 
	  name_file, tipo_name_file) 
	  VALUES (%s, %s, %s, %s)", 
      GetSQLValueString($id_causante_cuota_parte, "int"), 
	  GetSQLValueString($nombre_expediente_cp, "text"),
	  GetSQLValueString($nombre_img, "text"),
	  GetSQLValueString($tipo_name_file, "int")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

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


// eliminar registro

if (isset($_GET["e"]) && ""!=$_GET["e"]) {
    $id_expediente_cp = intval($_GET["e"]);

   $query84 = "UPDATE expediente_cp SET estado_expediente_cp = 0  WHERE id_expediente_cp = ".$id_expediente_cp." limit 1";  
   $Result1 = mysql_query($query84, $conexion);

   echo $actualizado;
  
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
			    <li><a href="causantes_cp&<?php echo $id_causante_cuota_parte; ?>.jsp"><b>EXPEDIENTES - CUOTA PARTE</b></a></li>
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
 // ************************************
 // Detalle de Expedientes
 // ************************************
 ?>
 
 		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>					   
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#nmetafun"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Expediente</a> 
					   </h4> 
					   <?php } ?>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID Reg</th>
                                <th>ID Causante</th>
								<th>Descriptivo</th>
								<th>Archivo</th>
								<th>Tipo Archivo</th>
				                <th colspan="4">Accion</th>
                             </tr>
                </thead>
            <tbody>

            <?php
               $query62 = sprintf("SELECT * 
	            FROM expediente_cp   
                WHERE id_causante_cuota_parte = '$id_causante_cuota_parte'  
				AND estado_expediente_cp = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
			   $tipo_archivo = $row62['tipo_name_file'];
			   $dtipo_name_file = 'Expediente';
			   if ($tipo_archivo == 2) {
				   $dtipo_name_file = 'Cuenta de Cobro';
			   } 
			   if ($tipo_archivo == 3) {
				   $dtipo_name_file = 'Otro Tipo';
			   } 
            ?>
          <tr>
             <td><?php echo $row62['id_expediente_cp']; ?></td>
             <td><?php echo $row62['id_causante_cuota_parte']; ?></td>
             <td><?php echo utf8_encode($row62['nombre_expediente_cp']);?></td> 
			 <td><?php echo utf8_encode($row62['name_file']);?></td> 
			 <td><?php echo $dtipo_name_file; ?></td>
			 <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
		     <td> 
			    <a href="filesnr/cuota_parte/<?php echo $row62['name_file']; ?>" title="Expediente" target = '_blank' ><img src="images/pdf.png"></a>
             </td>
		     <td> 
			   <a href="expediente_cp&<?php echo $row62['id_causante_cuota_parte']; ?>&<?php echo $row62['id_expediente_cp']; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar registro"  ><span class="glyphicon glyphicon-trash"></span></a>
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
// Nuevo Expediente
// ********************************
?>
<div class="modal fade" id="nmetafun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVO EXPEDIENTE CP</b><span style="font-weight: bold;"></span></h4>
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
        <label  class="control-label"><span style="color:#ff0000;">*</span> Descriptivo Archivo:</label>   
        <textarea rows="5" cols="40" class="form-control" id="nombre_expediente_cp"  name="nombre_expediente_cp" value="" required ></textarea>
    </div>
    
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Archivo:</label>    
        <select class="form-control" name="tipo_name_file" required >
         <option value="" selected></option>
         <option value="1">Expediente</option>
         <option value="2">Cuenta de Cobro</option>
         <option value="3">Otro tipo</option>
        </select>
    </div>    
	
    <div class="form-group text-left"> 
         <label  class="control-label"> ADJUNTAR DOCUMENTO (en PDF):</label> 
         <input type="file" value=""  id="file" name="file" required >
         <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
    </div>
    
	<div class="modal-footer">
        <span style="color:#ff0000;">(*) Campos obligatorios</span>
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="insertexpcp" value="insertexpcp">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 


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

 
