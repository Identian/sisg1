<?php
$nump37=privilegios(37,$_SESSION['snr']);
/*viejo
$hostname_conexion2="192.168.80.12";
$database_conexioncc = "mibew";
$username_conexioncc = "chat";
$password_conexioncc = "SNRadmin2018";
*/

$hostname_conexion2="192.168.80.13";
$database_conexioncc = "prdchat";
$username_conexioncc = "chatsnr";
$password_conexioncc = "CHATadmin2021";





global $mysqlichat;
$mysqlichat = new mysqli($hostname_conexion2, $username_conexioncc, $password_conexioncc, $database_conexioncc);
if (mysqli_connect_errno()) {
    printf("Error de acceso,  Ingresar directamente a: https://servicios.supernotariado.gov.co/Chat/operator/login ", $mysqlichat->connect_error);
    exit();
}



function cantidaddechat($info) {
global $mysqlichat;
//$query4 = sprintf("SELECT count(threadid) as contadorac FROM thread"); 
$query4 = sprintf("select COUNT(threadid) as contadorac FROM thread WHERE thread.agentid!=0 and thread.agentid!=1");  

$result4 = $mysqlichat->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contadorac'];
return $res;
$result4->free();
}



function cantidaddeoperadores($info2) {
global $mysqlichat;
$query4 = sprintf("SELECT count(operatorid) as contadorop FROM operator"); 
$result4 = $mysqlichat->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contadorop'];
return $res;
$result4->free();
}









function listado($info) {	
global $mysqlichat;
$query = "SELECT * FROM operator, operatortoopgroup where operatortoopgroup.groupid=1 and operatortoopgroup.operatorid=operator.operatorid";
$result = $mysqlichat->query($query);
while ($obj = $result->fetch_array()) {
	
        printf ("<tr><td>%s</td><td>%s</td><td><a href='usuario&%s.jsp'>Ver perfil</td><td><a href='https://servicios.supernotariado.gov.co/Chat/operator/' target='_blank'>Acceder al chat</td></tr>", $obj['vclocalename'], $obj['vclogin'],  $obj['code']);
    }

$result->free();
}




function nuevomensaje($titul, $text) {
global $mysqlichat;
$query4g = "INSERT INTO cannedmessage (locale, vctitle, vcvalue) VALUES ('es', '$titul', '$text')"; 
$result4g = $mysqlichat->query($query4g);
$resok='';
return $resok;
$result4g->free();
}




function eliminarmensaje($del) {
global $mysqlichat;
$del1=intval($del);
$query4g1 = "DELETE FROM cannedmessage WHERE id =".$del1; 
$result4g1 = $mysqlichat->query($query4g1);
$resok1='';
return $resok1;
$result4g1->free();
}

if (isset($_GET['i']) && ""!=$_GET['i'] && (1==$_SESSION['rol'] or 0<$nump37)) {
	echo eliminarmensaje($_GET['i']);
} else {}


function mensajespordefecto() {	
global $mysqlichat;
$query = "SELECT * FROM cannedmessage";
$result = $mysqlichat->query($query);
$num2=0;
while ($obj = $result->fetch_array()) {
	$num2=$num2+1;
	
        printf ('<tr><td style="min-width:200px;">%s. %s</td><td>%s</td>
		
		<td><a href="chat&%s.jsp" style="color:#ff0000;" class="confirmationdel" title="Borrar"><span class="glyphicon glyphicon-trash"></span></a></td>
		
		
		</tr>', $num2, utf8_encode($obj['vctitle']),  utf8_encode($obj['vcvalue']), $obj['id']);
    }

$result->free();
}




function mensajeschat($infofecha) {	
global $mysqlichat;
$query = "SELECT * FROM thread";
$result = $mysqlichat->query($query);
while ($obj = $result->fetch_array()) {
	$reald2=$obj['dtmcreated'];
	$al = date('Y-m-d', $obj['dtmcreated']);
	$alwet = date('Y-m-d H:i', $obj['dtmcreated']).'-'.$reald2.'';
	if ($infofecha==$al) {
        printf ('<tr><td>%s</td><td>%s</td><td>%s</td><td><a href="" class="buscar_chat" id="%s" data-toggle="modal" data-target="#popupcorrespondencia">Conversación</a></td></tr>', utf8_encode($obj['username']), $obj['agentname'], $alwet, $obj['threadid']);
	} else {}
    }

$result->free();
}


							        

function mensajessinchat($infofecha2) {	
global $mysqlichat;
$queryw = "select thread.threadid, message.tmessage, thread.dtmcreated from thread, message 
where thread.threadid=message.threadid and thread.agentname is NULL group by thread.threadid";
$resultw = $mysqlichat->query($queryw);
while ($objw = $resultw->fetch_array()) {
$idchatres=$objw['threadid'];
	$reald=$objw['dtmcreated'];
	$alw = date('Y-m-d', $objw['dtmcreated']);
	$alwe = date('Y-m-d H:i', $objw['dtmcreated']).'-'.$reald.'';
	$text=utf8_encode($objw['tmessage']);
	if ($infofecha2==$alw) {
		$resultadochat=existenciaunica('respuesta_chat','id_chat',$idchatres);
		
        printf ('<tr><td style="max-width:420px;">%s</td><td>Sin responder en Chat</td><td>%s</td>
		<td>%s</td><td><a href="" class="buscar_chat" id="%s" data-toggle="modal" data-target="#popupcorrespondencia">Solicitud</a></td></tr>',
		utf8_encode($objw['tmessage']), $alwe, $resultadochat, $idchatres);
	} else {}
    }

$resultw->free();

}





if (isset($_POST['mensaje']) && ""!=$_POST['mensaje']) {

if (isset($_FILES['filet']['name']) && ""!=$_FILES['filet']['name']) {

//$tamano_archivo=11534336;
$tamano_archivo=5767168;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp3="files/chat/";

$ruta_archivo = $identi;

$archivo = $_FILES['filet']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['filet']['size'];
$nombrefile = strtolower($_FILES['filet']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if ('pdf'==$extension)  { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp3.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
    
$filesc='https://servicios.supernotariado.gov.co/files/chat/'.$identi.'.pdf';
   
  } else {
$filesc='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
  }
} else { 
$filesc='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}
		
	
} else { 
$filesc='';	
	}
	
	





$mensaje=utf8_decode($_POST['mensaje']);

if (isset($_POST['valormensaje']) && ""!=$_POST['valormensaje']) {
$valormensaje=utf8_decode($_POST['valormensaje']).' ';
} else {
$valormensaje='';
}
$valormensajefile=$valormensaje.$filesc;

echo nuevomensaje($mensaje, $valormensajefile);
echo $insertado;
} else {}







if (isset($_POST['respuestachat']) && ""!=$_POST['respuestachat']) {
//echo enviomail($_POST['correoa'],$_POST['idchat'],$_POST['respuestachat']);

$mailc=$_POST['correoa'];
$idchat3=$_POST['idchat'];
$descchat3=$_POST['respuestachat'];

$insertSQLhh = sprintf("INSERT INTO respuesta_chat (id_chat, email_chat, nombre_respuesta_chat, fecha_chat, estado_respuesta_chat) VALUES
 (%s, %s, %s, now(), %s)", 
GetSQLValueString($idchat3, "int"), 
GetSQLValueString($mailc, "text"), 
GetSQLValueString($descchat3, "text"), 
GetSQLValueString(1, "int"));
$Resulthh = mysql_query($insertSQLhh, $conexion);



$subject = 'Respuesta a mensaje del Chat de la SNR';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= $descchat3; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($mailc,$subject,$cuerpo2,$cabeceras);

echo '<div class="alert aviso" style="background:#4BA75B;color:#fff;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Mensaje enviado</div>';
 
 
} else {}


?>

 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo mensaje o documento</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="foewrewr543543m1" enctype="multipart/form-data">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Asunto (Máximo 100 caracteres):</label> 
<input type="text" class="form-control" name="mensaje" class="mayuscula" required maxlength="100">
</div>
<div class="form-group text-left"> 
<label  class="control-label"> Texto (Máximo 1024 caracteres):</label> <!-- id="texto_requerir"-->
<textarea class="form-control" name="valormensaje" maxlength="1024">
</textarea>
</div>
<script>
function fileValidation(){
    var fileInput = document.getElementById('filet');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension .pdf.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
</script>
<div class="form-group text-left"> 
<label  class="control-label">Documento (Solo pdf): <div id="imagePreview"></div></label> 
<input type="file" class="form-control" name="filet" id="filet" onchange="return fileValidation()" >
</div>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="resoluciondatos">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div></form>


      </div>
    </div>
  </div>
</div>







<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3><?php echo cantidaddechat(1);
 ?>
 </h3>

              <p>Comunicaciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> 
<?php echo cantidaddeoperadores(1); ?>
</h3>

              <p>Operadores</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer" >Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
<span class="fa fa-wechat"></span>
</h3>

              <p>Probar Chat para ciudadanos</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
			
            <a href="https://servicios.supernotariado.gov.co/Chat/index.php/chat" target="_blank" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3>
<span class="fa fa-file"></span>
</h3>
              <p>Reporte completo</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="reportechat/reporte.xls" target="_blank" class="small-box-footer" >Reporte. <i class="fa fa-arrow-circle-right"></i></a>
			
			
			
			
          </div>
        </div>
		
	 
      </div>







<div class="row">
 <div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-body">
<h3>CHATBOT
</h3>

<?PHP
$nump148=privilegios(148,$_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump148) {
function token($iduser){
  
    $url2='http://192.168.210.130:2020';
	 $url='https://servicios.supernotariado.gov.co/chatbot/web';
    $llave = '7df9fb99dfff4b3ec65a16366a9510ef'; 
    $cabecera = array('typ' => 'JWT', 'alg' => 'HS256');
    $cabecera = json_encode($cabecera);
    $cabecera = base64_encode($cabecera);
    $data = array('admin'=>'1', 'iss' => 'SNR', 'id_funcionario' => '2319', 'nombre_funcionario' => 'SlVBTiBDQVJMT1MgUkFNSVJFWiBHT01FWg==', 'correo'=>'and@snr.co');
    $data = json_encode($data);
    $data = base64_encode($data);
    $firma = hash_hmac('sha256', "$cabecera.$data", $llave);
    $token = "$cabecera.$data.$firma";


   $final= '<form action="'.$url.'/token/generate" method="post" target="_blank">
            <input type="hidden" name="token" value="'.$token.'" />
            <input type="submit" value="Acceder" class="btn btn-xs " style="width:50%;background:#555;color:#fff;">
            </form>'; 
return $final;
			
}
echo token($_SESSION['snr']);
} else {}
?>
<!--410010004 SELECCIONAR:  "Enviar de todos modos."  http://192.168.210.130:2020/-->
<hr>
<a href="https://servicios.supernotariado.gov.co/chatbot/" TARGET="_blank" class="btn btn-xs btn-danger">PROBAR CHATBOT</a>



<!--
<div style="text-align:right">
<a href="" target="blank" class="btn btn-success">
<span class=""></span>Probar el Chat</a>

<a href="" target="blank" class="btn btn-warning">
<span class=""></span>Administrar el Chat</a>
</div>


<div style="width:100%;height:200px;">
<canvas id="chartjs-7" class="chartjs" style="width:100%;height:200px;">
</canvas></div>-->

<hr>
<HR>

<h3>CHAT OPERADORES</h3>
<table class="table">

<?php echo listado('1'); ?> 
</table>



<hr>

<h3>RESPUESTAS AUTOMÁTICAS Y ARCHIVOS ADJUNTOS</h3>
<?php if (1==$_SESSION['rol'] or 0<$nump37) { ?>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo </button> Recuerde que son maximo 60 mensajes. Puede eliminar anteriores.<?php } ?>
<table class="table">
<tr><td><b>ASUNTO</b></td><td><B>MENSAJE</B></td></tr>
<?php echo mensajespordefecto(); ?> 
</table>




<hr>

	<h3>COMUNICACIONES (<?php  
	if (isset($_POST['fecha_chat'])) {
	$realdate2=$_POST['fecha_chat'];
} else {
	$realdate2= date("Y-m-d");
}
	
	 echo $realdate2; ?>)</h3>
		<div class="row">
		<div class="col-md-7">
		

			
			
		
		</div>
			<div class="col-md-5">
			<form action="" method="post" name="4334345435">
			<input type="text" class="datepicker" name="fecha_chat" value="<?php echo $realdate2; ?>" readonly="readonly">
			<button type="submit" class="btn btn-xs btn-success" >Buscar por fecha</button> 
			</form>
			</div>
		</div>
	
<table class="table">
<tr>
<th>Ciudadano</th><th>Operador</th><th>Fecha</th><th></th>
</tr>
<?php 
echo mensajeschat($realdate2); ?> 
</table>
<hr>
		<?php
//$date_input = getDate(strtotime($realdate2)); 
//echo $date_input[0];  
?>

		<b>Reporte del chat</b>
<form action="chatxls/chat.xls" method="post" name="4365465434345435" target="_blank">
			<input type="text" class="datepicker" name="fecha_inicio" value="" readonly="readonly">
			<input type="text" class="datepicker" name="fecha_fin" value="" readonly="readonly">
			<button type="submit" class="btn btn-xs btn-success" >Descargar</button> 
			</form>


<hr>
<form action="" method="post" name="43FDS34345435">
	<h3>COMUNICACIONES SIN RESPONDER EN  EL CHAT(<?php  echo $realdate2; ?>)</h3>
		<div class="row">
		<div class="col-md-7">
		</div>
			<div class="col-md-5">
			<input type="text" class="datepicker" name="fecha_chat" value="" readonly="readonly">
			<button type="submit" class="btn btn-xs btn-success" >Buscar por fecha</button> 
			</div>
		</div>
	</form>
<table class="table">
<tr>
<th>Correo</th><th>Estado</th><th>Fecha</th><th>Respuestas</th><th></th>
</tr>
<?php 
echo mensajessinchat($realdate2); ?> 
</table>

</div>
</div>
</div>
</div>



<div class="modal fade bd-example-modal-lg" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Conversación de chat</label></h4>
			</div> 
			<div class="ver_conversacion_chat" class="modal-body"> 

			</div>
		</div> 
	</div> 
</div> 








