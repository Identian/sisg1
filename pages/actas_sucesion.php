
<?php
if (isset($_GET['i'])) {
	$id_sucesion=$_GET['i'];
	
    $query4 = sprintf("SELECT * FROM sucesion 
    WHERE id_sucesion='$id_sucesion' limit 1"); 
    $select4 = mysql_query($query4, $conexion) or die(mysql_error());
    $row4 = mysql_fetch_assoc($select4);
    $totalRows4 = mysql_num_rows($select4);
	
    if ($totalRows4 > 0) { // sino existe se sale
	
       $fecha_inicio = $row4['fecha_inicio'];
	   $numero_acta = $row4['numero_acta'];
	   $fecha_acta = $row4['fecha_acta'];
	   $fecha_reg_creacion = $row4['fecha_reg_creacion'];
	   $cc_funcionario_reg = $row4['cc_funcionario_reg'];
	   $num_causantes = $row4['num_causantes'];
	   $id_estado_sucesion = $row4['id_estado_sucesion'];
	   $des_estado_sucesion = 'ABIERTA';
       if ($id_estado_sucesion == 2){
		   $des_estado_sucesion = 'TERMINADA';
	   }

} else {
	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';
}


?>


<div class="row">
    <div class="col-md-12">
		<div class="row">
          <div class="box  box-info">
             <div class="box-header with-border">
 
			 <div class="row-md-6 text-left">
             <h3 class="box-title">SUCESI&Oacute;N - CARGUE DE ACTAS</h3> &nbsp; &nbsp; 
             </div>

			 <div class="row-md-6 text-right">
			 </div>
			 <!-- Modal -->


          <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group text-left"> 
                       <label  class="control-label">FECHA DE INICIO:</label>   
                       <?php echo $fecha_inicio ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">N&Uacute;MERO ACTA:</label>   
                        <?php echo $numero_acta; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA ACTA:</label>   
                        <?php echo $fecha_acta; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">ESTADO SUCESI&Oacute;N:</label>   
                        <span style= 'color: red;'><?php echo $des_estado_sucesion; ?></span>
                  </div>
				</div>  
                <div class="col-md-6">
				<form action="" method="POST" name="form47" enctype="multipart/form-data">
                     <div class="form-group text-left"> 
                         <label  class="control-label"><span style="color:#ff0000;">*</span> ADJUNTAR ACTAS DE SUCESI&Oacute;N:</label> 
                         <input type="file" value=""  name="file" required>
                         <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
                     </div>

                     <div class="form-group text-left"> 
					     <label  class="control-label">TIPO DE ACTA:</label> 
                         <select id="id_tipo_docto_sucesion" name="id_tipo_docto_sucesion" required >
						 <option value="" selected></option>
                         <option value="1">Inicio Sucesi&oacute;n</option>
                         <option value="2">Terminaci&oacute;n Sucesi&oacute;n</option>
                         </select>
                     </div>
                     <div class="form-group text-left">
					     <button type="submit" class="btn btn-success">
                         <input type="hidden" name="insertacta" value="cargueacta"><span class="glyphicon glyphicon-ok"></span> Agregar </button>
                     </div>
				</form>
                </div>

                </div>
                </div>
            </div>
          </div>
	    </div>
			
		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4><b>ACTAS DE SUCESI&Oacute;N </b></h4> 
                       <div class="text-right"> 
                      <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
               </div>
  
               <div class="box-body">
               <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
                <thead>
                <tr>
                  <th>ID Sucesi&oacute;n</th>
                  <th>Num Acta</th>
                  <th>Fecha Acta</th>
                  <th>Tipo de Acta</th>
                  <th>Archivo</th>
                 <th>Accion</th>
                </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT id_tipo_docto_sucesion,
			    nombre_docto_sucesion, numero_acta, fecha_acta
	            FROM docto_sucesion, sucesion 
                WHERE docto_sucesion.id_sucesion = sucesion.id_sucesion 
				AND docto_sucesion.id_sucesion = '$id_sucesion'
	            AND estado_docto_sucesion = 1"); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
                $id_tipo_docto_sucesion = $row62['id_tipo_docto_sucesion'];
				$tipo_docto = 'ACTA INICIO';
                if($id_tipo_docto_sucesion == 2){
                   $tipo_docto = 'ACTA TERMINACI&Oacute;N';
                }				
            ?>
          <tr>
             <td><?php echo $id_sucesion;?></td>
             <td><?php echo $row62['numero_acta'];?></td>
             <td><?php echo $row62['fecha_acta'];?></td>
             <td><?php echo $tipo_docto;?></td>
             <td><?php echo $row62['nombre_docto_sucesion'];?></td>

		     <?php if('' != $row62['nombre_docto_sucesion']){?> 
		     <td> 
			    <a href="filesnr/sucesionessnr/<?php echo $row62['nombre_docto_sucesion']; ?>.pdf" class="btn btn-mn btn-success" target = '_blank' style="width:100%;">
		        <span class="rounded float-left"></span><img src="images/pdf.png"></a>
	         </td>
		     <?php } else { echo ""; } ?>
          </tr>
		  <?php } ?>
		  
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
// *******************
// cargue de archivos
// *******************

if ((isset($_POST["insertacta"])) && ($_POST["insertacta"] == "cargueacta")) { // 1

  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');

 if (""!=$_FILES['file']['tmp_name']){ // 2
 
    $tipoArchivo=explode("/",$_FILES["file"]["type"]);
    $ubicacion="filesnr/sucesionessnr/";
	$NomImagen=$_FILES['file']['name'];
	$totarchivo=explode(".",$_FILES["file"]["name"]);
	echo $totarchivo[0];
	
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
     $NomImagenR=$ubicacion."/".$totarchivo[0].'.'.$tipoArchivo[1];
	 
    $nombre_img=$totarchivo[0];

    if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 500000)) { // 3
	if ($_FILES["file"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file']['tmp_name'],$NomImagenR);
			
//         $nombrebre_orig= ucwords($nombrefile);
//         $hash=md5($files);

          $insertSQL = sprintf("INSERT INTO docto_sucesion (id_sucesion, 
		  id_tipo_docto_sucesion, nombre_docto_sucesion, estado_docto_sucesion, 
		  fecha_registro) 
          VALUES (%s, %s, %s, 1, now())", 
          GetSQLValueString($id_sucesion, "int"), 
          GetSQLValueString($_POST['id_tipo_docto_sucesion'], "int"),
          GetSQLValueString($nombre_img, "text"));
      
	      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
          echo $insertado;
          echo '<meta http-equiv="refresh" content="0;URL= ./actas_sucesion&'.$id_sucesion.'.jsp" />';
       } else { $valido=0; echo  $doc_no_tipo;
			} // fin 4 
    } else { $valido=0; echo $doc_tam;
		} // fin 3
  } else { 
      echo $doc_tam;
	  echo '<meta http-equiv="refresh" content="0;URL= ./actas_sucesion&'.$id_sucesion.'.jsp" />';

  } // fin 2

} else { 

} // fin 1

	
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }
	

?>


