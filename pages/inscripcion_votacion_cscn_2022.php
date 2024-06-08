<?php

$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2022-09-20 08:00:00");
$fecha_limite = strtotime("2022-10-03 17:00:00");


if($fecha_actual > $fecha_inicio)
	{



$nump74=privilegios(74,$_SESSION['snr']);


if ((1==$_SESSION['rol'] or 0<$nump74) and isset($_GET["i"])) {

$queryk = "SELECT  count(funcionario.id_funcionario) as totp   
FROM notaria, posesion_notaria, funcionario WHERE 
 notaria.id_notaria=posesion_notaria.id_notaria AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND posesion_notaria.fecha_fin IS NULL AND estado_notaria=1 AND estado_funcionario=1 AND estado_posesion_notaria=1 
 AND posesion_notaria.id_tipo_nombramiento_n=2 and funcionario.id_funcionario=".$_GET["i"].""; 
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
	$queryk = "SELECT  count(funcionario.id_funcionario) as totp   
FROM notaria, posesion_notaria, funcionario WHERE 
 notaria.id_notaria=posesion_notaria.id_notaria AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND posesion_notaria.fecha_fin IS NULL AND estado_notaria=1 AND estado_funcionario=1 AND estado_posesion_notaria=1 
 AND posesion_notaria.id_tipo_nombramiento_n=2 and funcionario.id_funcionario=".$_SESSION['snr'].""; 

$selectk = mysql_query($queryk, $conexion);
$rowpk = mysql_fetch_assoc($selectk);
$valp=$rowpk['totp'];
mysql_free_result($selectk);
if (0<$valp) {
$id=$_SESSION['snr'];
//$id=0;
} else {
//$id=0;
$queryk2 = "SELECT * FROM notario_propiedad WHERE id_funcionario=".$_SESSION['snr']." and estado_notario_propiedad=1"; 
$selectk2 = mysql_query($queryk2, $conexion);
$rowpk2 = mysql_fetch_assoc($selectk2);
$valp2=$rowpk2['id_funcionario'];
mysql_free_result($selectk2);
if (0<$valp2) {
$id=$valp2;
} else {
$id=0;
}


}
		
}











if (0<$id) {

if (isset($_POST["votacion"]) && 3==$_SESSION['snr_tipo_oficina']) {
	
//	if (1==intval($_POST["id_categoria1"]) or 1==intval($_POST["id_categoria2"])) {
		
$idf1=$_POST['id_funcionario1'];
$idf2=$_POST['id_funcionario2'];
	
$select = mysql_query("select count(id_candidato_votacion_cscn_2022) as totale from candidato_votacion_cscn_2022 where (id_funcionario1=".$idf1." or id_funcionario2=".$idf1." or  id_funcionario1=".$idf2." or id_funcionario2=".$idf2." ) and estado_candidato_votacion_cscn_2022=1", $conexion);
$row = mysql_fetch_assoc($select);
$numvota=intval($row['totale']);
mysql_free_result($select);

if (0<$numvota) {
echo '<script type="text/javascript">swal(" ERROR !", " Uno de los dos notarios ya se encuentra inscrito. !", "error");</script>';

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
  

$insertSQL = sprintf("INSERT INTO candidato_votacion_cscn_2022 (nombre_candidato_votacion_cscn_2022, 
id_funcionario1, id_funcionario2, id_notaria1, id_notaria2, url, estado_candidato_votacion_cscn_2022) VALUES (now(), %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["id_funcionario1"], "int"), 
GetSQLValueString($_POST["id_funcionario2"], "int"), 
GetSQLValueString($_POST["id_notaria1"], "int"), 
GetSQLValueString($_POST["id_notaria2"], "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));

$Result = mysql_query($insertSQL, $conexion);


$nnota=$_POST["id_notaria1"];
$selectr = mysql_query("select nombre_notaria from notaria where id_notaria=".$nnota." ", $conexion);
$rowr = mysql_fetch_assoc($selectr);
$nombre_notaria=$rowr['nombre_notaria'];
mysql_free_result($selectr);


$emailur='votonotarial@supernotariado.gov.co';
//$emailur='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Inscripción a Votación CSCN 2022';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= 'La superintendencia de notariado y registro informa que se ha registrado correctamente una inscripcion como candidato a las elecciones de representantes de notarios ante el CSCN 2022.';
$cuerpo .= "<br><br>"; 
$cuerpo .= "Notaria: ".$nombre_notaria; 
$cuerpo .= "<br><br>"; 
$cuerpo .= 'Incripción: <a href="https://sisg.supernotariado.gov.co/inscripcion_votacion_cscn_2022&'.$idf1.'.jsp">Ver inscripción</a>'; 
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



$emailur2=$_SESSION['snr_correo'];
//$emailur2='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Inscripción a Votación CSCN 2022';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado
correctamente su inscripción en las elecciones de representantes de notarios ante
el Consejo Superior de la Carrera Notarial 2022.';
$cuerpo2 .= "<br><br>"; 
$cuerpo .= "Notaria: ".$nombre_notaria; 
$cuerpo .= "<br><br>"; 
$cuerpo2 .= 'Incripción: <a href="https://sisg.supernotariado.gov.co/inscripcion_votacion_cscn_2022.jsp">Ver inscripción</a>'; 
$cuerpo2 .= "<br><br>";  
$cuerpo2 .= 'Documento: <a href="https://sisg.supernotariado.gov.co/filesnr/votacion/'.$files.'">Formato diligenciado</a>'; 
$cuerpo2 .= "<br><br>"; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);




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
	
//	} else {
//echo '<script type="text/javascript">swal(" ERROR !", " Una de las dos notarias debe ser de 1 categoria. !", "error");</script>';
//	}
	
} else {}





?>

	  
	  

	  


<div class="row">

<div class="col-md-12">
  
<div class="box">

<div class="box-header with-border">
<h3 class="box-title">INSCRIPCIÓN A VOTACIÓN CSCN 2022</h3>



<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
				
            <div class="box-body">
			<?php 

function vota($fun) {
global $mysqli;
$query = "SELECT * FROM funcionario where id_funcionario=".$fun." and estado_funcionario=1 limit 1 ";
$result4m = $mysqli->query($query);
$row4m = $result4m->fetch_array(MYSQLI_ASSOC);
//$resm=$row4m['nombre_funcionario'];
 $resm='<center><img src="files/'.$row4m['foto_funcionario'].'" style="width:150px;"></center>
				<br>'.$row4m['nombre_funcionario'].'';

				
return $resm;
$result4m->free();
}
  
  
function votan($not) {
global $mysqli;
$queryn = "SELECT * FROM notaria where id_notaria=".$not." and estado_notaria=1 limit 1 ";
$result4mn = $mysqli->query($queryn);
$row4mn = $result4mn->fetch_array(MYSQLI_ASSOC);
//$resmn=$row4mn['nombre_notaria'];
$resmn=' <li><a>Notaria: '.$row4mn['nombre_notaria'].'<span class="pull-right badge bg-blue"></span></a></li>
                <li><a>'.$row4mn['email_notaria'].'<span class="pull-right badge bg-aqua"></span></a></li>
                <li><a>Notaria de '.$row4mn['id_categoria_notaria'].' categoria<span class="pull-right badge bg-green"></span></a></li>';	 
return $resmn;
$result4mn->free();
}



$selecti = mysql_query("select * from candidato_votacion_cscn_2022 where (id_funcionario1=".$id." or id_funcionario2=".$id." ) and estado_candidato_votacion_cscn_2022=1 limit 1", $conexion);
$rowi = mysql_fetch_assoc($selecti);
$numvota= mysql_num_rows($selecti);
if (0<$numvota) {




$idv=$rowi['id_candidato_votacion_cscn_2022'];
$fun1=vota($rowi['id_funcionario1']);
$fun2=vota($rowi['id_funcionario2']);
$namenotaria1=votan($rowi['id_notaria1']);
$namenotaria2=votan($rowi['id_notaria2']);


?>
 <div class="row">
<div class="col-md-12">
Ya tiene una inscripción.<br>
<?php 
echo 'Fecha de inscripción: '.$rowi['nombre_candidato_votacion_cscn_2022'].'<br>';
echo 'Documento de inscripción: <a href="filesnr/votacion/'.$rowi['url'].'" target="_blank"><img src="images/pdf.png"></a>';
?>
<br><br>
</div>
</div>
 <div class="row">
<div class="col-md-6">

			    <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
           
             
				<?php echo $fun1; ?>
            
			  <br>
              <b>Principal</b>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
			 
    <?php echo  $namenotaria1; ?>
            </ul>
            </div>
          </div>
		  
	</div>
<div class="col-md-6">
		   <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
            
	<?php echo $fun2; ?>
	<br>
              <b>Suplente</b>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
			  
   <?php echo  $namenotaria2; ?>           
		   </ul>
            </div>
          </div>
			  
		 </div>

          </div>

<?php
mysql_free_result($selecti);	} else {


$query = "SELECT  *   
FROM notaria, posesion_notaria, funcionario WHERE 
 notaria.id_notaria=posesion_notaria.id_notaria AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND posesion_notaria.fecha_fin IS NULL AND estado_notaria=1 AND estado_funcionario=1 AND estado_posesion_notaria=1 
 AND posesion_notaria.id_tipo_nombramiento_n=2 and funcionario.id_funcionario=".$id." 
limit 1";

$actualizar55 = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($actualizar55);
$idfun=$row['id_funcionario'];
$idnot=$row['id_notaria'];
$rownotaria=$row['nombre_notaria'];
$rowname=$row['nombre_funcionario'];
$rowcedula=$row['cedula_funcionario'];
$codigo_dane=$row['codigo_dane'];
$numn=substr($codigo_dane, -2);
$email=$row['email_notaria'];
$dep=$row['id_departamento'];
$mun=$row['codigo_municipio'];
$foto=$row['foto_funcionario'];
$categoria=$row['id_categoria_notaria'];
$codnotaria=$row['codigo_notaria'];
mysql_free_result($actualizar55);

?>

	<form action="" method="POST" name="form65461" enctype="multipart/form-data"  >	

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
<label  class="control-label"><span style="color:#ff0000;">*</span> ADJUNTAR SOLICITUD: 
<a href="files/portal/portal-formato_inscripcion_cscn_2022.docx">Descargar modelo</a></label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 10 Mg </span>
<div id="imagePreview"></div>
</div>



<div class="box box-widget with-border widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua" >
              <div class="widget-user-image">
                <img src="files/<?php echo $foto; ?>" alt="Fotografia" style="max-width:300px;">
              </div>
              <!-- /.widget-user-image -->
			  <br>
              <h3 class="widget-user-username"><?php echo $rowname; ?></h3>
              <h5 class="widget-user-desc">PRINCIPAL</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="notaria&<?php echo $idnot; ?>.jsp" target="_blank">Notario <?php echo $rownotaria.' ('.$numn.')'; ?><span class="pull-right badge bg-blue"></span></a></li>
                <li><a><?PHP echo $email; ?><span class="pull-right badge bg-aqua"></span></a></li>
                <li><a>Notaria de <?PHP echo $categoria; ?> categoria<span class="pull-right badge bg-green"></span></a></li>
             </ul>
            </div>
          </div>




<div class="modal-footer">


<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<input type="hidden" name="id_funcionario1" value="<?php echo $idfun; ?>">
<input type="hidden" name="id_notaria1" value="<?php echo $idnot; ?>">
<input type="hidden" name="id_categoria1" value="<?php echo $categoria; ?>">
<input type="hidden" name="votacion" value="1">
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Inscribirse</button>

</div>


</div>




<div class="col-md-6">


 
  
		  
  
  
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
});
  </script>
  <div class="form-group text-left"> 
<label  class="control-label">NOTARIO SUPLENTE:</label> 
<select class="form-control select2" id="notaria_votacion" required >
<option value="" selected></option>
<?php 

$query = "SELECT nombre_funcionario, funcionario.id_funcionario FROM notaria, posesion_notaria, funcionario WHERE 
 notaria.id_notaria=posesion_notaria.id_notaria AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND posesion_notaria.fecha_fin IS NULL AND estado_notaria=1 AND estado_funcionario=1 AND estado_posesion_notaria=1 
 AND posesion_notaria.id_tipo_nombramiento_n=2 AND posesion_notaria.fecha_fin IS null order by nombre_funcionario 
 "; 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
echo $totalRows.'<hr>';
if (0<$totalRows){
do {

	echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].'</option>';


	 } while ($row = mysql_fetch_assoc($select)); 
} else {	
}	 
mysql_free_result($select);
 ?>
</select>
</div>

  <div id="suplente">
  </div> 
  <?php } ?>
  
		  
		  </div>
		 
<hr>		 


<?php 


?>

<?php
mysql_free_result($selectn);
 ?>






</form>


<br>
<br>
<br>





</div>
</div>
</div>

</div>






<?php } else { echo 'No tiene acceso, funcionalidad solo para Notarios en propiedad.';}


	} else { 	echo 'Sistema cerrado'; }

 ?>



