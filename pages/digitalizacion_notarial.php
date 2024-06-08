<?php
$nump97=privilegios(97,$_SESSION['snr']);
if ((1==$_SESSION['rol'] or 0<$nump97) and isset($_GET["i"])){
	
$id=$_GET['i'];


if ((isset($_POST["cumplimiento"])) && (""!=$_POST["cumplimiento"])) { 
$updateSQL = sprintf("UPDATE notaria SET cump_val_digitalizacion=%s where id_notaria=%s",
GetSQLValueString($_POST["cumplimiento"], "text"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion);
echo $actualizado;
mysql_free_result($Result);
} else { }




if ((isset($_POST["resolucion_autorizacion"])) && (""!=$_POST["resolucion_autorizacion"])) { 
$updateSQL4 = sprintf("UPDATE resp_val_not_digital set resolucion_autorizacion=%s, 
fecha_resolucion=%s where id_notaria=%s", 
GetSQLValueString($_POST["resolucion_autorizacion"], "int"), 
GetSQLValueString($_POST["fecha_resolucion"], "date"), 
GetSQLValueString($id, "int"));
$Result4 = mysql_query($updateSQL4, $conexion);
echo $actualizado;
mysql_free_result($Result4);
} else { }



	
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
$rowp = mysql_fetch_assoc($actualizar55);
$id_funci=$rowp['id_funcionario'];
$llave_token=$rowp['llave_token'];
$api_user=$rowp['api_user'];
$api_key=$rowp['api_key'];
$rownotaria=$rowp['nombre_notaria'];
$rowname=$rowp['nombre_funcionario'];
$rowcedula=$rowp['cedula_funcionario'];
$codigo_dane=$rowp['codigo_dane'];
$email=$rowp['email_notaria'];
$dep=$rowp['id_departamento'];
$mun=$rowp['codigo_municipio'];
$cump_val_digitalizacion=$rowp['cump_val_digitalizacion'];

$id_tipo_oficina=$rowp['id_tipo_oficina'];

//$id_tipo_oficina=$_SESSION['snr_tipo_oficina'];


mysql_free_result($actualizar55);
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
			
			 <li><a href="notaria&<?php echo $id; ?>.jsp"><b>NOTARIA 
     <?php echo $rownotaria;?>
		  </b></a></li>
           
              <li><a href="sucesion<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Liq. Herencia</a></li>
			  
			   <?php if (($_SESSION['snr_tipo_oficina'] == 3 && 1==$_SESSION['snr_grupo_cargo']) OR 1==$_SESSION['rol']) { ?> 
			  <li><a href="privilegios_notariado<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Acceso a módulos</a></li>
			   <?php } ?>
			   <li><a href="salida_menor<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Salida de menores</a></li>
            <li><a href="notaria_datos_facturacion<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Datos Facturación</a></li>
           
		   <?php if (1==$_SESSION['rol']) { ?> 
		  <li><a href="apostilla.jsp" title="Apostilla">Apostilla</a></li>
		    <li><a href="digitalizacion_notarial<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="Digitalización">Digitalización</a></li>
 <!-- <li><a href="registro_fotografico_notaria<?php //if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="Registro Fotografico">Local</a></li>-->
				 
		 <?php } else {} ?>
		  
            </ul>
          </div>
		 
      </div>
    </nav>
  </div>
</div>
	
	  
	  
	  

	  


<div class="row">

<div class="col-md-12">
  
<div class="box">

<div class="box-header with-border">
<h3 class="box-title">DATOS DE CONFIGURACIÓN PARA LA NOTARIA <?php echo $rownotaria; ?></h3>



<div class="box-tools pull-right">

<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
				
            <div class="box-body">
		

<div class="col-md-6">


<div class="form-group text-left"> 
<label  class="control-label">DANE: </label>   
<input type="text" class="form-control" name=""   value="<?php echo ''.$codigo_dane; ?>" readonly >
</div>


<div class="form-group text-left"> 
<label  class="control-label">CORREO INSTITUCIONAL:</label>   
<input type="text" class="form-control" name=""   value="<?PHP echo $email; ?>" readonly >
</div>


<div class="form-group text-left"> 
<label  class="control-label">CÉDULA:</label>   
<input type="text" class="form-control"    value="<?php echo $rowcedula; ?>" readonly >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL NOTARIO(A).</a>:</label>   
<input type="text" class="form-control mayuscula" readonly name="nombre_notario"  value="<?php echo $rowname; ?>"  required >
</div>

<script>
function mostrarintegracion() {
	document.getElementById("divtoken").style="display";
}

</script>
<div class="form-group text-left"> 
<a><label  class="control-label" onclick="mostrarintegracion();">Ver Datos de integración.</label>  </a> 
</div>

<div id="divtoken" style="display:none;">
<div class="form-group text-left"> 
<label  class="control-label">TOKEN:</label>   
<input type="text" class="form-control" name="" value="<?php echo $llave_token; ?>" readonly >
</div>


<div class="form-group text-left"> 
<label  class="control-label">API-USER:</label>   
<input type="text" class="form-control" name="" value="<?php echo $api_user; ?>" readonly >
</div>

<div class="form-group text-left"> 
<label  class="control-label">API-KEY:</label>   
<input type="text" class="form-control" name="" value="<?php echo $api_key; ?>" readonly >
</div>

</div>



 <form action="" method="POST" name="fo32432rr45435435435m54435565461">
<div class="form-group text-left"> 
<label  class="control-label">Cumplimiento (Resultado):</label>
<select name="cumplimiento" style="width:100px;">
<option><?php echo $cump_val_digitalizacion; ?></option>
<option value="No">No</option>
<option value="Si">Si</option>
</select>

<button type="submit" class="btn btn-success btn-xs">
<span class="glyphicon glyphicon-ok"></span> Guardar</button>
</div>
</form>

</div>




<div class="col-md-6">

<a href="validacion_notarias_digitales.jsp">Control</a>


<?php if (1==$_SESSION['rol'] or 0<$nump97) { ?>
<hr>
		
		<div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Digitalización<br>Notarial</span> 

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
				  <?php
	// ambiente   1: producción    2: pruebas
	
	//id_tipo_oficina   1: Es analista, no pueden salir botones de creación
	//                  3:  es Notario,  sale todo
	
	

function token($ambiente,$iduser,$llave,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email){
       
       $cabecera = array('typ' => 'JWT', 'alg' => 'HS256');
        $cabecera = json_encode($cabecera);
        $cabecera = base64_encode($cabecera);
        $data = array('iss' => 'SNR', 'ambiente' => $ambiente, 'admin'=>0, 'id_funcionario' => ''.$iduser.'', 'nombre_funcionario' => ''.$rowname64.'', 'id_departamento' => ''.$dep.'', 'codigo_municipio' => ''.$mun.'', 'id_tipo_oficina' => ''.$id_tipo_oficina.'', 'id_notaria' => ''.$id.'', 'nombre_notaria' => ''.$rownotaria64.'', 'dane' => ''.$codigo_dane.'', 'correo' => ''.$email.'');
        $data = json_encode($data);
        $data = base64_encode($data);
        $firma = hash_hmac('sha256', "$cabecera.$data", $llave);
        $token = "$cabecera.$data.$firma";
      //52.184.219.189      40.70.170.37      52.251.65.16   https://www.digitalizacionnotarial.gov.co
	   $final= '<form action="https://www.digitalizacionnotarial.gov.co/token" method="post" target="_blank">
                <input type="hidden" name="token" value="'.$token.'" />
                <input type="submit" value="Acceder" class="btn btn-xs btn-default" style="width:100%">
                </form>'; 
return $final;				
    }
	
	$ambiente='1';
	$rowname64=base64_encode($rowname);
	$rownotaria64=base64_encode($rownotaria);
	echo token($ambiente,$id_funci,$llave_token,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email);
	
	//echo token($id_funci,$llave_token);
				  ?>
                <!--  <a href="" target="_blank" class="btn btn-xs btn-default" style="width:100%">
                    Acceder</a>-->
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  
    
	  <?php //echo 'Ambiente: '.$ambiente.'<br>'.$id_funci.'<br>'.$llave_token.'<br>'.base64_decode($rowname64).'<br>'.$dep.'<br>'.$mun.'<br>Oficina: '.$id_tipo_oficina.'<br>idnot: '.$id.'<br>'.base64_decode($rownotaria64).'<br>'.$codigo_dane.'<br>'.$email;
	?>
	 
  
		  
		   <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TEST Digitalización<br>Notarial</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                	  <?php
					  
					  
					  
function tokentest($ambientep,$iduser,$llave,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email){
       
       $cabecera = array('typ' => 'JWT', 'alg' => 'HS256');
        $cabecera = json_encode($cabecera);
        $cabecera = base64_encode($cabecera);
        $data = array('iss' => 'SNR', 'ambiente' => $ambientep, 'admin'=>0, 'id_funcionario' => ''.$iduser.'', 'nombre_funcionario' => ''.$rowname64.'', 'id_departamento' => ''.$dep.'', 'codigo_municipio' => ''.$mun.'', 'id_tipo_oficina' => ''.$id_tipo_oficina.'', 'id_notaria' => ''.$id.'', 'nombre_notaria' => ''.$rownotaria64.'', 'dane' => ''.$codigo_dane.'', 'correo' => ''.$email.'');
	   $data = json_encode($data);
        $data = base64_encode($data);
        $firma = hash_hmac('sha256', "$cabecera.$data", $llave);
        $token = "$cabecera.$data.$firma";
   $final= '<form action="http://test.digitalizacionnotarial.gov.co/token" method="post" target="_blank">
                <input type="hidden" name="token" value="'.$token.'">
                <input type="submit" value="Acceder" class="btn btn-xs btn-default" style="width:100%">
                </form>'; 
return $final;				
    }
	
	$ambientep='2';

	echo tokentest($ambientep,$id_funci,$llave_token,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email);
	
	
	

				  ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
 <?php 
 
} else {}
 
 
 //echo 'Ambiente '.$ambientep; ?>
		
		
		
		
	<?php	if ((1==$_SESSION['rol'] or 0<$nump97) and isset($_GET["i"])){ ?>
		
		 <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Analisis Producción</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                	  <?php
					  
					  
					  
function tokenan($ambientep,$iduser,$llave,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email){
       
       $cabecera = array('typ' => 'JWT', 'alg' => 'HS256');
        $cabecera = json_encode($cabecera);
        $cabecera = base64_encode($cabecera);
        $data = array('iss' => 'SNR', 'ambiente' => $ambientep, 'admin'=>1, 'id_funcionario' => ''.$iduser.'', 'nombre_funcionario' => ''.$rowname64.'', 'id_departamento' => ''.$dep.'', 'codigo_municipio' => ''.$mun.'', 'id_tipo_oficina' => ''.$id_tipo_oficina.'', 'id_notaria' => ''.$id.'', 'nombre_notaria' => ''.$rownotaria64.'', 'dane' => ''.$codigo_dane.'', 'correo' => ''.$email.'');
	   $data = json_encode($data);
        $data = base64_encode($data);
        $firma = hash_hmac('sha256', "$cabecera.$data", $llave);
        $token = "$cabecera.$data.$firma";
   $final= '<form action="https://www.digitalizacionnotarial.gov.co/token" method="post" target="_blank">
                <input type="hidden" name="token" value="'.$token.'">
                <input type="submit" value="Acceder" class="btn btn-xs btn-default" style="width:100%">
                </form>'; 
return $final;				
    }
	
	$ambientep='1';
$nombre64=base64_encode($_SESSION['snr_nombre']);
	echo tokenan($ambientep,$_SESSION['snr'],$llave_token,$nombre64,$dep,$mun,$_SESSION['snr_tipo_oficina'],$id,$rownotaria64,$codigo_dane,$email);
	
	
	

				  ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  
		  
		  
		  
		  
		  
		   <div class="info-box bg-danger">
            <span class="info-box-icon"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Analisis Pruebas</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                	  <?php
			/*		  
					  
function tokentest($ambientep,$iduser,$llave,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email){
       
       $cabecera = array('typ' => 'JWT', 'alg' => 'HS256');
        $cabecera = json_encode($cabecera);
        $cabecera = base64_encode($cabecera);
        $data = array('iss' => 'SNR', 'ambiente' => $ambientep, 'admin'=>1, 'id_funcionario' => ''.$iduser.'', 'nombre_funcionario' => ''.$rowname64.'', 'id_departamento' => ''.$dep.'', 'codigo_municipio' => ''.$mun.'', 'id_tipo_oficina' => ''.$id_tipo_oficina.'', 'id_notaria' => ''.$id.'', 'nombre_notaria' => ''.$rownotaria64.'', 'dane' => ''.$codigo_dane.'', 'correo' => ''.$email.'');
	   $data = json_encode($data);
        $data = base64_encode($data);
        $firma = hash_hmac('sha256', "$cabecera.$data", $llave);
        $token = "$cabecera.$data.$firma";
   $final= '<form action="https://www.digitalizacionnotarial.gov.co/token2" method="post" target="_blank">
                <input type="hidden" name="token" value="'.$token.'">
                <input type="submit" value="Acceder" class="btn btn-xs btn-default" style="width:100%">
                </form>'; 
return $final;				
    }
	
	$ambientep='2';

	echo tokentest($ambientep,$id_funci,$llave_token,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email);
	*/
	
	
				  ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  
		  
		  
	<?php } else {} ?>
		
</div>


</div>

</div>
</div>
</div>






<div class="row">
<div class="col-md-12">
<div class="box">
<div class="box-header with-border">
<h3 class="box-title">PREGUNTAS DE VALIDACIÓN</h3>
<div class="form-group text-left"> 
<span style="color:#B40404;"></span>


&nbsp; &nbsp; &nbsp; &nbsp; <a style="color:#777;cursor: pointer" onclick="window.print()" title="Constancia"><span class="glyphicon glyphicon-print"></span></a>


</div>
<div class="box-tools pull-right">
<?php echo date('Y-m-d H:m:s'); ?>
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>
</div>
<div class="box-body">

Tener en cuenta:<br>
1. La validación se podra realizar en varias sesiones incluyendo una sesion para revisar la interoperabilidad con el repositorio de la Superintendencia.
<br>2. Para validar el enrolamiento en Notaria, el Notario tendra que habilitar video en la aplicación Teams y presentar el procedimiento con una persona.
<br>3. El alcance y detalles tecnicos de la validación es de acuerdo con el Anexo técnico- Digitalización Notarial: <a href="http://www.supernotariado.gov.co/files/portal/portal-anexotecnico4deenero.pdf" target="_blank"> <b>Ver</b></a> 
<br>4. Correo de recepción de documentos: proyectodigitalnotarial@supernotariado.gov.co


<?PHP
/*
$query4="select * FROM validacion_notariasd";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
echo '<div class="form-group text-left"> 
<label  class="control-label">'.$row['orden'].' '.$row['nombre_validacion_notariasd'].':</label> ';
echo '<br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple'.$row['id_validacion_notariasd'].'" value="rescumple'.$row['id_validacion_notariasd'].'finalres"> &nbsp;  &nbsp;  &nbsp; Observación:';
echo '<textarea name="observacion'.$row['id_validacion_notariasd'].'" style="width:100%">resobservacion'.$row['id_validacion_notariasd'].'finalobservacion</textarea>';
echo '</div><hr>';
 } */
 
 
 

$id = $_GET['i'];


if ((isset($_POST["tipo_adjunto"])) && (""!=$_POST["tipo_adjunto"])) {

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'jpg', 'png');


$directoryftp="filesnr/digitalizacion/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'notaria-'.$_SESSION['snr'].'-'.date("YmdGis");

$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
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
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
  


$insertSQL = sprintf("INSERT INTO doc_resp_val_not_digital (nombre_doc_resp_val_not_digital, 
id_resp_val_not_digital,  url, estado_doc_resp_val_not_digital) 
VALUES (%s, %s, %s, %s)", 
GetSQLValueString($_POST["tipo_adjunto"], "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) ;

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
  
	

} else { }




if ((isset($_POST["fecha_solicitud"])) && ($_POST["fecha_solicitud"] != "")) { 
$updateSQL = sprintf("UPDATE resp_val_not_digital SET nombre_resp_val_not_digital=%s, 
fecha_solicitud=%s, fecha_validacion=%s, orden_cita=%s, url=%s, proveedor=%s,  
 observacion1=%s, 
observacion2=%s, observacion3=%s, observacion4=%s, observacion5=%s, observacion6=%s, 
observacion7=%s, cumple8=%s, observacion8=%s, cumple9=%s, observacion9=%s, 
cumple10=%s, observacion10=%s, cumple11=%s, observacion11=%s, cumple12=%s, 
observacion12=%s, cumple13=%s, observacion13=%s, cumple14=%s, observacion14=%s, 
cumple15=%s, observacion15=%s, cumple16=%s, observacion16=%s, cumple17=%s, observacion17=%s, 
cumple18=%s, observacion18=%s, cumple19=%s, observacion19=%s, cumple20=%s, observacion20=%s, 
cumple21=%s, observacion21=%s, cumple22=%s, observacion22=%s, cumple23=%s, observacion23=%s, 
cumple24=%s, observacion24=%s, cumple25=%s, observacion25=%s, cumple26=%s, observacion26=%s, 
cumple27=%s, observacion27=%s, cumple28=%s, observacion28=%s, cumple29=%s, observacion29=%s, 
cumple30=%s, observacion30=%s, cumple31=%s, observacion31=%s, cumple32=%s, observacion32=%s, 
cumple33=%s, observacion33=%s, cumple34=%s, observacion34=%s, cumple35=%s, observacion35=%s, 
cumple36=%s, observacion36=%s, cumple37=%s, observacion37=%s, cumple38=%s, observacion38=%s, 
cumple39=%s, observacion39=%s, cumple40=%s, observacion40=%s, cumple41=%s, observacion41=%s, 
cumple42=%s, observacion42=%s, cumple43=%s, observacion43=%s, cumple44=%s, observacion44=%s, 
cumple45=%s, observacion45=%s, cumple46=%s, observacion46=%s, observacion47=%s, 
estado_resp_val_not_digital=%s where id_resp_val_not_digital=%s",
GetSQLValueString($_POST["nombre_resp_val_not_digital"], "text"),  
GetSQLValueString($_POST["fecha_solicitud"], "date"), 
GetSQLValueString($_POST["fecha_validacion"], "date"),
GetSQLValueString($_POST["orden_cita"], "text"), 
GetSQLValueString($_POST["url"], "text"), 
GetSQLValueString($_POST["proveedor"], "text"),
GetSQLValueString($_POST["observacion1"], "text"), 
GetSQLValueString($_POST["observacion2"], "text"), 
GetSQLValueString($_POST["observacion3"], "text"), 
GetSQLValueString($_POST["observacion4"], "text"), 
GetSQLValueString($_POST["observacion5"], "text"), 
GetSQLValueString($_POST["observacion6"], "text"), 
GetSQLValueString($_POST["observacion7"], "text"), 
GetSQLValueString($_POST["cumple8"], "text"), 
GetSQLValueString($_POST["observacion8"], "text"), 
GetSQLValueString($_POST["cumple9"], "text"), 
GetSQLValueString($_POST["observacion9"], "text"), 
GetSQLValueString($_POST["cumple10"], "text"), 
GetSQLValueString($_POST["observacion10"], "text"), 
GetSQLValueString($_POST["cumple11"], "text"), 
GetSQLValueString($_POST["observacion11"], "text"), 
GetSQLValueString($_POST["cumple12"], "text"), 
GetSQLValueString($_POST["observacion12"], "text"), 
GetSQLValueString($_POST["cumple13"], "text"), 
GetSQLValueString($_POST["observacion13"], "text"), 
GetSQLValueString($_POST["cumple14"], "text"), 
GetSQLValueString($_POST["observacion14"], "text"), 
GetSQLValueString($_POST["cumple15"], "text"), 
GetSQLValueString($_POST["observacion15"], "text"), 
GetSQLValueString($_POST["cumple16"], "text"), 
GetSQLValueString($_POST["observacion16"], "text"), 
GetSQLValueString($_POST["cumple17"], "text"), 
GetSQLValueString($_POST["observacion17"], "text"), 
GetSQLValueString($_POST["cumple18"], "text"), 
GetSQLValueString($_POST["observacion18"], "text"), 
GetSQLValueString($_POST["cumple19"], "text"), 
GetSQLValueString($_POST["observacion19"], "text"), 
GetSQLValueString($_POST["cumple20"], "text"), 
GetSQLValueString($_POST["observacion20"], "text"), 
GetSQLValueString($_POST["cumple21"], "text"), 
GetSQLValueString($_POST["observacion21"], "text"), 
GetSQLValueString($_POST["cumple22"], "text"), 
GetSQLValueString($_POST["observacion22"], "text"), 
GetSQLValueString($_POST["cumple23"], "text"), 
GetSQLValueString($_POST["observacion23"], "text"), 
GetSQLValueString($_POST["cumple24"], "text"), 
GetSQLValueString($_POST["observacion24"], "text"), 
GetSQLValueString($_POST["cumple25"], "text"), 
GetSQLValueString($_POST["observacion25"], "text"), 
GetSQLValueString($_POST["cumple26"], "text"), 
GetSQLValueString($_POST["observacion26"], "text"), 
GetSQLValueString($_POST["cumple27"], "text"), 
GetSQLValueString($_POST["observacion27"], "text"), 
GetSQLValueString($_POST["cumple28"], "text"), 
GetSQLValueString($_POST["observacion28"], "text"), 
GetSQLValueString($_POST["cumple29"], "text"), 
GetSQLValueString($_POST["observacion29"], "text"), 
GetSQLValueString($_POST["cumple30"], "text"), 
GetSQLValueString($_POST["observacion30"], "text"), 
GetSQLValueString($_POST["cumple31"], "text"), 
GetSQLValueString($_POST["observacion31"], "text"), 
GetSQLValueString($_POST["cumple32"], "text"), 
GetSQLValueString($_POST["observacion32"], "text"), 
GetSQLValueString($_POST["cumple33"], "text"), 
GetSQLValueString($_POST["observacion33"], "text"), 
GetSQLValueString($_POST["cumple34"], "text"), 
GetSQLValueString($_POST["observacion34"], "text"), 
GetSQLValueString($_POST["cumple35"], "text"), 
GetSQLValueString($_POST["observacion35"], "text"), 
GetSQLValueString($_POST["cumple36"], "text"), 
GetSQLValueString($_POST["observacion36"], "text"), 
GetSQLValueString($_POST["cumple37"], "text"), 
GetSQLValueString($_POST["observacion37"], "text"), 
GetSQLValueString($_POST["cumple38"], "text"), 
GetSQLValueString($_POST["observacion38"], "text"), 
GetSQLValueString($_POST["cumple39"], "text"), 
GetSQLValueString($_POST["observacion39"], "text"), 
GetSQLValueString($_POST["cumple40"], "text"), 
GetSQLValueString($_POST["observacion40"], "text"), 
GetSQLValueString($_POST["cumple41"], "text"), 
GetSQLValueString($_POST["observacion41"], "text"), 
GetSQLValueString($_POST["cumple42"], "text"), 
GetSQLValueString($_POST["observacion42"], "text"), 
GetSQLValueString($_POST["cumple43"], "text"), 
GetSQLValueString($_POST["observacion43"], "text"), 
GetSQLValueString($_POST["cumple44"], "text"), 
GetSQLValueString($_POST["observacion44"], "text"), 
GetSQLValueString($_POST["cumple45"], "text"), 
GetSQLValueString($_POST["observacion45"], "text"), 
GetSQLValueString($_POST["cumple46"], "text"), 
GetSQLValueString($_POST["observacion46"], "text"), 
GetSQLValueString($_POST["observacion47"], "text"), 
GetSQLValueString(1, "int"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion);
echo $actualizado;
} else { }
	
	
$query_update = sprintf("SELECT * FROM resp_val_not_digital WHERE id_notaria = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion);
$row = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
mysql_free_result($update);

 ?>
 
 
 
 <br><br><br>
 
<div class="form-group"> 		
<div class="col-md-6">	

ANEXOS
<form action="" method="POST" name="forr34543545435m54435565461" enctype="multipart/form-data">
<select name="tipo_adjunto" selected style="width:200px;">
<option select></option>
<option value="Solicitud de validación">Solicitud de validación</option>
<option value="Ethical Hacking (30)">Ethical Hacking (30)</option>
<option value="Informe de pruebas de carga y estres (31)">Informe de pruebas de carga y estres (31)</option>
<option value="Resolución de autorización de operador biometrico (34)">Resolución de autorización de operador biometrico (34)</option>
<option value="Cumplimiento de las políticas y lineamientos AGN (35)">Cumplimiento de las políticas y lineamientos AGN(35)</option>
<option value="Documento de aliado tecnológico">Documento de aliado tecnológico</option>
<option value="Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 15 de Bogota / SIGNO360">Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 15 de Bogota / SIGNO360</option>
<option value="Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 16 de Bogota / OLIMPIA">Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 16 de Bogota / OLIMPIA</option>
<option value="Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 26 de Bogota / Ecosystem">Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 26 de Bogota / Ecosystem</option>
<option value="Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 25 de Medellin / Signo360-Ecosystem">Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 25 de Medellin / Signo360-Ecosystem</option>
<option value="Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 43 de Bogota / GEAR">Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria 43 de Bogota / Gear</option>
<option value="Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria Unica de Cota / Autentic/ConNotar">Solicidud de los mismos resultados de los aliados tecnologicos de la Notaria Unica de Cota / Autentic/ConNotar</option>

<option value="Revisión de la OTI">Revisión de la OTI</option>
<option value="Resolución de permiso para la prestación del servicio público notarial a través de medios electrónicos">Resolución de permiso para la prestación del servicio público notarial a través de medios electrónicos</option>


<option value="Traslado de proveedor a SIGNO360">Traslado de proveedor a SIGNO360</option>
<option value="Traslado de proveedor a GEAR">Traslado de proveedor a GEAR</option>
<option value="Traslado de proveedor a AUTENTIC/ConNotar">Traslado de proveedor a AUTENTIC/ConNotar</option>
<option value="Traslado de proveedor a Ecosystem">Traslado de proveedor a Ecosystem</option>


</select>
<input type="file" value="" name="file" id="file" > 
<button type="submit" class="btn btn-xs btn-success">
Adjuntar</button>
</form>
<hr>

<form action="" method="POST" name="forr34542325m54435565461" >
<b>Resolución de autorización para la prestación del servicio público notarial a través de medios electrónicos:</b>
<br>
<input type="text" class="numero" name="resolucion_autorizacion" placeholder="Número resolución" value="<?php echo $row['resolucion_autorizacion']; ?>"> 
de <input type="text" class="datepicker" name="fecha_resolucion" placeholder="Fecha resolución" value="<?php echo $row['fecha_resolucion']; ?>">

<button type="submit" class="btn btn-xs btn-danger">
Actualizar</button>
</form>
<hr>
</div>
<div class="col-md-6">

<?php
$queryr = sprintf("SELECT * FROM doc_resp_val_not_digital where id_resp_val_not_digital=".$id." and estado_doc_resp_val_not_digital=1 order by id_doc_resp_val_not_digital"); 
$selectr = mysql_query($queryr, $conexion);
$rowr = mysql_fetch_assoc($selectr);
$totalRowsr = mysql_num_rows($selectr);
if (0<$totalRowsr){
	echo 'Adjuntos:<br>';
do {
echo '<a href="filesnr/digitalizacion/'.$rowr['url'].'" target="_blank">'.$rowr['nombre_doc_resp_val_not_digital'].'</a><br>';
	 } while ($rowr = mysql_fetch_assoc($selectr)); 
} else {}	 
mysql_free_result($selectr);
?>
</div>

</div>

 <br>
  <br>
 <br>
 <hr>
 <br>
 <center><b>Validación</b></center>
 <br>
 <form action="" method="POST" name="forr45435m54435565461">
 
 <div class="form-group text-left"> 			
<label  class="control-label"> Fecha de solicitud:</label> 
<input type="text" class="datepicker"  name="fecha_solicitud" value="<?php echo $row['fecha_solicitud']; ?>">
</div>
 <div class="form-group text-left"> 			
<label  class="control-label"> Fecha de validación:</label> 
<input type="text" class="datepicker"  name="fecha_validacion" value="<?php echo $row['fecha_validacion']; ?>">
</div>
<div class="form-group text-left"> 			
<label  class="control-label"> Hora:</label> 
<input type="text"  name="orden_cita" value="<?php echo $row['orden_cita']; ?>">
</div>

 <div class="form-group text-left"> 			
<label  class="control-label"> Información de la Cita:</label> 
<input type="text" style="width:100%" name="nombre_resp_val_not_digital" value="<?php echo $row['nombre_resp_val_not_digital']; ?>">
</div>

 <div class="form-group text-left"> 			
<label  class="control-label"> Dirección de la pagina web:</label> 
<input type="text" style="width:100%" name="url" value="<?php echo $row['url']; ?>">
</div>


 <div class="form-group text-left"> 			
<label  class="control-label"> Proveedor tecnológico:</label> 
<select name="proveedor">
<option selected><?php echo $row['proveedor']; ?></option>
<option>Signo360/Ecosystem</option>
<option>Signo360</option>
<option>Ecosystem</option>
<option>Olimpia</option>
<option>Gear</option>
<option>Autentic/ConNotar</option>
</select>
</div>



<hr>
<div class="form-group text-left"> 			
<label  class="control-label"> Lugar:</label> <textarea name="observacion1" style="width:100%"><?php echo $row['observacion1']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label"> Entidad solicitante:</label> 
<textarea name="observacion2" style="width:100%"><?php if (isset($row['observacion2'])) { echo $row['observacion2']; } else { echo $rownotaria; } ?></textarea></div>

<hr><div class="form-group text-left"> 
<label  class="control-label"> Representante de la entidad solicitante:</label> 
<textarea name="observacion3" style="width:100%"><?php  if (isset($row['observacion3'])) {  echo $row['observacion3']; } else { echo $rowname; } ?></textarea>

</div><hr><div class="form-group text-left"> 
<label  class="control-label"> Representante aliado tecnologico:</label> <textarea name="observacion4" style="width:100%"><?php echo $row['observacion4']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label"> Aliado tecnologico que presenta la prueba:</label><textarea name="observacion5" style="width:100%"><?php echo $row['observacion5']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label"> Servidores publicos:</label><textarea name="observacion6" style="width:100%"><?php echo $row['observacion6']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label"> Observaciones:</label><textarea name="observacion7" style="width:100%"><?php echo $row['observacion7']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">1 Verificar que la solución tecnológica de la notaría cuente con LOG de auditoria.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple8" value="<?php echo $row['cumple8']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion8" style="width:100%"><?php echo $row['observacion8']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">2 Verificar que la solución tecnológica de la notaría se encuentre en ambiente web y móvil.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple9" value="<?php echo $row['cumple9']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion9" style="width:100%"><?php echo $row['observacion9']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">3 Verificar que la solución tecnológica de la notaría presente la descripción de los tramites y requisitos para su realización, pasos a seguir, la tarifa por tramite y los medios de pago electrónicos.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple10" value="<?php echo $row['cumple10']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion10" style="width:100%"><?php echo $row['observacion10']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">4 Verificar que la solución tecnológica de la notaría establezca un Código Unico Acto Notarial Digital (CUANDI) para cada acto electrónico que se realice.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple11" value="<?php echo $row['cumple11']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion11" style="width:100%"><?php echo $row['observacion11']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">5 Si se utiliza el recurso de video llamada como medio de verificación en la rogación de un tramite notarial, su grabación y descarga. Se verificara el cumplimiento del numeral 9 del capítulo 5. Lineamientos Generales.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple12" value="<?php echo $row['cumple12']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion12" style="width:100%"><?php echo $row['observacion12']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">6 Verificar que la solución tecnológica de la notaría permita el uso de medios electrónicos para el pago de los derechos notariales. :</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple13" value="<?php echo $row['cumple13']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion13" style="width:100%"><?php echo $row['observacion13']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">7 Verificar que la solución tecnológica de la notaría permita que el usuario notarial envíe y cargue a la notaria los documentos necesarios para la ejecución del tramite notarial. :</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple14" value="<?php echo $row['cumple14']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion14" style="width:100%"><?php echo $row['observacion14']; ?></textarea></div><hr><div class="form-group text-left"> 
<!--<label  class="control-label">8 Verificar que la solución tecnológica de la notaría permita la Interoperabilidad con el repositorio de la SNR a traves de X-ROAD.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple15" value="<?php //echo $row['cumple15']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion15" style="width:100%"><?php //echo $row['observacion15']; ?></textarea></div><hr><div class="form-group text-left"> -->
<label  class="control-label">8 Verificar que la solución tecnológica de la notaría permita el acceso al repositorio notarial dispuesto por la SNR para el protocolo notarial.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple16" value="<?php echo $row['cumple16']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion16" style="width:100%"><?php echo $row['observacion16']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">9 Verificar que la solución tecnológica de la notaría permita el enrolamiento del Usuario del Servicio Digital Notarial, verificando la información contra el ANI de la RNEC.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple17" value="<?php echo $row['cumple17']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion17" style="width:100%"><?php echo $row['observacion17']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">10 Verificar que la solución tecnológica de la notaría permita en la autenticación de usuarios la verificación mediante el uso de doble factor.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple18" value="<?php echo $row['cumple18']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion18" style="width:100%"><?php echo $row['observacion18']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">11 Verificar que la solución tecnológica de la notaría permita en el enrolamiento el cargue de la información mínima requerida de obligatorio cumplimiento. Se verificara el cumplimiento del numeral 3 del capítulo 9.1.1.Registro - Enrolamiento.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple19" value="<?php echo $row['cumple19']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion19" style="width:100%"><?php echo $row['observacion19']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">12 Verificar que la solución tecnológica de la notaría permita en el enrolamiento el cargue de la información del departamento y municipio de domicilio segun la DIVIPOLA diseñada por DANE. Se verificara el cumplimiento del numeral 3 del capítulo 9.1.1.Registro - Enrolamiento.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple20" value="<?php echo $row['cumple20']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion20" style="width:100%"><?php echo $row['observacion20']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">13 Verificar que la solución tecnológica de la notaría permita en el enrolamiento la verificación del numero del celular mediante mensaje de texto, mensaje de correo ó llamada para confirmación.  :</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple21" value="<?php echo $row['cumple21']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion21" style="width:100%"><?php echo $row['observacion21']; ?></textarea></div><hr><div class="form-group text-left"> 
<!--<label  class="control-label">15 Verificar que la solución tecnológica de la notaría permita en el enrolamiento la verificación del correo electrónico mediante mensaje de correo para confirmación.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple22" value="<?php //echo $row['cumple22']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion22" style="width:100%"><?php //echo $row['observacion22']; ?></textarea></div><hr><div class="form-group text-left"> -->
<label  class="control-label">14 Verificar que la solución tecnológica de la notaría permita en el enrolamiento el almacenamiento de la fecha de registro del usuario y de la fecha de actualización del registro del usuario.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple23" value="<?php echo $row['cumple23']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion23" style="width:100%"><?php echo $row['observacion23']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">15 Verificar que la solución tecnológica de la notaría permita la creación y almacenamiento de contraseñas seguras y el doble factor.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple24" value="<?php echo $row['cumple24']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion24" style="width:100%"><?php echo $row['observacion24']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">16 Verificar que la solución tecnológica de la notaría permita durante el procedimiento de registro del usuario la aceptación expresa de los terminos y condiciones de uso y operación del servicio, la cual debe quedar almacenada para su posterior consulta.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple25" value="<?php echo $row['cumple25']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion25" style="width:100%"><?php echo $row['observacion25']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">17 Verificar que la solución tecnológica de la notaría permita que en el procedimiento de registro se le solicite al usuario la aceptación expresa del tratamiento de datos y habeas.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple26" value="<?php echo $row['cumple26']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion26" style="width:100%"><?php echo $row['observacion26']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">18 Verificar que la solución tecnológica de la notaría permita insertar en logs los intentos de identificación con mínimo los siguientes campos: tipo de documento, numero de documento, fecha y hora identificación, id metodo identificación, resultado identificación.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple27" value="<?php echo $row['cumple27']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion27" style="width:100%"><?php echo $row['observacion27']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">19 Verificar que la solución tecnológica de la notaría permita la aceptación de terminos y condiciones y la de tratamiento de datos personales, que debe ser firmada electrónicamente, junto con una estampa cronológica y numero unico de transacción.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple28" value="<?php echo $row['cumple28']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion28" style="width:100%"><?php echo $row['observacion28']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">20 Verificar que la solución tecnológica de la notaría de cumplimiento al capítulo 9.3 Verificación del Documento de Identificación.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple29" value="<?php echo $row['cumple29']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion29" style="width:100%"><?php echo $row['observacion29']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">21 Verificar que la solución tecnológica de la notaría permita la autenticación biometrica permitiendo la identificación del usuario del acto digital notarial. Se verificara el cumplimiento del capítulo 9.5. Autenticación Biometrica.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple30" value="<?php echo $row['cumple30']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion30" style="width:100%"><?php echo $row['observacion30']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">22 Verificar que la solución tecnológica de la notaría permita el uso de la Firma Electrónica por parte de Usuario del Servicio Digital Notarial.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple31" value="<?php echo $row['cumple31']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion31" style="width:100%"><?php echo $row['observacion31']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">23 Verificar que la solución tecnológica de la notaría permita el uso de la Firma Digital por Parte del Notario.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple32" value="<?php echo $row['cumple32']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion32" style="width:100%"><?php echo $row['observacion32']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">24 Verificar que la solución tecnológica de la notaría permita la Validación de la Geolocalización del notario al otorgamiento del acto notarial. :</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple33" value="<?php echo $row['cumple33']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion33" style="width:100%"><?php echo $row['observacion33']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">25 Verificar que la solución tecnológica de la notaría permita la Validación de la Geolocalización del usuario al otorgamiento del acto notarial. :</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple34" value="<?php echo $row['cumple34']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion34" style="width:100%"><?php echo $row['observacion34']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">26 Verificar que la solución tecnológica de la notaría permita la Validación de la Geolocalización del circulo notarial. :</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple35" value="<?php echo $row['cumple35']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion35" style="width:100%"><?php echo $row['observacion35']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">27 Verificar que la solución tecnológica de la notaría permita que los distintos usuarios solo tengan acceso a la información y funcionalidades acordes a su rol y llevar un registro de auditoría donde se pueda establecer la trazabilidad de las funcionalidades utilizadas en cada sesión de trabajo y sus modificaciones. Se realizara la prueba segun la definición de perfiles establecida por la notaria.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple36" value="<?php echo $row['cumple36']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion36" style="width:100%"><?php echo $row['observacion36']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">28 Verificar que la solución tecnológica de la notaría permita el uso Sello Digital Notarial.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple37" value="<?php echo $row['cumple37']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion37" style="width:100%"><?php echo $row['observacion37']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">29 Verificar que la solución tecnológica de la notaría utilice Estampado cronológico en la generación de documentos electrónicos.  :</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple38" value="<?php echo $row['cumple38']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion38" style="width:100%"><?php echo $row['observacion38']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">30 Adjuntar y verificar la existencia de la certificación de la actividad de Ethical Hacking realizada sobre la solución tecnológica de la notaria.  :</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple39" value="<?php echo $row['cumple39']; ?>"><br>Adjunto: <?php echo $row['hacking']; ?><br>Observación:<textarea name="observacion39" style="width:100%"><?php echo $row['observacion39']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">31 Adjuntar y verificar la existencia del informe de pruebas de carga y estres realizada sobre la solución tecnológica de la notaria.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple40" value="<?php echo $row['cumple40']; ?>"><br>Adjunto: <?php echo $row['carga']; ?><br>Observación:<textarea name="observacion40" style="width:100%"><?php echo $row['observacion40']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">32 Verificar que la solución tecnológica de la notaría permita la custodia del testamento cerrado de forma digital.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple41" value="<?php echo $row['cumple41']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion41" style="width:100%"><?php echo $row['observacion41']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">33 Verificar que la solución tecnológica de la notaría en el caso de generar comunicaciones o notificaciones electrónicas guarde la trazabilidad de las mismas, mediante la prueba de envío y entrega, y el sello de hora oficial.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple42" value="<?php echo $row['cumple42']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion42" style="width:100%"><?php echo $row['observacion42']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">34 Adjuntar resolución de autorización de operador biometrico y verificar que la solución tecnológica de la notaría acredita el cumplimiento de los requerimientos establecidos por la RNEC, demostrando que cuenta con el respaldo de un operador biometrico homologado.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple43" value="<?php echo $row['cumple43']; ?>"><br>Adjunto: <?php echo $row['biometrico']; ?><br>Observación:<textarea name="observacion43" style="width:100%"><?php echo $row['observacion43']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">35 Adjuntar auto-certificación del notario sobre el cumplimiento de las políticas y lineamientos tecnicos dictados conjuntamente por el Archivo General de la Nación y el Ministerio de Tecnologías de la Información y las Comunicaciones en la gestión de documentos y expedientes electrónicos en la solución tecnológica de la notaría implementada.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple44" value="<?php echo $row['cumple44']; ?>"><br>Adjunto: <?php echo $row['agn']; ?><br>Observación:<textarea name="observacion44" style="width:100%"><?php echo $row['observacion44']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">36 Verificar que la solución tecnológica de la notaría en el documento generado del tramite notarial digital, contenga como Los siguientes parametros digitales:
<br>Código CUANDI
<br>Firma digital por parte del notario
<br>Sello electrónico (Imagen que corresponde al sello físico del notario)
<br>Código QR
<br>Firma electrónica usuario
<br>Mecanismo opcional de identificación del operador (Opcional)
</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple45" value="<?php echo $row['cumple45']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion45" style="width:100%"><?php echo $row['observacion45']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">37 Verificar que la solución tecnológica de la notaría cuente con un módulo para el agendamiento de citas virtuales.:</label> <br>Cumple: <input type="text" placeholder="Si / No"  maxlength="2" name="cumple46" value="<?php echo $row['cumple46']; ?>"> &nbsp;  &nbsp;  &nbsp; Observación:<textarea name="observacion46" style="width:100%"><?php echo $row['observacion46']; ?></textarea></div><hr><div class="form-group text-left"> 
<label  class="control-label">Links de videos de la mesa de trabajo.:</label><textarea name="observacion47" style="width:100%"><?php echo $row['observacion47']; ?></textarea></div><hr>				



<button type="submit" class="btn btn-success" style="width:100%" >
<span class="glyphicon glyphicon-ok"></span> Guardar</button>
<br><br>
</Form>

<?php } else {} ?>




</DIV>
</DIV>
</DIV>		
</DIV>	




<?php } else { echo 'No tiene acceso, funcionalidad solo para Notarios.';} ?>



