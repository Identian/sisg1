<?php
if (isset($_SESSION['snr'])) {
	$id=$_SESSION['snr'];
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }



if ((isset($_POST["subirfoto"])) && ($_POST["subirfoto"] != "")) { 



$tamano_archivo=524288;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('jpg', 'png');


$directoryftp="files/";


$ruta_archivo = 'fotoperfil-'.$id.'-'.date("YmdGis");


 if (""!=$_FILES['file']['tmp_name']){
	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
  

//$seguridad=md5($files.$id_ciudadano);
  

$updateSQL = sprintf("UPDATE funcionario SET foto_funcionario=%s where id_funcionario=%s",
GetSQLValueString($files, "text"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());


echo $actualizado;

  
  
  } else { 
  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';

		}
	
	


} else {
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';


	}

} else { }






















if ((isset($_POST["table"])) && ($_POST["table"] == "soporte_funcionario")) { 


$tamano_archivo=4194304;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="files/";


$ruta_archivo = 'documentopersonal-'.$id.'-'.date("YmdGis");


 if (""!=$_FILES['file']['tmp_name']){
	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $files2 = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files2);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  


$seguridad=md5($files2.$id_ciudadano);


$insertSQL = sprintf("INSERT INTO soporte_funcionario (nombre_soporte_funcionario, id_categoria_soporte, id_tipo_soporte, id_funcionario, url_soporte, hash_soporte, fecha_soporte, estado_soporte_funcionario) VALUES (%s, %s, %s, %s, %s, %s, now(), %s)", 
GetSQLValueString($_POST["nombre_soporte_funcionario"], "text"), 
GetSQLValueString($_POST["id_categoria_soporte"], "int"), 
GetSQLValueString($_POST["id_tipo_soporte"], "int"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($files2, "text"), 
GetSQLValueString($seguridad, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
  
  } else { 
  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';

		}
	
	


} else {
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';


	}

} else { }





$query = sprintf("SELECT * FROM funcionario where id_funcionario='$id' limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($select);



?>	




	<div class="row">
	<!--
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
              <h3>0</h3>

              <p>PQRS ABIERTAS</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
		  </div>
		  

 <div class="col-lg-3 col-xs-6">
         
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>0</h3>

              <p>PQRS CERRADAS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
       
    
        <div class="col-lg-3 col-xs-6">
      
          <div class="small-box bg-green">
            <div class="inner">
              <h3>0<sup style="font-size: 20px"></sup></h3>

              <p>NOTIFICACIONES</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
 
       
		 <div class="col-lg-3 col-xs-6">
      
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>0</h3>

              <p>REUNIONES</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
-->
      </div>
	
	
	<div class="modal fade" id="popupnewdocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Soportes Documentales: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="formasdf3245fhgdh345122" enctype="multipart/form-data">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Categoria:</label> 
<select  class="form-control mayuscula" name="id_categoria_soporte"  id="id_categoria_soporte" required>
<option value="" selected></option>
<?php echo lista('categoria_soporte');  ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Documento:</label> 
<select  class="form-control mayuscula" name="id_tipo_soporte"  id="id_tipo_soporte" required>

</select>
</div>
<div class="form-group text-left">
<input type="file" name="file" required>
<span style="color:#aaa;font-size:13px;">Documento PDF inferior a 2Mb</span>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Observaciones:</label> 
<textarea class="form-control" name="nombre_soporte_funcionario" style="height:120px;" ></textarea>
</div>


<input type="hidden" name="table" value="soporte_funcionario">

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
<input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
</div>
</form>
</div>
</div> 
</div> 
</div> 


	
	<div class="row">
<div class="col-md-8">
	<div class="box">





<div class="box-header with-border">
                  <h3 class="box-title">Perfil</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
			
			  
			  
			<div  class="modal-body">
			<div class="form-group text-left"> 
<label  class="control-label">CEDULA DE FUNCIONARIO:</label>   
<?php echo $row_update['cedula_funcionario']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NOMBRE DE FUNCIONARIO:</label>   
<?php echo $row_update['nombre_funcionario']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CORREO DE FUNCIONARIO:</label>   
<?php echo $row_update['correo_funcionario']; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Usuario de acceso:</label>  
 
<?php 
echo $row_update['alias_iduca']; 
?>

</div>
<div class="form-group text-left"> 
<label  class="control-label">ROL:</label>   
<?php echo quees('rol', $row_update['id_rol']); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">TIPO DE OFICINA:</label>   
<?php echo quees('tipo_oficina', $row_update['id_tipo_oficina']); ?>
</div>
<div class="form-group text-left"> 


<?php if (1==$row_update['id_tipo_oficina']) {

echo '<label  class="control-label">GRUPO:</label>';
 echo quees('grupo_area', $row_update['id_grupo_area']); 
} else if (2==$row_update['id_tipo_oficina']) {
	echo '<label  class="control-label">Oficina:</label> ';	
	echo quees('oficina_registro', $row_update['id_oficina_registro']); 
} else {}


if (1==$_SESSION['snr_tipo_oficina']){
$id_grupo=$row_update['id_grupo_area'];
$actualizar6 = mysql_query("SELECT nombre_area FROM area, grupo_area WHERE area.id_area=grupo_area.id_area and grupo_area.id_grupo_area='$id_grupo' limit 1", $conexion) or die(mysql_error());
$row16 = mysql_fetch_assoc($actualizar6);
echo ' / '.$row16['nombre_area'];
	
} else {
	echo '';
	
}

?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CARGO:</label>   
<?php echo quees('cargo', $row_update['id_cargo']); ?>
</div>


<?php if (1==$row_update['id_cargo'] && 1==$_SESSION['snr_tipo_oficina']){	?>
<div class="form-group text-left"> 
<label  class="control-label">Código APP:</label>   
<?php echo $row_update['codigo_app']; ?>
</div>
<?php } ?>



    </div>      
              </div>
			  

			

        
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
		
		
		<div class="col-md-4">


		  <div class="box box-warning direct-chat direct-chat-warning" >
                <div class="box-header with-border">
                  <h3 class="box-title">Foto</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
				<div class="direct-chat-messages" style="min-height:320px;">
				<center>
<img src="files/<?php echo $row_update['foto_funcionario']; ?>" style="width:150px;">
</center>
<br><form action="" method="POST" name="formsfg1ftregg" enctype="multipart/form-data">
<div class="form-group text-left">
<input type="file" name="file" required>
<input type="hidden" name="subirfoto" value="1">
<span style="color:#aaa;font-size:13px;">Imagenes jpg ó png inferiores a 500 Kb</span>
<br><center>
<button type="submit" class="btn btn-xs btn-warning">
<span class="glyphicon glyphicon-user"></span> &nbsp; Subir &nbsp; </button>
</center>
</div>
</form>

				</div>
			</div>	
	</div>
	
	
	
	
	
	
	
	                  <div class="box">
						 
						    <div class="box-header with-border">
                  <h3 class="box-title">Soportes documentales</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
			
<a class="ventana1" data-toggle="modal" data-target="#popupnewdocumento" href="" title="Añadir"> <button type="button" class="btn btn-xs btn-success">
<span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>
			
<?php
$select = mysql_query("select * from soporte_funcionario, categoria_soporte, tipo_soporte where categoria_soporte.id_categoria_soporte=tipo_soporte.id_categoria_soporte and soporte_funcionario.id_tipo_soporte=tipo_soporte.id_tipo_soporte and soporte_funcionario.id_categoria_soporte=categoria_soporte.id_categoria_soporte and id_funcionario=".$id." and estado_soporte_funcionario=1 order by categoria_soporte.id_categoria_soporte,tipo_soporte.id_tipo_soporte", $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	 echo '<hr>';
	
	echo ''.$row['nombre_categoria_soporte'].' / ';
	echo ''.$row['nombre_tipo_soporte'].'';
	echo ' <a href="files/'.$row['url_soporte'].'" target="_blank"><img src="images/pdf.png"></a>';
	echo '<br><span style="color:#999;">'.$row['fecha_soporte'].'</span>';
	if (isset($row['nombre_soporte_funcionario']) && ""!=$row['nombre_soporte_funcionario']) {
echo '<br>"'.$row['nombre_soporte_funcionario'].'"';
	} else {}


 } while ($row = mysql_fetch_assoc($select)); 
} else { } 
mysql_free_result($select);




?>
<br>
<br>
</div>
</div>


</div>

	</div>
	
	