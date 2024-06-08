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
	
	  $id_funcpermiso=intval($_GET['i']); 
	  
	  $query8 = sprintf("SELECT * FROM funcpermiso
                  where id_funcpermiso = '$id_funcpermiso' 
				 AND estado_funcpermiso = 1 "); 
    $select8 = mysql_query($query8, $conexion) or die(mysql_error());
    $row8 = mysql_fetch_assoc($select8);
    $totalRows8 = mysql_num_rows($select8);
    if ($totalRows8 > 0){
       $id_tipo_permiso = $row8['id_tipo_permiso'];
   } else {
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
   }

    }
} else { 
    echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 
 
if ($id_tipo_permiso > 0) { // Hasta el final
	
	$id_funcpermiso=intval($_GET['i']);
	
	
    $query4 = sprintf("SELECT au.id_funcionario, au.id_tipo_permiso, 
      fecha_inicio, hora_inicio, fecha_final, hora_final, 
      au.id_funcionario_jefe, au.id_funcionario_reempla,
      motivo_permiso, soli.nombre_funcionario funcionario_soli,
	  soli.id_cargo, soli.id_tipo_oficina, soli.id_grupo_area, 
	  soli.id_oficina_registro,
	  tipoa.nombre_tipo_permiso, jefe.nombre_funcionario funcionario_jefe,
	  reem.nombre_funcionario funcionario_reem, 
	  au.id_aprobacion_permiso, apa.nombre_aprobacion_permiso
      FROM funcpermiso au
      LEFT JOIN funcionario soli
      ON  au.id_funcionario = soli.id_funcionario
      LEFT JOIN tipo_permiso tipoa
      ON au.id_tipo_permiso = tipoa.id_tipo_permiso
      LEFT JOIN funcionario jefe
      ON  au.id_funcionario_jefe = jefe.id_funcionario
      LEFT JOIN funcionario reem
      ON  au.id_funcionario_reempla = reem.id_funcionario
      LEFT JOIN aprobacion_permiso apa
      ON   au.id_aprobacion_permiso =  apa.id_aprobacion_permiso
      WHERE au.id_funcpermiso = ".$id_funcpermiso." AND estado_funcpermiso = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
	$id_tipo_permiso = $row4['id_tipo_permiso'];
    $fecha_inicio = $row4['fecha_inicio'];
	$hora_inicio = $row4['hora_inicio'];
	$hora_final = $row4['hora_final'];
	$fecha_final = $row4['fecha_final'];
	$id_funcionario_jefe = $row4['id_funcionario_jefe'];
	$id_funcionario_reempla = $row4['id_funcionario_reempla'];
	$motivo_permiso = $row4['motivo_permiso'];
	$funcionario_soli = $row4['funcionario_soli'];
	$nombre_tipo_permiso = $row4['nombre_tipo_permiso'];
	$funcionario_jefe = $row4['funcionario_jefe'];
	$funcionario_reem = $row4['funcionario_reem'];
	$id_aprobacion_permiso = $row4['id_aprobacion_permiso'];
	$nombre_aprobacion_permiso = $row4['nombre_aprobacion_permiso'];

	$nom_tipoau      =  $row4['nombre_tipo_permiso'];
    $codifi = mb_detect_encoding($nom_tipoau, "UTF-8, ISO-8859-1");
    $nombre_tipo_permiso = iconv($codifi, 'UTF-8', $nom_tipoau);
	
	$nom_funcio  =  $row4['funcionario_soli'];
    $codifi = mb_detect_encoding($nom_funcio, "UTF-8, ISO-8859-1");
    $funcionario_soli = iconv($codifi, 'UTF-8', $nom_funcio);

	$nom_jefe  =  $row4['funcionario_jefe'];
    $codifi = mb_detect_encoding($nom_jefe, "UTF-8, ISO-8859-1");
    $funcionario_jefe = iconv($codifi, 'UTF-8', $nom_jefe);
	
	$nom_reem  =  $row4['funcionario_reem'];
    $codifi = mb_detect_encoding($nom_reem, "UTF-8, ISO-8859-1");
    $funcionario_reem = iconv($codifi, 'UTF-8', $nom_reem);

    $id_cargo8 = $row4['id_cargo'];
	$id_tipo_oficina8 = $row4['id_tipo_oficina'];
	$id_grupo_area8 = $row4['id_grupo_area'];
	$id_oficina_registro8 = $row4['id_oficina_registro'];
	
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
	 $nombre_img=$id_funcpermiso.'-'.$id_funcionario.'-'.$aleatorio.'.pdf';
	 
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
      $NomImagenR=$ubicacion."/".$nombre_img;
	 
     

      if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 11534336)) { // 3
	    if ($_FILES["file"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file']['tmp_name'],$NomImagenR);
			
//          $nombrebre_orig= ucwords($nombrefile);
//          $hash=md5($files);
            $id_tipo_docto_permiso = $_POST['id_tipo_docto_permiso']; // 0 = Evidencia 1 = Resolución

            $insertSQL = sprintf("INSERT INTO docto_permiso (id_funcpermiso, 
		    id_tipo_docto_permiso, nombre_docto_permiso, 
			descrip_docto_permiso, estado_docto_permiso, 
		    fecha_registro) 
            VALUES (%s, %s, %s, %s, 1, now())", 
            GetSQLValueString($id_funcpermiso, "int"), 
            GetSQLValueString($id_tipo_docto_permiso, "int"),
            GetSQLValueString($nombre_img, "text"),
			GetSQLValueString( $_POST["descrip_docto_permiso"], "text"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
		  
            echo $insertado;
            echo '<meta http-equiv="refresh" content="0;URL= ./consulta_permiso_funcionario&'.$id_funcpermiso.'.jsp" />';
        } else { $valido=0; echo  $doc_no_tipo;
	           echo '<meta http-equiv="refresh" content="0;URL= ./consulta_permiso_funcionario&'.$id_funcpermiso.'.jsp" />';
			} // fin 4 
      } else { $valido=0; echo $doc_tam;
	         echo '<meta http-equiv="refresh" content="0;URL= ./consulta_permiso_funcionario&'.$id_funcpermiso.'.jsp" />';
		} // fin 3
		
		
  } else { 
//      echo $doc_tam;
	  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_permiso_funcionario&'.$id_funcpermiso.'.jsp" />';
  } // fin 2

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
		</div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			    <li><a href="permiso.jsp"><p style="font-size: 18px"><b>PERMISO</b></p></a></li>
            </ul>
        </div>
		 
      </div>
    </nav>
  </div>
</div>

<?php
// *******************************
// Consulta Permiso
// *******************************		
?>

<div class="row">
    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <div class="row-md-6 text-left">
                 <h3 class="box-title"><b>CONSULTA PERMISO</b></h3> &nbsp; &nbsp; 
				 <?php if(($id_aprobacion_permiso < 6) or (1==$_SESSION['rol'])) { ?>
    		     <a id="" class="ventana1" data-toggle="modal" data-target="#mofiausen" href="" title="Modificar Permiso"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></a>
				  <?php } ?>  
             </div>
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
                       <label  class="control-label">TIPO DE PERMISO:</label>   
                       <?php echo $nombre_tipo_permiso; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">ESTADO PERMISO:</label>   
                       <?php echo $nombre_aprobacion_permiso; ?>
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
                       <label  class="control-label">MOTIVO DEL PERMISO:</label>   
                       <textarea type="text"  rows="4" cols="20" class="form-control" id="motivo_permiso"  name="motivo_permiso"  readonly="readonly" ><?php echo $motivo_permiso; ?></textarea> 
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
					       <?php 
						   $totre = 0;
						   $query52 = sprintf("SELECT COUNT(id_funcpermiso) AS totre
	                       FROM docto_permiso
                           WHERE id_funcpermiso = '$id_funcpermiso'  
                           AND id_tipo_docto_permiso = 1
				           AND estado_docto_permiso = 1 ");
				           $select52 = mysql_query($query52, $conexion) or die(mysql_error());
						   while ($row52 = mysql_fetch_assoc($select52)) {	
						        $totre = $row52['totre'];
						    }

						if(($totre < 1) or (1==$_SESSION['rol'])) { ?>
            		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#carguedocau"><span class="glyphicon glyphicon-plus-sign"></span> Documento Permiso</a>
					       <?php } else { echo 'Documentos del Permiso ';}?>
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
               $query62 = sprintf("SELECT id_docto_permiso, 
			    nombre_docto_permiso, descrip_docto_permiso,
			    fecha_registro
	            FROM docto_permiso
                WHERE id_funcpermiso = '$id_funcpermiso'  
				AND estado_docto_permiso = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	  
            ?>
          <tr>
             <td><?php echo $row62['id_docto_permiso'];?></td>
             <td><?php echo $row62['nombre_docto_permiso'];?></td>
			 <td><?php echo $row62['descrip_docto_permiso'];?></td>
             <td><?php echo $row62['fecha_registro'];?></td>

		     <?php if('' != $row62['nombre_docto_permiso']){ ?> 
		     <td> 
			    <a href="filesnr/ausentismosnr/<?php echo $row62['nombre_docto_permiso']; ?>" target = '_blank' >
		       <img src="images/pdf.png"></a>
			   <?php if(0==$id_aprobacion_permiso) { ?>
				<a style="color:#ff0000;cursor: pointer" title="Borrar" name="docto_permiso" id="<?php echo $row62['id_docto_permiso']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
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
// Consulta detalle de permiso
// *************************************
?>		
			<div class="col-md-6">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'DETALLE PERMISO'; ?>
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
               $query62 = sprintf("SELECT id_detalle_permiso, 
			    fecha_secuencia, hora_inicio, hora_final,
			    num_dias, num_horas
	            FROM detalle_permiso
                WHERE id_funcpermiso = '$id_funcpermiso'  
				AND estado_detalle_permiso = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
            ?>
          <tr>
      
             <td><?php echo $row62['id_detalle_permiso'];?></td>
             <td><?php echo $row62['fecha_secuencia'];?></td>
             <td><?php echo $row62['hora_inicio'];?></td>
             <td><?php echo $row62['hora_final'];?></td>
             <td><?php echo $row62['num_horas'];?></td>

		     <?php if(0==$id_aprobacion_permiso) { ?>
		     <td> 
				<a style="color:#ff0000;cursor: pointer" title="Borrar" name="detalle_permiso" id="<?php echo $row62['id_detalle_permiso']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
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
// *************************************
// MODIFICACION PERMISO
// **************************************
?>
		
<div class="modal fade" id="mofiausen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>ACTUALIZACI&Oacute;N PERMISO</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="post" name="form43257777435224">

    <input type="hidden" class="form-control" name="id_funcpermiso" id="id_funcpermiso" readonly="readonly" value="<?php echo $id_funcpermiso; ?>">

    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO:</label>   
      <input type="text" class="form-control" name="funcionario_soli" readonly="readonly" value="<?php echo $funcionario_soli; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO JEFE:</label>   
      <input type="text" class="form-control" name="funcionario_jefe" readonly="readonly" value="<?php echo $funcionario_jefe; ?>">
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO QUE LO REEMPLAZA: </label>  
        <select class="form-control" name="id_funcionario_reempla" id="id_funcionario_reempla">
        <option value="<?php echo $id_funcionario_reempla; ?>" selected><?php echo $funcionario_reem; ?></option>
		<?php if ($id_tipo_oficina8 == 1) {  echo nivelc($id_funcionario8, $id_grupo_area8);  } ?>
        <?php if ($id_tipo_oficina8 == 2) {  echo ofireg($id_funcionario8, $id_oficina_registro8);  } ?>
        </select>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">TIPO DE PERMISO:</label>   
      <input type="text" class="form-control" name="nombre_tipo_permiso"  readonly="readonly" value="<?php echo $nombre_tipo_permiso; ?>">
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
        <label  class="control-label">MOTIVO DEL PERMISO:</label>   
        <textarea type="text"  rows="4" cols="40" class="form-control" id="motivo_permiso"  name="motivo_permiso"><?php echo $motivo_permiso; ?></textarea> 
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






<?php 
}

// mysql_free_result($update);

?>
<?php

// ********************************
// Carge Doctos Permiso
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
        <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Permiso:</label>   
        <input type="text" required class="form-control" id="nombre_tipo_permiso"  name="nombre_tipo_permiso" readonly="readonly" value="<?php echo $nombre_tipo_permiso; ?>" required >
    </div>
	
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Documento:</label>   
        <select class="form-control" name="id_tipo_docto_permiso">
             <option value="" selected></option>
             <option value= 0 >Evidencia</option>
             <option value= 1 >Resolución</option>
        </select>
    </div>
	
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Descripción Documento:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="descrip_docto_permiso"  name="descrip_docto_permiso"  value=""></textarea>
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




// *****************************************
// Registro Modificacion Permiso
// *****************************************

if (isset($_POST['modiausen'])){

	$id_funcpermiso = $_POST['id_funcpermiso'];
	$id_funcionario_reempla = $_POST['id_funcionario_reempla'];
    $motivo_permiso = $_POST['motivo_permiso'];


    $updateSQL37 = sprintf("UPDATE funcpermiso 
	        SET id_funcionario_reempla = %s, 
	        motivo_permiso = %s
			WHERE id_funcpermiso = %s",                  
	GetSQLValueString($id_funcionario_reempla, "int"),
	GetSQLValueString($motivo_permiso, "text"),
	GetSQLValueString($id_funcpermiso, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_permiso_funcionario&'.$id_funcpermiso.'.jsp" />';
 }

?>
