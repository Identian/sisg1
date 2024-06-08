<?php
$nump69=privilegios(69,$_SESSION['snr']);



if ((1==$_SESSION['rol'] or 0<$nump69) and isset($_GET["i"])){
	$id=$_GET['i'];
	
	
if (isset($_POST['borrar_evidencia']) && ""!=$_POST['borrar_evidencia']) {
$updateSQLrt = "UPDATE notaria_facturacion SET evidencia=NULL WHERE id_notaria=".$id." and estado_notaria_facturacion=1";
$Result1rt = mysql_query($updateSQLrt, $conexion);
mysql_free_result($Result1rt);
echo $insertado;
} else {}


	
	
	
	
	
if (isset($_POST['seguimiento']) && ""!=$_POST['seguimiento']) {
$seguimiento=$_POST['seguimiento'];
$updateSQLrt = "UPDATE notaria_facturacion SET seguimiento='$seguimiento' WHERE id_notaria=".$id." and estado_notaria_facturacion=1";
$Result1rt = mysql_query($updateSQLrt, $conexion);
mysql_free_result($Result1rt);
echo $insertado;
} else {}
	
	
if (isset($_POST['id_funcionario']) && ""!=$_POST['id_funcionario']) {
	$id_funcionario=$_POST['id_funcionario'];
$updateSQLrt = "UPDATE notaria_facturacion SET id_funcionario=".$id_funcionario." WHERE id_notaria=".$id." and estado_notaria_facturacion=1";
$Result1rt = mysql_query($updateSQLrt, $conexion);
mysql_free_result($Result1rt);
echo $insertado;
} else {}
	
	
	
if (isset($_POST['instalada']) && ""!=$_POST['instalada']) {
$instalada=intval($_POST['instalada']);
$updateSQLrtf = "UPDATE notaria_facturacion SET instalada=".$instalada." WHERE id_notaria=".$id." and estado_notaria_facturacion=1";
$Result1rtf = mysql_query($updateSQLrtf, $conexion);
mysql_free_result($Result1rtf);
echo $insertado;
} else {}
	
	
if (isset($_POST['permiso_actualizacion']) && ""!=$_POST['permiso_actualizacion']) {
$updateSQLr = "UPDATE notaria_facturacion SET permiso_actualizacion=1 WHERE id_notaria=".$id." and estado_notaria_facturacion=1";
$Result1r = mysql_query($updateSQLr, $conexion);
mysql_free_result($Result1r);
echo $insertado;

$emailur=$_POST['mail'];
//$emailur='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Solicitud de corrección para facturación electrónica';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "La Superintendencia de Notariado y Registro informa que se debe corregir la información reportada en el módulo de facturación electrónica."; 
$cuerpo .= '<br><br>Debe acceder a la URL: <a href="https://sisg.supernotariado.gov.co/notaria_datos_facturacion.jsp">https://sisg.supernotariado.gov.co/notaria_datos_facturacion.jsp</a><br><br>'; 
$cuerpo .= '<br><br>Puede acceder al manual V1 en: <a href="https://youtu.be/43HSJbaHgOk">https://youtu.be/43HSJbaHgOk</a><br>';

$cuerpo .= '<br><br>Puede acceder al manual V2 en: <a href="https://youtu.be/LOeNfh1JPww">https://youtu.be/LOeNfh1JPww</a><br>';

if (isset($_POST['mensajeo']) && ""!=$_POST['mensajeo']) {
$men=$_POST['mensajeo'];
$cuerpo .= '<br><br>Observación: '.$men.'<br>';
} else { }


$cuerpo .= '<br><br>Recuerde que debe solicitar y utilizar los rangos de numeración de facturas electrónicas y de contingencia sin prefijo en la plataforma Muisca para la etapa de operación. <a href="https://www.youtube.com/watch?v=Ll-z2yRn_Ss" target="_blank">Ver como se hace.</a>';

$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur,$subject,$cuerpo,$cabeceras);


} else { }
	
	
} else {
	
if (isset($_SESSION['id_vigilado']) && 3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) {
$id=$_SESSION['id_vigilado'];
//$id=0;
} else {
$id=0;
}
		
}


if (0<$id) {



		
if (isset($_POST['evidencia']) && ""!=$_POST['evidencia']) {

//echo '<script>alert("'.$_POST['evidencia'].'");</script>';
if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$tamano_archivo=11534336;
$formato_archivo = array('png', 'jpg', 'jpeg');
$directoryftp="filesnr/fe/";

$ruta_archivo = $id.'-'.$identi;

$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'-'.$_POST['evidencia'].'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  $nombrebre_orig= ucwords($nombrefile);
  
  
$updateSQLrt = "UPDATE notaria_facturacion SET evidencia='$files', instalada=1 WHERE id_notaria=".$id." and estado_notaria_facturacion=1";
$Result1rt = mysql_query($updateSQLrt, $conexion);
mysql_free_result($Result1rt);
echo $insertado;
  
  } else {
$files='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
  }
} else { 
$files='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}	
} else { 
$files='';	
	} 
} else {}


if ((isset($_POST["correo_rut"])) && ($_POST["correo_rut"] != "") && 
(isset($_POST["id_sw"])) && ($_POST["id_sw"] != "")) { 

//echo $_POST["celular_n"].'-'.$_POST["resolucion_dian"];

if ((isset($_POST["correo_rut"]) and 
isset($_POST["nit"]) and  
isset($_POST["celular_n"]) and  
isset($_POST["direccion_n"]) and 
isset($_POST["cod_postal"]) and  
isset($_POST["id_sw"]) and 
isset($_POST["testsetid"]) and 
isset($_POST["llave_tecnica"]) and 
isset($_POST["prefijo"]) and 
isset($_POST["rango_desde"]) and 
isset($_POST["rango_hasta"]) and 
isset($_POST["rango_fecha_desde"]) and 
isset($_POST["rango_fecha_hasta"]) and 
isset($_POST["nombre_notario"]) and 
isset($_POST["vigencia_desde"]) and 
isset($_POST["vigencia_hasta"]) and 
isset($_POST["velocidad_internet"]) and  
isset($_POST["estabilidad_internet"]) and  
isset($_POST["anydesk"])) and (
""!=$_POST["correo_rut"] and 
""!=$_POST["nit"] and  
""!=$_POST["celular_n"] and  
""!=$_POST["direccion_n"] and 
""!=$_POST["cod_postal"] and  
""!=$_POST["id_sw"] and 
""!=$_POST["testsetid"] and 
""!=$_POST["llave_tecnica"] and 
""!=$_POST["prefijo"] and 
""!=$_POST["rango_desde"] and 
""!=$_POST["rango_hasta"] and 
""!=$_POST["rango_fecha_desde"] and 
""!=$_POST["rango_fecha_hasta"] and 
""!=$_POST["nombre_notario"] and 
""!=$_POST["vigencia_desde"] and 
""!=$_POST["vigencia_hasta"] and 
""!=$_POST["velocidad_internet"] and  
""!=$_POST["estabilidad_internet"] and  
""!=$_POST["anydesk"])) { 




if (920<$id) {
	echo 'Debe solicitar creación de registro a la SNR / OTI';
} else {

$updateSQL = sprintf("UPDATE notaria_facturacion SET correo_rut=%s, nit=%s, 
celular_n=%s, direccion_n=%s, cod_postal=%s, id_sw=%s, testsetid=%s, llave_tecnica=%s, 
prefijo=%s, rango_desde=%s, rango_hasta=%s, rango_fecha_desde=%s, rango_fecha_hasta=%s, 
nombre_notario=%s, vigencia_desde=%s, 
vigencia_hasta=%s, velocidad_internet=%s, estabilidad_internet=%s, anydesk=%s, 
resolucion_dian=%s, fecha_resolucion_dian=%s, fecha_actualizacion=now(), permiso_actualizacion=%s, 
estado_notaria_facturacion=%s 
where id_notaria=%s",
GetSQLValueString($_POST["correo_rut"], "text"), 
GetSQLValueString($_POST["nit"], "int"), 
GetSQLValueString($_POST["celular_n"], "text"), 
GetSQLValueString($_POST["direccion_n"], "text"), 
GetSQLValueString($_POST["cod_postal"], "int"), 
GetSQLValueString($_POST["id_sw"], "text"), 
GetSQLValueString($_POST["testsetid"], "text"), 
GetSQLValueString($_POST["llave_tecnica"], "text"),
GetSQLValueString($_POST["prefijo"], "text"),
GetSQLValueString($_POST["rango_desde"], "int"),
GetSQLValueString($_POST["rango_hasta"], "int"),
GetSQLValueString($_POST["rango_fecha_desde"], "date"), 
GetSQLValueString($_POST["rango_fecha_hasta"], "date"), 
GetSQLValueString($_POST["nombre_notario"], "text"),
GetSQLValueString($_POST["vigencia_desde"], "date"), 
GetSQLValueString($_POST["vigencia_hasta"], "date"), 
GetSQLValueString($_POST["velocidad_internet"], "int"), 
GetSQLValueString($_POST["estabilidad_internet"], "int"), 
GetSQLValueString($_POST["anydesk"], "text"), 
GetSQLValueString($_POST["resolucion_dian"], "text"), 
GetSQLValueString($_POST["fecha_resolucion_dian"], "date"), 
GetSQLValueString(0, "int"), 
GetSQLValueString(1, "int"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) ;
//echo $updateSQL;
echo $insertado;
	}
} else {
	
echo '<script type="text/javascript">swal(" ERROR !", " Faltaron datos a diligenciar. !", "error");</script>';

}

} else {}
	
	

 IF ((3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) or 1==$_SESSION['rol'] or 0<$nump69) { 


$query = "SELECT * FROM notaria, posesion_notaria, funcionario   
WHERE notaria.id_notaria=posesion_notaria.id_notaria 
AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND posesion_notaria.fecha_fin IS NULL 
AND estado_notaria=1 
AND estado_funcionario=1 
AND estado_posesion_notaria=1 
and notaria.id_notaria=".$id." 
limit 1";



$actualizar55 = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($actualizar55);

$rownotaria=$row['nombre_notaria'];
$rowname=$row['nombre_funcionario'];
$rowcedula=$row['cedula_funcionario'];
$codigo_dane=$row['codigo_dane'];
$email=$row['email_notaria'];
$dep=$row['id_departamento'];
$mun=$row['codigo_municipio'];

mysql_free_result($actualizar55);

 } else {}  ?>
	  
	  
	  <?php if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && (""!=$_SESSION['posesionnotaria'] or ""!=$_SESSION['id_vigilado'])))
{ include 'menu_notaria.php'; } else { } ?>


	  


<div class="row">

<div class="col-md-12">
  
<div class="box">

<div class="box-header with-border">
<h3 class="box-title">DATOS DE FACTURACIÓN PARA LA NOTARIA <?php echo $rownotaria ?></h3>



<div class="box-tools pull-right">
<!--<a href="https://youtu.be/43HSJbaHgOk" target="_blank"><img src="images/youtube.fw.png" style="width:25px;height:25px;"> <b>Manual V1.</b></a> &nbsp; 

<a href="https://youtu.be/LOeNfh1JPww" target="_blank"><img src="images/youtube.fw.png" style="width:25px;height:25px;"> <b>Manual V2.</b></a> &nbsp; 
-->


<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
				
            <div class="box-body">
		

<div class="col-md-6">
<?php 

$queryn="SELECT * FROM notaria_facturacion where id_notaria=".$id." and estado_notaria_facturacion=1 limit 1";
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);

?>




<div class="form-group text-left"> 
<span style="color:#B40404;">DIAN: </span><br>
<a href="https://catalogo-vpfe-hab.dian.gov.co/User/PersonLogin" target="_blank">Configuración de la DIAN - Habilitación</a>
<br>
<a href="https://catalogo-vpfe.dian.gov.co/User/PersonLogin" target="_blank">Configuración de la DIAN - Producción</a>
</div>


<?php if (1==$_SESSION['rol'] or (isset($rown['llave_tecnica']) && ""!=$rown['llave_tecnica'])) { ?>
<div class="form-group text-left"> 
<span style="color:#B40404;">Manual de instalación y configuración: </span>
<a href="documentos/Manual_FE.html" target="_blank"><img src="images/youtube.fw.png" style="width:20px;height:20px;"> <b>Obtener</b></a> 
</div>
<div class="form-group text-left"> 
<span style="color:#B40404;">Archivo de configuración a colocar en el sistema:   </span>
<a href="factura_notariado/<?php echo $id; ?>.json" target="_blank">Obtener</a>
</div>
<?php } else {} ?>


<?php 
/*
$fechaact = strtotime($rown['fecha_actualizacion']);
$fecha_limite = strtotime("2020-08-25");
	$fechaact <= $fecha_limite &&
	*/
if (1==$_SESSION['rol'] or (isset($rown['llave_tecnica']) && ""!=$rown['llave_tecnica'])) { ?>


 <div class="form-group text-left"> 
<span style="color:#B40404;">Actualización de SIN SERVIDOR:</span>
<a href="https://sisg.supernotariado.gov.co/documentos/SIN-SERVIDOR.exe" target="_blank">Descargar</a> &nbsp; 

<a href="documentos/Manual_SIN.pdf" target="_blank"><b>Manual de SIN</b></a> 
</div>

<div class="form-group text-left"> 
<span style="color:#B40404;">Actualización de SIN CLIENTE:</span>
<a href="documentos/SIN_CLIENTE.exe" target="_blank">Descargar</a>  
</div>
 
<div class="form-group text-left"> 
<span style="color:#B40404;">Instalador web F.E. DIAN: </span>
<!--<a href="https://sisg.supernotariado.gov.co/documentos/SISG.exe">Descargar</a>-->
 <a href="https://sisg.supernotariado.gov.co/documentos/SISG.exe" target="_blank">Descarga</a> 


<?php if (isset($rown['evidencia']) && ""!=$rown['evidencia'])  {
echo '<hr><div class="form-group text-left" ><span style="color:#B40404;">Evidencia:</span> <a href="filesnr/fe/'.$rown['evidencia'].'" target="_blank">Si, <img src="filesnr/fe/'.$rown['evidencia'].'" style="width:25px;"></a> ';
 if ((1==$_SESSION['rol']) or 0<$nump69) { ?>
<form action="" method="post" name="fo453454532432" > 
<input type="hidden" name="borrar_evidencia" value="222">
<input type="submit" value="Borrar evidencia">
</form>
<?php } else {} echo '</div>';
	} else { ?>
<hr>
<form action="" method="post" name="fo4532432" enctype="multipart/form-data" >
<div class="form-group text-left" > 
<span style="color:#B40404;">* Adjuntar evidencia de superar habilitación. <a href="documentos/ejemplo_evidencia.jpg" target="_blank">Ejemplo</a></span>
<input type="file" name="file" id="file" title="Subir impresion de pantalla en formato de imagen PNG"   style="">				   
<input type="hidden" name="evidencia" value="111">
<input type="submit" value="Enviar">
</div>
</form>
<?php }  ?>


</div>
<?php  } else { } ?>





<?php if (1==$_SESSION['rol'] or  0<$nump69) { ?>
<hr>
<form action="" method="POST" name="fo45343243245r543545m1" >
<div class="form-group text-left"> 
<span style="color:#B40404;">Con instalación? (funciona con http://localhost):   </span>
<select name="instalada">
<option></option>
<option value="0" <?php if (0==$rown['instalada']) { echo 'selected'; } else {} ?>>No</option>
<option value="1" <?php if (1==$rown['instalada']) { echo 'selected'; } else {} ?>>Si</option>
</select>
<input type="submit" value="Enviar">
</div>
</form>
<hr>
<form action="" method="POST" name="fo453342342354534545r543545m1" >
<div class="form-group text-left"> 
<span style="color:#B40404;">Seguimiento a la Notaria (No eliminar mensajes anteriores):   </span>
<textarea name="seguimiento" style="width:100%;" Placeholder="El dia 25-09-2020 a las 10:00 am se llamo a la Notaria para conocer porque no ha instalado el sistema de facturación electrónica, se dio claridad que la instalación la debe realizar la Notaria y se socializo la mesa de ayuda que la SNR brinda. La notaria no ha instalado porque xxxxxxxx"><?php echo $rown['seguimiento']; ?></textarea>
<input type="submit" value="Enviar">
</div>
</form>
<hr>
<?php  } else { } ?>

<?php if (1==$_SESSION['rol'] or 0<$nump69) { ?>


<form action="" method="POST" name="fo45345r543545m1" >
<div class="form-group text-left"> 
<span style="color:#B40404;">Permitir actualización:   </span>
<select name="permiso_actualizacion">
<option value="0" <?php if (0==$rown['permiso_actualizacion']) { echo 'selected'; } else {} ?>>No</option>
<option value="1" <?php if (1==$rown['permiso_actualizacion']) { echo 'selected'; } else {} ?>>Si</option>
</select>
<input type="hidden" name="mail" value="<?php echo $email; ?>">
<input type="submit" value="Enviar">
<br>
<textarea name="mensajeo" style="width:100%;"></textarea>
</div>
</form>
<!--
<form action="" method="POST" name="fo423235334534543545m1" >
<div class="form-group text-left"> 
<span style="color:#B40404;">Asignación:   </span>
<select name="id_funcionario" >
					<option value="" selected></option>
					<?php		
/*					
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and id_perfil=75  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion);
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {
							echo '<option value="'.$rowop['id_funcionario'].'" ';
							if ($rown['id_funcionario']==$rowop['id_funcionario']) { echo 'selected'; } else {}
							echo '>'.$rowop['nombre_funcionario'].'</option>';
							
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
*/
					?>						
				</select>			
<input type="submit" value="Enviar">
</div>
</form>
-->



<?php 

} else {} ?>


<form action="" method="POST" name="form1" >

<div class="form-group text-left"> 
<label  class="control-label">DEPARTAMENTO:</label>   
<input type="text" class="form-control" name=""   value="<?PHP echo $dep; ?>" readonly >
</div>


<div class="form-group text-left"> 
<label  class="control-label">MUNICIPIO:</label>   
<input type="text" class="form-control" name=""   value="<?PHP echo $mun; ?>" readonly >
</div>


<div class="form-group text-left"> 
<label  class="control-label">CORREO INSTITUCIONAL:</label>   
<input type="text" class="form-control" name=""   value="<?PHP echo $email; ?>" readonly >
</div>


<div class="form-group text-left"> 
<label  class="control-label">RAZÓN SOCIAL:</label>   
<input type="text" class="form-control" name=""   value="Persona natural" readonly >
</div>

<div class="form-group text-left"> 
<label  class="control-label">ACTIVIDAD ECONÓMICA:</label>   
<input type="text" class="form-control" name=""   value="6910" readonly >
</div>

<div class="form-group text-left"> 
<label  class="control-label">APORTES A TERCEROS:</label>   
<input type="text" class="form-control" name=""   value="RECAUDO FONDO ESPECIAL NOTARIADO" readonly >

<input type="text" class="form-control" name=""   value="RECAUDO SUPERINTENDENCIA DE NOTARIADO Y REGISTRO" readonly >

<input type="text" class="form-control" name=""   value="APORTE ESPECIAL FONDO NOTARIADO" readonly >


</div>





<div class="form-group text-left"> 
<label  class="control-label">NOMBRE DEL SOFTWARE PROPIO - DIAN: (<a href="documentos/nombreSoftware.png" target="_blank">Donde colocarlo</a>)</label>   
<input type="text" class="form-control" name=""   value="<?php echo 'SNR'.$codigo_dane; ?>" readonly >
</div>


<div class="form-group text-left"> 
<label  class="control-label">PIN - DIAN: (<a href="documentos/pinDian.png" target="_blank">Donde colocarlo</a>)</label>   
<input type="text" class="form-control" name="" value="12345" readonly >
</div>




<div class="form-group text-left"> 
<label  class="control-label">CÉDULA:</label>   
<input type="text" class="form-control"    value="<?php echo $rowcedula; ?>" readonly >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL NOTARIO(A)  <a href="images/nombre_notario.png" target="_blank">Idéntico al registrado en RUT.</a>:</label>   
<input type="text" class="form-control mayuscula" name="nombre_notario"  value="<?php echo $rown['nombre_notario']; ?>"  placeholder="<?php echo $rowname; ?>" required >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CELULAR:</label>   
<input type="text" class="form-control numero" name="celular_n"  value="<?php echo $rown['celular_n']; ?>"  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DIRECCIÓN DE LA NOTARIA:</label>   
<input type="text" class="form-control" name="direccion_n"  value="<?php echo $rown['direccion_n']; ?>"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE CÓDIGO POSTAL: (<a href="http://www.codigopostal.gov.co" target="_blank">Identificar</a>)</label>   
<input type="text" class="form-control numero" name="cod_postal"   value="<?php echo $rown['cod_postal']; ?>"  required>
</div>


</div>




<div class="col-md-6">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CORREO ELECTRÓNICO DE FACTURACIÓN REGISTRADO EN RUT:</label>   
<input type="email" class="form-control" name="correo_rut"   value="<?php echo $rown['correo_rut']; ?>" required >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NIT registrado en DIAN: <a href="images/nitdian.png" target="_blank">Donde ubicarlo.</a></label>   
<input type="text" class="form-control numero" name="nit"   value="<?php echo $rown['nit']; ?>"  required>
</div>




<!--https://youtu.be/K0kXzrz4lGw?t=234-->
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> IDENTIFICADOR DE SOFTWARE DIAN: <a href="documentos/ejemploidsoftdian.jpg" target="_blank">Donde ubicarlo.</a></label>   
<input type="text" class="form-control" name="id_sw"   value="<?php echo $rown['id_sw']; ?>"  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TEST SET ID: "Código" <a href="images/testsetid.jpg" target="_blank">Donde ubicarlo</a></label>   
<input type="text" class="form-control" name="testsetid"  value="<?php echo $rown['testsetid']; ?>"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> LLAVE TÉCNICA: <a href="images/llave_tecnica.png" target="_blank">Donde ubicarlo</a></label>   
<input type="text" class="form-control" name="llave_tecnica"  value="<?php echo $rown['llave_tecnica']; ?>"  required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> PREFIJO: <a href="images/prefijo.png" target="_blank">Donde ubicarlo.</a></label>   
<input type="text" class="form-control" name="prefijo"  value="<?php echo $rown['prefijo']; ?>"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RANGO DE NÚMERACIÓN: <a href="images/rangos.png" target="_blank">Donde ubicarlo.</a></label>   
<input type="text" class="form-control numero" style="max-width:200px;background:#fff;" name="rango_desde"  placeholder="Desde" value="<?php echo $rown['rango_desde']; ?>"  required>
<input type="text" class="form-control numero" style="max-width:200px;background:#fff;" name="rango_hasta"  placeholder="Hasta" value="<?php echo $rown['rango_hasta']; ?>"  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHAS DE RANGOS DE NUMERACIÓN: <a href="images/fecha_rango.png" target="_blank">Donde ubicarlo.</a></label>   
<input type="text" class="form-control datepickera" style="max-width:200px;background:#fff;" name="rango_fecha_desde"  placeholder="Desde" value="<?php echo $rown['rango_fecha_desde']; ?>" readonly required>
<input type="text" class="form-control datepickera" style="max-width:200px;background:#fff;" name="rango_fecha_hasta"  placeholder="Hasta" value="<?php echo $rown['rango_fecha_hasta']; ?>" readonly required>
</div>


<hr>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> VIGENCIA DEL CERTIFICADO DIGITAL: <a href="documentos/ejemplovigencia.png" target="_blank">Donde ubicarlo.</a></label>   
<input type="text" class="form-control datepickera" style="max-width:200px;background:#fff;" name="vigencia_desde"  placeholder="Desde" value="<?php echo $rown['vigencia_desde']; ?>" readonly required>
<input type="text" class="form-control datepickera" style="max-width:200px;background:#fff;" name="vigencia_hasta"  placeholder="Hasta" value="<?php echo $rown['vigencia_hasta']; ?>" readonly required>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> VELOCIDAD DE INTERNET: <a href="https://fast.com/es/" target="_blank">Realizar prueba.</a>   </label>   
<select class="form-control" name="velocidad_internet"  required>
<option  value="" ></option>
<option value="1" <?php if (1==$rown['velocidad_internet']) { echo 'selected'; } else {} ?>>1 Mbps</option>
<option value="2" <?php if (2==$rown['velocidad_internet']) { echo 'selected'; } else {} ?>>2 Mbps</option>
<option value="5" <?php if (5==$rown['velocidad_internet']) { echo 'selected'; } else {} ?>>5 Mbps</option>
<option value="10" <?php if (10==$rown['velocidad_internet']) { echo 'selected'; } else {} ?>>10 Mbps</option>
<option value="20" <?php if (20==$rown['velocidad_internet']) { echo 'selected'; } else {} ?>>20 Mbps</option>
<option value="30" <?php if (30==$rown['velocidad_internet']) { echo 'selected'; } else {} ?>>30 Mbps</option>
<option value="50" <?php if (50==$rown['velocidad_internet']) { echo 'selected'; } else {} ?>>50 Mbps</option>
<option value="100" <?php if (100==$rown['velocidad_internet']) { echo 'selected'; } else {} ?>>100 Mbps</option>
</select>
</div>





<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> LA ESTABILIDAD O DISPONIBILIDAD DE INTERNET ES:</label>   
<select class="form-control" name="estabilidad_internet"  required>
<option value="" ></option>
<option value="1" <?php if (1==$rown['estabilidad_internet']) { echo 'selected'; } else {} ?>>Siempre hay internet</option>
<option value="2" <?php if (2==$rown['estabilidad_internet']) { echo 'selected'; } else {} ?>>Falla el internet menos de 1 hora al dia</option>
<option value="3" <?php if (3==$rown['estabilidad_internet']) { echo 'selected'; } else {} ?>>Falla el internet menos de 2 hora al dia</option>
<option value="4" <?php if (4==$rown['estabilidad_internet']) { echo 'selected'; } else {} ?>>Falla el internet menos de 6 hora al dia</option>
<option value="5" <?php if (5==$rown['estabilidad_internet']) { echo 'selected'; } else {} ?>>Falla el internet un dia a la semana</option>
<option value="6" <?php if (6==$rown['estabilidad_internet']) { echo 'selected'; } else {} ?>>Falla el internet varios dias a la semana</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO / DIRECCIÓN DE USO PERSONAL DE ANYDESK: <a href="https://anydesk.com/en" target="_blank">Descargar</a> / <a href="documentos/anydesk-remote-desktop-software.jpg" target="_blank">Donde ubicarlo.</a></label>   
<input type="text" class="form-control" name="anydesk"   value="<?php echo $rown['anydesk']; ?>" required>
</div>

<hr>
<span style="color:#bbb;">Datos obligatorios luego de las pruebas de habilitación:</span>
<div class="form-group text-left"> 
<label  class="control-label">NÚMERO DE RESOLUCIÓN COMO FACTURADOR DIAN:  (1876 <a href="documentos/numeroResolucion.png" target="_blank">Donde ubicarlo.</a>)</label>   
<input type="text" class="form-control" name="resolucion_dian" placeholder="Se debe colocar luego de las pruebas de habilitación"  value="<?php echo $rown['resolucion_dian']; ?>"  >
</div>



<div class="form-group text-left"> 
<label  class="control-label">FECHA DE RESOLUCIÓN COMO FACTURADOR DIAN:</label>   
<input type="text" class="form-control datepicker" style="max-width:200px;background:#fff;" name="fecha_resolucion_dian" readonly  placeholder="Se debe colocar luego de las pruebas de habilitación" value="<?php echo $rown['fecha_resolucion_dian']; ?>"  >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#B40404;">Recuerde que debe solicitar y utilizar los rangos de numeración de facturas electrónicas y de contingencia en la plataforma Muisca para la etapa de operación.</span> <a href="https://www.youtube.com/watch?v=Ll-z2yRn_Ss" target="_blank">Ver como.</a></label>   
</div>
<hr>
<div class="modal-footer">
<?php 


if ((isset($_SESSION['id_vigilado']) && 3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) or 1==$_SESSION['rol'] or 0<$nump69) {



if ((isset($rown['correo_rut'])) && ($rown['correo_rut'] != "") && 
(isset($rown['id_sw'])) && ($rown['id_sw'] != "") 
&& 0==$rown['permiso_actualizacion']) 
{ echo '<b>Información reportada: '.$rown['fecha_actualizacion'].',
 Para correcciones escribir a: soporte.sin@supernotariado.gov.co</b>'; 
 
 } else { 
?>

<span style="color:#ff0000;">* Obligatorio</span> 
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success"><input type="hidden" name="table" value="notaria">
<span class="glyphicon glyphicon-ok"></span> Enviar</button>

<?php
}
mysql_free_result($selectn);

} else {}
 ?>
</div>


</div>


</form>


<br>
<br>
<br>





</div>
</div>
</div>

</div>






<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>DATOS DE FACTURACIÓN PARA LA NOTARIA <?php echo $rownotaria; ?></b></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


</div>
</div> 
</div> 
</div> 
























<div class="modal fade" id="popupnumeracion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>RANGOS DE NUMERACIÓN PARA CONTINGENCIA <?php echo $rownotaria; ?></b></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


</div>
</div> 
</div> 
</div> 


<?php } else { echo 'No tiene acceso'; } ?>



