<?php
$nump94=privilegios(94,$_SESSION['snr']);
if (2==3) {

if ((1==$_SESSION['rol']) and isset($_GET["i"])) {

$queryk = "SELECT count(id_funcionario) as totp FROM funcionario where id_vinculacion in (2, 3, 4, 7) and id_funcionario=".$_GET["i"].""; 
$selectk = mysql_query($queryk, $conexion);
$rowpk = mysql_fetch_assoc($selectk);
$valp=$rowpk['totp'];
mysql_free_result($selectk);
if (0<$valp) {
$id=$_GET['i'];	
} else {
$id=0;
}

} else {
$queryk = "SELECT count(id_funcionario) as totp FROM funcionario where id_vinculacion in (2, 3, 4, 7) and  id_funcionario=".$_SESSION['snr'].""; 
$selectk = mysql_query($queryk, $conexion);
$rowpk = mysql_fetch_assoc($selectk);
$valp=$rowpk['totp'];
mysql_free_result($selectk);
if (0<$valp) {
$id=$_SESSION['snr'];
//$id=0;
} else {
$id=0;
}
		
}


if (0<$id) {

if (isset($_POST["votacion"])) {
	
//	if (1==intval($_POST["id_categoria1"]) or 1==intval($_POST["id_categoria2"])) {
		
$idf1=$id;
	
$select = mysql_query("select count(id_candidato_votacion_convivencia) as totale from candidato_votacion_convivencia where id_funcionario=".$idf1." and estado_candidato_votacion_convivencia=1", $conexion);
$row = mysql_fetch_assoc($select);
$numvota=intval($row['totale']);
mysql_free_result($select);

if (0<$numvota) {
echo '<script type="text/javascript">swal(" ERROR !", " Ya se encuentra inscrito. !", "error");</script>';

	} else {
	
		
	
$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/votacion/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'votacion-'.$_SESSION['snr'].'-'.date("YmdGis");

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
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  

$insertSQL = sprintf("INSERT INTO candidato_votacion_convivencia (nombre_candidato_votacion_convivencia, 
id_funcionario, url, estado_candidato_votacion_convivencia) VALUES (now(), %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"),  
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));

$Result = mysql_query($insertSQL, $conexion);



$emailur=$_SESSION['snr_correo'];
$subject = 'Inscripción a Votación del comite de convivencia laboral';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= 'La superintendencia de notariado y registro informa que se ha registrado correctamente una inscripcion como candidato a las elecciones del comite de convivencia laboral.';
$cuerpo .= "<br><br>"; 
$cuerpo .= "Funcionario: ".$_SESSION['snr_nombre']; 
$cuerpo .= "<br><br>"; 
$cuerpo .= 'Incripción: <a href="https://sisg.supernotariado.gov.co/inscripcion_votacion_convivencia&'.$idf1.'.jsp">Ver inscripción</a>'; 
$cuerpo .= "<br><br>";  
$cuerpo .= 'Documento: <a href="https://sisg.supernotariado.gov.co/filesnr/votacion/'.$files.'">Formato diligenciado</a>'; 
$cuerpo .= "<br><br>"; 
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur,$subject,$cuerpo,$cabeceras);




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
  
	
	}
	
	
} 





?>

	  
	  
 


<div class="row">

<div class="col-md-12">
  
<div class="box">

<div class="box-header with-border">
<h3 class="box-title">INSCRIPCIÓN A VOTACIÓN / COMITE DE CONVIVENCIA LABORAL</h3>



<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
				
            <div class="box-body">
			<?php 





$selecti = mysql_query("select * from candidato_votacion_convivencia, funcionario where candidato_votacion_convivencia.id_funcionario=funcionario.id_funcionario and candidato_votacion_convivencia.id_funcionario=".$id." and estado_candidato_votacion_convivencia=1 limit 1", $conexion);
$rowi = mysql_fetch_assoc($selecti);
$numvota= mysql_num_rows($selecti);
if (0<$numvota) {

$idv=$rowi['id_candidato_votacion_convivencia'];

?>
 <div class="row">
<div class="col-md-12">
Ya tiene una inscripción.<br>
<?php 
echo 'Fecha de inscripción: '.$rowi['nombre_candidato_votacion_convivencia'].'<br>';
echo 'Documento de inscripción: <a href="filesnr/votacion/'.$rowi['url'].'" target="_blank"><img src="images/pdf.png"></a>';
?>
<br><br>
</div>
</div>
 <div class="row">
<div class="col-md-6">

	<div class="box box-widget with-border widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-success" >
              <div class="widget-user-image">
                <img src="files/<?php echo $rowi['foto_funcionario']; ?>" alt="Fotografia" style="max-width:300px;">
              </div>
              <!-- /.widget-user-image -->
			  <br>
              <h3 class="widget-user-username"><?php echo $rowi['nombre_funcionario']; ?></h3>
              <h5 class="widget-user-desc">Incripción</h5>
            </div>
            <div class="box-footer no-padding">
          
            </div>
          </div>
		  
	</div>
<div class="col-md-6">
	
			  
		 </div>

          </div>

<?php
mysql_free_result($selecti);

	} else {


$query = "SELECT * FROM funcionario where id_funcionario=".$id." and id_vinculacion in (2, 3) limit 1";

$actualizar55 = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($actualizar55);
$idfun=$row['id_funcionario'];
$rowname=$row['nombre_funcionario'];
$rowcedula=$row['cedula_funcionario'];
$foto=$row['foto_funcionario'];
mysql_free_result($actualizar55);

?>

	<form action="" method="POST" name="form655435461" enctype="multipart/form-data"  >	

<div class="col-md-6">

<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
	var fsize = 10000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension pdf');
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
	alert('Debe ser inferior a 10000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> SOLICITUD: <a href="documentos/formato_convivencia_2021.docx">Descargar modelo</a></label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 10 Mg / </span>
<div id="imagePreview"></div>
</div>



<div class="box box-widget with-border widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-success" >
              <div class="widget-user-image">
                <img src="files/<?php echo $foto; ?>" alt="Fotografia" style="max-width:300px;">
              </div>
              <!-- /.widget-user-image -->
			  <br>
              <h3 class="widget-user-username"><?php echo $rowname; ?></h3>
              <h5 class="widget-user-desc">Candidato</h5>
            </div>
            <div class="box-footer no-padding">
          
            </div>
          </div>




<div class="modal-footer">


<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<input type="hidden" name="votacion" value="1">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Inscribirse</button>

</div>


</div>




<div class="col-md-6">


		  
		  </div>
		 
<hr>		 



</form>


<br>
<br>
<br>





</div>
</div>
</div>

</div>






<?php } 

} else { echo 'No tiene acceso, Solo para funcionarios de carrera administrativa, provisionales y de empleo temporal.';}
 
 
} else { echo 'Ya paso la inscripción..';}
 ?>



