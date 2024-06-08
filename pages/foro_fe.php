<?php
$nump75=privilegios(75,$_SESSION['snr']);
	
if (1==$_SESSION['rol'] or 0<$nump75 or 3==$_SESSION['snr_tipo_oficina']) { 
	
if (3==$_SESSION['snr_tipo_oficina']) {
$idnota=$_SESSION['id_vigilado'];
$query4h = sprintf("SELECT id_funcionario FROM notaria_facturacion where id_notaria=".$idnota." and estado_notaria_facturacion=1 limit 1"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
if (0<count($row4h)){
$idfun=intval($row4h['id_funcionario']);
} else { $idfun=0; }
$result4h->free();

	} else {
		
if (isset($_GET['i']) && 1==$_SESSION['rol']){
	$idfun=$_GET['i'];
} else {
	$idfun=$_SESSION['snr'];
}

		
	}
	
	?>
<div class="row">
 <div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body">
<h3>Preguntas frecuentes
&nbsp; &nbsp; &nbsp; &nbsp; <img src="images/youtube.fw.png" style="width:25px;height:25px;"> <a href="https://sisg.supernotariado.gov.co/documentos/Manual_FE.html" target="_blank">Manual de facturación electrónica</a>

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <a href="documentos/Manual_SIN.pdf" target="_blank">Manual de SIN</a> 

</h3>
<br>1. <b>Que tipo de firma digital se debe usar:</b> Firma digital con extensión .p12 <a href="https://youtu.be/24YdLokjwq4" target="_blank">(Ver como se realiza conversión)</a>
<br>2. <b>Que caracteristicas debe tener mi pc:</b> Leer la <a href="https://sisg.supernotariado.gov.co/files/snrcirculares/0c5bed6293eadf5a66e970054f6944fc.pdf" target="_blank">circular 5111 de 2017</a>
<br>3. <b>Cual es el link de acceso de la DIAN para pruebas - habilitación:</b> <a href="https://catalogo-vpfe-hab.dian.gov.co/User/PersonLogin" target="_blank">https://catalogo-vpfe-hab.dian.gov.co/User/PersonLogin</a>
<br>4. <b>Cual es el link de acceso de la DIAN para PRODUCCIÓN:</b> <a href="https://catalogo-vpfe.dian.gov.co/User/PersonLogin" target="_blank">https://catalogo-vpfe.dian.gov.co/User/PersonLogin</a>
<br>5. <b>Como se pasa de pruebas - "habilitación" a producción:</b> Asociando prefijos en el ambiente de producción de la DIAN. (<a href="https://youtu.be/i9L-4r9uz6U" target="_blank">Ver manual - Paso a producción</a>)
<br>6. <b>El computador de la Notaria debe tener IP fija:</b> Si, dado que el sistema tiene configurada la IP de la base de datos; en ese sentido la ip debe ser fija.
<br>7. <b>Para usar facturación electrónica por CONTINGENCIA debo utilizar un prefijo:</b> Si, debe colocar en el formulario de la DIAN - MUISCA el prefijo <b>FEC</b>  para facturas por contingencia. El manual describe como.
<br>8. <b>Las facturas electrónicas por contingencia tienen CUFE:</B> No, El servicio de la DIAN para facturas por contingencia no emite dicho parametro.<br>
</div> 
</div> 
</div> 
</div>  


<?php

if (0<$idfun) {
	
	
if (isset($_POST['message']) && ""!=$_POST['message']) {

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$tamano_archivo=11534336;
$formato_archivo = array('png');
$directoryftp="filesnr/fe/";

$ruta_archivo = $identi;

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
  $nombrebre_orig= ucwords($nombrefile);
  
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
 
 

	//echo $_POST["message"];
$insertSQL = sprintf("INSERT INTO foro_fe (nombre_foro_fe,
id_tipo_oficina, id_notaria, id_funcionario, fecha_foro_fe, tipo_foro_fe, grupo_fe, file, estado_foro_fe) 
 VALUES (%s, %s, %s, %s, now(), %s, %s, %s, %s)", 
GetSQLValueString($_POST["message"], "text"), 
GetSQLValueString($_SESSION['snr_tipo_oficina'], "int"), 
GetSQLValueString($idnota, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST['tipo_foro_fe'], "int"), 
GetSQLValueString($idfun, "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

} else {}
?>
   <!-- Direct Chat -->
      <div class="row">
        <div class="col-md-4">
          <!-- DIRECT CHAT PRIMARY -->
          <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ayuda - Instalación</h3>

              <div class="box-tools pull-right">
                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Email" data-widget="chat-pane-toggle">
                  <i class="fa fa-comments"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages" style="min-height:600px;"><!--min-height:900px; -->
                <!-- Message. Default to the left -->
<?php
if (isset($_GET['i']) && 1==$_SESSION['rol']) {
	$i=$_GET['i'];
	$fun=" and foro_fe.grupo_fe=".$i."";
} else {
	$fun=" and foro_fe.grupo_fe=".$idfun." ";
} 



$query4="SELECT id_foro_fe, notaria.id_notaria, file, nombre_notaria, id_tipo_oficina, fecha_foro_fe, nombre_foro_fe 
FROM foro_fe 
LEFT JOIN notaria 
ON foro_fe.id_notaria = notaria.id_notaria 
where tipo_foro_fe=1 and estado_foro_fe=1 ".$fun." order by id_foro_fe;
";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
if (3==$row['id_tipo_oficina']) {

?>
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left"><a href="notaria&<?php echo $row['id_notaria']; ?>.jsp" target="_blank"><?php echo $row['nombre_notaria']; ?></a>
					<?php
					if (1==$_SESSION['snr_tipo_oficina']) {
						echo ' <a style="color:#B40404;" href="factura_notariado/'.$row['id_notaria'].'.json" target="_blank" >Config</a>';
					} else {}
					?>
					</span>
                    <span class="direct-chat-timestamp pull-right"><?php echo $row['fecha_foro_fe']; ?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="images/notaria.png" alt="Notaria"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                  <?php echo $row['nombre_foro_fe']; 
				  
if (isset($row['file']) && ""!=$row['file']) {
			echo ' <a href="filesnr/fe/'.$row['file'].'" target="blank" style="color:#B40404;"><i class="fa fa-file-image-o"></i></a>';
} else { }
  ?>
                  </div>
                </div>

<?php } else if (1==$row['id_tipo_oficina']) { ?>

                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">SuperNotariado</span>
                    <span class="direct-chat-timestamp pull-left"><?php echo $row['fecha_foro_fe']; ?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="images/snr_logo.png" alt="SNR"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    <?php echo $row['nombre_foro_fe']; 
if (isset($row['file']) && ""!=$row['file']) {
			echo ' <a href="filesnr/fe/'.$row['file'].'" target="blank" style="color:#B40404;"><i class="fa fa-file-image-o"></i></a>';
} else { }

if (1==$_SESSION['rol'] or 0<$nump75) {
			echo ' <a class="borrar_f" name="foro_fe" id="'.$row['id_foro_fe'].'" style="color:#ccc;cursor: pointer;" title="Borrar"><i class="fa fa-trash"></i></a>';
} else { }




?>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
	
				<?php
} else {}
}
$result->free();
 ?>
	
				
              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here -->
              <div class="direct-chat-contacts">
                <ul class="contacts-list">
                  <li>
                    <a href="">
                      <img class="contacts-list-img" src="images/snr_logo.png" alt="SNR">

                      <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Soporte
                              <small class="contacts-list-date pull-right">SNR</small>
                            </span>
                        <span class="contacts-list-msg">soporte.sin@supernotariado.gov.co</span>
                      </div>
                      <!-- /.contacts-list-info -->
                    </a>
                  </li>
                  <!-- End Contact Item -->
                </ul>
                <!-- /.contatcts-list -->
              </div>
              <!-- /.direct-chat-pane -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <form action="" method="post" name="545465456e545" enctype="multipart/form-data">
                <div class="input-group">
                  <input type="text" name="message" id="men1" maxlength="250" placeholder="Mensaje...." class="form-control">
 
 <script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.png)$/i;
	
	var fsize = 1000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension de imagen: .png');
        fileInput.value = '';
        return false;
		
		
    }else{
  
  if  (siezekiloByte < fsize){
	  
	   if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
	  
} else {
	alert('Debe ser inferior a 1000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>
 <input type="file" name="file" id="file" title="Subir impresion de pantalla en formato de imagen PNG" onchange="return fileValidation()" 
 style="width:80%; background:#fff; color:#bbb;
  height:12px;font-size:7px;">				   
				   <input type="hidden" name="tipo_foro_fe" value="1">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Enviar</button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- DIRECT CHAT SUCCESS -->
          <div class="box box-success direct-chat direct-chat-success">
            <div class="box-header with-border">
              <h3 class="box-title">Ayuda -  Configuración</h3>

              <div class="box-tools pull-right">
                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                  <i class="fa fa-comments"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages"  style="min-height:600px;">
                <!-- Message. Default to the left -->
                
                <?php

$query4="
SELECT id_foro_fe, notaria.id_notaria, file, nombre_notaria, id_tipo_oficina, fecha_foro_fe, nombre_foro_fe 
FROM foro_fe LEFT JOIN notaria 
ON foro_fe.id_notaria = notaria.id_notaria 
where tipo_foro_fe=2 and estado_foro_fe=1 ".$fun." order by id_foro_fe;
";
//$query4="SELECT id_notaria, id_tipo_oficina, fecha_foro_fe, nombre_foro_fe  from foro_fe where tipo_foro_fe=1 and estado_foro_fe=1 order by id_foro_fe";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
if (3==$row['id_tipo_oficina']) {

?>
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
					<span class="direct-chat-name pull-left"><a href="notaria&<?php echo $row['id_notaria']; ?>.jsp" target="_blank"><?php echo $row['nombre_notaria']; ?></a>
					<?php
					if (1==$_SESSION['snr_tipo_oficina']) {
						echo ' <a style="color:#B40404;" href="factura_notariado/'.$row['id_notaria'].'.json" target="_blank" >Config</a>';
					} else {}
					?>
					</span>
					
					<span class="direct-chat-timestamp pull-right"><?php echo $row['fecha_foro_fe']; ?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="images/notaria.png" alt="Notaria"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                  <?php echo $row['nombre_foro_fe']; 				  
if (isset($row['file']) && ""!=$row['file']) {
			echo ' <a href="filesnr/fe/'.$row['file'].'" target="blank" style="color:#B40404;"><i class="fa fa-file-image-o"></i></a>';
} else { }



?>
                  </div>
                </div>

<?php } else if (1==$row['id_tipo_oficina']) { ?>

                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">SuperNotariado</span>
                    <span class="direct-chat-timestamp pull-left"><?php echo $row['fecha_foro_fe']; ?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="images/snr_logo.png" alt="SNR"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    <?php echo $row['nombre_foro_fe']; 				  
if (isset($row['file']) && ""!=$row['file']) {
			echo ' <a href="filesnr/fe/'.$row['file'].'" target="blank" style="color:#B40404;"><i class="fa fa-file-image-o"></i></a>';
} else { }

if (1==$_SESSION['rol'] or 0<$nump75) {
			echo ' <a class="borrar_f" name="foro_fe" id="'.$row['id_foro_fe'].'" style="color:#ccc;cursor: pointer;" title="Borrar"><i class="fa fa-trash"></i></a>';
} else { }

?>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
	
				<?php
} else {}
}
$result->free();
 ?>
                <!-- /.direct-chat-msg -->
              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here -->
              <div class="direct-chat-contacts">
                <ul class="contacts-list">
                  <li>
                    <a href="">
                      <img class="contacts-list-img" src="images/snr_logo.png" alt="SNR">

                      <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Soporte
                              <small class="contacts-list-date pull-right">SNR</small>
                            </span>
                        <span class="contacts-list-msg">soporte.sin@supernotariado.gov.co</span>
                      </div>
                      <!-- /.contacts-list-info -->
                    </a>
                  </li>
                  <!-- End Contact Item -->
                </ul>
                <!-- /.contatcts-list -->
              </div>
              <!-- /.direct-chat-pane -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
          <form action="" method="post" name="54544223465456e545" enctype="multipart/form-data">
                <div class="input-group">
                 <input type="text" name="message" id="men2" maxlength="250" placeholder="Mensaje...." class="form-control">
				 
 <script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.png)$/i;
	
	var fsize = 1000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension de imagen: .png');
        fileInput.value = '';
        return false;
		
		
    }else{
  
  if  (siezekiloByte < fsize){
	  
	   if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
	  
} else {
	alert('Debe ser inferior a 1000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>
 <input type="file" name="file" id="file" title="Subir impresion de pantalla en formato de imagen PNG" onchange="return fileValidation()" 
 style="width:80%; background:#fff; color:#bbb;
  height:12px;font-size:7px;">	
				 <input type="hidden" name="tipo_foro_fe" value="2">
					<span class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-flat">Enviar</button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- DIRECT CHAT WARNING -->
          <div class="box box-warning direct-chat direct-chat-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Uso del sistema</h3>

              <div class="box-tools pull-right">
             
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                  <i class="fa fa-comments"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages"  style="min-height:600px;">
                <!-- Message. Default to the left -->
                
            <?php

$query4="
SELECT id_foro_fe, notaria.id_notaria, file, nombre_notaria, id_tipo_oficina, fecha_foro_fe, nombre_foro_fe 
FROM foro_fe LEFT JOIN notaria 
ON foro_fe.id_notaria = notaria.id_notaria 
where tipo_foro_fe=3 and estado_foro_fe=1 ".$fun."  order by id_foro_fe;
";
//$query4="SELECT id_notaria, id_tipo_oficina, fecha_foro_fe, nombre_foro_fe  from foro_fe where tipo_foro_fe=1 and estado_foro_fe=1 order by id_foro_fe";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
if (3==$row['id_tipo_oficina']) {

?>
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                   <span class="direct-chat-name pull-left"><a href="notaria&<?php echo $row['id_notaria']; ?>.jsp" target="_blank"><?php echo $row['nombre_notaria']; ?></a>
					<?php
					if (1==$_SESSION['snr_tipo_oficina']) {
						echo ' <a style="color:#B40404;" href="factura_notariado/'.$row['id_notaria'].'.json" target="_blank" >Config</a>';
					} else {}
					?>
					</span>
				   <span class="direct-chat-timestamp pull-right"><?php echo $row['fecha_foro_fe']; ?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="images/notaria.png" alt="Notaria"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                  <?php echo $row['nombre_foro_fe']; 				  
if (isset($row['file']) && ""!=$row['file']) {
			echo ' <a href="filesnr/fe/'.$row['file'].'" target="blank" style="color:#B40404;"><i class="fa fa-file-image-o"></i></a>';
} else { }?>
                  </div>
                </div>

<?php } else if (1==$row['id_tipo_oficina']) { ?>

                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">SuperNotariado</span>
                    <span class="direct-chat-timestamp pull-left"><?php echo $row['fecha_foro_fe']; ?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="images/snr_logo.png" alt="SNR"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    <?php echo $row['nombre_foro_fe']; 				  
if (isset($row['file']) && ""!=$row['file']) {
			echo ' <a href="filesnr/fe/'.$row['file'].'" target="blank" style="color:#B40404;"><i class="fa fa-file-image-o"></i></a>';
} else { }

if (1==$_SESSION['rol'] or 0<$nump75) {
			echo ' <a class="borrar_f" name="foro_fe" id="'.$row['id_foro_fe'].'" style="color:#ccc;cursor: pointer;" title="Borrar"><i class="fa fa-trash"></i></a>';
} else { }
?>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
	
				<?php
} else {}
}
$result->free();
 ?>
 
                <!-- /.direct-chat-msg -->
              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here -->
              <div class="direct-chat-contacts">
                <ul class="contacts-list">
                  <li>
                    <a href="">
                      <img class="contacts-list-img" src="images/snr_logo.png" alt="SNR">

                      <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Soporte
                              <small class="contacts-list-date pull-right">SNR</small>
                            </span>
                        <span class="contacts-list-msg">soporte.sin@supernotariado.gov.co</span>
                      </div>
                      <!-- /.contacts-list-info -->
                    </a>
					
                  </li>
                  <!-- End Contact Item -->
                </ul>
                <!-- /.contatcts-list -->
              </div>
              <!-- /.direct-chat-pane -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <form action="" method="post" name="54567465456e76677545" enctype="multipart/form-data">
                <div class="input-group">
                 <input type="text" name="message" id="men3" maxlength="250" placeholder="Mensaje...." class="form-control">
 <script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.png)$/i;
	
	var fsize = 1000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension de imagen: .png');
        fileInput.value = '';
        return false;
		
		
    }else{
  
  if  (siezekiloByte < fsize){
	  
	   if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
	  
} else {
	alert('Debe ser inferior a 1000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>
 <input type="file" name="file" id="file" title="Subir impresion de pantalla en formato de imagen PNG" onchange="return fileValidation()" 
 style="width:80%; background:#fff; color:#bbb;
  height:12px;font-size:7px;">					
				<input type="hidden" name="tipo_foro_fe" value="3">
				 <span class="input-group-btn">
                        <button type="submit" class="btn btn-warning btn-flat">Enviar</button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>
        <!-- /.col -->


      </div>
	  <?php } else { echo '<h3>No se ha asignado la Notaria para que tenga soporte.</h3>'; } ?>
<?php } else {} ?>