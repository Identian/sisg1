<?php
if (isset($_GET['i']) && "" != $_GET['i']) {
$id = $_GET['i'];


$nump=privilegios(4,$_SESSION['snr']);
$numpose=privilegios(5,$_SESSION['snr']);
$nump6=privilegios(6,$_SESSION['snr']);
$nump51=privilegios(51,$_SESSION['snr']);
$nump52=privilegios(52,$_SESSION['snr']);
$nump53=privilegios(53,$_SESSION['snr']);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1") && (0<$numpose or 1==$_SESSION['rol'])) {
 $updateSQL = sprintf("UPDATE posesion_notaria SET forma_ingreso=%s, fecha_inicio=%s, acto_nombramiento=%s, numero_nombramiento=%s, fecha_nombramiento=%s, nominador=%s, acto_confirmacion=%s, acto_conf_numero=%s, acto_conf_fecha=%s, acto_conf_autoridad=%s, acta_pose_numero=%s, acto_pose_fecha=%s, acto_pose_f_fiscales=%s, fecha_rec_notaria=%s, causal_retiro=%s, fecha_retiro=%s, fecha_fin=%s, autoridad_ret=%s, t_doc_ret=%s, n_doc_ret=%s, fecha_doc_ret=%s, n_acta_entrega=%s WHERE id_posesion_notaria=%s",

                       GetSQLValueString($_POST['forma_ingreso'], "text"),
 
                       GetSQLValueString($_POST['fecha_inicio'], "date"),
                       GetSQLValueString($_POST['acto_nombramiento'], "text"),
                       GetSQLValueString($_POST['numero_nombramiento'], "int"),
                       GetSQLValueString($_POST['fecha_nombramiento'], "date"),
                       GetSQLValueString($_POST['nominador'], "text"),
                       GetSQLValueString($_POST['acto_confirmacion'], "text"),
                       GetSQLValueString($_POST['acto_conf_numero'], "int"),
                       GetSQLValueString($_POST['acto_conf_fecha'], "date"),
                       GetSQLValueString($_POST['acto_conf_autoridad'], "text"),
                       GetSQLValueString($_POST['acta_pose_numero'], "int"),
                       GetSQLValueString($_POST['acto_pose_fecha'], "date"),
                       GetSQLValueString($_POST['acto_pose_f_fiscales'], "date"),
                       GetSQLValueString($_POST['fecha_rec_notaria'], "date"),
                       GetSQLValueString($_POST['causal_retiro'], "text"),
                       GetSQLValueString($_POST['fecha_retiro'], "date"),
                       GetSQLValueString($_POST['fecha_fin'], "date"),
                       GetSQLValueString($_POST['autoridad_ret'], "text"),
                       GetSQLValueString($_POST['t_doc_ret'], "text"),
                       GetSQLValueString($_POST['n_doc_ret'], "int"),
                       GetSQLValueString($_POST['fecha_doc_ret'], "date"),
                       GetSQLValueString($_POST['n_acta_entrega'], "int"),
             GetSQLValueString($_POST['id_posesion_notaria'], "int"));
             


  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
echo $actualizado;
}







if (isset($_POST['personal']) && isset($_POST['insumos']) && isset($_POST['otros'])) {






if (isset($_FILES['filet']['name']) && ""!=$_FILES['filet']['name']) {

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');

$directoryftp3="filesnr/reactivacion_orip/";

$ruta_archivo = 'orip-'.$_SESSION['snr'].'-'.date("YmdGis");

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
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp3.$files);
  //chmod($files,0777);
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
  
  
  
  
$otrosv='';
if (isset($_POST['tecnologia'])){
$otrosv.='. Copiado por correo a Tecnologia, ';
} else {}
	
if (isset($_POST['infraestructura'])){
$otrosv.='. Copiado por correo a Infraestructura, ';
} else {}

if (isset($_POST['capacitacion'])){
$otrosv.='. Copiado por correo a Capacitación, ';
} else {}

if (isset($_POST['ente_territorial'])){
$otrosv.='. Copiado por correo a la Regional. ';
} else {}

$otros=$_POST["obs_otros"].$otrosv;

$insertSQL = sprintf("INSERT INTO reactivacion_orip (
	id_oficina_registro, 
	fecha_reactivacion_orip, 
	personal, 
	obs_personal, 
	mail_personal, 
	insumos, 
	obs_insumos, 
	mail_insumos, 
	otros, 
	obs_otros, 
	mail_otros, 
	soporte, 
	estado_reactivacion_orip) VALUES (%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["personal"], "text"), 
GetSQLValueString($_POST["obs_personal"], "text"), 
GetSQLValueString($_POST["mail_personal"], "text"), 
GetSQLValueString($_POST["insumos"], "text"), 
GetSQLValueString($_POST["obs_insumos"], "text"), 
GetSQLValueString($_POST["mail_insumos"], "text"), 
GetSQLValueString($_POST["otros"], "text"), 
GetSQLValueString($otros, "text"), 
GetSQLValueString($_POST["mail_otros"], "text"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;
mysql_free_result($Result);




if ('No'==$_POST["personal"]) {
$emailune='mauricio.rivera@supernotariado.gov.co';
$subject = 'Reactivación de ORIPS';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de personal para la reactivación de una ORIP"; 
$cuerpo .= "<br><br>"; 
$cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <a href="https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp">https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>'; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailune,$subject,$cuerpo,$cabeceras);
} else {} 



if (1==$_POST['regional']) {  $emailun='jhon.jaimes@supernotariado.gov.co,diana.losada@supernotariado.gov.co';
} else if (2==$_POST['regional']) { $emailun='carlos.orozco@supernotariado.gov.co,oscar.serna@supernotariado.gov.co';
} else if (3==$_POST['regional']) { $emailun='marly.estrada@supernotariado.gov.co,milagro.villalobos@supernotariado.gov.co';
} else if (4==$_POST['regional']) { $emailun='diego.salazar@supernotariado.gov.co,jair.corcino@supernotariado.gov.co';
} else if (5==$_POST['regional']) {  $emailun='nelson.penuela@supernotariado.gov.co,edgar.bahamon@supernotariado.gov.co';
} else { $emailun='giovanni.ortegon@supernotariado.gov.co';}

if ('No'==$_POST["insumos"]) {
$subject = 'Reactivación de ORIPS';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad para la reactivación de una ORIP"; 
$cuerpo .= "<br>"; 
$cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp">https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>'; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailun,$subject,$cuerpo,$cabeceras);
} else {} 



if (isset($_POST['tecnologia'])){
$emailu1='wilson.barrios@supernotariado.gov.co';
$subject = 'Reactivación de ORIPS';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de tecnologia para la reactivación de una ORIP"; 
$cuerpo .= "<br>"; 
$cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp">https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>'; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu1,$subject,$cuerpo,$cabeceras);
} else {}
	
	if (isset($_POST['infraestructura'])){
$emailu2='sandra.ruiz@supernotariado.gov.co';
$subject = 'Reactivación de ORIPS';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de infraestructura para la reactivación de una ORIP"; 
$cuerpo .= "<br>"; 
$cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp">https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>'; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu2,$subject,$cuerpo,$cabeceras);
} else {}

if (isset($_POST['capacitacion'])){
$emailu3='beatrizh.galindo@supernotariado.gov.co';
$subject = 'Reactivación de ORIPS';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de capacitación para la reactivación de una ORIP"; 
$cuerpo .= "<br>"; 
$cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp">https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>'; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu3,$subject,$cuerpo,$cabeceras);
} else {}


if (isset($_POST['ente_territorial'])){
$emailu4=$emailun;
$subject = 'Reactivación de ORIPS';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de ente territorial para la reactivación de una ORIP"; 
$cuerpo .= "<br>"; 
$cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp">https://sisg.supernotariado.gov.co/orip&'.$id.'.jsp</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>'; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu4,$subject,$cuerpo,$cabeceras);

} else {}

	




} else {}
	
	
	


$query_update = sprintf("SELECT * FROM oficina_registro WHERE oficina_registro.id_oficina_registro = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
mysql_free_result($update);
?>


<?php 
if ((1==$_SESSION['rol']) or 0<$nump) { 
?>

<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar ORIP:</b></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form1" >
<div class="form-group text-left"> 
<label  class="control-label">DIRECCION DE LA ORIP:</label>   
<input type="text" class="form-control" name="direccion_oficina_registro"   value="<?php echo $row_update['direccion_oficina_registro']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">TELEFONO DE LA ORIP:</label>   
<input type="text" class="form-control" name="telefono_oficina_registro"   value="<?php echo $row_update['telefono_oficina_registro']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">EMAIL DE LA ORIP:</label>   
<input type="text" class="form-control" name="correo_oficina_registro"   value="<?php echo $row_update['correo_oficina_registro']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">REGIONAL:</label>   
<select  class="form-control" name="id_region" required>
<option value="1" <?php if (1==$row_update['id_region']) { echo 'selected'; } else {} ?>>Región Central</option>
<option value="2" <?php if (2==$row_update['id_region']) { echo 'selected'; } else {} ?>>Región Andina</option>
<option value="3" <?php if (3==$row_update['id_region']) { echo 'selected'; } else {} ?>>Región Caribe</option>
<option value="4" <?php if (4==$row_update['id_region']) { echo 'selected'; } else {} ?>>Región Pacifica</option>
<option value="5" <?php if (5==$row_update['id_region']) { echo 'selected'; } else {} ?>>Región Orinoquia</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"> CIRCULO REGISTRAL:</label> 
 <input type="text" class="form-control" name="circulo"   value="<?php echo $row_update['circulo']; ?>">
</div>



<div class="form-group text-left"> 
<label  class="control-label">SISTEMA MISIONAL:</label>   
<select  class="form-control" name="id_oficina_registro_sismisional" required>
<option value="1" <?php if (1==$row_update['id_oficina_registro_sismisional']) { echo 'selected'; } else {} ?>>FOLIO</option>
<option value="2" <?php if (2==$row_update['id_oficina_registro_sismisional']) { echo 'selected'; } else {} ?>>SIR</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Con SGD - IRIS:</label>   
<select  class="form-control" name="id_oficina_registro_sismisional" required>
<option value="1" <?php if (1==$row_update['iris']) { echo 'selected'; } else {} ?>>Si</option>
<option value="0" <?php if (0==$row_update['iris']) { echo 'selected'; } else {} ?>>No</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label">HORARIO:</label>   
<input type="text" class="form-control" name="horario_oficina_registro"   value="<?php echo $row_update['horario_oficina_registro']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">LATITUD:</label>   
<input type="text" class="form-control" name="latitud"   value="<?php echo $row_update['latitud']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label">LONGITUD:</label>   
<input type="text" class="form-control" name="longitud"   value="<?php echo $row_update['longitud']; ?>">
</div>



<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success"><input type="hidden" name="table" value="notaria">
<span class="glyphicon glyphicon-ok"></span> Actualizar</button></div></form>



</div>
</div> 
</div> 
</div> 

<?php 
} else {}


?>


<div class="modal fade" id="actualizarsituacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Situación administrativa</h4>
      </div>
      <div class="modal-body" id="resultadoposesion">
    
   
    </div> 
</div> 
</div> 
</div> 
    
    
    
    
    
    
    
    
    
<div class="modal fade" id="updatesituacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Situación administrativa</h4>
      </div>
      <div class="modal-body" id="resultadoactposesion">
    
   
    </div> 
</div> 
</div> 
</div> 
    
    
    
    
    
<div class="modal fade" id="resultadopermisolicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Detalles del permiso o licencia</h4>
      </div>
      <div class="modal-body" id="resultadopermiso">
    
   
    </div> 
</div> 
</div> 
</div> 

    
    
    
<?php  if ((1==$_SESSION['rol']) or 0<$numpose) {  ?>

 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva situación</h4>
      </div>
      <div class="modal-body">
    
<form action="" method="POST" name="form1" onsubmit="return validate();"><div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> USUARIO:</label> 
<select  class="form-control" name="id_funcionario" required>
<option selected></option>
<?php
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_tipo_oficina=3 and id_rol=3 and id_cargo=1 and estado_funcionario=1 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
  echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].'</option>';
   } while ($row = mysql_fetch_assoc($select)); 
} else {}  
mysql_free_result($select);
?>
</select> 
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ACTO DE NOMBRAMIENTO:</label> 

 <select class="form-control" name="acto_nombramiento" required>
    <option value="" selected></option>
    <option value="Decreto">Decreto</option>
    <option value="Resolucion">Resolucion</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO:</label> 
<input type="text"  required class="form-control" name="numero_nombramiento"   >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE NOMBRAMIENTO:</label> 
<select  class="form-control" name="id_tipo_nombramiento_n" required>
<option value="" selected></option>
<?php echo lista('tipo_nombramiento_n'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE INICIO:</label> 
<input type="text" readonly="readonly" required class="form-control datepicker" name="fecha_inicio"   >
</div>

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success"><input type="hidden" name="table" value="posesion_oficina_registro">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>
</form>

</div>
</div> 
</div> 
</div> 



<?php } else { } ?>







 <div class="row">
        <div class="col-md-4">

     
          <div class="box box-primary">
            <div class="box-body box-profile">
      
      <div class="box-tools">
         <?php 
if (1==$_SESSION['rol'] or (0<$nump)){ ?>
 &nbsp; <a href=""  data-toggle="modal" data-target="#popup">
<button type="button" class="btn btn-warning btn-xs" >Actualizar</button>
  </a>
<?php } else { } ?>
              </div>
        
      
      
            <p class="text-muted text-center">Oficina de Registro de Intrumentos Publicos</p>
              <h3 class="profile-username text-center"><?php echo $row_update['nombre_oficina_registro']; ?></h3>

              <p class="text-muted text-center"><?php echo quees('departamento', $row_update['id_departamento']); ?> / <?php echo nombre_municipio($row_update['codigo_municipio'], $row_update['id_departamento']); ?></p>

            <!-- <p class="text-muted text-center">DANE: <?php echo $row_update['codigo_dane']; ?></p> -->
          
              <ul class="list-group list-group-unbordered">
                <!-- <li class="list-group-item">
                  <b>Categoria:</b> <?php echo $row_update['id_categoria_oficina_registro']; ?>
                </li> -->
                <li class="list-group-item">
                  <b>Teléfono:</b> <?php echo $row_update['telefono_oficina_registro']; ?>
                </li>

                <li class="list-group-item">
                  <b>Fax:</b> <?php echo $row_update['fax_oficina_registro']; ?>
                </li>

                <li class="list-group-item">
                  <b>Email:</b> <?php echo $row_update['correo_oficina_registro']; ?>
                </li>
           <li class="list-group-item">
                  <b>Dirección:</b> <?php echo $row_update['direccion_oficina_registro']; ?>
                </li>
           <li class="list-group-item">
                  <b>Horario:</b> <?php echo $row_update['horario_oficina_registro']; ?>
                </li>
        
      
        
         <li class="list-group-item">
          <b>Circulo Registral:</b> 
          <?php echo $row_update['circulo']; ?>
         </li>

          <li class="list-group-item">
                  <b>Regional:</b> <?php echo quees('region', $row_update['id_region']);?>
                </li>
        
         <li class="list-group-item">
                  <b>Sistema Misional:</b> <?php echo quees('oficina_registro_sismisional', $row_update['id_oficina_registro_sismisional']);?>
                </li>
        
		
		
		
		<li class="list-group-item">
                  <b>Con sistema de gestión documental - Iris:</b> <?php if (1==$row_update['iris']) { echo 'Si'; } else { echo 'No'; }?>
                </li>
		
         <!--<li class="list-group-item">
                  <b>Acto de creación:</b> <?php echo $row_update['acto_creacion']; ?>
                </li>
        
        <li class="list-group-item">
                  <b>Número de acto:</b> <?php echo $row_update['numero_acto']; ?>
                </li>
        
        <li class="list-group-item">
                  <b>Fecha del acto:</b> <?php echo $row_update['fecha_acto']; ?>
                </li> -->
        

   <li class="list-group-item">
                  <b>Geolocalización:</b> <?php echo $row_update['latitud']; ?>, <?php echo $row_update['longitud']; ?>
                </li>

        </ul>

        
        
 <div id="mapid" style="width: 100%; min-height: 315px;border: 2px #333;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
</div>
<br>
<b>Comprensión registral</b>
 <table class="table">
                <thead>
                </thead>
                <tbody>          
                <?php
           $circulo=$row_update['circulo'];
          $actualizar57ll = mysql_query("SELECT nombre_municipio_orip from municipio_orip where circulo_orip='$circulo'  and estado_municipio_orip=1 order by nombre_municipio_orip", $conexion);
          $row157ll = mysql_fetch_assoc($actualizar57ll);
          $total557ll = mysql_num_rows($actualizar57ll);
          if (0<$total557ll) {
           do { 
           
              echo '<tr><td>';  
                
                echo $row157ll['nombre_municipio_orip'].'</td></tr>';
           
           } while ($row157ll = mysql_fetch_assoc($actualizar57ll)); 
            mysql_free_result($actualizar57ll);
          } else {}
          ?>
                </tbody>
                </table>
				
				
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>

      <script>

  var mymap = L.map('mapid').setView([<?php echo $row_update['latitud']; ?>, <?php echo $row_update['longitud']; ?>], 12);  // toda colombia 6

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    
  
    maxZoom: 18,
    attribution: 'OpenStreetMap' +
      '' +
      '',
    id: 'open.streets'
  }).addTo(mymap);

  
  L.marker([<?php echo $row_update['latitud']; ?>, <?php echo $row_update['longitud']; ?>]).addTo(mymap)
   .bindPopup('<?php echo $row_update['nombre_notaria']; ?>');
   
</script><br>


    
  
            </div>
            <!-- /.box-body -->

          </div>

      


        </div>
        <!-- /.col -->
		<div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Funcionario</a></li>
			 <?php if (1==$_SESSION['rol'] or 0<$nump53) { ?>
			    <li><a href="#encuesta" data-toggle="tab">Encuesta Bioseguridad</a></li>
			 <?php } else {}  ?>
         
              <li><a href="#settings" data-toggle="tab">Medios de recaudo</a></li>
			 <li><a href="#control" data-toggle="tab">Reactivación Oficina</a></li>
			 <!-- <li><a href="#suspension" data-toggle="tab">Suspensión de servicio</a></li>-->
            </ul>
            <div class="tab-content">
			
			
			
			
              <div class="active tab-pane" id="activity">
 
  <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
 	   <?php          
$queryn = sprintf("SELECT funcionario.id_cargo, cedula_funcionario, nombre_funcionario, correo_funcionario, id_funcionario, nombre_cargo FROM funcionario, cargo where funcionario.id_cargo=cargo.id_cargo and id_oficina_registro=".$id." and id_tipo_oficina=2 and estado_funcionario=1 order by funcionario.id_cargo desc");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
?>
            
          <table class="table table-striped table-bordered table-hover" id="detallefun">
            <thead>
            <tr>
			  <th style="width:3px !important;"></th>
        <th>Cedula</th>
              <th>Nombre</th>
              <th>Correo</th>
        <th>Cargo</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
      do {
  echo '<tr>';
echo '<td style="width:3px !important;"><span style="font-size:3px;">'.$rown['id_cargo'].'</span></td>';
echo '<td>'.$rown['cedula_funcionario'].'</td>';
echo '<td>'.$rown['nombre_funcionario'].'</td>';
echo '<td>'.$rown['correo_funcionario'].'</td>';
echo '<td>'.$rown['nombre_cargo'].'</td>';
echo '<td><a href="usuario&'.$rown['id_funcionario'].'.jsp"><span class="glyphicon glyphicon-user"></span></a></td></tr>';

if (1==$rown['id_cargo']) {
$correo_registrador=$rown['correo_funcionario'];
} else {}

} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


?>
<script>
                  $(document).ready(function() {
                $('#detallefun').DataTable({
                  "lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                  }
                });
              });
            </script>
 </tbody>
          </table>
           
				  
      
	
        </div>
    </div>
    </div>
  </div>
			  
			  
	






 <?php if (1==$_SESSION['rol'] or 0<$nump53) { ?>
  <div class="active tab-pane" id="encuesta">
 
  <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 <?php       

if (isset($_POST['p1']) and ""!=$_POST['p1']) {

$varen1=intval($_POST['p1']);
$varen2=intval($_POST['p2']);
$varen3=intval($_POST['p3']);
$varen4=intval($_POST['p4']);
$varen5=intval($_POST['p5']);
$varen6=intval($_POST['p6']);
$varen7=intval($_POST['p7']);
$varen8=intval($_POST['p8']);
$varen9=intval($_POST['p9']);
$varen10=intval($_POST['p10']);
$varen11=intval($_POST['p11']);
$varen12=intval($_POST['p12']);
$varen13=intval($_POST['p13']);
$varen14=intval($_POST['p14']);
$varen15=intval($_POST['p15']);
$varen16=intval($_POST['p16']);
$varen17=intval($_POST['p17']);
$varen18=intval($_POST['p18']);
$varen19=intval($_POST['p19']);
$varen20=intval($_POST['p20']);
$varen21=intval($_POST['p21']);
$varen22=$_POST['p22'];
$varen23=$_POST['p23'];
$varen24=$_POST['p24'];
$varen25=intval($_POST['p25']);
$varen26=$_POST['p26'];
$varen27=$_POST['p27'];
$varen28=$_POST['p28'];
$varen29=$_POST['p29'];
$varen30=$_POST['p30'];
$varen31=$_POST['p31'];
$varen32=$_POST['p32'];
$varen33=$_POST['p33'];
$varen34=$_POST['p34'];
$varen35=$_POST['p35'];
$varen36=$_POST['p36'];
$varen37=$_POST['p37'];
$insertSQL5 = sprintf("INSERT INTO reactivacion_respuesta (id_oficina_registro, fecha, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, p33, p34, p35, p36, p37, estado_reactivacion_respuesta) 
VALUES (%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($varen1, "int"), 
GetSQLValueString($varen2, "int"), 
GetSQLValueString($varen3, "int"), 
GetSQLValueString($varen4, "int"), 
GetSQLValueString($varen5, "int"), 
GetSQLValueString($varen6, "int"), 
GetSQLValueString($varen7, "int"), 
GetSQLValueString($varen8, "int"), 
GetSQLValueString($varen9, "int"), 
GetSQLValueString($varen10, "int"), 
GetSQLValueString($varen11, "int"), 
GetSQLValueString($varen12, "int"), 
GetSQLValueString($varen13, "int"), 
GetSQLValueString($varen14, "int"), 
GetSQLValueString($varen15, "int"), 
GetSQLValueString($varen16, "int"), 
GetSQLValueString($varen17, "int"), 
GetSQLValueString($varen18, "int"), 
GetSQLValueString($varen19, "int"), 
GetSQLValueString($varen20, "int"), 
GetSQLValueString($varen21, "int"), 
GetSQLValueString($varen22, "text"), 
GetSQLValueString($varen23, "text"), 
GetSQLValueString($varen24, "text"), 
GetSQLValueString($varen25, "int"), 
GetSQLValueString($varen26, "text"), 
GetSQLValueString($varen27, "text"), 
GetSQLValueString($varen28, "text"), 
GetSQLValueString($varen29, "text"), 
GetSQLValueString($varen30, "text"), 
GetSQLValueString($varen31, "text"), 
GetSQLValueString($varen32, "text"), 
GetSQLValueString($varen33, "text"), 
GetSQLValueString($varen34, "text"), 
GetSQLValueString($varen35, "date"),
GetSQLValueString($varen36, "text"),
GetSQLValueString($varen37, "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL5, $conexion);


echo $insertado;
mysql_free_result($Result);



} else {}




global $mysqli;
$mysqli = new mysqli($hostname_conexion2, $username_conexion2, $password_conexion2, $database_conexion2);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}

function reactivacion_respuesta($idg, $preg) {
global $mysqli;
$query4 = sprintf("SELECT ".$preg." FROM reactivacion_respuesta where id_oficina_registro=".$idg." and estado_reactivacion_respuesta=1 limit 1"); 
$result4 = $mysqli->query($query4);
$obj = $result4->fetch_array(MYSQLI_ASSOC);
printf ("%s", $obj[$preg]);
//return $res;
$result4->free();
}


$querynn = sprintf("SELECT count(id_reactivacion_respuesta) as totnot FROM reactivacion_respuesta where estado_reactivacion_respuesta=1 and id_oficina_registro=".$id." "); 
$selectnn = mysql_query($querynn, $conexion);
$rownn = mysql_fetch_assoc($selectnn);
if (0<$rownn['totnot']){
	
	

if (isset($_POST['up1']) and ""!=$_POST['up1']) {


$updatecc = sprintf("UPDATE reactivacion_respuesta SET 
p1=%s, p2=%s, p3=%s, p4=%s, p5=%s, p6=%s, p7=%s, p8=%s, p9=%s, p10=%s, p11=%s, p12=%s, p13=%s, p14=%s, p15=%s, p16=%s, p17=%s, p18=%s, p19=%s, p20=%s, p21=%s, p22=%s, p23=%s, p24=%s, p25=%s, p26=%s, p27=%s, p28=%s, p29=%s, p30=%s, p31=%s, p32=%s, p33=%s, p34=%s, p35=%s, p36=%s, p37=%s 
 WHERE id_oficina_registro=".$id." and estado_reactivacion_respuesta=1",                  

GetSQLValueString($_POST['up1'], "int"), 
GetSQLValueString($_POST['up2'], "int"), 
GetSQLValueString($_POST['up3'], "int"), 
GetSQLValueString($_POST['up4'], "int"), 
GetSQLValueString($_POST['up5'], "int"), 
GetSQLValueString($_POST['up6'], "int"), 
GetSQLValueString($_POST['up7'], "int"), 
GetSQLValueString($_POST['up8'], "int"), 
GetSQLValueString($_POST['up9'], "int"), 
GetSQLValueString($_POST['up10'], "int"), 
GetSQLValueString($_POST['up11'], "int"), 
GetSQLValueString($_POST['up12'], "int"), 
GetSQLValueString($_POST['up13'], "int"), 
GetSQLValueString($_POST['up14'], "int"), 
GetSQLValueString($_POST['up15'], "int"), 
GetSQLValueString($_POST['up16'], "int"), 
GetSQLValueString($_POST['up17'], "int"), 
GetSQLValueString($_POST['up18'], "int"), 
GetSQLValueString($_POST['up19'], "int"), 
GetSQLValueString($_POST['up20'], "int"), 
GetSQLValueString($_POST['up21'], "int"), 
GetSQLValueString($_POST['up22'], "text"), 
GetSQLValueString($_POST['up23'], "text"), 
GetSQLValueString($_POST['up24'], "text"), 
GetSQLValueString($_POST['up25'], "int"), 
GetSQLValueString($_POST['up26'], "text"), 
GetSQLValueString($_POST['up27'], "text"), 
GetSQLValueString($_POST['up28'], "text"), 
GetSQLValueString($_POST['up29'], "text"), 
GetSQLValueString($_POST['up30'], "text"), 
GetSQLValueString($_POST['up31'], "text"), 
GetSQLValueString($_POST['up32'], "text"), 
GetSQLValueString($_POST['up33'], "text"), 
GetSQLValueString($_POST['up34'], "text"), 
GetSQLValueString($_POST['up35'], "date"),
GetSQLValueString($_POST['up36'], "text"),
GetSQLValueString($_POST['up37'], "text"),
GetSQLValueString(1, "int"));

$Resulta = mysql_query($updatecc, $conexion);

echo $actualizado;
mysql_free_result($Resulta);
} else {}





echo '<b>Encuesta enviada</b> &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp; ';
	

if (isset($_GET['e'])) { 

///////////////  actualización


$queryn = sprintf("SELECT * FROM reactivacion_encuesta where estado_reactivacion_encuesta=1");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
?>
    <form action="" method="POST" name="foractualizam1" onsubmit="">        
          <table class="table">
            <thead>
            <tr>	
        <th></th>
              <th>Pregunta</th>
              <th>Respuesta</th>
            </tr>
            </thead>
            <tbody>
            <?php
      do {  
		  echo $rown['nombre_seccion'];	  
$pre='p'.$rown['id_reactivacion_encuesta'];

echo '<tr>';
echo '<td><span>'.$rown['id_reactivacion_encuesta'].'</span></td>';
echo '<td>'.$rown['nombre_reactivacion_encuesta'].'';
echo '</td>';
echo '<td>';
if (1==$rown['tipo_pregunta']) {
echo '<input type="text" class="form-control numero" required placeholder="Solo números" name="up'.$rown['id_reactivacion_encuesta'].'" value="';
echo reactivacion_respuesta($id, $pre);
echo '">';
} else if (2==$rown['tipo_pregunta']) {
echo '<select name="up'.$rown['id_reactivacion_encuesta'].'" required class="form-control">';	
echo '<option value="';
echo reactivacion_respuesta($id, $pre);
echo '" selected>';
echo reactivacion_respuesta($id, $pre);
echo '</option>';
echo '<option value="Si">Si</option>';
echo '<option value="No">No</option>';
echo '</select>';

} else if (3==$rown['tipo_pregunta']) {
	
$updatet = mysql_query("select p35 from reactivacion_respuesta where id_oficina_registro=".$id." and estado_reactivacion_respuesta=1", $conexion);
$rowt = mysql_fetch_assoc($updatet);
$respuestafecha=$rowt['p35'];
mysql_free_result($updatet);
	
echo '<input type="text" class="form-control datepicker" readonly name="up'.$rown['id_reactivacion_encuesta'].'" value="'.$respuestafecha.'">';	
} else {}

echo '</td></tr>';
		 

} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


?>    
	</table>
	<div class="modal-footer">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div>

</form>


<?php






} else {
echo '<a href="orip&'.$id.'&1.jsp" class="btn btn-xs btn-warning">Actualizar</a>';


$queryn = sprintf("SELECT * FROM reactivacion_encuesta where estado_reactivacion_encuesta=1");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
   
echo ' <table class="table">
            <thead>
            <tr>	
        <th></th>
              <th>Pregunta</th>
              <th>Respuesta</th>
            </tr>
            </thead>
            <tbody>';
           
      do {
		   echo $rown['nombre_seccion'];
  echo '<tr>';
echo '<td><span>'.$rown['id_reactivacion_encuesta'].'</span></td>';
echo '<td>'.$rown['nombre_reactivacion_encuesta'].'</td>';
echo '<td>';
if (35==$rown['id_reactivacion_encuesta']){	
$updatet = mysql_query("select p35 from reactivacion_respuesta where id_oficina_registro=".$id." and estado_reactivacion_respuesta=1", $conexion);
$rowt = mysql_fetch_assoc($updatet);
echo $rowt['p35'];
mysql_free_result($updatet);

} else {
 $pre='p'.$rown['id_reactivacion_encuesta'];
echo reactivacion_respuesta($id, $pre);
} 
echo '</td></tr>';


} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


echo '</table>';

}

} else {



$queryn = sprintf("SELECT * FROM reactivacion_encuesta where estado_reactivacion_encuesta=1");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
?>
    <form action="" method="POST" name="form1" onsubmit="">        
          <table class="table">
            <thead>
            <tr>	
        <th></th>
              <th>Pregunta</th>
              <th>Respuesta</th>
            </tr>
            </thead>
            <tbody>
            <?php
      do {
		  
		  echo $rown['nombre_seccion'];
		  
		  
if (31==$rown['id_reactivacion_encuesta']) {
		if 	(1==$row_update['iris'])  {
echo '<tr><td>31</td><td>'.$rown['nombre_reactivacion_encuesta'].'</td><td>
<select name="p31" required class="form-control">
<option value="" selected></option>
<option value="Si">Si</option>
<option value="No">No</option>
</select>
</td></tr>';	
		} else {
       echo '<input type="hidden" name="p31" value="No">';
			}
		  } else { 

  echo '<tr>';
echo '<td><span>'.$rown['id_reactivacion_encuesta'].'</span></td>';
echo '<td>'.$rown['nombre_reactivacion_encuesta'].'';
echo '</td>';
echo '<td>';
if (1==$rown['tipo_pregunta']) {
echo '<input type="text" class="form-control numero" required placeholder="Solo números" name="p'.$rown['id_reactivacion_encuesta'].'" value="">';
} else if (2==$rown['tipo_pregunta']) {
echo '<select name="p'.$rown['id_reactivacion_encuesta'].'" required class="form-control">';	
echo '<option value="" selected></option>';
echo '<option value="Si">Si</option>';
echo '<option value="No">No</option>';
echo '</select>';
} else if (3==$rown['tipo_pregunta']) {
echo '<input type="text" class="form-control datepicker" readonly name="p'.$rown['id_reactivacion_encuesta'].'" value="">';	
} else {}

echo '</td></tr>';
		  }

} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


?>    
	</table>
	<div class="modal-footer">
<button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>

</form>
<?php }
mysql_free_result($selectnn);
 ?>

        </div>
    </div>
    </div>
	</div>
 <?php } else {} ?>
	
			  
			  
			  
			  




              <div class="tab-pane" id="settings">
             <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
          <table class="table table-borderless">
      <thead>
        <tr>
          <th scope="col"><i class="glyphicon glyphicon glyphicon-cog"></i> Configuracion de Medios Recaudo</th>
          <th scope="col">Activo / Inhabilitado</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Cuenta Producto:</th>
          <td>
            <?php
              $opconoff = 0;
                if ($opconoff == $row_update['opc_1']){ 
                echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
               }else { 
                echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
              }?>
          </td>
        </tr>
        <tr>
          <th scope="row">Liquidador Derechos de Registro(VUR):</th>
          <td>
            <?php
              $opconoff = 0;
                if ($opconoff == $row_update['opc_2']){ 
                echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
               }else { 
                echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
              }?>
          </td>
        </tr>
        <tr>
          <th scope="row">Supergiros:</th>
          <td>
            <?php
              $opconoff = 0;
                if ($opconoff == $row_update['opc_3']){ 
                echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
               }else { 
                echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
              }?>
          </td>
        </tr>
        <tr>
          <th scope="row">Radicacion Electronica (REL):</th>
          <td>
            <?php
              $opconoff = 0;
                if ($opconoff == $row_update['opc_4']){ 
                echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
               }else { 
                echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
              }?>
          </td>
        </tr>
        <tr>
          <th scope="row">Datafono:</th>
          <td>
            <?php
              $opconoff = 0;
                if ($opconoff == $row_update['opc_5']){ 
                echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
               }else { 
                echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
              }?>
          </td>
        </tr>
        <tr>
          <th scope="row">Otras ORIPS antiguo botón de pago:</th>
          <td>
            <?php
              $opconoff = 0;
                if ($opconoff == $row_update['opc_6']){ 
                echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
               }else { 
                echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
              }?>
          </td>
        </tr>
        <tr>
          <th scope="row">Sellos:</th>
          <td>
            <?php
              $opconoff = 0;
                if ($opconoff == $row_update['opc_7']){ 
                echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
               }else { 
                echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
              }?>
          </td>
        </tr>
        <tr>
          <th scope="row">Inmediatos canales web y electrónicos:</th>
          <td>
            <?php
              $opconoff = 0;
                if ($opconoff == $row_update['opc_8']){ 
                echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
               }else { 
                echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
              }?>
          </td>
        </tr>
      </tbody>
    </table>
  
          
	
        </div>
    </div>
    </div>
	
              </div>
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
<div class="tab-pane" id="control">
<div class="post">
<div class="user-block">
 <div class="col-xs-12 table-responsive ">
<?php if (0<$nump51 or 0<$nump52 or 1==$_SESSION['rol']) { 

?>
<button class="btn btn-success" data-toggle="modal"data-target="#popupcontrol" title="Control"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo</button>
<br>
<?php 

} else {} ?>
<br>
 	   <?php  

 if (isset($_POST['resolucion_r'])){ 
 $reactivacion_orip=intval($_POST['reactivacion_orip']);
 
  $resolucion_r=$_POST['resolucion_r'];
  $fecha_resolucion_r=$_POST['fecha_resolucion_r'];
  $fecha_apertura=$_POST['fecha_apertura'];
	$updateSQLe = "UPDATE reactivacion_orip SET 
resolucion_r='$resolucion_r', 
fecha_resolucion_r='$fecha_resolucion_r', 
fecha_apertura='$fecha_apertura' 
	where id_oficina_registro=".$id." and id_reactivacion_orip=".$reactivacion_orip." and estado_reactivacion_orip=1 limit 1";
	$Result1e = mysql_query($updateSQLe, $conexion);
	echo $actualizado;
	mysql_free_result($Result1e);
		} else {}

	   
$queryn = sprintf("SELECT * from reactivacion_orip where id_oficina_registro=".$id." and estado_reactivacion_orip=1 order by fecha_reactivacion_orip desc");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
  $totalRows = mysql_num_rows($selectn);
if(0<$totalRows){
      do {  //alert alert-success
	if ("Si"==$rown['personal'] && "Si"==$rown['insumos'] && "Si"==$rown['otros']) { $color='background:#D0E9C6;'; } else { $color='background:#f2f2f2;'; }
  echo '<div  style="border-radius: 5px;margin:10px 2px 0px 2px;padding:10px 10px 10px 10px;'.$color.'">';
  echo ''.$rown['fecha_reactivacion_orip'].'<br>';
echo '<b>Activación por Personal: '.$rown['personal'].'</b>; '.$rown['obs_personal'].'.<br>';


echo '<b>Activación por insumos: '.$rown['insumos'].'</b>; '.$rown['obs_insumos'].'.<br>';


echo '<b>Activación por Otros: '.$rown['otros'].'</b>; '.$rown['obs_otros'].'<br>';


if (isset($rown['soporte'])){
echo '<br><a href="filesnr/reactivacion_orip/'.$rown['soporte'].'" target="_blank">Ver Soporte</a>';
} else {}

if ("Si"==$rown['personal'] && "Si"==$rown['insumos'] && "Si"==$rown['otros']) {
	if (0<$nump52 or 1==$_SESSION['rol']) { 	
	echo '<hr><form action="" method="post">
	<input type="hidden" name="reactivacion_orip" value="'.$rown['id_reactivacion_orip'].'">
	<b>Resolución activación:</b> <input type="text" style="width:90px;" name="resolucion_r" value="'.$rown['resolucion_r'].'" class="numero" placeholder="N. Resolución">
	de <input type="text" style="width:130px;" name="fecha_resolucion_r" value="'.$rown['fecha_resolucion_r'].'" class="datepicker" placeholder="Fecha resolución">
	Apertura: <input type="text" style="width:130px;" name="fecha_apertura" value="'.$rown['fecha_apertura'].'" class="datepicker" placeholder="Fecha apertura">
	<input type="submit" value="Guardar" style="background:#008D4C;color:#fff;">
	</form>';
	} else {}
} else {}
echo '</div>';
} while ($rown = mysql_fetch_assoc($selectn));
				}
mysql_free_result($selectn);


?>

		  

        </div>
    </div>
    </div>
 </div>
			  
			  
			  
			  
			
<!--
<div class="tab-pane" id="suspension">
 <div class="post">
 <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
</div>
</div>
 </div>
</div>-->



			
			  
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
	  
	  
	  
	  <div class="modal fade" id="popupcontrol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Reactivación de ORIP / <?php echo $row_update['nombre_oficina_registro']; ?></label></h4>
			</div> 
			<div class="modal-body"> 
<form action="" method="POST" name="form1" onsubmit="" enctype="multipart/form-data">
<input type="hidden" name="regional" value="<?php echo $row_update['id_region']; ?>">
<input type="hidden" name="correo_registrador" value="<?php echo $correo_registrador; ?>">	
	
<div class="form-group text-left"> 
<div class="input-group">
<label  class="control-label input-group-addon">
<b>Personal:</b></label> 
<span class="input-group-addon">
<select name="personal" style="width:65px;" class="form-control" required >
<option value="" selected></option>
<option value="Si">Si</option>
<option value="No">No</option>
</select>
</span>
<textarea name="obs_personal" class="form-control" id="" placeholder="Observación"></textarea>
</div>
</div>


<div class="form-group text-left"> 
<div class="input-group">
<label  class="control-label input-group-addon">
<b>Insumos:</b></label> 
<span class="input-group-addon">
<select name="insumos" style="width:65px;" class="form-control" required >
<option value="" selected></option>
<option value="Si">Si</option>
<option value="No">No</option>
</select>
</span>
<textarea name="obs_insumos" class="form-control" id="" placeholder="Observación"></textarea>
</div>
</div>

<div class="form-group text-left"> 
<div class="input-group">
<label  class="control-label input-group-addon">
<b>Otros:</b></label> 
<span class="input-group-addon">
<select name="otros" style="width:65px;" class="form-control" required >
<option value="" selected></option>
<option value="Si">Si</option>
<option value="No">No</option>
</select>
</span>
<textarea name="obs_otros" class="form-control" id="" placeholder="Observación"></textarea>
</div>
<b>Copiar por correo a:</b> &nbsp; Tecnologia: <input type="checkbox" name="tecnologia" value="" >  &nbsp;   &nbsp; 
Infraestructura: <input type="checkbox" name="infraestructura" value="" >  &nbsp;   &nbsp; 
Capacitación: <input type="checkbox" name="capacitacion" value="" >   &nbsp;   &nbsp; 
Ente territorial: <input type="checkbox" name="ente_territorial" value="" > 
</div>


<div class="form-group text-left"> 
<div class="">
<label  class="control-label">
<b>Soporte:</b></label> 
<input type="file" name="filet" class="form-control" >
<span style="color:#aaa;font-size:13px;">Archivo inferior a 8 Mg</span>
</div>
</div>






<div class="modal-footer">
<button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>

</form>
			</div>
		</div> 
	</div> 
</div> 


    
    <?php
}}
?>


