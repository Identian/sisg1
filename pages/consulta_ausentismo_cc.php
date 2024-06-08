<?php
$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;
$id_tipo_ausentismo = 0;

if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {
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
	
	  $id_ausentismo=intval($_GET['i']); 
	  
	  $query8 = sprintf("SELECT * FROM ausentismo
                  where id_ausentismo = '$id_ausentismo' 
				  AND id_funcionario = '$id_funcionario' 
				 AND estado_ausentismo = 1 "); 
    $select8 = mysql_query($query8, $conexion) or die(mysql_error());
    $row8 = mysql_fetch_assoc($select8);
    $totalRows8 = mysql_num_rows($select8);
    if ($totalRows8 > 0){
       $id_tipo_ausentismo = $row8['id_tipo_ausentismo'];
   } else {
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
   }

    }
} else { 
    echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 
 
if ($id_tipo_ausentismo > 0) { // Hasta el final
	
	$id_ausentismo=intval($_GET['i']);
	
    $query4 = sprintf("SELECT au.id_funcionario, au.id_tipo_ausentismo, 
      fecha_inicio, hora_inicio, fecha_final, hora_final, 
      au.id_funcionario_jefe, au.id_funcionario_reempla,
      motivo_ausentismo, soli.nombre_funcionario funcionario_soli,
	  tipoa.nombre_tipo_ausentismo, jefe.nombre_funcionario funcionario_jefe,
	  reem.nombre_funcionario funcionario_reem,
	  au.id_aprobacion_ausentismo, apa.nombre_aprobacion_ausentismo
      FROM ausentismo au
      LEFT JOIN funcionario soli
      ON  au.id_funcionario = soli.id_funcionario
      LEFT JOIN tipo_ausentismo tipoa
      ON au.id_tipo_ausentismo = tipoa.id_tipo_ausentismo
      LEFT JOIN funcionario jefe
      ON  au.id_funcionario_jefe = jefe.id_funcionario
      LEFT JOIN funcionario reem
      ON  au.id_funcionario_reempla = reem.id_funcionario
      LEFT JOIN aprobacion_ausentismo apa
      ON   au.id_aprobacion_ausentismo =  apa.id_aprobacion_ausentismo
      WHERE au.id_ausentismo = ".$id_ausentismo." and au.id_funcionario = ".$id_funcionario.
      " AND estado_ausentismo = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
	$id_tipo_ausentismo = $row4['id_tipo_ausentismo'];
    $fecha_inicio = $row4['fecha_inicio'];
	$hora_inicio = $row4['hora_inicio'];
	$hora_final = $row4['hora_final'];
	$fecha_final = $row4['fecha_final'];
	$id_funcionario_jefe = $row4['id_funcionario_jefe'];
	$id_funcionario_reempla = $row4['id_funcionario_reempla'];
	$motivo_ausentismo = $row4['motivo_ausentismo'];
	$funcionario_soli = $row4['funcionario_soli'];
	$nombre_tipo_ausentismo = $row4['nombre_tipo_ausentismo'];
	$funcionario_jefe = $row4['funcionario_jefe'];
	$funcionario_reem = $row4['funcionario_reem'];
	$id_aprobacion_ausentismo = $row4['id_aprobacion_ausentismo'];
	$nombre_aprobacion_ausentismo = $row4['nombre_aprobacion_ausentismo'];

	$nom_tipoau      =  $row4['nombre_tipo_ausentismo'];
    $codifi = mb_detect_encoding($nom_tipoau, "UTF-8, ISO-8859-1");
    $nombre_tipo_ausentismo = iconv($codifi, 'UTF-8', $nom_tipoau);
	
	$nom_funcio  =  $row4['funcionario_soli'];
    $codifi = mb_detect_encoding($nom_funcio, "UTF-8, ISO-8859-1");
    $funcionario_soli = iconv($codifi, 'UTF-8', $nom_funcio);

	$nom_jefe  =  $row4['funcionario_jefe'];
    $codifi = mb_detect_encoding($nom_jefe, "UTF-8, ISO-8859-1");
    $funcionario_jefe = iconv($codifi, 'UTF-8', $nom_jefe);
	
	$nom_reem  =  $row4['funcionario_reem'];
    $codifi = mb_detect_encoding($nom_reem, "UTF-8, ISO-8859-1");
    $funcionario_reem = iconv($codifi, 'UTF-8', $nom_reem);

 }


mysql_free_result($select4);


if ((isset($_POST["insertdocto"])) && ($_POST["insertdocto"] == "carguedocto")) { // 1

  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');

   if (""!=$_FILES['file']['tmp_name']){ // 2
 
      $tipoArchivo=explode("/",$_FILES["file"]["type"]);
      $ubicacion="filesnr/ausentismosnr/";
	  $NomImagen=$_FILES['file']['name'];
	  $totarchivo=explode(".",$_FILES["file"]["name"]);
	  // echo $totarchivo[0];
	 $nombre_img=$id_ausentismo.'-'.$id_funcionario.'-'.$aleatorio.'.pdf';
	 
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
      $NomImagenR=$ubicacion."/".$nombre_img;
	 
     

      if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 11534336)) { // 3
	    if ($_FILES["file"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file']['tmp_name'],$NomImagenR);
			
//          $nombrebre_orig= ucwords($nombrefile);
//          $hash=md5($files);
            $id_tipo_docto_ausentismo = 0; // 0 = Evidencia

            $insertSQL = sprintf("INSERT INTO docto_ausentismo (id_ausentismo, 
		    id_tipo_docto_ausentismo, nombre_docto_ausentismo, 
			descrip_docto_ausentismo, estado_docto_ausentismo, 
		    fecha_registro) 
            VALUES (%s, %s, %s, %s, 1, now())", 
            GetSQLValueString($id_ausentismo, "int"), 
            GetSQLValueString($id_tipo_docto_ausentismo, "int"),
            GetSQLValueString($nombre_img, "text"),
			GetSQLValueString( $_POST["descrip_docto_ausentismo"], "text"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
		  
            echo $insertado;
            echo '<meta http-equiv="refresh" content="0;URL= ./consulta_ausentismo&'.$id_ausentismo.'.jsp" />';
        } else { $valido=0; echo  $doc_no_tipo;
	           echo '<meta http-equiv="refresh" content="0;URL= ./consulta_ausentismo&'.$id_ausentismo.'.jsp" />';
			} // fin 4 
      } else { $valido=0; echo $doc_tam;
	         echo '<meta http-equiv="refresh" content="0;URL= ./consulta_ausentismo&'.$id_ausentismo.'.jsp" />';
		} // fin 3
		
		
  } else { 
//      echo $doc_tam;
	  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_ausentismo&'.$id_ausentismo.'.jsp" />';
  } // fin 2

} 
?>
<?php
// *************************************
// MODIFICACION AUSENTISMO
// **************************************
?>
		
<div class="modal fade" id="mofiausen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>ACTUALIZACI&Oacute;N AUSENTISMO</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="post" name="form4325435224">

    <input type="hidden" class="form-control" name="id_ausentismo" id="id_ausentismo" readonly="readonly" value="<?php echo $id_ausentismo; ?>">

    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO:</label>   
      <input type="text" class="form-control" name="funcionario_soli" readonly="readonly" value="<?php echo $funcionario_soli; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO JEFE:</label>   
      <input type="text" class="form-control" name="funcionario_jefe" readonly="readonly" value="<?php echo $funcionario_jefe; ?>">
    </div>
	
    <?php if ($id_funcionario_reempla == 0) { $funcionario_reem = "SIN REEMPLAZO "; }  ?>
	<?php $id_funcionario_reempla2 = 0;  $funcionario_reem2 = "SIN REEMPLAZO "; ?>
    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO QUE LO REEMPLAZA: </label>  
        <select class="form-control" name="id_funcionario_reempla" id="id_funcionario_reempla">
        <option value="<?php echo $id_funcionario_reempla; ?>" selected><?php echo $funcionario_reem; ?></option>
		<option value="<?php echo $id_funcionario_reempla2; ?>" ><?php echo $funcionario_reem2; ?></option>
		<?php if ($id_tipo_oficina == 1) {  echo nivelc($id_funcionario, $id_grupo_area);  } ?>
        <?php if ($id_tipo_oficina == 2) {  echo ofireg($id_funcionario, $id_oficina_registro);  } ?>
        </select>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">TIPO DE AUSENTISMO:</label>   
      <input type="text" class="form-control" name="nombre_tipo_ausentismo"  readonly="readonly" value="<?php echo $nombre_tipo_ausentismo; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA INICIO:</label>   
      <input type="text" class="form-control" name="fecha_inicio" readonly="readonly" value="<?php echo $fecha_inicio; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA FINAL:</label>   
      <input type="text" class="form-control" name="fecha_final" readonly="readonly" value="<?php echo $fecha_final; ?>">
    </div>
<?php if ($fecha_inicio == $fecha_final) { ?>
    <div class="form-group text-left"> 
      <label  class="control-label">HORA INICIO:</label>   
      <input type="text" class="form-control" name="hora_inicio"  readonly="readonly" value="<?php echo $hora_inicio; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">HORA FINAL:</label>   
      <input type="text" class="form-control" name="hora_final"  readonly="readonly" value="<?php echo $hora_final; ?>">
    </div>
<?php } ?>

    <div class="form-group text-left"> 
        <label  class="control-label">MOTIVO DEL AUSENTISMO:</label>   
        <textarea type="text"  rows="4" cols="40" class="form-control" id="motivo_ausentismo"  name="motivo_ausentismo"><?php echo $motivo_ausentismo; ?></textarea> 
	</div>

    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="modiausen" value="modiausen">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<div class="modal fade" id="editcausante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Modificación de causante <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="post" name="fodf45dwf435435224">

    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="termsucesion" value="cierresu">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


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
			    <li><a href="ausentismo.jsp"><b>AUSENTISMO</b></a></li>
            </ul>
        </div>
		 
      </div>
    </nav>
  </div>
</div>

<?php
// *******************************
// Consulta Ausentismo
// *******************************		
?>

<div class="row">
    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <div class="row-md-6 text-left">
                 <h3 class="box-title"><b>CONSULTA AUSENTISMO</b></h3> &nbsp; &nbsp; 
    		     <a id="" class="ventana1" data-toggle="modal" data-target="#mofiausen" href="" title="Modificar Sucesi&oacute;n"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></a>
             </div>
             <input type="hidden" class="form-control" name="tot_causantes" id="tot_causantes" readonly="readonly" value="">
		  <div class="row-md-6 text-right">
	</div>
	    <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">FUNCIONARIO:</label>   
                       <?php echo $funcionario_soli; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">FUNCIONARIO JEFE:</label>   
                       <?php echo $funcionario_jefe; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">FUNCIONARIO QUE LO REEMPLAZA:</label>   
                       <?php echo $funcionario_reem; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">TIPO DE AUSENTISMO:</label>   
                       <?php echo $nombre_tipo_ausentismo; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">ESTADO AUSENTISMO:</label>   
                       <?php echo $nombre_aprobacion_ausentismo; ?>
                    </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA INICIO:</label>   
                        <?php echo $fecha_inicio; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA FINAL:</label>   
                        <?php echo $fecha_final; ?>
                  </div>
                 <?php if ($fecha_inicio == $fecha_final) { ?>

                  <div class="form-group text-left"> 
                        <label  class="control-label">HORA INICIO:</label>   
                        <?php echo $hora_inicio; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">HORA FINAL:</label>   
                        <?php echo $hora_final; ?>
                  </div>
                 <?php } ?>
                  <div class="form-group text-left"> 
                       <label  class="control-label">MOTIVO DEL AUSENTISMO:</label>   
                       <textarea type="text"  rows="4" cols="20" class="form-control" id="motivo_ausentismo"  name="motivo_ausentismo"  readonly="readonly" ><?php echo $motivo_ausentismo; ?></textarea> 
                  </div>
				</div>  
             </div>
        </div>
  </div>
  </div>
   </div> 
 </div>
 		<div class="row">
			<div class="col-md-6">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					       <?php if(0==$id_aprobacion_ausentismo) { ?>
            		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#carguedocau"><span class="glyphicon glyphicon-plus-sign"></span> Documento Ausentismo</a>
					       <?php } else { echo 'Documentos del Ausentismo ';}?>
					   </h4> 
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID</th>
                                <th>Archivo</th>
								<th>Descripción</th>
                                <th>Fecha Registro</th>
                                <th>Accion</th>
                             </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT id_docto_ausentismo, 
			    nombre_docto_ausentismo, descrip_docto_ausentismo,
			    fecha_registro
	            FROM docto_ausentismo
                WHERE id_ausentismo = '$id_ausentismo'  
				AND estado_docto_ausentismo = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	  
            ?>
          <tr>
             <td><?php echo $row62['id_docto_ausentismo'];?></td>
             <td><?php echo $row62['nombre_docto_ausentismo'];?></td>
			 <td><?php echo $row62['descrip_docto_ausentismo'];?></td>
             <td><?php echo $row62['fecha_registro'];?></td>

		     <?php if('' != $row62['nombre_docto_ausentismo']){ ?> 
		     <td> 
			    <a href="filesnr/ausentismosnr/<?php echo $row62['nombre_docto_ausentismo']; ?>" target = '_blank' >
		       <img src="images/pdf.png"></a>
			   <?php if(0==$id_aprobacion_ausentismo) { ?>
				<a style="color:#ff0000;cursor: pointer" title="Borrar" name="docto_ausentismo" id="<?php echo $row62['id_docto_ausentismo']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
				<?php } ?>
	         </td>
		     <?php } else { echo ""; } ?>
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
// *************************************
// Consulta detalle de ausentismo
// *************************************
?>		
			<div class="col-md-6">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'DETALLE AUSENTISMO'; ?>
					   </h4> 
               <div class="box-body">
               <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Fecha</th>
                  <th>Hora Inicio</th>
                  <th>Hora Final</th>
                  <th>Total Horas</th>
                   <th>Acción</th>
               </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT id_detalle_ausentismo, 
			    fecha_secuencia, hora_inicio, hora_final,
			    num_dias, num_horas
	            FROM detalle_ausentismo
                WHERE id_ausentismo = '$id_ausentismo'  
				AND estado_detalle_ausentismo = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
            ?>
          <tr>
      
             <td><?php echo $row62['id_detalle_ausentismo'];?></td>
             <td><?php echo $row62['fecha_secuencia'];?></td>
             <td><?php echo $row62['hora_inicio'];?></td>
             <td><?php echo $row62['hora_final'];?></td>
             <td><?php echo $row62['num_horas'];?></td>

		     <?php if(0==$id_aprobacion_ausentismo) { ?>
		     <td> 
				<a style="color:#ff0000;cursor: pointer" title="Borrar" name="detalle_ausentismo" id="<?php echo $row62['id_detalle_ausentismo']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
	         </td>
		     <?php } else { echo ""; } ?>
          </tr>
		  <?php } ?>
		  
          </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->

               </div>
</div>

<?php 
}

// mysql_free_result($update);

?>
<?php

// ********************************
// Carge Doctos Ausentismo
// ********************************
?>
<div class="modal fade" id="carguedocau" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>CARGUE DE DOCUMENTOS</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
  <form action="" method="POST" name="form43534543555" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_ausentismo" name="id_ausentismo" value="<?php echo $id_ausentismo; ?>">
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Ausentismo:</label>   
        <input type="text" required class="form-control" id="nombre_tipo_ausentismo"  name="nombre_tipo_ausentismo" readonly="readonly" value="<?php echo $nombre_tipo_ausentismo; ?>" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Documento:</label>   
        <input type="text" required class="form-control" id="id_tipo_docto_ausentismo" name="id_tipo_docto_ausentismo" readonly="readonly"  value="<?php echo"EVIDENCIA"; ?>" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Descripción Documento:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="descrip_docto_ausentismo"  name="descrip_docto_ausentismo"  value=""></textarea>
    </div>
    <div class="form-group text-left"> 
       <label  class="control-label"><span style="color:#ff0000;">*</span> ADJUNTAR DOCUMENTO:</label> 
       <input type="file" value=""  name="file" required>
       <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
    </div>

    <div class="form-group text-left">
	   <button type="submit" class="btn btn-success">
       <input type="hidden" name="insertdocto" value="carguedocto"><span class="glyphicon glyphicon-ok"></span> Agregar </button>
    </div>
  </form>
</div>
</div> 
</div> 
</div> 

<?php
// *****************************************
// Registro Modificacion Ausentismo
// *****************************************

if (isset($_POST['modiausen'])){

	$id_ausentismo = $_POST['id_ausentismo'];
	$id_funcionario_reempla = $_POST['id_funcionario_reempla'];
    $motivo_ausentismo = $_POST['motivo_ausentismo'];


    $updateSQL37 = sprintf("UPDATE ausentismo 
	        SET id_funcionario_reempla = %s, 
	        motivo_ausentismo = %s
			WHERE id_ausentismo = %s",                  
	GetSQLValueString($id_funcionario_reempla, "int"),
	GetSQLValueString($motivo_ausentismo, "text"),
	GetSQLValueString($id_ausentismo, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_ausentismo&'.$id_ausentismo.'.jsp" />';
 }

?>
