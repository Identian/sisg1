<?php
if (isset($_GET['i'])) {
	$id=intval($_GET['i']);
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }



if (isset($_POST["asignarnuevociudadano"]) and ""!=$_POST["asignarnuevociudadano"]) {
$ideciu=$_POST["asignarnuevociudadano"];
  $updateSQL7 = sprintf("UPDATE radi_cert SET identificacion=%s where id_radi_cert=%s and estado_radi_cert=1",
                    GetSQLValueString($ideciu, "text"),                     
					 GetSQLValueString($id, "int"));
  $Result17 = mysql_query($updateSQL7, $conexion) or die(mysql_error());
echo $insertado;	
}


if (2>=$_SESSION['snr_tipo_oficina']) {


global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}


	
$query48 = sprintf("SELECT * from radi_cert where id_radi_cert=".$id.""); 
$selectls8 = mysql_query($query48, $conexion) or die(mysql_error());
$row4 = mysql_fetch_assoc($selectls8);
$totalRowsls8 = mysql_num_rows($selectls8);
if (0<$totalRowsls8) {
	

$radicado = $row4['radi_cert'];
$fecha_radicado = $row4['fecha_radi_cert'];
$nombre_pqrs  = $row4['nombre_radi_cert'];
$identificacionc  = $row4['identificacion'];
$trasladada_sisg  = $row4['trasladada_sisg'];




if (isset($_POST["PQRS_sin_ciudadano"]) and "Informar"==$_POST["PQRS_sin_ciudadano"]) {

$urlciu="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$inform='La PQRS: '.$urlciu.' no tiene ciudadano asignado';
	
$insertSQL = sprintf("INSERT INTO soporte (id_funcionario, fecha_soporte, nombre_soporte, estado_soporte) VALUES (%s, now(), %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"),
GetSQLValueString($inform, "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo $insertado;


	
}





if (isset($_POST["cerrar_pqrs_sin_iris"]) and $radicado=$_POST["cerrar_pqrs_sin_iris"]) {



 $insertSQL33 = sprintf("INSERT INTO pqrs_iris_cert (idcorrespondencia, codigo_iris, referencia_iris, nombre_pqrs_iris_cert, fecha_pqrs_iris_cert, estado_pqrs_iris_cert, salida_iris, cerro_usuario) VALUES (%s, %s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString('111111', "int"),
GetSQLValueString($radicado, "int"),
GetSQLValueString($radicado, "int"),
GetSQLValueString('PQRS cerrada', "text"),
GetSQLValueString(1, "int"),
GetSQLValueString($radicado, "int"),
GetSQLValueString($_SESSION['snr'], "int"));
$Result33 = mysql_query($insertSQL33, $conexion) or die(mysql_error());



$updateSQL75 = sprintf("UPDATE radi_cert SET iris_salida=%s where id_radi_cert=%s and estado_radi_cert=1",
                    GetSQLValueString($radicado, "int"),                     
					 GetSQLValueString($id, "int"));
$Result175 = mysql_query($updateSQL75, $conexion) or die(mysql_error());
  




$tamano_archivo=5242880;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="files/";


$ruta_archivo = $id.'-'.date("YmdGis");



	 
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
  
  



$insertSQL5 = sprintf("INSERT INTO doc_cert (nombre_doc_cert, fecha_doc_cert, expediente, radi_cert, estado_doc_cert) VALUES (%s, now(), %s, %s, %s)", 
GetSQLValueString($files, "text"), 
GetSQLValueString($radicado, "int"), 
GetSQLValueString($radicado, "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL5, $conexion) or die(mysql_error());

  
  } else { 
  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';

		}
	
	




echo $insertado;


	
}






if (isset($_POST["gestion_oac"]) and ""!=$_POST["gestion_oac"]) {

$radi_g=$_POST["gestion_oac"];

$updateSQL75 = sprintf("UPDATE radi_cert SET gestion_oac=%s where id_radi_cert=%s and estado_radi_cert=1",
                    GetSQLValueString($radi_g, "text"),                     
					 GetSQLValueString($id, "int"));
$Result175 = mysql_query($updateSQL75, $conexion) or die(mysql_error());
  echo $insertado;
}
  


?>


 	<div class="row">
<div class="col-md-12">
<h4>PQRS GESTIONADA POR CERTICAMARA</h4>
</div>
</div>



	
	
	<div class="row">
<div class="col-md-9">
	<div class="box box-info">


 <div class="box-header with-border">
                  <h3 class="box-title">Radicado del anterior sistema: <b style="font-size:20px;"><?php echo $radicado; ?></b>
				 
<?php
$actualizar5a = mysql_query("SELECT * FROM pqrs_iris_cert where referencia_iris=".$radicado." and estado_pqrs_iris_cert=1 limit 1", $conexion) or die(mysql_error());
$row4a = mysql_fetch_assoc($actualizar5a);
$total55a = mysql_num_rows($actualizar5a);
if (0<$total55a) {

	$radicadoiris=$row4a['codigo_iris'];
	echo '<br>Radicado SNR: <b style="font-size:20px;">'.$radicadoiris.'</b>';
} else { 
$radicadoiris=0;

}

 mysql_free_result($actualizar5a);
?>
				  
				  </h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">

			<div  class="modal-body">
			
	<div class="row" >
	 <div class="col-md-6">	
<br>	 
<?php	
echo '<b>Canal de entrada:</b> ';
echo 'Importado<br>';

echo '<b>Fecha de radicado:</b> ';
echo $fecha_radicado.'<br>';
echo '<b>Radicado:</b> ';
echo ''.$radicado.'<br>';


if (0===$radicadoiris){ } else {
echo '<b>Radicado IRIS:</b> ';
echo ''.$radicadoiris.'<br>';
}

echo '<b>Estado:</b> ';


if (0===$radicadoiris){ 

if ('0'==$trasladada_sisg){ 
echo 'No ha sido trasladada';
} else { 
echo 'Trasladada a SISG mediante: '.$trasladada_sisg;
}

} else {
echo 'Gestionada con IRIS. ';
}
?>
</div>
<div class="col-md-6">	
			
			<?php
$actualizar5 = mysql_query("SELECT * FROM ciudadano where identificacion='$identificacionc' and cfuncionario=0 limit 1", $conexion) or die(mysql_error());
$row4 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {

$nombre = $row4['nombre_ciudadano'];
$identificacion = $row4['identificacion'];
$correo_ciudadano = $row4['correo_ciudadano'];
$direccion_ciudadano = $row4['direccion_ciudadano'];
$erespuesta=$row4['id_tipo_respuesta'];
$id_ciudadano=$row4['id_ciudadano'];
$dep=$row4['id_departamento'];
$mun=$row4['id_municipio'];
$tipod=$row4['id_tipo_documento'];
$telefono=$row4['telefono_ciudadano'];

 
 if (isset($row4['id_etnia']) && ""!=$row4['id_etnia']) {
$etnia=$row4['id_etnia'];
} else {
$etnia=6;	
}

echo '<div style="text-align:right;"><a href="ciudadano&'.$id_ciudadano.'.jsp" title="Actualizar datos del Ciudadano"><i class="glyphicon glyphicon-pencil"></i></a></div>';

echo '<b>Nombre:</b> '.$nombre.'<br>';
echo '<b>Tipo de documento:</b> ';
echo ''.quees('tipo_documento', $tipod).'<br>';
echo '<b>Identificación:</b> '.$identificacion.'<br>';
echo '<b>Etnia:</b> ';
echo ''.quees('etnia', $etnia).'<br>';
echo '<b>E-mail:</b> '.$correo_ciudadano.'<br>';
echo '<b>Telefono:</b> '.$telefono.'<br>';
echo '<b>Dirección:</b> '.$direccion_ciudadano.'<br>';
echo '<b>Emisi&oacute;n de respuesta:</b> ';
echo ''.quees('tipo_respuesta', $erespuesta).'<br>';
echo '<b>Departamento:</b> ';
echo ''.quees('departamento', $dep).'<br>';
echo '<b>Municipio:</b> ';
echo ''.quees('municipio', $mun).'<br>';


  } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
 mysql_free_result($actualizar5);

} else {
	?>
	<br>
	La PQRS no tiene vinculado un ciudadano, por favor buscar y asociar por número de identificación.
<br>
	
<?php if (1==$_SESSION['rol'] or 24==$_SESSION['snr_grupo_area'] or 40==$_SESSION['snr_grupo_area']) { ?>
	
	<label  class="control-label"><span style="color:#ff0000;">*</span> BUSCAR CIUDADANO:</label> 
 <input class="numero" id="consultaciudadano" value="" style="width:250px;" placeholder="Cedula" required>
<button id="botonconsultaciudadano22" type="button" class="btn btn-xs btn-warning" >
<span class="glyphicon glyphicon-search"></span></button>
<form action="" method="POST" name="forasdm34544354351FGDG">
<div id="resultadoconsultaciudadano">
</div>
</form>
<hr>
<?php } else {
	
	echo 'Se debe reportar a la oficina de atención al ciudadano por correo electrónico.';
	
} ?>
	


<?php
}
?>
		
			
	</div>
</div>		










<div class="row" >
	 <div class="col-md-12">
<br><b>Asunto</b> <?php echo $nombre_pqrs; ?>
<br>
<br>

<b>Trazabilidad:</b><br>
<?php
$actualizar579 = mysql_query("SELECT * FROM eventos_cert WHERE radi_cert=".$radicado." and estado_eventos_cert=1", $conexion) or die(mysql_error());
$row1579 = mysql_fetch_assoc($actualizar579);
$total5579 = mysql_num_rows($actualizar579);
if (0<$total5579) {
 do { 
 
 echo $row1579['nombre_ciu'].' - '.$row1579['estado'].' - '.$row1579['tarea'].' - '.$row1579['fecha_eventos_cert'].'<br>';
 
 

 } while ($row1579 = mysql_fetch_assoc($actualizar579)); 
  mysql_free_result($actualizar579);
} else {}
?>



<br><br><b>Documentos adjuntos</b><br>
<?php
$actualizar57 = mysql_query("SELECT * FROM doc_cert WHERE radi_cert=".$radicado." and estado_doc_cert=1", $conexion) or die(mysql_error());
$row157 = mysql_fetch_assoc($actualizar57);
$total557 = mysql_num_rows($actualizar57);
if (0<$total557) {
	
 do { 
 

 echo ' <a href="files/'.$row157['nombre_doc_cert'].'" target="_blank"><img src="images/pdf.png">  ';
 
 if ('2018-06-13'>$row157['fecha_doc_cert']) {
 echo 'Anexo';
 } else {  echo 'Cerrada';  } 
 
 echo ' </a> Subido: '.$row157['fecha_doc_cert'].' ';   

 if ('2018-06-13'>$row157['fecha_doc_cert']) {
 echo '/ Expediente: '.$row157['expediente'].'';
 } else {  echo '';  }
 
 echo '<br>';
    
 } while ($row157 = mysql_fetch_assoc($actualizar57)); 
  mysql_free_result($actualizar57);
} else {}

?>

	




		
		
		
		</div>  
    </div>      
          
<hr>

<?php
$actualizar5a8 = mysql_query("SELECT * FROM pqrs_iris_cert where (referencia_iris='$radicadoiris' or referencia_iris='$radicado') and estado_pqrs_iris_cert=1 limit 1", $conexion) or die(mysql_error());
$row4a8 = mysql_fetch_assoc($actualizar5a8);
$total55a8 = mysql_num_rows($actualizar5a8);
if (0<$total55a8) {

	$radicadoirissalida=$row4a8['codigo_iris'];
	echo '<br>Radicado de salida: &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; <b style="font-size:20px;">'.$radicadoirissalida.'</b><br><br>';
	echo '<div class="col-md-12" style="background:#f1f1f1;padding: 15px 15px 15px 15px;">';
	echo '<br>Respuesta al radicado: '.$radicadoiris.'';
	echo '<br>Fecha de respuesta: '.$row4a8['fecha_pqrs_iris_cert'].'<br>';
	echo 'Descripción: '.$row4a8['nombre_pqrs_iris_cert'].'<br>';
	
	if (isset($row4a8['cerro_usuario']) && ""!=$row4a8['cerro_usuario']) {
		echo 'Cerro PQRS: ';
		echo quees('funcionario', $row4a8['cerro_usuario']);
	} else {}
	
	
	echo '<br><br></div><br><br><br><br><br><br><br><br><br><br><br>';
} else { 






?>
<div class="row botonrespuesta" >
<div class="col-md-12 text-center">  

<?php 
if ('0'==$trasladada_sisg){ 
?>

<?php if (isset($id_ciudadano) && ""!=$id_ciudadano) {


	?>

<div class="row">

<div class="col-md-6 text-center" > 
<br><br><br>
	<!--<a href="https://sisg.supernotariado.gov.co/nueva_pqrs&<?php //echo $id_ciudadano; ?>&<?php //echo $id; ?>.jsp" class="btn btn-lg btn-warning" style="width:100%;"	>
	<span class="glyphicon glyphicon-warning-sign"></span>  TRASLADAR A SISG. </a>-->
	<br><br></div>
	
	<div class="col-md-6 text-center" style="border:1px solid#ccc;"> 
	
	
	 <form action="" method="POST" name="formterg561" enctype="multipart/form-data">
	
<input type="hidden"  name="cerrar_pqrs_sin_iris" value="<?php echo $radicado; ?>">
Adjuntar documento: <span style="color:#B40404;">(PDF inferior a 4 Mg.)</span>
<input type="file"  name="file" value="">
<br>
<button type="submit" class="cerrar_pqrs_cert btn btn-lg btn-success" style="width:100%;">
<span class="glyphicon glyphicon-ok"></span> 	CERRAR PQRS SIN IRIS. </button>


	</form>
	<br>
	</div>
	
	
	</div>
	
	
<?php 	} else { ?>
		
		
		<a href="" class="btn btn-lg btn-danger" style="width:80%;"	>
	<span class="glyphicon glyphicon-warning-sign"></span>  HACE FALTA EL CIUDADANO, INFORMAR A OAC </a>
	
	
		<?php }	?>


<?php
} else { 
echo '	
	<h2> Trasladada a SISG mediante:  '.$trasladada_sisg.' </h2>Revisar número de Iris en la parte superior derecha';
}
?>



	
	
	
	</div>
</div>
<?php







}
mysql_free_result($actualizar5a8);
?>








<br>
<br>
<div>
</div>		  
 </div>  			  

			
			
              <!-- /.table-responsive -->
            </div>
        
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
		
		
		<div class="col-md-3">



		
		
		


		  
		  
		  
		  
<!--
		  
<div class="box box-warning direct-chat direct-chat-warning" >
    <div class="box-header with-border">
                  <h3 class="box-title">

				  
 DIRECCIONAMIENTO


				  </h3>
                  <div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">



		</div>
	</div>	
</div>  
		  
		  
		  

		  <div class="box box-primary direct-chat direct-chat-danger" >
    <div class="box-header with-border">
            <h3 class="box-title">

 ASIGNACIONES PQRSD 
				  

			</h3>
		<div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">
				
			

		</div>
	</div>	
</div>
-->


		  
		  
		  <div class="box box-success direct-chat direct-chat-warning" >
                <div class="box-header with-border">
                  <h3 class="box-title">Otras PQRS del mismo Ciudadano</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
				<div  class="modal-body" style="max-height:450px;">
		

			<?php
			
		if (isset($id_ciudadano) && ""!=$id_ciudadano) {
			$id_ciudadano=$id_ciudadano;
		} else {
			$id_ciudadano='0000';
		}

		
		
$actualizar57llm = mysql_query("SELECT * FROM solicitud_pqrs, ciudadano where ciudadano.id_ciudadano=".$id_ciudadano."  and solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and estado_solicitud_pqrs=1 order by id_solicitud_pqrs desc", $conexion) or die(mysql_error());
$row9 = mysql_fetch_assoc($actualizar57llm);
$total557llm = mysql_num_rows($actualizar57llm);
if (0<$total557llm) {
 do { 
 
	echo '<a href="solicitud_pqrs&'.$row9['id_solicitud_pqrs'].'.jsp">'.$row9['radicado'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row9['fecha_radicado'].'</span><br>';
			echo $row9['nombre_solicitud_pqrs'].'<hr>';
 
 } while ($row9 = mysql_fetch_assoc($actualizar57llm)); 
  mysql_free_result($actualizar57llm);
} else {}



?>
		


		
		
		<?php
	
			if (isset($identificacion) && ""!=$identificacion) {
			$identificacion=$identificacion;
		} else {
			$identificacion='0000';
		}
		
$actualizar57ll = mysql_query("SELECT * FROM radi_cert where identificacion='$identificacion' and estado_radi_cert=1", $conexion) or die(mysql_error());
$row157ll = mysql_fetch_assoc($actualizar57ll);
$total557ll = mysql_num_rows($actualizar57ll);
if (0<$total557ll) {
 do { 
 
		echo '<a href="https://sisg.supernotariado.gov.co/radicado_anterior&'.$row157ll['id_radi_cert'].'.jsp">Certicamara '.$row157ll['radi_cert'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row157ll['fecha_radi_cert'].'</span><br>';
			echo $row157ll['nombre_radi_cert'].'<hr>';
 
 } while ($row157ll = mysql_fetch_assoc($actualizar57ll)); 
  mysql_free_result($actualizar57ll);
} else {}
?>




		

		
			
			</div>
			</div>	
	</div>
	
	
	
	
		  <div class="box box-primary direct-chat direct-chat-danger" >
    <div class="box-header with-border">
            <h3 class="box-title">
		Gestión Interna
			</h3>
		<div class="box-tools pull-right">       
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button></div>
                </div>
 <div class="box-body" >
<div  class="modal-body" style="max-height:250px;">
				
		
<?php
$actualizar57llm = mysql_query("SELECT gestion_oac FROM radi_cert where id_radi_cert=".$id." and estado_radi_cert=1", $conexion) or die(mysql_error());
$row157llm = mysql_fetch_assoc($actualizar57llm);
if (isset($row157llm['gestion_oac']) && ""!=$row157llm['gestion_oac']) {
echo $row157llm['gestion_oac'];
} else {
	
	if (1==$_SESSION['rol'] or 1632==$_SESSION['snr']) {
?>
<form action="" method="POST" name="forasdm43536564351FGDG">
<textarea name="gestion_oac" style="width:100%;"></textarea>
<br>
<button type="submit" class="btn btn-xs btn-warning" >
Enviar </button>
</form>
<?php
} else { }
	}

	 ?>
				


		</div>
	</div>	
</div>

	
	
	
	
	
	
	
	</div>
	
	



        </div>
		
		<?php  } else {   ?>
<div class="row">
<div class="col-md-12">
  <div class="box box-info">
		 <div class="box-body">
              <div class="table-responsive">
                <h3>No existe la PQRS</h3>
              </div>
            </div>
          </div>
        </div>
</div>

<?php } } else {}	?>